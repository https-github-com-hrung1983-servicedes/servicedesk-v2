<?
header("Content-Type: text/html; charset=tis-620");

session_start();
require_once("function.php"); 
//require_once("function.execute.php"); 
if(!checkUser()){    echo Message(35,"red",$titel1,$msg1,"<a href='index.php'> $login </a>");
   exit;
}                 
                                                                              
   $id = $_REQUEST["id"];        
   $other_seq = $_REQUEST["other_seq"];   // echo $other_seq;     exit;
   $table = "tbl_incentive_ot_settlement";  
   $typer = $_REQUEST["typer"];               
   $exited = 0;   
   if($typer == ""){                                 
	   $dte = $_REQUEST["dte"];
       $bill_description = addslashes($_REQUEST["bill_description"]);  
       $bill_no = $_REQUEST["bill_no"];
       $bill_total = $_REQUEST["bill_total"];       
		 $fee_type = $_REQUEST["fee_type"];                                                                      
           if($id != "" && $other_seq ==""){           
              $other_seq = AutoNumber($table." where other_no = $id","other_seq");                                                                                         
              $sql = "Insert into $table (other_no,other_seq,other_dte,bill_description,bill_no,bill_total,feetype)
                       values ('$id','$other_seq','$dte','$bill_description','$bill_no','$bill_total','$fee_type')";  
                      // echo $sql;exit;    
             mysqli_query($conn,$sql);                                            
           } else if($id != "" && $other_seq !=""){                                 
              $sql = "Update $table set other_dte='$dte' ,bill_description='$bill_description',bill_no='$bill_no',bill_total='$bill_total',feetype='$fee_type'
                       Where other_no = $id And other_seq = $other_seq"; 
             mysqli_query($conn,$sql);          
           }  
   } else if($typer == "del"){
       $tal = $_REQUEST["ttotal"];        
       $sql_del = "delete from $table where other_no = $id and other_seq = $other_seq";    // echo $sql_del;
       mysqli_query($conn,$sql_del); 
   } else if($typer == "check"){
	  // PTT
	  $state_cm = $_SESSION["UState"];
	  $cmd_ptt = "";
	  $cmd_retail = "";
	  $cmd_major = "";
	  if($state_cm=="user"){
	  
      $sql_check_ptt = "SELECT tbl_log_call_center.job_no,
			   tbl_log_call_center.doc,tbl_log_call_center.open_call_dte,tbl_log_call_center.paid_status
			FROM tbl_log_call_center 
			Inner Join tbl_incentive_detail ON tbl_log_call_center.job_no = tbl_incentive_detail.job_no
			Where  tbl_log_call_center.category_type in (3,4,5,6,10,11,12,13,14,15,16,18,19,77,79,80,23,24,25,26,27,31,32,33,36,41,42,51,52,56,64,67,81,72,74,75,86,89,91,93,94,106,109,114,116,117,119,121,125,123,129)
			And tbl_incentive_detail.id= '$id'
			And (tbl_log_call_center.paid_status = 'n' Or tbl_log_call_center.doc = 'false')";
      $rs_check_ptt = @mysqli_query($conn,$sql_check_ptt);
      //$row_ptt = mysql_numrows($rs_check_ptt);
     // if(){}
      echo "
<style type='text/css'>
     .th{ background-color:#003366; color:#FFF; padding:0px; border:0px solid #ccc; height:20px; }
 </style>     
      <table  align='center' bordercolor='#000000'   class='mytable' id='table7' border='0' width='60%'><tr>      
      <th class='th'>Job No.</th>
      <th class='th'>By</th>
      <th class='th'>Doc.</th>
      <th class='th'>Paid.</th>
      <th class='th'>Date.</th></tr>";
	while($c_check_ptt = @mysqli_fetch_array($rs_check_ptt)){
	 echo "<tr><td align='center'>&nbsp;".$c_check_ptt["job_no"]."</td>";
	 echo "<td align='center'>PTT</td>
		  <td align='center'>&nbsp;";if($c_check_ptt["doc"]=="false") echo "No"; else echo "Yes";echo "</td>
		  <td align='center'>&nbsp;";if($c_check_ptt["paid_status"]=="n") echo "No"; else echo "Yes";echo "</td>
		  <td align='center'>&nbsp;".$c_check_ptt["open_call_dte"]."</td></tr>";
	 $exited = 1;	 
	}
	// Retail
	$sqk_check_retail ="SELECT tbl_incentive_detail.job_no,
			      itbl_logcall_retail.doc,itbl_logcall_retail.paid_status,itbl_logcall_retail.call_openjob_datetime
			   FROM itbl_logcall_retail
			   Inner Join tbl_incentive_detail ON itbl_logcall_retail.job_no = tbl_incentive_detail.job_no
			   Where itbl_logcall_retail.problem_job in  (8,9,10,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35,36,37,38,39)
			   And tbl_incentive_detail.id= '$id'
			   And (itbl_logcall_retail.paid_status = 'n'  Or itbl_logcall_retail.doc = 'false')";
	 $rs_check_retail = @mysqli_query($conn,$sqk_check_retail); 
	 while($c_retail = @mysqli_fetch_array($rs_check_retail)){
	 echo "<tr><td align='center'>&nbsp;".$c_retail["job_no"]."</td>
		  <td align='center'>&nbsp;Retail Etc.</td>
		  <td align='center'>&nbsp;";if($c_retail["doc"]=="false") echo "No"; else echo "Yes";echo "</td>
		  <td align='center'>&nbsp;";if($c_retail["paid_status"]=="n") echo "No"; else echo "Yes";echo "</td>
		  <td align='center'>&nbsp;".$c_retail["call_openjob_datetime"]."</td></tr>";
	 $exited = 1;	 
	}
	// Major
	 $sqk_check_major ="SELECT tbl_incentive_detail.job_no,
			      tbl_major_logcall.call_openjob_datetime,tbl_major_logcall.doc,tbl_major_logcall.paid_status
			   FROM tbl_incentive_detail
			   Inner Join tbl_major_logcall ON tbl_major_logcall.job_no = tbl_incentive_detail.job_no
			   WHERE tbl_incentive_detail.id =  '$id'
			   And tbl_major_logcall.problem_job in (9,10)
			   And (tbl_incentive_detail.paid_status = 'n' Or tbl_major_logcall.doc = 'f')"; // 
	 $rs_check_major = @mysqli_query($conn,$sqk_check_major); 
	 while($c_major = @mysqli_fetch_array($rs_check_major)){
	 echo "<tr><td align='center'>&nbsp;".$c_major["job_no"]."</td>
	 <td align='center'>&nbsp;Major</td>
		  <td align='center'>&nbsp;";if($c_major["doc"]=="false") echo "No"; else echo "Yes";echo "</td>
		  <td align='center'>&nbsp;";if($c_retail["paid_status"]=="n") echo "No"; else echo "Yes";echo "</td>
		  <td align='center'>&nbsp;".$c_major["call_openjob_datetime"]."</td></tr>";
	 $exited = 1;	 
	}
	 
	 
	 echo "</table>";
	 
	} 
	  
	 if($exited == 0) { 	     
             $sql_check = "update tbl_incentive_ot set status_check = 's' ,authen_by = '1' where id = $id";
             mysqli_query($conn,$sql_check);
	 } else { 
	    echo "<center><input class="form-control"  type='button' value='Back' style='width:130pt;' onclick='history.back();'></center>";
	 } 

}



if($exited==0){
   header("location:incentive.clear.php?id=".$id."&type=edit");
}


    
   
   
   
   
function sumFee($id,$feetype){
	global $conn;
$fee = "0.00";
$sql = "select sum($feetype) as fee from tbl_incentive_detail where id='$id'";
$rc = mysqli_query($conn,$sql);
	while($c=mysqli_fetch_array($rc)){
		$fee = $c["fee"];
	}
return $fee;
}
?>

