<?
header("Content-Type: text/html; charset=tis-620");                 
session_start();
require_once("function.php");          
  
  if(!checkUser()){    echo Message(35,"red",$titel1,$msg1,"<a href='index.php?link=bsslogcall.index'> $login </a>");
  exit;
  }                                                                                                      
       
include("header.php");
      $type =  $_REQUEST["type"];
      $schTxt =  $_REQUEST["schTxt"];
      $dte_beg =  $_REQUEST["dte_beg"];
      $dte_end =  $_REQUEST["dte_end"];
    if($dte_beg =="") $dte_beg = getDte();
    if($dte_end =="") $dte_end = getDte();
    if($type =="") $type = "0";
    
if($type=="1") {
    $cmd = " Where tbl_log_call_bss.job_start_date between '$dte_beg 00:00:00' and '$dte_end 00:00:00'";
     //Or itbl_logcall_retail.status_call = 'feedback'
} elseif($type=="2") {
   $cmd = " Where tbl_log_call_bss.job_end_date between '$dte_beg 00:00:00' and '$dte_end 00:00:00'";
   // Or itbl_logcall_retail.status_call = 'feedback'
} elseif($type=="3") {
     $cmd = " Where tbl_log_call_bss.job_no like '%$schTxt%'";
     // Or itbl_logcall_retail.status_call = 'feedback'
} elseif($type=="7") {
    $cmd = " Where (tbl_log_call_bss.job_status like 'close' or tbl_log_call_bss.job_status like 'Close') And tbl_log_call_bss.job_end_date between '$dte_beg 00:00:00' and '$dte_end 00:00:00'";
} elseif($type=="8") {
    $cmd = " Where tbl_log_call_bss.job_status like 'cancel' And tbl_log_call_bss.job_end_date between '$dte_beg 00:00:00' and '$dte_end 00:00:00'";
} elseif($type=="0") {
    $cmd = " ";
}                          
                          
$sql = "SELECT
tbl_log_call_bss.job_id,
tbl_log_call_bss.job_no,
tbl_log_call_bss.job_date,
tbl_log_call_bss.job_problem,  
tbl_log_call_bss.job_solution,
tbl_log_call_bss.job_start_time, 
tbl_log_call_bss.job_start_date,
tbl_log_call_bss.job_end_time,
tbl_log_call_bss.job_end_date,
tbl_user.name, 
tbl_user.sname,
tbl_log_call_bss.job_status,
tbl_log_call_bss.site_id,
tbl_log_call_bss.job_type,
tbl_log_call_bss.logfrom,
tbl_site_retail.site_name
FROM tbl_log_call_bss 
Left Join tbl_user ON tbl_log_call_bss.job_engineer_reciept_id = tbl_user.user_id
Inner Join tbl_site_retail on tbl_site_retail.site_id = tbl_log_call_bss.site_id
$cmd
Order by tbl_user.name
";
//echo $sql;//exit;
?>  
<script type="text/javascript">
$(document).ready(function(){
         
		$(".Add").click(function(){  
					alert("sss");

			});	
				
});
</script>

