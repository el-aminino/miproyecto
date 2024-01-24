from flask_socketio import SocketIO, emit
from flask import Flask, render_template
from readserial import readeserial as rs
import threading 
import time

app= Flask(__name__,template_folder="")
app.secret_key = '1234'
socketio = SocketIO(app)


@app.route('/test')
def test():
    return 'test'


@app.route('/')
def index():
    update_thread.start()
    return render_template('index.html')

def send_data():
    a = rs.serreader('/dev/ttyUSB0')
    if a != "1":
        temp = a[0]
        data ={'value1':temp[1],'value2':temp[3]}
        socketio.emit('update_data',data)
        print(f'sending data :{data}')


def thread_time():
    while True:
        send_data()
        #time.sleep(0.2)

update_thread = threading.Thread(target=thread_time)

if __name__ == '__main__' :
    
    socketio.run(app,debug=True)
    
