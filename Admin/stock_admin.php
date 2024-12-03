<?php include '../condb.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Do</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
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
        <?php include './header.php'; ?>
        <div class="row">
            <div class="col-2">
                <?php include './menu.php'; ?>
            </div>
            <div class="card mt-3 pb-5 px-2 col-10">
                <div class="container my-4">
                    <!-- Statistics Section -->
                    <div class="row">
                        <div class="col-md-3">
                            <div class="card-stat green">
                                <div>พร้อมขาย</div>
                                <div>41</div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card-stat orange">
                                <div>ใกล้หมด</div>
                                <div>0</div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card-stat red">
                                <div>หมดแล้ว</div>
                                <div>0</div>
                            </div>
                        </div>
                    </div>
                    
                        <div class="col-10">
                            <h1>ข้อมูลของเก่า</h1>
                            <div class="row">
                                <!-- Filter Section -->
                                <di class="mt-3">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <select class="form-select">
                                                <option>สถานะ</option>
                                                <option>พร้อมขาย</option>
                                                <option>หมดแล้ว</option>
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <select class="form-select">
                                                <option>หมวดหมู่</option>
                                                <option>เครื่องใช้ไฟฟ้า</option>
                                                <option>เฟอร์นิเจอร์</option>
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <select class="form-select">
                                                <option>ที่อยู่สินค้า</option>
                                                <option>คลัง 1</option>
                                                <option>คลัง 2</option>
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <select class="form-select">
                                                <option>หน่วย</option>
                                                <option>ชิ้น</option>
                                                <option>แพ็ค</option>
                                            </select>
                                        </div>
                                    </div>
                                </di
                                    <!-- Search and Table Section -->
                                <div class="mt-4">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <input type="text" class="form-control w-50" placeholder="ชื่อ, รหัสสินค้า และบาร์โค้ด">
                                        <div>
                                            <button class="btn btn-success"><i class="bi bi-plus"></i></button>
                                        </div>
                                    </div>
                                </div>

                                <div class="table-responsive mt-3">
                                    <table id="productTable" class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th scope="col">ลำดับ</th>
                                                <th scope="col">ชื่อสินค้า</th>
                                                <th scope="col">ภาพ</th>
                                                <th scope="col">จำนวนคงเหลือ</th>
                                                <th scope="col">หมายเหตุ</th>
                                                <th scope="col">ลบ</th>
                                                <th scope="col">แก้ไข</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            // ดึงข้อมูลจากฐานข้อมูล
                                            $sql = "SELECT * FROM tbl_product"; // ระบุชื่อตาราง
                                            $result = $conn->query($sql);

                                            if ($result->num_rows > 0) {
                                                $index = 1; // ตัวนับลำดับ
                                                while ($row = $result->fetch_assoc()) {
                                                    echo "<tr>";
                                                    echo "<th scope='row'>" . $index++ . "</th>";
                                                    echo "<td>" . $row['p_name'] . "</td>";
                                                    echo "<td><img src='" . $row['p_img'] . "' alt='product' class='img-fluid' width='50'></td>";
                                                    echo "<td>" . $row['p_qty'] . "</td>";
                                                    echo "<td>" . $row['p_type'] . "</td>";
                                                    echo "<td><button type='button' class='btn btn-danger'>ลบ</button></td>";
                                                    echo "<td><button type='button' class='btn btn-warning'>แก้ไข</button></td>";
                                                    echo "</tr>";
                                                }
                                            } else {
                                                echo "<tr><td colspan='8'>ไม่มีข้อมูล</td></tr>";
                                            }

                                            $conn->close(); // ปิดการเชื่อมต่อฐานข้อมูล
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <!-- Import Bootstrap JS -->
                            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
                            <!-- DataTables JS -->
                            <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
                            <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
                            <script>
                                $(document).ready(function() {
                                    $('#productTable').DataTable();
                                });
                            </script>

                            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
                            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                            <script>
                                $(document).ready(function() {
                                    $(".cart").click(function() {
                                        Swal.fire({
                                            title: "สำเร็จ",
                                            text: "You clicked the button!",
                                            icon: "success"
                                        });
                                    });
                                });
                            </script>
</body>

</html>