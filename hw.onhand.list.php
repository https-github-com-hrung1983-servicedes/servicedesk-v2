<?
header("Content-Type: text/html; charset=tis-620");
header("content-type: application/x-javascript; charset=TIS-620");
session_start();
require_once("function.php");

if(!checkUser()){    echo Message(35,"red",$titel1,$msg1,"<a href='index.php?link=hw.onhand.list'>$login </a>");
   exit;
}
include("header.php");
$user_id = $_REQUEST["user_id"];
if($user_id==""){
   $user_id  = $_SESSION["User_id"];
}else if($user_id=="all"){
   $user_id  = $_REQUEST["user_id"];
}

if($_SESSION['Ustate'] ==  "helpdesk" || $_SESSION['Ustate'] ==  "admin" ){ 
  $hw_status="'o','b','r','a' ";
}
else{
  $hw_status="'o','b' ";
}
$cmd = "";
if($_SESSION["Ustate"]=="user"){
	$hw_status="'o','b' ";
	$cmd = " and tbl_hardware_onhand_user.user_id = '".$_REQUEST["user_id"]."'";
}


$owner_by = $_REQUEST["owner_by"];
$sql = "SELECT
						tbl_hardware_onhand_user.id,
						tbl_user.name,
						tbl_user.sname,
						tbl_hardware_onhand_user.cate_id,
						tbl_hardware_onhand_user.hardware_brand,
						tbl_hardware_onhand_user.user_id,
						tbl_category_hardware.cate_name,
						tbl_hardware_onhand_user.hardware_no,
						tbl_hardware_onhand_user.dte_tme_form_stock,
						tbl_hardware_onhand_user.dte_tme_form_pump,
						tbl_hardware_onhand_user.hardware_status,
						tbl_hardware_onhand_user.from_site_id,
						tbl_hardware_onhand_user.owner_by,
						tbl_hardware_onhand_user.bussinessname,
     tbl_hardware_onhand_user.changedatetime,
     tbl_hardware_onhand_user.lastupdate_from,
	 tbl_user.name,
	 tbl_user.sname
					FROM
						tbl_hardware_onhand_user
						Inner Join tbl_user ON tbl_hardware_onhand_user.user_id = tbl_user.user_id
						Inner Join tbl_category_hardware ON tbl_category_hardware.cate_id = tbl_hardware_onhand_user.cate_id
						where tbl_hardware_onhand_user.hardware_status in ($hw_status ) $cmd
						
						 ";

