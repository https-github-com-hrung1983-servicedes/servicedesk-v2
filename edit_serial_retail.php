<? 
session_start();                 
header("Content-Type: text/html; charset=tis-620");

require_once("function.php");           
require_once("script/function.js");  
  
  if(!checkUser()){    echo Message(35,"red",$titel1,$msg1,"<a href='index.php'> $login </a>");
  exit;
  }                                 
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
<body  >
<br>
<center>
        <?
        	$site_id = $_REQUEST["id"];  
	$user_engineer = $_REQUEST["user_engineer"]; 		
        ?>
        <form action="edit_serial_retail.excute.php"  method="post"  name="form1" id="form1"  >
        <input class="form-control"  type="hidden" value="<?=$site_id?>" name="site_id" id="site_id">         
        
        <table align="center" bordercolor="#000000" cellpadding="0" cellspacing="0"  class="mytable" id="table7" border="0" width="100%">       
                    <tr>
                        <td width="95%">&nbsp;</td>
                        <td><input class="form-control"  name="Submit"  type="image" onClick=" return CheckText()"  src="image/save.jpg" alt="Save" align="right" width="20" height="20" />    </td>
                       <td align="left"><b>บันทึก</b>    </td>
                       <td><a href="javascript:window.close()" ><img src="image/cancel.jpg" alt="Cancel" width="20" height="18" border="0" align="left" /> </a> </td>
                       <td align="left"><nobr><b> ยกเลิก</b>     </td>
                     </tr>
         </table>
         <table align="center" bordercolor="#000000"  cellpadding="0" cellspacing="0"    class="mytable" id="table7" border="1" width="60%">
                    <tr>                                                                   
                        <th width="40%" height="40" class="th" align="center">Category</th> 
                        <th width="30%" height="40" class="th" align="center">Old Serial No.</th> 
                        <th width="30%" height="40" class="th" align="center">New  Serial No.</th>                                  
                     </tr>
                <tr><td>&nbsp;</td><td>&nbsp;</td></tr >
            <?
$sql_select = "SELECT
						tbl_hardware_onhand_user.user_id,
						tbl_hardware_onhand_user.cate_id,
						tbl_hardware_onhand_user.hardware_no,
						tbl_category_hardware.cate_id,
						tbl_category_hardware.cate_name
					FROM
						tbl_hardware_onhand_user
					Inner Join tbl_category_hardware ON tbl_hardware_onhand_user.cate_id = tbl_category_hardware.cate_id
					Where tbl_hardware_onhand_user.user_id = '$site_id'					
					Order by tbl_category_hardware.cate_name";

		$sql_select = mysqli_query($conn,$sql_select);
		while($c = mysqli_fetch_array($sql_select)){?>
		
		<tr onmouseover="this.style.backgroundColor='violet';" onMouseOut="this.style.backgroundColor='white';" >   
			<td width="30%" align="left" class="fontBblue">&nbsp;&nbsp;&nbsp;&nbsp;
				<select name="cate" id="cate"  style="width:200pt">
					<option value="<?=$c['cate_id'];?>" ><?=$c['cate_name'];?></option>			
				</select>
			  </td>
			<td width="30%" align="center"><input class="form-control"  type="text" value="<?=$c["hardware_no"]?>" ></td>
                        		<td width="30%" align="center"><select name="sn_new" id="sn_new"  style="width:150pt" >
					<?
						$sql_sn = "SELECT
							tbl_hardware_onhand_user.id,
							tbl_hardware_onhand_user.hardware_no
						FROM
							tbl_hardware_onhand_user
						Where tbl_hardware_onhand_user.owner_by = 'BSS'
						And tbl_hardware_onhand_user.user_id = '$user_engineer'";
					$rs_sn = mysqli_query($conn,$sql_sn);
					while ($c_sn = mysqli_fetch_array($rs_sn)){
					?>
						<option value="<?=$c_sn["id"]?>"><?=$c_sn["hardware_no"]?></option>
					<?}?>
			</select></td> 
                </tr >
		<?} ?>
        </table>
      </form>  
</center>
</body>
</html>
<script type="text/javascript">
var props = {	formatDate :		'%m-%d-%y'	};
    props.formatDate = '%y-%m-%d';
    var cdp1 = new CalendarDatePicker(props); 


  function CheckText(){
        if(document.form1.site_id.value == "") {
            alert('กรุณากรอก Site ID ด้วยนะคับ');
            document.form1.site_id.focus();
            return false;
        } 
        if(document.form1.sn.value == "") {
            alert('กรุณากรอก S/N ด้วยนะครับ');
            document.form1.sn.focus(); 
            return false;
        } 
        return true;
    } 

</script>



