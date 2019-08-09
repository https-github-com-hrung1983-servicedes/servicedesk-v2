<?
header("Content-Type: text/html; charset=tis-620");                 
session_start();

    require_once("function.php");                                         
 
  if(!checkUser()){    echo Message(35,"red",$titel1,$msg1,"<a href='index.php?link=report_all_show'> $login </a>");
  exit;
  } 
$report_name = $_REQUEST["reporttype"]; // echo $report_name;exit;
//echo $report_name; 
//exit;
$months = $_REQUEST["months"];
$years = $_REQUEST["years"];
$dte = $years."-".$months;

//echo $report_name;
if ($report_name=="1") {     //CMPOSNGV
		header('Content-type: application/csv');
		$name = "Content-Disposition: attachment; filename=CMPOSNGV_".$months."-".$years.".csv;sheet1='xx'";
		header($name); 
		POSCMNGV($years,$months,"BSS",$dte,"8");
		POSCMNGV($years,$months,"SDC",$dte,"8");
		POSCMNGV($years,$months,"BSS",$dte,"9");
		POSCMNGV($years,$months,"SDC",$dte,"9"); 
	} else if ($report_name=="2") {  //CMPOSOil
	   header('Content-type: application/csv');
		$name = "Content-Disposition: attachment; filename=CMPOSOil_".$months."-".$years.".csv;sheet1='xx'";
	    header($name); 
		POSCMOil($years,$months,"BSS",$dte,"1");
		POSCMOil($years,$months,"SDC",$dte,"1");
	} else if ($report_name=="3") {//PMPOSNGV
	    header('Content-type: application/csv');
		$name = "Content-Disposition: attachment; filename=PMPOSNGV_".$months."-".$years.".csv;sheet1='xx'";
		header($name); 
		POSPMOil($years,$months,"BSS",$dte,"18");
	} else if ($report_name=="4") {  //PMPOSOil
	    header('Content-type: application/csv');
		$name = "Content-Disposition: attachment; filename=PMPOSOil_".$months."-".$years.".csv;";
		header($name); 
//// POK  7
	    header("location:cover_setup_ngv_pos.php?dte=$dte");
	} else if($report_name=="5"){
		// POK 15
		header("location:cover_setup_oil_pos.php?dte=$dte");
	}else if($report_name=="6"){
		// POK 13
      header("location:cover_pm_ngv.php?dte=$dte");
	}else if($report_name=="7"){
		
	}else if($report_name=="11"){//????????? ???????? (Flowco)
       header("location:maintenanceplan(flowco).php?m=$months&y=$years"); 
    }else if($report_name=="12"){ //???????????? ??? Standby ????? (Flowco)
       header("location:trainingforsalesandstandby(flowco).php?m=$months&y=$years"); 
    }else if($report_name=="13"){ // ???????????? Replace Program (Flowco)
       header("location:plannedinstallationsreplaceprogram(flowco).php?m=$months&y=$years"); 
    }else if($report_name=="14"){ // ???????????? Replace Program (Flowco)
		 header('Content-type: application/csv');
		$name = "Content-Disposition: attachment; filename=ReplaceFlowco_".$months."-".$years.".csv;sheet1='xx'";
		header($name); 
			 CoverReplaceFlowco($years,$months);
	} else if($report_name=="17"){ // Upgrade Loyalty Amazon
         header('Content-type: application/csv');
        $name = "Content-Disposition: attachment; filename=UpgradeLoaltyAmazon".$months."-".$years.".csv;sheet1='xx'";
        header($name); 
        UpgradeLoaltyAmazon("BSS",$years,$months);
        UpgradeLoaltyAmazon("SDC",$years,$months);  
        UpgradeLoaltyAmazon("BOONPA",$years,$months);  
    }  else if($report_name=="18"){ // Incentive
         header('Content-type: application/csv');
        $name = "Content-Disposition: attachment; filename=IncentiveEmployee".$months."-".$years.".csv;sheet1='xx'";
        header($name); 
        IncentiveEmp($years,$months);     
    } else if($report_name=="19"){ // PM oil
         header('Content-type: application/csv');
        $name = "Content-Disposition: attachment; filename=PMPOSOIL".$months."-".$years.".csv;sheet1='xx'";
        header($name); 
        PMPOSOIL($years,$months,"19");     
    } else if($report_name=="20"){ // Upgrade ???? Loyalty Oil
         header('Content-type: application/csv');
        $name = "Content-Disposition: attachment; filename=UpgradeLoyaltyOil".$months."-".$years.".csv;sheet1='xx'";
        header($name); 
        PMPOSOIL($years,$months,"26");     
    }else if($report_name=="21") { // 3g NGV
          header('Content-type: application/csv');
        $name = "Content-Disposition: attachment; filename=NGV3g.csv;sheet1='xx'";
        header($name); 
        NGV3g();       
    }else if($report_name=="22") { // 3g Oil
         header('Content-type: application/csv');
        $name = "Content-Disposition: attachment; filename=3gOil.csv;";
        header($name); 
        Oil3g();     
    }else if($report_name=="23") { //3g Amazon
         header('Content-type: application/csv');
        $name = "Content-Disposition: attachment; filename=3gAmazon.csv;";
        header($name); 
        Amazon3g();     
    }
   
	function NGV3g(){
		global $conn;
	    $sql = "SELECT 
								tbl_station_ngv.site_id,
								tbl_station_ngv.site_name,
								tbl_station_ngv.routerbox_no,
								tbl_station_ngv.routerbox_bss_no,
								tbl_station_ngv.sim_no,
								tbl_station_ngv.aircard_no,
								tbl_station_ngv.aircard_bss_no,
								tbl_station_ngv.install_network_dte,
								tbl_station_ngv.status_install_3g,
								tbl_station_ngv.ip_address,
								tbl_station_ngv.comment_site
						FROM
								tbl_station_ngv
						WHERE tbl_station_ngv.status_install_3g = 'y' ";
	echo "ลำดับ,รหัสสถานี,ชื่อสถานี,วันที่เข้าดำเนินการ,ประเภท,IP,S/N Router,S/N BSS,S/N Aircard,S/N Aircard BSS,เบอร์ SIM,ส่งคืนอุปกรณ์ EMBES,หมายเหตุ\n";
	$rs = mysqli_query($conn,$sql);
		$i=1;
		while($c = mysqli_fetch_array($rs)){
			echo "$i,$c[site_id],$c[site_name],$c[install_network_dte],NGV,$c[ip_address],$c[routerbox_no],$c[routerbox_bss_no],$c[aircard_no],$c[aircard_bss_no],$c[sim_no],Done,$c[comment_site],\n";
		}

	}

	function Oil3g(){
		global $conn;
	    $sql = "SELECT 
								tbl_station_oil.station_id,
								tbl_station_oil.site_name,
								tbl_station_oil.routerbox_no,
								tbl_station_oil.routerbox_bss_no,
								tbl_station_oil.sim_no,
								tbl_station_oil.aircard_no,
								tbl_station_oil.aircard_bss_no,
								tbl_station_oil.install_network_dte,
								tbl_station_oil.status_install_3g,
								tbl_station_oil.ip_address,
								tbl_station_oil.comment_site
						FROM
								tbl_station_oil
						WHERE tbl_station_oil.status_install_3g = 'y' ";
	echo "ลำดับ,รหัสสถานี,ชื่อสถานี,วันที่เข้าดำเนินการ,ประเภท,IP,S/N Router,S/N BSS,S/N Aircard,S/N Aircard BSS,เบอร์ SIM,ส่งคืนอุปกรณ์ EMBES,หมายเหตุ\n";
	$rs = mysqli_query($conn,$sql);
		$i=1;
		while($c = mysqli_fetch_array($rs)){
			echo "$i,$c[station_id],$c[site_name],$c[install_network_dte],OIL,$c[ip_address],$c[routerbox_no],$c[routerbox_bss_no],$c[aircard_no],$c[aircard_bss_no],$c[sim_no],Done,$c[comment_site],\n";
		}

	}

