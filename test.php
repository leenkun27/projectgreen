<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product List</title>
    <!-- Import Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <style>
        .status-icon {
            font-size: 1.2em;
        }

        .status-icon i {
            margin-right: 5px;
        }

        .card-stat {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 20px;
            margin-bottom: 20px;
            border-radius: 8px;
        }

        .card-stat.green {
            background-color: #e0f7ea;
            color: #2e7d32;
        }

        .card-stat.purple {
            background-color: #ede7f6;
            color: #6a1b9a;
        }

        .card-stat.orange {
            background-color: #fff3e0;
            color: #e65100;
        }

        .card-stat.red {
            background-color: #ffebee;
            color: #b71c1c;
        }
    </style>
</head>

<body>
    <div class="container my-4">
        <!-- Statistics Section -->
        <div class="row">
            <div class="col-md-3">
                <div class="card-stat green">
                    <div>พร้อมขาย</div>
                    <div>41</div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card-stat purple">
                    <div>มีส่วนลด</div>
                    <div>0</div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card-stat orange">
                    <div>ใกล้หมด</div>
                    <div>0</div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card-stat red">
                    <div>หมดแล้ว</div>
                    <div>0</div>
                </div>
            </div>
        </div>

        <!-- Filter Section -->
        <div class="mt-3">
            <div class="row">
                <div class="col-md-3">
                    <select class="form-select">
                        <option>สถานะ</option>
                        <option>พร้อมขาย</option>
                        <option>หมดแล้ว</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <select class="form-select">
                        <option>หมวดหมู่</option>
                        <option>เครื่องใช้ไฟฟ้า</option>
                        <option>เฟอร์นิเจอร์</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <select class="form-select">
                        <option>ที่อยู่สินค้า</option>
                        <option>คลัง 1</option>
                        <option>คลัง 2</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <select class="form-select">
                        <option>หน่วย</option>
                        <option>ชิ้น</option>
                        <option>แพ็ค</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- Search and Table Section -->
        <div class="mt-4">
            <div class="d-flex justify-content-between align-items-center">
                <input type="text" class="form-control w-50" placeholder="ชื่อ, รหัสสินค้า และบาร์โค้ด">
                <div>
                    <button class="btn btn-primary"><i class="bi bi-grid"></i></button>
                    <button class="btn btn-success"><i class="bi bi-plus"></i></button>
                </div>
            </div>
        </div>

        <div class="table-responsive mt-3">
            <table id="productTable" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>รหัส</th>
                        <th>ชื่อสินค้า</th>
                        <th>ราคา</th>
                        <th>จำนวน</th>
                        <th>หมวดหมู่</th>
                        <th>สถานะ</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>PD65000022</td>
                        <td>สายไฟ</td>
                        <td>฿170.00</td>
                        <td>59.743 แพ็ค</td>
                        <td>รับซื้อ</td>
                        <td>
                            <div class="status-icon"><i class="bi bi-check-circle text-success"></i> พร้อมขาย</div>
                        </td>
                    </tr>
                    <tr>
                        <td>PD65000027</td>
                        <td>มุ้งลวด</td>
                        <td>฿80.00</td>
                        <td>64.743 ชิ้น</td>
                        <td>รับซื้อ</td>
                        <td>
                            <div class="status-icon"><i class="bi bi-x-circle text-danger"></i> หมดแล้ว</div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Import Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#productTable').DataTable();
        });
    </script>
</body>

</html>
