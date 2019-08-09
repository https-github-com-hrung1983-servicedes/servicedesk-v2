<?
header("Content-Type: text/html; charset=TIS-620");
session_start();
require_once("function.php");
date_default_timezone_set('Asia/Bangkok');
//if(!checkUser()){    echo Message(35,"red",$titel1,$msg1,"<a href='index.php?link=logcall.form'> $login </a>");
 // exit;
 // }
$id = $_REQUEST["id"];
$type = $_REQUEST["type"];
//if($type != "add" && $type !="edit" ){
 //echo Message(35,"red",$titel1,$msg1,"<a href='index.php?link=logcall.form'> $login </a>");
 //exit;
//}
include("header.php");
if ($type == "add") {
    $open_date = date("Y-m-d H:i:s");
    $onsite_date = date("Y-m-d H:i:s");
    $fix_date = date("Y-m-d H:i:s");
    $close_date = date("Y-m-d H:i:s");
    $appoint_date = date("Y-m-d H:i:s");
    $hour_sal = "2";
    $type_disable = "";
} elseif ($type == "edit") {

  if($_SESSION['Ustate'] ==  "admin"){
      $type_disable = "";
  }else{
      $type_disable = "disabled=disabled";
   }

  $sql = "Select tbl_log_call_center.*,
              tbl_category_type.fixed_description,
              u1.name as reciept_name,
              u1.sname as reciept_sname,
              u2.name as engineer_name,
              u2.sname as engineer_sname,
              tbl_province.provice_phase,
			        tbl_site.site_name,
			        tbl_site.site_old_name,
	   		      tbl_site.pos,
			        tbl_site.province_name,
              tbl_log_call_center.reciept_job_user_id
          From tbl_log_call_center
                    Left Join tbl_category_type ON tbl_log_call_center.category_type = tbl_category_type.category_id
                    Left Join tbl_user u1 ON tbl_log_call_center.reciept_job_bss = u1.user_id
                    Left Join tbl_user u2 ON tbl_log_call_center.reciept_job_user_id = u2.user_id
                    Left Join tbl_province ON tbl_log_call_center.site_province = tbl_province.province_name
		    Left Join tbl_site ON tbl_log_call_center.site_id = tbl_site.site_id
             Where tbl_log_call_center.id = $id";
 // echo $sql;
  $rs = mysqli_query($conn,$sql);
  $c = mysqli_fetch_array($rs);
    $open_date = $c["open_call_dte"];
    $onsite_date = $c["onsite_datetime"];
    $fix_date = $c["fixed_time"];
    $close_date = $c["closed_date"];
    $hour_sal = $c["sla"];
    $appoint_date = $c["appoint_date"];

$opendate = date('d/m/Y',strtotime($c["open_call_dte"]));
$opentime = $c["open_call_tme"];
$closedate = date('d/m/Y',strtotime($c["closed_date"]));
$closetime = $c["closed_time"];
$appointdate = date('d/m/Y',strtotime($c["appoint_date"]));
$appointtime = $c["appoint_time"];
$onsitedate = date('d/m/Y',strtotime($c["onsite_datetime"]));
$onsitetime = date('H:i:s',strtotime($c["onsite_datetime"]));

if($c["commente"]==""){
	$comment="-";
}else{
	$comment=$c["commente"];
}





  //  echo "nn".$c["provice_phase"];
}
  //       echo getIDRand();






      if($c["reciept_job_bss"]==""){
          $reciept_id = $_SESSION["User_id"];
          $reciept_name = $_SESSION["Uname"]. " " .$_SESSION["Usname"];
      } else {
          $reciept_id  = $c["reciept_job_bss"];
          $reciept_name = $c["reciept_name"]. " " .$c["reciept_sname"];
      }

	//	$sql_status_sign = "select count(job_no) as cnt_job_status from tbl_job_signature  where job_no = '".$c["job_no"]."'";
//		$rs_status_sign = mysql_query($sql_status_sign);
//		$c_status_sign = mysql_fetch_array($rs_status_sign);
	//	echo $sql_status_sign."<br>";
//		echo $c_status_sign["cnt_job_status"];
	//	exit;
?>

