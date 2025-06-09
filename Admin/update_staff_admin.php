<?php
session_start();
if ($_SESSION['role'] != 'admin') {
    header("Location: ../login.php");
    exit();
}

include '../condb.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $username = $_POST['username'];
    $user_address = $_POST['user_address'];
    $user_tell = $_POST['user_tell'];
    $role = $_POST['role'];
    $password = $_POST['password'];

    if (!empty($password)) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $sql = "UPDATE users SET 
                    name = '$name',
                    username = '$username',
                    user_address = '$user_address',
                    user_tell = '$user_tell',
                    role = '$role',
                    password = '$hashed_password'
                WHERE id = $id";
    } else {
        $sql = "UPDATE users SET 
                    name = '$name',
                    username = '$username',
                    user_address = '$user_address',
                    user_tell = '$user_tell',
                    role = '$role'
                WHERE id = $id";
    }

    if ($conn->query($sql)) {
        echo "<script>
                alert('อัปเดตข้อมูลเรียบร้อยแล้ว');
                window.location='staff_admin.php';
              </script>";
    } else {
        echo "เกิดข้อผิดพลาด: " . $conn->error;
    }

    $conn->close();
}
?>
