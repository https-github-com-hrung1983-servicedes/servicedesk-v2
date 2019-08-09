<?
header("Content-Type: text/html; charset=tis-620");
session_start();
require_once("function.php");
  if(!checkUser()){    echo Message(35,"red",$titel1,$msg1,"<a href='index.php?link=hw.waitrepair.form'> $login </a>");
  exit;
  }
$id = $_REQUEST["id"];
$type=$_REQUEST["type"];

$sql = "SELECT
						tbl_hardware_onhand_user.id,
						tbl_hardware_onhand_user.cate_id,
						tbl_hardware_onhand_user.hardware_brand,
						tbl_hardware_onhand_user.user_id,
						tbl_category_hardware.cate_name,
						tbl_hardware_onhand_user.hardware_no,
						tbl_hardware_onhand_user.dte_tme_entry_stock,
						year(tbl_hardware_onhand_user.dte_tme_entry_stock) as year_dte_tme_entry_stock,
						month(tbl_hardware_onhand_user.dte_tme_entry_stock) as month_dte_tme_entry_stock,
						day(tbl_hardware_onhand_user.dte_tme_entry_stock) as day_dte_tme_entry_stock,
						tbl_hardware_onhand_user.hardware_status,
						tbl_hardware_onhand_user.installation_date,
						tbl_hardware_onhand_user.expired_date,
						tbl_hardware_onhand_user.hardware_type,
						tbl_hardware_onhand_user.warranty_hardware_type_date,
						tbl_hardware_onhand_user.expired_hardware_type_date,
						tbl_hardware_onhand_user.license_windows_no,
						tbl_hardware_onhand_user.sparepartfor
					FROM
						tbl_hardware_onhand_user
						Inner Join tbl_category_hardware ON tbl_category_hardware.cate_id = tbl_hardware_onhand_user.cate_id
						 where tbl_hardware_onhand_user.id = '$id'"; //echo $sql;
	$rs = mysqli_query($conn,$sql);
	 $c = mysqli_fetch_array($rs);
$dte_tme_entry_stock=str_replace("/", "-", $c["dte_tme_entry_stock"]);
$installation_date=str_replace("/", "-", $c["installation_date"]);
$expired_date=str_replace("/", "-", $c["expired_date"]);
$warranty_hardware_type_date=str_replace("/", "-", $c["warranty_hardware_type_date"]);
$expired_hardware_type_date=str_replace("/", "-", $c["expired_hardware_type_date"]);

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
				var id_rep = $("#id_rep").attr('value');
				var cate_id = encodeURIComponent($("#cate_id").attr('value'));
				var hardware_brand = $("#hardware_brand").attr('value');
				var serialno = $("#serialno").attr('value');
				var status_hwxxx = $("#status_hwxxx").attr('value');// status_hw
	 			var SendTo = $("#SendTo").attr('value');
				var comment_repair = $("#comment_repair").attr('value');
				var user_repair = $("#user_repair").attr('value');

				var dte_tme_install = $("#dte_tme_install").attr('value');
				var dte_tme_expired = $("#dte_tme_expired").attr('value');
				var dte_tme_warranty = $("#dte_tme_warranty").attr('value');
				var dte_tme_expired_warranty = $("#dte_tme_expired_warranty").attr('value');
				var status_deal = $("#status_deal").attr('value');
				var license_windows_no = $("#license_windows_no").attr('value');
				var sparepartfor = $("#sparepartfor").attr('value');

			$.post('function.execute.php',{ mode : "hw.waitrepair", id_rep: id_rep,cate_id:cate_id,serialno : serialno,status_hw :status_hwxxx,
			       comment_repair :comment_repair, user_repair : user_repair, SendTo : SendTo ,dte_tme_install : dte_tme_install,dte_tme_expired : dte_tme_expired,
			       dte_tme_warranty : dte_tme_warranty,dte_tme_expired_warranty : dte_tme_expired_warranty,status_deal : status_deal ,hardware_brand : hardware_brand,license_windows_no:license_windows_no
			       ,sparepartfor:sparepartfor},
			function(data) {
			//alert(data);
					window.parent.location.href ="hw.waitrepair.list.php?id="+Math.random(100*1000,1000/2);
				});
			return false;
		});

	//$("#Delete").click(function(){
	//	var answer = confirm("Are you sure you want to delete this serial no.?");
	//		if (answer !=0) {
	//			var id_rep = $("#id_rep").attr('value');
	//			var serialno = $("#serialno").attr('value');
	//		$.post('function.execute.php',{ mode : "hw.delete.serialno", id_rep : id_rep,serialno : serialno},
	//		function(data) {
	//				alert("Delete complete.");
	//				window.parent.location.href ="hw.waitrepair.list.php?id="+Math.random(100*1000,1000/2);
	//			});
	//		return false;
	//		}
	//	});
