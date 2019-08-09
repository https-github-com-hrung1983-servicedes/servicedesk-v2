<?
header("Content-Type: text/html; charset=tis-620");                 
session_start();
require_once("function.php");                                   
include("header.php");   
  if(!checkUser()){    echo Message(35,"red",$titel1,$msg1,"<a href='index.php?link=cm_sla_percentage'> $login </a>");
		 exit;
  }
 	  $months = $_REQUEST["months"];
      $years = $_REQUEST["years"];
	  $today = getdate();
//	  print_r($today);
	  if ( $months == "" || $years=="" ) {
			$months = date("m");  //$today["mon"]
			$years = $today["year"];
			$dte = $years."-".$months;//formatNum($months,1)
	  } else  {
		$dte = $years."-".$months; 
	  }
	 
	   

  
$sql_bss="select * from tbl_cm_sla_percentage where cm_ngv_percall_sitename='Biserv Solution' order by cm_id DESC limit 1";
$rs_bss = mysqli_query($conn,$sql_bss);
$data_bss= mysqli_fetch_array($rs_bss);

$sql_msi="select * from tbl_cm_sla_percentage where cm_ngv_percall_sitename='Maximum Solution Idea' order by cm_id DESC limit 1";
$rs_msi = mysqli_query($conn,$sql_msi);
$data_msi= mysqli_fetch_array($rs_msi);

$sql_total="select * from tbl_cm_sla_percentage where cm_ngv_percall_sitename='TOTAL' order by cm_id DESC limit 1";
$rs_total = mysqli_query($conn,$sql_total);
$data_total= mysqli_fetch_array($rs_total);

?>
<style>
table{
	   font-family: Arial;
	   font-size: 11px;
}
.ttd{
	   background-color: #00316A;
	   color: #FFFFFF;
	   text-align: center;
}
.list_td:hover{
	   background-color: violet;
}
</style>
<table border="1" style="width: 100%;">
<tr>
	   <th colspan=13 class="ttd">CM NGV (Per Call)</th>
</tr>
<tr>
	   <td rowspan=2 class="ttd">Site Name</td>
	   <td colspan=2 class="ttd">WSLA</td>
	   <td colspan=2 class="ttd">FSLA</td>
	   <td colspan=2 class="ttd">Close</td>
	   <td colspan=2 class="ttd">Cancel</td>
	   <td colspan=2 class="ttd">Inprogress</td>
	   <td colspan=2 class="ttd">Total</td> 
</tr>
<tr >
	   <td class="ttd">Job</td><td class="ttd">Percentage</td>
	   <td class="ttd">Job</td><td class="ttd">Percentage</td>
	   <td class="ttd">Job</td><td class="ttd">Percentage</td>
	   <td class="ttd">Job</td><td class="ttd">Percentage</td>
	   <td class="ttd">Job</td><td class="ttd">Percentage</td>
	   <td class="ttd">Job</td><td class="ttd">Percentage</td>

</tr>
<tr  class='list_td'>
	   <td align='center' class='list_td'><?=$data_bss["cm_ngv_percall_sitename"]?></td>
	   <td align='center' class='list_td'><?=$data_bss["cm_ngv_percall_wsla_job"]?></td><td align='center'><?=$data_bss["cm_ngv_percall_wsla_percentage"]?></td>
	   <td align='center' class='list_td'><?=$data_bss["cm_ngv_percall_fsla_job"]?></td><td align='center'><?=$data_bss["cm_ngv_percall_fsla_percentage"]?></td>
	   <td align='center' class='list_td'><?=$data_bss["cm_ngv_percall_close_job"]?></td><td align='center'><?=$data_bss["cm_ngv_percall_close_percentage"]?></td>
	   <td align='center' class='list_td'><?=$data_bss["cm_ngv_percall_cancel_job"]?></td><td align='center'><?=$data_bss["cm_ngv_percall_cancel_percentage"]?></td>
	   <td align='center' class='list_td'><?=$data_bss["cm_ngv_percall_inprogress_job"]?></td><td align='center'><?=$data_bss["cm_ngv_percall_inprogress_percentage"]?></td>
	   <td align='center' class='list_td'><?=$data_bss["cm_ngv_percall_total_job"]?></td><td align='center'><?=$data_bss["cm_ngv_percall_total_percentage"]?></td>
