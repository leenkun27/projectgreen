<?php
include '../condb.php';

$product_name = $_GET['product_name'] ?? '';
if (!$product_name) {
    echo "ไม่พบชื่อของเก่า";
    exit();
}

$sql = "SELECT ob.orderbuy_date, od.orderbuy_detail_id, od.quantity, od.total_price
        FROM orderbuy_detail od
        JOIN order_buy ob ON od.orderbuy_id = ob.orderbuy_id
        WHERE od.product_name = '$product_name'
        ORDER BY ob.orderbuy_date DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>รายการเตรียมส่งขาย</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>

<body>
    <div class="container">
        <?php include '../header_admin.php'; ?>
        <div class="row">
            <div class="col-2">
                <?php include '../menu_admin.php'; ?>
            </div>
            <div class="card mt-3 pb-5 px-2 col-10">
                <h3>ส่งขาย: <?= htmlspecialchars($product_name) ?></h3>

                <form method="post" action="submit_sale_admin.php">
                    <input type="hidden" name="product_name" value="<?= $product_name ?>">

                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>เลือก</th>
                                <th>วันที่รับซื้อ</th>
                                <th>จำนวน (kg)</th>
                                <th>ราคารวม (บาท)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($row = $result->fetch_assoc()): ?>
                                <tr>
                                    <td>
                                        <input type="checkbox" name="selected_ids[]"
                                            value="<?= $row['orderbuy_detail_id'] ?>"
                                            data-qty="<?= $row['quantity'] ?>"
                                            data-price="<?= $row['total_price'] ?>"
                                            onchange="calcAverage()">
                                    </td>
                                    <td><?= $row['orderbuy_date'] ?></td>
                                    <td><?= $row['quantity'] ?></td>
                                    <td><?= number_format($row['total_price'], 2) ?></td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>

                    <p><strong>ราคาเฉลี่ยต่อหน่วย:</strong> <span id="avg">0.00</span> บาท/หน่วย</p>
                    <p><strong>ราคารวมเฉลี่ย:</strong> <span id="sum">0.00</span> บาท</p>

                    <div class="text-end">
                        <a href="sale_admin.php" class="btn btn-secondary me-2">ย้อนกลับ</a>
                        <a href="sale_admin.php" class="btn btn-primary">เพิ่มเข้าตะกร้า</a>
                        <button type="submit" class="btn btn-success">ส่งขาย</button>
                    </div>
                </form>
            </div>

            <script>
                function calcAverage() {
                    let checkboxes = document.querySelectorAll('input[name="selected_ids[]"]:checked');
                    let totalQty = 0;
                    let totalPrice = 0;

                    checkboxes.forEach(cb => {
                        totalQty += parseFloat(cb.getAttribute('data-qty'));
                        totalPrice += parseFloat(cb.getAttribute('data-price'));
                    });

                    let avg = (totalQty > 0) ? (totalPrice / totalQty).toFixed(2) : "0.00";
                    let sum = totalPrice.toFixed(2);

                    document.getElementById('avg').innerText = avg;
                    document.getElementById('sum').innerText = sum;
                }
            </script>
</body>

</html>