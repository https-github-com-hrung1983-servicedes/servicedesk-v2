<meta http-equiv=Content-Type content="text/html; charset=utf-8">
<? 
session_start();                 

require_once("function.php");           
require_once("script/function.js");  
  
  if(!checkUser()){    echo Message(35,"red",$titel1,$msg1,"<a href='index.php?link=stock.ngv.bss'> $login </a>");         
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
<title>Bizserv Solution Co.,Ltd.</title></head>
  <style type="text/css">
   .th{ background-color:#003366; color:#FFF; padding:0px; border:0px solid #ccc; height:20px; }  
</style> 
<body  >
<center>
<table align="center" bordercolor="#000000" class="mytable"  border="1" width="60%">

                <tr>
                      <th class="th" rowspan="2"><nobr>#</th> 
                      <th class="th" rowspan="2"><nobr>Hardware</th>                                 
                      <th class="th" rowspan="2" ><nobr>&nbsp;Available<nobr></th>                      
                      <th class="th" rowspan="2" ><nobr>&nbsp;Repair<nobr></th>                   
                      <th class="th" colspan='2' ><nobr>&nbsp;<?=iconv('UTF-8','TIS-620',"กลาง")?><nobr></th>              
                      <th class="th" colspan='2' ><nobr>&nbsp;<?=iconv('UTF-8','TIS-620',"เชียงใหม่")?><nobr></th>             
                      <th class="th" colspan='2' ><nobr>&nbsp;<?=iconv('UTF-8','TIS-620',"ลำปาง")?><nobr></th>            
                      <th class="th" colspan='2' ><nobr>&nbsp;<?=iconv('UTF-8','TIS-620',"อุทัยธานี")?><nobr></th>                       
                      <th class="th" colspan='2' ><nobr>&nbsp;<?=iconv('UTF-8','TIS-620',"อุตรดิตถ์")?><nobr></th>         
                      <th class="th" colspan='2' ><nobr>&nbsp;<?=iconv('UTF-8','TIS-620',"ขอนแก่น")?><nobr></th>                   
                      <th class="th" colspan='2' ><nobr>&nbsp;<?=iconv('UTF-8','TIS-620',"นครราชสีมา")?><nobr></th>                 
                      <th class="th" colspan='2' ><nobr>&nbsp;<?=iconv('UTF-8','TIS-620',"ร้อยเอ็ด")?><nobr></th>                 
                      <th class="th" colspan='2' ><nobr>&nbsp;<?=iconv('UTF-8','TIS-620',"อุบลราชธานี")?><nobr></th>                   
                      <th class="th" colspan='2' ><nobr>&nbsp;<?=iconv('UTF-8','TIS-620',"อุดรธานี")?><nobr></th>                 
                      <th class="th" colspan='2' ><nobr>&nbsp;<?=iconv('UTF-8','TIS-620',"อยุธยา")?><nobr></th>                   
                      <th class="th" colspan='2' ><nobr>&nbsp;<?=iconv('UTF-8','TIS-620',"ชลบุรี")?><nobr></th>                        
                      <th class="th" colspan='2' ><nobr>&nbsp;<?=iconv('UTF-8','TIS-620',"ระยอง")?><nobr></th>                    
                      <th class="th" colspan='2' ><nobr>&nbsp;<?=iconv('UTF-8','TIS-620',"ปราจีนบุรี")?><nobr></th>                  
                      <th class="th" colspan='2' ><nobr>&nbsp;<?=iconv('UTF-8','TIS-620',"สงขลา")?><nobr></th>             
                      <th class="th" colspan='2' ><nobr>&nbsp;<?=iconv('UTF-8','TIS-620',"ชุมพร")?><nobr></th>                 
                      <th class="th" colspan='2' ><nobr>&nbsp;<?=iconv('UTF-8','TIS-620',"กระบี่")?><nobr></th>                 
                      <th class="th" colspan='2' ><nobr>&nbsp;<?=iconv('UTF-8','TIS-620',"สุราษฯ")?><nobr></th>                 
                      <th class="th" colspan='2' ><nobr>&nbsp;<?=iconv('UTF-8','TIS-620',"นครศรีฯ")?><nobr></th>                
                      <th class="th" colspan='2' ><nobr>&nbsp;<?=iconv('UTF-8','TIS-620',"สมุทรสาคร")?><nobr></th>                 
                      <th class="th" rowspan="2" ><nobr>&nbsp;<?=iconv('UTF-8','TIS-620',"คลังนวนคร")?><nobr></th>            
		              <th class="th" colspan='2'  ><nobr>&nbsp;Grand Total</th>     
             </tr>
             <tr>                 
                      <th class="th"><nobr>&nbsp;<?=iconv('UTF-8','TIS-620',"ดี")?><nobr></th>  
                      <th class="th"><nobr>&nbsp;<?=iconv('UTF-8','TIS-620',"เสีย")?><nobr></th>
                      <th class="th"><nobr>&nbsp;<?=iconv('UTF-8','TIS-620',"ดี")?><nobr></th>  
                      <th class="th"><nobr>&nbsp;<?=iconv('UTF-8','TIS-620',"เสีย")?><nobr></th>
                      <th class="th"><nobr>&nbsp;<?=iconv('UTF-8','TIS-620',"ดี")?><nobr></th>  
                      <th class="th"><nobr>&nbsp;<?=iconv('UTF-8','TIS-620',"เสีย")?><nobr></th>
                      <th class="th"><nobr>&nbsp;<?=iconv('UTF-8','TIS-620',"ดี")?><nobr></th>  
                      <th class="th"><nobr>&nbsp;<?=iconv('UTF-8','TIS-620',"เสีย")?><nobr></th>
                      <th class="th"><nobr>&nbsp;<?=iconv('UTF-8','TIS-620',"ดี")?><nobr></th>  
                      <th class="th"><nobr>&nbsp;<?=iconv('UTF-8','TIS-620',"เสีย")?><nobr></th>
                      <th class="th"><nobr>&nbsp;<?=iconv('UTF-8','TIS-620',"ดี")?><nobr></th>  
                      <th class="th"><nobr>&nbsp;<?=iconv('UTF-8','TIS-620',"เสีย")?><nobr></th>
                      <th class="th"><nobr>&nbsp;<?=iconv('UTF-8','TIS-620',"ดี")?><nobr></th>  
                      <th class="th"><nobr>&nbsp;<?=iconv('UTF-8','TIS-620',"เสีย")?><nobr></th>
                      <th class="th"><nobr>&nbsp;<?=iconv('UTF-8','TIS-620',"ดี")?><nobr></th>  
                      <th class="th"><nobr>&nbsp;<?=iconv('UTF-8','TIS-620',"เสีย")?><nobr></th>
                      <th class="th"><nobr>&nbsp;<?=iconv('UTF-8','TIS-620',"ดี")?><nobr></th>  
                      <th class="th"><nobr>&nbsp;<?=iconv('UTF-8','TIS-620',"เสีย")?><nobr></th>
                      <th class="th"><nobr>&nbsp;<?=iconv('UTF-8','TIS-620',"ดี")?><nobr></th>  
                      <th class="th"><nobr>&nbsp;<?=iconv('UTF-8','TIS-620',"เสีย")?><nobr></th>
                      <th class="th"><nobr>&nbsp;<?=iconv('UTF-8','TIS-620',"ดี")?><nobr></th>  
                      <th class="th"><nobr>&nbsp;<?=iconv('UTF-8','TIS-620',"เสีย")?><nobr></th>
                      <th class="th"><nobr>&nbsp;<?=iconv('UTF-8','TIS-620',"ดี")?><nobr></th>  
                      <th class="th"><nobr>&nbsp;<?=iconv('UTF-8','TIS-620',"เสีย")?><nobr></th>
                      <th class="th"><nobr>&nbsp;<?=iconv('UTF-8','TIS-620',"ดี")?><nobr></th>  
                      <th class="th"><nobr>&nbsp;<?=iconv('UTF-8','TIS-620',"เสีย")?><nobr></th>
                      <th class="th"><nobr>&nbsp;<?=iconv('UTF-8','TIS-620',"ดี")?><nobr></th>  
                      <th class="th"><nobr>&nbsp;<?=iconv('UTF-8','TIS-620',"เสีย")?><nobr></th>
                      <th class="th"><nobr>&nbsp;<?=iconv('UTF-8','TIS-620',"ดี")?><nobr></th>  
                      <th class="th"><nobr>&nbsp;<?=iconv('UTF-8','TIS-620',"เสีย")?><nobr></th>
                      <th class="th"><nobr>&nbsp;<?=iconv('UTF-8','TIS-620',"ดี")?><nobr></th>  
                      <th class="th"><nobr>&nbsp;<?=iconv('UTF-8','TIS-620',"เสีย")?><nobr></th>
                      <th class="th"><nobr>&nbsp;<?=iconv('UTF-8','TIS-620',"ดี")?><nobr></th>  
                      <th class="th"><nobr>&nbsp;<?=iconv('UTF-8','TIS-620',"เสีย")?><nobr></th>
                      <th class="th"><nobr>&nbsp;<?=iconv('UTF-8','TIS-620',"ดี")?><nobr></th>  
                      <th class="th"><nobr>&nbsp;<?=iconv('UTF-8','TIS-620',"เสีย")?><nobr></th>
                      <th class="th"><nobr>&nbsp;<?=iconv('UTF-8','TIS-620',"ดี")?><nobr></th>  
                      <th class="th"><nobr>&nbsp;<?=iconv('UTF-8','TIS-620',"เสีย")?><nobr></th> 
                      <th class="th"><nobr>&nbsp;<?=iconv('UTF-8','TIS-620',"ดี")?><nobr></th>  
                      <th class="th"><nobr>&nbsp;<?=iconv('UTF-8','TIS-620',"เสีย")?><nobr></th>    
                      <th class="th"><nobr>&nbsp;<?=iconv('UTF-8','TIS-620',"ดี")?><nobr></th>  
                      <th class="th"><nobr>&nbsp;<?=iconv('UTF-8','TIS-620',"เสีย")?><nobr></th>      
             </tr>

          <? /*  order by orderbyid,cate_name 
          
          tbl_category_hardware.cate_id in ('1','2','3','4','6','7','8','9','10','11','12','13','16','25','27','31',
'30','36','37','45','70','132','139','140','143','150','154','162','164','193','199','201','203','204','206')
*/
$sql = "SELECT
      tbl_category_hardware.cate_id,
      tbl_category_hardware.cate_name
      FROM
      tbl_category_hardware
      where tbl_category_hardware.cate_active='y' and orderbyid is not null
      order by tbl_category_hardware.orderbyid,tbl_category_hardware.cate_name"; 
$res = mysqli_query($conn,$sql);
$i = 1;
while( $row = mysqli_fetch_array($res)){ 
    $cate0 =  getCntOnHandAndStock_center($row['cate_id'],"");
    $cate0_total += $cate0;
    $cate0_1 =  getCntOnHandAndStock_center($row['cate_id'],"1");
    $cate0_total_1 += $cate0_1;


$cate1 = getCntOnHandAndStock($row['cate_id'],'112','');   // เชียงใหม่ 
$cate1_total += $cate1;
$cate1_1 = getCntOnHandAndStock($row['cate_id'],'112','x');   // เชียงใหม่ 
$cate1_total_1 += $cate1_1;

$cate2 = getCntOnHandAndStock($row['cate_id'],'274','');   // ลำปาง 
$cate2_total += $cate2;
$cate2_2 = getCntOnHandAndStock($row['cate_id'],'274','x');   // ลำปาง 
$cate2_total_2 += $cate2_2;

$cate3 = getCntOnHandAndStock($row['cate_id'],'119','');   // อุทัย 
$cate3_total += $cate3;
$cate3_3 = getCntOnHandAndStock($row['cate_id'],'119','x');   // อุทัย 
$cate3_total_3 += $cate3_3;

$cate4 = getCntOnHandAndStock($row['cate_id'],'258','');   // อุตรดิตถ์ 
$cate4_total += $cate4;
$cate4_4 = getCntOnHandAndStock($row['cate_id'],'258','x');   // อุตรดิตถ์ 
$cate4_total_4 += $cate4_4;

$cate5 = getCntOnHandAndStock($row['cate_id'],'14','');   // ขอนแก่น 
$cate5_total += $cate5;
$cate5_5 = getCntOnHandAndStock($row['cate_id'],'14','x');   // ขอนแก่น 
$cate5_total_5 += $cate5_5;

$cate6 = getCntOnHandAndStock($row['cate_id'],'109','');   // นครราชสีมา 
$cate6_total += $cate6;
$cate6_6 = getCntOnHandAndStock($row['cate_id'],'109','x');   // นครราชสีมา 
$cate6_total_6 += $cate6_6;

$cate7 = getCntOnHandAndStock($row['cate_id'],'176','');   // ร้อยเอ็ด 
$cate7_total += $cate7;
$cate7_7 = getCntOnHandAndStock($row['cate_id'],'176','x');   // ร้อยเอ็ด 
$cate7_total_7 += $cate7_7;

$cate8 = getCntOnHandAndStock($row['cate_id'],'202','');   // อุบลราชธานี 
$cate8_total += $cate8;
$cate8_8 = getCntOnHandAndStock($row['cate_id'],'202','x');   // อุบลราชธานี 
$cate8_total_8 += $cate8_8;

$cate9 = getCntOnHandAndStock($row['cate_id'],'120','');   // อุดรธานี 
$cate9_total += $cate9;
$cate9_9 = getCntOnHandAndStock($row['cate_id'],'120','x');   // อุดรธานี 
$cate9_total_9 += $cate9_9;

$cate10 = getCntOnHandAndStock($row['cate_id'],'125','');   // อยุธยา 
$cate10_total += $cate10;
$cate10_10 = getCntOnHandAndStock($row['cate_id'],'125','x');   // อยุธยา 
$cate10_total_10 += $cate10_10;

$cate11 = getCntOnHandAndStock($row['cate_id'],'110','');   // ชลบุรี 
$cate11_total += $cate11;
$cate11_11 = getCntOnHandAndStock($row['cate_id'],'110','x');   // ชลบุรี 
$cate11_total_11 += $cate11_11;

$cate12 = getCntOnHandAndStock($row['cate_id'],'206','');   // ระยอง 
$cate12_total += $cate12;
$cate12_12 = getCntOnHandAndStock($row['cate_id'],'206','x');   // ระยอง 
$cate12_total_12 += $cate12_12;

$cate13 = getCntOnHandAndStock($row['cate_id'],'127','');   // ปราจีนบุรี 
$cate13_total += $cate13;
$cate13_13 = getCntOnHandAndStock($row['cate_id'],'127','x');   // ปราจีนบุรี 
$cate13_total_13 += $cate13_13;

$cate14 = getCntOnHandAndStock($row['cate_id'],'205','');   // สงขลา 
$cate14_total += $cate14;
$cate14_14 = getCntOnHandAndStock($row['cate_id'],'205','x');   // สงขลา 
$cate14_total_14 += $cate14_14;

$cate15 = getCntOnHandAndStock($row['cate_id'],'270','');   // สงขลา 
$cate15_total += $cate15;
$cate15_15 = getCntOnHandAndStock($row['cate_id'],'270','x');   // สงขลา 
$cate15_total_15 += $cate15_15;

$cate16 = getCntOnHandAndStock($row['cate_id'],'269','');   // กระบี่ 
$cate16_total += $cate16;
$cate16_16 = getCntOnHandAndStock($row['cate_id'],'269','x');   // กระบี่ 
$cate16_total_16 += $cate16_16;

$cate17 = getCntOnHandAndStock($row['cate_id'],'268','');   // สุราษฯ 
$cate17_total += $cate17;
$cate17_17 = getCntOnHandAndStock($row['cate_id'],'268','x');   // สุราษฯ 
$cate17_total_17 += $cate17_17;

$cate18 = getCntOnHandAndStock($row['cate_id'],'267','');   // นครศรีฯ 
$cate18_total += $cate18;
$cate18_18 = getCntOnHandAndStock($row['cate_id'],'267','x');   // นครศรีฯ 
$cate18_total_18 += $cate18_18;

$cate20 = getCntOnHandAndStock($row['cate_id'],'273','');   // สมุทรสาคร 
$cate20_total += $cate20;
$cate20_20 = getCntOnHandAndStock($row['cate_id'],'273','x');   // สมุทรสาคร 
$cate20_total_20 += $cate20_20;

$cate19 = getCntOnHandAndStock($row['cate_id'],'252','');   // คลังนวนคร 
$cate19_total += $cate19;
$cate19_19 = getCntOnHandAndStock($row['cate_id'],'252','x');   // คลังนวนคร 
$cate19_total_19 += $cate19_19;

$stock = $cate19+$cate19_19;

//$cate_safety_stock = getCntOnHandAndStock($row['cate_id'],'150');
//$cate_safety_stock_total += $cate_safety_stock;
$cate_stock = getCntSafetyStockRepair($row['cate_id'],'a');
$cate_stock_total += $cate_stock;
$cate_repair = getCntSafetyStockRepair($row['cate_id'],'r');
$cate_repair_total += $cate_repair;
$cate_scrap = 0;//getCntSafetyStockRepair($row['cate_id'],'i');
$cate_scrap_total += $cate_scrap;

$bycate_total = $cate1+$cate2+$cate3+$cate4+$cate5+$cate6+$cate7+$cate8+$cate9+$cate10+$cate11+$cate12+$cate13+$cate14+$cate15+$cate16+$cate17+$cate18+$cate19+$cate20; 
//$bycate_totalx = $cate1_1;
//+$cate2_2+$cate3_3+$cate4_4+$cate5_5+$cate6_6+$cate7_7+$cate8_8+$cate9_9+$cate10_10+$cate11_11+$cate12_12+$cate13_13+$cate14_14+$cate15_15+$cate16_16+$cate17_17+$cate18_18+$cate19_19+$cate20_20; 



//$allcate_total = $cate_safety_stock_total+$cate_stock_total+$cate_repair_total+$cate0_total+$cate1_total+$cate2_total+$cate3_total+$cate4_total+$cate5_total+$cate6_total+$cate7_total+$cate_scrap_total; 






echo "<tr onmouseover=this.style.backgroundColor='violet'; onmouseout=this.style.backgroundColor='white';>";                               
echo"<td  style='padding:0px; border-bottom:1px solid #ccc; border-right:0px solid #ccc;' align='center'><b>$i</b></td> ";              
echo"<td  style='padding:0px; border-bottom:1px solid #ccc; border-right:0px solid #ccc;'>&nbsp;<b>$row[cate_name]</b></td> ";             
//echo"<td  style='padding:0px; border-bottom:1px solid #ccc; border-right:0px solid #ccc;' align='center'>
//	<a href='stock.ngv.bss.form.php?id=$row[cate_id]&typer=150&status=rrr' target='blank'>".$cate_safety_stock."</a></td> ";
echo"<td  style='padding:0px; border-bottom:1px solid #ccc; border-right:0px solid #ccc;' align='center'>
	<a href='stock.ngv.bss.form.php?id=$row[cate_id]&typer=a&status=rr'target='blank'>".$cate_stock."</a></td> ";   
echo"<td  style='padding:0px; border-bottom:1px solid #ccc; border-right:0px solid #ccc;' align='center'>
	<a href='stock.ngv.bss.form.php?id=$row[cate_id]&typer=r&status=rr'target='blank'>".$cate_repair."</a></td> "; 
echo"<td  style='padding:0px; border-bottom:1px solid #ccc; border-right:0px solid #ccc;' align='center'>
        <a href='stock.ngv.bss.form.php?id=$row[cate_id]&typer=c0&status=a'target='blank'>".$cate0."</a></td> ";
echo"<td  style='padding:0px; border-bottom:1px solid #ccc; border-right:0px solid #ccc;' align='center'>
        <a href='stock.ngv.bss.form.php?id=$row[cate_id]&typer=c0&status=r'target='blank'>".$cate0_1."</a></td> ";
       
echo"<td  style='padding:0px; border-bottom:1px solid #ccc; border-right:0px solid #ccc;' align='center'>
        <a href='stock.ngv.bss.form.php?id=$row[cate_id]&typer=112&status=a'target='blank'>".$cate1."</a></td> ";      // เชียงใหม่
echo"<td  style='padding:0px; border-bottom:1px solid #ccc; border-right:0px solid #ccc;' align='center'>
        <a href='stock.ngv.bss.form.php?id=$row[cate_id]&typer=112&status=r'target='blank'>".$cate1_1."</a></td> ";    // เชียงใหม่
                      
echo"<td  style='padding:0px; border-bottom:1px solid #ccc; border-right:0px solid #ccc;' align='center'>
        <a href='stock.ngv.bss.form.php?id=$row[cate_id]&typer=207&status=a'target='blank'>".$cate2."</a></td> ";      // ลำปาง
echo"<td  style='padding:0px; border-bottom:1px solid #ccc; border-right:0px solid #ccc;' align='center'>
        <a href='stock.ngv.bss.form.php?id=$row[cate_id]&typer=207&status=r'target='blank'>".$cate2_2."</a></td> ";     // ลำปาง        
      
echo"<td  style='padding:0px; border-bottom:1px solid #ccc; border-right:0px solid #ccc;' align='center'>
        <a href='stock.ngv.bss.form.php?id=$row[cate_id]&typer=119&status=a'target='blank'>".$cate3."</a></td> ";      // อุทัย 
echo"<td  style='padding:0px; border-bottom:1px solid #ccc; border-right:0px solid #ccc;' align='center'>
        <a href='stock.ngv.bss.form.php?id=$row[cate_id]&typer=119&status=r'target='blank'>".$cate3_3."</a></td> ";      // อุทัย         
      
echo"<td  style='padding:0px; border-bottom:1px solid #ccc; border-right:0px solid #ccc;' align='center'>
        <a href='stock.ngv.bss.form.php?id=$row[cate_id]&typer=258&status=a'target='blank'>".$cate4."</a></td> ";      // อุตรดิตถ์ 
echo"<td  style='padding:0px; border-bottom:1px solid #ccc; border-right:0px solid #ccc;' align='center'>
        <a href='stock.ngv.bss.form.php?id=$row[cate_id]&typer=258&status=r'target='blank'>".$cate4_4."</a></td> ";      // อุตรดิตถ์ 
        
echo"<td  style='padding:0px; border-bottom:1px solid #ccc; border-right:0px solid #ccc;' align='center'>
	<a href='stock.ngv.bss.form.php?id=$row[cate_id]&typer=14&status=a'target='blank'>".$cate5."</a></td> ";      // ขอนแก่น 
echo"<td  style='padding:0px; border-bottom:1px solid #ccc; border-right:0px solid #ccc;' align='center'>
        <a href='stock.ngv.bss.form.php?id=$row[cate_id]&typer=14&status=r'target='blank'>".$cate5_5."</a></td> ";      // ขอนแก่น 
                
echo"<td  style='padding:0px; border-bottom:1px solid #ccc; border-right:0px solid #ccc;' align='center'>
        <a href='stock.ngv.bss.form.php?id=$row[cate_id]&typer=109&status=a'target='blank'>".$cate6."</a></td> ";          // นครราชสีมา 
echo"<td  style='padding:0px; border-bottom:1px solid #ccc; border-right:0px solid #ccc;' align='center'>
        <a href='stock.ngv.bss.form.php?id=$row[cate_id]&typer=109&status=r'target='blank'>".$cate6_6."</a></td> ";          // นครราชสีมา 
        
echo"<td  style='padding:0px; border-bottom:1px solid #ccc; border-right:0px solid #ccc;' align='center'>
        <a href='stock.ngv.bss.form.php?id=$row[cate_id]&typer=176&status=a'target='blank'>".$cate7."</a></td> ";          // ร้อยเอ็ด 
echo"<td  style='padding:0px; border-bottom:1px solid #ccc; border-right:0px solid #ccc;' align='center'>
        <a href='stock.ngv.bss.form.php?id=$row[cate_id]&typer=176&status=r'target='blank'>".$cate7_7."</a></td> ";          // ร้อยเอ็ด 
        
echo"<td  style='padding:0px; border-bottom:1px solid #ccc; border-right:0px solid #ccc;' align='center'>
	<a href='stock.ngv.bss.form.php?id=$row[cate_id]&typer=202&status=a'target='blank'>".$cate8."</a></td> ";        // อุบลราชธานี 
echo"<td  style='padding:0px; border-bottom:1px solid #ccc; border-right:0px solid #ccc;' align='center'>
        <a href='stock.ngv.bss.form.php?id=$row[cate_id]&typer=202&status=r'target='blank'>".$cate8_8."</a></td> ";        // อุบลราชธานี 

echo"<td  style='padding:0px; border-bottom:1px solid #ccc; border-right:0px solid #ccc;' align='center'>
        <a href='stock.ngv.bss.form.php?id=$row[cate_id]&typer=120&status=a'target='blank'>".$cate9."</a></td> ";        // อุดรธานี 
echo"<td  style='padding:0px; border-bottom:1px solid #ccc; border-right:0px solid #ccc;' align='center'>
        <a href='stock.ngv.bss.form.php?id=$row[cate_id]&typer=120&status=r'target='blank'>".$cate9_9."</a></td> ";        // อุดรธานี 
        
echo"<td  style='padding:0px; border-bottom:1px solid #ccc; border-right:0px solid #ccc;' align='center'>
        <a href='stock.ngv.bss.form.php?id=$row[cate_id]&typer=125&status=a'target='blank'>".$cate10."</a></td> ";        // อยุธยา 
echo"<td  style='padding:0px; border-bottom:1px solid #ccc; border-right:0px solid #ccc;' align='center'>
        <a href='stock.ngv.bss.form.php?id=$row[cate_id]&typer=125&status=r'target='blank'>".$cate10_10."</a></td> ";        // อยุธยา 
        
echo"<td  style='padding:0px; border-bottom:1px solid #ccc; border-right:0px solid #ccc;' align='center'>
        <a href='stock.ngv.bss.form.php?id=$row[cate_id]&typer=110&status=a'target='blank'>".$cate11."</a></td> ";        // ชลบุรี 
echo"<td  style='padding:0px; border-bottom:1px solid #ccc; border-right:0px solid #ccc;' align='center'>
        <a href='stock.ngv.bss.form.php?id=$row[cate_id]&typer=110&status=r'target='blank'>".$cate11_11."</a></td> ";        // ชลบุรี 
        
echo"<td  style='padding:0px; border-bottom:1px solid #ccc; border-right:0px solid #ccc;' align='center'>
        <a href='stock.ngv.bss.form.php?id=$row[cate_id]&typer=206&status=a'target='blank'>".$cate12."</a></td> ";            // ระยอง 
echo"<td  style='padding:0px; border-bottom:1px solid #ccc; border-right:0px solid #ccc;' align='center'>
        <a href='stock.ngv.bss.form.php?id=$row[cate_id]&typer=206&status=r'target='blank'>".$cate12_12."</a></td> ";            // ระยอง 
        
echo"<td  style='padding:0px; border-bottom:1px solid #ccc; border-right:0px solid #ccc;' align='center'>
        <a href='stock.ngv.bss.form.php?id=$row[cate_id]&typer=127&status=a'target='blank'>".$cate13."</a></td> ";            // ปราจีนบุรี 
echo"<td  style='padding:0px; border-bottom:1px solid #ccc; border-right:0px solid #ccc;' align='center'>
        <a href='stock.ngv.bss.form.php?id=$row[cate_id]&typer=127&status=r'target='blank'>".$cate13_13."</a></td> ";            // ปราจีนบุรี 
        
echo"<td  style='padding:0px; border-bottom:1px solid #ccc; border-right:0px solid #ccc;' align='center'>
        <a href='stock.ngv.bss.form.php?id=$row[cate_id]&typer=205&status=a'target='blank'>".$cate14."</a></td> ";            // สงขลา 
echo"<td  style='padding:0px; border-bottom:1px solid #ccc; border-right:0px solid #ccc;' align='center'>
	<a href='stock.ngv.bss.form.php?id=$row[cate_id]&typer=205&status=r'target='blank'>".$cate14_14."</a></td> ";            // สงขลา 
    
echo"<td  style='padding:0px; border-bottom:1px solid #ccc; border-right:0px solid #ccc;' align='center'>
        <a href='stock.ngv.bss.form.php?id=$row[cate_id]&typer=270&status=a'target='blank'>".$cate15."</a></td> ";            // ชุมพร 
echo"<td  style='padding:0px; border-bottom:1px solid #ccc; border-right:0px solid #ccc;' align='center'>
        <a href='stock.ngv.bss.form.php?id=$row[cate_id]&typer=270&status=r'target='blank'>".$cate15_15."</a></td> ";            // ชุมพร 
        
echo"<td  style='padding:0px; border-bottom:1px solid #ccc; border-right:0px solid #ccc;' align='center'>
        <a href='stock.ngv.bss.form.php?id=$row[cate_id]&typer=269&status=a'target='blank'>".$cate16."</a></td> ";            // กระบี่ 
echo"<td  style='padding:0px; border-bottom:1px solid #ccc; border-right:0px solid #ccc;' align='center'>
        <a href='stock.ngv.bss.form.php?id=$row[cate_id]&typer=269&status=r'target='blank'>".$cate16_16."</a></td> ";            // กระบี่ 
        
echo"<td  style='padding:0px; border-bottom:1px solid #ccc; border-right:0px solid #ccc;' align='center'>
        <a href='stock.ngv.bss.form.php?id=$row[cate_id]&typer=268&status=a'target='blank'>".$cate17."</a></td> ";            // สุราษฯ 
echo"<td  style='padding:0px; border-bottom:1px solid #ccc; border-right:0px solid #ccc;' align='center'>
        <a href='stock.ngv.bss.form.php?id=$row[cate_id]&typer=268&status=r'target='blank'>".$cate17_17."</a></td> ";            // สุราษฯ 
        
echo"<td  style='padding:0px; border-bottom:1px solid #ccc; border-right:0px solid #ccc;' align='center'>
        <a href='stock.ngv.bss.form.php?id=$row[cate_id]&typer=267&status=a'target='blank'>".$cate18."</a></td> ";            // นครศรีฯ 
echo"<td  style='padding:0px; border-bottom:1px solid #ccc; border-right:0px solid #ccc;' align='center'>
        <a href='stock.ngv.bss.form.php?id=$row[cate_id]&typer=267&status=r'target='blank'>".$cate18_18."</a></td> ";            // นครศรีฯ 
        
echo"<td  style='padding:0px; border-bottom:1px solid #ccc; border-right:0px solid #ccc;' align='center'>
        <a href='stock.ngv.bss.form.php?id=$row[cate_id]&typer=273&status=a'target='blank'>".$cate20."</a></td> ";            // สมุทรสาคร 
echo"<td  style='padding:0px; border-bottom:1px solid #ccc; border-right:0px solid #ccc;' align='center'>
        <a href='stock.ngv.bss.form.php?id=$row[cate_id]&typer=273&status=r'target='blank'>".$cate20_20."</a></td> ";            // สมุทรสาคร 
        
echo"<td  style='padding:0px; border-bottom:1px solid #ccc; border-right:0px solid #ccc;' align='center'>
        <a href='stock.ngv.bss.form.php?id=$row[cate_id]&typer=252&status=X'target='blank'>".$stock."</a></td> ";            // คลังนวนคร  $cate19
        /*
echo"<td  style='padding:0px; border-bottom:1px solid #ccc; border-right:0px solid #ccc;' align='center'>
        <a href='stock.ngv.bss.form.php?id=$row[cate_id]&typer=252'target='blank'>".$cate19_19."</a></td> ";            // คลังนวนคร 
*/






echo"<td  style='padding:0px; border-bottom:1px solid #ccc; border-right:0px solid #ccc;' align='center'>$bycate_total</td> ";
echo"<td  style='padding:0px; border-bottom:1px solid #ccc; border-right:0px solid #ccc;' align='center'>$bycate_totalx</td> ";
 $i++;         
//  <a href='stock.ngv.bss.form.php?id=$row[cate_id]&typer=bycat' target='blank'>".   </a>

            ?>         
        </tr>
        <?} /*?>
            <tr onmouseover=this.style.backgroundColor='violet'; onmouseout=this.style.backgroundColor='white';>                               
            <td  style='padding:0px; border-bottom:1px solid #ccc; border-right:0px solid #ccc;' align='center' colspan='2'><b>Grand Total</b></td>             
            <td  style='padding:0px; border-bottom:1px solid #ccc; border-right:0px solid #ccc;' align='center'><?=$cate_safety_stock_total?></td>
            <td  style='padding:0px; border-bottom:1px solid #ccc; border-right:0px solid #ccc;' align='center'><?=$cate_stock_total?></td>
	        <td  style='padding:0px; border-bottom:1px solid #ccc; border-right:0px solid #ccc;' align='center'><?=$cate_repair_total?></td>   
            <td  style='padding:0px; border-bottom:1px solid #ccc; border-right:0px solid #ccc;' align='center'><?=$cate0_total?></td> 
      	    <td  style='padding:0px; border-bottom:1px solid #ccc; border-right:0px solid #ccc;' align='center'><?=$cate1_total?></td> 
      	    <td  style='padding:0px; border-bottom:1px solid #ccc; border-right:0px solid #ccc;' align='center'><?=$cate2_total?></td> 
      	    <td  style='padding:0px; border-bottom:1px solid #ccc; border-right:0px solid #ccc;' align='center'><?=$cate3_total?></td> 
      	    <td  style='padding:0px; border-bottom:1px solid #ccc; border-right:0px solid #ccc;' align='center'><?=$cate4_total?></td> 
      	    <td  style='padding:0px; border-bottom:1px solid #ccc; border-right:0px solid #ccc;' align='center'><?=$cate5_total?></td>
      	    <td  style='padding:0px; border-bottom:1px solid #ccc; border-right:0px solid #ccc;' align='center'><?=$cate6_total?></td>
      	    <td  style='padding:0px; border-bottom:1px solid #ccc; border-right:0px solid #ccc;' align='center'><?=$cate7_total?></td>
      	    <td  style='padding:0px; border-bottom:1px solid #ccc; border-right:0px solid #ccc;' align='center'><?=$cate_scrap_total?></td>
      	    <td  style='padding:0px; border-bottom:1px solid #ccc; border-right:0px solid #ccc;' align='center'><?=$allcate_total?></td>
       
        </tr>
        <?  */?>
        </table>
        
</center>
</body>
</html>
<?



function getCntOnHandAndStock($cate_id,$service_by,$fromsite){
	global $conn;
$sql = "SELECT
count(tbl_hardware_onhand_user.hardware_status) as cnt
FROM
tbl_hardware_onhand_user
Where tbl_hardware_onhand_user.cate_id in ('$cate_id') and tbl_hardware_onhand_user.user_id in ('$service_by')
And tbl_hardware_onhand_user.hardware_status = 'o'";
$cmd = " And tbl_hardware_onhand_user.from_site_id = ' '";
if($fromsite!=""){
    $cmd = " And tbl_hardware_onhand_user.from_site_id <> ''";
}
$sql = $sql.$cmd;
$rs = mysqli_query($conn,$sql);
	while($c = mysqli_fetch_array($rs)){
		$str = $c["cnt"];
	}
return $str;

}

function getCntOnHandAndStock_center($cate_id,$fromsite){
	global $conn;
$sql = "SELECT
count(tbl_hardware_onhand_user.hardware_status) as cnt
FROM
tbl_hardware_onhand_user
Where tbl_hardware_onhand_user.cate_id in ('$cate_id') and tbl_hardware_onhand_user.user_id in (77,91,137,154,228,237,166,224)
And tbl_hardware_onhand_user.hardware_status = 'o'";
$cmd = " And tbl_hardware_onhand_user.from_site_id = ' '";
if($fromsite!=""){
    $cmd = " And tbl_hardware_onhand_user.from_site_id <> ''";
}
$sql = $sql.$cmd;
$rs = mysqli_query($conn,$sql);
	while($c = mysqli_fetch_array($rs)){
        		$str = $c["cnt"];
	}
return $str;

}


function getCntSafetyStockRepair($cate_id,$status){
	global $conn;
$sql = "SELECT
count(tbl_hardware_onhand_user.hardware_status) as cnt
FROM
tbl_hardware_onhand_user
Where tbl_hardware_onhand_user.cate_id in ('$cate_id')
And tbl_hardware_onhand_user.hardware_status = '$status'";
$rs = mysqli_query($conn,$sql);
	while($c = mysqli_fetch_array($rs)){
		$str = $c["cnt"];
	}
return $str;

}









?>
