<?
header("Content-Type: text/html; charset=tis-620");                 
session_start();
require_once("function.php");
                                             
  
  if(!checkUser()){    echo Message(35,"red",$titel1,$msg1,"<a href='index.php?link=dashboard'> $login </a>");
  exit;
  }         

 include("header.php");  
$month=$_REQUEST["month"];
$year=$_REQUEST["year"];

if ( $month == "" || $year=="" ) {
	 		$today = getdate();	
			$month = date("m");  //$today["mon"];
			$year = $today["year"];
			//$dte = $year."-".$month;
	  } 
			//$dte = $year."-".$month; 
?>

  
<title>Bizserv Solution Co.,Ltd</title>   
<link href="style/calendar.css" rel="stylesheet" type="text/css">    
<link href="style/mytable.css" rel="stylesheet" type="text/css" />   
<script type="text/javascript" src="script/calendar_date_picker.js"></script>     
<link href="style/stylecss.css" rel="stylesheet" type="text/css">
<link href="style/filtergrid.css" rel="stylesheet" type="text/css">
<style type="text/css">

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

</style> 

  <table align="center"  cellpadding="0" cellspacing="0" class="mytable">
  <tr>  <form  method="get" name="form1" id="form1" action="#">      
  <td clospan="7" valign="middel">
      
        <b>Month :</b> 
        <select name="month">
            <option value = "01" <?if($month=="01") echo "selected";?> >January</option>            
            <option value = "02" <?if($month=="02") echo "selected";?> >February</option>          
            <option value = "03" <?if($month=="03") echo "selected";?> >March</option>          
            <option value = "04" <?if($month=="04") echo "selected";?> >April</option>          
            <option value = "05" <?if($month=="05") echo "selected";?> >May</option>          
            <option value = "06" <?if($month=="06") echo "selected";?> >June</option>          
            <option value = "07" <?if($month=="07") echo "selected";?> >July</option>          
            <option value = "08" <?if($month=="08") echo "selected";?> >August</option>          
            <option value = "09" <?if($month=="09") echo "selected";?> >September</option>          
            <option value = "10" <?if($month=="10") echo "selected";?> >October</option>          
            <option value = "11" <?if($month=="11") echo "selected";?> >November</option>       
            <option value = "12" <?if($month=="12") echo "selected";?> >December</option>             
        </select>

        <b>Year :</b> 
        <select name="year">
        <option value="2012" <?if($year=="2012") echo "selected";?>>2012</option>
        <option value="2013" <?if($year=="2013") echo "selected";?>>2013</option>
        <option value="2014" <?if($year=="2014") echo "selected";?>>2014</option>
        <option value="2015" <?if($year=="2015") echo "selected";?>>2015</option>
        <option value="2016" <?if($year=="2016") echo "selected";?>>2016</option>
        <option value="2017" <?if($year=="2017") echo "selected";?>>2017</option>
        </select>
        <input class="form-control"  type="submit" value="Submit">

  </td>
          </form>
  </tr>
                    <tr>             
                        <th class="th" width="20%" rowspan="2">Summary JOB</th>
                        <th class="th" width="40%" colspan="3">PERCALL</th>
                        <th class="th" width="40%" colspan="3"><?echo iconv('UTF-8','TIS-620',"เหมาจ่าย");?></th> 
      
                    </tr >
                    <tr>             
                        <th class="th" width="10%">WSLA</th>
                        <th class="th" width="10%">FSLA</th> 
                        <th class="th" width="10%">TOTAL</th>
                        <th class="th" width="10%">WSLA</th>
                        <th class="th" width="10%">FSLA</th>
                        <th class="th" width="10%">TOTAL</th>
 
                    </tr >
                  <?
			$sql_cm_total = "SELECT 'PTTOIL' as job_type, 
            sum(IF(a.category_type='1' and a.status_sla='WSLA',1,0)) PERCALL_WSLA, 
            sum(IF(a.category_type='1' and a.status_sla='FSLA',1,0)) PERCALL_FSLA, 
            sum(IF(a.category_type='1',1,0)) PERCALL_TOTAL , 
            sum(IF(a.category_type='2' and a.status_sla='WSLA',1,0)) PACKAGES_WSLA, 
            sum(IF(a.category_type='2' and a.status_sla='FSLA',1,0)) PACKAGES_FSLA, 
            sum(IF(a.category_type='2' and a.status_sla in ('FSLA','WSLA'),1,0)) PACKAGES_TOTAL 
            from tbl_log_call_center a
            where month(a.open_call_dte)='05' 
            and year(a.open_call_dte)='2017' 
            and a.status_call = 'close' 
            union all select 'RICOHOIL' as job_type, 
            sum(IF(a.category_type='132' and a.status_sla='WSLA',1,0)) PERCALL_WSLA, 
            sum(IF(a.category_type='132' and a.status_sla='FSLA',1,0)) PERCALL_FSLA, 
            sum(IF(a.category_type='132',1,0)) PERCALL_TOTAL , 
            sum(IF(a.category_type='133' and a.status_sla='WSLA',1,0)) PACKAGES_WSLA, 
            sum(IF(a.category_type='133' and a.status_sla='FSLA',1,0)) PACKAGES_FSLA, 
            sum(IF(a.category_type='133' and a.status_sla in ('FSLA','WSLA'),1,0)) PACKAGES_TOTAL 
            from tbl_log_call_center a where month(a.open_call_dte)='05' 
            and year(a.open_call_dte)='2017' and a.status_call = 'close' 
            union all select 'PTTNGV' as job_type, sum(IF(a.category_type='8' and a.status_sla='WSLA',1,0)) PERCALL_WSLA, 
            sum(IF(a.category_type='8' and a.status_sla='FSLA',1,0)) PERCALL_FSLA, 
            sum(IF(a.category_type='8',1,0)) PERCALL_TOTAL , 
            sum(IF(a.category_type='9' and a.status_sla='WSLA',1,0)) PACKAGES_WSLA, 
            sum(IF(a.category_type='9' and a.status_sla='FSLA',1,0)) PACKAGES_FSLA, 
            sum(IF(a.category_type='9' and a.status_sla in ('FSLA','WSLA'),1,0)) PACKAGES_TOTAL 
            from tbl_log_call_center a where month(a.open_call_dte)='05' 
            and year(a.open_call_dte)='2017' and a.status_call = 'close' 
            union all select 'PTTAMAZON' as job_type, 
            sum(IF(a.problem_job='13' and a.status_sla='WSLA',1,0)) PERCALL_WSLA, 
            sum(IF(a.problem_job='13' and a.status_sla='FSLA',1,0)) PERCALL_FSLA, 
            sum(IF(a.problem_job='13',1,0)) PERCALL_TOTAL , 
            sum(IF(a.problem_job='44' and a.status_sla='WSLA',1,0)) PACKAGES_WSLA, 
            sum(IF(a.problem_job='44' and a.status_sla='FSLA',1,0)) PACKAGES_FSLA, 
            sum(IF(a.problem_job='44' and a.status_sla in ('FSLA','WSLA'),1,0)) PACKAGES_TOTAL 
            from itbl_logcall_retail a where month(a.call_openjob_datetime)='05' 
            and year(a.call_openjob_datetime)='2017' and a.status_call = 'close'
                                        ";
                                   //     echo $sql_cm_total;
			$rc_cm_total =mysqli_query($conn,$sql_cm_total);
			while($c_cm_total = mysqli_fetch_array($rc_cm_total)){
		 ?>
				  <tr onmouseover="this.style.backgroundColor='violet';" onmouseout="this.style.backgroundColor='white';" >
				       <td style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;"  align="left"><?=$c_cm_total["job_type"];?></td>
					   <td style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;"  align="center"><?=$c_cm_total["PERCALL_WSLA"];?></td>
					   <td style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;"  align="center">&nbsp;&nbsp;<?=$c_cm_total["PERCALL_FSLA"];?></td>
				       <td style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;"  align="center">&nbsp;&nbsp;<?=$c_cm_total["PERCALL_TOTAL"];?></td>
                       <td style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;"  align="center"><?=$c_cm_total["PACKAGES_WSLA"];?></td>
					   <td style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;"  align="center">&nbsp;&nbsp;<?=$c_cm_total["PACKAGES_FSLA"];?></td>
				       <td style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;"  align="center">&nbsp;&nbsp;<?=$c_cm_total["PACKAGES_TOTAL"];?></td>
				  </tr>

            <? } ?>     
                </table>  </form></td></tr></table>  