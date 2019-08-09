<?
session_start();
header("Content-Type: text/html; charset=tis-620");

require_once("function.php");
//require_once("script/function.js");
set_time_limit(0);
  //if(!checkUser()){    echo Message(35,"red",$titel1,$msg1,"<a href='index.php?link=gen.report.sn.ngv'> $login </a>");
 // exit;
 // }

 //     echo getSerial("S200003","3");

include("header.php");
$owner_by = $_REQUEST["owner_by"];
if($owner_by=="") { $owner_by = "BSS"; }

//echo $owner_by;
?>
  <html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874">
<meta http-equiv="refresh" content="14400;"/>
<link rel="stylesheet" href="style.css">
<script language="javascript" src="script.js"></script>
   <link href="style/mytable.css" rel="stylesheet" type="text/css" />
<title>Summary S/N</title></head>
  <style type="text/css">
    <!--
   .th{ background-color:#003366; color:#FFF; padding:0px; border:0px solid #ccc; height:20px; }
    -->
</style>
<body  >
<br>
092-249-8678
<center>
 <form id = "form1" name = "form1" method="post">
        <table align="center" bordercolor="#000000" class="mytable"  border="1" width="60%">
		<!--tr>
			<td colspan=21>Owner : <select id = "owner_by" name = "owner_by" onchange="form1.submit();">
			<option value = "All" <? if($owner_by=="All") echo "selected";?>>All</option>
			<option value = "BSS" <? if($owner_by=="BSS") echo "selected";?>>BSS</option>
			<option value = "MSI" <? if($owner_by=="MSI") echo "selected";?>>MSI</option>
			</select></td>
		</tr-->
                <tr  >
                      <th width="10%" class="th" ><nobr>&nbsp;Site ID.</th>
                      <!--th width="30%" class="th" ><nobr>&nbsp;Site Name<nobr></th---->
             <?  
              $c_col = mysqli_query($conn,"SELECT cate_id,cate_name FROM tbl_category_hardware WHERE cate_id in ('206','8','16','11','60','66','73','12','61','67','13','62','68','3','4','10','6','9','36','7')  order by cate_name");
              while($rs_col = mysqli_fetch_array($c_col)){
	$str_catename = "";
		if($rs_col["cate_name"]=="Magnetic Card Reader") {
			$str_catename = "MSR/Mouse";
		} else if($rs_col["cate_name"]=="Numeric Keypad") {
			$str_catename = "Keypad/Keyboard";
		} else if($rs_col["cate_name"]=="Slip Printer") {
			$str_catename = "Printer Slip/Laser";
		} else {
			$str_catename = $rs_col["cate_name"];
		}
             ?>
                      <th class="th" ><nobr>&nbsp;<?=$str_catename;?><nobr></th>
             <?}?>
             </tr>
          <?
//          tbl_log_call_center.category_type = '12'
//and 
$sql = "SELECT DISTINCT
tbl_log_call_center.site_id
FROM
tbl_log_call_center
Inner Join tbl_site ON tbl_log_call_center.site_id = tbl_site.site_id
Where  year(tbl_log_call_center.open_call_dte) in ('2016','2017','2018') 
And tbl_log_call_center.category_type  in ('9','148','8')
And tbl_log_call_center.status_call = 'close'";

 echo $sql;
        $res = mysqli_query($conn,$sql);

           while( $row = mysqli_fetch_array($res)){
            insertSite($row["site_id"]);  
            echo"<td  style='padding:0px; border-bottom:1px solid #ccc; border-right:0px solid #ccc;'>$row[site_id]</td> ";
            echo"<td  style='padding:0px; border-bottom:1px solid #ccc; border-right:0px solid #ccc;'>&nbsp;<nobr>$row[site_name]<nobr></td> ";
            $ccate_id = mysqli_query($conn,"SELECT cate_id FROM tbl_category_hardware WHERE cate_id in ('206','8','16','11','60','66','73','12','61','67','13','62','68','3','4','10','6','9','36','7') order by cate_name");
            while($rc_cate_id = mysqli_fetch_array($ccate_id)){
		if($rc_cate_id["cate_id"]=="30") {
			$cate = "30";
		} else if($rc_cate_id["cate_id"]=="25") {
			$cate = "25";
		} else if($rc_cate_id["cate_id"]=="45") {
			$cate = "45";
		} else {
			$cate = $rc_cate_id["cate_id"];
		}


		$sn_new = updateSerial($row["site_id"],$cate);
        echo $sn_new."<br>";
             //   echo"<td>&nbsp;<nobr><a href='detail.incident.hardware.php?id=$sn_new' target='blank'>$sn_new<nobr></a></td> ";
            }
            ?>
        </tr>
        <?
             }?>

        </table>

</center>
</form>
</body>
</html>
<?
 function insertSite($site_id){
	 global $conn;
     mysql_query($conn,"insert into tbl_serail_all_ngv (SiteID) values ('$site_id')");
 }

 function updateSerial($site_id,$cate_id) {
	 global $conn;
      $sql = "SELECT
                tbl_hardware_onhand_user.hardware_no,count(tbl_hardware_onhand_user.id) as cnt
           FROM  tbl_hardware_onhand_user
            WHERE tbl_hardware_onhand_user.user_id = '$site_id'
            And tbl_hardware_onhand_user.cate_id = '$cate_id'  group by tbl_hardware_onhand_user.id";
      $rs = mysqli_query($conn,$sql);
      while($c = mysqli_fetch_array($rs)) {
	     $cnt = $c["cnt"];
                        $str = "-";
		if($cnt=="1") {
		 	$str = $c["hardware_no"];
		 }
$cate_detail= Array("206"=>"CPU","8"=>"Cashdrawer","16"=>"EnableCard","11"=>"FDM071_1","60"=>"FDM071_2","66"=>"FDM071_3","73"=>"FDM071_4",
"12"=>"FDM082_1","61"=>"FDM082_2","67"=>"FDM082_3","13"=>"FDM115_1","62"=>"FDM115_2","68"=>"FDM115_3","3"=>"MSRMouse","4"=>"KeypadKeyboard","10"=>"Savetonic",
"6"=>"Printer","9"=>"Surgeguard","36"=>"TouchScreen","7"=>"UPS");

           $sql_update = "update tbl_serail_all_ngv set $cate_detail[$cate_id]='$str' where SiteID='$site_id'";
          mysqli_query($conn,$sql_update);
      }
      return $sql_update;
 }
?>
