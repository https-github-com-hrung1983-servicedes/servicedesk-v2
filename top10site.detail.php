<?
header("Content-Type: text/html; charset=tis-620");
session_start();
require_once("function.php");
  if(!checkUser()){    echo Message(35,"red",$titel1,$msg1,"<a href='index.php?link=detail_incident_hardeware'> $login </a>");
  exit;
  }  
include("header.php");
$id = $_REQUEST["id"];
$fromdte = $_REQUEST["fmyear"]."-".$_REQUEST["fmmnt"]."-1";
$todte = $_REQUEST["toyear"]."-".$_REQUEST["tomnt"]."-31";
/*
$sql="SELECT
	tbl_insident_hw.serial_no,
	tbl_hardware_onhand_user.hardware_no,
	tbl_hardware_onhand_user.id
FROM
tbl_insident_hw
Inner Join tbl_hardware_onhand_user ON tbl_insident_hw.serial_no = tbl_hardware_onhand_user.hardware_no";
$rs = mysqli_query($conn,$sql);
while($c = mysqli_fetch_array($rs)){
	$sql_update = "update tbl_insident_hw set tbl_insident_hw.serial_no = '$c[id]' where tbl_insident_hw.serial_no = '$c[serial_no]'";
mysqli_query($conn,$sql_update);
	echo $sql_update."<br>";
}
*/


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

 <form name="form" id="form">
<table align="center" class="mytable" id="table" height="70%"   cellpadding="1" cellspacing="1">
    <tr>                                               
        <td valign="top" align="center">                                                       	                         
                <table align="center" bordercolor="#000000" class="mytable"  border="1" width="60%">       

           
		    <tr>
			<td colspan="4" align="center">&nbsp;</td>
		    </tr>
		    <tr>
                        <th align="center" height="40" class="th">#</th>     
                        <th align="center" height="40" class="th">Category</th> 
                        <th align="center" height="40" class="th">S/N</th>     
                        <th align="center" height="40" class="th">Job no.</th>     
                        <th align="center" height="40" class="th">Date</th>                    
                    </tr >
	<?
		$sql = "SELECT  tbl_insident_hw.job_no,
tbl_insident_hw.site_id,
tbl_site.site_name,
tbl_category_hardware.cate_name,
tbl_insident_hw.job_no,
tbl_log_call_center.open_call_dte,
tbl_hardware_onhand_user.hardware_no
FROM
tbl_insident_hw
Inner Join tbl_site ON tbl_insident_hw.site_id = tbl_site.site_id
Inner Join tbl_category_hardware ON tbl_insident_hw.cate_id = tbl_category_hardware.cate_id
Inner Join tbl_log_call_center ON tbl_insident_hw.job_no = tbl_log_call_center.job_no
Inner Join tbl_hardware_onhand_user ON tbl_insident_hw.serial_no = tbl_hardware_onhand_user.id
Where  tbl_insident_hw.cate_id in ('1','2','3','4','6','7','8','9','10','11','12','13','36')
And tbl_insident_hw.site_id = '$id'
And tbl_insident_hw.job_no  like 'NGV%'
And tbl_log_call_center.open_call_dte   between '$fromdte' and  '$todte'
Order by tbl_category_hardware.cate_name"; 
//echo $sql;
	$res = mysqli_query($conn,$sql);
	$i = 1;
	while($c = mysqli_fetch_array($res)){
?>
		<tr onMouseOver="this.style.backgroundColor='violet';" onMouseOut="this.style.backgroundColor='white';">    
		      <td style="padding:0px; border-bottom:1px solid #ccc; border-right:0px solid #ccc;" align="center">
<?=$i?></td>
		      <td style="padding:0px; border-bottom:1px solid #ccc; border-right:0px solid #ccc;" >&nbsp;&nbsp;&nbsp;&nbsp;
<?=$c["cate_name"]?></td>      
		      <td style="padding:0px; border-bottom:1px solid #ccc; border-right:0px solid #ccc;" >&nbsp;&nbsp;&nbsp;&nbsp;
<?=$c["hardware_no"]?></td>
		      <td style="padding:0px; border-bottom:1px solid #ccc; border-right:0px solid #ccc;" >&nbsp;&nbsp;&nbsp;&nbsp;
<?=$c["job_no"]?></td>      
		      <td style="padding:0px; border-bottom:1px solid #ccc; border-right:0px solid #ccc;" >&nbsp;&nbsp;&nbsp;&nbsp;
<?=$c["open_call_dte"]?></td>
		</tr>
<?
	$i++;	
}
?>
                </table>  
            </form></td></tr></table>








