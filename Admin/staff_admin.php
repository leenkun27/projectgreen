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
<style>
    .card {
        max-height: 85vh;
        /* กำหนดความสูงสูงสุด */
        overflow-y: auto;
        /* เพิ่ม scroll ถ้าข้อมูลยาวเกิน */
        padding: 15px;
        /* เพิ่ม padding ให้ดูสบายตา */
    }

    .table-responsive {
        max-height: 70vh;
        /* จำกัดความสูงของตารางใน card */
        overflow-y: auto;
        /* ทำให้เลื่อนข้อมูลในแนวตั้งได้ */
    }

    .table {
        table-layout: fixed;
        /* ตารางมีขนาดคงที่ */
        word-wrap: break-word;
        /* ตัดคำที่ยาวเกินในช่อง */
    }

    th,
    td {
        text-align: center;
        /* จัดกลางข้อความในเซลล์ */
        vertical-align: middle;
        /* จัดกึ่งกลางในแนวตั้ง */
    }
</style>

</style>

<body>

    <div class="container">
        <?php include '../header_admin.php'; ?>
        <div class="row">
            <div class="col-2">
                <?php include '../menu_admin.php'; ?>
            </div>
            <div class="card mt-3 pb-5 px-2 col-10">
                <div class="col-12">
                    <h2 class="mb-3">ข้อมูลสมาชิก</h2>
                    <!-- Search Section -->
                    <div class="mt-4">
                        <div class="d-flex justify-content-between align-items-center">
                            <input type="text" class="form-control w-50" placeholder="ค้นหาชื่อพนักงาน">
                            <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                <i class="bi bi-plus"></i> เพิ่มข้อมูล </button>
                        </div>
                    </div>

                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">สร้างพนักงาน</h1>
                                    <div class="ms-auto">
                                        <button type="button" class="btn btn-Primary me-2">บันทึก</button>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                </div>

                                <div class="modal-header">
                                    <h2 class="modal-title fs-5" id="exampleModalLabel"><i class="bi bi-person-square"></i> เพิ่ม พนักงาน</h2>
                                </div>
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">ชื่อ-นามสกุล</label>
                                        <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">รหัสผ่าน</label>
                                        <input type="text" class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">ยืนยันรหัสผ่าน</label>
                                        <input type="text" class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <div>ประเภทของพนักงาน</div>
                                        <select class="form-select " aria-label=".form-select-sm example">
                                            <option selected>ผู้ดูแลระบบ</option>
                                            <option value="1">แอดมิน</option>
                                            <option value="2">พนักงาน</option>
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">ชื่อในใบเสร็จ</label>
                                        <input type="text" class="form-control">
                                    </div>
                                </div>

                                <div class="modal-header">
                                    <h2 class="modal-title fs-5" id="exampleModalLabel"><i class="bi bi-person-circle"></i> ข้อมูลส่วนตัว</h2>
                                </div>
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">ชื่อ</label>
                                        <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">นามสกุล</label>
                                        <input type="text" class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">เบอร์โทรศัพท์</label>
                                        <input type="text" class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <label for="">เพิ่มรูปภาพ</label>
                                        <input type="file" name="h_image" id="" class="form-control mb-3" accept=".png,.jpg,.jpeg">
                                    </div>

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
                                            <th scope="col">รหัสสมาชิก</th>
                                            <th scope="col">รูปภาพ</th>
                                            <th scope="col">ชื่อ</th>
                                            <th scope="col">ตำแหน่ง</th>
                                            <th scope="col">ลบ</th>
                                            <th scope="col">แก้ไข</th>
                                        </tr>
                                    </thead>

                                    <?php
                                    // ดึงข้อมูลจากฐานข้อมูล
                                    $sql = "SELECT * FROM tbl_member"; // ระบุชื่อตาราง
                                    $result = $conn->query($sql);

                                    if ($result->num_rows > 0) {
                                        $index = 1; // ตัวนับลำดับ
                                        while ($row = $result->fetch_assoc()) {
                                            echo "<tr>";
                                            echo "<th scope='row'>" . $index++ . "</th>";
                                            echo "<td>" . $row['mem_id'] . "</td>";
                                            echo "<td><img src='" . $row['mem_img'] . "' alt='product' class='img-fluid' width='50'></td>";
                                            echo "<td>" . $row['mem_name'] . "</td>";
                                            echo "<td>" . $row['role'] . "</td>";
                                            echo "<td><button type='button' class='btn btn-danger'>ลบ</button></td>";
                                            echo "<td><button type='button' class='btn btn-warning'>แก้ไข</button></td>";
                                            echo "</tr>";
                                        }
                                    } else {
                                        echo "<tr><td colspan='8'>ไม่มีข้อมูล</td></tr>";
                                    }

                                    $conn->close(); // ปิดการเชื่อมต่อฐานข้อมูล
                                    ?>
                                </table>
                            </div>
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