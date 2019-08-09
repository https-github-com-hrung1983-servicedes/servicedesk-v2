<?
define('FPDF_FONTPATH','fpdf/font/');
require("fpdf/fpdf.php");
require("function.php");       
$pdf=new FPDF('P','mm','A4');                               
//$pdf=new FPDF('P','mm', array(80,200)); //    'A5'
    $pdf->AddPage();
    $pdf->AddFont('angsa','','angsa.php');    
$id = $_REQUEST["id"];
$id = 14746;
$namexx ="";
$sql="Select tbl_log_call_center.*,
              tbl_category_type.fixed_description,
              u1.name as reciept_name,            
              u1.sname as reciept_sname,         
              u2.name as engineer_name,  
              u2.sname as engineer_sname,
              tbl_province.provice_phase,
			  tbl_site.site_name,
			  tbl_site.site_old_name,
	   		  tbl_site.pos,
			  tbl_site.province_name	
             From tbl_log_call_center
                    Left Join tbl_category_type ON tbl_log_call_center.category_type = tbl_category_type.category_id
                    Left Join tbl_user u1 ON tbl_log_call_center.reciept_job_bss = u1.user_id 
                    Left Join tbl_user u2 ON tbl_log_call_center.reciept_job_user_id = u2.user_id
                    Left Join tbl_province ON tbl_log_call_center.site_province = tbl_province.province_name
					Left Join tbl_site ON tbl_log_call_center.site_id = tbl_site.site_id
             Where tbl_log_call_center.id = '$id'"; 
$rs = mysqli_query($conn,$sql);
$c = mysqli_fetch_array($rs);  
$open_date = dateThai($c["open_call_dte"]);     
$onsite_date = $c["onsite_datetime"];  
$fix_date = $c["fixed_time"];     
$close_date = $c["closed_date"];
$hour_sal = $c["sla"];
$dte_thai = dateThai($c["other_date"]);

$pdf->Cell(200,8,"",0,1,'');
$pdf->Image("image/logo1.jpg",8,8,200,30,"jpg","");	



