
<?      // Chipset TPS 5112
header("Content-Type: text/html; charset=tis-620");                 
session_start();
require_once("function.php");                                   
                                                                         
 //include("header.php"); 
	
  $dte = array ('2012-07','2012-08','2012-09','2012-10','2012-11','2012-12');//'January','February','March','April','May','June',
  $mons = array('July ','August','September','October','November','December');

?>
<html>
<head>
<meta http-equiv="refresh" content="84000;"/>
<link href="image/bss_icon.ico"   rel="shortcut icon" />
<link href="style/calendar.css" rel="stylesheet" type="text/css">
<link href="style/mytable.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="script/calendar_date_picker.js"></script>
<link href="style/stylecss.css" rel="stylesheet" type="text/css">
<link href="style/filtergrid.css" rel="stylesheet" type="text/css">

<style type="text/css">
    <!--
    .mytable1 {    width:100%; font-size:12px;
                border:1px solid #ccc;
                font-size:11px;     
    }
    .mytable11 {width:100%; font-size:12px;                                                               
                border:1px solid #ccc;
                font-size:11px;     
    }
   .th{ background-color:#003366; color:#FFF; padding:0px; border:0px solid #ccc; height:20px; } 
    -->
</style> 
<body>
<br>
<!-----Start Amount------>
	<?
	$sql_clear="DELETE FROM tbl_rpt_summary_amount";
	mysqli_query($conn,$sql_clear);
	echo "<font color='red'>".$sql_clear."</font><br>";
	for ($i=0;$i<6;$i++) {
	   $cat0=getMinAvgMaxTimeSV($dte[$i],"CAT 0");
	   $cat1=getMinAvgMaxTimeSV($dte[$i],"CAT 1");
	   $cat2=getMinAvgMaxTimeSV($dte[$i],"CAT 2");
	   $cat3=getMinAvgMaxTimeSV($dte[$i],"CAT 3");
    
	$sql="INSERT INTO tbl_rpt_summary_amount(month, cat0, cat1, cat2, cat3) 
          VALUES ('".$mons[$i]."', '$cat0', '$cat1', '$cat2', '$cat3')";
	mysqli_query($conn,$sql);
    echo "<font color='red'>".$sql."</font><br>";
	
	} ?>
<!-----End Amount------>

<!-----Start AmountByLocation------>
<?
	   $sql_clear="DELETE FROM tbl_rpt_summary_amount_by_location";
	   mysqli_query($conn,$sql_clear);
	   echo "<font color='blue'>".$sql_clear."</font><br>";
	   
	   for ($i=0;$i<6;$i++) {
			  $bkk_cat0=getAmountByLocation($dte[$i],"CAT 0","c","bkk");
			  $bkk_cat1=getAmountByLocation($dte[$i],"CAT 1","c","bkk");
			  $bkk_cat2=getAmountByLocation($dte[$i],"CAT 2","c","bkk");
			  $bkk_cat3=getAmountByLocation($dte[$i],"CAT 3","c","bkk");       
			  $c_cat0=getAmountByLocation($dte[$i],"CAT 0","c","");
			  $c_cat1=getAmountByLocation($dte[$i],"CAT 1","c","");
			  $c_cat2=getAmountByLocation($dte[$i],"CAT 2","c","");
			  $c_cat3=getAmountByLocation($dte[$i],"CAT 3","c","");       
			  $n_cat0=getAmountByLocation($dte[$i],"CAT 0","n","");             
			  $n_cat1=getAmountByLocation($dte[$i],"CAT 1","n","");           
			  $n_cat2=getAmountByLocation($dte[$i],"CAT 2","n","");
			  $n_cat3=getAmountByLocation($dte[$i],"CAT 3","n","");     
			  $en_cat0=getAmountByLocation($dte[$i],"CAT 0","en",""); 
			  $en_cat1=getAmountByLocation($dte[$i],"CAT 1","en","");
			  $en_cat2=getAmountByLocation($dte[$i],"CAT 2","en","");
			  $en_cat3=getAmountByLocation($dte[$i],"CAT 3","en","");    
			  $s_cat0=getAmountByLocation($dte[$i],"CAT 0","s","");
			  $s_cat1=getAmountByLocation($dte[$i],"CAT 1","s","");
			  $s_cat2=getAmountByLocation($dte[$i],"CAT 2","s","");
			  $s_cat3=getAmountByLocation($dte[$i],"CAT 3","s","");                                                                                       
			  $e_cat0=getAmountByLocation($dte[$i],"CAT 0","e","");
			  $e_cat1=getAmountByLocation($dte[$i],"CAT 1","e","");
			  $e_cat2=getAmountByLocation($dte[$i],"CAT 2","e","");
			  $e_cat3=getAmountByLocation($dte[$i],"CAT 3","e","");    
			  $w_cat0=getAmountByLocation($dte[$i],"CAT 0","w","");
			  $w_cat1=getAmountByLocation($dte[$i],"CAT 1","w","");
			  $w_cat2=getAmountByLocation($dte[$i],"CAT 2","w","");
			  $w_cat3=getAmountByLocation($dte[$i],"CAT 3","w","");
    
	     $sql="INSERT INTO tbl_rpt_summary_amount_by_location
         (month, bkk_cat0, bkk_cat1, bkk_cat2, bkk_cat3, c_cat0, c_cat1, c_cat2, c_cat3, n_cat0, n_cat1, n_cat2, n_cat3,
		 en_cat0, en_cat1, en_cat2, en_cat3, s_cat0, s_cat1, s_cat2, s_cat3, e_cat0, e_cat1, e_cat2, e_cat3, w_cat0, w_cat1, w_cat2, w_cat3) 
         VALUES ('".$mons[$i]."', '".$bkk_cat0."', '".$bkk_cat1."', '".$bkk_cat2."', '".$bkk_cat3."', '".$c_cat0."', '".$c_cat1."', '".$c_cat2."', '".$c_cat3."', '".$n_cat0."', '".$n_cat1."', '".$n_cat2."', '".$n_cat3."',
         '".$en_cat0."', '".$en_cat1."', '".$en_cat2."', '".$en_cat3."', '".$s_cat0."', '".$s_cat1."', '".$s_cat2."', '".$s_cat3."', '".$e_cat0."', '".$e_cat1."', '".$e_cat2."', '".$e_cat3."', '".$w_cat0."', '".$w_cat1."', '".$w_cat2."', '".$w_cat3."')";
	     mysqli_query($conn,$sql);
         echo "<font color='blue'>".$sql."</font><br>";
	      } ?>
<!-----End AmountByLocation------>

<!-----Start cntSLA------>
<?
	   $sql_clear="DELETE FROM tbl_rpt_summary_cntsla";
	   mysqli_query($conn,$sql_clear);
	   echo "<font color='green'>".$sql_clear."</font><br>";
	   
	   for ($i=0;$i<6;$i++) {                
       $cat0_fail=cntSLA($dte[$i],"close","CAT 0","FSLA");
       $cat0_within=cntSLA($dte[$i],"close","CAT 0","WSLA");
       $cat0_cancel=cntSLA($dte[$i],"cancel","CAT 0","");     
       $cat1_fail=cntSLA($dte[$i],"close","CAT 1","FSLA");
       $cat1_within=cntSLA($dte[$i],"close","CAT 1","WSLA");
       $cat1_cancel=cntSLA($dte[$i],"cancel","CAT 1","");         
       $cat2_fail=cntSLA($dte[$i],"close","CAT 2","FSLA");
       $cat2_within=cntSLA($dte[$i],"close","CAT 2","WSLA");
       $cat2_cancel=cntSLA($dte[$i],"cancel","CAT 2","");        
       $cat3_fail=cntSLA($dte[$i],"close","CAT 3","FSLA");
       $cat3_within=cntSLA($dte[$i],"close","CAT 3","WSLA");
       $cat3_cancel=cntSLA($dte[$i],"cancel","CAT 3","");

	   $sql="INSERT INTO tbl_rpt_summary_cntsla
	   (month, cat0_fail, cat0_within, cat0_cancel, cat1_fail, cat1_within, cat1_cancel, cat2_fail,
	   cat2_within, cat2_cancel, cat3_fail, cat3_within, cat3_cancel) 
	   VALUES
	   ('".$mons[$i]."', '".$cat0_fail."', '".$cat0_within."', '".$cat0_cancel."', '".$cat1_fail."', '".$cat1_within."', '".$cat1_cancel."',
	   '".$cat2_fail."', '".$cat2_within."', '".$cat2_cancel."', '".$cat3_fail."', '".$cat3_within."', '".$cat3_cancel."')";
	   mysqli_query($conn,$sql);
       echo "<font color='green'>".$sql."</font><br>";

	} ?>
<!-----End cntSLA------>

<!-----Start cntSLAByLocation------>
<?
	   $sql_clear="DELETE FROM tbl_rpt_summary_cntsla_by_location";
	   mysqli_query($conn,$sql_clear);
	   echo "<font color='violet'>".$sql_clear."</font><br>";
	   
	    for ($i=0;$i<6;$i++) {                 
        $bkk_fail=cntSLAByLocation($dte[$i],"close","FSLA","c","bkk");
        $bkk_within=cntSLAByLocation($dte[$i],"close","WSLA","c","bkk");
        $bkk_cancel=cntSLAByLocation($dte[$i],"cancel","","c","bkk");           
        $c_fail=cntSLAByLocation($dte[$i],"close","FSLA","c","");
        $c_within=cntSLAByLocation($dte[$i],"close","WSLA","c","");
        $c_cancel=cntSLAByLocation($dte[$i],"cancel","","c","");           
        $n_fail=cntSLAByLocation($dte[$i],"close","FSLA","n","");
        $n_within=cntSLAByLocation($dte[$i],"close","WSLA","n","");
        $n_cancel=cntSLAByLocation($dte[$i],"cancel","","n","");           
        $en_fail=cntSLAByLocation($dte[$i],"close","FSLA","en","");                
        $en_within=cntSLAByLocation($dte[$i],"close","WSLA","en","");
        $en_cancel=cntSLAByLocation($dte[$i],"cancel","","en","");          
        $s_fail=cntSLAByLocation($dte[$i],"close","FSLA","s","");
        $s_within=cntSLAByLocation($dte[$i],"close","WSLA","s","");
        $s_cancel=cntSLAByLocation($dte[$i],"cancel","","s","");          
        $e_fail=cntSLAByLocation($dte[$i],"close","FSLA","e","");
        $e_within=cntSLAByLocation($dte[$i],"close","WSLA","e","");
        $e_cancel=cntSLAByLocation($dte[$i],"cancel","","e","");                    
        $w_fail=cntSLAByLocation($dte[$i],"close","FSLA","w","");
        $w_within=cntSLAByLocation($dte[$i],"close","WSLA","w","");
        $w_cancel=cntSLAByLocation($dte[$i],"cancel","","w","");
		
	   $sql="INSERT INTO tbl_rpt_summary_cntsla_by_location
	   (month, bkk_fail, bkk_within, bkk_cancel, c_fail, c_within, c_cancel, n_fail, n_within, n_cancel,
	   en_fail, en_within, en_cancel, s_fail, s_within, s_cancel, e_fail, e_within, e_cancel, w_fail, w_within, w_cancel) 
	   VALUES
	   ('".$mons[$i]."', '".$bkk_fail."', '".$bkk_within."', '".$bkk_cancel."', '".$c_fail."', '".$c_within."', '".$c_cancel."', '".$n_fail."', '".$n_within."', '".$n_cancel."',
	   '".$en_fail."', '".$en_within."', '".$en_cancel."', '".$s_fail."', '".$s_within."', '".$s_cancel."', '".$e_fail."', '".$e_within."', '".$e_cancel."', '".$w_fail."', '".$w_within."', '".$w_cancel."')";
	   mysqli_query($conn,$sql);
       echo "<font color='violet'>".$sql."</font><br>";
	 } ?>
<!-----End cntSLAByLocation------>


<!-----Start hardware------>


	<?
	   $sql_clear="DELETE FROM tbl_rpt_summary_category";
	   mysqli_query($conn,$sql_clear);
	   echo "<font color='black'>".$sql_clear."</font><br>";
	   
	   for ($i=0;$i<6;$i++) {
			  $a1=getReplace($dte[$i],"1");
			  $a2=getReplace($dte[$i],"2");
			  $a3=getReplace($dte[$i],"3");
			  $a4=getReplace($dte[$i],"4");
			  $a6=getReplace($dte[$i],"6");
			  $a7=getReplace($dte[$i],"7");
			  $a8=getReplace($dte[$i],"8");
			  $a9=getReplace($dte[$i],"9");
			  $a10=getReplace($dte[$i],"10");
			  $a11=getReplace($dte[$i],"11");
			  $a12=getReplace($dte[$i],"12");
			  $a13=getReplace($dte[$i],"13");
			  $a14=getReplace($dte[$i],"14");
			  $a16=getReplace($dte[$i],"16");
			  $a18=getReplace($dte[$i],"18");
			  $a19=getReplace($dte[$i],"19");
			  $a20=getReplace($dte[$i],"20");
			  $a22=getReplace($dte[$i],"22");
			  $a25=getReplace($dte[$i],"25");
			  $a27=getReplace($dte[$i],"27");
			  $a30=getReplace($dte[$i],"30");
			  $a31=getReplace($dte[$i],"31");
			  $a32=getReplace($dte[$i],"32");
			  $a33=getReplace($dte[$i],"33");
			  $a34=getReplace($dte[$i],"34");
			  $a36=getReplace($dte[$i],"36");
			  $a37=getReplace($dte[$i],"37");
			  $a45=getReplace($dte[$i],"45");
			  $a60=getReplace($dte[$i],"60");
			  $a61=getReplace($dte[$i],"61");
			  $a62=getReplace($dte[$i],"62");
			  $a63=getReplace($dte[$i],"63");
			  $a64=getReplace($dte[$i],"64");
			  $a65=getReplace($dte[$i],"65");
			  $a66=getReplace($dte[$i],"66");
			  $a67=getReplace($dte[$i],"67");
			  $a68=getReplace($dte[$i],"68");
			  
	   $sql="INSERT INTO tbl_rpt_summary_category
	   (month, `1`, `2`, `3`, `4`, `6`, `7`, `8`, `9`, `10`, `11`, `12`, `13`, `14`, `16`, `18`, `19`, `20`, `22`, `25`, `27`, `30`, `31`, `32`, `33`, `34`, `36`, `37`, `45`, `60`, `61`, `62`, `63`, `64`, `65`, `66`, `67`, `68`) 
	   VALUES ('".$mons[$i]."', '".$a1."', '".$a2."', '".$a3."', '".$a4."', '".$a6."', '".$a7."', '".$a8."', '".$a9."', '".$a10."', '".$a11."', '".$a12."', '".$a13."', '".$a14."', '".$a16."', '".$a18."', '".$a19."', '".$a20."', '".$a22."', '".$a25."', '".$a27."', '".$a30."', '".$a31."', '".$a32."', '".$a33."', '".$a34."', '".$a36."', '".$a37."', '".$a45."', '".$a60."', '".$a61."', '".$a62."', '".$a63."', '".$a64."', '".$a65."', '".$a66."', '".$a67."', '".$a68."')";
	   mysqli_query($conn,$sql);
       echo "<font color='black'>".$sql."</font><br>";

    }?>  

<!-----End hardware------>

<!-----Start 10 SITE------>
<?
	   $sql_clear="DELETE FROM tbl_rpt_summary_top10site";
	   mysqli_query($conn,$sql_clear);
	   echo "<font color='orange'>".$sql_clear."</font><br>";
	   
	   for ($i=0;$i<6;$i++) { 
                   $sql1 = "SELECT
                                tbl_log_call_center.site_id,
                                Count(tbl_log_call_center.site_id) AS max_count,
                                tbl_station_ngv.site_name
                                FROM
                                tbl_log_call_center
                                Inner Join tbl_station_ngv ON tbl_log_call_center.site_id = tbl_station_ngv.site_id
                                where open_call_dte like '".$dte[$i]."%' and category_type = '9' and status_call = 'close'
                                GROUP BY site_id
                                ORDER BY max_count DESC
                                limit 0,10";// echo $sql1;
                    $sql_all = mysqli_query($conn,$sql1);
                     $ii=0;
                     while($c_all = mysqli_fetch_array($sql_all)){
							$ii++;
                            $no=$ii;   
                            $site_id=$c_all["site_id"];            
                            $site_name=$c_all["site_name"];                                                                                                                                                                 
                            $cat0=getMonthSLA($dte[$i],$c_all["site_id"],"CAT 0");
                            $cat1=getMonthSLA($dte[$i],$c_all["site_id"],"CAT 1");
                            $cat2=getMonthSLA($dte[$i],$c_all["site_id"],"CAT 2");                                                                                                                           
                            $cat3=getMonthSLA($dte[$i],$c_all["site_id"],"CAT 3");
                            $total=$c_all["max_count"];;        
		
					 $sql="INSERT INTO tbl_rpt_summary_top10site
					 (month, no, site_id, site_name, cat0, cat1, cat2, cat3, total) 
					 VALUES ('".$mons[$i]."', '".$ii."', '".$site_id."', '".$site_name."', '".$cat0."', '".$cat1."', '".$cat2."', '".$cat3."', '".$total."')";
					 mysqli_query($conn,$sql);
					 echo "<font color='orange'>".$sql."</font><br>";
					 } } ?>
					 
<!-----End 10 SITE------>


<?
function getMinAvgMaxTimeSV($dte,$cate){
	global $conn;
$sql1 = "SELECT                           
                COUNT(tbl_log_call_center.job_no) as cntjob_no,
                MIN(TIMEDIFF(CONCAT(tbl_log_call_center.closed_date ,' ' ,tbl_log_call_center.closed_time),CONCAT(tbl_log_call_center.open_call_dte ,' ' ,tbl_log_call_center.open_call_tme))) AS mint,
                MAX(TIMEDIFF(CONCAT(tbl_log_call_center.closed_date ,' ' ,tbl_log_call_center.closed_time),CONCAT(tbl_log_call_center.open_call_dte ,' ' ,tbl_log_call_center.open_call_tme))) AS maxt,
                SUM(TIME_TO_SEC(TIMEDIFF(CONCAT(tbl_log_call_center.closed_date ,' ' ,tbl_log_call_center.closed_time),CONCAT(tbl_log_call_center.open_call_dte ,' ' ,tbl_log_call_center.open_call_tme)))) AS totaltime
                    FROM
                    tbl_log_call_center
                    Where tbl_log_call_center.open_call_dte like '$dte%'
                    And tbl_log_call_center.category_type = '9'
                    And tbl_log_call_center.severity = '$cate'
                    And tbl_log_call_center.status_call = 'close'";
  $rc = mysqli_query($conn,$sql1);  
  while($c = mysqli_fetch_array($rc)){        
      $cnt_job = $c["cntjob_no"];
      if($cnt_job==0){
                    $cnt_job = "1";
      }
            $avg = sec2hms($c["totaltime"]/$cnt_job,false);                        
    //  if($avg==0){
    //   $avg = "";   
    //  }
      $min = $c["mint"];
      $max = $c["maxt"];
   return $min."/".$avg."/".$max;
  } 
}

  function sec2hms($sec, $padHours = false){       
    $hms = "";                                       
    $hours = intval(intval($sec) / 3600);                 
    $hms .= ($padHours) 
          ? str_pad($hours, 2, "0", STR_PAD_LEFT). ":"
          : $hours. ":";                                               
    $minutes = intval(($sec / 60) % 60);               
    $hms .= str_pad($minutes, 2, "0", STR_PAD_LEFT). ":";    
    $seconds = intval($sec % 60);                          
    $hms .= str_pad($seconds, 2, "0", STR_PAD_LEFT);  
    return $hms;      
  }

function getAmountByLocation($dte,$cat,$phase,$bkk){ 
global $conn;
$sql = "";                     
             $sql = "SELECT
                count(tbl_log_call_center.job_no) as cnt
                FROM
                tbl_log_call_center
                Inner Join tbl_station_ngv ON tbl_log_call_center.site_id = tbl_station_ngv.site_id
                Where tbl_log_call_center.open_call_dte like '$dte%'
                And tbl_log_call_center.status_call = 'close'
                And tbl_log_call_center.category_type = '9'
                And tbl_log_call_center.severity = '$cat'
                And tbl_station_ngv.provice_phase = '$phase'";
              if($bkk==""){
					 $l=iconv('UTF-8','TIS-620',"กรุงเทพ");
                   $sql .= " And tbl_station_ngv.site_province not in ('$l')";
                } else {
					 $l=iconv('UTF-8','TIS-620',"กรุงเทพ");
                   $sql .= " And tbl_station_ngv.site_province = '$l'";                      
                }
  $rc = mysqli_query($conn,$sql);  
  $c = mysqli_fetch_array($rc);  
  $cnt_ = $c["cnt"];
  if($cnt_==0){
     $cnt_ = "";
  } 
   return $cnt_;            
}

function cntSLA($dte,$status,$cate,$sla){
	global $conn;
     $sql = "SELECT
                count(tbl_log_call_center.job_no) as cnt_job
                FROM
                tbl_log_call_center
                Where tbl_log_call_center.open_call_dte like '$dte%'
                And tbl_log_call_center.category_type = '9'
                And tbl_log_call_center.status_call = '$status'
                And tbl_log_call_center.severity = '$cate'";
                if($status=="close"){
                    $sql .= " And tbl_log_call_center.status_sla = '$sla'";
                }
     $rc = mysqli_query($conn,$sql);
     $c = mysqli_fetch_array($rc);
     $cnt = $c["cnt_job"];
     if($cnt==0){
        $cnt = ""; 
     }
     return $cnt;
}

function cntSLAByLocation($dte,$status,$sla,$phase,$bkk){
	global $conn;
     $sql = "SELECT
                    count(tbl_log_call_center.job_no) as cnt_job
                    FROM
                    tbl_log_call_center
                    Inner Join tbl_station_ngv ON tbl_log_call_center.site_id = tbl_station_ngv.site_id
                    Where tbl_log_call_center.open_call_dte like '$dte%'
                    And tbl_log_call_center.category_type = '9'
                    And tbl_log_call_center.status_call = '$status'";
                    
                    if($status=="close"){
                    $sql .= " And tbl_log_call_center.status_sla = '$sla'";
                    }
                    
                    $sql .= " And tbl_station_ngv.provice_phase = '$phase'";
                    
                    if($bkk!=""){
					 $l=iconv('UTF-8','TIS-620',"กรุงเทพ");
                      $sql .= " And tbl_station_ngv.site_province in ('$l')";
                    }else{
					 $l=iconv('UTF-8','TIS-620',"กรุงเทพ");
                       $sql .= " And tbl_station_ngv.site_province not in ('$l')";  
                    }
                    
                    
     $rc = mysqli_query($conn,$sql);
     $c = mysqli_fetch_array($rc);
     $cnt = $c["cnt_job"];
     if($cnt==0){
        $cnt = ""; 
     }
     return $cnt;
}

function getReplace($dte,$cate_id){
	global $conn;
  $sql_reqlacement = "SELECT count(tbl_log_call_center.job_no) as cnt_job
                        FROM
                        tbl_log_call_center
                        Inner Join tbl_category_hardware ON tbl_log_call_center.serial_type = tbl_category_hardware.cate_id
                        WHERE tbl_log_call_center.open_call_dte like '$dte%'
                        AND tbl_log_call_center.status_call = 'close'
                        AND tbl_category_hardware.cate_id = '$cate_id'";  
  $rc_replacement = mysqli_query($conn,$sql_reqlacement);
  $c_replacement = mysqli_fetch_array($rc_replacement);
  $ctn_replacement = $c_replacement["cnt_job"]; 
   if($ctn_replacement==0){
        $ctn_replacement = "";
   }  
  return $ctn_replacement; 
}

function getMonthSLA($dte,$site_id,$cat){
	global $conn;
    $sql_monthSLA = "SELECT                 
                count(tbl_log_call_center.severity) as cnt_job
                FROM
                tbl_log_call_center
                where open_call_dte like '$dte%' 
                and category_type = '9' 
                and status_call = 'close'
                And tbl_log_call_center.site_id = '$site_id'
                And tbl_log_call_center.severity = '$cat'";   
    $rc_monthSLA = mysqli_query($conn,$sql_monthSLA);
    $c_monthSLA = mysqli_fetch_array($rc_monthSLA);
    $cnt = $c_monthSLA["cnt_job"];
    if($cnt==0){
        $cnt = "";
    }
    return $cnt;
}

?>
