<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Create a new connection to the database
    $conn = mysqli_connect("localhost", "tej", "Tejkumar@717", "paymentdetails");

   


    // Check the connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    $adi=$_POST['Admission_Number'];
    echo "".$adi;

     // Get the edited data from the form
    $AdmissionNumber=$_POST['Admission_Number'];
    $Name=$_POST['Name'];
    $Year=$_POST['Year'];
    $Branch=$_POST['Branch'];
    $Scholarship=$_POST['Scholarship'];
    $Phone_Number=$_POST['Phone_Number'];
    $Tution_fee=$_POST['Tution_fee'];
    $Special_fee=$_POST['Special_fee'];
    $Other_fee=$_POST['Other_fee'];
    $Accommodation=$_POST['Accommodation']; 
    $Email_Id=$_POST['Email_Id'];
    $Cet_Qualified=$_POST['Cet_Qualified'];
   
// Assuming 'admissionNumber' is the name of the form field
   
$sql = "UPDATE `studentdetails` SET 
        `Admission_Number`='$AdmissionNumber',
        `Name`='$Name',
        `Year`='$Year',
        `Branch`='$Branch',
        `Scholarship`='$Scholarship',
        `Phone_Number`='$Phone_Number',
        `Tution_fee`='$Tution_fee',
        `Special_fee`='$Special_fee',
        `Other_fee`='$Other_fee',
        `Accommodation`='$Accommodation',
        `Email_Id`='$Email_Id',
        `Cet_Qualified`='$Cet_Qualified' 
        WHERE Admission_Number='$AdmissionNumber'";

$u = mysqli_query($conn, $sql);

if ($u === true) {
    echo "done";
} else {
    echo "error: " . mysqli_error($conn);
}

mysqli_close($conn);

}
?>
