<?php
include '../condb.php';

$product_id = $_GET['product_id'] ?? '';

if ($product_id == '') {
    echo "ไม่พบรหัสสินค้า";
    exit;
}

$product_sql = "SELECT product_name FROM product WHERE product_id = '$product_id'";
$product_result = $conn->query($product_sql);
$product = $product_result->fetch_assoc();
$product_name = $product['product_name'] ?? 'ไม่พบชื่อสินค้า';

$buy_sql = "SELECT ob.orderbuy_date, od.quantity, od.price_per_unit, od.total_price, ob.name
            FROM orderbuy_detail od
            JOIN order_buy ob ON od.orderbuy_id = ob.orderbuy_id
            WHERE od.product_name = '$product_name'
            ORDER BY ob.orderbuy_date DESC";
$buy_result = $conn->query($buy_sql);

$sale_sql = "SELECT os.ordersale_date, sd.quantity, sd.price_per_unit, sd.cost_avg, sd.total_price, sd.profit, os.name
             FROM ordersale_detail sd
             JOIN order_sale os ON sd.ordersale_id = os.ordersale_id
             WHERE sd.product_name = '$product_name'
             ORDER BY os.ordersale_date DESC";
$sale_result = $conn->query($sale_sql);
?>

<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <title>ประวัติสินค้า</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-4">
        <?php include '../header_emp.php'; ?>
        <div class="row">
            <div class="col-2">
                <?php include '../menu_emp.php'; ?>
            </div>
            <div class="card col-10 pt-3 px-3 pb-5">
                <h4>ประวัติสินค้า: <?= htmlspecialchars($product_name) ?></h4>

                <ul class="nav nav-tabs" id="historyTab" role="tablist">
                    <li class="nav-item">
                        <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#buy" type="button" role="tab">ประวัติรับซื้อ</button>
                    </li>
                    <li class="nav-item">
                        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#sale" type="button" role="tab">ประวัติขายออก</button>
                    </li>
                </ul>

                <div class="tab-content mt-3" id="historyTabContent">

                    <div class="tab-pane fade show active" id="buy" role="tabpanel">
                        <table class="table table-bordered table-striped">
                            <thead class="table-light">
                                <tr>
                                    <th>วันที่รับซื้อ</th>
                                    <th>จำนวน</th>
                                    <th>ราคาต่อหน่วย (บาท)</th>
                                    <th>ราคารวม (บาท)</th>
                                    <th>พนักงานรับซื้อ</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if ($buy_result->num_rows > 0) {
                                    while ($row = $buy_result->fetch_assoc()) {
                                        $ppu = ($row['price_per_unit'] > 0) ? $row['price_per_unit'] : ($row['quantity'] > 0 ? $row['total_price'] / $row['quantity'] : 0);
                                        $raw = $row['orderbuy_date'];
                                        $show = $raw ? date('d/m/Y', strtotime($raw)) : '-';
                                        echo "<tr>";
                                        echo "<td data-order='$raw'>$show</td>";
                                        echo "<td>{$row['quantity']}</td>";
                                        echo "<td>" . number_format($ppu, 2) . "</td>";
                                        echo "<td>" . number_format($row['total_price'], 2) . "</td>";
                                        echo "<td>{$row['name']}</td>";
                                        echo "</tr>";
                                    }
                                } else {
                                    echo "<tr><td colspan='5'>ไม่มีประวัติการรับซื้อ</td></tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>

                    <div class="tab-pane fade" id="sale" role="tabpanel">
                        <table class="table table-bordered table-striped">
                            <thead class="table-light">
                                <tr>
                                    <th>วันที่ขาย</th>
                                    <th>จำนวน</th>
                                    <th>ราคาขาย/หน่วย</th>
                                    <th>ต้นทุน/หน่วย</th>
                                    <th>ราคารวม</th>
                                    <th>กำไร</th>
                                    <th>ผู้ทำรายการ</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $total_profit = 0;

                                if ($sale_result->num_rows > 0) {
                                    while ($row = $sale_result->fetch_assoc()) {
                                        $raw = $row['ordersale_date'];
                                        $show = $raw ? date('d/m/Y', strtotime($raw)) : '-';

                                        $qty = $row['quantity'];
                                        $sale_price = $row['price_per_unit'];
                                        $cost = $row['cost_avg'];
                                        $total = $row['total_price'];

                                        if ($cost <= 0 && $qty > 0) {
                                            $cost = ($total > 0 && $sale_price > 0) ? $sale_price - ($row['profit'] / $qty) : 0;
                                        }

                                        $profit = $row['profit'] ?? (($sale_price - $cost) * $qty);
                                        $total_profit += $profit;
                                        echo "<tr>";
                                        echo "<td data-order='$raw'>$show</td>";
                                        echo "<td>{$qty}</td>";
                                        echo "<td>" . number_format($sale_price, 2) . "</td>";
                                        echo "<td>" . number_format($cost, 2) . "</td>";
                                        echo "<td>" . number_format($total, 2) . "</td>";
                                        echo "<td>" . number_format($profit, 2) . "</td>";
                                        echo "<td>{$row['name']}</td>";
                                        echo "</tr>";
                                    }
                                } else {
                                    echo "<tr><td colspan='7'>ไม่มีประวัติการขาย</td></tr>";
                                }
                                ?>
                            </tbody>

                        </table>
                        <?php if ($sale_result->num_rows > 0): ?>
                            <tfoot>
                                <tr class="table-success fw-bold">
                                    <td colspan="5" class="text-end">กำไรรวมทั้งหมด:</td>
                                    <td><?= number_format($total_profit, 2) ?> บาท</td>
                                    <td></td>
                                </tr>
                            </tfoot>
                        <?php endif; ?>
                    </div>
                    <a href="stock_emp.php" class="btn btn-secondary btn-sm mt-3">ย้อนกลับ</a>
                </div>

                
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>