<?
header("Content-Type: text/html; charset=tis-620");                 
session_start();
require_once("function.php");                                   
  
  if(!checkUser()){    echo Message(35,"red",$titel1,$msg1,"<a href='index.php?link=delete.serail'> $login </a>");
		 exit;
  }                                                                                                      
 include("header.php"); 

	  $type_station = $_REQUEST["type_station"];
      $site = $_REQUEST["site"];//echo $site."<hr>".$type_station."<hr>";
	  $sql = "";
	  if($type_station=="NGV"){
		$sql = "select site_id,site_name from tbl_station_ngv order by site_id";
	  } else if ($type_station=="OIL"){
		$sql = "select station_id as site_id,site_name from tbl_station_oil order by site_id";
	  } else if ($type_station=="AMAZON"){
		$sql = "select site_id,site_name from tbl_station_amazon order by site_id";
	  }
	//   echo $sql;
	 $rs = mysqli_query($conn,$sql);
	   
?>
<title>Bizserv Solution Co.,Ltd</title>
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
                    
<table width="100%" align="center" class="mytable" id="table" height="100%"   cellpadding="1" cellspacing="1" >
    <tr>
        <td valign="top"> 
            <form  method="post" name="form1" id="form1" action="#" target="_parent">             

                   <table width="100%" border="0" cellpadding="0" cellspacing="0" class="mytable">
                    <tr>
                        <td align="center">
                        <b>&nbsp;Site Type :</b> 
                            <select name="type_station" id="type_station" onchange="form1.submit();">                 
                                <option value = "NGV" <?if($type_station=="NGV") echo "selected";?> >PTT NGV</option>            
                                <option value = "OIL" <?if($type_station=="OIL") echo "selected";?> >PTT OIL</option>          
                                <option value = "AMAZON" <?if($type_station=="AMAZON") echo "selected";?> >PTT AMAZON</option>                    
                            </select> &nbsp;

							<b>&nbsp;Site ID and Site Name :</b>
									<select name="site" id="site" onchange="form1.submit();" style="width:450px"> 
									<? while($c = mysql_fetch_array($rs)){?>
										<option value = "<?=$c["site_id"]?>" <?if($c["site_id"]==$site) echo "selected";?> >
										&nbsp; <?=$c["site_id"] . "&nbsp;". $c["site_name"]?>
										</option>   
									<?}?>
                            </select> </td>
                            <td>&nbsp;</td>
                    </tr>
                </table>     
                <table width="100%" border="0" align="center" class="mytable" id="table7"  cellpadding="1" cellspacing="1">
                    <tr>             
						<th class="th" width="10%">No.</th>
                        <th class="th" width="20%">Job No.</th>
                        <th class="th" width="10%">Date</th>
                        <th class="th" width="20%">Type</th>
                        <th class="th" width="20%">Serail No.</th> 
                        <th class="th" width="10%">&nbsp;</th>   
                    </tr >
					<?
					$sql1 = "SELECT
								tbl_insident_hw.job_no,
								tbl_log_call_center.open_call_dte,
								tbl_log_call_center.open_call_tme,
								tbl_category_hardware.cate_name,
								tbl_insident_hw.serial_no
								FROM
								tbl_insident_hw
								Inner Join tbl_log_call_center ON tbl_insident_hw.job_no = tbl_log_call_center.job_no
								Inner Join tbl_category_hardware ON tbl_insident_hw.cate_id = tbl_category_hardware.cate_id
								where tbl_insident_hw.site_id = '$site'";
					$rs1 = mysqli_query($conn,$sql1);
					$i = 1;
					while($c1 = mysqli_fetch_array($rs1)){
					?>
					<tr onmouseover="this.style.backgroundColor='violet';" onmouseout="this.style.backgroundColor='white';" > 
						<td style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;"  align="center"><?=$i;?></td>
						<td style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;"  align="center"><?=$c1["job_no"];?></td>
						<td style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;"  align="center"><?=$c1["open_call_dte"]. " ".$c1["open_call_tme"];?></td>
						<td style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;"  align="center"><?=$c1["cate_name"];?></td>
						<td style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;"  align="center"><?=$c1["serial_no"];?></td>
						<td style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;"  align="center"> 
						<img  onclick="click2delete('<?=$c1["job_no"]?>','<?=$c1["serial_no"]?>');" src="image/delete.jpg" alt="Clear Text" width="20" height="18" border="0" align="center" /></td>
					</tr>
					<?
						$i++;
						}?>
                </table> 
		</td>
	</tr>
</table> 
<script>
 function click2delete(jobno,serialno){  
		   if(confirm('คุณต้องการจะลบ Serial No. นี้จริงหรือไม่')==true){
			   var site_type = document.form1.type_station.value;
			   var site_id = document.form1.site.value;
				parent.parent.location.href ="delete.serialno.execute.php?jobno="+jobno+"&serialno="+serialno+"&site_type="+site_type+"&site_id="+site_id;
		   }
      
}
</script>
