<?php
session_start();

// Redirect to login page if the admin is not logged in
if (!isset($_SESSION['admin'])) {
    header("Location: admin_login.php");
    exit;
}

$conn = new mysqli("localhost", "root", "", "bus_system");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get all drivers for the dropdown
$drivers_result = $conn->query("SELECT * FROM drivers");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get bus details from the form
    $bus_type = $_POST['bus_type'];
    $source = $_POST['source'];
    $destination = $_POST['destination'];
    $price = $_POST['ticket_price'];
    $contact_no = $_POST['contact'];  // Contact number
    $driver_id = $_POST['driver_id'];

    // SQL query to insert bus details into the database
    $sql = "INSERT INTO buses (bus_type, source, destination, ticket_price, contact, driver_id) 
            VALUES (?, ?, ?, ?, ?, ?)";

    // Prepare the statement
    $stmt = $conn->prepare($sql);

    // Check if the statement was prepared correctly
    if ($stmt === false) {
        die('MySQL prepare error: ' . $conn->error);
    }

    // Bind the parameters
    $stmt->bind_param("sssssi", $bus_type, $source, $destination, $price, $contact_no, $driver_id);

    // Execute the statement
    if ($stmt->execute()) {
        echo "Bus details added successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the prepared statement
    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Bus</title>
    <link rel="stylesheet" href="add_bus.css">
</head>
<body>
    <div class="container">
        <form method="POST" action="add_bus.php">
            <h1>Add Bus Details</h1>
            <label>Bus Type:</label>
            <select name="bus_type" required>
                <option value="AC Sleeper">AC Sleeper</option>
                <option value="Non-AC">Non-AC</option>
                <option value="Volvo">Volvo</option>
                <option value="Luxury">Luxury</option>
                <option value="Mini Bus">Mini Bus</option>
                <option value="Superfast">Superfast</option>
                <option value="Deluxe">Deluxe</option>
                <option value="Express">Express</option>
            </select><br>

            <label>Source:</label>
            <input type="text" name="source" required><br>

            <label>Destination:</label>
            <input type="text" name="destination" required><br>

            <label>Price:</label>
            <input type="text" name="ticket_price" required><br>

            <label>Contact No:</label>
            <input type="text" name="contact" required><br>  <!-- Added contact no field -->

            <label>Driver:</label>
            <select name="driver_id" required>
                <?php while ($driver = $drivers_result->fetch_assoc()): ?>
                    <option value="<?php echo $driver['driver_id']; ?>"><?php echo $driver['name']; ?></option>
                <?php endwhile; ?>
            </select><br><br>

            <button type="submit">Add Bus</button>           
        </form>
        <div class="button-container">
                <a href="admin_dashboard.php">
                    <button>Admin Dashboard</button>
                </a>
                <a href="main.php">
                    <button>Home Page</button>
                </a>
            </div>
    </div>
</body>
</html>