</tr>
<tr class='list_td'>
	   <td align='center' class='list_td'><?=$data_msi["cm_ngv_percall_sitename"]?></td>
	   <td align='center' class='list_td'><?=$data_msi["cm_ngv_percall_wsla_job"]?></td><td align='center'><?=$data_msi["cm_ngv_percall_wsla_percentage"]?></td>
	   <td align='center' class='list_td'><?=$data_msi["cm_ngv_percall_fsla_job"]?></td><td align='center'><?=$data_msi["cm_ngv_percall_fsla_percentage"]?></td>
	   <td align='center' class='list_td'><?=$data_msi["cm_ngv_percall_close_job"]?></td><td align='center'><?=$data_msi["cm_ngv_percall_close_percentage"]?></td>
	   <td align='center' class='list_td'><?=$data_msi["cm_ngv_percall_cancel_job"]?></td><td align='center'><?=$data_msi["cm_ngv_percall_cancel_percentage"]?></td>
	   <td align='center' class='list_td'><?=$data_msi["cm_ngv_percall_inprogress_job"]?></td><td align='center'><?=$data_msi["cm_ngv_percall_inprogress_percentage"]?></td>
	   <td align='center' class='list_td'><?=$data_msi["cm_ngv_percall_total_job"]?></td><td align='center'><?=$data_msi["cm_ngv_percall_total_percentage"]?></td>
</tr>
<tr class='list_td'>
	   <td align='center'><?=$data_total["cm_ngv_percall_sitename"]?></td>
	   <td align='center'><?=$data_total["cm_ngv_percall_wsla_job"]?></td><td align='center'><?=$data_total["cm_ngv_percall_wsla_percentage"]?></td>
	   <td align='center'><?=$data_total["cm_ngv_percall_fsla_job"]?></td><td align='center'><?=$data_total["cm_ngv_percall_fsla_percentage"]?></td>
	   <td align='center'><?=$data_total["cm_ngv_percall_close_job"]?></td><td align='center'><?=$data_total["cm_ngv_percall_close_percentage"]?></td>
	   <td align='center'><?=$data_total["cm_ngv_percall_cancel_job"]?></td><td align='center'><?=$data_total["cm_ngv_percall_cancel_percentage"]?></td>
	   <td align='center'><?=$data_total["cm_ngv_percall_inprogress_job"]?></td><td align='center'><?=$data_total["cm_ngv_percall_inprogress_percentage"]?></td>
	   <td align='center'><?=$data_total["cm_ngv_percall_total_job"]?></td><td align='center'><?=$data_total["cm_ngv_percall_total_percentage"]?></td>
</tr>
</table>

<br>

<table border="1" style="width: 100%;">
<tr>
	   <th colspan=13 class="ttd">CM NGV (Packages)</th>
</tr>
<tr>
	   <td rowspan=2 class="ttd">Site Name</td>
	   <td colspan=2 class="ttd">WSLA</td>
	   <td colspan=2 class="ttd">FSLA</td>
	   <td colspan=2 class="ttd">Close</td>
	   <td colspan=2 class="ttd">Cancel</td>
	   <td colspan=2 class="ttd">Inprogress</td>
	   <td colspan=2 class="ttd">Total</td> 
</tr>
<tr>
	   <td class="ttd">Job</td><td class="ttd">Percentage</td>
	   <td class="ttd">Job</td><td class="ttd">Percentage</td>
	   <td class="ttd">Job</td><td class="ttd">Percentage</td>
	   <td class="ttd">Job</td><td class="ttd">Percentage</td>
	   <td class="ttd">Job</td><td class="ttd">Percentage</td>
	   <td class="ttd">Job</td><td class="ttd">Percentage</td>

