<?
session_start();
header("Content-Type: text/html; charset=tis-620");

require_once("function.php");
require_once("script/function.js");

  if(!checkUser()){    echo Message(35,"red",$titel1,$msg1,"<a href='index.php?link=sch.job'> $login </a>");
  exit;
  }

  ?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874">
<link rel="stylesheet" href="style.css">
<script language="javascript" src="script.js"></script>
<script language="JavaScript">
   function SelectedVal(job_no,site_id,location_from,location_to,distance,gasperkilo,description){
        window.opener.document.formDetail.job_no.value = job_no;
        window.opener.document.formDetail.site_id.value = site_id;
		    window.opener.document.formDetail.location_from.value = location_from;
        window.opener.document.formDetail.location_to.value = location_to;
  	    window.opener.document.formDetail.distance_result_gps.value = distance;
        window.opener.document.formDetail.gasperkilo.value = gasperkilo;
        
        window.opener.document.formDetail.description.value = description;
        
        window.close();
   }
    </script>
   <link href="style/mytable.css" rel="stylesheet" type="text/css" />

<title>Bizserv Solution Co.,Ltd</title></head>
<link href="image/bss_icon.ico"   rel="shortcut icon" />
<link href="style/calendar.css" rel="stylesheet" type="text/css">
<link href="style/mytable.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="script/calendar_date_picker.js"></script>
<link href="style/stylecss.css" rel="stylesheet" type="text/css">
<link href="style/filtergrid.css" rel="stylesheet" type="text/css">
<meta http-equiv="refresh" content="300;"/>
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
     .td{ border-color:#003366;}
    -->
</style>
<body  >
<br>
<center>
        <? //echo "asdfsadf";
        $dte = $_REQUEST["dte"];
//		$job_type = $_REQUEST["job_type"];
            $sql = "SELECT
                        tbl_log_call_center.id,
                        tbl_log_call_center.doc,
                        tbl_log_call_center.job_no,
                        tbl_log_call_center.site_id,
                        tbl_log_call_center.problem,
                        tbl_log_call_center.fee_km,
                        tbl_site.site_name,
                        tbl_log_call_center.category_type
                    FROM
                    tbl_log_call_center
                    Left Join tbl_site ON tbl_log_call_center.site_id = tbl_site.site_id
                    Where tbl_log_call_center.closed_date = '$dte'
                    And tbl_log_call_center.reciept_job_user_id = '".$_SESSION["User_id"]."'
                    And tbl_log_call_center.status_call not like 'feedback'
                    And tbl_log_call_center.status_call not like 'cancel not paid'";
		  //  echo $sql;
       $res = mysqli_query($conn,$sql);
        ?>
		<form action="#" method="post">
		<table width="100%" border="0" cellpadding="0" cellspacing="0" class="mytable">
		</table>
        <table align="center" bordercolor="#000000"   class="mytable" id="table7" border="0" width="60%">
                <tr>
                      <th width="50" class="th" ><nobr>&nbsp;No. :</th>
                      <th width="100" class="th" ><nobr>&nbsp;Job No.<nobr></th>
                      <th width="100" class="th" ><nobr>&nbsp;Site ID<nobr></th>
                      <th width="150" class="th" ><nobr>&nbsp;Site Name<nobr></th>
                      <th width="300" class="th" ><nobr>&nbsp;Problem<nobr></th>
                      <th width="50" class="th" ><nobr>&nbsp;B/Km.<nobr></th>
             </tr>
          <?   $i = 1;
             while( $row = mysqli_fetch_array($res) ){

			   $sql_address="select b.address,b.la,b.lo,c.latitude,c.longitude
				  from tbl_log_call_center a
				  left outer join tbl_job_location b on a.id=b.job_no
				  left outer join tbl_site c on a.site_id=c.site_id
				  where a.job_no='".$row['job_no']."' ";
			   $res_address = mysqli_query($conn,$sql_address);
			   $row_address = mysqli_fetch_array($res_address);


				  if($job_status=="station"){
				  $len=distance($a["la"], $a["lo"], $lat, $long, "K");
				  //echo $len;
				  }else{
				  $len='0';
				  }
          $rid=$row["id"];
        $sql_distance1="SELECT sum(a.len_total) as total_distance FROM tbl_job_location a
                        Where a.job_no= '".$rid."' ";
        $res_distance1 = mysqli_query($conn,$sql_distance1);
        $row_distance1 = mysqli_fetch_array($res_distance1);
        $distance1=number_format(($row_distance1["total_distance"]), 2, '.', ',');
	 if(checkMyJob($dte,$row["job_no"],$row["site_id"])==0) { ?>
              <tr style="cursor:hand;" onmouseover=high(this) onmouseout=low(this) onClick="SelectedVal('<?=$row[job_no]?>','<?=$row[site_id]?>','<?=$row_address[address]?>','<?=$row[site_name]?>','<?=$distance1?>','<?=$row[fee_km]?>','<?=$row[problem]?>')">
         <?
            echo"<td style='padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;' align = 'center'>$i</td>";
            echo"<td style='padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;' align = 'center'>&nbsp;$row[job_no]</td>";
            echo"<td style='padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;' align = 'center'>&nbsp;$row[site_id]</td>";
            echo"<td style='padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;'>&nbsp;$row[site_name]</td>";
            echo"<td style='padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;'>&nbsp;$row[problem]</td>";
            echo"<td style='padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;'>&nbsp;$row[fee_km]</td>";
            ?>
        </tr>
        <? $i++;
                 }
        }
        ?>

        <?
                   //    Retail     itbl_logcall_retail.customer_id,
          $sql_retail = "SELECT
                              itbl_logcall_retail.id,
                              itbl_logcall_retail.job_no,
                              itbl_logcall_retail.problem_job,
                              itbl_logcall_retail.fee_km,
                              itbl_customer4.customer_id,
                              itbl_customer4.customer_name,
                              itbl_customer4.customer_address,
                              itbl_category_job.category_job
                         FROM
                         itbl_logcall_retail
                              Inner Join itbl_customer4 ON itbl_logcall_retail.customer_id = itbl_customer4.id
                              Inner Join itbl_category_job ON itbl_logcall_retail.problem_job = itbl_category_job.id
                       Where itbl_logcall_retail.close_datetime like '$dte%'
                           And itbl_logcall_retail.reciept_job_engineer = '".$_SESSION["User_id"]."'
                           And itbl_logcall_retail.status_call not like 'feedback'
                           And itbl_logcall_retail.status_call not like 'cancel not paid'
                           and paid_status='y'
                           ";
            $rs_retail = mysqli_query($conn,$sql_retail);
            while( $row_retail = mysqli_fetch_array($rs_retail) ){
                if(checkMyJob($dte,$row_retail["job_no"],$row_retail["customer_id"])==0) {
                  $rid=$row_retail["id"];

                  $sql_distance="SELECT sum(a.len_total) as total_distance FROM tbl_job_location a
                                  Where a.job_no= '".$rid."' ";
                  $res_distance = mysqli_query($conn,$sql_distance);
                  $row_distance = mysqli_fetch_array($res_distance);
		  $distance=number_format(($row_distance["total_distance"]), 2, '.', ',');
               
      ?>
      <tr style="cursor:hand" onmouseover=high(this) onmouseout=low(this) onClick="SelectedVal('<?=$row_retail[job_no]?>','<?=$row_retail[customer_id]?>','<?=$row_retail[customer_address]?>','<?=$row_retail[customer_name]?>','<?=$distance?>','<?=$row_retail[fee_km]?>','<?=$row_retail[problem_job]?>')">
            <td style='padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;' align = 'center'><?=$i?></td>
            <td style='padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;' align = 'center'>&nbsp;<?=$row_retail["job_no"]?></td>
            <td style='padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;' align = 'center'>&nbsp;<?=$row_retail["customer_id"]?></td>
            <td style='padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;'>&nbsp;<?=$row_retail["customer_name"]?></td>
            <td style='padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;'>&nbsp;<?=$row_retail["category_job"]?></td>
        </tr>
       <? } // if
       } // While ?>
       
       
       
         <?
                   //         Major
          $sql_major = "SELECT
				 tbl_major_logcall.id,
				 tbl_major_logcall.job_no,
				 tbl_major_logcall.problem_job_detail,
				 tbl_major_logcall.fee_km,
				 tbl_major_category_job_type.category_type,
				 tbl_major_site.customer_id,
				 tbl_major_site.customer_name,
				 tbl_major_site.customer_address				 
				 FROM
				 tbl_major_logcall
				 Left Join tbl_major_category_job_type ON tbl_major_logcall.problem_job = tbl_major_category_job_type.category_id
				 Inner Join tbl_major_site ON tbl_major_logcall.customer_id = tbl_major_site.id
				 Where tbl_major_logcall.close_datetime like '$dte%'
				 And tbl_major_logcall.reciept_job_engineer = '".$_SESSION["User_id"]."'
				 And tbl_major_logcall.status_call not like 'feedback'
				 And tbl_major_logcall.status_call not like 'cancel not paid'
                           ";
//echo $sql_major;
            $rs_major = mysqli_query($conn,$sql_major);
	    $iMajor = 1;
            while( $row_major = mysqli_fetch_array($rs_major) ){
                if(checkMyJob($dte,$row_major["job_no"],$row_major["customer_id"])==0) {
                  $rid=$row_major["id"];
                  $sql_distance_major="SELECT sum(a.len_total) as total_distance FROM tbl_job_location a
                                  Where a.job_no= '".$rid."' ";
                  $res_distance_major = mysqli_query($conn,$sql_distance_major);
                  $row_distance_major = mysqli_fetch_array($res_distance_major);
          	  $distance_major=number_format(($row_distance_major["total_distance"]), 2, '.', ',');
      ?>
      <tr style="cursor:hand" onmouseover=high(this) onmouseout=low(this) onClick="SelectedVal('<?=$row_major[job_no]?>','<?=$row_major[customer_id]?>','<?=$row_major[customer_address]?>','<?=$row_major[customer_name]?>','<?=$distance_major?>','<?=$row_major[fee_km]?>','<?=$row_major[problem_job_detail]?>')">
            <td style='padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;' align = 'center'><?=$iMajor++?></td>
            <td style='padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;' align = 'center'>&nbsp;<?=$row_major["job_no"]?></td>
            <td style='padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;' align = 'center'>&nbsp;<?=$row_major["customer_id"]?></td>
            <td style='padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;'>&nbsp;<?=$row_major["customer_name"]?></td>
            <td style='padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;'>&nbsp;<?=$row_major["problem_job_detail"]?></td>
        </tr>
       <?}//if checkMyJob
       }// While?>
       
       
       
       <?
                   //         iTerminal
          $sql_iTerminal = "SELECT
          tbl_iterminal_logcall.id,
          tbl_iterminal_logcall.job_no,
          tbl_iterminal_logcall.problem_job_detail,
          tbl_iterminal_category_job_type.category_type,
          tbl_iterminal_site.customer_id,
          tbl_iterminal_site.customer_name,
          tbl_iterminal_site.customer_address				 
				 FROM
				 tbl_iterminal_logcall
				 Inner Join tbl_iterminal_category_job_type ON tbl_iterminal_logcall.problem_job = tbl_iterminal_category_job_type.category_id
				 Inner Join tbl_iterminal_site ON tbl_iterminal_logcall.customer_id = tbl_iterminal_site.id
				 Where tbl_iterminal_logcall.close_datetime like '$dte%'
				 And tbl_iterminal_logcall.reciept_job_engineer = '".$_SESSION["User_id"]."'
				 And tbl_iterminal_logcall.status_call not like 'feedback'
				 And tbl_iterminal_logcall.status_call not like 'cancel not paid'
                           ";
//echo $sql_major;
            $rs_iTerminal = mysqli_query($conn,$sql_iTerminal);
	    $iTerminal = 1;
            while( $row_iTerminal = mysqli_fetch_array($rs_iTerminal) ){
                if(checkMyJob($dte,$row_iTerminal["job_no"],$row_iTerminal["customer_id"])==0) {
                  $rid=$row_major["id"];
                  $sql_distance_major="SELECT sum(a.len_total) as total_distance FROM tbl_job_location a
                                  Where a.job_no= '".$rid."' ";
                  $res_distance_major = mysqli_query($conn,$sql_distance_major);
                  $row_distance_major = mysqli_fetch_array($res_distance_major);
          	  $distance_major=number_format(($row_distance_major["total_distance"]), 2, '.', ',');
      ?>
      <tr style="cursor:hand" onmouseover=high(this) onmouseout=low(this) onClick="SelectedVal('<?=$row_iTerminal[job_no]?>','<?=$row_iTerminal[customer_id]?>','<?=$row_iTerminal[customer_address]?>','<?=$row_iTerminal[customer_name]?>','<?=$distance_major?>','<?=$row_iTerminal[fee_km]?>','<?=$row_iTerminal[problem_job_detail]?>')">
            <td style='padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;' align = 'center'><?=$iTerminal++?></td>
            <td style='padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;' align = 'center'>&nbsp;<?=$row_iTerminal["job_no"]?></td>
            <td style='padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;' align = 'center'>&nbsp;<?=$row_iTerminal["customer_id"]?></td>
            <td style='padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;'>&nbsp;<?=$row_iTerminal["customer_name"]?></td>
            <td style='padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;'>&nbsp;<?=$row_iTerminal["problem_job_detail"]?></td>
        </tr>
       <?}//if checkMyJob
       }// While?>
       
       




       
       
       <?
                   //         PTG
          $sql_ptg = "SELECT
          tbl_ptg_logcall.id,
          tbl_ptg_logcall.job_no,
          tbl_ptg_logcall.problem_job_detail,
          tbl_ptg_category_job_type.category_type,
          tbl_ptg_site.customer_id,
          tbl_ptg_site.customer_name,
          tbl_ptg_site.customer_address				 
				 FROM
				 tbl_ptg_logcall
				 Inner Join tbl_ptg_category_job_type ON tbl_ptg_logcall.problem_job = tbl_ptg_category_job_type.category_id
				 Inner Join tbl_ptg_site ON tbl_ptg_logcall.customer_id = tbl_ptg_site.id
				 Where tbl_ptg_logcall.close_datetime like '$dte%'
				 And tbl_ptg_logcall.reciept_job_engineer = '".$_SESSION["User_id"]."'
				 And tbl_ptg_logcall.status_call not like 'feedback'
				 And tbl_ptg_logcall.status_call not like 'cancel not paid'
                           ";
//echo $sql_ptg;
            $rs_ptg = mysqli_query($conn,$sql_ptg);
	    $ptg = 1;
            while( $row_ptg = mysqli_fetch_array($rs_ptg) ){
                if(checkMyJob($dte,$row_ptg["job_no"],$row_ptg["customer_id"])==0) {
                 /* $rid=$row_major["id"];
                  $sql_distance_major="SELECT sum(a.len_total) as total_distance FROM tbl_job_location a
                                  Where a.job_no= '".$rid."' ";
                  $res_distance_major = mysqli_query($conn,$sql_distance_major);
                  $row_distance_major = mysqli_fetch_array($res_distance_major);
          	  $distance_major=number_format(($row_distance_major["total_distance"]), 2, '.', ',');*/
                $distance_major = 0;
                $address = addslashes($row_ptg[customer_address]);
                $problem = addslashes($row_ptg[problem_job_detail]);
                $problem1 = str_replace('\n', '',$problem);
      ?>
      <tr style="cursor:hand" onmouseover=high(this) onmouseout=low(this) onClick="SelectedVal('<?=$row_ptg[job_no]?>','<?=$row_ptg[customer_id]?>','<?=$address?>','<?=$row_ptg[customer_name]?>','<?=$distance_major?>','','')">
            <td style='padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;' align = 'center'><?=$ptg++?></td>
            <td style='padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;' align = 'center'>&nbsp;<?=$row_ptg["job_no"]?></td>
            <td style='padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;' align = 'center'>&nbsp;<?=$row_ptg["customer_id"]?></td>
            <td style='padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;'>&nbsp;<?=$row_ptg["customer_name"]?></td>
            <td style='padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;'>&nbsp;<?=$row_ptg["problem_job_detail"]?></td>
        </tr>
       <?}//if checkMyJob
       }// While?>
       


        </table>

   </form>
</center>

  <div style="font-size:10px; color:red;">*Red - <?=iconv( 'UTF-8', 'TIS-620', "ไม่สามารถเบิกได้(ยังไม่ได้ส่งเอกสาร)");?></div>
  <div style="font-size:10px; color:black;">*Black - <?=iconv( 'UTF-8', 'TIS-620', "เบิกได้ปกติ");?></div>

</body>
</html>
<?
   function checkMyJob($dte,$job_no,$site_id){
	   global $conn;
	$sql = "select count(job_no) as cnt from tbl_incentive_detail where dte = '$dte' and job_no = '$job_no' and site_id = '$site_id'";
	$rc = mysqli_query($conn,$sql);
	$c = mysqli_fetch_array($rc);
	return $c["cnt"];
}



?>
