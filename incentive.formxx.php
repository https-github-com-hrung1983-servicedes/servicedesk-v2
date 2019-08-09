<?
header("Content-Type: text/html; charset=tis-620");

session_start();
require_once("function.php");

if(!checkUser()){    echo Message(35,"red","ข้อความเตือน","คุณยังไม่ได้กรอกชื่อและรหัสผ่านครับ","<a href='index.php?link=incentive.formxx'> เข้าสู่ระบบ </a>");
   exit;
}
$id = $_REQUEST["id"];
$type = $_REQUEST["type"];  
if($type != "add" && $type !="edit" ){
 echo Message(35,"red","ข้อความเตือน","คุณไม่มีสิทธิ์เข้าใช้หน้านี้","<a href='javascript:history.back(1)'> กลับ</a>");
 exit;
}
include("header.php");    
$id = $_REQUEST["id"];    
$type = $_REQUEST["type"];    
$other_date = getDte();   
$dte = getDte();   
$other_real_godate = getDte();    
$other_real_backdate = getDte(); 
$other_receive_id = $_SESSION["Uid"];            
$other_receive_name = $_SESSION["Uname"]; //  echo "sss".$Uid;     
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
                tbl_incentive_ot.incentive_total,   
                tbl_incentive_ot.status_check,     
                tbl_incentive_ot.gasperkilo,      
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
$width = "72%";
$status_check = $c["status_check"];
}
                
