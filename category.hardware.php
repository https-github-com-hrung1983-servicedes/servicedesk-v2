<?
header("Content-Type: text/html; charset=tis-620");
session_start();
require_once("function.php");
  if(!checkUser()){    echo Message(35,"red",$titel1,$msg1,"<a href='index.php?link=hw.onhand.entry'> $login </a>");
  exit;
  }
  require_once("header.php");
  
$id = $_REQUEST["id"];
$sql = "SELECT cate_id,cate_name,cate_active
	FROM
	tbl_category_hardware
	order by cate_name"; //echo $sql;
	$rs = mysqli_query($conn,$sql);
?>

<title>Bizserv Solution Co.,Ltd</title>
<link href="image/bss_icon.ico" rel="shortcut icon" />
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
<link href="css/loading.css" rel="stylesheet" type="text/css" media="all">

<script src="script/jquery.min.js"></script>
<script src="script/thickbox.js"></script>
<script src="script/loading.js"></script>

<script type="text/javascript" src="script/jquery-1.6.4.js"></script>
<script type="text/javascript" src="script/jquery_1.7.1_min.js"></script>
<div align="right"><a href="category.hardware.ui.php?type=add">Add</a></div>
<table align="center" class="mytable" id="table" height="70%"   cellpadding="1" cellspacing="1">
    <tr>
        <th class="th" valign="top" align="center">ID</th>
        <th class="th" valign="top" align="center">Description</th>
        <th class="th" valign="top" align="center">Status</th>  
    </tr>
    <?php 
    $row=1;
         while($c=mysqli_fetch_array($rs)){
        ?>
        <tr  onclick="click2edit(<?=$c["cate_id"];?>,'edit');" onmouseover="this.style.backgroundColor='violet';" onmouseout="this.style.backgroundColor='white';" >
            <td style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc; border-color:#003366;" align="center"><?php echo $row++;?></td>
            <td style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc; border-color:#003366;">&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $c["cate_name"];?></td>
            <td style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc; border-color:#003366;" align="center"><?php echo $c["cate_active"]?></td>  
        </tr>
    <?php }?>
</table>

<script type="text/javascript">       
      function click2edit(id,typer){    
		 parent.parent.location.href ="category.hardware.ui.php?id="+id+"&type="+typer;  
      }
</script>


























