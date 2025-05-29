<?php
session_start();
include '../condb.php';

if (!isset($_SESSION['cart']) || count($_SESSION['cart']) == 0) {
    echo "<script>alert('ไม่มีรายการสินค้าในตะกร้า'); window.location.href='buy_admin.php';</script>";
    exit;
}

$orderbuy_date = date("Y-m-d");
$name = isset($_SESSION['name']) ? $_SESSION['name'] : 'ไม่ทราบชื่อ';

$total = 0;

$sql = "INSERT INTO order_buy (orderbuy_date, name) VALUES ('$orderbuy_date', '$name')";
$conn->query($sql);
$orderbuy_id = $conn->insert_id;

foreach ($_SESSION['cart'] as $item) {
    $product_id = $item['product_id'];
    $product_name = $item['product_name'];
    $type_name = $item['type_name'];
    $qty = $item['quantity'];
    $unit = $item['unit'];
    $price = floatval($item['price_today']);
    $sum = $price * $qty;

    $total += $sum;

    $sql_detail = "INSERT INTO orderbuy_detail (
        orderbuy_id, product_name, quantity, unit, total_price, type_name, price_per_unit, is_sold
    ) VALUES (
        '$orderbuy_id', '$product_name', '$qty', '$unit', '$sum', '$type_name', '$price', 0
    )";
    $conn->query($sql_detail);

    // อัปเดตราคา
    $sql_price = "UPDATE product SET price_today = '$price' WHERE product_id = '$product_id'";
    $conn->query($sql_price);

    //เพิ่มจำนวนเข้า stock
    if ($qty > 0) {
        $sql_update_stock = "UPDATE product SET quantity = quantity + $qty WHERE product_id = '$product_id'";
        $conn->query($sql_update_stock);
    }
}

unset($_SESSION['cart']);
?>

<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <title>บันทึกรับซื้อสำเร็จ</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <script>
        Swal.fire({
            icon: 'success',
            title: 'บันทึกเรียบร้อยแล้ว',
            text: 'ข้อมูลการรับซื้อถูกบันทึกแล้ว',
            showCancelButton: true,
            confirmButtonText: 'พิมพ์ใบเสร็จ',
            cancelButtonText: 'กลับหน้ารับซื้อ'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = 'print_receipt.php?orderbuy_id=<?= $orderbuy_id ?>';
            } else {
                window.location.href = 'buy_admin.php';
            }
        });
    </script>

</body>

</html>