<?


require_once("function.php");
	if(!checkUser()){    echo Message(35,"red",$titel1,$msg1,"<a href='index.php'> $login </a>");
		   exit;
	}
	if($_SESSION["Ustate"] == "user") {
		 echo Message(35,"red",$titel1,$msg2,"<a href='javascript:history.back(1)'> $back</a>");
	        exit;
	} 
	//$_SESSION["Uid"]
        $job_id = trim($_REQUEST["job_id"]);    
        $job_no = trim($_REQUEST["job_no"]);    
        $job_date = trim($_REQUEST["job_date"]);   
        $job_type = trim($_REQUEST["job_type"]);   
        $site_id = trim($_REQUEST["txtSid"]);
        $category_type = trim($_REQUEST["CateTypeID"]);   
        $job_problem = trim($_REQUEST["job_problem"]);   
        $job_solution = trim($_REQUEST["job_solution"]);   
        $job_start_date = trim($_REQUEST["job_start_date"]);   
        $job_start_timex = $_REQUEST["job_start_time_hx"].":".$_REQUEST["job_start_time_t"].":00"; 
        $job_end_date = trim($_REQUEST["job_end_date"]);   
        $job_start_time = trim($_REQUEST["job_start_time_hs"]).":".$_REQUEST["job_end_timec"].":00"; 

        $job_engineer_reciept_id = trim($_REQUEST["job_engineer_reciept_id"]);  
        $job_status = $_REQUEST["job_status"];  

        $table = "tbl_log_call_bss";
        $user = $_SESSION["Uid"];                      
        $dte_tme = getDteTme();         
		$dte_beg = $_REQUEST["dte_beg"];
	    $dte_end = $_REQUEST["dte_end"];
  if($job_id == ""){
	   $id = AutoNumber($table,"job_id");
            $sql = "Insert into $table (job_id,job_no,job_date,job_type,site_id,category_type,job_problem,job_start_date,job_start_time,job_reciept_user_id,job_engineer_reciept_id,user_create_date,job_status,logfrom)
                 values ('$id','$job_no','$job_date','$job_type','$site_id','$category_type','$job_problem','$job_start_date',
				 '$job_start_timex','$user','$job_engineer_reciept_id','$user','Onsite','bsslog')";       
           // echo $sql;exit;                        
            mysqli_query($conn,$sql);
             header("location:bsslogcall.index.php?dte_beg=$dte_beg&dte_end=$dte_end");
        } else  if ($job_id != "") {               
             $sql="Update $table set category_type = '$category_type',job_solution='$job_solution',job_start_date='$job_start_date',job_start_time='$job_start_timex',job_end_date='$job_end_date',job_end_time='$job_start_time',job_engineer_reciept_id='$job_engineer_reciept_id',job_status='$job_status' where job_id = $job_id and logfrom='bsslog'";
			// echo $sql;exit;
			mysqli_query($conn,$sql);
             header("location:bsslogcall.index.php?dte_beg=$dte_beg&dte_end=$dte_end");
        } 
           
?>
