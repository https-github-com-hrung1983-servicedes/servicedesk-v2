<?
header("Content-Type: text/html; charset=tis-620");
header("content-type: application/x-javascript; charset=TIS-620");
session_start();
require_once("function.php");

if(!checkUser()){    echo Message(35,"red",$titel1,$msg1,"<a href='index.php?link=hw.expose.list'>$login </a>");
   exit;
}
include("header.php");
$txt = $_REQUEST["shctxt"];
$cate_id = $_REQUEST["cate_id"];
if($cate_id==""){
	$cate_id = "all";
}
//$user_id = $_REQUEST["user_id"];
$user_id = $_REQUEST["user_id"];
$typer = $_REQUEST["typer"];
$owner_by = $_REQUEST["owner_by"];
$cmd1 = "";
if($cate_id!="all"){
    $cmd1 .= " and tbl_hardware_onhand_user.cate_id ='$cate_id'";
}

$sql = "SELECT
	 tbl_hardware_onhand_user.id,
	 tbl_hardware_onhand_user.cate_id,
	 tbl_hardware_onhand_user.hardware_brand,
	 tbl_category_hardware.cate_name,
	 tbl_hardware_onhand_user.hardware_no,
	 tbl_hardware_onhand_user.dte_tme_fix_complete,
	 tbl_hardware_onhand_user.hardware_status,
	 tbl_hardware_onhand_user.owner_by,
     tbl_hardware_onhand_user.changedatetime,
     tbl_hardware_onhand_user.lastupdate_from,
tbl_user.name,
tbl_user.sname
      FROM
	 tbl_hardware_onhand_user
	 Inner Join tbl_category_hardware ON tbl_category_hardware.cate_id = tbl_hardware_onhand_user.cate_id $cmd1
     Left Join tbl_user ON tbl_hardware_onhand_user.lastupdate_from = tbl_user.user_id
      Where tbl_hardware_onhand_user.hardware_status = 'a' ";
if($txt!=""){
		$sql .= " and tbl_hardware_onhand_user.hardware_no like '%$txt%'";
}

//$sql .= " And tbl_hardware_onhand_user.asset_by = '".$_SESSION['Uat']."'";

$sql .= " order by tbl_category_hardware.cate_name ";

//echo $sql;
$rs = mysqli_query($conn,$sql);
?>
<title>Bizserv Solution Co.,Ltd</title>
<script src="script/jquery.min.js"></script>
<script src="script/thickbox.js"></script>
<script src="script/loading.js"></script>
<script type="text/javascript" src="script/jquery-1.6.4.js"></script>
<script type="text/javascript" src="script/jquery_1.7.1_min.js"></script>
<meta http-equiv=Content-Type content="text/html; charset=tis-620">
<link href="css/loading.css" rel="stylesheet" type="text/css" media="all">
<link href="image/bss_icon.ico"   rel="shortcut icon" />
<link href="style/calendar.css" rel="stylesheet" type="text/css">
<link href="style/mytable.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="script/calendar_date_picker.js"></script>
<link href="style/stylecss.css" rel="stylesheet" type="text/css">
<link href="style/filtergrid.css" rel="stylesheet" type="text/css">

<style type="text/css">
    <!--
    .mytable1 {	width:100%; font-size:12px;
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
<form  method="post" name="form1" id="form1" >

<table width="100%" align="center" class="mytable" id="table" height="100%"   cellpadding="1" cellspacing="1">
    <tr>
        <td valign="top">
                <table width="100%"  border="0" cellpadding="0" cellspacing="0" class="mytable" border="1" bordercolor="#FF0000">
					  <tr><td width="90%" colspan="2" align="center">
		<!--select name="owner_by" id="owner_by">
			<option value="All" <?if($owner_by=="") echo "selected";?>>All</option>
			<option value="PTT" <?if($owner_by=="PTT") echo "selected";?>>PTT</option>
			<option value="BSS" <?if($owner_by=="BSS") echo "selected";?>>BSS</option>
		</select-->


       					&nbsp;&nbsp; Search by  :
					<?
if($_SESSION['Uat'] ==  "BSS"){
							$sql_cate = "select cate_id,cate_name  from tbl_category_hardware  where cate_active='y' and orderbyid is not null  order by orderbyid,cate_name ";
} else if($_SESSION['Uat'] ==  "MSI"){
$sql_cate = "select cate_id,cate_name  from tbl_category_hardware  where cate_id in ('1','2','36','30','4','3','6','7','8','9','10','11','12','13','14','16','60','61','62','63'
,'64','65','66','67','68','37','25','27','31','28','70','74','75','76','77') order by cate_name ";


}
							$rs_cate = mysqli_query($conn,$sql_cate);
					?>
					  <select name="cate_id" id="cate_id" style="width:250pt"  />
                      <option value="all">-All-</option>
					  <? while ($c_cate = mysqli_fetch_array($rs_cate)) { ?>
					  		<option value="<?=$c_cate["cate_id"]?>"  <? if($c_cate["cate_id"]=="$cate_id") echo "selected";?>>    <?=$c_cate["cate_name"]?>    </option>
					<? } ?>
					  </select> &nbsp;
					  Search S/N : <input class="form-control"  type="text" name="shctxt" id="shctxt" style="width:150pt" value="<?=$txt?>" />
					  <input class="form-control"  type="button" value="Search" id="bntsch" name="bntsch" onclick="Search_Click(cate_id.value,shctxt.value)" />
						</td>
