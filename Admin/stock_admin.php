<?php include '../condb.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Do</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body>

    <div class="container">
        <?php include './header.php'; ?>
        <div class="row">
            <div class="col-2">
                <?php include './menu.php'; ?>
            </div>
            <div class="card mt-3 pb-5 px-2 col-10">
            <div class="col-10">
                <h1>ข้อมูลของเก่า</h1>
                <div class="row">
                    <div class="col-12">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">ลำดับ</th>
                                    <th scope="col">ชื่อสินค้า</th>
                                    <th scope="col">ภาพ</th>
                                    <th scope="col">จำนวนคงเหลือ</th>
                                    <th scope="col">หมายเหตุ</th>
                                    <th scope="col">ลบ</th>
                                    <th scope="col">แก้ไข</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                // ดึงข้อมูลจากฐานข้อมูล
                                $sql = "SELECT * FROM tbl_product"; // ระบุชื่อตาราง
                                $result = $conn->query($sql);

                                if ($result->num_rows > 0) {
                                    $index = 1; // ตัวนับลำดับ
                                    while ($row = $result->fetch_assoc()) {
                                        echo "<tr>";
                                        echo "<th scope='row'>" . $index++ . "</th>";
                                        echo "<td>" . $row['p_name'] . "</td>";
                                        echo "<td><img src='" . $row['p_img'] . "' alt='product' class='img-fluid' width='50'></td>";
                                        echo "<td>" . $row['p_qty'] . "</td>";
                                        echo "<td>" . $row['p_type'] . "</td>";
                                        echo "<td><button type='button' class='btn btn-danger'>ลบ</button></td>";
                                        echo "<td><button type='button' class='btn btn-warning'>แก้ไข</button></td>";
                                        echo "</tr>";
                                    }
                                } else {
                                    echo "<tr><td colspan='8'>ไม่มีข้อมูล</td></tr>";
                                }

                                $conn->close(); // ปิดการเชื่อมต่อฐานข้อมูล
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>

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
</body>

</html>