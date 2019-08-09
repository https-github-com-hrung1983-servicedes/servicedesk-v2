<?
header("Content-Type: text/html; charset=tis-620");                 
session_start();

    require_once("function.php");                                         
  
  if(!checkUser()){    echo Message(35,"red",$titel1,$msg1,"<a href='index.php?link=generate2excel'> $login </a>");
  exit;
  }                                                                                                      
// include("header.php");   
$types_site = $_REQUEST["types_site"];
$months = $_REQUEST["months"];
$years = $_REQUEST["years"];
$dte = $years."-".$months;//echo $dte;exit;
header('Content-type: application/csv');
//echo $types_site;
if ($types_site=="CMPOSNGV") {     
		$name = "Content-Disposition: attachment; filename='CMPOSNGV_".$months."-".$years.".csv';sheet1='xx'";
		header($name); 
		POSCMNGV($years,$months,"BSS",$dte,"8");
		POSCMNGV($years,$months,"SDC",$dte,"8");
		POSCMNGV($years,$months,"BSS",$dte,"9");
		POSCMNGV($years,$months,"SDC",$dte,"9"); 
	} else if ($types_site=="CMPOSOil"){
		$name = "Content-Disposition: attachment; filename='CMPOSOil_".$months."-".$years.".csv';sheet1='xx'";
	    header($name); 
		POSCMOil($years,$months,"BSS",$dte,"1");
		POSCMOil($years,$months,"SDC",$dte,"1");
	} else if ($types_site=="PMPOSNGV"){
		$name = "Content-Disposition: attachment; filename='PMPOSNGV_".$months."-".$years.".csv';sheet1='xx'";
		header($name); 
		POSPMOil($years,$months,"BSS",$dte,"18");
	}else if ($types_site=="PMPOSOil"){  
		$name = "Content-Disposition: attachment; filename='PMPOSOil_".$months."-".$years.".csv';";
		header($name); 
	
	}

	function POSCMNGV($years,$months,$type_service,$close_dte,$cat_id){
		global $conn;
		$sql = "Select 
		            tbl_log_call_center.site_id,
                     tbl_station_ngv.site_name_new,
                     tbl_station_ngv.site_name_old,
                     tbl_station_ngv.pos,
                     tbl_log_call_center.job_no,
                     tbl_log_call_center.open_call_dte,
                     tbl_log_call_center.closed_date,
                     tbl_log_call_center.problem,
                     tbl_log_call_center.problem_solving,
                     tbl_log_call_center.status_call,
                     tbl_log_call_center.status_sla,
                     tbl_log_call_center.type_service
                     FROM
                     tbl_log_call_center
                     Inner Join tbl_station_ngv ON tbl_log_call_center.site_id = tbl_station_ngv.site_id
                     Where tbl_log_call_center.type_service = '$type_service'
                     And tbl_log_call_center.closed_date like '$close_dte%'
                     And tbl_log_call_center.category_type = '$cat_id'
                     Order by tbl_log_call_center.open_call_dte ASC";
					 if($cat_id==8){
							echo "Per Call (POS NGV) เดือน ".$months ."  ".$years;
					 } else {
						echo "เหมาจ่าย (POS NGV) เดือน ".$months ."  ".$years;
					 }
		echo "\nSITE_ID,SITE_NAME,POS No.,เลขที่ใบงาน,Open_Date,Finish_Date,Problem,Solution,ค่าอะไหล่(บาท),ค่าบริการ(บาท),ค่าเดินทาง(บาท),Total,หมายเหตุ,สถานะ,ผู้รับผิดชอบ\n";
		//echo $sql;exit;
		$rc = mysqli_query($conn,$sql);
				while($c= mysqli_fetch_array($rc)){
				echo "$c[site_id], $c[site_name_new] - $c[site_name_old],$c[pos],$c[job_no],$c[open_call_dte],$c[closed_date],$c[problem],$c[problem_solving],$c[pay],0,0,$c[pay],$c[status_sla],$c[status_call],$c[type_service]\n";
				}
				echo "\n\n\n\n";
	}

	function POSCMOil($years,$months,$type_service,$close_dte,$cat_id){
		global $conn;
		$sql = "Select
                      tbl_log_call_center.site_id,
                      tbl_station_oil.site_name,
                      tbl_log_call_center.job_no,
                      tbl_station_oil.site_type,
                      tbl_log_call_center.open_call_dte,
                      tbl_log_call_center.closed_date,
                      tbl_log_call_center.problem,
                      tbl_log_call_center.problem_solving,
					  tbl_log_call_center.status_call,
                     tbl_log_call_center.status_sla,
                     tbl_log_call_center.type_service
                      FROM
                      tbl_log_call_center
                      Inner Join tbl_station_oil ON tbl_log_call_center.site_id = tbl_station_oil.station_id
                      Where tbl_log_call_center.type_service = '$type_service'
                      And tbl_log_call_center.closed_date like '$close_dte%'
                      And tbl_log_call_center.category_type = '$cat_id'
                      Order by tbl_log_call_center.open_call_dte ASC";    //echo $sql;//exit;	
		echo "เหมาจ่าย (POS Oil) เดือน ".$months ."  ".$years;			
		echo "\nSITE_ID,SITE_NAME,POS No.,เลขที่ใบงาน,Open_Date,Finish_Date,Problem,Solution,ค่าอะไหล่(บาท),ค่าบริการ(บาท),ค่าเดินทาง(บาท),Total,หมายเหตุ,สถานะ,ผู้รับผิดชอบ\n";
	
		$rc = mysqli_query($conn,$sql);
				while($c= mysqli_fetch_array($rc)){
				echo "$c[site_id], $c[site_name],$c[job_no],$c[site_type],$c[open_call_dte],$c[closed_date],$c[problem],$c[problem_solving],$c[pay],0,0,0,$c[status_sla],$c[status_call],$c[type_service]\n";
				}
				echo "\n\n\n\n";
	}

	function POSPMOil($years,$months,$type_service,$close_dte,$cat_id){
		global $conn;
		$sql = "SELECT
							tbl_log_call_center.site_id,
							tbl_log_call_center.job_no,
							tbl_log_call_center.open_call_dte,
							tbl_log_call_center.problem,
							tbl_log_call_center.problem_solving,
							tbl_user.name,
							tbl_station_oil.site_name,
							tbl_log_call_center.status_call,
							tbl_log_call_center.status_sla,
							tbl_log_call_center.type_service,
							tbl_log_call_center.closed_date
					 FROM
							tbl_log_call_center
							Inner Join tbl_user ON tbl_log_call_center.reciept_job_user_id = tbl_user.user_id
							Inner Join tbl_station_oil ON tbl_log_call_center.site_id = tbl_station_oil.station_id
						Where tbl_log_call_center.type_service = '$type_service'
						And tbl_log_call_center.category_type = '$cat_id' 
						And tbl_log_call_center.open_call_dte like '$close_dte%'
						Order by tbl_log_call_center.open_call_dte";   // echo $sql;
		echo "เหมาจ่าย (POS Oil) เดือน ".$months ."  ".$years;			
		echo "\nSITE_ID,SITE_NAME,เลขที่ใบงาน,Open_Date,Finish_Date,Problem,Solution,ค่าอะไหล่(บาท),ค่าบริการ(บาท),ค่าเดินทาง(บาท),Total,หมายเหตุ,สถานะ,ผู้รับผิดชอบ\n";
	
		$rc = mysqli_query($conn,$sql);
				while($c= mysqli_fetch_array($rc)){
				echo "$c[site_id], $c[site_name],$c[job_no],$c[open_call_dte],$c[closed_date],$c[problem],$c[problem_solving],0,0,0,0,$c[status_sla],$c[status_call],$c[type_service]\n";
				}
				echo "\n\n\n\n";
	}
