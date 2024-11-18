<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Bootstrap Scrollable Table</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    /* กำหนดขนาดและสไตล์สำหรับตาราง */
    .table-container {
      max-height: 200px; /* ความสูงของตาราง */
      overflow-y: auto; /* เพิ่มแถบเลื่อนแนวตั้ง */
      border: 1px solid #ccc; /* เส้นขอบ */
      border-radius: 5px; /* ขอบมน */
    }
    .table-hover tbody tr:hover {
      background-color: #e9ecef; /* สีพื้นหลังเมื่อ hover */
    }
    .selected-row {
      background-color: #d0ebff !important; /* สีพื้นหลังของแถวที่เลือก */
    }
  </style>
</head>
<body>
  <div class="container mt-5">
    <h4>ข้อมูลประเภทของทำ</h4>
    <div class="table-container">
      <table class="table table-bordered table-hover">
        <thead class="table-dark">
          <tr>
            <th>รหัสประเภทของทำ</th>
            <th>ชื่อประเภทของทำ</th>
          </tr>
        </thead>
        <tbody>
          <tr class="selected-row">
            <td>1001</td>
            <td>แก้ว</td>
          </tr>
          <tr>
            <td>1002</td>
            <td>พลาสติก</td>
          </tr>
          <tr>
            <td>1003</td>
            <td>เหล็ก</td>
          </tr>
          <tr>
            <td>1004</td>
            <td>สายไฟ</td>
          </tr>
          <tr>
            <td>1005</td>
            <td>กระดาษ</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<script>
  const rows = document.querySelectorAll("tbody tr");
  rows.forEach(row => {
    row.addEventListener("click", () => {
      rows.forEach(r => r.classList.remove("selected-row")); // ลบคลาส selected ออกจากทุกแถว
      row.classList.add("selected-row"); // เพิ่มคลาส selected เฉพาะแถวที่คลิก
    });
  });
</script>
