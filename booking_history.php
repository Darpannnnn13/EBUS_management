<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: index.php'); // Redirect to login if not logged in
    exit;
}

$user_email = $_SESSION['email'];
$conn = new mysqli("localhost", "root", "", "bus_system");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch user ID based on the email
$sql = "SELECT id FROM users WHERE email = '$user_email'";
$result = $conn->query($sql);
$user = $result->fetch_assoc();
$user_id = $user['id'];

// Fetch booking history for the logged-in user along with bus details
$sql = "SELECT b.bus_type, b.source, b.destination, bo.seat_count, bo.total_price, bo.booking_date 
        FROM bookings bo 
        JOIN buses b ON bo.bus_id = b.bus_id 
        WHERE bo.user_id = '$user_id'";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking History</title>
    <link rel="stylesheet" href="book_hist.css">
</head>
<body>
    <!-- Navbar -->
    <nav>
        <a href="dashboard.php">Dashboard</a>
        <a href="index.php">Logout</a>
    </nav>

    <div class="container">
        <h2>Your Booking History</h2>

        <?php if ($result->num_rows > 0): ?>
            <table>
                <thead>
                    <tr>
                        <th>Bus Type</th>
                        <th>Source</th>
                        <th>Destination</th>
                        <th>Seats Booked</th>
                        <th>Price</th>
                        <th>Booking Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($booking = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $booking['bus_type']; ?></td>
                            <td><?php echo $booking['source']; ?></td>
                            <td><?php echo $booking['destination']; ?></td>
                            <td><?php echo $booking['seat_count']; ?></td>
                            <td><?php echo $booking['total_price']; ?></td>
                            <td><?php echo $booking['booking_date']; ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>No booking history found.</p>
        <?php endif; ?>
    </div>
</body>
</html>

<?php $conn->close(); ?>
