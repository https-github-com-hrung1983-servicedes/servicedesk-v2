<?
define('FPDF_FONTPATH','fpdf/font/');
require("fpdf/fpdf.php");
require("function.php");
$pdf=new FPDF('L','mm','A4');
    $pdf->AddPage();
    $pdf->AddFont('angsa','','angsa.php');
$id = $_REQUEST["id"];
$namexx ="";
//$id = 146;
$sql="SELECT
tbl_incentive_ot.id,
tbl_incentive_ot.other_no,
tbl_incentive_ot.other_date,
tbl_incentive_ot.other_receive,
tbl_incentive_ot.other_by_job,
tbl_incentive_ot.other_description,
tbl_incentive_ot.other_real_godate,
tbl_incentive_ot.other_real_backdate,
tbl_incentive_ot.other_totaldate,
tbl_incentive_ot.other_rental_day,
tbl_incentive_ot.other_rental,
tbl_incentive_ot.other_expenses_per_day,
tbl_incentive_ot.other_expenses_per,
tbl_incentive_ot.other_gas_oil,
tbl_incentive_ot.other_pay,
tbl_incentive_ot.other_pay_total,
tbl_incentive_ot.other_total,
tbl_incentive_ot.status_funds,
tbl_incentive_ot.total_funds,
tbl_incentive_ot.incentive_total,
tbl_incentive_ot.approver_id,
tbl_incentive_ot.receive_id,
tbl_incentive_ot.pay_amount,
tbl_incentive_ot.pay_real_amount,
tbl_incentive_ot.pay_return,
tbl_incentive_ot.status_check,
tbl_incentive_ot.authen_by,
tbl_user.name,
tbl_user.sname,
tbl_user.sname,
tbl_user.gasperkilo
FROM
			tbl_incentive_ot
			Inner Join tbl_user ON tbl_incentive_ot.other_receive = tbl_user.id_login
		Where tbl_incentive_ot.id =  $id";
$rs = mysqli_query($conn,$sql);
$c = mysqli_fetch_array($rs);
$other_no = $c["other_no"];
$dte_thai = dateThai($c["other_date"]);
$pdf->SetFont('angsa','',10);
//$pdf->Image("image/logo1.jpg",10,8,160,30,"jpg","");
//$pdf->cell(250,18,iconv( 'UTF-8','TIS-620','BizServ Solution Co.,Ltd'),0,1,"L",0);
//$pdf->cell(210,-10,iconv( 'UTF-8','TIS-620','55/100 ซอยลาดพร้าว 88 (อรพิน) แขวงพลับพลา เขตวังทองหลาง กรุงเทพฯ โทรศัพท์ : 02-539-3787 โทรสาร : 02-539-3786'),0,1,"L",0);
//$pdf->cell(200,16,iconv( 'UTF-8','TIS-620','55/100 Soi Ladprow 88 (Orapin), Plubpla Wangthonglang, Bangkok 10310 Tel. : 02-539-3787 Fax. : 02-539-3786'),0,1,"L",0);
$pdf->SetFont('angsa','',18);
 $pdf->Cell(300,2,iconv( 'UTF-8','TIS-620','ใบเคลียร์เบิกเงินเดินทางและค่าเบี้ยเลี้ยงต่างจังหวัด'),0,1,"C",0);
 $pdf->SetFont('angsa','',12);
$pdf->setx(250);
$pdf->Cell(300,8,iconv( 'UTF-8','TIS-620','เลขที่ : ______'.$other_no.'_______'),0,1,'');
//$pdf->Ln();
$pdf->setx(250);
$pdf->Cell(300,2,iconv( 'UTF-8','TIS-620','วันที่ :  _______'.$dte_thai.'______  '),0,1,'');
$pdf->Ln();
$pdf->Ln();

$pdf->Cell(200,8,"",0,1,'');
//$pdf->Cell(20,14,'444',"1Ú",0,'C');
$pdf->SetFont('angsa','',12);
$desciption = $c['other_description'];
$namexx = $c["name"].'  '.$c["sname"];
$other_real_godate = dateThai($c["other_real_godate"]);
$other_real_backdate = dateThai($c["other_real_backdate"]);
$other_totaldate = $c["other_totaldate"];

