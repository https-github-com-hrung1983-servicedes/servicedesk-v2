<?

//echo "adfadfdf";   exit;
header("Content-Type: text/html; charset=tis-620");           
session_start();
require_once("function.php");          
  
if(!checkUser()){    echo Message(35,"red",$titel1,$msg1,"<a href='index.php?link=count.3g.job.list'> $login </a>");
  exit;
}                                                                                                      
       
include("header.php");  
      $typer =  $_REQUEST["typer"]; //echo $typer;
      $months =  $_REQUEST["months"];
      $years =  $_REQUEST["year"];
	  $today = getdate();
	  if($months==""){
	        $months = formatNum($today["mon"],1);// echo $months;
	  }
	if($years==""){
	   $years = $today["year"];
	  }
	  if($typer==""){
	   $typer = "2";
	}       
?>  
<link href="image/bss_icon.ico"   rel="shortcut icon" />  
<link href="style/calendar.css" rel="stylesheet" type="text/css">    
<link href="style/mytable.css" rel="stylesheet" type="text/css" />   
<script type="text/javascript" src="script/calendar_date_picker.js"></script>     
<link href="style/stylecss.css" rel="stylesheet" type="text/css">
<link href="style/filtergrid.css" rel="stylesheet" type="text/css">
<link href="css/loading.css" rel="stylesheet" type="text/css" media="all">

<script src="script/jquery.min.js"></script>
<script src="script/thickbox.js"></script>
<script src="script/loading.js"></script>

