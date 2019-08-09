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




 $str = array("1","2","3","4","6","7","8","9","10","11","12","13","14","36",
"37","31","32","33","34","25","30","27","45","16","60","61","62","63"
,"64","65","66","67","68","20",'22','18');                                                                     
                             
   $site_id = $_REQUEST["site_id"];
   //echo $site_id;

 if($site_id==""){
		echo Message(35,"red",$titel1,"Input SiteID","<a href='javascript:history.back(1)'> $back</a>");
	   exit;
}


$sql_ip = "update tbl_hardware_onhand_user set hardware_status='w',status_pm = 'y' where user_id = '".$site_id."' and cate_id='21'";
   mysqli_query($conn,$sql_ip);


for($i=0;$i<count($_POST["id-box"]);$i++)
{
//echo "Array $i = ".$_POST["id-box"][$i]," -- ";
//echo $_POST["search-box"][$i]."</br>";
$sn_new[$i] = $_POST["id-box"][$i];
$cate_id[$i] = $_POST["cate-id"][$i];
$search_box[$i] = $_POST["search-box"][$i];

 
 $query1 ="SELECT	tbl_hardware_onhand_user.id,
					tbl_hardware_onhand_user.hardware_no,
					tbl_hardware_onhand_user.user_id,
                    tbl_hardware_onhand_user.cate_id
					FROM
					tbl_hardware_onhand_user
					Where tbl_hardware_onhand_user.hardware_status in ('w','a','o')
					And tbl_hardware_onhand_user.status_pm = 'n'
                    And tbl_hardware_onhand_user.hardware_no = '".$search_box[$i]."'";
$c_query1 = mysqli_query($conn,$query1);			
$rs_query1 = mysqli_fetch_array($c_query1);

  if($search_box[$i] != $rs_query1["hardware_no"] && $search_box[$i] !=''){
	  echo Message(35,"red",$titel1,"S/N ".$search_box[$i]." not found.","<a href='javascript:history.back(1)'> $back</a>");
	  exit;
   }
   
   

   $str_sn = "sn_new".$str[$i];
   if($sn_new[$i]!=0){
   if(getDupplicateID($cate,$sn_new[$i])==0){  
   $sql_old = "update tbl_hardware_onhand_user set user_id = '', hardware_status='a',status_pm = 'n' where user_id='$site_id'   And cate_id = '".$cate_id[$i]."'"; //echo $sql_old;
   mysqli_query($conn,$sql_old); 


   $sql_new = "update tbl_hardware_onhand_user set user_id = '$site_id', hardware_status='w',status_pm = 'y' where id= '".$sn_new[$i]."'"; 
   mysqli_query($conn,$sql_new);
   //echo $search_box[$i]."<br>";
   //echo $sql_old."<br>".$sql_new."<br>";
   
   
	} else {
	   echo Message(35,"red",$titel1,"Dupplicate S/N","<a href='javascript:history.back(1)'> $back</a>");
	   exit;
	}
    
}

   
   
 
}

   

 
 
 
 
 






      header("location:insert.sn4pm.php?item=".$site_id);                     

  
   function getDupplicateID($cate,$sn){
	   global $conn;
     $sql = "select count(user_id) as cnt from tbl_hardware_onhand_user where cate_id = '$cate_id' and hardware_no in (select hardware_no from tbl_hardware_onhand_user where id = $sn)";
     $rc = mysqli_query($conn,$sql);
     $c = mysqli_fetch_array($rc);       
     return $c["cnt"];  // $sql;
  }
?>
















