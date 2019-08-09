<?
header("Content-Type: text/html; charset=tis-620");

session_start();
require_once("function.php"); 
if(!checkUser()){    echo Message(35,"red",$titel1,$msg1,"<a href='index.php?link=jobtype.form'> $login </a>");
   exit;
}
$id = $_REQUEST["id"];
$type = $_REQUEST["typer"];  
if($type != "add" && $type !="edit" ){
 echo Message(35,"red",$titel1,$msg2,"<a href='javascript:history.back(1)'> $back</a>");
 exit;
}
                                      
include("header.php");
 
 $sql = "Select category_id,station_type,category_type,fixed_description,commente from tbl_category_type Where category_id = '$id'";
 $rc = mysql_query($sql);
 $c = mysql_fetch_array($rc);
                
?>
<title>Bizserv Solution Co.,Ltd</title>
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
<table width="100%" align="center" class="mytable" id="table" height="100%"   cellpadding="1" cellspacing="1">
    <tr>                                               
        <td valign="top">                                                       
            <form action="jobtype.execute.php"  method="post"  name="form1" target="mainPage" id="form1"  >
            <input class="form-control"  type="hidden" value="<?=$c["category_id"]?>" name="category_id" id = "category_id">                             
                <table width="100%" border="0" cellpadding="0" cellspacing="0" class="mytable" bordercolor="#FF0000">
                    <tr>
                        <th align="center" height="40" width="100%" colspan="6" class="th">Job Type</th>                    
                    </tr >
                    
                    <tr>
                        <td width="95%" colspan="2">&nbsp;</td>
                        <td><input class="form-control"  name="Submit"  type="image" onclick=" return CheckText()"  src="image/save.jpg" alt="Save" align="right" width="20" height="20" />    </td>
                       <td align="left"><b>บันทึก</b>    </td>
                       <td><a href="javascript:history.back(1)" target="mainPage" ><img src="image/cancel.jpg" alt="Cancel" width="20" height="18" border="0" align="left" /> </a> </td>
                       <td align="left"><nobr><b> ยกเลิก</b>     </td>
                     </tr>
                </table>                                                                       
                <br>
                <table width="70%" align="center"  id="table" cellpadding="1" cellspacing="1" border="0">      
                    
                    <tr>                                       
                      <td height="25%" align="left" class="fontBblue" ><nobr>Job Type :</td>  
                      <td height="25%" align="left" class="fontBblue"> 
                      <select name="station_type" id="station_type" style="width:100pt" />   
                        <option value="n" <?if($row["station_type"]=="2"){echo "select";}?> >NGV</option>    
                        <option value="o" <?if($row["station_type"]=="3"){echo "select";}?> >Oil</option>
                        <option value="o" <?if($row["station_type"]=="4"){echo "select";}?> >Amazon</option>
                        <option value="o" <?if($row["station_type"]=="5"){echo "select";}?> >Bizserv</option>
                      </select></td>
                   </tr>
                                                  
                   <tr>                                       
                      <td height="25%" align="left" class="fontBblue"><nobr>Category Type  :</td>
                      <td height="25%" align="left" class="fontBblue" colspan="5"><input class="form-control"  type="text" name="category_type" id="category_type" value="<?=$c["category_type"];?>"  style="width:560pt" /></td>
                    </tr>
                    
                    <tr> 
                      <td height="25%" align="left" class="fontBblue"><nobr>   Fixed Description  :</td>
                      <td height="25%" align="left" class="fontBblue" colspan="5"><input class="form-control"  type="text" name="fixed_description" id="fixed_description" value="<?=$c["fixed_description"];?>"  style="width:560pt" /></td>
                    </tr>
                    
                    <tr>
                      <td height="20" align="left" class="fontBblue" ><nobr>Comment  :</td>
                      <td height="20" align="left" class="fontBblue"><nobr>
                        <input class="form-control"  name="commente" id="commente" type="text" value="<?=$c["commente"];?>">
                 </tr>
                        
                </table>
                <table align="center" class="mytable1" id="table7" cellpadding="1" cellspacing="1"><tr></tr >
                </table>
            </form></td></tr></table>
<script type="text/javascript"> 

    function CheckText(){
        if(document.form1.station_type.value == "") {
            alert('กรุณากรอก Station Type ด้วยนะคับ');                 
            document.form1.station_type.focus();
            return false;
        } 
        if(document.form1.category_type.value == "") {
            alert('กรุณากรอก Category Type ด้วยนะครับ');
            document.form1.category_type.focus(); 
            return false;
        } 

        if(document.form1.fixed_description.value == "") {
            alert('กรุณากรอก Fixed Description ด้วยนะครับ');
            document.form1.fixed_description.focus(); 
            return false;
        } 
     
        return true;
    }   

    
</script> 
</form>


 
