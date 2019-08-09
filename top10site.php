<?
header("Content-Type: text/html; charset=tis-620");
session_start();
require_once("function.php");
  if(!checkUser()){    echo Message(35,"red",$titel1,$msg1,"<a href='index.php?link=detail_incident_hardeware'> $login </a>");
  exit;
  }  
include("header.php");



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
	<tr>
		<td colspan="7" align="center" >

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
&nbsp;
			<select name="toyear" id="toyear">
				<? for ($jj=1;$jj<=9;$jj++) {?>
				<option value="<?=$dyear[$jj]?>" <? if($toyear==$dyear[$jj]) echo "selected"?>><?=$dyear[$jj]?></option>
				<?}?>
			     </select> &nbsp;&nbsp;


				Limit : <select name="limits" id="limits" onchange="form.submit();">
					<option value="10" <?if(10==$limits) echo "selected";?>>10</option>
					<option value="50" <?if(50==$limits) echo "selected";?>>50</option>
					<option value="100" <?if(100==$limits) echo "selected";?>>100</option>
					<option value="150" <?if(150==$limits) echo "selected";?>>150</option>
					<option value="200" <?if(200==$limits) echo "selected";?>>200</option>
					<option value="300" <?if(300==$limits) echo "selected";?>>300</option>
				</select>&nbsp;&nbsp;<input class="form-control"  type="button" value="Search" onclick="Search_Click(limits.value,fmmnt.value,fmyear.value,tomnt.value,toyear.value)"></td>
	</tr>	    
	<tr>
                        <th align="center" height="40" class="th">#</th> 
                        <th align="center" height="40" class="th">No.</th>   
                        <th align="center" height="40" class="th">Site</th>    
                        <th align="center" height="40" class="th" colspan=3>Province</th>                   
                    </tr >
	<? 
		$sql = "SELECT
				Count(tbl_insident_hw.site_id) AS cnt,
				tbl_insident_hw.site_id,
				tbl_site.site_name,
				tbl_province.province_name
			FROM
				tbl_insident_hw
			Inner Join tbl_site286 ON tbl_insident_hw.site_id = tbl_site286.site_id
			Inner Join tbl_site ON tbl_site286.site_id = tbl_site.site_id
			Inner Join tbl_province ON tbl_site.province_name = tbl_province.id
			Inner Join tbl_log_call_center ON tbl_insident_hw.job_no = tbl_log_call_center.job_no
			Where  tbl_insident_hw.cate_id in ('1','2','3','4','6','7','8','9','10','11','12','13','36')
			And tbl_insident_hw.job_no  like 'NGV%'
			And tbl_log_call_center.open_call_dte  between '$fmyear-$fmmnt-01' and  '$toyear-$tomnt-31'	
			GROUP BY tbl_insident_hw.site_id
			ORDER BY cnt DESC
			LIMIT 0, $limits"; 

