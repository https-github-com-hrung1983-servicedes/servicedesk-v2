<?
session_start();
require_once("function.php");

  if(!checkUser()){    echo Message(35,"red",$titel1,$msg1,"<a href='index.php'> $login </a>");
  exit;
  }

include("header.php");                    
?>

<link href="image/bss_icon.ico"   rel="shortcut icon" />  
<link href="style/calendar.css" rel="stylesheet" type="text/css">    
<link href="style/mytable.css" rel="stylesheet" type="text/css" />   
<script type="text/javascript" src="script/calendar_date_picker.js"></script>     
<link href="style/stylecss.css" rel="stylesheet" type="text/css">
<link href="style/filtergrid.css" rel="stylesheet" type="text/css">
<style type="text/css">

    .mytable1 {    width:100%; font-size:12px;
                border:1px solid #ccc;
                font-size:11px;     
    }
    .mytable11 {width:100%; font-size:12px;                                                               
                border:1px solid #ccc;
                font-size:11px;     
    }
   .th{ background-color:#003366; color:#FFF; padding:0px; border:0px solid #ccc; height:20px; }
   .trhover:hover{
    background-color:violet; 
   }
   .trtotal{
    background-color: #ccc;
   }
   .warry{
            width: 500px;
            font-size: 12px;
            margin: 0 auto;
            border : solid;
            padding: 20px;
   }

</style>

<div style="width: 100%; text-align: center;">
<form action="edit_warranty.php">  
<select name="sch_lot">
            <option value="0" >--Select--</option>
<?
$lot_sch=$_REQUEST["sch_lot"];

$sql_lot="select distinct a.comment_lot from tbl_hardware_onhand_user a
            where a.comment_lot !='' ";
$rs_lot = mysqli_query($conn,$sql_lot);
while($c_lot = mysqli_fetch_array($rs_lot)){
?>    
            <option value="<?=$c_lot["comment_lot"]?>" <? if($lot_sch==$c_lot["comment_lot"]) echo "selected";?>><?=$c_lot["comment_lot"]?></option>
<? } ?>
</select>

<input type="submit" value="Search">
</form>
<?

$sql_lot_select="select a.comment_lot,a.warranty_hardware_type_date,a.expired_hardware_type_date
                            from tbl_hardware_onhand_user a
                            where comment_lot = '".$lot_sch."'
                            ";
$rs_lot_select= mysqli_query($conn,$sql_lot_select);
$c_lot_select = mysqli_fetch_array($rs_lot_select);  ?>
<? if($lot_sch!=""){ ?>

<form action="edit_warranty.action.php">
<table class="warry">
         <tr>
            <td width="30%" align="right">Hardware Lot :</td>
            <td><input type="text" name="lot" value="<?=$c_lot_select["comment_lot"]?>" readonly style="width: 250px"></td>
         </tr>
         <tr>
            <td align="right">Warranty Date :</td>
            <td><input type="date" name="warr" value="<?=$c_lot_select["warranty_hardware_type_date"]?>"></td>
         </tr>
         <tr>
            <td align="right">Expired Date :</td>
            <td><input type="date" name="expried" value="<?=$c_lot_select["expired_hardware_type_date"]?>"></td>
         </tr>
         <tr>
            <td colspan="2" align="center"><input type="submit" value="Save" onclick="return confirm('Are you sure?');"></td>
         </tr>
</table>
</form>
<? } ?>

</div>

