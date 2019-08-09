<?
session_start();
header("Content-Type: text/html; charset=tis-620");
//header("content-type: application/x-javascript; charset=TIS-620");
//<div id="xx"></div>$('#xx').html(data);

require("connection.php");
$mode = $_REQUEST["mode"];
//echo $mode;exit;
switch ($mode) {
    case "gen_id_bss" :
			$dte = $_REQUEST["dte"];
			mysqli_query("insert into tbl_job_no (dte) values ('$dte')");
			$id = mysqli_insert_id($conn);
			echo formatenum($id);
		//echo "asdfasdfasd";
        break;



    case "user_loging" :
        $type = $_REQUEST["type"];
			$tbl = "tbl_user_login";
			if($type=="add"){
				$sql = "insert into $tbl (user_name,password,state,active) values ('$user_name','$password','$state','$active')";
				mysqli_query($conn,$sql);

				$id1 = mysqli_insert_id($conn);
				$sql_update = "update tbl_user set id_login='$id1' where user_id='".$_REQUEST["id_user"]."'";
				mysqli_query($conn,$sql_update);
			} else if($type=="edit") {
				$sql = "update $tbl set user_name='$user_name',password='$password',state='$state',active='$active' where user_bss_id = '$id'";
				mysqli_query($conn,$sql);
			}
			//echo $sql_update;
		break;

    case "user" :
			$type = $_REQUEST["type"];
			$id = $_REQUEST["id"];
			$at = $_REQUEST["at"];
			$name = iconvertlanguage($_REQUEST["name"]);
			$sname = iconvertlanguage($_REQUEST["sname"]);
			$tel = $_REQUEST["tel"];
			$status_user = $_REQUEST["status_user"];
			if($type=="add"){
			$tbl_user = "tbl_user";
				$sql ="insert into $tbl_user (at ,name,sname,tel,status_user)
						values ('$at','$name','$sname','$tel','$status_user')";
				mysqli_query($conn,$sql);

			} else if($type=="edit"){
				$sql = "update $tbl_user set at='$at' ,name='$name', sname='$sname', tel='$tel', status_user='$status_user'
				where user_id='$id' ";
				mysqli_query($conn,$sql);
			}
			echo $sql_update;
        break;

	case "getCateJob":
	$typejob = $_REQUEST["typejob"];
	$cat_job = $_REQUEST["cat_job"];
		echo "<select name='cat_job' id='cat_job'>";
			$rc_job = mysqli_query($conn,"SELECT
								concat(_utf8'',`tbl_category_type`.`category_type`) AS `category_type`,
								tbl_category_type.station_type
								from tbl_category_type where station_type = '$typejob'");
			while(@$c_job = mysqli_fetch_array($rc_job)){
			?>
			<option value="<?=$c_job["category_id"]?>" <? if($c_job["category_id"]==$cat_job) echo "selected";?>><?=$c_job["category_type"]?></option>
			<? } echo "</select>";

		break;

	case "report3G" :
		$typer = $_REQUEST["typer"];
		$months = $_REQUEST["months"];
		$years = $_REQUEST["years"];
		$str = "";
		if($typer=="2"){
			$str = "NGV";
			$sql = "SELECT
					tbl_log_call_center.open_call_dte,
					tbl_log_call_center.site_id,
					tbl_log_call_center.problem_solving,
					tbl_log_call_center.type_service,
					tbl_log_call_center.job_no,
					tbl_station_ngv.site_name,
					tbl_station_ngv.routerbox_no,
					tbl_station_ngv.ip_address,
					tbl_station_ngv.aircard_no,
					tbl_station_ngv.sim_no,
					tbl_station_ngv.install_network_dte
				FROM
					tbl_log_call_center
				Left Join tbl_station_ngv ON tbl_log_call_center.site_id = tbl_station_ngv.site_id
				Where tbl_station_ngv.install_network_dte like '$years-$months%'";
		}else if($typer=="3"){
			$str = "Oil";
			$sql = "SELECT
					tbl_log_call_center.open_call_dte,
					tbl_log_call_center.site_id,
					tbl_log_call_center.problem_solving,
					tbl_log_call_center.type_service,
					tbl_log_call_center.job_no,
					tbl_station_oil.site_name,
					tbl_station_oil.routerbox_no,
					tbl_station_oil.ip_address,
					tbl_station_oil.aircard_no,
					tbl_station_oil.sim_no,
					tbl_station_oil.install_network_dte
				FROM
					tbl_log_call_center
				Left Join tbl_station_oil ON tbl_log_call_center.site_id = tbl_station_oil.station_id
				Where tbl_station_oil.install_network_dte like '$years-$months%'";

		}else if($typer=="4"){
				$str = "Amazon";
				$sql = "SELECT
					tbl_log_call_center.open_call_dte,
					tbl_log_call_center.site_id,
					tbl_log_call_center.problem_solving,
					tbl_log_call_center.type_service,
					tbl_log_call_center.job_no,
					tbl_station_amazon.site_name,
					tbl_station_amazon.routerbox_no,
					tbl_station_amazon.ip_address,
					tbl_station_amazon.aircard_no,
					tbl_station_amazon.sim_no,
					tbl_station_amazon.install_network_dte
				FROM
					tbl_log_call_center
				Left Join tbl_station_amazon ON tbl_log_call_center.site_id = tbl_station_amazon.site_id
				Where tbl_station_amazon.install_network_dte like '$years-$months%'";

		}


		$name = "Content-Disposition: attachment; filename='3G".$str."-".$months."-".$years.".csv';";
		header($name);
		echo $sql."\n";
		echo "\nSITE_ID,SITE_NAME,Job No.,Install Date,IP-Address,Router No.,Sim No.,Solution,Team\n";
	//	echo $sql;exit;
		$rc = mysqli_query($conn,$sql);
				while($c= mysqli_fetch_array($rc)){
					echo $c["site_id"].",".$c["site_name"].",".$c["job_no"].",".$c["install_network_dte"].",".$c["ip_address"].",".$c["routerbox_no"].",".$c["sim_no"].",".$c["problem_solving"].",".$c["type_service"]."\n";
					echo "\nSITE_ID,SITE_NAME,Job No.,Install Date,IP-Address,Router No.,Sim No.,Solution,Team\n";
				}
				echo "$c[site_id],2,3,4,5,6,7,8,9\n";
				echo "\n\n\n\n";
	break;

	case "GetSiteNameAmazon" :
	 	$id = $_REQUEST["id"];
		$sql = "Select site_name from tbl_station_amazon where site_id = '$id'";
		$rc = mysqli_query($conn,$sql);
		$c = mysqli_fetch_array($rc);
		echo $c["site_name"];
	break;

	case "GetSiteNameNGV" :
		$id = $_REQUEST["id"];
		$sql = "SELECT site_name_new FROM tbl_station_ngv where site_id= '$id'";
		$rc = mysqli_query($conn,$sql);
		$c = mysqli_fetch_array($rc);
		echo $c["site_name_new"];
	break;

	case "GetSiteNameOil" :
		$id = $_REQUEST["id"];
		$sql = "SELECT site_name FROM tbl_station_oil where station_id = '$id'";
		$rc = mysqli_query($conn,$sql);
		$c = mysqli_fetch_array($rc);
		echo $c["site_name"];
	break;

	case "site.reponsibility" :
		$id = $_REQUEST["id"];
		$val_type = $_REQUEST["val_type"];
		$type = $_REQUEST["type"];
     		$responsibility_by = $_REQUEST["responsibility_by"];
     		$center_position = $_REQUEST["center_position"];
     		$way_length = $_REQUEST["way_length"];

		if($type=="add"){
		 	$sql1 = "insert into tbl_3g_responsibility (site_id,site_type,responsibility_by) values ('$id','$val_type','$$responsibility_by')";
			mysqli_query($conn,$sql1);
			$sql2 = "insert into tbl_site_ngv_responsible (site_id,way_length,responsible_by,center_position) values ('$id','$way_length','$responsibility_by','$center_position')";
			mysqli_query($conn,$sql2);
		} else {
			$sql1 = "update tbl_3g_responsibility set responsibility_by='$$responsibility_by'
				 where site_id='$id' and site_type = '$val_type'";
			mysqli_query($conn,$sql1);
			$sql2 = "update tbl_site_ngv_responsible set
				 way_length='$way_length',responsible_by='$responsibility_by',center_position='$center_position'
				 where site_id='$id'";
			mysqli_query($conn,$sql2);
		}
	break;


	case "hw.onhand.user" :
		$id_sn = $_REQUEST["id_sn"];
		$user_id = $_REQUEST["user_new"];
		$cate_id = $_REQUEST["cate_id"];
		$serialno = $_REQUEST["serialno"];
		//$dte_tme_entry_stock = getDteTme();
		$status_hw = $_REQUEST["status_hw"];
		$user_new = $_REQUEST["user_new"];
		//$sparepartfor = $_REQUEST["sparepartfor"];
		$dtetme = getDteTme();
		if($status_hw=="o" || $status_hw=="b" || $status_hw == "r"){
			$user_id = $user_new;
		} else {
			$user_id = "";
		}
		if($user_id=="129"){
		  $asset_by = "MSI";
		  $status_hw = "a";
		}else{ $asset_by = $_SESSION["Uat"];}
//,asset_by='$asset_by'
		$sql = "update tbl_hardware_onhand_user set user_id='$user_id',cate_id='$cate_id',hardware_no='$serialno'
		,hardware_status='$status_hw',changedatetime='$dtetme',lastupdate_from='".$_SESSION["User_id"]."' where id = '$id_sn'";
			mysqli_query($conn,$sql);

	break;

	case "hw.waitrepair" :

		$id_rep = $_REQUEST["id_rep"];
		$cate_id = $_REQUEST["cate_id"];
		$hardware_brand = $_REQUEST["hardware_brand"];
		$serialno = $_REQUEST["serialno"];
		$status_hw = $_REQUEST["status_hw"];

			$dte_tme_install = $_REQUEST["dte_tme_install"];
			$dte_tme_expired = $_REQUEST["dte_tme_expired"];
			$dte_tme_warranty = $_REQUEST["dte_tme_warranty"];
			$dte_tme_expired_warranty = $_REQUEST["dte_tme_expired_warranty"];
			$status_deal = $_REQUEST["status_deal"];

		$comment_repair = iconvertlanguage($_REQUEST["comment_repair"]);
		$dtetme = getDteTme();
		$user_repair = $_REQUEST["user_repair"];
		$SendTo = $_REQUEST["SendTo"];
	//	$license_windows_no = $_REQUEST["license_windows_no"];
	//	$sparepartfor = $_REQUEST["sparepartfor"];

		switch($SendTo){
		case "136" : $repair_by="BSS"; break;
		case "102" : $repair_by="Kamphol"; break;
		case "114" : $repair_by="Narapong"; break;
		case "129" : $repair_by="MSI"; break;
		case "99" : $repair_by="Ricoh"; break;
		case "132" : $repair_by="Bhomthai"; break;
		case "133" : $repair_by="Chawpaya"; break;
		case "134" : $repair_by="Nimble"; break;
		case "135" : $repair_by="SNS"; break;


		}

		if($license_windows_no!=""){
			$str = ",license_windows_no='$license_windows_no'";
		}

		if($SendTo=="129"){
		//    $user_repair = "148";
		    $status_hw = "a";
		    $user_repair = "";
		}else{
		} //,dte_tme_entry_stock=NOW(),dte_tme_form_stock=NOW(),dte_tme_form_pump=NOW()
		$dtetme = getDteTme();
		$sql = "update tbl_hardware_onhand_user set user_id='$SendTo'
		,dte_tme_fix_complete='$dtetme',hardware_status='$status_hw',hardware_no='$serialno',cate_id='$cate_id',hardware_brand='".$hardware_brand."' $cmd
		,installation_date='$dte_tme_install'
		,expired_date='$dte_tme_expired'
		,hardware_type='$status_deal'
		,warranty_hardware_type_date='$dte_tme_warranty'
		,expired_hardware_type_date='$dte_tme_expired_warranty' $str  
		,changedatetime='$dtetme',lastupdate_from='".$_SESSION["User_id"]."'
		where id = $id_rep";
		echo $sql;
		mysqli_query($conn,$sql);
		$sql1 = "insert into tbl_hardware_log_repair (dte_repair,cate_id,serail_no,comment_repair,repair_by)
		values (NOW(),'$cate_id','$serialno','$comment_repair','$SendTo')";
		//echo $sql1;
		mysqli_query($conn,$sql1);

	break;

	case "clear.seesion" :

		$userid = $_REQUEST["userid"];
		$sql = "update tbl_user_login set status_online = '$dtetme' where user_bss_id = '$userid'"; echo $sql;
		mysqli_query($conn,$sql);

	break;

	case "cnt_usage_hw" :

		$cate_id = $_REQUEST["cate_id"];
		$serail_no = $_REQUEST["serail_no"];
		$sql = "select count(*) as cnt from tbl_hardware_log_repair where cate_id = '$cate_id' and serail_no = '$serail_no'";
		$rs = mysqli_query($conn,$sql);
		$c = mysqli_fetch_array($rs);
		echo $c["cnt"];
	break;

	case "hw.expose" :
		$id_rep = $_REQUEST["id_rep"];
		$user_expose = $_REQUEST["user_expose"];
		$cate_id = $_REQUEST["cate_id"];
		$serialno = $_REQUEST["serialno"];
    $hardware_status = $_REQUEST["status_hw"];
		$dtetme = getDteTme();
		$sql = "update tbl_hardware_onhand_user set user_id = '$user_expose',dte_tme_form_stock='$dtetme' , 
		hardware_status = '$hardware_status', from_site_id='',changedatetime='$dtetme',
		lastupdate_from='".$_SESSION["User_id"]."' where id = '$id_rep'";
		mysqli_query($conn,$sql);
		mysqli_query($conn,"insert into tbl_hw_borrow (engineer_id,hardware_no,borrow_date,status_print) values ('$user_expose','$id_rep','$dtetme','')");



	break;


	case "hw.delete.serialno" :

		$id_rep = $_REQUEST["id_rep"];
		$sql = "delete from tbl_hardware_onhand_user where id = '$id_rep'";
		mysqli_query($conn,$sql);

	break;


	case "hw.waitrepair.add.serial.form" :

		$cate_id = $_REQUEST["cate_id"];
		$hardware_brand = $_REQUEST["hardware_brand"];
		$serialno = $_REQUEST["serialno"];
		$status_hw = $_REQUEST["status_hw"];
		$user_enter = $_REQUEST["user_enter"];
		$dte_tme_entry_stock = $_REQUEST["dte_tme_entry_stock"];
		$owner_by_sn = $_REQUEST["owner_by_sn"];

		$dte_tme_install = $_REQUEST["dte_tme_install"];
		$dte_tme_expired = $_REQUEST["dte_tme_expired"];

		$dte_tme_warranty = $_REQUEST["dte_tme_warranty"];
		$dte_tme_expired_warranty = $_REQUEST["dte_tme_expired_warranty"];

		$status_deal = $_REQUEST["status_deal"];

		$asset_by = $_REQUEST["asset_by"];;

		$buy_by = $_REQUEST["buy_by"];
		$license_windows_no = $_REQUEST["license_windows_no"];
		$sparepartfor = $_REQUEST["sparepartfor"];
		$repair_by = $_REQUEST["repair_by"];
		$fix_site4return = $_REQUEST["fix_site4return"];
		$bussinessname = $_REQUEST["bussinessname"]; 
		$dtetme = getDteTme();
		$user_id = $_SESSION["User_id"];
		$str = "";
		//$str = getDupplicateSN($cate_id,$serialno);//exit;
		if(getDupplicateSN($cate_id,$serialno)==0){
			$sql = "insert into tbl_hardware_onhand_user (user_id,cate_id,hardware_brand,hardware_no,dte_tme_entry_stock,dte_tme_fix_complete,
hardware_status,user_enter_system,owner_by,asset_by,status_pm,installation_date,expired_date,hardware_type,warranty_hardware_type_date,expired_hardware_type_date,comment_lot,license_windows_no,sparepartfor,repair_by,fix_site4return,bussinessname,changedatetime,lastupdate_from)
						values ('','$cate_id','$hardware_brand','$serialno','$dtetme','$dtetme','$status_hw',
'$user_enter','$owner_by_sn','$asset_by','n','$dte_tme_install','$dte_tme_expired','$status_deal','$dte_tme_warranty','$dte_tme_expired_warranty','$buy_by','$license_windows_no','$sparepartfor','$repair_by','$fix_site4return','$bussinessname','$dtetme','$user_id'
)";
			mysqli_query($conn,$sql);
		} else {
			$str =  "Serial No. นี้มีอยู่แล้ว";
		}
		echo $str;

	break;
    
    case "hw.waitrepair.edit.serial.form" :

	   $id = $_REQUEST["id"];
	   $license_windows_no = $_REQUEST["license_windows_no"];
	   $buy_by = $_REQUEST["buy_by"];
	   $owner_by = $_REQUEST["owner_by"];
	   $asset_by = $_REQUEST["asset_by"];
	   $sparepartfor = $_REQUEST["sparepartfor"];
	   $repair_by = $_REQUEST["repair_by"];
	   $comment_lot = $_REQUEST["comment_lot"];
	   $fix_site4return = $_REQUEST["fix_site4return"];
	   $cate_id = $_REQUEST["cate_id"];
	   $hardware_brand = $_REQUEST["hardware_brand"];
	   $bussinessname = $_REQUEST["bussinessname"];  	      
	$sql_count_row = "Select count(id) as cnt From tbl_hardware_onhand_user Where fix_site4return='$fix_site4return' And cate_id = '$cate_id' And hardware_brand ='$hardware_brand'";	      
	$rs_count_row = mysqli_query($conn,$sql_count_row);
	$c_count_row = mysqli_fetch_array($rs_count_row);
	$str = "";
	if($c_count_row["cnt"]==0){   
	    $sql = "update tbl_hardware_onhand_user set license_windows_no = '$license_windows_no',buy_by = '$buy_by',owner_by = '$owner_by',asset_by = '$asset_by',sparepartfor = '$sparepartfor',repair_by = '$repair_by',comment_lot = '$comment_lot',fix_site4return = '$fix_site4return' ,bussinessname='$bussinessname' Where id= $id";
	    mysqli_query($conn,$sql);
	} else {
	    $str = "Duplicate";	    
	}
	  echo $str;

	break;
    
    
    

	case "rpt.statisticssolve3g.form" :

		$typer = $_REQUEST["typer"];
		$dte = $_REQUEST["dte"];
		$site_id = $_REQUEST["site_id"];
		$site = split("\n",$site_id);
		for($i=0;$i<count($site);$i++){
		$str = "insert into tbl_statistic_solve_3g (dte,site_type,site_id) values ('$dte','$typer','$site[$i]')";// echo $str;
		mysqli_query($conn,$str);
		}
	break;

	case "count.3g.job" :

		$typer = $_REQUEST["typer"];
		$dte = $_REQUEST["dte"];
		$site_id = $_REQUEST["site_id"];
		$site = split("\n",$site_id);

		for($i=0;$i<count($site);$i++){
			$site_new = str_replace(" ","",$site[$i]);
			$site_new1 = split("T",$site_new);
			$comment = split("T",$site_new);
			$comment_new = trim($comment[1]);
			$str = "insert into tbl_count_job_3g (cnt_date,site_type,cnt_site_id,status_up) values ('$dte','$typer','$site_new1[0]','$comment_new')"; //echo $str;
			mysqli_query($conn,$str);
		//	echo $str."\n";//."  --  ".$comment_new."\n";//."--".$comment[0]
		}
	break;


	case "fix.gasnoil.form" :
		 $id = $_REQUEST["id"];
		 $gaskm = $_REQUEST["gaskm"];
		 $sql = "update tbl_user set gasperkilo = '$gaskm' where user_id = '$id'"; // echo $sql;
		mysqli_query($conn,$sql);
	 break;

	case "site.all" :

		 $typer = $_REQUEST["typer"];
		 $site_id = $_REQUEST["site_id"];
		 $site_old_name = iconvertlanguage($_REQUEST["site_old_name"]);
		 $site_new_name = iconvertlanguage($_REQUEST["site_new_name"]);
		 $site_name = iconvertlanguage($_REQUEST["site_name"]);
		 $pos = $_REQUEST["pos"];
		 $address = iconvertlanguage($_REQUEST["address"]);
		 $province_name = $_REQUEST["province_name"];
		 $contact = iconvertlanguage($_REQUEST["contact"]);
		 $center_phase = $_REQUEST["center_phase"];
		 $from_center = iconvertlanguage($_REQUEST["from_center"]);
     $from_owner = $_REQUEST["from_owner"];
     $Latitude = $_REQUEST["Latitude"];
     $Longtitude = $_REQUEST["Longtitude"];


		 $cmd = "";
		 if($typer == "add"){
				 if(getSiteDuplicate($site_id)==0){
					$sql = "insert into tbl_site (site_id,site_old_name,site_new_name,site_name,pos,address,province_name,contact,center_phase,from_center,from_owner,latitude,longitude)
					values ('$site_id','$site_old_name','$site_new_name','$site_name','$pos','$address','$province_name','$contact','$center_phase','$from_center','$from_owner'
,'$Latitude','$Longtitude')";
				 } else {
				 		echo "duplicate site";
				 }
		} else {
			 	$sql = "update tbl_site set site_old_name = '$site_old_name',site_new_name = '$site_new_name',site_name = '$site_name',pos = '$pos',address = '$address',province_name = '$province_name',contact = '$contact',center_phase = '$center_phase',from_center = '$from_center' , from_owner = '$from_owner',latitude='$Latitude',longitude='$Longtitude' 
				where site_id ='$site_id'";
		 		//echo $sql;
		 }
		mysqli_query($conn,$sql);

	 break;

	 case "del.files.upload" :

		 $folder_name = $_REQUEST["folder_name"];
		 $file_name = $_REQUEST["file_name"];
		 if(unlink("data/$folder_name/$file_name")){
		 		echo "<script> alert('Delete complete.');</script>";
				echo "<script> window.parent.location.href ='del.file.php?folder_name=$folder_name'</script>";
				exit();
			} else {
				echo "<script> alert('Can't delete.');</script>";
				echo "<script> window.parent.location.href ='del.file.php?folder_name=$folder_name'</script>";
				exit();}

	 break;

	 case "re-cal-gas-oil" :

		 $id_re = $_REQUEST["id_re"];
		 $new_param = $_REQUEST["new_param"];
		 $rs = mysqli_query($conn,"select * from tbl_incentive_detail where id = $id_re order by seq_id");
		 while($c = mysqli_fetch_array($rs)){
			$res = 0;
			$res = (double)$c["ditstance_result"] * $new_param;
			$sql = "update tbl_incentive_detail set fee_oil_gas = $res where id = $c[id] and seq_id = $c[seq_id]";
			mysqli_query($conn,$sql);
		 }

	 break;


	 case "signature4job" :

		 $id = $_REQUEST["id"];
		 $job_no = $_REQUEST["job_no"];
		 $dte_beg = $_REQUEST["dte_beg"];
		 $dte_end = $_REQUEST["dte_end"];
		 $file_name_old = $_FILES["browse"]["name"];
		 $names = $_REQUEST["names"];
		 $tel = $_REQUEST["tel"];
		 $dte = $_REQUEST["dte"];
		 $engineer = $_REQUEST["engineer"];
		 $job_type = $_REQUEST["job_type"];


		 if(copy($_FILES["browse"]["tmp_name"],"job_no_signature/$job_no.png")){
		 	$sql_insert_sig = "insert into tbl_job_signature (job_no,owner_name,signature_name,owner_tel,file_name_from_user,upload_file_engineer,dte_send_file)
			values ('$job_no','$names','$job_no.jpg','$tel','$file_name_old','$engineer','$dte')";
		 	mysqli_query($conn,$sql_insert_sig);
			$sql_update_sig = "update tbl_log_call_center set signature_status = 'y' where id = '$id'";
			mysqli_query($conn,$sql_update_sig);


			$input_file = "job_no_signature/$job_no.png";
			$output_file = "job_no_signature/$job_no.jpg";

			$width  = 180;
			$height  = 60;

			$input = imagecreatefrompng($input_file);
			list($width, $height) = getimagesize($input_file);
			$output = imagecreatetruecolor($width, $height);
			$white = imagecolorallocate($output,  255, 255, 255);
			imagefilledrectangle($output, 0, 0, $width, $height, $white);
			imagecopy($output, $input, 0, 0, 0, 0, $width, $height);
			imagejpeg($output, $output_file);
			unlink($input_file);

		 	echo "<script>alert('Copy complete');window.location='logcall.index.php?dte_beg=$dte_beg&dte_end=$dte_end';</script>";
		 } else {
		 	echo "<script>alert('Can t upload');window.location='logcall.form.php?type=edit&id=$id&dte_beg=$dte_beg&dte_end=$dte_end';</script>";
		 }

	 break;

	case "serialsite2onhand" :

		$serial_id = $_REQUEST["serial_id"];
		$user_id = $_REQUEST["user_id"];
		$status_hw = $_REQUEST["status_hw"];
$cmd = "";
		if($status_hw=="w"){
			$cmd = ",hardware_status = 'o'";
			}


		$sql_select = "select count(id) as cnt,user_id,cate_id from tbl_hardware_onhand_user where id = '$serial_id' and hardware_status = 'w'";
		$rs_curnt = mysqli_query($conn,$sql_select);
		$c_curnt = mysqli_fetch_array($rs_curnt);
		if($c_curnt["cnt"]==1){
			$sql_insert = "insert into tbl_hardware_onhand_user (user_id,cate_id,hardware_no,hardware_status)
			values ('$c_curnt[user_id]','$c_curnt[cate_id]','','w')";
			echo $sql_insert;//<font color=red><b>Missing</b></font>
			mysqli_query($conn,$sql_insert);
		}


		$sql = "update tbl_hardware_onhand_user set user_id = '$user_id' $cmd where id = $serial_id";
		mysqli_query($conn,$sql);





	break;


	// case "upload.msr.file.from.email" :
//	$folder = "\\job_no\\";
//	$bigchernFile = $_FILES['foldername'];
//		 if(!copy($bigchernFile['tmp_name'][$i],  $folder.$bigchernFile['name'][$i])){
//				exit();
//			}
//	 break;
//





}


