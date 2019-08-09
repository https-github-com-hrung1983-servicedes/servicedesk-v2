<?
header("Content-Type: text/html; charset=tis-620");
header("content-type: application/x-javascript; charset=TIS-620");   
session_start();
require_once("function.php");

if(!checkUser()){    echo Message(35,"red","¢éÍ¤ÇÒÁàµ×Í¹","¤Ø³ÂÑ§äÁèä´é¡ÃÍ¡ª×èÍáÅÐÃËÑÊ¼èÒ¹¤ÃÑº","<a href='index.php?link=hw.waitrepair.list'> à¢éÒÊÙèÃÐºº </a>");
   exit;
}
include("header.php");                    
$user_id = $_REQUEST["user_id"];  
$status_hw = $_REQUEST["status_hw"];

if($status_hw == ""){
   $status_hw  = "r";
}
$typer = $_REQUEST["typer"];
$owner_by = $_REQUEST["owner_by"];

$sql = "SELECT
						tbl_hardware_onhand_user.id,
						tbl_hardware_onhand_user.cate_id,
						tbl_hardware_onhand_user.user_id,
						tbl_category_hardware.cate_name,
						tbl_hardware_onhand_user.hardware_no,
						tbl_hardware_onhand_user.owner_by,			
						tbl_hardware_onhand_user.hardware_status,
						tbl_hardware_onhand_user.repair_by,
						tbl_hardware_onhand_user.asset_by,
						tbl_hardware_onhand_user.sparepartfor,
						tbl_hardware_onhand_user.fix_site4return,
						tbl_hardware_onhand_user.from_site_id,
     tbl_hardware_onhand_user.changedatetime,
     tbl_hardware_onhand_user.lastupdate_from,
tbl_user.name,
tbl_user.sname
					FROM
						tbl_hardware_onhand_user
						Inner Join tbl_category_hardware ON tbl_category_hardware.cate_id = tbl_hardware_onhand_user.cate_id
						Left Join tbl_user ON tbl_hardware_onhand_user.lastupdate_from = tbl_user.user_id
					WHERE tbl_hardware_onhand_user.hardware_status = '$status_hw'
				";
if($_SESSION['Uat'] ==  "MSI"){					
	$sql .= " And tbl_hardware_onhand_user.asset_by = 'MSI'";
}
$sql .= " order by tbl_category_hardware.cate_name";
//MSIecho  $sql
//AND     tbl_category_hardware.cate_id in ('1','2','3','4','6','7','8','9','10','11','12','13','36');
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
<script type="text/javascript">
$(document).ready(function() {
    $('#selecctall').click(function(event) {  //on click 
        if(this.checked) { // check select status
            $('.checkbox1').each(function() { //loop through each checkbox
                this.checked = true;  //select all checkboxes with class "checkbox1"               
            });
        }else{
            $('.checkbox1').each(function() { //loop through each checkbox
                this.checked = false; //deselect all checkboxes with class "checkbox1"                       
            });         
        }
    });
    
});
</script>
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
<form  method="post" name="form1" id="form1" action="hw.waitrepair.list.action.php"> 
             
<table width="100%" align="center" class="mytable" id="table" height="100%"   cellpadding="1" cellspacing="1">
    <tr>                                               
        <td valign="top">                                                       
                <table width="100%"  border="0" cellpadding="0" cellspacing="0" class="mytable" border="1" bordercolor="#FF0000">
					  <tr>
       					<td width="95%" colspan="2" align="center">&nbsp;  Search by  : 
						<select name="status_bar" id="status_bar" readonly="readonly"  style="width:250pt" OnChange="window.location='?status_hw='+this.value;">
										<option value="r" <? if($status_hw == "r") echo "selected";?>><?echo iconv('UTF-8','TIS-620',"กำลังอยู่ระหว่างการซ่อม");?></option>
										<option value="i" <? if($status_hw == "i") echo "selected";?>><?echo iconv('UTF-8','TIS-620',"จำหน่ายทิ้ง");?></option>
										<option value="a"  <? if($status_hw == "a") echo "selected";?>><?echo iconv('UTF-8','TIS-620',"ใช้งานได้ปกติ");?></option>
