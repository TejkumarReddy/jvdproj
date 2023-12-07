<?php
$conn = mysqli_connect("localhost", "tej", "Tejkumar@717", "paymentdetails");

$error_message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate form fields (example validation)
    $admissionNumber = $_POST['admissionNumber'];
    $phoneNumber = $_POST['phoneNumber'];
    
        $sql = "SELECT * FROM studentdetails WHERE `Admission_Number` = '$admissionNumber' AND `Phone_Number` = '$phoneNumber'";
        $result = mysqli_query($conn, $sql);
        $numRows = mysqli_num_rows($result);
        session_start();
        $_SESSION['admissionNumber']=$admissionNumber;
    
        if ($numRows >= 1) {
            header("Location: student_links.html");
            exit();
        } else {
            $error_message = "Invalid Admission Number or Phone Number. Please try again.";
            header("Location: login.html#?error_message=" . urlencode($error_message));
            exit();
        }
    
}

?>