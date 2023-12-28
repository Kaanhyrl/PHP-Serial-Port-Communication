from flask import Flask, render_template, request, jsonify
from flask_socketio import SocketIO, emit
import serial
import serial.tools.list_ports
import threading

app = Flask(__name__)
socketio = SocketIO(app)

# Seri port bağlantısı için gerekli değişkenler
ser = None
selected_port = None
is_listening = False

@app.route('/')
def index():
    return render_template('index.html', selected_port=selected_port)

@app.route('/get_ports')
def get_ports():
    ports = [port.device for port in serial.tools.list_ports.comports()]
    return jsonify(ports)

@app.route('/connect', methods=['POST'])
def connect():
    global ser, selected_port, is_listening
    selected_port = request.json.get('port')
    try:
        ser = serial.Serial(selected_port, 9600, timeout=1)
        is_listening = True
        # Seri port verilerini dinlemek için ayrı bir thread başlatıyoruz.
        threading.Thread(target=receive_data).start()
        return jsonify({"success": True})
    except Exception as e:
        return jsonify({"success": False, "error": str(e)})

@app.route('/disconnect', methods=['POST'])
def disconnect():
    global ser, selected_port, is_listening
    try:
        if ser:
            ser.close()
        selected_port = None
        is_listening = False
        return jsonify({"success": True})
    except Exception as e:
        return jsonify({"success": False, "error": str(e)})

def receive_data():
    global ser, is_listening
    while is_listening:
        if ser:
            try:
                data = ser.readline().decode().strip()
                if data:
                    print('Seri porttan gelen veri:', data)
                    socketio.emit('data', data)  # 'data' adlı event ile veriyi gönderiyoruz
            except Exception as e:
                print("Hata: ", str(e))


if __name__ == '__main__':
    socketio.run(app, debug=True)  # Flask uygulamasını SocketIO ile çalıştırıyoruz
