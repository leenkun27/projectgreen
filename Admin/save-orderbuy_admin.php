<?php
session_start();
include '../condb.php';

if (!empty($_SESSION['cart'])) {
    $order_date = date("Y-m-d");
    $username = $_SESSION['username'];

    $query = "SELECT name FROM users WHERE username = '$username'";
    $result = $conn->query($query);
    $row = $result->fetch_assoc();
    $employee_name = $row['name'];

    $total_price = 0;
    foreach ($_SESSION['cart'] as $item) {
        $total_price += ($item['price_today'] * $item['quantity']);
    }

    $sql_order = "INSERT INTO order_buy (name, orderbuy_date, total_price) 
                  VALUES ('$employee_name', '$order_date', '$total_price')";

    if ($conn->query($sql_order)) {
        $orderbuy_id = $conn->insert_id;

        foreach ($_SESSION['cart'] as $item) {
            $product_id = $item['product_id'];
            $product_name = $item['product_name'];
            $quantity = $item['quantity'];
            $unit = $item['unit'];
            $price_today = $item['price_today'];
            $total_item_price = $price_today * $quantity;
            $type_name = isset($item['type_name']) ? $item['type_name'] : 'ไม่ระบุ';

            $sql_detail = "INSERT INTO orderbuy_detail (orderbuy_id, product_name, quantity, unit, total_price, type_name) 
                           VALUES ('$orderbuy_id', '$product_name', '$quantity', '$unit', '$total_item_price', '$type_name')";
            $conn->query($sql_detail);

            $sql_update_product = "UPDATE product SET quantity = quantity + $quantity WHERE product_id = '$product_id'";
            if (!$conn->query($sql_update_product)) {
                die("เกิดข้อผิดพลาดในการอัปเดตสต็อกสินค้า: " . $conn->error);
            }
        }

        unset($_SESSION['cart']);

        // ✅ แสดง SweetAlert2 หลังจากบันทึกเสร็จ
?>
        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <title>บันทึกสำเร็จ</title>
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        </head>

        <body>
            <script>
                Swal.fire({
                    icon: 'success',
                    title: 'บันทึกข้อมูลสำเร็จ',
                    text: 'อัปเดตสต็อกสินค้าเรียบร้อยแล้ว',
                    confirmButtonText: 'พิมพ์ใบเสร็จ',
                    showCancelButton: true,
                    cancelButtonText: 'กลับหน้าหลัก'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = 'print_receipt.php';
                    } else if (result.dismiss === Swal.DismissReason.cancel) {
                        window.location.href = 'buy_admin.php';
                    }
                });
            </script>

        </body>

        </html>
    <?php
        exit();
    } else {
        // บันทึก order_buy ไม่สำเร็จ
    ?>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            Swal.fire({
                icon: 'error',
                title: 'เกิดข้อผิดพลาด',
                text: 'ไม่สามารถบันทึกคำสั่งซื้อได้',
            }).then(() => {
                window.location.href = 'buy_admin.php';
            });
        </script>
    <?php
        exit();
    }
} else {
    // ตะกร้าว่าง
    ?>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        Swal.fire({
            icon: 'warning',
            title: 'ไม่มีสินค้าในตะกร้า',
            text: 'กรุณาเพิ่มสินค้าเข้าตะกร้าก่อน',
        }).then(() => {
            window.location.href = 'buy_admin.php';
        });
    </script>
<?php
    exit();
}
?>