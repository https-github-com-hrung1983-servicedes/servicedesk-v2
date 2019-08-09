<?
header("Content-Type: text/html; charset=tis-620");
//session_start();
require_once("function.php");

if(!checkUser()){    echo Message(35,"red",$titel1,$msg1,"<a href='index.php?link=logcall.index'> $login </a>");
  exit;
  }
$id = $_REQUEST["id"];
$type = $_REQUEST["type"];
if($type != "add" && $type !="edit" ){
 echo Message(35,"red",$titel1,$msg1,"<a href='index.php?link=logcall.index'> $login </a>");
 exit;
}
include("header.php");
if ($type == "add") {
    $open_date = getDte();
    $appoint_date = getDte();
    $onsite_date = getDte();
    $fix_date = getDte();
    $close_date = getDte();
} elseif ($type == "edit") {
  $sql = "SELECT
itbl_logcall_retail.id,
itbl_logcall_retail.job_no,
itbl_logcall_retail.ref_job_no,
itbl_logcall_retail.msr_no,
itbl_logcall_retail.customer_id,
itbl_logcall_retail.contact_job,
itbl_logcall_retail.contact_tel,
itbl_logcall_retail.problem_job,
itbl_logcall_retail.problem_job_detail,
itbl_logcall_retail.cat,
itbl_logcall_retail.cat_time,
itbl_logcall_retail.reciept_job_call,
itbl_logcall_retail.reciept_job_engineer,
itbl_logcall_retail.problem_solving,
itbl_logcall_retail.problem_soving_by,
itbl_logcall_retail.call_openjob_datetime,
itbl_logcall_retail.appoint_datetime,
itbl_logcall_retail.deadline_solving,
itbl_logcall_retail.onsite_datetime,
itbl_logcall_retail.fixed_datetime,
itbl_logcall_retail.close_datetime,
itbl_logcall_retail.status_sla,
itbl_logcall_retail.status_call,
itbl_logcall_retail.comment_job,
itbl_logcall_retail.doc,
itbl_customer4.customer_name,
itbl_category_job.category_job,
u1.name AS namecall,
u1.sname AS snamecall,
u2.name AS nameengineer,
u2.sname AS snameegineer,
u2.tel,
itbl_customer3.customer_name as name3,
itbl_customer2.customer_name as name2,
itbl_customer1.customer_name as name1,
itbl_customer1.id as id1,
itbl_customer2.id as id2,
itbl_customer3.id as id3,
itbl_customer4.id as id4,
itbl_customer4.customer_id as id4customerid
FROM
itbl_logcall_retail
Left Join itbl_customer4 ON itbl_logcall_retail.customer_id = itbl_customer4.id
Left Join itbl_category_job ON itbl_logcall_retail.problem_job = itbl_category_job.id
Left Join tbl_user AS u1 ON itbl_logcall_retail.reciept_job_call = u1.user_id
Left Join tbl_user AS u2 ON itbl_logcall_retail.reciept_job_engineer = u2.user_id
Inner Join itbl_customer3 ON itbl_customer4.customer_level3 = itbl_customer3.id
Inner Join itbl_customer2 ON itbl_customer3.customer_level2 = itbl_customer2.id
Inner Join itbl_customer1 ON itbl_customer2.customer_level1 = itbl_customer1.id
Where itbl_logcall_retail.id = $id";
//  echo $sql;
  $rs = mysqli_query($conn,$sql);
  $c = mysqli_fetch_array($rs);
    $open_date = $c["call_openjob_datetime"];
    $appoint_date = $c["appoint_datetime"];
    $onsite_date = $c["onsite_datetime"];
    $fix_date = $c["fixed_datetime"];
    $close_date = $c["close_datetime"];
    
    
}
?>

