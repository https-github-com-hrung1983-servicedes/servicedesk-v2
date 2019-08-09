<?
header("Content-Type: text/html; charset=tis-620");                 
session_start();
require_once("function.php");          
  
  if(!checkUser()){    echo Message(35,"red",$titel1,$msg1,"<a href='index.php?link=logcall.index.excel.form4ricoh'> $login </a>");
  exit;
  }                                                                                                      
       
include("header.php");   
      $months =  $_REQUEST["months"];    
      $years =  $_REQUEST["years"];         
      $cate =  $_REQUEST["cate"];
      $statue_sla =  $_REQUEST["statue_sla"];
     if ( $months == "" || $years=="" ) {
	 		$today = getdate();	
			$months = date("m");  
			$years = $today["year"];
			$dte = $years."-".$months;
	  } 
			$dte = $years."-".$months; 
    if($cate == ""){
           $cmd = " And tbl_log_call_center.category_type in ('132','133')";
    } else {
         $cmd = " And tbl_log_call_center.category_type = '$cate'";
    }
if($statue_sla=="FSLA" || $statue_sla=="WSLA"){
        $cmd1 =  " And tbl_log_call_center.status_sla = '$statue_sla' ";
    }
			  $sql = "SELECT
                            tbl_log_call_center.site_id,
                            tbl_site.site_name,
                            tbl_site.pos,
                            tbl_log_call_center.job_no,
                            tbl_log_call_center.severity,
                            tbl_log_call_center.sla,
                            tbl_log_call_center.open_call_dte,
                            tbl_log_call_center.open_call_tme,
                            tbl_log_call_center.closed_date, 
                            tbl_log_call_center.closed_time,
                            tbl_log_call_center.problem,
                            tbl_log_call_center.problem_solving,
                            tbl_user.name,
                            tbl_user.sname,
                            tbl_site.from_owner,
                            tbl_log_call_center.commente,
                            tbl_site.province_name as province_code ,
                            tbl_province.province_name,
                            tbl_log_call_center.status_sla,
                            tbl_log_call_center.status_call
                        FROM
                            tbl_log_call_center
                        Inner Join tbl_site ON tbl_log_call_center.site_id = tbl_site.site_id
                        Inner Join tbl_user ON tbl_log_call_center.reciept_job_user_id = tbl_user.user_id
                        Inner Join tbl_province ON tbl_site.province_name = tbl_province.id
                        Where tbl_site.from_owner = 'RICOH'
                        And tbl_log_call_center.open_call_dte like '$dte%' 
                        And tbl_log_call_center.status_call = 'close' $cmd $cmd1";
	           
?>  

