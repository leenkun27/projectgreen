<?php
$host = "localhost";
$username = "root";
$password = "";
$dbname = "wichian_db";

$conn = new mysqli($host, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['product_id'])) {
    $product_id = filter_var($_POST['product_id'], FILTER_VALIDATE_INT);

    if ($product_id) {
        $query = "SELECT price_today FROM product WHERE product_id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $product_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            echo htmlspecialchars($row['price_today']);
        } else {
            echo "0";
        }

        $stmt->close();
    } else {
        echo "Invalid product ID";
    }
}

$conn->close();
?>