$pdf->cell(32,7,iconv( 'UTF-8','TIS-620','ชื่อผู้เบิก :'),"RLTB",0,'C');
$pdf->cell(160,7,$namexx,"RLTB",1,'L');
$pdf->cell(32,7,iconv( 'UTF-8','TIS-620','รายละเอียด :'),"RLTB",0,'C');
$pdf->SetFont('angsa','',12);
$pdf->cell(160,7,$desciption,"RLTB",1,'L');
$pdf->SetFont('angsa','',12);
$pdf->cell(32,7,iconv( 'UTF-8','TIS-620','วันที่เดินทางไป :'),"RLTB",0,'C');
$pdf->cell(32,7,iconv( 'UTF-8','TIS-620',$other_real_godate),"RLTB",0,'C');
$pdf->cell(32,7,iconv( 'UTF-8','TIS-620','วันที่เดินทางกลับ :'),"RLTB",0,'C');
$pdf->cell(32,7,iconv( 'UTF-8','TIS-620',$other_real_backdate),"RLTB",0,'C');
$pdf->cell(32,7,iconv( 'UTF-8','TIS-620','รวมวันเดินทาง :'),"RLTB",0,'C');
$pdf->cell(32,7,iconv( 'UTF-8','TIS-620',$other_totaldate),"RLTB",1,'C');

$pdf->Ln();
$pdf->cell(32,7,iconv( 'UTF-8','TIS-620','ลำดับที่'),"RLTB",0,'C');
$pdf->cell(96,7,iconv( 'UTF-8','TIS-620','รายละเอียด'),"RLTB",0,'C');
$pdf->cell(32,7,iconv( 'UTF-8','TIS-620','จำนวนเงินที่เบิก'),"RLTB",0,'C');
$pdf->cell(32,7,iconv( 'UTF-8','TIS-620','จำนวนเงินที่ใช้จริง'),"RLTB",0,'C');
$pdf->cell(32,7,iconv( 'UTF-8','TIS-620','เบิกเพิ่ม/เหลือคืน'),"RLTB",1,'C');

$fee_hotel = sumFeeType($id);
$fee_cnt = cntFeeType($id);
$other_rental = $c["other_rental"];
$pdf->cell(32,7,iconv( 'UTF-8','TIS-620','1.'),"RLTB",0,'C');
$pdf->cell(96,7,iconv( 'UTF-8','TIS-620','ค่าที่พักต่างจำหวัดจำนวน ___'.$c["other_rental_day"].'____  คืน ใช้จริง __'.$fee_cnt."__คืน"),"RLTB",0,'L');
$pdf->cell(32,7,iconv( 'UTF-8','TIS-620',format_moneys($other_rental)),"RLTB",0,'R');
$pdf->cell(32,7,format_moneys($fee_hotel),"RLTB",0,'R');
$pdf->cell(32,7,format_moneys($other_rental-$fee_hotel),"RLTB",1,'R');

$allowance = sumFee($id,"allowance");
$other_expenses_per = $c["other_expenses_per"];
$pdf->cell(32,7,iconv( 'UTF-8','TIS-620','2.'),"RLTB",0,'C');
$pdf->cell(96,7,iconv( 'UTF-8','TIS-620','ค่าเบี้ยเลี้ยงต่างจังหวัดจำนวน ___'.$c["other_expenses_per_day"].'____  วัน'),"RLTB",0,'L');
$pdf->cell(32,7,iconv( 'UTF-8','TIS-620',format_moneys($other_expenses_per)),"RLTB",0,'R');
$pdf->cell(32,7,format_moneys($allowance),"RLTB",0,'R');
$pdf->cell(32,7,format_moneys($other_expenses_per-$allowance),"RLTB",1,'R');

