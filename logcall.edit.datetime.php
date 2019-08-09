<?
header("Content-Type: text/html; charset=TIS-620");
session_start();
require_once("function.php");
date_default_timezone_set('Asia/Bangkok');
if(!checkUser()){    echo Message(35,"red",$titel1,$msg1,"<a href='index.php?link=logcall.form'> $login </a>");
  exit;
  }

include("header.php");

$jid=$_REQUEST["jid"];

$sql = "SELECT a.*
        From tbl_log_call_center a
        Where a.id = '$jid' ";
// echo $sql;
$rs = mysqli_query($conn,$sql);
$c = mysqli_fetch_array($rs);

$opendate = date('Y-m-d',strtotime($c["open_call_dte"]));
$openh = date('H',strtotime($c["open_call_tme"]));
$openm = date('i',strtotime($c["open_call_tme"]));

$onsitedate = date('Y-m-d',strtotime($c["onsite_datetime"]));
$onsiteh = date('H',strtotime($c["onsite_datetime"]));
$onsitem = date('i',strtotime($c["onsite_datetime"]));

$fixdate = date('Y-m-d',strtotime($c["fixed_time"]));
$fixh = date('H',strtotime($c["fixed_time"]));
$fixm = date('i',strtotime($c["fixed_time"]));

$closedate = date('Y-m-d',strtotime($c["closed_date"]));
$closeh = date('H',strtotime($c["closed_time"]));
$closem = date('i',strtotime($c["closed_time"]));

?>

<meta http-equiv="Content-Type" content="text/html; charset=TIS-620" />
<link href="image/bss_icon.ico"   rel="shortcut icon" />
<link href="style/calendar.css" rel="stylesheet" type="text/css">
<link href="style/mytable.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="script/calendar_date_picker.js"></script>
<link href="style/stylecss.css" rel="stylesheet" type="text/css">
<link href="style/filtergrid.css" rel="stylesheet" type="text/css">


<form name="frm1" id="frm1" action="logcall.edit.datetime.action.php" method="POST">
<input type="hidden" name="jid" id="jid" value="<?=$jid?>">
<input type="hidden" name="jobno" id="jobno" value="<?=$c["job_no"]?>">
<center>
<br>

JobNo : <?=$c["job_no"]?><br>
<table>
<? if($c["open_call_dte"] != NULL) { ?>
<tr>
  <td height="25" align="left" class="fontBblue">Open DateTime</td>
  <td><input type="date" name="update_open_date" id="update_open_date" value="<?=$opendate?>"></td>
  <td>

      <select  name="update_open_h" id="update_open_h">
        <?for($i=0;$i<24;$i++){?>
            <option value = "<?=$i?>" <?if($openh==$i) echo "selected";?>><?=$i?></option>";
        <?}?>
      </select>

      <select name="update_open_m" id="update_open_m">
        <?for($i=0;$i<60;$i++){?>
            <option value = "<?=$i?>" <?if($openm==$i) echo "selected";?>><?=$i?></option>";
        <?}?>

  </td>

</tr>
<? } ?>
<? if($c["onsite_datetime"] != NULL) { ?>
<tr>
  <td height="25" align="left" class="fontBblue">Onsite DateTime</td>
  <td><input type="date" name="update_onsite_date" id="update_onsite_date" value="<?=$onsitedate?>"></td>
  <td>

    <select  name="update_onsite_h" id="update_onsite_h">
      <?for($i=0;$i<24;$i++){?>
          <option value = "<?=$i?>" <?if($onsiteh==$i) echo "selected";?>><?=$i?></option>";
      <?}?>
    </select>

    <select name="update_onsite_m" id="update_onsite_m">
      <?for($i=0;$i<60;$i++){?>
          <option value = "<?=$i?>" <?if($onsitem==$i) echo "selected";?>><?=$i?></option>";
      <?}?>

  </td>
</tr>
<? } ?>
<? if($c["fixed_time"] != NULL) { ?>
<tr>
  <td height="25" align="left" class="fontBblue">Fix DateTime</td>
  <td><input type="date" name="update_fix_date" id="update_fix_date" value="<?=$fixdate?>"></td>
  <td>

    <select  name="update_fix_h" id="update_fix_h">
      <?for($i=0;$i<24;$i++){?>
          <option value = "<?=$i?>" <?if($fixh==$i) echo "selected";?>><?=$i?></option>";
      <?}?>
    </select>

    <select name="update_fix_m" id="update_fix_m">
      <?for($i=0;$i<60;$i++){?>
          <option value = "<?=$i?>" <?if($fixm==$i) echo "selected";?>><?=$i?></option>";
      <?}?>

    </td>
</tr>
<? } ?>
<? if($c["closed_date"] != NULL) { ?>
<tr>
  <td height="25" align="left" class="fontBblue">Close DateTime</td>
  <td><input type="date" name="update_close_date" id="update_close_date" value="<?=$closedate?>"></td>
  <td>

    <select  name="update_close_h" id="update_close_h">
      <?for($i=0;$i<24;$i++){?>
          <option value = "<?=$i?>" <?if($closeh==$i) echo "selected";?>><?=$i?></option>";
      <?}?>
    </select>

    <select name="update_close_m" id="update_close_m">
      <?for($i=0;$i<60;$i++){?>
          <option value = "<?=$i?>" <?if($closem==$i) echo "selected";?>><?=$i?></option>";
      <?}?>

  </td>
</tr>
<? } ?>
<tr>
  <td colspan="3" align="center"><input type="submit" value="Submit"></td>
</tr>

</center>

</form>
