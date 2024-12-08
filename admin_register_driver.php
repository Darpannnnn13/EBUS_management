<?php
session_start();

// Check if the admin is logged in, otherwise redirect to login page
if (!isset($_SESSION['admin'])) {
    header("Location: admin_login.php");
    exit;
}

$conn = new mysqli("localhost", "root", "", "bus_system");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle the form submission for adding a driver
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password']; // Simple password handling (no hash here as requested)
    $contact = $_POST['contact_number'];

    // Insert driver details into the 'drivers' table
    $sql = "INSERT INTO drivers (name, email, password, contact_number) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $name, $email, $password, $contact);

    if ($stmt->execute()) {
        echo "Driver registered successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register Driver</title>
    <link rel="stylesheet" href="login.css">
</head>
<body>
    <form method="POST" action="">
    <h1>Register Driver</h1>
        <label>Name:</label>
        <input type="text" name="name" required>
        <label>Email:</label>
        <input type="email" name="email" required>
        <label>Password:</label>
        <input type="password" name="password" required>
        <label>Contact Number:</label>
        <input type="text" name="contact_number" required>
        <button type="submit">Register Driver</button>
        <a href="admin_logout.php">
    <button type="button">admin Login</button>
</a>
<br><br>
        <a href="driver_login.php">
    <button type="button">Login Driver</button>
</a>
    </form>
</body>
</html>
