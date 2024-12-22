<?php
// เชื่อมต่อฐานข้อมูล
$host = "localhost";
$username = "root";
$password = "";
$dbname = "wichian_db";

$conn = new mysqli($host, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// ดึงข้อมูล type_name
$type_query = "SELECT type_id, type_name FROM product_type";
$type_result = $conn->query($type_query);

// ดึงข้อมูล product_name
$product_query = "SELECT product_id, product_name FROM product";
$product_result = $conn->query($product_query);
?>