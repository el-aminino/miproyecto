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



boardname = ""

#defining app and configurations
app = Flask(__name__, template_folder='',static_folder='')
app.secret_key = "1234"
#defining socket
socket = SocketIO(app, cors_allowed_origins='*')


#definations we need here
    
def send_data():
    global boardname
    if boardname != "" :
        a = d.readeserial.serreader(boardname)
        if isinstance(a,str) == False:
            print(a)
            #print(str(type(a[1]))+str(type(a[2])))
            #temp = a[1]+","+str(a[2])
            price ={'value':a[2]}#,'value2':a[2]}
            name = {'value':a[1]}
            
            socket.emit('send_name',name)
            print(f'sending price :{name}')
            socket.emit('send_price',price)
            print(f'sending price :{price}')
        if isinstance(a,str):
            print(a)
            rfid = {'value':a}
            socket.emit("new_tag",rfid)
            print(f'sending price :{rfid}')
def dummy_data_update():
    while True:
        send_data()
  




def get_tag():
    global boardname
    if boardname != "":
        a = d.readeserial.tag_reader(boardname)
        if a != "1":
            print(a)


def dummy_get_tag():
    
    while True:
        get_tag()






#define whick thread we need here
update_thread= threading.Thread(target=dummy_data_update)  
get_thread = threading.Thread(target=dummy_get_tag)  











#home page
@app.route('/', methods=['GET','POST'])
def home():
    title = 'home'
    #checks if there is any session variable
    if session:
        #looks for Comports which exported from system
        if session['brdname']:
            global boardname 
            boardname = session['brdname']
            print(boardname)
             #renders Home page
            return render_template('WEB/webui.html', title = title)
    #redirect to board selection page
    else :
        return redirect('/select_board?brd=no' , code=302)
    






#select arduino board by user 
@app.route('/select_board', methods=['GET','POST'])
def select_serial():
    title = 'select board'
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
        return render_template('WEB/dropdown.html', ser=ser, title = title)
    else:
        #returns error for not finding any COM device connected
        err = "Board Not Found"
        return render_template('WEB/dropdown.html', err=err, title = title)











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
    title = 'Add Product'
    return render_template("WEB/add.html", title = title)









@app.route('/add-act' , methods=["GET","POST"])
def addact():
    if request.method == "POST":
        p_name = request.form.get("p_name")
        p_price = request.form.get("p_price")
        p_cat = request.form.get("p_cat")
        p_tag = request.form.get("p_tag")
        print(p_name)
        print(p_price)
        print(p_cat)
        print(p_tag)
        db_cn = d.mysql_defs.dbcn()
        cursor = db_cn.cursor()
        add_cursor = f"INSERT INTO goods (GName,Price,Category,TAG) values('{p_name}','{p_price}','{p_cat}','{p_tag}');"
        cursor.execute(add_cursor)
        #cursor.fetchall()
        db_cn.commit()
        return redirect('/')




@app.route('/manage-prod')
def manprod():
    title = 'Manage Products'
    db_cn = d.mysql_defs.dbcn()
    cursor = db_cn.cursor()
    query = "Select * FROM goods;"
    cursor.execute(query)
    result = cursor.fetchall()
    i = 0
    return render_template("WEB/pro-man.html",data = result, i = i, title = title)

@app.route('/del-prod', methods=['GET','POST'])
def delprod():
    if request.method == "GET":
        id = request.args['id']
        db_cn = d.mysql_defs.dbcn()
        cursor = db_cn.cursor()
        query = f"DELETE FROM goods WHERE TAG = '{id}';"
        cursor.execute(query)
        db_cn.commit()
    return redirect('/manage-prod')



@app.route('/kill')
def killer():
    global boardname
    boardname = ""
    session.pop('brdname', None)
    return redirect('/', code=302)





if __name__ == '__main__':

    update_thread.start()
    socket.run(app,debug=True)
    #app.run(debug=True)