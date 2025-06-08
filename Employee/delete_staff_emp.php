<?php
include '../condb.php';

$id = $_GET['id'];
$sql = "DELETE FROM users WHERE id = $id";

if ($conn->query($sql) === TRUE) {
    echo "<script>alert('ลบข้อมูลสำเร็จ'); window.location='staff_emp.php';</script>";
} else {
    echo "Error: " . $conn->error;
}
$conn->close();
?>
