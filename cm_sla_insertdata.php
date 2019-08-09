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
	  
	  

$sql_clear="DELETE FROM tbl_cm_sla_percentage";
mysqli_query($conn,$sql_clear);
echo "<font color='orange'>".$sql_clear."</font><br>";
$sql_clear="DELETE FROM tbl_cm_sla_hardware";
mysqli_query($conn,$sql_clear);
echo "<font color='orange'>".$sql_clear."</font><br>";
$sql_clear="DELETE FROM tbl_cm_sla_site";
mysqli_query($conn,$sql_clear);
echo "<font color='orange'>".$sql_clear."</font><br>";



echo "BSS <br>";	  
/*  replace  */	  
$cm_ngv_percall_wsla = getRowReportType2("$dte","2","8","","BSS","WSLA");	 
$cm_ngv_percall_sitename = "Biserv Solution";
$cm_ngv_percall_inprogress=getRowReportType2("$dte","2","8","feedback","BSS","");
$cm_ngv_percall_fsla=getRowReportType2("$dte","2","8","","BSS","FSLA");
$cm_ngv_percall_close=getRowReportType2("$dte","2","8","close","BSS","");
$cm_ngv_percall_cancel=getRowReportType2("$dte","2","8","cancel","BSS","");
$cm_ngv_percall_total=getRowReportType2("$dte","2","8","","BSS","");
$cm_ngv_packages_wsla = getRowReportType2("$dte","2","9","","BSS","WSLA");	 
$cm_ngv_packages_sitename = "Biserv Solution";
$cm_ngv_packages_inprogress=getRowReportType2("$dte","9","8","feedback","BSS","");
$cm_ngv_packages_fsla=getRowReportType2("$dte","2","9","","BSS","FSLA");
$cm_ngv_packages_close=getRowReportType2("$dte","2","9","close","BSS","");
$cm_ngv_packages_cancel=getRowReportType2("$dte","2","9","cancel","BSS","");
$cm_ngv_packages_total=getRowReportType2("$dte","2","9","","BSS","");
$cm_oil_percall_wsla = getRowReportType2("$dte","3","1","","BSS","WSLA");	 
$cm_oil_percall_sitename = "Biserv Solution";
$cm_oil_percall_inprogress=getRowReportType2("$dte","3","1","feedback","BSS","");
$cm_oil_percall_fsla=getRowReportType2("$dte","3","1","","BSS","FSLA");
$cm_oil_percall_close=getRowReportType2("$dte","3","1","close","BSS","");
$cm_oil_percall_cancel=getRowReportType2("$dte","3","1","cancel","BSS","");
$cm_oil_percall_total=getRowReportType2("$dte","3","1","","BSS","");
/*  explode  */
$a = explode(" ", $cm_ngv_percall_wsla);
$b = explode(" ", $cm_ngv_percall_fsla);
$c = explode(" ", $cm_ngv_percall_close);
$d = explode(" ", $cm_ngv_percall_cancel);
$e = explode(" ", $cm_ngv_percall_inprogress);
$f = explode(" ", $cm_ngv_percall_total);

$a1 = explode(" ", $cm_ngv_packages_wsla);
$b1 = explode(" ", $cm_ngv_packages_fsla);
$c1 = explode(" ", $cm_ngv_packages_close);
$d1 = explode(" ", $cm_ngv_packages_cancel);
$e1 = explode(" ", $cm_ngv_packages_inprogress);
$f1 = explode(" ", $cm_ngv_packages_total);

$a2 = explode(" ", $cm_oil_percall_wsla);
$b2 = explode(" ", $cm_oil_percall_fsla);
$c2 = explode(" ", $cm_oil_percall_close);
$d2 = explode(" ", $cm_oil_percall_cancel);
$e2 = explode(" ", $cm_oil_percall_inprogress);
$f2 = explode(" ", $cm_oil_percall_total);

