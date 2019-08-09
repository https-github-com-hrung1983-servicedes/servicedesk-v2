<?
header("Content-Type: text/html; charset=tis-620");
session_start();
require_once("function.php");

  if(!checkUser()){    echo Message(35,"red",$titel1,$msg1,"<a href='index.php?link=logcall.retail.index'> $login </a>");
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
						itbl_logcall_retail.customer_id,
						itbl_customer4.customer_id,
						itbl_customer4.customer_name,
						tbl_province.province_name,					
						itbl_logcall_retail.job_no,
						itbl_logcall_retail.call_openjob_datetime,
						itbl_logcall_retail.onsite_datetime,
						itbl_logcall_retail.close_datetime,
						itbl_logcall_retail.problem_job_detail,
						itbl_logcall_retail.problem_solving,
						itbl_logcall_retail.reciept_job_engineer,
						tbl_user.name,
						tbl_user.sname,
						tbl_province.province_name,
                        itbl_logcall_retail.status_sla
				FROM
					itbl_logcall_retail
					Left Join itbl_customer4 ON itbl_logcall_retail.customer_id = itbl_customer4.id
					Left Join tbl_user ON itbl_logcall_retail.reciept_job_engineer = tbl_user.user_id							
					Left Join tbl_province ON itbl_customer4.address_province = tbl_province.id


						"; 
		

		 $sql .= " Where itbl_logcall_retail.call_openjob_datetime like '$dte%'";

	if($job!=""){
		$sql .= " And itbl_logcall_retail.problem_job = '$job'";
	}
	           
        $sql .= " And itbl_logcall_retail.status_call = 'close' Order by itbl_logcall_retail.call_openjob_datetime ASC";     
?>
<link href="image/bss_icon.ico"   rel="shortcut icon" />
<link href="style/calendar.css" rel="stylesheet" type="text/css">
<link href="style/mytable.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="script/calendar_date_picker.js"></script>
<link href="style/stylecss.css" rel="stylesheet" type="text/css">
<link href="style/filtergrid.css" rel="stylesheet" type="text/css">
<meta http-equiv="refresh" content="300;"/>
<style type="text/css">
 
    .mytable1 { width:100%; font-size:11px;
                border:1px solid #ccc;
                font-size:10px;
    }
    .mytable11 {width:100%; font-size:12px;
                border:1px solid #ccc;
                font-size:11px;
    }
     .th{ background-color:#003366; color:#FFF; padding:0px; border:0px solid #ccc; height:20px; }
     .td{ border-color:#003366;}
    
</style>

<table width="100%" align="center" class="mytable" id="table" height="100%"   cellpadding="1" cellspacing="1" >
    <tr>
        <td valign="top"> 
            <form  method="post"   name="form1" id="form1"  action="#" target="mainPage" onSubmit="return false";> 
                   <table width="100%" border="0" cellpadding="0" cellspacing="0" class="mytable">
                    <tr>
                        <td width="879" valign="middle" align="center"> <nobr>		
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
Job Type  :</b> 
							&nbsp; <select name="job" id="job"><option value="">--All--</option>
                            <?
							$rc_job = mysqli_query($conn,"select * from itbl_category_job where id in ('13','44') order by category_job");
							while(@$c_job = mysqli_fetch_array($rc_job)){
							?>
							<option value="<?=$c_job["id"]?>" <? if($c_job["id"]==$job) echo "selected";?>>
							<?=$c_job["category_job"]?></option>
							<? } ?>
							
                            </select>


                            &nbsp;<input class="form-control"   type="button" name="sch" value="Search"  onclick="Search_Click(months.value,years.value,job.value)" style="width:50pt;">

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
			<?if($_SESSION["Uat"]=="BSS"){?>
				<th class="th" width="5%">Doc.</th>
			<?}?> 
                        <th class="th" width="5%">Site ID</th>
                        <th class="th" width="15%">Site Name</th>
                        <th class="th" width="10%">Job No.</th>
                        <th class="th" width="5%">Open Date</th>
                        <th class="th" width="5%">Finish Date</th>
                        <th class="th" width="17%">Problem</th>
                        <th class="th" width="18%">Solution</th> 
                        <th class="th" width="5%">SLA</th>  
                        <th class="th" width="5%">Onsit By</th>                  
                        <th class="th" width="5%">Province</th>  
                    </tr >
                        <? //  echo $sql;
                         $res = mysqli_query($conn,$sql);
                          while($row = mysqli_fetch_array($res)) {
                          ?>
                          <tr onMouseOver="this.style.backgroundColor='violet';" onMouseOut="this.style.backgroundColor='white';" >
			<?if($_SESSION["Uat"]=="BSS"){?>
				<td style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;" align="center" width="5%"><?
					if($row["doc"]=="true"){
						echo "Yes";
				 	}else{
						echo "No";
					}
				?></td>
			<?}?>
                          <td  style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;" align="center">
                              <?=$row["customer_id"];?></td>
                          <td  style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;" align="left">
                              <?=$row["customer_name"];?></td>
                          <td  style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;" align="center">
                             <nobr> <?=$row["job_no"];?></td> 
                          <td style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;"  align="center">
                             <nobr> <? $opendte = split(" ",$row["call_openjob_datetime"]); echo dateThai($opendte[0])." ".$opendte[1];?></td>
                          <td style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;"  align="center">
                             <nobr> <? $closed = split(" ",$row["close_datetime"]);  echo dateThai($closed[0])." ".$closed[1];?></td>
                          <td  style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;">
                              <?=$row["problem_job_detail"] ?><?//=$row["problem_job_detail"];?></td>
                          <td  style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;">
                              <?=$row["problem_solving"] ?><?//=$row["problem_solving"];?></td>
                              <td  style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;" align="center">
                             <nobr><?=$row["status_sla"]?></font></td>   
                          <td style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;"  align="center">
                             <nobr> <?=$row["name"]." ".$row["sname"];?></td>
                          <td  style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;" align="center">
                             <nobr><?=$row["province_name"]?></font></td>                                  
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
  
    function Search_Click(months,years,job,emp){        
   			document.location.href ="logcall.retail.index1.php?months="+months+"&years="+years+"&job="+job;
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

