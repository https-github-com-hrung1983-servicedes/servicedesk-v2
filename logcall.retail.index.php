<?
header("Content-Type: text/html; charset=tis-620");
session_start();
require_once("function.php");

  if(!checkUser()){    echo Message(35,"red",$titel1,$msg1,"<a href='index.php?link=logcall.index'> $login </a>");
  exit;
  }

include("header.php");
      $type =  $_REQUEST["type"];
      $schTxt =  $_REQUEST["schTxt"];
      $dte_beg =  $_REQUEST["dte_beg"];
      $dte_end =  $_REQUEST["dte_end"];
    if($dte_beg =="") $dte_beg = getDte();
    if($dte_end =="") $dte_end = getDte();
    if($type =="") $type = "0";

$cmd = " ";
if($type=="1") {
$cmd = "  tbl_".$data_table_name."_logcall.call_openjob_datetime between '$dte_beg 00:00:00' and '$dte_end 23:59:59'";
//Or tbl_".$data_table_name."_logcall.status_call = 'feedback'
} elseif($type=="2") {
$cmd = "  tbl_".$data_table_name."_logcall.close_datetime between '$dte_beg 00:00:00' and '$dte_end 23:59:59'";
// Or tbl_".$data_table_name."_logcall.status_call = 'feedback'
} elseif($type=="3") {
$cmd = "  tbl_".$data_table_name."_logcall.job_no like '%$schTxt%'";
// Or tbl_".$data_table_name."_logcall.status_call = 'feedback'
} elseif($type=="4") {    //MSR
$cmd = "  tbl_".$data_table_name."_logcall.ref_job_no like '%$schTxt%'";
}elseif($type=="5") {    //MSR
$cmd = "  tbl_".$data_table_name."_logcall.call_openjob_datetime between '$dte_beg 00:00:00' and '$dte_end 23:59:59' and   tbl_".$data_table_name."_logcall.status_call = 'close'";
}elseif($type=="9") {
$cmd = " tbl_".$data_table_name."_site.customer_id like '%$schTxt%' ";
}elseif($type=="10") {
$cmd = "  tbl_".$data_table_name."_logcall.status_call = 'feedback' ";
$cmd.= " and  tbl_".$data_table_name."_logcall.call_openjob_datetime between '$dte_beg 00:00:00' and '$dte_end 23:59:59'";
}elseif($type=="11") {
$cmd = "  tbl_".$data_table_name."_logcall.status_call = 'close' ";
$cmd.= " and  tbl_".$data_table_name."_logcall.call_openjob_datetime between '$dte_beg 00:00:00' and '$dte_end 23:59:59'";
}elseif($type=="12") {
$cmd = "  tbl_".$data_table_name."_logcall.status_call = 'cancel' ";
$cmd.= "and  tbl_".$data_table_name."_logcall.call_openjob_datetime between '$dte_beg 00:00:00' and '$dte_end 23:59:59'";
}elseif($type=="13") {
$cmd = "  tbl_".$data_table_name."_logcall.status_call = 'cancel not paid' ";
$cmd.= " and  tbl_".$data_table_name."_logcall.call_openjob_datetime between '$dte_beg 00:00:00' and '$dte_end 23:59:59'";
}elseif($type=="14") {
$cmd = "  tbl_".$data_table_name."_category_job_type.fixed_description like  '%$schTxt%'";
$cmd.= " and  tbl_".$data_table_name."_logcall.call_openjob_datetime between '$dte_beg 00:00:00' and '$dte_end 23:59:59'";
}elseif($type=="15") {
$cmd = "  u2.name like  '%$schTxt%'";
$cmd.= " and  tbl_".$data_table_name."_logcall.call_openjob_datetime between '$dte_beg 00:00:00' and '$dte_end 23:59:59'";
}
else {
$cmd = " tbl_".$data_table_name."_logcall.call_openjob_datetime between '$dte_beg 00:00:00' and '$dte_end 23:59:59' or tbl_".$data_table_name."_logcall.status_call = 'feedback' ";
}

