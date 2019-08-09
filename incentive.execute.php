<?
header("Content-Type: text/html; charset=tis-620");

session_start();
require_once("function.php"); 
if(!checkUser()){    echo Message(35,"red",$titel1,$msg1,"<a href='index.php'> $login </a>");
   exit;
}                                                                                
   $id = $_REQUEST["id"]; //echo $id/
   $other_no = $_REQUEST["other_no"];   
   $other_date = $_REQUEST["other_date"];   
   $other_receive = $_REQUEST["other_receive_id"]; 
   $other_description = $_REQUEST["other_description"]; 
   $other_real_godate = $_REQUEST["other_real_godate"]; 
   $other_real_backdate = $_REQUEST["other_real_backdate"]; 
   $other_totaldate = $_REQUEST["other_totaldate"]; 
   $other_rental_day = $_REQUEST["other_rental_day"]; 
   $other_rental = $_REQUEST["other_rental"]; 
   $other_expenses_per_day = $_REQUEST["other_expenses_per_day"]; 
   $other_expenses_per = $_REQUEST["other_expenses_per"]; 
   $other_gas_oil = $_REQUEST["other_gas_oil"]; 
   $other_pay = $_REQUEST["other_pay"]; 
   $other_pay_total = $_REQUEST["other_pay_total"];   
   $incentive_total = $_REQUEST["incentive_total"];   
   $gasperkilo = $_REQUEST["gasperkilo"];
   
   $authen_by = $_REQUEST["authen_by"];
    $total =  $other_rental  + $other_gas_oil + $other_pay_total;
   
   $table = "tbl_incentive_ot";                                                                
                                                                             
   if($id == ""){   
                              
      $sql = "Insert into $table (other_no,other_date,other_receive,other_description,other_real_godate,
                other_real_backdate,other_totaldate,other_rental_day,other_rental,other_expenses_per_day,
                other_expenses_per,other_gas_oil,other_pay,other_pay_total,other_total,incentive_total,status_check,gasperkilo,authen_by)
               values ('$other_no','$other_date','$other_receive','$other_description','$other_real_godate',
                '$other_real_backdate','$other_totaldate','$other_rental_day','$other_rental','$other_expenses_per_day',
                '$other_expenses_per','$other_gas_oil','$other_pay','$other_pay_total','$total','$incentive_total','','$gasperkilo','0')"; 
//echo $sql;exit; 
    
mysql_query($conn,$sql);
    $idd1 = mysqli_insert_id($conn);//echo $idd1;exit;
    $idd = $Year."-".formatNum($idd1,3);   
    mysql_query("Update $table set other_no = '$idd'  where id = $idd1");
   } else {                                 
      $sql = "Update $table set other_description='$other_description',other_real_godate='$other_real_godate',
                other_real_backdate='$other_real_backdate',other_totaldate='$other_totaldate',
                other_rental_day='$other_rental_day',other_rental='$other_rental',other_expenses_per_day='$other_expenses_per_day',
                other_expenses_per='$other_expenses_per',other_gas_oil='$other_gas_oil',
                other_pay='$other_pay',other_pay_total='$other_pay_total',other_total='$total',incentive_total='$incentive_total',
                gasperkilo='$gasperkilo',authen_by='$authen_by'   
               Where id = $id"; 
               mysqli_query($conn,$sql); 
   }
    //      echo $sql;
  //
  // $id = mysql_insert_id();    
    header("location:incentive.ot.list.php");
?>

