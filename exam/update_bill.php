<?php

include "db.php";

$conn = get_connection();
$id = null;

if (isset($_GET['id'])) {
    $id = trim($_GET['id']);

    $query = "SELECT * FROM bills WHERE id = {$id}";
    $result = $conn->query($query);
    $bill = $result->fetch_assoc();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = trim($_POST['email']);
    $meter_number = $_POST['meter-number'];
    $address = trim($_POST['address']);
    $unit = $_POST['unit'];
    $due_date = $_POST['due_date'];

    // Compute total
    $php_per_unit = 3;
    $total = $unit * $php_per_unit;

    $query = "UPDATE bills SET name = ?, email = ?, meter_number = ?, address = ?, unit = ?, total = ?, due_date = ?
                WHERE id = ?";
    $sql = $conn->prepare($query);
    $sql->bind_param("ssisidsi", $name, $email, $meter_number, $address, $unit, $total, $due_date, $id);

    try {
        if ($sql->execute()) {
            header("Location: index.php");
            exit();
        }
    } catch (mysqli_sql_exception $e) {
        echo "Error Caused: {$sql->error}";
    }

    $sql->close();
    $conn->close();
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
    <h2 class="text-center">Electricity Bill Update Form</h2>
    <form action="update_bill.php?id=<?php echo $bill['id']; ?>" method="POST">
        <div class="mb-3">
            <label for="name" class="form-label fw-bold">Name: </label>
            <input type="text" name="name" class="form-control w-100" required value="<?php echo $bill["name"]; ?>" />
        </div>
        <div class="mb-3">
            <label for="email" class="form-label fw-bold">Email: </label>
            <input type="email" name="email" class="form-control w-100" required value="<?php echo $bill["email"]; ?>" />
        </div>
        <div class="mb-3">
            <label for="meter-number" class="form-label fw-bold">Meter Number:
            </label>
            <input
                type="number"
                name="meter-number"
                class="form-control w-100"
                required
                value="<?php echo $bill['meter_number']; ?>" />
        </div>
        <div class="mb-3">
            <label for="address" class="form-label fw-bold">Address: </label>
            <textarea
                type="text"
                name="address"
                class="form-control w-100"
                required
                value="<?php echo $bill['address'] ?>"></textarea>
        </div>
        <div class="mb-3">
            <label for="unit" class="form-label fw-bold">Units Consumed:
            </label>
            <input
                type="number"
                name="unit"
                class="form-control w-100"
                required
                value="<?php echo $bill['unit']; ?>" />
        </div>
        <div class="d-flex flex-column align-items-center gap-3">
            <button type="submit" class="btn btn-success">Update</button>
            <a href="index.php" class="btn btn-secondary">Back</a>
        </div>
    </form>
    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>