$fee_oil_gas = sumFee($id,"fee_oil_gas");
$other_gas_oil = $c["other_gas_oil"];
$pdf->cell(32,7,iconv( 'UTF-8','TIS-620','3.'),"RLTB",0,'C');
$pdf->cell(96,7,iconv( 'UTF-8','TIS-620','ค่าน้ำมันรถ หรือค่าแก็ส'),"RLTB",0,'L');
$pdf->cell(32,7,iconv( 'UTF-8','TIS-620',format_moneys($other_gas_oil)),"RLTB",0,'R');
$pdf->cell(32,7,format_moneys($fee_oil_gas) ,"RLTB",0,'R');
$pdf->cell(32,7,format_moneys($other_gas_oil-$fee_oil_gas) ,"RLTB",1,'R');

$other_fee = sumFee($id,"other_fee")+ sumFee($id,"express_position");
$other_pay_total = $c["other_pay_total"];
$pdf->cell(32,7,iconv( 'UTF-8','TIS-620','4.'),"RLTB",0,'C');
$pdf->cell(96,7,iconv( 'UTF-8','TIS-620','ค่าทางด่วน และใช้จ่ายอื่น ๆ'),"RLTB",0,'L');
$pdf->cell(32,7,iconv( 'UTF-8','TIS-620',format_moneys($other_pay_total)),"RLTB",0,'R');
$pdf->cell(32,7,format_moneys($other_fee),"RLTB",0,'R');
$pdf->cell(32,7,format_moneys($other_pay_total-$other_fee),"RLTB",1,'R');

//$incentive = sumFee($id,"incentive");
//$incentive_total = $c["incentive_total"];
//$pdf->cell(32,7,iconv( 'UTF-8','TIS-620','5.'),"RLTB",0,'C');
//$pdf->cell(96,7,iconv( 'UTF-8','TIS-620','ค่า Incentive'),"RLTB",0,'L');
//$pdf->cell(32,7,iconv( 'UTF-8','TIS-620',format_moneys($incentive_total)),"RLTB",0,'R');
//$pdf->cell(32,7,format_moneys($incentive),"RLTB",0,'R');
//$pdf->cell(32,7,format_moneys($incentive_total-$incentive),"RLTB",1,'R');

$fee_oil_gas = sumFee($id,"fee_oil_gas");
$ditstance_result = sumFee($id,"ditstance_result");
$distance_result_gps = sumFee($id,"distance_result_gps");
$distance_result_agv = sumFee($id,"distance_result_agv");
$gasperkilo = $c["gasperkilo"];
/*if($distance_result_gps==""){ */
$gas = $ditstance_result ." * ".$gasperkilo;//format_moneys($fee_oil_gas)format_moneys($fee_oil_gas)
/*
}else{
$gas = $distance_result_agv ." * ".$gasperkilo;
 }
 */
$pdf->cell(32,7,iconv( 'UTF-8','TIS-620','5.'),"RLTB",0,'C');
$pdf->cell(96,7,iconv( 'UTF-8','TIS-620','ค่าแก็สต่อกิโลเมตร'),"RLTB",0,'L');
$pdf->cell(32,7,iconv( 'UTF-8','TIS-620',$gas ),"RLTB",0,'R');
$pdf->cell(32,7,"0.00","RLTB",0,'R');
$pdf->cell(32,7,"0.00","RLTB",1,'R');

$total_pay = $fee_hotel+$allowance+$fee_oil_gas+$other_fee;//+$incentive+$fee_oil_gas

$gasperkilo = $c["gasperkilo"];
$total = $c["other_rental"]+ $c["other_gas_oil"] + $c["other_pay_total"] + $c["other_expenses_per"];
$total_all = $total - $total_pay;
$str = " เบิกเพิ่ม ";
if($total_all>0){
  $str = "เหลือคืน";
}

