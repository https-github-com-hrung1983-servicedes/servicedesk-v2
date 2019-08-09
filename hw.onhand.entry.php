<?
header("Content-Type: text/html; charset=tis-620");
session_start();
require_once("function.php");
  if(!checkUser()){    echo Message(35,"red",$titel1,$msg1,"<a href='index.php?link=hw.onhand.entry'> $login </a>");
  exit;
  }
$id = $_REQUEST["id"];
$sql = "SELECT
	    tbl_hardware_onhand_user.id,
	    tbl_hardware_onhand_user.cate_id,
	    tbl_hardware_onhand_user.user_id,
	    tbl_category_hardware.cate_name,
	    tbl_hardware_onhand_user.hardware_no,
	    tbl_hardware_onhand_user.dte_tme_form_stock,
	    tbl_hardware_onhand_user.dte_tme_form_pump,
	    tbl_hardware_onhand_user.hardware_status,
	    tbl_hardware_onhand_user.sparepartfor
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
<link href="css/loading.css" rel="stylesheet" type="text/css" media="all">

<script src="script/jquery.min.js"></script>
<script src="script/thickbox.js"></script>
<script src="script/loading.js"></script>

<script type="text/javascript" src="script/jquery-1.6.4.js"></script>
<script type="text/javascript" src="script/jquery_1.7.1_min.js"></script>
<script>



	$("#Save").click(function(){
				var id_sn = $("#id_sn").attr('value');
				var user_id = $("#user_id").attr('value');
				var cate_id = encodeURIComponent($("#cate_id").attr('value'));
				var serialno = $("#serialno").attr('value');
				var dte_tme_entry_stock = $("#dte_tme_entry_stock").attr('value');
				var status_hw = encodeURIComponent($("#status_hw2").attr('value'));
				var user_new = "";

				if(status_hw=="o" || status_hw=="b" || status_hw=="r"){
					user_new = $("#user_new2").attr('value');
				}
				//alert(user_new2);
				$.post('function.execute.php',{ mode : "hw.onhand.user",id_sn : id_sn,user_id : user_id, cate_id  : cate_id , serialno : serialno ,dte_tme_entry_stock : dte_tme_entry_stock, status_hw :  status_hw,user_new : user_new},
			function(data) {

					window.parent.location.href ="hw.onhand.list.php?id="+Math.random(100*1000,1000/2);
				});
			return false;
		});


</script>
<table align="center" class="mytable" id="table" height="70%"   cellpadding="1" cellspacing="1">
    <tr>
        <td valign="top" align="center">
            <form action=".execute.php"  method="post"  name="form1" id="form1"  >
			<input class="form-control"   type="hidden" value="<?=$id?>" name="id_sn" id="id_sn" />
			<input class="form-control"   type="hidden" value="<?=$_SESSION["User_id"];?>" name="user_id" id="user_id" />
                <table border="0" cellpadding="0" cellspacing="0" class="mytable" border="1"  bordercolor="#FF0000">
                    <tr>
                        <th align="center" height="40" colspan="3" class="th">Hardware on hand</th>
                    </tr >

                    <tr>
                        <td bgcolor="white" width="95%" align="right" colspan="2" >
						<input class="form-control"  name="Save" id="Save"  type="image" src="image/save.jpg" alt="Save" align="right" width="20" height="20" />    </td>
                       <td align="left" bgcolor="white" width="10%"><b>Save</b>    </td>
                     </tr>
					 <tr>
                      <td height="25" bgcolor="white" width="30%" align="left" class="fontBblue" >&nbsp;&nbsp;Category Hardware  :  </td>
                      <td height="25" bgcolor="white" width="70%" align="left" class="fontBblue" colspan="2" >
					  <select class="form-control" name="cate_id" id="cate_id" style="width:250pt" >
					  			<option value="<?=$cate_id?>"><?=$c["cate_name"]?></option>
					  </select>
						</td>
                    </tr>
					<tr>
                      <td height="25" bgcolor="white" width="30%" align="left" class="fontBblue" >&nbsp;&nbsp;Serial No.  :  </td>
                      <td height="25" bgcolor="white" width="70%" align="left" class="fontBblue" colspan="2" >
					  		<input class="form-control"  type="text" name="serialno" id="serialno" style="width:250pt" value="<?=$c["hardware_no"]?>" readonly>
						</td>
						</tr>
						<tr>
                      			<td height="25" bgcolor="white" width="30%" align="left" class="fontBblue" >&nbsp;&nbsp;Form Stock  :  </td>
                      			<td height="25" bgcolor="white" width="70%" align="left" class="fontBblue" colspan="2" >
					  			<input class="form-control"  type="text" name="dte_tme_form_stock" id="dte_tme_form_stock" readonly="readonly" value="<?=$c["dte_tme_form_stock"]?>" style="width:250pt"  >
						</td>
                    </tr>
					<tr>
                      			<td height="25" bgcolor="white" width="30%" align="left" class="fontBblue" >&nbsp;&nbsp;Form Site  :  </td>
                      			<td height="25" bgcolor="white" width="70%" align="left" class="fontBblue" colspan="2" >
					  			<input class="form-control"  type="text" name="dte_tme_form_pump" id="dte_tme_form_pump" readonly="readonly" value="<?=$c["dte_tme_form_pump"]?>" style="width:250pt"  >
						</td>
                    </tr>
					<tr>
                      			<td height="25" bgcolor="white" width="30%" align="left" class="fontBblue" >&nbsp;&nbsp;Enter Stock  :  </td>
                      			<td height="25" bgcolor="white" width="70%" align="left" class="fontBblue" colspan="2" >
					  			<input class="form-control"  type="text" name="dte_tme_entry_stock" id="dte_tme_entry_stock" readonly="readonly" value="<?=getDtetme();?>" style="width:250pt"  >
								</td>
                    </tr>
					<tr>
                      			<td height="25" bgcolor="white" width="30%" align="left" class="fontBblue" >&nbsp;&nbsp;Status  :  </td>
                      			<td height="25" bgcolor="white" width="70%" align="left" class="fontBblue" colspan="2" >
					  			<select class="form-control" name="status_hw2" id="status_hw2"  style="width:250pt"  >
										<option value="o" selected="selected">On hand</option>
										<option value="r" >Repair</option>
										<option value="a" >Active</option>
                    <option value="b" >Lend</option>
								</select>
								</td>
                    </tr>