$sql="SELECT
    tbl_".$data_table_name."_logcall.id,
    tbl_".$data_table_name."_logcall.job_no,
    tbl_".$data_table_name."_logcall.ref_job_no,
    tbl_".$data_table_name."_logcall.msr_no,
    tbl_".$data_table_name."_logcall.customer_id,
    tbl_".$data_table_name."_logcall.contact_job,
    tbl_".$data_table_name."_logcall.contact_tel,
    tbl_".$data_table_name."_logcall.problem_job,
    tbl_".$data_table_name."_logcall.problem_job_detail,
    tbl_".$data_table_name."_logcall.cat,
    tbl_".$data_table_name."_logcall.cat_time,
    tbl_".$data_table_name."_logcall.reciept_job_call,
    tbl_".$data_table_name."_logcall.reciept_job_engineer,
    tbl_".$data_table_name."_logcall.problem_solving,
    tbl_".$data_table_name."_logcall.problem_soving_by,
    tbl_".$data_table_name."_logcall.call_openjob_datetime,
    tbl_".$data_table_name."_logcall.status_sla,
    tbl_".$data_table_name."_logcall.status_call,
    tbl_".$data_table_name."_logcall.problem_job_type,
    tbl_".$data_table_name."_site.customer_id as ".$data_table_name."_id,
    tbl_".$data_table_name."_site.customer_name as ".$data_table_name."_name,
    u1.name AS namecall,
    u1.sname AS snamecall,
    u2.name AS nameengi,
    u2.sname AS snameengi,
    u2.tel AS telengi,
    tbl_".$data_table_name."_category_job_type.fixed_description
    FROM tbl_".$data_table_name."_logcall
    left outer Join tbl_".$data_table_name."_site ON tbl_".$data_table_name."_logcall.customer_id = tbl_".$data_table_name."_site.id
    left outer Join tbl_user AS u1 ON tbl_".$data_table_name."_logcall.reciept_job_call = u1.user_id
    left outer Join tbl_user AS u2 ON tbl_".$data_table_name."_logcall.reciept_job_engineer = u2.user_id
    left outer Join tbl_".$data_table_name."_category_job_type ON tbl_".$data_table_name."_logcall.problem_job = tbl_".$data_table_name."_category_job_type.category_id
    Where $cmd

    order by   tbl_".$data_table_name."_logcall.call_openjob_datetime DESC
    ";

echo $sql;

