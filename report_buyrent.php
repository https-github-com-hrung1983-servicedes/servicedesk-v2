<?
header("Content-Type: text/html; charset=tis-620");
header("content-type: application/x-javascript; charset=TIS-620");
session_start();
require_once("function.php");

include("header.php");

$schBR=$_REQUEST["schBR"];
if($schBR==""){
  $schBR="B";
}
//echo $schBR;
?>
<title>Bizserv Solution Co.,Ltd</title>
<script src="script/jquery.min.js"></script>
<script src="script/thickbox.js"></script>
<script src="script/loading.js"></script>
<script type="text/javascript" src="script/jquery-1.6.4.js"></script>
<script type="text/javascript" src="script/jquery_1.7.1_min.js"></script>
<meta http-equiv=Content-Type content="text/html; charset=tis-620">
<link href="css/loading.css" rel="stylesheet" type="text/css" media="all">
<link href="image/bss_icon.ico"   rel="shortcut icon" />
<link href="style/calendar.css" rel="stylesheet" type="text/css">
<link href="style/mytable.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="script/calendar_date_picker.js"></script>
<link href="style/stylecss.css" rel="stylesheet" type="text/css">
<link href="style/filtergrid.css" rel="stylesheet" type="text/css">
<style>
.mytable1 {
  width:100%;
  border:1px solid #ccc;
  font-size:12px;
}
.mytable1 td{
  padding:0px;
  border-bottom:1px solid #ccc;
  border-right:1px solid #ccc;
  border-color:#003366;
}
.mytable11 {width:100%; font-size:14px;
                border:1px solid #ccc;
                font-size:11px;
}
.mytable1 th{ background-color:#003366; color:#FFF; padding:0px; border:0px solid #ccc; height:20px; }
    -->
.rowtr:hover{
  background-color: violet;
}
</style>
<div>

</div>
<form action="" method="get" id="form1">
<select name="schBR" id="schBr" style="width:150px;">
  <option value="B" <? if($schBR=="B"){ echo "selected";}?> >Buy</option>
  <option value="R" <? if($schBR=="R"){ echo "selected";}?> >Rent</option>
</select>
<button type="submit" form="form1" value="Submit">Search</button>
</form>
<table class="mytable1" id="table7" CELLPADDING="1" CELLSPACING="1">
  <tr>
    <th>#</th>
    <th>Category</th>
    <th>Brand</th>
    <th>Series</th>
    <th>Lot</th>
    <th>Owner By</th>
    <th>Type</th>
  </tr>
<?
$i=0;
$sql="select b.cate_name,a.hardware_brand,a.hardware_no,a.comment_lot,a.owner_by,a.hardware_type from tbl_hardware_onhand_user a
      left outer join tbl_category_hardware b on a.cate_id=b.cate_id
      where a.hardware_type='$schBR'
      order by a.dte_tme_form_stock DESC
      ";
$rs = mysqli_query($conn,$sql);
while($c = mysqli_fetch_array($rs)) {
  $i++;


?>
  <tr class="rowtr">
    <td align="center"><?=$i?></td>
    <td><?=$c["cate_name"]?></td>
    <td><?=$c["hardware_brand"]?></td>
    <td><?=$c["hardware_no"]?></td>
    <td><? echo iconv( 'UTF-8', 'TIS-620', $c["comment_lot"]) ?></td>
    <td><?=$c["owner_by"]?></td>
    <td><? if($c["hardware_type"]=="B"){ echo "Buy";}
           if($c["hardware_type"]=="R"){ echo "Rent";}
     ?></td>
  </tr>
<? } ?>
<tr>
  <td colspan="7">
    total <?=$i?>
  </td>
</tr>
