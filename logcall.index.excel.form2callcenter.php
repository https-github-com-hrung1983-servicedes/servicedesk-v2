<?
header("Content-Type: text/html; charset=tis-620");                 
session_start();
require_once("function.php");          
  
  if(!checkUser()){    echo Message(35,"red",$titel1,$msg1,"<a href='index.php?link=logcall.index.excel.form2callcenter'> $login </a>");
  exit;
  }                                                                                                      
       
include("header.php");   
      $typer =  $_REQUEST["type"]; //$typer;
      $job =  $_REQUEST["job"];
      $months =  $_REQUEST["months"];            
      $years =  $_REQUEST["years"];
     if ( $months == "" || $years=="" ) {
	 		$today = getdate();	
			$months = date("m");  //$today["mon"];
			$years = $today["year"];
			$dte = $years."-".$months;
	  } 
			$dte = $years."-".$months; 
$emp = $_REQUEST["emp"];

			  $sql = "SELECT
              tbl_log_call_center.site_id,
              tbl_site.site_name,
              tbl_site.site_old_name,
              tbl_site.pos,
              tbl_site.province_name,
              tbl_site.from_owner,
              tbl_log_call_center.job_no,
              tbl_log_call_center.open_call_dte,
              tbl_log_call_center.open_call_tme,
              tbl_log_call_center.onsite_datetime,
              tbl_log_call_center.fixed_time,
              tbl_log_call_center.problem,
              tbl_log_call_center.problem_solving,
              tbl_log_call_center.type_service,
              tbl_log_call_center.reciept_job_user_id,
              a.name,
              a.sname,
              tbl_log_call_center.doc,
              tbl_province.province_name,
              tbl_province.provice_phase,
              tbl_log_call_center.status_call,
              b.name as callname,
              b.sname as callsname
              FROM
              tbl_log_call_center
              Left Join tbl_site ON tbl_log_call_center.site_id = tbl_site.site_id
              Left Join tbl_user AS a ON tbl_log_call_center.reciept_job_user_id = a.user_id
              Left Join tbl_province ON tbl_site.province_name = tbl_province.id
              Left Join tbl_user b ON tbl_log_call_center.reciept_job_bss = b.user_id
						"; 
		

		 $sql .= " Where tbl_log_call_center.open_call_dte like '$dte%'  And tbl_log_call_center.type_service = 'BSS'";

	if($job!=""){
		if($job=="hw" || $job=="sw" || $job=="ot" ){
		 $sql .= "  And tbl_log_call_center.type_problem = '$job'";
		} else {
		 $sql .= "  And tbl_log_call_center.category_type = '$job'";
		}
	}
