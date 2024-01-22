import serial
import serial.tools.list_ports
import mysql.connector


try :
    db_cn = mysql.connector.connect(
        host="localhost",
        user="db_user",
        password="admin",
        database="uni"
    )
    if db_cn.is_connected():
        db_info = db_cn.get_server_info()
        print(db_info)


except mysql.connector.Error as e :
    print(e)

ser = serial.Serial("/dev/ttyUSB0", 9600)
while True:
    readed = ser.readline()
    data = str(readed)
    data = data.replace('b','')
    data = data.replace("\\n",'') 
    data = data.replace('\\r','')
    data = data.replace('n','')
    data = data.replace('\'','')

    cursor=db_cn.cursor()
    prod_cursor="SELECT * FROM GOODS WHERE TAG='{}'".format(data)
    print(prod_cursor)
    cursor.execute(prod_cursor)
    result= cursor.fetchall()
    
    if result:
        print(result)
    else :
        print("Product not found id :"+data )






ser.close()


