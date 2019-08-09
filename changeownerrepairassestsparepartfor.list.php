<?
header("Content-Type: text/html; charset=tis-620");
header("content-type: application/x-javascript; charset=TIS-620");   
session_start();
require_once("function.php");

include("header.php");  
$cate_id = $_REQUEST["cate_id"];
$sql = "SELECT
tbl_hardware_onhand_user.id,
tbl_hardware_onhand_user.user_id,
tbl_hardware_onhand_user.hardware_no,
tbl_hardware_onhand_user.repair_by,
tbl_hardware_onhand_user.owner_by,
tbl_hardware_onhand_user.asset_by,
tbl_hardware_onhand_user.sparepartfor,
tbl_hardware_onhand_user.comment_lot,
tbl_hardware_onhand_user.cate_id
FROM
tbl_hardware_onhand_user
Where tbl_hardware_onhand_user.cate_id = '$cate_id' And tbl_hardware_onhand_user.hardware_status in ('a','r','o','w','i','l') 
Order by tbl_hardware_onhand_user.user_id,tbl_hardware_onhand_user.comment_lot"; //And fix_change = '0'
$rs = mysqli_query($conn,$sql);
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
<script type="text/javascript">
$(document).ready(function() {
    $('#selecctall').click(function(event) {  //on click 
        if(this.checked) { // check select status
            $('.checkbox1').each(function() { //loop through each checkbox
                this.checked = true;  //select all checkboxes with class "checkbox1"               
            });
        }else{
            $('.checkbox1').each(function() { //loop through each checkbox
                this.checked = false; //deselect all checkboxes with class "checkbox1"                       
            });         
        }
    });
        

});

