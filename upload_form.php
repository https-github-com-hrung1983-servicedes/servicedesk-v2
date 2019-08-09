<?
header("Content-Type: text/html; charset=tis-620");
header("content-type: application/x-javascript; charset=TIS-620");
session_start();
require_once("function.php");
include("header.php");

$fupload=$_POST["fupload"];
$schfolder=$_GET["sch_folder"];

$link=$_SERVER['SERVER_NAME'];
$todate=date("Y-m-d_H-i");
?>

<html>

<script language=VBScript>
Dim Bar, Line, SP
Bar = 0
Line = "|"
SP = 100
Function Window_onLoad()
Bar = 95
SP = 10
End Function

Function Count()
If Bar < 100 Then
Bar = Bar + 1
Window.Status = "Loading : " & Bar & "%" & " " & String(Bar, Line)
setTimeout "Count()", SP
Else
Window.Status = "Thailand Miscellaneous" // ใส่ข้อความที่ต้องการให้ขึ้นที่ STATUSBAR หลังจากแสดงแถบ LOAD เสร็จแล้ว
Document.Body.Style.Display = ""
End If
End Function

Call Count()
</script>



<head>
<title>BizservSolution</title>
<script language="javascript" src="script.js"></script>
<link href="css/loading.css" rel="stylesheet" type="text/css" media="all">
<link href="image/bss_icon.ico"   rel="shortcut icon" />
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.0/jquery.js" type="text/javascript"></script>
<link href="uploadscript/style_progress.css" rel="stylesheet" type="text/css" />
<script>
$(document).ready(function() {
//

	setInterval(function()
		{
	$.get("<?php echo $url; ?>?progress_key=<?php echo $_GET['up_id']; ?>&randval="+ Math.random(), {
		//get request to the current URL (upload_frame.php) which calls the code at the top of the page.  It checks the file's progress based on the file id "progress_key=" and returns the value with the function below:
	},
		function(data)	//return information back from jQuery's get request
			{
				$('#progress_container').fadeIn(100);	//fade in progress bar
				$('#progress_bar').width(data +"%");	//set width of progress bar based on the $status value (set at the top of this page)
				$('#progress_completed').html(parseInt(data) +"%");	//display the % completed within the progress bar
			}
		)},500);	//Interval is set at 500 milliseconds (the progress bar will refresh every .5 seconds)

});


</script>



<style>
.div_upload{
  width: 100%;
  text-align: center;
  margin-top: 20px;
}
.input_upload{
  padding: 2px;
}
.status_upload{
  padding: 20px;
  margin: 0 auto;
  margin-top: 20px;
  width: 700px;
  background-color: #DDE4E9;
  font-size: 14px;
}
.btn_upload{
  padding: 5px;
}
</style>
</head>
<body>
<div class="div_upload">
  <tr>
    <td>
<form name="form1" method="post" action="#" enctype="multipart/form-data" onSubmit="JavaScript:return fncSubmit();">
  Folder Name : <input type="text" name="fupload" id="fupload" value="<?=$fupload?>"><br>
	<input type="file" name="file_upload[]" id="file_upload[]" class="input_upload"><br>
	<input type="file" name="file_upload[]" id="file_upload[]" class="input_upload"><br>
	<input type="file" name="file_upload[]" id="file_upload[]" class="input_upload"><br>
  <input type="file" name="file_upload[]" id="file_upload[]" class="input_upload"><br>
  <input type="file" name="file_upload[]" id="file_upload[]" class="input_upload"><br>
  <input type="file" name="file_upload[]" id="file_upload[]" class="input_upload"><br>
  <input type="file" name="file_upload[]" id="file_upload[]" class="input_upload"><br>
  <input type="file" name="file_upload[]" id="file_upload[]" class="input_upload"><br>
  <input type="file" name="file_upload[]" id="file_upload[]" class="input_upload"><br>
  <input type="file" name="file_upload[]" id="file_upload[]" class="input_upload"><br>
  <br>
	<input name="btnSubmit" type="submit" value="Upload" class="btn_upload">

</div>
<? if($fupload !=""){ ?>
<div class="status_upload">

<?

if(is_dir("file_upload/$fupload"))
{
  if($fupload!=""){
    echo"<u>Folder $fupload Ative.</u> <br>  ";
  }
}
else
{

$uppath = mkdir ("file_upload/$fupload");
if($uppath)
{
	echo "<u>Folder $fupload Created.</u><br>";
}
else
{
	echo "<u>Folder $fupload Not Create.</u><br>";
}

 }

for($i=0;$i<count($_FILES["file_upload"]["name"]);$i++)
{
  $abc=$todate."_".$_FILES["file_upload"]["name"][$i];
	if($_FILES["file_upload"]["name"][$i] != "")
	{

                   //copy($_FILES["filUpload"]["tmp_name"],$_FILES["filUpload"]["name"])

		if(copy($_FILES["file_upload"]["tmp_name"][$i],"file_upload/$fupload/".$abc))
		{
			echo "<br>$abc <font color='green'>Upload Complete</font><br> ";
		}
		else{
			echo "$abc Upload Fail";
		}
	}


}

?>
</div>

<? } ?>
<div class="status_upload">
Select Folder : <select name="sch_folder" id="sch_folder" OnChange="window.location='?sch_folder='+this.value;">
<?
$objOpen_folder = opendir("file_upload");
while (($folder = readdir($objOpen_folder)) !== false)
{
	if (($folder == ".") or ($folder == "..")) continue;
	?>
	<option value="<?=$folder?>" <? if($schfolder == $folder){ echo "selected"; } ?>><?=$folder?></option>
<?}?>
</select>
<br>
<br>
<?php

	$objOpen = opendir("file_upload/$schfolder");
	while (($file = readdir($objOpen)) !== false)
	{
		if (($file == ".") or ($file == "..")) continue;
		?>
		 <a href='file_upload/<?=$schfolder?>/<?=$file?>'>Download</a> <?=$file?><br>
	<? } ?>
</div>

</form>
</body>
</html>

<script type="text/javascript">
function fncSubmit()
{
    if(document.getElementById('fupload').value == "")
    {
        alert('Please Input Folder Name.');
        return false;
    }
}
</script>
