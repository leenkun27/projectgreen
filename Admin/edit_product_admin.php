<?php
include '../condb.php';

// รับค่า product_id จาก URL
if (isset($_GET['product_id'])) {
    $product_id = $_GET['product_id'];

    // Query ข้อมูลสินค้าเดิมจากฐานข้อมูล
    $sql = "SELECT product_name, cost_price, unit FROM product WHERE product_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $product_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $product_name = $row['product_name'];
        $cost_price = $row['cost_price'];
        $unit = $row['unit'];
    } else {
        echo "<script>alert('ไม่พบข้อมูลสินค้า'); window.location.href='product_list.php';</script>";
        exit();
    }

    $stmt->close();
    $conn->close();
} else {
    echo "<script>alert('ไม่มีการระบุ ID สินค้า'); window.location.href='product_list.php';</script>";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>แก้ไขสินค้า</title>
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
                <h2>แก้ไขข้อมูลสินค้า</h2>
                <form action="update_product.php" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="product_id" value="<?php echo $product_id; ?>">

                    <div class="mb-3">
                        <label for="product_name">ชื่อสินค้า</label>
                        <input type="text" class="form-control" id="product_name" name="product_name" value="<?php echo htmlspecialchars($product_name); ?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="cost_price">ราคาต้นทุน</label>
                        <input type="number" class="form-control" id="cost_price" name="cost_price" value="<?php echo htmlspecialchars($cost_price); ?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="unit">หน่วย</label>
                        <input type="text" class="form-control" id="unit" name="unit" value="<?php echo htmlspecialchars($unit); ?>" required>
                    </div>

                    <!-- ฟิลด์อื่นๆ -->
                    <button type="submit" class="btn btn-primary">บันทึก</button>
                    <a href="product_list.php" class="btn btn-secondary">ยกเลิก</a>
                </form>
            </div>
</body>

</html>