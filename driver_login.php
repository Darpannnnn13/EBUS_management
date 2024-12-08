<?php
session_start();

if (isset($_SESSION['driver_id'])) {
    header("Location: driver_dashboard.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Connect to the database
    $conn = new mysqli("localhost", "root", "", "bus_system");

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Fetch driver details
    $sql = "SELECT * FROM drivers WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $driver = $result->fetch_assoc();
        // Check password
        if ($password === $driver['password']) {  // Use plain password comparison here as per your request
            $_SESSION['driver_id'] = $driver['driver_id'];
            $_SESSION['driver_name'] = $driver['name'];
            header("Location: driver_dashboard.php");
            exit;
        } else {
            echo "Incorrect password.";
        }
    } else {
        echo "No driver found with this email.";
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Driver Login</title>
    <link rel="stylesheet" href="login.css">
</head>
<body>
    
    <form method="POST" action="">
    <h1>Driver Login</h1>
        <label>Email:</label>
        <input type="email" name="email" required>
        
        <label>Password:</label>
        <input type="password" name="password" required>
        
        <button type="submit">Login</button>
        <br><br>
        <a href="main.php">
    <button type="button">Log Out</button>
</a>
    </form>
</body>
</html>