</script>

<table align="center" class="mytable" id="table" height="70%"   cellpadding="1" cellspacing="1">
    <tr>
        <td valign="top" align="center">
            <form action="#"  method="post"  name="form1" id="form1"  >
			<input  type="hidden" value="<?=$id?>" name="id_rep" id="id_rep" />
                <table border="0" cellpadding="0" cellspacing="0" class="mytable" border="1"  bordercolor="#FF0000">

                    <tr>
                        <td bgcolor="white" width="95%" align="right" colspan="2" >
				<input name="Save" id="Save"  type="image" src="image/save.jpg" alt="Save" align="right" width="20" height="20" />  </td>
                       <td align="left" bgcolor="white" width="10%"><b>Save</b>
			</td>
			<td bgcolor="white" align="right">
			<!--input name="Delete" id="Delete"  type="image" src="image/delete.gif" alt="Delete" align="right" width="20" height="20" /-->    </td>
                       <td align="left" bgcolor="white" width="10%"><!--b>Delete</b--->    </td>
                     </tr>
					 <tr>
                      <td height="25" bgcolor="white" width="30%" align="left" class="fontBblue" >&nbsp;&nbsp;<nobr>Category Hardware  :  </td>
                      <td height="25" bgcolor="white" width="70%" align="left" class="fontBblue" colspan="4" >
					  <select name="cate_id" id="cate_id" style="width:250pt" onchange="gethw(this)">
<?
$sql_cate = "select cate_id,cate_name  from tbl_category_hardware  where cate_id not in ('15','39','40','42','43','44','49','50','51','52','54','55','56','57','58','59','26') order by cate_name ";
							$rs_cate = mysqli_query($conn,$sql_cate);
 while ($c_cate = mysqli_fetch_array($rs_cate)) { ?>
					  		<option value="<?=$c_cate["cate_id"]?>"  <? if($c_cate["cate_id"]==$c["cate_id"]) echo "selected";?>>    <?=$c_cate["cate_name"]?>    </option>
					<? } ?>

					  </select>
						</td>
                    </tr>
					<tr>
                      <td height="25" bgcolor="white" width="30%" align="left" class="fontBblue" >&nbsp;&nbsp;Brand.  :  </td>
                      <td height="25" bgcolor="white" width="70%" align="left" class="fontBblue" colspan="4" >
					 <select name="hardware_brand" id="hardware_brand" style="width:250pt" >

								   <option value="na" <? if($c["hardware_brand"]=="na") echo "selected"?>>N/A</option>
                                   <option value="IEI" <? if($c["hardware_brand"]=="IEI") echo "selected"?>>IEI</option>
                                   <option value="Unicon" <? if($c["hardware_brand"]=="Unicon") echo "selected"?>>Unicon</option>
                                   <option value="Tank-800" <? if($c["hardware_brand"]=="Tank-800") echo "selected"?>>Tank-800</option>
                                   <option value="TM-U220B" <? if($c["hardware_brand"]=="TM-U220B") echo "selected"?>>TM-U220B</option>
                                   <option value="TM-T70" <? if($c["hardware_brand"]=="TM-T70") echo "selected"?>>TM-T70</option>
                                   <option value="Monitor" <? if($c["hardware_brand"]=="Monitor") echo "selected"?>>Monitor</option>
                                   <option value="Router" <? if($c["hardware_brand"]=="Router") echo "selected"?>>Router</option>
                                   <option value="Printer" <? if($c["hardware_brand"]=="Printer") echo "selected"?>>Printer</option>
                                   <option value="BO-NGV" <? if($c["hardware_brand"]=="BO-NGV") echo "selected"?>>BO-NGV</option>
                                   <option value="POS-NGV" <? if($c["hardware_brand"]=="POS-NGV") echo "selected"?>>POS-NGV</option>
                                   <option value="BO-OIL" <? if($c["hardware_brand"]=="BO-OIL") echo "selected"?>>BO-OIL</option>
                                   <option value="Pos-OIL" <? if($c["hardware_brand"]=="Pos-OIL") echo "selected"?>>Pos-OIL</option>
                             </select>
						</td>
					</tr>
					<tr>
                      <td height="25" bgcolor="white" width="30%" align="left" class="fontBblue" >&nbsp;&nbsp;Serial No.  :  </td>
                      <td height="25" bgcolor="white" width="70%" align="left" class="fontBblue" colspan="4" >
				 <input name="serialno" id="serialno" style="width:250pt" value="<?=$c["hardware_no"]?>" readonly="readonly" >
