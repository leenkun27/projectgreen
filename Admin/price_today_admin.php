<?php
session_start();
include '../condb.php';

// กำหนดจำนวนแถวที่จะแสดงต่อหน้า
$limit = 10;

// ตรวจสอบหน้าปัจจุบัน
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$start = ($page - 1) * $limit; // คำนวณ OFFSET

// ดึงข้อมูลจากฐานข้อมูล
$query = "
    SELECT 
        product.product_id, 
        product.product_name, 
        product.price_today, 
        product.type_id, 
        product_type.type_name,
        product.unit
    FROM 
        product
    LEFT JOIN 
        product_type 
    ON 
        product.type_id = product_type.type_id
    LIMIT $limit OFFSET $start
";
$result = $conn->query($query);

if (!$result) {
    die("Query failed: " . $conn->error);
}

// คำนวณจำนวนหน้าทั้งหมด
$count_query = "SELECT COUNT(*) AS total FROM product";
$count_result = $conn->query($count_query);
$row = $count_result->fetch_assoc();
$total_records = $row['total'];
$total_pages = ceil($total_records / $limit);

?>


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ราคาวันนี้</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>
<style>

</style>

<body onload="updateTime()">
    <div class="container">
        <?php include '../header_admin.php'; ?>
        <div class="row">
            <div class="col-2">
                <?php include '../menu_admin.php'; ?>
            </div>
            <div class="card mt-3 pb-5 px-2 col-10">
                <div class="container mt-4">
                    <h2 class="mb-4">📈 ราคาของเก่าวันนี้</h2>

                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>ลำดับ</th>
                                <th>ชื่อสินค้า</th>
                                <th>ประเภทสินค้า</th>
                                <th>ราคาวันนี้</th>
                                <th>หน่วย</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($row = $result->fetch_assoc()) { ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($row['product_id']); ?></td>
                                    <td><?php echo htmlspecialchars($row['product_name']); ?></td>
                                    <td><?php echo htmlspecialchars($row['type_name']); ?></td>
                                    <td><?php echo htmlspecialchars($row['price_today']); ?></td>
                                    <td><?php echo htmlspecialchars($row['unit']); ?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>


                    <!-- การแบ่งหน้า -->
                    <nav aria-label="Page navigation">
                        <ul class="pagination justify-content-center">
                            <li class="page-item <?php echo ($page == 1) ? 'disabled' : ''; ?>">
                                <a class="page-link" href="?page=<?php echo ($page - 1); ?>">ก่อนหน้า</a>
                            </li>
                            <?php for ($i = 1; $i <= $total_pages; $i++) { ?>
                                <li class="page-item <?php echo ($page == $i) ? 'active' : ''; ?>">
                                    <a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                                </li>
                            <?php } ?>
                            <li class="page-item <?php echo ($page == $total_pages) ? 'disabled' : ''; ?>">
                                <a class="page-link" href="?page=<?php echo ($page + 1); ?>">ถัดไป</a>
                            </li>
                        </ul>
                    </nav>

                </div>
            </div>
        </div>

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

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            $(document).ready(function() {
                $(".cart").click(function() {
                    Swal.fire({
                        title: "สำเร็จ",
                        text: "You clicked the button!",
                        icon: "success"
                    });
                });
            });
        </script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
</body>

</html>