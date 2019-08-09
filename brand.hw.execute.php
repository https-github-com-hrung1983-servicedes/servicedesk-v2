<?php
header("Content-Type: text/html; charset=tis-620");

session_start();
require_once("function.php");
if(!checkUser()){    echo Message(35,"red",$titel1,$msg1,"<a href='index.php'> $login </a>");
   exit;
}
$mode = $_REQUEST["mode"];
$id = $_REQUEST["id"];
$category_hw_id = $_REQUEST["category_hw_id"];
$brand_name = $_REQUEST["brand_name"];
$brand_active = $_REQUEST["brand_active"];
//echo "$mode : $category_hw_id";
if($mode=="add_brand"){
    $sql = "insert into itbl_brand (category_hw_id,brand_name,brand_active) values ('$category_hw_id','$brand_name','$brand_active')";
    mysqli_query($conn,$sql);
header("location:brand.hw.index.php?id=$category_hw_id&type=edit");
}
else if($mode=="delete"){
     $sql = "DELETE FROM itbl_brand WHERE id = $id";
     mysqli_query($conn,$sql);
header("location:brand.hw.index.php?id=$category_hw_id&type=edit");
}   
else  {
    $sql = "update itbl_brand set brand_name='$brand_name',brand_active='$brand_active' where id = $id";
    mysqli_query($conn,$sql);
header("location:brand.hw.index.php?id=$category_hw_id&type=edit");
}
//echo $mode."<br>";
//echo $sql;
?>
