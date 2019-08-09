<?
session_start();
$reciept_id = $_SESSION["User_id"];
require_once("function.php");
header("Content-Type: text/html; charset=UTF8");

	if(!checkUser()){    echo Message(35,"red",$titel1,$msg1,"<a href='index.php'> $login </a>");
		   exit;
	}

	if($_SESSION["Ustate"] == "user" || $_SESSION["Ustate"] == "cm") {
		 echo Message(35,"red",$titel1,$msg2,"<a href='javascript:history.back(1)'> $back</a>");
	        exit;
	}

	//$_SESSION["Uid"]
        $type_call = $_REQUEST["type_call"];

        $doc = $_REQUEST["doc"];
          if($doc == "on"){
              $doc = "true";
          } else {
              $doc = "false";
          }

	//echo $type_call;exit;
        $customer_call = trim($_REQUEST["txtCustomerCall"]);
        $call_name = trim($_REQUEST["txtCallerName"]);
        $cate_id = trim($_REQUEST["CateTypeID"]);
        $job_no = trim($_REQUEST["txtJobNo"]);
				$id = trim($_REQUEST["id"]);
        $bssmsr_no = trim($_REQUEST["txtBSSMSRNo"]);
        $site_id = trim($_REQUEST["txtSid"]);
        $site_province = trim($_REQUEST["txtSidProvince"]);
        $contact_name = trim($_REQUEST["txtContactName"]);
        $contact_tel = trim($_REQUEST["txtContactTel"]);
        $problem = addslashes(trim($_REQUEST["areaProblem"]));
        $cat = trim($_REQUEST["cmbCat"]);
        $slatime = trim($_REQUEST["txtSLA"]);
        $openttype = trim($_REQUEST["cmbOpenType"]);
        $user_receipt = trim($_REQUEST["UserReciptID"]);
        $srvtype = trim($_REQUEST["cmbServiceType"]);
        $user_engineer = trim($_REQUEST["UserEngineerID"]);
        $problemsolving = addslashes(trim($_REQUEST["txtProblemSolving"]));
        $seria_old = trim($_REQUEST["txtSerialOld"]);
        $seria_new = trim($_REQUEST["txtSerialNew"]);

        $open_call_dtetme = trim($_REQUEST["open_date"])." ".trim($_REQUEST["open_date_h"]).":".trim($_REQUEST["open_date_t"]).":00";
        $opent_call_dte = trim($_REQUEST["open_date"]);
        $opent_call_tme = trim($_REQUEST["open_date_h"]).":".trim($_REQUEST["open_date_t"]).":00";

        $onsite_dtetime = trim($_REQUEST["dteOnSite"])." ".trim($_REQUEST["cmbOnSiteHH"]).":".trim($_REQUEST["cmbOnSiteTT"]).":01";

        $fixed_dtetime = trim($_REQUEST["dteFixedTime"]). " " .trim($_REQUEST["cmbFixedTimeHH"]).":".trim($_REQUEST["cmbFixedTimeTT"]).":02";
        $clode_dte = trim($_REQUEST["dteClose"]);
        $clode_tme = trim($_REQUEST["cmbCloseHH"]).":".trim($_REQUEST["cmbCloseTT"]).":03";
        $deadline = getDateline($open_call_dtetme,$slatime);

        $stats = trim($_REQUEST["cmbStatus"]);
        $comment = trim($_REQUEST["txtComment"]);
        if($_REQUEST["province_phase"]==""){ $provice_phase = "1"; }else{ $provice_phase =$_REQUEST["province_phase"];}
        $problem_type = trim($_REQUEST["problem_type"]);
        $serial_type = $_REQUEST["cate_hardware"];
        $resolv_type = $_REQUEST["resolv_type"];
	      $shift_job = $_REQUEST["shift_job"];
	      $fee_km = $_REQUEST["fee_km"];





	$shred_location_in = $_REQUEST["shred_location_in"];
          if($shred_location_in == "on"){
              $shred_location_in = "true";
          } else {
              $shred_location_in = "false";
          }

	$shred_location_out = $_REQUEST["shred_location_out"];
          if($shred_location_out == "on"){
              $shred_location_out = "true";
          } else {
              $shred_location_out = "false";
          }

	$appoint_date = $_REQUEST["appoint_date"];
	$appoint_time = $_REQUEST["appoint_h_time"].":".$_REQUEST["appoint_m_time"].":00";


   	$cmbCatBSS = $_REQUEST["cmbCatBSS"];
	$txtSLABSS = $_REQUEST["txtSLABSS"];
	$dateline_cat_bss = $_REQUEST["dateline_cat_bss"];
	$status_cat_bss = $_REQUEST["status_cat_bss"];
	$manday = $_REQUEST["manday"];

	$withdraw = $_REQUEST["withdraw"];

	$deadline_bss = getDateline($open_call_dtetme,$txtSLABSS);

       //   echo $deadline_bss;exit;
        $table = "tbl_log_call_center";
        $user = $_SESSION["Uid"];
        $dte_tme = getDteTme();
 $id_mail = "";
    //        echo $id."<hr>";
    $dte_beg = trim($_REQUEST["dte_beg"]);
    $dte_end = trim($_REQUEST["dte_end"]);
	$mode = $_REQUEST["mode"];
	

		   if ($mode == "add") {      //  31
             $row = checkJobNo("jobno",$job_no);
              if($row >= 1){
                 echo Message(35,"red","JobNO : $job_no Wrong.","<a href='javascript:history.back(1)'>Back</a>");
                 exit;
              }
              $row1 = checkJobNo("msr",$bssmsr_no);

							$sql_logcall="select count(a1.id) as show_on_app_count
							              from
							              (
							              select
							              a.id , a.reciept_job_user_id
							              from tbl_log_call_center a
							              where a.status_call='feedback'
							              and a.type_service='BSS'
							              and
							              (a.show_on_app_status='y' or a.status_close_job = 'o')
							              union all
							              select b.id , b.reciept_job_engineer
							              from itbl_logcall_retail b
							              where b.status_call='feedback'
							              and
							              (b.show_on_app_status='y' or b.status_close_job = 'o')

							              ) a1
							              where
							              a1.reciept_job_user_id = '$user_engineer' ";
					    $que_logcall = mysqli_query($conn,$sql_logcall);
							$c = mysqli_fetch_array($que_logcall);
							if($c["show_on_app_count"]=="0"){
								$show_on_app_status="y";
							}else {
								$show_on_app_status="n";
							}
				

            $sql = "Insert into $table (call_type,open_call_dte,open_call_tme,customer_call,caller_name,
                     category_type,job_no,bss_msr_no,site_id,
                     site_province,customer_contact,customer_tel,problem,
                     severity,sla,open_type,reciept_job_bss,
                     type_service,reciept_job_user_id,problem_solving,serial_no_old,
                     serial_no_new,dateline_solving,onsite_datetime,fixed_time,
                     closed_date,closed_time,status_call,user_open,user_open_datetime,doc,provice_phase,
					 type_problem,serial_type,commente,resolv_type,appoint_date,appoint_time,cat_bss,cat_hour,dateline_cat_bss,
manday,status_close_job,shift_job,show_on_app_status,paid_status,fee_km)
                 values ('$type_call','$opent_call_dte','$opent_call_tme','$customer_call','$call_name',
                        '$cate_id','$job_no','$bssmsr_no','$site_id','$site_province','$contact_name',
                        '$contact_tel','$problem','$cat','$slatime ','$openttype','$user_receipt',
                        '$srvtype','$user_engineer','$problemsolving','$seria_old','$seria_new',
                        '$deadline',
												NULL,NULL
												,NULL,NULL,
                        '$stats','$user','$dte_tme','$doc','$provice_phase','$problem_type','$serial_type','$comment','$resolv_type',
			'$appoint_date','$appoint_time','$cmbCatBSS','$txtSLABSS','$deadline_bss','$manday','o','$shift_job',
'$show_on_app_status','$withdraw','$fee_km')";

            mysqli_query($conn,$sql); //echo $sql;   exit;

						$sql_log = "INSERT INTO tbl_log_call_transaction
											(call_type,open_call_dte,open_call_tme,customer_call,caller_name,
										 category_type,job_no,bss_msr_no,site_id,
										 site_province,customer_contact,customer_tel,problem,
										 severity,sla,open_type,reciept_job_bss,
										 type_service,reciept_job_user_id,problem_solving,serial_no_old,
										 serial_no_new,dateline_solving,onsite_datetime,fixed_time,
										 closed_date,closed_time,status_call,user_open,user_open_datetime,doc,provice_phase,
					 				 		type_problem,serial_type,commente,resolv_type,appoint_date,appoint_time,cat_bss,cat_hour,dateline_cat_bss,manday,status_close_job,shift_job,show_on_app_status,paid_status,
											user_update,status_transaction
										)
								 			values ('$type_call','$opent_call_dte','$opent_call_tme','$customer_call','$call_name',
												'$cate_id','$job_no','$bssmsr_no','$site_id','$site_province','$contact_name',
												'$contact_tel','$problem','$cat','$slatime ','$openttype','$user_receipt',
												'$srvtype','$user_engineer','$problemsolving','$seria_old','$seria_new',
												'$deadline',
													NULL,NULL
												,NULL,NULL,
												'$stats','$user','$dte_tme','$doc','$provice_phase','$problem_type','$serial_type','$comment','$resolv_type',
												'$appoint_date','$appoint_time','$cmbCatBSS','$txtSLABSS','$deadline_bss','$manday','o','$shift_job','$show_on_app_status','$withdraw'
												,'$reciept_id','o'
											)";
											//echo $provice_phase;
						mysqli_query($conn,$sql_log);

            $id_log = mysqli_insert_id($conn);
 	    $id_mail = $id_log;
	$GenNo = $_REQUEST["GenNo"];
	if($GenNo=="on"){
		$dtetme = getDteTme();
			$sql_bss = "insert into tbl_log_call_bss
								(job_id,job_no,job_date,job_type,site_id,job_problem,job_solution,
								job_start_date,job_start_time,job_reciept_user_id,
								job_engineer_reciept_id,user_create_date,job_status,logfrom)
								values ('$id_log','$job_no','$dtetme','$type_call','$site_id',
								'$problem','$problemsolving','$opent_call_dte','$opent_call_tme',
								'$user_receipt','$user_engineer','$dtetme','Onsite','log')";
					//			echo $sql_bss;exit;
					mysqli_query($conn,$sql_bss);
	}
	
