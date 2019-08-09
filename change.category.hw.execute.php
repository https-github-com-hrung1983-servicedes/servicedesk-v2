<?
header("Content-Type: text/html; charset=tis-620");
header("content-type: application/x-javascript; charset=TIS-620");
session_start();
require_once("function.php");

if(!checkUser()){    echo Message(35,"red",$titel1,$msg1,"<a href='index.php?link=hw.onhand.list'>$login </a>");
   exit;
}
$idupdate = $_REQUEST["idupdate"];  
$cate_id = $_REQUEST["cate_id"];
$sn_id = $_REQUEST["sn_id"];

$sql = "update tbl_hardware_onhand_user set cate_id = '$cate_id' where id = '$idupdate'";
mysqli_query($conn,$sql);
header("Location:change.category.hw.php?sn_id=$sn_id");  
?>
