<?php

include "db.php";
require "config.php";

$conn = get_connection();


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = trim($_POST['email']);
    $meter_number = $_POST['meter-number'];
    $address = trim($_POST['address']);
    $unit = $_POST['unit'];
    $due_date = $_POST['due_date'];
    $total = $unit * $rate_per_unit;

    $query = "INSERT INTO bills (name, email, meter_number, address, unit, total, due_date)
    VALUES (?, ?, ?, ?, ?, ?, ?)";

    $sql = $conn->prepare($query);
    $sql->bind_param("ssisids", $name, $email, $meter_number, $address, $unit, $total, $due_date);

    try {
        if ($sql->execute()) {
            header("Location: index.php");
            exit();
        }
    } catch (mysqli_sql_exception $e) {
        echo "<div class='toast-container position-fixed top-0 end-0 p-3'>
                <div id='errorToast' class='toast' role='alert' aria-live='assertive' aria-atomic='true' data-bs-autohide='true' data-bs-delay='5000'>
                    <div class='toast-header'>
                        <strong class='me-auto text-danger'>Update Error</strong>
                        <button type='button' class='btn-close' data-bs-dismiss='toast' aria-label='Close'></button>
                    </div>
                    <div class='toast-body'>
                        Error: {$sql->error}
                    </div>
                </div>
            </div>";
    }
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
    <h2 class="text-center">Electricity Bill Form</h2>
    <form action="add_bill.php" method="POST">
        <div class="mb-3">
            <label for="name" class="form-label fw-bold">Name: </label>
            <input type="text" name="name" class="form-control w-100" required />
        </div>
        <div class="mb-3">
            <label for="email" class="form-label fw-bold">Email: </label>
            <input type="email" name="email" class="form-control w-100" required />
        </div>
        <div class="mb-3">
            <label for="meter-number" class="form-label fw-bold">Meter Number:
            </label>
            <input
                type="number"
                name="meter-number"
                class="form-control w-100"
                required />
        </div>
        <div class="mb-3">
            <label for="address" class="form-label fw-bold">Address: </label>
            <textarea
                type="text"
                name="address"
                class="form-control w-100"
                required></textarea>
        </div>
        <div class="mb-3">
            <label for="unit" class="form-label fw-bold">Units Consumed:
            </label>
            <input
                type="number"
                name="unit"
                class="form-control w-100"
                required />
        </div>
        <div class="mb-3">
            <label for="due_date" class="form-label fw-bold">Due Date: </label>
            <input type="date" name="due_date" class="form-control w-100" required />
        </div>
        <div class="d-flex flex-column align-items-center gap-3">
            <button type="submit" class="btn btn-success">Submit</button>
            <a href="index.php" class="btn btn-secondary">Back</a>
        </div>
    </form>
    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const errorToast = document.getElementById('errorToast');
            if (errorToast) {
                const toastBootstrap = bootstrap.Toast.getOrCreateInstance(errorToast);
                toastBootstrap.show();
            }
        });
    </script>
</body>

</html>
