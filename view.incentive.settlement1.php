<?
header("Content-Type: text/html; charset=tis-620");                 
session_start();
require_once("function.php");
  if(!checkUser()){    
      echo Message(35,"red",$titel1,$msg1,"<a href='index.php'> $login </a>");
      exit;
  } 
  $id = $_REQUEST["id"];
 include("header.php");  





$sql_head="select other_no,other_date,other_receive,authen_by from tbl_incentive_ot where id = $id"; // echo $sql_head; 
$rc_head =  mysqli_query($conn,$sql_head);
$c_head = mysqli_fetch_array($rc_head);

$sql="select * from tbl_incentive_detail where id = $id order by seq_id"; //echo $sql;//exit;
$rc = mysqli_query($conn,$sql);
?>
<link href="image/bss_icon.ico"   rel="shortcut icon" />  
<link href="style/calendar.css" rel="stylesheet" type="text/css">    
<link href="style/mytable.css" rel="stylesheet" type="text/css" />   
<script type="text/javascript" src="script/calendar_date_picker.js"></script>     
<link href="style/stylecss.css" rel="stylesheet" type="text/css">
<link href="style/filtergrid.css" rel="stylesheet" type="text/css">
<link href="css/loading.css" rel="stylesheet" type="text/css" media="all">

<script src="script/jquery.min.js"></script>
<script src="script/thickbox.js"></script>
<script src="script/loading.js"></script>

<script type="text/javascript" src="script/jquery-1.6.4.js"></script>
<script type="text/javascript" src="script/jquery_1.7.1_min.js"></script>
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
            <form  method="post" name="form1" id="form1" action="#" target="_parent"> 
                <table width="100%" border="0" cellpadding="0" cellspacing="0" class="mytable">
                    <tr>
                        <td align ="center">
                        <span class="fonttitle_board">&nbsp;<?echo iconv('UTF-8','TIS-620',"เลขที่  :");?> 
                            &nbsp;  <?=$c_head["other_no"];?>                    </span>
                        <span class="fonttitle_board">&nbsp;<?echo iconv('UTF-8','TIS-620',"วันที่ : ");?>  &nbsp; <?=$c_head["other_date"];?></span> 
                        </td>         
               
                        <td width="18" valign="middle">
         <?
         echo $c_head["authen_by"];
//if(authen_by){
    
    
//}

