<meta http-equiv=Content-Type content="text/html; charset=utf-8">
<?
///require("function.execute.php");
session_start();
	mysqli_connect("localhost","root","Nirund2526!@") or die("Connection fail");
 	mysqli_select_db("bizservs_helpdesk") or die("Cannot connect database");
        mysqli_query($conn,"SET CHARACTER SET tis620");//tis620
        mysqli_query($conn,"SET character_set_results=tis620");
        mysqli_query($conn,"SET character_set_client=tis620");
        mysqli_query($conn,"SET character_set_connection=tis620");

$id  = $_REQUEST["id"];
$dte_beg  = $_REQUEST["dte_beg"]; 
$dte_end  = $_REQUEST["dte_end"];
$username = $_SESSION["Uname"]." ".$_SESSION["Usname"];

$sql = "SELECT
	tbl_log_call_center.id,
	tbl_log_call_center.call_type,
	tbl_log_call_center.open_call_dte,
	tbl_log_call_center.open_call_tme,
	tbl_log_call_center.job_no,
	tbl_log_call_center.site_id,
	tbl_site.site_name,
	tbl_site.site_old_name,
	tbl_site.address, 
	tbl_site.province_name,
	tbl_log_call_center.status_call,
	tbl_log_call_center.problem,
	tbl_log_call_center.problem_solving,
	tbl_log_call_center.commente,
	tbl_log_call_center.customer_contact,
	tbl_log_call_center.customer_tel,
	tbl_log_call_center.status_sla,
	tbl_log_call_center.type_service,
	tbl_log_call_center.dateline_solving,
	tbl_log_call_center.reciept_job_user_id, 
	tbl_log_call_center.cat_bss,
	tbl_log_call_center.cat_hour,
	tbl_log_call_center.dateline_cat_bss,
	tbl_log_call_center.status_cat_bss, 
	tbl_user.name, 
	tbl_user.sname,
	tbl_log_call_center.onsite_datetime, 	
	tbl_log_call_center.fixed_time,
	tbl_log_call_center.closed_date,
	tbl_log_call_center.closed_time
FROM tbl_log_call_center
Left JOIN tbl_site ON tbl_log_call_center.site_id = tbl_site.site_id
Left JOIN tbl_user ON tbl_log_call_center.reciept_job_user_id = tbl_user.user_id
WHERE tbl_log_call_center.id = $id";//

//echo $sql;exit;
$rs = mysqli_query($conn,$sql);
$c = mysqli_fetch_array($rs);

$engineer_name = $c["name"]." ".$c["sname"]; 
$str = " เรียน ".$c["type_service"]."<br><br>&nbsp;&nbsp;&nbsp;";
			if($c["status_call"]=="feedback"){
				$str .= "แจ้งเปิดงาน";				
			} else if($c["status_call"]=="close"){
				$str .= "แจ้งปิดงาน";
			} else if($c["status_call"]=="cancel"){
				$str .= "แจ้งยกเลิกงาน";
			}

			$site_id_name = getSiteNameNew($c["site_id"]);
		//	$site_id_address = getSiteNameAddressNew($site_id); 

			   $probsolving = "";
			if($problemsolving!=""){
				$probsolving = 	"
				<tr>
					<td height=20pt align=rigth><b>วิธีการแก้ปัญหา  : </b></td> <td>".iconv('TIS-620','UTF-8',$c["problem_solving"])." </td>
				</tr>";
			}
   
			if($c["status_cat_bss"]=="WSLA"){
				$status_sla_cmd = "ยังไม่ตก SLA";
			} else if($c["status_cat_bss"]=="FSLA"){
				$status_sla_cmd = "ตก SLA";
			}

			$strMessage = "
				<table width=80% border=1 align=rigth height=60%>
				<tr><td colspan=2 height=30pt><b>$str</b></tr>				
				<tr><td><b>เลขที่ใบงาน : </b></td> <td>$c[job_no]</td></tr>
				<tr><td><b>สถานะใบงาน  : </b></td> <td>$c[status_call]</td></tr>
				<tr><td><b>วันและเวลาเปิดงาน  : </b></td> <td>$c[open_call_dte] : $c[open_call_tme]</td></tr>
				<tr><td><b>หมายเหตุ  : </b></td> <td>".iconv('TIS-620','UTF-8',$c[commente])."</td></tr>
				<tr><td><b>รหัสสถานี  : </b></td> <td>$site_id_name </td></tr>
				<tr><td><b>ที่อยู่  : </b></td> <td>".iconv('TIS-620','UTF-8',$c["site_address"])."</td></tr>
				<tr><td><b>อาการแจ้ง  : </b></td> <td>".iconv('TIS-620','UTF-8',$c["problem"])." </td></tr>
				$probsolving 
				<tr><td><nobr><b>ระดับความรุนแรง  : </b></td> <td>$c[cat_bss] </td></tr>
				<tr><td><b>ระยะเวลา  : </b></td> <td>$c[cat_hour] ชั่วโมง</td></tr>
				<tr><td><b>ระยะเวลาสิ้นสุด  : </b></td> <td>$c[dateline_cat_bss] </td></tr>				
				<tr><td><b>ผู้ติดต่อ  : </b></td> <td>".iconv('TIS-620','UTF-8',$c["customer_contact"])  ." เบอร์โทร. $c[customer_tel]</td></tr>
				
				<tr><td><b>ชื่อช่างเข้าตรวจสอบ : </b></td><td>".iconv('TIS-620','UTF-8',$engineer_name)."</td></tr>
				<tr><td><b>วิธีการแก้ไข : </b></td><td>$probsolving</td></tr>
				<tr><td><b>เวลาที่ช่างเข้าถึงสถานี : </b></td><td>$c[onsite_datetime]</td></tr>
				<tr><td><b>เวลาที่ช่างปิดงาน : </b></td><td>$c[closed_date] $c[closed_time]</td></tr>
				<tr><td><b>สถานะใบงาน : </b></td> <td>$status_sla_cmd</td></tr>
				<tr><td align=center  colspan=2 ><b>จึงเรียนมาทราบ <br>
