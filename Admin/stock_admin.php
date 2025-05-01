<?php
include '../condb.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ข้อมูลสินค้า</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
    <style>
        .status-icon {
            font-size: 1.2em;
        }

        .status-icon i {
            margin-right: 5px;
        }

        .card-stat {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 20px;
            margin-bottom: 20px;
            border-radius: 8px;
        }

        .card-stat.green {
            background-color: #e0f7ea;
            color: #2e7d32;
        }

        .card-stat.purple {
            background-color: #ede7f6;
            color: #6a1b9a;
        }

        .card-stat.orange {
            background-color: #fff3e0;
            color: #e65100;
        }

        .card-stat.red {
            background-color: #ffebee;
            color: #b71c1c;
        }
    </style>
</head>

<body>

    <div class="container">
        <?php include '../header_admin.php'; ?>
        <div class="row">
            <div class="col-2">
                <?php include '../menu_admin.php'; ?>
            </div>
            <div class="card mt-3 pb-5 px-2 col-10">
                <div class="container my-4">
                    <h2>ข้อมูลสินค้าในคลัง</h2>

                    <div class="table-responsive mt-3">
                        <table id="productTable" class="table table-bordered table-striped">
                            <thead class="table-light">
                                <tr>
                                    <th scope="col">ลำดับ</th>
                                    <th scope="col">รหัสสินค้า</th>
                                    <th scope="col">รูปภาพ</th>
                                    <th scope="col">ชื่อของเก่า</th>
                                    <th scope="col">ประเภทของเก่า</th>
                                    <th scope="col">จำนวนคงเหลือ</th>
                                    <th scope="col">ราคาเฉลี่ย/หน่วย</th>
                                    <th scope="col">หน่วย</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $sql = "SELECT 
                                LPAD(p.product_id, 6, '0') AS product_id, 
                                p.product_name, 
                                p.price_today, 
                                p.cost_price, 
                                p.quantity, 
                                t.type_name, 
                                p.product_img, 
                                p.unit,
                                ROUND(SUM(od.total_price) / SUM(od.quantity), 2) AS price_per_unit
                            FROM product p
                            LEFT JOIN product_type t ON p.type_id = t.type_id
                            LEFT JOIN orderbuy_detail od ON p.product_name = od.product_name
                            GROUP BY p.product_id";
                                $result = $conn->query($sql);

                                if ($result->num_rows > 0) {
                                    $index = 1;
                                    while ($row = $result->fetch_assoc()) {
                                ?>
                                        <tr>
                                            <th scope="row"><?= $index++ ?></th>
                                            <td><?= $row['product_id'] ?></td>
                                            <td><img src="<?= $row['product_img'] ?>" alt="product" class="img-fluid" width="100"></td>
                                            <td><?= $row['product_name'] ?></td>
                                            <td><?= $row['type_name'] ?></td>
                                            <td><?= $row['quantity'] ?></td>
                                            <td><?= $row['price_per_unit'] ?></td>
                                            <td><?= $row['unit'] ?></td>
                                        </tr>
                                    <?php
                                    }
                                } else {
                                    ?>
                                    <tr>
                                        <td colspan="6">ไม่มีข้อมูล</td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#productTable').DataTable({
                "paging": true,
                "searching": true,
                "ordering": true,
                "info": true,
                "language": {
                    "lengthMenu": "แสดง MENU รายการต่อหน้า",
                    "zeroRecords": "ไม่พบข้อมูล",
                    "infoEmpty": "ไม่มีข้อมูลที่จะแสดง",
                    "infoFiltered": "(กรองจากทั้งหมด MAX รายการ)",
                    "search": "ค้นหา:",
                    "paginate": {
                        "first": "หน้าแรก",
                        "last": "หน้าสุดท้าย",
                        "next": "ถัดไป",
                        "previous": "ก่อนหน้า"
                    }
                }
            });
        });
    </script>
</body>

</html>

<?php
$conn->close();
?>