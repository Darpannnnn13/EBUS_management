<?php
session_start();

// If already logged in, redirect to the admin dashboard
if (isset($_SESSION['admin'])) {
    header("Location: admin_register_driver.php");
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

    // Fetch admin details
    $sql = "SELECT * FROM admin WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $admin = $result->fetch_assoc();
        // Direct password comparison (no hash here, as per your requirement)
        if ($password === $admin['password']) {
            $_SESSION['admin'] = $admin['name']; // Store admin's name in session
            header("Location: admin_dashboard.php"); // Redirect to the admin dashboard
            exit;
        } else {
            echo "<p>Incorrect password. Please try again.</p>";
        }
    } else {
        echo "<p>No admin found with this email.</p>";
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Login</title>
    <link rel="stylesheet" href="login.css">
</head>
<body>
    
    <form method="POST" action="">
    <h1>Admin Login</h1>
        <label>Email:</label>
        <input type="email" name="email" required>
        <label>Password:</label>
        <input type="password" name="password" required>
        <button type="submit">Login</button>
  
    </form>
</body>
</html>