$pdf->Ln();	$pdf->Ln();	$pdf->Ln();	
$pdf->SetFont('angsa','u',28);
$pdf->cell(200,7,iconv('UTF-8','TIS-620','Maintenance Service Report'),"",1,'C');
$pdf->SetFont('angsa','',11);
$pdf->cell(305,7,iconv('UTF-8','TIS-620','MSR NO.').$c["bss_msr_no"],"",1,'C');//RLTB
$pdf->cell(327,7,iconv('UTF-8','TIS-620','Case ID/(BSS): '.$c["job_no"]),"",1,'C');
$pdf->cell(333,7,iconv('UTF-8','TIS-620','Ref.No./(PTT ICT): '.$c["job_no"]),"",1,'C');
$pdf->Ln();	
$pdf->cell(30,7,iconv('UTF-8','TIS-620','Call Date/(วันที่แจ้ง): '),"",0,'L');
$pdf->cell(45,7,iconv('UTF-8','TIS-620','เวลา : '),"",0,'C');
$pdf->cell(45,7,iconv('UTF-8','TIS-620','Appointment Date/(วันที่นัดหมาย): '),"",0,'C');
$pdf->cell(45,7,iconv('UTF-8','TIS-620','Time/(เวลา): '),"",0,'C');
$pdf->Ln();	
$pdf->cell(30,7,iconv('UTF-8','TIS-620','Site ID/(รหัสสถานี): '),"",0,'L');
$pdf->cell(45,7,iconv('UTF-8','TIS-620','Site Name/ชื่อสถานี : '),"",0,'C');
$pdf->cell(45,7,iconv('UTF-8','TIS-620','Contact Person/(ผู้ติดต่อประสานงาน): '),"",0,'C');
$pdf->Ln();	
$pdf->cell(30,7,iconv('UTF-8','TIS-620','Instant Name/(ชื่ออุปกรณ์): '),"",0,'L');
$pdf->cell(45,7,iconv('UTF-8','TIS-620','Product Name/(ชื่อผลิตภัณฑ์) : '),"",0,'C');
$pdf->cell(45,7,iconv('UTF-8','TIS-620','Model/(รุ่น): '),"",0,'C');
$pdf->cell(45,7,iconv('UTF-8','TIS-620','S/n/(หมายเลขเครื่อง): '),"",0,'C');
$pdf->Ln();	
$pdf->cell(30,7,iconv('UTF-8','TIS-620','MA/Wananty/(เงื่อนไขการรับประกัน): '),"",0,'L');
$pdf->cell(45,7,iconv('UTF-8','TIS-620','O No/ไม่   O Yes/ใช่'),"",0,'C');
$pdf->cell(45,7,iconv('UTF-8','TIS-620','By Agreement No/หมายเลขสัญญาบริการ :'),"",0,'C');
$pdf->cell(45,7,iconv('UTF-8','TIS-620','From          To   : '),"",0,'C');
$pdf->Ln();	
$pdf->cell(30,7,iconv('UTF-8','TIS-620','Service Type/ประเภทงานให้บริการ :'),"",1,'L');
$pdf->cell(180,7,iconv('UTF-8','TIS-620','O Call(แจ้งปัญหา) O Install(ติดตั้งอุปกรณ์) O PM(บำรุงรักษา) O Delivery(จัดส่งอุปกรณ์) O Outsource(บริการให้คำปรึกษา) O Return(ส่งคืนอุปกรณ์)  O Other(อื่นๆ)'),"",1,'R');	
$pdf->cell(30,7,'_______________________________________________________________________________________________________________________________________________________',"",1,'L');
$pdf->cell(50,7,iconv('UTF-8','TIS-620','Case Title/ปัญหา :'),"",0,'L');
$pdf->Ln();	
$pdf->cell(50,7,iconv('UTF-8','TIS-620','Solution/การแก้ไข :'),"",0,'L');
$pdf->Ln();	
$pdf->cell(70,7,'_______________________________________________________________________________________________________________________________________________________',"",1,'L');
$pdf->SetFont('angsa','u',11);
$pdf->cell(180,7,iconv('UTF-8','TIS-620','Exchanged Record/รายการเปลี่ยนอุปกรณ์ :'),"",1,'L');
$pdf->SetFont('angsa','',11);
$pdf->cell(40,7,iconv('UTF-8','TIS-620','Customer Asset (Bring Back / Return ) : เครื่องลูกค้า (0 นำกลับ   0 ส่งคืน)'),"LTB",0,'L');
$pdf->cell(40,7,iconv('UTF-8','TIS-620',''),"TB",0,'L');
$pdf->cell(40,7,iconv('UTF-8','TIS-620',''),"TB",0,'L');
$pdf->cell(35,7,iconv('UTF-8','TIS-620',''),"TB",0,'L');
$pdf->cell(40,7,iconv('UTF-8','TIS-620',''),"RTB",1,'L');

$pdf->cell(40,7,iconv('UTF-8','TIS-620','Description/รายละเอียด'),"LRTB",0,'C');
$pdf->cell(40,7,iconv('UTF-8','TIS-620','Product Name/หมายเลขผลิตภัณฑ์'),"LRTB",0,'C');
$pdf->cell(40,7,iconv('UTF-8','TIS-620','Serial Number/หมายเลขเครื่อง'),"LRTB",0,'C');
$pdf->cell(35,7,iconv('UTF-8','TIS-620','Qty/จำนวน'),"LRTB",0,'C');
$pdf->cell(40,7,iconv('UTF-8','TIS-620','Remark Code'),"LRTB",1,'C');

$pdf->cell(40,7,iconv('UTF-8','TIS-620',''),"LRB",0,'C');
$pdf->cell(40,7,iconv('UTF-8','TIS-620',''),"LRB",0,'C');
$pdf->cell(40,7,iconv('UTF-8','TIS-620',''),"LRB",0,'C');
$pdf->cell(35,7,iconv('UTF-8','TIS-620',''),"LRB",0,'C');
$pdf->cell(40,7,iconv('UTF-8','TIS-620',''),"LRB",1,'C');

$pdf->SetFont('angsa','u',11);
$pdf->cell(180,7,iconv('UTF-8','TIS-620','Accessories Record/รายการชิ้นส่วนที่นำกลับ :'),"",1,'L');
$pdf->SetFont('angsa','',11);
$pdf->cell(40,7,iconv('UTF-8','TIS-620','Rotation Unit (Spare/Replacement) Status:(รายละเอียดสถานะอุปกรณ์สำรอง)'),"LTB",0,'L');
$pdf->cell(40,7,iconv('UTF-8','TIS-620',''),"TB",0,'L');
$pdf->cell(40,7,iconv('UTF-8','TIS-620',''),"TB",0,'L');
$pdf->cell(35,7,iconv('UTF-8','TIS-620',''),"TB",0,'L');
$pdf->cell(40,7,iconv('UTF-8','TIS-620',''),"RTB",1,'L');

