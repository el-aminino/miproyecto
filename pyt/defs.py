import serial
import serial.tools.list_ports
import mysql.connector
from flask_socketio import emit
class readeserial:
    def serreader(ser_port) : 
        #try:
        ser = serial.Serial(ser_port, 9600,timeout=2)
        #except :
        #    return "2"
        try :
            db_cn = mysql.connector.connect(
                host="localhost",
                user="db_user",
                password="admin",
                database="uni"
            )

        except mysql.connector.Error as e :
            return e


        check = False
        while not check:
            #try :
            readed = ser.readline()
            #print(readed)
            #except : 
            #    readed = ser.readline()
            data = str(readed)
            data = data.replace('b','')
            data = data.replace("\\n",'') 
            data = data.replace('\\r','')
            data = data.replace('n','')
            data = data.replace('\'','')
            if data :
                check =True
        cursor=db_cn.cursor()
        prod_cursor="SELECT * FROM goods WHERE TAG='{}'".format(data)
        #print(prod_cursor)
        cursor.execute(prod_cursor)
        result= list(cursor.fetchall())
            
        if result:
            return list(result[0])
        else :
          return "1"

        ser.close()

if __name__ == '__main__' :
    #for i in range(0,2):
        a= readeserial.serreader("/dev/ttyUSB1")
        print(a)




        
