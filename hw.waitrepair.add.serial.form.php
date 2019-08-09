<?
header("Content-Type: text/html; charset=tis-620");
session_start();
require_once("function.php");
  if(!checkUser()){    echo Message(35,"red",$titel1,$msg1,"<a href='index.php?link=hw.waitrepair.add.serial'> $login </a>");
  exit;
  }
$type = $_REQUEST["type"];
if($type!="add"){ 
 echo Message(35,"red",$titel1,$msg1,"<a href='index.php'> $login </a>");
  exit;
}
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
				var cate_id = encodeURIComponent($("#cate_id").attr('value'));
				var hardware_brand = encodeURIComponent($("#hardware_brand").attr('value'));
				var serialno = $("#serialno").attr('value');
				var status_hw = encodeURIComponent($("#status_hw").attr('value'));
				var user_enter = $("#user_enter").attr('value');
				var dte_tme_entry_stock = $("#dte_tme_entry_stock").attr('value');
				var dte_tme_install = $("#dte_tme_install").attr('value');
				var dte_tme_expired = $("#dte_tme_expired").attr('value');
				var dte_tme_warranty = $("#dte_tme_warranty").attr('value');
				var dte_tme_expired_warranty = $("#dte_tme_expired_warranty").attr('value');
				var status_deal = $("#status_deal").attr('value');
				var owner_by_sn = encodeURIComponent($("#owner_by_sn").attr('value'));
				var buy_by = encodeURIComponent($("#buy_by").attr('value'));
				var license_windows_no = $("#license_windows_no").attr('value');				
				var sparepartfor = $("#sparepartfor").attr('value');
				var repair_by = $("#repair_by").attr('value');
				var fix_site4return = $("#fix_site4return").attr('value');
				var asset_by = $("#asset_by").attr('value');
				var bussinessname = $("#bussinessname").attr('value');

			$.post('function.execute.php',{ mode : "hw.waitrepair.add.serial.form", cate_id: cate_id ,hardware_brand: hardware_brand,serialno:serialno,status_hw : status_hw,user_enter :user_enter,
			       dte_tme_entry_stock : dte_tme_entry_stock, owner_by_sn : owner_by_sn ,dte_tme_install : dte_tme_install,dte_tme_expired : dte_tme_expired,
			       status_deal : status_deal,dte_tme_warranty : dte_tme_warranty,dte_tme_expired_warranty : dte_tme_expired_warranty,buy_by:buy_by,
			       license_windows_no:license_windows_no,sparepartfor:sparepartfor,repair_by:repair_by,fix_site4return:fix_site4return,asset_by:asset_by,
			  bussinessname:bussinessname},
			function(data) {
			// alert(data);
			if(data==""){
								window.parent.location.href ="hw.waitrepair.list.php?id="+Math.random(100*1000,1000/2);
								} else {
									alert("Serial No. มีในระบบแล้ว");
								}
				});
			return false;
		});


</script>



<script language="javascript">
function getKey(){
               if (event.keyCode == 32 || event.keyCode == 95){
                     event.returnValue = false;
                   }
       }
</script>