$cm_ngv_percall_wsla_job =$a[0];
$cm_ngv_percall_wsla_percentage=$a[1];
$cm_ngv_percall_fsla_job =$b[0];
$cm_ngv_percall_fsla_percentage =$b[1];
$cm_ngv_percall_close_job =$c[0];
$cm_ngv_percall_close_percentage =$c[1];
$cm_ngv_percall_cancel_job =$d[0];
$cm_ngv_percall_cancel_percentage =$d[1];
$cm_ngv_percall_inprogress_job =$e[0];
$cm_ngv_percall_inprogress_percentage =$e[1];
$cm_ngv_percall_total_job =$f[0];
$cm_ngv_percall_total_percentage =$f[1];

$cm_ngv_packages_wsla_job=$a1[0];
$cm_ngv_packages_wsla_percentage =$a1[1];
$cm_ngv_packages_fsla_job =$b1[0];
$cm_ngv_packages_fsla_percentage =$b1[1];
$cm_ngv_packages_close_job =$c1[0];
$cm_ngv_packages_close_percentage =$c1[1];
$cm_ngv_packages_cancel_job =$d1[0];
$cm_ngv_packages_cancel_percentage =$d1[1];
$cm_ngv_packages_inprogress_job =$e1[0];
$cm_ngv_packages_inprogress_percentage =$e1[1];
$cm_ngv_packages_total_job =$f1[0];
$cm_ngv_packages_total_percentage =$f1[1];

$cm_oil_percall_wsla_job =$a2[0];
$cm_oil_percall_wsla_percentage =$a2[1];
$cm_oil_percall_fsla_job =$b2[0];
$cm_oil_percall_fsla_percentage =$b2[1];
$cm_oil_percall_close_job =$c2[0];
$cm_oil_percall_close_percentage =$c2[1];
$cm_oil_percall_cancel_job =$d2[0];
$cm_oil_percall_cancel_percentage =$d2[1];
$cm_oil_percall_inprogress_job =$e2[0];
$cm_oil_percall_inprogress_percentage =$e2[1];
$cm_oil_percall_total_job =$f2[0];
$cm_oil_percall_total_percentage =$f2[1];


/*  insert data  */
$sql="INSERT INTO bizservs_helpdesk.tbl_cm_sla_percentage
(cm_ngv_percall_sitename,
cm_ngv_percall_wsla_job,
cm_ngv_percall_wsla_percentage,
cm_ngv_percall_fsla_job,
cm_ngv_percall_fsla_percentage,
cm_ngv_percall_close_job,
cm_ngv_percall_close_percentage,
cm_ngv_percall_cancel_job,
cm_ngv_percall_cancel_percentage,
cm_ngv_percall_inprogress_job,
cm_ngv_percall_inprogress_percentage,
cm_ngv_percall_total_job,
cm_ngv_percall_total_percentage,
cm_ngv_packages_sitename,
cm_ngv_packages_wsla_job,
cm_ngv_packages_wsla_percentage,
cm_ngv_packages_fsla_job,
cm_ngv_packages_fsla_percentage,
cm_ngv_packages_close_job,
cm_ngv_packages_close_percentage,
cm_ngv_packages_cancel_job,
cm_ngv_packages_cancel_percentage,
cm_ngv_packages_inprogress_job,
cm_ngv_packages_inprogress_percentage,
cm_ngv_packages_total_job,
cm_ngv_packages_total_percentage,
cm_oil_percall_sitename,
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
cm_oil_percall_total_percentage) 
VALUES (
'".$cm_ngv_percall_sitename."',
'".$cm_ngv_percall_wsla_job."',
'".$cm_ngv_percall_wsla_percentage."',
'".$cm_ngv_percall_fsla_job."',
'".$cm_ngv_percall_fsla_percentage."',
'".$cm_ngv_percall_close_job."',
'".$cm_ngv_percall_close_percentage."',
'".$cm_ngv_percall_cancel_job."',
'".$cm_ngv_percall_cancel_percentage."',
'".$cm_ngv_percall_inprogress_job."',
'".$cm_ngv_percall_inprogress_percentage."',
'".$cm_ngv_percall_total_job."',
'".$cm_ngv_percall_total_percentage."',
'".$cm_ngv_packages_sitename."',
'".$cm_ngv_packages_wsla_job."',
'".$cm_ngv_packages_wsla_percentage."',
'".$cm_ngv_packages_fsla_job."',
'".$cm_ngv_packages_fsla_percentage."',
'".$cm_ngv_packages_close_job."',
'".$cm_ngv_packages_close_percentage."',
'".$cm_ngv_packages_cancel_job."',
'".$cm_ngv_packages_cancel_percentage."',
'".$cm_ngv_packages_inprogress_job."',
'".$cm_ngv_packages_inprogress_percentage."',
'".$cm_ngv_packages_total_job."',
'".$cm_ngv_packages_total_percentage."',
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
'".$cm_oil_percall_total_percentage."'
)";
mysqli_query($conn,$sql);
echo $sql;

