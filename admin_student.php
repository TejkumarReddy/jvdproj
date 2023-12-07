<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Get and Update Student Data</title>

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

    /* Added style for the edit form */
    .edit-form {
        display: none; /* Initially hide the edit form */
        margin-top: 20px;
        padding: 20px;
        border: 1px solid #ddd;
        background-color: #fff;
        border:none;
    }


    #editForm{
        border: none;
    }
    .edit-button {
        margin-top: 20px;
    }
</style>
</head>
<body>
<div class="previous-button">
        <a href="admin_links.html" class="btn btn-primary">Previous</a>
    </div>
<div class="container">
    <h2>Get and Update Student Data</h2>

    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" class="needs-validation" novalidate>
        <div class="form-group">
            <label for="admissionNumber">Admission Number:</label>
            <input name="admissionNumber" type="text" class="form-control" id="admissionNumber"  placeholder="Enter Admission Number" required>
            <div class="invalid-feedback">
                Please enter the admission number.
            </div>
        </div>

        <button type="submit" class="btn btn-primary btn-block">Get Data</button>
    </form>
</div>

<!-- Display data below the container -->
<div class="container data-container">
    <?php
    // Check if the form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Get the admission number from the form
        $admissionNumber = $_POST["admissionNumber"];

        // Perform database query to get student data
        $conn = mysqli_connect("localhost", "tej", "Tejkumar@717", "paymentdetails");

        $query = "SELECT * FROM studentdetails WHERE `Admission_Number` = '$admissionNumber'";
        $result = mysqli_query($conn, $query);

        // Display the retrieved data in a table with an edit option
        if ($result && mysqli_num_rows($result) > 0) {
            echo "<table class='data-table'>";
            $row = mysqli_fetch_assoc($result);

            foreach ($row as $key => $value) {
                echo "<tr>";
                echo "<th>{$key}</th>";
                echo "<td>{$value}</td>";
                echo "</tr>";
            }

            echo "</table>";

            // Add an edit button to show the edit form
            echo "<div class='edit-button'>";
            echo "<button class='btn btn-warning' onclick='showEditForm()'>Edit</button>";
            echo "</div>";

            // Add an edit form with input fields for each column
            echo "<div class='edit-form' id='editForm'>";
            echo "<h3>Edit Data</h3>";
            echo "<form method='post' action='update.php'>";
            foreach ($row as $key => $value) {
                echo "<div class='form-group'>";
                echo "<label for='{$key}'>{$key}:</label>";
                if($key=='ID'){
                    echo "<input type='text' class='form-control' id='{$key}' name='{$key}' value='{$value}' required readonly>";
                }else{
                echo "<input type='text' class='form-control' id='{$key}' name='{$key}' value='{$value}' required>";
                }
                echo "</div>";
            }
            echo "<button type='submit' class='btn btn-primary'>Update Data</button>";
            echo "</form>";
            echo "</div>";
        } else {
            echo "No data found for the given admission number.";
        }

        // Close the database connection
        mysqli_close($conn);
    }
    ?>
</div>

<!-- Bootstrap JS and dependencies (Optional) -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>
    function showEditForm() {
        document.getElementById('editForm').style.display = 'block';
    }
</script>

</body>
</html>
