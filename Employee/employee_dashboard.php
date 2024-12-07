<?php
session_start();
if ($_SESSION['role'] != 'employee') {
    header('Location: login.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Dashboard</title>
</head>
<body>
    <h2>Welcome Employee</h2>
    <p>This is the employee dashboard.</p>
    <a href="logout.php">Logout</a>
</body>
</html>
