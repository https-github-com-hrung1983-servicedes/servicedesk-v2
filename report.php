<?
require("function.php"); 
$sql = "SELECT
tbl_log_call_center.open_call_dte,
tbl_log_call_center.job_no,
tbl_log_call_center.site_id,
tbl_log_call_center.site_province,
tbl_log_call_center.problem,
tbl_log_call_center.problem_solving,
tbl_log_call_center.reciept_job_user_id,
tbl_log_call_center.type_service,
tbl_station_ngv.site_name
FROM
tbl_log_call_center
Inner Join tbl_station_ngv ON tbl_log_call_center.site_id = tbl_station_ngv.site_id
Where tbl_log_call_center.problem_solving like '%EDC%'
And tbl_log_call_center.open_call_dte like '2012%'";
//echo $sql;
$rs = mysqli_query($conn,$sql);
?>
<table border="1">
	<tr>
		<td>open_call_dte</td>
		<td>job_no</td>
		<td>site_id</td>
		<td>site_name</td>
		<td>site_province</td>
		<td>problem</td>
		<td>problem_solving</td>
		<td>type_service</td>
	</tr>
	<?
	while($c=mysqli_fetch_array($rs)){
	?>
	<tr>
		<td><?=$c["open_call_dte"];?></td>
		<td><?=$c["job_no"];?></td>
		<td><?=$c["site_id"];?></td>
		<td><?=$c["site_name"];?></td>
		<td><?=$c["site_province"];?></td>
		<td><?=$c["problem"];?></td>
		<td><?=$c["problem_solving"];?></td>
		<td><?=$c["type_service"];?></td>
	</tr>
	<?}?>
</table>