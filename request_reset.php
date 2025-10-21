<?php require 'db_connect.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Reset Password</title>
</head>
<body>
<h2>Reset Password</h2>
<form method="post" action="send_reset_otp.php">
    <label>Email: <input type="email" name="email" required></label><br>
    <button type="submit">Send OTP</button>
</form>
</body>
</html>
