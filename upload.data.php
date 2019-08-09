 <?                                                                  
session_start();              
require_once("function.php");          
  
 if(!checkUser()){    echo Message(35,"red",$titel1,$msg1,"<a href='index.php'> $login </a>");
  exit;
  }                                                                                                      
       
include("header.php");  
?> 
<html>
<head>
<title>Upload file to Bizserv Solution</title>
<style type="text/css">
<!--
body {
    background-color:  #FFFFFF;
    margin-left: 0px;
    margin-top: 0px;
    margin-right: 0px;
    margin-bottom: 0px;

}
-->
</style>
<style type="text/css">
    <!--
    .mytable1 { width:70%; font-size:15px;
                border:0px solid #ccc;     
    }
    .mytable11 {width:100%; font-size:16px;
                border:1px solid #ccc;     
    }
     .th{ background-color:#003366; color:#FFF; padding:0px; border:0px solid #ccc; height:20px; }
     .td{ border-color:#003366;};
    -->
</style>
<link href="image/bss_icon.ico"   rel="shortcut icon" />  
<link href="style/calendar.css" rel="stylesheet" type="text/css">    
<link href="style/mytable.css" rel="stylesheet" type="text/css" />   
<script type="text/javascript" src="script/calendar_date_picker.js"></script>     
<link href="style/stylecss.css" rel="stylesheet" type="text/css">
<link href="style/filtergrid.css" rel="stylesheet" type="text/css">
<link href="css/loading.css" rel="stylesheet" type="text/css" media="all">

<script src="script/jquery.min.js"></script>
<script src="script/thickbox.js"></script>
<script src="script/loading.js"></script>

<script type="text/javascript" src="script/jquery-1.6.4.js"></script>
<script type="text/javascript" src="script/jquery_1.7.1_min.js"></script>
</head>
<body>
<center><br>
<form action="upload.data.execute.php" method="post" enctype="multipart/form-data" name="bigchernForm" onSubmit="return chckval()">
 รหัสสถานี : <input class="form-control"  type="text" name="foldername" id="foldername" value="<?=$_REQUEST["txt"]?>"><br><br>
	  <input class="form-control"  type="file" name="bigchernFile[]" id="bigchernFile"><br>
	  <input class="form-control"  type="file" name="bigchernFile[]" id="bigchernFile"><br>
	  <input class="form-control"  type="file" name="bigchernFile[]" id="bigchernFile"><br>
	  <input class="form-control"  type="file" name="bigchernFile[]" id="bigchernFile"><br>
	  <input class="form-control"  type="file" name="bigchernFile[]" id="bigchernFile"><br><br>
	  <input class="form-control"  type="submit" name="bigchern" value="Upload file" >
	  <input class="form-control"  type="hidden" name="event" value="upload"><br><br>
	  <a href='list.folder.data.php' target='_blank'>รายละเอียด</a><br><br>
	  <? if($_SESSION["Username"]=="hrung"  ||  $_SESSION["Username"]=="santi") { ?>
	  			<a href="del.file.php?folder_name=" target='_blank'>ลบ</div>
	  <? } ?>
	  </th>
</form>
</center>
</body>

 <script language="JavaScript">
	function chckval(){
	var txt =  document.bigchernForm.foldername.value;  
	    if(txt==""){
			alert("กรุณากรอกรหัสสถานีก่อนครับ");
			document.bigchernForm.foldername.focus();           
		 	return false;
		} else {
		 return true;
		 }
	}
</script>








<?php /*?>
  <table align="center" border="0" class="mytable1">  
       
    <div id="divresult" align="center"></div>
    <div id="progress" style="visibility:hidden" align="center"><img src="image/loading.gif"></div>
  <tr>      
    <form action="upload.data.execute.php" name="frmMain" method="post" enctype="multipart/form-data" target="iframe_target" onSubmit="return ChkSubmit();">
    <iframe id="iframe_target" name="iframe_target" src="#" style="width:0;height:0;border:0px solid #fff;"></iframe>
    <script language="JavaScript">

        function ChkSubmit(result){
            
            if(document.getElementById("foldername").value == ""){
                alert('Insert folder name ...');
                return false;
            }
            if(document.getElementById("filUpload").value == ""){
                alert('Please select file...');
                return false;
            }
            
            document.getElementById("progress").style.visibility="visible"; 
            document.getElementById("divresult").innerHTML ="Uploading....";
            
            return true;
        }

        function showResult(result){
            document.getElementById("progress").style.visibility="hidden"; 
            if(result==1){
                document.getElementById("divresult").innerHTML = "<font color=green> Save successfully! </font>  <br><meta http-equiv='refresh'>";
            }else if(result==2){ 
                document.getElementById("divresult").innerHTML = "<font color=red> Error!! Cannot upload data </font> <br><meta http-equiv='refresh'>";
            }else if(result==3){
                document.getElementById("divresult").innerHTML = "<font color=red> Error!! Cannot create folder name </font> <br><meta http-equiv='refresh'>"; 
            }
        } //  0145  
    </script>
     <td>&nbsp;
     </td><td>
    รหัสสถานี : <input class="form-control"  type="text" name="foldername" id="foldername">  </td>  
    <td>เลือกไฟล์ : <input class="form-control"  type="file" name="filUpload" id="filUpload"> </td>
    </tr>
    <tr>
        <th colspan="3">
            <input class="form-control"  type="submit" name="submit" value="Upload">&nbsp;&nbsp;<input class="form-control"  type="reset" name="cancel" value="Cancel">
        </th>
    </tr> <tr><th colspan="3"><a href='data/' target='_blank'>รายละเอียด</a></th></tr>
</form>
      
</body>
</html>
<form accept="#" name="folderref" id="folderref"> 
<? // $refresh = $_REQUEST["refresh"];?>                                  
 <table border="0" cellpadding="5"  width="100%" class="mytable11" cellspacing="0" class="whitelinks">

<? 
//if($_REQUEST["folderref"]==""){
//    $refreshx = $_REQUEST["refresh"];
    $paht = "data";
    if ($handle = opendir($paht)) {
    $i=0;
    echo "<tr>";
        while (false !== ($entry = readdir($handle))) { 
            if ($entry != "." && $entry != "..") {
                echo "<th width='10%' align='left'><a href='data/$refreshx/$entry' target='_blank'>$entry</a></th>";    
            }     
            if($i==10){
                 echo "</tr>"; 
                 $i=0;  
               }        
                $i++; 
        }
        
        closedir($handle);
    }
//}<?php */?>

</form>   
   