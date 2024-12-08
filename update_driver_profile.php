<?php
session_start();

// Check if the driver is logged in
if (!isset($_SESSION['driver_id'])) {
    header("Location: driver_login.php"); // Redirect to login if not logged in
    exit;
}

$conn = new mysqli("localhost", "root", "", "bus_system");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$driver_id = $_SESSION['driver_id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = !empty($_POST['password']) ? password_hash($_POST['password'], PASSWORD_BCRYPT) : null; // Only hash if password is provided
    $contact_number = $_POST['contact_number'];

    // Prepare the SQL query
    if ($password) {
        // If the password is provided, update the password along with other details
        $sql = "UPDATE drivers SET name = ?, email = ?, password = ?, contact_number = ? WHERE driver_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssi", $name, $email, $password, $contact_number, $driver_id);
    } else {
        // If no new password, just update the other details
        $sql = "UPDATE drivers SET name = ?, email = ?, contact_number = ? WHERE driver_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssi", $name, $email, $contact_number, $driver_id);
    }

    // Execute the query
    if ($stmt->execute()) {
        echo "Profile updated successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

// Fetch current driver details to pre-fill the form
$sql = "SELECT * FROM drivers WHERE driver_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $driver_id);
$stmt->execute();
$result = $stmt->get_result();
$driver = $result->fetch_assoc();
$stmt->close();

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Driver Profile</title>
    <link rel="stylesheet" href="login.css">
</head>
<body>
    <form method="POST" action="">
    <h1>Update Your Profile</h1>
        <label>Name:</label>
        <input type="text" name="name" value="<?php echo htmlspecialchars($driver['name']); ?>" required><br>

        <label>Email:</label>
        <input type="email" name="email" value="<?php echo htmlspecialchars($driver['email']); ?>" required><br>

        <label>Password (Leave blank if you don't want to change):</label>
        <input type="password" name="password"><br>

        <label>Contact Number:</label>
        <input type="text" name="contact_number" value="<?php echo htmlspecialchars($driver['contact_number']); ?>" required><br>

        <button type="submit">Update Profile</button>
    </form>
</body>
</html>