".iconv('TIS-620','UTF-8',$username)."</b></td>
				</tr>
				<tr><td align=center colspan=2><b><br>หากท่านต้องการข้อมูลเพิ่มเติมหรือพบปัญหาการใช้งาน กรุณาติดต่อ 088-088-1799 ต่อ 401,402,407,408 
ได้ตลอด 24 ชั่วโมง ไม่มีวันหยุด ทางทีมงานมีความยินดีให้บริการท่าน</b></td>
				</tr>
			</table>
			";
//echo $strMessage;
	$strTo = getMail($c["type_service"]);//echo $strTo; exit;
//
	$strSubject = "=?UTF-8?B?".base64_encode("Servicedesk BSS : ".$c[job_no])."?=";
	$strHeader = "Content-type: text/html; charset=utf-8\r\n";
	$strHeader .= "From: ServicdeskBSS <callcentergroup@bizservsolution.com>";
	//echo $strMessage;
	$flgSend = @mail($strTo,$strSubject,$strMessage,$strHeader); // exit;//  = No Show Error //
		header("location:logcall.index.php?dte_beg=$dte_beg&dte_end=$dte_end");
	if($flgSend){
		echo "Email Sending.";
	} else {
		echo "Email Can Not Send.";
	}
exit;

function getSiteNameNew($site_id){
	global $conn;
	$sql_name_new = "select site_id,site_name from tbl_site where site_id = '$site_id'";
 	$rc_name_new = mysqli_query($conn,$sql_name_new);
	$c_name_new = mysqli_fetch_array($rc_name_new);
	return $c_name_new["site_id"]."-".iconv('TIS-620','UTF-8',$c_name_new["site_name"]);

//return $sql_name_new;
}

function getMail($typemail){
	global $conn;
		$mail_list = "";
		if($typemail=="BSS"){
			$sql = "select email from tbl_user where at = 'BSS' and status_user = 'y' AND group_email in('c','s') AND email IS NOT NULL";
			$rs = mysqli_query($conn,$sql);
			while($c=mysqli_fetch_array($rs)){
					$mail_list .= $c["email"].",";
				}		
		} 
		if($c["call_type"]=="39"){
			$mail_list .= "Kasem.Run@ricoh.co.th,Apichat.Som@ricoh.co.th,";
		}
		if($user_id=="99"){
			$mail_list .= "kittanatp@bizservsolution.com,Srikrung.Cha@ricoh.co.th,Wanchai.Kho@ricoh.co.th,Pornchai.Thu@ricoh.co.th
				,Jumras.Jan@ricoh.co.th,Suwan.Jai@ricoh.co.th,Montri.Sri@ricoh.co.th,kesorn.tho@ricoh.co.th,Udomsak.Jee@ricoh.co.th
				,Smith.Pit@ricoh.co.th	,Prasit.Mee@ricoh.co.th,Chittawadee.Int@ricoh.co.th,Parul.Poo@ricoh.co.th,Nirut.Kea@ricoh.co.th
				,nikhom.kha@ricoh.co.th,Poonnapa.Sup@ricoh.co.th,ricoh_callcenter@ricoh.co.th,";
}
		return $mail_list;//."narabhattaraj@bizservsolution.com";//
	  } 
?>








