<?
header("Content-Type: text/html; charset=tis-620");                 
session_start();
require_once("function.php");          
  
  if(!checkUser()){    echo Message(35,"red",$titel1,$msg1,"<a href='index.php?link=logcall.index.excel.form1'> $login </a>");
  exit;
  }                                                                                                      
       
include("header.php");   
      $dte_begin =  $_REQUEST["dte_begin"];            
      $dte_end =  $_REQUEST["dte_end"];
	if($dte_begin==""){
			$dte_begin = getDte();
	}
	if($dte_end==""){
			$dte_end = getDte();
	}
			  $sql = "SELECT
						tbl_log_call_center.site_id,
						tbl_site.site_name,
						tbl_site.site_old_name,
						tbl_site.pos,
						tbl_site.province_name,					
						tbl_log_call_center.job_no,
						tbl_log_call_center.onsite_datetime,
						tbl_log_call_center.fixed_time,
						tbl_log_call_center.problem,
						tbl_log_call_center.problem_solving,
						tbl_log_call_center.type_service,
						tbl_log_call_center.reciept_job_user_id,
						tbl_log_call_center.status_sla,
						tbl_log_call_center.resolv_type,
						tbl_user.name,
						tbl_user.sname,
						tbl_log_call_center.doc,
						tbl_province.province_name,
						tbl_province.provice_phase	,
						tbl_category_type.category_type,
						tbl_category_type.category_id,
						tbl_incentive_detail.ditstance_result
						FROM
						tbl_log_call_center
						Left Join tbl_site ON tbl_log_call_center.site_id = tbl_site.site_id
						Left Join tbl_user ON tbl_log_call_center.reciept_job_user_id = tbl_user.user_id							
						Left Join tbl_province ON tbl_site.province_name = tbl_province.id
						Left Join tbl_category_type ON tbl_log_call_center.category_type = tbl_category_type.category_id		
						Left Join tbl_incentive_detail ON tbl_log_call_center.job_no = tbl_incentive_detail.job_no 				
						 Where tbl_log_call_center.onsite_datetime between '$dte_begin' and '$dte_end'
						 And tbl_category_type.category_id in ('5' ,'77' ,'80' ,'24' ,'25' ,'31' ,'36' ,'56' ,'60' ,'61' ,'64' ,'65' ,'81' ,'72' ,'74' ,'89','91' ,'94' ,'12' ,'62' 
,'75','33' ,'32','34','43' ,'44','45','53' ,'54','55' ,'38'  ,'52' ,'57' ,'63','1' ,'2'  ,'8' ,'9' ,'35','16' ,'69')
 						And tbl_log_call_center.status_call = 'close' Order by tbl_log_call_center.fixed_time ASC";   
               
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
					From :  <input style="width:100pt;" name="dte_begin" type="text" id="dte_begin" value="<?=$dte_begin?>" size="35" maxlength="10"  readonly="readonly"  onclick="cdp1.showCalendar(this, 'dte_begin'); return false;"  />&nbsp;&nbsp;
					To :  <input style="width:100pt;" name="dte_end" type="text" id="dte_end" value="<?=$dte_end?>" size="35" maxlength="10"  readonly="readonly" onclick="cdp1.showCalendar(this, 'dte_end'); return false;"  />

                            &nbsp;<input  type="button" name="sch" value="ค้นหา"  onclick="Search_Click(dte_begin.value,dte_end.value)" style="width:50pt;">
