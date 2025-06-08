<?php
$conn = new mysqli("localhost", "root", "", "wichian_db");
$conn->set_charset("utf8");

if (isset($_GET['range'])) {
    $range = $_GET['range'];
} else {
    $range = 'month';
}

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


$salesQuery = "SELECT DATE_FORMAT(ordersale_date, '%d-%m-%Y') AS day, SUM(total_price) AS total 
               FROM order_sale 
               WHERE $condition 
               GROUP BY day 
               ORDER BY ordersale_date";

$salesResult = $conn->query($salesQuery);
$labels = array();
$data = array();

while ($row = $salesResult->fetch_row()) {
    $labels[] = $row[0]; 
    $data[] = $row[1];  
}

$buyQuery = "SELECT SUM(d.total_price) 
             FROM orderbuy_detail d 
             JOIN order_buy o ON d.orderbuy_id = o.orderbuy_id 
             WHERE " . str_replace("ordersale_date", "o.orderbuy_date", $condition);
$buyResult = $conn->query($buyQuery);
$buyRow = $buyResult->fetch_row();
$totalBuy = $buyRow[0];

if ($totalBuy == null) {
    $totalBuy = 0;
}

$saleResult = $conn->query("SELECT SUM(total_price) FROM order_sale WHERE $condition");
$saleRow = $saleResult->fetch_row();
$totalSale = $saleRow[0];

if ($totalSale == null) {
    $totalSale = 0;
}

$profitResult = $conn->query("SELECT SUM(profit) FROM order_sale WHERE $condition");
$profitRow = $profitResult->fetch_row();
$totalProfit = $profitRow[0];

if ($totalProfit == null) {
    $totalProfit = 0;
}

$topQuery = "SELECT d.type_name, SUM(d.quantity) 
             FROM ordersale_detail d 
             JOIN order_sale o ON d.ordersale_id = o.ordersale_id 
             WHERE $condition 
             GROUP BY d.type_name 
             ORDER BY SUM(d.quantity) DESC 
             LIMIT 5";

$topResult = $conn->query($topQuery);
$topItems = array();

while ($row = $topResult->fetch_row()) {
    $item = array();
    $item['type_name'] = $row[0];
    $item['total_qty'] = $row[1];
    $topItems[] = $item;
}

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


                <h4 class="text-center mt-4"><?= $titles[$range] ?></h4>
                <canvas id="barChart" class="mb-5"></canvas>


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