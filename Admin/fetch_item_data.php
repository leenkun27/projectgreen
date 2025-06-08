<?php
include '../condb.php';
if (isset($_POST['p_name'])) {
    $p_name = $_POST['p_name'];

    
    error_log("Received p_name: " . $p_name);

    
    $stmt = $pdo->prepare("SELECT * FROM tbl_product WHERE p_name = :p_name");
    $stmt->execute(['p_name' => $p_name]);
    $item = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($item) {
        echo json_encode([
            'success' => true,
            'type' => $item['p_type'],
            'quantity' => $item['p_qty'],
            'price' => $item['p_price']
        ]);
    } else {
        echo json_encode(['success' => false]);
    }
}
?>
