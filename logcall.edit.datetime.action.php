<?
header("Content-Type: text/html; charset=TIS-620");
session_start();
require_once("function.php");
date_default_timezone_set('Asia/Bangkok');
if(!checkUser()){    echo Message(35,"red",$titel1,$msg1,"<a href='index.php?link=logcall.form'> $login </a>");
  exit;
  }

$User_id=$_SESSION["User_id"];

$jid=$_REQUEST["jid"];
$jobno=$_REQUEST["jobno"];

$opendate=trim($_REQUEST["update_open_date"]);
$opentime=trim($_REQUEST["update_open_h"]).":".trim($_REQUEST["update_open_m"]).":00";

$onsitedatetime=trim($_REQUEST["update_onsite_date"])." ".trim($_REQUEST["update_onsite_h"]).":".trim($_REQUEST["update_onsite_m"]).":01";

$fixdatetime=trim($_REQUEST["update_fix_date"])." ".trim($_REQUEST["update_fix_h"]).":".trim($_REQUEST["update_fix_m"]).":02";

$closedate=trim($_REQUEST["update_close_date"]);
$closetime=trim($_REQUEST["update_close_h"]).":".trim($_REQUEST["update_close_m"]).":03";





if($_REQUEST["update_open_date"] == NULL){ $sql_open="call_openjob_datetime = NULL , open_call_tme = NULL "; } else { $sql_open="open_call_dte = '$opendate' , open_call_tme = '$opentime' "; }

if($_REQUEST["update_onsite_date"] == NULL){ $sql_onsite=",onsite_datetime = NULL"; } else { $sql_onsite=",onsite_datetime = '$onsitedatetime'"; }

if($_REQUEST["update_fix_date"] == NULL){ $sql_fix=" ,fixed_time = NULL "; } else { $sql_fix=" ,fixed_time = '$fixdatetime' "; }

if($_REQUEST["update_close_date"] == NULL){ $sql_close=",closed_date = NULL , closed_date = NULL "; } else { $sql_close=",closed_date = '$closedate' , closed_time = '$closetime' "; }



$sql_update="UPDATE tbl_log_call_center
              SET
              $sql_open
              $sql_onsite
              $sql_fix
              $sql_close
              ,user_update = '$uid'
              WHERE id='$jid' ";
mysqli_query($conn,$sql_update);

$sql_log = "INSERT INTO tbl_log_call_transaction
            (job_type,job_no,updateuser,updatebypage)
            VALUES ('edit_date','$jobno','$User_id','PTT');";
mysqli_query($conn,$sql_log);

header("location:logcall.form.php?id=$jid&type=edit");

?>
