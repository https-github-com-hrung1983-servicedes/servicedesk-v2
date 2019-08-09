<?php
header("content-type:text/javascript;charset=utf-8");
$con=mysqli_connect('localhost','user','password','gps')or die(mysql_error($conn)); 
//mysql_select_db('gps')or die(mysql_error());
mysqli_query($conn,"SET NAMES UTF8");
if (isset($_POST)){
    if($_POST['isAdd']=='true'){
        $Phone_no=$_POST['Phone_no'];
        $Track_time=$_POST['Track_time'];
        $Longitude = $_POST['Longitude'];
        $Latitude = $_POST['Latitude'];
        $Battery_life = $_POST['Battery_life'];
        $Remark = $_POST['Remark'];
        $sql="INSERT INTO 'ServiceTracking' ('Phone_no', 'Track_time', 'Longitude', 'Latitude','Battery_life','Remark') VALUES ('$Phone_no', '$Track_time', '$Longitude', '$Latitude','$Battery_life','$Remark')";
        mysqli_query($conn,$sql);
    }
}
mysql_close($conn);
?>