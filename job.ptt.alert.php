<?
header("Content-Type: text/html; charset=tis-620");
require_once("function.php");

//include("header.php");
  $sql="Select
      tbl_log_call_center.id,
      tbl_log_call_center.open_call_dte,
      tbl_log_call_center.open_call_tme,
      tbl_category_type.category_type,
      tbl_log_call_center.job_no,
      tbl_log_call_center.site_id,
      tbl_log_call_center.problem,
      tbl_log_call_center.problem_solving,
      u1.name as reciept_name,
      u1.sname as reciept_sname,
      tbl_log_call_center.type_service,
      u2.name as engineer_name,
      u2.sname as engineer_sname,
      u2.tel as engineer_tel,
      tbl_log_call_center.status_call,
      tbl_log_call_center.status_sla,
      tbl_log_call_center.doc,
      g.from_owner
      From tbl_log_call_center
      left outer  Join tbl_category_type ON tbl_log_call_center.category_type = tbl_category_type.category_id
      Left outer Join tbl_user u1 ON tbl_log_call_center.reciept_job_bss = u1.user_id
      Left outer Join tbl_user u2 ON tbl_log_call_center.reciept_job_user_id = u2.user_id
      Left outer join tbl_site g on tbl_log_call_center.site_id = g.site_id
      Where
      tbl_log_call_center.type_service='BSS'
      And tbl_log_call_center.status_call = 'feedback'
      Order by dateline_solving DESC";//,tbl_log_call_center.open_call_tme DESC
//echo $sql;
?>
<title>Bizserv Solution Co.,Ltd</title>
<link href="image/bss_icon.ico"   rel="shortcut icon" />
<link href="style/calendar.css" rel="stylesheet" type="text/css">
<link href="style/mytable.css" rel="stylesheet" type="text/css" />
<link href="style/stylecss.css" rel="stylesheet" type="text/css">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
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
     .td{ border-color:#003366;};
    -->
</style>

    <table width="100%" align="center" class="mytable" id="table7"  cellpadding="1" cellspacing="1">
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
							if($dte_beg ==	$dte_end){
									 if($row["status_call"]!="cancel"){
										   if( $row["status_call"]!="close"){
													alertSLA($row["job_no"],$row["engineer_name"],$row["engineer_tel"]);
										   }
									}
							}
                            $status_sla="";
								if($row["status_sla"]=="WSLA"){
                                     $status_sla="WSLA";
										$wsla++;
								}
								if($row["status_sla"]=="FSLA"){
											 $status_sla="FSLA";
											 $fsla++;
								}
                              ?>

                          <tr>
                         
                          <td style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;"  align="center">
                              <font color ="<?=$bg?>"><?=dateThai($row["open_call_dte"]);?></font></td>
                          <td  style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;" align="center">
                              <font color ="<?=$bg?>"><?=$row["category_type"];?></font></td>
                          <td  style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;" align="center">
                              <font color ="<?=$bg?>"><?=$row["job_no"];?></font></td>
                          <td  style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;" align="center">
                              <font color ="<?=$bg?>"><?=$row["site_id"];?></font></td>
                          <td  style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;">
                              <font color ="<?=$bg?>"><?=$row["problem"];?></font></td>
                          <td  style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;" align="center">
                              <font color ="<?=$bg?>"><?=$row["reciept_name"];?></font></td>
                          <td  style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;" align="center">
                              <font color ="<?=$bg?>"><?=$row["engineer_name"];?></font></td>
                          <td  style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;" align="center">
                              <font color ="<?=$bg?>"><nobr><?=$row["status_call"]." (".$status_sla.")";?></font></td>
                          </tr>
                       <?
                          $i++;
                          }?>
                          <tr>
                            <td colspan="10" style="padding:0px; border-bottom:1px solid #ccc; border-right:0px solid #ccc;"> Total <?=$i;?> Job  , WSL = <?=$wsla;?> Job , FSLA = <?=$fsla;?> Job</td>
                          </tr>
                </table>  </form></td></tr></table>

<?

function alertSLA($jobno,$engineer,$tel){
    $myAudioFile = "http://www.bizservsolution.com/servicedesk/sound/fsla.wav";
    echo '<EMBED SRC="'.$myAudioFile.'" HIDDEN="TRUE" AUTOSTART="TRUE"></EMBED>';
			 $datenow =  getDteTme();
			 $sql_diff_time = "SELECT TIMEDIFF(dateline_solving,'$datenow') as xx  from tbl_log_call_center where job_no = '$jobno' ";
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
    var props = {formatDate :'%m-%d-%y'};
    props.formatDate = '%y-%m-%d';
    var cdp1 = new CalendarDatePicker(props);

</script>