?>
<br><br><br>
<?

echo "MSI <br>";
/*  replace  */	  
$cm_ngv_percall_wsla = getRowReportType2("$dte","2","8","","MSI","WSLA");	 
$cm_ngv_percall_sitename = "Maximum Solution Idea";
$cm_ngv_percall_inprogress=getRowReportType2("$dte","2","8","feedback","MSI","");
$cm_ngv_percall_fsla=getRowReportType2("$dte","2","8","","MSI","FSLA");
$cm_ngv_percall_close=getRowReportType2("$dte","2","8","close","MSI","");
$cm_ngv_percall_cancel=getRowReportType2("$dte","2","8","cancel","MSI","");
$cm_ngv_percall_total=getRowReportType2("$dte","2","8","","MSI","");

$cm_ngv_packages_wsla = getRowReportType2("$dte","2","9","","MSI","WSLA");	 
$cm_ngv_packages_sitename = "Maximum Solution Idea";
$cm_ngv_packages_inprogress=getRowReportType2("$dte","9","8","feedback","MSI","");
$cm_ngv_packages_fsla=getRowReportType2("$dte","2","9","","MSI","FSLA");
$cm_ngv_packages_close=getRowReportType2("$dte","2","9","close","MSI","");
$cm_ngv_packages_cancel=getRowReportType2("$dte","2","9","cancel","MSI","");
$cm_ngv_packages_total=getRowReportType2("$dte","2","9","","MSI","");

$cm_oil_percall_wsla = getRowReportType2("$dte","3","1","","MSI","WSLA");	 
$cm_oil_percall_sitename = "Maximum Solution Idea";
$cm_oil_percall_inprogress=getRowReportType2("$dte","3","1","feedback","MSI","");
$cm_oil_percall_fsla=getRowReportType2("$dte","3","1","","MSI","FSLA");
$cm_oil_percall_close=getRowReportType2("$dte","3","1","close","MSI","");
$cm_oil_percall_cancel=getRowReportType2("$dte","3","1","cancel","MSI","");
$cm_oil_percall_total=getRowReportType2("$dte","3","1","","MSI","");

/*  explode  */
$a = explode(" ", $cm_ngv_percall_wsla);
$b = explode(" ", $cm_ngv_percall_fsla);
$c = explode(" ", $cm_ngv_percall_close);
$d = explode(" ", $cm_ngv_percall_cancel);
$e = explode(" ", $cm_ngv_percall_inprogress);
$f = explode(" ", $cm_ngv_percall_total);

$a1 = explode(" ", $cm_ngv_packages_wsla);
$b1 = explode(" ", $cm_ngv_packages_fsla);
$c1 = explode(" ", $cm_ngv_packages_close);
$d1 = explode(" ", $cm_ngv_packages_cancel);
$e1 = explode(" ", $cm_ngv_packages_inprogress);
$f1 = explode(" ", $cm_ngv_packages_total);