<script>
	/*
	 $("#engineer_row").hide();
		 function gethw(str){
		 	var cmd = str.value;
					if(cmd=="o"){
					$("#engineer_row").show();
					}else{
					$("#engineer_row").hide();
					}
		 }
*/
</script>

					<tr >
                      			<td height="25" bgcolor="white" width="30%" align="left" class="fontBblue" >&nbsp;&nbsp;<nobr>Transfer H/W to  :  </td>
                      			<td height="25" bgcolor="white" width="70%" align="left" class="fontBblue" colspan="2" >
					
					  			<select class="form-control" name="user_new2" id="user_new2"  style="width:250pt"  >
								<? if($_SESSION["Ustate"]=="admin"){
									$sql_user = "select  user_id,name,sname from tbl_user where at in ('".$_SESSION['Uat']."') and status_user = 'y' and user_id not in ('66','72','76','85','86','94','99','136')  order by name";
									$rs_user = mysqli_query($conn,$sql_user);
									while($c = mysqli_fetch_array($rs_user)){
								?>
										<option value="<?=$c["user_id"]?>" <? if($user_id==$c["user_id"]) echo "selected";?>><?=$c["name"]."  ".$c["sname"]?></option>
								<? } 
								
								} else {?>
									<option value = '<?=$_SESSION["User_id"]?>'><?=$_SESSION["Uname"]." ".$_SESSION["Usname"]?></option>

                <? } if($_SESSION["Uid"]=="98" || $_SESSION["Uid"]=="1"){ ?>
          				<option value = '136'>Bizserv Solution</option>
                <? } ?>
          				<option value = '99'>Ricoh</option>
                  		<option value="129">MSI</option>
                  		<option value="259"><? echo iconv( 'UTF-8', 'TIS-620','ของดีส่งให้ช่าง' );?></option>
                  		<option value="260"><? echo iconv( 'UTF-8', 'TIS-620','ของเสียช่างส่งเข้าสต็อก' );?></option>
                  		<option value="261"><? echo iconv( 'UTF-8', 'TIS-620','รื้อถอน' );?></option>

								</select>
								</td>
                    </tr>
					<? /* tr><td height="25" width="30%" bgcolor="white" width="30%" align="left" class="fontBblue">SparePart For : </td>
					    <td height="25" width="70%" bgcolor="white" width="30%" align="left" class="fontBblue" colspan="2">
						<select class="form-control" name="sparepartfor" id="sparepartfor"   style="width:250pt"  >
						<? $sql_sparepartfor = "SELECT customer_id,customer_name FROM tbl_customer Order by customer_name";
						   $rs_sparepartfor = mysql_query($sql_sparepartfor);
						   while($c_sparepartfor = mysql_fetch_array($rs_sparepartfor)){
						?>		    
						    <option value="<?=$c_sparepartfor["customer_id"]?>" <? if($c_sparepartfor["customer_id"]==$c["sparepartfor"]) echo "selected";?> ><?=$c_sparepartfor["customer_name"]?></option>
						<?}?>
						
					    </td>
					</tr */?>
					<tr><td height="25" bgcolor="white" width="30%" align="left" class="fontBblue" colspan="3" ></td></tr>
					<tr><td height="25" bgcolor="white" width="30%" align="left" class="fontBblue" colspan="3" ></td></tr>
                </table>
            </form></td></tr></table>



























