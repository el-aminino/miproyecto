import serial
import serial.tools.list_ports
import mysql.connector
from flask_socketio import emit
class readeserial:
    def serreader(ser_port) : 
        try:
            ser = serial.Serial(ser_port, 9600,timeout=0)
        except :
            return "2"
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
            
        if result:
            return result
        else :
          return "1"

        ser.close()

if __name__ == '__main__' :
    print("\n \nthis suposed to to be happened! This is a library, not a program ......")
    print("Add this To your program and use it",end=" \n \n \n")

#print(readeserial.serreader('/dev/ttyACM0'))


        
