<?php include '../condb.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ร้านขายของเก่า</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background: url('https://via.placeholder.com/1500x1000') no-repeat center center/cover;
            color: #333;
        }

        header {
            background-color: rgba(0, 0, 0, 0.7);
            padding: 20px;
            text-align: center;
            color: white;
        }

        header h1 {
            margin: 0;
        }

        nav {
            background-color: rgba(0, 0, 0, 0.8);
            display: flex;
            justify-content: center;
            padding: 10px 0;
        }

        nav a {
            color: white;
            text-decoration: none;
            padding: 10px 20px;
            margin: 0 10px;
            transition: background-color 0.3s ease;
        }

        nav a:hover {
            background-color: rgba(255, 255, 255, 0.3);
        }

        .hero {
            text-align: center;
            padding: 50px 20px;
            color: white;
            background: rgba(0, 0, 0, 0.6);
            margin: 20px;
            border-radius: 10px;
        }

        .hero h2 {
            font-size: 2.5em;
            margin-bottom: 20px;
        }

        .hero p {
            font-size: 1.2em;
        }

        .price-section {
            padding: 30px;
            background-color: #f9f9f9;
        }

        .price-section h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #004aad;
        }

        .price-section .time {
            text-align: center;
            margin-bottom: 20px;
            font-size: 1em;
            color: #666;
        }

        .price-container {
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
        }

        .price-table {
            flex: 1 1 45%;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            margin: 10px;
            overflow: hidden;
        }

        .price-table table {
            width: 100%;
            border-collapse: collapse;
        }

        .price-table th,
        .price-table td {
            padding: 10px;
            text-align: left;
            border: 1px solid #ddd;
        }

        .price-table th {
            background-color: #004aad;
            color: white;
        }

        .price-table td {
            background-color: #f9f9f9;
        }

        .price-table .down {
            color: red;
        }

        footer {
            background-color: #004aad;
            color: white;
            padding: 30px 20px;
            text-align: center;
        }

        footer .container {
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
            max-width: 1200px;
            margin: 0 auto;
        }

        footer .column {
            flex: 1 1 30%;
            margin: 10px;
        }

        footer h3 {
            margin-bottom: 10px;
            font-size: 1.2em;
        }

        footer p,
        footer a {
            font-size: 0.9em;
            color: white;
            text-decoration: none;
        }

        footer a:hover {
            text-decoration: underline;
        }
    </style>

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
            document.getElementById('current-time').textContent = now.toLocaleDateString('th-TH', options);
        }
        setInterval(updateTime, 1000);
    </script>
</head>

<body
    onload="updateTime()">
    <section class="img">
        <img src="index.png" class="" width="1700" height="600">
    </section>


    <section class="price-section">
        <h2>อัพเดทราคาประจำวัน</h2>
        <p id="current-time" class="time"></p>
        <div class="price-container">
            <div class="price-table">
                <table>
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
            <div class="price-table">
                <table>
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
    </section>





    <footer>
        <div class="container">
            <div class="column">
                <h3>ติดต่อเรา</h3>
                <p>วิเชียรรุ่งเรือง</p>
                <p>ที่อยู่ :</p>
                <p>ต.แก่งกระจาน อ.แก่งกระจาน จ.เพชรบุรี 76170</p>
                <p>📞 089 -2256557</p>
                <p>LINE: <a href="https://line.me">@wichiann</a></p>
                <p>Facebook: <a href="https://facebook.com">ร้านวิเชียรรุ่งเรืองร้านรับซื้อของเก่า</a></p>
            </div>
            <div class="column">
                <h3>บริการของเรา</h3>
                <ul>
                    <li>รับซื้อของเก่าทุกชนิด</li>
                    <li>เฟอร์นิเจอร์ เครื่องใช้ไฟฟ้า ตู้เย็น ทีวี แอร์</li>
                    <li>บริการรับซื้ออะลูมิเนียม</li>
                </ul>
            </div>
            <div class="column">
                <h3>แผนที่</h3>
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3874.044073042384!2d100.61688231513888!3d13.845379190283422!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30e28333c3b8e1d5%3A0x5515b9a5a0f4e93b!2z4LiK4Li04LiZ4LiEIOC4muC4seC4h-C4qOC5jOC4peC4sSDguK3guKPguLDguKfguJnguLLguKPguYzguKHguJnguKrguLTguKPguLHguKLguKEg4LiX4LmJ4LiZ4Liy4Lil4LmJ4LiZ4Li04LiZ4LmIIOC4nOC4reC4iuC4n-C4peC4tOC4meC4oSDguIHguLHguKHguKLguLLguIfguKnguLXguKLguIcgMTIxMzA!5e0!3m2!1sth!2sth!4v1671528665555"
                    width="100%"
                    height="300"
                    style="border:0;"
                    allowfullscreen=""
                    loading="lazy">
                </iframe>
    </footer>


</body>

</html>