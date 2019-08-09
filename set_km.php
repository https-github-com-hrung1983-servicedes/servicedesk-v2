<?php
include("connection.php");
 if(isset($_POST['submit'])){
   $edit_km = $_POST['edit_km'];
   $km_edit = $_POST['km_edit'];
   $ccid= $_POST['ccid'];
if (is_array($edit_km)) {
   foreach ($edit_km as $hobys=>$value) {
       $e = explode("-", $value);

       $id=$e[0];
       $seq=$e[1];
       $distance=$e[2];
       $total = $distance* $km_edit;
             //echo "edit_km : ".$id." ".$seq." ".$distance."*".$km_edit."=".$total."<br />";
            
                $sql="UPDATE  tbl_incentive_detail 
                            set fee_oil_gas='$total'
                            where id = '$id' and seq_id = ' $seq'
                            ";
                 mysqli_query($conn,$sql);      
                 header("location:view.incentive.settlement.php?id=$id");
        }
}else{
   header("location:javascript://history.go(-1)");
}
 }
?>