<?php
session_start();
include '../condb.php';

$type_query = "SELECT type_id, type_name FROM product_type";
$type_result = $conn->query($type_query);

// ดึงข้อมูล product_name
$product_query = "SELECT product_id, product_name FROM product";
$product_result = $conn->query($product_query);

// เพิ่มข้อมูลใน session
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $product_name = $_POST['product_name'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];
    $total = $price * $quantity;

    // เก็บข้อมูลลง session
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }
    $_SESSION['cart'][] = [
        'product_name' => $product_name,
        'price' => $price,
        'quantity' => $quantity,
        'total' => $total,
    ];
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
                                <input type="text" class="form-control" id="p_name" placeholder="กรอกชื่อพนักงาน" placeholder="กรอกชื่อของเก่า" onkeydown="checkEnter(event)">
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

                        <div class="d-flex justify-content-end mt-3">
                            <button type="submit" class="ms-2 btn btn-success">เพิ่ม</button>
                        </div>


                        <div class="table-responsive mt-3">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>ลำดับ</th>
                                        <th>ชื่อสินค้า</th>
                                        <th>จำนวน</th>
                                        <th>ราคาต่อหน่วย</th>
                                        <th>จำนวนเงิน</th>
                                        <th>ภาษี</th>
                                        <th>หมายเหตุ</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $grand_total = 0;
                                    $total_tax = 0;
                                    $row_number = 1;

                                    if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0) {
                                        foreach ($_SESSION['cart'] as $item) {
                                            $tax = $item['total'] * 0.07; // สมมติคิดภาษี 7%
                                            $grand_total += $item['total'];
                                            $total_tax += $tax;

                                            echo "<tr>
                        <td>{$row_number}</td>
                        <td>{$item['product_name']}</td>
                        <td>{$item['quantity']}</td>
                        <td>" . number_format($item['price'], 2) . "</td>
                        <td>" . number_format($item['total'], 2) . "</td>
                        <td>" . number_format($tax, 2) . "</td>
                        <td> - </td> <!-- ตัวอย่างหมายเหตุ -->
                    </tr>";

                                            $row_number++;
                                        }
                                    } else {
                                        echo "<tr><td colspan='9'>ไม่มีข้อมูลสินค้า</td></tr>";
                                    }
                                    ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="4" class="text-end"><strong>รวมทั้งหมด</strong></td>
                                        <td><strong><?php echo $row_number - 1; ?></strong></td>
                                        <td></td>
                                        <td><strong><?php echo number_format($grand_total, 2); ?></strong></td>
                                        <td><strong><?php echo number_format($total_tax, 2); ?></strong></td>
                                        <td></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>

                        <h3>ยอดรวมทั้งหมด: <?php echo $grand_total; ?> บาท</h3>
                    </div>
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
            // เมื่อคลิกปุ่ม "เพิ่ม"
            $('#addButton1').click(function() {
                var p_name = $('#p_name').val();
                var p_type = $('#p_type').val();
                var p_qty = $('#p_qty').val();
                var p_price = $('#p_price').val();

                // ตรวจสอบว่าข้อมูลครบหรือไม่
                if (p_name.trim() === "" || p_qty.trim() === "" || p_price.trim() === "") {
                    alert("กรุณากรอกข้อมูลให้ครบ");
                    return;
                }

                // ส่งข้อมูลไปยัง PHP ด้วย AJAX
                $.ajax({
                    url: 'add_product.php', // ไฟล์ PHP ที่จะบันทึกข้อมูล
                    type: 'POST',
                    data: {
                        p_name: p_name,
                        p_type: p_type,
                        p_qty: p_qty,
                        p_price: p_price
                    },
                    success: function(response) {
                        // เมื่อข้อมูลถูกบันทึกสำเร็จ
                        var data = JSON.parse(response); // สมมติว่า PHP ส่งข้อมูลกลับในรูปแบบ JSON
                        if (data.success) {
                            // คำนวณจำนวนเงิน
                            var total_price = data.qty * data.price;

                            // เพิ่มแถวใหม่ในตาราง
                            var newRow = `
                        <tr>
                            <td>${data.date}</td>
                            <td>${data.name}</td>
                            <td>${data.type}</td>
                            <td>${data.qty}</td>
                            <td>${data.price}</td>
                            <td>${total_price}</td>
                        </tr>
                    `;
                            $('#productTableBody').append(newRow);

                            // ล้างข้อมูลในฟอร์ม
                            $('#p_name').val('');
                            $('#p_qty').val('');
                            $('#p_price').val('');
                        } else {
                            alert('บันทึกข้อมูลไม่สำเร็จ');
                        }
                    }
                });
            });
        });

        $(document).ready(function() {
            // เมื่อเลือกประเภท
            $("#type").change(function() {
                const typeId = $(this).val();
                $("#product").html('<option value="">-- กำลังโหลดข้อมูล --</option>');

                if (typeId) {
                    $.ajax({
                        url: "fetch_products.php",
                        type: "POST",
                        data: {
                            type_id: typeId
                        },
                        success: function(data) {
                            $("#product").html(data);
                        }
                    });
                } else {
                    $("#product").html('<option value="">-- เลือกชื่อของเก่า --</option>');
                }
            });

            // เมื่อเลือกชื่อของเก่า
            $("#product").change(function() {
                const productId = $(this).val();
                $("#price").val(""); // ล้างค่าเดิมในช่องราคา

                if (productId) {
                    $.ajax({
                        url: "fetch_price.php",
                        type: "POST",
                        data: {
                            product_id: productId
                        },
                        success: function(data) {
                            $("#price").val(data);
                        }
                    });
                }
            });
        });
    </script>

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

<?php
$conn->close();
?>