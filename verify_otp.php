<?php require 'db_connect.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Verify OTP</title>
</head>
<body>
<h2>Enter OTP</h2>
<form method="post" action="verify_otp_action.php">
    <input type="hidden" name="email" value="<?php echo htmlspecialchars($_GET['email'] ?? '', ENT_QUOTES); ?>">
    <label>OTP: <input type="text" name="otp" maxlength="6" required></label><br>
    <button type="submit">Verify</button>
</form>
</body>
</html>
