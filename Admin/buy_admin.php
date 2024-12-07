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
                <div class="col-10">
                    <h1>รับซื้อของเก่า</h1>
                    <div class="row mt-5">
                        <div class="col-lg-6 col-md-4 col-sm-6">
                            ชื่อของเก่า
                            <div class="input-group">
                                <input type="text" class="form-control" id="p_name" placeholder="กรอกชื่อของเก่า" placeholder="กรอกชื่อของเก่า" onkeydown="checkEnter(event)">
                            </div>
                        </div>
                        <div class="col-6">
                            <div>ประเภทของเก่า</div>
                            <div class="input-group">
                                <select class="form-control" id="p_type" placeholder="">
                                    <option>เศษเหล็ก</option>
                                    <option>กระดาษ</option>
                                    <option>ขวดแก้ว</option>
                                    <option>พลาสติก</option>
                                    <option>โลหะที่มีค่าสูง</option>
                                    <option>เครี่องใช้ไฟฟ้า</option>
                                    <option>อื่นๆ</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-6 mt-2">
                            <div>ปริมาณการรับซื้อ</div>
                            <div class="input-group">
                                <input type="number" class="form-control" id="p_qty" placeholder="">
                            </div>
                        </div>


                        <div class="col-6 mt-2">
                            <div>ราคารับซื้อ</div>
                            <div class="input-group">
                                <input type="email" class="form-control" id="p_price" placeholder="">
                            </div>
                        </div>


                        <div class="table-responsive mt-3">
                            <table id="productTable" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th scope="col">วันที่</th>
                                        <th scope="col">ชื่อสินค้า</th>
                                        <th scope="col">จำนวน</th>
                                        <th scope="col">ราคาต่อหน่วย</th>
                                        <th scope="col">จำนวนเงิน</th>
                                        <th scope="col">ยอดรวม</th>


                                    </tr>
                                </thead>

                            </table>
                        </div>
                    </div>

                </div>
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
        function checkEnter(event) {
            if (event.key === "Enter") { // ถ้ากด Enter
                fetchItemData(); // เรียกฟังก์ชัน fetchItemData
            }
        }
        // เมื่อกด Enter ในช่องกรอกชื่อของเก่า
        function fetchItemData() {
            var p_name = $('#p_name').val(); // ใช้ #p_name เพื่อดึงค่า

            // ถ้าชื่อของเก่าไม่ว่าง
            if (p_name.trim() !== "") {
                $.ajax({
                    url: 'fetch_item_data.php', // ไฟล์ PHP ที่จะดึงข้อมูล
                    type: 'POST',
                    data: {
                        p_name: p_name
                    },
                    success: function(response) {
                        // แปลงข้อมูลที่ได้รับจาก PHP เป็น JSON
                        var data = JSON.parse(response);

                        // ตรวจสอบว่าได้รับข้อมูล
                        if (data.success) {
                            // แสดงข้อมูลที่ได้รับในฟอร์ม
                            $('#p_type').val(data.type); // แสดงประเภทของเก่า
                            $('#p_qty').val(data.quantity); // แสดงปริมาณการรับซื้อ
                            $('#p_price').val(data.price); // แสดงราคารับซื้อ
                        } else {
                            alert('ไม่พบข้อมูลของเก่า');
                        }
                    }
                });
            }
        }
    </script>

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