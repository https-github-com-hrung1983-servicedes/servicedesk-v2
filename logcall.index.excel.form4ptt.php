<?
header("Content-Type: text/html; charset=tis-620");                 
session_start();
require_once("function.php");          
  
  if(!checkUser()){    echo Message(35,"red",$titel1,$msg1,"<a href='index.php?link=logcall.index.excel.form4ptt'> $login </a>");
  exit;
  }                                                                                                      
       
include("header.php");   
      $months =  $_REQUEST["months"];       
      $years =  $_REQUEST["years"];         
      $cate =  $_REQUEST["cate"];       
      $statue_sla =  $_REQUEST["statue_sla"];
      $site_type =  $_REQUEST["site_type"];
      $service_type =  $_REQUEST["service_type"];
      $statue_call =  $_REQUEST["statue_call"];
      if ( $months == "" || $years=="" ) {
	 		$today = getdate();	
			$months = date("m");  //$today["mon"];
			$years = $today["year"];
			$dte = $years."-".$months;
	  } 
			$dte = $years."-".$months; 
    
     if($service_type=="NGV" || $service_type==""){
        $cmd2 = " And tbl_site.site_type = 'NGV'";
    } else if($service_type=="OIL"){
         $cmd2 = " And tbl_site.site_type = 'OIL'";
    }

    if($statue_call==""){
         $cmd4 = "close";
    } else {
        $cmd4 = $statue_call;
    } 
    if($site_type==""){
        $site_type = "PTTICT";
    }
     
    if($cate == ""){
           $cmd = " And tbl_log_call_center.category_type in ('1','2','8','9','132','133','43')";
    } else {
         $cmd = " And tbl_log_call_center.category_type = '$cate'";
    }

    if($statue_sla=="FSLA" || $statue_sla=="WSLA"){
        $cmd1 =  " And tbl_log_call_center.status_sla = '$statue_sla' ";
    }
			  $sql = "SELECT
                            tbl_log_call_center.open_call_dte,
                            tbl_log_call_center.open_call_tme,
                            tbl_log_call_center.job_no,
                            tbl_log_call_center.site_id,
                            tbl_site.site_name,
                            tbl_province.province_name,
                            tbl_log_call_center.problem,
                            tbl_log_call_center.severity,
                            tbl_log_call_center.sla,
                            tbl_user.name,
                            tbl_user.sname,
                            tbl_log_call_center.problem_solving,
                            tbl_log_call_center.dateline_solving,
                            tbl_site.pos,
                            tbl_log_call_center.onsite_datetime,
                            tbl_log_call_center.fixed_time,
                            tbl_log_call_center.closed_date,
                            tbl_log_call_center.closed_time,
                            tbl_log_call_center.status_sla,
                            tbl_log_call_center.status_call,
                            tbl_log_call_center.category_type,
                            tbl_log_call_center.commente
                        FROM
                            tbl_log_call_center
                            Inner Join tbl_site ON tbl_log_call_center.site_id = tbl_site.site_id
                            Inner Join tbl_user ON tbl_log_call_center.reciept_job_user_id = tbl_user.user_id
                            Inner Join tbl_province ON tbl_site.province_name = tbl_province.id
                        Where tbl_site.from_owner = '$site_type'
                        And tbl_log_call_center.open_call_dte like '$dte%'
                        And tbl_log_call_center.status_call = '$cmd4'
                        $cmd  $cmd1  $cmd2  "; 
		                 
//echo $sql;
?>  

