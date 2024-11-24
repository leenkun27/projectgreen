<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Do</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        /* กำหนดขนาดและสไตล์สำหรับตาราง */
        .table-container {
            max-height: 200px;
            /* ความสูงของตาราง */
            overflow-y: auto;
            /* เพิ่มแถบเลื่อนแนวตั้ง */
            border: 1px solid #ccc;
            /* เส้นขอบ */
            border-radius: 5px;
            /* ขอบมน */
        }

        .table-hover tbody tr:hover {
            background-color: #e9ecef;
            /* สีพื้นหลังเมื่อ hover */
        }

        .selected-row {
            background-color: #d0ebff !important;
            /* สีพื้นหลังของแถวที่เลือก */
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
            <div class="col-10">
                <h1>ข้อมูลของเก่า</h1>
                <div class="row">
                    <div class="col-6">
                        <div class="mb-3">
                            <label for="formGroupExampleInput" class="form-label">รหัสประเภทของเก่า</label>
                            <input type="text" class="form-control" id="formGroupExampleInput" placeholder="">
                        </div>
                    </div>
                    <div class="col-6">
                        <label for="formGroupExampleInput2" class="form-label">ชื่อประเภทของเก่า</label>
                        <input type="text" class="form-control" id="formGroupExampleInput2" placeholder="">
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="button" class="ms-2 btn btn-success">บันทึก</button>
                        <button type="button" class="ms-2 btn btn-secondary">แก้ไข</button>
                        <button type="button" class="ms-2 btn btn-danger">ลบ</button>
                    </div>

                    <div class="container mt-5">
                        <div class="table-container">
                            <table class="table table-bordered table-hover">
                                <thead class="table-dark">
                                    <tr>
                                        <th>รหัสประเภทของเก่า</th>
                                        <th>ชื่อประเภทของเก่า</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="selected-row">
                                        <td>1001</td>
                                        <td>แก้ว</td>
                                    </tr>
                                    <tr>
                                        <td>1002</td>
                                        <td>พลาสติก</td>
                                    </tr>
                                    <tr>
                                        <td>1003</td>
                                        <td>เหล็ก</td>
                                    </tr>
                                    <tr>
                                        <td>1004</td>
                                        <td>สายไฟ</td>
                                    </tr>
                                    <tr>
                                        <td>1005</td>
                                        <td>กระดาษ</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>


                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">กระดาษ</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="d-flex justify-content-center">
                                    <img
                                        class="w-50"
                                        src="https://th.bing.com/th/id/OIP.iZ6lxNXuEqjJd8FcnrFIygHaHa?w=1000&h=1000&rs=1&pid=ImgDetMain"
                                        alt="">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">จำนวน</label>
                                    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                    <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                                </div>
                                <div class="mb-3">
                                    <input type="text" class="form-control">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
                                <button type="button" class="btn btn-success">บันทึก</button>
                            </div>
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