<script type="text/javascript" src="script/jquery-1.6.4.js"></script>
<script type="text/javascript" src="script/jquery_1.7.1_min.js"></script>
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
        <td valign="top"> 
            <form  method="post"   name="form1" id="form1"  action="#" target="mainPage" onSubmit="return false";> 
                   <table width="100%" border="0" cellpadding="0" cellspacing="0" class="mytable">
                    <tr>
                        <td width="879" valign="middle" align="center"> <nobr>		
                         <select name="statue_sla" id="statue_sla">
                                <option value="ALL" <?if($statue_sla=="ALL") echo "selected";?>>ALL SLA</option>
                                <option value="FSLA" <?if($statue_sla=="FSLA") echo "selected";?>>FSLA</option>
                                <option value="WSLA" <?if($statue_sla=="WSLA") echo "selected";?>>WSLA</option>
                           </select>	
                           <select id="cate" name="cate">
                            <option value=""><?=iconv( 'UTF-8', 'TIS-620', "ทั้งหมด");?></option>
                                <? 
                               
                                $sql_cate = "SELECT *
                                            FROM
                                                tbl_category_type
                                            Where 
                                                tbl_category_type.category_id in ('132','133')";
                                    $rs_cate = mysqli_query($conn,$sql_cate);        //iconv( 'TIS-620', 'UTF-8', 
                                    while($c_cate = mysqli_fetch_array($rs_cate)){?>
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

                            <button onclick="Search_Click(statue_sla.value,months.value,years.value,cate.value)"><?=iconv( 'UTF-8', 'TIS-620', "แสดงข้อมูล");?></button>
                        </td>
                    </tr>
                </table>     
				
				
                <table width="100%" align="center" class="mytable" id="table7" name="table7"  cellpadding="1" cellspacing="1">
                    <tr>
            			<th class="th" width="5%"><nobr>Site ID</th>
                        <th class="th" width="20%">Site Name</th>
                        <th class="th" width="5%"><nobr>Job No.</th>
                        <th class="th" width="5%"><nobr>CAT</th>
                        <th class="th" width="5%"><nobr>Area</th>
                        <th class="th" width="5%"><nobr>SLA : (Hrs)</th>
                        <th class="th" width="5%"><nobr>Open DateTime</th>
                        <th class="th" width="5%"><nobr>Finish DateTime</th>
                        <th class="th" width="5%"><nobr>ETA (Hrs)</th>
                        <th class="th" width="10%">Problem</th>
                        <th class="th" width="20%">Solution</th>
                        <th class="th" width="5%"><nobr>Onsite by</th>
                        <th class="th" width="5%"><nobr>Province</th>
                        <th class="th" width="5%"><nobr>Owner</th>
                        <th class="th" width="5%"><nobr>Comment</th>
                    </tr >
                        <? //  echo $sql;
                         $res = mysqli_query($conn,$sql);
                         $i=0;
                          while($row = mysqli_fetch_array($res)) {
                              $open_dtetme = $row["open_call_dte"]." ".$row["open_call_tme"];          
                              $close_dtetme = $row["closed_date"]." ".$row["closed_time"];      
                              $enginame = $row["name"]." ".$row["sname"];
                              $eta = dte_diff($close_dtetme,$open_dtetme);
                              if($row["province_code"]=="25" || $row["province_code"]=="31"  || $row["province_code"]=="45" ){
                                    $arear = "24 hr.";
                              }else{
                                  $arear = "Area1";
                              }
                              $bg = "black";
                              if($row["status_sla"]=="FSLA") {
                                  $bg = "red";
                              }
                              
                          ?>
<tr onMouseOver="this.style.backgroundColor='violet';" onMouseOut="this.style.backgroundColor='white';" >    
    <td  style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;" align="center"><font color="<?=$bg?>"><?=$row["site_id"];?></font></td>
    <td  style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;" align="center"><font color="<?=$bg?>"><?=$row["site_name"];?></font></td>
    <td  style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;" align="center"><font color="<?=$bg?>"><?=$row["job_no"];?></font></td>
    <td  style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;" align="center"><font color="<?=$bg?>"><?=$row["severity"];?></font></td>
    <td  style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;" align="center"><font color="<?=$bg?>"><?=$arear?></font></td>
    <td  style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;" align="center"><font color="<?=$bg?>"><?=$row["sla"];?></font></td>
    <td  style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;" align="center"><font color="<?=$bg?>"><?=$open_dtetme;?></font></td>
    <td  style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;" align="center"><font color="<?=$bg?>"><?=$close_dtetme;?></font></td>
    <td  style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;" align="center"><font color="<?=$bg?>"><?=$eta;?></font></td>
    <td  style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;" align="center"><font color="<?=$bg?>"><?=$row["problem"];?></font></td>
    <td  style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;" align="center"><font color="<?=$bg?>"><?=$row["problem_solving"];?></font></td>
    <td  style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;" align="center"><font color="<?=$bg?>"><?=$enginame;?></font></td>
    <td  style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;" align="center"><font color="<?=$bg?>"><?=$row["province_name"];?></font></td>
    <td  style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;" align="center"><font color="<?=$bg?>"><?=$row["from_owner"];?></font></td>
    <td  style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;" align="center"><font color="<?=$bg?>"><?=$row["commente"];?></font></td>
        
<tr>
                          <? $i++; }?>  
                          <tr>                                                                                 
                            <td colspan="16" style="padding:0px; border-bottom:1px solid #ccc; border-right:0px solid #ccc;"><?=iconv('UTF-8','TIS-620',"จำนวน $i แถว"  )?></td>
                          </tr>  
                </table>
				  </form></td></tr></table>


<script type="text/javascript"> 
    var props = {    formatDate :        '%m-%d-%y'    };
    props.formatDate = '%y-%m-%d';
    var cdp1 = new CalendarDatePicker(props);                   
  
    function Search_Click(statue_sla,months,years,cate){          
   			document.location.href ="logcall.index.excel.form4ricoh.php?months="+months+"&years="+years+"&cate="+cate+"&statue_sla="+statue_sla;
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

<?
function dte_diff($date2,$date1){
	global $conn;
	   $sql = "SELECT TIMEDIFF('$date2' , '$date1') AS dte_diff";
	   $rs = mysqli_query($conn,$sql);
	   $c = mysqli_fetch_array($rs);
	   $d = $c["dte_diff"];
	   $dt = explode(":",$d);
    return $dt[0].".".$dt[1];
   }
?>
