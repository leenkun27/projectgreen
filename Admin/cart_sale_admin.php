<?php
include '../condb.php';

$product_name = $_GET['product_name'] ?? '';
if (!$product_name) {
    echo "<div style='color:red;'>❌ ไม่พบชื่อของเก่าที่จะส่งขาย</div>";
    echo "<a href='sale_admin.php'>⬅️ กลับหน้าหลัก</a>";
    exit();
}

$sql = "SELECT ob.orderbuy_date, od.orderbuy_detail_id, od.quantity, od.total_price, od.price_per_unit, od.type_name, p.unit
        FROM orderbuy_detail od
        JOIN order_buy ob ON od.orderbuy_id = ob.orderbuy_id
        JOIN product p ON od.product_name = p.product_name
        WHERE od.product_name = '$product_name'
        AND od.is_sold = 0
        ORDER BY ob.orderbuy_date DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>รายการเตรียมส่งขาย</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>

<body>
    <div class="container">
        <?php include '../header_admin.php'; ?>
        <div class="row">
            <div class="col-2">
                <?php include '../menu_admin.php'; ?>
            </div>
            <div class="card mt-3 pb-5 px-2 col-10">
                <h3>ส่งขาย: <?= htmlspecialchars($product_name) ?></h3>

                <form method="post" action="save-ordersale_admin.php">
                    <input type="hidden" name="product_name" value="<?= htmlspecialchars($product_name) ?>">
                    <input type="hidden" name="ordersale_date" value="<?= date('Y-m-d') ?>">
                    <input type="hidden" name="name" value="ปพิชญา คำปิคา">

                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>เลือก</th>
                                <th>วันที่รับซื้อ</th>
                                <th>จำนวน (kg)</th>
                                <th>ราคารวม (บาท)</th>
                                <th>ราคาต่อกิโล (บาท)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 0;
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    $price_per_kg = ($row['price_per_unit'] > 0)
                                        ? $row['price_per_unit']
                                        : (($row['quantity'] > 0) ? $row['total_price'] / $row['quantity'] : 0);

                                    echo "<tr>";
                                    echo "<td>
                                        <input type='checkbox' name='products[$i][checked]' value='1'>
                                        <input type='hidden' name='products[$i][product_name]' value='" . htmlspecialchars($product_name) . "'>
                                        <input type='hidden' name='products[$i][orderbuy_detail_id]' value='{$row['orderbuy_detail_id']}'>
                                        <input type='hidden' name='products[$i][qty]' value='{$row['quantity']}'>
                                        <input type='hidden' name='products[$i][total_price]' value='{$row['total_price']}'>
                                        <input type='hidden' name='products[$i][price_per_unit]' value='$price_per_kg'>
                                        <input type='hidden' name='products[$i][type_name]' value='{$row['type_name']}'>
                                        <input type='hidden' name='products[$i][unit]' value='{$row['unit']}'>
                                    </td>";
                                    echo "<td>{$row['orderbuy_date']}</td>";
                                    echo "<td>{$row['quantity']}</td>";
                                    echo "<td>" . number_format($row['total_price'], 2) . "</td>";
                                    echo "<td>" . number_format($price_per_kg, 2) . "</td>";
                                    echo "</tr>";
                                    $i++;
                                }
                            } else {
                                echo "<tr><td colspan='5'>ไม่มีข้อมูล</td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>

                    <div class="mb-3">
                        <label for="sale_price" class="form-label">ราคาขายต่อกิโลกรัม (บาท):</label>
                        <input type="number" step="0.01" class="form-control" name="sale_price" id="sale_price" required>
                    </div>

                    <div id="summary" class="bg-light border rounded p-3 mb-3"></div>

                    <button type="submit" class="btn btn-success">✅ ยืนยันส่งขาย</button>
                    <a href="sale_admin.php" class="btn btn-secondary">ย้อนกลับ</a>
                </form>
            </div>
        </div>
    </div>

    <script>
        const salePriceInput = document.getElementById('sale_price');
        const checkboxes = document.querySelectorAll('input[type="checkbox"][name^="products"]');

        function updateSummary() {
            let totalWeight = 0;
            let totalCost = 0;

            checkboxes.forEach((cb) => {
                if (cb.checked) {
                    const parent = cb.parentElement;
                    const qty = parseFloat(parent.querySelector('input[name$="[qty]"]').value);
                    const total_price = parseFloat(parent.querySelector('input[name$="[total_price]"]').value);
                    totalWeight += qty;
                    totalCost += total_price;
                }
            });

            const salePrice = parseFloat(salePriceInput.value) || 0;
            const avgCost = totalWeight > 0 ? totalCost / totalWeight : 0;
            const totalSale = salePrice * totalWeight;
            const profit = totalSale - totalCost;

            document.getElementById('summary').innerHTML = `
            <p><strong>ต้นทุนเฉลี่ยต่อกิโลกรัม:</strong> ${avgCost.toFixed(2)} บาท</p>
            <p><strong>ราคารวมที่ขายได้:</strong> ${totalSale.toFixed(2)} บาท</p>
            <p><strong style="color:green;">กำไร:</strong> ${profit.toFixed(2)} บาท</p>
        `;
        }

        checkboxes.forEach(cb => cb.addEventListener('change', updateSummary));
        salePriceInput.addEventListener('input', updateSummary);
    </script>
    

</body>

</html>