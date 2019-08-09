<?
header("Content-Type: text/html; charset=tis-620");                 
session_start();
require_once("function.php");          
  
  if(!checkUser()){    echo Message(35,"red",$titel1,$msg1,"<a href='index.php'> $login </a>");
  exit;
  }                                                                                                     
       
include("header.php");   
$schtxt = $_REQUEST["schTxt"];                         
                        
$sql = "SELECT
tbl_log_call_center.id,
tbl_log_call_center.job_no,
tbl_log_call_center.site_id,
tbl_site.site_name,
tbl_log_call_center.status_call
FROM
tbl_log_call_center
Inner Join tbl_site ON tbl_log_call_center.site_id = tbl_site.site_id
Where tbl_log_call_center.job_no = '$schtxt'";
?>
<title>Bizserv Solution Co.,Ltd</title>
<link href="image/bss_icon.ico"   rel="shortcut icon" />  
<link href="style/calendar.css" rel="stylesheet" type="text/css">    
<link href="style/mytable.css" rel="stylesheet" type="text/css" />   
<script type="text/javascript" src="script/calendar_date_picker.js"></script>     
<link href="style/stylecss.css" rel="stylesheet" type="text/css">
<link href="style/filtergrid.css" rel="stylesheet" type="text/css">
<style type="text/css">
    <!--
    .mytable1 { width:100%; font-size:11px;
                border:1px solid #ccc;
                font-size:10px;     
    }
    .mytable11 {width:100%; font-size:12px;
                border:1px solid #ccc;
                font-size:11px;     
    }
     .th{ background-color:#003366; color:#FFF; padding:0px; border:0px solid #ccc; height:20px; }
     .td{ border-color:#003366;};
    -->
</style>


<table width="100%" align="center" class="mytable" id="table" height="100%"   cellpadding="1" cellspacing="1" >
    <tr>
	<form id="form1" name="form1">
        <td valign="top"> 
                   <table width="100%" border="0" cellpadding="0" cellspacing="0" class="mytable">
                    <tr>
                        <td width="879" valign="middle" align="center"> <nobr>		
                          
                            
                            <b>&nbsp;วันที่  :</b>      
                            <input style="width:60pt;" name="date_end"  type="text" id="schtxt" value="" size="35" maxlength="10" />
                            
                            
                            &nbsp;<input  type="button" name="sch" value="ค้นหา"  onclick="Search_Click(schtxt.value)"style="width:50pt;">
                           
                        </td>
		<td width="18" valign="middle"><a href="bsslogcall.form.php?type=add" target="_parent">
                        <img src="image/add.JPG"  alt="Add" width="20" height="20" border="0" align="right"> </a></td>
                        <td width="27" valign="middle">&nbsp;<b> เพิ่ม </b></td>
                    </tr>
                </table>     
                <table width="100%" align="center" class="mytable" id="table7"  cellpadding="1" cellspacing="1">
                    <tr>			 
                        <th class="th" width="3%">#</th>
                        <th class="th" width="9%">Date Time</th>  
                        <th class="th" width="13%">Name</th>  
                        <th class="th" width="10%">Job No.</th> 
                        <th class="th" width="10%">Site ID</th> 
                        <th class="th" width="15%">Site Name</th>
                        <th class="th" width="10%">Status</th> 
                    </tr >

 <tr onclick="click2edit(<?=$row["job_id"]?>?>','edit');" onmouseover="this.style.backgroundColor='violet';" onmouseout="this.style.backgroundColor='white';" >
                          <td  style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;"  align="center"></td>
		<td style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;"  align="center"></td>
		<td style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;"  align="left"></td>
		<td style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;"  align="center"></td>
		<td style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;"  align="center"></td>
		<td style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;"  align="left"></td>
		<td style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;"  align="center"></td>
                          </tr>  
                       <?                         
                    //      }	
		?> 


 <tr>                                                                                 
                            <td colspan="10" style="padding:0px; border-bottom:1px solid #ccc; border-right:0px solid #ccc;"> Total :  <?=$i;?> (rows)</td>
                          </tr>   
                </table> </td></tr></table>
</form>


<script type="text/javascript"> 
	
    function Search_Click(dte_beg,dte_end){
	document.location.href ="bsslogcall.index.php"+"?dte_beg="+dte_beg+"&dte_end="+dte_end;
      }
      
      function click2edit(id){  		 
        	document.location.href ="bsslogcall.form.php?id="+id;   
      }
</script>