function Amazon3g(){
	global $conn;
	    $sql = "SELECT 
								tbl_station_amazon.site_id,
								tbl_station_amazon.site_name,
								tbl_station_amazon.routerbox_no,
								tbl_station_amazon.routerbox_bss_no,
								tbl_station_amazon.sim_no,
								tbl_station_amazon.aircard_no,
								tbl_station_amazon.aircard_bss_no,
								tbl_station_amazon.install_network_dte,
								tbl_station_amazon.status_install_3g,
								tbl_station_amazon.ip_address,
								tbl_station_amazon.comment_site
						FROM
								tbl_station_amazon
						WHERE tbl_station_amazon.status_install_3g = 'y' ";
	echo "ลำดับ,รหัสสถานี,ชื่อสถานี,วันที่เข้าดำเนินการ,ประเภท,IP,S/N Router,S/N BSS,S/N Aircard,S/N Aircard BSS,เบอร์ SIM,ส่งคืนอุปกรณ์ EMBES,หมายเหตุ\n";
	$rs = mysqli_query($conn,$sql);
		$i=1;
		while($c = mysqli_fetch_array($rs)){
			echo "$i,$c[site_id],$c[site_name],$c[install_network_dte],NGV,$c[ip_address],$c[routerbox_no],$c[routerbox_bss_no],$c[aircard_no],$c[aircard_bss_no],$c[sim_no],Done,$c[comment_site],\n";
		}

	}

   function PMPOSOIL($years,$months,$cate_type){
	   global $conn;
		$sql = "SELECT
                        tbl_log_call_center.site_id,
                        tbl_log_call_center.job_no,
                        tbl_log_call_center.open_call_dte,
                        tbl_log_call_center.closed_date,
                        tbl_log_call_center.problem,
                        tbl_log_call_center.problem_solving,
                        tbl_log_call_center.status_call,
                        tbl_log_call_center.status_sla,
                        tbl_log_call_center.type_service,
                        tbl_station_oil.site_name
                        FROM
                        tbl_log_call_center
                        Inner Join tbl_station_oil ON tbl_log_call_center.site_id = tbl_station_oil.station_id
                     Where tbl_log_call_center.closed_date like '$years-$months%'
                     And tbl_log_call_center.category_type = '$cate_type'
		     And tbl_log_call_center.status_call = 'close'
                     Order by tbl_log_call_center.open_call_dte ASC";  
					 if($cate_type=="26"){
						echo "UpgradeLoaltyAmazon ".$months ."  ".$years; 
					 }else{
							echo "PM POS OIL ".$months ."  ".$years; 
					 }	
                    echo "\nSITE_ID,SITE_NAME,??????????,Open_Date,Finish_Date,Problem,Solution,?????????(???),?????????(???),?????????(???),Total,????????,????\n";
        $rc = mysqli_query($conn,$sql);
                while($c= mysqli_fetch_array($rc)){
                $problem = str_replace(",","",$c["problem"]);
                $problem_solving = str_replace(","," ",$c["problem_solving"]);                   
                
                echo "$c[site_id],$c[site_name],$c[job_no],$c[open_call_dte],$c[closed_date],$problem,$problem_solving,0,0,0,0,$c[status_sla],$c[status_call]\n";
                }
                echo "\n\n\n\n";
   }
    
    function IncentiveEmp($years,$months){
		global $conn;
         $sql = "SELECT                             
                    Sum(tbl_incentive_ot.incentive_total) AS sumincentive,
                    tbl_user_login.name,
                    tbl_user_login.sname
                 FROM
                    tbl_incentive_ot
                 Inner Join tbl_user_login ON tbl_incentive_ot.other_receive = tbl_user_login.user_bss_id
                 WHERE tbl_incentive_ot.other_date like '$years-$months%'
                 GROUP BY tbl_incentive_ot.other_receive";      
                    echo "Incentive Employee ".$months ."/".$years;  
                    echo "\nNo.,Name,Surname,Summary\n";
                    $i=1;
        $rc = mysqli_query($conn,$sql);
                while($c= mysqli_fetch_array($rc)){                            
                  if($c[sumincentive] != 0){
                        echo "$i,$c[name],$c[sname],$c[sumincentive]\n";
                        $i++;
                  }
                }
                echo "\n\n\n\n";
    }                                                                                                               
    
    
    function UpgradeLoaltyAmazon($typer,$years,$months){
		global $conn;
          $sql = "SELECT
                        tbl_log_call_center.site_id,
                        tbl_log_call_center.job_no,
                        tbl_log_call_center.open_call_dte,
                        tbl_log_call_center.closed_date,
                        tbl_log_call_center.problem,
                        tbl_log_call_center.problem_solving,
                        tbl_log_call_center.status_call,
                        tbl_log_call_center.status_sla,
                        tbl_log_call_center.type_service,
                        tbl_station_amazon.site_name,
                        tbl_station_amazon.site_province
                        FROM
                        tbl_log_call_center
                        Inner Join tbl_station_amazon ON tbl_log_call_center.site_id = tbl_station_amazon.site_id
                     Where tbl_log_call_center.type_service = '$typer'
                     And tbl_log_call_center.closed_date like '$close_dte%'
                     And tbl_log_call_center.category_type = '23'
                     Order by tbl_log_call_center.open_call_dte ASC";      
                    echo "UpgradeLoaltyAmazon ".$months ."  ".$years;  
                    echo "\nSITE_ID,SITE_NAME,??????????,Open_Date,Finish_Date,Problem,Solution,?????????(???),?????????(???),?????????(???),Total,????????,????,????????????\n";
        $rc = mysqli_query($conn,$sql);
                while($c= mysqli_fetch_array($rc)){
                $problem = str_replace(",","",$c["problem"]);
                $problem_solving = str_replace(","," ",$c["problem_solving"]);
                $str = "";
                 if($c["type_service"]=="BSS"){
                     $str = "Bizserv Solution Team A";
                 }else if($c["type_service"]=="SDC"){       
                     $str = "Bizserv Solution Team B";
                 }else if($c["type_service"]=="BOONPA"){
                     $str = "Bizserv Solution Team C";
                 }                     
                
                echo "$c[site_id],$c[site_name],$c[job_no],$c[open_call_dte],$c[closed_date],$problem,$problem_solving,0,0,0,0,$c[status_sla],$c[status_call],$str\n";
                }
                echo "\n\n\n\n";
    }
