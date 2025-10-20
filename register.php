<?php
include('db_connect.php');
session_start();

$fullname = $phone = $password = $confirm = '';
$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fullname = trim($_POST['fullname']);
    $phone = trim($_POST['phone']);
    $password = $_POST['password'];
    $confirm = $_POST['confirm'];

    if (!$fullname || !$phone || !$password || !$confirm) {
        $error = "All fields are required.";
    } elseif ($password !== $confirm) {
        $error = "Passwords do not match.";
    } else {
        // Check if phone already registered
        $stmt = $conn->prepare("SELECT id FROM users WHERE phone = ?");
        $stmt->bind_param("s", $phone);
        $stmt->execute();
        $res = $stmt->get_result();

        if ($res->num_rows > 0) {
            $error = "Phone number already registered.";
        } else {
            // Hash password for security
            $hashed = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $conn->prepare("INSERT INTO users (fullname, phone, password, role) VALUES (?, ?, ?, 'student')");
            $stmt->bind_param("sss", $fullname, $phone, $hashed);
            $stmt->execute();
            $stmt->close();

            $success = "Registration successful! You can now login.";
            $fullname = $phone = $password = $confirm = '';
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
</head>
<body>

<form method="POST" action="">
    <h2 style="text-align:center;">Register Account</h2>
    <?php if ($error): ?><div class="message error"><?php echo $error; ?></div><?php endif; ?>
    <?php if ($success): ?><div class="message success"><?php echo $success; ?></div><?php endif; ?>

    <label>Full Name:</label>
    <input type="text" name="fullname" required value="<?php echo htmlspecialchars($fullname); ?>">

    <label>Phone Number:</label>
    <input type="text" name="phone" required value="<?php echo htmlspecialchars($phone); ?>">

    <label>Password:</label>
    <input type="password" name="password" id="password" required>

    <label>Confirm Password:</label>
    <input type="password" name="confirm" id="confirm" required onkeyup="checkMatch()">

    <div id="matchMsg" style="font-size: 14px; margin-top:5px;"></div>

    <button type="submit">Register</button>
    <div class="message">
        Already have an account? <a href="login.php">Login</a>
    </div>
</form>

<script>
function checkMatch() {
    let pass = document.getElementById('password').value;
    let confirm = document.getElementById('confirm').value;
    let msg = document.getElementById('matchMsg');

    if (confirm.length === 0) {
        msg.textContent = "";
        return;
    }

    if (pass === confirm) {
        msg.textContent = "✅ Passwords match";
        msg.style.color = "green";
    } else {
        msg.textContent = "❌ Passwords do not match";
        msg.style.color = "red";
    }
}
</script>

</body>
</html>
