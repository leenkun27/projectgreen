<?php
include '../condb.php';

$type_filter = $_GET['type'] ?? '';
$name_filter = $_GET['name'] ?? '';

$where = [];
if (!empty($type_filter)) {
    $where[] = "t.type_name = '$type_filter'";
}
if (!empty($name_filter)) {
    $where[] = "p.product_name = '$name_filter'";
}
$where_clause = count($where) > 0 ? "WHERE " . implode(" AND ", $where) : "";
?>

<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <title>ข้อมูลสินค้าในคลัง</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
</head>

<body>

    <div class="container mt-4">
        <?php include '../header_emp.php'; ?>
        <div class="row">
            <div class="col-2">
                <?php include '../menu_emp.php'; ?>
            </div>

            <div class="card mt-3 pb-5 px-4 col-10">
                <h2 class="mt-3">🗃️ ข้อมูลสินค้าในคลัง</h2>
                <form method="get" class="row g-3 mt-2 mb-4">
                    <div class="col-md-4">
                        <label>ประเภทของเก่า:</label>
                        <select name="type" class="form-select">
                            <option value="">-- แสดงทั้งหมด --</option>
                            <?php
                            $type_result = $conn->query("SELECT DISTINCT type_name FROM product_type");
                            while ($t = $type_result->fetch_assoc()) {
                                $selected = $t['type_name'] == $type_filter ? 'selected' : '';
                                echo "<option value='{$t['type_name']}' $selected>{$t['type_name']}</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label>ชื่อของเก่า:</label>
                        <select name="name" class="form-select">
                            <option value="">-- แสดงทั้งหมด --</option>
                            <?php
                            $name_result = $conn->query("SELECT DISTINCT product_name FROM product");
                            while ($n = $name_result->fetch_assoc()) {
                                $selected = $n['product_name'] == $name_filter ? 'selected' : '';
                                echo "<option value='{$n['product_name']}' $selected>{$n['product_name']}</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-md-4 d-flex align-items-end">
                        <button type="submit" class="btn btn-primary">ค้นหา</button>
                        <a href="stock_employee.php" class="btn btn-secondary ms-2">รีเซ็ต</a>
                    </div>
                </form>

                <table id="productTable" class="table table-bordered table-striped mt-3">
                    <thead class="table-light">
                        <tr>
                            <th>ลำดับ</th>
                            <th>รหัสสินค้า</th>
                            <th>รูปภาพ</th>
                            <th>ชื่อของเก่า</th>
                            <th>ประเภท</th>
                            <th>หน่วย</th>
                            <th>จำนวนคงเหลือ</th>
                            <th>ราคาเฉลี่ย/หน่วย</th>
                            <!-- <th>สถานะ</th> -->
                            <th>จัดการ</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = "SELECT 
                                p.product_id, p.product_name, p.product_img, p.price_today, p.quantity, p.unit,
                                t.type_name,
                                ROUND(SUM(od.total_price)/SUM(od.quantity), 2) AS price_per_unit,
                                MAX(ob.orderbuy_date) AS latest_date
                            FROM product p
                            LEFT JOIN product_type t ON p.type_id = t.type_id
                            LEFT JOIN orderbuy_detail od ON od.product_name = p.product_name
                            LEFT JOIN order_buy ob ON od.orderbuy_id = ob.orderbuy_id
                            $where_clause
                            GROUP BY p.product_id";

                        $result = $conn->query($sql);
                        $i = 1;

                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>" . $i++ . "</td>";
                                echo "<td>" . str_pad($row['product_id'], 6, "0", STR_PAD_LEFT) . "</td>";
                                echo "<td><img src='" . $row['product_img'] . "' width='80'></td>";
                                echo "<td>{$row['product_name']}</td>";
                                echo "<td>{$row['type_name']}</td>";
                                echo "<td>{$row['unit']}</td>";
                                echo "<td>{$row['quantity']}</td>";
                                echo "<td>" . number_format($row['price_per_unit'], 2) . "</td>";
                                echo "<td>
                                    <a href='product-buy_history.php?product_id={$row['product_id']}' class='btn btn-sm btn-info'>
                                        <i class='bi bi-clock-history'></i> ประวัติ
                                    </a>
                                  </td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='12'>ไม่มีข้อมูล</td></tr>";
                        }
                        $conn->close();
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#productTable').DataTable({
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