/*
function SummarySheet($years,$months,$type){
    $sql = "SELECT
								tbl_log_call_center.site_id,
								tbl_station_ngv.site_name,
								tbl_station_ngv.pos,
								tbl_log_call_center.job_no,
								tbl_log_call_center.open_call_dte,
								tbl_category_type.fixed_description
							FROM
								tbl_log_call_center
							Inner Join tbl_category_type ON tbl_log_call_center.category_type = tbl_category_type.category_id
							Inner Join tbl_station_ngv ON tbl_log_call_center.site_id = tbl_station_ngv.site_id
							WHERE tbl_log_call_center.category_type = '$i'
							And tbl_log_call_center.open_call_dte like'$years-$months%'"; //echo $sql;exit;
		echo "\nSITE_ID	SITE_NAME	POS No.	??????????	Open_Date	Finish_Date	Problem	Solution	?????????(???)	?????????(???)	?????????(???)	Total	????????	????	????????????\n";
		//echo $sql;exit;
		$rc = mysql_query($sql);
				while($c= mysql_fetch_array($rc)){
				echo "$c[site_id],$c[site_name_old],$c[pos],$c[job_no],$c[open_call_dte],'????????? POS NGV','?????????????????, ScanVirus, ??????????????????????, Backup ??????, ???? S/N ???????',0,0,0,0,0,$c[fixed_description]\n";
				}
				echo "\n\n\n\n";
}
*/





