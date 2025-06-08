<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "wichian_db";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$orderbuy_id = $_GET['orderbuy_id'] ?? 0;

$sql_order = "SELECT name, orderbuy_date FROM order_buy WHERE orderbuy_id = $orderbuy_id";
$res_order = $conn->query($sql_order);
$order = $res_order->fetch_assoc();
$employeeName = $order['name'];
$orderDate = date('d/m/Y', strtotime($order['orderbuy_date']));

$sql_detail = "SELECT product_name, type_name, quantity, unit, total_price, (total_price / quantity) AS unit_price 
               FROM orderbuy_detail WHERE orderbuy_id = $orderbuy_id";
$result = $conn->query($sql_detail);

echo "<!DOCTYPE html>
<html lang='th'>
<head>
    <meta charset='UTF-8'>
    <title>ใบเสร็จรับซื้อ</title>
    <style>
        body {
            font-family: 'TH Sarabun New', sans-serif;
            font-size: 20px;
            background: #e6f0fa;
            padding: 30px;
            color: #002b5c;
        }
        .receipt {
            max-width: 800px;
            margin: auto;
            background: white;
            padding: 30px;
            border: 2px solid #4a90e2;
        }
        .header {
            display: flex;
            border-bottom: 2px solid #002b5c;
            margin-bottom: 20px;
            padding-bottom: 10px;
        }
        .header img {
            width: 80px;
            height: auto;
            object-fit: contain;
            margin-right: 15px;
        }

        .store-info {
            flex: 1;
        }

        .store-info p {
            margin: 2px 0; /* ลดระยะห่างแนวตั้ง */
            line-height: 1.3; /* เพิ่มความหนาแน่นแต่ไม่เบียดเกินไป */
        }

        h2 {
            text-align: center;
            font-size: 24px;
            color: #004a99;
        }
        .details {
            margin-bottom: 15px;
        }
        .details p {
            margin: 4px 0;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid #004a99;
            padding: 8px;
            text-align: center;
        }
        th {
            background-color: #d8e8ff;
        }
        td.right {
            text-align: right;
            padding-right: 12px;
        }
        .summary {
            margin-bottom: 30px;
        }
        .summary td {
            padding: 6px;
        }
        .footer {
            text-align: center;
            margin-top: 30px;
            font-size: 18px;
            color: #555;
        }
        .signatures {
            margin-top: 50px;
            display: flex;
            justify-content: space-between;
        }
        .sign {
            width: 45%;
            text-align: center;
        }
        .sign-line {
            border-top: 1px solid #333;
            margin-top: 60px;
            padding-top: 5px;
        }
        button.print-btn {
            display: block;
            margin: 20px auto;
            background-color: #004a99;
            color: #fff;
            padding: 10px 30px;
            border: none;
            font-size: 18px;
            border-radius: 5px;
            cursor: pointer;
        }
        @media print {
            button.print-btn {
                display: none;
            }
        }

        .main-title {
    text-align: center;
    font-size: 32px;
    color: #003f88;
    font-weight: bold;
    margin: 10px 0 20px;
    text-decoration: underline;
}

    </style>
</head>
<body>
<div class='receipt'>
    <div class='header'>
        <img src='../img/logo2.jpg' alt='โลโก้ร้าน'>
        <div class='store-info'>
            <h3>ร้านรับซื้อของเก่า วิเชียรรุ่งเรือง</h3>
            <p>883/160 บ้านโนนม่วง ตำบลแก่งกระจาน</p>
            <p>อำเภอแก่งกระจาน จังหวัดเพชรบุรี 76170</p>
            <p>โทร: 089-225-6557</p>
        </div>
    </div>
    <h1 class='main-title'>ใบรับซื้อสินค้า</h1>
    <h2>ใบกำกับภาษี / ใบเสร็จรับเงิน</h2>
    <div class='details'>
        <p><strong>เลขที่ใบเสร็จ:</strong> ORB-{$orderbuy_id}</p>
        <p><strong>วันที่:</strong> {$orderDate}</p>
        <p><strong>ผู้รับซื้อ:</strong> {$employeeName}</p>
    </div>


    <table>
        <thead>
            <tr>
                <th>ลำดับ</th>
                <th>รายการ</th>
                <th>ประเภท</th>
                <th>จำนวน</th>
                <th>หน่วย</th>
                <th>ราคาต่อหน่วย</th>
                <th>ราคารวม</th>
            </tr>
        </thead>
        <tbody>";

$counter = 1;
$total = 0;
while ($row = $result->fetch_assoc()) {
    $total += $row['total_price'];
    echo "<tr>
            <td>{$counter}</td>
            <td>{$row['product_name']}</td>
            <td>{$row['type_name']}</td>
            <td>{$row['quantity']}</td>
            <td>{$row['unit']}</td>
            <td class='right'>" . number_format($row['unit_price'], 2) . "</td>
            <td class='right'>" . number_format($row['total_price'], 2) . "</td>
          </tr>";
    $counter++;
}

$tax = $total * 0.07;
$grandTotal = $total + $tax;

echo "   </tbody>
    </table>
    <table class='summary'>
        <tr><td align='right'><strong>ยอดรวม:</strong></td><td class='right'>" . number_format($total, 2) . " บาท</td></tr>
        <tr><td align='right'><strong>ภาษีมูลค่าเพิ่ม (7%):</strong></td><td class='right'>" . number_format($tax, 2) . " บาท</td></tr>
        <tr><td align='right'><strong>ยอดสุทธิ:</strong></td><td class='right'><strong>" . number_format($grandTotal, 2) . " บาท</strong></td></tr>
    </table>


    <button class='print-btn' onclick='window.print()'>พิมพ์ใบเสร็จ</button>

    <div class='footer'>
        ขอบคุณที่ใช้บริการ
    </div>
</div>
</body>
</html>";

$conn->close();
