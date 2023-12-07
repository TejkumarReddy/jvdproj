<?php
require __DIR__ . '/vendor/autoload.php';

use Endroid\QrCode\QrCode;

// Database connection details
$db_host = "localhost";
$db_name = "paymentdetails";
$db_user = "tej";
$db_password = "Tejkumar@717";

// Connect to database
try {
    $db = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo "Database connection failed: " . $e->getMessage();
    die();
}

// Define YBL Pay details
$merchant_id = "9347383089tej@ybl";
$callback_url = "your_callback_url"; // Replace with your actual callback URL

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the dynamic amount from the form
    $amount = $_POST["amount"];

    // Generate QR code using Endroid/QrCode library
    $qrCode = new QrCode("upi://pay?pa=$merchant_id&mc=your-merchant-code&tid=your-transaction-id&tr=your-transaction-reference-id&tn=Payment%20Description&am=$amount&cu=INR&url=$callback_url");
    $qrCode->setSize(250);
    $qrCode->setMargin(10);
    $qrCode->writeFile('qr_code.png');

    // Display QR code image
    echo "<img src='qr_code.png' alt='QR Code'>";

    // Save payment details to the database
    savePaymentDetails($amount);
}

// Function to save payment details to the database
function savePaymentDetails($amount) {
    global $db;

    // Payment details
    $payment_id = uniqid(); // You might want to generate a unique payment ID in a more sophisticated way
    $payer_details = "John Doe"; // Replace with actual payer details

    // Prepare SQL query to insert payment details
    $sql = "INSERT INTO payment_log (payment_id, amount, payer_details, created_at) VALUES (:payment_id, :amount, :payer_details, :created_at)";

    // Bind parameters
    $stmt = $db->prepare($sql);
    $stmt->bindParam(":payment_id", $payment_id);
    $stmt->bindParam(":amount", $amount);
    $stmt->bindParam(":payer_details", $payer_details);
    $stmt->bindValue(":created_at", date("Y-m-d H:i:s"));

    // Execute query
    $stmt->execute();

    // Show payment details on screen
    echo "<p>Payment successful!</p>";
    echo "<p>Payment ID: $payment_id</p>";
    echo "<p>Amount: $amount</p>";
    echo "<p>Payer Details: $payer_details</p>";
    echo "<p>Payment Time: " . date("Y-m-d H:i:s") . "</p>";
}
?>
<!-- HTML form to enter the amount -->
<!-- <form method="post" action="">
    <label for="amount">Enter Amount: </label>
    <input type="text" name="amount" id="amount" required>
    <button type="submit">Generate QR Code</button>
</form> -->
