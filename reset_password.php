<?php
include('db_connect.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $new_password = $_POST['new_password'];

    // Check if user exists by email or phone
    
    $check = "SELECT * FROM users WHERE email='$email' OR phone='$phone'";
    $result = $conn->query($check);

    if ($result->num_rows > 0) {
        // Update password
        $update = "UPDATE users SET password='$new_password' WHERE email='$email' OR phone='$phone'";
        if ($conn->query($update) === TRUE) {
            echo "Password reset successful! Redirecting to login...";
            header("refresh:2; url=login.php");
            exit();
        } else {
            echo "Error updating password: " . $conn->error;
        }
    } else {
        echo "No account found with that email or phone number.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Reset Password</title>
</head>
<body>
    <h2>Reset Password</h2>
    <form method="POST" action="">
        <label>Email (optional):</label><br>
        <input type="email" name="email"><br><br>

        <label>Phone (optional):</label><br>
        <input type="text" name="phone"><br><br>

        <label>New Password:</label><br>
        <input type="password" name="new_password" required><br><br>

        <input type="submit" value="Reset Password"><br><br>

        <a href="login.php">Back to Login</a>
    </form>
</body>
</html>
