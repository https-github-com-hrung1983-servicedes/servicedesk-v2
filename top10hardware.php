<?
header("Content-Type: text/html; charset=tis-620");
session_start();
require_once("function.php");
  if(!checkUser()){    echo Message(35,"red",$titel1,$msg1,"<a href='index.php?link=detail_incident_hardeware'> $login </a>");
  exit;
  }  
include("header.php");
$cate_id = $_REQUEST["cate_id"];
if($cate_id==""){
	$cate_id = "1";
}
$limits = $_REQUEST["limits"];
if($limits==""){
	$limits = "10";
}
   
$dmonth  = Array("","January","February","March","April","May","June","July","August","September","October","November","December"); 
$dyear  = Array("2010","2011","2012","2013","2014","2015","2016","2017","2018","2019");


//Nimble Technology Co., Ltd.
//Chaophaya Computech Co., Ltd.

$fmmnt = $_REQUEST["fmmnt"];
if($fmmnt==""){
	$fmmnt = date('m');
}
$fmyear = $_REQUEST["fmyear"];
if($fmyear==""){
	$fmyear = date('Y');
}
$tomnt = $_REQUEST["tomnt"];
if($tomnt==""){
	$tomnt = date('m');
}
$toyear = $_REQUEST["toyear"];
if($toyear==""){
	$toyear = date('Y');
}
?>

