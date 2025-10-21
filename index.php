<?php
include('db_connect.php');
session_start();

// If logged in as admin, redirect to admin dashboard
if (isset($_SESSION['admin'])) {
    header("Location: admin-dashboard/admin.php");
    exit();
}   
// If logged in as user, redirect to user dashboard
elseif (isset($_SESSION['user'])) {
    header("Location: user-dashboard/user.php");
    exit();
}           
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Attendify - Main Dashboard</title>
</head>
<body>
    <div class="container">
        <h1>Welcome to Attendify</h1>
        <p>Please choose an option:</p>
        <a href="login.php" class="button">Login</a>
        <a href="register.php" class="button">Register</a>
    </div>
</body>
</html>
