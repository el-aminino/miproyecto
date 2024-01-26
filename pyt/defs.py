import serial
import serial.tools.list_ports
import mysql.connector
from flask_socketio import emit
import threading
import ctypes


class mysql_defs :
    def dbcn():
        try :
            db_cn = mysql.connector.connect(
                host="localhost",
                user="db_user",
                password="admin",
                database="uni"
            )
            return db_cn
        except mysql.connector.Error as e :
            return e
        
    def read_data_by_tag(tag):
        db_cn = mysql_defs.dbcn()
        cursor=db_cn.cursor()
        prod_cursor="SELECT * FROM goods WHERE TAG='{}'".format(tag)
        #print(prod_cursor)
        cursor.execute(prod_cursor)
        result = list(cursor.fetchall())
        return result
    

    def check_tag_exist(tag):
        db_cn = mysql_defs.dbcn()
        cursor = db_cn.cursor()
        exist_cursor = "SELECT EXISTS(SELECT * FROM goods WHERE TAG='{}')".format(tag)
        cursor.execute(exist_cursor)
        result = cursor.fetchall()
        result = result[0]
        result = result[0]
        if result == 0 : result = False 
        elif result == 1 : result = True 
        return result


class thread_with_exception(threading.Thread):
    def __init__(self, name):
        threading.Thread.__init__(self)
        self.name = name
             
    def run(self):
 
        # target function of the thread class
        try:
            while True:
                print('running ' + self.name)
        finally:
            print('ended')
          
    def get_id(self):
 
        # returns id of the respective thread
        if hasattr(self, '_thread_id'):
            return self._thread_id
        for id, thread in threading._active.items():
            if thread is self:
                return id
  
    def raise_exception(self):
        thread_id = self.get_id()
        res = ctypes.pythonapi.PyThreadState_SetAsyncExc(thread_id,
              ctypes.py_object(SystemExit))
        if res > 1:
            ctypes.pythonapi.PyThreadState_SetAsyncExc(thread_id, 0)
            print('Exception raise failure')
      




class readeserial:
    def serreader(ser_port) : 
        ser = serial.Serial(ser_port, 9600,timeout=2)


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
        
        result = mysql_defs.read_data_by_tag(data)
        if result:
            return list(result[0])
        else :
          return data

        ser.close()

    def tag_reader(ser_port):
        ser = serial.Serial(ser_port,9600,timeout=2)
        check = False
        while not check:
            readed = ser.readline()
            data = str(readed)
            data = data.replace('b','')
            data = data.replace("\\n",'') 
            data = data.replace('\\r','')
            data = data.replace('n','')
            data = data.replace('\'','')
            if data : 
                check = True
        if data:
            return data
        else:
            return "1"
        


if __name__ == '__main__' :
    #for i in range(0,2):
        a= readeserial.tag_reader("/dev/ttyUSB0")
        print(mysql_defs.check_tag_exist(a))
        
        