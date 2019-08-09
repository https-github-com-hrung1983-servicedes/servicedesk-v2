<?
header("Content-Type: text/html; charset=tis-620");
session_start();
require_once("function.php");

  if(!checkUser()){    echo Message(35,"red",$titel1,$msg1,"<a href='index.php?link=logcall.index'> $login </a>");
  exit;
  }

include("header.php");
      $schBy =  $_REQUEST["schBy"];
      $schTxt =  $_REQUEST["schTxt"];
      $dte_beg =  $_REQUEST["dte_beg"];
      $dte_end =  $_REQUEST["dte_end"];
    if($dte_beg =="") $dte_beg = getDte();
    if($dte_end =="") $dte_end = getDte();
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
      tbl_log_call_center.onsite_datetime,
      tbl_log_call_center.fixed_time,
      tbl_log_call_center.closed_date,
      tbl_log_call_center.closed_time,
      g.from_owner,
      g.site_name
      From tbl_log_call_center
      left outer  Join tbl_category_type ON tbl_log_call_center.category_type = tbl_category_type.category_id
      Left outer Join tbl_user u1 ON tbl_log_call_center.reciept_job_bss = u1.user_id
      Left outer Join tbl_user u2 ON tbl_log_call_center.reciept_job_user_id = u2.user_id
      Left outer join tbl_site g on tbl_log_call_center.site_id = g.site_id
      Where
      tbl_log_call_center.type_service='BSS'";
     //echo $sql;
    

  if($schBy==1){
    $cmd .= " And tbl_log_call_center.job_no like '%".$schTxt."%'";
  } else if($schBy==2) {
    $cmd .= " And And tbl_log_call_center.bss_msr_no like '%".$schTxt."%'";
  } else if($schBy==3) {
    $cmd .= " And tbl_log_call_center.site_id like '%".$schTxt."%'";
  } else if($schBy==4) {
    $cmd .= " And tbl_log_call_center.open_call_dte between '" . $dte_beg . "' and '". $dte_end . "'  ";
  } else if($schBy==5) {
    $cmd .= " And tbl_log_call_center.closed_date between '" . $dte_beg . "' and '". $dte_end . "' ";
  } else if($schBy==6) {
    $cmd .= " And tbl_category_type.category_type like '%Per Call%'";
    $cmd .= " And tbl_log_call_center.open_call_dte between '" . $dte_beg . "' and '". $dte_end . "'";
  } else if($schBy==7) {
    $cmd .= " And tbl_category_type.category_type like '%���Ҩ���%'";
    $cmd .= " And tbl_log_call_center.open_call_dte between '" . $dte_beg . "' and '". $dte_end . "'";
  } else if($schBy==8) {
    $cmd .= " And tbl_log_call_center.type_service = 'BSS'";
  } else if($schBy==9) {
    $cmd .= " And tbl_log_call_center.type_service = 'SDC'";
  } else if($schBy==10) {
    $cmd .= " And tbl_log_call_center.status_sla = 'WSLA'";
    $cmd .= " And tbl_log_call_center.open_call_dte between '" . $dte_beg . "' and '". $dte_end . "' ";
  }else if($schBy==11) {
    $cmd .= " And tbl_log_call_center.status_sla = 'FSLA'";
    $cmd .= " And tbl_log_call_center.open_call_dte between '" . $dte_beg . "' and '". $dte_end . "' ";
  }else if($schBy==12) {
   // $cmd .= " And tbl_log_call_center.status_sla = 'FSLA'";
    $cmd .= " And tbl_log_call_center.resolv_type = 'h'";
    $cmd .= " And tbl_log_call_center.open_call_dte between '" . $dte_beg . "' and '". $dte_end . "' ";
 }else if($schBy==14){
     $cmd .= " And tbl_log_call_center.status_call = 'feedback'";
     $cmd .= " And tbl_log_call_center.open_call_dte between '" . $dte_beg . "' and '". $dte_end . "' ";
   }else if($schBy==15){
        $cmd .= " And tbl_log_call_center.status_call = 'close'";
        $cmd .= " And tbl_log_call_center.open_call_dte between '" . $dte_beg . "' and '". $dte_end . "' ";
   }else if($schBy==16){
           $cmd .= " And tbl_log_call_center.status_call = 'cancel'";
           $cmd .= " And tbl_log_call_center.open_call_dte between '" . $dte_beg . "' and '". $dte_end . "' ";
  }else if($schBy==17){
           $cmd .= " And tbl_log_call_center.status_call = 'cancel not paid'";
           $cmd .= " And tbl_log_call_center.open_call_dte between '" . $dte_beg . "' and '". $dte_end . "' ";
  }else if($schBy==18){
          $cmd .= "  and tbl_log_call_center.shift_job='F'";
  }else if($schBy==19){
    $cmd .= " And tbl_log_call_center.status_call = 'waithw'";
    $cmd .= " And tbl_log_call_center.open_call_dte between '" . $dte_beg . "' and '". $dte_end . "' ";
  } else {
    $cmd .= " And tbl_log_call_center.open_call_dte between '" . $dte_beg . "' and '". $dte_end . "'";
    $cmd .= " Or tbl_log_call_center.status_call = 'feedback' And tbl_log_call_center.type_service = 'BSS'";

  }
  //  if($schBy!=1 || $schBy!=2 || $schBy!=3){
  //   $cmd .= " And tbl_log_call_center.open_call_dte between '" . $dte_beg . "' and '". $dte_end . "'";
  //   }


  $cmd .=" Order by tbl_log_call_center.open_call_dte DESC,tbl_log_call_center.open_call_tme DESC";
    $sql .= $cmd;
