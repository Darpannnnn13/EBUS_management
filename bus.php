<?php
// Start the session to check if the user is logged in (optional)
session_start();

// Connect to the bus_system database
$conn = new mysqli("localhost", "root", "", "bus_system");

// Check if the connection is successful
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query to fetch bus details from the buses table
$query = "SELECT * FROM buses";

// Execute the query and check for errors
$result = $conn->query($query);

// Check if the query execution was successful
if (!$result) {
    // If there's an error, display the error message and exit
    die("Error executing query: " . $conn->error);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bus Information</title>
    <!-- External CSS link -->
    <link rel="stylesheet" href="bus.css">
</head>
<body>
    <div class="container">
        <h1>Bus Information</h1>

        <?php
        // Check if there are any buses in the result set
        if ($result->num_rows > 0) {
            // If buses are available, display the data in a table
            echo "<table>
                    <thead>
                        <tr>
                            <th>Bus ID</th>
                            <th>Bus Type</th>
                            <th>Source</th>
                            <th>Destination</th>
                            <th>Price</th>
                            <th>Driver ID</th>
                        </tr>
                    </thead>
                    <tbody>";

            // Fetch and display each bus record
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>" . $row['bus_id'] . "</td>
                        <td>" . $row['bus_type'] . "</td>
                        <td>" . $row['source'] . "</td>
                        <td>" . $row['destination'] . "</td>
                        <td>" . $row['ticket_price'] . "</td>
                        <td>" . $row['driver_id'] . "</td>
                      </tr>";
            }

            echo "</tbody></table>";
        } else {
            // If no buses are found, display a message
            echo "<p>No buses available.</p>";
        }
        ?>

    </div>
</body>
</html>

<?php
// Close the database connection
$conn->close();
?>
