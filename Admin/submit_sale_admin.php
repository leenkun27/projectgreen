<?php
include '../condb.php';

$product_name = $_POST['product_name'] ?? '';
$selected_ids = $_POST['selected_ids'] ?? [];

if (empty($product_name) || empty($selected_ids)) {
    echo "กรุณาเลือกสินค้าที่จะส่งขาย";
    exit();
}

// คำนวณจำนวนรวมที่เลือก
$total_qty = 0;
foreach ($selected_ids as $id) {
    $sql = "SELECT quantity FROM orderbuy_detail WHERE orderbuy_detail_id = $id";
    $result = $conn->query($sql);
    if ($row = $result->fetch_assoc()) {
        $total_qty += $row['quantity'];
    }
}

// อัปเดตสต๊อก (ลดจำนวนใน product)
$sql = "UPDATE product SET quantity = quantity - $total_qty WHERE product_name = '$product_name'";
$conn->query($sql);

// แสดงผลลัพธ์
echo "<h3>ส่งขายเรียบร้อย!</h3>";
echo "<p>สินค้าที่ส่งขาย: <strong>$product_name</strong></p>";
echo "<p>จำนวนที่หักออกจากสต๊อก: <strong>$total_qty</strong> หน่วย</p>";

echo '<a href="sale_admin.php" class="btn btn-primary mt-3">กลับหน้าขาย</a>';
?>
