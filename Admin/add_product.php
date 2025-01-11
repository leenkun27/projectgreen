<?php
// เชื่อมต่อฐานข้อมูล
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "wichian_db";

$conn = new mysqli($servername, $username, $password, $dbname);

// ตรวจสอบการเชื่อมต่อ
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $product_name = $_POST['product_name'];
    $price_today = $_POST['price_today'];
    $cost_price = $_POST['cost_price'];
    $quantity = $_POST['quantity'];
    $type_id = $_POST['type_id'];
    $unit = $_POST['unit'];
    $image = $_FILES['product_img']['name'];

    // ตั้งค่าที่อยู่สำหรับเก็บไฟล์
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($image);

    // อัปโหลดไฟล์
    if (move_uploaded_file($_FILES['product_img']['tmp_name'], $target_file)) {
        // SQL สำหรับเพิ่มข้อมูลในฐานข้อมูล
        $sql = "INSERT INTO product (product_name, price_today, cost_price, quantity, type_id, product_img, unit) 
                VALUES ('$product_name', '$price_today', '$cost_price', '$quantity', '$type_id', '$image', '$unit')";

        if ($conn->query($sql) === TRUE) {
            echo "บันทึกข้อมูลสำเร็จ";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "เกิดข้อผิดพลาดในการอัปโหลดรูปภาพ";
    }
}

$conn->close();
?>
