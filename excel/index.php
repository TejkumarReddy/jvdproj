<?php require 'config.php'; ?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <title>Export To Excel</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .container {
            margin-top: 50px;
        }

        label {
            margin-right: 10px;
        }

        select {
            width: 150px; /* Adjust the width as needed */
            margin-right: 20px;
        }

        button {
            margin-top: 20px;
        }

        table {
            width: 100%;
            margin-top: 20px;
        }

        th,
        td {
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #007bff;
            color: #fff;
        }

        #exportButton button {
            background-color: #28a745;
            color: #fff;
        }
    </style>
</head>

<body>
    <div class="container">
        <label for="year">Select Year:</label>
        <select id="year" name="year" class="form-control">
            <option value="">All Years</option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
        </select>

        <label for="scholarship">Select Scholarship:</label>
        <select id="scholarship" name="scholarship" class="form-control">
            <option value="">All Scholarships</option>
            <option value="Jvd">Jvd</option>
            <option value="Non-Jvd">Non-Jvd</option>
        </select>

        <label for="branch">Select Branch:</label>
        <select id="branch" name="branch" class="form-control">
            <option value="">All Branches</option>
            <option value="CSE">CSE</option>
            <option value="ECE">ECE</option>
            <option value="EEE">EEE</option>
            <option value="MECH">MECH</option>
            <option value="CIVIL">CIVIL</option>
            <option value="FDT">FDT</option>
        </select>

        <button type="button" class="btn btn-primary" onclick="updateTable()">Apply Filters</button>

        <hr>

        <table class="table table-bordered" id="dataTable">
            <!-- ... your table headers ... -->
        </table>

        <div id="exportButton">
            <button type="button" class="btn btn-success" onclick="exportToExcel()">Export To Excel</button>
        </div>
    </div>

    <!-- Bootstrap JS and dependencies (Optional) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        function updateTable() {
            var year = document.getElementById('year').value;
            var scholarship = document.getElementById('scholarship').value;
            var branch = document.getElementById('branch').value;

            var url = 'data.php?year=' + year + '&scholarship=' + scholarship + '&branch=' + branch;

            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("dataTable").innerHTML = this.responseText;
                }
            };
            xhttp.open("GET", url, true);
            xhttp.send();
        }

        function exportToExcel() {
            var year = document.getElementById('year').value;
            var scholarship = document.getElementById('scholarship').value;
            var branch = document.getElementById('branch').value;

            var url = 'export.php';
            if (year || scholarship || branch) {
                url += '?year=' + year + '&scholarship=' + scholarship + '&branch=' + branch;
            }

            window.location.href = url;
        }
    </script>

</body>

</html>
