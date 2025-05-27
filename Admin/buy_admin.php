
Papitchaya Khampikha
<?php
session_start();

if ($_SESSION['role'] != 'admin') {
    header("Location: ../login.php");
    exit();
}

include '../condb.php';

$current_date = date("d-m-Y");

$type_id = isset($_POST['type']) ? $_POST['type'] : '';
$type_result = $conn->query("SELECT type_id, type_name FROM product_type");


$product_result = $conn->query("
    SELECT p.product_id, p.product_name, p.price_today, p.unit, t.type_name 
    FROM product p 
    LEFT JOIN product_type t ON p.type_id = t.type_id
    WHERE p.type_id = '$type_id'
");


if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['product']) && isset($_POST['quantity']) && isset($_POST['price_today'])) {
    $product_id = intval($_POST['product']);
    $quantity = intval($_POST['quantity']);
    $price = floatval($_POST['price_today']);

   
    $conn->query("UPDATE product SET price_today = $price WHERE product_id = $product_id");

   
    $product_query = $conn->query("
        SELECT p.product_name, p.unit, t.type_name 
        FROM product p 
        LEFT JOIN product_type t ON p.type_id = t.type_id
        WHERE p.product_id = $product_id
    ");

    $product_data = $product_query->fetch_assoc();

    if ($product_data) {
        $product_name = $product_data['product_name'];
        $unit = $product_data['unit'];
        $type_name = $product_data['type_name'];
        $total = $price * $quantity;

        $_SESSION['cart'][] = [
            'product_id' => $product_id,
            'product_name' => $product_name,
            'price_today' => $price,
            'quantity' => $quantity,
            'unit' => $unit,
            'type_name' => $type_name,
            'total' => $total
        ];

        header("Location: buy_admin.php");
        exit();
    }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>รับซื้อสินค้า</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function updatePrice() {
            var productSelect = document.getElementById("product"); 
            var selectedOption = productSelect.options[productSelect.selectedIndex]; 
            var priceField = document.getElementById("price_today"); 
            priceField.value = selectedOption.getAttribute("data-price"); 
        }
    </script>
</head>

<body>
    <div class="container">
        <?php include '../header_admin.php'; ?>
        <div class="row">
            <div class="col-2">
                <?php include '../menu_admin.php'; ?>
            </div>

            <div class="card mt-3 pb-5 px-4 col-10">
                <h2 class="mt-3">🛒 รับซื้อสินค้า</h2>

                <form method="POST" action="">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="purchase_date" class="form-label">วันที่รับซื้อ</label>
                                <input type="date" class="form-control" name="purchase_date" value="<?= date('Y-m-d') ?>" required>
                            </div>

                            <div class="mb-3">
                                <label for="type" class="form-label">เลือกประเภท:</label>
                                <select class="form-control" name="type" id="type" onchange="this.form.submit()">
                                    <option value="">-- เลือกประเภท --</option>
                                    <?php while ($row = $type_result->fetch_assoc()) { ?>
                                        <option value="<?= $row['type_id'] ?>" <?= ($type_id == $row['type_id']) ? 'selected' : '' ?>>
                                            <?= $row['type_name'] ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="quantity" class="form-label">ปริมาณการรับซื้อ:</label>
                                <input type="number" class="form-control" name="quantity" required min="1">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">ชื่อพนักงานที่รับซื้อ:</label>
                                <input type="text" class="form-control" value="<?php echo isset($_SESSION['name']) ? $_SESSION['name'] : 'ไม่พบชื่อ'; ?>" readonly>
                            </div>

                            <div class="mb-3">
                                <label for="product" class="form-label">เลือกชื่อของเก่า:</label>
                                <select class="form-control" name="product" id="product" onchange="updatePrice()">
                                    <option value="">-- เลือกชื่อของเก่า --</option>
                                    <?php while ($row = $product_result->fetch_assoc()) { ?>
                                        <option value="<?= $row['product_id'] ?>" data-price="<?= $row['price_today'] ?>">
                                            <?= $row['product_name'] ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="price_today" class="form-label">ราคาวันนี้:</label>
                                <input type="text" class="form-control" id="price_today" name="price_today" >
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-success">เพิ่ม</button>
                </form>

                <hr>

                <h4 class="mt-4">🛍️ ตะกร้าสินค้า</h4>
                <table class="table table-bordered mt-3">
                    <thead class="table-light">
                        <tr>
                            <th>วันที่รับซื้อ</th>
                            <th>ชื่อสินค้า</th>
                            <th>ประเภทของเก่า</th>
                            <th>จำนวน</th>
                            <th>หน่วย</th>
                            <th>ราคา</th>
                            <th>รวม</th>
                            <th>ลบ</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $grand_total = 0; ?>
                        <?php if (!empty($_SESSION['cart'])): ?>
                            <?php foreach ($_SESSION['cart'] as $index => $item): ?>
                                <tr>
                                    <td><?= date("d-m-Y") ?></td>
                                    <td><?= $item['product_name'] ?></td>
                                    <td><?= $item['type_name'] ?></td>
                                    <td><?= $item['quantity'] ?></td>
                                    <td><?= $item['unit'] ?></td>
                                    <td><?= number_format($item['price_today'], 2) ?></td>
                                    <td><?= number_format($item['total'], 2) ?></td>
                                    <td>
                                        <form method="post" action="remove_item.php">
                                            <input type="hidden" name="index" value="<?= $index ?>">
                                            <button type="submit" class="btn btn-danger btn-sm">ลบ</button>
                                        </form>
                                    </td>
                                </tr>
                                <?php $grand_total += $item['total']; ?>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="8" class="text-center">ไม่มีสินค้าในตะกร้า</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>

                <div class="text-end">
                    <p>ยอดรวมทั้งหมด: <strong><?= number_format($grand_total, 2) ?></strong> บาท</p>
                    <a href="clear_cart.php" class="btn btn-danger">ล้างตะกร้า</a>
                    <a href="save-orderbuy_admin.php" class="btn btn-primary">บันทึก</a>
                </div>
            </div>

</body>
</html>

<?php
$conn->close();
?>
