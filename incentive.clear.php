<?
header("Content-Type: text/html; charset=tis-620");

session_start();
require_once("function.php");

$id = $_REQUEST["id"];
$type = $_REQUEST["type"];
//if($type != "add" && $type !="edit" ){
// echo Message(35,"red","��ͤ������͹","�س������Է����������˹�ҹ��","<a href='javascript:history.back(1)'> ��Ѻ</a>");
// exit;
//}
include("header.php");
$id = $_REQUEST["id"];
$type = $_REQUEST["type"];
$dte =  getDte();
$other_date = getDte();
$other_real_godate = getDte();
$other_real_backdate = getDte();
$other_receive_id = $Uid;
$other_receive_name = $Uname; //  echo "sss".$Uid;
$colspan = 7;
$width = "90%";
if ($type == "edit") {
  $sql = "SELECT
                tbl_incentive_ot.id,
                tbl_incentive_ot.other_no,
                tbl_incentive_ot.other_date,
                tbl_incentive_ot.other_receive,
                tbl_incentive_ot.other_by_job,
                tbl_incentive_ot.other_description,
                tbl_incentive_ot.other_real_godate,
                tbl_incentive_ot.other_real_backdate,
                tbl_incentive_ot.other_totaldate,
                tbl_incentive_ot.other_rental_day,
                tbl_incentive_ot.other_rental,
                tbl_incentive_ot.other_expenses_per_day,
                tbl_incentive_ot.other_expenses_per,
                tbl_incentive_ot.other_gas_oil,
                tbl_incentive_ot.other_pay,
                tbl_incentive_ot.other_pay_total,
                tbl_incentive_ot.other_total,
                tbl_incentive_ot.status_funds,
                tbl_incentive_ot.total_funds,
                tbl_incentive_ot.status_check,
                tbl_incentive_ot.gasperkilo,
                tbl_incentive_ot.authen_by,
                tbl_user_login.name,
                tbl_user_login.sname
            FROM
            tbl_incentive_ot
            Inner Join tbl_user_login ON tbl_incentive_ot.other_receive = tbl_user_login.user_bss_id
            Where tbl_incentive_ot.id = $id"; //  echo $sql;
  $rs = mysqli_query($conn,$sql);
  $c = mysqli_fetch_array($rs);
  $other_receive_id =  $c["other_receive"];
  $other_receive_name = $c["name"];
  $other_real_godate = $c["other_real_godate"];
$other_real_backdate = $c["other_real_backdate"];
$colspan = 9;
$width = "80%";
$tot = $c["other_total"];
$tot_f = $c["total_funds"];
$status_check = $c["status_check"];
}

