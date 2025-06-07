<?php
// เชื่อมต่อฐานข้อมูล
$conn = new mysqli("localhost", "root", "", "wichian_db");
$conn->set_charset("utf8");

// รับค่าจากฟอร์ม เลือกช่วงเวลา
$range = $_GET['range'] ?? 'month';

// ตั้งเงื่อนไขช่วงเวลา
if ($range == 'today') {
    $condition = "DATE(ordersale_date) = CURDATE()";
} elseif ($range == 'week') {
    $condition = "YEARWEEK(ordersale_date, 1) = YEARWEEK(CURDATE(), 1)";
} elseif ($range == 'month') {
    $condition = "MONTH(ordersale_date) = MONTH(CURDATE()) AND YEAR(ordersale_date) = YEAR(CURDATE())";
} elseif ($range == 'year') {
    $condition = "YEAR(ordersale_date) = YEAR(CURDATE())";
} else {
    $condition = "1";
}

// ดึงข้อมูลยอดขายรายวัน (ไว้ทำกราฟ)
$salesQuery = "SELECT DATE_FORMAT(ordersale_date, '%d-%m-%Y') AS day, SUM(total_price) AS total 
               FROM order_sale 
               WHERE $condition 
               GROUP BY day 
               ORDER BY ordersale_date";

$salesResult = $conn->query($salesQuery);
$labels = [];
$data = [];
while ($row = $salesResult->fetch_assoc()) {
    $labels[] = $row['day'];
    $data[] = $row['total'];
}

// ดึงยอดซื้อ (จาก order_buy)
$buyQuery = "SELECT SUM(d.total_price) AS total_buy 
             FROM orderbuy_detail d 
             JOIN order_buy o ON d.orderbuy_id = o.orderbuy_id 
             WHERE " . str_replace("ordersale_date", "o.orderbuy_date", $condition);
$totalBuy = $conn->query($buyQuery)->fetch_assoc()['total_buy'] ?? 0;

// ดึงยอดขายรวม และกำไรสุทธิ
$totalSale = $conn->query("SELECT SUM(total_price) AS total_sale FROM order_sale WHERE $condition")->fetch_assoc()['total_sale'] ?? 0;
$totalProfit = $conn->query("SELECT SUM(profit) AS net_profit FROM order_sale WHERE $condition")->fetch_assoc()['net_profit'] ?? 0;

// ดึง Top 5 ประเภทสินค้าที่ขายได้มากที่สุด
$topQuery = "SELECT d.type_name, SUM(d.quantity) AS total_qty 
             FROM ordersale_detail d 
             JOIN order_sale o ON d.ordersale_id = o.ordersale_id 
             WHERE $condition 
             GROUP BY d.type_name 
             ORDER BY total_qty DESC 
             LIMIT 5";
$topResult = $conn->query($topQuery);
$topItems = [];
while ($row = $topResult->fetch_assoc()) {
    $topItems[] = $row;
}

// ชื่อหัวข้อช่วงเวลา
$titles = [
    'today' => 'ยอดขายวันนี้',
    'week' => 'ยอดขายสัปดาห์นี้',
    'month' => 'ยอดขายเดือนนี้',
    'year' => 'ยอดขายปีนี้',
    'all' => 'ยอดขายทั้งหมด'
];
?>

<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <title>แดชบอร์ดยอดขาย</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container">
        <?php include '../header_admin.php'; ?>
        <div class="row">
            <div class="col-2">
                <?php include '../menu_admin.php'; ?>
            </div>

            <div class="card mt-3 pb-5 px-4 col-10">
                <h2 class="text-center mb-4">แดชบอร์ดยอดขายของเก่า</h2>

                <!-- ฟอร์มเลือกช่วงเวลา -->
                <form method="GET" class="mb-4 text-center">
                    <label class="fw-bold">เลือกช่วงเวลา: </label>
                    <select name="range" onchange="this.form.submit()" class="form-select d-inline w-auto ms-2">
                        <option value="today" <?= $range == 'today' ? 'selected' : '' ?>>วันนี้</option>
                        <option value="week" <?= $range == 'week' ? 'selected' : '' ?>>สัปดาห์นี้</option>
                        <option value="month" <?= $range == 'month' ? 'selected' : '' ?>>เดือนนี้</option>
                        <option value="year" <?= $range == 'year' ? 'selected' : '' ?>>ปีนี้</option>
                        <option value="all" <?= $range == 'all' ? 'selected' : '' ?>>ทั้งหมด</option>
                    </select>
                </form>

                <!-- แสดงยอดรวม -->
                <div class="row text-center mb-4">
                    <div class="col-md-4">
                        <h5>ยอดซื้อ</h5>
                        <p class="text-success fs-4 fw-bold"><?= number_format($totalBuy, 2) ?> ฿</p>
                    </div>
                    <div class="col-md-4">
                        <h5>ยอดขาย</h5>
                        <p class="text-primary fs-4 fw-bold"><?= number_format($totalSale, 2) ?> ฿</p>
                    </div>
                    <div class="col-md-4">
                        <h5>กำไรสุทธิ</h5>
                        <p class="text-danger fs-4 fw-bold"><?= number_format($totalProfit, 2) ?> ฿</p>
                    </div>
                </div>

                <!-- กราฟยอดขายรายวัน -->
                <h4 class="text-center mt-4"><?= $titles[$range] ?></h4>
                <canvas id="barChart" class="mb-5"></canvas>

                <!-- ตาราง Top 5 -->
                <h4 class="text-center mt-5">Top 5 ประเภทสินค้าที่ขายได้มากที่สุด</h4>
                <table class="table table-bordered table-striped text-center">
                    <thead class="table-dark">
                        <tr>
                            <th>ประเภท</th>
                            <th>จำนวนที่ขาย</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($topItems as $item): ?>
                            <tr>
                                <td><?= htmlspecialchars($item['type_name']) ?></td>
                                <td><?= number_format($item['total_qty']) ?> หน่วย</td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <!-- สคริปต์กราฟ -->
            <script>
                new Chart(document.getElementById('barChart'), {
                    type: 'bar',
                    data: {
                        labels: <?= json_encode($labels) ?>,
                        datasets: [{
                            label: 'ยอดขาย (บาท)',
                            data: <?= json_encode($data) ?>,
                            backgroundColor: '#60a5fa'
                        }]
                    },
                    options: {
                        responsive: true,
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        },
                        plugins: {
                            legend: {
                                display: false
                            }
                        }
                    }
                });
            </script>
</body>

</html>