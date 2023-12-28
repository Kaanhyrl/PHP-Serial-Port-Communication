<?php
// Seri port haberleşmesi için verileri hazırlayalım
$data_to_send = "Merhaba, bu seri port verisidir.";

// Python komutunu oluşturalım
$python_command = 'python /path/to/app.py';

// Python komutuna veriyi ve diğer gereken argümanları aktaralım
$command = $python_command . ' ' . escapeshellarg($data_to_send);

// Python uygulamasını arka planda çalıştırıp çıktıyı alalım
exec($command, $output);

// Python çıktısını ekrana basalım
foreach ($output as $line) {
    echo $line . "\n";
}
?>
