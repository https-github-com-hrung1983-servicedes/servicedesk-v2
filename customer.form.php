<?
header("Content-Type: text/html; charset=tis-620");

session_start();
require_once("function.php");

if(!checkUser()){    echo Message(35,"red","ข้อความเตือน","คุณยังไม่ได้กรอกชื่อและรหัสผ่านครับ","<a href='index.php?link=customer.form'> เข้าสู่ระบบ </a>");
   exit;
}
$id = $_REQUEST["id"];
$type = $_REQUEST["typer"];  
if($type != "add" && $type !="edit" ){
 echo Message(35,"red","ข้อความเตือน","คุณไม่มีสิทธิ์เข้าใช้หน้านี้","<a href='javascript:history.back(1)'> กลับ</a>");
 exit;
}
include("header.php");                    
if ($type == "edit") {
  $sql = "Select * from tbl_other_customer
             Where customer_id = $id";       
  $rs = mysqli_query($conn,$sql);
  $c = mysqli_fetch_array($rs);        
}
                
?>
<title>Bizserv Solution Co.,Ltd</title>
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
<table width="100%" align="center" class="mytable" id="table" height="70%"   cellpadding="1" cellspacing="1">
    <tr>                                               
        <td valign="top">                                                       
            <form action="customer.execute.php"  method="post"  name="form1" id="form1"  >  
            <input class="form-control"  type="hidden" name="customer_id" id="customer_id" value="<?=$c["customer_id"];?>" style="width:100pt" readonly="readonly">                                 
                <table width="100%" border="0" cellpadding="0" cellspacing="0" class="mytable" border="1" bordercolor="#FF0000">
                    <tr>
                        <th align="center" height="40" width="100%" colspan="6" class="th">Cusotmer</th>                    
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
                <table align="center"  id="table" cellpadding="1" cellspacing="1" border="0">
                    <tr>
                      <td width="20%" height="20" align="left" class="fontBblue" >รหัสลูกค้า :  </td>  
                      <td width="80%" align="left" class="fontBblue" colspan="4">                   
                      <input class="form-control"  type="text" name="customer_idx" id="customer_idx" value="<?=formatNum($c["customer_id"],3);?>" style="width:100pt" readonly="readonly"></td>          
                  </tr >
                   <tr>
                      <td width="20%" height="20" align="left" class="fontBblue" >ชื่อลูกค้า :  </td>  
                      <td width="80%" align="left" class="fontBblue" colspan="4">                   
                      <input class="form-control"  type="text" name="customer_name" id="customer_name" value="<?=$c["customer_name"];?>" style="width:550pt"></td>          
                  </tr >
                    
                    <tr>
                      <td height="20%" align="left" class="fontBblue" ><nobr>ชื่อผู้ติดต่อ :</td>
                      <td height="30%" align="left" class="fontBblue"> 
                      <input class="form-control"  type="text" name="customer_contact" id="customer_contact" value="<?=$c["customer_contact"];?>" style="width:226pt" /></td>
                      <td height="20%" align="left" class="fontBblue"><nobr>  เบอร์โทรศัพท์  :</td>
                      <td height="30%" align="left" class="fontBblue" >
                      <input class="form-control"  type="text" name="customer_tel" id="customer_tel" value="<?=$c["customer_tel"];?>"  style="width:200pt" /></td>
                    </tr>
                    
                    <tr>
                      <td height="20%" align="left" class="fontBblue" ><nobr>ที่อยู่  :</td>
                      <td height="80%" align="left" class="fontBblue" colspan="4">
                      <input class="form-control"  type="text" name="customer_address" value="<?=$c["customer_address"];?>" id="customer_address"  style="width:550pt" /></td>
                    </tr>  
                    
                </table>  
            </form></td></tr></table>

</form>
<script type="text/javascript">
   function CheckText(){
        if(document.form1.customer_name.value == "") {
            alert('กรุณากรอกชื่อลูกค้าก่อนนะครับ');
            document.form1.customer_name.focus();
            return false;
        }   
        return true;
    }   
</script>
