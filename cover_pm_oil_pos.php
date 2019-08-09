<?
//echo "adsfasd";exit;  0865924278 ¨ÐàÍë ¢ÒÂ
define('FPDF_FONTPATH','fpdf/font/');
require("fpdf/fpdf.php");
require("function.php");                    
$dte = $_REQUEST["dte"];    
$d = split("-",$dte);

$pdf=new FPDF('P','mm','A4');
    $pdf->AddPage();
    $pdf->AddFont('angsa','','angsa.php');                                                                                                             
                                                                     
    $sql="select 
	`tbl_log_call_center`.`site_id` AS `site_id`,
	`tbl_station_ngv`.`site_name` AS `site_name` 
	from `tbl_log_call_center`
	join `tbl_station_ngv` on `tbl_log_call_center`.`site_id` = `tbl_station_ngv`.`site_id`
	where `tbl_log_call_center`.`category_type` = '5' 
	and `tbl_log_call_center`.`status_call` = 'close'
	and `tbl_log_call_center`.`open_call_dte` like '$dte%'
	order by `tbl_log_call_center`.`open_call_dte`";
//echo $sql;exit;
$rc=mysqli_query($conn,$sql);    
while($c=mysqli_fetch_array($rc)){
    $pdf->SetFont('angsa','',45);
	//$pdf->cell(190,10,"xxx",1,1,"C");    http://192.168.2.22/helpdeskbss/Index1.php
	//$pdf->Ln();
	$pdf->cell(190,10,"",0,1,"C");
	$pdf->Ln();
	$pdf->cell(190,10,iconv( 'UTF-8','TIS-620','เอกสารส่งมอบงาน'),0,1,"C",0);	
	$pdf->Ln();
    $pdf->Cell(190,10,iconv( 'UTF-8','TIS-620','(PTTICT)'),0,1,"C",0);
	$pdf->Ln();$pdf->Ln();$pdf->Ln();$pdf->Ln();$pdf->Ln();$pdf->Ln();
    $pdf->SetFont('angsa','',29);
	$str = split("\(",$c["site_name"]); 
    $pdf->Cell(190,10,iconv( 'UTF-8','TIS-620','สถานีบริการ NGV').$str[0],0,1,"C",0);
	$pdf->Ln();
	if($str[1]!=""){
		 $pdf->Cell(190,10,"(".$str[1],0,1,"C",0);
		$pdf->Ln();
	}
    $pdf->Cell(190,10,iconv( 'UTF-8','TIS-620','รหัสสถานี ').$c["site_id"],0,1,"C",0);
	$pdf->Ln();$pdf->Ln();$pdf->Ln();$pdf->Ln();$pdf->Ln();$pdf->Ln();
	$pdf->SetFont('angsa','',38);
    $pdf->Cell(0,10,getDescriptionJob("7"),0,1,"C");
	$pdf->Ln();
    $pdf->Cell(0,10,iconv( 'UTF-8','TIS-620','เดือน '.$thaimonth[$d[1]]." ".($d[0]+543)),0,1,"C");                                                                          
	$pdf->Ln();
$pdf->SetAutoPageBreak(true);   
$pdf->Addpage("P");
}                                        
                                                                                  
$pdf->output();      
?>
