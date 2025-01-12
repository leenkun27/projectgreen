<?php
session_start();
if ($_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
</head>
<body>
    <h1>ยินดีต้อนรับ Admin: <?php echo $_SESSION['username']; ?></h1>
    <a href="logout.php">Logout</a>
</body>
</html>
