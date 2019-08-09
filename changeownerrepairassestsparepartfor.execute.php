<?
require_once("function.php");
header("Content-Type: text/html; charset=tis-620");


		$check = $_REQUEST["check"];
		$cate_id = $_REQUEST["cate_id"];

		$repair_by = $_REQUEST["repair_by"];
		$owner_by = $_REQUEST["owner_by"];
		$asset_by = $_REQUEST["asset_by"];
		$sparepartfor = $_REQUEST["sparepartfor"];
		$cmdx = "";
		for($i=0;$i<$_REQUEST["rows"];$i++){
				$id[$i] = $_REQUEST["check"][$i];
				$sql_changeonhand = "";
				if($id[$i]!=""){
					$sql_changeonhand = "update tbl_hardware_onhand_user set
						repair_by = '$repair_by',
						owner_by = '$owner_by',
						asset_by = '$asset_by',
						sparepartfor = '$sparepartfor',
						fix_change = '1'
					 where id ='$id[$i]'";
					 mysqli_query($conn,$sql_changeonhand);
				//	echo  $sql_changeonhand."<br>";
					}
			
		}

header("location:changeownerrepairassestsparepartfor.list.php?cate_id=$cate_id");
//echo "asdfasd";

