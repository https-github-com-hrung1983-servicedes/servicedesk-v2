<?php
require_once('connection.php');
$select_action=$_POST["select_action"];

for($i=0;$i<count($_POST["check"]);$i++)
{

$id[$i] = $_POST["check"][$i];

//echo "ID : $id[$i] Action : $select_action <br>";
//echo "$i = ",$_POST["check"][$i],"</br>";

switch($select_action){
case "del":
    $strSQL = "DELETE FROM tbl_hardware_onhand_user WHERE id = '".$id[$i] ."' ";
    $objQuery = mysqli_query($conn,$strSQL);
    //echo $strSQL."<br>";
    break;
default:
    $strSQL2 = "UPDATE tbl_hardware_onhand_user SET hardware_status= '".$select_action."' WHERE id = '".$id[$i] ."'";
    $objQuery2 = mysqli_query($conn,$strSQL2);
    //echo $strSQL2."<br>";
    break;
}

}
header('Location:hw.waitrepair.list.php');
?>

