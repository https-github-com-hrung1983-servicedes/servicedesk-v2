<?
session_start();
header("Content-Type: text/html; charset=tis-620");

require_once("function.php");

  if(!checkUser()){    echo Message(35,"red",$titel1,$msg1,"<a href='index.php?link=insert.sn4pm'> $login </a>");
  exit;
  }

include("header.php");

	$siteid = trim($_REQUEST["item"]);//"S000342";//
	$cate_id = $_REQUEST["cate_id"];
//if($cate_id==""){
//	$cate_id = "1";
//}
//insert.sn4pm.execute.php
$start_pm_month ='07' // =>07/2015
?>

<title>Bizserv Solution Co.,Ltd</title>
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
	#country-list{position: absolute;list-style:none;margin:0;padding:0;width:400px;cursor:pointer;}
    #country-list li{padding: 5px; background:#99CCFF;border-bottom:#F0F0F0 1px solid;}
    #country-list li:hover{background:#99D6FF;}
    #search-box{border: #F0F0F0 1px solid;width:400px;}

</style>
<link href="css/loading.css" rel="stylesheet" type="text/css" media="all">

<script src="script/jquery.min.js"></script>
<script src="script/thickbox.js"></script>
<script src="script/loading.js"></script>

<script type="text/javascript" src="script/jquery-1.6.4.js"></script>
<script type="text/javascript" src="script/jquery_1.7.1_min.js"></script>
<script>
	$("#Save").click(function(){
			alert('adfasdfxxxxxxxx');
				//var sn_old = encodeURIComponent($("#sn_old").attr('value'));
				//var sn_new = encodeURIComponent($("#sn_new").attr('value'));
				//var site_id = encodeURIComponent($("#site_id").attr('value'));
				//var cate_id = encodeURIComponent($("#cate_id").attr('value'));
				//var sn = encodeURIComponent($("#sn").attr('value'));
			//$.post('insert.sn4pm.execute.php',{
		//sn_old: sn_old,sn_new:sn_new,site_id : site_id,cate_id:cate_id,sn:sn},

		//	function(data) {
		//	alert(data);
			//		window.parent.location.href ="insert.sn4pm.php";
		//		});
		//	return false;
		});

	//alert('adfasdf');
</script>

 <form id = "form1" name = "form1" method="post" action="insert.sn4pm.execute.php">
        <table align="center" bordercolor="#000000" class="mytable"  border="0" width="60%">
		<tr>
			<td style="width:'99%'; text-align: center;" >
<!---------------------------------------------------------------------------------------------------------------------------------------------------------->
		  <select name="lmName1" OnChange="window.location='?item='+this.value;" style="width: 400px;">
			<option value=""><-- Select Item --></option>
			<?php
			$uat=$_SESSION["Uat"];
			$strSQL = "Select distinct
						tbl_log_call_center.site_id,
						tbl_site.site_name
						From tbl_log_call_center
						Inner Join tbl_category_type ON tbl_log_call_center.category_type = tbl_category_type.category_id
						Left Join tbl_user u1 ON tbl_log_call_center.reciept_job_bss = u1.user_id
						Left Join tbl_user u2 ON tbl_log_call_center.reciept_job_user_id = u2.user_id
						Inner Join tbl_site ON tbl_log_call_center.site_id = tbl_site.site_id
						Where
						tbl_log_call_center.status_call ='feedback'
						and tbl_log_call_center.category_type in ('12','19')
						and tbl_log_call_center.type_service = '$uat'
						order by  tbl_log_call_center.site_id";
			$objQuery = mysqli_query($conn,$strSQL);
			while($objResult = mysqli_fetch_array($objQuery))
			{
				if($_GET["item"] == $objResult["site_id"])
				{
					$sel = "selected";
				}
				else
				{
					$sel = "";
				}
			?>
			<option value="<?php echo $objResult["site_id"];?>" <? if($objResult["site_id"]==$siteid) echo "selected";?>><?=$objResult["site_id"]?> : <?=$objResult["site_name"];?></option>
			<?php
			}
			?>
		  </select>


<input class="form-control"  type="hidden" name="site_id" type="site_id" value="<?=$siteid?>">
<!---------------------------------------------------------------------------------------------------------------------------------------------------------->
			</td>
			<td><nobr>
			</td><td>
				<input class="form-control"  name="Submit" id="Save"  type="image" src="image/save.jpg" alt="Save" align="right" width="20" height="20" />
			</td>
<td><b>Save</b></td>
	</tr>
<tr>
<td colspan=4>
<?
	//$sql = "SELECT
//tbl_hardware_onhand_user.id,
//tbl_hardware_onhand_user.user_id,
//tbl_hardware_onhand_user.cate_id,
//tbl_hardware_onhand_user.hardware_no,
//tbl_site.site_name
//FROM
//tbl_hardware_onhand_user
//Left Join tbl_site ON tbl_hardware_onhand_user.user_id = tbl_site.site_id
//Where tbl_hardware_onhand_user.user_id='$siteid' And tbl_hardware_onhand_user.hardware_status = 'w' And tbl_hardware_onhand_user.cate_id in //('1','2','3','4','6','7','8','9','10','11','12','13','14','36','37','31','32','33','34','25','30','27','45','16','60','61','62','63'
//,'64','65','66','67','68','20','22','18','19')";

//echo $sql;
$sql_site = "select site_id,site_name from tbl_site where site_id = '$siteid'";//echo $sql_site;
	$rc = mysqli_query($conn,$sql_site);
	$c = mysqli_fetch_array($rc);