</tr>
<tr  class='list_td'>
	   <td align='center'><?=$data_bss["cm_ngv_packages_sitename"]?></td>
	   <td align='center'><?=$data_bss["cm_ngv_packages_wsla_job"]?></td><td align='center'><?=$data_bss["cm_ngv_packages_wsla_percentage"]?></td>
	   <td align='center'><?=$data_bss["cm_ngv_packages_fsla_job"]?></td><td align='center'><?=$data_bss["cm_ngv_packages_fsla_percentage"]?></td>
	   <td align='center'><?=$data_bss["cm_ngv_packages_close_job"]?></td><td align='center'><?=$data_bss["cm_ngv_packages_close_percentage"]?></td>
	   <td align='center'><?=$data_bss["cm_ngv_packages_cancel_job"]?></td><td align='center'><?=$data_bss["cm_ngv_packages_cancel_percentage"]?></td>
	   <td align='center'><?=$data_bss["cm_ngv_packages_inprogress_job"]?></td><td align='center'><?=$data_bss["cm_ngv_packages_inprogress_percentage"]?></td>
	   <td align='center'><?=$data_bss["cm_ngv_packages_total_job"]?></td><td align='center'><?=$data_bss["cm_ngv_packages_total_percentage"]?></td>
</tr>
<tr  class='list_td'>
	   <td align='center'><?=$data_msi["cm_ngv_packages_sitename"]?></td>
	   <td align='center'><?=$data_msi["cm_ngv_packages_wsla_job"]?></td><td align='center'><?=$data_msi["cm_ngv_packages_wsla_percentage"]?></td>
	   <td align='center'><?=$data_msi["cm_ngv_packages_fsla_job"]?></td><td align='center'><?=$data_msi["cm_ngv_packages_fsla_percentage"]?></td>
	   <td align='center'><?=$data_msi["cm_ngv_packages_close_job"]?></td><td align='center'><?=$data_msi["cm_ngv_packages_close_percentage"]?></td>
	   <td align='center'><?=$data_msi["cm_ngv_packages_cancel_job"]?></td><td align='center'><?=$data_msi["cm_ngv_packages_cancel_percentage"]?></td>
	   <td align='center'><?=$data_msi["cm_ngv_packages_inprogress_job"]?></td><td align='center'><?=$data_msi["cm_ngv_packages_inprogress_percentage"]?></td>
	   <td align='center'><?=$data_msi["cm_ngv_packages_total_job"]?></td><td align='center'><?=$data_msi["cm_ngv_packages_total_percentage"]?></td>
</tr>
<tr  class='list_td'>
	   <td align='center'><?=$data_total["cm_ngv_packages_sitename"]?></td>
	   <td align='center'><?=$data_total["cm_ngv_packages_wsla_job"]?></td><td align='center'><?=$data_total["cm_ngv_packages_wsla_percentage"]?></td>
	   <td align='center'><?=$data_total["cm_ngv_packages_fsla_job"]?></td><td align='center'><?=$data_total["cm_ngv_packages_fsla_percentage"]?></td>
	   <td align='center'><?=$data_total["cm_ngv_packages_close_job"]?></td><td align='center'><?=$data_total["cm_ngv_packages_close_percentage"]?></td>
	   <td align='center'><?=$data_total["cm_ngv_packages_cancel_job"]?></td><td align='center'><?=$data_total["cm_ngv_packages_cancel_percentage"]?></td>
	   <td align='center'><?=$data_total["cm_ngv_packages_inprogress_job"]?></td><td align='center'><?=$data_total["cm_ngv_packages_inprogress_percentage"]?></td>
	   <td align='center'><?=$data_total["cm_ngv_packages_total_job"]?></td><td align='center'><?=$data_total["cm_ngv_packages_total_percentage"]?></td>
</tr>
</table>

<br>

<table border="1" style="width: 100%;">
<tr>
	   <th colspan=13 class="ttd">CM Oil (Per Call)</th>
</tr>
<tr>
	   <td rowspan=2 class="ttd">Site Name</td>
	   <td colspan=2 class="ttd">WSLA</td>
	   <td colspan=2 class="ttd">FSLA</td>
	   <td colspan=2 class="ttd">Close</td>
	   <td colspan=2 class="ttd">Cancel</td>
	   <td colspan=2 class="ttd">Inprogress</td>
	   <td colspan=2 class="ttd">Total</td> 
