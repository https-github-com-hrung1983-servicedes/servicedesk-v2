<?
header("Content-Type: text/html; charset=tis-620");

session_start();
require_once("function.php"); 
if(!checkUser()){    echo Message(35,"red",$titel1,$msg1,"<a href='index.php'> $login </a>");
   exit;
}                                                                                       
   $jobno = $_REQUEST["jobno"];        
   $serialno = $_REQUEST["serialno"];  
   $site_type = $_REQUEST["site_type"];  
   $site_id = $_REQUEST["site_id"]; 
    $sql = "Delete from tbl_insident_hw where job_no = '$jobno' and site_id = '$site_id' and serial_no = '$serialno'";//echo $sql;
	mysqli_query($conn,$sql);	

    header("location:delete.serail.php?type_station=".$site_type."&site=".$site_id);
?>
