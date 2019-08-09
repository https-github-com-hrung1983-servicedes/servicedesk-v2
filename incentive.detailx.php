<?
header("Content-Type: text/html; charset=tis-620");

session_start();
require_once("function.php"); 
if(!checkUser()){    echo Message(35,"red",$titel1,$msg1,"<a href='index.php?link=incentive.detailx'> $login </a>");
   exit;
}                

                                                                              
   $id = $_REQUEST["id"];
   $typer = $_REQUEST["typer"];
   $site_id = $_REQUEST["site_id"];
   $table = "tbl_incentive_detail";
   if($typer == ""){       
       $seq_id = $_REQUEST["seq_id"];
       $dte = $_REQUEST["dte"];   //echo  $dte; exit;
       $location_from = $_REQUEST["location_from"];   
       $location_to = $_REQUEST["location_to"];         
       $distance_from = $_REQUEST["distance_from"];   
       $distance_to = $_REQUEST["distance_to"];   
       $distance_result = $distance_to-$distance_from;//$_REQUEST["distance_result"];   
       $express_ = $_REQUEST["express_"];   
       $description = addslashes($_REQUEST["description"]);                                                
       if($id != "" && $seq_id ==""){
          $seq_id = AutoNumber($table." where id = $id","seq_id");                          
          $sql = "Insert into $table (id,seq_id,dte,site_id,location_form,location_to,distance_form,distance_to,ditstance_result,express_position,jobdescription)
                   values ('$id','$seq_id','$dte','$site_id','$location_from','$location_to',
                    '$distance_from','$distance_to','$distance_result','$express_','$description')";     // echo $sql;exit;
         mysqli_query($conn,$sql);                                            
       } else {                                 
          $sql = "Update $table set dte='$dte',site_id='$site_id',location_form='$location_from',location_to='$location_to',distance_form='$distance_from',
                    distance_to='$distance_to',ditstance_result='$distance_result',express_position='$express_',jobdescription='$description'   
                   Where id = $id And seq_id = $seq_id"; //echo $sql;exit;
                   mysqli_query($conn,$sql); 
       }                            
  
   } else {
       $sql_del = "delete from $table where id = $id and seq_id = $seq_id";
       mysqli_query($conn,$sql_del);
   }
    header("location:incentive.form.php?id=".$id."&type=edit");
?>

