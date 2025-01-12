<?php
session_start();
include 'condb.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = md5($_POST['password']); 

    // ตรวจสอบผู้ใช้
    $sql = "SELECT * FROM users WHERE username = ? AND password = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();
        $_SESSION['username'] = $user['username'];
        $_SESSION['role'] = $user['role'];
        $_SESSION['name'] = $user['name']; 


        // แยก Role
        if ($user['role'] == 'admin') {
            header("Location: Admin/buy_admin.php");
        } else if ($user['role'] == 'user') {
            header("Location: Employee/employee_dashboard.php");
        }
        exit();
    } else {
        echo "<script>alert('ชื่อผู้ใช้หรือรหัสผ่านไม่ถูกต้อง'); window.location.href='login.php';</script>";
    }
}
?>
