<?php

session_start();
require_once("function.php");
if(!checkUser()){    echo Message(35,"red",$titel1,$msg1,"<a href='index.php?link=logcall.index'> $login </a>");
exit;
}
/*
echo "action : ".$_REQUEST["action"]." / Jobid : ".$_REQUEST["jobid"]." / Logtype : ".$_REQUEST["logtype"]." / Engineer : ".$_REQUEST["engineerid"];
echo "<br>";
*/
$job_no=$_REQUEST["jobid"];
$engineerid=$_REQUEST["engineerid"];

switch ($_REQUEST["logtype"]) {
  case 'PTT' :
    $table = "tbl_log_call_center";
    $coment_cl = "a.commente";
    break;
  case 'BSS' :
    $table = "itbl_logcall_retail";
    $coment_cl = "a.comment_job";
    break;

  case 'MAJOR' :
    $table = "tbl_major_logcall";
    $coment_cl = "a.comment_job";
    break;
}

switch ($_REQUEST["action"]) {
  case 'send' :
    $sql_send="UPDATE $table a SET a.show_on_app_status='y' where a.job_no='$job_no' ";
    mysqli_query($conn,$sql_send);
    //echo $sql_send;
    break;

  case 'switch' :

    $sql_old="select a1.id , a1.job_no ,a1.reciept_job_user_id
                from
                (
                select
                a.id , a.job_no ,a.reciept_job_user_id
                from tbl_log_call_center a
                where a.status_call='feedback'
                and a.type_service='BSS'
                and a.show_on_app_status='y'
                union all
                select b.id , b.job_no , b.reciept_job_engineer as reciept_job_user_id
                from itbl_logcall_retail b
                where b.status_call='feedback'
                and b.show_on_app_status='y'
                union all
                select b.id , b.job_no , b.reciept_job_engineer as reciept_job_user_id
                from tbl_major_logcall b
                where b.status_call='feedback'
                and b.show_on_app_status='y'
                ) a1
                where
                a1.reciept_job_user_id = '$engineerid'  ";
    $que_old = mysqli_query($conn,$sql_old);
    $old = mysqli_fetch_array($que_old);
    $Comment= "Switch GPS From JobNo ".$old["job_no"];
    $jobid_old=$old["id"];
    //echo $Comment;

    $sql_switch_clear1="UPDATE tbl_log_call_center a SET a.show_on_app_status='n' where a.reciept_job_user_id='$engineerid' ";
    mysqli_query($conn,$sql_switch_clear1);

    $sql_switch_clear2="UPDATE itbl_logcall_retail a SET a.show_on_app_status='n' where a.reciept_job_engineer='$engineerid' ";
    mysqli_query($conn,$sql_switch_clear2);

    $sql_switch_clear3="UPDATE tbl_major_logcall a SET a.show_on_app_status='n' where a.reciept_job_engineer='$engineerid' ";
    mysqli_query($conn,$sql_switch_clear3);



    $sql_switch_new="UPDATE $table a SET a.show_on_app_status='y' , $coment_cl='".$Comment."' where a.job_no='$job_no' ";
    mysqli_query($conn,$sql_switch_new);

    $sql_switch_location="UPDATE tbl_job_location a SET a.job_no='$job_no' where a.job_no='$jobid_old' ";
    mysqli_query($conn,$sql_switch_location);

    //echo $sql_switch_clear1."<br>".$sql_switch_clear2."<br>".$sql_switch_old."<br>".$sql_switch_new."<br>".$sql_switch_location;


    break;

  case 'reject' :

    $sql_switch_clear1="UPDATE tbl_log_call_center a SET a.show_on_app_status='n' where a.job_no='$job_no' and a.reciept_job_user_id='$engineerid' ";
    mysqli_query($conn,$sql_switch_clear1);

    $sql_switch_clear2="UPDATE itbl_logcall_retail a SET a.show_on_app_status='n' where a.job_no='$job_no' and a.reciept_job_engineer='$engineerid' ";
    mysqli_query($conn,$sql_switch_clear2);

    $sql_switch_clear3="UPDATE tbl_major_logcall a SET a.show_on_app_status='n' where a.job_no='$job_no' and a.reciept_job_engineer='$engineerid' ";
    mysqli_query($conn,$sql_switch_clear3);

    //echo $sql_switch_clear1."<br>".$sql_switch_clear2;
    break;


  case 'clear' :

      $sql_switch_clear1="UPDATE tbl_log_call_center a SET a.show_on_app_status='n' , a.status_close_job='c' where a.job_no='$job_no'";
      mysqli_query($conn,$sql_switch_clear1);

      $sql_switch_clear2="UPDATE itbl_logcall_retail a SET a.show_on_app_status='n' , a.status_close_job='c' where a.job_no='$job_no'";
      mysqli_query($conn,$sql_switch_clear2);

      $sql_switch_clear3="UPDATE tbl_major_logcall a SET a.show_on_app_status='n' , a.status_close_job='c' where a.job_no='$job_no'";
      mysqli_query($conn,$sql_switch_clear3);

      //echo $sql_switch_clear1."<br>".$sql_switch_clear2;
      break;
}

header('Location: ' . $_SERVER['HTTP_REFERER']);

?>
