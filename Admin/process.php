<?php
$host = "localhost";
$username = "root";
$password = "";
$dbname = "wichian_db";

$conn = new mysqli($host, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$type_query = "SELECT type_id, type_name FROM product_type";
$type_result = $conn->query($type_query);

$product_query = "SELECT product_id, product_name FROM product";
$product_result = $conn->query($product_query);
?>