$pdf->cell(40,7,iconv('UTF-8','TIS-620','Description/รายละเอียด'),"LRTB",0,'C');
$pdf->cell(40,7,iconv('UTF-8','TIS-620','Product Name/หมายเลขผลิตภัณฑ์'),"LRTB",0,'C');
$pdf->cell(40,7,iconv('UTF-8','TIS-620','Serial Number/หมายเลขเครื่อง'),"LRTB",0,'C');
$pdf->cell(35,7,iconv('UTF-8','TIS-620','Qty/จำนวน'),"LRTB",0,'C');
$pdf->cell(40,7,iconv('UTF-8','TIS-620','Remark Code'),"LRTB",1,'C');

$pdf->cell(40,7,iconv('UTF-8','TIS-620',''),"LRB",0,'C');
$pdf->cell(40,7,iconv('UTF-8','TIS-620',''),"LRB",0,'C');
$pdf->cell(40,7,iconv('UTF-8','TIS-620',''),"LRB",0,'C');
$pdf->cell(35,7,iconv('UTF-8','TIS-620',''),"LRB",0,'C');
$pdf->cell(40,7,iconv('UTF-8','TIS-620',''),"LRB",1,'C');

$pdf->cell(195,7,iconv('UTF-8','TIS-620','Accessories (ชิ้นส่วนที่สำรอง/เปลี่ยนถาวร)'),"RLTB",1,'L');
$pdf->SetFont('angsa','u',11);
$pdf->cell(195,7,iconv('UTF-8','TIS-620','*Remark Code : BN = Bring back (นำกลับ), RN = Return (ส่่งคืน), RS = Return+Spare Back (ส่งคืน+นำเครื่องสำรองกลับ), BS = Spare (สำรอง), BR = Brplacement (เปลี่ยนถาวร)'),"",1,'L');

$pdf->cell(20,7,iconv('UTF-8','TIS-620','Memo (หมายเหตุ) : '),"",0,'L');
$pdf->cell(175,7,iconv('UTF-8','TIS-620',''),"B",1,'C');
$pdf->cell(70,7,'______________________________________________________________________________________________________________________________________________________',"",1,'L');
$pdf->cell(60,7,iconv('UTF-8','TIS-620','Arrived (เวลาถึง Site) Date : '),"",0,'L');
$pdf->cell(40,7,iconv('UTF-8','TIS-620','Time : '),"",0,'L');
$pdf->cell(40,7,iconv('UTF-8','TIS-620','Job Start : '),"",0,'L');
$pdf->cell(40,7,iconv('UTF-8','TIS-620','Job Finish : '),"",1,'L');


//$pdf->cell(90,7,iconv('UTF-8','TIS-620','Engineer name/ชื่อผู้ให้บริการ : '),"",0,'L');
//$pdf->cell(30,7,iconv('UTF-8','TIS-620','Date/วันที่ : '),"",0,'L');
//$pdf->cell(30,7,iconv('UTF-8','TIS-620','Time/เวลา : '),"",0,'L');
//
//$pdf->Ln();	$pdf->Ln();
//$pdf->cell(90,7,iconv('UTF-8','TIS-620','Engineer name/ชื่อผู้ให้บริการ : '),"",0,'L');
//$pdf->cell(30,7,iconv('UTF-8','TIS-620','Date/วันที่ : '),"",0,'L');
//$pdf->cell(30,7,iconv('UTF-8','TIS-620','Time/เวลา : '),"",1,'L');

$pdf->Cell(80,70,"",0,1,'');
$job_no_img = $c["job_no"].".jpg";
$pdf->Image("job_no_signature/".$job_no_img,8,8,60,8,"jpg","");	


$pdf->output("job_no/$c[job_no].pdf","F");
 

?>

<script type="text/javascript">
window.parent.location.href ="<?="job_no/$c[job_no].pdf"?>";
</script> 
