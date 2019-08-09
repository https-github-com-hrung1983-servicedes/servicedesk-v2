<?
header("Content-Type: text/html; charset=tis-620");
//echo "Under constuction.";exit;
session_start();
require_once("function.php"); 
if(!checkUser()){    echo Message(35,"red",$titel1,$msg1,"<a href='index.php'> $login </a>");
   exit;
}    
if($_SESSION["Ustate"] == "user") {
		 echo Message(35,"red",$titel1,$msg2,"<a href='javascript:history.back(1)'> $back</a>");
	        exit;
	}                                                                             
   $id = $_REQUEST["id"];                          
   $site_id = $_REQUEST["site_id"];                                                                         
   $cate = $_REQUEST["cate"];                                                                 
   $indate = $_REQUEST["indate"];                                                                 
   $exdate = $_REQUEST["exdate"];
   $sn = $_REQUEST["sn"];   


if(getDupplicateID($cate,$sn)==0){
   $sql = "Insert into tbl_hardware_onhand_user (user_id,cate_id,hardware_no,installation_date,expired_date,owner_by) values ('$site_id','$cate','$sn','$indate','$exdate','BSS')";//echo $sql;exit;  
    mysqli_query($conn,$sql);   
	} else {
	echo Message(35,"red",$titel1,"Dupplicate S/N","<a href='javascript:history.back(1)'> $back</a>");
		exit;
}


                        
  header("location:add_serial_retail.php?id=".$site_id);
  
   function getDupplicateID($cate,$sn){
	   global $conn;
     $sql = "select count(user_id) as cnt from tbl_hardware_onhand_user where cate_id = '$cate_id' and hardware_no = '$sn'";
     $rc = mysqli_query($conn,$sql);
     $c = mysqli_fetch_array($rc);       
     return $c["cnt"];  // $sql;
  }
?>
