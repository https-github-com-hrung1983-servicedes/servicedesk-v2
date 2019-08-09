<? 
session_start();                 
header("Content-Type: text/html; charset=tis-620");

require_once("function.php");           
require_once("script/function.js");  
  
  if(!checkUser()){    echo Message(35,"red",$titel1,$msg1,"<a href='index.php?link=select_user'> $login </a>");         
  exit;
  }                                 
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874"> 
<link rel="stylesheet" href="style.css">

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
<title>Bizserv Solution Co.,Ltd</title>
<body  >
<br>
<center>
        <?  
		$serial_id = $_REQUEST["serial_id"];
		$sch_text = $_REQUEST["sch_text"];
        $sql = "Select * from tbl_user where at = 'BSS' And status_user = 'y' and user_id not in ('72','76','66','85','94','99') order by name";                        
        //echo $sql;
        $res = mysqli_query($conn,$sql);            
        ?>
		<script type="text/javascript">
$(document).ready(function(){

			$("#Save").click(function(){ 
						var user_id = encodeURIComponent($("#user_id").attr('value')); 
						var serial_id = $("#serial_id").attr('value');
						var sch_text = $("#sch_text").attr('value'); 
						var status_hw = "w";
						if(user_id=="asdf"){
							user_id = $("#site_name").attr('value'); 
							 status_hw = "h";
						}
						
			  
						$.post('function.execute.php',{ mode : "serialsite2onhand",serial_id : serial_id,user_id : user_id,status_hw:status_hw},
						function(data){
					//	alert(data);

						window.parent.location.href ="serialsite2onhand.php?sch_text="+sch_text+"&val="+Math.random(100*1000,1000/2);
							});
						return false;
				});	
});

	$("#site_name").hide();							  
					  function getuser_id(str){
					  				var cmd = str.value;
									if(cmd=="asdf"){
										$("#site_name").show();		
										document.getElementById("site_name").focus();    
									}else{
										$("#site_name").hide();		
									}
					  }
</script>
<input type="hidden" value="<?=$serial_id?>" name="serial_id" id="serial_id">
<input type="hidden" value="<?=$sch_text?>" name="sch_text" id="sch_text">
    <table align="center" class="mytable" id="table"   cellpadding="1" cellspacing="1">
	<tr>
                        <td bgcolor="white" width="95%" align="right" >
						<input name="Save" id="Save"  type="image" src="image/save.jpg" alt="Save" align="right" width="20" height="20" />    </td>
                       <td align="left" bgcolor="white" width="10%"><b>Save</b>    </td>
                     </tr>
    <tr>                                               
        <td valign="top" align="center" colspan="2">                                                                                
                <table border="0" cellpadding="0" cellspacing="0" class="mytable" border="1"  bordercolor="#FFFFFF">
                <tr >
                      <th width="10%" class="th" ><nobr>&nbsp;Select </th> 
             </tr>
          
            <tr>             
			<td style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;"  align="center">
				<select name="user_id"  id="user_id" onChange="getuser_id(this)" style="width:200pt">
				<? while( $row = mysqli_fetch_array($res) ){  ?>
						<option value="<?=$row["user_id"]?>"><?=$row["name"]."  ".$row["sname"]?></option>
			   <? }?>
			           <option value="asdf">อื่นๆ สำหรับเปลี่ยนสถานี</option>
				</select>
				<input type="text" value="" name="site_name" id="site_name">
			</td>      
        </tr>

        </table>
    </td></tr></table>    
</center>
</body>
</html>