<option value="l"  <? if($status_hw == "l") echo "selected";?>><?echo iconv('UTF-8','TIS-620',"Lost And Found");?></option>
								</select>
					&nbsp;&nbsp;&nbsp;
		<!--select name="owner_by" id="owner_by" onchange="form1.submit();">
			<option value="All" <?if($c["owner_by"]=="") echo "selected";?>>All</option>
			<option value="PTT" <?if($c["owner_by"]=="PTT") echo "selected";?>>PTT</option>
			<option value="BSS" <?if($c["owner_by"]=="BSS") echo "selected";?>>BSS</option></select-->
						</td>
<?if($_SESSION['Uat']=="BSS"){?>
					   <td><a lang="hw.waitrepair.add.serial.form.php?type=add"  class="thickbox pointer" title="Add new hardware and serial no." >
					  <img src="image/add.JPG" alt="Add hardware" width="20" height="18" border="0" align="left" /> </a> </td>
					   <td align="left"><nobr><b> Add hardware</b></td>
<?}?>



					   <td><a href="javascript:history.back(1)" ><img src="image/cancel.jpg" alt="Cancel" width="20" height="18" border="0" align="left" /> </a> </td>
					   <td align="left"><nobr><b> Cancel</b>     </td>
					 </tr>
                </table>
               <table width="100%" border="0" align="center" class="mytable" id="table7"  cellpadding="1" cellspacing="1">
				   <tr><td colspan=7>
				   <select name="select_action" id="select_action" style="width: 200px;">
						 <option value="-" disabled selected>-----Status-----</option>
									    <option value="r" <? if($status_hw == "r") ?>><?echo iconv('UTF-8','TIS-620',"กำลังอยู่ระหว่างการซ่อม");?></option>
										<option value="i" <? if($status_hw == "i") ?>><?echo iconv('UTF-8','TIS-620',"จำหน่ายทิ้ง");?></option>
