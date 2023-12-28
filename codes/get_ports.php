<?php
function getSerialPorts()
{
    $ports = [];
    exec('mode', $output);
    foreach ($output as $line) {
        if (strpos($line, 'COM') !== false) {
            $asd = explode(' ',$line)[3];
            $port = explode(':', $asd)[0];
            $ports[] = $port;
        }
    }
    return $ports;
}

// Get the list of available ports
$availablePorts = getSerialPorts();

// Return the list as JSON data
header('Content-Type: application/json');
echo json_encode($availablePorts);
?>