//Left Join tbl_user x1 ON tbl_hardware_onhand_user.lastupdate_from = tbl_user.user_id
//if($owner_by != "All"){			and tbl_user.at = '".$_SESSION['Uat']."'
//	$sql .= " And tbl_hardware_onhand_user.owner_by = '$owner_by'";
//}
if($user_id != "all"){
  	$sql .= " and tbl_hardware_onhand_user.user_id= '$user_id' ";
}
$sql .= " order by tbl_category_hardware.cate_name ";//tbl_hardware_onhand_user.dte_tme_form_stock
//echo $sql;
//echo "<hr>ccc".$user_id;
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
<script type="text/javascript">
$(document).ready(function() {
   $("#user_new").hide();
		 function gethw(str){
		 	var cmd = str.value;
					if(cmd!="o"){
					$("#user_new").hide();
					}else{
					$("#user_new").show();
					}
		 }
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
<form  method="post" name="form1" id="form1" action="hw.onhand.list.action.php">

<table width="100%" align="center" class="mytable" id="table" height="100%"   cellpadding="1" cellspacing="1">
    <tr>
        <td valign="top">
                <table width="100%"  border="0" cellpadding="0" cellspacing="0" class="mytable" border="1" bordercolor="#FF0000">
					  <tr>
       					<td width="95%" colspan="2" align="center">
	<select style="width:170pt" name="user_id" id="user_id" OnChange="window.location='?user_id='+this.value;">
	<? if($_SESSION["Ustate"]=="admin" || $_SESSION['Uat'] ==  "MSI" || $_SESSION["User_id"] == "102") { ?>

						
								<option value="all" <? if($user_id == "all") echo "selected";?>selected > -- All --</option>
								<?
									$sql_user = "select  user_id,name,sname from tbl_user where status_user = 'y'  and user_id not in ('75','59','75','76','72','69','136') order by name";
									$rs_user = mysqli_query($conn,$sql_user);
									while($c = mysqli_fetch_array($rs_user)){
								?>
										<option value="<?=$c["user_id"]?>" <? if($user_id==$c["user_id"]) echo "selected";?>><?=$c["name"]."  ".$c["sname"]?></option>
								<? } ?>

      <? if($_SESSION["Uid"]=="98" || $_SESSION["Uid"]=="1" || $_SESSION["User_id"] == "102" || $_SESSION["User_id"] == "186" || $_SESSION["User_id"] == "187"){ ?>
				<option value = '136'>Bizserv Solution</option>
      <? } ?>
	<? } else { ?>
				<option value="" ><?=iconv( 'UTF-8', 'TIS-620', "เลือก")?></option>
				<option value="259" <? if($user_id=="259") echo "selected"; ?>><?=iconv( 'UTF-8', 'TIS-620', "ของดีส่งให้ช่าง")?></option>
				<option value="260" <? if($user_id=="260") echo "selected"; ?>><?=iconv( 'UTF-8', 'TIS-620', "ของเสียช่างส่งเข้าสต็อก")?></option>
				<option value="261" <? if($user_id=="261") echo "selected"; ?>><?=iconv( 'UTF-8', 'TIS-620', "รื้อถอน")?></option>
	<? } ?>
</select>
								&nbsp;
						</td>
					   <td><a href="javascript:history.back(1)" ><img src="image/cancel.jpg" alt="Cancel" width="20" height="18" border="0" align="left" /> </a> </td>
					   <td align="left"><nobr><b> Back</b>     </td>
					 </tr>
                </table>
               <table width="100%" border="0" align="center" class="mytable" id="table7"  cellpadding="1" cellspacing="1">
		  <?/*?>
				   <tr>
					 <td colspan=7>
						  <select name="status_hw" id="status_hw"  onchange="gethw(this)" style="width:90pt"  >
										<option value="r">Repair</option>
										<option value="a">Active</option>


								</select>
						   <input type="submit" value="Change" onclick="return confirm('Confirm to change');">
					 </td>
				   </tr>
				   <tr>
		     <?*/?>
					  <!--th align="center" height="20" width="5%" class="th"><input type="checkbox" id="selecctall"/></th-->
                      <th align="center" height="20" width="5%" class="th">#</th>
                      <th align="center" height="20" width="15%" class="th"">Name</th>
                      <th align="center" height="20" width="20%" class="th"">Hardware</th>
                      <th align="center" height="20" width="10%" class="th"">Serial no.</th>
					  <!--th align="center" height="20" width="10%" class="th"">Date From Strock</th-->
                      <th align="center" height="20" width="10%" class="th"">Business</th>
                      <th align="center" height="20" width="10%" class="th"">From Site</th>
                      <th align="center" height="20" width="10%" class="th"">Status</th>
                      <th align="center" height="20" width="15%" class="th"">Last Update</th>
                      <th align="center" height="20" width="15%" class="th"">From User</th>
                    </tr>
					<? $i = 1;	while($c = mysqli_fetch_array($rs)) {	 ?>
					<tr onmouseover="this.style.backgroundColor='violet';" onmouseout="this.style.backgroundColor='white';" >
			<? /* td align="center" height="20" style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;" ><input class="checkbox1" type="checkbox" name="check[]" id="check<?=$i?>" value="<?=$c["id"]?>"></td */ ?>
			<td align="center" height="20" style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;" >
<a lang="hw.onhand.entry.php?id=<?=$c['id']?>" class="thickbox pointer"><?=$i?></a></td>
			<td height="20" style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;">
<a lang="hw.onhand.entry.php?id=<?=$c['id']?>" class="thickbox pointer"><?=$c["name"]."  ".$c["sname"]?></a></td>
			<td  style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;">
<a lang="hw.onhand.entry.php?id=<?=$c['id']?>" class="thickbox pointer"><?=$c["cate_name"]. "  (". $c["hardware_brand"]. "  )";?></a></td>
			<td align="center" style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;" >
<a lang="hw.onhand.entry.php?id=<?=$c['id']?>" class="thickbox pointer"><?=$c["hardware_no"]?></a></td>

			<td align="center" style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;">
				<a lang="hw.onhand.entry.php?id=<?=$c["id"]?>" class="thickbox pointer"><?=$c["bussinessname"]?></a></td>
			<td align="center" style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;">
<a lang="hw.onhand.entry.php?id=<?=$c['id']?>" class="thickbox pointer"><?=$c["from_site_id"]?></a></td>
						  <!--td align="center" style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;">
						  <a lang="hw.onhand.entry.php?id=<?=$c["id"]?>" class="thickbox pointer"><? if($c["hardware_status"]=="o") echo "On hand";?></a></td-->
      <td align="center" style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;">
        <?
        if($c["hardware_status"]=="b") { echo "Lend"; }
        if($c["hardware_status"]=="o") { echo "On hand"; }
        if($c["hardware_status"]=="a") { echo "Active"; }
        if($c["hardware_status"]=="r") { echo "Repair"; }
        ?>
      </td>
						  <td align="center" style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;"><a lang="hw.onhand.entry.php?id=<?=$c["id"]?>" class="thickbox pointer"><? echo $c["changedatetime"]?></a></td>
						  <td align="center" style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;"><a lang="hw.onhand.entry.php?id=<?=$c["id"]?>" class="thickbox pointer"><? echo $c["name"]." ".$c["sname"];?></a></td>
        	</tr>
					<? $i++; } ?>
                </table>
            </td></tr></table>
</table>
</form>
