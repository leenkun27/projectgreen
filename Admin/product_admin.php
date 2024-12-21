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
</head>

<body>

    <div class="container">
        <?php include '../header_admin.php'; ?>
        <div class="row">
            <div class="col-2">
                <?php include '../menu_admin.php'; ?>
            </div>
            <div class="card mt-3 pb-5 px-2 col-10">
                <div class="col-12">
                    <h2>ข้อมูลสินค้า</h2>
                    <!-- Search and Table Section -->
                    <div class="mt-4">
                        <div class="d-flex justify-content-between align-items-center">
                            <input type="text" class="form-control w-50" placeholder="ชื่อสินค้า">
                            <div>
                                <button class="btn btn-success"><i class="bi bi-plus" data-bs-toggle="modal" data-bs-target="#exampleModal"></i>เพิ่มข้อมูล</button>
                            </div>
                        </div>
                    </div>

                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">เพิ่มข้อมูลสินค้า</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">ชื่อสินค้า</label>
                                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                    </div>
                                    <div class="mb-2">
                                        <label for="exampleInputEmail1" class="form-label">ราคาต้นทุน</label>
                                        <input type="number" class="form-control">
                                    </div>
                                    <div class="mb-2">
                                        <label for="exampleInputEmail1" class="form-label">จำนวนคงเหลือ</label>
                                        <input type="number" class="form-control">
                                    </div>
                                    <div class="mb-2">
                                        <label for="exampleInputEmail1" class="form-label">หมายเหตุ</label>
                                        <input type="text" class="form-control">
                                    </div>
                                    <div class="col-md mt-2" text-align="left">
                                        <label for="">รูปภาพ</label>
                                        <input type="file" name="h_image" id="" class="form-control mb-3" accept=".png,.jpg,.jpeg">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
                                    <button type="button" class="btn btn-success">บันทึก</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row ">
                        <div class="col-12">
                            <div class="table-responsive mt-3">
                                <table class="table table-bordered table-striped table-summary">
                                    <thead class="table-light">
                                        <tr>
                                            <th scope="col">ลำดับ</th>
                                            <th scope="col">รูปภาพ</th>
                                            <th scope="col">ชื่อสินค้า</th>
                                            <th scope="col">ราคาต้นทุน</th>
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
                                                echo "<td><img src='" . $row['p_img'] . "' alt='product' class='img-fluid' width='50'></td>";
                                                echo "<td>" . $row['p_name'] . "</td>";
                                                echo "<td>" . $row['p_qty'] . "</td>";
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