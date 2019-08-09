<?
header("Content-Type: text/html; charset=tis-620");                 
session_start();
require_once("function.php");                                 
?>
<meta http-equiv="refresh" content="84000;"/>
<?
 

	  $months = $_REQUEST["months"];
      $years = $_REQUEST["years"];
	  $today = getdate();
//	  print_r($today);
	  if ( $months == "" || $years=="" ) {
			$months =  date("m");  //$today["mon"]
			$years = $today["year"];
			$dte = $years."-".$months;//formatNum($months,1)
	  } else  {
		$dte = $years."-".$months; 
	  }
	  
	  

$sql_clear="DELETE FROM tbl_cm_sla_percentage_oil";
mysqli_query($conn,$sql_clear);
echo "<font color='orange'>".$sql_clear."</font><br>";
$sql_clear="DELETE FROM tbl_cm_sla_hardware_oil";
mysqli_query($conn,$sql_clear);
echo "<font color='orange'>".$sql_clear."</font><br>";
$sql_clear="DELETE FROM tbl_cm_sla_site_oil";
mysqli_query($conn,$sql_clear);
echo "<font color='orange'>".$sql_clear."</font><br>";



echo "BSS <br>";	  
/*  replace  */	  
$cm_oil_percall_wsla = getRowReportType2("$dte","3","1","","BSS","WSLA");	 
$cm_oil_percall_sitename = "Biserv Solution";
$cm_oil_percall_inprogress=getRowReportType2("$dte","3","1","feedback","BSS","");
$cm_oil_percall_fsla=getRowReportType2("$dte","3","1","","BSS","FSLA");
$cm_oil_percall_close=getRowReportType2("$dte","3","1","close","BSS","");
$cm_oil_percall_cancel=getRowReportType2("$dte","3","1","cancel","BSS","");
$cm_oil_percall_total=getRowReportType2("$dte","3","1","","BSS","");
$cm_oil_packages_wsla = getRowReportType2("$dte","3","1","","BSS","WSLA");	 
$cm_oil_packages_sitename = "Biserv Solution";
$cm_oil_packages_inprogress=getRowReportType2("$dte","3","2","feedback","BSS","");
$cm_oil_packages_fsla=getRowReportType2("$dte","3","2","","BSS","FSLA");
$cm_oil_packages_close=getRowReportType2("$dte","3","2","close","BSS","");
$cm_oil_packages_cancel=getRowReportType2("$dte","3","2","cancel","BSS","");
$cm_oil_packages_total=getRowReportType2("$dte","3","2","","BSS","");
$cm_oil_percall_wsla = getRowReportType2("$dte","3","2","","BSS","WSLA");	
/*  explode  */
$a = explode(" ", $cm_oil_percall_wsla);
$b = explode(" ", $cm_oil_percall_fsla);
$c = explode(" ", $cm_oil_percall_close);
$d = explode(" ", $cm_oil_percall_cancel);
$e = explode(" ", $cm_oil_percall_inprogress);
$f = explode(" ", $cm_oil_percall_total);

$a1 = explode(" ", $cm_oil_packages_wsla);
$b1 = explode(" ", $cm_oil_packages_fsla);
$c1 = explode(" ", $cm_oil_packages_close);
$d1 = explode(" ", $cm_oil_packages_cancel);
$e1 = explode(" ", $cm_oil_packages_inprogress);
$f1 = explode(" ", $cm_oil_packages_total);



$cm_oil_percall_wsla_job =$a[0];
$cm_oil_percall_wsla_percentage=$a[1];
$cm_oil_percall_fsla_job =$b[0];
$cm_oil_percall_fsla_percentage =$b[1];
$cm_oil_percall_close_job =$c[0];
$cm_oil_percall_close_percentage =$c[1];
$cm_oil_percall_cancel_job =$d[0];
$cm_oil_percall_cancel_percentage =$d[1];
$cm_oil_percall_inprogress_job =$e[0];
$cm_oil_percall_inprogress_percentage =$e[1];
$cm_oil_percall_total_job =$f[0];
$cm_oil_percall_total_percentage =$f[1];

