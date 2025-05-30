<?php
include '../condb.php';

$name = $_POST['name'];
$username = $_POST['username'];
$password = $_POST['password'];
$confirm_password = $_POST['confirm_password'];
$role = $_POST['role'] == '1' ? 'admin' : 'user';
$address = $_POST['user_address'];
$tel = $_POST['user_tell'];

if ($password !== $confirm_password) {
    echo "<script>alert('รหัสผ่านไม่ตรงกัน'); window.history.back();</script>";
    exit;
}

$hashPassword = password_hash($password, PASSWORD_DEFAULT);

$sql = "INSERT INTO users (username, password, role, name, user_address, user_tell)
        VALUES ('$username', '$hashPassword', '$role', '$name', '$address', '$tel')";

if ($conn->query($sql) === TRUE) {
    echo "<script>alert('เพิ่มพนักงานสำเร็จ'); window.location='staff_admin.php';</script>";
} else {
    echo "Error: " . $conn->error;
}
$conn->close();
?>
