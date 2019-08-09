<?
header("Content-Type: text/html; charset=tis-620");
header("content-type: application/x-javascript; charset=TIS-620");   
session_start();
require_once("function.php");

if(!checkUser()){    echo Message(35,"red","ข้อความเตือน","คุณไม่มีสิทธิ์ใช้หน้านี้","<a href='index.php?link=check.serial.no'> กลับ </a>");
   exit;
}
include("header.php");        
$shctxt = trim($_REQUEST["shctxt"]);
if($shctxt!=""){
$sql = "SELECT
	tbl_hardware_onhand_user.id,
	tbl_hardware_onhand_user.hardware_brand,
	tbl_category_hardware.cate_name,
	tbl_hardware_onhand_user.hardware_no,
	tbl_site.site_id,
	tbl_site.site_name,
	tbl_hardware_onhand_user.hardware_status,
	tbl_user.name,
	tbl_user.sname
	FROM
	tbl_hardware_onhand_user
	Inner Join tbl_category_hardware ON tbl_category_hardware.cate_id = tbl_hardware_onhand_user.cate_id
	Left Join tbl_site ON tbl_hardware_onhand_user.user_id = tbl_site.site_id
	Left Join tbl_user ON tbl_hardware_onhand_user.user_id = tbl_user.user_id
	where tbl_hardware_onhand_user.hardware_no like '%$shctxt%'";
//echo $sql;
$rs = mysqli_query($conn,$sql);
}
?>

<meta http-equiv=Content-Type content="text/html; charset=tis-620">
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
<form  method="post" name="form1" id="form1" > 
<table width="100%" align="center" class="mytable" id="table" height="100%"   cellpadding="1" cellspacing="1">
    <tr>                                               
        <td valign="top">                                                       
                <table width="100%"  border="0" cellpadding="0" cellspacing="0" class="mytable" border="1" bordercolor="#FF0000">
					  <tr>
       					<td width="90%" colspan="2" align="center">
                           <select>
                                <? $sql_user = "select user_id,name,sname from tbl_user order by name";
                                    $rs_user = mysqli_query($conn,$sql_user);
                                    while($c_user=mysqli_fetch_array($rs_user)){
                                ?>
                                        <option <?echo $c_user["user_id"];?>><?echo $c_user["name"]." ".$c_user["sname"]?></option>
                                <?}?>
                           </select>
                            Serial no : <input class="form-control"  type="text" name="shctxt" id="shctxt" style="width:150pt" value="<?=$shctxt?>" /> 
					  <input class="form-control"  type="button" value="Search" id="bntsch" name="bntsch" onclick="Search_Click(shctxt.value)" />
						</td>					  
					 </tr>
                </table>
               <table width="100%" border="0" align="center" class="mytable" id="table7"  cellpadding="1" cellspacing="1">
				   <tr>
                      <th align="center" height="20" width="15%" class="th">Brand</th>
                      <th align="center" height="20" width="25%" class="th"">Name</th>
                      <th align="center" height="20" width="15%" class="th"">Serial no.</th>
					  <th align="center" height="20" width="15%" class="th"">Status</th>
                      <th align="center" height="20" width="30%" class="th"">At</th>
                    </tr>
					<? $i = 1;	while($c = @mysqli_fetch_array($rs)) {
					$at = "";
					 if($c["site_name"]==""){
					 		$at = $c["name"]."  ".$c["sname"];
					 } else {
					     	$at = $c["site_name"];
					 }
					 
					 ?>
					<tr onmouseover="this.style.backgroundColor='violet';" onmouseout="this.style.backgroundColor='white';" >
						  <td  style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;"><a lang="hw.expose.form.php?id=<?=$c["id"]?>" class="thickbox pointer"><?=$c["cate_name"]. "  (". $c["hardware_brand"]. "  )";?></a></td>
						  <td align="left" style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;" ><a lang="hw.expose.form.php?id=<?=$c["id"]?>" class="thickbox pointer">&nbsp;&nbsp;<?=$c["cate_name"]?></a></td>
						  <td align="center" style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;"><a lang="hw.expose.form.php?id=<?=$c["id"]?>" class="thickbox pointer"><?=$c["hardware_no"]?></a></td>
						  <td align="center" style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;"><a lang="hw.expose.form.php?id=<?=$c["id"]?>" class="thickbox pointer"><? if($c["hardware_status"]=="w") {echo "������ʶҹ�"; } else  if($c["hardware_status"]=="w") { echo "�������ͪ�ҧ";} else { echo "���ԡ"; }?></a></td>  
						  <td align="left" style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;"><a lang="hw.expose.form.php?id=<?=$c["id"]?>" class="thickbox pointer">&nbsp;&nbsp;&nbsp;<?=$c["site_id"]."  ".$at?></a></td>
					</tr>
					<? $i++; } ?>	
                </table>
            </form></td></tr></table>

<script type="text/javascript"> 

	function Search_Click(txt) {
		 document.location.href ="check.serial.no.php?shctxt="+txt;
      }
	
	
</script> 


