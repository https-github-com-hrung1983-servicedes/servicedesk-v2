<?
header("Content-Type: text/html; charset=tis-620");                 
session_start();
require_once("function.php");          
  
  if(!checkUser()){    echo Message(35,"red",$titel1,$msg1,"<a href='index.php?link=incentive.ot.list'> $login </a>");
  exit;
  }  
 $user_id = $_REQUEST["user_id"];
 if($user_id == ""){                                                 
   $user_id = $_SESSION['Uid'];      
 }                                                    
include("header.php");   
       $other_date = getDte();
       $sql = "SELECT
                    tbl_incentive_ot.id,
                    tbl_incentive_ot.other_no,
                    tbl_incentive_ot.other_date,
                    tbl_user_login.name,
                    tbl_user_login.sname,
                    tbl_incentive_ot.other_description,
                    tbl_incentive_ot.other_rental,
                    tbl_incentive_ot.other_expenses_per,
                    tbl_incentive_ot.other_gas_oil,
                    tbl_incentive_ot.other_pay_total,
                    tbl_incentive_ot.status_check
              FROM
                    tbl_incentive_ot
                    Inner Join tbl_user_login ON tbl_incentive_ot.other_receive = tbl_user_login.user_bss_id";
   //if($Ustate=="user" || $Ustate=="helpdesk"){
        $sql .= " Where tbl_user_login.user_bss_id = '$user_id'  Order by  tbl_incentive_ot.id DESC";
