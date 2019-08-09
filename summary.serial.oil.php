<? 
session_start();                 
include 'connection.php';    
include("header.php");                           
?>
  <html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link rel="stylesheet" href="css/style.css">
<script language="javascript" src="script.js"></script>    

   <link href="style/mytable.css" rel="stylesheet" type="text/css" />
<title>Bizserv Solution Co.,Ltd</title></head>

<body >
	<br>
<center>
<table align="center" bordercolor="#000000" class="table_one">
                <tr>
                      <th width="10%" class="th" ><nobr>&nbsp;#</th>  
		              <th class="th" ><nobr>&nbsp;Category<nobr></th>                                 
                      <th class="th" ><nobr>&nbsp;Active<nobr></th>                                
                      <th class="th" ><nobr>&nbsp;Stock</th>                     
                      <th class="th" ><nobr>&nbsp;On hand<nobr></th>                   
                      <th class="th" ><nobr>&nbsp;Repair<nobr></th>                  
                      <th class="th" ><nobr>&nbsp;Scrap<nobr></th>                
                </tr>
          <? 
$sql = "SELECT
tbl_category_hardware.cate_id,
tbl_category_hardware.cate_name
FROM
tbl_category_hardware
where tbl_category_hardware.cate_id in ('2','3','4','6','7','8','9','10','11','12','13','16','25','27','28','31','30','37','45','66','60','61','62','67','68','69','70')
order by tbl_category_hardware.cate_name"; echo $sql;
$res = mysqli_query($conn,$sql);
$i = 1;
           while( $row = mysqli_fetch_array($res)){   
?>
  <tr onmouseover=this.style.backgroundColor='violet'; onmouseout=this.style.backgroundColor='white';>                              
				<td   align='center'>
				<?=$i?>
				</td>              
				<td >
				  <?=$row["cate_name"]?>
				</td>           
				<td align='center'>
				  <a href='summary_serial_detail.php?id=<?=$row[cate_id]?>&typer=active&site_type=OIL' target='blank'><?=getCntSerial($row["cate_id"])?></a>
				</td>
				<td align='center'>
				  <a href='summary_serial_detail.php?id=<?=$row[cate_id]?>&typer=activetoengineer&site_type=OIL' target='blank'><?=getCntActiveToEngineer($row["cate_id"])?></a>
				</td>
				<td align='center'>
				  <a href='summary_serial_detail.php?id=<?=$row[cate_id]?>&typer=onhand&site_type=OIL' target='blank'><?=getCntOnHand($row["cate_id"])?></a>
				</td>
				<td align='center'>
				  <a href='summary_serial_detail.php?id=<?=$row[cate_id]?>&typer=repair&site_type=OIL' target='blank'><?=getCntRepair($row["cate_id"])?></a>
				</td>
				<td align='center'>
				  <a href='summary_serial_detail.php?id=<?=$row[cate_id]?>&typer=scrap&site_type=OIL' target='blank'><?=getCntScrap($row["cate_id"])?></a>
				</td>         
  </tr>
<? $i++; } ?>
</table>
        
</center>
</body>
</html>
<?
 function getCntSerial($cate_id){
	 global $conn;
$sql = "SELECT
				count(tbl_hardware_onhand_user.hardware_status) as cnt
				FROM
				tbl_hardware_onhand_user
				Where tbl_hardware_onhand_user.cate_id = '$cate_id'
				And
				(tbl_hardware_onhand_user.user_id like '10%'
				or tbl_hardware_onhand_user.user_id like '6%'
				or tbl_hardware_onhand_user.hardware_brand like '%OIL%'
				)
				And tbl_hardware_onhand_user.hardware_status = 'w'
	  "; 
$rs = mysqli_query($conn,$sql);     	  
      while($c = mysqli_fetch_array($rs)){ 
		 	$str = $c["cnt"];       
      }     
      return $str;
 }


function getCntActiveToEngineer($cate_id){
	global $conn;
$sql = "SELECT
				count(tbl_hardware_onhand_user.hardware_status) as cnt
				FROM
				tbl_hardware_onhand_user
				Where tbl_hardware_onhand_user.cate_id = '$cate_id'
				And
				(tbl_hardware_onhand_user.user_id like '10%'
				or tbl_hardware_onhand_user.user_id like '6%'
				or tbl_hardware_onhand_user.hardware_brand like '%OIL%'
				)
				
				And tbl_hardware_onhand_user.hardware_status = 'a'";
$rs = mysqli_query($conn,$sql);
	while($c = mysqli_fetch_array($rs)){
		$str = $c["cnt"];
	}
return $str;

}

function getCntOnHand($cate_id){
	global $conn;
$sql = "SELECT
				count(tbl_hardware_onhand_user.hardware_status) as cnt
				FROM
				tbl_hardware_onhand_user
				Where tbl_hardware_onhand_user.cate_id = '$cate_id'
				And
				(tbl_hardware_onhand_user.user_id like '10%'
				or tbl_hardware_onhand_user.user_id like '6%'
				or tbl_hardware_onhand_user.hardware_brand like '%OIL%'
				)
				And tbl_hardware_onhand_user.hardware_status = 'o'";
$rs = mysqli_query($conn,$sql);
	while($c = mysqli_fetch_array($rs)){
		$str = $c["cnt"];
	}
return $str;
}

function getCntRepair($cate_id){
	global $conn;
$sql = "SELECT
				count(tbl_hardware_onhand_user.hardware_status) as cnt
				FROM
				tbl_hardware_onhand_user
				Where tbl_hardware_onhand_user.cate_id = '$cate_id'
				And
				(tbl_hardware_onhand_user.user_id like '10%'
				or tbl_hardware_onhand_user.user_id like '6%'
				or tbl_hardware_onhand_user.hardware_brand like '%OIL%'
				)
				And tbl_hardware_onhand_user.hardware_status = 'r'";
$rs = mysqli_query($conn,$sql);
	while($c = mysqli_fetch_array($rs)){
		$str = $c["cnt"];
	}
return $str;
}

function getCntScrap($cate_id){
	global $conn;
$sql = "SELECT
				count(tbl_hardware_onhand_user.hardware_status) as cnt
				FROM
				tbl_hardware_onhand_user
				Where tbl_hardware_onhand_user.cate_id = '$cate_id'
				And
				(tbl_hardware_onhand_user.user_id like '10%'
				or tbl_hardware_onhand_user.user_id like '6%'
				or tbl_hardware_onhand_user.hardware_brand like '%OIL%'
				)
				And tbl_hardware_onhand_user.hardware_status = 'i'";
$rs = mysqli_query($conn,$sql);
	while($c = mysqli_fetch_array($rs)){
		$str = $c["cnt"];
	}
return $str;

}

?>
