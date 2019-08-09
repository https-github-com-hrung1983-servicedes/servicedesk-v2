<?
header("Content-Type: text/html; charset=tis-620");

session_start();
require_once("function.php");
  if(!checkUser()){    echo Message(35,"red",$titel1,$msg1,"<a href='index.php?link=bsslogcall.form'> $login </a>");
  exit;
  }  
$id = $_REQUEST["id"];
$type = $_REQUEST["type"];  
$ubpdate_by = $_REQUEST["ubpdate_by"];  

//if($type != "add" && $type !="edit" ){
// echo Message(35,"red",$titel1,$msg1,"<a href='index.php?link=bsslogcall.form'> $login </a>");
// exit;
//}     
include("header.php");  
if ($type == "edit") {
  $sql = "Select tbl_log_call_bss.*,
tbl_user.name,
tbl_user.sname,
tbl_user.tel 
from tbl_log_call_bss 
Inner Join tbl_user ON tbl_log_call_bss.job_engineer_reciept_id = tbl_user.user_id
where tbl_log_call_bss.job_id = $id 
and tbl_log_call_bss.logfrom='$ubpdate_by'"; //    echo $sql;exit;  
  $rs = mysqli_query($conn,$sql);
  $c = mysqli_fetch_array($rs);        
}
  $job_date =  $c["job_date"];    
  $expire_date =  $c["expire_date"];  
    if($job_date =="") $job_date = getDte();
    if($expire_date =="") $expire_date = getDte();        

	$site_id = "MAJ001";//$_REQUEST["site_id"];



	$dte_beg = $_REQUEST["dte_beg"];
	$dte_end = $_REQUEST["dte_end"];
