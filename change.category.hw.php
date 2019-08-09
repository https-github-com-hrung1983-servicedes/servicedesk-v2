<?
header("Content-Type: text/html; charset=tis-620");
header("content-type: application/x-javascript; charset=TIS-620");
session_start();
require_once("function.php");

if(!checkUser()){    echo Message(35,"red",$titel1,$msg1,"<a href='index.php?link=hw.onhand.list'>$login </a>");
   exit;
}
include("header.php");
$sn_id = $_REQUEST["sn_id"];
if($sn_id==""){
    $sn_id="hrung";
}
$sql = "SELECT
						tbl_hardware_onhand_user.id,
						tbl_hardware_onhand_user.cate_id,
						tbl_hardware_onhand_user.hardware_brand,
						tbl_hardware_onhand_user.hardware_no
					FROM
						tbl_hardware_onhand_user
					where tbl_hardware_onhand_user.hardware_no = '$sn_id'	
						 ";

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
    
    .mytable1 {	width:100%; font-size:12px;
                border:1px solid #ccc;
                font-size:11px;
    }
    .mytable11 {width:100%; font-size:12px;
                border:1px solid #ccc;
                font-size:11px;
    }
   .th{ background-color:#003366; color:#FFF; padding:0px; border:0px solid #ccc; height:20px; }

</style>
<form  method="post" name="form1" id="form1" action="#">

<table width="100%" align="center" class="mytable" id="table" height="100%"   cellpadding="1" cellspacing="1">
    <tr>
        <td valign="top">
                <table width="100%"  border="0" cellpadding="0" cellspacing="0" class="mytable" border="1" bordercolor="#FF0000">
					  <tr>
       					<td width="95%" colspan="2" align="center">
                            &nbsp;  SN No. : <input class="form-control"  type="text" id="sn_id" value="<?php echo $sn_id;?>">
                            &nbsp;  <input class="form-control"  type="button" value="Search" onclick="schsn(sn_id.value);">
						</td>
					   <td><a href="javascript:history.back(1)" ><img src="image/cancel.jpg" alt="Cancel" width="20" height="18" border="0" align="left" /> </a> </td>
					   <td align="left"><nobr><b> Back</b>     </td>
					 </tr>
                </table>
               <table width="100%" border="0" align="center" class="mytable" id="table7"  cellpadding="1" cellspacing="1">
                    <tr>
                      <th align="center" height="20" width="5%" class="th"></th>
                      <th align="center" height="20" width="20%" class="th">Hardware</th>
                      <th align="center" height="20" width="15%" class="th">Serial no.</th>
                      <th align="center" height="20" width="15%" class="th"></th>
                    </tr>
                    <? $i = 1;	
                    while($c = mysqli_fetch_array($rs)) {
                        ?>
<tr onmouseover="this.style.backgroundColor='violet';" onmouseout="this.style.backgroundColor='white';" >
	<td align="center" height="20" style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;" >
        <?=$i?></td>
	<td height="20" style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;">
        <select id="updatecate_id" name="updatecate_id">
        <?php 
            $sql_cate = "select * from tbl_category_hardware order by cate_name";
            $rs_cate = mysqli_query($conn,$sql_cate);
            while($c_cate = mysqli_fetch_array($rs_cate)){
        ?>
            <option value="<?=$c_cate["cate_id"];?>" <?php if($c_cate["cate_id"]==$c["cate_id"]) echo "selected";?>><?=$c_cate["cate_name"];?></option>
            <?php } ?>
        </select>
    </td>
	<td  style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;"><?=$c["hardware_no"]?></td>
    <td  style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;">
                <input class="form-control"  type="text" id="idupdate"  name="idupdate" value="<?php echo $c["id"]?>" readonly>
                <input class="form-control"  type="button" id="update" name="update" value="Save" onclick="updatesn(idupdate.value,updatecate_id.value,sn_id.value);">
    </td>
</tr>
					<? $i++; } ?>
                </table>
            </td></tr></table>
</table>
</form>

<script type="text/javascript">
function schsn(txt){
    document.location.href ="change.category.hw.php?sn_id="+txt;
}
function updatesn(idx,cate_idx,sn_id){
    document.location.href ="change.category.hw.execute.php?idupdate="+idx+"&cate_id="+cate_idx+"&sn_id="+sn_id;
}
</script>