<meta http-equiv="Content-Type" content="text/html; charset=TIS-620" />
<link href="image/bss_icon.ico"   rel="shortcut icon" />
<link href="style/calendar.css" rel="stylesheet" type="text/css">
<link href="style/mytable.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="script/calendar_date_picker.js"></script>
<link href="style/stylecss.css" rel="stylesheet" type="text/css">
<link href="style/filtergrid.css" rel="stylesheet" type="text/css">
<style type="text/css">
    <!--
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
    -->
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
					var job_no = $("#job_no").val();

					if(job_no==""){
							var d = new Date();
							var dte = d.getFullYear()+"-"+(d.getMonth()+1)+"-"+d.getDate();
						$.post('function.execute.php',{mode : "gen_id_bss",dte : dte},
							function(data){
								$("#job_no").val(data);
							});
							return false;
					} else {
							$("#job_no").val('');
					}
		});


});
</script>

<table width="100%" align="center" class="mytable11"  height="100%"   cellpadding="1" cellspacing="1" >
    <tr>
        <td valign="top" align="center">
            <form action="logcall.retail.execute.php"  method="post"  name="form1" id="form1"  >
            <input class="form-control"  type="hidden" value="<?=$id?>" name="id" id = "id">
            <input class="form-control"  type="hidden" value="<?=$type?>" name="mode" id = "mode">
            <input class="form-control"  type="hidden" value="<?=$_REQUEST["dte_beg"]?>" name="dte_beg" id = "dte_beg">
            <input class="form-control"  type="hidden" value="<?=$_REQUEST["dte_end"]?>" name="dte_end" id = "dte_end">
                <table width="100%" border="0" cellpadding="0" cellspacing="0" class="mytable" border="1" bordercolor="#FF0000">
                    <tr>
                        <th align="center" height="40" width="100%" colspan="7" class="th">Log call center</th>
                    </tr >
 <?if($_SESSION["Ustate"] == "admin" || $_SESSION["Ustate"] == "helpdesk"){?>
                    <tr>
                        <td width="95%" align="right" ></td>
			<td><input class="form-control"  name="Submit"  type="image" onclick=" return CheckText()"  src="image/save.jpg" alt="Save" align="right" width="20" height="20" />	</td>
			<td align="left"><b><?=iconv('UTF-8','TIS-620',"บันทึก");?></b>    </td>
			<td><a href="javascript:history.back(1)" ><img src="image/cancel.jpg" alt="Cancel" width="20" height="18" border="0" align="left" /> </a> </td>
			<td align="left"><nobr><b><?=iconv('UTF-8','TIS-620',"ยกเลิก");?></b>     </td>
                    </tr>
<?}?>
                </table>
                <br>
                <table width="100%" align="center"  id="table" cellpadding="1" cellspacing="1" border="0">
                    <tr>
                        <td width="15%" height="25" align="right" class="fontBblue"><?=iconv('UTF-8','TIS-620',"ลูกค้า");?> :  &nbsp;&nbsp;</td>
                        <td width="35%" height="25" align="left" class="fontBblue" >
			<select name="biz_typer" id="biz_typer"  style="width:200pt">
                            <?
                            $sql_customer1 = "Select * from itbl_customer1 order by customer_name";
                            $rs_customer1 = mysqli_query($conn,$sql_customer1);
                            while($c_customer1 = mysqli_fetch_array($rs_customer1)){
                            ?>
                               <option value = "<?=$c_customer1["id"];?>"<?if($c_customer1["id"]==$c["id1"]) echo "selected";?>><?=$c_customer1["customer_name"];?></option>
                            <?}?>
                        </select> &nbsp;
			<input class="form-control"  type="checkbox" name="doc" id="doc" <?if($c["doc"]=="true") echo "checked";?>  /> <?=iconv('UTF-8','TIS-620',"ส่งเอกสาร (MSR.)");?>
                        </td>
                        <td width="15%" height="25" align="right" class="fontBblue"><nobr><?=iconv('UTF-8','TIS-620',"เลขที่ใบงาน");?>  : &nbsp;&nbsp;</td>
                        <td width="35%" height="25" align="left" class="fontBblue"><input class="form-control"  type="text" name="job_no" id="job_no" value="<?=$c["job_no"];?>"  style="width:160pt" />
                          <?// if($type=="add") {?>
                          <input class="form-control"  type="checkbox" id="GenNo" name="GenNo"> <?=iconv('UTF-8','TIS-620',"ระบบสร้างใบงาน");?>
                          <?//}?>
                      </td>
                  </tr>
                  <tr>
                      <td width="15%" height="25" align="right" class="fontBblue"><nobr><?=iconv('UTF-8','TIS-620',"อ้างอิงเลขที่ใบงาน");?>  : &nbsp;&nbsp;</td>
                      <td width="35%" height="25" align="left" class="fontBblue"><input class="form-control"  name="ref_job_no" id="ref_job_no" value="<?=$c['ref_job_no']?>" style="width:250pt"></td>
                      <td width="15%" height="25" align="right" class="fontBblue"><nobr><?=iconv('UTF-8','TIS-620',"เลขที่ใบ MSR.");?>  : &nbsp;&nbsp;</td>
                      <td width="35%" height="25" align="left" class="fontBblue"><input class="form-control"  name="msr_no" id="msr_no" value="<?=$c['msr_no']?>" style="width:250pt"></td>
                  </tr>
                  <tr>
                      <td height="25" align="right" class="fontBblue"> <?=iconv('UTF-8','TIS-620',"รหัสลูกค้า");?>  :&nbsp;&nbsp;</td>
                      <td height="25" align="left" class="fontBblue" colspan="4"><nobr>
                          <input class="form-control"  name="customer_id" type="hidden" id="customer_id" style="width:160pt" value="<?=$c['customer_id']?>"  />
                          <input class="form-control"  name="cusid" type="text" id="cusid" style="width:160pt" value="<?=$c['id4customerid']?>" readonly />
                          <a href="javascript:getSite('biz_typer')">
                          <img src="image/search.gif" width="26" height="22" border="0" align="top" /></a>
                      <input class="form-control"  type="text" value="<?=$c['customer_name']?>" name="customer_name" id="customer_name" style="width:558pt" readonly  />
                    </tr>

                  <tr>
                      <td width="15%" height="25" align="right" class="fontBblue"><nobr><?=iconv('UTF-8','TIS-620',"ชื่อผู้แจ้ง ");?>  : &nbsp;&nbsp;</td>
                      <td width="35%" height="25" align="left" class="fontBblue"><input class="form-control"  name="contact_job" id="contact_job" value="<?=$c['contact_job']?>" style="width:250pt"></td>
                      <td width="15%" height="25" align="right" class="fontBblue"><nobr><?=iconv('UTF-8','TIS-620',"เบอร์โทรศัพท์ติดต่อ ");?>  : &nbsp;&nbsp;</td>
                      <td width="35%" height="25" align="left" class="fontBblue"><input class="form-control"  name="contact_tel" id="contact_tel" value="<?=$c['contact_tel']?>" style="width:250pt"></td>
                  </tr>

                  <tr>
                      <td width="15%" height="25" align="right" class="fontBblue"><nobr><?=iconv('UTF-8','TIS-620',"ประเภทของปัญหา ");?>  : &nbsp;&nbsp;</td>
                      <td width="35%" height="25" align="left" class="fontBblue" colspan="3">
                          <select name="problem_job" id="problem_job" style="width:745pt">
                                <?
                                    $sql_category_job = "select * from itbl_category_job  where active_job = 'y' order by category_job";
                                    $rs_category_job = mysqli_query($conn,$sql_category_job);
                                    while($c_category_job = mysqli_fetch_array($rs_category_job)){
                                ?>
                              <option value="<?=$c_category_job["id"]?>" <?if($c_category_job["id"]==$c["problem_job"]) echo "selected";?>><?=$c_category_job["category_job"];?></option>
                              <?}?>
                          </select>
                      </td>
                  </tr>

                  <tr>
                      <td width="15%" height="25" align="right" class="fontBblue"><nobr><?=iconv('UTF-8','TIS-620',"ปัญหา ");?>  : &nbsp;&nbsp;</td>
                      <td width="35%" height="25" align="left" class="fontBblue" colspan="3">
                          <input class="form-control"  name="problem_job_detail" id="problem_job_detail" value="<?=$c['problem_job_detail']?>" style="width:745pt"></td>
                  </tr>

                  <tr>
                      <td width="15%" height="25" align="right" class="fontBblue"><nobr><?=iconv('UTF-8','TIS-620',"ความรุนแรง ");?>  : &nbsp;&nbsp;</td>
                      <td width="35%" height="25" align="left" class="fontBblue">
                          <select name="cat" id="cat" style="width:250pt">
                              <option value="CAT 0" <?if($c['cat']=="CAT 0") echo "selected";?>><?=iconv('UTF-8','TIS-620',"ระดับ 0 ");?></option>
                              <option value="CAT 1" <?if($c['cat']=="CAT 1") echo "selected";?>><?=iconv('UTF-8','TIS-620',"ระดับ 1 ");?></option>
                              <option value="CAT 2" <?if($c['cat']=="CAT 2") echo "selected";?>><?=iconv('UTF-8','TIS-620',"ระดับ 2 ");?></option>
                              <option value="CAT 3" <?if($c['cat']=="CAT 3") echo "selected";?>><?=iconv('UTF-8','TIS-620',"ระดับ 3 ");?></option>
                              <option value="CAT 4" <?if($c['cat']=="CAT 4") echo "selected";?>><?=iconv('UTF-8','TIS-620',"ระดับ 4 ");?></option>
                          </select></td>
                      <td width="15%" height="25" align="right" class="fontBblue"><nobr><?=iconv('UTF-8','TIS-620',"ระยะเวลาแก้ไข ");?>  : &nbsp;&nbsp;</td>
                      <td width="35%" height="25" align="left" class="fontBblue">
                          <select name="cat_time" id="cat_time" style="width:215pt">
                              <? for($ii=1;$ii<=24;$ii++) { ?>
                              <option value="<?=$ii?>" <?if($ii==$c['cat_time']) echo "selected";?>><?=$ii?></option>
                              <?}?>
                              <option value="48" <?if($ii==$c['cat_time']) echo "selected";?>>48</option>
                          </select> &nbsp;<?=iconv('UTF-8','TIS-620'," ชั่วโมง");?>
                      </td>
                  </tr>
    <?
       if($c["reciept_job_bss"]==""){
          $reciept_id = $_SESSION["User_id"];
          $reciept_name = $_SESSION["Uname"]. " " .$_SESSION["Usname"];
      } else {
          $reciept_id  = $c["reciept_job_bss"];
          $reciept_name = $c["reciept_name"]. " " .$c["reciept_sname"];
      }
      ?>
                  <tr>
                      <td width="15%" height="25" align="right" class="fontBblue"><nobr><?=iconv('UTF-8','TIS-620',"ผู้รับใบงาน ");?>  : &nbsp;&nbsp;</td>
                      <td width="35%" height="25" align="left" class="fontBblue">
                          <input class="form-control"  type="hidden" name="reciept_job_call" id="reciept_job_call" value="<?=$reciept_id?>" style="width:250pt">
                          <input class="form-control"  type="text" name="reciept_job_call_name" id="reciept_job_call_name" value="<?=$reciept_name?>" style="width:250pt" readonly>
                      </td>
                      <td width="15%" height="25" align="right" class="fontBblue"><nobr><?=iconv('UTF-8','TIS-620',"ช่างรับใบงาน ");?>  : &nbsp;&nbsp;</td>
                      <td width="35%" height="25" align="left" class="fontBblue">
                          <select name="reciept_job_engineer" id="reciept_job_engineer" style="width:250pt">
                              <option value="0"><?=iconv('UTF-8','TIS-620',"--เลือก-- ");?></option>
                           <? $sql_call = "SELECT tbl_user.user_id,tbl_user.name,tbl_user.sname,tbl_user.tel
                                          FROM tbl_user
                                          Where tbl_user.at in ('BSS','BOONPA','RS') And tbl_user.status_user = 'y' And tbl_user.group_email in ('s','c','rs')
                                          Order by tbl_user.name";
                               $rs_call = mysqli_query($conn,$sql_call);
                              while($c_call = mysqli_fetch_array($rs_call)){
                              ?>
                              <option value="<?=$c_call["user_id"]?>" <? if($c_call["user_id"]==$c["reciept_job_engineer"]) echo "selected";?>><?=$c_call["name"]." ".$c_call["sname"]." (".$c_call["tel"].")"?></option>
                              <?}?>
                          </select>
                      </td>
                  </tr>

                  <tr>
                      <td width="15%" height="25" align="right" class="fontBblue"><nobr><?=iconv('UTF-8','TIS-620',"วิธีการแก้ไข ");?>  : &nbsp;&nbsp;</td>
                      <td width="35%" height="25" align="left" class="fontBblue" colspan="3">
                          <input class="form-control"  type="text" name="problem_solving" id="problem_solving" value="<?=$c["problem_solving"]?>" style="width:800pt">
                      </td>
                  </tr>
                  
                  <tr>
                      <td width="15%" height="25" align="right" class="fontBblue"><nobr><?=iconv('UTF-8','TIS-620',"แก้ไขโดย ");?>  : &nbsp;&nbsp;</td>
                      <td width="35%" height="25" align="left" class="fontBblue" colspan="3">
                          <select name="problem_soving_by" id="problem_soving_by" value="" style="width:250pt">
                              <option value="h" <?if($c["problem_soving_by"]=="h") echo "selected";?> >Helpdesk</option>
                              <option value="c" <?if($c["problem_soving_by"]=="c") echo "selected";?> >CM Onsite</option>
                          </select>
                          <input class="form-control"  type="button" value="<?=iconv('UTF-8','TIS-620',"การเปลี่ยนอุปกรณ์");?>" style="width:100pt"
