<?
header("Content-Type: text/html; charset=tis-620");                 
session_start();
require_once("function.php");                                   
  
  if(!checkUser()){    echo Message(35,"red",$titel1,$msg1,"<a href='index.php'> $login </a>");
  exit;
  }                                         

	  $dte = $_REQUEST["dte"];
      $id = $_REQUEST["id"];

	 
	   
?>
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
<table width="100%" align="center" class="mytable" id="table7"  cellpadding="1" cellspacing="1">
				<tr>             
                        <th class="th" colspan = "11" >CM POS NGV  (Per Call) </th>
                    </tr >
                    <tr>             
                        <th class="th" width="5%" align="center" >No.</th>
                        <th class="th" width="10%">Open Date</th>
                        <th class="th" width="10%" align="center" >Job No.</th>
                        <th class="th" width="20%">Problem</th>
                        <th class="th" width="30%">Solution</th> 
                        <th class="th" width="5%">Status SLA</th>
                        <th class="th" width="5%">Status Call</th> 
                    </tr >
					<?
					$sql = "SELECT
																		tbl_log_call_center.site_id,
																		tbl_log_call_center.problem,
																		tbl_log_call_center.problem_solving,
																		tbl_log_call_center.open_call_dte,
																		tbl_log_call_center.open_call_tme,
																		tbl_log_call_center.severity,
																		tbl_log_call_center.status_sla,
																		tbl_log_call_center.status_call,
																		tbl_log_call_center.job_no
																		FROM
																		tbl_log_call_center
																		Where tbl_log_call_center.site_id = '$id'
																		And tbl_log_call_center.open_call_dte like '$dte%'
																		And tbl_log_call_center.category_type = '8'"; //  echo $sql;
					$sql_all = mysqli_query($conn,$sql);
																			$i=0;
                     while($c_all = mysqli_fetch_array($sql_all)){
						 $i++;
						 ?>
						 <tr onmouseover="this.style.backgroundColor='violet';" onmouseout="this.style.backgroundColor='white';" >       
							<td style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;"  align="center">&nbsp;<?=$i?></td>     
                            <td  style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;" align="center">&nbsp;<?=$c_all["open_call_dte"]." ".$c_all["open_call_tme"];?></td> 
                            <td  style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;" align="center">&nbsp;<?=$c_all["job_no"];?></td>	
                            <td  style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;" align="left">&nbsp;<?=$c_all["problem"];?></td>			
							<td style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;"  align="left">&nbsp;<?=$c_all["problem_solving"]?></td>      
                            <td  style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;" align="center">&nbsp;<?=$c_all["status_sla"];?></td>	
                            <td  style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;" align="center">&nbsp;<?=$c_all["status_call"];?></td>			
							</tr>
	<?
				}
					?>
                </table>

				<br>
				<table width="100%" align="center" class="mytable" id="table7"  cellpadding="1" cellspacing="1">
				<tr>             
                        <th class="th" colspan = "11" >CM POS NGV</th>
                    </tr >
                    <tr>             
                        <th class="th" width="5%" align="center" >No.</th>
                        <th class="th" width="10%">Open Date</th>
                        <th class="th" width="10%" align="center" >Job No.</th>
                        <th class="th" width="20%">Problem</th>
                        <th class="th" width="30%">Solution</th> 
                        <th class="th" width="5%">Status SLA</th>
                        <th class="th" width="5%">Status Call</th> 
                    </tr >
					<?
					$sql = "SELECT
																		tbl_log_call_center.site_id,
																		tbl_log_call_center.problem,
																		tbl_log_call_center.problem_solving,
																		tbl_log_call_center.open_call_dte,
																		tbl_log_call_center.open_call_tme,
																		tbl_log_call_center.severity,
																		tbl_log_call_center.status_sla,
																		tbl_log_call_center.status_call,
																		tbl_log_call_center.job_no
																		FROM
																		tbl_log_call_center
																		Where tbl_log_call_center.site_id = '$id'
																		And tbl_log_call_center.open_call_dte like '$dte%'
																		And tbl_log_call_center.category_type = '9'";  //echo $sql;
					$sql_all = mysqli_query($conn,$sql);
																			$i=0;
                     while($c_all = mysqli_fetch_array($sql_all)){
						 $i++;
						 ?>
						 <tr onmouseover="this.style.backgroundColor='violet';" onmouseout="this.style.backgroundColor='white';" >       
							<td style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;"  align="center">&nbsp;<?=$i?></td>     
                            <td  style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;" align="center">&nbsp;<?=$c_all["open_call_dte"]." ".$c_all["open_call_tme"];?></td> 
                            <td  style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;" align="center">&nbsp;<?=$c_all["job_no"];?></td>	
                            <td  style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;" align="left">&nbsp;<?=$c_all["problem"];?></td>			
							<td style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;"  align="left">&nbsp;<?=$c_all["problem_solving"]?></td>      
                            <td  style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;" align="center">&nbsp;<?=$c_all["status_sla"];?></td>	
                            <td  style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;" align="center">&nbsp;<?=$c_all["status_call"];?></td>			
							</tr>
	<?
				}
					?>
                </table>
				</form>