</td>
					</tr>
<script>
  //$("#license_windows_nox").hide();
  function gethw(str){
      var cmd = str.value;
            if(cmd=="1" || cmd=="53" || cmd=="70"){
                $("#license_windows_nox").show();
            }else{
                 $("#license_windows_nox").hide();
            }
  }

</script>
	<? if($c["cate_id"]=="1" || $c["cate_id"]=="53" || $c["cate_id"]=="70") { ?>		
		<tr id="license_windows_nox">
		  <td height="25" bgcolor="white" width="30%" align="left" class="fontBblue" >&nbsp;&nbsp;<nobr><?=iconv('UTF-8','TIS-620',"License Windows");?> :  </td>
		  <td height="25" bgcolor="white" width="70%" align="left" class="fontBblue" colspan="2" >
			 <input type="text" name="license_windows_no" id="license_windows_no" value="<?=$c["license_windows_no"]?>" style="width:250pt" >
			 </td>
                </tr>					
	<? } ?>			
					
					<tr>
                      			<td height="25" bgcolor="white" width="30%" align="left" class="fontBblue" >&nbsp;&nbsp;Form Stock  :  </td>
                      			<td height="25" bgcolor="white" width="70%" align="left" class="fontBblue" colspan="4" >
								<input type="date" name="dte_tme_warranty" id="dte_tme_warranty"  readonly  value="<?=date ("Y-m-d", strtotime($dte_tme_entry_stock))?>" style="width:250pt"  >
						</td>
                    </tr>

					<tr>
                      			<td height="25" bgcolor="white" width="30%" align="left" class="fontBblue" >&nbsp;&nbsp;Install Date  :  </td>
                      			<td height="25" bgcolor="white" width="70%" align="left" class="fontBblue" colspan="2" >
					  			<input type="date" name="dte_tme_install" id="dte_tme_install"  value="<?=date ("Y-m-d", strtotime($installation_date))?>" style="width:250pt"  >
						</td>
                    </tr>
					<tr>
                      			<td height="25" bgcolor="white" width="30%" align="left" class="fontBblue" >&nbsp;&nbsp;Expired Date  :  </td>
                      			<td height="25" bgcolor="white" width="70%" align="left" class="fontBblue" colspan="2" >
					  			<input type="date" name="dte_tme_expired" id="dte_tme_expired"  value="<?=date ("Y-m-d", strtotime($expired_date))?>" style="width:250pt"  >
						</td>
                    </tr>
					<tr>
                      			<td height="25" bgcolor="white" width="30%" align="left" class="fontBblue" >&nbsp;&nbsp;Warranty Date  :  </td>
                      			<td height="25" bgcolor="white" width="70%" align="left" class="fontBblue" colspan="2" >
					  			<input type="date" name="dte_tme_warranty" id="dte_tme_warranty"  value="<?=date ("Y-m-d", strtotime($warranty_hardware_type_date))?>" style="width:250pt"  >
						</td>
                    </tr>
					<tr>
                      			<td height="25" bgcolor="white" width="30%" align="left" class="fontBblue" ><nobr>&nbsp;&nbsp;Expired Warranty Date  :  </td>
                      			<td height="25" bgcolor="white" width="70%" align="left" class="fontBblue" colspan="2" >
					  			<input type="date" name="dte_tme_expired_warranty" id="dte_tme_expired_warranty"  value="<?=date ("Y-m-d", strtotime($expired_hardware_type_date))?>" style="width:250pt">
						</td>
                    </tr>
		    <!--tr>
                      			<td height="25" bgcolor="white" width="30%" align="left" class="fontBblue" >&nbsp;&nbsp;Status  Dealing :  </td>
                      			<td height="25" bgcolor="white" width="70%" align="left" class="fontBblue" colspan="2" >
					  			<select name="status_deal" id="status_deal" readonly="readonly"  style="width:250pt"  >
										<option value="R"  selected="selected">Lease</option>
										<option value="B">Buy</option>
								</select>
								</td>
                    </tr-->




		<tr>
                      			<td height="25" bgcolor="white" width="30%" align="left" class="fontBblue" >&nbsp;&nbsp;Status  :  </td>
                      			<td height="25" bgcolor="white" width="70%" align="left" class="fontBblue" colspan="4" >
					  			<select name="status_hwxxx" id="status_hwxxx"   style="width:250pt"  >
										<option value="r">Repair</option>
										<option value="i" >Discard</option>
										<option value="a" selected>Active</option>
										<option value="l">Lose And Found</option>
								</select>
								</td>
                    </tr>

	<? if($_SESSION["Ustate"] ==  "admin") { ?>
		<tr>
                      			<td height="25" bgcolor="white" width="30%" align="left" class="fontBblue" >&nbsp;&nbsp;Send To (Repair)  :  </td>
                      			<td height="25" bgcolor="white" width="70%" align="left" class="fontBblue" colspan="4" >
					  			<select name="SendTo" id="SendTo"   style="width:250pt"  >
												<option value="136">BSS</option>
												<option value="129">MSI</option>
												<option value="99">BSS(Ricoh)</option>
												<option value="132">BSS(Bhomthai)</option>
												<option value="133">BSS(Chawpaya)</option>
												<option value="134">BSS(Nimble)</option>
												<option value="135">BSS(SNS)</option>
												<option value="102">BSS(Kamphol)</option>
												<option value="252">NavaDC</option>
												<option value="254">The Sun</option>
												<option value="262">Identify RFID</option>
												<option value="263">PASS</option>
												<option value="264">Wireless Teck</option>
												
								</select>
								</td>
                    </tr>
		<!--tr>
                      			<td height="25" bgcolor="white" width="30%" align="left" class="fontBblue" >&nbsp;&nbsp;SparePart For  :  </td>
                      			<td height="25" bgcolor="white" width="70%" align="left" class="fontBblue" colspan="4" >
					    <select name="sparepartfor" id="sparepartfor"   style="width:250pt"  >
						<?// $sql_sparepartfor = "SELECT customer_id,customer_name FROM tbl_customer Order by customer_name";
						  // $rs_sparepartfor = mysql_query($sql_sparepartfor);
						  // while($c_sparepartfor = mysql_fetch_array($rs_sparepartfor)){
						?>		    
						    <option value="<?//=$c_sparepartfor["customer_id"]?>" <?// if($c_sparepartfor["customer_id"]==$c["sparepartfor"]) echo "selected";?> ><?//=$c_sparepartfor["customer_name"]?></option>
						<?//}?>
					</select></td>
                    </tr-->
		
	<? } ?>

					<tr><td height="25" bgcolor="white" width="30%" align="left" class="fontBblue" valign="top" >&nbsp;&nbsp;Comment : </td>
					<td height="25" bgcolor="white" width="30%" align="left" class="fontBblue" colspan="4" >
					<textarea id="comment_repair" name="comment_repair" cols="49" rows="10"></textarea></td></tr>
		    <!--tr><td height="25" bgcolor="white" width="30%" align="left" class="fontBblue" >&nbsp;&nbsp;Repair by :</td>
					<td height="25" bgcolor="white" width="30%" align="left" class="fontBblue" colspan="4" >
					<select name="user_repair" id="user_repair">
						    <option value="BSS">BSS</option>
						    <option value="MSI">MSI</option>
						    <option value="Ricoh">BSS(Ricoh)</option>
						    <option value="Bhomthai">BSS(Bhomthai)</option>
						    <option value="Chawpaya">BSS(Chawpaya)</option>
						    <option value="Nimble">BSS(Nimble)</option>
						    <option value="SNS">BSS(SNS)</option>
					</select></td></tr-->
                </table>
            </form></td></tr></table>
