<?php
// send_otp.php
include('db_connect.php');
session_start();

function genOTP() {
    return str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);
}

$phone = '';
$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $phone = trim($_POST['phone']);

    if (!$phone) {
        $error = "Enter phone number.";
    } else {
        // Check user exists
        $stmt = $conn->prepare("SELECT id FROM users WHERE phone = ?");
        $stmt->bind_param('s', $phone);
        $stmt->execute();
        $res = $stmt->get_result();
        $stmt->close();

        if ($res->num_rows == 0) {
            $error = "Phone number not found.";
        } else {
            // Generate OTP
            $otp = genOTP();
            // Save otp to users table (demo approach)
            $stmt = $conn->prepare("UPDATE users SET otp = ? WHERE phone = ?");
            $stmt->bind_param('ss', $otp, $phone);
            $stmt->execute();
            $stmt->close();

            // Insert simulated SMS into sms_messages
            $body = "Your verification code is: $otp (valid 10 minutes)";
            $stmt = $conn->prepare("INSERT INTO sms_messages (phone, body) VALUES (?, ?)");
            $stmt->bind_param('ss', $phone, $body);
            $stmt->execute();
            $stmt->close();

            // Keep phone in session to continue flow
            $_SESSION['reset_phone'] = $phone;

            $success = "OTP created and saved to simulated SMS inbox.";
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head><title>Send OTP (Simulated SMS)</title></head>
<body>
<h2>Reset Password — Step 1: Request OTP</h2>

<?php if ($error) echo "<div style='color:red;'>$error</div>"; ?>
<?php if ($success) echo "<div style='color:green;'>$success</div>"; ?>

<form method="POST" action="">
    <label>Phone (include country code):</label><br>
    <input type="text" name="phone" required value="<?php echo htmlspecialchars($phone); ?>"><br><br>
    <button type="submit">Send OTP (simulate SMS)</button>
</form>

<?php if (!empty($_SESSION['reset_phone'])): ?>
    <p>
      <a href="verify_otp.php">Proceed to verify OTP</a> |
      <a href="inbox.php?phone=<?php echo urlencode($_SESSION['reset_phone']); ?>">Open simulated SMS inbox for <?php echo htmlspecialchars($_SESSION['reset_phone']); ?></a>
    </p>
<?php endif; ?>

<p><a href="login.php">Back to login</a></p>
</body>
</html>