$pdf->cell(32,7,iconv( 'UTF-8','TIS-620','รวมเป็นเงิน   (  '. $str .' )'),"RLTB",0,'C');
$pdf->cell(96,7,iconv( 'UTF-8','TIS-620','( '.txtBahtThai($total_all).' )'),"TB",0,'C');
$pdf->cell(32,7,iconv( 'UTF-8','TIS-620',format_moneys($total)),"RLTB",0,'R');
$pdf->cell(32,7,iconv( 'UTF-8','TIS-620',format_moneys($total_pay)),"RLTB",0,'R');
$pdf->cell(32,7,iconv( 'UTF-8','TIS-620',format_moneys($total_all)),"RLTB",1,'R');

$other_expenses_per = $c["other_expenses_per"];
//////}


//$pdf->Ln();


$sql_detail = "
select distinct a.*
,b.doc, b.onsite_datetime,b.at,b.status_call
	from tbl_incentive_detail a
	left Join v_logcall b ON a.job_no = b.job_no
where
a.id = $id

order by a.seq_id
"; //echo $sql_detail;exit;
$rc_detail = mysqli_query($conn,$sql_detail);
$pdf->SetFont('angsa','',13);
$pdf->cell(0,7,iconv( 'UTF-8','TIS-620','รายละเอียดการเดินทาง'),0,1,'L');
$pdf->cell(6,7,iconv( 'UTF-8','TIS-620','#'),"RLTB",0,'C');
$pdf->cell(15,7,iconv( 'UTF-8','TIS-620','วันที่'),"RLTB",0,'C');
$pdf->cell(18,7,iconv( 'UTF-8','TIS-620','ใบงานเลขที่'),"RLTB",0,'C');
$pdf->cell(14,7,iconv( 'UTF-8','TIS-620','รหัสสถานี'),"RLTB",0,'C');
$pdf->cell(80,7,iconv( 'UTF-8','TIS-620','เริ่ม - ถึง'),"RLTB",0,'C');
//$pdf->cell(25,7,iconv( 'UTF-8','TIS-620','ถึง'),"RLTB",0,'C');
$pdf->cell(15,7,iconv( 'UTF-8','TIS-620','ไมล์เริ่ม'),"RLTB",0,'C');
$pdf->cell(15,7,iconv( 'UTF-8','TIS-620','ไมล์ถึง'),"RLTB",0,'C');
$pdf->cell(15,7,iconv( 'UTF-8','TIS-620','ไมล์รวม'),"RLTB",0,'C');
$pdf->cell(15,7,iconv( 'UTF-8','TIS-620','ค่าทางด่วน'),"RLTB",0,'C');

$pdf->cell(15,7,iconv( 'UTF-8','TIS-620','ค่าโรงแรม'),"RLTB",0,'C');
$pdf->cell(15,7,iconv( 'UTF-8','TIS-620','เบี้ยเลี้ยง'),"RLTB",0,'C');
$pdf->cell(15,7,iconv( 'UTF-8','TIS-620','Incentive'),"RLTB",0,'C');
$pdf->cell(15,7,iconv( 'UTF-8','TIS-620','ค่าแก็ส'),"RLTB",0,'C');
$pdf->cell(15,7,iconv( 'UTF-8','TIS-620','ค่าอื่นๆ'),"RLTB",1,'C');

