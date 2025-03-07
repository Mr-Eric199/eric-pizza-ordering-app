<?php
// Database Configuration
$servername = "localhost";
$username   = "root";
$password   = "root";
$dbname     = "eric_pizza";

// Establish Connection with Exception Handling
$conn = new mysqli($servername, $username, $password, $dbname);

// Check Connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
