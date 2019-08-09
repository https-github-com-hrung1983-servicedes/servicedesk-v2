<?      // Chipset TPS 5112
header("Content-Type: text/html; charset=tis-620");                 
session_start();
require_once("function.php");                                   
  
  if(!checkUser()){    echo Message(35,"red",$titel1,$msg1,"<a href='index.php?link=rpt.summary.index'> $login </a>");
         exit;
  }                                                                                                      
 include("header.php"); 
     
?>
<link href="css/loading.css" rel="stylesheet" type="text/css" media="all">

<script src="script/jquery.min.js"></script>
<script src="script/thickbox.js"></script>
<script src="script/loading.js"></script>

<script type="text/javascript" src="script/jquery-1.6.4.js"></script>
<script type="text/javascript" src="script/jquery_1.7.1_min.js"></script>
<script type="text/javascript">
$(document).ready(function(){

		$("#loading").ajaxStart(function(){
			$(this).show();
		 }).ajaxStop(function(){
			$(this).hide();
		 });
	
			$("#rptsummary").load('rpt.summary.php');
	
});
</script>
<html>
<head>
</head>   
<body>
<div id="loading" align="center"><br><br><br><br><br><br>
  <p><img src="image/loading.gif" /><br> Please Wait</p>
</div>
	<div id="rptsummary" class="rptsummary"></div>
</body>
</html>
