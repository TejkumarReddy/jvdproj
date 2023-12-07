<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Your database connection details
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

    // Fetch values from the form
    $admissionNumber = $_POST["admissionNumber"];
    $name = $_POST["name"];
    $jvd = $_POST["jvd"];
    $email = $_POST["email"];
    $year = $_POST["year"];
    $branch = $_POST["branch"];
    $qualify = $_POST["Qualify"];
    $phoneNumber = $_POST["phoneNumber"];
    $acomidation = $_POST["acomidation"];

    // Prepare and execute the SQL query
    $sql = "INSERT INTO studentdetails (`Admission_Number`,Name, Scholarship, `Email_Id`, Year, Branch, `Cet_Qualified`, `Phone_Number`, Accommodation)
            VALUES ('$admissionNumber', '$name', '$jvd', '$email', '$year', '$branch', '$qualify', '$phoneNumber', '$acomidation')";

    if ($conn->query($sql) === TRUE) {
        $success_message = "Record added successfully";
        header("Location: file.html#?success_message=" . urlencode($success_message));    } 
        else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close the database connection
    $conn->close();
}
?>