onclick="entry_serial(customer_id.value,job_no.value,reciept_job_engineer.value);">
                     </td>
                  </tr>
                  
                  <tr>
                      <td width="15%" height="25" align="right" class="fontBblue"><nobr><?=iconv('UTF-8','TIS-620',"หมายเหตุ ");?>  : &nbsp;&nbsp;</td>
                      <td width="35%" height="25" align="left" class="fontBblue" colspan="3">
                          <input class="form-control"  type="text" name="comment_job" id="comment_job" value="<?=$c["comment_job"]?>" style="width:800pt">
                      </td>
                  </tr>

                  <tr>
                      <td width="15%" height="25" align="right" class="fontBblue"><nobr><?=iconv('UTF-8','TIS-620',"วันและเวลาที่เปิดใบงาน ");?>  : &nbsp;&nbsp;</td>
                      <td width="35%" height="25" align="left" class="fontBblue">
                           <?
                          $dop = splitTime($open_date,"DD");
                          ?>
                          <input class="form-control"  name="call_openjob_datetime" id="call_openjob_datetime" value="<?=$dop?>" style="width:100pt" readonly>
                       <a href="#" onclick="cdp1.showCalendar(this, 'call_openjob_datetime'); return false;" >
                          <img src="image/calendar.png" width="17" height="13" border="0" /></a>
                       <nobr> HH : 
                          <?
                          $hop = splitTime($open_date,"HH");
                          ?>
                          <select name="hop" id="hop">
                            <?for($i=0;$i<24;$i++){?>
                                <option value = "<?=$i?>" <?if($hop==$i) echo "selected";?>><?=$i?></option>";
                            <?}?>
                        </select>
                        <nobr>MM :
                          <?
                          $mop = splitTime($open_date,"MM");
                          ?>
                          <select name="mop" id="mop">
                            <?for($i=0;$i<60;$i++){?>
                                <option value = "<?=$i?>" <?if($mop==$i) echo "selected";?>><?=$i?></option>";
                            <?}?>
                     </select></td>
                      <td width="15%" height="25" align="right" class="fontBblue"><nobr><?=iconv('UTF-8','TIS-620',"วันและเวลาที่นัดหมาย ");?>  : &nbsp;&nbsp;</td>
                      <td width="35%" height="25" align="left" class="fontBblue">
                          <?
                          $dap = splitTime($appoint_date,"DD");
                          ?>
                          <input class="form-control"  name="appoint_datetime" id="appoint_datetime" value="<?=$dap?>" style="width:100pt" readonly>
                       <a href="#" onclick="cdp1.showCalendar(this, 'appoint_datetime'); return false;" >
                          <img src="image/calendar.png" width="17" height="13" border="0" /></a>
                       <nobr> HH :
                          <?
                          $hap = splitTime($appoint_date,"HH");
                          ?>
                          <select name="hap" id="hap">
                            <?for($i=0;$i<24;$i++){?>
                                <option value = "<?=$i?>" <?if($hap==$i) echo "selected";?>><?=$i?></option>";
                            <?}?>
                        </select>
                        <nobr>MM :
                          <?
                          $map = splitTime($appoint_date,"MM");
                          ?>
                          <select name="map" id="map">
                            <?for($i=0;$i<60;$i++){?>
                                <option value = "<?=$i?>" <?if($map==$i) echo "selected";?>><?=$i?></option>";
                            <?}?>
                     </select></td>
                  </tr>

                  <tr>
                      <td width="15%" height="25" align="right" class="fontBblue"><nobr><?=iconv('UTF-8','TIS-620',"เวลาที่กำหนดให้แล้วเสร็จ ");?>  : &nbsp;&nbsp;</td>
                      <td width="35%" height="25" align="left" class="fontBblue">
                           <?
                        //  $ddl = splitTime($c["deadline_solving"],"DD");
                          ?>
                          <input class="form-control"  name="deadline_solving" id="deadline_solving" value="<?=$c["deadline_solving"]?>" style="width:250pt" readonly>
                       <!--a href="#" onclick="cdp1.showCalendar(this, 'deadline_solving'); return false;" >
                          <img src="image/calendar.png" width="17" height="13" border="0" /></a>
                       <nobr> HH :
                          <?
                          //$hdl = splitTime($c["deadline_solving"],"HH");
                          ?>
                          <select name="hdl" id="hdl">
                            <?//for($i=0;$i<24;$i++){?>
                                <option value = "<?//=$i?>" <?//if($hdl==$i) echo "selected";?>><?//=$i?></option>";
                            <?//}?>
                        </select>
                        <nobr>MM :
                          <?
                          //$mdl = splitTime($c["deadline_solving"],"MM");
                          ?>
                          <select name="mdl" id="mdl">
                            <?//for($i=0;$i<60;$i++){?>
                                <option value = "<?//=$i?>" <?//if($mdl==$i) echo "selected";?>><?//=$i?></option>";
                            <?//}?>
                     </select></td--->
                      <td width="15%" height="25" align="right" class="fontBblue"><nobr><?=iconv('UTF-8','TIS-620',"แจ้งถึงจุดหมาย ");?>  : &nbsp;&nbsp;</td>
                      <td width="35%" height="25" align="left" class="fontBblue">
                          <?
                          $dos = splitTime($onsite_date,"DD");
                          ?>
                          <input class="form-control"  name="onsite_datetime" id="onsite_datetime" value="<?=$dos?>" style="width:100pt" readonly>
                       <a href="#" onclick="cdp1.showCalendar(this, 'onsite_datetime'); return false;" >
                          <img src="image/calendar.png" width="17" height="13" border="0" /></a>
                       <nobr> HH :
                          <?
                          $hos = splitTime($onsite_date,"HH");
                          ?>
                          <select name="hos" id="hos">
                            <?for($i=0;$i<24;$i++){?>
                                <option value = "<?=$i?>" <?if($hos==$i) echo "selected";?>><?=$i?></option>";
                            <?}?>
                        </select>
                        <nobr>MM :
                          <?
                          $mos = splitTime($onsite_date,"MM");
                          ?>
                          <select name="mos" id="mos">
                            <?for($i=0;$i<60;$i++){?>
                                <option value = "<?=$i?>" <?if($mos==$i) echo "selected";?>><?=$i?></option>";
                            <?}?>
                     </select></td>
                  </tr>

                  <tr>
                      <td width="15%" height="25" align="right" class="fontBblue"><nobr><?=iconv('UTF-8','TIS-620',"เวลาที่แก้ไขเสร็จ ");?>  : &nbsp;&nbsp;</td>
                      <td width="35%" height="25" align="left" class="fontBblue">
                          <?
                          $dfx = splitTime($fix_date,"DD");
                          ?>
                          <input class="form-control"  name="fixed_datetime" id="fixed_datetime" value="<?=$dfx?>" style="width:100pt" readonly>
                       <a href="#" onclick="cdp1.showCalendar(this, 'fixed_datetime'); return false;" >
                          <img src="image/calendar.png" width="17" height="13" border="0" /></a>
                       <nobr> HH :
                          <?
                          $hfx = splitTime($fix_date,"HH");
                          ?>
                          <select name="hfx" id="hfx">
                            <?for($i=0;$i<24;$i++){?>
                                <option value = "<?=$i?>" <?if($hfx==$i) echo "selected";?>><?=$i?></option>";
                            <?}?>
                        </select>
                        <nobr>MM :
                          <?
                          $mfx = splitTime($fix_date,"MM");
                          ?>
                          <select name="mfx" id="mfx">
                            <?for($i=0;$i<60;$i++){?>
                                <option value = "<?=$i?>" <?if($mfx==$i) echo "selected";?>><?=$i?></option>";
                            <?}?>
                     </select></td>
                      <td width="15%" height="25" align="right" class="fontBblue"><nobr><?=iconv('UTF-8','TIS-620',"เวลาปิดงาน ");?>  : &nbsp;&nbsp;</td>
                      <td width="35%" height="25" align="left" class="fontBblue">
                          <?
                          $dcd = splitTime($close_date,"DD");
                          ?>
                          <input class="form-control"  name="close_datetime" id="close_datetime" value="<?=$dcd?>" style="width:100pt" readonly>
                       <a href="#" onclick="cdp1.showCalendar(this, 'close_datetime'); return false;" >
                          <img src="image/calendar.png" width="17" height="13" border="0" /></a>
                       <nobr> HH :
                          <?
                          $hcd = splitTime($close_date,"HH");
                          ?>
                          <select name="hcd" id="hcd">
                            <?for($i=0;$i<24;$i++){?>
                                <option value = "<?=$i?>" <?if($hcd==$i) echo "selected";?>><?=$i?></option>";
                            <?}?>
                        </select>
                        <nobr>MM :
                          <?
                          $mcd = splitTime($close_date,"MM");
                          ?>
                          <select name="mcd" id="mcd">
                            <?for($i=0;$i<60;$i++){?>
                                <option value = "<?=$i?>" <?if($mcd==$i) echo "selected";?>><?=$i?></option>";
                            <?}?>
                     </select></td>
                  </tr>

                  <tr>
                      <td width="15%" height="25" align="right" class="fontBblue"><nobr><?=iconv('UTF-8','TIS-620',"สถานะใบงาน ");?>  : &nbsp;&nbsp;</td>
                      <td width="35%" height="25" align="left" class="fontBblue">
                          <select name="status_call" id="status_call" style="width:250pt">
                              <option value="feedback" <?if($c["status_call"]=="feedback") echo "selected";?>><?=iconv('UTF-8','TIS-620',"อยู่ช่วงดำเนินการ ");?></option>
                              <option value="close" <?if($c["status_call"]=="close") echo "selected";?>><?=iconv('UTF-8','TIS-620',"ปิดงาน ");?></option>
                              <option value="cancel" <?if($c["status_call"]=="cancel") echo "selected";?>><?=iconv('UTF-8','TIS-620',"ยกเลิก ");?></option>
                              <option value="cancel not paid" <?if($c["status_call"]=="cancel not paid") echo "selected";?>><?=iconv('UTF-8','TIS-620',"ยกเลิกใบงานโดยไม่ให้เบิกค่าเดินทาง ");?></option>

                          </select>
                      </td>
                      <td width="15%" height="25" align="right" class="fontBblue"><nobr><?=iconv('UTF-8','TIS-620',"ระดับการบริการ ");?>  : &nbsp;&nbsp;</td>
                      <td width="35%" height="25" align="left" class="fontBblue">
                          <input class="form-control"  name="status_sla" id="status_sla" value="<?=$c['status_sla']?>" style="width:250pt" readonly></td>
                  </tr>



                </table>
               
                </table>
            </form></td></tr></table>

