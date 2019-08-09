 <?                                                                 
session_start();              
require_once("function.php");          
  
if(!checkUser()){    echo Message(35,"red",$titel1,$msg1,"<a href='index.php?link=file'> $login </a>");
  exit;
  }                                                                                                      
       
//include("header.php");  
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
</head>
<body>
  <table align="center" border="0" class="mytable1">  
       
    <div id="divresult" align="center"></div>
    <div id="progress" style="visibility:hidden" align="center"><img src="image/loading.gif"></div>
  <tr>      
    <form action="file.execute.php" name="frmMain" method="post" enctype="multipart/form-data" target="iframe_target" onSubmit="return ChkSubmit();">
    <iframe id="iframe_target" name="iframe_target" src="#" style="width:0;height:0;border:0px solid #fff;"></iframe>
    <script language="JavaScript">

        function ChkSubmit(result){
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
        }
    </script>
     <td>
    Folder name : <input class="form-control"  type="text" name="foldername" id="foldername">  </td>  
    <td>Select file : <input class="form-control"  type="file" name="filUpload" id="filUpload"> </td>
    </tr>
    <tr>
        <th colspan="3">
            <input class="form-control"  type="submit" name="submit" value="Upload">&nbsp;&nbsp;<input class="form-control"  type="reset" name="cancel" value="Cancel">
        </th>
    </tr>
</form>
      
</body>
</html>
