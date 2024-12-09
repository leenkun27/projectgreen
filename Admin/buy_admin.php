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
                            <label for="p_date">วันที่รับซื้อ</label>
                            <div class="input-group">
                                <input type="date" class="form-control" id="p_date">
                            </div>
                        </div>

                        <div class="col-6 ">
                            ชื่อของเก่า
                            <div class="input-group">
                                <input type="text" class="form-control" id="p_name" placeholder="กรอกชื่อของเก่า" placeholder="กรอกชื่อของเก่า" onkeydown="checkEnter(event)">
                            </div>
                        </div>

                        <div class="col-6 mt-2">
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
                            <div>ราคารับซื้อวันนี้</div>
                            <div class="input-group">
                                <input type="email" class="form-control" id="p_price" placeholder="">
                            </div>
                        </div>

                        <div class="d-flex justify-content-end mt-3">
                            <button type="button" class="ms-2 btn btn-success" id="addButton1">เพิ่ม</button>
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
                                <tbody id="productTableBody">
                                    <!-- ข้อมูลจะถูกเพิ่มที่นี่ -->
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>


        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(document).ready(function() {
            // เมื่อคลิกปุ่ม "เพิ่ม"
            $('#addButton1').click(function() {
                var p_name = $('#p_name').val();
                var p_type = $('#p_type').val();
                var p_qty = $('#p_qty').val();
                var p_price = $('#p_price').val();

                // ตรวจสอบว่าข้อมูลครบหรือไม่
                if (p_name.trim() === "" || p_qty.trim() === "" || p_price.trim() === "") {
                    alert("กรุณากรอกข้อมูลให้ครบ");
                    return;
                }

                // ส่งข้อมูลไปยัง PHP ด้วย AJAX
                $.ajax({
                    url: 'add_product.php', // ไฟล์ PHP ที่จะบันทึกข้อมูล
                    type: 'POST',
                    data: {
                        p_name: p_name,
                        p_type: p_type,
                        p_qty: p_qty,
                        p_price: p_price
                    },
                    success: function(response) {
                        // เมื่อข้อมูลถูกบันทึกสำเร็จ
                        var data = JSON.parse(response); // สมมติว่า PHP ส่งข้อมูลกลับในรูปแบบ JSON
                        if (data.success) {
                            // คำนวณจำนวนเงิน
                            var total_price = data.qty * data.price;

                            // เพิ่มแถวใหม่ในตาราง
                            var newRow = `
                        <tr>
                            <td>${data.date}</td>
                            <td>${data.name}</td>
                            <td>${data.type}</td>
                            <td>${data.qty}</td>
                            <td>${data.price}</td>
                            <td>${total_price}</td>
                        </tr>
                    `;
                            $('#productTableBody').append(newRow);

                            // ล้างข้อมูลในฟอร์ม
                            $('#p_name').val('');
                            $('#p_qty').val('');
                            $('#p_price').val('');
                        } else {
                            alert('บันทึกข้อมูลไม่สำเร็จ');
                        }
                    }
                });
            });
        });
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