//echo $sql;
		$rs = mysqli_query($conn,$sql);
		$i = 1;
		while($c = mysqli_fetch_array($rs)) {
?> 
		<tr onMouseOver="this.style.backgroundColor='violet';" onMouseOut="this.style.backgroundColor='white';">    
			<td style="padding:0px; border-bottom:1px solid #ccc; border-right:0px solid #ccc;" align="center">
<!---a href = "top10site.detail.php?id=<?=$c[site_id]?>&fmmnt=<?=$fmmnt?>&fmyear=<?=$fmyear?>&tomnt=<?=$tomnt?>&toyear=<?=$toyear?>"----><?=$i?><!---/a----></td>
			<td style="padding:0px; border-bottom:1px solid #ccc; border-right:0px solid #ccc;" align="center">
<!---a href = "top10site.detail.php?id=<?=$c[site_id]?>&fmmnt=<?=$fmmnt?>&fmyear=<?=$fmyear?>&tomnt=<?=$tomnt?>&toyear=<?=$toyear?>"----><?=$c["cnt"]?><!---/a----></td>
			<td style="padding:0px; border-bottom:1px solid #ccc; border-right:0px solid #ccc;">
<!---a href = "top10site.detail.php?id=<?=$c[site_id]?>&fmmnt=<?=$fmmnt?>&fmyear=<?=$fmyear?>&tomnt=<?=$tomnt?>&toyear=<?=$toyear?>"----><?=$c["site_id"]." ".$c["site_name"]?><!---/a----></td>
			<td style="padding:0px; border-bottom:1px solid #ccc; border-right:0px solid #ccc;" colspan=3>
<!---a href = "top10site.detail.php?id=<?=$c[site_id]?>&fmmnt=<?=$fmmnt?>&fmyear=<?=$fmyear?>&tomnt=<?=$tomnt?>&toyear=<?=$toyear?>"-----><?=$c["province_name"]?><!---/a----></td>
		</tr>
                        <th align="center" class="th"colspan=3>Category</th> 
                        <th align="center" class="th">S/N</th>     
                        <th align="center" class="th">Job no.</th>     
                        <th align="center" class="th">Date</th>  
<?
$sql_detail = "SELECT  tbl_insident_hw.job_no,
		tbl_insident_hw.site_id,
		tbl_site.site_name,
		tbl_category_hardware.cate_name,
		tbl_insident_hw.job_no,
		tbl_log_call_center.open_call_dte,
		tbl_hardware_onhand_user.hardware_no
FROM
	tbl_insident_hw
Inner Join tbl_site ON tbl_insident_hw.site_id = tbl_site.site_id
Inner Join tbl_category_hardware ON tbl_insident_hw.cate_id = tbl_category_hardware.cate_id
Inner Join tbl_log_call_center ON tbl_insident_hw.job_no = tbl_log_call_center.job_no
Inner Join tbl_hardware_onhand_user ON tbl_insident_hw.serial_no = tbl_hardware_onhand_user.id
Where  tbl_insident_hw.cate_id in ('1','2','3','4','6','7','8','9','10','11','12','13','36')
And tbl_insident_hw.site_id = '$c[site_id]'
And tbl_insident_hw.job_no  like 'NGV%'
And tbl_log_call_center.open_call_dte   between '$fmyear-$fmmnt-01' and  '$toyear-$tomnt-31'
Order by tbl_category_hardware.cate_name"; 
	$res_detail = mysqli_query($conn,$sql_detail);
	while($c_detail = mysqli_fetch_array($res_detail)){
?>
	<tr onMouseOver="this.style.backgroundColor='violet';" onMouseOut="this.style.backgroundColor='white';">    
		      <td style="padding:0px; border-bottom:1px solid #ccc; border-right:0px solid #ccc;" align="center" colspan=2>&nbsp;</td>
		      <td style="padding:0px; border-bottom:1px solid #ccc; border-right:0px solid #ccc;" >&nbsp;&nbsp;&nbsp;&nbsp;
<?=$c_detail["cate_name"]?></td>      
		      <td style="padding:0px; border-bottom:1px solid #ccc; border-right:0px solid #ccc;" >&nbsp;&nbsp;&nbsp;&nbsp;
<?=$c_detail["hardware_no"]?></td>
		      <td style="padding:0px; border-bottom:1px solid #ccc; border-right:0px solid #ccc;" >&nbsp;&nbsp;&nbsp;&nbsp;
<?=$c_detail["job_no"]?></td>      
		      <td style="padding:0px; border-bottom:1px solid #ccc; border-right:0px solid #ccc;" >&nbsp;&nbsp;&nbsp;&nbsp;
<?=$c_detail["open_call_dte"]?></td>
		</tr>	
<?		
}
?>

<tr>
                        <th align="center" height="40" class="th">#</th> 
                        <th align="center" height="40" class="th">No.</th>   
                        <th align="center" height="40" class="th">Site</th>    
                        <th align="center" height="40" class="th" colspan=3>Province</th>                   
                    </tr >





<?
	$i++;
}
?>
                </table>  
            </form></td></tr></table>


<script>

 function Search_Click(limits,fmmnt,fmyear,tomnt,toyear){        
   document.location.href ="top10site.php?limits="+limits+"&fmmnt="+fmmnt+"&fmyear="+fmyear+"&tomnt="+tomnt+"&toyear="+toyear;
      }

</script>



