from flask_socketio import SocketIO, emit
from flask import Flask, render_template
from readserial import readeserial as rs
import threading 

app= Flask(__name__,template_folder="")
app.secret_key = '1234'
socketio = SocketIO(app)

@app.route('/')
def index():
    return render_template('index.html')

def send_data():
    a = rs.serreader('/dev/ttyUSB1')
    if a != "1":
        temp = a[0]
        data ={'value1':temp[0],'value2':temp[1],'value3':temp[2],'value4':temp[4]}
        print(f'sending data :{data}')
        socketio.emit('update_data',data)

def thread_time():
    while True:
        send_data()

update_thread = threading.Thread(target=thread_time)
update_thread.start()

if __name__ == '__main__' :
    socketio.run(app,host='0.0.0.0',debug=True)