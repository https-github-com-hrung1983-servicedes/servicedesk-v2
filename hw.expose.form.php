<?
header("Content-Type: text/html; charset=tis-620");
session_start();
require_once("function.php");
  if(!checkUser()){    echo Message(35,"red",$titel1,$msg1,"<a href='index.php?link=hw.expose.form'> $login </a>");
  exit;
  }
$id = $_REQUEST["id"];
$sql = "SELECT
						tbl_hardware_onhand_user.id,
						tbl_hardware_onhand_user.cate_id,
						tbl_hardware_onhand_user.user_id,
						tbl_category_hardware.cate_name,
						tbl_hardware_onhand_user.hardware_no,
						tbl_hardware_onhand_user.dte_tme_entry_stock,
						tbl_hardware_onhand_user.hardware_status
					FROM
						tbl_hardware_onhand_user
						Inner Join tbl_category_hardware ON tbl_category_hardware.cate_id = tbl_hardware_onhand_user.cate_id
						 where tbl_hardware_onhand_user.id = '$id'"; //echo $sql;
	$rs = mysqli_query($conn,$sql);
	 $c = mysqli_fetch_array($rs);
	 $cate_id = $c["cate_id"];
	 $hardware_no = $c["hardware_no"];
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
</style>
<script type="text/javascript" src="script/jquery-1.6.4.js"></script>
<script type="text/javascript" src="script/jquery_1.7.1_min.js"></script>

<link href="css/loading.css" rel="stylesheet" type="text/css" media="all">

<script src="script/jquery.min.js"></script>
<script src="script/thickbox.js"></script>
<script src="script/loading.js"></script>

<script type="text/javascript">
$(document).ready(function(){
	$("#Save").click(function(){
				var id_rep = $("#id_rep").attr('value');
				var user_expose = $("#user_expose").attr('value');
				var cate_id = encodeURIComponent($("#cate_id").attr('value'));
				var serialno = encodeURIComponent($("#serialno").attr('value'));
				var status_hw = encodeURIComponent($("#status_hw").attr('value'));
			$.post('function.execute.php',{ mode : "hw.expose", id_rep: id_rep,user_expose:user_expose,cate_id:cate_id,serialno : serialno,status_hw :status_hw},
			function(data) {
				//	alert(data);
					window.parent.location.href ="hw.expose.list.php?id="+Math.random(100*1000,1000/2);
				});
			return false;
		});
	//
	     $("#cnt").load("function.execute.php?mode=cnt_usage_hw&cate_id=<?=$cate_id?>&serail_no=<?=$hardware_no?>");
		//
});
</script>


<table align="center" class="mytable" id="table" height="70%"   cellpadding="1" cellspacing="1">
    <tr>
        <td valign="top" align="center">
            <form action=".execute.php"  method="post"  name="form1" id="form1"  >
			<input class="form-control"   type="hidden" value="<?=$id?>" name="id_rep" id="id_rep" />
                <table border="0" cellpadding="0" cellspacing="0" class="mytable" border="1"  bordercolor="#FF0000">
                    <tr>
                        <th align="center" height="40" colspan="3" class="th">Hardware Repairing</th>
                    </tr >

                    <tr>
                        <td bgcolor="white" width="95%" align="right" colspan="2" >
						<input class="form-control"  name="Save" id="Save"  type="image" src="image/save.jpg" alt="Save" align="right" width="20" height="20" />    </td>
                       <td align="left" bgcolor="white" width="10%"><b>Save</b>    </td>

					 <tr>
                      <td height="25" bgcolor="white" width="30%" align="left" class="fontBblue" >&nbsp;&nbsp;Category :  </td>
                      <td height="25" bgcolor="white" width="70%" align="left" class="fontBblue" colspan="2" >
					  <select name="cate_id" id="cate_id" style="width:250pt">
					  		<option value="<?=$c["cate_id"]?>" >    <?=$c["cate_name"]?>    </option>
					  </select>
						</td>
                    </tr>
					<tr>
                      <td height="25" bgcolor="white" width="30%" align="left" class="fontBblue" >&nbsp;&nbsp;Serial No.  :  </td>
                      <td height="25" bgcolor="white" width="70%" align="left" class="fontBblue" colspan="2" >
					 <input class="form-control"  type="text" name="serialno" id="serialno" style="width:250pt"  value="<?=$c["hardware_no"]?>" readonly>
						</td>
					</tr>
					<tr>
                      			<td height="25" bgcolor="white" width="30%" align="left" class="fontBblue" >&nbsp;&nbsp;Form Stock  :  </td>
                      			<td height="25" bgcolor="white" width="70%" align="left" class="fontBblue" colspan="2" >
					  			<input class="form-control"  type="text" name="dte_tme_entry_stock" id="dte_tme_entry_stock" readonly="readonly" value="<?=getDtetme()?>" style="width:250pt"  >
						</td>
                    </tr>
					<tr>
                      			<td height="25" bgcolor="white" width="30%" align="left" class="fontBblue" >&nbsp;&nbsp;Status  :  </td>
                      			<td height="25" bgcolor="white" width="70%" align="left" class="fontBblue" colspan="2" >
					  			<select name="status_hw" id="status_hw" readonly="readonly"  style="width:250pt"  >
										<option value="o" >On hand</option>
                    <option value="b" >Lend</option>
								</select>
								</td>
                    </tr>
					<tr><td height="25" bgcolor="white" width="30%" align="left" class="fontBblue" >&nbsp;&nbsp;Service by :</td>
					<td height="25" bgcolor="white" width="30%" align="left" class="fontBblue" colspan="2" >

          <select name="user_expose" id="user_expose">
            <?
              $sql_user = "select  user_id,name,sname from tbl_user where at in ('".$_SESSION['Uat']."') and status_user = 'y' and user_id not in ('72','76','85','86','94','99')  order by name";
              $rs_user = mysqli_query($conn,$sql_user);
              while($c = mysqli_fetch_array($rs_user)){
            ?>
                <option value="<?=$c["user_id"]?>" <? if($_SESSION["User_id"]==$c["user_id"]) echo "selected";?>><?=$c["name"]."  ".$c["sname"]?></option>
            <? } ?>
            <option value="129">MSI</option>
          </select>
					<tr><td height="40" bgcolor="white" width="30%" align="left" class="fontBblue" colspan="3"  >&nbsp;&nbsp;</td></tr>
                </table>
            </form></td></tr></table>
