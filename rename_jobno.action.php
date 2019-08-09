<?
require_once("function.php");
session_start();
header("Content-Type: text/html; charset=UTF8");

$job_id=$_REQUEST['job_id'];
$job_no=$_REQUEST['job_no'];
$job_rename=$_REQUEST['job_rename'];
            $row = checkJobNo("jobno",$job_rename);
              if($row == 1){
                 echo Message(35,"red","¢éÍ€ÇÒÁàµ×Í¹","¡ÃØ³ÒµÃÇšÊÍºËÁÒÂàÅ¢ $job_no ÇèÒÁÕÍÂÙèáÅéÇËÃ×ÍäÁè ","<a href='javascript:history.back(1)'> ¡ÅÑºä»µÃÇšÊÍº</a>"); 
                 exit;
              }             
       $sql_rejob ="UPDATE tbl_log_call_center 
                    SET job_no = '".$job_rename."'
                    WHERE job_no = '".$job_no."' and id= '".$job_id."' ";

	   $obj_rejob = mysqli_query($conn,$sql_rejob);
       header("location:rename_jobno.php?job_serch=$job_rename");
?>
