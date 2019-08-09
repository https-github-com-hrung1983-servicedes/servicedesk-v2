<?
header("Content-Type: text/html; charset=tis-620");       
header("content-type: application/x-javascript; charset=TIS-620");          
session_start();
require_once("function.php");          
  
  if(!checkUser()){    echo Message(35,"red",$titel1,$msg1,"<a href='index.php?link=employee.form'> $login </a>");
  exit;
  }    
  
 $type = $_REQUEST["type"];  

if($type != "add" && $type !="edit" ){
	 echo Message(35,"red",$titel1,$msg1,"<a href='index.php'> $login </a>");
	 exit;
} else {
	if($type =="edit" ){
		$id = $_REQUEST["id"]; 
		$sql_employee = "Select * from tbl_user where user_id = $id";
		$rc_employee = mysqli_query($conn,$sql_employee);
		$c = mysqli_fetch_array($rc_employee);
	}
}
  if($c["id_login"]==""){
	$type_ = "add";
   } else {
	$type_ = "edit";
   }
include("header.php");   
  
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
	$("#Save").click(function(){ 
				var type = encodeURIComponent($("#type").attr('value')); 
				var id = $("#id").attr('value'); 
				var at = $("#at").attr('value'); 
				var name = $("#name").attr('value'); 
				var sname = $("#sname").attr('value'); 
				var tel = $("#tel").attr('value'); 
				var status_user = $("#status_user").attr('value');//
				$.post('function.execute.php',{ mode : "user",type : type, id : id ,at : at,name : name,sname : sname,tel : tel,status_user : status_user},
			function(data){
					window.parent.location.href ="employee.list.php?id="+Math.random(100*1000,1000/2);
				});
			return false;
		});	
		
		
		$("#at").change(function(){ 
		var strSelected = "";
        $("#at option:selected").each(function() {
            strSelected += $(this)[0].value;
				if(strSelected!="BSS"){
					$("#login_img").hide("");
					$("p").hide("");
				}else{
					$("#login_img").show("");
					$("p").show("");
				}
			});
       
		});
	
	$("#Cancel").click(function(){ 
		window.parent.location.href ="employee.list.php";
	});


});
</script>

<table width="100%" align="center" class="mytable" id="table" height="100%"   cellpadding="1" cellspacing="1" >
    <tr>
        <td valign="top" align="center"> 
            <form method="post" name="form1" id="form1"> 
				<input type="hidden" name="id" id="id"  style="width:180pt;" value="<?=$id;?>">
				<input type="hidden" name="type" id="type"  style="width:180pt;" value="<?=$type?>">
			
                   <table width="100%" align="center" border="0"  cellpadding="0" cellspacing="0" class="mytable">
				   <tr>
						<th class="th" colspan="6" align="center" >Employee</th>
				   </tr>
                    <tr>
					   <td bgcolor="white" width="95%" >&nbsp;
					   <?if($type=="edit"){?>
						   <a lang="userlogin.form.php?type=<?=$type_;?>&id=<?=$c["id_login"];?>&id_user=<?=$id?>" class="thickbox pointer" id="stay.bill">
						   <input name="button" id="login_img" name="login_img"  type="image" src="image/security.png" alt="security" align="right" width="20" height="20" />    </td>
						   </a>						
					   <td align="left" bgcolor="white" width="10%"><nobr><b><p>สร้าง Login</p></b>    <?}?></td>
                       <td bgcolor="white" ><img id="Save" name="Save" src="image/save.jpg" alt="Save" align="right" width="20" height="20" />    </td>
                       <td align="left" bgcolor="white" width="10%"><b>บันทึก</b>    </td>
					   <td><img src="image/cancel.jpg" id="Cancel" name="Cancel" alt="Cancel" width="20" height="18" border="0" align="left" /> </td>
					   <td align="left"><nobr><b> ยกเลิก</b>     </td>
                     </tr>
                </table>     
                <table align="center"  id="table" border="0" cellpadding="1" cellspacing="1" border="0">
                    <tr><br>			 
                        <td height="20" width="30%" align="left" class="fontBblue" >At : </td> 
                        <td height="20" width="70%" align="left" class="fontBblue" >
						<select name="at" id="at"  style="width:150pt;">
								<option value="BSS" <? if($c["status_user"]=="BSS") echo "selected";?>>Bizserv Solution</option>
								<option value="SDC" <? if($c["status_user"]=="SDC") echo "selected";?>>System Dot Com</option>
								<option value="BOONPA" <? if($c["status_user"]=="BOONPA") echo "selected";?>>Boonpa</option>
						</select></td>   
                    </tr >
                     <tr>			 
                        <td height="20" width="30%" align="left" class="fontBblue" >Name : </td> 
                        <td height="20" width="70%" align="left" class="fontBblue" >
						<input type="text" name="name" id="name"  style="width:180pt;" value="<?=$c["name"];?>"></td>   
                    </tr >   
                     <tr>			 
                        <td height="20" width="30%" align="left" class="fontBblue" >Surname : </td> 
                        <td height="20" width="70%" align="left" class="fontBblue" >
						<input type="text" name="sname" id="sname" value="<?=$c["sname"]?>"  style="width:180pt;"></td>   
                    </tr > 
                     <tr>			 
                        <td height="20" width="30%" align="left" class="fontBblue" >Tel. : </td> 
                        <td height="20" width="70%" align="left" class="fontBblue" >
						<input type="text" name="tel" id="tel" value="<?=$c["tel"]?>"  style="width:180pt;"></td>   
                    </tr >  
                     <tr>			 
                        <td height="20" width="30%" align="left" class="fontBblue" >Status : </td> 
                        <td height="20" width="70%" align="left" class="fontBblue" >
						<select name="status_user" id="status_user"   style="width:120pt;">
								<option value="y" <? if($c["status_user"]=="y") echo "selected";?>>Active</option>
								<option value="n" <? if($c["status_user"]=="n") echo "selected";?>>No active</option>
						</select></td>   
                    </tr >   
                </table>  </form></td></tr></table>



