from flask import Flask, render_template, request, session , redirect
import serial.tools.list_ports
from pyt.readserial import readeserial as rs 
from flask_socketio import SocketIO , emit ,send
import threading

app = Flask(__name__, template_folder='')

app.secret_key = "1234"

socket = SocketIO(app, cors_allowed_origins='*')


    
def send_data(data):
    print(f'sending data : {data}')
    socket.emit('update_data',data)

def dummy_data_update():
    while True:
        #data = {}
        data = rs.serreader(session['brdname'])
        '''data['id'] = a[0]
        data['gname'] = a[1]
        data['price'] = a[3]'''
        send_data(data)

update_thread= threading.Thread(target=dummy_data_update)    


@app.route('/', methods=['GET','POST'])
def home():
    if session:
        if session['brdname']:
            
 
            return render_template('WEB/webui.html')
            #return rs.serreader(session['brdname'])
    else :
        return redirect('/select_board?brd=no' , code=302)
    




@app.route('/select_board', methods=['GET','POST'])
def select_serial():
    ports = list(serial.tools.list_ports.comports())
    if ports:    
        ser = []
        
        for p in ports:
            a=str(p).split(" ")
            ser.append(a[0])
            #return ser
            
        return render_template('WEB/dropdown.html', ser=ser)
    else:
        err = "Board Not Found"
        return render_template('WEB/dropdown.html', err=err)

@app.route('/brd', methods =["GET", "POST"])
def brd():
    if request.method == "POST":
        brdname = request.form.get("selectBoard")
        session['brdname'] = brdname
        return redirect('/')
@app.route('/kill')
def killer():
    session.pop('brdname', None)
    return redirect('/', code=302)


update_thread.start()


if __name__ == '__main__':
    socket.run(app,debug=True)
    #app.run(debug=True)