?>

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
<script type="text/javascript">
$(document).ready(function(){

				var job_no = $("#job_no").val(); 
				
				if(job_no==""){
							var d = new Date();
							var curr_date = d.getDate();
							var curr_month = d.getMonth()+1;
							var curr_year = d.getFullYear();
							var id = Math.floor((Math.random()*1000)+100);
							var now = "BSS"+curr_date+""+curr_month+""+curr_year+""+id;
							  $("#job_no").val(''); 
							  $("#job_no").val(now);
				}
});//bsslogcall.execute.php
</script>
<table align="center" class="mytable" id="table" height="70%"   cellpadding="1" cellspacing="1">
    <tr>                                               
        <td valign="top" align="center">                                                       
            <form action=""  method="post"  name="form1" id="form1"  >
            <input type="hidden" name="job_id" id="job_id" value="<?=$id;?>" style="width:100pt" readonly="readonly">       <input type="hidden" name="dte_beg" id="dte_beg" value="<?=$dte_beg?>">                               
			<input type="hidden" name="dte_end" id="dte_end" value="<?=$dte_end?>">                         
                <table border="0" cellpadding="0" cellspacing="0" class="mytable" border="1" bordercolor="#FF0000">
                    <tr>
                        <th align="center" height="40" colspan="6" class="th">Log Call Center (BSS)</th>                    
                    </tr >
                    
                    <tr>
                        <td bgcolor="white" width="95%" ><input name="Submit" id="Submit"  type="image" src="image/save.jpg" alt="Save" align="right" width="20" height="20" />    </td>
                       <td align="left" bgcolor="white" width="10%"><b>บันทึก</b>    </td>
					   <td><a href="javascript:history.back(1)" ><img src="image/cancel.jpg" alt="Cancel" width="20" height="18" border="0" align="left" /> </a> </td>
					   <td align="left"><nobr><b> ยกเลิก</b>     </td>
                     </tr>
                </table>
                <br>
                <table align="center"  id="table" cellpadding="1" cellspacing="1" border="0">
				<input type="hidden" name="logfrom" id="logfrom" value="<?=$c["logfrom"];?>" style="width:150pt" readonly>
                    <tr>
                      <td height="20" width="30%" align="left" class="fontBblue" >Job no. :  </td> 
                      <td height="20" width="70%" align="left" class="fontBblue">                   
					  <input type="text" name="job_no" id="job_no" value="<?=$c["job_no"]?>" style="width:150pt" >
						</td>          
                    </tr>
					<tr>
                      <td height="20" width="30%" align="left" class="fontBblue" >Job date. :  </td>  
                      <td height="20" width="70%" align="left" class="fontBblue">                   
						<input type="text" name="job_date" id="job_date" style="width:150pt" readonly onclick="cdp1.showCalendar(this, 'job_date');return false;" value="<?=$job_date?>"></td>          
                    </tr >
					  <!--tr>
						  <td height="20" width="30%" align="left" class="fontBblue" >Job type :  </td>  
						  <td height="20" width="70%" align="left" class="fontBblue">                   
							<select name="job_type" id="job_type" style="width:250pt">
								<?
										$sql_job_type = "select customer_id,customer_code,customer_name from tbl_customer order by customer_type,customer_name";
										$rs_job_type = mysqli_query($conn,$sql_job_type);
										while($c_job_type = mysqli_fetch_array($rs_job_type)){
								?>
									<option value="<?=$c_job_type["customer_id"]?>" <? if($c_job_type["customer_id"] == $c["job_type"]) echo "selected";?>><?=$c_job_type["customer_code"]." (".$c_job_type["customer_name"]." )"?></option>
									<?}?>
							</select>
						  </td>          
					  </tr --->
                   <tr>
                      <td height="20" width="30%" height="20" align="left" class="fontBblue" >Site :  </td>  
                      <td height="20" width="70%" align="left" class="fontBblue"><?//=$c["site_id"];?>
                   
                      <select name="site_id" id="site_id">
				<?
					$sql_site = "select site_id,site_name from tbl_site_retail order by site_name";
					$rs_site = mysqli_query($conn,$sql_site);
					while($c_site = mysqli_fetch_array($rs_site)){
				?>
					<option value="<?=$c_site[site_id]?>" <?if($c_site["site_id"]==$site_id) echo "selected";?>><?=$c_site["site_name"]?></option>	
				<?}?>
		      </select>	
		     </td>          
                  </tr>
		   <tr>
                      <td height="20" align="left" class="fontBblue" ><nobr>Contact  :</td>
                      <td height="20" align="left" class="fontBblue" ><nobr>
                        <input name="cmbCateType" type="text" id="cmbCateType" value="<?=$c['fixed_description'];?>"  style="width:275pt"  readonly/></td>
                     </tr>

                    <tr>
                      <td height="20" align="left" class="fontBblue" ><nobr>Category type  :</td>
                      <td height="20" align="left" class="fontBblue" ><nobr>
                        <input name="CateTypeID" id="CateTypeID" type="hidden" value="<?=$c['category_type'];?>">
                        <input name="cmbCateType" type="text" id="cmbCateType" value="<?=$c['fixed_description'];?>"  style="width:275pt"  readonly/>
                      <a href="javascript:getCategoryType('CateTypeID','cmbCateType')">
                      <img src="image/search.gif" alt="เลือกประเภทปัญหา" width="26" height="22" border="0" align="top"/></a></td>
                     </tr>



                   <tr>
                      <td height="20" width="30%" height="20" align="left" class="fontBblue" >Job problem :  </td>  
                      <td height="20" width="70%" align="left" class="fontBblue">                   
                      <input type="text" name="job_problem" id="job_problem" value="<?=$c['job_problem'];?>" style="width:300pt"></td>          
                  </tr >
                   <tr>
                      <td height="20" width="30%" height="20" align="left" class="fontBblue" >Job solution :  </td>  
                      <td height="20" width="70%" align="left" class="fontBblue">                   
                      <input type="text" name="job_solution" id="job_solution" value="<?=$c['job_solution'];?>" style="width:300pt"></td>          
                  </tr >
                   <tr>
                      <td height="20" width="30%" height="20" align="left" class="fontBblue" >Job start date :  </td>  
                      <td height="20" width="70%" align="left" class="fontBblue">                   
                      <input type="text" name="job_start_date" id="job_start_date" value="<?=$c['job_start_date'];?>" readonly style="width:150pt">
					  <a href="#" onclick="cdp1.showCalendar(this, 'job_start_date'); return false;" > 
                          <img src="image/calendar.png" width="17" height="13" border="0" /></a><nobr> HH :  
                          <?
                          $hop = getTime($c["job_start_time"],0);
                          ?>
                          <select name="job_start_time_hx" id="job_start_time_hx">
                            <?for($i=0;$i<60;$i++){?>
                                <option value = "<?=$i?>" <?if($hop==$i) echo "selected";?>><?=$i?></option>";
                            <?}?>
                        </select>
                          <nobr>MM :
                          <?
                          $mop = getTime($c["job_start_time"],1);
                          ?>
                          <select name="job_start_time_t" id="job_start_time_t">
                            <?for($i=0;$i<60;$i++){?>
                                <option value = "<?=$i?>" <?if($mop==$i) echo "selected";?>><?=$i?></option>";
                            <?}?>
                     </select>
					  
					  </td>          
                  </tr >
				  <tr>
                      <td height="20" width="30%" height="20" align="left" class="fontBblue" >Job end time :  </td>  
                      <td height="20" width="70%" align="left" class="fontBblue">                   
                      <input type="text" name="job_end_date" id="job_end_date" value="<?=$c['job_end_date'];?>" readonly style="width:150pt"><a href="#" onclick="cdp1.showCalendar(this, 'job_end_date'); return false;" > 
                          <img src="image/calendar.png" width="17" height="13" border="0" /></a>
					 <nobr> HH :  
                          <?
                          $hen = getTime($c["job_end_time"],0);
                          ?>
                          <select name="job_start_time_hs" id="job_start_time_hs">
                            <?for($i=0;$i<60;$i++){?>
                                <option value = "<?=$i?>" <?if($hen==$i) echo "selected";?>><?=$i?></option>";
                            <?}?>
                        </select>
                          <nobr>MM :
                          <?
                          $men = getTime($c["job_end_time"],1);
                          ?>
                          <select name="job_end_timec" id="job_end_timec">
                            <?for($i=0;$i<60;$i++){?>
                                <option value = "<?=$i?>" <?if($men==$i) echo "selected";?>><?=$i?></option>";
                            <?}?>
                     </select>
					  </td>          
                  </tr >
               <?/*?>   
                   <tr>
                      <td height="20" width="30%" height="20" align="left" class="fontBblue" >Job reciept user :  </td>  
                      <td height="20" width="70%" align="left" class="fontBblue">               
                      <input type="hidden" name="job_reciept_user_idx" id="job_reciept_user_idx" value="<?=$c["job_reciept_user_id"];?>" style="width:150pt">
					  <input type="text" name="job_reciept_user_name" id="job_reciept_user_id" value="" style="width:150pt">
					  <a href="javascript:getUser('bsslogcalluser','BSS')"><img src="image/search.gif" alt="เลือกสถานี" width="26" height="22" border="0" align="top" /></a></td>          
                  </tr > <?*/?> 
                   <tr>
                      <td height="20" width="30%" height="20" align="left" class="fontBblue" >Job engineer reciept :  </td>  
                      <td height="20" width="70%" align="left" class="fontBblue">                   
                      <input type="hidden" name="job_engineer_reciept_id" id="job_engineer_reciept_id" value="<?=$c["job_engineer_reciept_id"];?>" style="width:150pt">        
                      <input type="text" name="job_engineer_reciept_name" id="job_engineer_reciept_name" value="<?=$c["name"]." ".$c["sname"]."  (".$c["tel"].")";?>" style="width:150pt">
					  <a href="javascript:getUser('bsslogcalleng','BSS')"><img src="image/search.gif" alt="เลือกสถานี" width="26" height="22" border="0" align="top" /></a></td>          
                  </tr >
                   <tr>
                      <td height="20" width="30%" height="20" align="left" class="fontBblue" >Job referance :  </td>  
                      <td height="20" width="70%" align="left" class="fontBblue">                   
                      <input type="text" name="job_referance_id" id="job_referance_id" value="<?=$c["job_referance_id"];?>" style="width:150pt" readonly></td>          
                  </tr >
                   <tr>
                      <td height="20" width="30%" height="20" align="left" class="fontBblue" >Job status :  </td>  
                      <td height="20" width="70%" align="left" class="fontBblue">                   
                      <select name="job_status" id="job_status" style="width:150pt">
							<option value="Onsite" <?if($c["job_status"]=="Onsite") echo "selected";?>>Onsite</option>
							<option value="Close" <?if($c["job_status"]=="Close") echo "selected";?>>Close</option>
					  </select></td>          
                  </tr >
                    
                </table>  


