<?php
// Function to open and configure the serial port
function openSerialPort($port, $baudRate)
{
    $serialPort = fopen($port, 'w+');
    if ($serialPort === false) {
        die("Error opening serial port {$port}");
    }

    // Configure serial port settings
    stream_set_timeout($serialPort, 5);
    stream_set_blocking($serialPort, false);
    exec("mode {$port}: BAUD={$baudRate} PARITY=N DATA=8 STOP=1");

    return $serialPort;
}

// Function to close the serial port
function closeSerialPort($serialPort)
{
    fclose($serialPort);
}

// Function to write data to the serial port
function writeDataToSerialPort($serialPort, $data)
{
    fwrite($serialPort, $data);
}

// Function to read data from the serial port
function readDataFromSerialPort($serialPort)
{
    $data = '';

    while (($char = fread($serialPort, 1)) !== false) {
        $data .= $char;
    }

    return $data;
}

// Get the selected port from the client-side (you may need to modify this based on your HTML/JavaScript code)
$selectedPort = $_POST['selectedPort']; // Assuming the port name is sent via POST request

// Set the baud rate and other settings
$baudRate = 9600;

// Open the selected serial port
$serialPort = openSerialPort($selectedPort, $baudRate);

// Check if there is any data to send
if (!empty($_POST['sendData'])) {
    // Get the data to send from the client-side (you may need to modify this based on your HTML/JavaScript code)
    $dataToSend = $_POST['sendData']; // Assuming the data to send is sent via POST request

    // Send the data to the serial port
    writeDataToSerialPort($serialPort, $dataToSend);
}

// Read any available data from the serial port
$receivedData = readDataFromSerialPort($serialPort);

// Close the serial port
closeSerialPort($serialPort);

// Return the received data as JSON response
header('Content-Type: application/json');
echo json_encode(['receivedData' => $receivedData]);
