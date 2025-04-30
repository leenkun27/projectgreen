<?php
include '../condb.php';

$product_id = ltrim($_POST['product_id'], '0'); // เอาศูนย์นำหน้าออกให้หมด
$sell_qty = $_POST['sell_qty'];

$sql_product = "SELECT * FROM product WHERE product_id = '$product_id'";
$result_product = mysqli_query($conn, $sql_product);
$product = mysqli_fetch_assoc($result_product);


if ($product && $sell_qty > 0 && $sell_qty <= $product['quantity']) {
    $product_name = $product['product_name'];
    $unit = $product['unit'];
    $type_name = $product['type_name'];
    $price_per_unit = $product['price_today'];
    $total_price = $price_per_unit * $sell_qty;
    $sale_date = date('Y-m-d');
    $employee_name = 'admin'; 

  
    $sql_sale = "INSERT INTO ordersale (ordersale_date, name, total_price)
                 VALUES ('$sale_date', '$employee_name', '$total_price')";
    mysqli_query($conn, $sql_sale);

 
    $ordersale_id = mysqli_insert_id($conn);

    $sql_detail = "INSERT INTO ordersale_detail (ordersale_id, product_name, quantity, unit, total_price, type_name)
                   VALUES ('$ordersale_id', '$product_name', '$sell_qty', '$unit', '$total_price', '$type_name')";
    mysqli_query($conn, $sql_detail);

   
    $sql_update_stock = "UPDATE product SET quantity = quantity - $sell_qty WHERE product_id = '$product_id'";
    mysqli_query($conn, $sql_update_stock);

    echo "<script>
        alert('ขายสินค้าสำเร็จแล้ว');
        window.location.href = 'sale_admin.php';
    </script>";
    exit();
} else {
    echo "<script>
        alert('ขายไม่ได้: จำนวนไม่ถูกต้อง หรือสินค้าไม่พอขาย');
        history.back();
    </script>";
}
?>