$cm_oil_packages_wsla_job=$a1[0];
$cm_oil_packages_wsla_percentage =$a1[1];
$cm_oil_packages_fsla_job =$b1[0];
$cm_oil_packages_fsla_percentage =$b1[1];
$cm_oil_packages_close_job =$c1[0];
$cm_oil_packages_close_percentage =$c1[1];
$cm_oil_packages_cancel_job =$d1[0];
$cm_oil_packages_cancel_percentage =$d1[1];
$cm_oil_packages_inprogress_job =$e1[0];
$cm_oil_packages_inprogress_percentage =$e1[1];
$cm_oil_packages_total_job =$f1[0];
$cm_oil_packages_total_percentage =$f1[1];



/*  insert data  */
$sql="INSERT INTO bizservs_helpdesk.tbl_cm_sla_percentage_oil
(cm_oil_percall_sitename,
cm_oil_percall_wsla_job,
cm_oil_percall_wsla_percentage,
cm_oil_percall_fsla_job,
cm_oil_percall_fsla_percentage,
cm_oil_percall_close_job,
cm_oil_percall_close_percentage,
cm_oil_percall_cancel_job,
cm_oil_percall_cancel_percentage,
cm_oil_percall_inprogress_job,
cm_oil_percall_inprogress_percentage,
cm_oil_percall_total_job,
cm_oil_percall_total_percentage,
cm_oil_packages_sitename,
cm_oil_packages_wsla_job,
cm_oil_packages_wsla_percentage,
cm_oil_packages_fsla_job,
cm_oil_packages_fsla_percentage,
cm_oil_packages_close_job,
cm_oil_packages_close_percentage,
cm_oil_packages_cancel_job,
cm_oil_packages_cancel_percentage,
cm_oil_packages_inprogress_job,
cm_oil_packages_inprogress_percentage,
cm_oil_packages_total_job,
cm_oil_packages_total_percentage) 
VALUES (
'".$cm_oil_percall_sitename."',
'".$cm_oil_percall_wsla_job."',
'".$cm_oil_percall_wsla_percentage."',
'".$cm_oil_percall_fsla_job."',
'".$cm_oil_percall_fsla_percentage."',
'".$cm_oil_percall_close_job."',
'".$cm_oil_percall_close_percentage."',
'".$cm_oil_percall_cancel_job."',
'".$cm_oil_percall_cancel_percentage."',
'".$cm_oil_percall_inprogress_job."',
'".$cm_oil_percall_inprogress_percentage."',
'".$cm_oil_percall_total_job."',
'".$cm_oil_percall_total_percentage."',
'".$cm_oil_packages_sitename."',
'".$cm_oil_packages_wsla_job."',
'".$cm_oil_packages_wsla_percentage."',
'".$cm_oil_packages_fsla_job."',
'".$cm_oil_packages_fsla_percentage."',
'".$cm_oil_packages_close_job."',
'".$cm_oil_packages_close_percentage."',
'".$cm_oil_packages_cancel_job."',
'".$cm_oil_packages_cancel_percentage."',
'".$cm_oil_packages_inprogress_job."',
'".$cm_oil_packages_inprogress_percentage."',
'".$cm_oil_packages_total_job."',
'".$cm_oil_packages_total_percentage."'
)";
mysqli_query($conn,$sql);
echo $sql;

?>
<br><br><br>
<?

echo "MSI <br>";
/*  replace  */	  
$cm_oil_percall_wsla = getRowReportType2("$dte","3","1","","MSI","WSLA");	 
$cm_oil_percall_sitename = "Maximum Solution Idea";
$cm_oil_percall_inprogress=getRowReportType2("$dte","3","1","feedback","MSI","");
$cm_oil_percall_fsla=getRowReportType2("$dte","3","1","","MSI","FSLA");
$cm_oil_percall_close=getRowReportType2("$dte","3","1","close","MSI","");
$cm_oil_percall_cancel=getRowReportType2("$dte","3","1","cancel","MSI","");
$cm_oil_percall_total=getRowReportType2("$dte","3","1","","MSI","");

$cm_oil_packages_wsla = getRowReportType2("$dte","3","2","","MSI","WSLA");	 
$cm_oil_packages_sitename = "Maximum Solution Idea";
$cm_oil_packages_inprogress=getRowReportType2("$dte","3","2","feedback","MSI","");
$cm_oil_packages_fsla=getRowReportType2("$dte","3","2","","MSI","FSLA");
$cm_oil_packages_close=getRowReportType2("$dte","3","2","close","MSI","");
$cm_oil_packages_cancel=getRowReportType2("$dte","3","2","cancel","MSI","");
$cm_oil_packages_total=getRowReportType2("$dte","3","2","","MSI","");


