<?php
session_start();
unset($_SESSION['cart']);
header("Location: buy_admin.php"); 
exit();
?>