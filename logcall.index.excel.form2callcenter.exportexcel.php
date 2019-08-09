<?
header("Content-Type: text/html; charset=tis-620");                 
session_start();
require_once("function.php");          
/*  
  if(!checkUser()){    echo Message(35,"red",$titel1,$msg1,"<a href='index.php?link=logcall.index.excel.form2callcenter'> $login </a>");
  exit;
  }  
 */ 
  
$name = "Content-Disposition: attachment; filename='service-report".$months."-".$years.".csv';";
header($name);

$sql = "SELECT
tbl_log_call_center.site_id,
tbl_site.site_name,
tbl_site.site_old_name,
tbl_site.pos,
tbl_site.province_name,
tbl_site.from_owner,
tbl_log_call_center.job_no,
tbl_log_call_center.open_call_dte,
tbl_log_call_center.open_call_tme,
tbl_log_call_center.onsite_datetime,
tbl_log_call_center.fixed_time,
tbl_log_call_center.problem,
tbl_log_call_center.problem_solving,
tbl_log_call_center.type_service,
tbl_log_call_center.reciept_job_user_id,
a.name,
a.sname,
tbl_log_call_center.doc,
tbl_province.province_name,
tbl_province.provice_phase,
tbl_log_call_center.status_call,
b.name as callname,
b.sname as callsname
FROM
tbl_log_call_center
Left Join tbl_site ON tbl_log_call_center.site_id = tbl_site.site_id
Left Join tbl_user AS a ON tbl_log_call_center.reciept_job_user_id = a.user_id
Left Join tbl_province ON tbl_site.province_name = tbl_province.id
Left Join tbl_user b ON tbl_log_call_center.reciept_job_bss = b.user_id
          "; 


$sql .= " Where tbl_log_call_center.fixed_time like '$dte%'  And tbl_log_call_center.type_service = 'BSS'";

if($job!=""){
if($job=="hw" || $job=="sw" || $job=="ot" ){
$sql .= "  And tbl_log_call_center.type_problem = '$job'";
} else {
$sql .= "  And tbl_log_call_center.category_type = '$job'";
}
}
//NGV12120008
if($emp!="") {
$sql .= " And tbl_log_call_center.reciept_job_user_id = '$emp'"; 
} else {
//$sql .= " And tbl_log_call_center.reciept_job_user_id = ''";
} 

echo "\Job No.,Open Date,Finish Date,Problem,Solution,Province,Zone,Call Center,Onsite by,Owner,Status\n";
$rc = mysqli_query($conn,$sql);
while($c= mysqli_fetch_array($rc)){
$str_phase = "";
  if($row["provice_phase"]=="c") $str_phase = "กรุงเทพฯและปริมณฑล";
  if($row["provice_phase"]=="n") $str_phase = "เหนือ";
  if($row["provice_phase"]=="s") $str_phase = "ใต้";  
  if($row["provice_phase"]=="en") $str_phase = "ตะวันออกเฉียงเหนือ";
  if($row["provice_phase"]=="e") $str_phase = "ตะวันออก";
  if($row["provice_phase"]=="cn") $str_phase = "กลาง";
  if($row["provice_phase"]=="w") $str_phase = "ตะวันตก";  //(บน)
  
echo $c["site_id"].",".$c["site_name"].",".$c["job_no"].",".$c["install_network_dte"].",".$c["ip_address"].",".$c["routerbox_no"].",".$c["sim_no"].",".$c["problem_solving"].",".$c["type_service"]."\n";

}
echo "$c[site_id],2,3,4,5,6,7,8,9\n";
echo "\n\n\n\n";
?>  


<table width="100%" align="center" class="mytable" id="table" height="100%"   cellpadding="1" cellspacing="1" >
<tr>
<td valign="top"> 
<form  method="post"   name="form1" id="form1"  action="#" target="mainPage" onSubmit="return false";> 
  <table width="100%" align="center" class="mytable" id="table7" name="table7"  cellpadding="1" cellspacing="1">
      <tr>
