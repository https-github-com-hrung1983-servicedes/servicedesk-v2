<?
header("Content-Type: text/html; charset=tis-620");
session_start();
require_once("function.php");
if(!checkUser()){    echo Message(35,"red","ข้อความเตือน","คุณยังไม่ได้กรอกชื่อและรหัสผ่านครับ","<a href='index.php?link=fix.gasnoil.form'> เข้าสู่ระบบ </a>");
  exit;
  }
$id = $_REQUEST["id"];
$type = $_REQUEST["type"];  
if($type !="edit" ){
 echo Message(35,"red","ข้อความเตือน","คุณไม่มีสิทธิ์เข้าใช้หน้านี้","<a href='javascript:history.back(1)'> กลับ</a>");
 exit;
}
//include("header.php");                    
if ($type == "edit") {
  $sql = "SELECT
 					tbl_user.user_id,
					tbl_user.id_login,
					tbl_user.name,
					tbl_user.sname,
					tbl_user.gasperkilo
				FROM
					tbl_user
				Where tbl_user.id_login = '$id'";  
  $rs = mysqli_query($conn,$sql);
  $c = mysqli_fetch_array($rs);        
}
                
?>
<title>Bizserv Solution Co.,Ltd</title>
<meta http-equiv="Content-Type" content="text/html; charset=TIS-620" /> 
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
<meta http-equiv=Content-Type content="text/html; charset=tis-620">
<link href="css/loading.css" rel="stylesheet" type="text/css" media="all">

<script src="script/jquery.min.js"></script>
<script src="script/thickbox.js"></script>
<script src="script/loading.js"></script>

<script type="text/javascript" src="script/jquery-1.6.4.js"></script>
<script type="text/javascript" src="script/jquery_1.7.1_min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	$(".Save").click(function(){  
				var id = $("#user_id").attr('value');   
				var gaskm = $("#gaskm").attr('value'); 
				$.post('function.execute.php',{ mode : "fix.gasnoil.form", id : id, gaskm : gaskm},
				function(data){
					//	alert(data);
			window.parent.location.href ="fix.gasnoil.index.php";
				});
				return false;
		});	 
	
	$(".Cancel").click(function(){ 
		window.parent.location.href ="fix.gasnoil.index.php";
	});
		
});
</script>  
<table width="100%" align="center" class="mytable" id="table" height="80%"  bgcolor="white"  cellpadding="1" cellspacing="1" >
    <tr>                                               
        <td valign="top">                                                                              
                <table width="100%" align="center" border="0"  cellpadding="0" cellspacing="0" class="mytable">
                    <tr>
                        <th align="center" height="40" width="100%" colspan="6" class="th">Cusotmer</th>                    
                    </tr >
                    
                    <tr>
                           <td width="95%" colspan="2">&nbsp;</td>
                        <td><img id="Save" name="Save" class="Save" src="image/save.jpg" align="right" width="20" height="20" /></td>
                       <td align="left"><b>บันทึก</b>    </td>
                       <td><a href="javascript:history.back(1)" ><img src="image/cancel.jpg" alt="Cancel" width="20" height="18" border="0" align="left" /> </a> </td>
                       <td align="left"><nobr><b> ยกเลิก</b>     </td>
                     </tr>
                </table>
                <br>
              <table align="center" width="100%"  id="table" border="0" cellpadding="1" cellspacing="1" border="0" bgcolor="white">
                    <tr>
                      <td width="20%" height="20" align="left" class="fontBblue" >ID :  </td>
                      <td width="80%" align="left" class="fontBblue" colspan="4">                   
                      <input class="form-control"  type="text" name="user_id" id="user_id" value="<?=$c["user_id"];?>" style="width:100pt" readonly="readonly"></td>          
                  </tr >
                   <tr>
                      <td width="20%" height="20" align="left" class="fontBblue" >Name :  </td>  
                      <td width="80%" align="left" class="fontBblue" colspan="4">                   
                      <input class="form-control"  type="text" name="customer_name" id="customer_name" value="<?=$c["name"]." ".$c["sname"];?>" style="width:200pt" readonly="readonly"></td>          
                  </tr >
                    
                    <tr>
                      <td height="20%" align="left" class="fontBblue" ><nobr>Gas per Km. :</td>
                      <td height="30%" align="left" class="fontBblue"> 
                      <select style="width:100pt" name="gaskm" id="gaskm">
					  		<option value="0" <? if($c["gasperkilo"]=="0") echo "selected";?>>0</option>
							  						<option value="2" <? if($c["gasperkilo"]=="2") echo "selected";?>>2.0</option>	
							  						<option value="2.5" <? if($c["gasperkilo"]=="2.5") echo "selected";?>>2.5</option>	
							  						<option value="4" <? if($c["gasperkilo"]=="4") echo "selected";?>>4.0</option>	
							  						<option value="8" <? if($c["gasperkilo"]=="8") echo "selected";?>>8.0</option>	
					  </select>
					  </td>
                    </tr>
                                      
                </table>  
            </td></tr></table>

</form>
