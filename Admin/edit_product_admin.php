้
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
        <?php include './header.php'; ?>
        <div class="row">
            <div class="col-2">
                <?php include './menu.php'; ?>
            </div>
            <div class="card mt-3 pb-5 px-2 col-10">
                <h2>แก้ไขข้อมูลของเก่า</h2>
                <div class="text-center">
                    <img src="..." class="rounded" alt="...">
                </div>
                <div class="mb-3">
                    <label for="formFile" class="form-label">แก้ไขรูปภาพ</label>
                    <input class="form-control" type="file" id="formFile">
                </div>

                <div class="col-12">
                    <div>ชื่อของเก่า</div>
                    <div class="input-group">
                        <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="">
                    </div>
                </div>
                <div class="col-12">
                    <div>จำนวน</div>
                    <div class="input-group">
                        <input type="number" class="form-control" id="exampleFormControlInput1" placeholder="">
                    </div>
                </div>

                <div class="col-12">
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
                <div class="col-12">
                    <div>ราคา</div>
                    <div class="input-group">
                        <input type="number" class="form-control" id="exampleFormControlInput1" placeholder="">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success">บันทึก</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ยกเลิก</button>
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