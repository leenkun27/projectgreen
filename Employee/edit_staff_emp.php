<?php include '../condb.php';

$id = $_GET['id'];
$sql = "SELECT * FROM users WHERE id = $id";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title>แก้ไขข้อมูลพนักงาน</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <?php include '../header_emp.php'; ?>
    <div class="row">
        <div class="col-2">
            <?php include '../menu_emp.php'; ?>
        </div>

        <div class="col-10">
            <div class="card p-4">
                <h2 class="mb-4">แก้ไขข้อมูลพนักงาน</h2>
                <form method="POST" action="update_staff_emp.php">
                    <input type="hidden" name="id" value="<?= $row['id'] ?>">

                    <div class="mb-3">
                        <label for="name" class="form-label">ชื่อ-นามสกุล</label>
                        <input type="text" class="form-control" id="name" name="name" value="<?= htmlspecialchars($row['name']) ?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="username" class="form-label">ชื่อผู้ใช้</label>
                        <input type="text" class="form-control" id="username" name="username" value="<?= htmlspecialchars($row['username']) ?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="user_address" class="form-label">ที่อยู่</label>
                        <input type="text" class="form-control" id="user_address" name="user_address" value="<?= htmlspecialchars($row['user_address']) ?>">
                    </div>

                    <div class="mb-3">
                        <label for="user_tell" class="form-label">เบอร์โทรศัพท์</label>
                        <input type="text" class="form-control" id="user_tell" name="user_tell" value="<?= htmlspecialchars($row['user_tell']) ?>">
                    </div>

                    <div class="mb-3">
                        <label for="role" class="form-label">ประเภท</label>
                        <select class="form-select" id="role" name="role">
                            <option value="admin" <?= $row['role'] == 'admin' ? 'selected' : '' ?>>แอดมิน</option>
                            <option value="user" <?= $row['role'] == 'user' ? 'selected' : '' ?>>พนักงาน</option>
                        </select>
                    </div>

                    <div class="d-flex justify-content-start gap-2">
                        <button type="submit" class="btn btn-success">บันทึก</button>
                        <a href="staff_emp.php" class="btn btn-danger">ยกเลิก</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>
