<?
header("Content-Type: text/html; charset=tis-620");                 
session_start();
require_once("function.php");          
  
  if(!checkUser()){    echo Message(35,"red",$titel1,$msg1,"<a href='index.php'> $login </a>");
  exit;
  }    
  
 $type = $_REQUEST["type"];  

if($type != "add" && $type !="edit" ){
	 echo Message(35,"red",$titel1,$msg1,"<a href='index.php'> $login </a>");
	 exit;
} else {
	if($id !="" ){
		$id = $_REQUEST["id"]; 
		$sql_user = "Select * from tbl_user_login where user_bss_id = $id";
		$rc_user = mysqli_query($conn,$sql_user);
		$c = mysqli_fetch_array($rc_user);
	//	echo $sql_user;
	}
}  
  
?>  
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
				var typer = $("#typer").attr('value'); 
				var id_user = $("#id_user").attr('value'); 
				var id = $("#id").attr('value'); 
				var user_name = $("#user_name").attr('value'); 
				var password = $("#password").attr('value'); 
				var state = $("#state").attr('value'); 
				var active = $("#active").attr('value'); 
				$.post('function.execute.php',{ mode : "user_loging", type : typer, 
				id_user : id_user,id : id ,user_name : user_name, password : password ,state : state,active : active},
				function(data){
					window.parent.location.href ="employee.list.php";
				});
				return false;
		});	 
	
	$(".Cancel").click(function(){ 
		window.parent.location.href ="employee.list.php";
	});
		
});
</script>
<table width="100%" align="center" class="mytable" id="table" height="80%"  bgcolor="white"  cellpadding="1" cellspacing="1" >
    <tr>
        <td valign="top" align="center"> 
            <form method="post" name="form1" id="form1"> 
				<input type="hidden" name="id" id="id"  style="width:180pt;" value="<?=$id;?>">
				<input type="hidden" name="id_user" id="id_user"  style="width:180pt;" value="<?=$_REQUEST["id_user"];?>">
				<input type="hidden" name="typer" id="typer"  style="width:180pt;" value="<?=$type?>">
			
                   <table width="100%" align="center" border="0"  cellpadding="0" cellspacing="0" class="mytable">
				   <tr>
						<th class="th" colspan="4" align="center" >Login</th>
				   </tr>
                    <tr>
                       <td width="95%" ><img id="Save" name="Save" class="Save" src="image/save.jpg" align="right" width="20" height="20" /></td>
                       <td align="left" width="10%"><b>บันทึก</b></td>
					   <td><img src="image/cancel.jpg" class="Cancel" id="Cancel" name="Cancel" width="20" height="18" border="0" align="left" /> </a> </td>
					   <td align="left"><nobr><b> ยกเลิก</b></td>
                     </tr>
                </table>     
                <table align="center"  id="table" border="0" cellpadding="1" cellspacing="1" border="0" bgcolor="white">
                    <tr>		 
                        <td height="20" width="30%" align="left" class="fontBblue" >Username : </td> 
                        <td height="20" width="70%" align="left" class="fontBblue" >
						<input type="text" name="user_name" id="user_name"  style="width:180pt;" value="<?=$c["user_name"];?>"></td>   
                    </tr >   
                     <tr>			 
                        <td height="20" width="30%" align="left" class="fontBblue" >Password : </td> 
                        <td height="20" width="70%" align="left" class="fontBblue" >
						<input type="password" name="password" id="password" value="<?=$c["password"]?>"  style="width:180pt;"></td>   
                    </tr > 
                     <tr>			 
                        <td height="20" width="30%" align="left" class="fontBblue" >Group. : </td> 
                        <td height="20" width="70%" align="left" class="fontBblue" >
						<select name="state" id="state"   style="width:120pt;">
								<option value="admin" <? if($c["state"]=="admin") echo "selected";?>>Admin</option>
								<option value="cm" <? if($c["state"]=="cm") echo "selected";?>>CM</option>
								<option value="helpdesk" <? if($c["state"]=="helpdesk") echo "selected";?>>Helpdesk</option>
								<option value="pm" <? if($c["state"]=="pm") echo "selected";?>>PM</option>
								<option value="user" <? if($c["state"]=="user") echo "selected";?>>User</option>
								<option value="other" <? if($c["state"]=="other") echo "selected";?>>Other</option>
						</select></td>   
                    </tr >  
                     <tr>			 
                        <td height="20" width="30%" align="left" class="fontBblue" >Active : </td> 
                        <td height="20" width="70%" align="left" class="fontBblue" >
						<select name="active" id="active"   style="width:120pt;">
								<option value="y" <? if($c["active"]=="y") echo "selected";?>>Active</option>
								<option value="n" <? if($c["active"]=="n") echo "selected";?>>No active</option>
						</select></td>   
                    </tr >   
                </table>  </form></td></tr></table>



