<?
header("Content-Type: text/html; charset=tis-620");
session_start();
require_once("function.php");


  if(!checkUser()){
      echo Message(35,"red",$titel1,$msg1,"<a href='index.php?link=rpt.incentivebyemp'> $login </a>");
      exit;
  }
  $months = $_REQUEST["months"];
    $today = getdate();
  if($months == ""){
    $months = $today["mon"];
     $months  = formatNum($months,1);
  }

  $years = $_REQUEST["years"];
  if($years == ""){
    $years = $today["year"];
  }



 include("header.php");
//	  if($user_id != ""){
		 $sql = "SELECT
tbl_incentive_ot.id,
tbl_incentive_ot.other_no,
tbl_incentive_ot.other_date,
tbl_incentive_ot.other_receive,
tbl_incentive_ot.other_by_job,
tbl_incentive_ot.other_description,
tbl_incentive_ot.other_totaldate,
tbl_incentive_ot.other_gas_oil,
Sum(tbl_incentive_ot.other_pay) as other_pay,
tbl_incentive_ot.other_pay_total,
Sum(tbl_incentive_ot.other_total) as other_total,
Sum(tbl_incentive_detail.location_form) AS location_form,
Sum(tbl_incentive_detail.ditstance_result) AS ditstance_result,
Sum(tbl_incentive_detail.distance_result_gps) AS distance_result_gps,
Sum(tbl_incentive_detail.distance_result_agv) AS distance_result_agv,
tbl_incentive_ot.other_rental ,
tbl_incentive_ot.other_expenses_per,
tbl_incentive_detail.express_position,
tbl_incentive_ot.incentive_total,
tbl_incentive_ot.authen_by,
tbl_user.name,
tbl_user.sname,
tbl_user_login.state
FROM
tbl_incentive_ot
Left Join tbl_incentive_detail ON tbl_incentive_ot.id = tbl_incentive_detail.id
Inner Join tbl_user_login ON tbl_incentive_ot.other_receive = tbl_user_login.user_bss_id
Inner Join tbl_user ON tbl_user_login.user_bss_id = tbl_user.id_login";
// 1 สันติ
// 169 กนกพร   169 วรัญญา
// 94 กรรณิการ์
$authe = "";
//echo $_SESSION["User_id"];exit;
if($_SESSION["User_id"] == "169"){
  $authe = "1','3";
}else if($_SESSION["User_id"] == "1" || $_SESSION["User_id"] == "108"){
  $authe = "2";

}else if($_SESSION["User_id"] == "94"){
  $authe = "4";
}else{
  $authe = "1','2','3','4','5','6";
}
		 if($_SESSION["Ustate"] == "admin" || $_SESSION["Ustate"] == "account"){
				$sql .= " Where tbl_incentive_ot.authen_by in ('$authe')";

    } else if($_SESSION["User_id"] == "1") {
       $sql .= " Where tbl_incentive_ot.authen_by in ('$authe')
                and tbl_user_login.state='cm'
                ";
    } else if($_SESSION["User_id"] == "108") {
      $sql .= " Where tbl_incentive_ot.authen_by in ('$authe')
               and tbl_user_login.state='user'
               ";
    }
      else if($_SESSION["User_id"] == "169") {
      $sql .= " Where tbl_incentive_ot.authen_by in ('$authe') ";
    }
    else {
			  $sql .= " Where tbl_incentive_ot.other_receive = '".$_SESSION["Uid"]."'";
		 }

		$sql .= "
		And  tbl_incentive_ot.other_date like '$years-$months%'";

		  $sql .= " Group by tbl_incentive_ot.other_no
		  Order by tbl_incentive_ot.other_date DESC, tbl_incentive_ot.id";

//echo $sql;

		  $rc = mysqli_query($conn,$sql);






