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


$objCSV = fopen("MyXls/sn_move_to_stockbss_26-09-2016.csv", "r");

$datenow=date("Y/m/d");

$i=0;
while (($objArr = fgetcsv($objCSV, 1000, ",")) !== FALSE) {
	$strSQL = "update tbl_hardware_onhand_user ";
	$strSQL .=" set user_id='160' ";
	$strSQL .=" where hardware_no = '".$objArr[0]."'";

 $objQuery = mysqli_query($conn,$strSQL);
		  echo "MOVE : ".$objArr[0]."</br>";

	$i++;
}
fclose($objCSV);

?>
</center>
