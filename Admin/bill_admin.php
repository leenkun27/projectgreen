<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ใบเสร็จรับเงิน</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .invoice-box {
            max-width: 800px;
            margin: auto;
            padding: 20px;
            border: 1px solid #eee;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
            font-size: 14px;
            line-height: 24px;
            font-family: 'Arial', sans-serif;
            color: #555;
        }

        .invoice-header {
            text-align: center;
            margin-bottom: 20px;
        }

        .invoice-details {
            margin-bottom: 20px;
        }

        .table td,
        .table th {
            vertical-align: middle;
        }

        .total {
            text-align: right;
        }
    </style>
</head>

<body>
    <div class="invoice-box">
        <div class="invoice-header">
            <h2>บริษัท วินดี จำกัด</h2>
            <p>52 คลองเตยเหนือ กรุงเทพฯ 10110</p>
            <p>เลขประจำตัวผู้เสียภาษี: 1054-99888-11-1</p>
            <p>โทร: 02-001-1414</p>
        </div>

        <!-- <div class="invoice-details">
            <div class="row">
                <div class="col-6">
                    <strong>ลูกค้า:</strong> <?php echo $invoice['customer_name']; ?><br>
                    ที่อยู่: <?php echo $invoice['customer_address']; ?><br>
                    เบอร์โทร: <?php echo $invoice['customer_phone']; ?>
                </div>
                <div class="col-6 text-end">
                    <strong>วันที่:</strong> <?php echo $invoice['invoice_date']; ?><br>
                    <strong>เลขที่:</strong> <?php echo $invoice['invoice_number']; ?><br>
                    <strong>ผู้เรียกเก็บ:</strong> <?php echo $invoice['issuer']; ?><br>
                    <strong>วันครบกำหนด:</strong> <?php echo $invoice['due_date']; ?><br>
                </div>
            </div>
        </div> -->

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ลำดับ</th>
                    <th>วันที่</th>
                    <th>ชื่อสินค้า</th>
                    <th>จำนวน</th>
                    <th>ราคาต่อหน่วย</th>
                    <th>จำนวนเงิน</th>
                </tr>
            </thead>
            <!-- <tbody>
                <?php foreach ($invoice['items'] as $index => $item) : ?>
                    <tr>
                        <td><?php echo $index + 1; ?></td>
                        <td><?php echo $item['date']; ?></td>
                        <td><?php echo $item['product']; ?></td>
                        <td><?php echo $item['quantity']; ?></td>
                        <td><?php echo number_format($item['unit_price'], 2); ?></td>
                        <td><?php echo number_format($item['quantity'] * $item['unit_price'], 2); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody> -->
        </table>

        <div class="row">
            <div class="col-6">
                <p><strong>หมายเหตุ:</strong> (รวมสินค้าโปรโมชั่นแล้ว)</p>
            </div>
            <div class="col-6">
                <p class="total"><strong>รวมเงิน:</strong> <?php echo number_format($total, 2); ?></p>
                <p class="total"><strong>ภาษีมูลค่าเพิ่ม 7%:</strong> <?php echo number_format($vat, 2); ?></p>
                <p class="total"><strong>รวมเป็นเงินทั้งสิ้น:</strong> <?php echo number_format($grand_total, 2); ?></p>
            </div>
        </div>
    </div>
</body>

</html>