/*
	function POSPMOil($years,$months,$type_service,$close_dte,$cat_id){
		global $conn;
		$sql = "Select
                      tbl_log_call_center.site_id,
                      tbl_station_oil.site_name,
                      tbl_log_call_center.job_no,
                      tbl_station_oil.site_type,
                      tbl_log_call_center.open_call_dte,
                      tbl_log_call_center.closed_date,
                      tbl_log_call_center.problem,
                      tbl_log_call_center.problem_solving
                      FROM
                      tbl_log_call_center
                      Inner Join tbl_station_oil ON tbl_log_call_center.site_id = tbl_station_oil.station_id
                      Where tbl_log_call_center.type_service = '$type_service'
                      And tbl_log_call_center.closed_date like '$close_dte%'
                      And tbl_log_call_center.category_type = '$cat_id'
                      Order by tbl_log_call_center.open_call_dte ASC";    //echo $sql;//exit;	
		echo "เหมาจ่าย (POS Oil) เดือน ".$months ."  ".$years;			
		echo "\nSITE_ID,SITE_NAME,POS No.,เลขที่ใบงาน,Open_Date,Finish_Date,Problem,Solution,ค่าอะไหล่(บาท),ค่าบริการ(บาท),ค่าเดินทาง(บาท),Total,หมายเหตุ,สถานะ,ผู้รับผิดชอบ\n<hr>";
	
		$rc = mysqli_query($conn,$sql);
				while($c= mysqli_fetch_array($rc)){
				echo "$c[site_id], $c[site_name],$c[job_no],$c[site_type],$c[open_call_dte],$c[closed_date],$c[problem],$c[problem_solving]\n<hr>";
				}
				echo "\n\n\n\n";
	}*/



	
?>