<?if($_SESSION["Uat"]=="BSS"){?>
<?}?> 
          <th class="th" width="5%">Site ID</th>
          <th class="th" width="20%">Site Name</th>
          <? if($typer == "Oil") {
              echo "<th class='th' width='5%'>Site Type.</th>";
          } else {
              echo "<th class='th' width='5%'>Pos No.</th>";
          }?>
          <th class="th" width="10%"></th>
          <th class="th" width="5%"></th>
          <th class="th" width="5%"></th>
          <th class="th" width="17%"></th>
          <th class="th" width="18%"></th>                    
          <th class="th" width="5%"></th>          
          <th class="th" width="5%"></th>  
          <th class="th" width="18%"></th>   
          <th class="th" width="18%"></th>                
          <th class="th" width="5%"></th>              
          <th class="th" width="5%"></th>    
      </tr >
          <?
           $res = mysqli_query($conn,$sql);
            while($row = mysqli_fetch_array($res)) {
            ?>
            <tr onMouseOver="this.style.backgroundColor='violet';" onMouseOut="this.style.backgroundColor='white';" >

            <td  style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;" align="center">
                <?=$row["site_id"];?></td>
            <td  style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;" align="left">
                <?
                            $site_name_old = "";
                      if($row["site_old_name"]!=""){
                            $site_name_old = " , ".$row["site_old_name"]; 
                        }
                       echo  $row["site_name"].$site_name_old;	
              // }
                      ?>
                </td>
                <?
                if($typer == "Oil") {
                  echo "<td  style='padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;' align='center'>";
                     echo $row["site_type"];
                  echo "&nbsp;</td>";
                } else {
                    echo "<td  style='padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;' align='center'>";
                     echo $row["pos"];
                  echo "&nbsp;</td>";
                } 
                ?></td>
            <td  style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;" align="center">
               <nobr> <?=$row["job_no"];?></td> 
            <td style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;"  align="center">
               <nobr> <? $opendte = split(" ",$row["open_call_dte"]); echo dateThai($opendte[0]);?></td>
            <td style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;"  align="center">
               <nobr> <? $fixed = split(" ",$row["fixed_time"]);  echo dateThai($fixed[0]);?></td>
            <td  style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;">
                <?=$row["problem"];?></td>
            <td  style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;">
                <?=$row["problem_solving"];?></td>
            <td  style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;" align="center">
               <nobr><?=$row["province_name"]?></font></td> 
            <td  style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;" align="center">
               <nobr><?=iconv( 'UTF-8', 'TIS-620', $str_phase)?></font></td> 
            <td  style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;" align="center">
               <nobr><?=$row["callname"]."  ".$row["callsname"]?></font></td> 
            <td  style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;" align="center">
               <nobr><?=$row["name"]."  ".$row["sname"]?></font></td> 
            <td  style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;" align="center">
               <nobr><?=$row["from_owner"]?></font></td> 
            <td  style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;" align="center">
               <nobr><?=$row["status_call"]?></font></td>                                  
           </tr>
         <?
            $i++;
            }
            ?> 
            <tr>                                                                                 
              <td colspan="10" style="padding:0px; border-bottom:1px solid #ccc; border-right:0px solid #ccc;"><?=iconv('UTF-8','TIS-620',"จำนวน $i แถว"  )?></td>
            </tr>  
  </table>
</div>
<script>
window.onbeforeunload = function(){return false;};
setTimeout(function(){window.close();}, 10000);
</script>
</body>
</html>



<?exit;






  $name = "Content-Disposition: attachment; filename='service-report".$months."-".$years.".csv';";
  header($name);
      $typer =  $_REQUEST["type"]; //$typer;
      $job =  $_REQUEST["job"];
      $months =  $_REQUEST["months"];            
      $years =  $_REQUEST["years"];
     if ( $months == "" || $years=="" ) {
	 		$today = getdate();	
			$months = date("m");  //$today["mon"];
			$years = $today["year"];
			$dte = $years."-".$months;
	  } 
			$dte = $years."-".$months; 
$emp = $_REQUEST["emp"];

			  $sql = "SELECT
              tbl_log_call_center.site_id,
              tbl_site.site_name,
              tbl_site.site_old_name,
              tbl_site.pos,
              tbl_site.province_name,
              tbl_site.from_owner,
              tbl_log_call_center.job_no,
              tbl_log_call_center.open_call_dte,
              tbl_log_call_center.open_call_tme,
              tbl_log_call_center.onsite_datetime,
              tbl_log_call_center.fixed_time,
              tbl_log_call_center.problem,
              tbl_log_call_center.problem_solving,
              tbl_log_call_center.type_service,
              tbl_log_call_center.reciept_job_user_id,
              a.name,
              a.sname,
              tbl_log_call_center.doc,
              tbl_province.province_name,
              tbl_province.provice_phase,
              tbl_log_call_center.status_call,
              b.name as callname,
              b.sname as callsname
              FROM
              tbl_log_call_center
              Left Join tbl_site ON tbl_log_call_center.site_id = tbl_site.site_id
              Left Join tbl_user AS a ON tbl_log_call_center.reciept_job_user_id = a.user_id
              Left Join tbl_province ON tbl_site.province_name = tbl_province.id
              Left Join tbl_user b ON tbl_log_call_center.reciept_job_bss = b.user_id
						"; 
		

		 $sql .= " Where tbl_log_call_center.fixed_time like '$dte%'  And tbl_log_call_center.type_service = 'BSS'";

	if($job!=""){
		if($job=="hw" || $job=="sw" || $job=="ot" ){
		 $sql .= "  And tbl_log_call_center.type_problem = '$job'";
		} else {
		 $sql .= "  And tbl_log_call_center.category_type = '$job'";
		}
	}
