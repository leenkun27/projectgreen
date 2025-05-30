<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "wichian_db";
$conn = new mysqli($host, $user, $pass, $db);
$conn->set_charset("utf8");

$month = date('m');

$res_buy = $conn->query("SELECT SUM(d.total_price) AS total_buy FROM orderbuy_detail d JOIN order_buy o ON d.orderbuy_id = o.orderbuy_id WHERE MONTH(o.orderbuy_date) = '$month'");
$total_buy = $res_buy->fetch_assoc()['total_buy'] ?? 0;

$res_sale = $conn->query("SELECT SUM(total_price) AS total_sale FROM order_sale WHERE MONTH(ordersale_date) = '$month'");
$total_sale = $res_sale->fetch_assoc()['total_sale'] ?? 0;

$res_profit = $conn->query("SELECT SUM(profit) AS net_profit FROM order_sale WHERE MONTH(ordersale_date) = '$month'");
$net_profit = $res_profit->fetch_assoc()['net_profit'] ?? 0;

$res_chart = $conn->query("SELECT DAY(ordersale_date) AS sale_day, SUM(total_price) AS total FROM order_sale WHERE MONTH(ordersale_date) = '$month' GROUP BY sale_day ORDER BY sale_day");
$labels = $data = [];
while ($row = $res_chart->fetch_assoc()) {
    $labels[] = 'วันที่ ' . $row['sale_day'];
    $data[] = $row['total'];
}

$res_pie = $conn->query("SELECT d.type_name, SUM(d.profit) AS total_profit FROM ordersale_detail d JOIN order_sale o ON d.ordersale_id = o.ordersale_id WHERE MONTH(o.ordersale_date) = '$month' GROUP BY d.type_name ORDER BY total_profit DESC");
$pie_labels = $pie_data = [];
while ($row = $res_pie->fetch_assoc()) {
    $pie_labels[] = $row['type_name'];
    $pie_data[] = $row['total_profit'];
}

$res_bar = $conn->query("SELECT d.type_name, SUM(d.cost_avg * d.quantity) AS total_cost, SUM(d.profit) AS total_profit FROM ordersale_detail d JOIN order_sale o ON d.ordersale_id = o.ordersale_id WHERE MONTH(o.ordersale_date) = '$month' GROUP BY d.type_name");
$bar_labels = $bar_cost = $bar_profit = [];
while ($row = $res_bar->fetch_assoc()) {
    $bar_labels[] = $row['type_name'];
    $bar_cost[] = $row['total_cost'];
    $bar_profit[] = $row['total_profit'];
}

$res_top5 = $conn->query("SELECT d.type_name, SUM(d.quantity) AS total_qty FROM ordersale_detail d JOIN order_sale o ON d.ordersale_id = o.ordersale_id WHERE MONTH(o.ordersale_date) = '$month' GROUP BY d.type_name ORDER BY total_qty DESC LIMIT 5");
$top5_items = [];
while ($row = $res_top5->fetch_assoc()) {
    $top5_items[] = $row;
}

$res_low_stock = $conn->query("SELECT product_name, type_name, quantity, unit FROM orderbuy_detail WHERE quantity <= 10 ORDER BY quantity ASC");
$low_stock_items = [];
while ($row = $res_low_stock->fetch_assoc()) {
    $low_stock_items[] = $row;
}

