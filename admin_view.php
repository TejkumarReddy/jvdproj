<?php
// Use Composer autoloading
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Shared\StringHelper;

// Function to export data to Excel using PhpSpreadsheet
function exportToExcel($data) {
    if (empty($data)) {
        die("No data to export.");
    }

    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    // Add header row
    $header = array_keys($data[0]);
    foreach ($header as $colIndex => $colName) {
        $sheet->setCellValueByColumnAndRow($colIndex + 1, 1, $colName);
    }

    // Add data rows
    foreach ($data as $rowIndex => $rowData) {
        foreach ($rowData as $colIndex => $colData) {
            // Handle the "Admission Number" column specifically
            if ($colName === 'Admission Number' && is_numeric($colData)) {
                $colDataString = strval($colData);
            } else {
                // Try to explicitly cast data to string or handle the case if it's not scalar
                try {
                    $colDataString = strval($colData);
                } catch (Throwable $e) {
                    // Print out the specific values causing the error
                    echo "Error in row $rowIndex, column $colIndex: $colData\n";
                    echo "Error message: " . $e->getMessage() . "\n";

                    // Set a placeholder value in the spreadsheet
                    $colDataString = "Error";
                }
            }

            $sheet->setCellValueByColumnAndRow($colIndex + 1, $rowIndex + 2, $colDataString);
        }
    }

    $writer = new Xlsx($spreadsheet);

    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="exported_data.xlsx"');
    header('Cache-Control: max-age=0');

    $writer->save('php://output');
}



// Your database connection code here
$servername = "localhost";
$username = "tej";
$password = "Tejkumar@717";
$dbname = "paymentdetails";


$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to build SQL query based on filters
function buildQuery($year, $branch, $scholarship) {
    $query = "SELECT * FROM studentdetails WHERE 1";

    if ($year != "all") {
        $query .= " AND year = '$year'";
    }

    if ($branch != "all") {
        $query .= " AND branch = '$branch'";
    }

    if ($scholarship != "all") {
        $query .= " AND scholarship = '$scholarship'";
    }

    return $query;
}

// Retrieve data based on filters
$year = $_POST['year'];
$branch = $_POST['branch'];
$scholarship = $_POST['scholarship'];

$query = buildQuery($year, $branch, $scholarship);
$result = $conn->query($query);

$data = array();

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
}

// Export data to Excel
exportToExcel($data);

// Close the connection
$conn->close();
?>
