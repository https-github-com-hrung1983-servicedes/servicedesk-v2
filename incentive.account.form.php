<?
header("Content-Type: text/html; charset=tis-620");

session_start();
require_once("function.php");

if(!checkUser()){    echo Message(35,"red","��ͤ�����͹","�س�ѧ������͡����������ʼ�ҹ��Ѻ","<a href='index.php?link=incentive.account.form'> �������к� </a>");
   exit;
}
$id = $_REQUEST["id"];
$type = $_REQUEST["type"];  
if($type != "add" && $type !="edit" ){
 echo Message(35,"red","��ͤ�����͹","�س������Է��������˹�ҹ��","<a href='javascript:history.back(1)'> ��Ѻ</a>");
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
                       <td align="left" valign="middle"><b> ����������� </b></td><?}?>
                       <td align="left">
                       <a href="#" onclick="printexpense(<?=$id?>);" ><img src="image/icon_printer.gif" alt="Print" width="20" height="18" border="0" align="right" /> </a></td>
                       <td align="left"><b> ����� </b></td>                                          
                       <td>
                            <input class="form-control"  name="Submit"  type="image" onclick=" return CheckText()"  src="image/save.jpg" alt="Save" align="right" width="20" height="20" /></td>
                       <td align="left"><b>�ѹ�֡</b></td>                       
                       <td valign="middle"><a href="incentive.ot.list.php" >
                       <img src="image/cancel.jpg" alt="Cancel" width="20" height="18" border="0" align="left" /> </a> </td>
                       <td align="left"><nobr><b> ¡��ԡ</b>     </td>
                     </tr>
                </table>       
                <table width="50%" align="center"  id="table" cellpadding="1" cellspacing="1" border="0">
                   <tr>
                      <td height="20" align="left" class="fontBblue">�Ţ���  :  </td>
                      <td align="left" class="fontBblue">
                          <input class="form-control"  style="width:100pt;" name="other_no" type="text" id="other_no" value="<?=$c["other_no"]?>" readonly="readonly"/></td>                       
                     </tr> 
                   <tr>
                      <td height="20" align="left" class="fontBblue">�ѹ���  : </td>
                      <td align="left" class="fontBblue"> 
                          <input class="form-control"  style="width:100pt;" name="other_date" type="text" id="other_date" value="<?=$other_date?>" size="35" maxlength="10"  readonly="readonly"/>                          </td>                       
                     </tr>  
                     <tr>  
                      <td align="left" class="fontBblue"><nobr>���ͼ����ԡ : </td>
                      <td align="left" class="fontBblue">
                        <input class="form-control"  type="hidden" name="other_receive_id" id="other_receive_id" value="<?=$other_receive_id?>" readonly="readonly">
                        <input class="form-control"  type="text" name="other_receive_name" id="other_receive_name" value="<?=$other_receive_name?>" style="width:250pt;" readonly="readonly"></td>
                     </tr>  
                     <tr>   
                            <td align="left" class="fontBblue"><nobr>��������´  : </td>                                       
                           <td align="left" class="fontBblue">    
                           <input class="form-control"  style="width:400pt;" name="other_description" type="text" id="other_description" value="<?=$c["other_description"]?>"/>  </td>
                     </tr>  
                     <tr> 
                           <td align="left" class="fontBblue"><nobr> �ѹ����Թ�ҧ�  : </td>                                   
                           <td align="left" class="fontBblue"><nobr>  
                           <input class="form-control"  style="width:100pt;" name="other_real_godate" type="text" id="other_real_godate" value="<?=$other_real_godate?>" size="35" maxlength="10"  readonly="readonly"/>                
                          <a href="#" onclick="cdp1.showCalendar(this, 'other_real_godate'); return false;" > 
                          <img src="image/calendar.png" width="17" height="13" border="0" /></a></td>
                  </tr >
                  <tr> 
                           <td align="left" class="fontBblue"><nobr> �ѹ����Թ�ҧ��Ѻ  : </td>                                     
                           <td align="left" class="fontBblue"><nobr>  
                           <input class="form-control"  style="width:100pt;" name="other_real_backdate" type="text" id="other_real_backdate" value="<?=$other_real_backdate?>" size="35" maxlength="10"  readonly="readonly"/>                
                          <a href="#" onclick="cdp1.showCalendar(this, 'other_real_backdate'); return false;" > 
                          <img src="image/calendar.png" width="17" height="13" border="0" /></a></td>
                  </tr >
                  <tr> 
                           <td align="left" class="fontBblue"><nobr> ����ѹ�Թ�ҧ  : </td>                                   
                           <td align="left" class="fontBblue"><select name="other_totaldate" id="other_totaldate" style="width:100pt;">
                           <? for ($i=1;$i<=60;$i++){?>
                            <option value="<?=$i?>" <?if($i==$c["other_totaldate"]) echo "selected";?>><?=$i?></option>
                            <?}?>
                           </select></td>
                  </tr >  
                 </table>    <br>
                <table width="80%" align="center" id="table" cellpadding="1" cellspacing="1" border="1">                       
                    <tr>
                        <td width="10%" height="20" class="fontBblue" align="center">�ӴѺ���</td>
                        <td width="40%" height="20" class="fontBblue" align="center">��������´</td>
                        <td width="15%" height="20" class="fontBblue" align="center">�ӹǹ�Թ</td>       
                    </tr >
                    <tr>
                        <td width="10%" class="fontBblue" align="center">1.</td>
                        <td width="40%" class="fontBblue" align="left">&nbsp;&nbsp;��ҷ��ѡ��ҧ�ѧ��Ѵ�ӹǹ 
                            <select name="other_rental_day" id="other_rental_day" >
                               <? for ($i=0;$i<=60;$i++){?>
                                <option value="<?=$i?>" <?if($i==$c["other_rental_day"]) echo "selected";?>><?=$i?></option>
                                <?}?>
                           </select> (�׹)                        
                        </td>
                        <td width="15%" class="fontBblue" align="center"><input class="form-control"  style="width:120pt;direction:rtl;" type="text" name="other_rental" value="<?=$c["other_rental"];?>" id="other_rental"></td>
                    </tr >
                    <tr>
                        <td width="10%" class="fontBblue" align="center">2.</td>
                        <td width="40%" class="fontBblue" align="left">&nbsp;&nbsp;�����������§��ҧ�ѧ��Ѵ�ӹǹ 
                            <select name="other_expenses_per_day" id="other_expenses_per_day">
                               <? for ($i=0;$i<=60;$i++){?>
                                <option value="<?=$i?>" <? if($i==$c["other_expenses_per_day"]) echo "selected";?>><?=$i?></option>
                                <?}?>                                         
                           </select> (�ѹ)                        
                        </td>
                        <td width="15%" class="fontBblue" align="center"><input class="form-control"  type="text" readonly value="<?=$c["other_expenses_per"];?>" name="other_expenses_per" id="other_expenses_per" style="width:120pt;direction:rtl;"></td>        
                    </tr >
                     <tr>
                        <td width="10%" class="fontBblue" align="center">3.</td>
                        <td width="40%" class="fontBblue" align="left">&nbsp;&nbsp;��ҹ���ѹö�������</td>
                        <td width="15%" class="fontBblue" align="center"><input class="form-control"  type="text" value="<?=$c["other_gas_oil"];?>" name="other_gas_oil" id="other_gas_oil" style="width:120pt;direction:rtl;"></td>               
                    </tr >
                    <tr>
                        <td width="10%" class="fontBblue" align="center">4.</td>             
                        <td width="40%" class="fontBblue" align="left">&nbsp;&nbsp;������������ 
                           <input class="form-control"  type="text" name="other_pay" id="other_pay" value="<?=$c["other_pay"]?>" style="width:280pt;">
                        </td>                                                                                
                        <td width="15%" class="fontBblue" align="center"><input class="form-control"  type="text" name="other_pay_total" value="<?=$c["other_pay_total"];?>" id="other_pay_total" style="width:120pt;direction:rtl;"></td>       
                    </tr >
                    <tr>
                        <td width="10%" class="fontBblue" align="center">5.</td>             
                        <td width="40%" class="fontBblue" align="left">&nbsp;&nbsp;��� Incentive </td>                                                                          
                        <td width="15%" class="fontBblue" align="center"><input class="form-control"  type="text" name="incentive_total" value="<?=$c["incentive_total"]?>" id="incentive_total" style="width:120pt;direction:rtl;" readonly></td>       
                    </tr >
                    <tr>
                        <td width="10%" class="fontBblue" align="center">6.</td>             
                        <td width="40%" class="fontBblue" align="left">&nbsp;&nbsp;������/��.</td>                                                                          
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
                        <td width="10%" class="fontBblue" colspan="2" align="center">������Թ������</td>                                                                                 
                        <td width="15%" class="fontBblue" align="center"><input class="form-control"  type="text" readonly="readonly"  name="other_total" value="<?=$c["other_total"];?>" id="other_total" style="width:120pt;direction:rtl;bgcolor:red;"></td>       
                    </tr>   
                                    
                </table>
                </form>
  <script type="text/javascript"> 
 var props = {    formatDate :        '%m-%d-%y'    };
    props.formatDate = '%y-%m-%d';
    var cdp1 = new CalendarDatePicker(props); 
	
</script>      
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
