<?
header("Content-Type: text/html; charset=tis-620");

session_start();
require_once("function.php"); 
if(!checkUser()){    echo Message(35,"red",$titel1,$msg1,"<a href='index.php'> $login </a>");
   exit;
}                 
                                                                              
   $id = $_REQUEST["id"];        
   $other_seq = $_REQUEST["other_seq"];   // echo $other_seq;     exit;
   $table = "tbl_incentive_ot_settlement";  
   $typer = $_REQUEST["typer"];               
   //  echo $typer;           //exit;      
   if($typer == ""){                                 
	   $dte = $_REQUEST["dte"];
       $bill_description = addslashes($_REQUEST["bill_description"]);  
       $bill_no = $_REQUEST["bill_no"];
       $bill_total = $_REQUEST["bill_total"];                     
     //  $bill_total_all = $_REQUEST["bill_total_all"];  
     //  $total_funds = $_REQUEST["total_funds"];       
     //  $status_funds = $_REQUEST["status_funds"];  
     //  $incentive_total = $_REQUEST["incentive_total"];  
       
     //  $ttotal = $_REQUEST["ttotal"]; 
     //  $tot = $_REQUEST["tot"]; 
     //  $tal = $tot-$ttotal;                                                                     
           if($id != "" && $other_seq ==""){           
              $other_seq = AutoNumber($table." where other_no = $id","other_seq");                                                                                         
              $sql = "Insert into $table (other_no,other_seq,other_dte,bill_description,bill_no,bill_total)
                       values ('$id','$other_seq','$dte','$bill_description','$bill_no','$bill_total')";     
                      // echo $sql;exit;    
             mysqli_query($conn,$sql);                                            
           } else if($id != "" && $other_seq !=""){                                 
              $sql = "Update $table set other_dte='$dte' ,bill_description='$bill_description',bill_no='$bill_no',bill_total='$bill_total'
                       Where other_no = $id And other_seq = $other_seq"; 
             mysqli_query($conn,$sql);          
           }
   //    if($tal<0){
   //      $status_funds = "เบิกเพิ่ม";  
   //    }else{
   //       $status_funds = "เหลือ/คืน"; 
   //    }
   //    $sql_updatefunds = "update tbl_incentive_ot  set  status_funds = '$status_funds' , total_funds = '$tal'
  //     where id = $id";   //echo $sql_updatefunds;exit;     
   //   mysql_query($sql_updatefunds);    
   } else if($typer == "del"){
       $tal = $_REQUEST["ttotal"];   
   //    echo  $_REQUEST["bill_total_all"] ."<hr>";      
   //    echo  $_REQUEST["ttotal"] ."<hr>";      
       $sql_del = "delete from $table where other_no = $id and other_seq = $other_seq";    // echo $sql_del;
       mysqli_query($conn,$sql_del); 
       
  //     if($tal<0){
  //       $status_funds = "เบิกเพิ่ม";  
  //     }else{
  //        $status_funds = "เหลือ/คืน"; 
  //     }
  //     $sql_updatefunds = "update tbl_incentive_ot  set  status_funds = '$status_funds' , total_funds = '$tal'
  //     where id = $id";  // echo $sql_updatefunds;exit;
  //     mysql_query($sql_updatefunds); 
   } else if($typer == "check"){
             $to = $_REQUEST["to"];                
             $sql_check = "update tbl_incentive_ot set status_check = 's' where id = $id";
             mysqli_query($conn,$sql_check);       
   }
    header("location:incentive.clear.php?id=".$id."&type=edit");
?>

