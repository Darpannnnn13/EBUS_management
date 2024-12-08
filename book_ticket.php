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

// Check if form data is received
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $bus_id = $_POST['bus_id'];
    $seat_count = $_POST['seat_count'];
    $ticket_price = $_POST['ticket_price'];
    $total_price = $seat_count * $ticket_price;

    // Fetch user ID from session email
    $user_email = $_SESSION['email'];
    $user_sql = "SELECT id FROM users WHERE email = ?";
    $stmt = $conn->prepare($user_sql);
    $stmt->bind_param("s", $user_email);
    $stmt->execute();
    $user_result = $stmt->get_result();
    if ($user_result->num_rows > 0) {
        $user_id = $user_result->fetch_assoc()['id'];

        // Insert booking into the database
        $booking_sql = "INSERT INTO bookings (user_id, bus_id, seat_count, total_price) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($booking_sql);
        $stmt->bind_param("iiid", $user_id, $bus_id, $seat_count, $total_price);

        if ($stmt->execute()) {
            // Fetch bus details for confirmation
            $bus_sql = "SELECT * FROM buses WHERE bus_id = ?";
            $stmt = $conn->prepare($bus_sql);
            $stmt->bind_param("i", $bus_id);
            $stmt->execute();
            $bus_result = $stmt->get_result();
            $bus = $bus_result->fetch_assoc();

            // Print the ticket
            echo "<div class='ticket-container'>
                    <h2>Booking Confirmation</h2>
                    <div class='ticket-details'>
                        <p><strong>Booking ID:</strong> " . $stmt->insert_id . "</p>
                        <p><strong>User Name:</strong> " . $_SESSION['user'] . "</p>
                        <p><strong>Email:</strong> " . $user_email . "</p>
                        <p><strong>Bus Type:</strong> " . $bus['bus_type'] . "</p>
                        <p><strong>Source:</strong> " . $bus['source'] . "</p>
                        <p><strong>Destination:</strong> " . $bus['destination'] . "</p>
                        <p><strong>Seats Booked:</strong> " . $seat_count . "</p>
                        <p><strong>Ticket Price:</strong> ₹" . number_format($ticket_price, 2) . "</p>
                        <p class='total-price'><strong>Total Price:</strong> ₹" . number_format($total_price, 2) . "</p>
                    </div>
                    <div class='ticket-footer'>
                        <button class='print-btn' onclick='window.print()'>Print Ticket</button>
                    </div>
                </div>";
        } else {
            echo "<p>Error: " . $stmt->error . "</p>";
        }
    } else {
        echo "<p>User not found. Please try again.</p>";
    }

    $stmt->close();
} else {
    echo "<p>Invalid request method. Please book via the dashboard.</p>";
}

$conn->close();
?>

<!-- Include the CSS for ticket styling -->
<style>
   /* Style for the entire page */
body {
    font-family: 'Arial', sans-serif;
    background-color: #f4f4f9;
    color: #333;
    padding: 20px;
}

/* Style for the ticket container */
.ticket-container {
    max-width: 600px;
    margin: 20px auto;
    padding: 20px;
    background-color: #fff;
    border: 1px solid #ddd;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    border-radius: 10px;
}

/* Style for the header of the ticket */
.ticket-container h2 {
    text-align: center;
    color: #007bff;
    margin-bottom: 20px;
    font-size: 24px;
}

/* Style for the details section */
.ticket-details {
    margin-bottom: 20px;
    font-size: 16px;
}

/* Style for labels (Booking details) */
.ticket-details strong {
    display: inline-block;
    width: 150px;
    font-weight: bold;
    color: #333;
}

/* Style for the ticket rows (values) */
.ticket-details p {
    margin: 5px 0;
}

/* Style for the total price */
.ticket-details .total-price {
    font-size: 20px;
    font-weight: bold;
    color: #28a745;
}

/* Style for the footer */
.ticket-footer {
    text-align: center;
    margin-top: 20px;
}

/* Button for printing the ticket */
.print-btn {
    padding: 10px 20px;
    background-color: #007bff;
    color: #fff;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

.print-btn:hover {
    background-color: #0056b3;
}

/* Print-specific styles */
@media print {
    body {
        padding: 0;
    }

    .ticket-container {
        width: 100%;
        max-width: none;
        box-shadow: none;
    }

    .ticket-footer {
        display: none;
    }

    .print-btn {
        display: none;
    }
}

</style>
