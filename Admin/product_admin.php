<?php include '../condb.php';

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>หน้าข้อมูลของเก่า</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body>

    <div class="container">
        <?php include '../header_admin.php'; ?>
        <div class="row">
            <div class="col-2">
                <?php include '../menu_admin.php'; ?>
            </div>

            <div class="card mt-3 pb-5 px-2 col-10">
                <div class="col-12">
                    <h2 class="mt-3">📦ข้อมูลสินค้า</h2>
                    <div class="mt-4">
                        <div class="d-flex justify-content-between align-items-center">
                            <input id="searchInput" type="text" class="form-control w-50" placeholder="ค้นหาชื่อของเก่า">
                            <div>
                                <a href="add_product_admin.php" class="btn btn-success"><i class="bi bi-plus"></i> เพิ่มข้อมูล</a>
                            </div>

                        </div>
                    </div>

                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">เพิ่มข้อมูลสินค้า</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label for="province">เลือกประเภทของเก่า:</label>
                                        <select class="form-control" id="province" placeholder="">
                                            <option value="">-- เลือกประเภทของเก่า --</option>
                                            <option value="1">เศษเหล็ก</option>
                                            <option value="2">กระดาษ</option>
                                            <option value="3">ขวดแก้ว</option>
                                            <option value="4">พลาสติก</option>
                                            <option value="5">โลหะที่มีค่าสูง</option>
                                            <option value="6">เครี่องใช้ไฟฟ้า</option>
                                            <option value="7">อื่นๆ</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="district">เลือกชื่อของเก่า:</label>
                                        <select class="form-control" id="district" disabled placeholder="">
                                            <option value="">-- เลือกของเก่า --</option>
                                        </select>
                                    </div>

                                    <div class="mb-2">
                                        <label for="exampleInputEmail1" class="form-label">ราคาต้นทุน</label>
                                        <input type="number" class="form-control">
                                    </div>
                                    <div class="mb-2">
                                        <label for="exampleInputEmail1" class="form-label">จำนวนคงเหลือ</label>
                                        <input type="number" class="form-control">
                                    </div>
                                    <div class="mb-2">
                                        <label for="exampleInputEmail1" class="form-label">หมายเหตุ</label>
                                        <input type="text" class="form-control">
                                    </div>
                                    <div class="col-md mt-2" text-align="left">
                                        <label for="">รูปภาพ</label>
                                        <input type="file" name="h_image" id="" class="form-control mb-3" accept=".png,.jpg,.jpeg">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
                                    <input type="submit" name="submit" id="sb" value="บันทึก" class="btn btn-success">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row ">
                        <div class="col-12">
                            <div class="table-responsive mt-3">
                                <table class="table table-bordered table-striped table-summary">
                                    <thead class="table-light">
                                        <tr>
                                            <th scope="col">ลำดับ</th>
                                            <th scope="col">รูปภาพ</th>
                                            <th scope="col">ชื่อของเก่า</th>
                                            <th scope="col">ประเภทของเก่า</th>
                                            <th scope="col">ราคาต้นทุน</th>
                                            <th scope="col">จำนวนคงเหลือ</th>
                                            <th scope="col">จำนวนขายขั้นต่ำ</th>
                                            <th scope="col">หน่วย</th>
                                            <th scope="col">ลบ</th>
                                            <th scope="col">แก้ไข</th>

                                        </tr>
                                    </thead>
                                    <tbody id="productBody">
                                        <?php
                                        $sql = "SELECT p.*, t.type_name 
            FROM product p 
            LEFT JOIN product_type t ON p.type_id = t.type_id";
                                        $result = $conn->query($sql);

                                        if ($result->num_rows > 0) {
                                            $index = 1;
                                            while ($row = $result->fetch_assoc()) {
                                        ?>
                                                <tr>
                                                    <th scope="row"><?= $index++ ?></th>
                                                    <td><img src="<?= $row['product_img'] ?>" alt="product" class="img-fluid" width="100"></td>
                                                    <td><?= $row['product_name'] ?></td>
                                                    <td><?= $row['type_name'] ?></td>
                                                    <td><?= $row['cost_price'] ?> ฿</td>
                                                    <td><?= $row['quantity'] ?></td>
                                                    <td><?= $row['minimum_sale'] ?></td>
                                                    <td><?= $row['unit'] ?></td>
                                                    <td><a href="delete_product_admin.php?id=<?= $row['product_id'] ?>" class="btn btn-danger"><i class="bi bi-trash"></i></a></td>
                                                    <td><a href="edit_product_admin.php?product_id=<?= $row['product_id'] ?>" class="btn btn-warning"><i class="bi bi-pencil-square"></i></a></td>
                                                </tr>
                                            <?php
                                            }
                                        } else {
                                            ?>
                                            <tr>
                                                <td colspan="9">ไม่มีข้อมูล</td>
                                            </tr>
                                        <?php
                                        }

                                        $conn->close();
                                        ?>
                                    </tbody>

                                </table>
                                <div class="d-flex justify-content-between align-items-center">
                                    <button class="btn btn-outline-primary" id="prevPage">ก่อนหน้า</button>
                                    <span id="pageInfo"></span>
                                    <button class="btn btn-outline-primary" id="nextPage">ถัดไป</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <script>
                    document.addEventListener("DOMContentLoaded", function() {
                        const searchInput = document.getElementById("searchInput");
                        const table = document.getElementById("productBody");
                        const rows = table.getElementsByTagName("tr");


                        searchInput.addEventListener("keyup", function() {
                            const filter = searchInput.value.toLowerCase();

                            for (let i = 0; i < rows.length; i++) {
                                const cells = rows[i].getElementsByTagName("td");

                                if (cells.length > 0) {
                                    const productName = cells[1].textContent.toLowerCase();

                                    rows[i].style.display = productName.includes(filter) ? "" : "none";
                                }
                            }
                        });
                    });
                </script>

                <script>
                    const rowsPerPage = 10;
                    let currentPage = 1;
                    const table = document.getElementById("productTable");
                    const tbody = document.getElementById("productBody");
                    const totalRows = tbody.rows.length;
                    const totalPages = Math.ceil(totalRows / rowsPerPage);

                    function displayRows() {
                        for (let i = 0; i < totalRows; i++) {
                            tbody.rows[i].style.display =
                                i >= (currentPage - 1) * rowsPerPage && i < currentPage * rowsPerPage ?
                                "" :
                                "none";
                        }
                        document.getElementById("pageInfo").innerText = `หน้า ${currentPage} จาก ${totalPages}`;
                    }

                    document.getElementById("prevPage").addEventListener("click", () => {
                        if (currentPage > 1) {
                            currentPage--;
                            displayRows();
                        }
                    });

                    document.getElementById("nextPage").addEventListener("click", () => {
                        if (currentPage < totalPages) {
                            currentPage++;
                            displayRows();
                        }
                    });

                    displayRows();
                </script>


                <script>
                    document.addEventListener("click", function(e) {
                        if (e.target.classList.contains("removeRow")) {
                            e.preventDefault();
                            const agree = confirm("คุณต้องการลบข้อมูลนี้หรือไม่?");
                            if (agree) {
                                const rowId = e.target.getAttribute("data-id");
                                deleteRow(rowId);
                            }
                        }
                    });
                </script>


</body>

</html>

<script language="JavaScript">
    function Del(mypang) {
        var agree = confirm("คุณต้องการลบข้อมูลหรือไม่");
        if (agree) {
            window.location = mypang;
        }
    }
</script>