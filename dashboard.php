<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: index.php'); // Redirect to login if not logged in
    exit;
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bus_system";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch bus details
$sql = "SELECT * FROM buses";
$result = $conn->query($sql);

// Fetch user ID
$user_email = $_SESSION['email'];
$user_sql = "SELECT * FROM users WHERE email = '$user_email'";
$user_result = $conn->query($user_sql);
$user_id = $user_result->fetch_assoc()['id'];
//$user_email1 = $user_result->fetch_assoc()['email'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard</title>
  <link rel="stylesheet" href="dashboard.css">
</head>
<body>
      </tbody>
    </table>
    <!-- Booking History Button -->
    <div class="container">
        <h2>Welcome, <?php echo $_SESSION['user']; ?>!</h2>
        <div class="button-container">
    <a href="booking_history.php" class="history-btn">View Booking History</a>
    <a href="main.php" class="logout">Logout</a>
</div>

        <h3>Available Buses</h3>
        <table>
            <thead>
                <tr>
                    <th>Bus Type</th>
                    <th>Source</th>
                    <th>Destination</th>
                    <th>Ticket Price</th>
                    <th>Contact</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <!-- Fetch and display buses available for booking -->
                <?php
                $conn = new mysqli("localhost", "root", "", "bus_system");
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                $sql = "SELECT * FROM buses";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>{$row['bus_type']}</td>
                                <td>{$row['source']}</td>
                                <td>{$row['destination']}</td>
                                <td>{$row['ticket_price']}</td>
                                <td>{$row['contact']}</td>
                                <td>
                                    <form method='post' action='book_ticket.php' class='book-form'>
                                        <input type='hidden' name='bus_id' value='" . htmlspecialchars($row['bus_id']) . "'>
                                        <input type='hidden' name='ticket_price' value='" . htmlspecialchars($row['ticket_price']) . "'>
                                        <input type='number' name='seat_count' placeholder='No. of Seats' min='1' required>
                                        <button type='submit'>Book Now</button>
                                    </form>
                                </td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='6'>No buses available</td></tr>";
                }
                ?>
            </tbody>
        </table>
</body>
</html>
