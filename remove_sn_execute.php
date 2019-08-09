<?
session_start();
require_once("function.php");
?>
<div style="width: 100%; text-align: center;">
<?
        $site_id = $_REQUEST["site_id"];  
        $jobno = $_REQUEST["jobno"]; 
        $user_engineer = $_REQUEST["user_engineer"]; 
        $service_type = $_REQUEST["service_type"];
        
        //echo $site_id." : ".$jobno." : ".$user_engineer." : ".$service_type."<br>";
        
        $sql_onhand="select * from tbl_hardware_onhand_user a
                              where a.user_id='".$site_id."' and a.cate_id not in ('21','24','26')";
        $r_onhand = mysqli_query($conn,$sql_onhand);
        while($c_onhand=mysqli_fetch_array($r_onhand)){
            $sn_id=$c_onhand["id"];
            $cate_id=$c_onhand["cate_id"];
            $sql_movement="INSERT INTO tbl_insident_hw  (job_no, site_id, cate_id, serial_no, active_status) 
                                    VALUES ('".$jobno."', '".$site_id."', '".$cate_id."', '".$sn_id."', 'r' ) ";
             mysqli_query($conn,$sql_movement);
             
             echo "<font color=red>".$c_onhand["hardware_no"]." has been remove. </font><br>";
            
        }
        
        
        $sql_remove="update tbl_hardware_onhand_user set user_id='$user_engineer' , from_site_id='".$site_id."' , hardware_status = 'o'
                              where user_id='".$site_id."' and cate_id not in ('21','24','26')";
         mysqli_query($conn,$sql_remove);
         //echo $sql_remove."<br>";
         
         
         
         
?>

<a href="javascript:window.open('','_self');window.close()" >Close</a>
</div>