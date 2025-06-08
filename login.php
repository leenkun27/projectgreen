<?php
session_start();
include 'condb.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        body {
            background-image: url('https://fixthephoto.com/images/content/sky-backgrounds-for-photoshop-61612275657.jpg'); /* ใส่ลิงก์ของภาพพื้นหลัง */
            background-size: cover;
            background-position: center;
            background-attachment: fixed; 
            height: 100vh; 
        }
        .logo {
            display: block;
            margin: 0 auto 20px;
            width: 100px; 
            height: auto;
        }
        .card {
            opacity: 0.9; 
            background-color: rgba(255, 255, 255, 0.8); 
        }
    </style>
</head>
<body>
    <div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
        <div class="card p-4 shadow-lg" style="width: 400px;">
            <img src="./img/Logo.jpg" alt="Logo" class="logo">
            <h3 class="text-center mb-4">เข้าสู่ระบบ</h3>
            <form action="process_login.php" method="POST">
                <div class="mb-3">
                    <label for="username" class="form-label">ชื่อผู้ใช้</label>
                    <input type="text" class="form-control" id="username" name="username" placeholder="" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">รหัสผ่าน</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="" required>
                </div>
                <button type="submit" class="btn btn-primary w-100">เข้าสู่ระบบ</button>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
