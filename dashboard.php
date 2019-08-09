<?
header("Content-Type: text/html; charset=tis-620");                 
session_start();
require_once("function.php");
                                             
  
  if(!checkUser()){    echo Message(35,"red",$titel1,$msg1,"<a href='index.php?link=dashboard'> $login </a>");
  exit;
  }         
 $today = getdate();
 $months = $today["mon"];
 $years = $today["year"];
 $ym = $years."-".formatNum($months,1);
 include("header.php");  

?>

  
<title>Bizserv Solution Co.,Ltd</title>   
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
                    
<table width="100%" align="center" class="mytable" id="table" height="100%"   cellpadding="1" cellspacing="1" >
    <tr>
        <td valign="top"> 
            <form  method="post" name="form1" id="form1" action="dashboard.php" target="_parent"> 
			    <table width="100%" border="0" cellpadding="0" cellspacing="0" class="mytable">
                    <tr>
                        <td align ="center">
						<span class="fonttitle_board">&nbsp;Type :</span> 
                            <select name="types_site" id="types_site" onchange="form1.submit();">  
									<option value="NGV">NGV</option>
									<option value="Oil">Oil</option>
									<option value="Res">Resturant</option>
								</select>&nbsp;
                        <span class="fonttitle_board">&nbsp;Month :</span> 
                            <select name="months" id="months" onchange="form1.submit();">                 
                                <option value = "01" <?if($months=="01") echo "selected";?> >January</option>            
                                <option value = "02" <?if($months=="02") echo "selected";?> >February</option>          
                                <option value = "03" <?if($months=="03") echo "selected";?> >March</option>          
                                <option value = "04" <?if($months=="04") echo "selected";?> >April</option>          
                                <option value = "05" <?if($months=="05") echo "selected";?> >May</option>          
                                <option value = "06" <?if($months=="06") echo "selected";?> >June</option>          
                                <option value = "07" <?if($months=="07") echo "selected";?> >July</option>          
                                <option value = "08" <?if($months=="08") echo "selected";?> >August</option>          
                                <option value = "09" <?if($months=="09") echo "selected";?> >September</option>          
                                <option value = "10" <?if($months=="10") echo "selected";?> >October</option>          
                                <option value = "11" <?if($months=="11") echo "selected";?> >November</option>       
                                <option value = "12" <?if($months=="12") echo "selected";?> >December</option>               
                            </select> &nbsp;

							<span class="fonttitle_board">&nbsp;Year :</span>
			<select name="years" id="years" onchange="form1.submit();">                 
                                <option value = "2012" <?if($years==2012) echo "selected";?> >2012</option>            
                                <option value = "2013" <?if($years==2013) echo "selected";?> >2013</option>          
                                <option value = "2014" <?if($years==2014) echo "selected";?> >2014</option>          
                                <option value = "2015" <?if($years==2015) echo "selected";?> >2015</option>                      
                            </select> 
                        </td>          
						
                        <td width="18" valign="middle">       
                            <a href="#" onclick="form1.submit();">
                            <img src="image/pixadex.png" alt="Report" width="20" height="20" border="0" align="right"> </a></td>
                            <td width="27" valign="middle">&nbsp;<b><nobr>Report </b></td>                         
                        <td width="18" valign="middle">
                        <img src="image/cancel.JPG" alt="Delete" width="20" height="20" border="0" align="right">
                        </td>
                        <td width="27" valign="middle">&nbsp;<b><nobr>Cancel </b></td>
                    </tr>
                </table> <br>
                                             
<? 
         $sql_total_job = "SELECT count(call_type) as cntJob FROM tbl_log_call_center where open_call_dte like '$ym%'"; 
	$rc_total_job = mysqli_query($conn,$sql_total_job);	
	$c_total_job = mysqli_fetch_array($rc_total_job);        	
?>
                <table align="center"  cellpadding="1" cellspacing="1" class="mytable">
                    <tr>             
                        <th class="th" width="50%">Total NGV</th>          
			<th class="th" width="10%"><?=$c_total_job["cntJob"];?>&nbsp;Jobs</th>
		 </tr>
                </table>
                  
                  
                  
                  
                <table align="center"  cellpadding="1" cellspacing="1" class="mytable">
                    <tr>             
                        <th class="th" width="40%" rowspan="2">Corrective Maintenance</th>
                        <th class="th" width="10%" colspan="2">SLA 0</th>
                        <th class="th" width="10%" colspan="2">SLA 1</th> 
                        <th class="th" width="10%" colspan="2">SLA 2</th> 
                        <th class="th" width="10%" colspan="2">SLA 3</th> 
                        <th class="th" width="10%" colspan="2">SLA 4</th>       
                    </tr >
                    <tr>             
                        <th class="th" width="5%">WSLA</th>
                        <th class="th" width="5%">FSLA</th> 
                        <th class="th" width="5%">WSLA</th>
                        <th class="th" width="5%">FSLA</th>
                        <th class="th" width="5%">WSLA</th>
                        <th class="th" width="5%">FSLA</th>
                        <th class="th" width="5%">WSLA</th> 
                        <th class="th" width="5%">FSLA</th>
                        <th class="th" width="5%">WSLA</th> 
                        <th class="th" width="5%">FSLA</th>       
                    </tr >
                  <?
			$sql_cm_total = "SELECT Count(tbl_log_call_center.job_no) AS cntRow
			 				 FROM tbl_log_call_center
							Where tbl_log_call_center.open_call_dte like '2012-07%'
							And tbl_log_call_center.category_type = '8'
							And tbl_log_call_center.type_problem = 'hw'";
			$rc_cm_total =mysqli_query($conn,$sql_cm_total);
			$c_cm_total = mysqli_fetch_array($rc_cm_total);
		 ?>
				  <tr onmouseover="this.style.backgroundColor='violet';" onmouseout="this.style.backgroundColor='white';" >
				           <td style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;"  align="center">Hardware</td>
					   <td style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;"  align="center"><?=$c_cm_total["cntRow"];?></td>
					   <td style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;"  align="left">&nbsp;&nbsp;<?=$c["report_name"];?></td>
				  </tr>
				  <tr onmouseover="this.style.backgroundColor='violet';" onmouseout="this.style.backgroundColor='white';" >
				           <td style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;"  align="center">Software</td>
					   <td style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;"  align="center"><?=$c_cm_total["cntRow"];?></td>
					   <td style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;"  align="left">&nbsp;&nbsp;<?=$c["report_name"];?></td>
				  </tr>
                       
                </table>  </form></td></tr></table>                    

