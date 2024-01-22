import serial.tools.list_ports
ports = list(serial.tools.list_ports.comports())
ser = []
for p in ports:
    print(p)

