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
        ?>
        <form action="add_serial_retail.excute.php"  method="post"  name="form1" id="form1"  >
        <input type="hidden" value="<?=$site_id?>" name="site_id" id="site_id">         
        
        <table align="center" bordercolor="#000000" cellpadding="0" cellspacing="0"  class="mytable" id="table7" border="0" width="100%">       
                    <tr>
                        <td width="95%">&nbsp;</td>
                        <td><input name="Submit"  type="image" onClick=" return CheckText()"  src="image/save.jpg" alt="Save" align="right" width="20" height="20" />    </td>
                       <td align="left"><b>บันทึก</b>    </td>
                       <td><a href="javascript:window.close()" ><img src="image/cancel.jpg" alt="Cancel" width="20" height="18" border="0" align="left" /> </a> </td>
                       <td align="left"><nobr><b> ยกเลิก</b>     </td>
                     </tr>
         </table>
         <table align="center" bordercolor="#000000"  cellpadding="0" cellspacing="0"    class="mytable" id="table7" border="1" width="60%">
                    <tr>                                                                   
                        <th width="35%" height="40" class="th" align="center">Category</th> 
                        <th width="20%" height="40" class="th" align="center">Installation Date</th> 
                        <th width="20%" height="40" class="th" align="center">Expire Date</th> 
                        <th width="25%" height="40" class="th" align="center">Serial No.</th>                                    
                     </tr>
                <tr  onmouseover="this.style.backgroundColor='violet';" onMouseOut="this.style.backgroundColor='white';" >      
                                                                            
                          <td width="30%" align="left" class="fontBblue">
				<select name="cate" id="cate">
					<?
					$sql_cate = "SELECT
						tbl_category_hardware.cate_id,
						tbl_category_hardware.cate_name
					FROM
						tbl_category_hardware
					Where tbl_category_hardware.owner_by not in ('PTT')
					And tbl_category_hardware.cate_id not in ('15')";
					$res_cate = mysqli_query($conn,$sql_cate);
					while($c_cate = mysqli_fetch_array($res_cate)){?>
						<option value="<?=$c_cate['cate_id'];?>"><?=$c_cate["cate_name"];?></option>
					<?}?>				
				</select>
			  </td>
		<td align="left" class="fontBblue"><input type="text" name="indate" id="indate" onclick="cdp1.showCalendar(this, 'indate'); return false;" readonly="readonly"></td>
		<td align="left" class="fontBblue"><input type="text" name="exdate" id="exdate" onclick="cdp1.showCalendar(this, 'exdate'); return false;" readonly="readonly"></td>

                          <td width="30%" align="left" class="fontBblue"><input name="sn" id="sn" ></td> 
                </tr ><tr><td>&nbsp;</td><td>&nbsp;</td></tr >
            <?
$sql_select = "SELECT
						tbl_hardware_onhand_user.user_id,
						tbl_hardware_onhand_user.cate_id,
						tbl_hardware_onhand_user.hardware_no,
						tbl_hardware_onhand_user.installation_date,
						tbl_hardware_onhand_user.expired_date,
						tbl_category_hardware.cate_name
					FROM
						tbl_hardware_onhand_user
					Inner Join tbl_category_hardware ON tbl_hardware_onhand_user.cate_id = tbl_category_hardware.cate_id
					Where tbl_hardware_onhand_user.user_id = '$site_id'					
					Order by tbl_category_hardware.cate_name";

		$sql_select = mysqli_query($conn,$sql_select);
		while($c = mysqli_fetch_array($sql_select)){?>
		
		<tr onmouseover="this.style.backgroundColor='violet';" onMouseOut="this.style.backgroundColor='white';" >   
			<td width="30%" align="left"><?=$c["cate_name"]?></td>
			<td width="30%" align="left"><?=$c["installation_date"]?></td>
			<td width="30%" align="left"><?=$c["expired_date"]?></td>
                        		<td width="30%" align="left"><?=$c["hardware_no"]?></td> 
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


<table id="calendarTable">
    <tbody id="calendarTableHead">
        <tr>
            <td colspan="4" align="left">
                <select id="selectMonth">
                    <option value="0">January</option>
                    <option value="1">February</option>
                    <option value="2">March</option>
                    <option value="3">April</option>
                    <option value="4">May</option>
                    <option value="5">June</option>
                    <option value="6">July</option>
                    <option value="7">August</option>
                    <option value="8">September</option>
                    <option value="9">October</option>
                    <option value="10">November</option>
                    <option value="11">December</option>
                </select>
            </td>
            <td colspan="2" align="center"><select id="selectYear"></select></td>
            <td align="right"><a href="#" id="closeCalendarLink">X</a></td>
        </tr>
    </tbody>
    <tbody id="calendarTableDays">
        <tr id="calenderDaysIndex">
            <td>Su</td><td>Mo</td><td>Tu</td><td>We</td><td>Thu</td><td>Fr</td><td>Sa</td>
        </tr>
    </tbody>
    <tbody id="calendar"></tbody>
</table>