<table align="center" class="mytable" id="table" height="70%"   cellpadding="1" cellspacing="1">
    <tr>
        <td valign="top" align="center">
            <form action=".execute.php"  method="post"  name="form1" id="form1"  >
			<input class="form-control"   type="hidden" value="<?=$id?>" name="id_rep" id="id_rep" />
                <table border="0" cellpadding="0" cellspacing="0" class="mytable" border="1"  bordercolor="#FF0000">

                    <tr>
                        <td bgcolor="white" width="95%" align="right" colspan="2" >
						<input class="form-control"  name="Save" id="Save"  type="image" src="image/save.jpg" alt="Save" align="right" width="20" height="20" />    </td>
                       <td align="left" bgcolor="white" width="10%"><b>Save</b>    </td>
                     </tr>
					 <tr>
                      <td height="25" bgcolor="white" width="30%" align="left" class="fontBblue" >&nbsp;&nbsp;<nobr>Category Hardware  :  </td>
                      <td height="25" bgcolor="white" width="70%" align="left" class="fontBblue" colspan="2" ><br />
					<?
							$sql_cate = "select cate_id,cate_name  from tbl_category_hardware  where cate_active = 'y' order by cate_name ";
							$rs_cate = mysqli_query($conn,$sql_cate);
					?>
					  <select name="cate_id" id="cate_id" style="width:250pt" onchange="gethw(this)">
					  <? while ($c_cate = mysqli_fetch_array($rs_cate)) {?>
					  		<option value="<?=$c_cate["cate_id"]?>" >    <?=$c_cate["cate_name"]?>    </option>
					<? } ?>
					  </select>
				</td>
                    </tr>
					<tr>
                      <td height="25" bgcolor="white" width="30%" align="left" class="fontBblue" >&nbsp;&nbsp;Brand.  :  </td>
                      <td height="25" bgcolor="white" width="70%" align="left" class="fontBblue" colspan="2" >
			   <select name="hardware_brand" id="hardware_brand" style="width:250pt" >
                                   <option value="<?php echo $c_brand["brand_name"];?>" <? if($c_serial["hw_brand"]=="na") echo "selected"?>>N/A</option>
						<?php 
						
									$sql_cat_brand = "SELECT brand_name, brand_id from tbl_category_brand where active='y' order by brand_name";
									$rs_cate_brand = mysqli_query($conn,$sql_cat_brand);
									while($c_brand = mysqli_fetch_array($rs_cate_brand)){
						?>
						<option value="<?php echo $c_brand["brand_name"];?>" <? if($c_serial["hw_brand"]==$c_brand["brand_name"]) echo "selected"?>><?echo $c_brand["brand_name"]?></option>
                        <?php } ?>

                         </select>
						</td>
					</tr>
					<tr>
                      <td height="25" bgcolor="white" width="30%" align="left" class="fontBblue" >&nbsp;&nbsp;Serial No.  :  </td>
                      <td height="25" bgcolor="white" width="70%" align="left" class="fontBblue" colspan="2" >
					 <input class="form-control"  type="text" onKeyPress="getKey()" name="serialno" id="serialno" style="width:250pt" >
						</td>
					</tr>
  <script>
  $("#license_windows_nox").hide();
  function gethw(str){
      var cmd = str.value;
            if(cmd=="1" || cmd=="53" || cmd=="70"){
                $("#license_windows_nox").show();
            }else{
                 $("#license_windows_nox").hide();
            }
  }