function iconvertlanguage($str){
	return iconv('UTF-8','TIS-620',$str);
}

function formatenum($i){
	if($i<10  && $i>0 ){
		return "BSS-00000".(string)$i;
	} else if($i<100 && $i>10){
		return "BSS-0000".(string)$i;
	} else if($i<1000 && $i>100){
		return "BSS-000".(string)$i;
	} else if($i<10000 && $i>1000){
		return "BSS-00".(string)$i;
	} else if($i<100000 && $i>10000){
		return "BSS-0".(string)$i;
	} else {
		return "BSS-".(string)$i;//site_name
	}
}

function getDteTme(){
        $today = getdate();
        $dte = $today["year"] ."-".$today["mon"]."-".$today["mday"]." ".($today["hours"]-1).":".$today["minutes"].":".$today["seconds"];
        return $dte;
}

  function getDupplicateSN($cate_id,$sn){
	  global $conn;
     $sql = "select count(cate_id) as cnt from tbl_hardware_onhand_user where cate_id = '$cate_id' and hardware_no = TRIM('$sn')";
     $rc = mysqli_query($conn,$sql);
     $c = mysqli_fetch_array($rc);
     return  $c["cnt"]; // $sql;//
  }

    function getSiteDuplicate($site_id){
		global $conn;
     $sql = "select count(site_id) as cnt from tbl_site where site_id = '$site_id'";
     $rc = mysqli_query($conn,$sql);
     $c = mysqli_fetch_array($rc);
     return  $c["cnt"]; // $sql;//
  }




