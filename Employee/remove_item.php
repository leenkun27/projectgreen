<?php
session_start();
if (isset($_POST['index'])) {
    unset($_SESSION['cart'][$_POST['index']]); 
}
header("Location: buy_employee.php"); 
exit();
?>