<script type="text/javascript" src="script/jquery-1.6.4.js"></script>
<script type="text/javascript" src="script/jquery_1.7.1_min.js"></script>
<link href="image/bss_icon.ico"   rel="shortcut icon" />  
<link href="style/calendar.css" rel="stylesheet" type="text/css">    
<link href="style/mytable.css" rel="stylesheet" type="text/css" />   
<script type="text/javascript" src="script/calendar_date_picker.js"></script>     
<link href="style/stylecss.css" rel="stylesheet" type="text/css">
<link href="style/filtergrid.css" rel="stylesheet" type="text/css">
<!--meta http-equiv="refresh" content="300;"/-->
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
        <td valign="top"> 
            <form  method="post"   name="form1" id="form1"  action="#" target="mainPage" onSubmit="return false";> 
                   <table width="100%" border="0" cellpadding="0" cellspacing="0" class="mytable">
                    <tr>
                        <td width="879" valign="middle" align="center"> <nobr>	
                          <select name="site_type" id="site_type">
                                <option value="PTTICT" <?if($site_type=="PTTICT") echo "selected";?>>PTTICT</option>
                                <option value="RICOH" <?if($site_type=="RICOH") echo "selected";?>>RICOH</option>
                           </select>
                           <select name="service_type" id="service_type">
                                <option value="NGV" <?if($service_type=="NGV") echo "selected";?>>NGV</option>
                                <option value="OIL" <?if($service_type=="OIL") echo "selected";?>>OIL</option>
                           </select>
                           <select name="statue_sla" id="statue_sla">
                                <option value="FSLA" <?if($statue_sla=="FSLA") echo "selected";?>>FSLA</option>
                                <option value="WSLA" <?if($statue_sla=="WSLA") echo "selected";?>>WSLA</option>
                           </select>
                           <select name="statue_call" id="statue_call">
                                <option value="close" <?if($statue_call=="close") echo "selected";?>>close</option>
                                <option value="feedback" <?if($statue_call=="feedback") echo "selected";?>>feedback</option>
                           </select>	
                           <select id="cate" name="cate">
                            <option value=""><?=iconv( 'UTF-8', 'TIS-620', "ทั้งหมด");?></option>
                                <? 
                               
                                $sql_cate = "SELECT *
                                            FROM
                                                tbl_category_type
                                            Where 
                                                tbl_category_type.category_id in ('1','2','8','9','132','133','43')";
                                    $rs_cate = mysqli_query($conn,$sql_cate);        //iconv( 'TIS-620', 'UTF-8', 
                                    while($c_cate = mysqli_fetch_array($rs_cate)) { ?>
                    <option value="<?=$c_cate["category_id"];?>" <?if($c_cate["category_id"]==$cate) echo "selected";?>><?=$c_cate["category_type"];?></option>
                                  <?  }  ?>
                           </select>
                            <select name="months" id="months">
                                <option value="01"  <? if($months=="01") echo "selected"; ?>><?=iconv( 'UTF-8', 'TIS-620', "มกราคม");?></option>
                                <option value="02"  <? if($months=="02") echo "selected"; ?>><?=iconv( 'UTF-8', 'TIS-620', "กุมภาพันธ์");?></option>
                                <option value="03"  <? if($months=="03") echo "selected"; ?>><?=iconv( 'UTF-8', 'TIS-620', "มีนาคม");?></option>
                                <option value="04"  <? if($months=="04") echo "selected"; ?>><?=iconv( 'UTF-8', 'TIS-620', "เมษายน");?></option>
                                <option value="05"  <? if($months=="05") echo "selected"; ?>><?=iconv( 'UTF-8', 'TIS-620', "พฤษภาคม");?></option>
                                <option value="06"  <? if($months=="06") echo "selected"; ?>><?=iconv( 'UTF-8', 'TIS-620', "มิถุนายน");?></option>
                                <option value="07"  <? if($months=="07") echo "selected"; ?>><?=iconv( 'UTF-8', 'TIS-620', "กรกฏาคม");?></option>
                                <option value="08"  <? if($months=="08") echo "selected"; ?>><?=iconv( 'UTF-8', 'TIS-620', "สิงหาคม");?></option>
                                <option value="09"  <? if($months=="09") echo "selected"; ?>><?=iconv( 'UTF-8', 'TIS-620', "กันยายน");?></option>
                                <option value="10" <? if($months=="10") echo "selected"; ?>><?=iconv( 'UTF-8', 'TIS-620', "ตุลาคม");?></option>
                                <option value="11" <? if($months=="11") echo "selected"; ?>><?=iconv( 'UTF-8', 'TIS-620', "พฤศจิกายน");?></option>
                                <option value="12" <? if($months=="12") echo "selected"; ?>><?=iconv( 'UTF-8', 'TIS-620', "ธันวาคม");?></option>
                            </select>

                        <select name="years" id="years">
                                <option value="2016"  <? if($years=="2016") echo "selected"; ?>><?=iconv( 'UTF-8', 'TIS-620', "2016");?></option>
                                <option value="2017"  <? if($years=="2017") echo "selected"; ?>><?=iconv( 'UTF-8', 'TIS-620', "2017");?></option>
                                <option value="2018"  <? if($years=="2018") echo "selected"; ?>><?=iconv( 'UTF-8', 'TIS-620', "2018");?></option>
                            </select>

                            <button onclick="Search_Click(service_type.value,site_type.value,statue_sla.value,months.value,years.value,cate.value,statue_call.value)"><?=iconv( 'UTF-8', 'TIS-620', "แสดงข้อมูล");?></button>
                        </td>
                    </tr>
                </table>  
        <script>           
			function Search_Click(service_type,site_type,statue_sla,months,years,cate,statue_call) {
		        document.location.href ="logcall.index.excel.form4ptt.php?months="+months+"&years="+years+"&cate="+cate+"&statue_sla="+statue_sla+"&site_type="+site_type+"&service_type="+service_type+"&statue_call="+statue_call;
            }
      </script>
				
                <table width="100%" align="center" class="mytable" id="table7" name="table7"  cellpadding="1" cellspacing="1">
                    <tr>
                        <th class="th" width="20%">Site Name</th>
                        <th class="th" width="5%">Job No.</th>
                        <th class="th" width="5%">CAT</th>
                        <th class="th" width="5%">SLA(Hrs)</th>
                        <th class="th" width="5%">Open DateTime</th>
                        <th class="th" width="5%">Onsite DateTime</th>
                        <th class="th" width="5%">Finish DateTime</th>
                        <th class="th" width="5%">Close DateTime</th>
                        <th class="th" width="20%">Problem</th>
                        <th class="th" width="20%">Solution</th>
                        <th class="th" width="20%">comment</th>
                        <th class="th" width="10%"><nobr>Onsite by</th>
                    </tr >
                        <? //  echo $sql;
                         $res = mysqli_query($conn,$sql);
                          while($row = mysqli_fetch_array($res)) {
                          ?>
                           
                <tr onMouseOver="this.style.backgroundColor='violet';" onMouseOut="this.style.backgroundColor='white';" >
                    <td style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc; border-color:#003366;" align="center"><?=$row["site_id"]." ".$row["site_name"]?></td>
                    <td style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc; border-color:#003366;" align="center"><?=$row["job_no"]?></td>
                    <td style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc; border-color:#003366;" align="center"><?=$row["severity"]?></td>
                    <td style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc; border-color:#003366;" align="center"><?=$row["sla"]?></td>
                    <td style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc; border-color:#003366;" align="center"><nobr><?=$row["open_call_dte"]." ".$row["open_call_tme"]?></td>
                    <td style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc; border-color:#003366;" align="center"><nobr><?=$row["onsite_datetime"]?></td>
                    <td style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc; border-color:#003366;" align="center"><nobr><?=$row["fixed_time"]?></td>
                    <td style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc; border-color:#003366;" align="center"><nobr><?=$row["closed_date"]." ".$row["closed_time"]?></td>
                    <td style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc; border-color:#003366;" align="center"><?=$row["problem"]?></td>
                    <td style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc; border-color:#003366;" align="center"><?=$row["problem_solving"]?></td>
                    <td style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc; border-color:#003366;" align="center"><?=$row["commente"]?></td>
                    <td style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc; border-color:#003366;" align="center"><nobr><?=$row["name"]." ".$row["sname"]?></td>
                 </tr>  
                          <? $rows++;
                          }?>
                          <tr><td colspan="11"><?=iconv( 'UTF-8', 'TIS-620', "จำนวน : ".$rows." แถว");?></td></tr>
                </table>
				  </form></td></tr></table>


<script type="text/javascript"> 
    var props = {    formatDate :        '%m-%d-%y'    };
    props.formatDate = '%y-%m-%d';
    var cdp1 = new CalendarDatePicker(props);                   
  
      
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


