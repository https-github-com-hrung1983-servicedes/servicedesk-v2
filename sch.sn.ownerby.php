<?
header("Content-Type: text/html; charset=tis-620");
///http://www.rlaid.com/product_272861_th
session_start();
require_once("function.php");

if(!checkUser()){    echo Message(35,"red","ข้อความเตือน","คุณยังไม่ได้กรอกชื่อและรหัสผ่านครับ","<a href='index.php?link=logcall.form'> เข้าสู่ระบบ </a>");
   exit;
}
$id = $_REQUEST["id"];
$type = $_REQUEST["type"];  
if($type != "add" && $type !="edit" ){
 echo Message(35,"red","ข้อความเตือน","คุณไม่มีสิทธิ์เข้าใช้หน้านี้","<a href='javascript:history.back(1)'> กลับ</a>");
 exit;
}
include("header.php");                    
if ($type == "add") {
    $open_date = getDte();     
    $onsite_date = getDte();     
    $fix_date = getDte();     
    $close_date = getDte();
    $appoint_date = getDte();	
    $hour_sal = "2";     
} elseif ($type == "edit") {
  $sql = "Select tbl_log_call_center.*,
              tbl_category_type.fixed_description,
              u1.name as reciept_name,            
              u1.sname as reciept_sname,         
              u2.name as engineer_name,
              u2.sname as engineer_sname,
              tbl_province.provice_phase,
			  tbl_site.site_name,
			  tbl_site.site_old_name,
	   		  tbl_site.pos,
			  tbl_site.province_name	
             From tbl_log_call_center
                    Left Join tbl_category_type ON tbl_log_call_center.category_type = tbl_category_type.category_id
                    Left Join tbl_user u1 ON tbl_log_call_center.reciept_job_bss = u1.user_id 
                    Left Join tbl_user u2 ON tbl_log_call_center.reciept_job_user_id = u2.user_id
                    Left Join tbl_province ON tbl_log_call_center.site_province = tbl_province.province_name
					Left Join tbl_site ON tbl_log_call_center.site_id = tbl_site.site_id
             Where tbl_log_call_center.id = $id";
 // echo $sql;
  $rs = mysqli_query($conn,$sql);
  $c = mysqli_fetch_array($rs);
    $open_date = $c["open_call_dte"];     
    $onsite_date = $c["onsite_datetime"];  
    $fix_date = $c["fixed_time"];     
    $close_date = $c["closed_date"];
    $hour_sal = $c["sla"];
    $appoint_date = $c["appoint_date"];
  //  echo "nn".$c["provice_phase"];
}
  //       echo getIDRand();   
  
  
  
  
        
   
      if($c["reciept_job_bss"]==""){                
          $reciept_id = $_SESSION["User_id"];
          $reciept_name = $_SESSION["Uname"]. " " .$_SESSION["Usname"];
      } else {
          $reciept_id  = $c["reciept_job_bss"];
          $reciept_name = $c["reciept_name"]. " " .$c["reciept_sname"];
      }
        
	//	$sql_status_sign = "select count(job_no) as cnt_job_status from tbl_job_signature  where job_no = '".$c["job_no"]."'";
//		$rs_status_sign = mysqli_query($conn,$sql_status_sign);  
//		$c_status_sign = mysqli_fetch_array($rs_status_sign);
	//	echo $sql_status_sign."<br>";
//		echo $c_status_sign["cnt_job_status"];
	//	exit;
?>