</script>			
		<tr id="license_windows_nox">
		  <td height="25" bgcolor="white" width="30%" align="left" class="fontBblue" >&nbsp;&nbsp;<nobr><?=iconv('UTF-8','TIS-620',"License Windows");?> :  </td>
		  <td height="25" bgcolor="white" width="70%" align="left" class="fontBblue" colspan="2" >
			 <input class="form-control"  type="text" name="license_windows_no" id="license_windows_no" style="width:250pt" >
			 </td>
                </tr>
			
					
					<tr>
                      			<td height="25" bgcolor="white" width="30%" align="left" class="fontBblue" >&nbsp;&nbsp;Enter Stock  :  </td>
                      			<td height="25" bgcolor="white" width="70%" align="left" class="fontBblue" colspan="2" >
					  			<input class="form-control"  type="date" name="dte_tme_entry_stock" id="dte_tme_entry_stock" readonly="readonly" value="<?=date("Y-m-d")?>" style="width:250pt"  >
						</td>
                    </tr>

					<tr>
                      			<td height="25" bgcolor="white" width="30%" align="left" class="fontBblue" >&nbsp;&nbsp;Warranty Date  :  </td>
                      			<td height="25" bgcolor="white" width="70%" align="left" class="fontBblue" colspan="2" >
					  			<input class="form-control"  type="date" name="dte_tme_warranty" id="dte_tme_warranty"  value="<?=date("Y-m-d")?>" style="width:250pt"  >
						</td>
                    </tr>
					<tr>
                      			<td height="25" bgcolor="white" width="30%" align="left" class="fontBblue" ><nobr>&nbsp;&nbsp;Expired Warranty Date  :  </td>
                      			<td height="25" bgcolor="white" width="70%" align="left" class="fontBblue" colspan="2" >
					  			<input class="form-control"  type="date" name="dte_tme_expired_warranty" id="dte_tme_expired_warranty"  value="<?=date("Y-m-d", strtotime('+5 years'))?>" style="width:250pt">
						</td>
                    </tr>
		    <tr>
                      			<td height="25" bgcolor="white" width="30%" align="left" class="fontBblue" >&nbsp;&nbsp;Install Date  :  </td>
                      			<td height="25" bgcolor="white" width="70%" align="left" class="fontBblue" colspan="2" >
					  			<input class="form-control"  type="date" name="dte_tme_install" id="dte_tme_install"  value="<?=date("Y-m-d")?>" style="width:250pt"  >
						</td>
                    </tr>
					<tr>
                      			<td height="25" bgcolor="white" width="30%" align="left" class="fontBblue" >&nbsp;&nbsp;Expired Date  :  </td>
                      			<td height="25" bgcolor="white" width="70%" align="left" class="fontBblue" colspan="2" >
					  			<input class="form-control"  type="date" name="dte_tme_expired" id="dte_tme_expired"  value="<?=date("Y-m-d", strtotime('+5 years'))?>" style="width:250pt"  >
						</td>
                    </tr>
					<tr>
                      			<td height="25" bgcolor="white" width="30%" align="left" class="fontBblue" >&nbsp;&nbsp;Status  Dealing :  </td>
                      			<td height="25" bgcolor="white" width="70%" align="left" class="fontBblue" colspan="2" >
					  			<select name="status_deal" id="status_deal" readonly="readonly"  style="width:250pt"  >
										<option value="R"  selected="selected">Lease</option>
										<option value="B">Buy</option>
								</select>
								</td>
                    </tr>
					<tr>
                      			<td height="25" bgcolor="white" width="30%" align="left" class="fontBblue" >&nbsp;&nbsp;Status  Hardware :  </td>
                      			<td height="25" bgcolor="white" width="70%" align="left" class="fontBblue" colspan="2" >
					  			<select name="status_hw" id="status_hw" readonly="readonly"  style="width:250pt"  >
										<option value="r">Repair</option>
										<option value="a" selected="selected">Active</option>
										<option value="j" >Reject</option>
								</select>								
					<input class="form-control"  type="hidden" name="user_enter" id="user_enter" value="<?=$_SESSION["User_id"]?>" readonly>
					</td>
                    </tr>
		    <tr><td height="25" bgcolor="white" width="30%" align="left" class="fontBblue" >&nbsp;&nbsp;Fix Site :</td>
					<td height="25" bgcolor="white" width="30%" align="left" class="fontBblue" colspan="2" >
					<select name="fix_site4return" id="fix_site4return" style="width:250pt" >
					   <option value="">No Fix</option>
					   <?
					     $str_site_id = "select site_id,site_name 
					     from tbl_site  
					     where site_id like 'S0%' or  site_id like 'S1%'or  site_id like 'S2%'or  site_id like 'S3%'or  site_id like 'S4%'or  site_id like 'S5%'or  site_id like 'S6%'or  site_id like 'S7%' or  site_id like 'S8%'or  site_id like 'S9%'
						   or  site_id like '6%'or  site_id like '10%'  or  site_id like 'AMZ%'
					     order by site_name";
					     $rs_site_id = mysqli_query($conn,$str_site_id);
					     while($c_site_id = mysqli_fetch_array($rs_site_id)){
					   ?>   
					      <option value="<?=$c_site_id["site_id"]?>"><?=$c_site_id["site_id"]." ".$c_site_id["site_name"]?></option>
					   <?}?>
					   
					</select>
				       </td></tr>

		    <tr>		<td height="25" bgcolor="white" width="30%" align="left" class="fontBblue" >&nbsp;&nbsp;Owner :</td>
				<td height="25" bgcolor="white"  colspan="3" >
				  <select name="owner_by_sn" id="owner_by_sn"  style="width:250pt">
					  <option value="BSS">BSS</option>
					  <option value="MSI">MSI</option>
					  <option value="Ricoh">Ricoh</option>
					  <option value="Bhomthai">Bhomthai</option>
					  <option value="Chawpaya">Chawpaya</option>
					  <option value="Nimble">Nimble</option>
					  <option value="SNS">SNS</option>
					  <option value="FLOWCO">FLOWCO</option>
				  </select>
				 </td>
		    </tr>
		      <tr><td height="25" bgcolor="white" width="30%" align="left" class="fontBblue" >&nbsp;&nbsp;Asset By :</td>
				<td height="25" bgcolor="white"  colspan="3" >
				  <select name="asset_by" id="asset_by"  style="width:250pt">
					  <option value="BSS">BSS</option>
					  <option value="PTTICT">PTTICT</option>
					  <option value="Flowco">Flowco</option>
					  <option value="Ricoh">Ricoh</option>
				  </select>
				 </td>
		    </tr>
		    <tr>
                      			<td height="25" bgcolor="white" width="30%" align="left" class="fontBblue" >&nbsp;&nbsp;SparePart For  :  </td>
                      			<td height="25" bgcolor="white" width="70%" align="left" class="fontBblue" colspan="4" >
					    <select name="sparepartfor" id="sparepartfor"   style="width:250pt"  >
						<?/* $sql_sparepartfor = "SELECT customer_id,customer_name FROM tbl_customer Order by customer_name";
						   $rs_sparepartfor = mysql_query($sql_sparepartfor);
						   while($c_sparepartfor = mysql_fetch_array($rs_sparepartfor)){
						?>		    
						    <option value="<?=$c_sparepartfor["customer_name"]?>"><?=$c_sparepartfor["customer_name"]?></option>
						<?}*/?>
						    <option value="NGVONLY"><?=iconv('UTF-8','TIS-620',"ใช้ได้เฉพาะ NGV ของ ICT เท่านั้น ");?></option>
										<option value="OILONLY"><?=iconv('UTF-8','TIS-620',"ใช้ได้เฉพาะ OIL ของ ICT เท่านั้น ");?></option>	
										<option value="ALLOilNGV"><?=iconv('UTF-8','TIS-620',"ใช้ได้ทั้ง NGV และ Oil ของ ICT และ Ricoh ");?></option>
										<option value="ALLOilOnly"><?=iconv('UTF-8','TIS-620',"ใช้ได้เฉพาะ OIL ของ ICT และ Ricoh ");?></option>
										<option value="ALLOilRicohOnly"><?=iconv('UTF-8','TIS-620',"ใช้ได้เฉพาะ OIL ของ Ricoh ");?></option>					
					</select></td>
                    </tr>
		    <tr>
                      			<td height="25" bgcolor="white" width="30%" align="left" class="fontBblue" >&nbsp;&nbsp;Repair By  :  </td>
                      			<td height="25" bgcolor="white" width="70%" align="left" class="fontBblue" colspan="4" >
					    <select name="repair_by" id="repair_by"  style="width:250pt">
						<option value="BSS">BSS</option>
						<option value="MSI">MSI</option>
						<option value="Ricoh">Ricoh</option>
						<option value="Bhomthai">Bhomthai</option>
						<option value="Chawpaya">Chawpaya</option>
						<option value="Nimble">Nimble</option>
						<option value="SNS">SNS</option>
						<option value="FLOWCO">FLOWCO</option>
						<option value="NavaDC">Navanakorn(DC)</option>
						<option value="WirelessTech">WirelessTech</option>
						<option value="TheSun">The Sun</option>
					</select></td>
                    </tr>
		     <tr>
				<td height="25" bgcolor="white" width="30%" align="left" class="fontBblue" >&nbsp;&nbsp;Bussiness :</td>
					  <td height="25" bgcolor="white"  colspan="3" >
					  <select name="bussinessname" id="bussinessname" style="width:250pt">
					  	<option value="ngv" >NGV</option>
						<option value="oil" >Oil</option>
						<option value="amz"  >Amazon</option>
					  </select>

			</td></tr>
			<tr>
				<td height="25" bgcolor="white" width="30%" align="left" class="fontBblue" >&nbsp;&nbsp;Comment (lot) :</td>
					  <td height="25" bgcolor="white"  colspan="3" >
					  <input class="form-control"  type="text" name="buy_by" id="buy_by" style="width:250pt">

			</td></tr>
					<tr><td height="25" bgcolor="white"  colspan="3" >&nbsp;</td></tr>
                </table>
            </form></td></tr></table>