<option value="l"  <? if($status_hw == "l") echo "selected";?>><?echo iconv('UTF-8','TIS-620',"Lost And Found");?></option>
<?if($_SESSION['Ustate'] ==  "admin"){?>
					<!---option value="del"><?echo iconv('UTF-8','TIS-620',"ลบ");?></option--->
<?}?>
						</select>  
						<input type="submit" value="Change" onclick="return confirm('Confirm to change');">
				      </td>
				   </tr>
				   <tr>
					  <th align="center" height="20" width="5%" class="th"><input type="checkbox" id="selecctall"/></th>
                      <th align="center" height="20" width="5%" class="th">#</th>
                      <th align="center" height="20" width="15%" class="th"">Hardware</th>
                      <th align="center" height="20" width="10%" class="th"">Serial no.</th>
                      <th align="center" height="20" width="5%" class="th"">Owner</th>
                      <th align="center" height="20" width="5%" class="th"">Asset</th>
                      <th align="center" height="20" width="5%" class="th"">Spare</th>
                      <th align="center" height="20" width="15%" class="th"">Repair</th>
                      <th align="center" height="20" width="5%" class="th"">Fix</th>
                      <th align="center" height="20" width="10%" class="th"">Status</th>
                      <th align="center" height="20" width="10%" class="th"">From Site</th>
                      <th align="center" height="20" width="10%" class="th"">Last Update</th>
                      <th align="center" height="20" width="10%" class="th"">From User</th>
                      <th align="center" height="20" width="5%" class="th""></th>
                    </tr>
					<? 
					$r = 0; $a = 0;
					$i = 1;	
					while($c = mysqli_fetch_array($rs)) {	
					$font = "black"; 
						if($c["hardware_status"]=="r"){ 
								$str = iconv('UTF-8','TIS-620',"กำลังอยู่ระหว่างการซ่อม");  
								$r++; 
								$font = "red";
							} else if($c["hardware_status"]=="a"){ 
								$str = iconv('UTF-8','TIS-620',"ใช้งานได้ปกติ");
								$a++;
							} else if($c["hardware_status"]=="i"){ 
								$str = iconv('UTF-8','TIS-620',"จำหน่ายทิ้ง");
								$a++;
							}  else if($c["hardware_status"]=="l"){ 
								$str = iconv('UTF-8','TIS-620',"Lose And Found");
								$a++;
							} 
		$sendtorepair="";
		if($c["user_id"]=="102"){
			$sendtorepair=" - Kamphol";
		}else if($c["user_id"]=="99"){
			$sendtorepair=" - Ricoh"; 
		}else if($c["user_id"]== "132"){
			$sendtorepair=" - Bhomthai"; 
		}else if($c["user_id"]== "133"){
			$sendtorepair=" - Chawpaya"; 
		}else if($c["user_id"]== "134"){
			$sendtorepair=" - Nimble"; 
		}else if($c["user_id"]== "135"){
			$sendtorepair=" - SNS"; 
		}else if($c["user_id"]== "252"){
			$sendtorepair=" - NavaDC"; 
		}else{
			$sendtorepair="";
		}

			$names = $c["name"]." ".$c["sname"];				
							?>
	 <tr onmouseover="this.style.backgroundColor='violet';" onmouseout="this.style.backgroundColor='white';" >
	    <td align="center" style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;" ><input class="checkbox1" type="checkbox" name="check[]" id="check<?=$i?>" value="<?=$c["id"]?>"></td>
	    <td align="center" height="20" style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;" >
	       <a lang="hw.waitrepair.form.php?id=<?=$c["id"]?>" class="thickbox pointer" title="Hardware Repairing"><font color="<?= $font?>"><?=$i?></font></a></td>
	    <td  style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;">
	       <a lang="hw.waitrepair.form.php?id=<?=$c["id"]?>" class="thickbox pointer" title="Hardware Repairing">&nbsp;<font color="<?= $font?>"><?=$c["cate_name"]?></font></a></td>
	    <td align="left" style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;" >
	       <a lang="hw.waitrepair.form.php?id=<?=$c["id"]?>" class="thickbox pointer" title="Hardware Repairing">&nbsp;<font color="<?= $font?>"><?=$c["hardware_no"]?></font></a></td>
	    <td align="center" style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;">
	       <a lang="hw.waitrepair.form.php?id=<?=$c["id"]?>" class="thickbox pointer" title="Hardware Repairing"><font color="<?= $font?>"><?=$c["owner_by"]?></font></a></td>  
	    <td align="center" style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;">
	       <a lang="hw.waitrepair.form.php?id=<?=$c["id"]?>" class="thickbox pointer" title="Hardware Repairing"><font color="<?= $font?>"><?=$c["asset_by"]?></font></a></td>
	    <td align="center" style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;">
	       <a lang="hw.waitrepair.form.php?id=<?=$c["id"]?>" class="thickbox pointer" title="Hardware Repairing"><font color="<?= $font?>"><?=$c["sparepartfor"]?></font></a></td>
	    <td align="center" style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;">
	       <a lang="hw.waitrepair.form.php?id=<?=$c["id"]?>" class="thickbox pointer" title="Hardware Repairing"><font color="<?= $font?>"><?=$c["repair_by"].$sendtorepair?></font></a></td>
	     <td align="center" style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;">
	       <a lang="hw.waitrepair.form.php?id=<?=$c["id"]?>" class="thickbox pointer" title="Hardware Repairing"><font color="<?= $font?>"><?=$c["fix_site4return"]?></font></a></td>
	    <td align="center" style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;">
	       <a lang="hw.waitrepair.form.php?id=<?=$c["id"]?>" class="thickbox pointer" title="Hardware Repairing"><font color="<?= $font?>"><?=$str?></font></a></td>
	    <td align="center" style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;">
	       <a lang="hw.waitrepair.form.php?id=<?=$c["id"]?>" class="thickbox pointer" title="Hardware Repairing"><font color="<?= $font?>"><?=$c["from_site_id"]?></font></a></td>
		<td align="center" style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;"><a lang="hw.waitrepair.form?id=<?=$c["id"]?>" class="thickbox pointer"><? echo $c["changedatetime"]?></a></td>
		<td align="center" style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;">
		<nobr><a lang="hw.waitrepair.form?id=<?=$c["id"]?>" class="thickbox pointer"><? echo $names;?></a></td>
	
	    <td align="center" style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;">
	    <? if($c["fix_site4return"] == "") {?>  
	       <a lang="hw.waitrepair.edit.serial.form.php?type=edit&id=<?=$c["id"]?>&status=<?=$status_hw?>"  class="thickbox pointer" title="Edit Detail" >
	       <img src="image/addedit.png" alt="Edit hardware" width="20" height="18" border="0" align="center" /> </a>
	    <? } ?></td>				
	 </tr>
	    <? $i++; } ?>	
	 <tr><td colspan="5">Wait repairing :<?=$r?>  &nbsp;  , Active : <?=$a;?></td></tr>
                </table>
            </td></tr></table>
</form>