<br><br>

<input type="hidden" id="txtSidProvince" name="txtSidProvince">
<input type="hidden" id="province_phase" name="province_phase">
<input type="hidden" id="way_length" name="way_length">
<input type="hidden" id="cmbServiceType" name="cmbServiceType">
            </form></td></tr></table>


<script type="text/javascript"> 
 var props = {    formatDate :        '%m-%d-%y'    };
    props.formatDate = '%y-%m-%d';
    var cdp1 = new CalendarDatePicker(props); 


   function CheckText(){
        if(document.form1.customer_name.value == "") {
            alert('');
            document.form1.customer_name.focus();
            return false;
        }   
        return true;
    }   

	function getSite(id){     
        myleft=(screen.width)?(screen.width-800)/2:100;    
        mytop=(screen.height)?(screen.height-300)/2:100;      
        properties = " width=800,height=300";
        
            var type = document.form1.job_type.value;        
            var site = document.form1.txtSid.value;        

            if(site==""){
             alert("กรุณากรอกรหัสสถานีก่อนนะครับ");
             document.form1.txtSid.focus();      
             return;
            }
            
        properties +="directories=no,titlebar=no,toolbar=no,location=no,status=no,menubar=no,scrollbars=yes, top="+mytop+",left="+myleft;      
        window.open("sch_site.php?type="+type+"&site="+site,"Search",properties);                                                                       

    }

	function getUser(frm,type){     
        myleft=(screen.width)?(screen.width-800)/2:100;    
        mytop=(screen.height)?(screen.height-300)/2:100;      
        properties = " width=800,height=300";
                                                                        
        properties +="directories=no,titlebar=no,toolbar=no,location=no,status=no,menubar=no,scrollbars=yes, top="+mytop+",left="+myleft;      
        window.open("sch_user.php?frm="+frm+"&type="+type,"Search",properties);                                                                       

    }

	             
    function getCategoryType(id,val){     
        myleft=(screen.width)?(screen.width-800)/2:100;    
        mytop=(screen.height)?(screen.height-300)/2:100;      
        properties = " width=800,height=300";
            var cat = document.form1.job_type.value;        
         
        properties +=",menubar=no,scrollbars=auto,scrollbars=auto, top="+mytop+",left="+myleft;      
        window.open("sch_categry_work.php?cat="+cat,"Search",properties);        
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