<?if($_SESSION['Uat'] ==  "BSS"){?>
					   <td>
					   				<a lang="rpt.hw.borrow.reprint.php?id=add" class="thickbox pointer" title="Re-print">
					   				<img src="image/icon_printer.gif" alt="Report" width="18" height="18" border="0" align="center"> </a></td>
					   <td><nobr><b>Print Retroact</b>&nbsp;</td>
					    <td>
					   				<a href="rpt.hw.borrow.php" target="_blank">
					   				<img src="image/icon_printer.gif" alt="Report" width="18" height="18" border="0" align="center"> </a></td>
					   <td><nobr><b>Print</b>&nbsp;</td>
<?}?>
					   <td><a href="javascript:history.back(1)" ><img src="image/cancel.jpg" alt="Cancel" width="20" height="18" border="0" align="left" /> </a> </td>
					   <td align="left"><nobr><b> Back</b>     </td>
					 </tr>
                </table>
               <table width="100%" border="0" align="center" class="mytable" id="table7"  cellpadding="1" cellspacing="1">
				   <tr>
                      <th align="center" height="20" width="5%" class="th">#</th>
                      <th align="center" height="20" width="20%" class="th"">Hardware</th>
                      <th align="center" height="20" width="15%" class="th"">Serial no.</th>
					  <th align="center" height="20" width="15%" class="th"">Enter Strock</th>
                      <th align="center" height="20" width="10%" class="th"">Status</th>
                      <th align="center" height="20" width="10%" class="th"">Last Update</th>
                      <th align="center" height="20" width="10%" class="th"">From User</th>
                    </tr>
					<? $i = 1;	while($c = mysqli_fetch_array($rs)) { ?>
					<tr onmouseover="this.style.backgroundColor='violet';" onmouseout="this.style.backgroundColor='white';" >
						<td align="center" height="20" style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;" ><a lang="hw.expose.form.php?id=<?=$c["id"]?>" class="thickbox pointer"><?=$i?></a></td>
						  <td  style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;"><a lang="hw.expose.form.php?id=<?=$c["id"]?>" class="thickbox pointer"><?=$c["cate_name"]. "  (". $c["hardware_brand"]. "  )";?></a></td>
						  <td align="left" style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;" ><a lang="hw.expose.form.php?id=<?=$c["id"]?>" class="thickbox pointer">&nbsp;&nbsp;<?=$c["hardware_no"]?></a></td>
						  <td align="center" style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;"><a lang="hw.expose.form.php?id=<?=$c["id"]?>" class="thickbox pointer"><?=$c["dte_tme_fix_complete"]?></a></td>
						  <td align="center" style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;"><a lang="hw.expose.form.php?id=<?=$c["id"]?>" class="thickbox pointer"><? if($c["hardware_status"]=="a") echo "Active";?></a></td>
						  <td align="center" style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;"><a lang="hw.expose.form.php?id=<?=$c["id"]?>" class="thickbox pointer"><? echo $c["changedatetime"]?></a></td>
						  <td align="center" style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;"><a lang="hw.expose.form.php?id=<?=$c["id"]?>" class="thickbox pointer"><? echo $c["name"]." ".$c["sname"];?></a></td>

					</tr>
					<? $i++; } ?>
                </table>
                <table align="center" class="mytable1" id="table7" cellpadding="1" cellspacing="1"><tr></tr >
                </table>
            </form></td></tr></table>

<script type="text/javascript">
    var props = {	formatDate :		'%m-%d-%y'	};
    props.formatDate = '%y-%m-%d';
    var cdp1 = new CalendarDatePicker(props);

	function Search_Click(cate_id,txt) {
		 document.location.href ="hw.expose.list.php?cate_id="+cate_id+"&txt="+txt;
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
