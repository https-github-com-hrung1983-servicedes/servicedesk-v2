<?
/******* config *********/
$folder = "/var/www/servicedesk/"; // ����������������� �� upload/ ������������ҧ ������������������ ���������� chamod �� 777
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
      /*    �����ҡ�纪������ŧ database ���纵ç��� ���¡�����  $bigchernFile['name'][$i] ��ҹ����� */
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
 
 

