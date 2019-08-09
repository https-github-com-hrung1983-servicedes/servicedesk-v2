<?
header("Content-Type: text/html; charset=tis-620");
session_start();
require_once("function.php");
  if(!checkUser()){    echo Message(35,"red",$titel1,$msg1,"<a href='index.php?link=hw.waitrepair.add.serial'> $login </a>");
  exit;
  }
$type = $_REQUEST["type"];
$id = $_REQUEST["id"];
if($type=="edit"){
 $sql = "SELECT brand_id,brand_name,active
 FROM
 tbl_category_brand
      Where brand_id = $id";
    //  echo $sql;
   $rs = mysqli_query($conn,$sql);
   $c = mysqli_fetch_array($rs);
}
require_once("header.php");
?>

<title>Bizserv Solution Co.,Ltd</title>
<link href="image/bss_icon.ico" rel="shortcut icon" />
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
    
</style>
<link href="css/loading.css" rel="stylesheet" type="text/css" media="all">

<script src="script/jquery.min.js"></script>
<script src="script/thickbox.js"></script>
<script src="script/loading.js"></script>

<script type="text/javascript" src="script/jquery-1.6.4.js"></script>
<script type="text/javascript" src="script/jquery_1.7.1_min.js"></script>
<table align="center" class="mytable" id="table" height="70%"   cellpadding="1" cellspacing="1">
    <tr>
        <td valign="top" align="center">
            <form action="category.brand.execute.php"  method="post"  name="form1" id="form1"  >

			<input  type="hidden" value="<?php echo $id?>" name="id" id="id" />
                <table border="0" cellpadding="0" cellspacing="0" class="mytable" border="1"  bordercolor="#FF0000">

                    <tr>
                        <td bgcolor="white" width="95%" align="right" colspan="2" >
						<input name="Save" id="Save"  type="image" src="image/save.jpg" alt="Save" align="right" width="20" height="20" />    </td>
                       <td align="left" bgcolor="white" width="10%"><b>Save</b>    </td>
                     </tr>
					 <tr>
                      <td height="25" bgcolor="white" width="30%" align="right" class="fontBblue" >&nbsp;&nbsp;<nobr>Category Description  :  &nbsp;&nbsp;</td>
                      <td height="25" bgcolor="white" width="70%" align="left" class="fontBblue"> 
                        <input type="text" value="<?php echo $c["brand_name"];?>" id="catedesc" name="catedesc"  style="width:350pt" colspan="2">
                      </td>
                    </tr>
					<tr>
                      <td height="25" bgcolor="white" width="30%" align="right" class="fontBblue" >&nbsp;&nbsp;Active.  :  &nbsp;&nbsp;</td>
                      <td height="25" bgcolor="white" width="70%" align="left" class="fontBblue" colspan="2" >
			   <select name="stractive" id="stractive" style="width:250pt" >
                                    <option value="y" <?php if($c["active"]=="y") echo "selected";?>>Y</option>
                                   <option value="n" <?php if($c["active"]=="n") echo "selected";?>>N</option>
                         </select></td>
		    </tr>
		   
	       <tr><td height="25" bgcolor="white"  colspan="3" >&nbsp;</td></tr>
                </table>
            </form></td></tr></table>
