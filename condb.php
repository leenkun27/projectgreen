<?php
$host = 'localhost';
$username = 'root';
$password = '';
$dbname = 'wichian_db';

$conn = new mysqli($host, $username, $password);

// ตรวจสอบการเชื่อมต่อ
if ($conn->connect_error) {
    die("การเชื่อมต่อเซิร์ฟเวอร์ผิดพลาด: " . $conn->connect_error);
}

// ตรวจสอบว่าฐานข้อมูลมีอยู่จริงหรือไม่
$db_selected = $conn->select_db($dbname);
if (!$db_selected) {
    die("ไม่พบฐานข้อมูล: $dbname");
}

// echo "เชื่อมต่อสำเร็จ!";
?>

