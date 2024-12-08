<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="ad_dash.css"> <!-- Link the CSS -->
</head>
<body>
    <header>
        <h1>Welcome, Admin!</h1>
    </header>

    <div class="action-container">
        <!-- Button to go to bus.php -->
        <a href="bus.php" class="action-btn">
            <button>Go to Bus Management</button>
        </a>

        <!-- Button to add new bus -->
        <a href="add_bus.php" class="action-btn">
            <button>Add New Bus</button>
        </a>

        <!-- Button to manage drivers -->
        <a href="admin_register_driver.php" class="action-btn">
            <button>Register Driver</button>
        </a>

        <!-- Logout button -->
        <a href="admin_logout.php" class="action-btn logout-btn">
            <button>Logout</button>
        </a>

        <!-- Home page button -->
        <a href="main.php" class="action-btn">
            <button>Home Page</button>
        </a>
    </div>

    <footer>
        <p>&copy; 2024 Bus Management System. All Rights Reserved.</p>
    </footer>
</body>
</html>
