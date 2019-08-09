<?
//echo "eee";exit;
define('FPDF_FONTPATH','fpdf/font/');
require("fpdf/fpdf.php");
require("function.php");                    
                     
$pdf=new FPDF('P','mm','A4');
    $pdf->AddPage();
    $pdf->AddFont('angsa','','angsa.php');    
$id=$_REQUEST["id"];
$sql="SELECT
						tbl_incentive_ot.*,
						tbl_user_login.name,
						tbl_user_login.sname
		FROM
			tbl_incentive_ot
			Inner Join tbl_user_login ON tbl_incentive_ot.other_receive = tbl_user_login.user_bss_id 
		Where tbl_incentive_ot.id =  $id"; 
$rs = mysqli_query($conn,$sql);
while($c = mysqli_fetch_array($rs)){  
$pdf->SetFont('angsa','',10);
$pdf->Image("image/logo.jpg",10,8,20,10,"jpg","");
$pdf->cell(250,18,iconv( 'UTF-8','TIS-620','BizServ Solution Co.,Ltd'),0,1,"L",0);
$pdf->cell(210,-10,iconv( 'UTF-8','TIS-620','55/100 ซอยลาดพร้าว 88 (อรพิน) แขวงพลับพลา เขตวังทองหลาง กรุงเทพฯ โทรศัพท์ : 02-539-3786 โทรสาร : 02-539-3786'),0,1,"L",0);
$pdf->cell(200,18,iconv( 'UTF-8','TIS-620','55/100 Soi Ladprow 88 (Orapin), Plubpla Wangthonglang, Bangkok 10310 Tel. : 02-539-3786 Fax. : 02-539-3786'),0,1,"L",0);
$pdf->SetFont('angsa','',18);
 $pdf->Cell(200,10,iconv( 'UTF-8','TIS-620','ใบเบิกเงินเดินทางและค่าเบี้ยเลี้ยงต่างจังหวัด'),0,1,"C",0);  
 $pdf->SetFont('angsa','',12);
$pdf->setx(160);
$pdf->Cell(170,8,iconv( 'UTF-8','TIS-620','เลขที่ : ______'.$c["other_no"].'_______'),0,0,'');
$pdf->Ln();
$pdf->setx(160);
$pdf->Cell(200,8,iconv( 'UTF-8','TIS-620','วันที่ :  _______'.dateThai($c["other_date"]).'______  '),0,1,'');

$pdf->Cell(200,8,"",0,1,'');
//$pdf->Cell(20,14,'444',"1Ú",0,'C');
$pdf->SetFont('angsa','',12);
$desciption = $c['other_description'];
 $pdf->cell(32,7,iconv( 'UTF-8','TIS-620','ชื่อผู้เบิก :'),"RLTB",0,'C');
$pdf->cell(160,7,iconv( 'UTF-8','TIS-620',$c["name"].'  '.$c["sname"]),"RLTB",1,'L');
$pdf->cell(32,7,iconv( 'UTF-8','TIS-620','รายละเอียด :'),"RLTB",0,'C');
$pdf->SetFont('angsa','',12);
$pdf->cell(160,7,$desciption,"RLTB",1,'L');
$pdf->SetFont('angsa','',12);
$pdf->cell(32,7,iconv( 'UTF-8','TIS-620','วันที่เดินทางไป :'),"RLTB",0,'C');
$pdf->cell(32,7,iconv( 'UTF-8','TIS-620',dateThai($c["other_real_godate"])),"RLTB",0,'C');
$pdf->cell(32,7,iconv( 'UTF-8','TIS-620','วันที่เดินทางกลับ :'),"RLTB",0,'C');
$pdf->cell(32,7,iconv( 'UTF-8','TIS-620',dateThai($c["other_real_backdate"])),"RLTB",0,'C');
$pdf->cell(32,7,iconv( 'UTF-8','TIS-620','รวมวันเดินทาง :'),"RLTB",0,'C');
$pdf->cell(32,7,iconv( 'UTF-8','TIS-620',$c["other_totaldate"]),"RLTB",1,'C');

$pdf->Ln();
$pdf->cell(32,7,iconv( 'UTF-8','TIS-620','ลำดับที่'),"RLTB",0,'C');
$pdf->cell(96,7,iconv( 'UTF-8','TIS-620','รายละเอียด'),"RLTB",0,'C');
$pdf->cell(32,7,iconv( 'UTF-8','TIS-620','จำนวนเงิน'),"RLTB",0,'C');
$pdf->cell(32,7,iconv( 'UTF-8','TIS-620','จำนวนเงินรวม'),"RLTB",1,'C');

$pdf->cell(32,7,iconv( 'UTF-8','TIS-620','1.'),"RLTB",0,'C');
$pdf->cell(96,7,iconv( 'UTF-8','TIS-620','ค่าที่พักต่างจำหวัดจำนวน ___'.$c["other_rental_day"].'____  คืน'),"RLTB",0,'L');
$pdf->cell(32,7,iconv( 'UTF-8','TIS-620',format_moneys($c["other_rental"])),"RLTB",0,'C');
$pdf->cell(32,7,iconv( 'UTF-8','TIS-620',format_moneys($c["other_rental"])),"RLTB",1,'C');

$pdf->cell(32,7,iconv( 'UTF-8','TIS-620','2.'),"RLTB",0,'C');
$pdf->cell(96,7,iconv( 'UTF-8','TIS-620','ค่าเบี้ยเลี้ยงต่างจังหวัดจำนวน ___'.$c["other_expenses_per_day"].'____  วัน'),"RLTB",0,'L');
$pdf->cell(32,7,iconv( 'UTF-8','TIS-620',format_moneys($c["other_expenses_per"])),"RLTB",0,'C');
$pdf->cell(32,7,iconv( 'UTF-8','TIS-620',format_moneys($c["other_expenses_per"])),"RLTB",1,'C');

$pdf->cell(32,7,iconv( 'UTF-8','TIS-620','3.'),"RLTB",0,'C');
$pdf->cell(96,7,iconv( 'UTF-8','TIS-620','ค่าน้ำมันรถ หรือค่าแก็ส'),"RLTB",0,'L');
$pdf->cell(32,7,iconv( 'UTF-8','TIS-620',format_moneys($c["other_gas_oil"])),"RLTB",0,'C');
$pdf->cell(32,7,iconv( 'UTF-8','TIS-620',format_moneys($c["other_gas_oil"])),"RLTB",1,'C');

$pdf->cell(32,7,iconv( 'UTF-8','TIS-620','4.'),"RLTB",0,'C');
$pdf->cell(96,7,iconv( 'UTF-8','TIS-620','ค่าใช้จ่ายอื่น ๆ'),"RLTB",0,'L');
$pdf->cell(32,7,iconv( 'UTF-8','TIS-620',format_moneys($c["other_pay_total"])),"RLTB",0,'C');
$pdf->cell(32,7,iconv( 'UTF-8','TIS-620',format_moneys($c["other_pay_total"])),"RLTB",1,'C');

//$pdf->cell(32,7,iconv( 'UTF-8','TIS-620','5.'),"RLTB",0,'C');
//$pdf->cell(96,7,iconv( 'UTF-8','TIS-620','ค่า Incentive'),"RLTB",0,'L');
//$pdf->cell(32,7,iconv( 'UTF-8','TIS-620',format_moneys($c["incentive_total"])),"RLTB",0,'C');
//$pdf->cell(32,7,iconv( 'UTF-8','TIS-620',format_moneys($c["incentive_total"])),"RLTB",1,'C');

$pdf->cell(32,7,iconv( 'UTF-8','TIS-620','5.'),"RLTB",0,'C');
$pdf->cell(96,7,iconv( 'UTF-8','TIS-620','ค่าแก็สต่อกิโลเมตร'),"RLTB",0,'L');
$pdf->cell(32,7,iconv( 'UTF-8','TIS-620',format_moneys($c["gasperkilo"])),"RLTB",0,'C');
$pdf->cell(32,7,iconv( 'UTF-8','TIS-620',format_moneys($c["gasperkilo"])),"RLTB",1,'C');


$total = $c["other_rental"]+ $c["other_gas_oil"] + $c["other_pay_total"]+$c["other_expenses_per"];
$pdf->cell(32,7,iconv( 'UTF-8','TIS-620','รวมเป็นเงิน   :  '),"LTB",0,'C');
$pdf->cell(96,7,iconv( 'UTF-8','TIS-620','( '.txtBahtThai($total).' )'),"TB",0,'C');
$pdf->cell(32,7,iconv( 'UTF-8','TIS-620',''),"TB",0,'C');
$pdf->cell(32,7,iconv( 'UTF-8','TIS-620',format_moneys($total)),"RLTB",1,'C');



$pdf->Ln();
$pdf->cell(120,7,'',"",1,'C');
$pdf->cell(60,7,'__________________________',"",0,'C');
$pdf->cell(73,7,'__________________________',"",0,'C');
$pdf->cell(75,7,'__________________________',"",1,'C');

$pdf->cell(60,7,'(_________________________)',"",0,'C');
$pdf->cell(73,7,'(_________________________)',"",0,'C');
$pdf->cell(75,7,'(_________________________)',"",1,'C');

$pdf->cell(60,7,iconv( 'UTF-8','TIS-620','ผู้ขอเบิก'),"",0,'C');
$pdf->cell(73,7,iconv( 'UTF-8','TIS-620','ผู้ตรวจสอบ'),"",0,'C');
$pdf->cell(75,7,iconv( 'UTF-8','TIS-620','ผู้อนุมัติ'),"",1,'C');

$pdf->cell(60,7,iconv( 'UTF-8','TIS-620','วันที่___/___/______'),"",0,'C');
$pdf->cell(73,7,iconv( 'UTF-8','TIS-620','วันที่___/___/______'),"",0,'C');
$pdf->cell(75,7,iconv( 'UTF-8','TIS-620','วันที่___/___/______'),"",1,'C');

$pdf->Ln();$pdf->Ln();
$pdf->cell(100,7,'__________________________',"",0,'C');
$pdf->cell(130,7,'__________________________',"",1,'C');
$pdf->cell(100,7,'(_________________________)',"",0,'C');
$pdf->cell(130,7,'(_________________________)',"",1,'C');
$pdf->cell(100,7,iconv( 'UTF-8','TIS-620','ผู้รับเงิน'),"",0,'C');
$pdf->cell(130,7,iconv( 'UTF-8','TIS-620','ผู้จ่ายเงิน'),"",1,'C');
$pdf->cell(100,7,iconv( 'UTF-8','TIS-620','วันที่___/___/______'),"",0,'C');
$pdf->cell(130,7,iconv( 'UTF-8','TIS-620','วันที่___/___/______'),"",1,'C');

}       


