<?php
session_start();
include '../condb.php';

// Query for joining product and product_type tables
$query = "
    SELECT 
        product.product_id, 
        product.product_name, 
        product.price_today, 
        product.type_id, 
        product_type.type_name,
        product.unit
    FROM 
        product
    LEFT JOIN 
        product_type 
    ON 
        product.type_id = product_type.type_id
";

$result = $conn->query($query);

if (!$result) {
    die("Query failed: " . $conn->error);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buy Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <div class="container mt-5">
        <h2 class="mb-4">รายการสินค้า</h2>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ลำดับ</th>
                    <th>ชื่อสินค้า</th>
                    <th>ประเภทสินค้า</th>
                    <th>ราคาวันนี้</th>
                    <th>หน่วย</th>
                    
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()) { ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['product_id']); ?></td>
                        <td><?php echo htmlspecialchars($row['product_name']); ?></td>
                        <td><?php echo htmlspecialchars($row['type_name']); ?></td>
                        <td><?php echo htmlspecialchars($row['price_today']); ?></td>
                        <td><?php echo htmlspecialchars($row['unit']); ?></td>    
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</body>

</html>