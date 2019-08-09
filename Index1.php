<?                 
//header("Content-Type: text/html; charset=tis-620");                 
//session_start();
//require_once("function.php");         
  
//  if(!checkUser()){    echo Message(35,"red",$titel1,$msg1,"<a href='index.php'> $login </a>");
//  exit;
//  }  
$link=$_REQUEST["link"];      
if($link==""){
		//$link = "cm_sla_percentage";
		$link = "serial.export";
	} 
?>
 


<head>
    <title>Bizserv Solution Co.,Ltd</title>
    <link href="image/bss_icon.ico"   rel="shortcut icon" /> 
</head>



<style type="text/css">
<!--
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;

}
-->
</style>


<frameset rows="0%,*" border="1" >
    <frame name="header" marginwidth="10" marginheight="10" scrolling="no" frameborder="0" noresize-->
    <frameset   border="1" >
        <!--frame name="leftMenu" src="leftMenu.php" marginwidth="10" marginheight="10" scrolling="no" frameborder="0" noresize--> 
        <frame name="mainPage" src="<?=$link?>.php" marginwidth="10" marginheight="10" scrolling="auto" frameborder="0" noresize>
    </frameset>
</frameset><noframes></noframes>











