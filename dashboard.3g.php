 <?                                                                  
session_start();              
require_once("function.php");          
  
 if(!checkUser()){    echo Message(35,"red",$titel1,$msg1,"<a href='index.php?link=dashboard.3g'> $login </a>");
  exit;
  }                                                                                                      
       
include("header.php");  
?> 
<html>
<head>
<title>Bizserv Solution Co.,Ltd</title>
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
<style type="text/css">
<!--
body {
    background-color:  #FFFFFF;
    margin-left: 0px;
    margin-top: 0px;
    margin-right: 0px;
    margin-bottom: 0px;

}
-->
</style>
<style type="text/css">
    <!--
    .mytable1 { width:70%; font-size:15px;
                border:0px solid #ccc;     
    }
    .mytable11 {width:100%; font-size:16px;
                border:1px solid #ccc;     
    }
     .th{ background-color:#003366; color:#FFF; padding:0px; border:0px solid #ccc; height:20px; }
     .td{ border-color:#003366;};
    -->
</style>

</head>
<body>
<center>
                    
<table width="100%" align="center" class="mytable" id="table" height="100%"   cellpadding="1" cellspacing="1" >
    <tr>
        <td valign="top"> 
            <form  method="post" name="form1" id="form1" action="#" target="_parent" onSubmit="return false";>             

                   <table width="100%" border="0" cellpadding="0" cellspacing="0" class="mytable">
                    <tr>
                        <td width="879" valign="middle">&nbsp;</td>                                                         
                        <td width="18" valign="middle">       
                            <a lang="site.form.php?typer=add" class="thickbox pointer" title="Add site">
                            <img src="image/add.JPG" alt="Add" width="20" height="20" border="0" align="right"> </a></td>
                            <td width="27" valign="middle">&nbsp;<b> เพิ่ม </b></td> 
                        
                        <td width="18" valign="middle">
                        <img src="image/delete.JPG" alt="Delete" width="20" height="20" border="0" align="right">
                        </td>
                        <td width="27" valign="middle">&nbsp;<b>  ลบ</b></td>
                    </tr>
                </table>     
                <table width="100%" align="center" class="mytable" id="table7"  cellpadding="1" cellspacing="1">
                    <tr>             
                        <th class="th" width="7%" >ภาค</th>
                        <th class="th" width="13%" >ประเภท</th>
                        <th class="th" width="20%">RB 751 + ZTE</th>
                        <th class="th" width="20%">RB 751 + Huawei</th>
                        <!--th class="th" width="20%" >RB 411 + Huawei</th-->
                        <th class="th" width="20%" >RB 411 + Sierra</th>
                    </tr > 
					<? 
					$phase = array("เหนือ","ใต้","ตะวันออก","ตะวันตก","ตะวันออกเฉียงเหนือ","กรุงเทพฯ","ภาคกลางปริมณทล");
					$phase_id = array("n","s","e","s","en","c","cp");
					$dte = "2013";
					for($i=0;$i<7;$i++){
						//echo $phase[$i];
					?>
					<tr>            
                        <th class="th" width="10%" rowspan="3"><?=$phase[$i]?></th>
                        <th class="th" width="10%">AMAZON</th>
 						<td width="10%"  style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;"  align="center"><?=getValueS($phase_id[$i],'AMZ','18')?></td>
 						<td width="10%"  style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;"  align="center"><?=getValueS($phase_id[$i],'AMZ','22')?></td> 
 						<td width="10%"  style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;"  align="center"><?=getValueS($phase_id[$i],'AMZ','19')?></td> 
                     </tr > 
                        <th class="th" width="10%">NGV</th>
 						<td width="10%"  style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;"  align="center"><?=getValueS($phase_id[$i],'S')?></td>
 						<td width="10%"  style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;"  align="center"><?=getValueS($phase_id[$i],'S')?></td> 
 						<td width="10%"  style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;"  align="center"><?=getValueS($phase_id[$i],'S','20')?></td>
						</tr > 
						<th class="th" width="10%">OIl</th>
 						<td width="10%"  style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;"  align="center"><?=getValueS($phase_id[$i],'10','18')?></td>
 						<td width="10%"  style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;"  align="center"><?=getValueS($phase_id[$i],'10','17')?></td> 
 						<td width="10%"  style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;"  align="center"><?=getValueS($phase_id[$i],'10','20')?></td>
						</tr > 
					<? } ?>  
				<?php /*?>	<tr><td>&nbsp;<br></td></tr>
					<tr>             
                        <th class="th" width="10%" >ภาค</th>
                        <th class="th" width="20%" >ประเภท</th>
                        <th class="th" width="24%">CAT</th>
                        <th class="th" width="24%">DTAC</th>
                    </tr > 
					<? 
					$phase = array("เหนือ","ใต้","ตะวันออก","ตะวันตก","กรุงเทพฯ","ภาคกลางปริมณทล");
					$phase_id = array("n","s","e","s","c","cp");
					for($i=0;$i<6;$i++){
						//echo $phase[$i];
					?>
					<tr>             
                        <th class="th" width="10%" rowspan="3"><?=$phase[$i]?></th>
                        <th class="th" width="10%">AMAZON</th>
                        <td width="10%"  style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;"  align="center"><?=getValueS($phase_id[$i],'AMZ','32')?></td>
                        <td width="10%"  style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;"  align="center"><?=getValueS($phase_id[$i],'AMZ','33')?></td>                
                    </tr >    <tr>             
                         <th class="th" width="10%">NGV</th>
                        <td width="10%"  style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;"  align="center"><?=getValueS($phase_id[$i],'S','32')?></td>
                        <td width="10%"  style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;"  align="center"><?=getValueS($phase_id[$i],'S','33')?></td>
                    </tr >   <tr>             
                        <th class="th" width="10%">OIL</th>
                        <td width="10%"  style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;"  align="center"><?=getValueS($phase_id[$i],'10','32')?></td>
                        <td width="10%"  style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;"  align="center"><?=getValueS($phase_id[$i],'10','33')?></td>
                    </tr >  
					<? } ?>  <?php */?>
                </table>  
					</form></td></tr></table>        
</center>
</body>

<?php /*?>
<tr>            
                        <th class="th" width="10%" rowspan="3"><?=$phase[$i]?></th>
                        <th class="th" width="10%">AMAZON</th>
 						<td width="10%"  style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;"  align="center"><?=get751_ZTE($phase_id[$i],'AMZ')?></td>
 						<td width="10%"  style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;"  align="center"><?=get751_Huawei($phase_id[$i],'AMZ')?></td> 
 						<td width="10%"  style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;"  align="center"><?=get411_Huawei($phase_id[$i],'AMZ')?></td> 
 						<td width="10%"  style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;"  align="center"><?=get411_Sierra($phase_id[$i],'AMZ')?></td> 
                     </tr > 
                        <th class="th" width="10%">NGV</th>
 						<td width="10%"  style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;"  align="center"><?=get751_ZTE($phase_id[$i],'S')?></td>
 						<td width="10%"  style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;"  align="center"><?=get751_Huawei($phase_id[$i],'S')?></td> 
 						<td width="10%"  style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;"  align="center"><?=get411_Huawei($phase_id[$i],'S')?></td> 
 						<td width="10%"  style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;"  align="center"><?=get411_Sierra($phase_id[$i],'S')?></td> 
                     </tr > <?php */?>

 <?
 	function getValueS($type_phase,$type_site,$type_hardware){
	$str  = 0;$cmd = "";
	if($type_phase=="cp") {
			$cmd = "tbl_province.provice_phase = 'c' and  tbl_province.id = '2' ";
	}  else if($type_phase=="c") {
			$cmd = "tbl_province.provice_phase = 'c' and  tbl_province.id not in ('2') ";
	} else  {
		  $cmd = "tbl_province.provice_phase = '$type_phase'";
	}
				$sql = "	SELECT
						count(tbl_hardware_onhand_user.user_id) as cnt
						FROM
						tbl_hardware_onhand_user
						Inner Join tbl_site ON tbl_hardware_onhand_user.user_id = tbl_site.site_id
						Inner Join tbl_province ON tbl_site.province_name = tbl_province.id
						Where $cmd
						And tbl_hardware_onhand_user.user_id like '$type_site%'
						And tbl_hardware_onhand_user.cate_id in ('$type_hardware')
						order by tbl_hardware_onhand_user.cate_id"; 
			$rc = mysqli_query($conn,$sql);
			while($c = mysqli_fetch_array($rc)){
				 $str = $c["cnt"];
			}
			return $str;
	} 	
	
//
//	function get751_ZTE($phase,$site_type){
//		$sql = "SELECT 
//						count(rb751.user_id) as cnt
//						FROM
//						rb751
//						Inner Join zte ON rb751.user_id = zte.user_id
//						Inner Join tbl_site ON zte.user_id = tbl_site.site_id
//						Inner Join tbl_province ON tbl_site.province_name = tbl_province.id
//						Where tbl_province.provice_phase = '$phase' and rb751.user_id like '$site_type%'";
//						$rs = mysql_query($sql);
//						$str = 0;
//		while($c = mysql_fetch_array($rs)){
//				$str =$c["cnt"];
//		}
//		return $str;
//	}
//	
//	function get751_Huawei($phase,$site_type){
//			$sql = "SELECT DISTINCT
//							count(rb751.user_id) as cnt
//							FROM
//							rb751
//							Inner Join huawei ON rb751.user_id = huawei.user_id
//							Inner Join tbl_site ON huawei.user_id = tbl_site.site_id
//							Inner Join tbl_province ON tbl_site.province_name = tbl_province.id
//							Where tbl_province.provice_phase = '$phase' and rb751.user_id  like '$site_type%'";
//			$rs = mysql_query($sql);
//							$str = 0;
//			while($c = mysql_fetch_array($rs)){
//					$str =$c["cnt"];
//			}
//			return $str;
//		}
//		
//	function get411_Huawei($phase,$site_type){
//			$sql = "SELECT DISTINCT
//							count(rb411.user_id) as cnt
//							FROM
//							rb411
//							Inner Join huawei ON rb411.user_id = huawei.user_id
//							Inner Join tbl_site ON huawei.user_id = tbl_site.site_id
//							Inner Join tbl_province ON tbl_site.province_name = tbl_province.id
//							Where tbl_province.provice_phase = '$phase' and rb751.user_id  like '$site_type%'";
//			$rs = mysql_query($sql);
//							$str = 0;
//			while($c = mysql_fetch_array($rs)){
//					$str =$c["cnt"];
//			}
//			return $str;
//		}
//	
//	function get411_Sierra($phase,$site_type){
//			$sql = "SELECT DISTINCT
//								count(rb411.user_id) as cnt
//								FROM
//								rb411
//								Inner Join sierra ON rb411.user_id = sierra.user_id
//								Inner Join tbl_site ON sierra.user_id = tbl_site.site_id
//								Inner Join tbl_province ON tbl_site.center_phase = tbl_province.id
//							Where tbl_province.provice_phase = '$phase' and rb411.user_id  like '$site_type%'";
//			$rs = mysql_query($sql);
//							$str = 0;
//			while($c = mysql_fetch_array($rs)){
//					$str =$c["cnt"];
//			}
//			return $sql;
//		}	
//	
//	function  get751_Huawei_CAT($type_phase,$dte,$site_type){
//	$sql = "SELECT count( donw_all.user_id ) AS cnt
//							FROM donw_all
//							INNER JOIN rb751 ON donw_all.user_id = rb751.user_id
//							INNER JOIN huawei ON rb751.user_id = huawei.user_id
//							INNER JOIN cat ON huawei.user_id = cat.user_id
//							INNER JOIN tbl_site ON cat.user_id = tbl_site.site_id
//							INNER JOIN tbl_province ON tbl_site.province_name = tbl_province.id
//							WHERE donw_all.dte LIKE '$dte%'
//							AND tbl_province.provice_phase = '$type_phase'
//							And donw_all.site_type = '$site_type'";
//		$rs = mysql_query($sql);	
//		$str = 0;
//		while($c = mysql_fetch_array($rs)) {
//		        $str = $c["cnt"];
//		}
//		return $str;
//	}
//	
//	function  get751_ZTE_CAT($type_phase,$dte,$site_type){
//	$sql = "SELECT count( donw_all.user_id ) AS cnt
//							FROM donw_all
//							INNER JOIN rb751 ON donw_all.user_id = rb751.user_id
//							INNER JOIN huawei ON rb751.user_id = huawei.user_id
//							INNER JOIN cat ON huawei.user_id = cat.user_id
//							INNER JOIN tbl_site ON cat.user_id = tbl_site.site_id
//							INNER JOIN tbl_province ON tbl_site.province_name = tbl_province.id
//							WHERE donw_all.dte LIKE '$dte%'
//							AND tbl_province.provice_phase = '$type_phase'
//							And donw_all.site_type = '$site_type'";
//		$rs = mysql_query($sql);	
//		$str = 0;
//		while($c = mysql_fetch_array($rs)) {
//		        $str = $c["cnt"];
//		}
//		return $str;
//	}
//	
//	function get751_Huawei_Dtac($type_phase,$dte,$site_type){
//	$sql = "SELECT count( donw_all.user_id ) AS cnt
//							FROM donw_all
//							INNER JOIN rb751 ON donw_all.user_id = rb751.user_id
//							INNER JOIN huawei ON rb751.user_id = huawei.user_id
//							INNER JOIN dtac ON huawei.user_id = dtac.user_id
//							INNER JOIN tbl_site ON dtac.user_id = tbl_site.site_id
//							INNER JOIN tbl_province ON tbl_site.province_name = tbl_province.id
//						WHERE donw_all.dte LIKE '$dte%'
//							AND tbl_province.provice_phase = '$type_phase'
//							And donw_all.site_type = '$site_type'";
//		$rs = mysql_query($sql);	
//		$str = 0;
//		while($c = mysql_fetch_array($rs)) {
//		        $str = $c["cnt"];
//		}
//		return $str;
//	}
//		
//	function get751_ZTE_Dtac($type_phase,$dte,$site_type){
//				$sql = "SELECT count( donw_all.user_id ) AS cnt
//						FROM
//						donw_all
//						Inner Join rb751 ON donw_all.user_id = rb751.user_id
//						Inner Join zte ON rb751.user_id = zte.user_id
//						Inner Join dtac ON zte.user_id = dtac.user_id
//						Inner Join tbl_site ON dtac.user_id = tbl_site.site_id
//						Inner Join tbl_province ON tbl_site.province_name = tbl_province.id									
//			WHERE donw_all.dte LIKE '$dte%'
//							AND tbl_province.provice_phase = '$type_phase'
//							And donw_all.site_type = '$site_type'";
//		$rs = mysql_query($sql);	
//		$str = 0;
//		while($c = mysql_fetch_array($rs)) {
//		        $str = $c["cnt"];
//		}
//		return $str;
//	}
//	
//	
 ?>
 
 <?php /*?>SELECT
					count(tbl_statistic_solve_3g.site_id) AS cnt
				FROM
					tbl_hardware_onhand_user
				Inner Join tbl_site ON tbl_hardware_onhand_user.user_id = tbl_site.site_id
				Inner Join tbl_province ON tbl_site.province_name = tbl_province.id
				Inner Join tbl_statistic_solve_3g ON tbl_statistic_solve_3g.site_id = tbl_hardware_onhand_user.user_id
				Where tbl_statistic_solve_3g.dte like '2013-09%'
				And tbl_province.provice_phase = '$type_phase' 
				And tbl_hardware_onhand_user.user_id like '$type_site%' 
				And tbl_hardware_onhand_user.cate_id in ('$type_hardwareTT')
				And tbl_hardware_onhand_user.user_id in (SELECT
						tbl_hardware_onhand_user.user_id
						FROM
						tbl_hardware_onhand_user
						Inner Join tbl_site ON tbl_hardware_onhand_user.user_id = tbl_site.site_id
						Inner Join tbl_province ON tbl_site.province_name = tbl_province.id
						WHERE tbl_province.provice_phase =  '$type_phase' AND
						tbl_hardware_onhand_user.user_id LIKE  '$type_site%' AND
						tbl_hardware_onhand_user.cate_id IN  ('$type_hardwarePP'))
				Order by tbl_hardware_onhand_user.cate_id<?php */?>