//NGV12120008
	if($emp!="") {
		 $sql .= " And tbl_log_call_center.reciept_job_user_id = '$emp'"; 
	} else {
		//$sql .= " And tbl_log_call_center.reciept_job_user_id = ''";
} 

    echo "\Job No.,Open Date,Finish Date,Problem,Solution,Province,Zone,Call Center,Onsite by,Owner,Status\n";
    $rc = mysqli_query($conn,$sql);
    while($c= mysqli_fetch_array($rc)){
        $str_phase = "";
				if($row["provice_phase"]=="c") $str_phase = "กรุงเทพฯและปริมณฑล";
				if($row["provice_phase"]=="n") $str_phase = "เหนือ";
				if($row["provice_phase"]=="s") $str_phase = "ใต้";  
				if($row["provice_phase"]=="en") $str_phase = "ตะวันออกเฉียงเหนือ";
				if($row["provice_phase"]=="e") $str_phase = "ตะวันออก";
				if($row["provice_phase"]=="cn") $str_phase = "กลาง";
                if($row["provice_phase"]=="w") $str_phase = "ตะวันตก";  //(บน)
                
        echo $c["site_id"].",".$c["site_name"].",".$c["job_no"].",".$c["install_network_dte"].",".$c["ip_address"].",".$c["routerbox_no"].",".$c["sim_no"].",".$c["problem_solving"].",".$c["type_service"]."\n";

    }
    echo "$c[site_id],2,3,4,5,6,7,8,9\n";
    echo "\n\n\n\n";
?>  

  
<table width="100%" align="center" class="mytable" id="table" height="100%"   cellpadding="1" cellspacing="1" >
    <tr>
        <td valign="top"> 
            <form  method="post"   name="form1" id="form1"  action="#" target="mainPage" onSubmit="return false";> 
                <table width="100%" align="center" class="mytable" id="table7" name="table7"  cellpadding="1" cellspacing="1">
                    <tr>
			<?if($_SESSION["Uat"]=="BSS"){?>
			<?}?> 
                        <th class="th" width="5%">Site ID</th>
                        <th class="th" width="20%">Site Name</th>
						<? if($typer == "Oil") {
                        	echo "<th class='th' width='5%'>Site Type.</th>";
						} else {
							echo "<th class='th' width='5%'>Pos No.</th>";
						}?>
                        <th class="th" width="10%"></th>
                        <th class="th" width="5%"></th>
                        <th class="th" width="5%"></th>
                        <th class="th" width="17%"></th>
                        <th class="th" width="18%"></th>                    
                        <th class="th" width="5%"></th>          
                        <th class="th" width="5%"></th>  
                        <th class="th" width="18%"></th>   
                        <th class="th" width="18%"></th>                
                        <th class="th" width="5%"></th>              
                        <th class="th" width="5%"></th>    
                    </tr >
                        <?
                         $res = mysqli_query($conn,$sql);
                          while($row = mysqli_fetch_array($res)) {
                          ?>
                          <tr onMouseOver="this.style.backgroundColor='violet';" onMouseOut="this.style.backgroundColor='white';" >
			
                          <td  style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;" align="center">
                              <?=$row["site_id"];?></td>
                          <td  style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;" align="left">
                              <?
										  $site_name_old = "";
									if($row["site_old_name"]!=""){
										  $site_name_old = " , ".$row["site_old_name"]; 
									  }
									 echo  $row["site_name"].$site_name_old;	
							// }
									?>
                          	</td>
                              <?
							  if($typer == "Oil") {
							    echo "<td  style='padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;' align='center'>";
							   	echo $row["site_type"];
								echo "&nbsp;</td>";
							  } else {
							  	echo "<td  style='padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;' align='center'>";
							   	echo $row["pos"];
								echo "&nbsp;</td>";
							  } 
							  ?></td>
                          <td  style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;" align="center">
                             <nobr> <?=$row["job_no"];?></td> 
                          <td style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;"  align="center">
                             <nobr> <? $opendte = split(" ",$row["open_call_dte"]); echo dateThai($opendte[0]);?></td>
                          <td style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;"  align="center">
                             <nobr> <? $fixed = split(" ",$row["fixed_time"]);  echo dateThai($fixed[0]);?></td>
                          <td  style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;">
                              <?=$row["problem"];?></td>
                          <td  style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;">
                              <?=$row["problem_solving"];?></td>
                          <td  style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;" align="center">
                             <nobr><?=$row["province_name"]?></font></td> 
                          <td  style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;" align="center">
                             <nobr><?=iconv( 'UTF-8', 'TIS-620', $str_phase)?></font></td> 
                          <td  style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;" align="center">
                             <nobr><?=$row["callname"]."  ".$row["callsname"]?></font></td> 
                          <td  style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;" align="center">
                             <nobr><?=$row["name"]."  ".$row["sname"]?></font></td> 
                          <td  style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;" align="center">
                             <nobr><?=$row["from_owner"]?></font></td> 
                          <td  style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;" align="center">
                             <nobr><?=$row["status_call"]?></font></td>                                  
                         </tr>
                       <?
                          $i++;
                          }
						  ?> 
                          <tr>                                                                                 
                            <td colspan="10" style="padding:0px; border-bottom:1px solid #ccc; border-right:0px solid #ccc;"><?=iconv('UTF-8','TIS-620',"จำนวน $i แถว"  )?></td>
                          </tr>  
                </table>
				  </form></td></tr></table>

