<?php
include '../condb.php';
?>
<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ราคาประจำวัน - ร้านขายของเก่า</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        body {
            font-family: 'Kanit', sans-serif;
            background-color: #f0f2f5;
            margin: 0;
        }

        .wrapper {
            display: flex;
        }

        .sidebar {
            width: 250px;
            background-color: #001f5f;
            min-height: 100vh;
            color: white;
            padding: 20px 10px;
        }

        .main {
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .content-card {
            background: white;
            border-radius: 10px;
            padding: 30px;
            margin-top: 30px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 1200px;
        }

        .hero-img {
            width: 100%;
            height: auto;
            object-fit: cover;
            border-radius: 10px;
            margin-bottom: 20px;
        }

        .price-table th {
            background-color: #004aad;
            color: white;
        }

        .price-table td {
            background-color: white;
        }

        .down {
            color: red;
        }

        footer {
            background-color: #004aad;
            color: white;
            padding: 30px 20px;
            margin-top: 40px;
            border-radius: 10px;
        }

        footer h5 {
            border-bottom: 1px solid rgba(255, 255, 255, 0.3);
            padding-bottom: 5px;
        }

        footer a {
            color: white;
            text-decoration: underline;
        }
    </style>
</head>

<body onload="updateTime()">
    <div class="wrapper">
        <?php include '../header_admin.php'; ?>
        <div class="sidebar">
            <?php include '../menu_admin.php'; ?>
        </div>

        <div class="main">
            <!-- กล่องการ์ดใหญ่เริ่มตรงนี้ -->
            <div class="content-card ">

                <img src="./index.png" class="hero-img" alt="ภาพหน้าร้าน">

                <h3 class="text-center text-primary">อัพเดทราคาประจำวัน</h3>
                <p id="current-time" class="text-center text-muted"></p>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <table class="table table-bordered price-table">
                            <thead>
                                <tr>
                                    <th>ทองแดง</th>
                                    <th>ราคา / PRICE</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>ทองแดงปอกสวย</td>
                                    <td class="down">292</td>
                                </tr>
                                <tr>
                                    <td>ทองแดงช็อตดำ</td>
                                    <td class="down">281</td>
                                </tr>
                                <tr>
                                    <td>ทองแดงใหญ่/ท่อเก่า</td>
                                    <td class="down">270</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-6 mb-3">
                        <table class="table table-bordered price-table">
                            <thead>
                                <tr>
                                    <th>ทองเหลือง</th>
                                    <th>ราคา / PRICE</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>ทองเหลืองหนา</td>
                                    <td class="down">190</td>
                                </tr>
                                <tr>
                                    <td>หม้อน้ำทองเหลือง</td>
                                    <td class="down">173</td>
                                </tr>
                                <tr>
                                    <td>ขี้กลึงทองเหลืองสะอาด</td>
                                    <td class="down">140</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

               
            </div>
            <!-- จบการ์ด -->
        </div>
    </div>
     <footer class="rounded">
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <h5>ติดต่อเรา</h5>
                            <p>วิเชียรรุ่งเรือง</p>
                            <p>ต.แก่งกระจาน อ.แก่งกระจาน จ.เพชรบุรี 76170</p>
                            <p>📞 089-2256557</p>
                            <p>LINE: <a href="https://line.me">@wichiann</a></p>
                            <p>Facebook: <a href="https://facebook.com">ร้านวิเชียรรุ่งเรืองร้านรับซื้อของเก่า</a></p>
                        </div>
                        <div class="col-md-4 mb-3">
                            <h5>บริการของเรา</h5>
                            <ul>
                                <li>รับซื้อของเก่าทุกชนิด</li>
                                <li>เฟอร์นิเจอร์ เครื่องใช้ไฟฟ้า ตู้เย็น ทีวี แอร์</li>
                                <li>บริการรับซื้ออะลูมิเนียม</li>
                            </ul>
                        </div>
                        <div class="col-md-4 mb-3">
                            <h5>แผนที่</h5>
                            <iframe src="https://www.google.com/maps/embed?pb=..."
                                width="100%" height="200" style="border:0;" allowfullscreen loading="lazy">
                            </iframe>
                        </div>
                    </div>
                </footer>
    <script>
        function updateTime() {
            const now = new Date();
            const options = {
                year: 'numeric',
                month: 'long',
                day: 'numeric',
                hour: 'numeric',
                minute: 'numeric',
                second: 'numeric'
            };
            document.getElementById('current-time').textContent =
                now.toLocaleDateString('th-TH', options);
        }
        setInterval(updateTime, 1000);
    </script>
</body>

</html>
