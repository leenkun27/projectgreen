<?php
include '../condb.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $type_id = $_POST['type_id'];
    $cost_price = $_POST['cost_price'];
    $quantity = $_POST['quantity'];
    $unit = $_POST['unit'];

    // ตรวจสอบการอัปโหลดรูปภาพใหม่
    if (!empty($_FILES['product_img']['name'])) {
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES['product_img']['name']);
        if (move_uploaded_file($_FILES['product_img']['tmp_name'], $target_file)) {
            $sql = "UPDATE product SET product_name=?, type_id=?, cost_price=?, quantity=?, unit=?, product_img=? WHERE product_id=?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("siidssi", $product_name, $type_id, $cost_price, $quantity, $unit, $target_file, $product_id);
        } else {
            echo "<script>alert('ไม่สามารถอัปโหลดรูปภาพได้'); window.history.back();</script>";
        }
    } else {
        $sql = "UPDATE product SET product_name=?, type_id=?, cost_price=?, quantity=?, unit=? WHERE product_id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("siidss", $product_name, $type_id, $cost_price, $quantity, $unit, $product_id);
    }

    if ($stmt->execute()) {
        echo "<script>alert('แก้ไขข้อมูลสำเร็จ'); window.location.href='product_list.php';</script>";
    } else {
        echo "<script>alert('เกิดข้อผิดพลาดในการแก้ไขข้อมูล'); window.history.back();</script>";
    }

    $stmt->close();
    $conn->close();
}
