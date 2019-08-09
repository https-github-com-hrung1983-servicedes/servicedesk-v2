<?
header("Content-Type: text/html; charset=tis-620");
session_start();
require_once("function.php");
  if(!checkUser()){    echo Message(35,"red",$titel1,$msg1,"<a href='index.php?link=change.sparepartfor'> $login </a>");
  exit;
  }
$id = $_REQUEST["id"];
$type=$_REQUEST["type"];

$sql = "SELECT
	    tbl_hardware_onhand_user.id,
	    tbl_hardware_onhand_user.hardware_no,
	    tbl_hardware_onhand_user.cate_id,
	    tbl_category_hardware.cate_name,
	    tbl_hardware_onhand_user.sparepartfor
	FROM
	    tbl_hardware_onhand_user
	Inner Join tbl_category_hardware ON tbl_category_hardware.cate_id = tbl_hardware_onhand_user.cate_id
	Where tbl_hardware_onhand_user.id = '$id'"; 
	$rs = mysqli_query($conn,$sql);
	$c = mysqli_fetch_array($rs);

?>

<title>Bizserv Solution Co.,Ltd</title>
<link href="image/bss_icon.ico" rel="shortcut icon" />
<link href="style/calendar.css" rel="stylesheet" type="text/css">
<link href="style/mytable.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="script/calendar_date_picker.js"></script>
<link href="style/stylecss.css" rel="stylesheet" type="text/css">
<link href="style/filtergrid.css" rel="stylesheet" type="text/css">

<style type="text/css">
    <!--
    .mytable1 {    width:100%; font-size:12px;
                border:1px solid #ccc;
                font-size:11px;
    }
    .mytable11 {width:100%; font-size:12px;
                border:1px solid #ccc;
                font-size:11px;
    }
   .th{ background-color:#003366; color:#FFF; padding:0px; border:0px solid #ccc; height:20px; }
    -->
</style>
<link href="css/loading.css" rel="stylesheet" type="text/css" media="all">

<script src="script/jquery.min.js"></script>
<script src="script/thickbox.js"></script>
<script src="script/loading.js"></script>

<script type="text/javascript" src="script/jquery-1.6.4.js"></script>
<script type="text/javascript" src="script/jquery_1.7.1_min.js"></script>
<script>
	$("#Save").click(function(){
				var id = $("#id").attr('value');
				var sparepartfor = encodeURIComponent($("#sparepartfor").attr('value')); 
	    
	    
			$.post('function.execute.php',{ mode : "change.sparepartfor", id: id,sparepartfor:sparepartfor},
			function(data) {
			//alert(data);
					window.parent.location.href ="change.sparepartfor.php?id="+Math.random(100*1000,1000/2);
				});
			return false;
		});
</script>

<table align="center" class="mytable" id="table" height="70%"   cellpadding="1" cellspacing="1">
    <tr>
        <td valign="top" align="center">
            <form action="#"  method="post"  name="form1" id="form1"  >
			<input  type="hidden" value="<?=$id?>" name="id_rep" id="id_rep" />
                <table border="0" cellpadding="0" cellspacing="0" class="mytable" border="1"  bordercolor="#FF0000">

                    <tr>
                        <td bgcolor="white" width="95%" align="right" colspan="2" >
				<input name="Save" id="Save"  type="image" src="image/save.jpg" alt="Save" align="right" width="20" height="20" />  </td>
                       <td align="left" bgcolor="white" width="10%"><b>Save</b>
			</td>
			<td bgcolor="white" align="right">
			<!--input name="Delete" id="Delete"  type="image" src="image/delete.gif" alt="Delete" align="right" width="20" height="20" /-->    </td>
                       <td align="left" bgcolor="white" width="10%"><!--b>Delete</b--->    </td>
                     </tr>
					 <tr>
                      <td height="25" bgcolor="white" width="30%" align="left" class="fontBblue" >&nbsp;&nbsp;<nobr>Category Hardware  :  </td>
                      <td height="25" bgcolor="white" width="70%" align="left" class="fontBblue" colspan="4" >
			    <select name="cate_id" id="cate_id" style="width:250pt">
				<option value=""><?=$c["cate_name"]?></option>
			    </select>
			</td>                  
		</tr>
		<tr>
                      <td height="25" bgcolor="white" width="30%" align="left" class="fontBblue" >&nbsp;&nbsp;Serial No.  :  </td>
                      <td height="25" bgcolor="white" width="70%" align="left" class="fontBblue" colspan="4" >
				 <input name="serialno" id="serialno" style="width:250pt" value="<?=$c["hardware_no"]?>" readonly="readonly" >
		    </td>
		</tr>		
		
		<tr>
                      			<td height="25" bgcolor="white" width="30%" align="left" class="fontBblue" >&nbsp;&nbsp;SparePart For  :  </td>
                      			<td height="25" bgcolor="white" width="70%" align="left" class="fontBblue" colspan="4" >
					    <select name="sparepartfor" id="sparepartfor"   style="width:250pt"  >
						<? $sql_sparepartfor = "SELECT customer_id,customer_name FROM tbl_customer Order by customer_name";
						   $rs_sparepartfor = mysqli_query($conn,$sql_sparepartfor);
						   while($c_sparepartfor = mysqli_fetch_array($rs_sparepartfor)){
						?>		    
						    <option value="<?=$c_sparepartfor["customer_id"]?>" <? if($c_sparepartfor["customer_id"]==$c["sparepartfor"]) echo "selected";?> ><?=$c_sparepartfor["customer_name"]?></option>
						<?}?>
					</select></td>
                    </tr>
                </table>
            </form></td></tr></table>
