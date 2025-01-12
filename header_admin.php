<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>

?>
<style>
    /* กำหนดให้ navbar อยู่เหนือสุด */
    .custom-navbar {
        background-color: #0056b3;
        /* สี navbar */
        z-index: 1030;
        /* ให้ navbar อยู่บนสุด */
    }

    /* เพิ่ม margin-top ให้กับเนื้อหาหลัก เพื่อไม่ให้ถูก navbar บัง */
    .content {
        margin-top: 120px;
        /* ปรับให้พอดีกับความสูงของ navbar */
        padding-left: 220px;
        /* ระยะห่างจาก Sidebar */
        padding-top: 20px;
    }

    /* ปรับตำแหน่งของ sidebar */
    .sidebar {
        position: fixed;
        top: 80px;
        /* ขยับ sidebar ลงมาจากด้านบน (navbar) */
        left: 0;
        width: 200px;
        height: 100%;
        background-color: #0056b3;
        z-index: 1020;
        /* ให้ sidebar อยู่ล่างกว่า navbar */
        padding-top: 20px;
        /* เพิ่มระยะห่างด้านบนของ sidebar */
    }
</style>

<!-- Navbar -->
<div class="row mx-5 mb-5">
    <nav class="navbar navbar-expand-lg custom-navbar fixed-top">
        <div class="container">
            <a class="navbar-brand text-white" href="#">Wichian</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <!-- เมนูข้อมูลผู้ใช้จะย้ายไปทางขวาที่สุด -->
                </ul>
                <!-- ฟอร์มค้นหาอยู่ทางขวาอยู่แล้ว -->

                <!-- เมนูข้อมูลผู้ใช้ -->
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item dropdown">
                        <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-person-circle"></i> <?php echo $_SESSION['username']; ?>
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <li class="dropdown-header">เมนูผู้ใช้งาน</li>
                            <li><a class="dropdown-item" href="../Admin/staff_admin.php"><i class="bi bi-person"></i> ข้อมูลพนักงาน</a></li>
                            <li><a class="dropdown-item text-danger" href="../logout.php"><i class="bi bi-box-arrow-right"></i> ออกจากระบบ</a></li>
                    </li>
                </ul>
            </div>


        </div>
    </nav>
</div>