<?php
require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/vendor/phpqrcode.php';
$amount = $_POST['amount'];
$merchantUPI = '9703668695@paytm';
$merchantName = 'C.SivaKumar';

$upiURL = "upi://pay?pn=$merchantName&pa=$merchantUPI&am=$amount";

$qrCode = QRcode::png($upiURL, 'qr.png', 'c', 5, 2);

echo "<img src='qr.png' alt='QR Code' id='qr-image'>";
echo $qrCode;
?>