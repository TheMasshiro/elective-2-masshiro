<?php

include "db.php";

$conn = get_connection();

$query = "SELECT * FROM bills";
$result = $conn->query($query);

?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Electricity Bill</title>
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
        crossorigin="anonymous" />
</head>

<body class="container mt-5">
    <h2 class="text-center">Electricity Bills</h2>
    <?php
    echo "<div class='d-flex justify-content-end m-3'>
          <a href='add_bill.php' class='btn btn-success'>Add Bill</a>
      </div>";

    if ($result->num_rows > 0) {
        echo   "<div class='table-responsive'>
        <table class='table table-striped table-bordered align-middle'>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Meter No.</th>
                    <th>Address</th>
                    <th>Units</th>
                    <th>Total Amount</th>
                    <th>Due Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>{$row['id']}</td>
                    <td>{$row['name']}</td>
                    <td>{$row['meter_number']}</td>
                    <td>{$row['address']}</td>
                    <td>{$row['unit']}</td>
                    <td>Php {$row['total']}</td>
                    <td>{$row['due_date']}</td>
                    <td>
                        <a href='update_bill.php?id={$row['id']}' class='btn btn-warning btn-sm'>Edit</a>
                        <a href='delete_bill.php?id={$row['id']}' class='btn btn-danger btn-sm'
                            onclick=\"return confirm('Are you sure you want to delete Meter No. {$row['meter_number']}?')\">Delete</a>
                        <a href='print.php?id={$row[' id']}' class='btn btn-secondary btn-sm'>Print</a>
                    </td>
                </tr>";
        }
        echo "</tbody>
        </table>
    </div>";
    } else {
        echo "<p class='text-center text-muted'>No records found.</p>";
    }
    ?>
    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>