//$pdf->cell(60,7,iconv( 'UTF-8','TIS-620','รายละเอียดของงาน'),"RLTB",1,'C');
$i = 1;
$pdf->SetFont('angsa','',11);
while($c_detail = mysqli_fetch_array($rc_detail)){
$pdf->cell(6,7,$i ,"RLTB",0,'C');
//
$str_dte = split(" ",$c_detail["onsite_datetime"]);

$location_form_substr=substr($c_detail["location_form"], 0, 20)."...";
$location_to_substr=substr($c_detail["location_to"], 0, 20)."...";

$pdf->cell(15,7,$str_dte[0],"RLTB",0,'C');
$pdf->cell(18,7,$c_detail["job_no"],"RLTB",0,'C');
$pdf->cell(14,7,$c_detail["site_id"],"RLTB",0,'C');
$pdf->cell(80,7,$location_form_substr." - ".$location_to_substr,"RLTB",0,'L');
//$pdf->cell(25,7,,"RLTB",0,'L');
$pdf->cell(15,7,$c_detail["distance_form"],"RLTB",0,'R');
$pdf->cell(15,7,$c_detail["distance_to"],"RLTB",0,'R');

$ditstance_result = $c_detail["ditstance_result"];
$pdf->cell(15,7,$ditstance_result,"RLTB",0,'R');

$express_position = $c_detail["express_position"];
$pdf->cell(15,7,format_moneys($express_position),"RLTB",0,'R');

$fee_hotel = $c_detail["fee_hotel"];
$pdf->cell(15,7,format_moneys($fee_hotel),"RLTB",0,'R');

$allowance = $c_detail["allowance"];
$pdf->cell(15,7,format_moneys($allowance),"RLTB",0,'R');

$incentive = $c_detail["incentive"];
$pdf->cell(15,7,format_moneys($incentive),"RLTB",0,'R');

$fee_oil_gas = $c_detail["fee_oil_gas"];
$pdf->cell(15,7,format_moneys($fee_oil_gas),"RLTB",0,'R');

$other_fee = $c_detail["other_fee"];
$pdf->cell(15,7,format_moneys($other_fee),"RLTB",1,'R');

$str_status = "เอกสารยังไม่ผ่านการตรวจสอบ";
if($c_detail["doc"]=="true"){
	$str_status = "เอกสารผ่านการตรวจสอบแล้ว";
}
$pdf->cell(268,7,iconv( 'UTF-8','TIS-620','รายละเอียด  :  ').$c_detail["jobdescription"]. " (".iconv( 'UTF-8','TIS-620',$str_status).")","LB",1,'L');





$total_ditstance_result  += $c_detail["ditstance_result"];
$total_express_position  += $c_detail["express_position"];
$ditstance_result_total += $ditstance_result;
$express_position_all  += $express_position;
$fee_hotel_all += $fee_hotel;
$allowance_all += $allowance;
$incentive_all += $incentive;
$fee_oil_gas_all +=	$fee_oil_gas;
$other_fee_all += $other_fee;
$i ++;
}

$ditstance = $ditstance_result_total * $gasperkilo;
$pdf->cell(133,7,iconv( 'UTF-8','TIS-620','รวมทั้งหมด (กม.) :  '),0,0,'R');
$pdf->cell(45,7,$ditstance_result_total ." * ". $gasperkilo,"LTB",0,'R');
$pdf->cell(15,7,format_moneys($express_position_all),"RLTB",0,'R');
$pdf->cell(15,7,format_moneys($fee_hotel_all),"RLTB",0,'R');
$pdf->cell(15,7,format_moneys($allowance_all),"RLTB",0,'R');
$pdf->cell(15,7,format_moneys($incentive_all),"RLTB",0,'R');
$pdf->cell(15,7,format_moneys($fee_oil_gas_all),"RLTB",0,'R');
$pdf->cell(15,7,format_moneys($other_fee_all),"RLTB",1,'R');


$pdf->SetFont('angsa','',13);
$pdf->cell(0,4,iconv( 'UTF-8','TIS-620','รายละเอียดใบเสร็จ'),0,1,'L');
$pdf->cell(20,7,iconv( 'UTF-8','TIS-620','วันที่'),"RLTB",0,'C');
$pdf->cell(17,7,iconv( 'UTF-8','TIS-620','ลำดับที่'),"RLTB",0,'C');
$pdf->cell(35,7,iconv( 'UTF-8','TIS-620','ประเภท'),"RLTB",0,'C');
$pdf->cell(100,7,iconv( 'UTF-8','TIS-620','รายละเอียด'),"RLTB",0,'C');
$pdf->cell(30,7,iconv( 'UTF-8','TIS-620','บิลเลขที่'),"RLTB",0,'C');
$pdf->cell(25,7,iconv( 'UTF-8','TIS-620','จำนวนเงิน'),"RLTB",1,'C');

