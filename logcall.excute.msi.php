<?
//require_once("connection.php");
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

//	echo $_SESSION["Ustate"];//exit;
        $customer_call = trim($_REQUEST["txtCustomerCall"]);    
        $call_name = trim($_REQUEST["txtCallerName"]);  
        $cate_id = trim($_REQUEST["CateTypeID"]);    
        $job_no = trim($_REQUEST["txtJobNo"]); 
        $l_no = trim($_REQUEST["txtBSSMSRNo"]);    
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
        
                                                                                                                                              
        $onsite_dtetime = trim($_REQUEST["dteOnSite"])." ".trim($_REQUEST["cmbOnSiteHH"]).":".trim($_REQUEST["cmbOnSiteTT"]).":00";         
        $fixed_dtetime = trim($_REQUEST["dteFixedTime"]). " " .trim($_REQUEST["cmbFixedTimeHH"]).":".trim($_REQUEST["cmbFixedTimeTT"]).":00";                                
        $clode_dte = trim($_REQUEST["dteClose"]);
        $clode_tme = trim($_REQUEST["cmbCloseHH"]).":".trim($_REQUEST["cmbCloseTT"]).":00";    
        $deadline = getDateline($open_call_dtetme,$slatime);                                             
        $stats = trim($_REQUEST["cmbStatus"]);    
        $comment = trim($_REQUEST["txtComment"]);   
        $provice_phase = $_REQUEST["province_phase"];
        $problem_type = trim($_REQUEST["problem_type"]);
        $serial_type = $_REQUEST["cate_hardware"];
        $resolv_type = $_REQUEST["resolv_type"];    
 

	$appoint_date = $_REQUEST["appoint_date"];
	$appoint_time = $_REQUEST["appoint_h_time"].":".$_REQUEST["appoint_m_time"].":00";



          
                                               
        $table = "tbl_log_call_center";
        $user = $_SESSION["Uid"];                      
        $dte_tme = getDteTme();        
            $id = $_REQUEST["id"];
    $dte_beg = trim($_REQUEST["dte_beg"]);
    $dte_end = trim($_REQUEST["dte_end"]);  
	$mode = $_REQUEST["mode"]; 
       if ($mode == "add") {      //  31
             $row = checkJobNo("jobno",$job_no);
              if($row == 1){
                 echo Message(35,"red","¢éÍ€ÇÒÁàµ×Í¹","¡ÃØ³ÒµÃÇšÊÍºËÁÒÂàÅ¢ $job_no ÇèÒÁÕÍÂÙèáÅéÇËÃ×ÍäÁè ","<a href='javascript:history.back(1)'> ¡ÅÑºä»µÃÇšÊÍº</a>"); 
                 exit;
              }
              $row1 = checkJobNo("msr",$bssmsr_no);
              if($row1 == 1){
                 echo Message(35,"red","¢éÍ€ÇÒÁàµ×Í¹","¡ÃØ³ÒµÃÇšÊÍºËÁÒÂàÅ¢ $bssmsr_no ÇèÒÁÕÍÂÙèáÅéÇËÃ×ÍäÁè ","<a href='javascript:history.back(1)'> ¡ÅÑºä»µÃÇšÊÍº</a>"); 
                 exit;
              }
            $sql = "Insert into $table (call_type,open_call_dte,open_call_tme,customer_call,caller_name,
                     category_type,job_no,bss_msr_no,site_id,
                     site_province,customer_contact,customer_tel,problem,
                     severity,sla,open_type,reciept_job_bss,
                     type_service,reciept_job_user_id,problem_solving,serial_no_old,
                     serial_no_new,dateline_solving,onsite_datetime,fixed_time,
                     closed_date,closed_time,status_call,user_open,user_open_datetime,doc,provice_phase,
		     type_problem,serial_type,commente,resolv_type,appoint_date,appoint_time)
                 values ('$type_call','$opent_call_dte','$opent_call_tme','$customer_call','$call_name',
                        '$cate_id','$job_no','$bssmsr_no','$site_id','$site_province','$contact_name',
                        '$contact_tel','$problem','$cat','$slatime ','$openttype','$user_receipt',
                        '$srvtype','$user_engineer','$problemsolving','$seria_old','$seria_new',
                        '$deadline','$onsite_dtetime','$fixed_dtetime','$clode_dte','$clode_tme',
                        '$stats','$user','$dte_tme','$doc','$provice_phase','$problem_type','$serial_type','$comment','$resolv_type',
			'$appoint_date','$appoint_time')";       
          // echo $sql;exit;                         
            mysqli_query($conn,$sql); 		
	
        } else  if ($mode == "edit") {
               $row = checkJobNo("msr",$job_no);
              if($row >= 1){
                 echo Message(35,"red","¢éÍ€ÇÒÁàµ×Í¹","¡ÃØ³ÒµÃÇšÊÍºËÁÒÂàÅ¢ $job_no ÇèÒÁÕÍÂÙèáÅéÇËÃ×ÍäÁè ","<a href='javascript:history.back(1)'> ¡ÅÑºä»µÃÇšÊÍº</a>"); 
                 exit;
              }             
              $sql = "Update $table set call_type='$type_call',open_call_dte='$opent_call_dte',
                     open_call_tme='$opent_call_tme',customer_call='$customer_call',caller_name='$call_name',
                     category_type='$cate_id',job_no='$job_no',bss_msr_no='$bssmsr_no',site_id='$site_id',
                     site_province='$site_province',customer_contact='$contact_name',customer_tel='$contact_tel',problem='$problem',
                     severity='$cat',sla='$slatime',open_type='$openttype',reciept_job_bss='$user_receipt',
                     type_service='$srvtype',reciept_job_user_id='$user_engineer',problem_solving='$problemsolving',serial_no_old='$seria_old',
                     serial_no_new='$seria_new',dateline_solving='$deadline',onsite_datetime='$onsite_dtetime',fixed_time='$fixed_dtetime',
                     closed_date='$clode_dte',closed_time='$clode_tme',status_call='$stats',user_update='$user',user_update_datetime='$dte_tme',doc='$doc',
                     provice_phase='$provice_phase',type_problem='$problem_type',serial_type='$serial_type',commente='$comment',resolv_type='$resolv_type',
                     shared_location_in = '$shred_location_in', shared_location_out='$shred_location_out',appoint_date = '$appoint_date',appoint_time = '$appoint_time'";  
                            
            $usege_timing = dte_diff($opent_call_dte." ".$opent_call_tme,$clode_dte." ".$clode_tme);





            $diff_tme = $slatime +  $usege_timing;	
		$status_sla_str = "";
           if ($stats != "feedback") {	
               // if ($usege_timing <= $slatime) {
			  if($diff_tme>0){
					    $sts = "WSLA";
			$status_sla_str = "(äÁèµ¡ SLA)";	
					} else if($diff_tme<0){	
					$sts = "FSLA";     
			$status_sla_str = "(µ¡ SLA)";
			}
                $sql .= ",status_sla = '" .$sts."'";
            }    



            $sql .= " Where id = '". $id ."'";
          mysqli_query($conn,$sql);
		


        } 
		
			
		
	
  		header("location:logcall.index.msi.php?dte_beg=$dte_beg&dte_end=$dte_end");
		

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
