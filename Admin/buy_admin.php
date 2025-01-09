<?php
session_start();
include '../condb.php';

// ดึงข้อมูลประเภทสินค้า
$type_result = $conn->query("SELECT type_id, type_name FROM product_type");
// ดึงข้อมูลสินค้า
$product_result = $conn->query("SELECT product_id, product_name FROM product");

// ถ้ามีการกดเพิ่มสินค้า
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $product_name = $_POST['product_name'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];

    $total = $price * $quantity;

    $_SESSION['cart'][] = [
        'product_name' => $product_name,
        'price' => $price,
        'quantity' => $quantity,
        'total' => $total
    ];

    echo json_encode(['success' => true]);
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Do</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

</head>

<style>
    body {
        font-family: Arial, sans-serif;
        padding: 20px;
    }

    select {
        padding: 10px;
        margin: 10px 0;
        width: 200px;
    }
</style>

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
                        <h2><i class="bi-basket fs-5 me-2"></i> รับซื้อสินค้า</h2>
                    </div>
                    <div class="row mt-5">
                        <div class="col-lg-6 col-md-4 col-sm-6">
                            <label for="p_date">วันที่รับซื้อ</label>
                            <div class="input-group">
                                <input type="date" class="form-control" id="p_date" readonly>
                            </div>
                        </div>

                        <script>
                            document.addEventListener("DOMContentLoaded", function() {
                                const dateField = document.getElementById("p_date");
                                const now = new Date();
                                const formattedDate = now.toISOString().split("T")[0]; // รูปแบบ YYYY-MM-DD
                                dateField.value = formattedDate;
                            });
                        </script>


                        <div class="col-6 ">
                            ชื่อพนักงานที่รับซื้อ
                            <div class="input-group">
                                <input type="text" class="form-control" id="p_name" placeholder="กรอกชื่อพนักงาน">
                            </div>
                        </div>

                        <div class="col-6 mt-2">
                            <!-- Dropdown ประเภทของเก่า -->
                            <form action="process.php" method="POST">
                                <label for="type">เลือกประเภท:</label>

                                <select class="form-control" name="type" id="type" placeholder="">
                                    <option value="">-- เลือกประเภท --</option>
                                    <?php
                                    if ($type_result->num_rows > 0) {
                                        while ($row = $type_result->fetch_assoc()) {
                                            echo "<option value='" . $row['type_id'] . "'>" . $row['type_name'] . "</option>";
                                        }
                                    }
                                    ?>
                                </select>

                        </div>


                        <div class="col-6 mt-2">
                            <!-- Dropdown ของเก่า -->
                            <label for="product">เลือกชื่อของเก่า:</label>
                            <select class="form-control" name="product" id="product" placeholder="">
                                <option value="">-- เลือกชื่อของเก่า --</option>
                            </select>

                        </div>


                        <div class="col-6 mt-2">
                            <div>ปริมาณการรับซื้อ</div>
                            <div class="input-group">
                                <input type="text" class="form-control" name="quantity" id="quantity" required min="1">
                            </div>
                        </div>


                        <div class="col-6 mt-2">
                            <div>ราคารับซื้อวันนี้</div>
                            <div class="input-group">
                                <input type="text" class="form-control" name="price" id="price" readonly>
                            </div>
                        </div>

                        <div class="col-12 mt-3 text-end">
                            <button type="button" id="addButton" class="btn btn-success">เพิ่ม</button>
                        </div>


                        <h2>ตะกร้าสินค้า</h2>
                        <table border="1">
                            <thead>
                                <tr>
                                    <th>ชื่อสินค้า</th>
                                    <th>จำนวน</th>
                                    <th>ราคา</th>
                                    <th>รวม</th>
                                </tr>
                            </thead>
                            <tbody id="cart"></tbody>
                        </table>
                    </div>

                    <div class="summary">
                        <p>ยอดรวมทั้งหมด: <span id="grand-total">0.00</span> บาท</p>
                    </div>

                    <div class="text-end mt-3">
                        <button type="button" id="saveButton" class="btn btn-primary">บันทึก</button>
                        <a href="product_list.php" class="btn btn-secondary">ยกเลิก</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>


    </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
        $("#addButton").click(function() {
            let productName = $("#product option:selected").text();
            let quantity = parseInt($("#quantity").val());
            let price = parseFloat($("#price").val());
            let total = price * quantity;

            if (!productName || isNaN(price) || isNaN(quantity)) {
                alert("กรุณากรอกข้อมูลให้ครบถ้วน");
                return;
            }

            let row = `<tr>
                <td>${productName}</td>
                <td>${quantity}</td>
                <td>${price.toFixed(2)}</td>
                <td>${total.toFixed(2)}</td>
            </tr>`;

            $("#cart").append(row);

            // ล้างค่าหลังจากเพิ่มลงตะกร้า
            $("#quantity").val('');
            $("#price").val('');
        });

        // ตรวจสอบว่า jQuery โหลดสำเร็จหรือไม่
        if (!window.jQuery) {
            alert("jQuery ไม่โหลด กรุณาตรวจสอบการเชื่อมต่อ");
        }
    });
    
        // เมื่อเลือกประเภท
        $("#type").change(function() {
            const typeId = $(this).val();
            if (typeId) {
                $.post("fetch_products.php", {
                    type_id: typeId
                }, function(data) {
                    $("#product").html(data);
                });
            } else {
                $("#product").html('<option value="">-- เลือกชื่อของเก่า --</option>');
            }
        });

        // เมื่อเลือกชื่อของเก่า
        $("#product").change(function() {
            const productId = $(this).val();
            if (productId) {
                $.post("fetch_price.php", {
                    product_id: productId
                }, function(data) {
                    $("#price").val(data);
                    $("#unit").val(data);
                });
            } else {
                $("#price").val('');
            }
        });
    </script>

</body>

</html>
<?php
$conn->close();
?>