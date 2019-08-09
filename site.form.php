<?
header("Content-Type: text/html; charset=tis-620");

session_start();
require_once("function.php");
if(!checkUser()){    echo Message(35,"red",$titel1,$msg1,"<a href='index.php'> $login </a>");
   exit;
}
$id = $_REQUEST["id"];
$type = $_REQUEST["typer"];
$txt = $_REQUEST["txt"];

if($type != "add" && $type !="edit" ){
 echo Message(35,"red",$titel1,$msg2,"<a href='javascript:history.back(1)'> $back</a>");
 exit;
}
$readonly = "";
if($type =="edit") {
  $readonly = "readonly";
}

 $sql = "Select * from tbl_site Where site_id = '$id'";
 $rc = @mysqli_query($conn,$sql);
 $c = @mysqli_fetch_array($rc);
echo "sss";
?>



<title>Bizserv Solution Co.,Ltd</title>
<meta http-equiv=Content-Type content="text/html; charset=utf-8">
<link href="style/mytable.css" rel="stylesheet" type="text/css" />
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

<?php// exit;?>

<script type="text/javascript">
$(document).ready(function(){
	$("#Save").click(function(){
				var typer  = $("#typer").attr('value');
				var site_id  = $("#site_id").attr('value');
				var  site_old_name = $("#site_old_name").attr('value');
				var site_new_name = $("#site_new_name").attr('value');
				var site_name = $("#site_name").attr('value');
				var  pos = $("#pos").attr('value');
				var  address = $("#address").attr('value');
				var  province_name = $("#province_name").attr('value');
				var  contact = $("#contact").attr('value');
				var  center_phase = $("#center_phase").attr('value');
				var  from_center = $("#from_center").attr('value');
				var  Latitude = $("#Latitude").attr('value');
				var  Longtitude = $("#Longtitude").attr('value'); 
        var  from_owner = $("#from_owner").attr('value');
				var  txt = $("#txt").attr('value');
			$.post('function.execute.php',{ mode : "site.all", typer : typer, site_id : site_id ,site_old_name : site_old_name ,site_new_name  :  site_new_name, site_name : site_name , pos : pos , address : address , province_name : province_name , contact : contact , center_phase : center_phase,  from_center : from_center , from_owner : from_owner,Latitude:Latitude,Longtitude:Longtitude},
			function(data) { // alert(data);
			if(data==""){
					window.parent.location.href ="site.index.php?schTxt="+txt+"&id="+Math.random(100*1000,1000/2);
			} else {
						alert(data);
			}
				});
			return false;
		});
});
</script>
<table width="100%" align="center" class="mytable" id="table" height="50%"   cellpadding="1" cellspacing="1" bgcolor="#FFFFFF">
    <tr>
        <td valign="top">
                <table width="100%" border="0" cellpadding="0" cellspacing="0" class="mytable" bgcolor="#FFFFFF">
                    <tr>
			<td width="80%"><a href="#" onclick="showSerial_no_bss('<?=$c["site_id"];?>');">
                        <img src="image/gear_replace.gif" alt="Save" align="right" width="20" height="20" /></td><?if($_SESSION['Uat'] ==  "BSS"){?>
                        <td><b><nobr>Serial No (BSS.)</b></td>
                        <td>&nbsp;</td>
                        <td><a href="#" onclick="showSerial_no('<?=@$c["site_id"];?>');">
                        <img src="image/gear_replace.gif" alt="Save" align="right" width="20" height="20" /></td><?}?>
                        <td><b><nobr>Serial No (PTT.)</b></td>
                        <td>&nbsp;</td>
                        <td><input class="form-control"  name="Save"  id="Save" type="image" onclick=" return CheckText()"  src="image/save.jpg" alt="Save" align="right" width="20" height="20" />    </td>
                       <td align="left"><b>Save</b>    </td>
                       <td><a href="javascript:history.back(1)" target="mainPage" ><img src="image/cancel.jpg" alt="Cancel" width="20" height="18" border="0" align="left" /> </a> </td>
                       <td align="left"><nobr><b>Cancel</b>     </td>
                     </tr>
                </table>
                <br>
                <table width="70%" align="center"  id="table" cellpadding="1" cellspacing="1" border="0"  bgcolor="#FFFFFF">
                   <tr>
                      <td width="18%" height="20" align="left" class="fontBblue" >Site ID :  </td>
                      <td align="left" class="fontBblue">
					  <input class="form-control"  type="hidden" name="typer" id="typer" style="width:130pt;" value="<?=@$type?>">
					  <input class="form-control"  type="hidden" name="txt" id="txt" style="width:130pt;" value="<?=@$txt?>">
                      <input class="form-control"  type="text" name="site_id" id="site_id" style="width:130pt;" <?=$readonly?>  value="<?=@$c["site_id"]?>"></td>
                  </tr >

                    <tr>
                      <td height="25%" align="left" class="fontBblue" ><nobr>Name(old) :</td>
                      <td height="25%" align="left" class="fontBblue"> <input class="form-control"  type="text" name="site_old_name" id="site_old_name" value="<?=@$c["site_old_name"];?>" style="width:300pt" /></td><meta http-equiv="Content-Type" content="text/html; charset=windows-874">
                   </tr>

                   <tr>
                      <td height="25%" align="left" class="fontBblue"><nobr>Name(New):</td>
                      <td height="25%" align="left" class="fontBblue" colspan="5"><input class="form-control"  type="text" name="site_new_name" id="site_new_name" value="<?=@$c["site_new_name"];?>"  style="width:300pt" /></td>
                    </tr>

                    <tr>
                      <td height="25%" align="left" class="fontBblue"><nobr>Name :</td>
                      <td height="25%" align="left" class="fontBblue" colspan="5"><input class="form-control"  type="text" name="site_name" id="site_name" value="<?=@$c["site_name"];?>"  style="width:300pt" /></td>
                    </tr>
                    <tr>
                      <td height="25%" align="left" class="fontBblue"><nobr>   POS  :</td>
                      <td height="25%" align="left" class="fontBblue" colspan="5"><input class="form-control"  type="text" name="pos" id="pos" value="<?=@$c["pos"];?>"  style="width:300pt" /></td>
                    </tr>
					<tr>
                      <td height="25%" align="left" class="fontBblue"><nobr>   Address  :</td>
                      <td height="25%" align="left" class="fontBblue" colspan="5"><input class="form-control"  type="text" name="address" id="address" value="<?=@$c["address"];?>"  style="width:330pt" /></td>
                    </tr>
                 <tr>
                      <td height="20" align="left" class="fontBblue"><nobr>Province :</td>
                      <td height="20" align="left" class="fontBblue">
					  		<select name="province_name" id="province_name" 	style="width:130pt" >
							<?
									$sql_province = mysqli_query($conn,"select id,province_name from tbl_province order by province_name");
									while($c_province = mysqli_fetch_array($sql_province)){
							?>
									<option value="<?=$c_province["id"]?>"  <? if($c_province["id"] == @$c["province_name"]) echo "selected";?>><?=$c_province["province_name"]?></option>
									<? } ?>
							</select>
					  </td>
                 </tr>
				 <tr>
                      <td height="20" align="left" class="fontBblue"><nobr>Contact  :</td>
                      <td height="20" align="left" class="fontBblue"><input class="form-control"  type="text" name="contact" id="contact" value="<?=@$c['contact'];?>"  style="width:200pt" /></td>
                 </tr>
				 <tr>
                      <td height="20" align="left" class="fontBblue"><nobr>Service  :</td>
                      <td height="20" align="left" class="fontBblue">
	<?  ?>
		<select name="center_phase" id="center_phase" style="width:200pt" >