?>
<title>Bizserv Solution Co.,Ltd</title>
<link href="image/bss_icon.ico"   rel="shortcut icon" />
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
<table width="100%" align="center" class="mytable" id="table" height="100%"   cellpadding="1" cellspacing="1">
    <tr>
        <td valign="top">
            <form action="incentive.executex.php"  method="post" target="mainPage"  name="form1" id="form1" onsubmit="return CheckText()"  >
            <input class="form-control"  type="hidden" value="<?=$id?>" name="id" id = "id">
            <input class="form-control"  type="hidden" value="2" name="authen_by" id = "authen_by">

                <table width="100%" border="0" cellpadding="0" cellspacing="0" class="mytable" border="1" bordercolor="#FF0000">
                    <tr>
                        <th align="center" height="40" width="100%" colspan="<?=$colspan?>" class="th">Incentive And Over Time </th>
                    </tr>
                    <tr>
                       <td width="90%">
                       <a href = "#" onclick="statuscheck(<?=$id?>,<?=$c["other_no"]?>)">
                       <img  type="image" src="image/save.jpg" alt="Save" align="right" width="20" height="20" border="0" /></a></td>
                       <td><nobr><b>Save</b>&nbsp;</td>
                       <td>
                       <a href="incentive.form.php?id=<?=$id?>&type=edit">
                       <img src="image/cancel.jpg" alt="Cancel" width="20" height="18" border="0" align="left" /> </a> </td>
                       <td align="left"><nobr><b> Back</b>     </td>
                     </tr>
                </table>
                <table width="50%" align="center"  id="table" cellpadding="1" cellspacing="1" border="0">
                   <tr>
                      <td height="20" align="left" class="fontBblue">No.  :  </td>
                      <td align="left" class="fontBblue">
                          <input class="form-control"  style="width:100pt;" name="other_no" type="text" id="other_no" value="<?=$c["other_no"]?>" readonly="readonly"/></td>
                     </tr>
                   <tr>
                      <td height="20" align="left" class="fontBblue">Date  : </td>
                      <td align="left" class="fontBblue">
                          <input class="form-control"  style="width:100pt;" name="other_date" type="text" id="other_date" value="<?=$other_date?>" size="35" maxlength="10"  readonly="readonly"/>                          </td>
                     </tr>
                     <tr>
                      <td align="left" class="fontBblue"><nobr>Name : </td>
                      <td align="left" class="fontBblue">
                        <input class="form-control"  type="hidden" name="other_receive_id" id="other_receive_id" value="<?=$other_receive_id?>" readonly="readonly">
                        <input class="form-control"  type="text" name="other_receive_name" id="other_receive_name" value="<?=$other_receive_name?>" style="width:250pt;" readonly="readonly"></td>
                     </tr>
                     <tr>
                            <td align="left" class="fontBblue"><nobr>Detail  : </td>
                           <td align="left" class="fontBblue">
                           <input class="form-control"  style="width:400pt;" name="other_description" type="text" id="other_description" value="<?=$c["other_description"]?>"/>  </td>
                     </tr>
                     <tr>
                           <td align="left" class="fontBblue"><nobr> From Date : </td>
                           <td align="left" class="fontBblue"><nobr>
                           <input class="form-control"  style="width:100pt;" name="other_real_godate" type="text" id="other_real_godate" value="<?=$other_real_godate?>" size="35" maxlength="10"  readonly="readonly"/>
                          <a href="#" onclick="cdp1.showCalendar(this, 'other_real_godate'); return false;" >
                          <img src="image/calendar.png" width="17" height="13" border="0" /></a></td>
                  </tr >
                  <tr>
                           <td align="left" class="fontBblue"><nobr> To Date  : </td>
                           <td align="left" class="fontBblue"><nobr>
                           <input class="form-control"  style="width:100pt;" name="other_real_backdate" type="text" id="other_real_backdate" value="<?=$other_real_backdate?>" size="35" maxlength="10"  readonly="readonly"/>
                          <a href="#" onclick="cdp1.showCalendar(this, 'other_real_backdate'); return false;" >
                          <img src="image/calendar.png" width="17" height="13" border="0" /></a></td>
                  </tr >
                  <tr>
                           <td align="left" class="fontBblue"><nobr> Days  : </td>
                           <td align="left" class="fontBblue"><select name="other_totaldate" id="other_totaldate" style="width:100pt;">
                           <? for ($i=1;$i<=60;$i++){?>
                            <option value="<?=$i?>" <?if($i==$c["other_totaldate"]) echo "selected";?>><?=$i?></option>
                            <?}?>
                           </select></td>
                  </tr >
                 </table>    <br>
                <table width="80%" align="center" id="table" cellpadding="1" cellspacing="1" border="1">
                    <tr>
                        <td width="10%" height="20" class="fontBblue" align="center">#</td>
                        <td width="40%" height="20" class="fontBblue" align="center">Detail</td>
                        <td width="15%" height="20" class="fontBblue" align="center">Summary</td>
                    </tr >
                    <tr>
                        <td width="10%" class="fontBblue" align="center">1.</td>
                        <td width="40%" class="fontBblue" align="left">&nbsp;&nbsp;<?=iconv('UTF-8','TIS-620',"ค่าที่พักค้างคืนต่างจังหวัด");?>
                            <select name="other_rental_day" id="other_rental_day" >
                               <? for ($i=1;$i<=60;$i++){?>
                                <option value="<?=$i?>" <?if($i==$c["other_rental_day"]) echo "selected";?>><?=$i?></option>
                                <?}?>
                           </select> <?=iconv('UTF-8','TIS-620',"(คืน)");?>
                        </td>
                        <td width="15%" class="fontBblue" align="center"><input class="form-control"  style="width:120pt;" type="text" name="other_rental" value="<?=$c["other_rental"];?>" id="other_rental" OnKeyPress="return chkNumber(this)"></td>
                    </tr >
					<?/*?>
                    <tr>
                        <td width="10%" class="fontBblue" align="center">2.</td>
                        <td width="40%" class="fontBblue" align="left">&nbsp;&nbsp;������������§��ҧ�ѧ��Ѵ�ӹǹ
                            <select name="other_expenses_per_day" id="other_expenses_per_day">
                               <? for ($i=1;$i<=60;$i++){?>
                                <option value="<?=$i?>" <? if($i==$c["other_expenses_per_day"]) echo "selected";?>><?=$i?></option>
                                <?}?>
                           </select> (�ѹ)
                        </td>
                        <td width="15%" class="fontBblue" align="center"><input class="form-control"  type="text" value="<?=$c["other_expenses_per"];?>" name="other_expenses_per" id="other_expenses_per" style="width:120pt;"></td>
                    </tr>
					<?*/?>
                     <tr>
                        <td width="10%" class="fontBblue" align="center">2.</td>
                        <td width="40%" class="fontBblue" align="left">&nbsp;&nbsp;<?=iconv('UTF-8','TIS-620',"ค่าน้ำมันรถ/แก็ส");?></td>
                        <td width="15%" class="fontBblue" align="center"><input class="form-control"  type="text" value="<?=$c["other_gas_oil"];?>" name="other_gas_oil" id="other_gas_oil" style="width:120pt;" OnKeyPress="return chkNumber(this)"></td>
                    </tr >
                    <tr>
                        <td width="10%" class="fontBblue" align="center">3.</td>
                        <td width="40%" class="fontBblue" align="left">&nbsp;&nbsp;<?=iconv('UTF-8','TIS-620',"ค่าใช้จ่ายอื่นๆ");?>
                           <input class="form-control"  type="text" name="other_pay" id="other_pay" value="<?=$c["other_pay"]?>" style="width:280pt;">
                        </td>
                        <td width="15%" class="fontBblue" align="center"><input class="form-control"  type="text" name="other_pay_total" value="<?=$c["other_pay_total"];?>" id="other_pay_total" style="width:120pt;" OnKeyPress="return chkNumber(this)"></td>
                    </tr >
                   <?/*?> <tr>
                        <td width="10%" class="fontBblue" align="center">5.</td>
                        <td width="40%" class="fontBblue" align="left">&nbsp;&nbsp;��� Incentive </td>
                        <td width="15%" class="fontBblue" align="center"><input class="form-control"  type="text" name="incentive_total" value="<?=$c["incentive_total"]?>" id="incentive_total" style="width:120pt;"></td>
                    </tr ><?*/?>
                    <tr>
                        <td width="10%" class="fontBblue" align="center">4.</td>
                        <td width="40%" class="fontBblue" align="left">&nbsp;&nbsp;<?=iconv('UTF-8','TIS-620',"ค่าแก็ส/กม.");?></td>
                        <td width="15%" class="fontBblue" align="center">
                            <input class="form-control"  type="text" name="gasperkilo"  id="gasperkilo" value="<?=$_SESSION["Ugasperkilo"]?>" style="width:120pt;" OnKeyPress="return chkNumber(this)">
                        </td>
                    </tr >
                    <tr>
                        <td width="10%" class="fontBblue" colspan="2" align="center"><?=iconv('UTF-8','TIS-620',"รวมเป็นเงินทั้งหมด");?></td>
                        <td width="15%" class="fontBblue" align="center"><input class="form-control"  type="text" readonly="readonly"  name="other_total" value="<?=$c["other_total"];?>" id="other_total" style="width:120pt;bgcolor:red;" OnKeyPress="return chkNumber(this)"></td>
                    </tr>
                </table>
                </form>



        <? if($id!=""){?>
              <form action="incentive.clear.execute.php" method="post" name="formDetail" target="_parent">
                   <input class="form-control"  type="hidden" name="id" id="id" value="<?=$id?>">
                  <table width="100%" align="center" id="table" cellpadding="1" cellspacing="1" border="1">
            <tr>
		<td width="5%" height="20" class="fontBblue" align="center"> <?=iconv('UTF-8','TIS-620',"วันที่");?></td>
	        <td width="5%" height="20" class="fontBblue" align="center"><?=iconv('UTF-8','TIS-620',"ลำดับที่");?></td>
	        <td width="10%" height="20" class="fontBblue" align="center"><?=iconv('UTF-8','TIS-620',"ค่าใช้จ่าย");?></td>
                <td width="35%" height="20" class="fontBblue" align="center"><?=iconv('UTF-8','TIS-620',"รายละเอียด");?></td>
                <td width="15%" height="20" class="fontBblue" align="center"><?=iconv('UTF-8','TIS-620',"บิลเลขที่");?></td>
                <td width="20%" height="20" colspan="2" class="fontBblue" align="center"><?=iconv('UTF-8','TIS-620',"จำนวนเงิน");?></td>
            </tr>
            <tr>
		<td width="7%" height="20" align="center">
                <input class="form-control"  type="text" onclick="cdp1.showCalendar(this, 'dte'); return false;" name="dte" id="dte" value="<?=$dte?>" style="width:55pt;"></td>
                <td height="20" align="center"><input class="form-control"  type="text" name="other_seq" id="other_seq" style="width:55pt;" readonly="readonly" ></td>
		<td height="20" align="center">
						<select name="fee_type" id="fee_type" style="width:55pt;">
							<option value="1" id="1"><?=iconv('UTF-8','TIS-620',"ค่าแก็ส");?></option>
							<option value="2" id="2"><?=iconv('UTF-8','TIS-620',"ค่าโรงแรม");?></option>
							<option value="3" id="3"><?=iconv('UTF-8','TIS-620',"ค่าทางด่วน");?></option>
							<option value="4" id="4"><?=iconv('UTF-8','TIS-620',"ค่าน้ำมัน");?></option>
							<option value="5" id="5"><?=iconv('UTF-8','TIS-620',"ค่าที่จอดรถ");?></option>
							<option value="6" id="6"><?=iconv('UTF-8','TIS-620',"ค่าแท็กซี่");?></option>
							<option value="7" id="7"><?=iconv('UTF-8','TIS-620',"ค่าซ่อมรถ");?></option>
							<option value="8" id="8"><?=iconv('UTF-8','TIS-620',"ค่าอื่นๆ");?></option>
						</select></td>
                <td height="20" align="center"><input class="form-control"  type="text" name="bill_description" id="bill_description" style="width:400pt;"></td>
                <td height="20" align="center"><input class="form-control"  type="text" name="bill_no" id="bill_no" style="width:150pt;"></td>
                <td height="20" align="center"><input class="form-control"  type="text" name="bill_total" id="bill_total" style="width:150pt;" OnKeyPress="return chkNumber(this)"></td>
                <td height="20" width="7%" align="center">
                <? if($status_check == ""){?>
                    <img  onclick="click2clrtext();" src="image/cancel.jpg" alt="Clear Text" width="18" height="18" border="0" align="center" />
                    <input class="form-control"  name="Submit"  type="image" onclick="return chkDetail();"  src="image/save.jpg" alt="Save" align="center" width="18" height="18" />
                <?}?>
                </td>
           </tr>

           <?
           $sql_detail = "select * from tbl_incentive_ot_settlement where other_no = $id order by other_seq";
           $rc_detail = mysqli_query($conn,$sql_detail);
           $i=1;
           while($c = mysqli_fetch_array($rc_detail)){
           ?>
            <tr ondblclick="click2editdetail('<?=$c["other_seq"]?>','<?=$c["other_dte"]?>','<?=$c["bill_description"]?>','<?=$c["bill_no"]?>','<?=$c["bill_total"]?>','<?=$c["bill_total_all"]?>','<?=$c["feetype"]?>');" onmouseover="this.style.backgroundColor='violet';" onmouseout="this.style.backgroundColor='white';">
			<td height="20" align="center" class="fontBblue"><nobr>&nbsp;<?=$c["other_dte"]?></td>
                <td height="20" align="center" class="fontBblue"><nobr>&nbsp;<?=$i;?></td>
	 	<td height="20" align="center" class="fontBblue">	<?
                				if($c["feetype"]=="1"){
                					echo iconv('UTF-8','TIS-620',"ค่าแก็ส");
                				}else if($c["feetype"]=="2"){
                					echo iconv('UTF-8','TIS-620',"ค่าโรงแรม");
                				}else if($c["feetype"]=="3"){
                					echo iconv('UTF-8','TIS-620',"ค่าทางด่วน");
                				}else if($c["feetype"]=="4"){
                					echo iconv('UTF-8','TIS-620',"ค่าน้ำมัน");
                				}else if($c["feetype"]=="5"){
                					echo iconv('UTF-8','TIS-620',"ค่าที่จอดรถ");
                				}else if($c["feetype"]=="6"){
                					echo iconv('UTF-8','TIS-620',"ค่าแท็กซี่");
                				}else if($c["feetype"]=="7"){
                					echo iconv('UTF-8','TIS-620',"ค่าซ่อมรถ");
                				}else if($c["feetype"]=="8"){
                					echo iconv('UTF-8','TIS-620',"ค่าอื่นๆ");
                				}
                			?></td>
                <td height="20" class="fontBblue">&nbsp;<?=$c["bill_description"]?></td>
                <td height="20" class="fontBblue">&nbsp;<?=$c["bill_no"]?></td>
                <td height="20" align="right" class="fontBblue">&nbsp;<?=$c["bill_total"]?></td>
                <td height="20" class="fontBblue" align="center">&nbsp;
                <? if($status_check == ""){?>
                <img  onclick="click2delete('<?=$id?>','<?=$c["other_seq"]?>');" src="image/delete.jpg" alt="Clear Text" width="20" height="18" border="0" align="center" />
                <? }?>
                </td>
             </tr>
           <?
           $ttotal += $c["bill_total"];
           $i++;
           }
          /*
           $total_founds_ = $tot - $ttotal;
             $rs1 = mysql_query($sql);
             while($c1 = mysql_fetch_array($rs1)){    // $c1["total_funds"]
             $tttot = $tot - $ttotal;
           ?>
           <input class="form-control"  type="hidden" value="<?=$ttotal;?>" name="ttotal" id="ttotal">
           <input class="form-control"  type="hidden" value="<?=$tot;?>" name="tot" id="tot">
               <tr>
                <td height="20" align="center" colspan="3" class="fontBblue">��������Թ�������㹡����ԡ : </td>
                <td height="20" align="center">
                <input class="form-control"  type="hidden" name="id" id="id" value="<?=$id?>">
                        <select name="status_funds" id="status_funds" style="width:80pt;">
                            <option value="�����/�׹" <? if($c1["status_funds"]=="�����/�׹") echo "selected";?>>�����/�׹</option>
                            <option value="��ԡ�����" <? if($c1["status_funds"]=="��ԡ�����") echo "selected";?>>��ԡ�����</option>
                        </select>
                </td>
                <td height="20" align="center" >
                <input class="form-control"  type="text" readonly="readonly" value="<?=$tttot?>" name="total_funds" id="total_funds" style="width:80pt;"></td>
                <td height="20" align="center">&nbsp;
                <!--img  type="image" onclick="click2updatefunds('<?=$id?>',status_funds.value,total_funds.value);"  src="image/save.jpg" alt="Save" align="cennter" width="20" height="20" /--></td>
           </tr>
           <?}*/?>
		   <tr>
		   <td colspan = "5" align="right" class="fontBblue"><b>Total :</b></td>
		   <td align="right" class="fontBblue"><?=format_moneys($ttotal)?></td>
		   <td align="right" class="fontBblue">&nbsp;</td>
		   </tr>
              </table>


          <form>

        <?}?>

                 </td></tr></table>


