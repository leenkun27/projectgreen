<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>รายงานยอดขาย</title>
    <!-- Import Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .filter-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .filter-bar button,
        .filter-bar input,
        .filter-bar select {
            margin-right: 10px;
        }

        .pagination-container {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 20px;
        }

        .table-summary {
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            overflow: hidden;
        }

        th,
        td {
            text-align: center;
            vertical-align: middle;
        }

        .info-card {
            border-radius: 10px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
            display: flex;
            align-items: center;
            padding: 15px;
            margin-bottom: 20px;
            color: #fff;
        }

        .info-card .icon {
            font-size: 2rem;
            margin-right: 15px;
        }

        .info-card.orange {
            background-color: #f7a541;
        }

        .info-card.green {
            background-color: #28a745;
        }

        .info-card.blue {
            background-color: #17a2b8;
        }

        .info-card.red {
            background-color: #dc3545;
        }

        .info-card .text-muted {
            font-size: 0.9rem;
            color: rgba(255, 255, 255, 0.8);
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
            <div class="card mt-3 pb-5 px-2 col-10">

                <div class="container mt-5">
                    <div class="row">
                        <!-- กำไรสุทธิ -->
                        <div class="col-md-3">
                            <div class="info-card orange">
                                <div class="icon">
                                    <i class="bi bi-bar-chart-line-fill"></i>
                                </div>
                                <div>
                                    <h5>กำไรสุทธิ</h5>
                                    <h3>0.00</h3>
                                </div>
                            </div>
                        </div>
                        <!-- ยอดขาย -->
                        <div class="col-md-3">
                            <div class="info-card green">
                                <div class="icon">
                                    <i class="bi bi-currency-exchange"></i>
                                </div>
                                <div>
                                    <h5>ยอดขาย</h5>
                                    <h3>0.00</h3>
                                </div>
                            </div>
                        </div>
                        <!-- ต้นทุน -->
                        <div class="col-md-3">
                            <div class="info-card blue">
                                <div class="icon">
                                    <i class="bi bi-calculator"></i>
                                </div>
                                <div>
                                    <h5>ต้นทุน</h5>
                                    <h3>0.00</h3>
                                    <!-- <p class="text-muted">สินค้า: 0.00 + ค่าใช้จ่าย: 0.00</p> -->
                                </div>
                            </div>
                        </div>

                    </div>
                </div>


                <div class="card mt-3 pb-5 px-2 col-12">
                    <div class="container mt-5">
                        <!-- Filter Bar -->
                        <div class="filter-bar">
                            <div>
                                <button class="btn btn-primary"><i class="bi bi-funnel"></i> ตัวกรอง</button>
                                <select class="form-select d-inline-block w-auto">
                                    <option selected>วันนี้</option>
                                    <option>สัปดาห์</option>
                                    <option>เดือน</option>
                                    <option>ทั้งหมด</option>
                                </select>
                                <input type="date" class="form-control d-inline-block w-auto">
                            </div>
                            <div>
                                <button class="btn btn-outline-secondary"><i class="bi bi-search"></i></button>
                            </div>
                        </div>

                        <!-- Summary Table -->
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-summary">
                                <thead class="table-light">
                                    <tr>
                                        <th>รายการ</th>
                                        <th>ยอดรวม</th>
                                        <th>คืนเงิน</th>
                                        <th>ยอดสุทธิ</th>
                                        <th>ต้นทุน</th>
                                        <th>กำไรสุทธิ</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>26 พ.ย. 2024 อ.</td>
                                        <td>฿0.00</td>
                                        <td>฿0.00</td>
                                        <td>฿0.00</td>
                                        <td>฿0.00</td>
                                        <td>฿0.00</td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                    <tr class="fw-bold">
                                        <td>รวม (฿)</td>
                                        <td>฿0.00</td>
                                        <td>฿0.00</td>
                                        <td>฿0.00</td>
                                        <td>฿0.00</td>
                                        <td>฿0.00</td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>

                        <!-- Pagination -->
                        <div class="pagination-container">
                            <button class="btn btn-outline-secondary">ก่อนหน้า</button>
                            <span class="mx-3">1</span>
                            <button class="btn btn-outline-secondary">ถัดไป</button>
                        </div>
                    </div>

                    <!-- Import Bootstrap JS -->
                    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
                    <!-- Import Bootstrap Icons -->
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