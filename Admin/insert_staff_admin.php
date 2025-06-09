<?php
session_start();
if ($_SESSION['role'] != 'admin') {
    header("Location: ../login.php");
    exit();
}

include '../condb.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); 
    $role = $_POST['role'];
    $name = $_POST['name'];
    $address = $_POST['user_address'];
    $tell = $_POST['user_tell'];

    $sql = "INSERT INTO users (username, password, role, name, user_address, user_tell)
            VALUES ('$username', '$password', '$role', '$name', '$address', '$tell')";

    if ($conn->query($sql)) {
        echo "<script>
                alert('เพิ่มพนักงานเรียบร้อยแล้ว');
                window.location='staff_admin.php';
              </script>";
    } else {
        echo "เกิดข้อผิดพลาด: " . $conn->error;
    }

    $conn->close();
}
?>