<?
	$sql_phase = "select * from tbl_phase order by phase_id";
	$rs_phase = @mysqli_query($conn,$sql_phase);
	while($c_p = @mysqli_fetch_array($rs_phase)){
?>
		<option value="<?=$c_p['phase_id']?>" <? if($c_p["phase_id"]==@$c['center_phase']) echo "selected";?>><?=$c_p['phase_name'];?></option>
<? }?>
		</select>
		</td>
        </tr>
			<tr>
        <td height="20" align="left" class="fontBblue"><nobr>Length(Km)  :</td>
        <td height="20" align="left" class="fontBblue"><input class="form-control"  type="text" name="from_center" id="from_center" value="<?=@$c['from_center'];?>"  style="width:200pt" />Km.</td>
      </tr>
      <tr>
        <td height="20" align="left" class="fontBblue"><nobr>Owner :</td>
        <td height="20" align="left" class="fontBblue">
          <select name="from_owner" id="from_owner">
            <option value="RICOH" <? if(@$c["from_owner"]== "RICOH"){ echo "selected"; }?> >RICOH</option>
            <!--option value="FLOWCO" <? if(@$c["from_owner"]== "FLOWCO"){ echo "selected"; }?> >FLOWCO</option-->
            <option value="PTTICT" <? if(@$c["from_owner"]== "PTTICT"){ echo "selected"; }?> >PTTICT</option>
          </select>
        </td>
      </tr>

