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
   function SelectedVal(job_no,site_id,location_to,gasperkilo){ 
        window.opener.document.formDetail.job_no.value = job_no;
        window.opener.document.formDetail.site_id.value = site_id;
        window.opener.document.formDetail.location_to.value = location_to;
        window.opener.document.formDetail.gasperkilo.value = gasperkilo;
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
        <?
        $dte = $_REQUEST["dte"]; 
//		$job_type = $_REQUEST["job_type"];
            $sql = "SELECT
                        tbl_log_call_center.doc,
                        tbl_log_call_center.job_no,
                        tbl_log_call_center.site_id,
                        tbl_log_call_center.problem,
                        tbl_log_call_center.fee_km,
                        tbl_site.site_name
                    FROM
                    tbl_log_call_center
                    Left Join tbl_site ON tbl_log_call_center.site_id = tbl_site.site_id
                    Where tbl_log_call_center.closed_date = '$dte'
                    And tbl_log_call_center.reciept_job_user_id = '".$_SESSION["User_id"]."'
                    And tbl_log_call_center.status_call not like 'feedback'
                    And tbl_log_call_center.status_call not like 'cancel not paid'";
//echo $sql;
       $res = mysqli_query($conn,$sql);            
        ?>
		<form action="#" method="post">
		<table width="100%" border="0" cellpadding="0" cellspacing="0" class="mytable">
                    <!--tr>
                        <td width="879" valign="middle" align="center"><b>Site Teyp : </b>
                          <select name="job_type" id="job_type" onChange="form.submit();">
                                    <option value = "NGV" <?//if($job_type=="NGV") echo "selected";?>>NGV</option>
                                    <option value = "Oil" <?//if($job_type=="Oil") echo "selected";?>>Oil</option>
                                    <option value = "Amazon" <?//if($job_type=="Amazon") echo "selected";?>>Amazon</option>
                                    <option value = "BSS" <?//if($job_type=="BSS") echo "selected";?>>Bizser</option>
                          </select>
                        </td>
                    </tr-->
		</table>
        <table align="center" bordercolor="#000000"   class="mytable" id="table7" border="0" width="60%"> 
                <tr>
                      <th width="50" class="th" ><nobr>&nbsp;No. :</th>
                      <th width="100" class="th" ><nobr>&nbsp;Job No.<nobr></th> 
                      <th width="100" class="th" ><nobr>&nbsp;Site ID<nobr></th>                        
                      <th width="150" class="th" ><nobr>&nbsp;Site Name<nobr></th>
                      <th width="300" class="th" ><nobr>&nbsp;Problem<nobr></th>
             </tr>
          <?   $i = 1;
             while( $row = mysqli_fetch_array($res) ){
		if(checkMyJob($dte,$row["job_no"],$row["site_id"])==0) {
            ?>
            <tr style="cursor:hand" onmouseover=high(this) onmouseout=low(this) onClick="SelectedVal('<?=$row[job_no]?>','<?=$row[site_id]?>','<?=$row[site_name]?>','<?=$row[fee_km]?>')">      
            <?                                                                                                                    
            echo"<td style='padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;' align = 'center'>$i</td>"; 
            echo"<td style='padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;' align = 'center'>&nbsp;$row[job_no]</td>"; 
            echo"<td style='padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;' align = 'center'>&nbsp;$row[site_id]</td>"; 
            echo"<td style='padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;'>&nbsp;$row[site_name]</td>";            
            echo"<td style='padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;'>&nbsp;$row[problem]</td>";            
            ?>         
        </tr>
        <? $i++;
                 }
        }
        ?>

        <?
                   //         itbl_logcall_retail.customer_id,
        $sql_retail = "SELECT
                            itbl_logcall_retail.job_no,
                            itbl_logcall_retail.problem_job,
                            itbl_logcall_retail.fee_km,
                            itbl_customer4.customer_id,
                            itbl_customer4.customer_name,
                            itbl_category_job.category_job
                       FROM
                       itbl_logcall_retail
                            Inner Join itbl_customer4 ON itbl_logcall_retail.customer_id = itbl_customer4.id
                            Inner Join itbl_category_job ON itbl_logcall_retail.problem_job = itbl_category_job.id
                       Where itbl_logcall_retail.close_datetime like '$dte%'
                           And itbl_logcall_retail.reciept_job_engineer = '".$_SESSION["User_id"]."'
                           And itbl_logcall_retail.status_call not like 'feedback'
                           And itbl_logcall_retail.status_call not like 'cancel not paid'";
//echo $sql_retail;
            $rs_retail = mysqli_query($conn,$sql_retail);
            while( $row_retail = mysqli_fetch_array($rs_retail) ){
                if(checkMyJob($dte,$row_retail["job_no"],$row_retail["customer_id"])==0) {
            ?>
         <tr style="cursor:hand" onmouseover=high(this) onmouseout=low(this) onClick="SelectedVal('<?=$row_retail[job_no]?>','<?=$row_retail[customer_id]?>','<?=$row_retail[customer_name]?>','<?=$row_retail[fee_km]?>')">
            <td style='padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;' align = 'center'><?=$i?></td>
            <td style='padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;' align = 'center'>&nbsp;<?=$row_retail["job_no"]?></td>
            <td style='padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;' align = 'center'>&nbsp;<?=$row_retail["customer_id"]?></td>
            <td style='padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;'>&nbsp;<?=$row_retail["customer_name"]?></td>
            <td style='padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;'>&nbsp;<?=$row_retail["category_job"]?></td>
        </tr>
       <?}}?>
        </table>
		<input type="button" name="home" id="home" value="Go home" onClick="SelectedVal('xxxx','xxxx','Office')">
   </form>     
</center>
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