</script>
<style type="text/css">
    <!--
    .mytable1 {	width:100%; font-size:12px;
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
<form  method="post" name="form1" id="form1" action="changeownerrepairassestsparepartfor.execute.php"> 
             
<table width="100%" align="center" class="mytable" id="table" height="100%"   cellpadding="1" cellspacing="1">
    <tr>                                               
        <td valign="top">                                                       
                <table width="100%"  border="0" cellpadding="0" cellspacing="0" class="mytable" border="1" bordercolor="#FF0000">
					  <tr>
       					<td width="95%" colspan="2" align="center">&nbsp;  Category :
						   <select name="cate_id" id="cate_id" OnChange="window.location='?cate_id='+this.value;">
		<?
		//Where 
//tbl_category_hardware.cate_id in ('1','30','25','3','4','2','36','6','8','10','69','9','7','37','45','31','27','11','12','13','66','60','61','62','67','68','73','16','139','140') 


				   $sql_cate = "SELECT
tbl_category_hardware.cate_id,
tbl_category_hardware.cate_name
FROM
tbl_category_hardware
where cate_active = 'y'
Order by tbl_category_hardware.cate_name";

//where tbl_category_hardware.cate_id in ('1','2','3','4','6','7','8','9','10','11','12','13','16','25','27','31',
//'30','36','37','45','70','132','139','140','143','150','154','162','164','185','193','199','201','203','204','206')

$rs_cate = mysqli_query($conn,$sql_cate);
while($c_cate = mysqli_fetch_array($rs_cate)){
				   ?>
						
										<option value="<?=$c_cate["cate_id"]?>" <? if($c_cate["cate_id"]==$cate_id) echo "selected";?>><?=$c_cate["cate_name"]?></option>
<?}?>
								</select>&nbsp;
								Repair By : 
										<select name="repair_by" id="repair_by">
											<option value="BSS">BSS</option>
											<option value="MSI">MSI</option>
											<option value="Ricoh">Ricoh</option>
											<option value="Bhomthai">Bhomthai</option>
											<option value="Chawpaya">Chawpaya</option>
											<option value="Nimble">Nimble</option>
											<option value="SNS">SNS</option>
											<option value="FLOWCO">FLOWCO</option>
											<option value="NavaDC">Navanakorn(DC)</option>
										</select>
								Owner By: 
								<select name="owner_by" id="owner_by">
									<option value="BSS">BSS</option>
									<option value="MSI">MSI</option>
									<option value="Ricoh">Ricoh</option>
									<option value="Bhomthai">Bhomthai</option>
									<option value="Chawpaya">Chawpaya</option>
									<option value="Nimble">Nimble</option>
									<option value="SNS">SNS</option>
									<option value="FLOWCO">FLOWCO</option>
				  				</select>&nbsp;
								  Asset By :
								  <select name="asset_by" id="asset_by" >
										<option value="BSS">BSS</option>
										<option value="PTTICT">PTTICT</option>
										<option value="Flowco">Flowco</option>
										<option value="Ricoh">Ricoh</option>
									</select>&nbsp;
									SparePart For  :  
									<select name="sparepartfor" id="sparepartfor" >
									<?/* $sql_sparepartfor = "SELECT customer_id,customer_name FROM tbl_customer Order by customer_name";
									$rs_sparepartfor = mysql_query($sql_sparepartfor);
									while($c_sparepartfor = mysql_fetch_array($rs_sparepartfor)){
									?>		    
										<option value="<?=$c_sparepartfor["customer_name"]?>"><?=$c_sparepartfor["customer_name"]?></option>
									<?}*/?>
										<option value="NGVONLY"><?=iconv('UTF-8','TIS-620',"ใช้ได้เฉพาะ NGV ของ ICT เท่านั้น ");?></option>
										<option value="OILONLY"><?=iconv('UTF-8','TIS-620',"ใช้ได้เฉพาะ OIL ของ ICT เท่านั้น ");?></option>	
										<option value="ALLOilNGV"><?=iconv('UTF-8','TIS-620',"ใช้ได้ทั้ง NGV และ Oil ของ ICT และ Ricoh ");?></option>
										<option value="ALLOilOnly"><?=iconv('UTF-8','TIS-620',"ใช้ได้เฉพาะ OIL ของ ICT และ Ricoh ");?></option>
										<option value="ALLOilRicohOnly"><?=iconv('UTF-8','TIS-620',"ใช้ได้เฉพาะ OIL ของ Ricoh ");?></option>	
										<option value="ALLAmazon"><?=iconv('UTF-8','TIS-620',"ใช้ได้เฉพาะ Amazon ");?></option>		
										<option value="ALL"><?=iconv('UTF-8','TIS-620',"ใช้ร่วมกันไม่ได้หมด");?></option>					
								</select></td>

					   <td><div id="Save" onclick="form1.submit();">
					  <img src="image/save.JPG" alt="Save" width="20" height="18" border="0" align="left"  /> </a> </td>
					   <td align="left"><nobr><b>Save</b></div></td>



					   <td><a href="javascript:history.back(1)" ><img src="image/cancel.jpg" alt="Cancel" width="20" height="18" border="0" align="left" /> </a> </td>
					   <td align="left"><nobr><b> Cancel</b>     </td>
					 </tr>
                </table>
               <table width="100%" border="0" align="center" class="mytable" id="table7"  cellpadding="1" cellspacing="1">
				   
				   <tr><th align="center" height="20" width="5%" class="th"><input class="form-control"  type="checkbox" id="selecctall"/></th>
                      <th align="center" height="20" width="10%" class="th">No.</th>
                      <th align="center" height="20" width="10%" class="th">user_id</th>
                      <th align="center" height="20" width="10%" class="th">hardware_no</th>
                      <th align="center" height="20" width="10%" class="th">repair_by</th>
                      <th align="center" height="20" width="10%" class="th">owner_by</th>
                      <th align="center" height="20" width="10%" class="th">asset_by</th>
                      <th align="center" height="20" width="10%" class="th">sparepartfor</th>
                      <th align="center" height="20" width="15%" class="th">comment_lot</th>
                    </tr>
					<? 
					$i = 0;	
					while($c = mysqli_fetch_array($rs)) {	
$i++;
?>
	 <tr onmouseover="this.style.backgroundColor='violet';" onmouseout="this.style.backgroundColor='white';" >
	    <td align="center" style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;" >
		<input class="form-control"  class="checkbox1" type="checkbox" name="check[]" id="check<?=$i?>" value="<?=$c["id"]?>"></td>
	    <td align="center" height="20" style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;" ><?=$i?></td>
	    <td  style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;"><?=$c["user_id"]?></a></td>
	    <td align="left" style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;" ><?=$c["hardware_no"]?></td>
	    <td align="center" style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;"><?=$c["repair_by"]?></td>  
	    <td align="center" style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;"><?=$c["owner_by"]?></td>
	    <td align="center" style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;"><?=$c["asset_by"]?></td>
	     <td align="center" style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;"><?=$c["sparepartfor"]?></td>
	    <td align="center" style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;"><?=$c["comment_lot"]?></td></td>			
	 </tr>
	    <?  } ?>
		<input class="form-control"  type="hidden" name="rows" id="rows" value="<?=$i;?>">	
	 <tr><td colspan="5"><?=$i?>  (Rows)</td></tr>
                </table>
            </td></tr></table>
</form>

