<?
session_start();
initdb();
function initdb(){
		global $conn;
		
        $conn=mysqli_connect("localhost","bizservs_admin","Bss1234!","bizservs_helpdesk");
        //mysqli_select_db("bizservs_helpdesk");        
        mysqli_query($conn,"SET CHARACTER SET tis620");//tis620
        mysqli_query($conn,"SET character_set_results=tis620");
        mysqli_query($conn,"SET character_set_client=tis620");
        mysqli_query($conn,"SET character_set_connection=tis620");
}
?>
