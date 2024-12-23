<?php
include '../condb.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // รับ JSON จาก Frontend
    $input = json_decode(file_get_contents('php://input'), true);
    $id = $input['id'] ?? null;

    if ($id) {
        // ใช้ Prepared Statement เพื่อป้องกัน SQL Injection
        $stmt = $conn->prepare("DELETE FROM product WHERE id = ?");
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            echo json_encode(["success" => true, "message" => "ลบข้อมูลสำเร็จ"]);
        } else {
            echo json_encode(["success" => false, "message" => "เกิดข้อผิดพลาด"]);
        }

        $stmt->close();
    } else {
        echo json_encode(["success" => false, "message" => "ID ไม่ถูกต้อง"]);
    }
} else {
    echo json_encode(["success" => false, "message" => "Method ไม่ถูกต้อง"]);
}

$conn->close();
