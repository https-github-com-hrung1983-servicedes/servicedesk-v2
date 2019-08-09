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


$objCSV = fopen("MyXls/update_site.csv", "r");

$datenow=date("Y/m/d");

$i=0;
while (($objArr = fgetcsv($objCSV, 1000, ",")) !== FALSE) {
	$strSQL = "update tbl_site ";
	$strSQL .=" set from_owner= '".$objArr[1]."' ";
	$strSQL .=" where site_id = '".$objArr[0]."'";

 $objQuery = mysqli_query($conn,$strSQL);
		  echo "site_id : ".$objArr[0]."</br>";

	$i++;
}
fclose($objCSV);

?>
</center>
