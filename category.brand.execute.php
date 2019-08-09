<?php
require_once('connection.php');
$id=$_POST["id"];
$catedesc=$_POST["catedesc"];
$stractive=$_POST["stractive"];
if($id==""){
    $strSQL = "INSERT INTO tbl_category_brand (brand_name,active) VALUES ('$catedesc' ,'$stractive')";
    $objQuery = mysqli_query($conn,$strSQL);
}else{
    $strSQL = "UPDATE tbl_category_brand SET brand_name= '$catedesc' , active = '$stractive' WHERE brand_id = $id";
    $objQuery = mysqli_query($conn,$strSQL);
}
   echo  $strSQL;   
        
header("Location:category.brand.php");
?>