/*  explode  */
$a = explode(" ", $cm_oil_percall_wsla);
$b = explode(" ", $cm_oil_percall_fsla);
$c = explode(" ", $cm_oil_percall_close);
$d = explode(" ", $cm_oil_percall_cancel);
$e = explode(" ", $cm_oil_percall_inprogress);
$f = explode(" ", $cm_oil_percall_total);

$a1 = explode(" ", $cm_oil_packages_wsla);
$b1 = explode(" ", $cm_oil_packages_fsla);
$c1 = explode(" ", $cm_oil_packages_close);
$d1 = explode(" ", $cm_oil_packages_cancel);
$e1 = explode(" ", $cm_oil_packages_inprogress);
$f1 = explode(" ", $cm_oil_packages_total);


$cm_oil_percall_wsla_job =$a[0];
$cm_oil_percall_wsla_percentage=$a[1];
$cm_oil_percall_fsla_job =$b[0];
$cm_oil_percall_fsla_percentage =$b[1];
$cm_oil_percall_close_job =$c[0];
$cm_oil_percall_close_percentage =$c[1];
$cm_oil_percall_cancel_job =$d[0];
$cm_oil_percall_cancel_percentage =$d[1];
$cm_oil_percall_inprogress_job =$e[0];
$cm_oil_percall_inprogress_percentage =$e[1];
$cm_oil_percall_total_job =$f[0];
$cm_oil_percall_total_percentage =$f[1];

$cm_oil_packages_wsla_job=$a1[0];
$cm_oil_packages_wsla_percentage =$a1[1];
$cm_oil_packages_fsla_job =$b1[0];
$cm_oil_packages_fsla_percentage =$b1[1];
$cm_oil_packages_close_job =$c1[0];
$cm_oil_packages_close_percentage =$c1[1];
$cm_oil_packages_cancel_job =$d1[0];
$cm_oil_packages_cancel_percentage =$d1[1];
$cm_oil_packages_inprogress_job =$e1[0];
$cm_oil_packages_inprogress_percentage =$e1[1];
$cm_oil_packages_total_job =$f1[0];
$cm_oil_packages_total_percentage =$f1[1];




/*  insert data  */
$sql="INSERT INTO bizservs_helpdesk.tbl_cm_sla_percentage_oil
(cm_oil_percall_sitename,
cm_oil_percall_wsla_job,
cm_oil_percall_wsla_percentage,
cm_oil_percall_fsla_job,
cm_oil_percall_fsla_percentage,
cm_oil_percall_close_job,
cm_oil_percall_close_percentage,
cm_oil_percall_cancel_job,
cm_oil_percall_cancel_percentage,
cm_oil_percall_inprogress_job,
cm_oil_percall_inprogress_percentage,
cm_oil_percall_total_job,
cm_oil_percall_total_percentage,
cm_oil_packages_sitename,
cm_oil_packages_wsla_job,
cm_oil_packages_wsla_percentage,
cm_oil_packages_fsla_job,
cm_oil_packages_fsla_percentage,
cm_oil_packages_close_job,
cm_oil_packages_close_percentage,
cm_oil_packages_cancel_job,
cm_oil_packages_cancel_percentage,
cm_oil_packages_inprogress_job,
cm_oil_packages_inprogress_percentage,
cm_oil_packages_total_job,
cm_oil_packages_total_percentage) 
VALUES (
'".$cm_oil_percall_sitename."',
'".$cm_oil_percall_wsla_job."',
'".$cm_oil_percall_wsla_percentage."',
'".$cm_oil_percall_fsla_job."',
'".$cm_oil_percall_fsla_percentage."',
'".$cm_oil_percall_close_job."',
'".$cm_oil_percall_close_percentage."',
'".$cm_oil_percall_cancel_job."',
'".$cm_oil_percall_cancel_percentage."',
'".$cm_oil_percall_inprogress_job."',
'".$cm_oil_percall_inprogress_percentage."',
'".$cm_oil_percall_total_job."',
'".$cm_oil_percall_total_percentage."',
'".$cm_oil_packages_sitename."',
'".$cm_oil_packages_wsla_job."',
'".$cm_oil_packages_wsla_percentage."',
'".$cm_oil_packages_fsla_job."',
'".$cm_oil_packages_fsla_percentage."',
'".$cm_oil_packages_close_job."',
'".$cm_oil_packages_close_percentage."',
'".$cm_oil_packages_cancel_job."',
'".$cm_oil_packages_cancel_percentage."',
'".$cm_oil_packages_inprogress_job."',
'".$cm_oil_packages_inprogress_percentage."',
'".$cm_oil_packages_total_job."',
'".$cm_oil_packages_total_percentage."'

)";
mysqli_query($conn,$sql);
echo $sql;

