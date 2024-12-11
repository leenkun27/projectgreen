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
                    <div>
                        <h2><i class="bi bi-shop fs-5 me-2"></i> ขายสินค้า</h2>
                    </div>
                </div>

                <div class="row mt-5">
                    <div class="col-lg-6 col-md-4 col-sm-6">
                        ชื่อของเก่า
                        <div class="input-group">
                            <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="">
                        </div>
                    </div>
                    <div class="col-6">
                        <div>ประเภทของเก่า</div>
                        <div class="input-group">
                            <select class="form-control" id="" placeholder="">
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
                        <div>ราคา</div>
                        <div class="input-group">
                            <input type="number" class="form-control" id="exampleFormControlInput1" placeholder="">
                        </div>
                    </div>


                    <div class="col-6 mt-2">
                        <div>ราคาต่อหน่วย</div>
                        <div class="input-group">
                            <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="">
                        </div>
                    </div>
                    <div class="col-6 mt-2">
                        <div>จำนวน</div>
                        <div class="input-group">
                            <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="">
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