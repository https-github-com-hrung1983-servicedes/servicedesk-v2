<?
session_start();
require_once("function.php");
$lot=$_REQUEST["lot"];
$warr=$_REQUEST["warr"];
$expried=$_REQUEST["expried"];

$sql_update="UPDATE tbl_hardware_onhand_user 
                    SET warranty_hardware_type_date = '".$warr."', expired_hardware_type_date = '".$expried."'
                    WHERE comment_lot='".$lot."' ";
                    //echo $sql_update;
                    mysqli_query($conn,$sql_update);
                    
                    
                    echo "<script>
                     alert('Update Warranty Date : $warr and Expired Date : $expried');
                     window.location.href='edit_warranty.php?sch_lot=$lot';
                     </script>";
                                         
                    
?>