<script type="text/javascript" src="script/jquery-1.6.4.js"></script>
<script type="text/javascript" src="script/jquery_1.7.1_min.js"></script>
<meta http-equiv="refresh" content="30000;"/>
<style type="text/css">
    <!--
    .mytable1 { width:100%; font-size:14px;
                border:1px solid #ccc;   
    }
    .mytable11 {width:100%; font-size:12px;
                border:1px solid #ccc;
                font-size:11px;     
    }
     .th{ background-color:#003366; color:#FFF; padding:0px; border:0px solid #ccc; height:20px; }
     .td{ border-color:#003366;};
    -->
</style>
<table width="100%" align="center" class="mytable1" id="table" height="100%"   cellpadding="1" cellspacing="1" >
    <tr>
        <td valign="top"> 
            <form  method="post"   name="form1" id="form1"  action="#"> 
             

                  <table width="100%" border="0" cellpadding="0" cellspacing="0" class="mytable1">
                    <tr>
                        <td valign="middle" align="center"> <nobr>
						 <span class="fonttitle_board">&nbsp; Type :</span> 
						<select id="typer" name="typer" onchange="Search_Click(typer.value,months.value,years.value)">
							<option value="2" <? if($typer=="2") echo "selected";?>>NGV</option>
							<option value="3" <? if($typer=="3") echo "selected";?>>Oil</option>
							<option value="4" <? if($typer=="4") echo "selected";?>>Amazon</option>
						</select>		
                             <span class="fonttitle_board">&nbsp;Month :</span> 
                            <select name="months" id="months" onchange="Search_Click(typer.value,months.value,years.value)">                 
                                <option value = "01" <? if($months=="01") echo "selected";?> >January</option>            
                                <option value = "02" <? if($months=="02") echo "selected";?> >February</option>          
                                <option value = "03" <? if($months=="03") echo "selected";?> >March</option>          
                                <option value = "04" <? if($months=="04") echo "selected";?> >April</option>          
                                <option value = "05" <? if($months=="05") echo "selected";?> >May</option>          
                                <option value = "06" <? if($months=="06") echo "selected";?> >June</option>          
                                <option value = "07" <? if($months=="07") echo "selected";?> >July</option>          
                                <option value = "08" <? if($months=="08") echo "selected";?> >August</option>          
                                <option value = "09" <? if($months=="09") echo "selected";?> >September</option>          
                                <option value = "10" <? if($months=="10") echo "selected";?> >October</option>          
                                <option value = "11" <? if($months=="11") echo "selected";?> >November</option>       
                                <option value = "12" <? if($months=="12") echo "selected";?> >December</option>               
                            </select> &nbsp;

							<span class="fonttitle_board">&nbsp;Year :</span>
									<select name="years" id="years">           
                                <option value = "2013" <? if($years==2013) echo "selected";?> >2013</option>          
                                <option value = "2014" <? if($years==2014) echo "selected";?> >2014</option>          
                                <option value = "2015" <? if($years==2015) echo "selected";?> >2015</option>                      
                            </select> 
                            &nbsp;<input  type="button" name="sch" value="แสดง"  onclick="Search_Click(typer.value,months.value,years.value)"style="width:50pt;">
                            
                        <td width="18" valign="middle"><a lang="count.3g.job.form.php?type=add" class="thickbox pointer">
                        <img src="image/add.JPG" alt="Add" width="20" height="20" border="0" align="right"> </a></td>
                        <td width="27" valign="middle"><b><nobr> เพิ่ม </b>&nbsp;</td>
						
                        <td width="27" valign="middle"><b><nobr> ส่งออกเป็น Excel </b>&nbsp</td>
                    </tr>
                </table>     
                <table width="100%" align="center" class="mytable1" id="table7"  cellpadding="1" cellspacing="1">
                    <tr>			 
                               <th class="th" width="5%">#</th>
							   <th class="th" width="15%">วันที่</th>    
							   <th class="th" width="10%">แก้ไขไม่ได้</th>  
							   <th class="th" width="10%">แก้ไขได้</th>  
							   <th class="th" width="20%">จำนวนทั้งหมด</th>   
							   <th class="th" width="10%">แก้ไขไม่ได้ %</th>   
							   <th class="th" width="10%">แก้ไขได้ %</th> 
							   <th class="th" width="20%">จำนวนทั้งหมด %</th>   
				   </tr>
			<?	
		$sql = "select distinct cnt_date from tbl_count_job_3g where cnt_date like '$years-$months%' order by cnt_date ";		//	 echo $sql;  
			$rs = mysqli_query($conn,$sql);
			$i_dte = 0;
			$row = 1;
			while($c = @mysqli_fetch_array($rs)){		
			$str = "";			
			 if($c["status_up"]=="el"){
					$str = "Tel.";
			}
			$downs = countstatus($c["cnt_date"],$typer,'');
			$up = countstatus($c["cnt_date"],$typer,'el');
			$sum_down_up = $downs+$up;
			
			$percent_down = round(($downs*100)/$sum_down_up,2);
			$percent_up = round(($up*100)/$sum_down_up,2);
              ?>  </tr> 
                          <td style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc; border-color:#003366;" align="center"><b><?=$row?></b></font></td>  
                          <td style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc; border-color:#003366;" align="center"><b><?=$c["cnt_date"] ?></b></font></td>  
                          <td style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc; border-color:#003366;" align="center"><b><?=$downs?></b></font></td>   
                          <td style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc; border-color:#003366;" align="center"><b><?=$up?></b></font></td>  
                          <td style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc; border-color:#003366;" align="center"><b><?=$sum_down_up?></b></font></td> 
                          <td style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc; border-color:#003366;" align="center"><b><?=$percent_down?></b></font></td>  
                          <td style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc; border-color:#003366;" align="center"><b><?=$percent_up?></b></font></td>  
                          <td style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc; border-color:#003366;" align="center"><b>100 </b></font></td>  
						  </tr> 
						  <? 
						  $row++; 
						       $downs_all += $downs; 
						       $up_all += $up; 
						       $sum_down_up_all += $sum_down_up; 
							   
							$percent_down_all   =  round(($downs_all*100)/$sum_down_up_all,2);
						    $percent_up_all   = round(($up_all*100)/$sum_down_up_all,2);
							   
						  }?>
						  </tr> 
							  <td style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc; border-color:#003366;" align="center"><b></b></font></td>  
							  <td style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc; border-color:#003366;" align="center"><b></b></font></td>  
							  <td style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc; border-color:#003366;" align="center"><b><?=$downs_all?></b></font></td>   
							  <td style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc; border-color:#003366;" align="center"><b><?=$up_all?></b></font></td> 
							  <td style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc; border-color:#003366;" align="center"><b><?=$sum_down_up_all?></b></font></td>  
							  <td style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc; border-color:#003366;" align="center"><b><?=$percent_down_all?></b></font></td>  
							  <td style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc; border-color:#003366;" align="center"><b><?=$percent_up_all?></b></font></td>  
							  <td style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc; border-color:#003366;" align="center"><b>100</b></font></td>  
						  </tr> 
                </table>  </form></td></tr></table>

                    </tr >
 </table>
<?
   function countstatus($dte,$site_type,$site_status) {
	   global $conn;
	$sql = "SELECT  Count(*) AS cnt  from tbl_count_job_3g  where cnt_date like '$dte%'  and tbl_count_job_3g.status_up = '$site_status' and tbl_count_job_3g.site_type = '$site_type'";
    $rs = mysqli_query($conn,$sql);
	$str = "0";
		while($c=mysqli_fetch_array($rs)){
				$str = $c["cnt"];
		}
		return $str;
	}
	
	function countPercentAll($dte,$site_type) {
		global $conn;
	$sql = "SELECT  Count(*) AS cnt  from tbl_count_job_3g  where cnt_date like '$dte%'  and tbl_count_job_3g.site_type = '$site_type'";
    $rs = mysqli_query($conn,$sql);
	$str = "0";
		while($c=mysqli_fetch_array($rs)){
				$str = $c["cnt"];
		}
		return $sql;
	}
?>
<script type="text/javascript"> 
    var props = {    formatDate :        '%m-%d-%y'    };
    props.formatDate = '%y-%m-%d';
    var cdp1 = new CalendarDatePicker(props);                   
     
    function Search_Click(typer,months,years){       
          document.location.href  ="count.3g.job.list.php?typer="+typer+"&months="+months+"&year="+years;
      }     
      
</script>

