#!/usr/bin/env python
import serial

def read_serial_data():
    ser = serial.Serial('COM1', 9600)  # Seri portu ve baud hızını ayarlayın
    data = ser.readline()
    ser.close()
    return data

if __name__ == "__main__":
    print(read_serial_data())
