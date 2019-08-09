<?
//session_start();
initdb();
function initdb(){
		global $conn;
		
       $conn=mysqli_connect("localhost","root","Nirund2526!@","bizservs_helpdesk") or die("Connection fail");
       // mysql_select_db("helpdesk_service");        
      //  mysql_query("SET CHARACTER SET  tis620");
        
        
    // ff    mysql_connect("localhost","bizservs_admin","Bss1234!");
        //mysql_select_db("bizservs_helpdesk") or die("Cannot connect database");
        mysqli_query($conn,"SET CHARACTER SET tis620");//tis620
        mysqli_query($conn,"SET character_set_results=tis620");
        mysqli_query($conn,"SET character_set_client=tis620");
        mysqli_query($conn,"SET character_set_connection=tis620");
}




?>
