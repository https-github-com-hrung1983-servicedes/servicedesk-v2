<?
header("Content-Type: text/html; charset=tis-620");
session_start();
require_once("function.php");
  if(!checkUser()){    echo Message(35,"red",$titel1,$msg1,"<a href='index.php?link=hw.waitrepair.add.serial'> $login </a>");
  exit;
  }
$type = $_REQUEST["type"];
$id = $_REQUEST["id"];
$status_sch = $_REQUEST["status"];
if($type=="edit"){
 $sql = "Select id,
	   cate_id,
	   hardware_brand,
	   hardware_no,
	   license_windows_no,
	   buy_by,
	   owner_by,
	   asset_by,
	   sparepartfor,
	   repair_by,
	   comment_lot,
	   fix_site4return,
	   bussinessname
	  From tbl_hardware_onhand_user
	  Where id = $id";
	//  echo $sql;
   $rs = mysqli_query($conn,$sql);
   $c = mysqli_fetch_array($rs);
}else{
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
	       var id = encodeURIComponent($("#id_sn").attr('value'));	
	       var status_sch = $("#status_sch").attr('value');	 
	       var cate_id = $("#cate_id").attr('value');	 
	       var hardware_brand = $("#hardware_brand").attr('value');	 
	       var license_windows_no = $("#license_windows_no").attr('value');	
	       var buy_by = encodeURIComponent($("#buy_by").attr('value'));
	       var owner_by = $("#owner_by").attr('value');
	       var asset_by = $("#asset_by").attr('value');			
	       var sparepartfor = $("#sparepartfor").attr('value');
	       var repair_by = $("#repair_by").attr('value');
	       var comment_lot = $("#comment_lot").attr('value');
	       var fix_site4return = $("#fix_site4return").attr('value');
		   
	       var bussinessname = $("#bussinessname").attr('value');
		   

	       $.post('function.execute.php',{ mode : "hw.waitrepair.edit.serial.form",
		      id:id,
		      cate_id:cate_id,
		      hardware_brand:hardware_brand,
		      license_windows_no:license_windows_no,
		      buy_by:buy_by,
		      owner_by:owner_by,
		      asset_by:asset_by,
		      sparepartfor:sparepartfor,
		      repair_by:repair_by,
		      comment_lot:comment_lot,
		      fix_site4return:fix_site4return,
			  bussinessname:bussinessname},
	      function(data) {
		if(data==""){
		     window.parent.location.href ="hw.waitrepair.list.php?status_hw="+status_sch+"&id="+Math.random(100*1000,1000/2);
		 }else{
		   alert(data);
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
			<input class="form-control"   type="hidden" value="<?=$id?>" name="id_sn" id="id_sn" />
			<input class="form-control"   type="hidden" value="<?=$status_sch?>" name="status_sch" id="status_sch" />
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
							$sql_cate = "select cate_id,cate_name  from tbl_category_hardware  where cate_id = '$c[cate_id]'";
							$rs_cate = mysqli_query($conn,$sql_cate);
					?>
					  <select name="cate_id" id="cate_id" style="width:250pt" onchange="gethw(this)">
					  <? while ($c_cate = mysqli_fetch_array($rs_cate)) {?>
					     <option value="<?=$c_cate["cate_id"]?>" ><?=$c_cate["cate_name"]?></option>
					<? } ?>
					  </select>
				</td>
                    </tr>
					<tr>
                      <td height="25" bgcolor="white" width="30%" align="left" class="fontBblue" >&nbsp;&nbsp;Brand.  :  </td>
                      <td height="25" bgcolor="white" width="70%" align="left" class="fontBblue" colspan="2" >
			   <select name="hardware_brand" id="hardware_brand" style="width:250pt" >
                                   <option><?=$c["hardware_brand"]?></option>
                         </select></td>
		    </tr>
		    <tr>
                      <td height="25" bgcolor="white" width="30%" align="left" class="fontBblue" >&nbsp;&nbsp;Serial No.  :  </td>
                      <td height="25" bgcolor="white" width="70%" align="left" class="fontBblue" colspan="2" >
		      <input class="form-control"  type="text" readonly value="<?=$c["hardware_no"]?>" name="serialno" id="serialno" style="width:250pt" >
		     </td>
		    </tr>
 	<? if($c["cate_id"]=="1" || $c["cate_id"]=="53" || $c["cate_id"]=="70"){
	 $str_readonly = "";
	      if($c["license_windows_no"]!=""){
	         $str_readonly = "readonly";	       
	      }
	 ?>
	
		<tr id="license_windows_nox">
		  <td height="25" bgcolor="white" width="30%" align="left" class="fontBblue" >&nbsp;&nbsp;<nobr><?=iconv('UTF-8','TIS-620',"License Windows");?> :  </td>
		  <td height="25" bgcolor="white" width="70%" align="left" class="fontBblue" colspan="2" >
			 <input class="form-control"  type="text" <?=$str_readonly?> name="license_windows_no" id="license_windows_no" value="<?=$c["license_windows_no"]?>" style="width:250pt" >
			 </td>
                </tr>
       <?}?>
		
	<? if($c["fix_site4return"] == "") { ?>
	       <tr>
		   <td height="25" bgcolor="white" width="30%" align="left" class="fontBblue" >&nbsp;&nbsp;Status  Dealing :  </td>
		   <td height="25" bgcolor="white" width="70%" align="left" class="fontBblue" colspan="2" >
		      <select name="buy_by" id="buy_by" readonly="readonly"  style="width:250pt"  >
			 <option value="R" <? if($c["buy_by"]=="R") echo "selected";?>>Lease</option>
			 <option value="B" <? if($c["buy_by"]=="B") echo "selected";?>>Buy</option>
		      </select>
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
			  or  site_id like '6%'or  site_id like '10%'
			  order by site_name";
			  $rs_site_id = mysqli_query($conn,$str_site_id);
			  while($c_site_id = mysqli_fetch_array($rs_site_id)){
			   ?>   
			 <option value="<?=$c_site_id["site_id"]?>" <? if($c["fix_site4return"]==$c_site_id["site_id"]) echo "selected";?>><?=$c_site_id["site_id"]." ".$c_site_id["site_name"]?></option>
			 <?}?>					   
		     </select>
		   </td>
	       </tr>
	       <tr><td height="25" bgcolor="white" width="30%" align="left" class="fontBblue" >&nbsp;&nbsp;Owner :</td>
		   <td height="25" bgcolor="white"  colspan="3" >
		     <select name="owner_by" id="owner_by"  style="width:250pt">
			 <option value="BSS"  <? if($c["owner_by"]=="BSS") echo "selected";?>>BSS</option>
			 <option value="MSI"  <? if($c["owner_by"]=="MSI") echo "selected";?>>MSI</option>
			 <option value="Ricoh"  <? if($c["owner_by"]=="Ricoh") echo "selected";?>>Ricoh</option>
			 <option value="Bhomthai"  <? if($c["owner_by"]=="Bhomthai") echo "selected";?>>Bhomthai</option>
			 <option value="Chawpaya"  <? if($c["owner_by"]=="Chawpaya") echo "selected";?>>Chawpaya</option>
			 <option value="Nimble"  <? if($c["owner_by"]=="Nimble") echo "selected";?>>Nimble</option>
			 <option value="SNS"  <? if($c["owner_by"]=="SNS") echo "selected";?>>SNS</option>
			 <option value="FLOWCO"  <? if($c["owner_by"]=="FLOWCO") echo "selected";?>>FLOWCO</option>
		     </select>
		   </td>
	       </tr>
	       <tr><td height="25" bgcolor="white" width="30%" align="left" class="fontBblue" >&nbsp;&nbsp;Asset By :</td>
		   <td height="25" bgcolor="white"  colspan="3" >
			<select name="asset_by" id="asset_by"  style="width:250pt">
			   <option value="BSS" <? if($c["asset_by"]=="BSS") echo "selected";?>>BSS</option>
			   <option value="PTTICT" <? if($c["asset_by"]=="PTTICT") echo "selected";?>>PTTICT</option>
			   <option value="Flowco" <? if($c["asset_by"]=="Flowco") echo "selected";?>>Flowco</option>
			   <option value="Ricoh" <? if($c["asset_by"]=="Ricoh") echo "selected";?>>Ricoh</option>
			</select>
		   </td>
	       </tr>
	       <tr>
		   <td height="25" bgcolor="white" width="30%" align="left" class="fontBblue" >&nbsp;&nbsp;SparePart For  :  </td>
		   <td height="25" bgcolor="white" width="70%" align="left" class="fontBblue" colspan="4" >
		   <select name="sparepartfor" id="sparepartfor"   style="width:250pt"  >
		   <? $sql_sparepartfor = "SELECT customer_id,customer_name FROM tbl_customer Order by customer_name";
		   $rs_sparepartfor = mysqli_query($conn,$sql_sparepartfor);
		      while($c_sparepartfor = mysqli_fetch_array($rs_sparepartfor)){
		   ?>		    
			<option value="<?=$c_sparepartfor["customer_name"]?>" <? if($c["sparepartfor"]==$c_sparepartfor["customer_name"]) echo "selected";?>><?=$c_sparepartfor["customer_name"]?></option>
		   <?}?>
			<option value="ALLOilNGV" <? if($c["sparepartfor"]=="ALLOilNGV") echo "selected";?>>ALL (NGV & OIL)</option>	
			<option value="ALLOilOnly" <? if($c["sparepartfor"]=="ALLOilOnly") echo "selected";?>>ALL (OIL Only) (ICT, Ricoh)</option>						
		   </select></td>
	       </tr>
	       <tr>
		   <td height="25" bgcolor="white" width="30%" align="left" class="fontBblue" >&nbsp;&nbsp;Repair By  :  </td>
		   <td height="25" bgcolor="white" width="70%" align="left" class="fontBblue" colspan="4" >
		     <select name="repair_by" id="repair_by"  style="width:250pt">
			<option value="BSS" <? if($c["repair_by"]=="BSS") echo "selected";?>>BSS</option>
			<option value="MSI" <? if($c["repair_by"]=="MSI") echo "selected";?>>MSI</option>
			<option value="Ricoh" <? if($c["repair_by"]=="Ricoh") echo "selected";?>>Ricoh</option>
			<option value="Bhomthai" <? if($c["repair_by"]=="Bhomthai") echo "selected";?>>Bhomthai</option>
			<option value="Chawpaya" <? if($c["repair_by"]=="Chawpaya") echo "selected";?>>Chawpaya</option>
			<option value="Nimble" <? if($c["repair_by"]=="Nimble") echo "selected";?>>Nimble</option>
			<option value="SNS" <? if($c["repair_by"]=="SNS") echo "selected";?>>SNS</option>
			<option value="FLOWCO" <? if($c["repair_by"]=="FLOWCO") echo "selected";?>>FLOWCO</option>
			<option value="NavaDC" <? if($c["repair_by"]=="NavaDC") echo "selected";?>>Navanakorn(DC)</option>
		    </select></td>
	       </tr>
		   <tr>
		    <td height="25" bgcolor="white" width="30%" align="left" class="fontBblue" >&nbsp;&nbsp;Bussiness :</td>
		    <td height="25" bgcolor="white"  colspan="3" >
		    	<select id="bussinessname" name="bussinessname">
					<option value="ngv" <? if($c["bussinessname"]=="ngv") echo "selected";?>>NGV</option>
					<option value="oil" <? if($c["bussinessname"]=="oil") echo "selected";?>>Oil</option>
					<option value="amz" <? if($c["bussinessname"]=="amz") echo "selected";?>>Amazon</option>
				</select>
			</td>
	       </tr>
	       <tr>
		    <td height="25" bgcolor="white" width="30%" align="left" class="fontBblue" >&nbsp;&nbsp;Comment (lot) :</td>
		    <td height="25" bgcolor="white"  colspan="3" >
		    <input class="form-control"  type="text" name="comment_lot" id="comment_lot" value="<?=$c["comment_lot"]?>" style="width:250pt">
			</td>
	       </tr>
	       <?}?>
	       <tr><td height="25" bgcolor="white"  colspan="3" >&nbsp;</td></tr>
                </table>
            </form></td></tr></table>
