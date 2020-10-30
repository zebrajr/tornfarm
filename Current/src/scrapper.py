#!/usr/bin/env python3
# ---------- CONFIG ----------
# Config File
configfile = 'config/settings.json'
# Config File Sample
configfilesample = 'config/settings.json.sample'
# Your API Key
apikey = "qCE5aQ6a2kHPpXoy"
# Starting ID
startingid = 1
# Ending ID
endingid = 2385000
# Maximal API Requests / Minute
maxrequests = 99

# ------------------------------------------------------
# ---------- Do not edit below here if unsure ----------
# ------------------------------------------------------

# ----------  Imports and Main Link Configuration ----------
import time
import sys
import os
from shutil import copyfile
'''
import json
import csv
import random
import requests
import mysql.connector
import datetime
'''

homepage1 = "https://api.torn.com/user/"
homepage2 = "?selections=&key="

# --------------------------------
# ---------- Functions  ----------
# --------------------------------
# Prints Message With TimeStamp
def addtolog(message):
    localtime = time.asctime(time.localtime(time.time()))
    tempstring = localtime + " | " + message
    print (tempstring)

# ----------------------------------
# ---------- MAIN PROGRAM ----------
# ----------------------------------

current_request = 1
while 1==1:
    arr = os.listdir()
    print(arr)
    print("Hey")    
    try:
      with open(configfile, 'r') as f:
        f = open(configfile, 'r')
        file_contents = f.read()
        print(file_contents)
        f.close()
    except:
        print("Config Not Found. Creating from .sample")
        copyfile(configfilesample, configfile)
    time.sleep(10)


    ''' 
    # Creates the DB Connection
    mydb = mysql.connector.connect(
        host = '[:DEPLOY]##YOUR_MYSQL_DATABASE_HOST##',
        user = '[:DEPLOY]##YOUR_MYSQL_USER##',
        password = '[:DEPLOY]##YOUR_MYSQL_PWD##',
        database = '[:DEPLOY]##YOUR_MYSQL_DATABASE_NAME##'
    )
    mycursor = mydb.cursor()
    

    # Gets a random user
    playerid = random.randint(startingid,endingid)

    
    # Search for ID as ignored user
    sqlquery = "SELECT id, playerid FROM torn_list_ignored WHERE playerid = %s"
    sqlid = (playerid, )
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

    # Creates Full Link and makes the Web Request
    if not SkipAction:
        fulllink = homepage1 + str(playerid) + homepage2 + apikey
        response = json.loads(requests.get(fulllink).text)

    # If it contains an Error Attribute
    if ((response.get('error')) and not (SkipAction)):
        if (response.get('error').get('code') == 5):
            addtolog("Too Many Requests. Waiting 10 seconds...")
            current_request = 1
            time.sleep(10)
        else:
            # Error other then 5 means that the PlayerID is invalid
            message = [playerid, response.get('error').get('code'), response.get('error').get('error')]
            print(message)
            # Add the user to the table
            sqlquery = "INSERT INTO torn_list_ignored (playerid) VALUES (%s)"
            values = (playerid, )
            mycursor.execute(sqlquery, values)
            mydb.commit()
    # In case Data is returned
    if ((response.get('rank')) and not (SkipAction)):
        # Search for ID as known user
        sqlquery = "SELECT id, playerid FROM torn_list WHERE playerid = %s"
        sqlid = (playerid, )
        mycursor.execute(sqlquery, sqlid)
        myresult = mycursor.fetchall()
        csv = [playerid, response.get('rank'), response.get('role'), response.get('level'), response.get('awards'), response.get('age'), response.get('player_id'), response.get('name'), response.get('faction').get('faction_name'), response.get('life').get('maximum'), response.get('last_action').get('relative'), datetime.datetime.now(), '0', '-']
        

        # If the User is found
        if(len(myresult) == 1):
            print ("Updating PlayerID:", playerid)
            sqlquery = "UPDATE torn_list SET rank = %s, role = %s, level = %s, awards = %s, age = %s, name = %s, faction_name = %s, maximum_life = %s, last_action = %s, attack_date = %s WHERE playerid = %s"
            values = (csv[1], csv[2], csv[3], csv[4], csv[6], csv[7], csv[8], csv[9], csv[10], csv[11], csv[0])

        # If the User isn't found
        if(len(myresult) == 0):
            print ("Creating PlayerID:", playerid)
            sqlquery = "INSERT INTO torn_list (rank, role, level, awards, age, playerid, name, faction_name, maximum_life, last_action, attack_date, attack_level, attack_result) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)"
            values = (csv[1], csv[2], csv[3], csv[4], csv[5], csv[6], csv[7], csv[8], csv[9], csv[10], csv[11], csv[12], csv[13])

        
        mycursor.execute(sqlquery, values)
        mydb.commit()
        

    if not SkipAction:
        current_request += 1

    # Closes the DB Connection
    mydb.close()
'''
