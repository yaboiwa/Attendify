<?php require 'db_connect.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
</head>
<body>
<h2>Create an Account</h2>
<form method="post" action="register_action.php">
    <label>Email: <input type="email" name="email" required></label><br>
    <label>Phone: <input type="text" name="phone" required></label><br>
    <label>Password: <input type="password" name="password" required></label><br>
    <label>Confirm Password: <input type="password" name="password2" required></label><br>
    <button type="submit">Register</button>
</form>
<p>Already have an account? <a href="login.php">Login here</a></p>
</body>
</html>