?>
<link href="image/bss_icon.ico"   rel="shortcut icon" />
<link href="style/calendar.css" rel="stylesheet" type="text/css">
<link href="style/mytable.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="script/calendar_date_picker.js"></script>
<link href="style/stylecss.css" rel="stylesheet" type="text/css">
<link href="style/filtergrid.css" rel="stylesheet" type="text/css">
<meta http-equiv="refresh" content="300;"/>
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

            <form  method="post"   name="form1" id="form1"  action="#" target="mainPage" onSubmit="return false">


                   <table width="100%" border="0" cellpadding="0" cellspacing="0" class="mytable">
                    <tr>
                      <td>
                        <?
                          $sql_per_month="SELECT count(a.id) cnt_job from tbl_major_logcall a
                                                    where month(a.call_openjob_datetime) = month(NOW())
                                                    and year(a.call_openjob_datetime) = year(NOW())
                                                    and a.job_no not like '%BSS%'
                                                    and a.status_call not in ('cancel','cancel not paid') ";
                          $res_per_month = mysqli_query($conn,$sql_per_month);
                          $row_per_month = mysqli_fetch_array($res_per_month);
                          if($row_per_month["cnt_job"] >= 50){
                            $color_cnt="red";
                          }
                          else if($row_per_month["cnt_job"] >= 40){
                            $color_cnt="orange";
                          }
                          else{   $color_cnt="green"; }
                        ?>
                        Count Job Per Month : <b><font color="<?=$color_cnt?>"><?=$row_per_month["cnt_job"];?></font></b>
                      </td>

                        <td valign="middle" align="center">
                             <b>&nbsp;<?=iconv('UTF-8','TIS-620',"Search");?>  :</b>
                            <select name="schBy" id="schBy" style="width:80pt;">
                                <option value="0" <?if($type == "0") echo "selected";?>>---Select---</option>
                                <option value="1" <?if($type == "1") echo "selected";?>><?=iconv('UTF-8','TIS-620',"Open Date");?></option>
                                <option value="2" <?if($type == "2") echo "selected";?>><?=iconv('UTF-8','TIS-620',"Close Date");?></option>
                                <option value="5" <?if($type == "5") echo "selected";?>><?=iconv('UTF-8','TIS-620',"Open Date Status Close");?></option>
                                <option value="9" <?if($type == "9") echo "selected";?>><?=iconv('UTF-8','TIS-620',"Branch ID");?></option>
                                <option value="10" <?if($type == "10") echo "selected";?>><?=iconv('UTF-8','TIS-620',"Feedback");?></option>
                                <option value="11" <?if($type == "11") echo "selected";?>><?=iconv('UTF-8','TIS-620',"Close");?></option>
                                <option value="12" <?if($type == "12") echo "selected";?>><?=iconv('UTF-8','TIS-620',"Cancel");?></option>
                                <option value="13" <?if($type == "13") echo "selected";?>><?=iconv('UTF-8','TIS-620',"Cencel not paid");?></option>
                                <option value="3" <?if($type == "3") echo "selected";?>><?=iconv('UTF-8','TIS-620',"Job No.");?></option>
                                <option value="14" <?if($type == "14") echo "selected";?>><?=iconv('UTF-8','TIS-620',"Category Job");?></option>
                                <option value="15" <?if($type == "15") echo "selected";?>><?=iconv('UTF-8','TIS-620',"Engineer");?></option>
                            </select>
                            <input type="text" style="width:90pt;" name="schTxt" id="schTxt" value="<?=$schTxt ?>">
                            <b>&nbsp;<?=iconv('UTF-8','TIS-620',"วันที่");?>  :</b>
                            <input style="width:60pt;" name="date_beg"  type="text" onclick="cdp1.showCalendar(this, 'date_beg');return false;" id="date_beg" value="<?=$dte_beg;?>" size="35" maxlength="10" />
                             <span class="fonttitle_board">&nbsp;-&nbsp;</span>
                            <input style="width:60pt;" name="date_end"  type="text" onclick="cdp1.showCalendar(this, 'date_end');return false;" id="date_end" value="<?=$dte_end;?>" size="35" maxlength="10" />
                            &nbsp;<input  type="button" name="sch" value="<?=iconv('UTF-8','TIS-620',"Search");?>"
                             onclick="Search_Click(schBy.value,schTxt.value,date_beg.value,date_end.value)" style="width:50pt;">
                            &nbsp;
                        </td>
                        <?

                            $link_openjob="logcall.retail.form.php?type=add";

                        ?>
                        <td width="18" valign="middle"><a href="<?=$link_openjob?>" target="_parent">
                        <img src="image/add.JPG" alt="Add" width="20" height="20" border="0" align="right"> </a></td>
                        <td width="27" valign="middle">&nbsp;<b><nobr> <?=iconv('UTF-8','TIS-620',"Add Log");?> </b></td>

                    </tr>
                </table>
                <table width="100%" align="center" class="mytable" id="table7"  cellpadding="1" cellspacing="1">
                    <tr>

                        <th class="th" width="3%"><nobr><?=iconv('UTF-8','TIS-620',"#");?></nobr></th>
                        <th class="th" width="5%" ><nobr><?=iconv('UTF-8','TIS-620',"Open Date");?></nobr></th>
                        <th class="th" width="10%"><nobr><?=iconv('UTF-8','TIS-620',"Category Job");?></nobr></th>
                        <th class="th" width="7%" ><nobr><?=iconv('UTF-8','TIS-620',"Job No.");?></nobr></th>
                        <th class="th" width="7%" ><nobr><?=iconv('UTF-8','TIS-620',"Ref Job No.");?></nobr></th>
                        <th class="th" width="5%" ><nobr><?=iconv('UTF-8','TIS-620',"Branch ID");?></nobr></th>
                        <th class="th" width="25%" ><nobr><?=iconv('UTF-8','TIS-620',"Promblem");?></nobr></th>
                        <th class="th" width="25%" ><nobr><?=iconv('UTF-8','TIS-620',"Problem Solving");?></nobr></th>
                        <th class="th" width="5%" ><nobr><?=iconv('UTF-8','TIS-620',"Reciept Name");?></nobr></th>
                        <th class="th" width="5%" ><nobr><?=iconv('UTF-8','TIS-620',"Engineer Name");?></nobr></th>
                        <th class="th" width="7%" ><nobr><?=iconv('UTF-8','TIS-620',"Status Job");?></nobr></th>
                    </tr >
                        <?  // echo $sql;
                         $res = mysqli_query($conn,$sql);
                         $i=0;
                         $wsla = 0;
                         $fsla = 0;
                          while($row = mysqli_fetch_array($res)) {
                          $bg = "";
                            if($row["status_call"]=="cancel"){
                               $bg = "green";
                            }else if($row["status_call"]=="feedback"){
                                $bg = "blue";
                            }

                            if($row["cat"]=="Special"){
                              $bg = "green";
                            }


                                 if($row["status_call"]!="cancel" || $row["status_call"]!="close"){
                                        alertSLA($row["job_no"],$row["nameengi"]." ".$row["snameengi"],$row["telengi"],$data_table_name);
                                }


                            if($row["status_sla"]=="WSLA"){
                                if($row["status_call"]=="cancel"){
                                    $bg = "pink";
                                    $wsla++;
                                }else{
                                    $bg = "black";
                                }
                            }
                            if($row["status_sla"]=="FSLA"){
                                 $bg = "red";
                                 $fsla++;
                            }

                             if($row["reciept_job_engineer"]==""){
                                 $bg = "lime";
                            }


                              ?>

                          <tr onclick="click2edit(<?echo $row["id"]?>,'edit');" onmouseover="this.style.backgroundColor='violet';" onmouseout="this.style.backgroundColor='white';" background-color="<?=$bg?>" >
                          <td style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc; border-color:#003366;" align="center">
                          <?
                         $irows++;
                         echo $irows;  //iconv('UTF-8','TIS-620',
                          ?>
                          </td><?//=dateThai($row["open_call_dte"]);?>
                          <td  style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;" align="center">
                              <font color ="<?=$bg?>"><?=ConvDteTme($row["call_openjob_datetime"]);?></font><nobr></td>
                          <td style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;"  align="center">
                              <font color ="<?=$bg?>"><?=$row["fixed_description"];?></font></td>
                          <td style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;"  align="center">
                              <font color ="<?=$bg?>"><?=$row["job_no"];?></font></td>
                          <td style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;"  align="center">
                              <font color ="<?=$bg?>"><?=$row["ref_job_no"];?></font></td>
                          <td  style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;" align="center">
                              <font color ="<?=$bg?>" title="<?=$row["".$data_table_name."_name"];?>"><?=$row["".$data_table_name."_id"];?></font></td>

                          <td  style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;">
                              <font color ="<?=$bg?>"><?=$row["problem_job_detail"];?></font></td>
                          <td  style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;">
                              <font color ="<?=$bg?>"><?=$row["problem_solving"];?></font></td>
                          <td  style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;" align="center">
                              <font color ="<?=$bg?>"><?=$row["namecall"];?></font></td>
                          <td  style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;" align="center">
                              <font color ="<?=$bg?>"><?=$row["nameengi"];?></font></td>
                          <td  style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;" align="center">
                            <? if($row["status_sla"] != "") { $str_status_sla=$row["status_sla"]; } else { $str_status_sla = "N\A"; } ?>
                              <font color ="<?=$bg?>"><nobr><?=$row["status_call"]." (". $str_status_sla .")";?></font></td>
                          </tr>
                       <?
                          $i++;
                          }
                        ?>
                          <tr>
                            <td colspan="10" style="padding:0px; border-bottom:1px solid #ccc; border-right:0px solid #ccc;"><?=iconv('UTF-8','TIS-620',"Count $i");?> , WSL = <?=$wsla;?>  , FSLA = <?=$fsla;?> </td>
                          </tr>
                </table>  </form>



