<?php session_start(); ?>
<?php include '../condb.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>หน้าขายสินค้า</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
                    <h2 class="mt-3">🚚 ส่งขายสินค้า</h2>
                    <div class="table-responsive mt-3">
                        <table id="productTable" class="table table-bordered table-striped">
                            <thead class="table-light">
                                <tr>
                                    <th scope="col">ลำดับ</th>
                                    <th scope="col">รูปภาพ</th>
                                    <th scope="col">ชื่อของเก่า</th>
                                    <th scope="col">ประเภทของเก่า</th>
                                    <th scope="col">ราคา/หน่วย</th>
                                    <th scope="col">จำนวนคงเหลือ</th>
                                    <th scope="col">จำนวนขายขั้นต่ำ</th>
                                    <th scope="col">ส่งขาย</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $sql = "SELECT 
                                            p.product_id,
                                            p.product_name, 
                                            p.price_today, 
                                            p.cost_price, 
                                            p.quantity,
                                            p.minimum_sale, 
                                            t.type_name, 
                                            p.product_img, 
                                            p.unit
                                        FROM product p 
                                        LEFT JOIN product_type t ON p.type_id = t.type_id
                                        WHERE p.quantity >= p.minimum_sale
                                        ORDER BY p.quantity DESC";
                                $result = $conn->query($sql);
                                if ($result->num_rows > 0) {
                                    $index = 1;
                                    while ($row = $result->fetch_assoc()) {
                                ?>
                                        <tr>
                                            <td><?= $index++ ?></td>
                                            <td><img src="<?= $row['product_img'] ?>" alt="product" class="img-fluid" width="100"></td>
                                            <td><?= $row['product_name'] ?></td>
                                            <td><?= $row['type_name'] ?></td>
                                            <td><?= $row['price_today'] ?> ฿</td>
                                            <td><?= $row['quantity'] ?></td>
                                            <td><?= $row['minimum_sale'] ?></td>
                                            <td>

                                                <form method="get" action="cart_sale_admin.php">
                                                    <input type="hidden" name="product_name" value="<?= $row['product_name'] ?>">
                                                    <button type="submit" class="btn btn-success">
                                                        <i class="bi bi-cart3"></i>
                                                    </button>
                                                </form>

                                            </td>

                                        </tr>
                                    <?php
                                    }
                                } else {
                                    ?>
                                    <tr>
                                        <td colspan="7">ไม่มีข้อมูล</td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex justify-content-between align-items-center">
                        <button class="btn btn-outline-primary" id="prevPage">ก่อนหน้า</button>
                        <span id="pageInfo"></span>
                        <button class="btn btn-outline-primary" id="nextPage">ถัดไป</button>
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
            });
        });
    </script>
</body>

</html>

<?php
$conn->close();
?>