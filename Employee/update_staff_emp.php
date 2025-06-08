<?php
include '../condb.php';

$id = $_POST['id'];
$name = $_POST['name'];
$username = $_POST['username'];
$address = $_POST['user_address'];
$tel = $_POST['user_tell'];
$role = $_POST['role'];

$sql = "UPDATE users SET 
            name = '$name',
            username = '$username',
            user_address = '$address',
            user_tell = '$tel',
            role = '$role'
        WHERE id = $id";

if ($conn->query($sql) === TRUE) {
    echo "<script>alert('แก้ไขข้อมูลสำเร็จ'); window.location='staff_employee.php';</script>";
} else {
    echo "Error: " . $conn->error;
}
$conn->close();
?>
