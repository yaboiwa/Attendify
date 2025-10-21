<?php
require 'db_connect.php';
session_start();

$allowed = isset($_SESSION['password_reset_allowed']) && $_SESSION['password_reset_allowed'] >= time();
if (!isset($_SESSION['password_reset_user']) || !$allowed) {
    die('Not authorized or session expired.');
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Set New Password</title>
</head>
<body>
<h2>Set New Password</h2>
<form method="post" action="reset_password_action.php">
    <label>New password: <input type="password" name="password" required></label><br>
    <label>Confirm password: <input type="password" name="password2" required></label><br>
    <button type="submit">Save Password</button>
</form>
</body>
</html>
