<?php
$conn = mysqli_connect("localhost", "tej", "Tejkumar@717", "paymentdetails");

$error_message = ""; // Variable to store error message

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate form fields (example validation)
    $uname = $_POST['username'];
    $upass = $_POST['password'];
        $sql = "SELECT * FROM admin WHERE username = '$uname' AND password = '$upass'";
        $mysqls = mysqli_query($conn, $sql);
        $no = mysqli_num_rows($mysqls);
    
        if ($no >= 1) {
            header("Location: admin_links.html");
        } else {
            $error_message = "Invalid username or password"; // Set error message for invalid entries
            header("Location: login.html?error_message=" . urlencode($error_message));
            exit();
        }
        
    
    
}
?>
