import json
import time
import sys
import csv
import os
import random
import requests
import mysql.connector as mariadb
import datetime
import rsc.functions as scrapperHelper

# ---------- CONFIG ----------
# Your API Key
apikey          = str(os.getenv('APIKEY', '0'))
databaseHost    = str(os.getenv('DBHOST', '0'))
databaseName    = str(os.getenv('DBNAME', '0'))
databaseUser    = str(os.getenv('DBUSER', '0'))
databasePwd     = str(os.getenv('DBPWD', '0'))
# Starting ID
startingid = int(os.getenv('STARTINGID', 0))
# Ending ID
endingid = int(os.getenv('ENDINGID', 0))
# Maximal API Requests / Minute
maxrequests = 80


# ------------------------------------------------------
# ---------- Do not edit below here if unsure ----------
# ------------------------------------------------------

# ----------  Imports and Main Link Configuration ----------

homepage1 = "https://api.torn.com/user/"
homepage2 = "?selections=profile,personalstats,crimes&key="


# --------------------------------
# ---------- Functions  ----------
# --------------------------------
# Prints Message With TimeStamp
def addtolog(message):
    localtime = time.asctime(time.localtime(time.time()))
    tempstring = localtime + " | " + message
    print (tempstring)


def removeOldPlayerValue(idPlayer):
    pass

# ----------------------------------
# ---------- MAIN PROGRAM ----------
# ----------------------------------
if(apikey == '0'):
    print("No ApiKey Given! Terminating")
    sys.exit()

current_request = 1
#currentPlayerID = random.randint(startingid,endingid)
currentPlayerID = startingid
while currentPlayerID <= endingid:
    # Creates the DB Connection
    #scrapperHelper.getProcedure(procName='deletePrevious')
    #mydb = createDBConnection()
    #cursor = mydb.cursor(buffered=True)
    mydb = mariadb.connect(
        host = 'tornFarmDB',
        user = 'root',
        password = 'secret',
        database = 'tornFarm'
    )
    mycursor = mydb.cursor()

    # Search for ID as ignored user
    sqlquery = "SELECT id, playerid FROM torn_list_ignored WHERE playerid = %s"
    sqlid = (currentPlayerID, )
    mycursor.execute(sqlquery, sqlid)
    myresult = mycursor.fetchall()

    # Assumes there isn't a Skip Needed
    SkipAction = False
    # Checks if the ID is known as empty and set as Skip if needed
    if ((len(myresult) == 1)):
        SkipAction = True

    # Checks if the X Calls per Minute have been reached and waits if needed
    if ((current_request >= maxrequests) and not (SkipAction)):
        addtolog("Max. Requests Reached. Waiting 40 seconds.")
        current_request = 1
        time.sleep(50)

    # If Target should be skipped
    if(SkipAction):
        mydb.close()
        currentPlayerID += 1
        continue

    # Creates Full Link and makes the Web Request
    if not SkipAction:
        fulllink = homepage1 + str(currentPlayerID) + homepage2 + apikey
        response = json.loads(requests.get(fulllink).text)



    # If it contains an Error Attribute
    if (response.get('error')): #[REMOVEME] and not (SkipAction)):
        if (response.get('error').get('code') == 5):
            addtolog("Too Many Requests. Waiting 10 seconds...")
            current_request = 1
            time.sleep(10)
        else:
            # Error other then 5 means that the PlayerID is invalid
            message = [currentPlayerID, response.get('error').get('code'), response.get('error').get('error')]
            print(message)
            # Add the user to the table
            sqlquery = "INSERT INTO torn_list_ignored (playerid) VALUES (%s)"
            values = (currentPlayerID, )
            mycursor.execute(sqlquery, values)
            mydb.commit()
    # In case Data is returned
    if (response.get('rank')): #[REMOVEME] and not (SkipAction)):
        # Search for ID as known user

        sqlquery = "SELECT id, playerid FROM torn_list WHERE playerid = %s"
        sqlid = (currentPlayerID, )
        mycursor.execute(sqlquery, sqlid)
        myresult = mycursor.fetchall()
        csv = [currentPlayerID, \
               response.get('rank'), \
               response.get('role'), \
               response.get('level'), \
               response.get('awards'), \
               response.get('age'), \
               response.get('player_id'), \
               response.get('name'), \
               response.get('faction').get('faction_name'), \
               response.get('life').get('maximum'), \
               response.get('last_action').get('relative'), \
               datetime.datetime.now(), \
               response.get('criminalrecord').get('total'), \
               response.get('personalstats').get('networth'), \
               response.get('personalstats').get('xantaken'), \
               response.get('personalstats').get('energydrinkused'), \
               response.get('personalstats').get('refills'), \
               response.get('personalstats').get('statenhancersused')]

        # If the User is found
        if(len(myresult) == 1):
            print ("Deleting old PlayerID:", currentPlayerID)
            sqlquery = "DELETE FROM torn_list WHERE playerid = %s"
            values = (csv[0],)
            mycursor.execute(sqlquery, values)


        # Added
        # totalCrimes = %s, totalNetworth = %s, xanTaken = %s, energyDrinkUsed = %s, energyRefills = %s, statEnhancersUsed = %s
        #totalCrimes, totalNetworth, xanTaken, energyDrinkUsed, energyRefills, statEnhancersUsed
        # If the User isn't found
        print ("Creating PlayerID:", currentPlayerID)
        sqlquery = "INSERT INTO torn_list (rank, role, level, awards, age, playerid, name, faction_name, maximum_life, last_action, attack_date, totalCrimes, totalNetworth, xanTaken, energyDrinkUsed, energyRefills, statEnhancersUsed) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)"
        values = (csv[1], csv[2], csv[3], csv[4], csv[5], csv[6], csv[7], csv[8], csv[9], csv[10], csv[11], csv[12], csv[13], csv[14], csv[15], csv[16], csv[17])

        mycursor.execute(sqlquery, values)
        mydb.commit()

    if not SkipAction:
        current_request += 1

    # Closes the DB Connection
    mydb.close()
    currentPlayerID += 1
