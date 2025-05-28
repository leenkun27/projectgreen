<?php
session_start();
include '../condb.php';

if ($conn->connect_error) {
    die("เชื่อมต่อฐานข้อมูลไม่สำเร็จ: " . $conn->connect_error);
}

$date = $_POST['ordersale_date'];
$name = $_POST['name'];
$sale_price = $_POST['sale_price'];
$products = $_POST['products'];

$total_price = 0;
$total_cost = 0;
$total_qty = 0;
$product_name = '';

foreach ($products as $p) {
    if (isset($p['checked'])) {
        $qty = $p['qty'];
        $cost = $p['price_per_unit'];
        $total_price += $qty * $sale_price;
        $total_cost += $qty * $cost;
        $total_qty += $qty;
        $product_name = $p['product_name'];
    }
}

$sql_min = "SELECT minimum_sale FROM product WHERE product_name = '$product_name'";
$res_min = $conn->query($sql_min);
$min_row = $res_min->fetch_assoc();
$min_sale_qty = $min_row['minimum_sale'] ?? 0;

if ($total_qty < $min_sale_qty) {
    echo "<script>
        alert('❌ ไม่สามารถบันทึกได้ เนื่องจากจำนวนขายรวม ($total_qty กก.) น้อยกว่าขั้นต่ำ ($min_sale_qty กก.)');
        window.location.href = 'cart_sale_admin.php?product_name=" . urlencode($product_name) . "';
    </script>";
    exit;
}

$profit = $total_price - $total_cost;

$sql = "INSERT INTO order_sale (ordersale_date, name, total_price, profit)
        VALUES ('$date', '$name', '$total_price', '$profit')";
$conn->query($sql);
$ordersale_id = $conn->insert_id;

foreach ($products as $p) {
    if (isset($p['checked'])) {
        $product_name = $p['product_name'];
        $type_name = $p['type_name'];
        $unit = $p['unit'];
        $qty = $p['qty'];
        $cost = $p['price_per_unit'];
        $total = $qty * $sale_price;
        $profit_item = ($sale_price - $cost) * $qty;

        $sql_detail = "INSERT INTO ordersale_detail (
            ordersale_id, product_name, quantity, unit, total_price, type_name,
            price_per_unit, cost_avg, profit
        ) VALUES (
            '$ordersale_id', '$product_name', '$qty', '$unit', '$total', '$type_name',
            '$sale_price', '$cost', '$profit_item'
        )";
        $conn->query($sql_detail);

        // อัปเดตว่าออเดอร์นั้นขายแล้ว
        $orderbuy_detail_id = $p['orderbuy_detail_id'];
        $sql_mark_sold = "UPDATE orderbuy_detail SET is_sold = 1 WHERE orderbuy_detail_id = '$orderbuy_detail_id'";
        $conn->query($sql_mark_sold);

        // ตัด stock ออกจาก product
        $sql_stock = "UPDATE product SET quantity = quantity - $qty WHERE product_name = '$product_name'";
        $conn->query($sql_stock);
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title>ส่งขายเรียบร้อยแล้ว</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <script>
        Swal.fire({
            icon: 'success',
            title: 'ส่งขายเรียบร้อยแล้ว',
            text: 'ข้อมูลถูกบันทึกเรียบร้อย',
            confirmButtonText: 'กลับหน้าหลัก'
        }).then(() => {
            window.location.href = 'sale_admin.php';
        });
    </script>
</body>
</html>