?>
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
<table width="100%" align="center" border="1" class="mytable" id="table" height="100%"   cellpadding="1" cellspacing="1">
    <tr>                                               
        <td valign="top">                                                       
            <form action="incentive.execute.php"  method="post" target="_parent"  name="form1" id="form1" onsubmit="return CheckText()"  >
            <input class="form-control"  type="hidden" value="<?=$id?>" name="id" id = "id">                            
                <table width="100%" cellpadding="0" cellspacing="0" class="mytable" border="0" bordercolor="#FF0000">
                    <tr>
                        <th align="center" height="40" width="100%" colspan="<?=$colspan?>" class="th">Incentive And Over Time </th>                    
                    </tr>                                                                  
                    <tr>
                       <td width="<?=$width?>" align="right">&nbsp;</td>
                       <?if($type=="edit"){?> 
                       <td align="left">&nbsp;
                       <a href="incentive.clear.php?id=<?=$id?>&type=edit" >
                       <img src="image/addedit.png" alt="Print" width="20" valign="middle" height="18" border="0" align="right" /> </a></td>
                       <td align="left" valign="middle"><b> เคลียร์ใบเสร็จ </b></td><?}?>
                       <td align="left">
                       <a href="#" onclick="printexpense(<?=$id?>);" ><img src="image/icon_printer.gif" alt="Print" width="20" height="18" border="0" align="right" /> </a></td>
                       <td align="left"><b> พิมพ์ </b></td>                                          
                       <td>
                       <? if($status_check == ""){?> 
					    <? if($id==""){?>
                            <input class="form-control"  name="Submit"  type="image" onclick=" return CheckText()"  src="image/save.jpg" alt="Save" align="right" width="20" height="20" /><?}?><?}?>    </td>
                       <td align="left">
                            <? if($status_check == ""){?><? if($id==""){?><b>บันทึก</b><?}?><?}?></td>                       
                       <td valign="middle"><a href="incentive.ot.list.php" >
                       <img src="image/cancel.jpg" alt="Cancel" width="20" height="18" border="0" align="left" /> </a> </td>
                       <td align="left"><nobr><b> ยกเลิก</b>     </td>
                     </tr>
                </table>       
                <table width="50%" align="center"  id="table" cellpadding="1" cellspacing="1" border="0">
                   <tr>
                      <td height="20" align="left" class="fontBblue">เลขที่  :  </td>
                      <td align="left" class="fontBblue">
                          <input class="form-control"  style="width:100pt;" name="other_no" type="text" id="other_no" value="<?=$c["other_no"]?>" readonly="readonly"/></td>                       
                     </tr> 
                   <tr>
                      <td height="20" align="left" class="fontBblue">วันที่  : </td>
                      <td align="left" class="fontBblue"> 
                          <input class="form-control"  style="width:100pt;" name="other_date" type="text" id="other_date" value="<?=$other_date?>" size="35" maxlength="10"  readonly="readonly"/>                          </td>                       
                     </tr>  
                     <tr>  
                      <td align="left" class="fontBblue"><nobr>ชื่อผู้ขอเบิก : </td>
                      <td align="left" class="fontBblue">
                        <input class="form-control"  type="hidden" name="other_receive_id" id="other_receive_id" value="<?=$other_receive_id?>" readonly="readonly">
                        <input class="form-control"  type="text" name="other_receive_name" id="other_receive_name" value="<?=$other_receive_name?>" style="width:250pt;" readonly="readonly"></td>
                     </tr>  
                     <tr>   
                            <td align="left" class="fontBblue"><nobr>รายละเอียด  : </td>                                       
                           <td align="left" class="fontBblue">    
                           <input class="form-control"  style="width:400pt;" name="other_description" type="text" id="other_description" value="<?=$c["other_description"]?>"/>  </td>
                     </tr>  
                     <tr> 
                           <td align="left" class="fontBblue"><nobr> วันที่เดินทางไป  : </td>                                   
                           <td align="left" class="fontBblue"><nobr>  
                           <input class="form-control"  style="width:100pt;" name="other_real_godate" type="text" id="other_real_godate" value="<?=$other_real_godate?>" size="35" maxlength="10"  readonly="readonly"/>                
                          <a href="#" onclick="cdp1.showCalendar(this, 'other_real_godate'); return false;" > 
                          <img src="image/calendar.png" width="17" height="13" border="0" /></a></td>
                  </tr >
                  <tr> 
                           <td align="left" class="fontBblue"><nobr> วันที่เดินทางกลับ  : </td>                                     
                           <td align="left" class="fontBblue"><nobr>  
                           <input class="form-control"  style="width:100pt;" name="other_real_backdate" type="text" id="other_real_backdate" value="<?=$other_real_backdate?>" size="35" maxlength="10"  readonly="readonly"/>                
                          <a href="#" onclick="cdp1.showCalendar(this, 'other_real_backdate'); return false;" > 
                          <img src="image/calendar.png" width="17" height="13" border="0" /></a></td>
                  </tr >
                  <tr> 
                           <td align="left" class="fontBblue"><nobr> รวมวันเดินทาง  : </td>                                   
                           <td align="left" class="fontBblue"><select name="other_totaldate" id="other_totaldate" style="width:100pt;">
                           <? for ($i=1;$i<=60;$i++){?>
                            <option value="<?=$i?>" <?if($i==$c["other_totaldate"]) echo "selected";?>><?=$i?></option>
                            <?}?>
                           </select></td>
                  </tr >  
                 </table>    <br>
                <table width="80%" align="center" id="table" cellpadding="1" cellspacing="1" border="1">                       
                    <tr>
                        <td width="10%" height="20" class="fontBblue" align="center">ลำดับที่</td>
                        <td width="40%" height="20" class="fontBblue" align="center">รายละเอียด</td>
                        <td width="15%" height="20" class="fontBblue" align="center">จำนวนเงิน</td>       
                    </tr >
                    <tr>
                        <td width="10%" class="fontBblue" align="center">1.</td>
                        <td width="40%" class="fontBblue" align="left">&nbsp;&nbsp;ค่าที่พักต่างจังหวัดจำนวน 
                            <select name="other_rental_day" id="other_rental_day" >
                               <? for ($i=0;$i<=60;$i++){?>
                                <option value="<?=$i?>" <?if($i==$c["other_rental_day"]) echo "selected";?>><?=$i?></option>
                                <?}?>
                           </select> (คืน)                        
                        </td>
                        <td width="15%" class="fontBblue" align="center"><input class="form-control"  style="width:120pt;direction:rtl;" type="text" name="other_rental" value="<?=$c["other_rental"];?>" id="other_rental"></td>
                    </tr >
                    <tr>
                        <td width="10%" class="fontBblue" align="center">2.</td>
                        <td width="40%" class="fontBblue" align="left">&nbsp;&nbsp;ค่าเบี้ยเลี้ยงต่างจังหวัดจำนวน 
                            <select name="other_expenses_per_day" id="other_expenses_per_day">
                               <? for ($i=0;$i<=60;$i++){?>
                                <option value="<?=$i?>" <? if($i==$c["other_expenses_per_day"]) echo "selected";?>><?=$i?></option>
                                <?}?>                                         
                           </select> (วัน)                        
                        </td>
                        <td width="15%" class="fontBblue" align="center"><input class="form-control"  type="text" readonly value="<?=$c["other_expenses_per"];?>" name="other_expenses_per" id="other_expenses_per" style="width:120pt;direction:rtl;"></td>        
                    </tr >
                     <tr>
                        <td width="10%" class="fontBblue" align="center">3.</td>
                        <td width="40%" class="fontBblue" align="left">&nbsp;&nbsp;ค่าน้ำมันรถหรือแก็ส</td>
                        <td width="15%" class="fontBblue" align="center"><input class="form-control"  type="text" value="<?=$c["other_gas_oil"];?>" name="other_gas_oil" id="other_gas_oil" style="width:120pt;direction:rtl;"></td>               
                    </tr >
                    <tr>
                        <td width="10%" class="fontBblue" align="center">4.</td>             
                        <td width="40%" class="fontBblue" align="left">&nbsp;&nbsp;ค่าใช้จ่ายอื่นๆ 
                           <input class="form-control"  type="text" name="other_pay" id="other_pay" value="<?=$c["other_pay"]?>" style="width:280pt;">
                        </td>                                                                                
                        <td width="15%" class="fontBblue" align="center"><input class="form-control"  type="text" name="other_pay_total" value="<?=$c["other_pay_total"];?>" id="other_pay_total" style="width:120pt;direction:rtl;"></td>       
                    </tr >
                    <tr>
                        <td width="10%" class="fontBblue" align="center">5.</td>             
                        <td width="40%" class="fontBblue" align="left">&nbsp;&nbsp;ค่า Incentive </td>                                                                          
                        <td width="15%" class="fontBblue" align="center"><input class="form-control"  type="text" name="incentive_total" value="<?=$c["incentive_total"]?>" id="incentive_total" style="width:120pt;direction:rtl;" readonly></td>       
                    </tr >
                    <tr>
                        <td width="10%" class="fontBblue" align="center">6.</td>             
                        <td width="40%" class="fontBblue" align="left">&nbsp;&nbsp;ค่าแก็ส/กม.</td>                                                                          
                        <td width="15%" class="fontBblue" align="center">
                            <select name="gasperkilo" id="gasperkilo" style="width:120pt;">
                               <?  $gasperkilo = $c["gasperkilo"];
						   for($i=0;$i<=10;$i++){?>
                                <option value="<?=$i?>" <?if($c["gasperkilo"]==$i) echo "selected";?>><?=$i?></option>
                                <?}?>
                            </select>
                        </td>       
                    </tr >
                    <tr>
                        <td width="10%" class="fontBblue" colspan="2" align="center">รวมเป็นเงินทั้งหมด</td>                                                                                 
                        <td width="15%" class="fontBblue" align="center"><input class="form-control"  type="text" readonly="readonly"  name="other_total" value="<?=$c["other_total"];?>" id="other_total" style="width:120pt;direction:rtl;bgcolor:red;"></td>       
                    </tr>   
                                    
                </table>
                </form>
        
        
                     
                
        <? if($id!=""){?>
              <form action="incentive.detail.php" method="post" name="formDetail" target="_parent">
                   <input class="form-control"  type="hidden" name="id" id="id" value="<?=$id?>">
                   <input class="form-control"  type="hidden" name="seq_id" id="seq_id" value="">
		    <input class="form-control"  type="hidden" name="gasperkilo" id="gasperkilo" value="<?=$gasperkilo?>">
                  <table width="100%" align="center" id="table" cellpadding="1" cellspacing="1" border="1">                       
            <tr>
                <td width="7%" height="20" class="fontBblue" align="center"> วันที่</td> 
                <td width="7%" height="20" class="fontBblue" align="center">Ref.JobNo.</td>  
                <td width="7%" height="20" class="fontBblue" align="center">รหัสสถานี</td>
                <td width="8%" height="20" class="fontBblue" align="center">จาก</td>
                <td width="10%" height="20" class="fontBblue" align="center">ถึง</td>       
                <td width="7%" height="20" class="fontBblue" align="center">เลขไมล์เริ่มต้น</td>       
                <td width="7%" height="20" class="fontBblue" align="center">เลขไมล์สิ้นสุด</td>  
                <td width="7%" height="20" class="fontBblue" align="center">ระยะทาง(กม.)</td>   
                <td width="7%" height="20" class="fontBblue" align="center">ค่าทางด่วน</td>  
                <td width="7%" height="20" class="fontBblue" align="center">เบี้ยเลี้ยง</td>    
                <td width="7%" height="20" class="fontBblue" align="center">Incentive</td> 
                <td width="7%" height="20" class="fontBblue" align="center">ค่าโรงแรม</td>      
                <td width="7%" height="20" class="fontBblue" align="center">ค่าแก็ส/น้ำมัน</td>   
                <td width="7%" height="20" class="fontBblue" align="center">ค่าอื่นๆ</td>   				
                <td width="30%" height="20" colspan="2" class="fontBblue" align="center">รายละเอียดของงาน</td> 
            </tr>
            <tr>
            <td width="7%" height="20" align="center"><nobr><input class="form-control"  type="text" name="dte" id="dte" value="<?=$dte?>" style="width:55pt;" readonly onclick="cdp1.showCalendar(this, 'dte'); return false;"></td>
<td height="20" align="center"><nobr><input class="form-control"  type="text" name="job_no" id="job_no" style="width:80pt;" 
				onclick="getJobNo()" readonly ></td>
                <td height="20" align="center"><nobr><input class="form-control"  type="text" name="site_id" id="site_id" style="width:50pt;"></td>
                <td height="20"><input class="form-control"  type="text" name="location_from" id="location_from" style="width:60pt;"></td>
                <td height="20"><input class="form-control"  type="text" name="location_to" id="location_to" style="width:60pt;"></td>       
                <td height="20" align="center"><input class="form-control"  type="text" name="distance_from" id="distance_from" style="direction:rtl;width:50pt;"></td>       
                <td height="20" align="center"><input class="form-control"  type="text" name="distance_to" id="distance_to" style="direction:rtl;width:50pt;"></td>  
                <td height="20" align="center"><input class="form-control"  type="text" name="distance_result" id="distance_result" readonly="readonly" style="direction:rtl;width:50pt;"></td>  
                <td height="20" align="center"><input class="form-control"  type="text" name="express_" id="express_" style="direction:rtl;width:50pt;"></td>  
                <!--,job_no,allowance,incentive,fee_hotel,fee_oil_gas   -->
                <td height="20" align="center"><input class="form-control"  type="text" name="allowance" id="allowance" style="direction:rtl;width:50pt;"></td>
                <td height="20" align="center"><input class="form-control"  type="text" name="incentive" id="incentive" style="direction:rtl;width:50pt;"></td>
                <td height="20" align="center"><input class="form-control"  type="text" name="fee_hotel" id="fee_hotel" style="direction:rtl;width:50pt;"></td>
                <td height="20" align="center"><input class="form-control"  type="text" name="fee_oil_gas" id="fee_oil_gas" <?if($gasperkilo!=0)echo "readonly";?> style="direction:rtl;width:50pt;"></td>
                <td height="20" align="center"><input class="form-control"  type="text" name="other_fee" id="other_fee" style="direction:rtl;width:50pt;"></td>




                <td height="20" align="center"><input class="form-control"  type="text" name="description" id="description" style="width:130pt;"></td>         
                <td height="20" align="center">&nbsp;<? if($status_check == ""){?><nobr>  
                <img onclick="click2clrtext();" src="image/cancel.jpg" alt="Clear Text" width="18" height="18" border="0" /> 
                <input class="form-control"  name="Submit"  type="image" onclick="return chkDetail();"  src="image/save.jpg" alt="Save" width="18" height="18" /> <?}?> &nbsp;  </td>
           </tr>
           <?
           $sql_detail = "select * from tbl_incentive_detail where id = $id order by seq_id";  
           $rc_detail = mysqli_query($conn,$sql_detail);                                              
           while($c = mysqli_fetch_array($rc_detail)){                     
           ?>                              
            <tr ondblclick="click2editdetail('<?=$c["id"]?>','<?=$c["dte"]?>','<?=$c["seq_id"]?>','<?=$c["site_id"]?>','<?=$c["location_form"]?>','<?=$c["location_to"]?>','<?=$c["distance_form"]?>','<?=$c["distance_to"]?>','<?=$c["ditstance_result"]?>','<?=$c["express_position"]?>','<?=$c["jobdescription"]?>','<?=$c["job_no"]?>','<?=$c["allowance"]?>','<?=$c["incentive"]?>','<?=$c["fee_hotel"]?>','<?=$c["fee_oil_gas"]?>','<?=$c["other_fee"]?>');" onmouseover="this.style.backgroundColor='violet';" onmouseout="this.style.backgroundColor='white';">
                <td height="20" align="center" class="fontBblue"><nobr>&nbsp;<?=$c["dte"]?></td>
				<td height="20" align="center" class="fontBblue"><nobr>&nbsp;<?=$c["job_no"]?></td>
                <td height="20" align="center" class="fontBblue"><nobr>&nbsp;<?=$c["site_id"]?></td>
                <td height="20" class="fontBblue">&nbsp;<?=substr($c["location_form"],0,6)."..."?></td>
                <td height="20" class="fontBblue">&nbsp;<?=substr($c["location_to"],0,6)."..."?></td>       
                <td height="20" align="center" class="fontBblue">&nbsp;<?=$c["distance_form"]?></td>       
                <td height="20" align="center" class="fontBblue">&nbsp;<?=$c["distance_to"]?></td>  
                <td height="20" align="center" class="fontBblue">&nbsp;<?=$c["ditstance_result"]?></td>  
                <td height="20" align="center" class="fontBblue">&nbsp;<?=$c["express_position"]?></td>  
<!--,job_no,allowance,incentive,fee_hotel,fee_hotel other_fee  -->
				<td height="20" align="center" class="fontBblue">&nbsp;<?=$c["allowance"]?></td>
				<td height="20" align="center" class="fontBblue">&nbsp;<?=$c["incentive"]?></td>
				<td height="20" align="center" class="fontBblue">&nbsp;<?=$c["fee_hotel"]?></td>
				<td height="20" align="center" class="fontBblue">&nbsp;<?=$c["fee_oil_gas"]?></td>
				<td height="20" align="center" class="fontBblue">&nbsp;<?=$c["other_fee"]?></td>

                <td height="20" class="fontBblue">&nbsp;<?=substr($c["jobdescription"],0,25)."...";?></td>
                <td height="20" class="fontBblue" align="center">&nbsp;<? if($status_check == ""){?>
                <img onclick="click2delete('<?=$c["id"]?>','<?=$c["seq_id"]?>');" src="image/delete.jpg" alt="Clear Text" width="20" height="18" border="0" align="center" />
                <?}?>
                </td>
           </tr>
           <?}?>
                           
              </table>
              </form>
              
              
              
        <?}?>
                
                 </td></tr></table>  
                
                
