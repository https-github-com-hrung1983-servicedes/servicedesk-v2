<?
header("Content-Type: text/html; charset=tis-620");
session_start();
require_once("function.php");
  if(!checkUser()){    echo Message(35,"red",$titel1,$msg1,"<a href='index.php?link=detail_incident_hardeware'> $login </a>");
  exit;
  } 
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
			$sql_site_type
			order by site_id
			";
 }else if($typer == "activetoengineer"){ 
	$sql = "SELECT
			tbl_hardware_onhand_user.hardware_no as sn,
			tbl_hardware_onhand_user.owner_by as site_id,
		    tbl_hardware_onhand_user.dte_tme_entry_pump
			FROM tbl_hardware_onhand_user
			Where
			tbl_hardware_onhand_user.cate_id = '$cate_id'
			$sql_site_type
			And tbl_hardware_onhand_user.hardware_status = 'a'
			order by site_id
			";

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
		    And tbl_hardware_onhand_user.hardware_status = 'r'
			order by site_id
			";
} else if($typer == "scrap"){
$sql = "SELECT
			tbl_hardware_onhand_user.hardware_no as sn,
			tbl_hardware_onhand_user.owner_by as site_id,
			tbl_hardware_onhand_user.dte_tme_entry_pump
			FROM tbl_hardware_onhand_user
			Where
			tbl_hardware_onhand_user.cate_id in ('$cate_id')
			$sql_site_type
			And tbl_hardware_onhand_user.hardware_status = 'i'
			order by site_id
			";

}

// echo $sql;	

?>

<link href="image/bss_icon.ico" rel="shortcut icon" />  
<link href="style/calendar.css" rel="stylesheet" type="text/css">    
<link href="style/mytable.css" rel="stylesheet" type="text/css" />   
<script type="text/javascript" src="script/calendar_date_picker.js"></script>     
<link href="style/stylecss.css" rel="stylesheet" type="text/css">
<link href="style/filtergrid.css" rel="stylesheet" type="text/css">

<style type="text/css">
    <!--
    .mytable1 {    width:100%; font-size:12px;
                border:1px solid #ccc;
                font-size:11px;     
    }
    .mytable11 {width:100%; font-size:12px;                                                               
                border:1px solid #ccc;
                font-size:11px;     
    }
   .th{ background-color:#003366; color:#FFF; padding:0px; border:0px solid #ccc; height:20px; } 
    -->
</style>
<link href="css/loading.css" rel="stylesheet" type="text/css" media="all">

 
<table align="center" class="mytable" id="table" height="70%"   cellpadding="1" cellspacing="1">
    <tr>                                               
        <td valign="top" align="center">                                                       	                         
                <table align="center" bordercolor="#000000" class="mytable"  border="1" width="60%"> 
                   
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
		</td></tr></table>








