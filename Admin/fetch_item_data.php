<?php
include '../condb.php';
if (isset($_POST['p_name'])) {
    $p_name = $_POST['p_name'];

    // ตรวจสอบข้อมูลที่ได้รับมา
    error_log("Received p_name: " . $p_name);

    // เตรียมคำสั่ง SQL เพื่อตรวจสอบชื่อของเก่าในฐานข้อมูล
    $stmt = $pdo->prepare("SELECT * FROM tbl_product WHERE p_name = :p_name");
    $stmt->execute(['p_name' => $p_name]);
    $item = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($item) {
        echo json_encode([
            'success' => true,
            'type' => $item['p_type'],
            'quantity' => $item['p_qty'],
            'price' => $item['p_price']
        ]);
    } else {
        echo json_encode(['success' => false]);
    }
}
?>
