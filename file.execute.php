<?
sleep(3);
$foldername = trim($_REQUEST["foldername"]); 
$datatype = trim($_REQUEST["datatype"]); 

$flgRename = rename($_FILES["filUpload"]["name"], $_FILES["filUpload"]["name"]."_bc");

if(copy($_FILES["filUpload"]["tmp_name"],$_FILES["filUpload"]["name"]))
{
    echo "<script>alert('Upload file successfully!');</script>";
    echo "<script>window.top.window.showResult('1');</script>";
}
else
{
    echo "<script>alert('Error! Cannot upload data');</script>";
    echo "<script>window.top.window.showResult('2');</script>";
}
?>
