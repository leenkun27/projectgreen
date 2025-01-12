<?php
include '../condb.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>เพิ่มสินค้า</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <?php include '../header_admin.php'; ?>
        <div class="row">
            <div class="col-2">
                <?php include '../menu_admin.php'; ?>
            </div>
            <div class="card mt-3 pb-5 px-2 col-10">
                <h2>เพิ่มข้อมูลสินค้า</h2>
                <form method="POST" action="insert_product_admin.php" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="product_name" class="form-label">ชื่อสินค้า</label>
                        <input type="text" class="form-control" id="product_name" name="product_name" required>
                    </div>

                    <div class="mb-3">
                        <label for="type_id" class="form-label">ประเภทสินค้า</label>
                        <select class="form-control" id="type_id" name="type_id" required>
                            <option value="" disabled selected>-- เลือกประเภทสินค้า --</option>
                            <option value="1">เศษเหล็ก</option>
                            <option value="2">กระดาษ</option>
                            <option value="3">ขวดแก้ว</option>
                            <option value="4">พลาสติก</option>
                            <option value="5">โลหะที่มีค่าสูง</option>
                            <option value="6">เครื่องใช้ไฟฟ้า</option>
                            <option value="7">อื่นๆ</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="cost_price" class="form-label">ราคาต้นทุน</label>
                        <input type="number" class="form-control" id="cost_price" name="cost_price" required>
                    </div>

                    <div class="mb-3">
                        <label for="quantity" class="form-label">จำนวนคงเหลือ</label>
                        <input type="number" class="form-control" id="quantity" name="quantity" required>
                    </div>

                    <div class="mb-3">
                        <label for="unit">หน่วย:</label>
                        <select class="form-control" id="unit" name="unit" required>
                            <option value="">-- เลือกหน่วย --</option>
                            <option value="1">กิโลกรัม</option>
                            <option value="2">ชิ้น</option>
                            <option value="3">ลัง</option>
                        </select>
                    </div>

                        <div class="mb-3">
                            <label for="product_img">รูปภาพสินค้า</label>
                            <input type="file" class="form-control" id="product_img" name="product_img" required>
                        </div>

                    <button type="submit" class="btn btn-success">บันทึก</button>
                    <a href="product_admin.php" class="btn btn-secondary">ยกเลิก</a>
                </form>
            </div>
</body>

</html>