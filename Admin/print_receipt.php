<?php
$servername = "localhost"; 
$username = "root";        
$password = "";            
$dbname = "wichian_db";   

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT order_buy.orderbuy_id, order_buy.name, order_buy.orderbuy_date, orderbuy_detail.product_name, orderbuy_detail.quantity, orderbuy_detail.unit, orderbuy_detail.total_price
        FROM order_buy
        INNER JOIN orderbuy_detail ON order_buy.orderbuy_id = orderbuy_detail.orderbuy_id
        WHERE order_buy.orderbuy_id = (SELECT orderbuy_id FROM order_buy ORDER BY orderbuy_id DESC LIMIT 1);";
$result = $conn->query($sql);

if ($result->num_rows > 0) {

    $totalAmount = 0;
    $taxAmount = 0;
    $grandTotal = 0;

    $customerName = "";
    $orderDate = date("d-m-Y");

    $html = "
    <html lang='th'>
    <head>
        <meta charset='UTF-8'>
        <title>ใบเสร็จรับเงิน</title>
        <style>
            body { font-family: Arial, sans-serif; margin: 0; padding: 0; display: flex; justify-content: center; align-items: center; height: 100vh; background-color: #f4f4f4; }
            .receipt-container { width: 70%; max-width: 800px; background-color: #fff; padding: 20px; border-radius: 10px; box-shadow: 0 0 15px rgba(0, 0, 0, 0.1); }
            .receipt-header { text-align: center; font-size: 22px; font-weight: bold; margin-bottom: 20px; }
            .receipt-body { margin-top: 20px; }
            .item-table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
            .item-table th, .item-table td { border: 1px solid #000; padding: 8px; text-align: left; }
            .footer { text-align: center; margin-top: 20px; font-size: 14px; }
            .total { text-align: right; font-weight: bold; font-size: 16px; }
            .address { margin-top: 20px; }
            @media print {
                body {
                    width: 100%;
                    font-size: 14px;
                }
                .receipt-header {
                    font-size: 18px;
                }
                .footer {
                    page-break-after: always;
                }
            }
        </style>
    </head>
    <body>
    
    <div class='receipt-container'>
        <div class='receipt-header'>
            <p>ร้านรับซื้อของเก่า วิเชียรรุ่งเรือง</p>
            <p>อำเภอแก่งกระจาน จังหวัดเพชรบุรี</p>
            <p>โทร: 089-225-6557</p>
            <hr>
            <h2>ใบกำกับภาษี/ใบเสร็จรับเงิน</h2>
        </div>

        <div class='receipt-body'>
            <p>ผู้รับซื้อ / Member: <b>";

    while ($row = $result->fetch_assoc()) {
        $employeeName = $row['name'];
        break;  
    }

    $html .= $employeeName . "</b></p>";

    $html .= "<table class='item-table'>
                <thead>
                    <tr>
                        <th>ลำดับ</th>
                        <th>วันที่</th>
                        <th>ชื่อสินค้า</th>
                        <th>จำนวน</th>
                        <th>ราคา/หน่วย</th>
                        <th>จำนวนเงิน</th>
                    </tr>
                </thead>
                <tbody>";

    $result->data_seek(0);

    $counter = 1;

    while ($row = $result->fetch_assoc()) {
        $totalAmount += $row['total_price']; 
        $html .= "
            <tr>
                <td>{$counter}</td>
                <td>{$orderDate}</td>
                <td>{$row['product_name']}</td>
                <td>{$row['quantity']}</td>
                <td>{$row['total_price']} บาท</td>
                <td>{$row['total_price']} บาท</td>
            </tr>";
        $counter++;
    }

    $taxAmount = $totalAmount * 0.07;
    $grandTotal = $totalAmount + $taxAmount;

    $html .= "
            </tbody>
        </table>
        
        <div class='total'>
            <p>ยอดรวม: {$totalAmount} บาท</p>
            <p>ภาษีมูลค่าเพิ่ม 7%: {$taxAmount} บาท</p>
            <p><b>จำนวนเงินทั้งหมด: {$grandTotal} บาท</b></p>
        </div>
    </div>

    <div class='footer'>
        ขอบคุณที่ใช้บริการ
        <button onclick='window.print();'>พิมพ์ใบเสร็จ</button>
    </div>
    
    </div>
    </body>
    </html>";

    echo $html;

} else {
    echo "ไม่พบข้อมูลการสั่งซื้อในวันนี้";
}

$conn->close();
?>
