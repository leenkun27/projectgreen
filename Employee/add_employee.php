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
        <div class="row">
            <div class="col-md-4"> <br>
                <h4>ข้อมูลส่วนตัว</h4>
                <form action="formAdd_db.php" method="post">
                    <div class="mb-1">
                        <label for="name" class="col-sm-2 col-form-label"> ชื่อ : </label>
                        <div class="col-sm-10">
                            <input type="text" name="name" class="form-control" required minlength="3" placeholder="ชื่อ">
                        </div>
                    </div>
                    <div class="mb-1">
                        <label for="name" class="col-sm-2 col-form-label"> นามสกุล : </label>
                        <div class="col-sm-10">
                            <input type="text" name="surname" class="form-control" required minlength="3" placeholder="นามสกุล">
                        </div>
                    </div>
                    <div class="mb-1">
                        <label for="number" class="col-sm-3 col-form-label"> เบอร์โทรศัพท์ : </label>
                        <div class="col-sm-10">
                            <input type="number" name="phone" class="form-control" required minlength="3" placeholder="เบอร์โทรศัพท์">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">เพิ่มข้อมูล</button>
                </form>
                
            </div>
        </div>
    </div>
</body>



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