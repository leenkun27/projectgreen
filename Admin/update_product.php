<?php
include '../condb.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $type_id = $_POST['type_id'];
    $cost_price = $_POST['cost_price'];
    $unit = $_POST['unit'];
    switch ($unit) {
        case 1:
            $unit = "กิโลกรัม";
            break;
        case 2:
            $unit = "ชิ้น";
            break;
        case 3:
            $unit = "ลัง";
            break;
        default:
            $unit = "ไม่ระบุ";
    }

    if (!empty($_FILES['product_img']['name'])) {
        $target_dir = "../uploads/";
        $target_file = $target_dir . basename($_FILES['product_img']['name']);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        $check = getimagesize($_FILES["product_img"]["tmp_name"]);
        if ($check === false) {
            echo "<script>alert('ไฟล์ที่อัปโหลดไม่ใช่รูปภาพ'); window.history.back();</script>";
            exit;
        }

        if (move_uploaded_file($_FILES['product_img']['tmp_name'], $target_file)) {
            $sql = "UPDATE product SET product_name=?, type_id=?, cost_price=?, unit=?, product_img=? WHERE product_id=?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("siissi", $product_name, $type_id, $cost_price, $unit, $target_file, $product_id);
        } else {
            echo "<script>alert('ไม่สามารถอัปโหลดรูปภาพได้'); window.history.back();</script>";
            exit;
        }
    } else {
        $sql = "UPDATE product SET product_name=?, type_id=?, cost_price=?, unit=? WHERE product_id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("siisi", $product_name, $type_id, $cost_price, $unit, $product_id);
    }

    if ($stmt->execute()) {
        echo "<script>alert('แก้ไขข้อมูลสำเร็จ'); window.location.href='product_admin.php';</script>";
    } else {
        echo "<script>alert('เกิดข้อผิดพลาดในการแก้ไขข้อมูล'); window.history.back();</script>";
    }

    $stmt->close();
    $conn->close();
}
?>
