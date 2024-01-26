#import Libraries
#Flask for backend, 
    #render template to use HTML
    #request to handle requests from web interface
    #session to use session variables
    #redirect to transfer redirect web requests
from flask import Flask, render_template, request, session , redirect
#Serial list port to find arduino board COM port
import serial.tools.list_ports
#import our own lib
import pyt.defs as d
#socketIO for cummunication with JS
from flask_socketio import SocketIO , emit ,send
#Threading for multiproccessing 
import threading





#defining app and configurations
app = Flask(__name__, template_folder='')
app.secret_key = "1234"
#defining socket
socket = SocketIO(app, cors_allowed_origins='*')


#definations we need here
    
def send_data():
    a = d.readeserial.serreader('/dev/ttyUSB1')
    if a != "1" and a !="2":
        print(a)
        #print(str(type(a[1]))+str(type(a[2])))
        #temp = a[1]+","+str(a[2])
        price ={'value':a[2]}#,'value2':a[2]}
        name = {'value':a[1]}
        
        socket.emit('send_name',name)
        print(f'sending price :{name}')
        socket.emit('send_price',price)
        print(f'sending price :{price}')

def dummy_data_update():
    print('dummy Ready')
    while True:
        send_data()



#define whick thread we need here
update_thread= threading.Thread(target=dummy_data_update)    




#home page
@app.route('/', methods=['GET','POST'])
def home():
    #checks if there is any session variable
    if session:
        #looks for Comports which exported from system
        if session['brdname']:
             """     --------- Here You need to make a validation check for Arduino availability ---------     """
             #renders Home page
             return render_template('WEB/webui.html')
    #redirect to board selection page
    else :
        return redirect('/select_board?brd=no' , code=302)
    



#select arduino board by user 
@app.route('/select_board', methods=['GET','POST'])
def select_serial():
    #List any connected COM device
    ports = list(serial.tools.list_ports.comports())
    
    #checks if any COM port found
    if ports:    
        ser = []
        #Create a list from Found Comports
        for p in ports:
            a=str(p).split(" ")
            ser.append(a[0])
        #render Board selection HTML interface
        return render_template('WEB/dropdown.html', ser=ser)

    else:
        #returns error for not finding any COM device connected
        err = "Board Not Found"
        return render_template('WEB/dropdown.html', err=err)



#Proccess related to board selection (Action page)
@app.route('/brd', methods =["GET", "POST"])
def brd():
    #Looks for POST method
    if request.method == "POST":
        brdname = request.form.get("selectBoard")
        session['brdname'] = brdname
        return redirect('/')



@app.route('/add-prod')
def addprod():
    return "Product add"



@app.route('/manage-prod')
def manprod():
    return "Product Management"




@app.route('/kill')
def killer():
    session.pop('brdname', None)
    return redirect('/', code=302)





if __name__ == '__main__':
    update_thread.start()
    socket.run(app,debug=True)
    #app.run(debug=True)