<script type="text/javascript"> 
$(document).ready(function(){  
         
  $("#report3g").click(function(){
	//	alert("adfasdf");
		var typer = $("#typer").attr('value'); 
		var job = $("#job").attr('value'); 
		var months = $("#months").attr('value'); 
		var years = $("#years").attr('value'); 
		document.location.href ="function.execute.php?mode=report3G&typer="+typer+"&months="+months+"&years="+years;
  });	  
  
});     
</script>

                        </td>
                    </tr>
                </table>     
				
				
                <table width="100%" align="center" class="mytable" id="table7" name="table7"  cellpadding="1" cellspacing="1">
                    <tr>		 
                        <th class="th" width="5%"><nobr>Bussiness</th>
                        <th class="th" width="10%"><nobr>Category</th>
                        <th class="th" width="5%"><nobr>Site ID</th>
                        <th class="th" width="15%"><nobr>Site Name</th>
                        <th class="th" width="5%"><nobr>Job No.</th>
                        <th class="th" width="5%"><nobr>Open Date</th>
                        <th class="th" width="17%">Problem</th>
                        <th class="th" width="18%">Solution</th>                     
                        <th class="th" width="5%"><nobr>SLA</th>                  
                        <th class="th" width="5%"><nobr>Team</th>                   
                        <th class="th" width="5%"><nobr>Province</th>           
                        <th class="th" width="5%"><nobr>Sector</th>            
                        <th class="th" width="5%"><nobr>Close by</th>           
                        <th class="th" width="5%"><nobr>Length</th>  
                    </tr >
                        <? //  echo $sql;
                         $res = mysqli_query($conn,$sql);
                          while($row = mysqli_fetch_array($res)) {
                          ?>
                          <tr onMouseOver="this.style.backgroundColor='violet';" onMouseOut="this.style.backgroundColor='white';" >
                          <td  style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;" align="center">
						  <?						 
						  			$cmd =  substr($row["job_no"],0,3);
						  			echo $cmd;

									
									$str = "";
									if($row["category_id"]=="5" || $row["category_id"]=="77" || $row["category_id"]=="80" || $row["category_id"]=="24" || 
												$row["category_id"]=="25" || $row["category_id"]=="31" || $row["category_id"]=="36" || $row["category_id"]=="56" || 
												$row["category_id"]=="60" || $row["category_id"]=="61" || $row["category_id"]=="64" || $row["category_id"]=="65" || 
												$row["category_id"]=="81" || $row["category_id"]=="72" || $row["category_id"]=="74" || $row["category_id"]=="89" || 
												$row["category_id"]=="91" || $row["category_id"]=="94" || $row["category_id"]=="12" || $row["category_id"]=="62" || 
												$row["category_id"]=="75" || $row["category_id"]=="23" ){  // installation 3g
											$str = "งานติดตั้ง";
									} else if($row["category_id"]=="33" || $row["category_id"]=="32"  ||  $row["category_id"]=="34"){
											$str = "งานติดตั้ง 3G";
									} else if($row["category_id"]=="43" || $row["category_id"]=="44"  || $row["category_id"]=="45" ||  $row["category_id"]=="53" || $row["category_id"]=="54" 
									 || $row["category_id"]=="55" || $row["category_id"]=="38"  || $row["category_id"]=="52" || $row["category_id"]=="57" || $row["category_id"]=="63" || $row["category_id"]=="42"){
											$str = "CM 3G";
									} else if($row["category_id"]=="1" || $row["category_id"]=="2"  || $row["category_id"]=="8" || $row["category_id"]=="9" || $row["category_id"]=="35"
									|| $row["category_id"]=="16" || $row["category_id"]=="69"){
											$str = "CM";
									} else {
												$str = $row["category_type"];
									}
						  ?>						  
						  </td>
                          <td  style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;" align="center"><?=$str;?></td>
                          <td  style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;" align="center"><?=$row["site_id"];?></td>
                          <td  style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;" align="left"><?=$row["site_name"];?></td>
                          <td  style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;" align="center">
                              <?=$row["job_no"];?></td>
                          <td style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;"  align="center"><nobr>
                              <? $onsite = split(" ",$row["onsite_datetime"]); echo dateMDY($onsite[0]);?></td>
                          <td  style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;">
                              <?=$row["problem"];?></td>
                          <td  style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;">
                              <?=$row["problem_solving"];?></td>
                          <td  style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;" align="center">
                              <?=$row["status_sla"];?></td>
                          <td  style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;" align="center">
                             <nobr><? if($row["type_service"]=="BSS"){
							  if($row["reciept_job_user_id"]=="67"  ||  $row["reciept_job_user_id"] == "98"  || $row["reciept_job_user_id"] == "95"  || 
									$row["reciept_job_user_id"] == "39" ||  $row["reciept_job_user_id"]== "91" ||  $row["reciept_job_user_id"]== "100"){ echo "B"; 
									}  else { echo "A";	}
								 } else if($row["type_service"]=="SDC"){ echo "B"; }  else if($row["type_service"]=="BOONPA"){ echo "C"; }   
							 else if($row["type_service"]=="BOONPA"){ echo "C"; } ?>
							 <?
							 if($row["type_service"]=="BSS")  echo "(".$row["name"].")"
							 ?>							 
							 </font></td>    
							  <td  style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;" align="center">
                             <nobr><?=$row["province_name"] ?></td> 
							  <td  style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;" align="center">
                             <nobr>
							 <? if($row["provice_phase"]=="n") {  echo "เหนือ";
							 		} else if($row["provice_phase"]=="s") {   echo "ใต้";
									} else if($row["provice_phase"]=="c") {  echo "กลาง";
									} else if($row["provice_phase"]=="e") {  echo "ตะวันออก";
									} else if($row["provice_phase"]=="w") {  echo "ตะวันตก";
									} else if($row["provice_phase"]=="en") {  echo "ตะวันออกเฉียงเหนือ";
									} else if($row["provice_phase"]=="cn") {  echo "กลางตอนบน";
									}
							 ?></td>     
						<td  style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;" align="center"><nobr>
									<?if($row["resolv_type"]=="c"){ echo "CM";}else{ echo "Helpdesk";}?> </td>                            
						<td  style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;" align="center"><nobr>
									<?=$row["ditstance_result"]?> </td>                            
                         </tr>
                       <?
                          $i++;
                          }
						  ?> 
                          <tr>                                                                                 
                            <td colspan="10" style="padding:0px; border-bottom:1px solid #ccc; border-right:0px solid #ccc;"> จำนวนทั้งหมด <?=$i;?> งาน  </td>
                          </tr>  
                </table>
				  </form></td></tr></table>


<script type="text/javascript"> 
    var props = {    formatDate :        '%m-%d-%y'    };
    props.formatDate = '%y-%m-%d';
    var cdp1 = new CalendarDatePicker(props);                   
  
    function Search_Click(dte_begin,dte_end){        
   			document.location.href ="logcall.index.excel.form1.php?dte_begin="+dte_begin+"&dte_end="+dte_end;
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


