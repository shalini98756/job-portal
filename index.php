<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.html");
    exit;
}

date_default_timezone_set("Asia/Kolkata");
$username = htmlspecialchars($_SESSION['username']);
$currentDate = date("l, F j, Y");
$currentTime = date("h:i A");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Welcome</title>
<link rel="stylesheet" href="css/style.css">
</head>

<body>
  <div class="box">
    <h2>Welcome, <span class="username"><?php echo $username; ?></span>!</h2>
    <p>You have successfully logged in.</p>
    <a href="logout.php">Logout</a>
  </div>
</body>
</html>