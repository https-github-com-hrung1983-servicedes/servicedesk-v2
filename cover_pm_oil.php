<?
define('FPDF_FONTPATH','fpdf/font/');
require("fpdf/fpdf.php");
require("function.php");                    
                     
$pdf=new FPDF('P','mm','A4');
    $pdf->AddPage();
    $pdf->AddFont('angsa','','angsa.php');                                                                                                             
                                                                     
    $sql="SELECT * FROM rpt_pm_pos_ngv";
$rc=mysqli_query($conn,$sql);    
while($c=mysqli_fetch_array($rc)){
    $pdf->SetFont('angsa','',45);
	//$pdf->cell(190,10,"xxx",1,1,"C");
	//$pdf->Ln();
	$pdf->cell(190,10,"",0,1,"C");
	$pdf->Ln();
	$pdf->cell(190,10,iconv( 'UTF-8','TIS-620','เอกสารส่งมอบงาน'),0,1,"C",0);	
	$pdf->Ln();
    $pdf->Cell(190,10,iconv( 'UTF-8','TIS-620','(PTTICT)'),0,1,"C",0);
	$pdf->Ln();$pdf->Ln();$pdf->Ln();$pdf->Ln();$pdf->Ln();$pdf->Ln();
    $pdf->SetFont('angsa','',29);
	$str = split("\(",$c["site_name_old"]); 
    $pdf->Cell(190,10,$str[0],0,1,"C",0);
	$pdf->Ln();
	if($str[1]!=""){
		 $pdf->Cell(190,10,"(".$str[1],0,1,"C",0);
		$pdf->Ln();
	}
    $pdf->Cell(190,10,$c["site_id"],0,1,"C",0);
	$pdf->Ln();$pdf->Ln();$pdf->Ln();$pdf->Ln();$pdf->Ln();$pdf->Ln();
	$pdf->SetFont('angsa','',38);
    $pdf->Cell(0,10,iconv( 'UTF-8','TIS-620','PM (POS NGV)'),0,1,"C");
	$pdf->Ln();
    $pdf->Cell(0,10,iconv( 'UTF-8','TIS-620','เดือนมิถุนายน 2555'),0,1,"C");                                                                          
	$pdf->Ln();
$pdf->SetAutoPageBreak(true);   
$pdf->Addpage("P");
}                                        
                                                                                  
$pdf->output();      
?>
