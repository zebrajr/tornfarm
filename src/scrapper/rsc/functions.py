import os
import mysql.connector as mariadb

def createDBConnection():
    mydb = mariadb.connect(
        host        = str(os.getenv('DBHOST', '0')),
        user        = str(os.getenv('DBUSER', '0')),
        password    = str(os.getenv('DBPWD', '0')),
        database    = str(os.getenv('DBNAME', '0'))
    )
    return mydb


def getProcedure(procName):
    mydb    = createDBConnection()
    cursor  = mydb.cursor(buffered=True)
    cursor.callproc('test')
    commitDBConnection(mydb)


def commitDBConnection(database):
    database.commit()
    database.close()
