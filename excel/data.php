<?php
$conn = mysqli_connect("localhost", "tej", "Tejkumar@717", "paymentdetails");

// Initialize query with no filters
$query = "SELECT * FROM studentdetails WHERE 1";

// Check if year filter is set
if (!empty($_GET['year'])) {
    $query .= " AND Year = '{$_GET['year']}'";
}

// Check if scholarship filter is set
if (!empty($_GET['scholarship'])) {
    $query .= " AND Scholarship = '{$_GET['scholarship']}'";
}

// Check if branch filter is set
if (!empty($_GET['branch'])) {
    $query .= " AND Branch = '{$_GET['branch']}'";
}

$rows = mysqli_query($conn, $query);

echo "<table border='1'>";
echo "<tr>";
echo "<th>#</th>";
echo "<th>Admission_Number</th>";
echo "<th>Name</th>";
echo "<th>Year</th>";
echo "<th>Branch</th>";
echo "<th>Scholarship</th>";
echo "<th>Phone_Number</th>";
echo "<th>Tution_Fee</th>";
echo "<th>Special_Fee</th>";
echo "<th>Other_Fee</th>";
echo "<th>Due_Amount</th>";
echo "</tr>";

$i = 1;
foreach ($rows as $row) {
    echo "<tr>";
    echo "<td>{$i}</td>";
    echo "<td>{$row['Admission_Number']}</td>";
    echo "<td>{$row['Name']}</td>";
    echo "<td>{$row['Year']}</td>";
    echo "<td>{$row['Branch']}</td>";
    echo "<td>{$row['Scholarship']}</td>";
    echo "<td>{$row['Phone_Number']}</td>";
    echo "<td>{$row['Tution_fee']}</td>";
    echo "<td>{$row['Special_fee']}</td>";
    echo "<td>{$row['Other_fee']}</td>";
    echo "<td>{$row['Due_Amount']}</td>";
    echo "</tr>";
    $i++;
}

echo "</table>";
?>
