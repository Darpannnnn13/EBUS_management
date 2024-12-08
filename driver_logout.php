<?php
session_start();
session_unset();  // Remove all session variables
session_destroy();  // Destroy the session

// Redirect to driver login page
header("Location: driver_login.php");
exit;
?>
