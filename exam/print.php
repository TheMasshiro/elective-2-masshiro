<?php

include "db.php";
require "config.php";

$conn = get_connection();

if (isset($_GET['id'])) {
    $id = trim($_GET['id']);

    $query = "SELECT * FROM bills WHERE id = {$id}";
    $result = $conn->query($query);
    $bill = $result->fetch_assoc();
}

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
    <div class="container mt-4">
        <div class="border p-4 rounded shadow-lg">
            <h2 class="text-center mb-4">Electricity Bill</h2>
            <hr>
            <div class="mb-3">
                <p><strong>Bill ID:</strong> <?php echo $bill['id']; ?></p>
                <p><strong>Name:</strong> <?php echo $bill['name']; ?></p>
                <p><strong>Meter Number:</strong> <?php echo $bill['meter_number']; ?></p>
                <p><strong>Email:</strong> <?php echo $bill['email']; ?></p>
                <p><strong>Address:</strong> <?php echo $bill['address']; ?></p>
            </div>
            <hr>
            <div class="mb-3">
                <p><strong>Units Consumed:</strong> <?php echo $bill['unit']; ?> kWh</p>
                <p><strong>Rate:</strong> Php <?php echo number_format($rate_per_unit, 2); ?> per kWh</p>
                <p><strong>Computation:</strong> <?php echo $bill['unit']; ?> kWh × Php <?php echo number_format($rate_per_unit, 2); ?></p>
                <p><strong>Total:</strong> <span class="fw-bold text-danger">Php <?php echo number_format($bill['total'], 2); ?></span></p>
            </div>
            <hr>
            <div class="mb-3">
                <p><strong>Bill Date:</strong> <?php echo $bill['bill_date']; ?></p>
                <p><strong>Due Date:</strong> <?php echo $bill['due_date']; ?></p>
            </div>
            <hr>
            <div class="text-center mt-3 d-print-none">
                <a href="index.php" class="btn btn-secondary">Back</a>
                <button class="btn btn-primary" onclick="window.print()">Print Bill</button>
            </div>
        </div>
    </div>

    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>
