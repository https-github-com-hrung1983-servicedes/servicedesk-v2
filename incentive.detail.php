<?
header("Content-Type: text/html; charset=tis-620");

session_start();
require_once("function.php"); 
if(!checkUser()){    echo Message(35,"red",$titel1,$msg1,"<a href='index.php?link=incentive.detail'> $login </a>");
   exit;
}                

                                                                              
   $id = $_REQUEST["id"];
   $typer = $_REQUEST["typer"];
   $site_id = $_REQUEST["site_id"];
   $table = "tbl_incentive_detail";
       $seq_id = $_REQUEST["seq_id"];
   if($typer == ""){         
       $dte = $_REQUEST["dte"]; //  echo  $seq_id; exit;
       $location_from = $_REQUEST["location_from"];   
       $location_to = $_REQUEST["location_to"];         
       $distance_from = $_REQUEST["distance_from"];   
       $distance_to = $_REQUEST["distance_to"];   
       $distance_result = $distance_to-$distance_from;//$_REQUEST["distance_result"];   
       $express_ = $_REQUEST["express_"];   
       $description = addslashes($_REQUEST["description"]); 
       $job_id = $_REQUEST["job_no"]; 
       $allowan = $_REQUEST["allowance"];  
       $incentive = $_REQUEST["incentive"]; 
       $fee_hotel = $_REQUEST["fee_hotel"];   
       $gasperkilo = $_REQUEST["gasperkilo"]; 
       $other_fee = $_REQUEST["other_fee"];   
	   $fee_gas = $distance_result * $gasperkilo;
	   if($gasperkilo==0){
	   $fee_gas = $_REQUEST["fee_oil_gas"];
	   }
       if($id != "" && $seq_id ==""){
          $seq_id = AutoNumber($table." where id = $id","seq_id");                          
          $sql = "Insert into $table (id,seq_id,dte,site_id,location_form,location_to,distance_form,distance_to,ditstance_result,express_position,jobdescription,job_no,allowance,incentive,fee_hotel,fee_oil_gas,other_fee)
                   values ('$id','$seq_id','$dte','$site_id','$location_from','$location_to',
                    '$distance_from','$distance_to','$distance_result','$express_','$description','$job_id','$allowan','$incentive','$fee_hotel','$fee_gas','$other_fee')";     //echo $sql;exit;
         mysqli_query($sql);                                            
       } else {                                 
          $sql = "Update $table set dte='$dte',site_id='$site_id',location_form='$location_from',location_to='$location_to',distance_form='$distance_from',
                    distance_to='$distance_to',ditstance_result='$distance_result',express_position='$express_',jobdescription='$description',
					job_no = '$job_id',allowance = '$allowan',incentive = '$incentive',fee_hotel='$fee_hotel',fee_oil_gas = '$fee_gas',other_fee='$other_fee'
                   Where id = $id And seq_id = $seq_id";// echo $sql;exit;
                   mysqli_query($sql); 
       }                            
  
   } else {
       $sql_del = "delete from $table where id = $id and seq_id = $seq_id";
       mysqli_query($sql_del);
//echo $sql_del;exit;
   }
    header("location:incentive.form.php?id=".$id."&type=edit");
?>

