<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>รายงานยอดขาย</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>
    <div class="container">
        <?php include '../header_admin.php'; ?>
        <div class="row">
            <div class="col-2">
                <?php include '../menu_admin.php'; ?>
            </div>
            <div class="card mt-3 pb-5 px-2 col-10">
                <div>
                    <h2><i class="bi bi-file-text-fill"></i> ประวัติ-ขาย (ใบเสร็จ)</h2>
                </div>

               
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-summary">
                        <thead class="table-light">
                            <tr>
                                <th>รายการ</th>
                                <th>ใบเสร็จ</th>
                                <th>พนักงาน</th>
                                <th>ยอดรวม</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>26 พ.ย. 2024 </td>
                                <td></td>
                                <td>supatsorn</td>
                                <td>฿0.00</td>
                            </tr>
                        </tbody>
                       
                    </table>
                </div>


                <div class="pagination-container">
                    <button class="btn btn-outline-secondary">ก่อนหน้า</button>
                    <span class="mx-3">1</span>
                    <button class="btn btn-outline-secondary">ถัดไป</button>
                </div>
            </div>

           
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
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
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
</body>

</html>