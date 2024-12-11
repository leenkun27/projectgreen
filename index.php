<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>หน้าหลัก</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>

<style>
    .custom-bg,
    .custom-bg1 {
        background-color: #E0FFFF;
        /* ใช้สีเดียวกัน */
    }

    .text-white {
        color: white;
    }

    .row.custom-bg {
        height: auto;
        /* ปรับให้ความสูงปรับตามเนื้อหาจริง */
    }
</style>


<body>
    <div class="container-fluid p-0">
        <?php include './header_admin.php'; ?>
        <!-- ส่วนเนื้อหา -->
        <div class="row align-items-center custom-bg" style="min-height: 80vh;">
            <!-- คอนเทนต์ทางซ้าย -->
            <div class="col-md-6 text-center p-4">
                <h4>ข้อมูลร้านรับซื้อของเก่า</h4>
                <p>ร้านรับซื้อของเก่าที่เปิดให้บริการมาอย่างยาวนาน เรารับซื้อสินค้าหลากหลายประเภท เช่น เหล็ก, พลาสติก, กระดาษ และอื่นๆ</p>
                <p>ที่อยู่: อำเภอแก่งกระจาน จังหวัดเพชรบุรี</p>
                <p>ติดต่อ: 089-225-6557</p>
                <p>เวลาทำการ: จันทร์-ศุกร์ เวลา 08:00-17:00,เสาร์ เวลา 08:00-17:00</p>
            </div>

            <!-- รูปภาพทางขวา -->
            <div class="col-md-6 text-center">
                <img src="./img/wichain.jpg" alt="ร้านรับซื้อของเก่าวิเชียรรุ่งเรื่อง" class="img-fluid rounded" style="max-height: 400px; object-fit: contain;">
            </div>
        </div>
    </div>
</body>
<footer class="bg-dark text-white py-4">
    <div class="container text-center">
        <p>© 2024 Wichian รับซื้อของเก่า | สงวนลิขสิทธิ์</p>
        <p>ติดต่อ: 089-225-6557</p>
    </div>
</footer>

</html>