$sql_settlement = "select * from tbl_incentive_ot_settlement where other_no = $id order by other_seq";
$rc_settlement = mysqli_query($conn,$sql_settlement);
$pdf->SetFont('angsa','',13);
while($c_settlement = mysqli_fetch_array($rc_settlement)){
$str = "";
  if($c_settlement["feetype"]=="1"){
       $str = "ค่าแก็ส";
	} else if($c_settlement["feetype"]=="2"){
		$str = "ค่าโรงแรม";
	} else if($c_settlement["feetype"]=="3"){
		$str = "ค่าทางด่วน";
	}else if($c_settlement["feetype"]=="4"){
		$str = "ค่าน้ำมัน";
	}else if($c_settlement["feetype"]=="5"){
		$str = "ค่าที่จอดรถ";
	}else if($c_settlement["feetype"]=="6"){
		$str = "ค่าแท็กซี่";
	}
$pdf->cell(20,7,$c_settlement["other_seq"],"RLTB",0,'C');
$pdf->cell(17,7,$c_settlement["other_dte"],"RLTB",0,'C');
$pdf->cell(35,7,iconv( 'UTF-8','TIS-620',$str),"RLTB",0,'C');
$pdf->cell(100,7,$c_settlement["bill_description"],"RLTB",0,'L');
$pdf->cell(30,7,$c_settlement["bill_no"],"RLTB",0,'C');
$pdf->cell(25,7,format_moneys($c_settlement["bill_total"]),"RLTB",1,'R');
//$pdf->cell(30,7,$c_settlement["bill_total_all"],"RLTB",1,'C');
$total_bill_total  += $c_settlement["bill_total"];
//$total_bill_total_all  += $c_settlement["bill_total_all"];
}
$pdf->cell(202,7,iconv( 'UTF-8','TIS-620','รวม :  '),0,0,'R');
$pdf->cell(25,7,format_moneys($total_bill_total),"RLTB",1,'R');
//$pdf->cell(30,7,$total_bill_total_all,"RLTB",1,'C');





