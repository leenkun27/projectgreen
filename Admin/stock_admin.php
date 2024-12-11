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
                    <!-- Statistics Section -->
                    <div class="row">
                        <div class="col-md-4">
                            <div class="card-stat green">
                                <div>พร้อมขาย</div>
                                <div>0</div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card-stat orange">
                                <div>ใกล้หมด</div>
                                <div>0</div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card-stat red">
                                <div>หมดแล้ว</div>
                                <div>0</div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <h2>ข้อมูลของเก่า</h2>
                        <div class="row">
                            <!-- Filter Section -->
                            <div class="mt-4">
                                <div class="row">
                                    <div class="col-md-4">
                                        <select id="statusSelect" class="form-select">
                                            <option value="">สถานะ</option>
                                            <option value="พร้อมขาย">พร้อมขาย</option>
                                            <option value="หมดแล้ว">หมดแล้ว</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <select id="categorySelect" class="form-select">
                                            <option value="">ประเภทสินค้า</option>
                                            <option value="เศษเหล็ก">เศษเหล็ก</option>
                                            <option value="กระดาษ">กระดาษ</option>
                                            <option value="พลาสติก">พลาสติก</option>
                                            <option value="โลหะที่มีค่าสูง">โลหะที่มีค่าสูง</option>
                                            <option value="เครื่องใช้ไฟฟ้า">เครื่องใช้ไฟฟ้า</option>
                                            <option value="อื่นๆ">อื่นๆ</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <select id="locationSelect" class="form-select">
                                            <option value="">หน่วย</option>
                                            <option value="กิโลกรัม">กิโลกรัม</option>
                                            <option value="ชิ้น">ชิ้น</option>
                                            <option value="ลัง">ลัง</option>
                                        </select>
                                    </div>

                                </div>
                            </div>

                            <!-- DataTable Section -->
                            <div class="table-responsive mt-3">
                                <table class="table table-bordered table-striped table-summary">
                                    <thead class="table-light">
                                        <tr>
                                            <th scope="col">ลำดับ</th>
                                            <th scope="col">ชื่อสินค้า</th>
                                            <th scope="col">ภาพ</th>
                                            <th scope="col">จำนวนคงเหลือ</th>
                                            <th scope="col">ราคา</th>
                                            <th scope="col">หมายเหตุ</th>
                                            <th scope="col">สถานะ</th>
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
                                                echo "<td>" . $row['p_price'] . "</td>";
                                                echo "<td>" . $row['p_type'] . "</td>";
                                                echo "<td>" . $row['p_type'] . "</td>";
                                                echo "<td><button type='button' class='btn btn-danger'>ลบ</button></td>";
                                                echo "<td><button type='button' class='btn btn-warning'>แก้ไข</button></td>";
                                                echo "</tr>";
                                            }
                                        } else {
                                            echo "<tr><td colspan='7'>ไม่มีข้อมูล</td></tr>";
                                        }

                                        $conn->close(); // ปิดการเชื่อมต่อฐานข้อมูล
                                        ?>
                                    </tbody>
                                </table>


                            </div>
                        </div>

                    </div>

                    <!-- DataTable JS -->
                    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
                    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
                    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
                    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
                    <script>
                        $(document).ready(function() {
                            var table = $('#productTable').DataTable({
                                language: {
                                    search: "ค้นหา:",
                                    searchPlaceholder: "ชื่อ, รหัสสินค้า และบาร์โค้ด"
                                }
                            });

                            // ค้นหาตามฟิลด์ที่เลือก
                            $('#searchButton').click(function() {
                                var status = $('#statusSelect').val();
                                var category = $('#categorySelect').val();
                                var location = $('#locationSelect').val();
                                var unit = $('#unitSelect').val();

                                table
                                    .column(5).search(status) // ค้นหาตามสถานะ
                                    .column(1).search(category) // ค้นหาตามประเภทสินค้า
                                    .column(2).search(unit) // ค้นหาตามหน่วย
                                    .draw();
                            });
                        });
                    </script>

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