<tr>
        <td height="20" align="left" class="fontBblue"><nobr>Latitude :</td>
        <td height="20" align="left" class="fontBblue"><input class="form-control"  type="text" name="Latitude" id="Latitude" value="<?=@$c['latitude'];?>"  style="width:200pt" /></td>
      </tr>
<tr>
        <td height="20" align="left" class="fontBblue"><nobr>Longtitude :</td>
        <td height="20" align="left" class="fontBblue"><input class="form-control"  type="text" name="Longtitude" id="Longtitude" value="<?=@$c['longitude'];?>"  style="width:200pt" /></td>
      </tr>
      </table>
            </td>

      </tr>


  </table>
<script type="text/javascript">
    var props = {    formatDate :        '%m-%d-%y'    };
    props.formatDate = '%y-%m-%d';
    var cdp1 = new CalendarDatePicker(props);


    function CheckText(){
        if(document.form1.site_id.value == "") {
            document.form1.site_id.focus();
            return false;
        }
        if(document.form1.name_old.value == "") {
            document.form1.name_old.focus();
            return false;
        }

        if(document.form1.name_new.value == "") {
            document.form1.name_new.focus();
            return false;
        }

        if(document.form1.name_new1.value == "") {
            document.form1.name_new1.focus();
            return false;
        }
        if(document.form1.Amphur.value == "") {
            document.form1.Amphur.focus();
            return false;
        }
        if(document.form1.province.value == "") {
            document.form1.province.focus();
            return false;
        }
        return true;
    }

   function showSerial_no(val){
    // alert(val);
            myleft=(screen.width)?(screen.width-600)/2:100;
            mytop=(screen.height)?(screen.height-300)/2:100;
            properties = " width=800,height=600";
            properties +="directories=no,titlebar=no,toolbar=no,location=no,status=no,menubar=no,scrollbars=yes, top="+mytop+",left="+myleft;
            window.open("serial_no_all.php?id="+val,"Entry",properties);
 }

function showSerial_no_bss(val){
    // alert(val);
            myleft=(screen.width)?(screen.width-600)/2:100;
            mytop=(screen.height)?(screen.height-300)/2:100;
            properties = " width=800,height=600";
            properties +="directories=no,titlebar=no,toolbar=no,location=no,status=no,menubar=no,scrollbars=yes, top="+mytop+",left="+myleft;
            window.open("add_serial_retail.php?id="+val,"Entry",properties);
 }
</script>
</form>


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
