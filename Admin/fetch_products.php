<?php
$host = "localhost";
$username = "root";
$password = "";
$dbname = "wichian_db";

$conn = new mysqli($host, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['type_id'])) {
    $type_id = $_POST['type_id'];
    $query = "SELECT product_id, product_name FROM product WHERE type_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $type_id);
    $stmt->execute();
    $result = $stmt->get_result();

    echo '<option value="">-- เลือกชื่อของเก่า --</option>';
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<option value='" . $row['product_id'] . "'>" . $row['product_name'] . "</option>";
        }
    } else {
        echo '<option value="">ไม่มีข้อมูล</option>';
    }

    $stmt->close();
}

$conn->close();
?>
