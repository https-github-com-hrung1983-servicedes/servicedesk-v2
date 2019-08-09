<?
session_start();
require_once("connection.php");
include("header.php");  
$cate_id = $_REQUEST["id"];
$typer = $_REQUEST["typer"];
$site_type=$_REQUEST["site_type"];
if($site_type == "NGV"){
	  $sql_site_type=" And tbl_hardware_onhand_user.user_id not like '10%'
							  And tbl_hardware_onhand_user.user_id not like '6%'
							  ";
}
elseif($site_type == "OIL"){
	  $sql_site_type="and (tbl_hardware_onhand_user.user_id like '10%'
				or tbl_hardware_onhand_user.user_id like '6%'
				or tbl_hardware_onhand_user.hardware_brand like '%OIL%'
				)";
}
else{
	   $sql_site_type="";
}


if($typer == "active"){
      $sql = "SELECT
			tbl_hardware_onhand_user.user_id as site_id,
			tbl_hardware_onhand_user.hardware_no as sn,
			tbl_hardware_onhand_user.dte_tme_entry_pump
			FROM tbl_hardware_onhand_user
			Where tbl_hardware_onhand_user.cate_id = '$cate_id'
			And tbl_hardware_onhand_user.hardware_status = 'w'
			$sql_site_type";
 }else if($typer == "activetoengineer"){ 
	$sql = "SELECT
			tbl_hardware_onhand_user.hardware_no as sn,
			tbl_hardware_onhand_user.owner_by as site_id,
		    tbl_hardware_onhand_user.dte_tme_entry_pump
			FROM tbl_hardware_onhand_user
			Where
			tbl_hardware_onhand_user.cate_id = '$cate_id'
			$sql_site_type
			And tbl_hardware_onhand_user.hardware_status = 'a'";

 }else if($typer == "onhand"){
 	$sql = "SELECT
			tbl_hardware_onhand_user.user_id,
			tbl_hardware_onhand_user.hardware_no as sn,
			concat(tbl_user.name,' ',tbl_user.sname) as site_id,
		    tbl_hardware_onhand_user.dte_tme_entry_pump
			FROM tbl_hardware_onhand_user
			left outer join tbl_user ON tbl_hardware_onhand_user.user_id = tbl_user.user_id
			Where
			tbl_hardware_onhand_user.cate_id in ('$cate_id')
			$sql_site_type
			And tbl_hardware_onhand_user.hardware_status = 'o'
			order by tbl_user.name";
} else if($typer == "repair"){
	$sql = "SELECT
			tbl_hardware_onhand_user.hardware_no as sn,
			tbl_hardware_onhand_user.owner_by as site_id,
		    tbl_hardware_onhand_user.dte_tme_entry_pump
			FROM tbl_hardware_onhand_user
			Where
			tbl_hardware_onhand_user.cate_id in ('$cate_id')
			$sql_site_type
		    And tbl_hardware_onhand_user.hardware_status = 'r'";
} else if($typer == "scrap"){
$sql = "SELECT
			tbl_hardware_onhand_user.hardware_no as sn,
			tbl_hardware_onhand_user.owner_by as site_id,
			tbl_hardware_onhand_user.dte_tme_entry_pump
			FROM tbl_hardware_onhand_user
			Where
			tbl_hardware_onhand_user.cate_id in ('$cate_id')
			$sql_site_type
			And tbl_hardware_onhand_user.hardware_status = 'i'";

}

// echo $sql;	

?>

<link href="css/style.css" rel="stylesheet" type="text/css">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

<link href="css/loading.css" rel="stylesheet" type="text/css" media="all">

 </br>
                                    &nbsp;&nbsp;
			<a href="summary_serial_detail_export.php?id=<?=$cate_id?>&typer=<?=$typer?>&site_type=<?=$site_type?>"><img src="img/export.png" width="25px" height="25px" title="Export to excel"></a>                 	                         
<table align="center" bordercolor="#000000" class="table_one"  border="1" > 
                   
		    <tr>
                        <th align="center" height="40" class="th"></th> 
                        <th align="center" height="40" class="th">Responsibility</th>   
                        <th align="center" height="40" class="th">S/N</th> 
                        <th align="center" height="40" class="th">Date</th>                   
                    </tr >
	<?
		$rs = mysqli_query($conn,$sql);
		$i = 1;
		while($c = mysqli_fetch_array($rs)) {
?>
	  <tr onmouseover=this.style.backgroundColor='violet'; onmouseout=this.style.backgroundColor='white';>
			<td align="center" style="padding:0px; border-bottom:1px solid #ccc; border-right:0px solid #ccc;"><?=$i?></td>
			<td style="padding:0px; border-bottom:1px solid #ccc; border-right:0px solid #ccc;">&nbsp;&nbsp;&nbsp;<?=$c["site_id"]?></td>
			<td style="padding:0px; border-bottom:1px solid #ccc; border-right:0px solid #ccc;">&nbsp;&nbsp;&nbsp;<?=$c["sn"]?></td>
			<td style="padding:0px; border-bottom:1px solid #ccc; border-right:0px solid #ccc;">&nbsp;&nbsp;&nbsp;<?=$c["dte_tme_entry_pump"]?></td>
		</tr>
<?
	$i++;
}
?>
</table>