$a2 = explode(" ", $cm_oil_percall_wsla);
$b2 = explode(" ", $cm_oil_percall_fsla);
$c2 = explode(" ", $cm_oil_percall_close);
$d2 = explode(" ", $cm_oil_percall_cancel);
$e2 = explode(" ", $cm_oil_percall_inprogress);
$f2 = explode(" ", $cm_oil_percall_total);

$cm_ngv_percall_wsla_job =$a[0];
$cm_ngv_percall_wsla_percentage=$a[1];
$cm_ngv_percall_fsla_job =$b[0];
$cm_ngv_percall_fsla_percentage =$b[1];
$cm_ngv_percall_close_job =$c[0];
$cm_ngv_percall_close_percentage =$c[1];
$cm_ngv_percall_cancel_job =$d[0];
$cm_ngv_percall_cancel_percentage =$d[1];
$cm_ngv_percall_inprogress_job =$e[0];
$cm_ngv_percall_inprogress_percentage =$e[1];
$cm_ngv_percall_total_job =$f[0];
$cm_ngv_percall_total_percentage =$f[1];

$cm_ngv_packages_wsla_job=$a1[0];
$cm_ngv_packages_wsla_percentage =$a1[1];
$cm_ngv_packages_fsla_job =$b1[0];
$cm_ngv_packages_fsla_percentage =$b1[1];
$cm_ngv_packages_close_job =$c1[0];
$cm_ngv_packages_close_percentage =$c1[1];
$cm_ngv_packages_cancel_job =$d1[0];
$cm_ngv_packages_cancel_percentage =$d1[1];
$cm_ngv_packages_inprogress_job =$e1[0];
$cm_ngv_packages_inprogress_percentage =$e1[1];
$cm_ngv_packages_total_job =$f1[0];
$cm_ngv_packages_total_percentage =$f1[1];

$cm_oil_percall_wsla_job =$a2[0];
$cm_oil_percall_wsla_percentage =$a2[1];
$cm_oil_percall_fsla_job =$b2[0];
$cm_oil_percall_fsla_percentage =$b2[1];
$cm_oil_percall_close_job =$c2[0];
$cm_oil_percall_close_percentage =$c2[1];
$cm_oil_percall_cancel_job =$d2[0];
$cm_oil_percall_cancel_percentage =$d2[1];
$cm_oil_percall_inprogress_job =$e2[0];
$cm_oil_percall_inprogress_percentage =$e2[1];
$cm_oil_percall_total_job =$f2[0];
$cm_oil_percall_total_percentage =$f2[1];


/*  insert data  */
$sql="INSERT INTO bizservs_helpdesk.tbl_cm_sla_percentage
(cm_ngv_percall_sitename,
cm_ngv_percall_wsla_job,
cm_ngv_percall_wsla_percentage,
cm_ngv_percall_fsla_job,
cm_ngv_percall_fsla_percentage,
cm_ngv_percall_close_job,
cm_ngv_percall_close_percentage,
cm_ngv_percall_cancel_job,
cm_ngv_percall_cancel_percentage,
cm_ngv_percall_inprogress_job,
cm_ngv_percall_inprogress_percentage,
cm_ngv_percall_total_job,
cm_ngv_percall_total_percentage,
cm_ngv_packages_sitename,
cm_ngv_packages_wsla_job,
cm_ngv_packages_wsla_percentage,
cm_ngv_packages_fsla_job,
cm_ngv_packages_fsla_percentage,
cm_ngv_packages_close_job,
cm_ngv_packages_close_percentage,
cm_ngv_packages_cancel_job,
cm_ngv_packages_cancel_percentage,
cm_ngv_packages_inprogress_job,
cm_ngv_packages_inprogress_percentage,
cm_ngv_packages_total_job,
cm_ngv_packages_total_percentage,
cm_oil_percall_sitename,
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
cm_oil_percall_total_percentage) 
VALUES (
'".$cm_ngv_percall_sitename."',
'".$cm_ngv_percall_wsla_job."',
'".$cm_ngv_percall_wsla_percentage."',
'".$cm_ngv_percall_fsla_job."',
'".$cm_ngv_percall_fsla_percentage."',
'".$cm_ngv_percall_close_job."',
'".$cm_ngv_percall_close_percentage."',
'".$cm_ngv_percall_cancel_job."',
'".$cm_ngv_percall_cancel_percentage."',
'".$cm_ngv_percall_inprogress_job."',
'".$cm_ngv_percall_inprogress_percentage."',
'".$cm_ngv_percall_total_job."',
'".$cm_ngv_percall_total_percentage."',
'".$cm_ngv_packages_sitename."',
'".$cm_ngv_packages_wsla_job."',
'".$cm_ngv_packages_wsla_percentage."',
'".$cm_ngv_packages_fsla_job."',
'".$cm_ngv_packages_fsla_percentage."',
'".$cm_ngv_packages_close_job."',
'".$cm_ngv_packages_close_percentage."',
'".$cm_ngv_packages_cancel_job."',
'".$cm_ngv_packages_cancel_percentage."',
'".$cm_ngv_packages_inprogress_job."',
'".$cm_ngv_packages_inprogress_percentage."',
'".$cm_ngv_packages_total_job."',
'".$cm_ngv_packages_total_percentage."',
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
'".$cm_oil_percall_total_percentage."'
)";
mysqli_query($conn,$sql);
echo $sql;

