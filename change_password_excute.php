<?                                
require_once("function.php");                              
        $pass = $_REQUEST["txtNew1"];             
            $sql = "Update tbl_user_login set password = '$pass' where user_bss_id = ".$_SESSION["Uid"];      
          //    echo $sql;  
             $Upassword =  $pass;           
             mysqli_query($conn,$sql);
             header("location:index1.php");                        
                       
           
?>
