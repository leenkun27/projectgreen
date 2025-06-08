<?php
include '../condb.php';
$ids=$_GET['id'];
$sql="DELETE FROM product WHERE product_id='$ids' ";
if(mysqli_query($conn,$sql)){
    echo "<script>alert('ลบข้อมูลสำเร็จ');</script>";
    echo "<script>window.location='product_emp.php';</script>";
}else{
    echo "Error : " . $sql . "<br>" . mysqli_error($conn);
    echo "<script>alert('ไม่สามารถลบข้อมูลได้');</script>";
}

mysqli_close($conn);

?>