$thai_months = ["01" => "มกราคม", "02" => "กุมภาพันธ์", "03" => "มีนาคม", "04" => "เมษายน", "05" => "พฤษภาคม", "06" => "มิถุนายน", "07" => "กรกฎาคม", "08" => "สิงหาคม", "09" => "กันยายน", "10" => "ตุลาคม", "11" => "พฤศจิกายน", "12" => "ธันวาคม"];
$month_number = date('m');
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title>แดชบอร์ดร้านของเก่า</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <?php include '../header_admin.php'; ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2 p-0">
                <?php include '../menu_admin.php'; ?>
            </div>
            <div class="col-md-10 pt-4">

                <div class="card p-4 mb-5">
                    <h2 class="text-center mb-4">แดชบอร์ดร้านรับซื้อของเก่า (<?= $thai_months[$month_number] . ' ' . (date('Y') + 543) ?>)</h2>

                    <div class="row text-center mb-4">
                        <div class="col-md-4">
                            <h5>ยอดซื้อ</h5>
                            <p class="text-success fs-4 fw-bold"><?= number_format($total_buy, 2) ?> ฿</p>
                        </div>
                        <div class="col-md-4">
                            <h5>ยอดขาย</h5>
                            <p class="text-primary fs-4 fw-bold"><?= number_format($total_sale, 2) ?> ฿</p>
                        </div>
                        <div class="col-md-4">
                            <h5>กำไรสุทธิ</h5>
                            <p class="text-danger fs-4 fw-bold"><?= number_format($net_profit, 2) ?> ฿</p>
                        </div>
                    </div>

                    <h4 class="text-center mt-4">ยอดขายประจำวันในเดือนนี้</h4>
                    <canvas id="barChart" class="mb-5"></canvas>

                    <h4 class="text-center">ประเภทสินค้าที่ทำกำไรได้มากที่สุด</h4>
                    <div class="d-flex justify-content-center">
                        <canvas id="pieChart" width="300" height="300"></canvas>
                    </div>

                    <h4 class="text-center mt-5">ต้นทุนและกำไรแยกตามประเภท</h4>
                    <canvas id="barChartCostProfit" class="mb-5"></canvas>

                    <h4 class="text-center">รายละเอียดต้นทุนและกำไร</h4>
                    <div class="table-responsive">
                        <table class="table table-bordered table-sm text-center">
                            <thead class="table-light">
                                <tr><th>ประเภท</th><th>ต้นทุนรวม (บาท)</th><th>กำไรรวม (บาท)</th></tr>
                            </thead>
                            <tbody>
                                <?php for ($i = 0; $i < count($bar_labels); $i++): ?>
                                    <tr>
                                        <td><?= htmlspecialchars($bar_labels[$i]) ?></td>
                                        <td><?= number_format($bar_cost[$i], 2) ?></td>
                                        <td><?= number_format($bar_profit[$i], 2) ?></td>
                                    </tr>
                                <?php endfor; ?>
                            </tbody>
                        </table>
                    </div>

                    <h4 class="text-center mt-5">Top 5 ประเภทสินค้าที่ขายได้มากที่สุด</h4>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped text-center">
                            <thead class="table-dark">
                                <tr><th>ประเภท</th><th>จำนวนที่ขาย</th></tr>
                            </thead>
                            <tbody>
                                <?php foreach ($top5_items as $item): ?>
                                    <tr>
                                        <td><?= htmlspecialchars($item['type_name']) ?></td>
                                        <td><?= number_format($item['total_qty']) ?> หน่วย</td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>

                    <h4 class="text-center mt-5 text-danger">สินค้าใกล้หมดสต๊อก</h4>
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover text-center">
                            <thead class="table-warning">
                                <tr><th>ชื่อ</th><th>ประเภท</th><th>คงเหลือ</th><th>หน่วย</th></tr>
                            </thead>
                            <tbody>
                                <?php if (count($low_stock_items) > 0): ?>
                                    <?php foreach ($low_stock_items as $item): ?>
                                        <tr>
                                            <td><?= htmlspecialchars($item['product_name']) ?></td>
                                            <td><?= htmlspecialchars($item['type_name']) ?></td>
                                            <td><?= $item['quantity'] ?></td>
                                            <td><?= $item['unit'] ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr><td colspan="4" class="text-muted">ไม่มีรายการ</td></tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <script>
        new Chart(document.getElementById('barChart'), {
            type: 'bar',
            data: {
                labels: <?= json_encode($labels) ?>,
                datasets: [{ label: 'ยอดขาย (บาท)', data: <?= json_encode($data) ?>, backgroundColor: '#60a5fa' }]
            },
            options: { responsive: true, plugins: { legend: { display: false } }, scales: { y: { beginAtZero: true } } }
        });

        new Chart(document.getElementById('pieChart'), {
            type: 'pie',
            data: {
                labels: <?= json_encode($pie_labels) ?>,
                datasets: [{ data: <?= json_encode($pie_data) ?>, backgroundColor: ['#f87171', '#34d399', '#60a5fa', '#facc15', '#a78bfa', '#fb923c'] }]
            },
            options: { responsive: false, plugins: { legend: { position: 'bottom' } } }
        });

        new Chart(document.getElementById('barChartCostProfit'), {
            type: 'bar',
            data: {
                labels: <?= json_encode($bar_labels) ?>,
                datasets: [
                    { label: 'ต้นทุน (บาท)', data: <?= json_encode($bar_cost) ?>, backgroundColor: '#facc15' },
                    { label: 'กำไร (บาท)', data: <?= json_encode($bar_profit) ?>, backgroundColor: '#34d399' }
                ]
            },
            options: { responsive: true, plugins: { legend: { position: 'bottom' } }, scales: { y: { beginAtZero: true } } }
        });
    </script>
</body>
</html>