?>
<br><br><br>
<?

echo "TOTAL <br>";
/*  replace  */	  
$cm_ngv_percall_wsla = getRowReportType2("$dte","2","8","","","WSLA");	 
$cm_ngv_percall_sitename = "TOTAL";
$cm_ngv_percall_inprogress=getRowReportType2("$dte","2","8","feedback","","");
$cm_ngv_percall_fsla=getRowReportType2("$dte","2","8","","","FSLA");
$cm_ngv_percall_close=getRowReportType2("$dte","2","8","close","MSI","");
$cm_ngv_percall_cancel=getRowReportType2("$dte","2","8","cancel","","");
$cm_ngv_percall_total=getRowReportType2("$dte","2","8","","","");

$cm_ngv_packages_wsla = getRowReportType2("$dte","2","9","","MSI","WSLA");	 
$cm_ngv_packages_sitename = "TOTAL";
$cm_ngv_packages_inprogress=getRowReportType2("$dte","9","8","feedback","","");
$cm_ngv_packages_fsla=getRowReportType2("$dte","2","9","","","FSLA");
$cm_ngv_packages_close=getRowReportType2("$dte","2","9","close","","");
$cm_ngv_packages_cancel=getRowReportType2("$dte","2","9","cancel","","");
$cm_ngv_packages_total=getRowReportType2("$dte","2","9","","","");

$cm_oil_percall_wsla = getRowReportType2("$dte","3","1","","","WSLA");	 
$cm_oil_percall_sitename = "TOTAL";
$cm_oil_percall_inprogress=getRowReportType2("$dte","3","1","feedback","","");
$cm_oil_percall_fsla=getRowReportType2("$dte","3","1","","","FSLA");
$cm_oil_percall_close=getRowReportType2("$dte","3","1","close","","");
$cm_oil_percall_cancel=getRowReportType2("$dte","3","1","cancel","","");
$cm_oil_percall_total=getRowReportType2("$dte","3","1","","","");

/*  explode  */
$a = explode(" ", $cm_ngv_percall_wsla);
$b = explode(" ", $cm_ngv_percall_fsla);
$c = explode(" ", $cm_ngv_percall_close);
$d = explode(" ", $cm_ngv_percall_cancel);
$e = explode(" ", $cm_ngv_percall_inprogress);
$f = explode(" ", $cm_ngv_percall_total);

$a1 = explode(" ", $cm_ngv_packages_wsla);
$b1 = explode(" ", $cm_ngv_packages_fsla);
$c1 = explode(" ", $cm_ngv_packages_close);
$d1 = explode(" ", $cm_ngv_packages_cancel);
$e1 = explode(" ", $cm_ngv_packages_inprogress);
$f1 = explode(" ", $cm_ngv_packages_total);

