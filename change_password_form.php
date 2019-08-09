<?
header("Content-Type: text/html; charset=tis-620");   
session_start();
require_once("function.php");                         
if(!checkUser()){    echo Message(35,"red",$titel1,$msg1,"<a href='index.php?link=change_password_form'> $login </a>");
   exit;
} 
 include("header.php");               
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
            <form action="change_password_excute.php"  method="post"  name="form1" id="form1"  >          
                <table width="100%" border="0" cellpadding="0" cellspacing="0" class="mytable" border="1" bordercolor="#FF0000">
                    <tr>
                        <th align="center" height="40" width="100%" colspan="6" class="th">Change Password</th>                    
                    </tr >
                    
                    <tr>
                           <td width="95%" colspan="2">&nbsp;</td>
                        <td><input class="form-control"  name="Submit"  type="image" onclick=" return CheckText()"  src="image/save.jpg" alt="Save" align="right" width="20" height="20" />    </td>
                       <td align="left"><b>บันทึก</b>    </td>
                       <td><a href="index1.php" target="mainPage" ><img src="image/cancel.jpg" alt="Cancel" width="20" height="18" border="0" align="left" /> </a> </td>
                       <td align="left"><nobr><b> ยกเลิก</b>     </td>
                     </tr>
                </table>
                <br>
                <table width="30%" align="center"  id="table" cellpadding="1" cellspacing="1" border="0">
                   <tr>
                      <td width="10%" height="20" align="left" class="fontBblue" >รหัสผ่านเดิม :  </td>  
                      <td width="20%" align="left" class="fontBblue">                
                      <input class="form-control"  type="hidden" name="txtOld1" id="txtOld1" value="<? echo $_SESSION["Upassword"];?>" style="width:226pt" />
                      <input class="form-control"  type="password" name="txtOld2" id="txtOld2" value="" style="width:226pt" />
                      </td>    
                  </tr >
                    
                    <tr>
                      <td height="10%" align="left" class="fontBblue" ><nobr>รหัสผ่านใหม่ :</td>
                      <td height="20%" align="left" class="fontBblue"> <input class="form-control"  type="password" name="txtNew1" id="txtNew1" value="" style="width:226pt" /></td>
                    </tr>
                    
                    <tr>
                      <td height="10%" align="left" class="fontBblue" ><nobr>ยืนยันรหัสผ่านใหม่  :</td>
                      <td height="20%" align="left" class="fontBblue"><input class="form-control"  type="password" name="txtNew2" id="txtNew2" value="" style="width:226pt" /></td> 
                    </tr>                    
                    
                </table>
                <table align="center" class="mytable1" id="table7" cellpadding="1" cellspacing="1"><tr></tr >
                </table>
            </form></td></tr></table>
   </form>
   <script>
   function CheckText(){
       if(document.form1.txtOld1.value != document.form1.txtOld2.value){               
            alert('รหัสผ่านเดิมไม่ถูกต้อง กรุณากลับไปเชคก่อนนะครับ');
            document.form1.txtOld2.focus();
            return false;
       }                                                                   
        if(document.form1.txtOld2.value == "") {
            alert('กรุณารหัสผ่านเดิมก่อนนะครับ');
            document.form1.txtOld2.focus();
            return false;
        } 
        if(document.form1.txtNew1.value == "") {
            alert('กรุณารหัสผ่านใหม่ก่อนนะครับ');
            document.form1.txtNew1.focus(); 
            return false;
        } 
         if(document.form1.txtNew1.value == "") {
            alert('กรุณายืนยันรหัสผ่านใหม่ก่อนนะครับ');
            document.form1.txtNew1.focus(); 
            return false;
        } 
        if(document.form1.txtNew1.value != document.form1.txtNew2.value) {
            alert('กรุณายืนยันรหัสผ่านไม่ตรงกัน กรุณาเชคก่อนนะครับ');
            document.form1.txtNew2.focus(); 
            return false;
        } 
        return true;
    }
    </script>
