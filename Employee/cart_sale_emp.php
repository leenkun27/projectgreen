<?php
include '../condb.php';

$product_name = $_GET['product_name'] ?? '';
if (!$product_name) {
    echo "<div style='color:red;'>❌ ไม่พบชื่อของเก่าที่จะส่งขาย</div>";
    echo "<a href='sale_admin.php'>⬅️ กลับหน้าหลัก</a>";
    exit();
}

$sql_min = "SELECT minimum_sale FROM product WHERE product_name = '$product_name'";
$res_min = $conn->query($sql_min);
$min_row = $res_min->fetch_assoc();
$min_sale_qty = $min_row['minimum_sale'] ?? 0;

$sql = "SELECT ob.orderbuy_date, od.orderbuy_detail_id, od.quantity, od.total_price, od.price_per_unit, od.type_name, p.unit
        FROM orderbuy_detail od
        JOIN order_buy ob ON od.orderbuy_id = ob.orderbuy_id
        JOIN product p ON od.product_name = p.product_name
        WHERE od.product_name = '$product_name' AND od.is_sold = 0
        ORDER BY ob.orderbuy_date DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <title>รายการเตรียมส่งขาย</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-4">
        <?php include '../header_emp.php'; ?>
        <div class="row">
            <div class="col-2"><?php include '../menu_emp.php'; ?></div>
            <div class="card col-10 pt-3 px-3 pb-5">
                <h3>ส่งขาย: <?= htmlspecialchars($product_name) ?></h3>

                <form method="post" action="save-ordersale_emp.php">
                    <input type="hidden" name="product_name" value="<?= htmlspecialchars($product_name) ?>">
                    <input type="hidden" name="ordersale_date" value="<?= date('Y-m-d') ?>">
                    <input type="hidden" name="name" value="ปพิชญา คำปิคา">

                    <table class="table table-bordered mt-3">
                        <thead class="table-light">
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
                                    $ppu = $row['price_per_unit'] > 0 ? $row['price_per_unit'] : ($row['quantity'] > 0 ? $row['total_price'] / $row['quantity'] : 0);

                                    echo "<tr>";
                                    echo "<td><input type='checkbox' name='products[$i][checked]' value='1'></td>";
                                    echo "<td>{$row['orderbuy_date']}</td>";
                                    echo "<td>{$row['quantity']}</td>";
                                    echo "<td>" . number_format($row['total_price'], 2) . "</td>";
                                    echo "<td>" . number_format($ppu, 2) . "</td>";

                                    echo "<input type='hidden' name='products[$i][product_name]' value='" . htmlspecialchars($product_name) . "'>";
                                    echo "<input type='hidden' name='products[$i][orderbuy_detail_id]' value='{$row['orderbuy_detail_id']}'>";
                                    echo "<input type='hidden' name='products[$i][qty]' value='{$row['quantity']}'>";
                                    echo "<input type='hidden' name='products[$i][total_price]' value='{$row['total_price']}'>";
                                    echo "<input type='hidden' name='products[$i][price_per_unit]' value='$ppu'>";
                                    echo "<input type='hidden' name='products[$i][type_name]' value='{$row['type_name']}'>";
                                    echo "<input type='hidden' name='products[$i][unit]' value='{$row['unit']}'>";
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
                    <a href="sale_employee.php" class="btn btn-secondary">ย้อนกลับ</a>
                </form>
            </div>
        </div>
    </div>

    <script>
        const checkboxes = document.querySelectorAll('input[type="checkbox"][name^="products"]');
        const salePriceInput = document.getElementById('sale_price');
        const submitBtn = document.querySelector("button[type='submit']");

        const warningMsg = document.createElement('div');
        warningMsg.id = 'warning-msg';
        warningMsg.className = "text-danger small mt-2";
        warningMsg.style.display = "none";
        submitBtn.parentElement.appendChild(warningMsg);

        function updateSummary() {
            let totalWeight = 0;
            let totalCost = 0;

            checkboxes.forEach((cb, i) => {
                if (cb.checked) {
                    const qty = parseFloat(document.querySelector(`input[name="products[${i}][qty]"]`).value);
                    const cost = parseFloat(document.querySelector(`input[name="products[${i}][total_price]"]`).value);
                    totalWeight += qty;
                    totalCost += cost;
                }
            });

            const salePrice = parseFloat(salePriceInput.value) || 0;
            const avgCost = totalWeight > 0 ? totalCost / totalWeight : 0;
            const totalSale = salePrice * totalWeight;
            const profit = totalSale - totalCost;

            document.getElementById('summary').innerHTML = `
                <p><strong>จำนวน:</strong> ${totalWeight.toFixed(2)} กิโลกรัม</p>
                <p><strong>ต้นทุนเฉลี่ยต่อกิโลกรัม:</strong> ${avgCost.toFixed(2)} บาท</p>
                <p><strong>ราคารวมที่ขายได้:</strong> ${totalSale.toFixed(2)} บาท</p>
                <p><strong style="color:green;">กำไร:</strong> ${profit.toFixed(2)} บาท</p>
            `;
            validateMinimum(totalWeight);
        }

        function validateMinimum(totalQty) {
            const minQty = <?= (int)$min_sale_qty ?>;
            if (totalQty < minQty) {
                warningMsg.textContent = `❌ ยังไม่สามารถส่งขายได้ เนื่องจากไม่ถึงจำนวนขายขั้นต่ำ (${minQty} กก.)`;
                warningMsg.style.display = "block";
                submitBtn.disabled = true;
            } else {
                warningMsg.style.display = "none";
                submitBtn.disabled = false;
            }
        }

        checkboxes.forEach(cb => cb.addEventListener('change', updateSummary));
        salePriceInput.addEventListener('input', updateSummary);
        updateSummary();
    </script>
</body>

</html>