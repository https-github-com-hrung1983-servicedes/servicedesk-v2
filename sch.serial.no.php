<? 
session_start();                 
header("Content-Type: text/html; charset=tis-620");

require_once("function.php");           
require_once("script/function.js");  
  
  if(!checkUser()){    echo Message(35,"red",$titel1,$msg1,"<a href='index.php?link=sch.serial.no'> $login </a>");
  exit;
  }                                 
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874"> 
<link rel="stylesheet" href="style.css">
<script language="javascript" src="script.js"></script>    
<script language="JavaScript">       
   function SelectedVal(job_no,site_id){ 
        window.opener.document.formDetail.job_no.value = job_no;
        window.opener.document.formDetail.site_id.value = site_id;
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
     .td{ border-color:#003366;};
    -->
</style> 
<body  >
<br>
<center>
        <?
        $dte = $_REQUEST["dte"]; 
		$job_type = $_REQUEST["job_type"]; echo $site_id;
        if($job_type=="NGV"){
            $sql = "SELECT
						tbl_log_call_center.job_no,
						tbl_log_call_center.site_id,
						tbl_log_call_center.problem,
						tbl_station_ngv.site_name
						FROM
						tbl_log_call_center
						Inner Join tbl_station_ngv ON tbl_log_call_center.site_id = tbl_station_ngv.site_id
						Where tbl_log_call_center.open_call_dte = '$dte'";   
        } else if($job_type=="Oil") {
            $sql = "SELECT
						tbl_log_call_center.job_no,
						tbl_log_call_center.site_id,
						tbl_log_call_center.problem,
						tbl_station_oil.site_name
						FROM
						tbl_log_call_center
						Inner Join tbl_station_oil ON tbl_log_call_center.site_id = tbl_station_oil.station_id
						Where tbl_log_call_center.open_call_dte = '$dte'";            
        } else if($job_type=="Amazon") {
                $sql = "SELECT
							tbl_log_call_center.job_no,
							tbl_log_call_center.site_id,
							tbl_log_call_center.problem,
							tbl_station_amazon.site_name
							FROM
							tbl_log_call_center
							Inner Join tbl_station_amazon ON tbl_log_call_center.site_id = tbl_station_amazon.site_id
							Where tbl_log_call_center.open_call_dte = '$dte'";
        }
	//	echo $sql;
       $res = mysqli_query($conn,$sql);            
      
        ?>
		<form action="#" method="post">
		<table width="100%" border="0" cellpadding="0" cellspacing="0" class="mytable">
                    <tr>
                        <td width="879" valign="middle" align="center"><b>Site Teyp : </b>
							<select name="job_type" id="job_type" onchange="form.submit();">
								<option value = "NGV" <?if($job_type=="NGV") echo "selected";?>>NGV</option>
								<option value = "Oil" <?if($job_type=="Oil") echo "selected";?>>Oil</option>
								<option value = "Amazon" <?if($job_type=="Amazon") echo "selected";?>>Amazon</option>
							</select>
						</td>                    
                    </tr>
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
            ?>
            <tr style="cursor:hand"onmouseover=high(this) onmouseout=low(this) onClick="SelectedVal('<?=$row[job_no]?>','<?=$row[site_id]?>')">      
            <?                                                                                                                    
            echo"<td style='padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;' align = 'center'>$i</td>"; 
            echo"<td style='padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;' align = 'center'>&nbsp;$row[job_no]</td>"; 
            echo"<td style='padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;' align = 'center'>&nbsp;$row[site_id]</td>"; 
            echo"<td style='padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;'>&nbsp;$row[site_name]</td>";            
            echo"<td style='padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;'>&nbsp;$row[problem]</td>";            
            ?>         
        </tr>
        <?
             $i++;
             }
             ?>
            
        </table>
   </form>     
</center>
</body>
</html>