//echo $sql;
 //  }
   $sql_cnt_status = mysqli_query($conn,"SELECT count(tbl_incentive_ot.status_check ) as cnt 
FROM tbl_incentive_ot Inner Join tbl_user_login ON tbl_incentive_ot.other_receive = tbl_user_login.user_bss_id
Where tbl_user_login.user_bss_id = '".$_SESSION['Uid']."'
And tbl_incentive_ot.status_check = ''");
$c_cnt_status = mysqli_fetch_array($sql_cnt_status);
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
    .mytable1 { width:100%; font-size:11px;
                border:1px solid #ccc;
                font-size:10px;     
    }
    .mytable11 {width:100%; font-size:12px;
                border:1px solid #ccc;
                font-size:11px;     
    }
     .th{ background-color:#003366; color:#FFF; padding:0px; border:0px solid #ccc; height:20px; }
     .td{ border-color:#003366;};
    -->
</style>
  
<table width="100%" align="center" class="mytable" id="table" height="100%"   cellpadding="1" cellspacing="1" >
    <tr>
        <td valign="top"> 
            <form  method="post"   name="form1" id="form1"  action="#"  onSubmit="return false";> 
             

                   <table width="100%" border="0" cellpadding="0" cellspacing="0" class="mytable">
                    <tr>
                        <td width="879" valign="middle" align="center">   
						 <?
                        if($_SESSION["Ustate"] == "admin" ||  $_SESSION["Ustate"] == "account"){ 
                        ?>
						<span class="fonttitle_board">&nbsp;Employee Name :</span> 
                            <select name="user_id" id="user_id" style="width:150" onchange="form1.submit();">  
                                    <option value="select">--Select--</option>
                           <?
                           $sql_user = "select * from tbl_user_login where active = 'y' order by name";
                           $rc_user = mysqli_query($conn,$sql_user);
                           while($c_user = mysqli_fetch_array($rc_user)){
                           ?>         
                                    <option value="<?=$c_user["user_bss_id"]?>" <? if($c_user["user_bss_id"]==$user_id) echo "selected";?> ><?=$c_user["name"];?></option>    
                            <? }?>
                                </select>&nbsp;
                        <?
                        }  
                        ?>     
                            <!--span class="fonttitle_board">&nbsp;Date :</span>      
                            <input class="form-control"  style="width:75pt;" name="date_beg"  type="text" onclick="cdp1.showCalendar(this, 'date_beg');return false;" id="date_beg" value="<?=$other_date;?>" size="35" maxlength="10" />                       
                            &nbsp;<input class="form-control"   type="button" name="sch" value="ค้นหา"  onclick="Search_Click(typer.value,state.value,schBy.value,schTxt.value,date_beg.value,date_end.value)"style="width:50pt;"-->
                        </td>
                        <td width="18" valign="middle">
						<? if($c_cnt_status["cnt"] == 0 || $_SESSION['Ustate']=="cm" || $_SESSION['Ustate']=="admin"){?>
						<a href="incentive.form.php?type=add" target="_parent">
                        <img src="image/add.JPG" alt="Add" width="20" height="20" border="0" align="right"> </a>
						<?}?>
						</td>
                        <td width="27" valign="middle">&nbsp;<b><? if($c_cnt_status["cnt"] == 0  || $_SESSION['Ustate']=="cm" || $_SESSION['Ustate']=="admin"){
							?> เพิ่ม <?}?></b></td>
                        <td width="18" valign="middle"></td>
                    </tr>
                </table>     
                <table width="100%" align="center" class="mytable" id="table7"  cellpadding="1" cellspacing="1">
                    <tr>             
                        <th class="th" width="5%">No.</th>
                        <th class="th" width="7%">เลขที่</th>
                        <th class="th" width="10%">ชื่อผู้เบิก</th>
                        <th class="th" width="25%">รายละเอียด</th>
                        <th class="th" width="8%">วันที่ขอเบิก</th>
                        <th class="th" width="7%">ค่าที่พัก</th>
                        <th class="th" width="7%">ค่าเบี้ยงเลี้ยง</th>
                        <th class="th" width="7%">ค่าเดินทาง</th>
                        <th class="th" width="7%">ค่าใช้จ่ายอื่นๆ</th>
                        <th class="th" width="10%">รวม</th>      
                    </tr >
                        <?  // echo $sql;
                         $res = mysqli_query($conn,$sql);
                         $i=0;
                          while($row = mysqli_fetch_array($res)) {  
                               $i++;       
                               $other_total =  0;
                               $other_total =  $row["other_rental"]+$row["other_gas_oil"]+$row["other_pay_total"];
                              
                              if($row["status_check"] == ""){
                                $color = "red";   
                              }else{
                                $color = "black";    
                              }
                              
                              ?>    
							  
                          <tr onclick="click2edit(<?=$row["id"]?>,'edit');" onmouseover="this.style.backgroundColor='violet';" onmouseout="this.style.backgroundColor='white';" >
                          <td style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc; border-color:#003366;" align="center">
                            <font color="<?=$color?>"><?=$i?></td>
                          <td style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;"  align="center">
                              <font color="<?=$color?>"><?=$row["other_no"];?></td>     
                          <td  style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;" align="center">
                              <font color="<?=$color?>"><?=$row["name"];?></td>
                          <td  style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;" align="left">
                              <font color="<?=$color?>"><?=$row["other_description"];?></td>
                          <td  style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;" align="center">
                              <font color="<?=$color?>"><?=$row["other_date"];?></td>
                          <td  style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;" align="center">
                              <font color="<?=$color?>"><?=$row["other_rental"];?></td>
                          <td  style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;" align="center">
                              <font color="<?=$color?>"><?=$row["other_expenses_per"];?></td>
                          <td  style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;" align="center">
                              <font color="<?=$color?>"><?=$row["other_gas_oil"];?></td>
                          <td  style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;" align="center">
                              <font color="<?=$color?>"><?=$row["other_pay_total"];?></td>
                          <td  style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;" align="center">
                              <font color="<?=$color?>"><?=$other_total;?></td>
                          
                          </tr>      
                       <? }?>
                          <tr>
                            <td colspan="10" style="padding:0px; border-bottom:1px solid #ccc; border-right:0px solid #ccc;"> จำนวนทั้งหมด <?=$i;?>แถว</td>
                          </tr>   
                </table>  </form></td></tr></table>

<script type="text/javascript"> 
    var props = {    formatDate :        '%m-%d-%y'    };
    props.formatDate = '%y-%m-%d';
    var cdp1 = new CalendarDatePicker(props);                   
  
    function Search_Click(type,state,selected,txt,dte_beg,dte_end){        
    parent.mainPage.location.href ="logcall.index.php"+"?type="+type+"&state="+state+"&schBy="+selected+"&schTxt="+txt+"&dte_beg="+dte_beg+"&dte_end="+dte_end;
      }
      
    function click2edit(id,typer){      
    //alert(id);                        
         parent.parent.location.href ="incentive.form.php?id="+id+"&type="+typer;   
      }
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


