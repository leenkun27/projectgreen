<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dropdown ซ้อนกัน</title>
    <style>
        /* สไตล์สำหรับ dropdown */
        .dropdown {
            position: relative;
            display: inline-block;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #f9f9f9;
            box-shadow: 0px 8px 16px rgba(0, 0, 0, 0.2);
            padding: 12px 16px;
            z-index: 1;
            min-width: 150px;
        }

        .dropdown:hover .dropdown-content {
            display: block;
        }

        .dropdown-sub {
            position: relative;
        }

        .dropdown-sub .dropdown-content {
            top: 0;
            left: 100%;
            /* แสดง dropdown sub-menu ทางขวา */
        }
    </style>
</head>

<body>
    <!-- Dropdown หลัก -->
    <div class="dropdown">
        <button>เมนูหลัก</button>
        <div class="dropdown-content">
            <p>รายการที่ 1</p>
            <p>รายการที่ 2</p>

            <!-- Dropdown ซ้อน -->
            <div class="dropdown-sub">
                <button>ซ้อนเมนู</button>
                <div class="dropdown-content">
                    <p>ซ้อนรายการที่ 1</p>
                    <p>ซ้อนรายการที่ 2</p>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.querySelectorAll('.dropdown > button').forEach(button => {
            button.addEventListener('click', () => {
                const dropdownContent = button.nextElementSibling;
                dropdownContent.style.display = dropdownContent.style.display === 'block' ? 'none' : 'block';
            });
        });
    </script>
</body>

</html>