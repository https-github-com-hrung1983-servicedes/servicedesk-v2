<?
$folder = "job_no/"; 
$bigchernFile = $_FILES['file'];

$name = explode("\\.",$bigchernFile['name']);
$name1 = explode("job_no_",$name[0]);
		if(!copy($bigchernFile['tmp_name'],  $folder.$name1[1]."_new.pdf")){
			echo "<script> alert('�Ѿ��Ŵ��������');</script>";
			echo "<script> window.history.back();</script>"; 
			exit();
		} 
		echo "<script> alert('�Ѿ��Ŵ���º����');</script>";
	    echo "<script>window.close();</script>"; 
		
		
		

?>
