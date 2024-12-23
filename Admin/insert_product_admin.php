<?php
include '../condb.php';
$p_name = $_POST['product_name'];
$t_id = $_POST['type_id'];
$c_price = $_POST['cost_price'];
$q = $_POST['quantity'];
$u = $_POST['unit'];
$p_img = $_POST['product_img'];

$sql="INSERT INTO product(product_name,type_id,cost_price,quantity,unit,product_img) VALUES('$p_name','$t_id','$c_price','$q','$u','$p_img') ";
$result=mysqli_query($conn,$sql);
if($result){
    echo "<script>alert('บันทึกข้อมูลสำเร็จ');</script>";
    echo "<script>window.location='product_admin.php';</script>";
}else{
    echo "<script>alert('ไม่สามารถบันทึกข้อมูลได้');</script>";
}
mysqli_close($conn);
?>
