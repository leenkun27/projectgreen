<?php
include '../condb.php';

function buildWhereClause($column, $time_range) {
    $today = date('Y-m-d');
    switch ($time_range) {
        case 'today':
            return "DATE($column) = CURDATE()";
        case 'week':
            return "YEARWEEK($column, 1) = YEARWEEK(CURDATE(), 1)";
        case 'month':
            return "MONTH($column) = MONTH(CURDATE()) AND YEAR($column) = YEAR(CURDATE())";
        case 'year':
            return "YEAR($column) = YEAR(CURDATE())";
        default:
            return '1';
    }
}

$type_filter = $_GET['type'] ?? '';
$product_filter = $_GET['product'] ?? '';
$range = $_GET['range'] ?? 'all';

$where_buy = buildWhereClause('ob.orderbuy_date', $range);
$where_sale = buildWhereClause('os.ordersale_date', $range);

if ($type_filter) {
    $where_buy .= " AND od.type_name = '$type_filter'";
    $where_sale .= " AND sd.type_name = '$type_filter'";
}

if ($product_filter) {
    $where_buy .= " AND od.product_name = '$product_filter'";
    $where_sale .= " AND sd.product_name = '$product_filter'";
}

$type_result = $conn->query("SELECT DISTINCT type_name FROM product_type");
$product_result = $conn->query("SELECT DISTINCT product_name FROM product");
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title>ประวัติการรับซื้อและขายออก</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
</head>
<body>
<div class="container mt-4">
    <?php include '../header_admin.php'; ?>
    <div class="row">
        <div class="col-2"><?php include '../menu_admin.php'; ?></div>

        <div class="col-10">
            <h3>ประวัติการซื้อขาย</h3>

            <form method="get" class="row g-3 mb-3">
                <div class="col-md-3">
                    <label class="form-label">ช่วงเวลา:</label>
                    <select class="form-select" name="range" onchange="this.form.submit()">
                        <option value="today" <?= $range == 'today' ? 'selected' : '' ?>>วันนี้</option>
                        <option value="week" <?= $range == 'week' ? 'selected' : '' ?>>สัปดาห์นี้</option>
                        <option value="month" <?= $range == 'month' ? 'selected' : '' ?>>เดือนนี้</option>
                        <option value="year" <?= $range == 'year' ? 'selected' : '' ?>>ปีนี้</option>
                        <option value="all" <?= $range == 'all' ? 'selected' : '' ?>>ทั้งหมด</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label">ประเภท:</label>
                    <select class="form-select" name="type" onchange="this.form.submit()">
                        <option value="">ทั้งหมด</option>
                        <?php while ($row = $type_result->fetch_assoc()) {
                            $selected = $type_filter == $row['type_name'] ? 'selected' : '';
                            echo "<option value='{$row['type_name']}' $selected>{$row['type_name']}</option>";
                        } ?>
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label">ชื่อของเก่า:</label>
                    <select class="form-select" name="product" onchange="this.form.submit()">
                        <option value="">ทั้งหมด</option>
                        <?php while ($row = $product_result->fetch_assoc()) {
                            $selected = $product_filter == $row['product_name'] ? 'selected' : '';
                            echo "<option value='{$row['product_name']}' $selected>{$row['product_name']}</option>";
                        } ?>
                    </select>
                </div>
            </form>

            <!-- Tabs -->
            <ul class="nav nav-tabs mt-2" id="tabMenu" role="tablist">
                <li class="nav-item">
                    <button class="nav-link active" id="buy-tab" data-bs-toggle="tab" data-bs-target="#buy" type="button" role="tab">รับซื้อ</button>
                </li>
                <li class="nav-item">
                    <button class="nav-link" id="sale-tab" data-bs-toggle="tab" data-bs-target="#sale" type="button" role="tab">ขายออก</button>
                </li>
            </ul>
            <br>

            <div class="tab-content" id="tabContent">
                <!-- Buy Table -->
                <div class="tab-pane fade show active" id="buy" role="tabpanel">
                    <table class="table table-bordered table-striped mt-3" id="buyTable">
                        <thead class="table-light">
                            <tr>
                                <th>วันที่รับซื้อ</th>
                                <th>ชื่อของเก่า</th>
                                <th>ประเภท</th>
                                <th>จำนวน</th>
                                <th>หน่วย</th>
                                <th>ราคาต่อหน่วย</th>
                                <th>ราคารวม</th>
                                <th>พนักงาน</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sum_buy = 0;
                            $sql_buy = "SELECT ob.orderbuy_date, od.product_name, od.type_name, od.quantity, od.unit, od.price_per_unit, od.total_price, ob.name
                                        FROM orderbuy_detail od
                                        JOIN order_buy ob ON od.orderbuy_id = ob.orderbuy_id
                                        WHERE $where_buy";
                            $result = $conn->query($sql_buy);
                            while ($row = $result->fetch_assoc()) {
                                $sum_buy += $row['total_price'];
                                echo "<tr>
                                    <td>" . date('d/m/Y', strtotime($row['orderbuy_date'])) . "</td>
                                    <td>{$row['product_name']}</td>
                                    <td>{$row['type_name']}</td>
                                    <td>{$row['quantity']}</td>
                                    <td>{$row['unit']}</td>
                                    <td>" . number_format($row['price_per_unit'], 2) . "</td>
                                    <td>" . number_format($row['total_price'], 2) . "</td>
                                    <td>{$row['name']}</td>
                                </tr>";
                            }
                            ?>
                        </tbody>
                        <tfoot>
                            <tr class="table-info fw-bold">
                                <td colspan="6" class="text-end">รวมยอดรับซื้อ:</td>
                                <td><?= number_format($sum_buy, 2) ?></td>
                                <td>บาท</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>

                <!-- Sale Table -->
                <div class="tab-pane fade" id="sale" role="tabpanel">
                    <table class="table table-bordered table-striped mt-3" id="saleTable">
                        <thead class="table-light">
                            <tr>
                                <th>วันที่ขาย</th>
                                <th>ชื่อของเก่า</th>
                                <th>ประเภท</th>
                                <th>จำนวน</th>
                                <th>หน่วย</th>
                                <th>ราคาขาย</th>
                                <th>ต้นทุนเฉลี่ย</th>
                                <th>กำไร</th>
                                <th>รวม</th>
                                <th>พนักงาน</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sum_sale = 0;
                            $sum_profit = 0;
                            $sql_sale = "SELECT os.ordersale_date, sd.product_name, sd.type_name, sd.quantity, sd.unit, sd.price_per_unit, sd.cost_avg, sd.profit, sd.total_price, os.name
                                        FROM ordersale_detail sd
                                        JOIN order_sale os ON sd.ordersale_id = os.ordersale_id
                                        WHERE $where_sale";
                            $result = $conn->query($sql_sale);
                            while ($row = $result->fetch_assoc()) {
                                $sum_sale += $row['total_price'];
                                $sum_profit += $row['profit'];
                                echo "<tr>
                                    <td>" . date('d/m/Y', strtotime($row['ordersale_date'])) . "</td>
                                    <td>{$row['product_name']}</td>
                                    <td>{$row['type_name']}</td>
                                    <td>{$row['quantity']}</td>
                                    <td>{$row['unit']}</td>
                                    <td>" . number_format($row['price_per_unit'], 2) . "</td>
                                    <td>" . number_format($row['cost_avg'], 2) . "</td>
                                    <td>" . number_format($row['profit'], 2) . "</td>
                                    <td>" . number_format($row['total_price'], 2) . "</td>
                                    <td>{$row['name']}</td>
                                </tr>";
                            }
                            ?>
                        </tbody>
                        <tfoot>
                            <tr class="table-success fw-bold">
                                <td colspan="7" class="text-end">รวมกำไร:</td>
                                <td><?= number_format($sum_profit, 2) ?></td>
                                <td colspan="2">บาท</td>
                            </tr>
                            <tr class="table-info fw-bold">
                                <td colspan="7" class="text-end">รวมยอดขาย:</td>
                                <td><?= number_format($sum_sale, 2) ?></td>
                                <td colspan="2">บาท</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
<script>
    $(document).ready(function () {
        $('#buyTable, #saleTable').DataTable({
            pageLength: 10,
            language: {
                search: "ค้นหา:",
                lengthMenu: "แสดง _MENU_ รายการ",
                zeroRecords: "ไม่พบข้อมูล",
                info: "แสดง _START_ ถึง _END_ จาก _TOTAL_ รายการ",
                paginate: {
                    first: "หน้าแรก",
                    last: "หน้าสุดท้าย",
                    next: "ถัดไป",
                    previous: "ก่อนหน้า"
                }
            }
        });
    });
</script>
</body>
</html>
