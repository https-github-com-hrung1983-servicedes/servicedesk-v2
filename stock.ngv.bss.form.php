<meta http-equiv=Content-Type content="text/html; charset=utf-8">
<? 
session_start();                 

require_once("function.php");           
require_once("script/function.js");  
  
  if(!checkUser()){    echo Message(35,"red",$titel1,$msg1,"<a href='index.php?link=stock.ngv.bss.form'> $login </a>");         
  exit;
  }    
  include("header.php"); 
	$cate_id = $_REQUEST["id"]; 
  $typer = $_REQUEST["typer"];  
  $status = $_REQUEST["status"];    
             
?>
  <html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874"> 
<link rel="stylesheet" href="style.css">
<script language="javascript" src="script.js"></script>    

   <link href="style/mytable.css" rel="stylesheet" type="text/css" />
<title>Bizserv Solution Co.,Ltd.</title></head>
  <style type="text/css">
    <!--
   .th{ background-color:#003366; color:#FFF; padding:0px; border:0px solid #ccc; height:20px; }  
    -->
</style> 
<body  >
<center>
<table align="center" bordercolor="#000000" class="mytable"  border="1" width="60%">

                <tr>
                      <th class="th" ><nobr>#</th> 
                      <th class="th" ><nobr>Hardware</th> 
                      <th class="th" ><nobr>Brand</th>  
		                  <th class="th" ><nobr>&nbsp;<nobr>Serial No.</th>    
		                  <th class="th" ><nobr>&nbsp;<nobr>From Site</th>    
             </tr>
          <? 
$sql = "SELECT 
			tbl_hardware_onhand_user.hardware_brand,
			tbl_hardware_onhand_user.hardware_no,
			tbl_hardware_onhand_user.cate_id,
			tbl_hardware_onhand_user.hardware_status,
			tbl_category_hardware.cate_name,
tbl_hardware_onhand_user.from_site_id
		FROM
		tbl_hardware_onhand_user
		Inner Join tbl_category_hardware On tbl_hardware_onhand_user.cate_id = tbl_category_hardware.cate_id";


if($typer=="c0") {
		$sql .= " Where tbl_hardware_onhand_user.cate_id in ('$cate_id') And tbl_hardware_onhand_user.user_id in (77,91,137,154,228,237,166,224)
		And tbl_hardware_onhand_user.hardware_status = 'o'"; 
} else if($typer=="s" || $typer=="a" || $typer=="r" || $typer=="i") {
		$sql .= " Where tbl_hardware_onhand_user.cate_id in ('$cate_id') And tbl_hardware_onhand_user.hardware_status = '$typer'";
} else if($typer=="bycat"){
		$sql .= " Where tbl_hardware_onhand_user.cate_id in ('$cate_id') And tbl_hardware_onhand_user.hardware_status in ('s','a','r','i','o') ";
} else {
		$sql .= " Where tbl_hardware_onhand_user.cate_id in ('$cate_id') And tbl_hardware_onhand_user.user_id in ('$typer')
		And tbl_hardware_onhand_user.hardware_status = 'o'"; 
} 




$sql .= " order by hardware_status";

//echo $sql;

$res = mysqli_query($conn,$sql);
$i = 1;
while( $row = mysqli_fetch_array($res)){ 
if($row["from_site_id"] == "" && $status == "a") {           
    echo "<tr onmouseover=this.style.backgroundColor='violet'; onmouseout=this.style.backgroundColor='white';>";                    
    echo"<td  style='padding:0px; border-bottom:1px solid #ccc; border-right:0px solid #ccc;' align='center'><b>$i</b></td> ";              
    echo"<td  style='padding:0px; border-bottom:1px solid #ccc; border-right:0px solid #ccc;'>&nbsp;&nbsp;$row[cate_name]</td> ";             
    echo"<td  style='padding:0px; border-bottom:1px solid #ccc; border-right:0px solid #ccc;'>&nbsp;&nbsp;$row[hardware_brand]</td> ";         
    echo"<td  style='padding:0px; border-bottom:1px solid #ccc; border-right:0px solid #ccc;'>&nbsp;&nbsp;$row[hardware_no]</td> ";           
    echo"<td  style='padding:0px; border-bottom:1px solid #ccc; border-right:0px solid #ccc;'>&nbsp;&nbsp;$row[from_site_id]</td> "; 
} else if($row["from_site_id"] != "" && $status == "r") {   
    echo "<tr onmouseover=this.style.backgroundColor='violet'; onmouseout=this.style.backgroundColor='white';>";                         
    echo"<td  style='padding:0px; border-bottom:1px solid #ccc; border-right:0px solid #ccc;' align='center'><b>$i</b></td> ";              
    echo"<td  style='padding:0px; border-bottom:1px solid #ccc; border-right:0px solid #ccc;'>&nbsp;&nbsp;$row[cate_name]</td> ";             
    echo"<td  style='padding:0px; border-bottom:1px solid #ccc; border-right:0px solid #ccc;'>&nbsp;&nbsp;$row[hardware_brand]</td> ";         
    echo"<td  style='padding:0px; border-bottom:1px solid #ccc; border-right:0px solid #ccc;'>&nbsp;&nbsp;$row[hardware_no]</td> ";           
    echo"<td  style='padding:0px; border-bottom:1px solid #ccc; border-right:0px solid #ccc;'>&nbsp;&nbsp;$row[from_site_id]</td> "; 
}else if($row["from_site_id"] == "" && $status == "rrr") {      
    echo "<tr onmouseover=this.style.backgroundColor='violet'; onmouseout=this.style.backgroundColor='white';>";                      
    echo"<td  style='padding:0px; border-bottom:1px solid #ccc; border-right:0px solid #ccc;' align='center'><b>$i</b></td> ";              
    echo"<td  style='padding:0px; border-bottom:1px solid #ccc; border-right:0px solid #ccc;'>&nbsp;&nbsp;$row[cate_name]</td> ";             
    echo"<td  style='padding:0px; border-bottom:1px solid #ccc; border-right:0px solid #ccc;'>&nbsp;&nbsp;$row[hardware_brand]</td> ";         
    echo"<td  style='padding:0px; border-bottom:1px solid #ccc; border-right:0px solid #ccc;'>&nbsp;&nbsp;$row[hardware_no]</td> ";           
    echo"<td  style='padding:0px; border-bottom:1px solid #ccc; border-right:0px solid #ccc;'>&nbsp;&nbsp;$row[from_site_id]</td> "; 
} else  if($status == "rr") {  
    echo "<tr onmouseover=this.style.backgroundColor='violet'; onmouseout=this.style.backgroundColor='white';>"; 
    echo"<td  style='padding:0px; border-bottom:1px solid #ccc; border-right:0px solid #ccc;' align='center'><b>$i</b></td> ";              
    echo"<td  style='padding:0px; border-bottom:1px solid #ccc; border-right:0px solid #ccc;'>&nbsp;&nbsp;$row[cate_name]</td> ";             
    echo"<td  style='padding:0px; border-bottom:1px solid #ccc; border-right:0px solid #ccc;'>&nbsp;&nbsp;$row[hardware_brand]</td> ";         
    echo"<td  style='padding:0px; border-bottom:1px solid #ccc; border-right:0px solid #ccc;'>&nbsp;&nbsp;$row[hardware_no]</td> ";           
    echo"<td  style='padding:0px; border-bottom:1px solid #ccc; border-right:0px solid #ccc;'>&nbsp;&nbsp;$row[from_site_id]</td> "; 
} else {
  echo "<tr onmouseover=this.style.backgroundColor='violet'; onmouseout=this.style.backgroundColor='white';>"; 
    echo"<td  style='padding:0px; border-bottom:1px solid #ccc; border-right:0px solid #ccc;' align='center'><b>$i</b></td> ";              
    echo"<td  style='padding:0px; border-bottom:1px solid #ccc; border-right:0px solid #ccc;'>&nbsp;&nbsp;$row[cate_name]</td> ";             
    echo"<td  style='padding:0px; border-bottom:1px solid #ccc; border-right:0px solid #ccc;'>&nbsp;&nbsp;$row[hardware_brand]</td> ";         
    echo"<td  style='padding:0px; border-bottom:1px solid #ccc; border-right:0px solid #ccc;'>&nbsp;&nbsp;$row[hardware_no]</td> ";           
    echo"<td  style='padding:0px; border-bottom:1px solid #ccc; border-right:0px solid #ccc;'>&nbsp;&nbsp;$row[from_site_id]</td> "; 
}
 $i++;              
            ?>         
        </tr>
        <?}?>
</table>
        
</center>
</body>
</html>

