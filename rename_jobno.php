<?
require_once("function.php");
session_start();
header("Content-Type: text/html; charset=UTF8");
  
  if(!checkUser()){    echo Message(35,"red",$titel1,$msg1,"<a href='index.php?link=logcall.index'> $login </a>");
  exit;
  }                                                                                                      
       
include("header.php"); 

	if(!checkUser()){    echo Message(35,"red",$titel1,$msg1,"<a href='index.php'> $login </a>");
		   exit;
	}
	
	if($_SESSION["Ustate"] == "user" || $_SESSION["Ustate"] == "cm") {
		 echo Message(35,"red",$titel1,$msg2,"<a href='javascript:history.back(1)'> $back</a>");
	        exit;
	}
	
$job_serch=$_GET["job_serch"];
//echo "JobNo : ".$job_serch;
?>

<form action="<?php echo $_SERVER['SCRIPT_NAME'];?>"  method="GET"  name="form1" id="form1">
<center>
<div style="padding: 1px;">
<input type="text" style="width:300px;" name="job_serch" id="job_serch" value="">
<input type="submit" name="submit" class="submit" value="Search">
</div>
</form>
<? 	   if($job_serch != ''){
			  	  
?>
<form action="rename_jobno.action.php"  method="post"  name="form2" id="form2">
<?
	   $sql_job ="Select * From tbl_log_call_center a
			      where 
				   a.job_no!=''";
	   $sql_job .="and a.job_no='".$job_serch."' order by a.job_no";	  

	   $obj_job = mysqli_query($conn,$sql_job);
	   while($re_job = mysqli_fetch_array($obj_job)){
		?>
		<input type="hidden" style="width:200px;" name="job_id" id="job_id" value="<?=$re_job["id"]?>">
		<br>
	   <table style="padding: 20px; border: solid; width: 350px; font-size: 14px;">
	   <tr>
			  <td align="right">JobNo.</td>
			  <td><?=$re_job["job_no"]?>
					 <input type="hidden" style="width:200px;" name="job_no" id="job_no" value="<?=$re_job["job_no"]?>" readonly></td>
	   </tr>
	   <tr>
			  <td align="right">New JobNo.</td>
			  <td><input type="text" style="width:200px;" name="job_rename" id="job_rename" value=""></td>
	   </tr>
	   <tr>
			  <td colspan=2 align="center"><input type="submit" name="submit" class="submit" value="Rename"></td>
	   </tr>  
		</table>
	   <? } ?>
</form>
<? } ?>
</center>
