<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sidebar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
        }

        .sidebar {
            height: 100vh;
            width: 250px;
            background-color: #000066;
            color: #fff;
            position: fixed;
            top: 0;
            left: 0;
            display: flex;
            flex-direction: column;
            padding: 20px 0;
        }

        .sidebar .logo {
            font-size: 24px;
            font-weight: bold;
            text-align: center;
            margin-bottom: 20px;
        }

        .sidebar ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .sidebar ul li {
            margin: 10px 0;
        }

        .sidebar ul li a {
            text-decoration: none;
            color: #fff;
            padding: 10px 20px;
            border-radius: 5px;
            display: block;
            transition: background-color 0.3s ease;
        }

        .sidebar ul li a:hover {
            background-color: #3399FF;
        }

        .sidebar ul li a.active {
            background-color: #3399FF;
        }

        .sidebar ul li a i {
            margin-right: 10px;
        }

        .content {
            margin-left: 250px;
            padding: 20px;
        }

    </style>
</head>

<body>
    <div class="sidebar">
        <div class="logo">
            <i class="bi bi-grid-3x3-gap-fill"></i> 
        </div>
        <ul>
            <li><a href="#" class="active"><i class="bi bi-house-door-fill"></i> หน้าหลัก</a></li>
            <li><a href="../Employee/sale_admin.php"><i class="bi bi-basket-fill"></i> หน้าขาย</a></li>
            <li><a href="../Employee/buy_admin.php"><i class="bi bi-bag-fill"></i> รับซื้อ</a></li>
            <li><a href="../Employee/product_admin.php"><i class="bi bi-cart-fill"></i> ข้อมูลของเก่า</a></li>
            <li><a href="../Employee/stock_admin.php"><i class="bi bi-box-fill"></i> สต๊อก</a></li>
            <li><a href="../Employee/history_sale_admin.php"><i class="bi bi-file-text-fill"></i> ประวัติขาย</a></li>
            <li><a href="../Employee/staff_admin.php"><i class="bi bi-person-circle"></i> ข้อมูลพนักงาน</a></li>
            <li><a href="#"><i class="bi bi-door-open-fill"></i> ออกจากระบบ</a></li>
        </ul>
    </div>
  
</body>

</html>