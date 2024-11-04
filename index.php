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
        <h1>Relic</h1>
        <div class="row">
            <div class="col-lg-3 col-md-4 col-sm-6">Lorem ipsum dolor sit amet consectetur adipisicing elit. Odio repellendus accusamus atque, doloremque optio sequi dolorum necessitatibus quidem veritatis sed!</div>
            <div class="col-lg-3 col-md-4 col-sm-6">Lorem ipsum dolor sit amet consectetur adipisicing elit. Recusandae sit optio placeat iusto, eius fuga! Optio omnis quas voluptate repellat.</div>
            <div class="col-lg-3 col-md-4 col-sm-6">Lorem ipsum dolor sit amet consectetur adipisicing elit. Commodi delectus cupiditate sed quas soluta magnam nam beatae quidem totam atque.</div>
        </div>

        <div class="row mt-5">
            <div class="col-6">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Fuga, magni?</div>
            <div class="col-6">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nemo, fugit.</div>
        </div>
        <div class="row mt-5">
            <div class="col-6">
                <div class="card" style="width: 18rem;">
                    <img src="https://th.bing.com/th/id/OIP.iZ6lxNXuEqjJd8FcnrFIygHaHa?w=1000&h=1000&rs=1&pid=ImgDetMain" alt="">
                    <div class="card-body">
                        <h3 class="card-title">กระดาษ</h3>
                        <p class="class-text">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Aliquam, eum?</p>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="card" style="width: 18rem;">
                    <img src="https://th.bing.com/th/id/OIP.iZ6lxNXuEqjJd8FcnrFIygHaHa?w=1000&h=1000&rs=1&pid=ImgDetMain" alt="">
                    <div class="card-body">
                        <h3 class="card-title">กระดาษ</h3>
                        <p class="class-text">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Aliquam, eum?</p>
                        <div class="row">
                            <div class="col-6"><button class="btn btn-sm btn-warning cart"><i class="bi bi-cart"></i></button></div>
                            <div class="col-6"><button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                    ดูรายละเอียด
                                </button></div>
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