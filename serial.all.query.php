<?
session_start();
include 'connection.php';

;
$sql_clear="DELETE FROM itbl_serail_all";
	mysqli_query($conn,$sql_clear);
echo $sql_clear."<br>";	  
	  $sql_site="select distinct a.id,b.id as type FROM itbl_customer4 a
					 left outer join itbl_customer3 b on a.customer_level3=b.id
						 order by 1";
		   $rs = mysqli_query($conn,$sql_site);
		  while($data = mysqli_fetch_array($rs)){
			  $site_id=$data["id"];
			  $type=$data["type"];
	  ?>

		  <? $sql_sn="SELECT *FROM itbl_hardware_onhand_site a WHERE  a.category_hw_id  = '1' and a.customer_id= '".$site_id."'";
		  //echo $sql_sn;
		  $rs_sn = mysqli_query($conn,$sql_sn);
		  $data_sn = mysqli_fetch_array($rs_sn);
		  $c1 =$data_sn["category_sn"];
		  //echo $c1; ?>

		  <? $sql_sn="SELECT *FROM itbl_hardware_onhand_site a WHERE  a.category_hw_id  = '2' and a.customer_id= '".$site_id."'";
		  //echo $sql_sn;
		  $rs_sn = mysqli_query($conn,$sql_sn);
		  $data_sn = mysqli_fetch_array($rs_sn);
		  $c2 =$data_sn["category_sn"];
		  //echo $c2; ?>

		  <? $sql_sn="SELECT *FROM itbl_hardware_onhand_site a WHERE  a.category_hw_id  = '3' and a.customer_id= '".$site_id."'";
		  //echo $sql_sn;
		  $rs_sn = mysqli_query($conn,$sql_sn);
		  $data_sn = mysqli_fetch_array($rs_sn);
		  $c3 =$data_sn["category_sn"];
		  //echo $c3; ?>

		  <? $sql_sn="SELECT *FROM itbl_hardware_onhand_site a WHERE  a.category_hw_id  = '4' and a.customer_id= '".$site_id."'";
		  //echo $sql_sn;
		  $rs_sn = mysqli_query($conn,$sql_sn);
		  $data_sn = mysqli_fetch_array($rs_sn);
		  $c4 =$data_sn["category_sn"];
		  //echo $c4; ?>

		  <? $sql_sn="SELECT *FROM itbl_hardware_onhand_site a WHERE  a.category_hw_id  = '6' and a.customer_id= '".$site_id."'";
		  //echo $sql_sn;
		  $rs_sn = mysqli_query($conn,$sql_sn);
		  $data_sn = mysqli_fetch_array($rs_sn);
		  $c6 =$data_sn["category_sn"];
		  //echo $c6; ?>

		  <? $sql_sn="SELECT *FROM itbl_hardware_onhand_site a WHERE  a.category_hw_id  = '7' and a.customer_id= '".$site_id."'";
		  //echo $sql_sn;
		  $rs_sn = mysqli_query($conn,$sql_sn);
		  $data_sn = mysqli_fetch_array($rs_sn);
		  $c7 =$data_sn["category_sn"];
		  //echo $c7; ?>

		  <? $sql_sn="SELECT *FROM itbl_hardware_onhand_site a WHERE  a.category_hw_id  = '8' and a.customer_id= '".$site_id."'";
		  //echo $sql_sn;
		  $rs_sn = mysqli_query($conn,$sql_sn);
		  $data_sn = mysqli_fetch_array($rs_sn);
		  $c8 =$data_sn["category_sn"];
		  //echo $c8; ?>

		  <? $sql_sn="SELECT *FROM itbl_hardware_onhand_site a WHERE  a.category_hw_id  = '9' and a.customer_id= '".$site_id."'";
		  //echo $sql_sn;
		  $rs_sn = mysqli_query($conn,$sql_sn);
		  $data_sn = mysqli_fetch_array($rs_sn);
		  $c9 =$data_sn["category_sn"];
		 // echo $c9; ?>

		  <? $sql_sn="SELECT *FROM itbl_hardware_onhand_site a WHERE  a.category_hw_id  = '10' and a.customer_id= '".$site_id."'";
		  //echo $sql_sn;
		  $rs_sn = mysqli_query($conn,$sql_sn);
		  $data_sn = mysqli_fetch_array($rs_sn);
		  $c10 =$data_sn["category_sn"];
		  //echo $c10; ?>

		  <? $sql_sn="SELECT *FROM itbl_hardware_onhand_site a WHERE  a.category_hw_id  = '11' and a.customer_id= '".$site_id."'";
		  //echo $sql_sn;
		  $rs_sn = mysqli_query($conn,$sql_sn);
		  $data_sn = mysqli_fetch_array($rs_sn);
		  $c11 =$data_sn["category_sn"];
		  //echo $c11; ?>

		  <? $sql_sn="SELECT *FROM itbl_hardware_onhand_site a WHERE  a.category_hw_id  = '12' and a.customer_id= '".$site_id."'";
		  //echo $sql_sn;
		  $rs_sn = mysqli_query($conn,$sql_sn);
		  $data_sn = mysqli_fetch_array($rs_sn);
		  $c12 =$data_sn["category_sn"];
		  //echo $c12; ?>

		  <? $sql_sn="SELECT *FROM itbl_hardware_onhand_site a WHERE  a.category_hw_id  = '13' and a.customer_id= '".$site_id."'";
		  //echo $sql_sn;
		  $rs_sn = mysqli_query($conn,$sql_sn);
		  $data_sn = mysqli_fetch_array($rs_sn);
		  $c13 =$data_sn["category_sn"];
		  //echo $c13; ?>
	 
		  <? $sql_sn="SELECT *FROM itbl_hardware_onhand_site a WHERE  a.category_hw_id  = '14' and a.customer_id= '".$site_id."'";
		  //echo $sql_sn;
		  $rs_sn = mysqli_query($conn,$sql_sn);
		  $data_sn = mysqli_fetch_array($rs_sn);
		  $c14 =$data_sn["category_sn"];
		  //echo $c14; ?>

		  <? $sql_sn="SELECT *FROM itbl_hardware_onhand_site a WHERE  a.category_hw_id  = '15' and a.customer_id= '".$site_id."'";
		  //echo $sql_sn;
		  $rs_sn = mysqli_query($conn,$sql_sn);
		  $data_sn = mysqli_fetch_array($rs_sn);
		  $c15 =$data_sn["category_sn"];
		  //echo $c16; ?>

		  <? $sql_sn="SELECT *FROM itbl_hardware_onhand_site a WHERE  a.category_hw_id  = '16' and a.customer_id= '".$site_id."'";
		  //echo $sql_sn;
		  $rs_sn = mysqli_query($conn,$sql_sn);
		  $data_sn = mysqli_fetch_array($rs_sn);
		  $c16 =$data_sn["category_sn"];
		  //echo $c25; ?>

		  <? $sql_sn="SELECT *FROM itbl_hardware_onhand_site a WHERE  a.category_hw_id  = '17' and a.customer_id= '".$site_id."'";
		  //echo $sql_sn;
		  $rs_sn = mysqli_query($conn,$sql_sn);
		  $data_sn = mysqli_fetch_array($rs_sn);
		  $c17 =$data_sn["category_sn"];
		  //echo $c27; ?>

		  <? $sql_sn="SELECT *FROM itbl_hardware_onhand_site a WHERE  a.category_hw_id  = '18' and a.customer_id= '".$site_id."'";
		  //echo $sql_sn;
		  $rs_sn = mysqli_query($conn,$sql_sn);
		  $data_sn = mysqli_fetch_array($rs_sn);
		  $c18 =$data_sn["category_sn"];
		  //echo $c30; ?>

		  <? $sql_sn="SELECT *FROM itbl_hardware_onhand_site a WHERE  a.category_hw_id  = '19' and a.customer_id= '".$site_id."'";
		  //echo $sql_sn;
		  $rs_sn = mysqli_query($conn,$sql_sn);
		  $data_sn = mysqli_fetch_array($rs_sn);
		  $c19 =$data_sn["category_sn"];
		  //echo $c31; ?>

		  <? $sql_sn="SELECT *FROM itbl_hardware_onhand_site a WHERE  a.category_hw_id  = '20' and a.customer_id= '".$site_id."'";
		  //echo $sql_sn;
		  $rs_sn = mysqli_query($conn,$sql_sn);
		  $data_sn = mysqli_fetch_array($rs_sn);
		  $c20 =$data_sn["category_sn"];
		  //echo $c36; ?>

		  <? $sql_sn="SELECT *FROM itbl_hardware_onhand_site a WHERE  a.category_hw_id  = '21' and a.customer_id= '".$site_id."'";
		  //echo $sql_sn;
		  $rs_sn = mysqli_query($conn,$sql_sn);
		  $data_sn = mysqli_fetch_array($rs_sn);
		  $c21 =$data_sn["category_sn"];
		  //echo $c37; ?>

	  <?
	  $sql_insert="INSERT INTO itbl_serail_all (SiteID,`Access Point`, `Cash Drawer`, POS, Keyboard, Mobile, Monitor, Mouse, PC, Printer, Scanner, `Monitor Touch Screen`, Switch, UPS, `Magnetic Card Reader (MSR)`, Harddisk, Router, Keypad, Plug, `FDM BOX`, `Enable Card`,type) 
	  values ('$site_id','$c1','$c2','$c3','$c4','$c6','$c7','$c8','$c9','$c10','$c11','$c12','$c13','$c14','$c15','$c16','$c17','$c18','$c19','$c20','$c21','$type')";
	  $objQuery = mysqli_query($conn,$sql_insert);
	  echo $sql_insert."<br>";
	  if($objQuery)
{
	echo "<font color='green'>Save Done.</font> <br>";
}
else
{
	echo "<font color='red'>Error Save.</font>  <br>";
}
	  } ?>
