<? 
session_start();                 
header("Content-Type: text/html; charset=tis-620");

require_once("function.php");           
require_once("script/function.js");  
  
  if(!checkUser()){    echo Message(35,"red",$titel1,$msg1,"<a href='index.php?link=getserialno.job.date.site'> $login </a>");         
  exit;
  }    
     include("header.php");              
?>
 <html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874"> 
<link rel="stylesheet" href="style.css">
<script language="javascript" src="script.js"></script>    

   <link href="style/mytable.css" rel="stylesheet" type="text/css" />
<title>Site Name</title></head>
  <style type="text/css">
    <!--
   .th{ background-color:#003366; color:#FFF; padding:0px; border:0px solid #ccc; height:20px; }  
    -->
</style> 
<body  >
<br>
<center>
        <b>ประเภท : </b>
		<select>
			<? $sql_cate = mysql_query("")?>
		</select>
        <table align="center" bordercolor="#000000" class="mytable"  border="1" width="60%"> 
                <tr>
				     <th class="th" ><nobr>#</th>                                 
                      <th class="th" ><nobr>&nbsp;Site ID.</th>                                 
                      <th class="th" ><nobr>&nbsp;Site Name<nobr></th>      
                      <th class="th" >CPU</th>         
                      <th class="th" >Job No.</th>         
                      <th class="th" >Date</th>   
                      <th class="th"  align="center">Engineer.</th>       
             </tr>
          <?                                
        $sql = "SELECT tbl_site.site_id,tbl_site.site_name,tbl_hardware_onhand_user.id,tbl_hardware_onhand_user.hardware_no
			FROM
			tbl_site
			Inner Join tbl_hardware_onhand_user ON tbl_site.site_id = tbl_hardware_onhand_user.user_id
			where (site_id like 'S0%' or site_id like 'S1%' or site_id like 'S2%' or site_id like 'S3%' or site_id like 'S4%' or site_id like 'S5%' or site_id like 'S6%' or site_id like 'S7%' or site_id like 'S8%' or site_id like 'S9%')
			And tbl_hardware_onhand_user.cate_id = '1'"; 
        $res = mysqli_query($conn,$sql);       
		$rows = 1;            
           while( $row = mysqli_fetch_array($res)){
		    echo"<tr><td align='center'  style='padding:0px; border-bottom:1px solid #ccc; border-right:0px solid #ccc;'>$rows</td> ";   
            echo"<td align='center'  style='padding:0px; border-bottom:1px solid #ccc; border-right:0px solid #ccc;'>$row[site_id]</td> ";              
            echo"<td  style='padding:0px; border-bottom:1px solid #ccc; border-right:0px solid #ccc;'>&nbsp;<nobr>$row[site_name]</td> ";                                                              
            echo getSerial($row["site_id"],$row["id"],$row["hardware_no"])."</tr> ";        
            $rows++;        
             }
			 ?>
        </table>
        
</center>
</body>
</html>
<?
 function getSerial($site_id,$serial_no1,$serialno){
	 global $conn;
	 
      $sql = "SELECT tbl_insident_hw.job_no,tbl_log_call_center.open_call_dte,tbl_user.name,tbl_user.sname
					FROM tbl_insident_hw
					Inner Join tbl_log_call_center ON tbl_insident_hw.job_no = tbl_log_call_center.job_no
					Inner Join tbl_user ON tbl_log_call_center.reciept_job_user_id = tbl_user.user_id
					WHERE  tbl_insident_hw.serial_no like '$serial_no1' or	tbl_insident_hw.serial_no like  '%$serialno%'"; 
      $rs = mysqli_query($conn,$sql);     	  
      $c = mysqli_fetch_array($rs);
	  if($c["job_no"]!=""){
	             $job1 = explode("-",$c["job_no"]);
				 $str = "CM";
	  			if($job1[0]=="BSS"){
						$str = "CM 3G ";
				}
				  echo"<td align='center'>&nbsp;<nobr>$serialno</td> ";  
				  echo"<td>&nbsp;<nobr>$c[job_no] ($str)</td> ";  
				  echo"<td align='center'>&nbsp;<nobr>$c[open_call_dte]</td> ";  
				  echo"<td>&nbsp;<nobr>$c[name]</td> "; 
		  } else {
		  $sqll = "SELECT tbl_log_call_center.open_call_dte,tbl_log_call_center.job_no,tbl_user.name,tbl_user.sname
					FROM  tbl_log_call_center
					Inner Join tbl_category_type ON tbl_log_call_center.category_type = tbl_category_type.category_id
					Inner Join tbl_user ON tbl_log_call_center.reciept_job_user_id = tbl_user.user_id
					where tbl_category_type.category_id = '12' and tbl_log_call_center.site_id = '$site_id'";
		      $rc = mysqli_query($conn,$sqll);
		           $r = mysqli_fetch_array($rc);
	   			  echo"<td align='center'>&nbsp;<nobr>$serialno</td> ";  
				  echo"<td>&nbsp;<nobr>$r[job_no] (PM) </td> ";  
				  echo"<td align='center'>&nbsp;<nobr>$r[open_call_dte]</td> ";  
				  echo"<td>&nbsp;<nobr>$r[name]</td> "; 
		  } 
 }
?>
