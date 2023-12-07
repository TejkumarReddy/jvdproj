<?php

if (isset($_POST['submit'])) {
    $admissionNumber = $_POST['admissionNumber'];
    $name = $_POST['name'];
    $isJVD = isset($_POST['jvd']) && $_POST['jvd'] === 'yes';
    $gender = $_POST['gender'];
    $dateOfBirth = $_POST['dateOfBirth'];
    $year = $_POST['year'];
    $phoneNumber = $_POST['phoneNumber'];
    $amount = $_POST['amount'];

    if ($amount > 0) {
        // Generate QR code using PhonePe payment gateway
        $phonePePaymentGateway = new PhonePePaymentGateway();
        $qrCode = $phonePePaymentGateway->generateQRCode($admissionNumber, $name, $amount);

        // Display QR code and payment details
        echo '<img src="' . $qrCode . '" alt="QR Code for Payment" />';
        echo '<p>Admission Number: ' . $admissionNumber . '</p>';
        echo '<p>Name: ' . $name . '</p>';
        echo '<p>JVD: ' . ($isJVD ? 'Yes' : 'No') . '</p>';
        echo '<p>Gender: ' . $gender . '</p>';
        echo '<p>Date of Birth: ' . $dateOfBirth . '</p>';
        echo '<p>Year: ' . $year . '</p>';
        echo '<p>Phone Number: ' . $phoneNumber . '</p>';
        echo '<p>Amount: ' . $amount . '</p>';
        echo '<p>Payment Successful</p>';
    } else {
        // Invalid amount
        echo '<p>Invalid amount. Please enter a valid amount.</p>';
    }
} else {
    // Display form to collect student details
?>