<script type="text/javascript">
    var props = {    formatDate :        '%m-%d-%y'    };
    props.formatDate = '%y-%m-%d';
    var cdp1 = new CalendarDatePicker(props);

     function getSite(id){
        myleft=(screen.width)?(screen.width-800)/2:100;
        mytop=(screen.height)?(screen.height-300)/2:100;
        properties = " width=800,height=300";
        properties +="directories=no,titlebar=no,toolbar=no,location=no,status=no,menubar=no,scrollbars=yes, top="+mytop+",left="+myleft;
        window.open("sch_site.php?id="+id,"Search",properties);
     }

     function printexpense(id){
        myleft=(screen.width)?(screen.width-800)/2:100;
        mytop=(screen.height)?(screen.height-300)/2:100;
        properties = " width=800,height=300";
        properties +="directories=no,titlebar=no,toolbar=no,location=no,status=no,menubar=no,scrollbars=yes, top="+mytop+",left="+myleft;
        window.open("expense.rpt.php?id="+id,"Search",properties);
     }

     function chkDetail(){
               if(document.formDetail.site_id.value == ""){
                    alert('��سҡ�͡����ʶҹա�͹�Ф�Ѻ');
                    document.formDetail.site_id.focus();
                    return false;
               }
                if (document.formDetail.location_from.value == ""){
                    alert('��سҡ�͡ʶҹ������������͹仡�͹�Ф�Ѻ');
                    document.formDetail.location_from.focus();
                    return false;
               }
                if (document.formDetail.location_to.value == ""){
                    alert('��سҡ�͡ʶҹ����Ҷ֧��͹�Ѻ��͹�Ф�Ѻ');
                    document.formDetail.location_to.focus();
                    return false;
               }
                if (document.formDetail.distance_from.value == ""){
                    alert('��سҡ�͡�Ţ����ö��͹�Ѻ��͹�Ф�Ѻ');
                    document.formDetail.distance_from.focus();
                    return false;
               }
                if (document.formDetail.distance_to.value == ""){
                    alert('��سҡ�͡��Ţ�����֧���ǡ�͹�Ф�Ѻ');
                    document.formDetail.distance_to.focus();
                    return false;
               }
                if (document.formDetail.distance_result.value == ""){
                     alert('��سҡ�͡���зҧ�����Թ�ҧ��͹�Ф�Ѻ');
                    document.formDetail.distance_result.focus();
                    return false;
               }

                    return true;

     }

     function click2editdetail(other_seq,dte,bill_description,bill_no,bill_total,bill_total_all,feetype){
               document.formDetail.other_seq.value = other_seq;
	       document.formDetail.dte.value = dte;
               document.formDetail.bill_description.value = bill_description;
               document.formDetail.bill_no.value = bill_no;
               document.formDetail.bill_total.value = bill_total;
		document.getElementById(feetype).selected=true;

     }

      function click2clrtext(){
               document.formDetail.other_seq.value = '';
               document.formDetail.bill_description.value = '';
               document.formDetail.bill_no.value = '';
               document.formDetail.bill_total.value = '';
               document.formDetail.bill_total_all.value = '';
     }

      function click2delete(id,other_seq,ttotal){
		   if(confirm('<?=iconv( 'UTF-8', 'TIS-620', "ยืนยันการลบรายการ");?>')==true){
            parent.parent.location.href ="incentive.clear.execute.php?typer=del&id="+id+"&other_seq="+other_seq;
		   }
      }

      function click2updatefunds(id,status_funds,total_funds){
            parent.parent.location.href ="incentive.clear.execute.php?typer=statusfunds&id="+id+"&status_funds="+status_funds+"&total_funds="+total_funds;
      }

      function statuscheck(id,other_seq){
          if(confirm('<?=iconv( 'UTF-8', 'TIS-620', "ส่งรายการเคลียร์เบิก");?>')==true){
            parent.parent.location.href ="incentive.clear.execute.php?typer=check&id="+id+"&other_seq="+other_seq+"&authen_by=2";
          }
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


<script language="JavaScript">
function chkNumber(ele)
{
var vchar = String.fromCharCode(event.keyCode);
if ((vchar<'0' || vchar>'9') && (vchar != '.')) return false;
ele.onKeyPress=vchar;
}
</script>