/*	0: ยังไม่ได้ request ไปยัง server
		1: สร้างการติดต่อไปยัง server
		2: ได้รับการRequest
		3: กำลังประมวลผล Request เพื่อส่งกลับไปยัง Client
		4: ประมวลผลเสร็จแล้วรอการส่งกลับไปยัง Client

		xmlvariable.status //จะ Return ค่า 200, 404
		มีความหมายดังนี้
		200: ใช้งานได้
		404: Page not found(คุ้นๆมั้ยครับ)



<div id="sndiv">
		function getXMLHTTP() {
		  var xmlhttp=false;
        try{
            xmlhttp=new XMLHttpRequest();
        } catch(e)    {
            try{
                xmlhttp= new ActiveXObject("Microsoft.XMLHTTP");
            } catch(e){
                try{
               		 xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
                } catch(e1){
                    xmlhttp=false;
                }
            }
        }
        return xmlhttp;
    }
    function get_cate_Id(val) {
        var req = getXMLHTTP();
        if (req) {
            req.onreadystatechange = function() {
                if (req.readyState == 4) {
                    if (req.status == 200) {
                        document.getElementById('sndiv').innerHTML=req.responseText;
                    } else {
                        alert("There was a problem while using XMLHTTP:\n" + req.statusText);
                    }
                }
            }
	    var user = document.getElementById('user_id').value;
		var	vale = "getserialno.php?user_Id="+user+"&cate_id="+val;
            req.open("GET", vale, true);
            req.send(null);
        }

    }	*/