$pdf->AddPage();  

$sql="SELECT
						tbl_incentive_ot.*,
						tbl_user_login.name,
						tbl_user_login.sname
		FROM
			tbl_incentive_ot
			Inner Join tbl_user_login ON tbl_incentive_ot.other_receive = tbl_user_login.user_bss_id 
		Where tbl_incentive_ot.id =  ".$_REQUEST["id"]; 
$rs = mysqli_query($conn,$sql);
while($c = mysqli_fetch_array($rs)){  
$pdf->SetFont('angsa','',10);
$pdf->Image("image/logo.jpg",10,8,20,10,"jpg","");
$pdf->cell(250,18,iconv( 'UTF-8','TIS-620','BizServ Solution Co.,Ltd'),0,1,"L",0);
$pdf->cell(210,-10,iconv( 'UTF-8','TIS-620','55/100 ซอยลาดพร้าว 88 (อรพิน) แขวงพลับพลา เขตวังทองหลาง กรุงเทพฯ โทรศัพท์ : 02-539-3786 โทรสาร : 02-539-3786'),0,1,"L",0);
$pdf->cell(200,18,iconv( 'UTF-8','TIS-620','55/100 Soi Ladprow 88 (Orapin), Plubpla Wangthonglang, Bangkok 10310 Tel. : 02-539-3786 Fax. : 02-539-3786'),0,1,"L",0);
$pdf->SetFont('angsa','',18);
 $pdf->Cell(200,10,iconv( 'UTF-8','TIS-620','ใบเบิกเงินเดินทางและค่าเบี้ยเลี้ยงต่างจังหวัด'),0,1,"C",0);  
 $pdf->SetFont('angsa','',12);
$pdf->setx(160);
$pdf->Cell(170,8,iconv( 'UTF-8','TIS-620','เลขที่ : ______'.$c["other_no"].'_______'),0,0,'');
$pdf->Ln();
$pdf->setx(160);
$pdf->Cell(200,8,iconv( 'UTF-8','TIS-620','วันที่ :  _______'.dateThai($c["other_date"]).'______  '),0,1,'');

$pdf->Cell(200,8,"",0,1,'');
//$pdf->Cell(20,14,'444',"1Ú",0,'C');
$pdf->SetFont('angsa','',12);
$desciption = $c['other_description'];
 $pdf->cell(32,7,iconv( 'UTF-8','TIS-620','ชื่อผู้เบิก :'),"RLTB",0,'C');
$pdf->cell(160,7,iconv( 'UTF-8','TIS-620',$c["name"].'  '.$c["sname"]),"RLTB",1,'L');
$pdf->cell(32,7,iconv( 'UTF-8','TIS-620','รายละเอียด :'),"RLTB",0,'C');
$pdf->SetFont('angsa','',12);
$pdf->cell(160,7,$desciption,"RLTB",1,'L');
$pdf->SetFont('angsa','',12);
$pdf->cell(32,7,iconv( 'UTF-8','TIS-620','วันที่เดินทางไป :'),"RLTB",0,'C');
$pdf->cell(32,7,iconv( 'UTF-8','TIS-620',dateThai($c["other_real_godate"])),"RLTB",0,'C');
$pdf->cell(32,7,iconv( 'UTF-8','TIS-620','วันที่เดินทางกลับ :'),"RLTB",0,'C');
$pdf->cell(32,7,iconv( 'UTF-8','TIS-620',dateThai($c["other_real_backdate"])),"RLTB",0,'C');
$pdf->cell(32,7,iconv( 'UTF-8','TIS-620','รวมวันเดินทาง :'),"RLTB",0,'C');
$pdf->cell(32,7,iconv( 'UTF-8','TIS-620',$c["other_totaldate"]),"RLTB",1,'C');

$pdf->Ln();
$pdf->cell(32,7,iconv( 'UTF-8','TIS-620','ลำดับที่'),"RLTB",0,'C');
$pdf->cell(96,7,iconv( 'UTF-8','TIS-620','รายละเอียด'),"RLTB",0,'C');
$pdf->cell(32,7,iconv( 'UTF-8','TIS-620','จำนวนเงิน'),"RLTB",0,'C');
$pdf->cell(32,7,iconv( 'UTF-8','TIS-620','จำนวนเงินรวม'),"RLTB",1,'C');

$pdf->cell(32,7,iconv( 'UTF-8','TIS-620','1.'),"RLTB",0,'C');
$pdf->cell(96,7,iconv( 'UTF-8','TIS-620','ค่าที่พักต่างจำหวัดจำนวน ___'.$c["other_rental_day"].'____  คืน'),"RLTB",0,'L');
$pdf->cell(32,7,iconv( 'UTF-8','TIS-620',format_moneys($c["other_rental"])),"RLTB",0,'C');
$pdf->cell(32,7,iconv( 'UTF-8','TIS-620',format_moneys($c["other_rental"])),"RLTB",1,'C');

$pdf->cell(32,7,iconv( 'UTF-8','TIS-620','2.'),"RLTB",0,'C');
$pdf->cell(96,7,iconv( 'UTF-8','TIS-620','ค่าเบี้ยเลี้ยงต่างจังหวัดจำนวน ___'.$c["other_expenses_per_day"].'____  วัน'),"RLTB",0,'L');
$pdf->cell(32,7,iconv( 'UTF-8','TIS-620',format_moneys($c["other_expenses_per"])),"RLTB",0,'C');
$pdf->cell(32,7,iconv( 'UTF-8','TIS-620',format_moneys($c["other_expenses_per"])),"RLTB",1,'C');

$pdf->cell(32,7,iconv( 'UTF-8','TIS-620','3.'),"RLTB",0,'C');
$pdf->cell(96,7,iconv( 'UTF-8','TIS-620','ค่าน้ำมันรถ หรือค่าแก็ส'),"RLTB",0,'L');
$pdf->cell(32,7,iconv( 'UTF-8','TIS-620',format_moneys($c["other_gas_oil"])),"RLTB",0,'C');
$pdf->cell(32,7,iconv( 'UTF-8','TIS-620',format_moneys($c["other_gas_oil"])),"RLTB",1,'C');

$pdf->cell(32,7,iconv( 'UTF-8','TIS-620','4.'),"RLTB",0,'C');
$pdf->cell(96,7,iconv( 'UTF-8','TIS-620','ค่าใช้จ่ายอื่น ๆ'),"RLTB",0,'L');
$pdf->cell(32,7,iconv( 'UTF-8','TIS-620',format_moneys($c["other_pay_total"])),"RLTB",0,'C');
$pdf->cell(32,7,iconv( 'UTF-8','TIS-620',format_moneys($c["other_pay_total"])),"RLTB",1,'C');

$pdf->cell(32,7,iconv( 'UTF-8','TIS-620','5.'),"RLTB",0,'C');
$pdf->cell(96,7,iconv( 'UTF-8','TIS-620','ค่า Incentive'),"RLTB",0,'L');
$pdf->cell(32,7,iconv( 'UTF-8','TIS-620',format_moneys($c["incentive_total"])),"RLTB",0,'C');
$pdf->cell(32,7,iconv( 'UTF-8','TIS-620',format_moneys($c["incentive_total"])),"RLTB",1,'C');

$pdf->cell(32,7,iconv( 'UTF-8','TIS-620','6.'),"RLTB",0,'C');
$pdf->cell(96,7,iconv( 'UTF-8','TIS-620','ค่าแก็สต่อกิโลเมตร'),"RLTB",0,'L');
$pdf->cell(32,7,iconv( 'UTF-8','TIS-620',format_moneys($c["gasperkilo"])),"RLTB",0,'C');
$pdf->cell(32,7,iconv( 'UTF-8','TIS-620',format_moneys($c["gasperkilo"])),"RLTB",1,'C');


$total = $c["other_rental"]+ $c["other_gas_oil"] + $c["other_pay_total"]+$c["other_expenses_per"];
$pdf->cell(32,7,iconv( 'UTF-8','TIS-620','รวมเป็นเงิน   :  '),"LTB",0,'C');
$pdf->cell(96,7,iconv( 'UTF-8','TIS-620','( '.txtBahtThai($total).' )'),"TB",0,'C');
$pdf->cell(32,7,iconv( 'UTF-8','TIS-620',''),"TB",0,'C');
$pdf->cell(32,7,iconv( 'UTF-8','TIS-620',format_moneys($total)),"RLTB",1,'C');



$pdf->Ln();
$pdf->cell(120,7,'',"",1,'C');
$pdf->cell(60,7,'__________________________',"",0,'C');
$pdf->cell(73,7,'__________________________',"",0,'C');
$pdf->cell(75,7,'__________________________',"",1,'C');

$pdf->cell(60,7,'(_________________________)',"",0,'C');
$pdf->cell(73,7,'(_________________________)',"",0,'C');
$pdf->cell(75,7,'(_________________________)',"",1,'C');

$pdf->cell(60,7,iconv( 'UTF-8','TIS-620','ผู้ขอเบิก'),"",0,'C');
$pdf->cell(73,7,iconv( 'UTF-8','TIS-620','ผู้ตรวจสอบ'),"",0,'C');
$pdf->cell(75,7,iconv( 'UTF-8','TIS-620','ผู้อนุมัติ'),"",1,'C');

$pdf->cell(60,7,iconv( 'UTF-8','TIS-620','วันที่___/___/______'),"",0,'C');
$pdf->cell(73,7,iconv( 'UTF-8','TIS-620','วันที่___/___/______'),"",0,'C');
$pdf->cell(75,7,iconv( 'UTF-8','TIS-620','วันที่___/___/______'),"",1,'C');

$pdf->Ln();$pdf->Ln();
$pdf->cell(100,7,'__________________________',"",0,'C');
$pdf->cell(130,7,'__________________________',"",1,'C');
$pdf->cell(100,7,'(_________________________)',"",0,'C');
$pdf->cell(130,7,'(_________________________)',"",1,'C');
$pdf->cell(100,7,iconv( 'UTF-8','TIS-620','ผู้รับเงิน'),"",0,'C');
$pdf->cell(130,7,iconv( 'UTF-8','TIS-620','ผู้จ่ายเงิน'),"",1,'C');
$pdf->cell(100,7,iconv( 'UTF-8','TIS-620','วันที่___/___/______'),"",0,'C');
$pdf->cell(130,7,iconv( 'UTF-8','TIS-620','วันที่___/___/______'),"",1,'C');

}  

$pdf->output("$id.pdf","F");
?>

<script type="text/javascript">
window.parent.location.href ="<?=$id?>.pdf";
</script>



