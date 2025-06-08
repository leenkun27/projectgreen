<?php include '../condb.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ข้อมูลพนักงาน</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<style>
    .card {
        max-height: 85vh;
        overflow-y: auto;
        padding: 15px;
    }

    .table-responsive {
        max-height: 70vh;
        overflow-y: auto;
    }

    .table {
        table-layout: fixed;
        word-wrap: break-word;
    }

    th,
    td {
        text-align: center;
        vertical-align: middle;
    }
</style>

<body>

    <div class="container">
        <?php include '../header_emp.php'; ?>
        <div class="row">
            <div class="col-2">
                <?php include '../menu_emp.php'; ?>
            </div>
            <div class="card mt-3 pb-5 px-2 col-10">
                <div class="col-12">
                    <h2><i class="bi bi-person-gear"></i> ตั้งค่าสมาชิก</h2>
                    <div class="mt-4">
                        <div class="d-flex justify-content-between align-items-center">
                            <input id="searchInput" type="text" class="form-control w-50" placeholder="ค้นหาชื่อหรือข้อมูล">
                            <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addStaffModal">
                                <i class="bi bi-plus"></i> เพิ่มข้อมูล </button>
                        </div>
                    </div>

                    <form method="POST" action="insert_staff_admin.php" enctype="multipart/form-data">
                        <div class="modal fade" id="addStaffModal" tabindex="-1" aria-labelledby="addStaffModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="addStaffModalLabel">สร้างพนักงาน</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>

                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label for="name" class="form-label">ชื่อ-นามสกุล</label>
                                            <input type="text" class="form-control" id="name" name="name" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="username" class="form-label">ชื่อผู้ใช้</label>
                                            <input type="text" class="form-control" id="username" name="username" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="password" class="form-label">รหัสผ่าน</label>
                                            <input type="password" class="form-control" id="password" name="password"
                                                required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="confirm_password" class="form-label">ยืนยันรหัสผ่าน</label>
                                            <input type="password" class="form-control" id="confirm_password"
                                                name="confirm_password" required>
                                        </div>
                                        <div class="mb-3">
                                            <div>ประเภทของพนักงาน</div>
                                            <select class="form-select " aria-label=".form-select-sm example" name="role">
                                                <option value="2" selected>พนักงาน</option>
                                                <option value="1">แอดมิน</option>
                                            </select>
                                        </div>

                                        <div class="mb-3">
                                            <label for="user_address" class="form-label">ที่อยู่</label>
                                            <input type="text" class="form-control" id="user_address" name="user_address">
                                        </div>
                                        <div class="mb-3">
                                            <label for="user_tell" class="form-label">เบอร์โทรศัพท์</label>
                                            <input type="text" class="form-control" id="user_tell" name="user_tell">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary">บันทึก</button>
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">ยกเลิก</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>

                    <div class="row ">
                        <div class="col-12">
                            <div class="table-responsive mt-3">
                                <table id="memberTable" class="table table-bordered table-striped table-summary">
                                    <thead class="table-light">
                                        <tr>
                                            <th>ลำดับ</th>
                                            <th>ชื่อผู้ใช้</th>
                                            <th>ชื่อ</th>
                                            <th>ที่อยู่</th>
                                            <th>เบอร์โทร</th>
                                            <th>ตำแหน่ง</th>
                                            <th scope="col">ลบ</th>
                                            <th scope="col">แก้ไข</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $query = "SELECT * FROM users";
                                        $result = $conn->query($query);
                                        if ($result->num_rows > 0) {
                                            $index = 1;
                                            while ($row = $result->fetch_assoc()) {
                                                echo "<tr>
            <td>" . $index++ . "</td>
            <td>" . htmlspecialchars($row['username']) . "</td>
            <td>" . htmlspecialchars($row['name']) . "</td>
            <td>" . htmlspecialchars($row['user_address']) . "</td>
            <td>" . htmlspecialchars($row['user_tell']) . "</td>
            <td>" . htmlspecialchars($row['role']) . "</td>
            <td>
                <a href='delete_staff_emp.php?id=" . $row['id'] . "' class='btn btn-danger' onclick='return confirm(\"ยืนยันการลบ?\")'>
                    <i class='bi bi-trash'></i>
                </a>
            </td>
            <td>
                <a href='edit_staff_emp.php?id=" . $row['id'] . "' class='btn btn-warning'>
                    <i class='bi bi-pencil-square'></i>
                </a>
            </td>
        </tr>";
                                            }
                                        } else {
                                            echo "<tr><td colspan='8' class='text-center'>ไม่มีข้อมูล</td></tr>";
                                        }
                                        ?>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <script>
                        document.addEventListener("DOMContentLoaded", function() {
                            const searchInput = document.getElementById("searchInput");
                            const table = document.getElementById("memberTable");
                            const rows = table.getElementsByTagName("tr");

                            searchInput.addEventListener("keyup", function() {
                                const filter = searchInput.value.toLowerCase();


                                for (let i = 1; i < rows.length; i++) {
                                    const cells = rows[i].getElementsByTagName("td");
                                    let match = false;


                                    for (let j = 0; j < cells.length; j++) {
                                        if (cells[j].textContent.toLowerCase().includes(filter)) {
                                            match = true;
                                            break;
                                        }
                                    }
                                    rows[i].style.display = match ? "" : "none";
                                }
                            });
                        });
                    </script>

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