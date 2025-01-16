<?php
$current_page = basename($_SERVER['PHP_SELF']);
?>
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

        .menu {
            list-style: none;
            padding: 0;
        }

        .menu li {
            display: inline-block;
            padding: 10px 15px;
            background: #ccc;
            margin-right: 5px;
            border-radius: 5px;
        }

        .menu li a {
            text-decoration: none;
            color: black;
        }

        .menu li.active {
            background:rgb(117, 36, 36);
            /* เปลี่ยนสีพื้นหลังของเมนูที่ Active */
            color: white;
        }

        .menu li.active a {
            color: white;
        }
    </style>
</head>

<body>
    <div class="sidebar">
        <div class="logo">
            <i class="bi bi-grid-3x3-gap-fill"></i>
        </div>
        <ul>
            <li class="<?= ($current_page == '../Admin_index_admin.php') ? 'active' : '' ?>">
                <a href="../Admin/index_admin.php"><i class="bi bi-house-door-fill"></i>หน้าหลัก</a>
            </li>

            <li class="<?= ($current_page == '../Admin/sale_admin.php') ? 'active' : '' ?>">
                <a href="../Admin/sale_admin.php"><i class="bi bi-basket-fill"></i> หน้าขาย</a>
            </li>

            <li class="<?= ($current_page == '../Admin/buy_admin.php') ? 'active' : '' ?>">
                <a href="../Admin/buy_admin.php"><i class="bi bi-bag-fill"></i> หน้ารับซื้อ</a>
            </li>

            <li class="<?= ($current_page == '../Admin/price_today_admin.php') ? 'active' : '' ?>">
                <a href="../Admin/price_today_admin.php"><i class="bi bi-tags-fill"></i> ราคาวันนี้</a>
            </li>


            <li class="<?= ($current_page == '../Admin/product_admin.php') ? 'active' : '' ?>">
                <a href="../Admin/product_admin.php"><i class="bi bi-cart-fill"></i> ข้อมูลของเก่า</a>
            </li>

            <li class="<?= ($current_page == '../Admin/stock_admin.php') ? 'active' : '' ?>">
                <a href="../Admin/stock_admin.php"><i class="bi bi-box-fill"></i> สต๊อก</a>
            </li>

            <li class="<?= ($current_page == '../Admin/dashboard_sale_admin.php') ? 'active' : '' ?>">
                <a href="../Admin/dashboard_sale_admin.php"><i class="bi bi-speedometer"></i> แดชบอร์ด</a>
            </li>

            <li class="<?= ($current_page == '../Admin/report_admin.php') ? 'active' : '' ?>">
                <a href="../Admin/report_admin.php"><i class="bi bi-clipboard-data-fill"></i> รายงาน</a>
            </li>

            <li class="<?= ($current_page == '../Admin/history_sale_admin.php') ? 'active' : '' ?>">
                <a href="../Admin/history_sale_admin.php"><i class="bi bi-file-text-fill"></i> ประวัติขาย</a>
            </li>

            <li class="<?= ($current_page == '../Admin/staff_admin.php') ? 'active' : '' ?>">
                <a href="../Admin/staff_admin.php"><i class="bi bi-person-circle"></i> ข้อมูลพนักงาน</a>
            </li>

            <li><a href="../logout.php"><i class="bi bi-door-open-fill"></i> ออกจากระบบ</a></li>
        </ul>
    </div>

</body>

</html>