//1 กำลังตรวจสอบบิล
//2 กำลังตรวจสอบเลขกิโล
//3 ตรวจสอบยอดเงิน
//4 รอโอนเงิน
//5 ได้รับเงินแล้ว
						$str = explode("-",$c_head["other_date"]);
						if($_SESSION["Ustate"] == "admin" || $_SESSION["Ustate"] == "account"){
						?>
						<a lang = "re-calulate.gas-oil.php?id=<?=$id?>&type=edit&no=<?=$c_head["other_no"]?>"  title="<?=$c_head["other_no"]?>"  class="thickbox pointer">
						<img src="image/gear_replace.gif" alt="Edit" width="20" height="20" border="0" align="right"></a.></td>
                        <td width="27" valign="middle">&nbsp;<b><nobr>Re-calulate&nbsp;</b></td>
						
						<td width="27" valign="middle">
						<a href = "incentive.account.form.php?id=<?=$id?>&type=edit">
						<img src="image/addedit.png" alt="Edit" width="20" height="20" border="0" align="right"></a.></td>
                        <td width="27" valign="middle">&nbsp;<b><nobr>Edit&nbsp;</b></td>

						<td width="18" valign="middle">
						<a href = "view.incentive.settlement_execute.php?mode=approver&id=<?=$id?>&user_id=<?=$c_head["other_receive"]?>&months=<?=$str[1]?>&years=<?=$str[0]?>">
						<img src="image/apply_f2.png" alt="Approve" width="20" height="20" border="0" align="right"></a.></td>
                        <td width="27" valign="middle">&nbsp;<b><nobr>Approve</b></td>
                        <td width="18" valign="middle">
						<a href = "view.incentive.settlement_execute.php?mode=return&id=<?=$id?>&user_id=<?=$c_head["other_receive"]?>&months=<?=$str[1]?>&years=<?=$str[0]?>">
						<img src="image/restore_f2.png" alt="Reject" width="20" height="20" border="0" align="right"></td>
                         <td width="27" valign="middle">&nbsp;<b><nobr>Reject</b></td>                         
                        <td width="18" valign="middle">
		<? }?>
						<a href = "rpt.incentivebyemp.php?user_id=<?=$c_head["other_receive"]?>&months=<?=$str[1]?>&years=<?=$str[0]?>">
						<img src="image/cancel.jpg" alt="Delete" width="20" height="20" border="0" align="right">
						</a></td>
                        <td width="27" valign="middle">&nbsp;<b><nobr>Cancel </b></td>
                    </tr>
                </table>   

				 <table width="60%" align="center" class="mytable" id="table7"  cellpadding="1" cellspacing="1">
				 <tr>
					<td colspan="10"><span class="fonttitle_board"><?echo iconv('UTF-8','TIS-620',"รายละเอียดการเดินทาง");?></span></td>
				 </tr>
                    <tr>             
                        <th class="th" width="4%"><?echo iconv('UTF-8','TIS-620',"ลำดับที่");?></th>
                        <th class="th" width="5%"><?echo iconv('UTF-8','TIS-620',"วันที่");?></th>
                        <th class="th" width="6%"><?echo iconv('UTF-8','TIS-620',"รหัสสถานี");?></th>        
                        <th class="th" width="15%"><?echo iconv('UTF-8','TIS-620',"จาก");?></th>             
                        <th class="th" width="15%"><?echo iconv('UTF-8','TIS-620',"ถึง");?></th>        
                        <th class="th" width="6%"><?echo iconv('UTF-8','TIS-620',"เลขไมล์เริ่มต้น");?></th>        
                        <th class="th" width="6%"><?echo iconv('UTF-8','TIS-620',"เลขไมล์สิ้นสุด");?></th>        
                        <th class="th" width="5%"><?echo iconv('UTF-8','TIS-620',"รวมระยะทาง");?></th>        
                        <th class="th" width="5%"><?echo iconv('UTF-8','TIS-620',"ค่าทางด่วน");?></th>        
                        <th class="th" width="60%"><?echo iconv('UTF-8','TIS-620',"รายละเอียดของงาน");?></th>  
                    </tr >
                  <?     
                  while($c = mysqli_fetch_array($rc)){
                  ?>
                  <tr onmouseover="this.style.backgroundColor='violet';" onmouseout="this.style.backgroundColor='white';" >
                       <td style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;"  align="center">&nbsp;<?=$c["seq_id"]?></td>
                       <td style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;"  align="center">&nbsp;<?=$c["dte"]?></td>
                       <td style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;"  align="center">&nbsp;<?=$c["site_id"]?></td>
                       <td style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;"  align="center"><?=$c["location_form"]?>&nbsp;</td>
                       <td style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;"  align="center"><?=$c["location_to"]?>&nbsp;</td>
                       <td style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;"  align="center"><?=$c["distance_form"]?>&nbsp;</td>
                       <td style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;"  align="right"><?=$c["distance_to"]?>&nbsp;</td>
                       <td style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;"  align="right"><?=$c["ditstance_result"]."/".$c["fee_oil_gas"];?>&nbsp;</td>
                       <td style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;"  align="right"><?=$c["express_position"];?>&nbsp;</td>
                       <td style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;"  align="left"><?=$c["jobdescription"];?>&nbsp; </td> 
                  </tr>
                   <? 
                      }
                  ?>     
                </table> 
				
				
				 <table width="60%" align="center" class="mytable" id="table7"  cellpadding="1" cellspacing="1">
				 <tr>
					<td colspan="10"><span class="fonttitle_board"><?echo iconv('UTF-8','TIS-620',"รายละเอียดการเคลียร์ใบเสร็จ");?></span></td>
				 </tr>
                    <tr>             
                        <th class="th" width="4%"><?echo iconv('UTF-8','TIS-620',"รายละเอียดใบเสร็จ");?></th>
                        <th class="th" width="5%"><?echo iconv('UTF-8','TIS-620',"วันที่");?></th>
                        <th class="th" width="6%"><?echo iconv('UTF-8','TIS-620',"ลำดับที่");?></th>        
                        <th class="th" width="8%"><?echo iconv('UTF-8','TIS-620',"รายละเอียด");?></th>             
                        <th class="th" width="8%"><?echo iconv('UTF-8','TIS-620',"บิลเลขที่");?></th>        
                        <th class="th" width="5%"><?echo iconv('UTF-8','TIS-620',"จำนวนเงิน");?></th>        
                    </tr >
                  <?     
				  $sql_settlement = "select * from tbl_incentive_ot_settlement where other_no = $id order by other_seq";
				 $rc_settlement = mysqli_query($conn,$sql_settlement);
                  while($c = mysqli_fetch_array($rc_settlement)){
                  ?>
                  <tr onmouseover="this.style.backgroundColor='violet';" onmouseout="this.style.backgroundColor='white';" >
                       <td style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;"  align="center">&nbsp;<?=$c["other_seq"]?></td>
                       <td style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;"  align="center">&nbsp;<?=$c["other_dte"]?></td>
                       <td style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;"  align="center"><?=$c["bill_description"]?>&nbsp;</td>
                       <td style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;"  align="center"><?=$c["bill_no"]?>&nbsp;</td>
                       <td style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;"  align="center"><?=$c["bill_total"]?>&nbsp;</td>
                       <td style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;"  align="right"><?=$c["bill_total_all"]?>&nbsp;</td>
                  </tr>
                   <? 
                      }
                  ?>     
                </table>
				</td></tr></table>      