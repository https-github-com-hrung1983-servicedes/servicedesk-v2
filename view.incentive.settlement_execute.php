<?
header("Content-Type: text/html; charset=tis-620");

session_start();
require_once("function.php"); 
if(!checkUser()){    echo Message(35,"red",$titel1,$msg1,"<a href='index.php'> $login </a>");
   exit;
}
$mode = $_REQUEST["mode"];
$id = $_REQUEST["id"];
$user_id = $_REQUEST["user_id"];
$months = $_REQUEST["months"];
$years = $_REQUEST["years"];  
$authen_by = $_REQUEST["authen_by"];  
if($mode=="approver"){
     $sql = "update tbl_incentive_ot  set status_check = 's',authen_by = '$authen_by' where id = $id";
}else if($mode=="return"){
    $sql = "update tbl_incentive_ot  set status_check = '',authen_by = '0' where id = $id";
}//echo $sql;exit;
  mysqli_query($conn,$sql);
    header("Location:rpt.incentivebyemp.php?user_id=".$user_id."&months=".$months."&years=".$years);
?>