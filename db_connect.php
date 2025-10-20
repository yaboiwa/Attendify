<?php
// Database connection settings
$host = "localhost";     // usually localhost in XAMPP
$user = "root";          // default username in XAMPP
$pass = "";              // default password (leave blank unless you set one)
$db   = "System_attendance"; // your database name

// Create connection
$conn = new mysqli($host, $user, $pass, $db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Optional: uncomment for testing
// echo "Database connected successfully!";
?>