$a2 = explode(" ", $cm_oil_percall_wsla);
$b2 = explode(" ", $cm_oil_percall_fsla);
$c2 = explode(" ", $cm_oil_percall_close);
$d2 = explode(" ", $cm_oil_percall_cancel);
$e2 = explode(" ", $cm_oil_percall_inprogress);
$f2 = explode(" ", $cm_oil_percall_total);

$cm_ngv_percall_wsla_job =$a[0];
$cm_ngv_percall_wsla_percentage=$a[1];
$cm_ngv_percall_fsla_job =$b[0];
$cm_ngv_percall_fsla_percentage =$b[1];
$cm_ngv_percall_close_job =$c[0];
$cm_ngv_percall_close_percentage =$c[1];
$cm_ngv_percall_cancel_job =$d[0];
$cm_ngv_percall_cancel_percentage =$d[1];
$cm_ngv_percall_inprogress_job =$e[0];
$cm_ngv_percall_inprogress_percentage =$e[1];
$cm_ngv_percall_total_job =$f[0];
$cm_ngv_percall_total_percentage =$f[1];

$cm_ngv_packages_wsla_job=$a1[0];
$cm_ngv_packages_wsla_percentage =$a1[1];
$cm_ngv_packages_fsla_job =$b1[0];
$cm_ngv_packages_fsla_percentage =$b1[1];
$cm_ngv_packages_close_job =$c1[0];
$cm_ngv_packages_close_percentage =$c1[1];
$cm_ngv_packages_cancel_job =$d1[0];
$cm_ngv_packages_cancel_percentage =$d1[1];
$cm_ngv_packages_inprogress_job =$e1[0];
$cm_ngv_packages_inprogress_percentage =$e1[1];
$cm_ngv_packages_total_job =$f1[0];
$cm_ngv_packages_total_percentage =$f1[1];

$cm_oil_percall_wsla_job =$a2[0];
$cm_oil_percall_wsla_percentage =$a2[1];
$cm_oil_percall_fsla_job =$b2[0];
$cm_oil_percall_fsla_percentage =$b2[1];
$cm_oil_percall_close_job =$c2[0];
$cm_oil_percall_close_percentage =$c2[1];
$cm_oil_percall_cancel_job =$d2[0];
$cm_oil_percall_cancel_percentage =$d2[1];
$cm_oil_percall_inprogress_job =$e2[0];
$cm_oil_percall_inprogress_percentage =$e2[1];
$cm_oil_percall_total_job =$f2[0];
$cm_oil_percall_total_percentage =$f2[1];