<link href="image/bss_icon.ico"   rel="shortcut icon" />  
<link href="style/calendar.css" rel="stylesheet" type="text/css">    
<link href="style/mytable.css" rel="stylesheet" type="text/css" />   
<script type="text/javascript" src="script/calendar_date_picker.js"></script>     
<link href="style/stylecss.css" rel="stylesheet" type="text/css">
<link href="style/filtergrid.css" rel="stylesheet" type="text/css">
<meta http-equiv="refresh" content="300;"/>
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
                          
                            
                              <b>&nbsp;<?=iconv('UTF-8','TIS-620',"ค้นหาตาม");?>  :</b>
                            <select name="schBy" id="schBy" style="width:80pt;">
                                <option value="0" <?if($type == "0") echo "selected";?>>All</option>
                                <option value="1" <?if($type == "1") echo "selected";?>><?=iconv('UTF-8','TIS-620',"วันที่เปิดงาน");?></option>
                                <option value="2" <?if($type == "2") echo "selected";?>><?=iconv('UTF-8','TIS-620',"วันที่ปิดงาน");?></option>
                                <option value="3" <?if($type == "3") echo "selected";?>><?=iconv('UTF-8','TIS-620',"ใบงานเลขที่");?></option>
                                <option value="7" <?if($type == "7") echo "selected";?>><?=iconv('UTF-8','TIS-620',"ปิดงาน");?></option>
                                <option value="8" <?if($type == "8") echo "selected";?>><?=iconv('UTF-8','TIS-620',"ยกเลิก");?></option>
                            </select>
                            <input type="text" style="width:90pt;" name="schTxt" id="schTxt" value="<?=$schTxt ?>">
                            <b>&nbsp;<?=iconv('UTF-8','TIS-620',"วันที่");?>  :</b>
                            <input style="width:60pt;" name="date_beg"  type="text" onclick="cdp1.showCalendar(this, 'date_beg');return false;" id="date_beg" value="<?=$dte_beg;?>" size="35" maxlength="10" />
                             <span class="fonttitle_board">&nbsp;-&nbsp;</span>
                            <input style="width:60pt;" name="date_end"  type="text" onclick="cdp1.showCalendar(this, 'date_end');return false;" id="date_end" value="<?=$dte_end;?>" size="35" maxlength="10" />
                            &nbsp;<input  type="button" name="sch" value="<?=iconv('UTF-8','TIS-620',"ค้นหา");?>"  
                             onclick="Search_Click(schBy.value,schTxt.value,date_beg.value,date_end.value)" style="width:50pt;">
                            &nbsp;
                           
                        </td>
                        <td width="18" valign="middle"><a href="bsslogcall.form.php?type=add" target="_parent">
                        <img src="image/add.JPG"  alt="Add" width="20" height="20" border="0" align="right"> </a></td>
                        <td width="27" valign="middle">&nbsp;<b> <?=iconv('UTF-8','TIS-620',"เพิ่ม");?> </b></td>
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
                        <th class="th" width="15%">Problem</th> 
                        <th class="th" width="15%">Solution</th> 
                        <th class="th" width="10%">Status</th> 
                    </tr >
                        <?  // echo $sql;
                         $res = mysqli_query($conn,$sql);
                         $i=0;						 
                          while($row = mysqli_fetch_array($res)) {    
							  if ($row["job_status"]=="Onsite"){
									$bg = "red";
							  } else {
									$bg = "black";
							  }
							$i++;
                              ?>
                          <tr onclick="click2edit(<?=$row["job_id"]?>,'<?=$row["logfrom"]?>','edit');" onmouseover="this.style.backgroundColor='violet';" onmouseout="this.style.backgroundColor='white';" >
                          <td style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;"  align="center">
                              <font color="<?=$bg;?>"><?=$i;?></font></td>
						<td style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;"  align="center">
                              <font color="<?=$bg;?>"><?=$row["job_start_date"]." ".$row["job_start_time"];?></font></td>
						<td style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;"  align="left">
                              &nbsp;&nbsp;<font color="<?=$bg;?>"><?=$row["name"]." ".$row["sname"];?></font></td>
						<td style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;"  align="center">
                              <font color="<?=$bg;?>"><?=$row["job_no"];?></font></td>
						<td style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;"  align="center">
                              <font color="<?=$bg;?>"><?=$row["site_id"];?></font></td>
						<td style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;"  align="left">
                              &nbsp;&nbsp;<font color="<?=$bg;?>"><?=$row['site_name'];?></font></td>
						<td style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;"  align="left">
                              &nbsp;&nbsp;<font color="<?=$bg;?>"><?=iconv('UTF-8','TIS-620',$row["job_problem"]);?></font></td>
						<td style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;"  align="left">
                              &nbsp;&nbsp;<font color="<?=$bg;?>"><?=iconv('UTF-8','TIS-620',$row["job_solution"]);?></font></td>
						<td style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;"  align="center">
                              <font color="<?=$bg;?>"><?=$row["job_status"];?></font></td>
                          </tr>  
                       <?                         
                          }
						  ?> 
                          <tr>                                                                                 
                            <td colspan="10" style="padding:0px; border-bottom:1px solid #ccc; border-right:0px solid #ccc;"> Total :  <?=$i;?> (rows)</td>
                          </tr>   
                </table> </td></tr></table>
</form>


<script type="text/javascript"> 
    var props = {    formatDate :        '%m-%d-%y'    };
    props.formatDate = '%y-%m-%d';
    var cdp1 = new CalendarDatePicker(props);
	
    function Search_Click(type,txt,dte_beg,dte_end){
		 document.location.href ="bsslogcall.index.php"+"?type="+type+"&schTxt="+txt+"&dte_beg="+dte_beg+"&dte_end="+dte_end;
      }
      
      function click2edit(id,ubpdate_by,typer){   
		var dte_b = document.form1.date_beg.value;                         
         var dte_e = document.form1.date_end.value;
		 
        document.location.href ="bsslogcall.form.php"+"?id="+id+"&ubpdate_by="+ubpdate_by+"&type="+typer+"&dte_beg="+dte_b+"&dte_end="+dte_e;   
      }
</script>

<table id="calendarTable">
    <tbody id="calendarTableHead">
        <tr>
            <td colspan="4" align="left">
                <select id="selectMonth">
                    <option value="0">January</option>
                    <option value="1">February</option>
                    <option value="2">March</option>
                    <option value="3">April</option>
                    <option value="4">May</option>
                    <option value="5">June</option>
                    <option value="6">July</option>
                    <option value="7">August</option>
                    <option value="8">September</option>
                    <option value="9">October</option>
                    <option value="10">November</option>
                    <option value="11">December</option>
                </select>
            </td>
            <td colspan="2" align="center"><select id="selectYear"></select></td>
            <td align="right"><a href="#" id="closeCalendarLink">X</a></td>
        </tr>
    </tbody>
    <tbody id="calendarTableDays">
        <tr id="calenderDaysIndex">
            <td>Su</td><td>Mo</td><td>Tu</td><td>We</td><td>Thu</td><td>Fr</td><td>Sa</td>
        </tr>
    </tbody>
    <tbody id="calendar"></tbody>
</table>