function CoverReplaceFlowco($years,$months) {
	global $conn;
	for($i=20;$i<=22;$i++){
		if($i==20){
			echo " \nMaintenance plan.";
		}else if($i==21){
			echo "\nTraining for Sales and Standby.";
		}else if($i==22){
			echo " \nPlanned installations Replace Program.";
		}
		$sql = "Select 
							tbl_log_call_center.site_id,
							tbl_log_call_center.job_no,
							tbl_log_call_center.open_call_dte,
							tbl_log_call_center.problem,
							tbl_log_call_center.problem_solving,
							tbl_log_call_center.site_province,
							tbl_station_ngv.pos,
							tbl_station_ngv.site_name_old
							FROM tbl_log_call_center
							Inner Join tbl_station_ngv ON tbl_log_call_center.site_id = tbl_station_ngv.site_id
							WHERE tbl_log_call_center.category_type = '$i'
							And tbl_log_call_center.open_call_dte like'$years-$months%'
							AND status_call = 'close'";  
		echo "\nSITE_ID,SITE_NAME,POS,Job No.,Open Date, Problem,Solution,Province \n";
		$rc = mysqli_query($conn,$sql);
				while($c= mysqli_fetch_array($rc)){
				echo "$c[site_id],$c[site_name_old],$c[pos],$c[job_no],$c[open_call_dte],$c[problem],$c[problem_solving],$c[site_province]\n";
				}
				echo "\n\n\n\n";
		}
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
							echo "Per Call (POS NGV) ????? ".$months ."  ".$years;
					 } else {
						echo "????????(POS NGV) ????? ".$months ."  ".$years;
					 }
	//	echo "\nSITE_ID,SITE_NAME,POS No.,??????????,Open_Date,Finish_Date,Problem,Solution,?????????(???),?????????(???),?????????(???),Total,????????,????,????????????\n";

   echo "\nSITE_ID,SITE_NAME	,POS No.	,??????????,	Open_Date	,Finish_Date,	Problem,	Solution	,?????????(???),	?????????(???),	?????????(???)	,Total	,????????,	????	,????????????\n";
		$rc = mysqli_query($conn,$sql);
				while($c= mysqli_fetch_array($rc)){
				$problem = str_replace(",","",$c["problem"]);
				$problem_solving = str_replace(","," ",$c["problem_solving"]);
				 $str = "";
                 if($c["type_service"]=="BSS"){
                     $str = "Bizserv Solution Team A";
                 }else if($c["type_service"]=="SDC"){       
                     $str = "Bizserv Solution Team B";
                 }else if($c["type_service"]=="BOONPA"){
                     $str = "Bizserv Solution Team C";
                 }   
				
				echo "$c[site_id],$c[site_name_old],$c[pos],$c[job_no],$c[open_call_dte],$c[closed_date],$problem,$problem_solving,$c[pay],0,0,$c[pay],$c[status_sla],$c[status_call],$str\n";
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
		echo "Per Call (POS Oil) ????? ".$months ."  ".$years;			
	//	echo "\nSITE_ID,SITE_NAME,POS No.,??????????,Open_Date,Finish_Date,Problem,Solution,?????????(???),?????????(???),?????????(???),Total,????????,????,????????????\n";
	  echo "\nSITE_ID,SITE_NAME	,POS No.	,??????????,	Open_Date	,Finish_Date,	Problem	Solution	,?????????(???),	?????????(???),	?????????(???)	,Total	,????????,	????	,????????????\n";
		$rc = mysqli_query($conn,$sql);
				while($c= mysqli_fetch_array($rc)){
					$site = getSiteNumber($c[site_id]);
                    $str = "";
                 if($c["type_service"]=="BSS"){
                     $str = "Bizserv Solution Team A";
                 }else if($c["type_service"]=="SDC"){       
                     $str = "Bizserv Solution Team B";
                 }else if($c["type_service"]=="BOONPA"){
                     $str = "Bizserv Solution Team C";
                 }
				echo "$site, $c[site_name],$c[job_no],$c[site_type],$c[open_call_dte],$c[closed_date],$c[problem],$c[problem_solving],$c[pay],0,0,0,$c[status_sla],$c[status_call],$str\n";
		//	echo "<br>";
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
		echo "???????? (POS Oil) ????? ".$months ."  ".$years;			
//		echo "\nSITE_ID,SITE_NAME,??????????,Open_Date,Finish_Date,Problem,Solution,?????????(???),?????????(???),?????????(???),Total,????????,????,????????????\n";
 echo "\nSITE_ID,SITE_NAME	,POS No.	,??????????,	Open_Date	,Finish_Date,	Problem	Solution	,?????????(???),	?????????(???),	?????????(???)	,Total	,????????,	????	,????????????\n";
		$rc = mysqli_query($conn,$sql);
				while($c= mysqli_fetch_array($rc)){
					$site = getSiteNumber($c[site_id]);
                    $str = "";
                 if($c["type_service"]=="BSS"){
                     $str = "Bizserv Solution Team A";
                 }else if($c["type_service"]=="SDC"){       
                     $str = "Bizserv Solution Team B";
                 }else if($c["type_service"]=="BOONPA"){
                     $str = "Bizserv Solution Team C";
                 }
				echo "$site, $c[site_name],$c[job_no],$c[open_call_dte],$c[closed_date],$c[problem],$c[problem_solving],0,0,0,0,$c[status_sla],$c[status_call],$str\n";
		//		echo "<br>";
				}
				echo "\n\n\n\n";
	}
?>
