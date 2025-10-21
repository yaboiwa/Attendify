<?php require 'db_connect.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>
<h2>Login</h2>
<form method="post" action="login_action.php">
    <label>Email: <input type="email" name="email" required></label><br>
    <label>Password: <input type="password" name="password" required></label><br>
    <button type="submit">Login</button>
</form>
<p><a href="request_reset.php">Forgot password? Reset via OTP</a></p>
<p>Don't have an account? <a href="register.php">Register here</a></p>
</body>
</html>
