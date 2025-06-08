<?php
session_start();
include '../condb.php';

if ($conn->connect_error) {
    die("เชื่อมต่อฐานข้อมูลไม่สำเร็จ: " . $conn->connect_error);
}

$date = $_POST['ordersale_date'];
$name = $_POST['name'];
$sale_price = floatval($_POST['sale_price']);
$products = $_POST['products'];

$total_price = 0;
$total_cost = 0;
$total_qty = 0;

$first_product_name = '';

foreach ($products as $p) {
    if (isset($p['checked'])) {
        $qty = floatval($p['qty']);
        $cost = floatval($p['price_per_unit']);
        $total_price += $qty * $sale_price;
        $total_cost += $qty * $cost;
        $total_qty += $qty;
        if ($first_product_name === '') {
            $first_product_name = $p['product_name'];
        }
    }
}

$sql_min = "SELECT minimum_sale FROM product WHERE product_name = '$first_product_name'";
$res_min = $conn->query($sql_min);
$min_row = $res_min->fetch_assoc();
$min_sale_qty = $min_row['minimum_sale'] ?? 0;

if ($total_qty < $min_sale_qty) {
    $conn->close();
    echo "<script>
        alert('❌ ไม่สามารถบันทึกได้ เนื่องจากจำนวนขายรวม ($total_qty กก.) น้อยกว่าขั้นต่ำ ($min_sale_qty กก.)');
        window.location.href = 'cart_sale_emp.php?product_name=" . urlencode($first_product_name) . "';
    </script>";
    exit;
}

$profit = $total_price - $total_cost;

// บันทึกใบขาย
$sql = "INSERT INTO order_sale (ordersale_date, name, total_price, profit)
        VALUES ('$date', '$name', '$total_price', '$profit')";
$conn->query($sql);
$ordersale_id = $conn->insert_id;

// บันทึกรายละเอียด และตัด stock
foreach ($products as $p) {
    if (isset($p['checked'])) {
        $product_name = $p['product_name'];
        $type_name = $p['type_name'];
        $unit = $p['unit'];
        $qty = floatval($p['qty']);
        $cost = floatval($p['price_per_unit']);
        $total = $qty * $sale_price;
        $profit_item = ($sale_price - $cost) * $qty;
        $orderbuy_detail_id = $p['orderbuy_detail_id'];

        $check_stock = $conn->query("SELECT quantity FROM product WHERE product_name = '$product_name'");
        $stock = $check_stock->fetch_assoc();
        $current_stock = $stock['quantity'] ?? 0;

        if ($qty > $current_stock) {
            $conn->close();
            echo "<script>
                alert('❌ ไม่สามารถขาย [$product_name] ได้ เนื่องจาก stock คงเหลือ ($current_stock กก.) ไม่พอขาย ($qty กก.)');
                window.location.href = 'cart_sale_admin.php';
            </script>";
            exit;
        }

        $sql_detail = "INSERT INTO ordersale_detail (
            ordersale_id, product_name, quantity, unit, total_price, type_name,
            price_per_unit, cost_avg, profit
        ) VALUES (
            '$ordersale_id', '$product_name', '$qty', '$unit', '$total', '$type_name',
            '$sale_price', '$cost', '$profit_item'
        )";
        $conn->query($sql_detail);

        $sql_mark_sold = "UPDATE orderbuy_detail SET is_sold = 1 WHERE orderbuy_detail_id = '$orderbuy_detail_id'";
        $conn->query($sql_mark_sold);

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
            window.location.href = 'sale_employee.php';
        });
    </script>
</body>
</html>