?>
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
            <form  method="post" name="form1" id="form1" action="#" target="_parent">
                <table width="100%" border="0" cellpadding="0" cellspacing="0" class="mytable">
                    <tr>
                        <td align ="center">
                        <?
                        if($_SESSION["Ustate"] == "admin" ||  $_SESSION["Ustate"] == "account" ){
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
                            <?}?>
                                </select>&nbsp;
                        <?
                        }
                        ?>
                        <span class="fonttitle_board">&nbsp;Month :</span>
                            <select name="months" id="months" onchange="form1.submit();">
                                <option value = "01" <?if($months=="01") echo "selected";?> >January</option>
                                <option value = "02" <?if($months=="02") echo "selected";?> >February</option>
                                <option value = "03" <?if($months=="03") echo "selected";?> >March</option>
                                <option value = "04" <?if($months=="04") echo "selected";?> >April</option>
                                <option value = "05" <?if($months=="05") echo "selected";?> >May</option>
                                <option value = "06" <?if($months=="06") echo "selected";?> >June</option>
                                <option value = "07" <?if($months=="07") echo "selected";?> >July</option>
                                <option value = "08" <?if($months=="08") echo "selected";?> >August</option>
                                <option value = "09" <?if($months=="09") echo "selected";?> >September</option>
                                <option value = "10" <?if($months=="10") echo "selected";?> >October</option>
                                <option value = "11" <?if($months=="11") echo "selected";?> >November</option>
                                <option value = "12" <?if($months=="12") echo "selected";?> >December</option>
                            </select> &nbsp;

                            <span class="fonttitle_board">&nbsp;Year :</span>
                                    <select name="years" id="years" onchange="form1.submit();">
                                        <option value = "2012" <?if($years==2012) echo "selected";?> >2012</option>
                                        <option value = "2013" <?if($years==2013) echo "selected";?> >2013</option>
                                        <option value = "2014" <?if($years==2014) echo "selected";?> >2014</option>
                                        <option value = "2015" <?if($years==2015) echo "selected";?> >2015</option>
                                        <option value = "2016" <?if($years==2016) echo "selected";?> >2016</option>
                                        <option value = "2017" <?if($years==2017) echo "selected";?> >2017</option>
                                        <option value = "2018" <?if($years==2018) echo "selected";?> >2018</option>
                                        <option value = "2019" <?if($years==2019) echo "selected";?> >2019</option>
                            </select>
                        </td>

                        <td width="18" valign="middle">&nbsp;
                            <!--a href="#" onclick="form1.submit();">
                            <img src="image/pixadex.png" alt="Report" width="20" height="20" border="0" align="right"> </a--></td>
                            <td width="27" valign="middle">&nbsp;<b><nobr>&nbsp; </b></td>
                        <td width="18" valign="middle">
                        <img src="image/cancel.JPG" alt="Delete" width="20" height="20" border="0" align="right">
                        </td>
                        <td width="27" valign="middle">&nbsp;<b><nobr>Cancel </b></td>
                    </tr>
                </table>
                <table width="60%" align="center" class="mytable" id="table7"  cellpadding="1" cellspacing="1">
                    <tr>
                        <th class="th" width="5%"><?echo iconv('UTF-8','TIS-620',"วันเดือนปีที่เบิก");?></th>
                        <th class="th" width="10%"><?echo iconv('UTF-8','TIS-620',"ใบงานเลขที่");?></th>
                        <th class="th" width="10%"><?echo iconv('UTF-8','TIS-620',"ผู้เบิก");?></th>
                        <th class="th" width="15%"><?echo iconv('UTF-8','TIS-620',"รายละเอียดงาน");?></th>
                        <th class="th" width="5%"><?echo iconv('UTF-8','TIS-620',"ระยะทาง");?></th>
                        <th class="th" width="5%"><?echo iconv('UTF-8','TIS-620',"ค่าน้ำมัน");?></th>
                        <th class="th" width="5%"><?echo iconv('UTF-8','TIS-620',"ค่าที่พัก");?></th>
                        <th class="th" width="5%"><?echo iconv('UTF-8','TIS-620',"ค่าเบี้ยเลี้ยง");?></th>
                        <th class="th" width="5%"><?echo iconv('UTF-8','TIS-620',"ค่าใช้จ่ายอื่น");?></th>
                        <th class="th" width="5%"><?echo iconv('UTF-8','TIS-620',"ค่า  Incentive");?></th>
                        <th class="th" width="5%">Total</th>
                        <th class="th" width="10%"><?echo iconv('UTF-8','TIS-620',"สถานะการเบิก");?></th>
		    <?
             //           if($Ustate == "admin"){
                        ?>
                        <th class="th" width="5%">&nbsp;</th>
			<?//}?>
                    </tr >
                  <?
                  while($c = mysqli_fetch_array($rc)){
$str_authen = "";
if($c["authen_by"]=="0"){
    $str_authen = "กลับไปแก้ไขใหม่ (".$_SESSION["Uname"]." ".$_SESSION["Username"].")"; //1

}else if($c["authen_by"]=="1"){
   $str_authen = "กำลังตรวจสอบเอกสาร (วรัญญา)";

       //2
}else if($c["authen_by"]=="2"){
  if($c["state"]=="cm"){ $str_authen = "กำลังตรวจสอบเลขกิโล (อำนาจ)"; }
  if($c["state"]=="user"){ $str_authen = "กำลังตรวจสอบเลขกิโล (สันติ)"; }

}else if($c["authen_by"]=="3"){
  $str_authen = "ตรวจสอบยอดเงิน(วรัญญา)";

}else if($c["authen_by"]=="4"){
  $str_authen = "รอโอนเงิน (กรรณิการ์)";

}else if($c["authen_by"]=="5"){
  $str_authen = "ได้รับเงินแล้ว";
}
		    $total_all = $c["other_gas_oil"]  + $c["other_rental"]  + $c["other_expenses_per"] + $c["other_pay_total"]  + $c["incentive_total"];
                  ?>
                  <tr onmouseover="this.style.backgroundColor='violet';" onmouseout="this.style.backgroundColor='white';" >
                       <td style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;"  align="center">&nbsp;<?=$c["other_date"]?></td>
                       <td style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;"  align="center">&nbsp;<?=$c["other_no"]?></td>
                       <td style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;"  align="center">&nbsp;<?=$c["name"]." ".$c["sname"];?></td>
                       <td style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;"  align="left">&nbsp;<?=$c["other_description"]?></td>
                       <td style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;"  align="right"><?=$c["ditstance_result"]?>&nbsp;</td>
                       <td style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;"  align="right"><?=$c["other_gas_oil"]?>&nbsp;</td>
                       <td style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;"  align="right"><?=$c["other_rental"]?>&nbsp;</td>
                       <td style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;"  align="right"><?=$c["other_expenses_per"]?>&nbsp;</td>
                       <td style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;"  align="right"><?=$c["other_pay_total"]?>&nbsp;</td>
                       <td style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;"  align="right"><?=$c["incentive_total"];?>&nbsp;</td>
                       <td style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;"  align="right"><?=sprintf("%01.2f",$total_all);?>&nbsp;
                       <td style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;"  align="center"><?=iconv('UTF-8','TIS-620',$str_authen);?>&nbsp;</td>
					    <?
                      //  if($Ustate == "admin"){
                        ?><td style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;"  align="center" valign="middle">
								<a href="rpt.incentive.settlement.php?id=<?=$c["id"];?>" target = "_blank" >
                            <img src="image/icon_printer.gif" alt="Report" width="18" height="18" border="0" align="center"> </a>
							<a href="view.incentive.settlement.php?id=<?=$c["id"];?>" >
                            <img src="image/pixadex.png" alt="View" width="18" height="18" border="0" align="center" > </a>
							</td>
						<?//}?>
					   </td>
                  </tr>
                   <?
@unlink("$c[id].pdf");
                      }
                  ?>
                </table>  </form></td></tr></table>
<script type="text/javascript">
function click2print(id){
            document.location.href ="rpt.incentive.settlement.php?id="+id;
      }
	  function click2print(id){
            parent.parent.location.href ="view.incentive.settlement.php?id="+id;
      }
</script>
