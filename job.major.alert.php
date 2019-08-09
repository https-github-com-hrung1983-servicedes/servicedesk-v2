<?
header("Content-Type: text/html; charset=tis-620");
require_once("function.php");
$data_table_name = "major";
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
    Where tbl_".$data_table_name."_logcall.status_call = 'feedback'
    order by   tbl_".$data_table_name."_logcall.deadline_solving DESC";

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

                <table width="100%" align="center" class="mytable" id="table7"  cellpadding="1" cellspacing="1">
                    <tr>
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

                            if($row["cat"]=="Special"){
                              $bg = "green";
                            }


                                 if($row["status_call"]!="cancel" || $row["status_call"]!="close"){
                                      //  alertSLA($row["job_no"],$row["nameengi"]." ".$row["snameengi"],$row["telengi"],$data_table_name);
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

                          <tr  onmouseover="this.style.backgroundColor='violet';" onmouseout="this.style.backgroundColor='white';">
                          
                          
                          <td  style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;" align="center">
                              <font color ="<?=$bg?>"><?=$row["call_openjob_datetime"];?></font><nobr></td>
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
        $datenow =  getDteTme();
        $sql_diff_time = "SELECT TIMEDIFF(deadline_solving,NOW()) as xx  from tbl_".$data_table_name."_logcall where job_no = '$jobno' ";
        $rc_diff_time = mysql_query($sql_diff_time);
        $c_diff_time = mysql_fetch_array($rc_diff_time);
        $str = split(":",$c_diff_time["xx"]);
       $val = 1;
			if($str[0]==0 && ($str [1]<60 && $str [1] >50)){
                 echo '<EMBED SRC="'.$myAudioFile.'" HIDDEN="TRUE" AUTOSTART="TRUE"></EMBED>';
			     // echo "<script>alert('Aleart $jobno Wrong SLA 60 min  Contact $engineer  Tel. $tel');</script>";
			}else if($str[0]==0 && ($str [1]<50 && $str [1] >40)){
                 echo '<EMBED SRC="'.$myAudioFile.'" HIDDEN="TRUE" AUTOSTART="TRUE"></EMBED>';
			      //echo "<script>alert('Aleart $jobno Wrong SLA 50 min  Contact $engineer  Tel. $tel');</script>";
			}else if($str[0]==0 && ($str [1]<40 && $str [1] >30)){
                 echo '<EMBED SRC="'.$myAudioFile.'" HIDDEN="TRUE" AUTOSTART="TRUE"></EMBED>';
			      //echo "<script>alert('Aleart $jobno Wrong SLA 40 min  Contact $engineer  Tel. $tel');</script>";
			}else if($str[0]==0 && ($str [1]<30 && $str [1] >20)){
                 echo '<EMBED SRC="'.$myAudioFile.'" HIDDEN="TRUE" AUTOSTART="TRUE"></EMBED>';
			      //echo "<script>alert('Aleart $jobno Wrong SLA 30 min  Contact $engineer  Tel. $tel');</script>";
			}else if($str[0]==0 && ($str [1]<20 && $str [1] >10)){
                 echo '<EMBED SRC="'.$myAudioFile.'" HIDDEN="TRUE" AUTOSTART="TRUE"></EMBED>';
			      //echo "<script>alert('Aleart $jobno Wrong SLA 20 min  Contact $engineer  Tel. $tel');</script>";
			}else if($str[0]==0 && ($str [1]<10 && $str [1] >5)){
                 echo '<EMBED SRC="'.$myAudioFile.'" HIDDEN="TRUE" AUTOSTART="TRUE"></EMBED>';
			      //echo "<script>alert('Aleart $jobno Wrong SLA 5 min  Contact $engineer  Tel. $tel');</script>";
			}else if($str[0]==0 && ($str [1]<0)){
                 echo '<EMBED SRC="'.$myAudioFile.'" HIDDEN="TRUE" AUTOSTART="TRUE"></EMBED>';
			      //echo "<script>alert('Aleart $jobno Wrong SLA Contact $engineer  Tel. $tel');</script>";
			}
}
?>


<script type="text/javascript">
    var props = {    formatDate :        '%m-%d-%y'    };
    props.formatDate = '%y-%m-%d';
    var cdp1 = new CalendarDatePicker(props);

</script>