<meta http-equiv="Content-Type" content="text/html; charset=TIS-620" />
<link href="image/bss_icon.ico"   rel="shortcut icon" />
<link href="style/calendar.css" rel="stylesheet" type="text/css">
<link href="style/mytable.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="script/calendar_date_picker.js"></script>
<link href="style/stylecss.css" rel="stylesheet" type="text/css">
<link href="style/filtergrid.css" rel="stylesheet" type="text/css">
<style type="text/css">
    .mytable1 { width:100%; font-size:11px;
                border:1px solid #ccc;
                font-size:10px;
    }
    .mytable11 {width:100%; font-size:12px;
                border:1px solid #ccc;
                font-size:11px;
    }
     .th{ background-color:#003366; color:#FFF; padding:0px; border:0px solid #ccc; height:20px; }
     .td{ border-color:#003366;}

     .status_update{

       text-decoration: underline;
     }
</style>
<title>Bizserv Solution Co.,Ltd</title>
<link href="css/loading.css" rel="stylesheet" type="text/css" media="all">

<script src="script/jquery.min.js"></script>
<script src="script/thickbox.js"></script>
<script src="script/loading.js"></script>

<script type="text/javascript" src="script/jquery-1.6.4.js"></script>
<script type="text/javascript" src="script/jquery_1.7.1_min.js"></script>
<script type="text/javascript">
$(document).ready(function(){

		$("#GenNo").click(function(){
					var job_no = $("#txtJobNo").val();

					if(job_no==""){
							var d = new Date();
							var dte = d.getFullYear()+"-"+(d.getMonth()+1)+"-"+d.getDate();
						$.post('function.execute.php',{mode : "gen_id_bss",dte : dte},
							function(data){
								$("#txtJobNo").val(data);
							});
							return false;
					} else {
							$("#txtJobNo").val('');
					}
		});


});
</script>

<table width="100%" align="center" class="mytable11"  height="100%"   cellpadding="1" cellspacing="1" >
    <tr>
        <td valign="top" align="center">
            <form action="logcall.excute.php"  method="post"  name="form1" id="form1"  >
            <input class="form-control"  type="hidden" value="<?=$id?>" name="id" id = "id">
            <input class="form-control"  type="hidden" value="<?=$c["job_no"];?>" name="job_no_update_bss" id = "job_no_update_bss">
			      <input class="form-control"  type="hidden" value="<?=$type?>" name="mode" id = "mode">
            <input class="form-control"  type="hidden" value="<?=$_REQUEST["dte_beg"]?>" name="dte_beg" id = "dte_beg">
            <input class="form-control"  type="hidden" value="<?=$_REQUEST["dte_end"]?>" name="dte_end" id = "dte_end">
                <table width="100%" border="0" cellpadding="0" cellspacing="0" class="mytable" border="0" bordercolor="#FF0000">
                    <tr>
                        <th align="center" height="40" width="100%" colspan="8" class="th">Log call center</th>
                    </tr >

                    <tr>

					<? if($c["signature_status"] != "n"){?>
       					<td width="90%" align="right" >
						<a lang="signature4job.php?type=add&id=<?=$id?>&job_type=<?=$c["category_type"]?>&job_no=<?=$c["job_no"];?>&dte_beg=<?=$_REQUEST["dte_beg"]?>&dte_end=<?=$_REQUEST["dte_end"]?>" class="thickbox pointer" title="Signature">
						<img src="image/addedit.png" alt="Cancel" width="20" height="18" border="0" align="right" /></a></td>
						<td><nobr><b><?=iconv( 'UTF-8', 'TIS-620', "Signature");?></b></td>
						<? } else { ?><td width="95%" align="right" ></td><? } ?>

						<? if($c["status_call"] == "close") { ?>
					   <td><a href="msr_print.php?job_no=<?=$c['job_no']?>" target="_blank"><img src="image/icon_printer.gif" alt="Cancel" width="20" height="18" border="0" align="left" /> </a> </td>
					   <td align="left"><nobr><b><?=iconv( 'UTF-8', 'TIS-620', "Print(MSR)");?></b>     </td>
					   <? } ?>
						<td><input class="form-control"  name="Submit"  type="image" onclick=" return CheckText()"  src="image/save.jpg" alt="Save" align="right" width="20" height="20" />	</td>
					   <td align="left"><b><?=iconv( 'UTF-8', 'TIS-620', "Save");?></b>    </td>
					   <td><a href="javascript:history.back(1)" ><img src="image/cancel.jpg" alt="Cancel" width="20" height="18" border="0" align="left" /> </a> </td>
					   <td align="left"><nobr><b><?=iconv( 'UTF-8', 'TIS-620', "Back");?></b>     </td>
					 </tr>
		<tr>
<script type="text/javascript" language="javascript">
function disableFunc() {
  document.getElementById("type_call1").disabled = true;
}
function ChooseContact(data){
   document.getElementById("type_call").value = data.value;
  // disableFunc();
}


</script>
		</tr>
                </table>
                <br>
                <table width="85%" align="center"  id="table" cellpadding="1" cellspacing="1" border="0">
				   <tr>
                      <td width="20%" height="25" align="left" class="fontBblue">Type :  </td>
					  <td width="75%" align="left" class="fontBblue" colspan="3" >
					  <select name="type_call1" id="type_call1"  style="width:200pt" onchange="ChooseContact(this);" <?=$type_disable?> >
              <option value = "0">--Select--</option>
                       <?
						  $sql_customer = "Select customer_id,customer_code,customer_name From tbl_customer Order by customer_name";
						  $rs_customer=mysqli_query($conn,$sql_customer);
						  while($c_cus = mysqli_fetch_array($rs_customer)){
						 ?>
								<option value = "<?=$c_cus["customer_id"];?>"<?if($c_cus["customer_id"]==$c["call_type"]) echo "selected";?>><?=$c_cus["customer_code"]." (".$c_cus["customer_name"].")";?></option>

						<?}?>
                     </select> &nbsp;
           <input class="form-control"  type="hidden" name="type_call" id="type_call" value="<?=$c["call_type"]?>">
					 <input class="form-control"  type="checkbox" name="doc" id="doc" <?if($c["doc"]=="true") echo "checked";?>  /> Document
				&nbsp;&nbsp;&nbsp;&nbsp;


</td>
                  </tr >

					<tr>
					  <td height="25" align="left" class="fontBblue" ><nobr><?=iconv( 'UTF-8', 'TIS-620', "Company :");?></td>
					  <td height="25" align="left" class="fontBblue">
                      <input class="form-control"  type="text" name="txtCustomerCall" id="txtCustomerCall" value="PTT ICT" style="width:160pt" />
            </td>
					  <td height="25" align="left" class="fontBblue"><nobr><?=iconv( 'UTF-8', 'TIS-620', "Ref. JobNo. :");?></td>
					  <td height="25" align="left" class="fontBblue">
                      <input class="form-control"  type="text" name="txtCallerName" id="txtCallerName" value="<?=$c['caller_name'];?>"  style="width:160pt" /></td>
					</tr>

                    <tr>
                      <td height="25" align="left" class="fontBblue" ><nobr><?=iconv( 'UTF-8', 'TIS-620', "Category Job :");?></td>
                      <td height="25" align="left" class="fontBblue" colspan="4" ><nobr>
                        <input class="form-control"  name="CateTypeID" id="CateTypeID" type="hidden" value="<?=$c['category_type'];?>">
                        <input class="form-control"  name="cmbCateType" type="text" id="cmbCateType" value="<?=$c['fixed_description'];?>"  style="width:552pt"  readonly/>

                      <a href="javascript:getCategoryType('CateTypeID','cmbCateType')">
                      <img src="image/search.gif" width="26" height="22" border="0" align="top"   style=" <?= $xvisible ?> "/></a>


                    </td>
                     </tr>

                    <tr>
                      <td height="25" align="left" class="fontBblue"><nobr><?=iconv( 'UTF-8', 'TIS-620', "Job No. :");?></td>

                      <td height="25" align="left" class="fontBblue"><input class="form-control"  type="text" name="txtJobNo" id="txtJobNo" value="<?=$c["job_no"];?>"  style="width:160pt" <? if($type=="edit"){ echo "readonly";  }?>/>
					 <? if($type=="add"){?>
							<input class="form-control"  type="checkbox" id="GenNo" name="GenNo"> Generate BSS. No.
					 <?}?>
					  </td>
                      <td height="25" align="left" class="fontBblue"><nobr><?=iconv( 'UTF-8', 'TIS-620', "Job No.(MSR):");?></td>
                      <td height="25" align="left" class="fontBblue"><input class="form-control"  type="text" name="txtBSSMSRNo" value="<?=$c['bss_msr_no'];?>" id="txtBSSMSRNo"  style="width:160pt" /></td>
                    </tr>

                    <tr>
                      <td height="25" align="left" class="fontBblue" ><?=iconv( 'UTF-8', 'TIS-620', "Site ID :");?></td>
                      <td height="25" align="left" class="fontBblue" colspan="4"><nobr>
                        <input class="form-control"  name="txtSid" type="text" id="txtSid" style="width:160pt" value="<?=$c["site_id"];//S000128?>" />
                      <a href="javascript:getSite('txtSid')"><img src="image/search.gif" width="26" height="22" border="0" align="top" /></a>
                      <? /*input type="text" value="<?=getSiteName($c["call_type"],$c["site_id"])?>" name="txtSid_name" id="txtSid_name" style="width:390pt" readonly  /*/?>
                      <input class="form-control"  type="text" value="<?=$c['site_name']?>" name="txtSid_name" id="txtSid_name" style="width:390pt" readonly  />
                    </tr>

                    <tr>
                        <td height="25" align="left" class="fontBblue" ><?=iconv( 'UTF-8', 'TIS-620', "Province :");?></td>
                        <td height="25" align="left" class="fontBblue">
                        <input class="form-control"  type="text" name="txtSidProvince" value="<?=$c['site_province'];?>" id="txtSidProvince"  style="width:160pt" />&nbsp;
                          <select name="province_phase" id="province_phase" style="width:120pt">
<?
	$sql_phase = "select * from tbl_phase order by phase_id";
	$rs_phase = mysqli_query($conn,$sql_phase);
	while($c_p = mysqli_fetch_array($rs_phase)){
?>
		<option value="<?=$c_p['phase_id']?>" <? if($c_p["phase_id"]==$c['center_phase']) echo "selected";?>><?=$c_p['phase_name'];?></option>
<? }?>
                      </td>
                      <td align="left" class="fontBblue"><?=iconv( 'UTF-8', 'TIS-620', "Site Note :");?></td>
                      <td align="left" class="fontBblue" colspan="2"><input class="form-control"  type="text" name="way_length" id="way_length" readonly="readonly" style="width:160pt;direction:rtl;" value="<?=getWayLang($c["site_id"]);?>">
                      </td>
                   </tr>

                    <tr>
                      <td height="25" align="left" class="fontBblue" ><nobr><?=iconv( 'UTF-8', 'TIS-620', "Contact :");?></td>
                      <td height="25" align="left" class="fontBblue"><nobr>
                      <input class="form-control"  name="txtContactName" type="text" id="txtContactName" value="<?=$c['customer_contact']?>"  style="width:120pt"  /></td>
                      <td height="25" align="left" class="fontBblue"><?=iconv( 'UTF-8', 'TIS-620', "Tel. :");?></td>
                      <td height="25" align="left" class="fontBblue" colspan="1"><input class="form-control"  type="text" value="<?=$c['customer_tel']?>" name="txtContactTel" id="txtContactTel"  style="width:120pt" /></td>
                   </tr>

                  <tr>
                      <td height="25" align="left" class="fontBblue" colspan="1"><?=iconv( 'UTF-8', 'TIS-620', "Problem Type :");?></td>
                      <td height="25" align="left" class="fontBblue" colspan="5">


<select name="problem_type" id="problem_type"  style="width:630pt" />
	<option value ="0">---Select--</option>
    <? $sql_problem_type = "select * from tbl_problem_category order by problem_id";
	$rs_problem_type = mysqli_query($conn,$sql_problem_type);
	while($c_problem_type = mysqli_fetch_array($rs_problem_type)){?>
                      <option value ="<?=$c_problem_type['problem_id']?>" <?if($c_problem_type["problem_id"]==$c["type_problem"]) echo "selected";?>><?=$c_problem_type["problem_description"]?></option>
    <?}?>
</select></td>
                   </tr>

                  <tr>
                      <td height="25" align="left" class="fontBblue"  valign="top"><nobr><?=iconv( 'UTF-8', 'TIS-620', "Problem :");?></td>
                      <td height="25" align="left" class="fontBblue" colspan="5"><nobr>
                      <input class="form-control"  name="areaProblem" id="areaProblem" value="<?=$c["problem"];?>" style="width:630pt"></td>
                     </tr>
            <?if($_SESSION['Ustate'] ==  "helpdesk" || $_SESSION['Ustate'] ==  "admin") {?>
                    <tr>
                      <td height="25" align="left" class="fontBblue" ><nobr><font color='red'><?=iconv( 'UTF-8', 'TIS-620', "CAT (PTT) :");?></font></td>
                      <td height="25" align="left" class="fontBblue"><nobr>
                         <select name="cmbCat" id="cmbCat" style="width:120pt" onchange="javascript:getCateHour();" />
                                <option value = "CAT 0" <?if($c["severity"] == "CAT 0") echo "selected";?>>CAT 0</option>
                                <option value = "CAT 1" <?if($c["severity"] == "CAT 1") echo "selected";?>>CAT 1</option>
                                <option value = "CAT 2" <?if($c["severity"] == "CAT 2") echo "selected";?>>CAT 2</option>
                                <option value = "CAT 3" <?if($c["severity"] == "CAT 3") echo "selected";?>>CAT 3</option>
                                <option value = "CAT 4" <?if($c["severity"] == "CAT 4") echo "selected";?>>CAT 4</option>
                         </select>
                         </td>
                      <td height="25" align="left" class="fontBblue" ><nobr><font color='red'><?=iconv( 'UTF-8', 'TIS-620', "Hour SLA :");?></font></td>
                      <td height="25" align="left" class="fontBblue"><nobr>
                      <input class="form-control"  name="txtSLA" id="txtSLA" type="text" value="<?=$hour_sal?>" style="width:120pt" /></td>
                    </tr>
	<? } ?>
			<tr>
                      <td height="25" align="left" class="fontBblue" ><nobr><?=iconv( 'UTF-8', 'TIS-620', "CAT (BSS) :");?></td>
                      <td height="25" align="left" class="fontBblue"><nobr>
                         <select name="cmbCatBSS" id="cmbCatBSS" style="width:120pt" onchange="javascript:getCateHour();" />
                                <option value = "CAT 0" <?if($c["cat_bss"] == "CAT 0") echo "selected";?>>CAT 0</option>
                                <option value = "CAT 1" <?if($c["cat_bss"] == "CAT 1") echo "selected";?>>CAT 1</option>
                                <option value = "CAT 2" <?if($c["cat_bss"] == "CAT 2") echo "selected";?>>CAT 2</option>
                         </select>
                         </td>
                      <td height="25" align="left" class="fontBblue" ><nobr><?=iconv( 'UTF-8', 'TIS-620', "Hour SLA :");?></td>
                      <td height="25" align="left" class="fontBblue"><nobr>
                      <input class="form-control"  name="txtSLABSS" id="txtSLABSS" type="text" value="<?=$c['cat_hour']?>" style="width:120pt" /></td>
                    </tr>

                    <tr>
                      <td height="25" align="left" class="fontBblue" ><nobr><?=iconv( 'UTF-8', 'TIS-620', "Open Job :");?></td>
                      <td height="25" align="left" class="fontBblue"><nobr>
                         <select name="cmbOpenType" id="cmbOpenType"   style="width:120pt"  />
                                <option value = "<?=iconv( 'UTF-8', 'TIS-620', "อีเมลล์");?>" <?if($c["open_type"] == iconv( 'UTF-8', 'TIS-620', "อีเมลล์")) echo "selected";?>><?=iconv( 'UTF-8', 'TIS-620', "Email");?></option>
                                <option value = "<?=iconv( 'UTF-8', 'TIS-620', "แฟกซ์");?>" <?if($c["open_type"] == iconv( 'UTF-8', 'TIS-620', "แฟกซ์")) echo "selected";?>><?=iconv( 'UTF-8', 'TIS-620', "Fax");?></option>
                                <option value = "<?=iconv( 'UTF-8', 'TIS-620', "โทรศัพท์");?>" <?if($c["open_type"] == iconv( 'UTF-8', 'TIS-620', "โทรศัพท์")) echo "selected";?>><?=iconv( 'UTF-8', 'TIS-620', "Tel.");?></option>
								<option value = "<?=iconv( 'UTF-8', 'TIS-620', "ตามแผน");?>" <?if($c["open_type"] == iconv( 'UTF-8', 'TIS-620', "ตามแผน")) echo "selected";?>><?=iconv( 'UTF-8', 'TIS-620', "Plan");?></option>
								<option value = "<?=iconv( 'UTF-8', 'TIS-620', "จากเว็บไซต์");?>" <?if($c["open_type"] == iconv( 'UTF-8', 'TIS-620', "จากเว็บไซต์")) echo "selected";?>><?=iconv( 'UTF-8', 'TIS-620', "Website");?></option>
                         </select>
                      </td>

                          <td height="25" align="left" class="fontBblue" ><nobr><?=iconv( 'UTF-8', 'TIS-620', "Recipt :");?></td>
                          <td height="25" align="left" class="fontBblue" ><nobr>
                          <input class="form-control"  type="hidden" value="<?=$reciept_id;?>" name="UserReciptID" id="UserReciptID">
                          <input class="form-control"  name="cmbUserReceipt" type="text" id="cmbUserReceipt" value="<?=$reciept_name?>"  style="width:160pt" readonly="readonly" />
                          <!--a href="javascript:getUser('UserReciptID','BSS')"><img src="image/search.gif" alt="àÅ×Í¡ª×èÍ¼ÙéÃÑºãº§Ò¹" width="26" height="22" border="0" align="top" /></a---></td>
                      </tr>

                     <tr>
                      <td height="25" align="left" class="fontBblue" ><nobr><?=iconv( 'UTF-8', 'TIS-620', "Team :");?></td>
                      <td height="25" align="left" class="fontBblue"><nobr>
					  <? if($c["type_service"] == ""){ $teamservice="BSS"; }else{ $teamservice=$c["type_service"]; } ?>
                        <select name="cmbServiceType" id="cmbServiceType" style="width:140pt"  />
                           <option value = "BSS" <?if($teamservice == "BSS") echo "selected";?>>Bizserv Solution Team A</option>
                           <option value = "SDC" <?if($teamservice == "SDC") echo "selected";?>>Bizserv Solution Team B</option>
                           <option value = "BOONPA" <?if($teamservice == "BOONPA") echo "selected";?>>Bizserv Solution Team C</option>
                        </select>
                      </td>
                      <td height="25" align="left" class="fontBblue" ><nobr><?=iconv( 'UTF-8', 'TIS-620', "Engineer :");?></td>
                      <td height="25" align="left" class="fontBblue"><nobr>
                      <input class="form-control"  type="hidden" value="<?=$c["reciept_job_user_id"];?>" name="UserEngineerID" id="UserEngineerID">
                      <input class="form-control"  name="cmbUserEngineer" type="text" id="cmbUserEngineer" readonly value="<?=$c["engineer_name"]. " " .$c["engineer_sname"]?>"  style="width:160pt"  />
                      <a href="javascript:getUser('cmbUserEngineer',cmbServiceType.value)"><img src="image/search.gif" alt="àÅ×Í¡ª×èÍ¼Ùé·Õè·Ó§Ò¹" width="26" height="22" border="0" align="top" /></a></td>
                     </tr>

                      <tr>
                      <td height="25" align="left" class="fontBblue" valign="top" ><?=iconv( 'UTF-8', 'TIS-620', "Problem Solving :");?></td>
                      <td height="25" align="left" class="fontBblue"  colspan="5">



                      <input class="form-control"  name="txtProblemSolving" id="txtProblemSolving" value="<?=$c["problem_solving"];?>" style="width:630pt" ><? // onBlur="ckeckrude('txtProblemSolving',txtProblemSolving.value)"?>
                      <br><input class="form-control"  type="button" value="Serial No." style="width:100pt"
onclick="entry_serial_no_ptt(txtSid.value,txtJobNo.value,UserEngineerID.value,cmbServiceType.value,type_call.value);"> &nbsp; &nbsp; &nbsp;
			   <!--input type="button" value="Serial No. (BSS)" style="width:100pt"
onclick="entry_serial_no_bss(txtSid.value,txtJobNo.value,UserEngineerID.value,cmbServiceType.value);"-->

					  <?=iconv( 'UTF-8', 'TIS-620', "Solving By :");?>
					  <select name="resolv_type" id="resolv_type" style="width:120pt">
                                    <option value="c" <?if($c["resolv_type"]=="c") echo "selected";?>>CM</option>
                                    <option value="h" <?if($c["resolv_type"]=="h") echo "selected";?>>Helpdesk</option>
                      </select>

					  <select name="shift_job" id="shift_job" style="width:120pt">
                                    <option value="T" <?if($c["shift_job"]=="T") echo "selected";?>><?=iconv( 'UTF-8', 'TIS-620', "Working Hours");?></option>
                                    <option value="F" <?if($c["shift_job"]=="F") echo "selected";?>><?=iconv( 'UTF-8', 'TIS-620', "Overtime");?></option>
                      </select>

					  </td>
                     </tr>

                    <tr>
			<td width="12%" align="left" class="fontBblue" height="25"><nobr><?=iconv( 'UTF-8', 'TIS-620', "Manday :");?></td>
		        <td align="left" class="fontBblue"  colspan="3" height="25">
                           <nobr><select style="width:160pt;" name="manday" type="text" id="manday"/>
					<option value="0" <?if($c['manday']=="0") echo "selected";?>>0</option>
					<option value="0.5" <?if($c['manday']=="0.5") echo "selected";?>>0.5</option>
					<option value="1.0" <?if($c['manday']=="1.0") echo "selected";?>>1.0</option>
					<option value="1.5" <?if($c['manday']=="1.5") echo "selected";?>>1.5</option>
					<option value="2.0" <?if($c['manday']=="2.0") echo "selected";?>>2.0</option>
					<option value="2.5" <?if($c['manday']=="2.5") echo "selected";?>>2.5</option>
					<option value="3.0" <?if($c['manday']=="3.0") echo "selected";?>>3.0</option>
					<option value="3.5" <?if($c['manday']=="3.5") echo "selected";?>>3.5</option>
					<option value="4.0" <?if($c['manday']=="4.0") echo "selected";?>>4.0</option>
					<option value="4.5" <?if($c['manday']=="4.5") echo "selected";?>>4.5</option>
					<option value="5.0" <?if($c['manday']=="5.0") echo "selected";?>>5.0</option>
					<option value="5.5" <?if($c['manday']=="5.5") echo "selected";?>>5.5</option>
					<option value="6.0" <?if($c['manday']=="6.0") echo "selected";?>>6.0</option>
					<option value="6.5" <?if($c['manday']=="6.5") echo "selected";?>>6.5</option>
					<option value="7.0" <?if($c['manday']=="7.0") echo "selected";?>>7.0</option>
					<option value="7.5" <?if($c['manday']=="7.5") echo "selected";?>>7.5</option>
					<option value="15.0" <?if($c['manday']=="15.0") echo "selected";?>>15.0</option>
					<option value="30.0" <?if($c['manday']=="30.0") echo "selected";?>>30.0</option>
        </select>&nbsp;<?=iconv( 'UTF-8', 'TIS-620', " Day");?>
		    </tr>



                     <tr>
                       <td width="12%" align="left" class="fontBblue" height="25"><nobr>
                        <nobr><?=iconv( 'UTF-8', 'TIS-620', "Appoint Date :");?></td>
                       <td  class="fontBblue" colspan="2">


                   			<input class="form-control"  style="width:130pt;" name="appoint_date" type="text" id="appoint_date" value="<?=$appoint_date?>" size="25" maxlength="10"  readonly="readonly"/>

                                             <a href="#" onclick="cdp1.showCalendar(this, 'appoint_date'); return false;" >
                                             <img src="image/calendar.png" width="17" height="13" border="0" /></a>
                   			<nobr> HH :
                                             <?
                                             $apphtme = getTime($c["appoint_time"],0);
                                             ?>
                                             <select name="appoint_h_time" id="appoint_h_time">
                                               <?for($i=0;$i<24;$i++){?>
                                                   <option value = "<?=$i?>" <?if($apphtme==$i) echo "selected";?>><?=$i?></option>";
                                               <?}?>
                                           </select>
                                             <nobr>MM :
                                             <?
                                             $appmtme = getTime($c["appoint_time"],1);
                                             ?>
                                             <select name="appoint_m_time" id="appoint_m_time">
                                               <?for($i=0;$i<60;$i++){?>
                                                   <option value = "<?=$i?>" <?if($appmtme==$i) echo "selected";?>><?=$i?></option>";
                                               <?}?>
                                        </select>
                       </td>
                     </tr>


                    <tr> <?if($_SESSION['Ustate'] ==  "helpdesk" || $_SESSION['Ustate'] ==  "admin") {?>
                      <td height="25" align="left" class="fontBblue" ><nobr><font color='red'><?=iconv( 'UTF-8', 'TIS-620', "Deadline Date (PTT) :");?></font></td>
                      <td height="25" align="left" class="fontBblue"><nobr>
                      <input class="form-control"  name="txtDeatLine" type="text" id="txtDeatLine" value="<?=$c['dateline_solving'];?>" readonly  style="width:160pt; color:red;"/></td>
<?}?>
                    </tr>
                    <tr>
                      <td height="25" align="left" class="fontBblue" ><nobr><?=iconv( 'UTF-8', 'TIS-620', "Deadline Date (BSS) :");?></td>
                        <td height="25" align="left" class="fontBblue"><nobr>
                        <input class="form-control"  name="dateline_cat_bss" type="text" id="dateline_cat_bss" value="<?=$c['dateline_cat_bss'];?>" readonly  style="width:160pt;"/></td>
                    </tr>

                    <tr>
                         <td width="12%" align="left" class="fontBblue" height="25"><nobr>
                          <?=iconv( 'UTF-8', 'TIS-620', "Open Date :");?></td>
                          <td align="left" class="fontBblue"  colspan="3" height="25">

                          <nobr>


                            <? if($type=="add") {  echo " ".date("Y-m-d H:i:s"); } else { echo " ".$open_date." ".$c["open_call_tme"]; }?>
                                <?
                                $hop = getTime($c["open_call_tme"],0);
                                $mop = getTime($c["open_call_tme"],1);
                                ?>
                             <input class="form-control"  name="open_date" type="hidden" id="open_date" value="<? if($type=='add') { echo date('Y-m-d'); } else { echo $open_date; }?>" size="2" readonly="readonly"/>
                             <input class="form-control"  name="open_date_h" type="hidden" id="open_date_h" value="<? if($type=="add"){ echo date('H'); } else { echo $hop; }?>" size="2" readonly="readonly"/>
                             <input class="form-control"  name="open_date_t" type="hidden" id="open_date_t" value="<? if($type=="add"){ echo date('i'); } else { echo $mop; }?>" size="2" readonly="readonly"/>

                    </td>
                    </tr>

                    <tr>
                      <td height="25" align="left" class="fontBblue" ><?=iconv( 'UTF-8', 'TIS-620', "On Site Date :");?></td>
                      <td height="25" align="left" class="fontBblue"><nobr>

                      <?

                          $honsite1 = explode(" ",$onsite_date);

                          if($type=="edit") {
                              if($onsite_date==NULL){

                                $onsite_value_date=date('Y-m-d');
                                $onsite_onpage= "<font color='gray'>".date("Y-m-d H:i:s")."</font>";
                                $onsite_type="checkbox";
                                $honsite = date('H');
                                $monsite = date('i');
                              }else{
                                $onsite_value_date=$honsite1[0];
                                $onsite_onpage=$onsite_date;
                                $onsite_type="hidden";
                                $honsite = getTime($honsite1[1],0);
                                $monsite = getTime($honsite1[1],1);
                              }
                          ?>
                          <input class="form-control"  type="<?=$onsite_type?>" name="dteOnSite" id="dteOnSite" value="<?=$onsite_value_date?>">
                          <?=$onsite_onpage?>
                          <input class="form-control"  name="cmbOnSiteHH" type="hidden" id="cmbOnSiteHH" value="<?=$honsite?>" size="2" readonly="readonly"/>
                          <input class="form-control"  name="cmbOnSiteTT" type="hidden" id="cmbOnSiteTT" value="<?=$monsite?>" size="2" readonly="readonly"/>
                          <? } else { ?>
                            <font color="gray"><?=date("Y-m-d H:i:s");?></font>
                          <? }
                            ?>



                      </td>
                     </tr>


                     <tr>

                       <td height="25" align="left" class="fontBblue">
                      <?=iconv( 'UTF-8', 'TIS-620', "Fixed Date :");?>
                      <td height="25" colspan="3" align="left" class="fontBblue"><nobr>


                      <?
                        $hfix1 = split(" ",$fix_date);

                        if($type=="edit") {
                            if($fix_date==NULL){

                              $fix_value_date=date('Y-m-d');
                              $fix_onpage= "<font color='gray'>".date("Y-m-d H:i:s")."</font>";
                              $fix_type="checkbox";
                              $hfix = date('H');
                              $mfix = date('i');
                            }else{
                              $fix_value_date=$fix_date;
                              $fix_onpage=$fix_date;
                              $fix_type="hidden";
                              $hfix = getTime($hfix1[1],0);
                              $mfix = getTime($c["fixed_time"],1);
                            }
                        ?>
                        <input class="form-control"  type="<?=$fix_type?>" name="dteFixedTime" id="dteFixedTime" value="<?=$fix_value_date?>">
                        <?=$fix_onpage?>
                        <input class="form-control"  name="cmbFixedTimeHH" type="hidden" id="cmbFixedTimeHH" value="<?=$hfix?>" size="2" readonly="readonly"/>
                        <input class="form-control"  name="cmbFixedTimeTT" type="hidden" id="cmbFixedTimeTT" value="<?=$mfix?>" size="2" readonly="readonly"/>
                        <? } else { ?>
                          <font color="gray"><?=date("Y-m-d H:i:s");?></font>
                        <? }
                          ?>


                    </td>
                     </tr>

                     <tr>
                      <td height="25" align="left" class="fontBblue" ><?=iconv( 'UTF-8', 'TIS-620', "Close Date :");?></td>
                      <td height="25" align="left" class="fontBblue"><nobr>

                        <?
                          if($type=="edit") {
                              if($close_date==NULL){

                                $close_value_date=date('Y-m-d');
                                $close_onpage= "<font color='gray'>".date("Y-m-d H:i:s")."</font>";
                                $closetype="checkbox";
                                $hclose = date('H');
                                $mclose = date('i');
                              }else{
                                $close_value_date=$close_date;
                                $close_onpage=$close_date." ".$c["closed_time"];
                                $closetype="hidden";
                                $hclose = getTime($c["closed_time"],0);
                                $mclose1 = split(" ",$c["closed_time"]);
                                $mclose = getTime($mclose1[0],1);
                              }
                          ?>
                          <input class="form-control"  type="<?=$closetype?>" name="dteClose" id="dteClose" value="<?=$close_value_date?>">

                          <?=$close_onpage?>
                          <input class="form-control"  name="cmbCloseHH" type="hidden" id="cmbCloseHH" value="<?=$hclose?>" size="2" readonly="readonly"/>
                          <input class="form-control"  name="cmbCloseTT" type="hidden" id="cmbCloseTT" value="<?=$mclose?>" size="2" readonly="readonly"/>
                          <? } else { ?>
                            <font color="gray"><?=date("Y-m-d H:i:s");?></font>
                          <? } ?>

                      </td>
                  </tr>

                  <?
                  if($type=="edit") {
                    if($_SESSION['Ustate'] ==  "helpdesk" || $_SESSION['Ustate'] ==  "admin") {?>
                  <tr>
                    <td height="25" align="left" class="fontBblue">
                    </td>
                    <td height="25" align="left" class="fontBblue">
                      <a href="logcall.edit.datetime.php?jid=<?=$id?>"><u>Edit Datetime</u></a>
                    </td>
                  </tr>
                  <? } } ?>

                  <tr>

                      <td height="25" align="left" class="fontBblue" ><nobr><?=iconv( 'UTF-8', 'TIS-620', "Status Job :");?></td>
                      <td height="25" align="left" class="fontBblue"><nobr>
                        <select name="cmbStatus" id="cmbStatus" style="width:160pt"   />
                          <option value="feedback" <?if($c["status_call"]=="feedback") echo "selected";?>>Feedback</option>
                          <option value="close" <?if($c["status_call"]=="close") echo "selected";?>>Close</option>
                          <option value="cancel" <?if($c["status_call"]=="cancel") echo "selected";?>>Cancel</option>
                          <option value="cancel not paid" <?if($c["status_call"]=="cancel_no_pay") echo "selected";?>>Cancel(no paid)</option>
                          <option value="waithw" <?if($c["status_call"]=="waithw") echo "selected";?>><?=iconv( 'UTF-8', 'TIS-620', "รออุปกรณ์");?></option>
                        </select>
                        </td>

                <?if($_SESSION['Ustate'] ==  "helpdesk" || $_SESSION['Ustate'] ==  "admin") {?>
                      <td height="25" align="left" class="fontBblue" ><nobr><font color='red'>SLA (PTT) : </font>
              <input class="form-control"  name="txtStatusSLA" type="text" id="txtStatusSLA" value="<?=$c['status_sla'];?>" style="width:60pt" readonly /></td>
		<?}?>
		<td height="25" align="left" class="fontBblue" ><nobr>SLA (BSS) :
              <input class="form-control"  name="status_cat_bss" type="text" id="status_cat_bss" value="<?=$c['status_cat_bss'];?>" style="width:60pt" readonly /></td>

                     </tr>
                     <tr>&nbsp;
                     <? if($_SESSION["Ustate"]=="admin" || $_SESSION["Ustate"]=="helpdesk" ) {
                          ?>
                       <td height="25" align="left" class="fontBblue" ><?=iconv( 'UTF-8', 'TIS-620', "Status Withdraw:");?></td>
                       <td height="25" align="left" class="fontBblue" >

                         <select name="withdraw" id="withdraw"  style="width:160pt">
                         <option value="y" <? if($c['paid_status']=="y"){ echo "selected";} ?>>Withdraw</option>
                         <option value="n" <? if($c['paid_status']=="n"){ echo "selected";} ?>>Not Withdraw</option>
                         </select>
                       </td>
                       
                     
                     <? }else{
                       ?>
                        <input class="form-control"  name="withdraw" type="hidden" id="withdraw" value="<?=$c['paid_status'];?>"  />

                    <? } ?>

<!--td height="25" align="left" class="fontBblue"  >&nbsp;
			</td--><td height="25" align="left" class="fontBblue" ><font color='red'>BKK.=3.00 / UPC.2.50 </font>
                         <select name="fee_km" id="fee_km"  style="width:160pt">
                         <option value="2.75" <? if($c['fee_km']=="2.75"){ echo "selected";} ?>>2.75</option>
                         <option value="3.00" <? if($c['fee_km']=="3.00"){ echo "selected";} ?>>3.00</option>
                         </select>
                       </td>
</tr>
                    <tr>
                      <td height="25" align="left" class="fontBblue" valign="top" ><?=iconv( 'UTF-8', 'TIS-620', "Comment :");?></td>
                      <td height="25" align="left" class="fontBblue" colspan="8"><nobr>
                        <input class="form-control"  name="txtComment" id="txtComment" value="<?=$c['commente'];?>" style="width:630pt" ></td>
                    </tr>
	<!--  แบบสำรวจและประเมิน -->


  <tr> 
      
  <table style="width: 100%; font-size: 12px;margin-bottom: 30px " class="mytable11" border=0 cellpadding=0 CELLSPACING=0>
            <tr >
             <td height="25" colspan="2" align="center" class="fontBblue" valign="top" ><br><br><?=iconv( 'UTF-8', 'TIS-620', "แบบสำรวจและประเมินโดย Call สอบถามลูกค้าเรื่องช่าง");?></td>
            <td></td>
            <td></td>
  </tr>
                    <tr onmouseover="this.style.backgroundColor='violet';" onmouseout="this.style.backgroundColor='white';" >
                      <td height="25" align="left" class="fontBblue" valign="top" ><?=iconv( 'UTF-8', 'TIS-620', "1. ช่างแก้ไข เสร็จเรียบร้อย และ สามารถ ใช้งานได้ตามปรกติ รึยัง");?></td>
                      <td height="25" align="left" class="fontBblue" colspan="8"><nobr>
                        <select name="evaluate1" id="evaluate1" >
                          <!--option value="0" <?//if($c['evaluate1']=="0") echo "selected";?>><?//=iconv( 'UTF-8', 'TIS-620', "เลือก");?></option-->
                          <option value="1" <?if($c['evaluate1']=="1") echo "selected";?>><?=iconv( 'UTF-8', 'TIS-620', "ควรปรับปรุง");?></option>
                          <option value="2" <?if($c['evaluate1']=="2") echo "selected";?>><?=iconv( 'UTF-8', 'TIS-620', "พอใช้");?></option>
                          <option value="3" <?if($c['evaluate1']=="3") echo "selected";?>><?=iconv( 'UTF-8', 'TIS-620', "ดี");?></option>
                        </select>
                        </td>
                    </tr>
                    <tr onmouseover="this.style.backgroundColor='violet';" onmouseout="this.style.backgroundColor='white';" >
                      <td height="25" align="left" class="fontBblue" valign="top" ><?=iconv( 'UTF-8', 'TIS-620', "2. เวลาที่ ช่างเข้าถึง ตามเวลา ที่ Confirm กันหรือไม่");?></td>
                      <td height="25" align="left" class="fontBblue" colspan="8"><nobr>
                        <select name="evaluate2" id="evaluate2" >
                          <!--option value="0" <?//if($c['evaluate2']=="0") echo "selected";?>><?//=iconv( 'UTF-8', 'TIS-620', "เลือก");?></option-->
                          <option value="1" <?if($c['evaluate2']=="1") echo "selected";?>><?=iconv( 'UTF-8', 'TIS-620', "ควรปรับปรุง");?></option>
                          <option value="2" <?if($c['evaluate2']=="2") echo "selected";?>><?=iconv( 'UTF-8', 'TIS-620', "พอใช้");?></option>
                          <option value="3" <?if($c['evaluate2']=="3") echo "selected";?>><?=iconv( 'UTF-8', 'TIS-620', "ดี");?></option>
                        </select></td>
                    </tr>
                    <tr onmouseover="this.style.backgroundColor='violet';" onmouseout="this.style.backgroundColor='white';" >
                      <td height="25" align="left" class="fontBblue" valign="top" ><?=iconv( 'UTF-8', 'TIS-620', "3. การแต่งกาย ของช่าง เรียบร้อย หรือไม่");?></td>
                      <td height="25" align="left" class="fontBblue" colspan="8"><nobr>
                        <select name="evaluate3" id="evaluate3" >
                          <!--option value="0" <?//if($c['evaluate3']=="0") echo "selected";?>><?//=iconv( 'UTF-8', 'TIS-620', "เลือก");?></option-->
                          <option value="1" <?if($c['evaluate3']=="1") echo "selected";?>><?=iconv( 'UTF-8', 'TIS-620', "ควรปรับปรุง");?></option>
                          <option value="2" <?if($c['evaluate3']=="2") echo "selected";?>><?=iconv( 'UTF-8', 'TIS-620', "พอใช้");?></option>
                          <option value="3" <?if($c['evaluate3']=="3") echo "selected";?>><?=iconv( 'UTF-8', 'TIS-620', "ดี");?></option>
                        </select></td>
                    </tr>
                    <tr onmouseover="this.style.backgroundColor='violet';" onmouseout="this.style.backgroundColor='white';" >
                      <td height="25" align="left" class="fontBblue" valign="top" ><?=iconv( 'UTF-8', 'TIS-620', "4. ความพร้อมของช่าง ที่ เข้า Service มีความพร้อมแค่ไหน");?></td>
                      <td height="25" align="left" class="fontBblue" colspan="8"><nobr>
                        <select name="evaluate4" id="evaluate4" >
                          <!--option value="0" <?//if($c['evaluate4']=="0") echo "selected";?>><?//=iconv( 'UTF-8', 'TIS-620', "เลือก");?></option-->
                          <option value="1" <?if($c['evaluate4']=="1") echo "selected";?>><?=iconv( 'UTF-8', 'TIS-620', "ควรปรับปรุง");?></option>
                          <option value="2" <?if($c['evaluate4']=="2") echo "selected";?>><?=iconv( 'UTF-8', 'TIS-620', "พอใช้");?></option>
                          <option value="3" <?if($c['evaluate4']=="3") echo "selected";?>><?=iconv( 'UTF-8', 'TIS-620', "ดี");?></option>
                        </select></td>
                    </tr>
                    <tr onmouseover="this.style.backgroundColor='violet';" onmouseout="this.style.backgroundColor='white';" >
                      <td height="25" align="left" class="fontBblue" valign="top" ><?=iconv( 'UTF-8', 'TIS-620', "5. การให้ คำแนะนำของช่าง เพียงพอหรือไม่");?></td>
                      <td height="25" align="left" class="fontBblue" colspan="8"><nobr>
                        <select name="evaluate5" id="evaluate5">
                          <!--option value="0" <?//if($c['evaluate5']=="0") echo "selected";?>><?//=iconv( 'UTF-8', 'TIS-620', "เลือก");?></option-->
                          <option value="1" <?if($c['evaluate5']=="1") echo "selected";?>><?=iconv( 'UTF-8', 'TIS-620', "ควรปรับปรุง");?></option>
                          <option value="2" <?if($c['evaluate5']=="2") echo "selected";?>><?=iconv( 'UTF-8', 'TIS-620', "พอใช้");?></option>
                          <option value="3" <?if($c['evaluate5']=="3") echo "selected";?>><?=iconv( 'UTF-8', 'TIS-620', "ดี");?></option>
                        </select></td>
                    </tr>
                    <tr onmouseover="this.style.backgroundColor='violet';" onmouseout="this.style.backgroundColor='white';" >
                      <td height="25" align="left" class="fontBblue" valign="top" ><?=iconv( 'UTF-8', 'TIS-620', "6. กิริยา มารยาท ของช่าง เป็นยังงัย");?></td>
                      <td height="25" align="left" class="fontBblue" colspan="8"><nobr>
                        <select name="evaluate6" id="evaluate6"  >
                          <!--option value="0" <?//if($c['evaluate6']=="0") echo "selected";?>><?//=iconv( 'UTF-8', 'TIS-620', "เลือก");?></option-->
                          <option value="1" <?if($c['evaluate6']=="1") echo "selected";?>><?=iconv( 'UTF-8', 'TIS-620', "ควรปรับปรุง");?></option>
                          <option value="2" <?if($c['evaluate6']=="2") echo "selected";?>><?=iconv( 'UTF-8', 'TIS-620', "พอใช้");?></option>
                          <option value="3" <?if($c['evaluate6']=="3") echo "selected";?>><?=iconv( 'UTF-8', 'TIS-620', "ดี");?></option>
                        </select></td>
                    </tr>

</tr>

					<tr>
					  <td colspan=4 align=center>
						<!--  แสดงส่วนรับงาน -->
						<div style="width: 100%; margin-top: 20px;">
						  <?
						  if($_SESSION["Ustate"]=="admin" ||$_SESSION["Ustate"]=="helpdesk" )
						  {
						  ?>
						
						<? } ?>
						<table style="width: 100%; font-size: 12px;margin-bottom: 30px " class="mytable11" border=0 cellpadding=0 CELLSPACING=0>
            <tr>
            <td></td>
            <td></td>
            <td></td>
            <td align="right">
            </td>
            <td align="right">
            <a href="route_gps.1.php?job_id=<?=$id?>&job_no=<?=$c[job_no]?>&job_type=PTT&engineer=<?= $c[reciept_job_user_id]?>" target="_blank">
						<?=iconv( 'UTF-8', 'TIS-620', "Distance");?></a> 
            | 
            <a href="route_gps.php?jobid=<?=$id?>&jobno=<?=$c["job_no"];?>&jobtype=PTT" target="_blank">
						<?=iconv( 'UTF-8', 'TIS-620', "Map");?></a>
            </td>
            </tr>
						  <tr >
							<th class="th">#</th>
							<th class="th">Datetime</th>
							<th class="th">Latitude&Longitude</th>
							<th class="th">Address</th>
							<th class="th">Status</th>
						  </tr>
						  <?
						  $sql_location="select a.id,a.user_id,a.job_no,a.dtetme,a.la,a.lo,a.len_total,a.address,a.status_shared from tbl_job_location a
												where a.job_no = '$id'
												and a.job_type='PTT'";
						   $rs_location=mysqli_query($conn,$sql_location);
						   $num_location = mysqli_num_rows($rs_location);
						   $i=1;
						   if($num_location == 0){
							?>
							<tr>
							<td>-</td>
							<td>-</td>
							<td>-</td>
							<td>-</td>
							<td>-</td>
						  </tr>
							<?
						   }
						  while($row_location = mysqli_fetch_array($rs_location)){
							switch ($row_location["status_shared"]) {
							case "G" : $status_shared=iconv( 'UTF-8', 'TIS-620', "Get Job/Geocoding"); break;
							case "O" : $status_shared=iconv( 'UTF-8', 'TIS-620', "On Site");break;
							case "C" : $status_shared=iconv( 'UTF-8', 'TIS-620', "Close Job");break;
							case "F" : $status_shared=iconv( 'UTF-8', 'TIS-620', "At Home");break;
							}
						  ?>
						  <tr>
							<td><?=$i?></td>
							<td><?=$row_location["dtetme"]?></td>
							<td><?=$row_location["la"]?>,<?=$row_location["lo"]?></td>
							<td><?=iconv( 'UTF-8', 'TIS-620', $row_location["address"])?></td>
							<td><?=$status_shared?></td>
						  </tr>
						  <? $i++; } ?>
						</table>


            <?
            if($type=="edit") {
              if($_SESSION["Ustate"]=="admin" ||$_SESSION["Ustate"]=="helpdesk" ){ ?>

            <table style="width: 100%; font-size: 12px;margin-bottom: 30px " class="mytable11" border=1 cellpadding=0 CELLSPACING=0>
              <tr>
                <th class="th">#</th>
                <th class="th">Update by</th>
                <th class="th">Update time</th>
                <th class="th" width="70%">Status Update</th>
              <tr/>
              <?
              $sql_update=" select
                            a.*
                            ,b.name,b.sname
                            from tbl_log_call_transaction a
                            left outer join tbl_user b on a.user_update=b.user_id
                            where a.job_no = '".$c['job_no']."'
                            order by a.id ASC
                            ";
               $rs_update=mysqli_query($conn,$sql_update);
               $num_update = mysqli_num_rows($rs_update);
               $iu=-1;
               $ir=1;
               while($row_update = mysqli_fetch_array($rs_update))
               {
               ?>
              <tr>
                <td><?=$ir?></td>
                <td><?=$row_update["name"]?> <?=$row_update["sname"]?></td>
                <td><?=$row_update["user_update_datetime"]?></td>
                <td>
                  <?

                  if($row_update["status_transaction"]=="e"){
                    if( $iu=="1" ){ $limit="1";} else {$limit="$iu,1";}
                    $sql_update_check="select
                                  a.*
                                  from tbl_log_call_transaction a
                                  left outer join tbl_user b on a.user_update=b.user_id
                                  where a.job_no = '".$c['job_no']."'
                                  order by a.id ASC limit $limit
                                  ";
                     $rs_update_check=mysqli_query($conn,$sql_update_check);
                     $row_update_check = mysqli_fetch_array($rs_update_check);
                     $sql_update_last=" select
                                   a.*
                                   from tbl_log_call_transaction a
                                   left outer join tbl_user b on a.user_update=b.user_id
                                   where a.id = '".$row_update["id"]."'
                                   order by a.id ASC
                                   ";
                      $rs_update_last=mysqli_query($conn,$sql_update_last);
                      $row_update_last = mysqli_fetch_array($rs_update_last);

                      if($row_update_check["call_type"] != $row_update_last["call_type"]){ echo " <il class='status_update'>-JobType</il> "; }
                      if($row_update_check["open_call_dte"] != $row_update_last["open_call_dte"] || $row_update_check["open_call_tme"] != $row_update_last["open_call_tme"]){ echo " <il class='status_update'->OpenDatetime</il> "; }
                      if($row_update_check["category_type"] != $row_update_last["category_type"]){ echo " <il class='status_update'>-CategoryType</il> "; }
                      if($row_update_check["bss_msr_no"] != $row_update_last["bss_msr_no"]){ echo " <il class='status_update'>-MSR</il> "; }
                      if($row_update_check["site_id"] != $row_update_last["site_id"]){ echo " Site "; }
                      if($row_update_check["customer_contact"] != $row_update_last["customer_contact"]){ echo " <il class='status_update'>-Contact</il> "; }
                      if($row_update_check["customer_tel"] != $row_update_last["customer_tel"]){ echo " <il class='status_update'>-CustomerTel</il> "; }
                      if($row_update_check["problem"] != $row_update_last["problem"]){ echo " <il class='status_update'>-Problem</il> "; }
                      if($row_update_check["severity"] != $row_update_last["severity"]){ echo " <il class='status_update'>-CAT(PTT)</il> "; }
                      if($row_update_check["sla"] != $row_update_last["sla"]){ echo " <il class='status_update'>-HourSLA(PTT)</il> "; }
                      if($row_update_check["open_type"] != $row_update_last["open_type"]){ echo " <il class='status_update'>-OpenJobBy</il> "; }
                      if($row_update_check["reciept_job_user_id"] != $row_update_last["reciept_job_user_id"]){ echo " <il class='status_update'>-Engineer</il> "; }
                      if($row_update_check["problem_solving"] != $row_update_last["problem_solving"]){ echo " <il class='status_update'>-ProblemSolving</il> "; }
                      if($row_update_check["dateline_solving"] != $row_update_last["dateline_solving"]){ echo " <il class='status_update'>-DatelineSolving</il> "; }
                      if($row_update_check["onsite_datetime"] != $row_update_last["onsite_datetime"]){ echo " <il class='status_update'>-OnsiteDatetime</il> "; }
                      if($row_update_check["fixed_time"] != $row_update_last["fixed_time"]){ echo " <il class='status_update'>-FixedeDatetime</il> "; }
                      if($row_update_check["closed_date"] != $row_update_last["closed_date"] || $row_update_check["closed_time"] != $row_update_last["closed_time"] ){ echo " <il class='status_update'>-CloseDatetime</il> "; }
                      if($row_update_check["status_call"] != $row_update_last["status_call"]){ echo " <il class='status_update'>-StatusJob($row_update_last[status_call])</il> "; }
                      if($row_update_check["commente"] != $row_update_last["commente"]){ echo " <il class='status_update'>-Commente</il> "; }
                      if($row_update_check["doc"] != $row_update_last["doc"]){ echo " <il class='status_update'>-Document</il> "; }
                      if($row_update_check["type_problem"] != $row_update_last["type_problem"]){ echo " <il class='status_update'>-ProblemType</il> "; }
                      if($row_update_check["provice_phase"] != $row_update_last["provice_phase"]){ echo " <il class='status_update'>-Province</il> "; }
                      if($row_update_check["appoint_date"] != $row_update_last["appoint_date"] || $row_update_check["appoint_time"] != $row_update_last["appoint_time"] ){ echo " <il class='status_update'>-AppointDatetime</il> "; }
                      if($row_update_check["cat_bss"] != $row_update_last["cat_bss"]){ echo " <il class='status_update'>-CAT(BSS)</il> "; }
                      if($row_update_check["cat_hour"] != $row_update_last["cat_hour"]){ echo " <il class='status_update'>-HourSLA(BSS)</il> "; }
                      if($row_update_check["manday"] != $row_update_last["manday"]){ echo " <il class='status_update'>-Manday</il> "; }
                      if($row_update_check["paid_status"] != $row_update_last["paid_status"]){ echo " <il class='status_update'>-StatusWithdraw</il> "; }
                    }
                    else{
                      echo "<il class='status_update'>-OpenJob</il>" ;
                    }

                  ?>
                </td>
              <tr/>
              <? $iu++; $ir++; } ?>
            </table>
            <? } } ?>
						</div>
					  </td>

					</tr>
                </table>


            </form></td></tr></table>
<?

	function getWayLang($site_id){
		global $conn;
		$sql = "select * from tbl_site_ngv_responsible where site_id = '$site_id'";
		$rc = mysqli_query($conn,$sql);
		while($c = mysqli_fetch_array($rc)){
			$str = "¨Ò¡ ".$c["center_position"]." ( ".$c["way_length"]." ) ¡Á ";
		}
    return $str;
}
?>
<script type="text/javascript">
    var props = {	formatDate :		'%m-%d-%y'	};
    props.formatDate = '%y-%m-%d';
    var cdp1 = new CalendarDatePicker(props);

    function CheckText(){
        if(document.form1.open_date.value == "") {
            alert('Input Open Date.');
            document.form1.open_date.focus();
            return false;
        }
        if(document.form1.cmbCateType.value == "") {
            alert('Input Category Job.');
            document.form1.cmbCateType.focus();
            return false;
        }

        if(document.form1.txtSid.value == "") {
            alert('Input Site.');
            document.form1.txtSid.focus();
            return false;
        }

		 if(document.form1.UserEngineerID.value == "") {
            alert('Input Engineer.');
            document.form1.cmbUserEngineer.focus();
            return false;
        }
        return true;
    }

    function getCategoryType(id,val){
        myleft=(screen.width)?(screen.width-800)/2:100;
        mytop=(screen.height)?(screen.height-300)/2:100;
        properties = " width=800,height=300";

            var cat = document.form1.type_call.value;

        properties +=",menubar=no,scrollbars=auto,scrollbars=auto, top="+mytop+",left="+myleft;
        window.open("sch_categry_work.php?cat="+cat,"Search",properties);
    }

    function getSite(id){
        myleft=(screen.width)?(screen.width-800)/2:100;
        mytop=(screen.height)?(screen.height-300)/2:100;
        properties = " width=800,height=300";

            var type = document.form1.type_call.value;
            var site = document.form1.txtSid.value;

            if(site==""){
             alert("Input Site ID.");
             document.form1.txtSid.focus();
             return;
            }

        properties +="directories=no,titlebar=no,toolbar=no,location=no,status=no,menubar=no,scrollbars=yes, top="+mytop+",left="+myleft;
        window.open("sch_site.php?type="+type+"&site="+site,"Search",properties);

    }

    function getUser(frm,type){
        myleft=(screen.width)?(screen.width-800)/2:100;
        mytop=(screen.height)?(screen.height-300)/2:100;
        properties = " width=800,height=300";

          //  var type = document.form1.cmbUserReceipt.value;
           // var site = document.form1.cmbUserEngineer.value;

        properties +="directories=no,titlebar=no,toolbar=no,location=no,status=no,menubar=no,scrollbars=yes, top="+mytop+",left="+myleft;
        window.open("sch_user.php?frm="+frm+"&type="+type,"Search",properties);

    }

     function getCateHour(){

            var cmbCat = document.form1.cmbCat.value;
			var txtslq1 = document.form1.way_length.value;

			var n = txtslq1.split("(");
			var txtslq = n[1].split(".");
		//	 alert(txtslq[0]);
            if(cmbCat=="CAT 1"){
                if(txtslq[0] >= 200){
                    document.form1.txtSLA.value = "6";
                } else {
                    document.form1.txtSLA.value = "4";
                }
            } else if(cmbCat=="CAT 2"){
				  if(txtslq[0] >= 200){
						document.form1.txtSLA.value = "10";
					} else {
						document.form1.txtSLA.value = "6";
					}
            } else if(cmbCat=="CAT 3"){
              if(txtslq[0] >= 200){
                    document.form1.txtSLA.value = "16";
                } else {
                    document.form1.txtSLA.value = "12";
                }
            } else if(cmbCat=="CAT 4"){
              document.form1.txtSLA.value = "24";
            }   else if(cmbCat=="CAT 0"){
              document.form1.txtSLA.value = "2";
            }

    }

    function entry_serial_no_ptt(val,jobno,user_engineer,service_type,type_call){
      var sparepartforbis = "";
        if(val==""){
           alert('Input Site ID.');
           document.form1.txtSid.focus();
           return;
        } else if(jobno==""){
           alert('Input JobNo.');
           document.form1.txtJobNo.focus();
           return;
        } else if(user_engineer==""){
           alert('Input Engineer');
           document.form1.UserEngineerID.focus();
           return;
        } else if(service_type==""){
           alert('Input Team.');
           document.form1.cmbServiceType.focus();
           return;
        } else {
	    if(type_call==39) {
		sparepartforbis = "ALLOilNGV','ALLOilOnly','ALLOilRicohOnly";	    
	    } else if(type_call==2) { 
		//sparepartforbis = "PTT NGV";   
		//  if(confirm('Serial ที่ต้องการจะเปลี่ยน เป็นของที่ใช่ร่วมกันทั้ง NGV และ OIL ด้วยหรือไม่ \n\n\n ถ้าใช้ให้กด OK \n\nถ้าไม่ใช่ให้กด Cancel \n\n')){
		    sparepartforbis = "NGVONLY','ALLOilNGV";
		//  }
	    }else if(type_call==3) { 
		///sparepartforbis = "PTT OIL";   
		//  if(confirm('Serial ที่ต้องการจะเปลี่ยน เป็นของที่ใช่ร่วมกันทั้ง NGV และ OIL ด้วยหรือไม่ \n\n\n ถ้าใช้ให้กด OK \n\nถ้าไม่ใช่ให้กด Cancel \n\n')){
		    sparepartforbis = "OILONLY','ALLOilNGV','ALLOilOnly";
		///  }
	    }
	  
	  
	  
	  
	  
	  
            myleft=(screen.width)?(screen.width-600)/2:100;
            mytop=(screen.height)?(screen.height-300)/2:100;
            properties = " width=800,height=600";
            properties +="directories=no,titlebar=no,toolbar=no,location=no,status=no,menubar=no,scrollbars=yes, top="+mytop+",left="+myleft;
            window.open("serial_no_all.php?id="+val+"&jobno="+jobno+"&user_engineer="+user_engineer+"&service_type="+service_type+"&type_call="+type_call+"&sparepartforbis="+sparepartforbis,"Entry",properties);
        }
    }

    function entry_serial_no_pttxx(val,jobno,user_engineer,service_type,type_call){
      var sparepartforbis = "";
var cmd = 'Serial No. NGV & OIL\n\n\n OK  =  All\n\n Cancel =  Only\n\n';
        if(val==""){
           alert('Input Site ID.');
           document.form1.txtSid.focus();
           return;
        } else if(jobno==""){
           alert('Input JobNo.');
           document.form1.txtJobNo.focus();
           return;
        } else if(user_engineer==""){
           alert('Input Engineer');
           document.form1.UserEngineerID.focus();
           return;
        } else if(service_type==""){
           alert('Input Team.');
           document.form1.cmbServiceType.focus();
           return;
        } else {
	    if(type_call==39) {
		sparepartforbis = "Ricoh-Oil";	    
	    } else if(type_call==2) { 
		sparepartforbis = "PTT NGV";   
	
				
		  if(confirm(<?=iconv( 'TIS-620', 'UTF-8', cmd);?>)){
		    sparepartforbis = "ALLOilNGV','PTT NGV";
		  }
	    }else if(type_call==3) { 
		sparepartforbis = "PTT OIL";   
		  if(confirm(<?=iconv( 'TIS-620', 'UTF-8', cmd);?>)){
		    sparepartforbis = "ALLOilNGV','PTT OIL";
		  }
	    }
	  
            myleft=(screen.width)?(screen.width-600)/2:100;
            mytop=(screen.height)?(screen.height-300)/2:100;
            properties = " width=800,height=600";
            properties +="directories=no,titlebar=no,toolbar=no,location=no,status=no,menubar=no,scrollbars=yes, top="+mytop+",left="+myleft;
            window.open("serial_no_all.php?id="+val+"&jobno="+jobno+"&user_engineer="+user_engineer+"&service_type="+service_type+"&type_call="+type_call+"&sparepartforbis="+sparepartforbis,"Entry",properties);
        }
    }

    function entry_serial_no_bss(val,jobno,user_engineer,service_type){
        if(val==""){
           alert('Input Site ID.');
           document.form1.txtSid.focus();
           return;
        } else if(jobno==""){
           alert('Input JobNo.');
           document.form1.txtJobNo.focus();
           return;
        } else if(user_engineer==""){
           alert('Input Engineer.');
           document.form1.UserEngineerID.focus();
           return;
        } else if(service_type==""){
           alert('Input Team.');
           document.form1.cmbServiceType.focus();
           return;
        } else {
            myleft=(screen.width)?(screen.width-600)/2:100;
            mytop=(screen.height)?(screen.height-300)/2:100;
            properties = " width=800,height=600";
            properties +="directories=no,titlebar=no,toolbar=no,location=no,status=no,menubar=no,scrollbars=yes, top="+mytop+",left="+myleft;
            window.open("edit_serial_retail.php?id="+val+"&jobno="+jobno+"&user_engineer="+user_engineer+"&service_type="+service_type,"Entry",properties);
        }
    }

	function ckeckrude(txt, data ){
var wordrude = new Array ( "IP","Ip","ip","S/N","S/n","s/n","DTAC","Dtac","dtac","CAT","Cat","cat","´Õá·¡","á¤·","01Z0","10.94","8966","8676");
  var wordchange =  "****";//alert('¡ÃØ³¡ÃÍ¡¢éÍÁÙÅãËé¶Ù¡·Õè ´éÇÂ¤ÃÑº');
 /// wordchange = "";
  //alert(txt);
  for ( n = 0 ; n < wordrude.length ; n++ )  {
    pattern = new RegExp( wordrude[n] , "gi" );
    data = data.replace( pattern , wordchange );
	if(txt=="txtProblemSolving") {
		document.getElementById("txtProblemSolving").value = data;
		//  document.form1.txtProblemSolving.focus();
		} else if (txt=="txtComment") {
		document.getElementById("txtComment").value = data;
	//	document.form1.txtComment.focus();
		}
  };
  //return data;
};


</script>

</form>

<table id="calendarTable">
    <tbody id="calendarTableHead">
        <tr>
            <td colspan="4" align="left">
                <select id="selectMonth">
                    <option value="0">January</option>
                    <option value="1">February</option>
                    <option value="2">March</option>
                    <option value="3">April</option>
                    <option value="4">May</option>
                    <option value="5">June</option>
                    <option value="6">July</option>
                    <option value="7">August</option>
                    <option value="8">September</option>
                    <option value="9">October</option>
                    <option value="10">November</option>
                    <option value="11">December</option>
                </select>
            </td>
            <td colspan="2" align="center"><select id="selectYear"></select></td>
            <td align="right"><a href="#" id="closeCalendarLink">X</a></td>
        </tr>
    </tbody>
    <tbody id="calendarTableDays">
        <tr id="calenderDaysIndex">
            <td>Su</td><td>Mo</td><td>Tu</td><td>We</td><td>Thu</td><td>Fr</td><td>Sa</td>
        </tr>
    </tbody>
    <tbody id="calendar"></tbody>
</table>
