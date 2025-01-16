<?php
include '../condb.php';
$productName = $_POST['product_name'];
$typeID = $_POST['type_id'];
$cost = $_POST['cost_price'];
$quant = $_POST['quantity'];

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

$target_dir = "../uploads/"; 
$target_file = $target_dir . basename($_FILES["product_img"]["name"]); 
$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION)); 


$check = getimagesize($_FILES["product_img"]["tmp_name"]);
if ($check === false) {
    echo "<script>alert('ไฟล์ที่อัปโหลดไม่ใช่รูปภาพ');</script>";
    exit;
}


if (move_uploaded_file($_FILES["product_img"]["tmp_name"], $target_file)) {

    $sql = "INSERT INTO product (product_name, type_id, cost_price, quantity, unit, product_img) 
            VALUES ('$productName', '$typeID', '$cost', '$quant', '$unit', '$target_file')";

    $result = mysqli_query($conn, $sql);
    if ($result) {
        echo "<script>alert('บันทึกข้อมูลสำเร็จ');</script>";
        echo "<script>window.location='product_admin.php';</script>";
    } else {
        echo "<script>alert('ไม่สามารถบันทึกข้อมูลได้');</script>";
    }
} else {
    echo "<script>alert('ไม่สามารถอัปโหลดรูปภาพได้');</script>";
}
mysqli_close($conn);

?>
