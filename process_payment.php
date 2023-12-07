<?php
// Assuming you have a database connection
require 'config.php';

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Assuming the table structure has columns: Date, Admission_Number, Name, Amount_paid, UTR_Number
$date = date("Y-m-d"); // Current date
$admission_number = $_POST['admission_number'];
$name = $_POST['name'];
$amount_paid = $_POST['amount_paid'];
$utr_number = $_POST['utr_number'];

$sql_insert = "INSERT INTO payment_logs (Date, Admission_Number, Name, Amount_paid, UTR_Number)
               VALUES ('$date', '$admission_number', '$name', '$amount_paid', '$utr_number')";

$sql_update = "UPDATE studentdetails 
               SET Due_Amount = Due_Amount - $amount_paid 
               WHERE Admission_Number = '$admission_number'";

if ($conn->query($sql_insert) === TRUE && $conn->query($sql_update) === TRUE) {
    $msg = "Record added successfully";
    header("Location: admin_links.html#?msg=" . urlencode($msg));
} else {
    echo "Error: " . $sql_insert . "<br>" . $conn->error;
    echo "Error: " . $sql_update . "<br>" . $conn->error;
}

$conn->close();
?>
