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
        <h3>จัดการของเก่า</h3>
        <div class="col-6">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    เพิ่ม
            </button>          
        </div>
        <br>
        <div class="row">
            <table class="table">
                <thead>
                    <tr class="table-info">
                        <th scope="col">ลำดับ</th>
                        <th scope="col">รูปภาพ</th>
                        <th scope="col">ชื่อของเก่า</th>
                        <th scope="col">ราคา</th>
                        <th scope="col">จำนวน</th>
                        <th scope="col">ประเภท</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row">1</th>
                        <td>#</td>
                        <td>กระดาษ</td>
                        <td>10</td>
                        <td>35</td>
                        <td>กระดาษ</td>
                    </tr>
                    <tr>
                        <th scope="row">2</th>
                        <td>#</td>
                        <td>หนังสือพิมพ์</td>
                        <td>9</td>
                        <td>30</td>
                        <td>กระดาษ</td>
                    </tr>
                    <tr>
                        <th scope="row">3</th>
                        <td>#</td>
                        <td>ขวดลีโอ</td>
                        <td>12</td>
                        <td>45</td>
                        <td>ขวด</td>
                    </tr>
                    <tr>
                        <th scope="row">3</th>
                        <td>#</td>
                        <td>ขวดลีโอ</td>
                        <td>12</td>
                        <td>45</td>
                        <td>ขวด</td>
                    </tr>
                    <tr>
                        <th scope="row">3</th>
                        <td>#</td>
                        <td>ขวดลีโอ</td>
                        <td>12</td>
                        <td>45</td>
                        <td>ขวด</td>
                    </tr>
                    <tr>
                        <th scope="row">3</th>
                        <td>#</td>
                        <td>ขวดลีโอ</td>
                        <td>12</td>
                        <td>45</td>
                        <td>ขวด</td>
                    </tr>
                    <tr>
                        <th scope="row">3</th>
                        <td>#</td>
                        <td>ขวดลีโอ</td>
                        <td>12</td>
                        <td>45</td>
                        <td>ขวด</td>
                    </tr>
                    <tr>
                        <th scope="row">3</th>
                        <td>#</td>
                        <td>ขวดลีโอ</td>
                        <td>12</td>
                        <td>45</td>
                        <td>ขวด</td>
                    </tr>
                    <tr>
                        <th scope="row">3</th>
                        <td>#</td>
                        <td>ขวดลีโอ</td>
                        <td>12</td>
                        <td>45</td>
                        <td>ขวด</td>
                    </tr>
                    <tr>
                        <th scope="row">3</th>
                        <td>#</td>
                        <td>ขวดลีโอ</td>
                        <td>12</td>
                        <td>45</td>
                        <td>ขวด</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">เพิ่มข้อมูลของเก่า</h1>
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
                            <label for="exampleInputEmail1" class="form-label">ชื่อของเก่า</label>
                            <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">ราคา</label>
                            <input type="text" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">จำนวน</label>
                            <input type="text" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">ประเภท</label>
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