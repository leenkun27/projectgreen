<style>
    /* เพิ่มสีพื้นหลังและการเปลี่ยนแปลงสีของตัวอักษรเมื่อ hover */
.sidebar .nav-link:hover {
    background-color: #007bff; /* เปลี่ยนสีพื้นหลังเมื่อ hover */
    color: white; /* เปลี่ยนสีตัวอักษรเมื่อ hover */
    transition: background-color 0.3s ease, color 0.3s ease; /* ทำให้การเปลี่ยนแปลงมีความนุ่มนวล */
}
</style>

<!-- Sidebar -->
<ul class="nav flex-column sidebar p-3 vh-100 position-fixed">
    <li class="nav-item mb-2">
        <a href="../Admin/admin_dashboard.php" class="nav-link text-white d-flex align-items-center">
            <i class="bi-house fs-5 me-2"></i> <span>หน้าหลัก</span>
        </a>
    </li>
    <li class="nav-item mb-2">
        <a href="./sale_admin.php" class="nav-link text-white d-flex align-items-center">
            <i class="bi bi-shop fs-5 me-2"></i> <span>หน้าขาย</span>
        </a>
    </li>
    <li class="nav-item mb-2">
        <a href="./buy_admin.php" class="nav-link text-white d-flex align-items-center">
            <i class="bi-basket fs-5 me-2"></i> <span>รับซื้อสินค้า</span>
        </a>
    </li>
    <li class="nav-item mb-2">
        <a href="./product_admin.php" class="nav-link text-white d-flex align-items-center">
            <i class="bi-cart fs-5 me-2"></i> <span>ข้อมูลของเก่า</span>
        </a>
    </li>
    <li class="nav-item mb-2">
        <a href="./stock_admin.php" class="nav-link text-white d-flex align-items-center">
            <i class="bi bi-box-seam fs-5 me-2"></i> <span>สต๊อก</span>
        </a>
    </li>
    <li class="nav-item mb-2">
        <a href="./report_admin.php" class="nav-link text-white d-flex align-items-center">
            <i class="bi-clipboard-data fs-5 me-2"></i> <span>รายงาน</span>
        </a>
    </li>
    <li class="nav-item mb-2">
        <a href="./staff_admin.php" class="nav-link text-white d-flex align-items-center">
            <i class="bi bi-person fs-5 me-2"></i> <span>ข้อมูลพนักงาน</span>
        </a>
    </li>
    <li class="nav-item mb-2">
        <a href="./checktimes_staff.php" class="nav-link text-white d-flex align-items-center">
            <i class="bi bi-clock fs-5 me-2"></i> <span>เช็คการเข้า-ออกของพนักงาน</span>
        </a>
    </li>
    <li class="nav-item">
        <a href="logout.php" class="nav-link text-danger d-flex align-items-center">
            <i class="bi-box-arrow-right fs-5 me-2"></i> <span>ออกจากระบบ</span>
        </a>
    </li>
</ul>

<!-- เนื้อหาหลัก -->
<div class="content">
    <!-- Content Here -->
</div>