<?
    function splitTime($dte,$val){
        $str = explode(" ", $dte);
        $tme1 = "";
        if($val=="DD"){
            $tme1 = $str[0];
        } else if($val=="HH"){
            $tme = explode(":",$str[1]);
            $tme1 = $tme[0];
        } else if($val=="MM"){
            $tme = explode(":",$str[1]);
            $tme1 = $tme[1];
        }
        return $tme1;
    }
?>


<script type="text/javascript">
    var props = {	formatDate :		'%m-%d-%y'	};
    props.formatDate = '%y-%m-%d';
    var cdp1 = new CalendarDatePicker(props);

    function CheckText(){
        if(document.form1.open_date.value == "") {
            alert('��س�ŧ�ѹ���ҷ���Դ�ҹ��͹�Ф�Ѻ');
            document.form1.open_date.focus();
            return false;
        }
        if(document.form1.cmbCateType.value == "") {
            alert('��س����͡������㺧ҹ');
            document.form1.cmbCateType.focus();
            return false;
        }

        if(document.form1.txtSid.value == "") {
            alert('��س����͡�����١��ҡ�͹�Ф�Ѻ');
            document.form1.txtSid.focus();
            return false;
        }

		 if(document.form1.UserEngineerID.value == "") {
            alert('��س����͡����Ѻ�Դ�ͺ��͹�Ф�Ѻ');
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
        properties = " width=960,height=540";

            var type = document.form1.biz_typer.value;
         //   var site = document.form1.txtSid.value;
         //   if(site==""){
         //    alert(type);
         //    document.form1.txtSid.focus();
         //    return;
         //   }

        properties +="directories=no,titlebar=no,toolbar=no,location=no,status=no,menubar=no,scrollbars=yes, top="+mytop+",left="+myleft;
        window.open("sch.customer.retail.php?cust1="+type,"Search",properties);

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
    function entry_serial(val,jobno,reciept_job_engineer){
        if(document.form1.job_no.value == "") {
            alert('<?=iconv('UTF-8','TIS-620',"กรอกเลขที่ใบงานก่อน ");?> ');
            document.form1.job_no.focus();
            return false;
        }
         if(document.form1.cusid.value == "") {
            alert('<?=iconv('UTF-8','TIS-620',"กรอกรหัสลุกค้าก่อนโดยการเลือก ");?>');
//            document.form1.cusid.focus();
            return false;
        }

            myleft=(screen.width)?(screen.width-600)/2:100;
            mytop=(screen.height)?(screen.height-300)/2:100;
            properties = " width=800,height=600";
            properties +="directories=no,titlebar=no,toolbar=no,location=no,status=no,menubar=no,scrollbars=yes, top="+mytop+",left="+myleft;
            window.open("movement.hw.php?customer_id="+val+"&job_no="+jobno+"&reciept_job_engineer="+reciept_job_engineer ,"Entry",properties);
//        }
    }




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

