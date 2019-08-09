<?
$foldername = trim($_REQUEST["foldername"]); 
$folder = "data/$foldername/"; 
$bigchernFile = $_FILES['bigchernFile'];
$event = $_REQUEST['event'];
if($event=="upload"){
 for($i=0;$i<count($bigchernFile['name']);$i++){
 //echo $folder.$i; 
   if(is_file($bigchernFile['tmp_name'][$i])){
	 //  echo $bigchernFile['name'][$i]." uploaded<br>";
		if(!copy($bigchernFile['tmp_name'][$i],  $folder.$bigchernFile['name'][$i])){
			echo "<script> alert('ไม่มีสถานีนี้ กรุณาตรวจสอบรหัสสถานีใหม่');</script>";
			echo "<script> window.parent.location.href ='upload.data.php?txt=$foldername'</script>"; 
			exit();
		}
   }
 } 
echo "<script> alert('Upload complete');</script>";
echo "<script> window.parent.location.href ='upload.data.php'</script>"; 
exit();
}

//require("function.php");
//$sql = "select tbl_site.site_id,tbl_site.site_name from tbl_site";
//$rs = mysqli_query($conn,$sql);
//while($c = mysqli_fetch_array($rs)){
//  $datafile = "data/".$c["site_id"];
//  echo $datafile."<hr>";
//  $makefolder = mkdir($datafile,0777); 
//}
//
//exit;
//sleep(3);
//$foldername = trim($_REQUEST["foldername"]); 
//$datatype = trim($_REQUEST["datatype"]); 
//$datafile = "data/$foldername/";
////$makefolder = mkdir($datafile,0777);    
////if(!$makefolder){                                                          
////    echo "<script>alert('Error! Cannot create folder name');</script>";
////    echo "<script>window.top.window.showResult('3');</script>";
////   exit;
////}
//
//
//if(copy($_FILES["filUpload"]["tmp_name"],$datafile.$_FILES["filUpload"]["name"]))
//{
//    echo "<script>alert('Upload file successfully!');</script>";
//    echo "<script>window.top.window.showResult('1');</script>";
//}
//else
//{
//    echo "<script>alert('Error! Cannot upload data');</script>";
//    echo "<script>window.top.window.showResult('2');</script>";
//}
//
//

?>