</tr>
<tr>
	   <td class="ttd">Job</td><td class="ttd">Percentage</td>
	   <td class="ttd">Job</td><td class="ttd">Percentage</td>
	   <td class="ttd">Job</td><td class="ttd">Percentage</td>
	   <td class="ttd">Job</td><td class="ttd">Percentage</td>
	   <td class="ttd">Job</td><td class="ttd">Percentage</td>
	   <td class="ttd">Job</td><td class="ttd">Percentage</td>

</tr>
<tr  class='list_td'>
	   <td align='center'><?=$data_bss["cm_oil_percall_sitename"]?></td>
	   <td align='center'><?=$data_bss["cm_oil_percall_wsla_job"]?></td><td align='center'><?=$data_bss["cm_oil_percall_wsla_percentage"]?></td>
	   <td align='center'><?=$data_bss["cm_oil_percall_fsla_job"]?></td><td align='center'><?=$data_bss["cm_oil_percall_fsla_percentage"]?></td>
	   <td align='center'><?=$data_bss["cm_oil_percall_close_job"]?></td><td align='center'><?=$data_bss["cm_oil_percall_close_percentage"]?></td>
	   <td align='center'><?=$data_bss["cm_oil_percall_cancel_job"]?></td><td align='center'><?=$data_bss["cm_oil_percall_cancel_percentage"]?></td>
	   <td align='center'><?=$data_bss["cm_oil_percall_inprogress_job"]?></td><td align='center'><?=$data_bss["cm_oil_percall_inprogress_percentage"]?></td>
	   <td align='center'><?=$data_bss["cm_oil_percall_total_job"]?></td><td align='center'><?=$data_bss["cm_oil_percall_total_percentage"]?></td>
</tr>
<tr  class='list_td'>
	   <td align='center'><?=$data_msi["cm_oil_percall_sitename"]?></td>
	   <td align='center'><?=$data_msi["cm_oil_percall_wsla_job"]?></td><td align='center'><?=$data_msi["cm_oil_percall_wsla_percentage"]?></td>
	   <td align='center'><?=$data_msi["cm_oil_percall_fsla_job"]?></td><td align='center'><?=$data_msi["cm_oil_percall_fsla_percentage"]?></td>
	   <td align='center'><?=$data_msi["cm_oil_percall_close_job"]?></td><td align='center'><?=$data_msi["cm_oil_percall_close_percentage"]?></td>
	   <td align='center'><?=$data_msi["cm_oil_percall_cancel_job"]?></td><td align='center'><?=$data_msi["cm_oil_percall_cancel_percentage"]?></td>
	   <td align='center'><?=$data_msi["cm_oil_percall_inprogress_job"]?></td><td align='center'><?=$data_msi["cm_oil_percall_inprogress_percentage"]?></td>
	   <td align='center'><?=$data_msi["cm_oil_percall_total_job"]?></td><td align='center'><?=$data_msi["cm_oil_percall_total_percentage"]?></td>
</tr>
<tr  class='list_td'>
	   <td align='center'><?=$data_total["cm_oil_percall_sitename"]?></td>
	   <td align='center'><?=$data_total["cm_oil_percall_wsla_job"]?></td><td align='center'><?=$data_total["cm_oil_percall_wsla_percentage"]?></td>
	   <td align='center'><?=$data_total["cm_oil_percall_fsla_job"]?></td><td align='center'><?=$data_total["cm_oil_percall_fsla_percentage"]?></td>
	   <td align='center'><?=$data_total["cm_oil_percall_close_job"]?></td><td align='center'><?=$data_total["cm_oil_percall_close_percentage"]?></td>
	   <td align='center'><?=$data_total["cm_oil_percall_cancel_job"]?></td><td align='center'><?=$data_total["cm_oil_percall_cancel_percentage"]?></td>
	   <td align='center'><?=$data_total["cm_oil_percall_inprogress_job"]?></td><td align='center'><?=$data_total["cm_oil_percall_inprogress_percentage"]?></td>
	   <td align='center'><?=$data_total["cm_oil_percall_total_job"]?></td><td align='center'><?=$data_total["cm_oil_percall_total_percentage"]?></td>
</tr>
</table>

<br>
<table style="width: 100%;">
	   <tr valign="top">
			  <td style="width: 50%;">