<script type="text/javascript"> 
    var props = {    formatDate :        '%m-%d-%y'    };
    props.formatDate = '%y-%m-%d';
    var cdp1 = new CalendarDatePicker(props); 
    
	 function getJobNo(){
                var dte = document.formDetail.dte.value;
		var curr_dte = document.formDetail.dte.value.split('-');
		var from_date =document.form1.other_real_godate.value.split('-');
        var to_date = document.form1.other_real_backdate.value.split('-');
		
		var dte_cur = new Date(curr_dte[0],curr_dte[1],curr_dte[2]);
        var dte_beg = new Date(from_date[0], from_date[1], from_date[2]); 
		var dte_end = new Date(to_date[0], to_date[1], to_date[2]); 

		if(dte_cur >= dte_beg && dte_cur <= dte_end){
			myleft=(screen.width)?(screen.width-800)/2:100;    
			mytop=(screen.height)?(screen.height-300)/2:100;      
			properties = " width=800,height=500";                                                         
			properties +="directories=no,titlebar=no,toolbar=no,location=no,status=no,menubar=no,scrollbars=yes, top="+mytop+",left="+myleft;      
			window.open("sch.job.php?dte="+dte+"&job_type=NGV","Search",properties);  
		} else { 	    
		   alert("เลือกวันที่ให้อยู่ในช่วงเวลา วันที่เดินทางไป และ วันที่เดินทางกลับ เท่านั้นนะครับ");
		   return false; 
		}     
     }

    function CheckText() {
		if(document.form1.other_descriptionvalue == ""){
			 alert('รายละเอียด');
                    document.formDetail.other_descriptionvalue.focus(); 
                    return false;
		}
			return true;
	}

     function getSite(id){
        myleft=(screen.width)?(screen.width-800)/2:100;    
        mytop=(screen.height)?(screen.height-300)/2:100;      
        properties = " width=800,height=300";                                                         
        properties +="directories=no,titlebar=no,toolbar=no,location=no,status=no,menubar=no,scrollbars=yes, top="+mytop+",left="+myleft;      
        window.open("sch_site.php?id="+id,"Search",properties);  
     }
     
     function printexpense(id){                  
        parent.parent.location.href ="rpt.incentivebyjob.php?id="+id
     }
     
     function chkDetail(){ 
               if(document.formDetail.site_id.value == ""){
                    alert('กรุณากรอกรหัสสถานีก่อนนะครับ');
                    document.formDetail.site_id.focus(); 
                    return false;
               } 
                if (document.formDetail.location_from.value == ""){
                    alert('กรุณากรอกสถานที่ที่อยู่ก่อนไปก่อนนะครับ');
                    document.formDetail.location_from.focus(); 
                    return false;
               } 
                if (document.formDetail.location_to.value == ""){    
                    alert('กรุณากรอกสถานที่มาถึงก่อนขับก่อนนะครับ');
                    document.formDetail.location_to.focus(); 
                    return false;
               } 
                if (document.formDetail.distance_from.value == ""){    
                    alert('กรุณากรอกเลขไมล์รถก่อนขับก่อนนะครับ');
                    document.formDetail.distance_from.focus(); 
                    return false;
               } 
                if (document.formDetail.distance_to.value == ""){
                    alert('กรุณากรอกรเลขไมล์ถึงแล้วก่อนนะครับ');
                    document.formDetail.distance_to.focus(); 
                    return false;
               } 
              //  if (document.formDetail.distance_result.value == ""){ 
               //      alert('กรุณากรอกระยะทางที่เดินทางก่อนนะครับ');
              //      document.formDetail.distance_result.focus(); 
              //      return false;
              // } 
                if (document.formDetail.description.value == ""){    
                    alert('กรุณากรอกรายละเอียดของงานที่ก่อนนะครับ');
                    document.formDetail.description.focus(); 
                    return false;
               } 
               
                    return true;       
               
     }     
     
     function click2editdetail(id,dte,seq_id,site_id,location_form,location_to,distance_form,distance_to,ditstance_result,express_position,jobdescription,job_no,allowance,incentive,fee_hotel,fee_oil_gas,other_fee){

		// ,job_no,allowance,incentive,fee_hotel,fee_oil_gas

               document.formDetail.seq_id.value = seq_id;
			   document.formDetail.dte.value = dte;
               document.formDetail.site_id.value = site_id;     
               document.formDetail.location_from.value = location_form; 
               document.formDetail.location_to.value = location_to; 
               document.formDetail.distance_from.value = distance_form; 
               document.formDetail.distance_to.value = distance_to; 
               document.formDetail.distance_result.value = ditstance_result; 
               document.formDetail.express_.value = express_position; 
               document.formDetail.description.value = jobdescription;   
			   
			         
		document.formDetail.job_no.value = job_no;  
               document.formDetail.allowance.value = allowance;  
               document.formDetail.incentive.value = incentive;  
               document.formDetail.fee_hotel.value = fee_hotel;   
               document.formDetail.fee_oil_gas.value = fee_oil_gas;
               document.formDetail.other_fee.value = other_fee; 
     }
     
      function click2clrtext(){
               document.formDetail.seq_id.value = '';
               document.formDetail.site_id.value = '';     
               document.formDetail.location_from.value = ''; 
               document.formDetail.location_to.value = ''; 
               document.formDetail.distance_from.value = ''; 
               document.formDetail.distance_to.value = ''; 
               document.formDetail.distance_result.value = ''; 
               document.formDetail.express_.value = ''; 
               document.formDetail.description.value = ''; 
               document.formDetail.job_no.value = '';  
               document.formDetail.allowance.value = '';  
               document.formDetail.incentive.value = '';  
               document.formDetail.fee_hotel.value = '';   
               document.formDetail.fee_oil_gas.value = '';
               document.formDetail.other_fee.value = '';   
               document.formDetail.site_id.focus();          
     }
      
      function click2delete(id,seq_id){
//alert(seq_id); 
          if(confirm('คุณแน่ใจหรือไม่ที่ต้องการส่งข้อมูลเพื่อการตรวจสอบครับ')==true){                                       
            parent.parent.location.href ="incentive.detail.php?typer=del&id="+id+"&seq_id="+seq_id;
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

