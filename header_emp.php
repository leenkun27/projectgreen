<style>
    .custom-navbar {
        background-color: #0056b3; /* สี*/
    }
</style>

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
                        <a class="nav-link dropdown-toggle text-white" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Login
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="login.php">ลงชื่อเข้าใช้</a></li>
                            <li><a class="dropdown-item" href="#">เกี่ยวกับ</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</div>