<table border="1" style="width: 100%;">
	   <tr>
			  <td colspan=5 class="ttd">TOP 10 SITE (Hardware & Software) </td>
	   </tr>
	   <tr>
			  <td class="ttd">No.</td>
			  <td class="ttd">Site ID</td>
			  <td class="ttd">Site Name</td>
			  <td class="ttd">Amount</td>
			  <td class="ttd">Province</td>
	   </tr>
	   <?
	   $sql_maxs ="SELECT max(s_no) as s_no FROM tbl_cm_sla_site";
	   $rs_maxs = mysqli_query($conn,$sql_maxs);
	   $data_maxs = mysqli_fetch_array($rs_maxs);
	   $max_maxs = $data_maxs["s_no"];
	   
	   $sql_s ="select * from tbl_cm_sla_site order by id  limit $max_maxs";
	   $rs_s = mysqli_query($conn,$sql_s);
	   while($data_s=mysqli_fetch_array($rs_s))
	   { ?>
	   <tr  class='list_td' onclick="javascript:showTopTenSite('<?=$dte?>','<?=$data_s['s_id']?>');" >
			  <td align='center'><?=$data_s["s_no"]?></td>
			  <td align='center'><?=$data_s["s_id"]?></td>
			  <td><?=$data_s["s_name"]?></td>
			  <td align='center'><?=$data_s["s_amount"]?></td>
			  <td><?=$data_s["s_province"]?></td>
	   </tr>
<? } ?>	   
</table>
</td><td style="width: 50%;">
<table border="1" style="width: 100%;">
	   <tr>
			  <td colspan=3 class="ttd">TOP 10 Hardware</td>
	   </tr>
	   <tr>
			  <td class="ttd">No.</td>
			  <td class="ttd">Hardware Name</td>
			  <td class="ttd">Amount</td>

	   </tr>
	   <?
	   $sql_maxh ="SELECT max(h_no) as h_no FROM tbl_cm_sla_hardware";
	   $rs_maxh = mysqli_query($conn,$sql_maxh);
	   $data_maxh = mysqli_fetch_array($rs_maxh);
	   $max_maxh = $data_maxh["h_no"];
	   
	   $sql_h ="select * from tbl_cm_sla_hardware order by id  limit $max_maxh"; 
	   $rs_h = mysqli_query($conn,$sql_h);
	   while($data_h=mysqli_fetch_array($rs_h))
	   { ?>
	   <tr  class='list_td' onclick="javascript:showTopTenHardware('<?=$dte?>','<?=$data_h['h_id']?>');">
			  <td align='center'><?=$data_h["h_no"]?></td>
			  <td><?=$data_h["h_name"]?></td>
			  <td align='center'><?=$data_h["h_amount"]?></td>
	   </tr>
<? } ?>	   
</table>
</td>
</tr>
</table>

<script type="text/javascript">
 //onclick="click2editx(<?=$row["category_id"]?>,'edit');"
 function Search_Click(typer,schby,schtxt){             
     parent.mainPage.location.href ="jobtype.index.php?typer="+typer+"&schBy="+schby+"&schTxt="+schtxt;
      }       
 function click2edit(id,typer){                        
         parent.mainPage.location.href ="jobtype.form.php?id="+id+"&typer="+typer;       
      }  
 
 function showTopTenSite(dte,id){     
        myleft=(screen.width)?(screen.width-800)/2:100;    
        mytop=(screen.height)?(screen.height-600)/2:100;      
        properties = " width=940,height=480";                
        properties +="directories=no,titlebar=no,toolbar=no,location=no,status=no,menubar=no,scrollbars=yes, top="+mytop+",left="+myleft;      
         window.open("view.sla.percentage.php?dte="+dte+"&id="+id,"Search",properties);         
    }
    function showTopTenHardware(dte,id){     
        myleft=(screen.width)?(screen.width-800)/2:100;    
        mytop=(screen.height)?(screen.height-600)/2:100;      
        properties = " width=940,height=480";                
        properties +="directories=no,titlebar=no,toolbar=no,location=no,status=no,menubar=no,scrollbars=yes, top="+mytop+",left="+myleft;      
         window.open("view.percentage.hardware.php?dte="+dte+"&id="+id,"Search",properties);         
    }
</script>
