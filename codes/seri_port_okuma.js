const express = require('express');
const app = express();
const server = require('http').Server(app);
const io = require('socket.io')(server);
const SerialPort = require('serialport');

const portName = 'COM1'; // Seri portun adını buraya yazın (Örneğin: COM3, /dev/ttyUSB0, /dev/ttyACM0 gibi)

const serialPort = new SerialPort(portName, {
  baudRate: 9600, // Seri port hızını buraya yazın (Genellikle 9600 veya 115200 gibi)
  dataBits: 8,
  parity: 'none',
  stopBits: 1,
  flowControl: false,
});

serialPort.on('open', () => {
  console.log('Seri port açıldı');
});

io.on('connection', (socket) => {
  console.log('Kullanıcı bağlandı');
  serialPort.on('data', (data) => {
    const strData = data.toString().trim();
    socket.emit('veri', strData); // Verileri istemciye (web tarayıcısına) gönder
  });
});

const port = 2222; // Web sunucusunun çalışacağı port numarası
server.listen(port, () => {
  console.log(`Sunucu ${port} numaralı port üzerinde çalışıyor`);
});
