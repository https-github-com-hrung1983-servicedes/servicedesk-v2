<? 
session_start();                 
header("Content-Type: text/html; charset=tis-620");

require_once("function.php");           

  
  if(!checkUser()){    echo Message(35,"red",$titel1,$msg1,"<a href='index.php?link=serial.export'> $login </a>");         
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
<title>Bizserv Solution Co.,Ltd</title></head>
  <style type="text/css">
    <!--
   .th{ background-color:#003366; color:#FFF; padding:0px; border:0px solid #ccc; height:20px; }  
    -->
</style> 
<body  >
<center>
<table align="center" bordercolor="#000000" class="mytable"  border="1" width="60%">

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


order by tbl_category_hardware.cate_name"; 
$res = mysqli_query($conn,$sql);
$i = 1;
           while( $row = mysqli_fetch_array($res)){

//retail status
//a : ใช้งานได้ปกติ
//b : กำลังนำเครื่องส่งให้ช่างซ่อมที่ BSS
//c : ซ่อมเสร็จแล้วรอช่างเปลี่ยนคืนให้ลุกค้า
//d : ทดแทน
//e : รื้อถอน
//f : เลิกใช้งาน
//g : กำลังซ่อม
//h : อุปกรณ์อยู่กับช่างรอเปลี่ยน 
//i :  ชุดสำหรับหมุนเวียน
//j :  ติดตั้งที่สาขา
	switch ($row[cate_id]) {
    case 1:
        $cate_id_retail='55';
        break;
	case 3:
        $cate_id_retail='62';
        break;
	case 4:
        $cate_id_retail='61';
        break;
	case 6:
        $cate_id_retail='63';
        break;
	case 7:
        $cate_id_retail='50';
        break;
	case 8:
        $cate_id_retail='37';
        break;
	case 9:
        $cate_id_retail='64';
        break;
	case 10:
        $cate_id_retail='56';
        break;
	case 11:
        $cate_id_retail='59';
		$brand_id_retail="and a1.category_brand='173'";
        break;
	case 12:
        $cate_id_retail='59';
		$brand_id_retail="and a1.category_brand='174'";
        break;
	case 13:
        $cate_id_retail='59';
		$brand_id_retail="and a1.category_brand='175'";
        break;
	case 16:
        $cate_id_retail='60';
        break;
	case 36:
        $cate_id_retail='58';
        break;	
}

			?>
<tr onmouseover=this.style.backgroundColor='violet'; onmouseout=this.style.backgroundColor='white';>                              
				<td   align='center'>
				<?=$i?>
				</td>              
				<td >
				  <?=$row["cate_name"]?>
				</td>           
				<td align='center'>
				  <a href='summary.serail.all.detail.php?id=<?=$row[cate_id]?>&typer=active&site_type=OIL' target='blank'><?=getCntSerial($row["cate_id"])?></a>
				</td>
				<td align='center'>
				  <a href='summary.serail.all.detail.php?id=<?=$row[cate_id]?>&typer=activetoengineer&site_type=OIL' target='blank'><?=getCntActiveToEngineer($row["cate_id"])?></a>
				</td>
				<td align='center'>
				  <a href='summary.serail.all.detail.php?id=<?=$row[cate_id]?>&typer=onhand&site_type=OIL' target='blank'><?=getCntOnHand($row["cate_id"])?></a>
				</td>
				<td align='center'>
				  <a href='summary.serail.all.detail.php?id=<?=$row[cate_id]?>&typer=repair&site_type=OIL' target='blank'><?=getCntRepair($row["cate_id"])?></a>
				</td>
				<td align='center'>
				  <a href='summary.serail.all.detail.php?id=<?=$row[cate_id]?>&typer=scrap&site_type=OIL' target='blank'><?=getCntScrap($row["cate_id"])?></a>
				</td>         
</tr>
        <?  $i++;   }?>
            
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
