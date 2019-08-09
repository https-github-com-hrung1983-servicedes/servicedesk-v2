<?
/******* config *********/
$folder = "/var/www/servicedesk/"; // โฟลเดอร์เอาไว้เก็บไฟล์ เช่น upload/ แต่อย่าลืมส้ราง โฟลเดอร์เอาไว้ด้วยหละ และอย่าลืม chamod เป็น 777
//$folder = "C:\\";
/********* param ********/
$bigchernFile = $_FILES['bigchernFile'];
$event = $_REQUEST['event'];
/********* event  *******/
if($event=="upload"){
 for($i=0;$i<count($bigchernFile['name']);$i++){
   if(is_file($bigchernFile['tmp_name'][$i])){
   echo $bigchernFile['name'][$i]." uploaded<br>";
    $rand = rand(1111,9999);
      copy($bigchernFile['tmp_name'][$i],$folder.$bigchernFile['name'][$i]);
      /*    ถ้าอยากเก็บชื่อไฟล์ลง database ก็เก็บตรงนี้ เรียกตัวแปร  $bigchernFile['name'][$i] ใช้งานได้เลย */
   }
 } 

echo "<script> alert('bigchern upload complete');</script>";
echo "<script> document.location='?';</script>"; 
exit();
}
?>

<body>
<form action="" method="post" enctype="multipart/form-data" name="bigchernForm">
  <input class="form-control"  type="file" name="bigchernFile[]" id="bigchernFile"><br>
  <input class="form-control"  type="file" name="bigchernFile[]" id="bigchernFile"><br>
  <input class="form-control"  type="file" name="bigchernFile[]" id="bigchernFile"><br>
  <input class="form-control"  type="file" name="bigchernFile[]" id="bigchernFile"><br>
  <input class="form-control"  type="file" name="bigchernFile[]" id="bigchernFile"><br>
  <input class="form-control"  type="file" name="bigchernFile[]" id="bigchernFile"><br>
  <input class="form-control"  type="file" name="bigchernFile[]" id="bigchernFile"><br>
  <input class="form-control"  type="file" name="bigchernFile[]" id="bigchernFile"><br>
  <input class="form-control"  type="file" name="bigchernFile[]" id="bigchernFile"><br>
  <input class="form-control"  type="file" name="bigchernFile[]" id="bigchernFile"><br>
  <input class="form-control"  type="file" name="bigchernFile[]" id="bigchernFile"><br>
  <input class="form-control"  type="file" name="bigchernFile[]" id="bigchernFile"><br>
  <input class="form-control"  type="file" name="bigchernFile[]" id="bigchernFile"><br>
  <input class="form-control"  type="submit" name="bigchern" value="bigchern submit">
  <input class="form-control"  type="hidden" name="event" value="upload">
</form>
 
 