?>
<br><br><br>
<?

echo "TOTAL <br>";
/*  replace  */	  
$cm_oil_percall_wsla = getRowReportType2("$dte","3","1","","","WSLA");	 
$cm_oil_percall_sitename = "TOTAL";
$cm_oil_percall_inprogress=getRowReportType2("$dte","3","1","feedback","","");
$cm_oil_percall_fsla=getRowReportType2("$dte","3","1","","","FSLA");
$cm_oil_percall_close=getRowReportType2("$dte","3","1","close","MSI","");
$cm_oil_percall_cancel=getRowReportType2("$dte","3","1","cancel","","");
$cm_oil_percall_total=getRowReportType2("$dte","3","1","","","");

$cm_oil_packages_wsla = getRowReportType2("$dte","3","2","","MSI","WSLA");	 
$cm_oil_packages_sitename = "TOTAL";
$cm_oil_packages_inprogress=getRowReportType2("$dte","3","2","feedback","","");
$cm_oil_packages_fsla=getRowReportType2("$dte","3","2","","","FSLA");
$cm_oil_packages_close=getRowReportType2("$dte","3","2","close","","");
$cm_oil_packages_cancel=getRowReportType2("$dte","3","2","cancel","","");
$cm_oil_packages_total=getRowReportType2("$dte","3","2","","","");


/*  explode  */
$a = explode(" ", $cm_oil_percall_wsla);
$b = explode(" ", $cm_oil_percall_fsla);
$c = explode(" ", $cm_oil_percall_close);
$d = explode(" ", $cm_oil_percall_cancel);
$e = explode(" ", $cm_oil_percall_inprogress);
$f = explode(" ", $cm_oil_percall_total);

$a1 = explode(" ", $cm_oil_packages_wsla);
$b1 = explode(" ", $cm_oil_packages_fsla);
$c1 = explode(" ", $cm_oil_packages_close);
$d1 = explode(" ", $cm_oil_packages_cancel);
$e1 = explode(" ", $cm_oil_packages_inprogress);
$f1 = explode(" ", $cm_oil_packages_total);



$cm_oil_percall_wsla_job =$a[0];
$cm_oil_percall_wsla_percentage=$a[1];
$cm_oil_percall_fsla_job =$b[0];
$cm_oil_percall_fsla_percentage =$b[1];
$cm_oil_percall_close_job =$c[0];
$cm_oil_percall_close_percentage =$c[1];
$cm_oil_percall_cancel_job =$d[0];
$cm_oil_percall_cancel_percentage =$d[1];
$cm_oil_percall_inprogress_job =$e[0];
$cm_oil_percall_inprogress_percentage =$e[1];
$cm_oil_percall_total_job =$f[0];
$cm_oil_percall_total_percentage =$f[1];

$cm_oil_packages_wsla_job=$a1[0];
$cm_oil_packages_wsla_percentage =$a1[1];
$cm_oil_packages_fsla_job =$b1[0];
$cm_oil_packages_fsla_percentage =$b1[1];
$cm_oil_packages_close_job =$c1[0];
$cm_oil_packages_close_percentage =$c1[1];
$cm_oil_packages_cancel_job =$d1[0];
$cm_oil_packages_cancel_percentage =$d1[1];
$cm_oil_packages_inprogress_job =$e1[0];
$cm_oil_packages_inprogress_percentage =$e1[1];
$cm_oil_packages_total_job =$f1[0];
$cm_oil_packages_total_percentage =$f1[1];