<?


function alertSLA($jobno,$engineer,$tel,$data_table_name){
	global $conn;
   	//echo $jobno;
        $datenow =  getDteTme();
        $sql_diff_time = "SELECT TIMEDIFF(deadline_solving,NOW()) as xx  from tbl_".$data_table_name."_logcall where job_no = '$jobno' ";
        //echo $sql_diff_time;
        $rc_diff_time = mysqli_query($conn,$sql_diff_time);
        $c_diff_time = mysqli_fetch_array($rc_diff_time);
        $str = explode(":",$c_diff_time["xx"]);
        $val = 1;
        if($str[0]==0 && ($str [1]<30 && $str [1] >20)){
           $str = "Job No. $jobno SLA remaining 30 minutes, please contact technical name ";
           echo "<script>alert('".iconv('UTF-8','TIS-620',$str).$engineer.iconv('UTF-8','TIS-620'," Tel. $tel")."');</script>";
        }else if($str[0]==0 && ($str [1]<20 && $str [1] >10)){
           $str = "Job No. SLA remaining 20 minutes, please contact technical name $jobno SLA remaining 20 minutes, please contact technical name";
           echo "<script>alert('".iconv('UTF-8','TIS-620',$str).$engineer.iconv('UTF-8','TIS-620',"  Tel. $tel")."');</script>";
        }else if($str[0]==0 && ($str [1]<10 && $str [1] >5)){
           $str = "Job No. SLA remaining 10 minutes, please contact technical name $jobno SLA remaining 10 minutes, please contact technical name ";
           echo "<script>alert('".iconv('UTF-8','TIS-620',$str).$engineer.iconv('UTF-8','TIS-620',"  Tel. $tel")."');</script>";
        }else if($str[0]==0 && ($str [1]<5 && $str [1] >0)){
           $str = "Job No.  $jobno SLA remaining 5 minutes, please contact technical name ";
           echo "<script>alert('".iconv('UTF-8','TIS-620',$str).$engineer.iconv('UTF-8','TIS-620',"  Tel. $tel")."');</script>";
        }
}
?>


<?

  $link_edit="logcall.retail.form.php";

?>

<script type="text/javascript">
    var props = {    formatDate :        '%m-%d-%y'    };
    props.formatDate = '%y-%m-%d';
    var cdp1 = new CalendarDatePicker(props);

    function Search_Click(type,txt,dte_beg,dte_end){
      document.location.href ="logcall.retail.index.php"+"?type="+type+"&schTxt="+txt+"&dte_beg="+dte_beg+"&dte_end="+dte_end;
    }

    function click2edit(id,typer){
     var dte_b = document.form1.date_beg.value;
     var dte_e = document.form1.date_end.value;
     document.location.href ="<?=$link_edit?>"+"?id="+id+"&type="+typer+"&dte_beg="+dte_b+"&dte_end="+dte_e;
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
