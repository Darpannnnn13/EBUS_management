<?php
// Start the session
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bus Booking System</title>
    <link rel="stylesheet" href="main.css">
</head>
<body>

    <!-- Navbar -->
    <nav>
        <a href="main.php">Home</a>
        <a href="index.php">User Login</a>
        <a href="driver_login.php">Driver Login</a>
        <a href="admin_login.php">Admin Login</a>
        <a href="register.php">User Register</a>
    </nav>

    <!-- Main Content -->
    <div class="main-container">
        <div class="company-info">
            <h2>Welcome to Our Bus Booking System</h2>
            <p>We offer comfortable and affordable bus services to various destinations across the country. Book your bus tickets easily with us!</p>
        </div>

        <!-- Bus Details Section -->
        <div class="buses-container">
            <?php
            // Static bus data
            $buses = [
                ['bus_type' => 'AC Sleeper', 'source' => 'Mumbai', 'destination' => 'Pune', 'ticket_price' => 500, 'image' => 'acsleeper1.webp'],
                ['bus_type' => 'Non-AC', 'source' => 'Delhi', 'destination' => 'Agra', 'ticket_price' => 300, 'image' => 'non-ac-luxury-bus1.png'],
                ['bus_type' => 'Volvo', 'source' => 'Bangalore', 'destination' => 'Chennai', 'ticket_price' => 600, 'image' => 'volvo1.webp'],
                ['bus_type' => 'Luxury', 'source' => 'Kolkata', 'destination' => 'Digha', 'ticket_price' => 700, 'image' => 'luxury1.webp'],
                ['bus_type' => 'Mini Bus', 'source' => 'Hyderabad', 'destination' => 'Vijayawada', 'ticket_price' => 400, 'image' => 'minibus1.jpeg'],
                ['bus_type' => 'Superfast', 'source' => 'Chennai', 'destination' => 'Madurai', 'ticket_price' => 550, 'image' => 'superfast1.jpeg'],
                ['bus_type' => 'Deluxe', 'source' => 'Kochi', 'destination' => 'Trivandrum', 'ticket_price' => 650, 'image' => 'deluxe1.avif'],
                ['bus_type' => 'Express', 'source' => 'Jaipur', 'destination' => 'Udaipur', 'ticket_price' => 350, 'image' => 'express1.jpg'],
                ['bus_type' => 'Volvo', 'source' => 'Ahmedabad', 'destination' => 'Surat', 'ticket_price' => 500, 'image' => 'volvo2.avif'],
                ['bus_type' => 'AC Sleeper', 'source' => 'Goa', 'destination' => 'Mangalore', 'ticket_price' => 600, 'image' => 'AC-sleeper2.webp'],
                ['bus_type' => 'Non-AC', 'source' => 'Pune', 'destination' => 'Nasik', 'ticket_price' => 250, 'image' => 'non-ac-bus2.jpg'],
                ['bus_type' => 'Luxury', 'source' => 'Lucknow', 'destination' => 'Agra', 'ticket_price' => 700, 'image' => 'luxury2.avif'],
                ['bus_type' => 'Superfast', 'source' => 'Patna', 'destination' => 'Bhubaneswar', 'ticket_price' => 450, 'image' => 'superfast2.jpg'],
                ['bus_type' => 'Mini Bus', 'source' => 'Bhopal', 'destination' => 'Indore', 'ticket_price' => 350, 'image' => 'mini-bus2.jpg'],
                ['bus_type' => 'Deluxe', 'source' => 'Chandigarh', 'destination' => 'Shimla', 'ticket_price' => 600, 'image' => 'deluxe2.jpg'],
                ['bus_type' => 'Express', 'source' => 'Delhi', 'destination' => 'Manali', 'ticket_price' => 750, 'image' => 'express2.jpeg']
            ];

            // Display bus details
            foreach ($buses as $bus) {
                echo "
                    <div class='bus-card'>
                        <img src='bus_images/{$bus['image']}' alt='{$bus['bus_type']}'>
                        <h3>{$bus['bus_type']}</h3>
                        <p><strong>Source:</strong> {$bus['source']}</p>
                        <p><strong>Destination:</strong> {$bus['destination']}</p>
                        <p class='price'>{$bus['ticket_price']} INR</p>
                    </div>
                ";
            }
            ?>
        </div>

        <!-- Book Now Button -->
        <div class="book-now-container">
            <a href="dashboard.php" class="book-now-btn">Book Now</a>
        </div>
    </div>

    <!-- Footer -->
    <footer>
        <p>&copy; 2024 Bus Booking System | <a href="terms.php">Terms & Conditions</a></p>
    </footer>

</body>
</html>
