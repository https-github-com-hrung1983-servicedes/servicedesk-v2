<? exit;
session_start();                 
header("Content-Type: text/html; charset=tis-620");

require_once("function.php");        
  
  if(!checkUser()){    echo Message(35,"red",$titel1,$msg1,"<a href='index.php?link=insert.sn4pm'> $login </a>");         
  exit;
  }         

include("header.php");                      

	$siteid = $_REQUEST["siteid"];//"S000370";
	$cate_id = $_REQUEST["cate_id"]; 
if($cate_id==""){
	$cate_id = "1";
}
//insert.sn4pm.execute.php
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



 <form id = "form1" name = "form1" method="post" action="#">
        <table align="center" bordercolor="#000000" class="mytable"  border="0" width="60%"> 
		<tr>
			<td width='99%'>&nbsp;
			</td>	
			<td><nobr>
			</td><td>
				<input name="Save" id="Save"  type="image" src="image/save.jpg" alt="Save" align="right" width="20" height="20" />
			</td>	
<td><b>
	Save</b>
</td>
	</tr>
<tr><td colspan=4>

<table align="center" bordercolor="#000000" class="mytable"  border="0" width="60%"> 
                <tr>
                      <th width="30%" class="th" ><nobr>&nbsp;Site ID.</th>                                 
                      <th width="70%" class="th" ><nobr>&nbsp;Site Name<nobr></th>  
		</tr>
<?
	$sql = "SELECT
tbl_hardware_onhand_user.id,
tbl_hardware_onhand_user.user_id,
tbl_hardware_onhand_user.cate_id,
tbl_hardware_onhand_user.hardware_no,
tbl_site.site_name
FROM
tbl_hardware_onhand_user
Inner Join tbl_site ON tbl_hardware_onhand_user.user_id = tbl_site.site_id
Where tbl_hardware_onhand_user.user_id='$siteid' And tbl_hardware_onhand_user.hardware_status = 'w' And tbl_hardware_onhand_user.cate_id = '$cate_id'";
//echo $sql;

	$rc = mysqli_query($conn,$sql);
	$c = mysqli_fetch_array($rc);
$cnt_job = checkjob($siteid,$cate_id,$_SESSION["Uat"]);//echo $cnt_job;
if($cnt_job==1){
	echo "<center><BLINK><font size='+3' color='red'>".iconv('UTF-8','TIS-620','สถานีนี้ทำ PM แล้ว')."</font></BLINK></center>";
}
?>
		<tr>
                      <td width="30%" align="center"><nobr><input name="site_id" id="site_id" value="<?=$siteid;?>" style="width:150pt" />&nbsp;
		<input  type="button" name="sch" value="Search"  onclick="Search_Click(site_id.value)" style="width:50pt;"></td>                                 
                      <td width="70%"><nobr><input name="site_name" id="site_name" value="<?=$c['site_name'];?>" style="width:750pt" readonly /></td>  
		</tr>
	  </table>
<br>


<? if($cnt_job==0) {?>
	<table align="center" bordercolor="#000000" class="mytable"  border="0" width="60%"> 
		<tr>			
			<th class="th" width="60%" style="padding:0px; border-bottom:1px solid #ccc; border-right:0px solid #ccc;">Category Name</th> 
			<th class="th" width="20%" style="padding:0px; border-bottom:1px solid #ccc; border-right:0px solid #ccc;">Current SN.</th> 
			<th class="th" width="20%" style="padding:0px; border-bottom:1px solid #ccc; border-right:0px solid #ccc;">New SN.</th> 
		</tr>		
              
		<tr>      
                      <td><select name="cate_id" id="cate_id" style="width:600pt;" onchange="form1.submit();">
			<?
              $c_col = mysqli_query($conn,"SELECT cate_id,cate_name FROM tbl_category_hardware WHERE cate_id in ('1','2','3','4','6','7','8','9','10','11','12','13','14','36','37','31','32','33','34','25','30','27','45','16','60','61','62','63'
,'64','65','66','67','68','20')   order by cate_name");
              while($rs_col = mysqli_fetch_array($c_col)){
			?>    
				<option value="<?=$rs_col['cate_id']?>" <? if($cate_id==$rs_col["cate_id"]) echo "selected";?>><?=$rs_col['cate_name']?></option>
		<?}?>			
			</select></td> 
                      <td><input type='hidden' name="sn_old" id="sn_old" value="<?=$c['id']?>" style="width:195pt" readonly />
			  <input name="hardware_name" id="hardware_name" value="<?=$c['hardware_no']?>" style="width:195pt" readonly /></td>  
                      <td>
			
<?
	$sql1 = "SELECT
tbl_hardware_onhand_user.id,
tbl_hardware_onhand_user.hardware_no,
tbl_hardware_onhand_user.user_id
FROM
tbl_hardware_onhand_user
Where tbl_hardware_onhand_user.hardware_status in ('w','a','o')
And tbl_hardware_onhand_user.cate_id = '$cate_id'
And tbl_hardware_onhand_user.owner_by in ('0','MSI','BSS')

And tbl_hardware_onhand_user.user_id not in (
SELECT
tbl_log_call_center.site_id
from tbl_log_call_center
where tbl_log_call_center.category_type in ('12','19') And tbl_log_call_center.open_call_dte like '2015%'
and tbl_log_call_center.status_call = 'close'
)
order by tbl_hardware_onhand_user.hardware_no 
"; echo $sql1;
?>
<select name="sn_new" id="sn_new" style="width:195pt" >
<?	$rc1 = mysqli_query($conn,$sql1);
	while($c1 = mysqli_fetch_array($rc1)){
?>
			<option value="<?=$c1['id']?>" <? if($c1["hardware_no"]==$c["hardware_no"]) echo "selected";?>><?=$c1["hardware_no"]?></option>
<?}?>
			</select>
		      </td> 
		</tr>            
             
             
      </table>
<?}?>
</td>
</tr>
</table>        
</center>
</form>
</body>
</html>
<script type="text/javascript"> 
    function Search_Click(site){        
   document.location.href ="insert.sn4pm.php?siteid="+site+"&id="+Math.random(100*1000,1000/2);
      }

</script>

<?
 function checkjob($site_id,$cate_id,$at){
	 global $conn;
	$sql_checkjob = " SELECT count(tbl_log_call_center.job_no) as cnt
			  FROM tbl_log_call_center
			Where tbl_log_call_center.category_type = '12'
			And tbl_log_call_center.open_call_dte like '2015%'
			And tbl_log_call_center.site_id = '$site_id'
                        And tbl_log_call_center.type_service = '$at'";
	//if($cate_id==""){
		$sql_checkjob .= " And tbl_log_call_center.status_call = 'close'";
	//}
	$rs_checkjob = mysqli_query($conn,$sql_checkjob);
	while($c_checkjob = mysqli_fetch_array($rs_checkjob)){
		$str = $c_checkjob["cnt"];
	}
return $str;
}
?>