if($incentive_all!="0.00"){
$pdf->Addpage("P");
$pdf->SetFont('angsa','',22);
$pdf->Cell(160,2,iconv( 'UTF-8','TIS-620','INCENTIVE REPORT'),0,1,"C",0);
$pdf->Ln();	$pdf->Ln();	$pdf->Ln();	$pdf->Ln();
$pdf->SetFont('angsa','',18);
 $pdf->Cell(160,2,iconv( 'UTF-8','TIS-620','ใบเคลียร์เบิกเงินเดินทางและค่าเบี้ยเลี้ยงต่างจังหวัด'),0,1,"C",0);
 $pdf->SetFont('angsa','',12);
$pdf->setx(160);
$pdf->Cell(160,8,iconv( 'UTF-8','TIS-620','เลขที่ : ______'.$other_no.'_______'),0,1,'');
//$pdf->Ln();
$pdf->setx(160);
$pdf->Cell(160,2,iconv( 'UTF-8','TIS-620','วันที่ :  _______'.$dte_thai.'______  '),0,1,'');
$pdf->Ln();
$pdf->Ln();

$pdf->Cell(200,8,"",0,1,'');
$pdf->SetFont('angsa','',12);

 $pdf->cell(32,7,iconv( 'UTF-8','TIS-620','ชื่อผู้เบิก :'),"RLTB",0,'C');
$pdf->cell(160,7,$namexx,"RLTB",1,'L');
$pdf->cell(32,7,iconv( 'UTF-8','TIS-620','รายละเอียด :'),"RLTB",0,'C');
$pdf->SetFont('angsa','',12);
$pdf->cell(160,7,$desciption,"RLTB",1,'L');
$pdf->SetFont('angsa','',12);
$pdf->cell(32,7,iconv( 'UTF-8','TIS-620','วันที่เดินทางไป :'),"RLTB",0,'C');
$pdf->cell(32,7,iconv( 'UTF-8','TIS-620',$other_real_godate),"RLTB",0,'C');
$pdf->cell(32,7,iconv( 'UTF-8','TIS-620','วันที่เดินทางกลับ :'),"RLTB",0,'C');
$pdf->cell(32,7,iconv( 'UTF-8','TIS-620',$other_real_backdate),"RLTB",0,'C');
$pdf->cell(32,7,iconv( 'UTF-8','TIS-620','รวมวันเดินทาง :'),"RLTB",0,'C');
$pdf->cell(32,7,iconv( 'UTF-8','TIS-620',$other_totaldate),"RLTB",1,'C');

$pdf->Ln();
$pdf->SetFont('angsa','',13);
$pdf->cell(8,7,iconv( 'UTF-8','TIS-620','#'),"RLTB",0,'C');
$pdf->cell(20,7,iconv( 'UTF-8','TIS-620','วันที่'),"RLTB",0,'C');
$pdf->cell(20,7,iconv( 'UTF-8','TIS-620','ใบงานเลขที่'),"RLTB",0,'C');
$pdf->cell(16,7,iconv( 'UTF-8','TIS-620','รหัสสถานี'),"RLTB",0,'C');
$pdf->cell(25,7,iconv( 'UTF-8','TIS-620','Incentive'),"RLTB",0,'C');
$pdf->cell(103,7,iconv( 'UTF-8','TIS-620','รายละเอียดของงาน'),"RLTB",1,'C');
$sql_incentive = "select * from tbl_incentive_detail where id = $id order by seq_id"; //echo $sql_detail;exit;
$rc_incentive = mysqli_query($conn,$sql_incentive);
$i_inctv = 0;
while($c_incentive = mysqli_fetch_array($rc_incentive)){
$i_inctv++;
$incentive_alll += $incentive;
$pdf->cell(8,7,$i_inctv,"RLTB",0,'C');
$pdf->cell(20,7,$c_incentive["dte"],"RLTB",0,'C');
$pdf->cell(20,7,$c_incentive["job_no"],"RLTB",0,'C');
$pdf->cell(16,7,$c_incentive["site_id"],"RLTB",0,'C');
$incentive = $c_incentive["incentive"];
$pdf->cell(25,7,format_moneys($incentive),"RLTB",0,'R');

$pdf->cell(103,7,$c_incentive["jobdescription"],"RLTB",1,'L');
}
$pdf->cell(64,7,iconv( 'UTF-8','TIS-620','รวมเป็นเงิน (บาท) :  '),"RLTB",0,'R');
$pdf->cell(25,7,format_moneys($incentive_alll ),"RLTB",1,'R');
$pdf->Ln();
}

$pdf->output("$id.pdf","F");



function sumFee($id,$feetype){
	global $conn;
$fee = "0.00";
//$sql = "select sum($feetype) as fee from tbl_incentive_detail where id='$id'";
$sql = "select distinct tbl_incentive_detail.*,tbl_log_call_center.doc
	from tbl_incentive_detail
	left Join tbl_log_call_center ON tbl_incentive_detail.site_id = tbl_log_call_center.site_id AND tbl_incentive_detail.job_no = tbl_log_call_center.job_no AND tbl_incentive_detail.dte = tbl_log_call_center.closed_date
					    where tbl_incentive_detail.id = $id order by seq_id";
$rc = mysqli_query($conn,$sql);
	while($c=mysqli_fetch_array($rc)){
		$fee += $c[$feetype];
	}
return $fee;
}

function sumFeeType($id){
	global $conn;
	$fee = "0.00";
$sql = "select sum(bill_total) as fee from tbl_incentive_ot_settlement where other_no='$id' and feetype = '2'";
$rc = mysqli_query($conn,$sql);
	while($c=mysqli_fetch_array($rc)){
		$fee = $c["fee"];
	}
return $fee;
}

function cntFeeType($id){
	global $conn;
	$fee = "0.00";
$sql = "select count(bill_total) as cnt from tbl_incentive_ot_settlement where other_no='$id' and feetype = '2'";
$rc = mysqli_query($conn,$sql);
	while($c=mysqli_fetch_array($rc)){
		$fee = $c["cnt"];
	}
return $fee;
}


?>




<script type="text/javascript">
window.parent.location.href ="<?=$id?>.pdf";
</script>
