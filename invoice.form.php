<?
header("Content-Type: text/html; charset=tis-620");

session_start();
require_once("function.php");

//if(!checkUser()){    echo Message(35,"red","ข้อความเตือน","คุณยังไม่ได้กรอกชื่อและรหัสผ่านครับ","<a href='index.php'> เข้าสู่ระบบ </a>");
//   exit;
//}
$id = $_REQUEST["id"];
$type = $_REQUEST["type"];  
//if($type != "add" && $type !="edit" ){
// echo Message(35,"red","ข้อความเตือน","คุณไม่มีสิทธิ์เข้าใช้หน้านี้","<a href='javascript:history.back(1)'> กลับ</a>");
// exit;
//}
include("header.php");                    
if ($type == "add") {
    $open_date = getDte();     
    $onsite_date = getDte();     
    $fix_date = getDte();     
    $close_date = getDte();
    $hour_sal = "2";     
} elseif ($type == "edit") {
  $sql = "Select tbl_log_call_center.*,
              tbl_category_type.fixed_description,
              u1.name as reciept_name,            
              u1.sname as reciept_sname,         
              u2.name as engineer_name,
              u2.sname as engineer_sname,
              tbl_province.provice_phase
             From tbl_log_call_center
                    Inner Join tbl_category_type ON tbl_log_call_center.category_type = tbl_category_type.category_id
                    Inner Join tbl_user u1 ON tbl_log_call_center.reciept_job_bss = u1.user_id 
                    Inner Join tbl_user u2 ON tbl_log_call_center.reciept_job_user_id = u2.user_id
                    Left Join tbl_province ON tbl_log_call_center.site_province = tbl_province.province_name
             Where tbl_log_call_center.id = $id";
 // echo $sql;
  $rs = mysqli_query($conn,$sql);
  $c = mysqli_fetch_array($rs);
    $open_date = $c["open_call_dte"];     
    $onsite_date = $c["onsite_datetime"];  
    $fix_date = $c["fixed_time"];     
    $close_date = $c["closed_date"];
    $hour_sal = $c["sla"];
  //  echo "nn".$c["provice_phase"];
}
                
?>
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
            <form action="invoice.execute.php"  method="post"  name="form1" id="form1"  >
            <input class="form-control"  type="hidden" value="<?=$id?>" name="id" id = "id">                            
                <table width="100%" border="0" cellpadding="0" cellspacing="0" class="mytable" border="1" bordercolor="#FF0000">
                    <tr>
                        <th align="center" height="40" width="100%" colspan="6" class="th">INVOICE</th>                    
                    </tr >
                    
                    <tr>
                           <td width="95%" colspan="2">&nbsp;</td>
                        <td><input class="form-control"  name="Submit"  type="image" onclick=" return CheckText()"  src="image/save.jpg" alt="Save" align="right" width="20" height="20" />    </td>
                       <td align="left"><b>บันทึก</b>    </td>
                       <td><a href="javascript:history.back(1)" ><img src="image/cancel.jpg" alt="Cancel" width="20" height="18" border="0" align="left" /> </a> </td>
                       <td align="left"><nobr><b> ยกเลิก</b>     </td>
                     </tr>
                </table>
                <br>
                <table width="50%" align="center"  id="table" cellpadding="1" cellspacing="1" border="1">
                   <tr>
                      <td height="20" align="left" class="fontBblue" >ลูกค้า :  </td>  
                      <td align="left" class="fontBblue"><nobr>
                      <input class="form-control"  type="hidden" name="customer_id" id="customer_id" value="">                   
                      <input class="form-control"  type="text" name="customer_idx" id="customer_idx" value="" onclick="javascript:getCustomer('customer_id',customer_id.value)" style="width:100pt;">
                      <input class="form-control"  type="text" name="customer_name" id="customer_name" value="" style="width:250pt;" readonly="readonly"></td>
                      <td align="left" class="fontBblue"><nobr>&nbsp;&nbsp;&nbsp;เลขที่  : </td>                                       
                           <td align="left" class="fontBblue"  colspan="5">    
                           <input class="form-control"  style="width:100pt;" name="no" type="text" id="no" value="<??>" size="35" maxlength="10"/></td>
                       <td align="left" class="fontBblue"><nobr>&nbsp;&nbsp;&nbsp; วันเวลาที่เปิดงาน  : </td>                                       
                           <td align="left" class="fontBblue">  <nobr>  
                           <input class="form-control"  style="width:100pt;" name="open_date" type="text" id="open_date" value="<?=$open_date?>" size="35" maxlength="10"  readonly="readonly"/>
                          <a href="#" onclick="cdp1.showCalendar(this, 'open_date'); return false;" > 
                          <img src="image/calendar.png" width="17" height="13" border="0" /></a></td>
                  </tr >
                  <tr>                              
                      <td height="20" align="left" class="fontBblue" ><nobr>ชื่อผู้รับผิดชอบ :</td>
                      <td height="20" align="left" class="fontBblue"><nobr></td>
                  </tr>                                        
                     
                </table>
                <table align="center" class="mytable1" id="table7" cellpadding="1" cellspacing="1"><tr></tr >
                </table>
            </form></td></tr></table>
<script type="text/javascript"> 
    var props = {    formatDate :        '%m-%d-%y'    };
    props.formatDate = '%y-%m-%d';
    var cdp1 = new CalendarDatePicker(props); 
   
    function CheckText(){
        if(document.form1.open_date.value == "") {
            alert('กรุณาลงวันเวลาที่เปิดงานก่อนนะครับ');
            document.form1.open_date.focus();
            return false;
        } 
        if(document.form1.cmbCateType.value == "") {
            alert('กรุณาเลือกประเภทใบงาน');
            document.form1.cmbCateType.focus(); 
            return false;
        } 

        if(document.form1.txtSid.value == "") {
            alert('กรุณาเลือกรหัสลูกค้าก่อนนะครับ');
            document.form1.txtSid.focus(); 
            return false;
        } 
        return true;
    }   

                 
    function getCustomer(id,val){     
        myleft=(screen.width)?(screen.width-800)/2:100;    
        mytop=(screen.height)?(screen.height-300)/2:100;      
        properties = " width=800,height=300";                
         
        properties +=",menubar=no,scrollbars=auto,scrollbars=auto, top="+mytop+",left="+myleft;      
        window.open("sch_customer.php?id="+val,"Search",properties);                                                                       

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

