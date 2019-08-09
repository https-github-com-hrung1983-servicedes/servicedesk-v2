<?
header("Content-Type: text/html; charset=tis-620");                 
session_start();
require_once("function.php");                                   
  
  if(!checkUser()){    echo Message(35,"red",$titel1,$msg1,"<a href='index.php?link=cm_sla_percentage'> $login </a>");
		 exit;
  }                                                                                                      
 include("header.php"); 

	  $months = $_REQUEST["months"];
      $years = $_REQUEST["years"];
	  $today = getdate();
//	  print_r($today);
	  if ( $months == "" || $years=="" ) {
			$months = date("m");  //$today["mon"]
			$years = $today["year"];
			$dte = $years."-".$months;//formatNum($months,1)
	  } else  {
		$dte = $years."-".$months; 
	  }
	 
	   
?>
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
    .mytableX { width:50%; font-size:11px;
                border:1px solid #ccc;
                font-size:11px;     
    }
    .mytable11 {width:100%; font-size:12px;
                border:1px solid #ccc;
                font-size:11px;     
    }
     .th{ background-color:#003366; color:#FFF; padding:0px; border:0px solid #ccc; height:20px; }
     .td{ border-color:#003366;};
    -->
</style> 
    
<title>Bizserv Solution Co.,Ltd</title>              
<table width="100%" align="center" class="mytable" id="table" height="100%"   cellpadding="1" cellspacing="1" >
    <tr>
        <td valign="top"> 
            <form  method="post" name="form1" id="form1" action="#" target="_parent">             

                   <table width="100%" border="0" cellpadding="0" cellspacing="0" class="mytable">
                    <tr>
                        <td align="center">
                        <b>&nbsp;Month :</b> 
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

							<b>&nbsp;Year :</b>
									<select name="years" id="years" onchange="form1.submit();">                 
                                <option value = "2012" <?if($years==2012) echo "selected";?> >2012</option>            
                                <option value = "2013" <?if($years==2013) echo "selected";?> >2013</option>          
                                <option value = "2014" <?if($years==2014) echo "selected";?> >2014</option>          
                                <option value = "2015" <?if($years==2015) echo "selected";?> >2015</option>                      
                            </select> </td>
                            <td><a href="javascript:history.back(1)" >
                                    <img src="image/cancel.jpg" alt="Cancel" width="20" height="18" border="0" align="right" /> </a> </td>
                            <td align="left"><nobr>&nbsp;<b> ยกเลิก</b>     </td>
                    </tr>
                </table>     
                <table width="100%" border="1" align="center" class="mytable" id="table7"  cellpadding="1" cellspacing="1">
				<tr>             
                        <th class="th" colspan = "13" >CM NGV  (Per Call)</th>
                    </tr >
                    <tr>             
                        <th class="th" width="10%" rowspan="2"  align="center" >Site Name</th>
						<th class="th" width="10%" colspan="2">WSLA</th>
                        <th class="th" width="10%" colspan="2">FSLA</th>
                        <th class="th" width="10%" colspan="2">Close</th>   
                        <th class="th" width="10%" colspan="2">Cancel</th> 
                        <th class="th" width="10%" colspan="2">Inprogress</th>         
                        <th class="th" width="10%" colspan="2">Total</th>
                    </tr >
					<tr>             
						<th class="th" width="5%">Job</th>
                        <th class="th" width="5%">Percentage</th>
                        <th class="th" width="5%">Job</th> 
                        <th class="th" width="5%">Percentage</th>         
                        <th class="th" width="5%">Job</th>
                        <th class="th" width="5%">Percentage</th>         
                        <th class="th" width="5%">Job</th>
                        <th class="th" width="5%">Percentage</th>         
                        <th class="th" width="5%">Job</th>
                        <th class="th" width="5%">Percentage</th>      
                        <th class="th" width="5%">Job</th>
                        <th class="th" width="5%">Percentage</th>     
                    </tr >
                       <tr onmouseover="this.style.backgroundColor='violet';" onmouseout="this.style.backgroundColor='white';" >                    
							<td style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;"  align="center"><nobr>Biserv Solution</td>      
                              <td  style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;" align="center"><?=getRowReportType("$dte","2","8","","BSS","WSLA");?></td>
                              <td  style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;" align="center"><?=getRowReportType("$dte","2","8","","BSS","FSLA");?></td>
                              <td  style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;" align="center"><?=getRowReportType("$dte","2","8","close","BSS","");?></td>   
                              <td  style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;" align="center"><?=getRowReportType("$dte","2","8","cancel","BSS","");?></td> 
                              <td  style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;" align="center"><?=getRowReportType("$dte","2","8","feedback","BSS","");?></td>  
							  <td  style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;" align="center"><?=getRowReportType("$dte","2","8","","BSS","");?></td>  
                          </tr>     
						  <!--tr onmouseover="this.style.backgroundColor='violet';" onmouseout="this.style.backgroundColor='white';" >                    
							<td style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;"  align="center"><nobr>Biserv Solution Team B (Thanasak)</td>      
                              <td  style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;" align="center"><?=getRowReportType("$dte","2","8","","SDC","WSLA");?></td>
                              <td  style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;" align="center"><?=getRowReportType("$dte","2","8","","SDC","FSLA");?></td>
                              <td  style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;" align="center"><?=getRowReportType("$dte","2","8","close","SDC","");?></td>
                              <td  style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;" align="center"><?=getRowReportType("$dte","2","8","cancel","SDC","");?></td>  
                              <td  style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;" align="center"><?=getRowReportType("$dte","2","8","feedback","SDC","");?></td>  
							  <td  style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;" align="center"><?=getRowReportType("$dte","2","8","","SDC","");?></td>  
                          </tr--->  
						  <tr onmouseover="this.style.backgroundColor='violet';" onmouseout="this.style.backgroundColor='white';" >                    
							<td style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;"  align="center">Total</td>      
                              <td  style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;" align="center"><?=getRowReportType("$dte","2","8","","","WSLA");?></td>
                              <td  style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;" align="center"><?=getRowReportType("$dte","2","8","","","FSLA");?></td>
                              <td  style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;" align="center"><?=getRowReportType("$dte","2","8","close","","");?></td>
                              <td  style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;" align="center"><?=getRowReportType("$dte","2","8","cancel","","");?></td>  
                              <td  style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;" align="center"><?=getRowReportType("$dte","2","8","feedback","","");?></td>  
							  <td  style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;" align="center"><?=getRowReportType("$dte","2","8","","","");?></td>  
                          </tr>
                </table>  
<br>

				<table width="100%" align="center" class="mytable" id="table7"  cellpadding="1" cellspacing="1">
				<tr>             
                        <th class="th" colspan = "13" >CM NGV  (เหมาจ่าย)</th>
                    </tr >
                    <tr>             
                        <th class="th" width="10%" rowspan="2"  align="center" >Site Name</th>
						<th class="th" width="10%" colspan="2">WSLA</th>
                        <th class="th" width="10%" colspan="2">FSLA</th>
                        <th class="th" width="10%" colspan="2">Close</th> 
                        <th class="th" width="10%" colspan="2">Cancel</th>    
                        <th class="th" width="10%" colspan="2">Inprogress</th>      
                        <th class="th" width="10%" colspan="2">Total</th>
                    </tr >
					<tr>             
						<th class="th" width="5%">Job</th>
                        <th class="th" width="5%">Percentage</th>
                        <th class="th" width="5%">Job</th> 
                        <th class="th" width="5%">Percentage</th>         
                        <th class="th" width="5%">Job</th>
                        <th class="th" width="5%">Percentage</th>         
                        <th class="th" width="5%">Job</th>
                        <th class="th" width="5%">Percentage</th>         
                        <th class="th" width="5%">Job</th>
                        <th class="th" width="5%">Percentage</th>        
                        <th class="th" width="5%">Job</th>
                        <th class="th" width="5%">Percentage</th>     
                    </tr >
                       <tr onmouseover="this.style.backgroundColor='violet';" onmouseout="this.style.backgroundColor='white';" >                    
							<td style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;"  align="center"><nobr>Biserv Solution</td>      
                              <td  style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;" align="center"><?=getRowReportType("$dte","2","9","","BSS","WSLA");?></td>
                              <td  style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;" align="center"><?=getRowReportType("$dte","2","9","","BSS","FSLA");?></td>
                              <td  style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;" align="center"><?=getRowReportType("$dte","2","9","close","BSS","");?></td>   
                              <td  style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;" align="center"><?=getRowReportType("$dte","2","9","cancel","BSS","");?></td>  
                              <td  style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;" align="center"><?=getRowReportType("$dte","2","9","feedback","BSS","");?></td>  
							  <td  style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;" align="center"><?=getRowReportType("$dte","2","9","","BSS","");?></td>  
                          </tr>     
						  <!----tr onmouseover="this.style.backgroundColor='violet';" onmouseout="this.style.backgroundColor='white';" >                    
							<td style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;"  align="center"><nobr>Biserv Solution Team B (Thanasak)</td>      
                              <td  style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;" align="center"><?=getRowReportType("$dte","2","9","","SDC","WSLA");?></td>
                              <td  style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;" align="center"><?=getRowReportType("$dte","2","9","","SDC","FSLA");?></td>
                              <td  style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;" align="center"><?=getRowReportType("$dte","2","9","close","SDC","");?></td>    
                              <td  style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;" align="center"><?=getRowReportType("$dte","2","9","cancel","SDC","");?></td>  
                              <td  style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;" align="center"><?=getRowReportType("$dte","2","9","feedback","SDC","");?></td>  
							  <td  style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;" align="center"><?=getRowReportType("$dte","2","9","","SDC","");?></td>  
                          </tr----->  
						  <tr onmouseover="this.style.backgroundColor='violet';" onmouseout="this.style.backgroundColor='white';" >                    
							<td style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;"  align="center">Total</td>      
                              <td  style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;" align="center"><?=getRowReportType("$dte","2","9","","","WSLA");?></td>
                              <td  style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;" align="center"><?=getRowReportType("$dte","2","9","","","FSLA");?></td>
                              <td  style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;" align="center"><?=getRowReportType("$dte","2","9","close","","");?></td>    
                              <td  style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;" align="center"><?=getRowReportType("$dte","2","9","cancel","","");?></td>  
                              <td  style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;" align="center"><?=getRowReportType("$dte","2","9","feedback","","");?></td>  
							  <td  style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;" align="center"><?=getRowReportType("$dte","2","9","","","");?></td>  
                          </tr>
                </table>
				
				<br>

				<table width="100%" align="center" class="mytable" id="table7"  cellpadding="1" cellspacing="1">
				<tr>             
                        <th class="th" colspan = "13" >CM Oil  (Per Call)</th>
                    </tr >
                    <tr>             
                        <th class="th" width="10%" rowspan="2"  align="center" >Site Name</th>
						<th class="th" width="10%" colspan="2">WSLA</th>
                        <th class="th" width="10%" colspan="2">FSLA</th>
                        <th class="th" width="10%" colspan="2">Close</th>    
                        <th class="th" width="10%" colspan="2">Cancel</th>
                        <th class="th" width="10%" colspan="2">Inprogress</th>         
                        <th class="th" width="10%" colspan="2">Total</th>
                    </tr >
					<tr>             
						<th class="th" width="5%">Job</th>
                        <th class="th" width="5%">Percentage</th>
                        <th class="th" width="5%">Job</th> 
                        <th class="th" width="5%">Percentage</th>         
                        <th class="th" width="5%">Job</th>
                        <th class="th" width="5%">Percentage</th>         
                        <th class="th" width="5%">Job</th>
                        <th class="th" width="5%">Percentage</th>         
                        <th class="th" width="5%">Job</th>
                        <th class="th" width="5%">Percentage</th>        
                        <th class="th" width="5%">Job</th>
                        <th class="th" width="5%">Percentage</th>     
                    </tr >
                       <tr onmouseover="this.style.backgroundColor='violet';" onmouseout="this.style.backgroundColor='white';" >                    
							<td style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;"  align="center"><nobr>Biserv Solution</td>      
                              <td  style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;" align="center"><?=getRowReportType("$dte","3","1","","BSS","WSLA");?></td>
                              <td  style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;" align="center"><?=getRowReportType("$dte","3","1","","BSS","FSLA");?></td>
                              <td  style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;" align="center"><?=getRowReportType("$dte","3","1","close","BSS","");?></td>   
                              <td  style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;" align="center"><?=getRowReportType("$dte","3","1","cancel","BSS","");?></td>  
                              <td  style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;" align="center"><?=getRowReportType("$dte","3","1","feedback","BSS","");?></td>  
								  <td  style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;" align="center"><?=getRowReportType("$dte","3","1","","BSS","");?></td>  
                          </tr>     
						  <tr onmouseover="this.style.backgroundColor='violet';" onmouseout="this.style.backgroundColor='white';" >                    
							<!---td style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;"  align="center"><nobr>Biserv Solution Team B (Thanasak)</td>      
                              <td  style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;" align="center"><?=getRowReportType("$dte","3","1","","SDC","WSLA");?></td>
                              <td  style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;" align="center"><?=getRowReportType("$dte","3","1","","SDC","FSLA");?></td>
                              <td  style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;" align="center"><?=getRowReportType("$dte","3","1","close","SDC","");?></td>  
                              <td  style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;" align="center"><?=getRowReportType("$dte","3","1","cancel","SDC","");?></td> 
                              <td  style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;" align="center"><?=getRowReportType("$dte","3","1","feedback","SDC","");?></td>  
								  <td  style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;" align="center"><?=getRowReportType("$dte","3","1","","SDC","");?></td>  
                          </tr------>  
						  <tr onmouseover="this.style.backgroundColor='violet';" onmouseout="this.style.backgroundColor='white';" >                    
							<td style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;"  align="center">Total</td>      
                              <td  style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;" align="center"><?=getRowReportType("$dte","3","1","","","WSLA");?></td>
                              <td  style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;" align="center"><?=getRowReportType("$dte","3","1","","","FSLA");?></td>
                              <td  style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;" align="center"><?=getRowReportType("$dte","3","1","close","","");?></td>   
                              <td  style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;" align="center"><?=getRowReportType("$dte","3","1","cancel","","");?></td>  
                              <td  style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;" align="center"><?=getRowReportType("$dte","3","1","feedback","","");?></td>  
								  <td  style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;" align="center"><?=getRowReportType("$dte","3","1","","","");?></td>  
                          </tr>
                </table>

<br>
			<table width="50%" align="left" class="mytableX" id="table7"  cellpadding="1" cellspacing="1">
				<tr>             
                        <th class="th" colspan = "11" >TOP 10 SITE (Hardware & Software)</th>
                    </tr >
                    <tr>             
                        <th class="th" width="5%" align="center" >No.</th>
						<th class="th" width="5%">Site ID</th>
                        <th class="th" width="25%">Site Name</th>
                        <th class="th" width="5%">Amount</th>
                        <th class="th" width="10%">Province</th> 
                    </tr >
					<?
					$sql1 = "SELECT
																			tbl_log_call_center.site_id,
																			Count(tbl_log_call_center.site_id) AS max_count,
																			tbl_station_ngv.site_name,
																			tbl_station_ngv.site_province
																			FROM
																			tbl_log_call_center
																			Inner Join tbl_station_ngv ON tbl_log_call_center.site_id = tbl_station_ngv.site_id
																			where open_call_dte like '$dte%' and category_type = '9' and status_call = 'close'
																			GROUP BY site_id
																			ORDER BY max_count DESC
																			limit 0,10"; //echo $sql1;
					$sql_all = mysqli_query($conn,$sql1);
																			$i=0;
                     while($c_all = mysqli_fetch_array($sql_all)){
						 $i++;
						 ?>
						 <tr  onclick="javascript:showTopTenSite('<?=$dte?>','<?=$c_all['site_id']?>');"  onmouseover="this.style.backgroundColor='violet';" onmouseout="this.style.backgroundColor='white';" >       
							<td style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;"  align="center">&nbsp;<?=$i?></td>      
                            <td  style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;" align="center">&nbsp;<?=$c_all["site_id"];?></td>			
							<td style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;"  align="left">&nbsp;<?=$c_all["site_name"]?></td>      
                            <td  style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;" align="center">&nbsp;<?=$c_all["max_count"];?></td>
                            <td  style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;" align="center">&nbsp;<?=$c_all["site_province"];?></td>			
							</tr>
	<?
				}
					?>
                </table>


<table width="50%" align="left" class="mytableX" id="table7"  cellpadding="1" cellspacing="1">
				<tr>             
                        <th class="th" colspan = "11" >TOP 10 Hardware</th>
                    </tr >
                    <tr>             
                        <th class="th" width="10%" align="center" >No.</th>
						<th class="th" width="30%">Hardware Name</th>    
                        <th class="th" width="10%">Amount</th>    
                    </tr >
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
								limit 0,10"; // echo $sql;
					$sql_all = mysqli_query($conn,$sql);
                    $i=0;
                     while($c_all = mysqli_fetch_array($sql_all)){
						 $i++;
						 ?>
						 <tr  onclick="javascript:showTopTenHardware('<?=$dte?>','<?=$c_all['cate_id']?>');"  onmouseover="this.style.backgroundColor='violet';" onmouseout="this.style.backgroundColor='white';" >       
	<td style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;" align="center">&nbsp;<?=$i?></td>      
        <td style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;" align="left">&nbsp;<?=$c_all["cate_name"];?></td>			
	<td  style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;" align="center">&nbsp;<?=$c_all["max_count"]?></td>     			
							</tr>
	<? } ?>
                </table>
				</form></td></tr>		
				</table> 

<script type="text/javascript">
 //onclick="click2editx(<?=$row["category_id"]?>,'edit');"
 function Search_Click(typer,schby,schtxt){             
     parent.mainPage.location.href ="jobtype.index.php?typer="+typer+"&schBy="+schby+"&schTxt="+schtxt;
      }       
 function click2edit(id,typer){                        
         parent.mainPage.location.href ="jobtype.form.php?id="+id+"&typer="+typer;       
      }  
 
    function showTopTenSite(dte,id){     
        myleft=(screen.width)?(screen.width-800)/2:100;    
        mytop=(screen.height)?(screen.height-600)/2:100;      
        properties = " width=940,height=480";                
        properties +="directories=no,titlebar=no,toolbar=no,location=no,status=no,menubar=no,scrollbars=yes, top="+mytop+",left="+myleft;      
         window.open("view.sla.percentage.php?dte="+dte+"&id="+id,"Search",properties);         
    }
    function showTopTenHardware(dte,id){     
        myleft=(screen.width)?(screen.width-800)/2:100;    
        mytop=(screen.height)?(screen.height-600)/2:100;      
        properties = " width=940,height=480";                
        properties +="directories=no,titlebar=no,toolbar=no,location=no,status=no,menubar=no,scrollbars=yes, top="+mytop+",left="+myleft;      
         window.open("view.percentage.hardware.php?dte="+dte+"&id="+id,"Search",properties);         
    }
</script>












