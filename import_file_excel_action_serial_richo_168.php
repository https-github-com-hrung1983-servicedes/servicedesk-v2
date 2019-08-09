<?
header("Content-Type: text/html; charset=tis-620");

session_start();
require_once("function.php");
include("header.php");

?>
<br>
<center>
<?php
move_uploaded_file($_FILES["fileCSV"]["tmp_name"],$_FILES["fileCSV"]["name"]); // Copy/Upload CSV


$objCSV = fopen("MyXls/sn_richo_168.csv", "r");

$datenow=date("Y/m/d");



$i=0;
while (($objArr = fgetcsv($objCSV, 1000, ",")) !== FALSE) {
	$strSQL = "INSERT INTO tbl_hardware_onhand_user ";
	$strSQL .="(user_id,cate_id, hardware_brand, hardware_no , hardware_status ,owner_by,asset_by
  ,warranty_hardware_type_date,expired_hardware_type_date,comment_lot ,dte_tme_entry_stock) ";
	$strSQL .="VALUES ";
	$strSQL .="('".$objArr[0]."','".$objArr[1]."','".$objArr[2]."' ";
	$strSQL .=",'".$objArr[3]."','".$objArr[4]."','".$objArr[5]."' ";
  $strSQL .=",'".$objArr[6]."','2016/5/19','2021/5/18','".$objArr[9]."' , NOW() ) ";

	$sql_check="select count(a.hardware_no) as sn_check
							from tbl_hardware_onhand_user a
							where a.hardware_no='".$objArr[3]."' ";
	$rs_check = mysqli_query($conn,$sql_check);
	$c_check = mysqli_fetch_array($rs_check);
if($i>0){
	if($c_check["sn_check"] > 0) {
		  echo "Import : ".$strSQL." <font color='red'>ERROR was already</font>.</br>";
	}else{
		$objQuery = mysqli_query($conn,$strSQL);
	  echo "Import : ".$strSQL." DONE.</br>";
	}
	}
	$i++;
}
fclose($objCSV);

?>
</center>
