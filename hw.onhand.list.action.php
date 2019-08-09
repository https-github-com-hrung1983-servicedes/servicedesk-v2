<?php
require_once('connection.php');
$user_id=$_POST["user_id"];
$select_action=$_POST["status_hw"];
$engineer_row=$_POST["engineer_row"];
//echo "ID : $id Action : $select_action<br>";


for($i=0;$i<count($_POST["check"]);$i++)
{
$id[$i] = $_POST["check"][$i];
//echo "$i = ",$_POST["check"][$i],"  On hand to : $engineer_row </br>";



switch ($select_action) {
    case "o":
        $strSQL = "UPDATE tbl_hardware_onhand_user SET user_id= '".$engineer_row."' WHERE id = '".$id[$i] ."'";
        $objQuery = mysqli_query($conn,$strSQL);
        //echo $strSQL."<br>";
        break;   
   default:
    $strSQL3 = "UPDATE tbl_hardware_onhand_user SET hardware_status= '".$select_action."',user_id='' WHERE id = '".$id[$i] ."'";
    $objQuery3 = mysqli_query($conn,$strSQL3);
    //echo $strSQL3."<br>";
    break;
}

}
header("Location:hw.onhand.list.php?user_id=$user_id");
?>

