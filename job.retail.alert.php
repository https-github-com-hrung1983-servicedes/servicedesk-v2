<?
header("Content-Type: text/html; charset=tis-620");
require_once("function.php");

      $sql="SELECT
            itbl_logcall_retail.id,
            itbl_logcall_retail.job_no,
            itbl_logcall_retail.ref_job_no,
            itbl_logcall_retail.msr_no,
            itbl_logcall_retail.customer_id,
            itbl_logcall_retail.contact_job,
            itbl_logcall_retail.contact_tel,
            itbl_logcall_retail.problem_job,
            itbl_logcall_retail.problem_job_detail,
            itbl_logcall_retail.cat,
            itbl_logcall_retail.cat_time,
            itbl_logcall_retail.reciept_job_call,
            itbl_logcall_retail.reciept_job_engineer,
            itbl_logcall_retail.problem_solving,
            itbl_logcall_retail.problem_soving_by,
            day(itbl_logcall_retail.call_openjob_datetime) op_d,
            month(itbl_logcall_retail.call_openjob_datetime) op_m,
            year(itbl_logcall_retail.call_openjob_datetime) op_y,
            itbl_logcall_retail.call_openjob_datetime,
            itbl_logcall_retail.appoint_datetime,
            itbl_logcall_retail.deadline_solving,
            itbl_logcall_retail.onsite_datetime,
            itbl_logcall_retail.fixed_datetime,
            itbl_logcall_retail.close_datetime,
            itbl_logcall_retail.status_sla,
            itbl_logcall_retail.status_call,
            itbl_logcall_retail.comment_job,
            itbl_logcall_retail.doc,
            itbl_customer4.customer_id as customer_id4,
            itbl_customer4.customer_name,
            itbl_category_job.category_job,
            u1.name as namecall,
            u1.sname as snamecall,
            u2.name as nameengineer,
            u2.sname as snameegineer,
            u2.tel
        FROM
            itbl_logcall_retail
        Left Join itbl_customer4 ON itbl_logcall_retail.customer_id = itbl_customer4.id
        left outer join itbl_customer3 b on itbl_customer4.customer_level3=b.id
        left outer join itbl_customer2 c on b.customer_level2=c.id
        left outer join itbl_customer1 d on c.customer_level1=d.id
        Left Join itbl_category_job ON itbl_logcall_retail.problem_job = itbl_category_job.id
        Left Join tbl_user u1 ON itbl_logcall_retail.reciept_job_call = u1.user_id
        Left Join tbl_user u2 ON itbl_logcall_retail.reciept_job_engineer = u2.user_id
        where c.customer_level1 in ('1','2','3')
        and itbl_logcall_retail.status_call = 'feedback'
        order by deadline_solving ";