<script src="script/jquery.min.js"></script>
<script src="script/thickbox.js"></script>
<script src="script/loading.js"></script>



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
$sql = "SELECT
tbl_category_hardware.cate_id,
tbl_category_hardware.cate_name
FROM
tbl_category_hardware
where tbl_category_hardware.cate_id in ('1','2','3','4','6','7','8','9','10','11','12','13','36')"; 
$res = mysqli_query($conn,$sql);
$i = 1;
?>
           
		    <tr>
			<td colspan="6" align="center">

			From : <select name="fmmnt" id="fmmnt">
				<? for ($i=1;$i<=12;$i++) {?>
					<option value="<?=$i?>" <? if($fmmnt==$i) echo "selected"?>><?=$dmonth[$i]?></option>
				<?}?>
				</select>&nbsp; 
			<select name="fmyear" id="fmyear">
			        <? for ($j=1;$j<=9;$j++) { ?>
			       <option value="<?=$dyear[$j]?>" <?if($fmyear==$dyear[$j]) echo "selected";?>><?=$dyear[$j]?></option>
			        <? } ?>
			</select>
			&nbsp;&nbsp;   

			To : <select name="tomnt" id="tomnt">
				<? for ($ii=1;$ii<=12;$ii++) {?>
					<option value="<?=$ii?>" <? if($tomnt==$ii) echo "selected"?>><?=$dmonth[$ii]?></option>
				<?}?>
			     </select>

			<select name="toyear" id="toyear">
				<? for ($jj=1;$jj<=9;$jj++) {?>
				<option value="<?=$dyear[$jj]?>" <? if($toyear==$dyear[$jj]) echo "selected"?>><?=$dyear[$jj]?></option>
				<?}?>
			     </select>


			Search by : 
			<select name="cate_id" id="cate_id"> 
			<? while( $row = mysqli_fetch_array($res)){ ?>         
				<option value="<?=$row['cate_id']?>" <? if($id == $row['cate_id']) echo "selected"; ?>><?=$row["cate_name"]?></option>
			<? } ?>
			</select> &nbsp;&nbsp; 
		    Limit : <select name="limits" id="limits">
					<option value="10" <?if(10==$limits) echo "selected";?>>10</option>
					<option value="50" <?if(50==$limits) echo "selected";?>>50</option>
					<option value="100" <?if(100==$limits) echo "selected";?>>100</option>
					<option value="150" <?if(150==$limits) echo "selected";?>>150</option>
					<option value="200" <?if(200==$limits) echo "selected";?>>200</option>
					<option value="300" <?if(300==$limits) echo "selected";?>>300</option>
				</select> &nbsp;
		<input type="button" value="Search" onclick="Search_Click(cate_id.value,limits.value,fmmnt.value,fmyear.value,tomnt.value,toyear.value)">
		</td>
		    </tr>
	      <tr>
                        <th align="center" height="40" class="th">#</th>     
                        <th align="center" height="40" class="th">No.</th>    
                        <th align="center" height="40" class="th" colspan=6>S/N</th>                 
                    </tr>
	<?// 
		$sql_cnt = "SELECT
				Count(tbl_insident_hw.serial_no) AS cnt,
				tbl_insident_hw.serial_no,
				tbl_hardware_onhand_user.hardware_no
			FROM
				tbl_insident_hw
			Inner Join tbl_hardware_onhand_user ON tbl_insident_hw.serial_no = tbl_hardware_onhand_user.id
			Inner Join tbl_log_call_center ON tbl_insident_hw.job_no = tbl_log_call_center.job_no
			Where tbl_insident_hw.cate_id = '$cate_id'
			And tbl_insident_hw.job_no like 'NGV%'
			And tbl_log_call_center.open_call_dte between '$fmyear-$fmmnt-01' and  '$toyear-$tomnt-31'
			GROUP BY tbl_insident_hw.serial_no
			ORDER BY cnt DESC
			LIMIT 0, $limits"; 

		$rs_cnt = mysqli_query($conn,$sql_cnt);          
		$i = 1;
		while($c_cnt = mysqli_fetch_array($rs_cnt)) {
?> 
		<tr onMouseOver="this.style.backgroundColor='violet';" onMouseOut="this.style.backgroundColor='white';">    
		      <td style="padding:0px; border-bottom:1px solid #ccc; border-right:0px solid #ccc;" align="center">
<!---a href = "top10hardware.detail.php?id=<?=$c_cnt['serial_no']?>&fmmnt=<?=$fmmnt?>&fmyear=<?=$fmyear?>&tomnt=<?=$tomnt?>&toyear=<?=$toyear?>"-----><?=$i?><!---/a----></td>
		      <td style="padding:0px; border-bottom:1px solid #ccc; border-right:0px solid #ccc;" align="center">
<!---a href = "top10hardware.detail.php?id=<?=$c_cnt['serial_no']?>&fmmnt=<?=$fmmnt?>&fmyear=<?=$fmyear?>&tomnt=<?=$tomnt?>&toyear=<?=$toyear?>"---><?=$c_cnt["cnt"]?><!---/a----></td>      
		      <td style="padding:0px; border-bottom:1px solid #ccc; border-right:0px solid #ccc;" colspan=6 >&nbsp;&nbsp;&nbsp;&nbsp;
<!---a href = "top10hardware.detail.php?id=<?=$c_cnt['serial_no']?>&fmmnt=<?=$fmmnt?>&fmyear=<?=$fmyear?>&tomnt=<?=$tomnt?>&toyear=<?=$toyear?>"---><?=$c_cnt["hardware_no"]?><!--/a---></td>
		</tr>
	     <tr>
                        <td align="center" colspan=2></td>     
                        <td align="center" class="th">Site ID.</td>    
                        <td align="center" class="th">Site Name</td> 
                        <td align="center" class="th">Job No.</td>       
                        <td align="center" class="th">Date</td>            
                    </tr >
	<? 
		$sql_detail = "SELECT
				tbl_insident_hw.site_id,
				tbl_site.site_name,
				tbl_insident_hw.job_no,
				tbl_log_call_center.open_call_dte
			FROM
				tbl_insident_hw
			Inner Join tbl_site ON tbl_insident_hw.site_id = tbl_site.site_id
			Inner Join tbl_log_call_center ON tbl_insident_hw.job_no = tbl_log_call_center.job_no
			WHERE tbl_insident_hw.serial_no = '$c_cnt[serial_no]'
			And tbl_insident_hw.job_no like 'NGV%'
			And tbl_log_call_center.open_call_dte  between '$fmyear-$fmmnt-01' and  '$toyear-$tomnt-31'";
		$rs_detail = mysqli_query($conn,$sql_detail);
		while($c_detail = mysqli_fetch_array($rs_detail)) {
//echo $sql_detail;
?> 
<tr onMouseOver="this.style.backgroundColor='violet';" onMouseOut="this.style.backgroundColor='white';">    
		      <td style="padding:0px; border-bottom:1px solid #ccc; border-right:0px solid #ccc;" align="center" colspan=2>
&nbsp;</td>
		      <td style="padding:0px; border-bottom:1px solid #ccc; border-right:0px solid #ccc;" align="center">
<?=$c_detail["site_id"]?></td>      
		      <td style="padding:0px; border-bottom:1px solid #ccc; border-right:0px solid #ccc;" >
<nobr><?=$c_detail["site_name"]?></td>
		      <td style="padding:0px; border-bottom:1px solid #ccc; border-right:0px solid #ccc;" >
<?=$c_detail["job_no"]?></td>
		      <td style="padding:0px; border-bottom:1px solid #ccc; border-right:0px solid #ccc;" >
<?=$c_detail["open_call_dte"]?></td>
		</tr>

<?}?>
<tr>	<th align="center" height="40" class="th">#</th>     
                        <th align="center" height="40" class="th">No.</th>    
                        <th align="center" height="40" class="th" colspan=6>S/N</th> </tr>
<?
	$i++;	
}
?>
                </table>  
            </form></td></tr></table>


<script type="text/javascript"> 
    var props = {	formatDate :		'%m-%d-%y'	};
    props.formatDate = '%y-%m-%d';
    var cdp1 = new CalendarDatePicker(props); 


 function Search_Click(cate_id,limits,fmmnt,fmyear,tomnt,toyear){        
   document.location.href ="top10hardware.php?cate_id="+cate_id+"&limits="+limits+"&fmmnt="+fmmnt+"&fmyear="+fmyear+"&tomnt="+tomnt+"&toyear="+toyear;
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



