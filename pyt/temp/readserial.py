import serial
import serial.tools.list_ports
import mysql.connector
from flask_socketio import emit
class readeserial:
    def serreader(ser_port) : 
        ser = serial.Serial(ser_port, 9600, timeout=0)
        try :
            db_cn = mysql.connector.connect(
                host="localhost",
                user="db_user",
                password="admin",
                database="uni"
            )
            #if db_cn.is_connected():
            #    db_info = db_cn.get_server_info()
            #    print(db_info)


        except mysql.connector.Error as e :
            return e

        readed = ser.readline()
        data = str(readed)
        data = data.replace('b','')
        data = data.replace("\\n",'') 
        data = data.replace('\\r','')
        data = data.replace('n','')
        data = data.replace('\'','')

        cursor=db_cn.cursor()
        prod_cursor="SELECT * FROM goods WHERE TAG='{}'".format(data)
        #print(prod_cursor)
        cursor.execute(prod_cursor)
        result= cursor.fetchall()
        ser.close()    
        if result:
            return result
        else :
          return "1"

        

#print(readeserial.serreader('/dev/ttyACM0'))


        
