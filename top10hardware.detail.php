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
<?
/*
$sql = "SELECT
tbl_category_hardware.cate_id,
tbl_category_hardware.cate_name
FROM
tbl_category_hardware
where tbl_category_hardware.cate_id in ('1','2','3','4','6','7','8','9','10','11','12','13','36')"; 
$res = mysqli_query($conn,$sql);
*/
$i = 1;
?>
           
		    <tr>
			<td colspan="5" align="center">&nbsp;</td>
		    </tr>
		    <tr>
                        <th align="center" height="40" class="th">#</th>     
                        <th align="center" height="40" class="th">Site ID.</th>    
                        <th align="center" height="40" class="th">Site Name</th> 
                        <th align="center" height="40" class="th">Job No.</th>       
                        <th align="center" height="40" class="th">Date</th>            
                    </tr >
	<? //echo $fromdte."-".$todte;
		$sql = "SELECT
				tbl_insident_hw.site_id,
				tbl_site.site_name,
				tbl_insident_hw.job_no,
				tbl_log_call_center.open_call_dte
			FROM
				tbl_insident_hw
			Inner Join tbl_site ON tbl_insident_hw.site_id = tbl_site.site_id
			Inner Join tbl_log_call_center ON tbl_insident_hw.job_no = tbl_log_call_center.job_no
			WHERE tbl_insident_hw.serial_no = '$id'
			And tbl_insident_hw.job_no like 'NGV%'
			And tbl_log_call_center.open_call_dte  between '$fromdte' and  '$todte'";//echo $sql;
		$rs = mysqli_query($conn,$sql);
		$i = 1;
		while($c = mysqli_fetch_array($rs)) {
?> 
		<tr onMouseOver="this.style.backgroundColor='violet';" onMouseOut="this.style.backgroundColor='white';">    
		      <td style="padding:0px; border-bottom:1px solid #ccc; border-right:0px solid #ccc;" align="center">
<?=$i?></td>
		      <td style="padding:0px; border-bottom:1px solid #ccc; border-right:0px solid #ccc;" align="center">
<?=$c["site_id"]?></td>      
		      <td style="padding:0px; border-bottom:1px solid #ccc; border-right:0px solid #ccc;" >&nbsp;&nbsp;&nbsp;&nbsp;
<?=$c["site_name"]?></td>
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