//echo $sql;




$sql_job_type = "select category_id,fixed_description from tbl_category_type";

?>
<title>Bizserv Solution Co.,Ltd</title>
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
     .td{ border-color:#003366;};
    -->
</style>

<table width="100%" align="center" class="mytable" id="table" height="100%"   cellpadding="1" cellspacing="1" >
    <tr>
        <td valign="top">
            <form  method="post"   name="form1" id="form1"  action="#" target="mainPage" onSubmit="return false";>


                   <table width="100%" border="0" cellpadding="0" cellspacing="0" class="mytable">
                    <tr>
                        <td width="879" valign="middle" align="center"> <nobr>


                             <b>&nbsp;Search By :</b>
                            <select name="schBy" id="schBy" style="width:80pt;">
                                <option value="0" <?if($schBy == "0") echo "selected";?>>All</option>
                                <option value="1" <?if($schBy == "1") echo "selected";?>>Job No.</option>
                                <option value="2" <?if($schBy == "2") echo "selected";?>>MSR No.</option>
                                <option value="3" <?if($schBy == "3") echo "selected";?>>Site Id.</option>
                                <option value="4" <?if($schBy == "4") echo "selected";?>>Open Date.</option>
                                <option value="5" <?if($schBy == "5") echo "selected";?>>Close Date.</option>
                                <option value="6" <?if($schBy == "6") echo "selected";?>>Per Call</option>
                                <option value="7" <?if($schBy == "7") echo "selected";?>>Packege</option>
                                <option value="8" <?if($schBy == "8") echo "selected";?>>Team A</option>
                                <option value="9" <?if($schBy == "9") echo "selected";?>>Team B</option>
                                <option value="10" <?if($schBy == "10") echo "selected";?>>WSLA</option>
                                <option value="11" <?if($schBy == "11") echo "selected";?>>FSLA</option>
                                <option value="12" <?if($schBy == "12") echo "selected";?>>Resolving by Helpdesk</option>
                                <option value="13" <?if($schBy == "13") echo "selected";?>>Etc.</option>

                                <option value="14" <?if($schBy == "14") echo "selected";?>>Feedback</option>
                                <option value="15" <?if($schBy == "15") echo "selected";?>>Close</option>
                                <option value="16" <?if($schBy == "16") echo "selected";?>>Cancel</option>
                                <option value="17" <?if($schBy == "17") echo "selected";?>>Cancel not paid</option>
                                <option value="19" <?if($schBy == "19") echo "selected";?>><?=iconv( 'UTF-8', 'TIS-620', "รออุปกรณ์");?></option>
                                <option value="18" <?if($schBy == "18") echo "selected";?>>Overtime</option>
                            </select>
                            <input class="form-control"  type="text" style="width:90pt;" name="schTxt" id="schTxt" value="<?=$schTxt ?>">

                            <b>&nbsp;Date :</b>
                            <input class="form-control"  style="width:60pt;" name="date_beg"  type="text" onclick="cdp1.showCalendar(this, 'date_beg');return false;" id="date_beg" value="<?=$dte_beg;?>" size="35" maxlength="10" />
                             <span class="fonttitle_board">&nbsp;-&nbsp;</span>
                            <input class="form-control"  style="width:60pt;" name="date_end"  type="text" onclick="cdp1.showCalendar(this, 'date_end');return false;" id="date_end" value="<?=$dte_end;?>" size="35" maxlength="10" />


                            &nbsp;<input class="form-control"   type="button" name="sch" value="Search"  onclick="Search_Click(schBy.value,schTxt.value,date_beg.value,date_end.value)" style="width:50pt;">
                            &nbsp;
                            <?/*select>
                            <?
                            $rc_job_type = mysql_query($sql_job_type);
                            while($c_job_type = mysql_fetch_array($rc_job_type)){
                            ?>
                              <option value="<?=$c_job_type["category_id"]?>"><?=$c_job_type["fixed_description"]?></option>
                            <?}?>
                            </select>*/ ?>
                        </td>
                        <td width="18" valign="middle"><a href="logcall.form.php?type=add" target="_parent">
                        <img src="image/add.JPG" alt="Add" width="20" height="20" border="0" align="right"> </a></td>
                        <td width="27" valign="middle">&nbsp;<b>Create Job</b></td>
                        <!--td width="18" valign="middle"><!--input name="button" type="image"   src="image/delete.JPG" alt="Delete" align="left" width="20" height="20">
                        <img src="image/delete.JPG" alt="Delete" width="20" height="20" border="0" align="right">
                        </td>
                        <td width="27" valign="middle">&nbsp;<b>  ź</b></td-->
                    </tr>
                </table>
                <table width="100%" align="center" class="mytable" id="table7"  cellpadding="1" cellspacing="1">
                    <tr>
                        <th class="th" width="3%">Doc</th>
                        <th class="th" width="5%">Open DateTime</th>
                        <th class="th" width="5%">Onsite DateTime</th>
                        <th class="th" width="5%">Fix DateTime</th>
                        <th class="th" width="5%">Close Date</th>
                        <th class="th" width="10%">Categoty Job</th>
                        <th class="th" width="7%">Job No.</th>
                        <th class="th" width="5%">Site ID.</th>
                        <th class="th" width="5%">Site Name</th>
                        <th class="th" width="4%">From</th>
                        <th class="th" width="23%">Problem</th>
                        <th class="th" width="25%">Problem Solving</th>
                        <th class="th" width="6%">Reciept Name (BSS)</th>
                        <th class="th" width="6%">Engineer Name</th>
                        <th class="th" width="6%">Status</th>
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
							if($dte_beg ==	$dte_end){
									 if($row["status_call"]!="cancel"){
										   if( $row["status_call"]!="close"){
													alertSLA($row["job_no"],$row["engineer_name"],$row["engineer_tel"]);
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
                              ?>

                          <tr onclick="click2edit(<?echo $row["id"]?>,'edit');" onmouseover="this.style.backgroundColor='violet';" onmouseout="this.style.backgroundColor='white';" >
                          <td style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc; border-color:#003366;" align="center">
                              <?
							  if($row["doc"]=="true"){
							  	  echo  "<b><font color=\"#00FF00\">/</font></b>";//"<img src='image/tick.png' width='10' height='10' border='0' align='center'>";
								} else {
								  echo "<b><font color=\"#FF0000\">X</font></b>"; //"<img src='image/publish_x.png' width='10' height='10' border='0' align='center'>";
								}
								$status_sla = $row["status_sla"];
								if($status_sla==""){
									$status_sla = "N\A";
								}
							  ?>
						  </td>
                          <td style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;"  align="center">
                              <font color ="<?=$bg?>"><?=dateThai($row["open_call_dte"])." ".$row["open_call_tme"];?></font></td>
                          <td style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;"  align="center">
                              <font color ="<?=$bg?>"><?=$row["onsite_datetime"];?></font></td>
                          <td style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;"  align="center">
                              <font color ="<?=$bg?>"><?=$row["fixed_time"];?></font></td>   
                          <td style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;"  align="center">
                              <font color ="<?=$bg?>"><?=dateThai($row["closed_date"])." ".$row["closed_time"];?></font></td>
                          <td  style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;" align="center">
                              <font color ="<?=$bg?>"><?=$row["category_type"];?></font></td>
                          <td  style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;" align="center">
                              <font color ="<?=$bg?>"><?=$row["job_no"];?></font></td>
                              <td  style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;" align="center">
                                  <font color ="<?=$bg?>"><?=$row["site_id"];?></font></td>
                          <td  style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;" align="center">
                              <font color ="<?=$bg?>"><?=$row["site_name"];?></font></td>
                          <td  style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;" align="center">
                              <font color ="<?=$bg?>"><nobr><?=$row["from_owner"]?></font></td>
                          <td  style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;">
                              <font color ="<?=$bg?>"><?=$row["problem"];?></font></td>
                          <td  style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;">
                              <font color ="<?=$bg?>"><?=$row["problem_solving"];?></font></td>
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
	global $conn;
			 $datenow =  getDteTme();
			 $sql_diff_time = "SELECT TIMEDIFF(dateline_solving,'$datenow') as xx  from tbl_log_call_center where job_no = '$jobno' ";
			$rc_diff_time = mysqli_query($conn,$sql_diff_time);
			$c_diff_time = mysqli_fetch_array($rc_diff_time);
			$str = explode(":",$c_diff_time["xx"]);
		//	echo $str[0] ."--". $str [1]."<br>";
			$val = 1;
			if($str[0]==0 && ($str [1]<30 && $str [1] >20)){
			      echo "<script>alert('Aleart $jobno Wrong SLA 30 min  Contact $engineer  Tel. $tel');</script>";
			}else if($str[0]==0 && ($str [1]<20 && $str [1] >10)){
			      echo "<script>alert('Aleart $jobno Wrong SLA 20 min  Contact $engineer  Tel. $tel');</script>";
			}else if($str[0]==0 && ($str [1]<10 && $str [1] >5)){
			      echo "<script>alert('Aleart $jobno Wrong SLA 10 min  Contact $engineer  Tel. $tel');</script>";
			}else if($str[0]==0 && ($str [1]<5 && $str [1] >0)){
			      echo "<script>alert('Aleart $jobno Wrong SLA 5 min  Contact $engineer  Tel. $tel');</script>";
			}
}
?>


<script type="text/javascript">
    var props = {formatDate :'%m-%d-%y'};
    props.formatDate = '%y-%m-%d';
    var cdp1 = new CalendarDatePicker(props);

    function Search_Click(schBy,txt,dte_beg,dte_end){
   document.location.href ="logcall.index.php"+"?schBy="+schBy+"&schTxt="+txt+"&dte_beg="+dte_beg+"&dte_end="+dte_end;
      }

      function click2edit(id,typer){
         var dte_b = document.form1.date_beg.value;
         var dte_e = document.form1.date_end.value;
         document.location.href ="logcall.form.php"+"?id="+id+"&type="+typer+"&dte_beg="+dte_b+"&dte_end="+dte_e;
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
