<?
header("Content-Type: text/html; charset=tis-620");                 
session_start();
require_once("function.php");          
  
  if(!checkUser()){    echo Message(35,"red",$titel1,$msg1,"<a href='index.php'> $login </a>");
  exit;
  }                                                                                                      
       
include("header.php");   
	$sch_text = trim($_REQUEST["sch_text"]);
    
   if($sch_text==""){
   			$sch_text = "xx";
   }                       
                          
$sql = "SELECT
tbl_hardware_onhand_user.id,
tbl_hardware_onhand_user.user_id,
tbl_category_hardware.cate_name,
tbl_hardware_onhand_user.hardware_no,
tbl_hardware_onhand_user.hardware_status,
tbl_hardware_onhand_user.status_pm
FROM
tbl_hardware_onhand_user
Inner Join tbl_category_hardware ON tbl_hardware_onhand_user.cate_id = tbl_category_hardware.cate_id
Where tbl_hardware_onhand_user.user_id = '$sch_text'
order by tbl_hardware_onhand_user.status_pm";// echo $sql;
?>  

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
<style type="text/css">
    <!--
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
    -->
</style>
  
<table width="100%" align="center" class="mytable" id="table" height="100%"   cellpadding="1" cellspacing="1" >
    <tr>
	<form id="form1" name="form1">
        <td valign="top"> 
                   <table width="100%" border="0" cellpadding="0" cellspacing="0" class="mytable">
                    <tr>
                        <td width="879" valign="middle" align="center"> <nobr>		
                          
                            
                            <b><? echo iconv('UTF-8','TIS-620',"รหัสสถานี"); ?></b>      
                            <input class="form-control"  style="width:100pt;" name="sch_text"  type="text"  id="sch_text" value="<?=$sch_text?>" />
                             
                            
                            
                            &nbsp;<input class="form-control"   type="button" name="sch" value="<? echo iconv('UTF-8','TIS-620',"ค้นหาเลขที่ใบงาน"); ?>"  onclick="Search_Click(sch_text.value)"style="width:50pt;">
                           
                        </td>
                        <td width="18" valign="middle"><!--a href="bsslogcall.form.php?type=add" target="_parent">
                        <img src="image/add.JPG"  alt="Add" width="20" height="20" border="0" align="right"> </a></td>
                        <td width="27" valign="middle">&nbsp;<b> à¾ÔèÁ </b-->&nbsp;</td>
                    </tr>
                </table>     
                <table width="100%" align="center" class="mytable" id="table7"  cellpadding="1" cellspacing="1">
                    <tr>			 
                        <th class="th" width="5%">#</th>
                        <th class="th" width="50%">Category</th>  
                        <th class="th" width="25%">Serial no</th>  
                        <th class="th" width="10%">Sent to</th>
						<th class="th" width="10%">Status PM</th> 
                    </tr >
                        <?  // echo $sql;
                         $res = mysqli_query($conn,$sql);
                         $i=0;						 
                          while($row = mysqli_fetch_array($res)) {    
						     $i++;
							 if($row["status_pm"] == 'n'){$color="blue";}else{$color='black';}
                              ?>
							 
                          <tr onmouseover="this.style.backgroundColor='violet';" onmouseout="this.style.backgroundColor='white';"  style="color: <?=$color?>; ">
                        <td style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;"  align="center"><?=$i;?></td>
						<td style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;"  align="left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$row["cate_name"];?></td>
						<td style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;"  align="left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$row["hardware_no"];?></td>
						<td style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;"  align="center">
						<a   lang="select.user.php?serial_id=<?=$row['id'];?>&sch_text=<?=$sch_text?>" class="thickbox pointer"><img src="image/refresh.png"></a
						</td>
						<td style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;"  align="center"><?
						if($row["status_pm"] =='y'){ echo "PM";}else{echo "-";}
						
						?></td>
                          </tr>  
                       <?     					                 
                          }
						  ?> 
                          <tr>                                                                                 
                            <td colspan="10" style="padding:0px; border-bottom:1px solid #ccc; border-right:0px solid #ccc;"> Total :  <?=$i;?> (rows)</td>
                          </tr>   
                </table> </td></tr></table>
</form>


<script type="text/javascript"> 
    var props = {    formatDate :        '%m-%d-%y'    };
    props.formatDate = '%y-%m-%d';
    var cdp1 = new CalendarDatePicker(props);
	
    function Search_Click(text){
		 document.location.href ="serialsite2onhand.php?sch_text="+text;
      }
      
      function click2edit(id,ubpdate_by,typer){   
		var dte_b = document.form1.date_beg.value;                         
         var dte_e = document.form1.date_end.value;
		 
        document.location.href ="bsslogcall.form.php"+"?id="+id+"&ubpdate_by="+ubpdate_by+"&type="+typer+"&dte_beg="+dte_b+"&dte_end="+dte_e;   
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


