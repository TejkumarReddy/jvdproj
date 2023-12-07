<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Get and Display Student Data</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <style>
        body {
            background-color: #f8f9fa;
        }

        .container {
            margin-top: 50px;
        }

        h2 {
            text-align: center;
            margin-bottom: 30px;
        }

        form {
            max-width: 400px;
            margin: auto;
        }

        .form-group {
            margin-bottom: 20px;
        }

        /* Added style for data display */
        .data-container {
            margin-top: 20px;
            padding: 20px;
            border: 1px solid #ddd;
            background-color: #fff;
        }

        /* Added style for the table */
        .data-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        .data-table th,
        .data-table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        .data-table th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
<div class="previous-button">
        <a href="admin_links.html" class="btn btn-primary">Previous</a>
    </div>
<div class="container">
    <h2>Get and Display Student Data</h2>

    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" class="needs-validation" novalidate>
        <div class="form-group">
            <label for="admissionNumber">Admission Number:</label>
            <input name="admissionNumber" type="text" class="form-control" id="admissionNumber" placeholder="Enter Admission Number" required>
            <div class="invalid-feedback">
                Please enter the admission number.
            </div>
        </div>

        <button type="submit" class="btn btn-primary btn-block">Get History</button>
    </form>
</div>
<!-- Display data below the container -->
<div class="container data-container">
    <?php
    // Use Composer autoloading
    require 'vendor/autoload.php';

    // Your database connection code here
    $servername = "localhost";
    $username = "tej";
    $password = "Tejkumar@717";
    $dbname = "paymentdetails";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Function to build SQL query based on admission number
    function buildQueryByAdmissionNumber($admissionNumber)
    {
        $query = "SELECT * FROM payment_logs WHERE Admission_Number = '$admissionNumber'";
        return $query;
    }

    // Check if admission number is submitted
    if (isset($_POST['admissionNumber'])) {
        $admissionNumber = $_POST['admissionNumber'];

        $query = buildQueryByAdmissionNumber($admissionNumber);
        $result = $conn->query($query);

        if ($result && $result->num_rows > 0) {
            echo '<table class="data-table">';
            echo '<thead>';
            echo '<tr>';
            echo '<th>Date</th>';
            echo '<th>Admission Number</th>';
            echo '<th>Name</th>';
            echo '<th>Amount_paid</th>';
            echo '<th>UTR_Number</th>';
            // Add more columns as needed
            echo '</tr>';
            echo '</thead>';
            echo '<tbody>';

            while ($row = $result->fetch_assoc()) {
                echo '<tr>';
                echo '<td>' . $row['Date'] . '</td>';
                echo '<td>' . $row['Admission_Number'] . '</td>';
                echo '<td>' . $row['Name'] . '</td>';
                echo '<td>' . $row['Amount_paid'] . '</td>';
                echo '<td>' . $row['UTR_Number'] . '</td>';
                echo '</tr>';
            }

            echo '</tbody>';
            echo '</table>';
        } else {
            echo "No payment history found for the given admission number.";
        }
    }

    // Close the connection
    $conn->close();
    ?>
</div>
<!-- Bootstrap JS and dependencies (Optional) -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