/*  insert data  */
$sql="INSERT INTO bizservs_helpdesk.tbl_cm_sla_percentage_oil
(cm_oil_percall_sitename,
cm_oil_percall_wsla_job,
cm_oil_percall_wsla_percentage,
cm_oil_percall_fsla_job,
cm_oil_percall_fsla_percentage,
cm_oil_percall_close_job,
cm_oil_percall_close_percentage,
cm_oil_percall_cancel_job,
cm_oil_percall_cancel_percentage,
cm_oil_percall_inprogress_job,
cm_oil_percall_inprogress_percentage,
cm_oil_percall_total_job,
cm_oil_percall_total_percentage,
cm_oil_packages_sitename,
cm_oil_packages_wsla_job,
cm_oil_packages_wsla_percentage,
cm_oil_packages_fsla_job,
cm_oil_packages_fsla_percentage,
cm_oil_packages_close_job,
cm_oil_packages_close_percentage,
cm_oil_packages_cancel_job,
cm_oil_packages_cancel_percentage,
cm_oil_packages_inprogress_job,
cm_oil_packages_inprogress_percentage,
cm_oil_packages_total_job,
cm_oil_packages_total_percentage) 
VALUES (
'".$cm_oil_percall_sitename."',
'".$cm_oil_percall_wsla_job."',
'".$cm_oil_percall_wsla_percentage."',
'".$cm_oil_percall_fsla_job."',
'".$cm_oil_percall_fsla_percentage."',
'".$cm_oil_percall_close_job."',
'".$cm_oil_percall_close_percentage."',
'".$cm_oil_percall_cancel_job."',
'".$cm_oil_percall_cancel_percentage."',
'".$cm_oil_percall_inprogress_job."',
'".$cm_oil_percall_inprogress_percentage."',
'".$cm_oil_percall_total_job."',
'".$cm_oil_percall_total_percentage."',
'".$cm_oil_packages_sitename."',
'".$cm_oil_packages_wsla_job."',
'".$cm_oil_packages_wsla_percentage."',
'".$cm_oil_packages_fsla_job."',
'".$cm_oil_packages_fsla_percentage."',
'".$cm_oil_packages_close_job."',
'".$cm_oil_packages_close_percentage."',
'".$cm_oil_packages_cancel_job."',
'".$cm_oil_packages_cancel_percentage."',
'".$cm_oil_packages_inprogress_job."',
'".$cm_oil_packages_inprogress_percentage."',
'".$cm_oil_packages_total_job."',
'".$cm_oil_packages_total_percentage."'
)";
mysqli_query($conn,$sql);
echo $sql;

?>
<br><br><br>
TOP 10 Hardware<br>
					<?
					$sql = "SELECT 
											 Count( a.site_id) AS max_count
											 ,b.cate_name
											 ,a.cate_id
											 FROM tbl_insident_hw a
											 left outer join tbl_category_hardware b on a.cate_id=b.cate_id
											 left outer join tbl_log_call_center c on a.job_no = c.job_no
											 where
											 b.cate_id != '15'
											 and c.category_type = '2'
											 and month(c.open_call_dte)='".$months."'
											 and year(c.open_call_dte)='".$years."'
											 group by a.cate_id
											 Order by max_count DESC limit 10
					
					"; 
					$sql_all = mysqli_query($conn,$sql);
                    $i=0;
                     while($c_all = mysqli_fetch_array($sql_all)){
					 $i++;
					 $sql_s="INSERT INTO bizservs_helpdesk.tbl_cm_sla_hardware_oil (h_no,h_id,h_name,h_amount)
					 VALUES ('".$i."','".$c_all['cate_id']."','".$c_all['cate_name']."','".$c_all['max_count']."')";
					 mysqli_query($conn,$sql_s);
					 echo $sql_s."<br>";
					 
					 
					 } ?>
					 
TOP 10 SITE<br>
					<?
					$sql1 = "Select a.site_id,Count(a.site_id) AS max_count,b.site_name ,c.province_name ,a.call_type
												FROM tbl_log_call_center a
												left outer Join tbl_site b  ON a.site_id = b.site_id
                                                left outer join tbl_province c on b.province_name=c.id
												where
                                                month(a.open_call_dte)='".$months."'
											    and year(a.open_call_dte)='".$years."'
                                                and a.status_call = 'close'
												and a.category_type = '2'
												GROUP BY b.site_id ,b.province_name ,a.call_type
									            ORDER BY max_count DESC limit 10"; 
					$sql_all = mysqli_query($conn,$sql1);
					$i=0;
                     while($c_all = mysqli_fetch_array($sql_all)){
						 $i++;								  
						$sql_s="INSERT INTO bizservs_helpdesk.tbl_cm_sla_site_oil (s_no,s_id,s_name,s_amount,s_province)
							VALUES ('".$i."','".$c_all['site_id']."','".$c_all['site_name']."','".$c_all['max_count']."','".$c_all['province_name']."')";
							mysqli_query($conn,$sql_s);
							echo $sql_s."<br>";
						  }
  
		?>
