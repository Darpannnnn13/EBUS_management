<?php
session_start();
if (!isset($_SESSION['driver_id'])) {
    header("Location: driver_login.php"); // Redirect to driver login page if not logged in
    exit;
}

$driver_id = $_SESSION['driver_id']; // Fetch driver_id from session
$conn = new mysqli("localhost", "root", "", "bus_system");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch driver information based on driver_id
$sql = "SELECT * FROM drivers WHERE driver_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $driver_id);
$stmt->execute();
$driver_result = $stmt->get_result();
$driver = $driver_result->fetch_assoc();

// Fetch buses assigned to the driver
$sql = "SELECT * FROM buses WHERE driver_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $driver_id);
$stmt->execute();
$buses_result = $stmt->get_result();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Driver Dashboard</title>
    <link rel="stylesheet" href="dr_dash.css">
    <style>
        /* Overall Body Styling */
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f7f8fa;
            margin: 0;
            padding: 0;
            color: #333;
        }

        /* Container Styling */
        .container {
            width: 85%;
            max-width: 1100px;
            margin: 50px auto;
            padding: 30px;
            background-color: #ffffff;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            color: #4A90E2;
            font-size: 2.5em;
            margin-bottom: 30px;
        }

        /* Table Styling */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 12px 15px; /* Added padding for more space */
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #4A90E2;
            color: white;
            font-size: 1.2em;
        }

        td {
            background-color: #f9f9f9;
        }

        /* Row Hover Effect */
        tr:hover {
            background-color: #f1f1f1;
        }

        /* Buttons Styling */
        .btn {
            background-color: #28a745;
            color: white;
            padding: 12px 24px;
            border: none;
            border-radius: 30px;
            cursor: pointer;
            font-size: 16px;
            text-decoration: none;
            text-align: center;
            transition: background-color 0.3s ease;
            display: inline-block;
            margin: 10px 0;
        }

        .btn:hover {
            background-color: #218838;
        }

        /* Additional Button Styles for Logout and Update */
        .btn-update {
            background-color: #ffc107;
        }

        .btn-logout {
            background-color: #dc3545;
        }

        .btn-update:hover {
            background-color: #e0a800;
        }

        .btn-logout:hover {
            background-color: #c82333;
        }

        /* Button Container */
        .button-container {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-top: 40px;
        }

        /* Responsive Layout */
        @media (max-width: 768px) {
            .dashboard-info {
                flex-direction: column;
                align-items: center;
            }

            .dashboard-box {
                width: 80%;
            }

            h1 {
                font-size: 2em;
            }
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav>
        <a href="main.php">Home Page</a>
        <a href="driver_logout.php">Logout</a>
    </nav>

    <div class="container">
        <h2>Welcome, <?php echo $driver['name']; ?>!</h2>

        <h3>Your Assigned Buses</h3>
        <?php if ($buses_result->num_rows > 0): ?>
            <table>
                <thead>
                    <tr>
                        <th>Bus Type</th>
                        <th>Source</th>
                        <th>Destination</th>
                        <th>Contact</th>
                        <th>Ticket Price</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($bus = $buses_result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $bus['bus_type']; ?></td>
                            <td><?php echo $bus['source']; ?></td>
                            <td><?php echo $bus['destination']; ?></td>
                            <td><?php echo $bus['contact']; ?></td>
                            <td><?php echo $bus['ticket_price']; ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>No buses assigned to you yet.</p>
        <?php endif; ?>

        <h3>Your Profile</h3>
        <p><strong>Name:</strong> <?php echo $driver['name']; ?></p>
        <p><strong>Email:</strong> <?php echo $driver['email']; ?></p>
        <p><strong>Contact Number:</strong> <?php echo $driver['contact_number']; ?></p>

        <a href="update_driver_profile.php">Update Profile</a>
    </div>
</body>
</html>

<?php $conn->close(); ?>