$cnt_job = checkjob($siteid,$cate_id,$_SESSION["Uat"]);//echo $cnt_job;
if($cnt_job==1){
	echo "<center><BLINK><font size='+3' color='red'>".iconv('UTF-8','TIS-620','สถานีนี้ทำ PM แล้ว')."</font></BLINK></center>";
}
?>
<? if($cnt_job==0) {
	if($siteid!='') {
?>

	<table align="center" bordercolor="#000000" class="mytable"  border="0" width="60%">
		<tr>
			<th class="th" width="10%" style="padding:0px; border-bottom:1px solid #ccc; border-right:0px solid #ccc;">#</th>
			<th class="th" width="40%" style="padding:0px; border-bottom:1px solid #ccc; border-right:0px solid #ccc;">Category Name</th>
			<th class="th" width="20%" style="padding:0px; border-bottom:1px solid #ccc; border-right:0px solid #ccc;">Current SN.</th>
			<th class="th" width="30%" style="padding:0px; border-bottom:1px solid #ccc; border-right:0px solid #ccc;">New SN.</th>
		</tr>
              <?
		$sql_cate = "
		SELECT distinct cate_id,cate_name
		FROM tbl_category_hardware
		WHERE
		cate_id in
		('1','2','3','4','6','7','8','9','10','11','12','13','14','36','37','31','32','33','34','25','30','27','45','16','60','61','62','63'
		,'64','65','66','67','68','20','22','18','19','69','70')   order by cate_name"; //echo $sql_cate;
		$c_col = mysqli_query($conn,$sql_cate);
		$row1 = 1;
		$i=0;
			      while($rs_col = mysqli_fetch_array($c_col)){
						$i++;
						$cate_id=$rs_col['cate_id'];

						$sql_onhand_user = "SELECT * FROM tbl_hardware_onhand_user WHERE user_id = '$siteid' and cate_id=$cate_id";
						$c_onhand_user = mysqli_query($sql_onhand_user);
						$rs_onhand_user = mysqli_fetch_array($c_onhand_user);
						$hardware_no=$rs_onhand_user["hardware_no"];

			      ?>
				<tr  onmouseover="this.style.backgroundColor='violet';" onmouseout="this.style.backgroundColor='white';" >
				      <td align='center'></a><?=$row1++?></td>
				      <td><?=$rs_col['cate_name']?>

					  </td>
				      <td>
						<?
						if($_GET["cate_id"] = $rs_onhand_user["cate_id"]){
									echo $hardware_no;
						}
						else {
									echo "-";
						}
						  ?>


					  </td>

					  <td>
<!---------------------------------------------------------------------------------------------------------------------------------------------------------->



<div>
<? //echo "i = $i"; ?>
<input class="form-control"  type="text" name="search-box[]" id="search-box<?=$i?>" autocomplete="off" style="width: 400px;"/>
<input class="form-control"  type="hidden" name="id-box[]" id="id-box<?=$i?>" autocomplete="off" readonly/>
<input class="form-control"  type="hidden" name="cate-id[]" id="cate-id<?=$i?>" autocomplete="off" readonly/>
<div id="suggesstion-box<?=$i?>"></div>
</div>
<script>
$(document).ready(function(){
	$("#search-box<?=$i?>").keyup(function(){
		$.ajax({
		type: "POST",
		url: "readsn.php?i=<?=$i?>&cate_id=<?=$rs_col['cate_id']?>",
		data:'keyword='+$(this).val(),
		beforeSend: function(){
			$("#search-box<?=$i?>").css("background");
		},
		success: function(data){
			$("#suggesstion-box<?=$i?>").show();
			$("#suggesstion-box<?=$i?>").html(data);
			$("#search-box<?=$i?>").css("background","#FFF");
		}
		});
	}

	);

});


function selectCountry<?=$i?>(val) {
$("#suggesstion-box<?=$i?>").hide();
var myString = val;
var mySplitResult = myString.split(":");
$("#id-box<?=$i?>").val(mySplitResult[0]);
$("#search-box<?=$i?>").val(mySplitResult[1]);
$("#cate-id<?=$i?>").val(mySplitResult[2]);
};
</script>

<!---------------------------------------------------------------------------------------------------------------------------------------------------------->




			  </td>
		</tr>
             <?} }?>
      </table>
<?} ?>
</td>
</tr>
</table>
</center>
</form>
<br>
<br>
</body>
</html>


<script type="text/javascript">
    function Search_Click(site){
   document.location.href ="insert.sn4pm.php?siteid="+site+"&id="+Math.random(100*1000,1000/2);
      }

</script>


<?
 function checkjob($site_id,$cate_id,$at){
	 global $conn;
	$sql_checkjob = " SELECT *
			  FROM tbl_log_call_center
			Where tbl_log_call_center.category_type in ('12','19')
      and tbl_log_call_center.open_call_dte like '2015%'
			And month(tbl_log_call_center.open_call_dte) >= '$start_pm_month'
			And tbl_log_call_center.site_id = '$site_id'
            And tbl_log_call_center.type_service = '$at'";
	//if($cate_id==""){
		$sql_checkjob .= " And tbl_log_call_center.status_call = 'close'";
	//}
	$rs_checkjob = mysqli_query($sql_checkjob);
	while($c_checkjob = mysqli_fetch_array($rs_checkjob)){
		$str = $c_checkjob["cnt"];
	}
return $str;
}
?>
