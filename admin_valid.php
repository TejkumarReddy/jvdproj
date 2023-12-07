<?php
// Assuming you have a database connection, replace the placeholders accordingly
$servername = "localhost";
$username = "tej";
$password = "Tejkumar@717";
$dbname = "paymentdetails";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve username and password from the form
    $inputUsername = $_POST['username'];
    $inputPassword = $_POST['password'];

    // SQL query to check if the username and password exist in the database
    $sql = "SELECT * FROM studentdetails WHERE Admission_Number= '$inputUsername' AND Phone_Number= '$inputPassword'";
    $result = $conn->query($sql);

    // If a matching record is found, the login is successful
    if ($result->num_rows > 0) {
        echo "Login successful!";
        // You can redirect the user to another page or perform additional actions here
    } else {
        echo "Invalid username or password";
    }
}

// Close the database connection
$conn->close();
?>