/*  insert data  */
$sql="INSERT INTO bizservs_helpdesk.tbl_cm_sla_percentage
(cm_ngv_percall_sitename,
cm_ngv_percall_wsla_job,
cm_ngv_percall_wsla_percentage,
cm_ngv_percall_fsla_job,
cm_ngv_percall_fsla_percentage,
cm_ngv_percall_close_job,
cm_ngv_percall_close_percentage,
cm_ngv_percall_cancel_job,
cm_ngv_percall_cancel_percentage,
cm_ngv_percall_inprogress_job,
cm_ngv_percall_inprogress_percentage,
cm_ngv_percall_total_job,
cm_ngv_percall_total_percentage,
cm_ngv_packages_sitename,
cm_ngv_packages_wsla_job,
cm_ngv_packages_wsla_percentage,
cm_ngv_packages_fsla_job,
cm_ngv_packages_fsla_percentage,
cm_ngv_packages_close_job,
cm_ngv_packages_close_percentage,
cm_ngv_packages_cancel_job,
cm_ngv_packages_cancel_percentage,
cm_ngv_packages_inprogress_job,
cm_ngv_packages_inprogress_percentage,
cm_ngv_packages_total_job,
cm_ngv_packages_total_percentage,
cm_oil_percall_sitename,
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
cm_oil_percall_total_percentage) 
VALUES (
'".$cm_ngv_percall_sitename."',
'".$cm_ngv_percall_wsla_job."',
'".$cm_ngv_percall_wsla_percentage."',
'".$cm_ngv_percall_fsla_job."',
'".$cm_ngv_percall_fsla_percentage."',
'".$cm_ngv_percall_close_job."',
'".$cm_ngv_percall_close_percentage."',
'".$cm_ngv_percall_cancel_job."',
'".$cm_ngv_percall_cancel_percentage."',
'".$cm_ngv_percall_inprogress_job."',
'".$cm_ngv_percall_inprogress_percentage."',
'".$cm_ngv_percall_total_job."',
'".$cm_ngv_percall_total_percentage."',
'".$cm_ngv_packages_sitename."',
'".$cm_ngv_packages_wsla_job."',
'".$cm_ngv_packages_wsla_percentage."',
'".$cm_ngv_packages_fsla_job."',
'".$cm_ngv_packages_fsla_percentage."',
'".$cm_ngv_packages_close_job."',
'".$cm_ngv_packages_close_percentage."',
'".$cm_ngv_packages_cancel_job."',
'".$cm_ngv_packages_cancel_percentage."',
'".$cm_ngv_packages_inprogress_job."',
'".$cm_ngv_packages_inprogress_percentage."',
'".$cm_ngv_packages_total_job."',
'".$cm_ngv_packages_total_percentage."',
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
'".$cm_oil_percall_total_percentage."'
)";
mysqli_query($conn,$sql);
echo $sql;

?>
<br><br><br>

					<?
					$sql = "SELECT
								Count(tbl_insident_hw.site_id) AS max_count,
								tbl_insident_hw.cate_id,
								tbl_category_hardware.cate_name
								FROM
								tbl_log_call_center
								Inner Join tbl_insident_hw ON tbl_log_call_center.job_no = tbl_insident_hw.job_no
								Inner Join tbl_category_hardware ON tbl_insident_hw.cate_id = tbl_category_hardware.cate_id
								Where tbl_log_call_center.open_call_dte LIKE  '$dte%' AND
																tbl_log_call_center.category_type =  '9' AND
																tbl_log_call_center.status_call =  'close'
																AND tbl_category_hardware.cate_id not in ('15')
								Group by tbl_insident_hw.cate_id
								Order by max_count DESC
								limit 0,10"; 
					$sql_all = mysqli_query($conn,$sql);
                    $i=0;
                     while($c_all = mysqli_fetch_array($sql_all)){
					 $i++;
					 $sql_s="INSERT INTO bizservs_helpdesk.tbl_cm_sla_hardware (h_no,h_id,h_name,h_amount)
					 VALUES ('".$i."','".$c_all['cate_id']."','".$c_all['cate_name']."','".$c_all['max_count']."')";
					 mysqli_query($conn,$sql_s);
					 echo $sql_s."<br>";
					 
					 
					 } ?>
					 

					<?
					$sql1 = "SELECT tbl_log_call_center.site_id,
							Count(tbl_log_call_center.site_id) AS max_count,
							tbl_station_ngv.site_name,
							tbl_station_ngv.site_province
							FROM
							tbl_log_call_center
							Inner Join tbl_station_ngv ON tbl_log_call_center.site_id = tbl_station_ngv.site_id
							where open_call_dte like '$dte%' and category_type = '9' and status_call = 'close'
							GROUP BY site_id
							ORDER BY max_count DESC
							limit 0,10"; 
					$sql_all = mysqli_query($conn,$sql1);
					$i=0;
                     while($c_all = mysqli_fetch_array($sql_all)){
						 $i++;								  
						$sql_s="INSERT INTO bizservs_helpdesk.tbl_cm_sla_site(s_no,s_id,s_name,s_amount,s_province)
							VALUES ('".$i."','".$c_all['site_id']."','".$c_all['site_name']."','".$c_all['max_count']."','".$c_all['site_province']."')";
							mysqli_query($conn,$sql_s);
							echo $sql_s."<br>";
						  }
  
		?>
