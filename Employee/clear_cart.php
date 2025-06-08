<?php
session_start();
unset($_SESSION['cart']);
header("Location: buy_employee.php"); 
exit();
?>