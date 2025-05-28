<?php
$servername = "localhost"; 
$username = "root";        
$password = "";            
$dbname = "wichian_db";   

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) { die("Connection failed: " . $conn->connect_error); }

// ดึง orderbuy_id ล่าสุด
$sql_id = "SELECT orderbuy_id FROM order_buy ORDER BY orderbuy_id DESC LIMIT 1";
$res_id = $conn->query($sql_id);
$row_id = $res_id->fetch_assoc();
$orderbuy_id = $row_id['orderbuy_id'];

// ดึงข้อมูลผู้รับซื้อและวันที่
$sql_order = "SELECT name, orderbuy_date FROM order_buy WHERE orderbuy_id = $orderbuy_id";
$res_order = $conn->query($sql_order);
$order = $res_order->fetch_assoc();
$employeeName = $order['name'];
$orderDate = date('d-m-Y', strtotime($order['orderbuy_date']));

// ดึงรายการสินค้าและรายละเอียด
$sql_detail = "SELECT product_name, quantity, unit, total_price, (total_price / quantity) AS unit_price 
               FROM orderbuy_detail WHERE orderbuy_id = $orderbuy_id";
$result = $conn->query($sql_detail);

if ($result->num_rows > 0) {

echo "<!DOCTYPE html>
<html lang='th'>
<head>
<meta charset='UTF-8'>
<title>ใบเสร็จรับเงิน</title>
<style>
    body {
        font-family: 'TH Sarabun New', Arial, sans-serif;
        background: #eee;
        padding: 20px 0;
    }
    .receipt {
        max-width: 600px;
        margin: auto;
        background: white;
        padding: 25px 30px;
        border: 1px solid #ccc;
        box-shadow: 0 0 15px rgba(0,0,0,0.1);
    }
    .header {
        display: flex;
        align-items: center;
        border-bottom: 2px solid #333;
        padding-bottom: 15px;
        margin-bottom: 15px;
    }
    .header img {
        max-width: 120px;
        margin-right: 15px;
    }
    .store-info {
        flex: 1;
        font-size: 16px;
    }
    .store-info p {
        margin: 2px 0;
    }
    h2 {
        text-align: center;
        margin: 15px 0 20px;
        font-weight: bold;
        font-size: 22px;
        letter-spacing: 1px;
    }
    .details {
        margin-bottom: 20px;
        font-size: 16px;
    }
    .details b {
        display: inline-block;
        width: 120px;
    }
    table {
        width: 100%;
        border-collapse: collapse;
        font-size: 16px;
        margin-bottom: 20px;
    }
    th, td {
        border: 1px solid #444;
        padding: 8px 10px;
        text-align: center;
    }
    th {
        background: #f0f0f0;
        font-weight: bold;
    }
    td.right {
        text-align: right;
        padding-right: 12px;
    }
    .totals td {
        border: none;
        padding: 6px 10px;
    }
    .totals tr td:first-child {
        text-align: right;
        font-weight: bold;
        padding-right: 12px;
    }
    .footer {
        text-align: center;
        font-size: 14px;
        color: #666;
        margin-top: 30px;
        letter-spacing: 1px;
    }
    @media print {
        body {
            background: none;
            padding: 0;
        }
        .receipt {
            box-shadow: none;
            border: none;
            margin: 0;
            width: 100%;
            max-width: none;
            padding: 0;
        }
        button {
            display: none;
        }
    }
    button.print-btn {
        display: block;
        margin: 0 auto 30px;
        background-color: #333;
        color: #fff;
        border: none;
        padding: 10px 25px;
        font-size: 16px;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }
    button.print-btn:hover {
        background-color: #555;
    }
</style>
</head>
<body>
<div class='receipt'>
    <div class='header'>
        <img src='../img/logo2.jpg' alt='โลโก้ร้าน'>
        <div class='store-info'>
            <p><strong>ร้านรับซื้อของเก่า วิเชียรรุ่งเรือง</strong></p>
            <p>อำเภอแก่งกระจาน จังหวัดเพชรบุรี</p>
            <p>โทร: 089-225-6557</p>
        </div>
    </div>
    <h2>ใบกำกับภาษี/ใบเสร็จรับเงิน</h2>
    <div class='details'>
        <p><b>ผู้รับซื้อ:</b> $employeeName</p>
        <p><b>วันที่รับซื้อ:</b> $orderDate</p>
    </div>
    <table>
        <thead>
            <tr>
                <th>ลำดับ</th>
                <th>ชื่อสินค้า</th>
                <th>จำนวน</th>
                <th>หน่วย</th>
                <th>ราคา/หน่วย (บาท)</th>
                <th>จำนวนเงิน (บาท)</th>
            </tr>
        </thead>
        <tbody>";

        $counter = 1;
        $totalAmount = 0;

        while ($row = $result->fetch_assoc()) {
            $totalAmount += $row['total_price'];
            $unitPrice = number_format($row['unit_price'], 2);
            $totalPrice = number_format($row['total_price'], 2);

            echo "<tr>
                    <td>" . $counter++ . "</td>
                    <td>" . $row['product_name'] . "</td>
                    <td>" . $row['quantity'] . "</td>
                    <td>" . $row['unit'] . "</td>
                    <td class='right'>$unitPrice</td>
                    <td class='right'>$totalPrice</td>
                </tr>";
        }

        $taxAmount = $totalAmount * 0.07;
        $grandTotal = $totalAmount + $taxAmount;

echo "</tbody>
    </table>
    <table class='totals' style='width:100%;'>
        <tr>
            <td>ยอดรวม</td>
            <td class='right'>" . number_format($totalAmount, 2) . " บาท</td>
        </tr>
        <tr>
            <td>ภาษีมูลค่าเพิ่ม 7%</td>
            <td class='right'>" . number_format($taxAmount, 2) . " บาท</td>
        </tr>
        <tr>
            <td><strong>จำนวนเงินทั้งหมด</strong></td>
            <td class='right'><strong>" . number_format($grandTotal, 2) . " บาท</strong></td>
        </tr>
    </table>
    <button class='print-btn' onclick='window.print();'>พิมพ์ใบเสร็จ</button>
    <div class='footer'>
        ขอบคุณที่ใช้บริการ
    </div>
</div>
</body>
</html>";

} else {
    echo "ไม่พบข้อมูลการสั่งซื้อ";
}

$conn->close();
?>
