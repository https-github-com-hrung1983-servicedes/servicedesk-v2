<?
header("Content-Type: text/html; charset=tis-620");
session_start();
require_once("function.php");
  if(!checkUser()){    echo Message(35,"red",$titel1,$msg1,"<a href='index.php?link=detail_incident_hardeware'> $login </a>");
  exit;
  }  
include("header.php");
$id = $_REQUEST["id"];
$sql = "SELECT distinct
tbl_hardware_onhand_user.id,
tbl_log_call_center.job_no,
tbl_log_call_center.site_id,
tbl_log_call_center.open_call_dte,
tbl_user.name,
tbl_user.sname,
tbl_site.site_name
FROM
tbl_hardware_onhand_user
Inner Join tbl_insident_hw ON tbl_hardware_onhand_user.id = tbl_insident_hw.serial_no
Right Join tbl_log_call_center ON tbl_insident_hw.job_no = tbl_log_call_center.job_no
Inner Join tbl_user ON tbl_log_call_center.reciept_job_user_id = tbl_user.user_id
Inner Join tbl_site ON tbl_log_call_center.site_id = tbl_site.site_id
Where tbl_hardware_onhand_user.hardware_no = '$id'
And tbl_log_call_center.job_no like 'NGV%'"; 
 
	
//echo $sql;
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
                        <th align="center" height="40" class="th">No.</th>   
                        <th align="center" height="40" class="th">Job No.</th>  
                        <th align="center" height="40" class="th">Installation Date</th>  
                        <th align="center" height="40" class="th">Site</th>   
                        <th align="center" height="40" class="th">S/N</th>  
                        <th align="center" height="40" class="th">Service by</th>                    
                    </tr >
	<? 
		$rs = mysqli_query($conn,$sql);
		$i = 1;
		while($c = mysqli_fetch_array($rs)) {
		if($c["job_no"]!=""){
?> 
		<tr>    <td style="padding:0px; border-bottom:1px solid #ccc; border-right:0px solid #ccc;" align="center"><?=$i?></td>
			<td style="padding:0px; border-bottom:1px solid #ccc; border-right:0px solid #ccc;" align="center"><?=$c["job_no"]?></td>
			<td style="padding:0px; border-bottom:1px solid #ccc; border-right:0px solid #ccc;" align="center"><?=$c["open_call_dte"]?></td>
			<td style="padding:0px; border-bottom:1px solid #ccc; border-right:0px solid #ccc;">&nbsp;&nbsp;&nbsp;<?=$c["site_id"]." ".$c["site_name"]?></td>
			<td style="padding:0px; border-bottom:1px solid #ccc; border-right:0px solid #ccc;" align="center"><?=$id?></td>
			<td style="padding:0px; border-bottom:1px solid #ccc; border-right:0px solid #ccc;">&nbsp;&nbsp;&nbsp;<?=$c["name"]." ".$c["sname"]?></td>
		</tr>
<?
	$i++;
	}
}
?>
                </table>  
            </form></td></tr></table>