<meta http-equiv="Content-Type" content="text/html; charset=TIS-620" /> 
<link href="image/bss_icon.ico"   rel="shortcut icon" />  
<link href="style/calendar.css" rel="stylesheet" type="text/css">    
<link href="style/mytable.css" rel="stylesheet" type="text/css" />   
<script type="text/javascript" src="script/calendar_date_picker.js"></script>     
<link href="style/stylecss.css" rel="stylesheet" type="text/css">
<link href="style/filtergrid.css" rel="stylesheet" type="text/css">
<style type="text/css">
    <!--
    .mytable1 { width:100%; font-size:11px;
                border:1px solid #ccc;
                font-size:10px;     
    }
    .mytable11 {width:100%; font-size:12px;
                border:1px solid #ccc;
                font-size:11px;     
    }
     .th{ background-color:#003366; color:#FFF; padding:0px; border:0px solid #ccc; height:20px; }
     .td{ border-color:#003366;};
    -->
</style>
<meta http-equiv=Content-Type content="text/html; charset=tis-620">
<link href="css/loading.css" rel="stylesheet" type="text/css" media="all">

<script src="script/jquery.min.js"></script>
<script src="script/thickbox.js"></script>
<script src="script/loading.js"></script>

<script type="text/javascript" src="script/jquery-1.6.4.js"></script>
<script type="text/javascript" src="script/jquery_1.7.1_min.js"></script>
<script type="text/javascript">
$(document).ready(function(){

		$("#GenNo").click(function(){
					var job_no = $("#txtJobNo").val(); 
					
					if(job_no==""){
							var d = new Date();
							var dte = d.getFullYear()+"-"+(d.getMonth()+1)+"-"+d.getDate();
						$.post('function.execute.php',{mode : "gen_id_bss",dte : dte},
							function(data){
								$("#txtJobNo").val(data); 
							});
							return false;	  
					} else {
							$("#txtJobNo").val(''); 
					}
		});	
		
		
});
</script>
                    
<table width="100%" align="center" class="mytable11"  height="100%"   cellpadding="1" cellspacing="1" >     
    <tr>                                               
        <td valign="top" align="center">                                                       
            <form action="logcall.excute.php"  method="post"  name="form1" id="form1"  >
            <input class="form-control"  type="hidden" value="<?=$id?>" name="id" id = "id">     
            <input class="form-control"  type="hidden" value="<?=$c["job_no"];?>" name="job_no_update_bss" id = "job_no_update_bss">     
			<input class="form-control"  type="hidden" value="<?=$type?>" name="mode" id = "mode">     
            <input class="form-control"  type="hidden" value="<?=$_REQUEST["dte_beg"]?>" name="dte_beg" id = "dte_beg">
            <input class="form-control"  type="hidden" value="<?=$_REQUEST["dte_end"]?>" name="dte_end" id = "dte_end">
                <table width="100%" border="0" cellpadding="0" cellspacing="0" class="mytable" border="1" bordercolor="#FF0000">
                    <tr>
                        <th align="center" height="40" width="100%" colspan="7" class="th">Log call center</th>                    
                    </tr >
					
                    <tr>
					<? if($c["signature_status"] != "y"){?>
       					<td width="90%" align="right" >						
						<a lang="signature4job.php?type=add&id=<?=$id?>&job_type=<?=$c["category_type"]?>&job_no=<?=$c["job_no"];?>&dte_beg=<?=$_REQUEST["dte_beg"]?>&dte_end=<?=$_REQUEST["dte_end"]?>" class="thickbox pointer" title="Signature">
						<img src="image/addedit.png" alt="Cancel" width="20" height="18" border="0" align="right" /></a></td>
						<td><nobr><b>ลายเซ็นต์ผู้ตรวจสอบ</b></td> 
						<? } else { ?><td width="95%" align="right" ></td><? } ?>
						<td><input class="form-control"  name="Submit"  type="image" onclick=" return CheckText()"  src="image/save.jpg" alt="Save" align="right" width="20" height="20" />	</td>
					   <td align="left"><b>บันทึก</b>    </td>
					   <td><a href="javascript:history.back(1)" ><img src="image/cancel.jpg" alt="Cancel" width="20" height="18" border="0" align="left" /> </a> </td>
					   <td align="left"><nobr><b> ยกเลิก</b>     </td>
					 </tr>
                </table>
                <br>
                <table width="85%" align="center"  id="table" cellpadding="1" cellspacing="1" border="0">
				   <tr>
                      <td width="20%" height="25" align="left" class="fontBblue">Type :  </td>  
			
                    </tr>
                  
                  
                    
                    
                </table>
                <table align="center" class="mytable1" id="table7" cellpadding="1" cellspacing="1"><tr></tr >
                </table>
            </form></td></tr></table>