// --------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//

        } else  if ($mode == "edit") {
               $row = checkJobNo("jobno",$job_no);
              if($row == 2){
                 echo Message(35,"red","JobNO : $job_no Wrong.","<a href='javascript:history.back(1)'>Back</a>");
                 exit;
              }

							if($stats=="close" && $clode_dte==NULL){
								echo Message(35,"red","Input Close Date.","<a href='javascript:history.back(1)'>Back</a>");
								exit;
							}


					 if($stats=="cancel not paid" || $stats=="cancel" ){
						    $status_close_job = ",status_close_job='c' , show_on_app_status = 'n' ";
					}else{
								$status_close_job = "";
						$sql_count="select count(a1.id) as show_on_app_count
												from
												(
												select
												a.id , a.reciept_job_user_id
												from tbl_log_call_center a
												where a.status_call='feedback'
												and a.type_service='BSS'
												and a.show_on_app_status='y'
												union all
												select b.id , b.reciept_job_engineer
												from itbl_logcall_retail b
												where b.status_call='feedback'
												and b.show_on_app_status='y'
												) a1
												where
												a1.reciept_job_user_id = '$user_engineer' ";
						$que_count = mysqli_query($conn,$sql_count);
						$count = mysqli_fetch_array($que_count);
						$show_on_app_count=$count["show_on_app_count"];


						if($_REQUEST["dteOnSite"] == NULL){ $aa1=",onsite_datetime=NULL"; }else{ $aa1=",onsite_datetime='$onsite_dtetime'"; }
						if($_REQUEST["dteFixedTime"] == NULL){ $aa2=",fixed_time=NULL"; }else{ $aa2=",fixed_time='$fixed_dtetime'"; }
						if($_REQUEST["dteClose"] == NULL){ $aa3=",closed_date=NULL ,closed_time=NULL"; }else{ $aa3=",closed_date='$clode_dte' ,closed_time='$clode_tme'"; }


					}
$evaluate1  = $_REQUEST["evaluate1"];
	$evaluate2  = $_REQUEST["evaluate2"];
	$evaluate3  = $_REQUEST["evaluate3"];
	$evaluate4  = $_REQUEST["evaluate4"];
	$evaluate5  = $_REQUEST["evaluate5"];
	$evaluate6  = $_REQUEST["evaluate6"];
if($stats!="cancel not paid" || $stats!="cancel" ){
  if($_REQUEST["doc"] != "on"){
    if($stats=="close"){
	if($user_receipt!=$user_engineer){
		if($evaluate1 == "0"){ echo Message(35,"red","กรุณากรอกแบบสอบถามข้อที่ 1 ","<a href='javascript:history.back(1)'>Back</a>"); exit;}
		if($evaluate2 == "0"){ echo Message(35,"red","กรุณากรอกแบบสอบถามข้อที่ 2 ","<a href='javascript:history.back(1)'>Back</a>"); exit;}
		if($evaluate3 == "0"){ echo Message(35,"red","กรุณากรอกแบบสอบถามข้อที่ 3 ","<a href='javascript:history.back(1)'>Back</a>"); exit;}
		if($evaluate4 == "0"){ echo Message(35,"red","กรุณากรอกแบบสอบถามข้อที่ 4 ","<a href='javascript:history.back(1)'>Back</a>"); exit;}
		if($evaluate5 == "0"){ echo Message(35,"red","กรุณากรอกแบบสอบถามข้อที่ 5 ","<a href='javascript:history.back(1)'>Back</a>"); exit;}
		if($evaluate6 == "0"){ echo Message(35,"red","กรุณากรอกแบบสอบถามข้อที่ 6 ","<a href='javascript:history.back(1)'>Back</a>"); exit;}
	}
    }
  }
}
              $sql = "Update $table set open_call_dte='$opent_call_dte',
                     open_call_tme='$opent_call_tme',customer_call='$customer_call',caller_name='$call_name',
                     category_type='$cate_id',bss_msr_no='$bssmsr_no',site_id='$site_id',
                     site_province='$site_province',customer_contact='$contact_name',customer_tel='$contact_tel',problem='$problem',
                     severity='$cat',sla='$slatime',open_type='$openttype',reciept_job_bss='$user_receipt',
                     type_service='$srvtype',reciept_job_user_id='$user_engineer',problem_solving='$problemsolving',serial_no_old='$seria_old',
                     serial_no_new='$seria_new',dateline_solving='$deadline'

										 $aa1
										 $aa2
                     $aa3

										 ,status_call='$stats',user_update='$user',user_update_datetime='$dte_tme',doc='$doc',
                     provice_phase='$provice_phase',type_problem='$problem_type',serial_type='$serial_type',commente='$comment',resolv_type='$resolv_type',
                     shared_location_in = '$shred_location_in', shared_location_out='$shred_location_out',appoint_date = '$appoint_date',appoint_time = '$appoint_time'
										 ,shift_job='$shift_job'

										 $status_close_job

					 				 	,paid_status='$withdraw',fee_km='$fee_km'
					 					";

            $usege_timing = dte_diff($opent_call_dte." ".$opent_call_tme,$clode_dte." ".$clode_tme);
            $diff_tme = $slatime +  $usege_timing;
		$status_sla_str = "";
           if ($stats != "feedback") {
			  if($diff_tme>0){
					    $sts = "WSLA";
			$status_sla_str = "(ไม่ตก SLA)";
					} else if($diff_tme<0){
					$sts = "FSLA";
			$status_sla_str = "(ตก SLA)";
			}
                $sql .= ",status_sla = '" .$sts."'";
            }



	$usege_timing_bss = dte_diff($opent_call_dte." ".$opent_call_tme,$clode_dte." ".$clode_tme);
            $diff_tme_bss = $txtSLABSS +  $usege_timing_bss;
		$status_sla_str = "";
           if ($stats != "feedback") {
			  if($diff_tme_bss>0){
					    $sts_bss = "WSLA";
			$status_sla_str_bss = "(ไม่ตก SLA)";
					} else if($diff_tme_bss<0){
					$sts_bss = "FSLA";
			$status_sla_str_bss = "(ตก SLA)";
			}
                $sql .= ",status_cat_bss = '" .$sts_bss."'";
            }






            $sql .= ",doc = '$doc',cat_bss = '$cmbCatBSS',cat_hour='$txtSLABSS',dateline_cat_bss='$deadline_bss',manday=$manday";
			$sql .= ",evaluate1 = '$evaluate1',evaluate2 = '$evaluate2',evaluate3='$evaluate3',evaluate4='$evaluate4',evaluate5=$evaluate5,evaluate6=$evaluate6";

            $sql .= " Where id = '". $id ."'";
$id_mail = $id;
          mysqli_query($conn,$sql);
      //   echo $sql;exit;
		$dtetme = getDteTme();
			$sql_bss = "Update tbl_log_call_bss set
								site_id='$site_id',job_problem='$problem',job_solution='$problemsolving',job_end_date='$clode_dte',
								job_end_time='$clode_tme',job_engineer_reciept_id='$user_engineer',job_referance_id='$job_no',
								user_update_date='$dtetme',job_status='$stats'
								where job_id = '$id' and logfrom='log'";
						//		echo $sql_bss;exit;
					mysqli_query($conn,$sql_bss);


					if($_REQUEST["dteOnSite"] == NULL){ $bb1="NULL"; }else{ $bb1="'".$onsite_dtetime."'"; }
					if($_REQUEST["dteFixedTime"] == NULL){ $bb2="NULL"; }else{ $bb2="'".$fixed_dtetime."'"; }
					if($_REQUEST["dteClose"] == NULL){ $bb3="NULL"; $bb4="NULL";  }else{ $bb3="'".$clode_dte."'"; $bb4="'".$clode_tme."'"; }


					$sql_log = "INSERT INTO tbl_log_call_transaction
										(call_type,open_call_dte,open_call_tme,customer_call,caller_name,
									 category_type,job_no,bss_msr_no,site_id,
									 site_province,customer_contact,customer_tel,problem,
									 severity,sla,open_type,reciept_job_bss,
									 type_service,reciept_job_user_id,problem_solving,serial_no_old,
									 serial_no_new,dateline_solving,
									 onsite_datetime,fixed_time,
									 closed_date,closed_time,
									 status_call,user_open,user_open_datetime,doc,provice_phase,
										type_problem,serial_type,commente,resolv_type,appoint_date,appoint_time,cat_bss,cat_hour,dateline_cat_bss,manday,status_close_job,shift_job,show_on_app_status,paid_status,
										user_update,status_transaction
									)
										values ('$type_call','$opent_call_dte','$opent_call_tme','$customer_call','$call_name',
											'$cate_id','$job_no','$bssmsr_no','$site_id','$site_province','$contact_name',
											'$contact_tel','$problem','$cat','$slatime ','$openttype','$user_receipt',
											'$srvtype','$user_engineer','$problemsolving','$seria_old','$seria_new',
											'$deadline',
												$bb1,$bb2
											,$bb3,$bb4,
											'$stats','$user','$dte_tme','$doc','$provice_phase','$problem_type','$serial_type','$comment','$resolv_type',
											'$appoint_date','$appoint_time','$cmbCatBSS','$txtSLABSS','$deadline_bss','$manday','o','$shift_job','n','$withdraw'
											,'$reciept_id','e'
										)";
										//echo $sql_log;
					mysqli_query($conn,$sql_log);


        }






	if($_REQUEST["doc"] != "on"){
		header("location:sendmail.php?id=$id_mail&dte_beg=$dte_beg&dte_end=$dte_end");
	 }else {
  		header("location:logcall.index.php?dte_beg=$dte_beg&dte_end=$dte_end");
	}

function dte_diff($date2,$date1){
	global $conn;
	   $sql = "SELECT TIMEDIFF('$date2' , '$date1') AS dte_diff";
	   $rs = mysqli_query($conn,$sql);
	   $c = mysqli_fetch_array($rs);
	   $d = $c["dte_diff"];
	   $dt = explode(":",$d);
    return $dt[0].".".$dt[1];
   }




?>
