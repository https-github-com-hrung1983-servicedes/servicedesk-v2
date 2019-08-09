<?php
require_once('connection.php');
$id=$_POST["id"];
$catedesc=$_POST["catedesc"];
$stractive=$_POST["stractive"];
if($id==""){
    $strSQL = "INSERT INTO tbl_category_hardware (cate_name,cate_active,owner_by) VALUES ('$catedesc' ,'$stractive','All')";
    $objQuery = mysqli_query($conn,$strSQL);
}else{
    $strSQL = "UPDATE tbl_category_hardware SET cate_name= '$catedesc' , cate_active = '$stractive' WHERE cate_id = $id";
    $objQuery = mysqli_query($conn,$strSQL);
}
   echo  $strSQL;   
        
header("Location:category.hardware.php");
?>

