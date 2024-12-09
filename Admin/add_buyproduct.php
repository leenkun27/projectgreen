<?php
// รับข้อมูลจาก AJAX
$p_name = $_POST['p_name'];
$p_type = $_POST['p_type'];
$p_qty = $_POST['p_qty'];
$p_price = $_POST['p_price'];

// กำหนดวันที่
$date = date("Y-m-d");

include '../condb.php';

// บันทึกข้อมูลลงในฐานข้อมูล
$query = "INSERT INTO tbl_product (name, type, quantity, price, date) VALUES ('$p_name', '$p_type', '$p_qty', '$p_price', '$date')";
$result = mysqli_query($conn, $query);

if ($result) {
    // ส่งข้อมูลกลับไปให้ JavaScript ใช้
    $response = array(
        'success' => true,
        'date' => $date,
        'name' => $p_name,
        'type' => $p_type,
        'qty' => $p_qty,
        'price' => $p_price
    );
} else {
    $response = array(
        'success' => true,
        'date' => $date,
        'name' => $p_name,
        'type' => $p_type,
        'qty' => $p_qty,
        'price' => $p_price
    );
    echo json_encode($response);}