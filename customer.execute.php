<?
header("Content-Type: text/html; charset=tis-620");

session_start();
require_once("function.php"); 
if(!checkUser()){    echo Message(35,"red",$titel1,$msg1,"<a href='index.php'> $login </a>");
   exit;
}                         
   $id = $_REQUEST["customer_id"];                                
   $customer_name = $_REQUEST["customer_name"];
   $customer_contact = $_REQUEST["customer_contact"];
   $customer_tel = $_REQUEST["customer_tel"];
   $customer_address = $_REQUEST["customer_address"];      
   $table = "tbl_other_customer";     
   if($id == ""){                            
      $sql = "Insert into $table (customer_name,customer_contact,customer_tel,customer_address)
               values ('$customer_name','$customer_contact','$customer_tel','$customer_address')";  
   } else {
      $sql = "Update $table set customer_name ='$customer_name', customer_contact='$customer_contact',
                customer_tel='$customer_tel',customer_address='$customer_address' 
               Where customer_id = $id"; 
   }
  // echo $sql;
    mysqli_query($conn,$sql);
    header("location:customer.list.php");
?>