$sql_job_type = "select category_id,fixed_description from tbl_category_type";

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

                <table width="100%" align="center" class="mytable11" id="table7"  cellpadding="1" cellspacing="1">
                    <tr>
                        <th class="th" width="5%" ><nobr><?=iconv('UTF-8','TIS-620',"วันที่เปิดใบงาน");?></nobr></th>
                        <th class="th" width="10%"><nobr><?=iconv('UTF-8','TIS-620',"ประเภทใบงาน");?></nobr></th>
                        <th class="th" width="7%" ><nobr><?=iconv('UTF-8','TIS-620',"เลขที่ใบงาน");?></nobr></th>
                        <th class="th" width="5%" ><nobr><?=iconv('UTF-8','TIS-620',"รหัสสถานี");?></nobr></th>
                        <th class="th" width="25%" ><nobr><?=iconv('UTF-8','TIS-620',"ปัญหา");?></nobr></th>
                        <th class="th" width="5%" ><nobr><?=iconv('UTF-8','TIS-620',"ผู้รับใบงาน");?></nobr></th>
                        <th class="th" width="5%" ><nobr><?=iconv('UTF-8','TIS-620',"ช่างผู้รับใบงาน");?></nobr></th>
                        <th class="th" width="7%" ><nobr><?=iconv('UTF-8','TIS-620',"สถานะใบงาน");?></nobr></th>
                    </tr >
                        <?  // echo $sql;
                         $res = mysql_query($sql);
                         $i=0;
                         $wsla = 0;
                         $fsla = 0;
                          while($row = mysql_fetch_array($res)) {
                          $bg = "";
                            if($row["status_call"]=="cancel"){
                               $bg = "green";
                            }else if($row["status_call"]=="feedback"){
                                $bg = "blue";
                            }
                            if($dte_beg ==$dte_end){
                                 if($row["status_call"]!="cancel"){
                                   if( $row["status_call"]!="close"){
                                        alertSLA($row["job_no"],$row["nameengineer"]." ".$row["snameegineer"],$row["tel"]);
                                   }
                                }
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

                          <tr onclick="click2edit(<?echo $row["id"]?>,'edit');" onmouseover="this.style.backgroundColor='violet';" onmouseout="this.style.backgroundColor='white';" >
                          <?//=dateThai($row["open_call_dte"]);?>
                          <td  style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;" align="center">
                              <font color ="<?=$bg?>"><?=$row["op_d"];?>-<?=$row["op_m"];?>-<?=$row["op_y"];?></font></td>
                          <td style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;"  align="center">
                              <font color ="<?=$bg?>"><?=$row["category_job"];?></font></td>
                          <td style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;"  align="center">
                              <font color ="<?=$bg?>"><?=$row["job_no"];?></font></td>


                          <td  style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;" align="center">
                              <font color ="<?=$bg?>"><?=$row["customer_id4"];?></font></td>

                          <td  style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;">
                              <font color ="<?=$bg?>"><?=$row["problem_job_detail"];?></font></td>
                          <td  style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;" align="center">
                              <font color ="<?=$bg?>"><?=$row["namecall"];?></font></td>
                          <td  style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;" align="center">
                              <font color ="<?=$bg?>"><?=$row["nameengineer"];?></font></td>
                          <td  style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;" align="center">
                              <font color ="<?=$bg?>"><nobr><?=$row["status_call"]." (".$status_sla.")";?></font></td>
                          </tr>

                       <?
                          $i++;
                          }?>
                          <tr>
                            <td colspan="10" style="padding:0px; border-bottom:1px solid #ccc; border-right:0px solid #ccc;"><?=iconv('UTF-8','TIS-620',"ใบงานทั้งหมด $i");?> , WSL = <?=$wsla;?>  , FSLA = <?=$fsla;?> </td>
                          </tr>
                </table>  </form></td></tr></table>


<?
function alertSLA($jobno,$engineer,$tel){
        $datenow =  getDteTme();
        $sql_diff_time = "SELECT TIMEDIFF(deadline_solving,'$datenow') as xx  from itbl_logcall_retail where job_no = '$jobno' ";
        $rc_diff_time = mysql_query($sql_diff_time);
        $c_diff_time = mysql_fetch_array($rc_diff_time);
        $str = split(":",$c_diff_time["xx"]);
        $val = 1;
        if($str[0]==0 && ($str [1]<30 && $str [1] >20)){
           $str = "ใบงานเลขที่ $jobno ใกล้ตก SLA เหลือเวลาอีก 30 นาที กรุณาติดต่อช่างชื่อ ";
           echo "<script>alert('".iconv('UTF-8','TIS-620',$str).$engineer.iconv('UTF-8','TIS-620'," เบอร์โทรศัพท์ $tel")."');</script>";
        }else if($str[0]==0 && ($str [1]<20 && $str [1] >10)){
           $str = "ใบงานเลขที่ $jobno ใกล้ตก SLA เหลือเวลาอีก 20 นาที กรุณาติดต่อช่างชื่อ ";
           echo "<script>alert('".iconv('UTF-8','TIS-620',$str).$engineer.iconv('UTF-8','TIS-620'," เบอร์โทรศัพท์ $tel")."');</script>";
        }else if($str[0]==0 && ($str [1]<10 && $str [1] >5)){
           $str = "ใบงานเลขที่ $jobno ใกล้ตก SLA เหลือเวลาอีก 10 นาที กรุณาติดต่อช่างชื่อ ";
           echo "<script>alert('".iconv('UTF-8','TIS-620',$str).$engineer.iconv('UTF-8','TIS-620'," เบอร์โทรศัพท์ $tel")."');</script>";
        }else if($str[0]==0 && ($str [1]<5 && $str [1] >0)){
           $str = "ใบงานเลขที่ $jobno ใกล้ตก SLA เหลือเวลาอีก 5 นาที กรุณาติดต่อช่างชื่อ ";
           echo "<script>alert('".iconv('UTF-8','TIS-620',$str).$engineer.iconv('UTF-8','TIS-620'," เบอร์โทรศัพท์ $tel")."');</script>";
        }
}
?>


<script type="text/javascript">
    var props = {    formatDate :        '%m-%d-%y'    };
    props.formatDate = '%y-%m-%d';
    var cdp1 = new CalendarDatePicker(props);

</script>