//NGV12120008
	if($emp!="") {
		 $sql .= " And tbl_log_call_center.reciept_job_user_id = '$emp'"; 
	} else {
		//$sql .= " And tbl_log_call_center.reciept_job_user_id = ''";
} 
if($typer=="2"){
		$sql .= " And  (tbl_site.site_id like 'S0%'  Or tbl_site.site_id like 'S1%'  Or tbl_site.site_id like 'S2%'  Or tbl_site.site_id like 'S3%'  Or tbl_site.site_id like 'S4%' 
		Or tbl_site.site_id like 'S5%' Or tbl_site.site_id like 'S6%' Or tbl_site.site_id like 'S7%' Or tbl_site.site_id like 'S8%' Or tbl_site.site_id like 'S9%' )";
	} else if($typer=="3") {
		$sql .= " And tbl_site.site_id like '10%'";
	} else if($typer=="4") {
		$sql .= " And tbl_site.site_id like 'AMZ%'";
	} else if($typer=="5") {
		$sql .= " And  tbl_log_call_center.job_no  like 'BSS%' ";
	}
	
	           
        $sql .= "  Order by tbl_log_call_center.fixed_time ASC";                   
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
                           <b> &nbsp; Site Type  :</b>
                            <select name="typer" id="typer">           
                                <option value = '1' <?if($typer=="1") echo "selected";?>>-All-</option>   
                                <option value = '2' <?if($typer=="2") echo "selected";?>>NGV</option>            
                                <option value = '3' <?if($typer=="3") echo "selected";?>>Oil</option>            
                                <option value = '4' <?if($typer=="4") echo "selected";?>>Amazon</option>     
                                <option value = '5' <?if($typer=="5") echo "selected";?>>Bizserv Solution</option>            
                            </select>           
                              <b>&nbsp;Month :</b> 
                            <select name="months" id="months">            
                                <option value = "01" <?if($months=="01") echo "selected";?> >January</option>            
                                <option value = "02" <?if($months=="02") echo "selected";?> >February</option>          
                                <option value = "03" <?if($months=="03") echo "selected";?> >March</option>          
                                <option value = "04" <?if($months=="04") echo "selected";?> >April</option>          
                                <option value = "05" <?if($months=="05") echo "selected";?> >May</option>          
                                <option value = "06" <?if($months=="06") echo "selected";?> >June</option>          
                                <option value = "07" <?if($months=="07") echo "selected";?> >July</option>          
                                <option value = "08" <?if($months=="08") echo "selected";?> >August</option>          
                                <option value = "09" <?if($months=="09") echo "selected";?> >September</option>          
                                <option value = "10" <?if($months=="10") echo "selected";?> >October</option>          
                                <option value = "11" <?if($months=="11") echo "selected";?> >November</option>       
                                <option value = "12" <?if($months=="12") echo "selected";?> >December</option>               
                            </select> &nbsp;

			   <b>&nbsp;Year :</b>
			     <select name="years" id="years">                 
                                <option value = "2012" <?if($years==2012) echo "selected";?> >2012</option>            
                                <option value = "2013" <?if($years==2013) echo "selected";?> >2013</option>          
                                <option value = "2014" <?if($years==2014) echo "selected";?> >2014</option>          
                                <option value = "2015" <?if($years==2015) echo "selected";?> >2015</option>         
                                <option value = "2016" <?if($years==2016) echo "selected";?> >2016</option>         
                                <option value = "2017" <?if($years==2017) echo "selected";?> >2017</option>         
                                <option value = "2018" <?if($years==2018) echo "selected";?> >2018</option>         
                                <option value = "2019" <?if($years==2019) echo "selected";?> >2019</option>                      
                            </select>&nbsp; 
				<?if($_SESSION["Uat"]=="BSS"){?>Job Type  :</b> 
							&nbsp; <select name="job" id="job"><option value="">--All--</option>
                            <?
							$rc_job = mysqli_query($conn,"select * from tbl_category_type order by station_type,category_type");
							$val=2;
								echo "<option></option>";
							if($val==2){
									echo "<option>---------NGV-----------</option>";
								}
							while(@$c_job = mysqli_fetch_array($rc_job)){
							if($c_job["station_type"]!=$val){
								$val+=1;
								echo "<option></option>";
								if($val==3){
									echo "<option>---------Oil-----------</option>";
								}else if($val==4){
									echo "<option>---------Amazon-----------</option>";
								}else if($val==5){
									echo "<option>---------Bizserv-----------</option>";
								}
							}
							?>
							<option value="<?=$c_job["category_id"]?>" <? if($c_job["category_id"]==$job) echo "selected";?>>
							<?=$c_job["category_type"]?></option>
							<? } ?>

							<option value='hw' <?if($job=="hw") echo "selected";?>>---------Hardware-----------</option>
							<option value='sw' <?if($job=="sw") echo "selected";?>>---------Software-----------</option>
							<option value='ot' <?if($job=="ot") echo "selected";?>>---------Network-----------</option>
							
                            </select><?}?>
							&nbsp;
							<select id="emp" name="emp">
								<option value="">--All--</option>;
							<?
							   $rc_emp = mysqli_query($conn,"SELECT tbl_user.user_id,tbl_user.name,tbl_user.sname
										FROM tbl_user
													Where tbl_user.at = '".$_SESSION["Uat"]."'
													And tbl_user.status_user = 'y' Order by tbl_user.name");
							while($c_emp = mysqli_fetch_array($rc_emp)){ ?>		
									<option value="<?=$c_emp["user_id"]?>"  <? if($c_emp["user_id"] == $emp) echo "selected";?> ><?=$c_emp["name"]  ."   ".$c_emp["sname"]?></option>;
							<? } ?>								
							</select>


                            &nbsp;<input  type="button" name="sch" value="Search"  onclick="Search_Click(typer.value,months.value,years.value,job.value,emp.value)" style="width:50pt;">
                            &nbsp;<input  type="button" name="report3g" id="report3g" value="3G Excel" style="width:50pt;">
<script type="text/javascript"> 
$(document).ready(function(){  
         
  $("#report3g").click(function(){
	//	alert("adfasdf");
		var typer = $("#typer").attr('value'); 
		var job = $("#job").attr('value'); 
		var months = $("#months").attr('value'); 
		var years = $("#years").attr('value'); 
		document.location.href ="logcall.index.excel.form2callcenter.exportexcel.php";
  });	  
  
});     
</script>

                        </td>
                    </tr>
                </table>     
				
				
                <table width="100%" align="center" class="mytable" id="table7" name="table7"  cellpadding="1" cellspacing="1">
                    <tr>
			<?if($_SESSION["Uat"]=="BSS"){?>
			<?}?> 
                        <th class="th" width="5%">Site ID</th>
                        <th class="th" width="20%">Site Name</th>
						<? if($typer == "Oil") {
                        	echo "<th class='th' width='5%'>Site Type.</th>";
						} else {
							echo "<th class='th' width='5%'>Pos No.</th>";
						}?>
                        <th class="th" width="10%">Job No.</th>
                        <th class="th" width="5%">Open Date</th>
                        <th class="th" width="5%">Finish Date</th>
                        <th class="th" width="17%">Problem</th>
                        <th class="th" width="18%">Solution</th>                    
                        <th class="th" width="5%">Province</th>          
                        <th class="th" width="5%">Zone</th>  
                        <th class="th" width="18%">Call Center</th>   
                        <th class="th" width="18%">Onsite by</th>                
                        <th class="th" width="5%">Owner</th>              
                        <th class="th" width="5%">Status</th>    
                    </tr >
                        <? //  echo $sql;
                         $res = mysqli_query($conn,$sql);
                          while($row = mysqli_fetch_array($res)) {
                          ?>
                          <tr onMouseOver="this.style.backgroundColor='violet';" onMouseOut="this.style.backgroundColor='white';" >
			
                          <td  style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;" align="center">
                              <?=$row["site_id"];?></td>
                          <td  style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;" align="left">
                              <?
										  $site_name_old = "";
									if($row["site_old_name"]!=""){
										  $site_name_old = " , ".$row["site_old_name"]; 
									  }
									 echo  $row["site_name"].$site_name_old;	
							// }
									?>
                          	</td>
                              <?
							  if($typer == "Oil") {
							    echo "<td  style='padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;' align='center'>";
							   	echo $row["site_type"];
								echo "&nbsp;</td>";
							  } else {
							  	echo "<td  style='padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;' align='center'>";
							   	echo $row["pos"];
								echo "&nbsp;</td>";
							  } 
				$str_phase = "";
				if($row["provice_phase"]=="b") $str_phase = "กรุงเทพฯ";
				if($row["provice_phase"]=="cc") $str_phase = "ปริมณฑล";
				if($row["provice_phase"]=="n") $str_phase = "เหนือ";
				if($row["provice_phase"]=="s") $str_phase = "ใต้";  
				if($row["provice_phase"]=="en") $str_phase = "ตะวันออกเฉียงเหนือ";
				if($row["provice_phase"]=="e") $str_phase = "ตะวันออก";
				if($row["provice_phase"]=="c") $str_phase = "กลาง";
				if($row["provice_phase"]=="w") $str_phase = "ตะวันตก";//(บน)
							  ?></td>
                          <td  style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;" align="center">
                             <nobr> <?=$row["job_no"];?></td> 
                          <td style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;"  align="center">
                             <nobr> <? $opendte = split(" ",$row["open_call_dte"]); echo dateThai($opendte[0]);?></td>
                          <td style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;"  align="center">
                             <nobr> <? $fixed = split(" ",$row["fixed_time"]);  echo dateThai($fixed[0]);?></td>
                          <td  style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;">
                              <?=$row["problem"];?></td>
                          <td  style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;">
                              <?=$row["problem_solving"];?></td>
                          <td  style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;" align="center">
                             <nobr><?=$row["province_name"]?></font></td> 
                          <td  style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;" align="center">
                             <nobr><?=iconv( 'UTF-8', 'TIS-620', $str_phase)?></font></td> 
                          <td  style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;" align="center">
                             <nobr><?=$row["callname"]."  ".$row["callsname"]?></font></td> 
                          <td  style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;" align="center">
                             <nobr><?=$row["name"]."  ".$row["sname"]?></font></td> 
                          <td  style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;" align="center">
                             <nobr><?=$row["from_owner"]?></font></td> 
                          <td  style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;" align="center">
                             <nobr><?=$row["status_call"]?></font></td>                                  
                         </tr>
                       <?
                          $i++;
                          }
						  ?> 
                          <tr>                                                                                 
                            <td colspan="10" style="padding:0px; border-bottom:1px solid #ccc; border-right:0px solid #ccc;"><?=iconv('UTF-8','TIS-620',"จำนวน $i แถว"  )?></td>
                          </tr>  
                </table>
				  </form></td></tr></table>


<script type="text/javascript"> 
    var props = {    formatDate :        '%m-%d-%y'    };
    props.formatDate = '%y-%m-%d';
    var cdp1 = new CalendarDatePicker(props);                   
  
    function Search_Click(typer,months,years,job,emp){        
   			document.location.href ="logcall.index.excel.form2callcenter.php?type="+typer+"&months="+months+"&years="+years+"&job="+job+"&emp="+emp;
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


