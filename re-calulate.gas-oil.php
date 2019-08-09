<?

header("Content-Type: text/html; charset=utf-8");         
session_start();
require_once("function.php");          
  
if(!checkUser()){    echo Message(35,"red",$titel1,$msg1,"<a href='index.php?link=re-calulate.gas-oil'> $login </a>");
  exit;
}                     
      $id =  $_REQUEST["id"]; 
      $no =  $_REQUEST["no"]; 
$sql = "SELECT
					tbl_user.gasperkilo
				FROM
					tbl_incentive_ot
				Inner Join tbl_user ON tbl_incentive_ot.other_receive = tbl_user.id_login
				where tbl_incentive_ot.id = '$id'"; // echo $sql;    
$rs = mysqli_query($conn,$sql); 
$c = mysqli_fetch_array($rs);            
   
?> 
<link href="image/bss_icon.ico"   rel="shortcut icon" />  
<link href="style/calendar.css" rel="stylesheet" type="text/css">    
<link href="style/mytable.css" rel="stylesheet" type="text/css" />   
<script type="text/javascript" src="script/calendar_date_picker.js"></script>     
<link href="style/stylecss.css" rel="stylesheet" type="text/css">
<link href="style/filtergrid.css" rel="stylesheet" type="text/css">
<link href="css/loading.css" rel="stylesheet" type="text/css" media="all">

<script src="script/jquery.min.js"></script>
<script src="script/thickbox.js"></script>
<script src="script/loading.js"></script>

<script type="text/javascript" src="script/jquery-1.6.4.js"></script>
<script type="text/javascript" src="script/jquery_1.7.1_min.js"></script>
  <script type="text/javascript">
$(document).ready(function(){
	$(".save").click(function(){  
				var id_re = $("#id_re").attr('value'); 
				var new_param = $("#new_param").attr('value'); 
				$.post('function.execute.php',{ mode : "re-cal-gas-oil", id_re : id_re, new_param : new_param},
				function(data){
					window.parent.location.href ="view.incentive.settlement.php?id="+id_re;
				});
				return false;
		});	 	
		
});
</script> 

<meta http-equiv="refresh" content="30000;"/>
<style type="text/css">
    <!--
    .mytable1 { width:100%; font-size:14px;
                border:1px solid #ccc;   
    }
    .mytable11 {width:100%; font-size:12px;
                border:1px solid #ccc;
                font-size:11px;     
    }
     .th{ background-color:#003366; color:#FFF; padding:0px; border:0px solid #ccc; height:20px; }
     .td{ border-color:#003366;};
    -->
</style>
<table width="100%" align="center" class="mytable1" id="table" height="100%"   cellpadding="1" cellspacing="1" >
    <tr>
        <td valign="top">             
<input type="hidden" name="id_re" value="<?=$id?>" id="id_re" />
                  <table width="100%" border="0" cellpadding="0" cellspacing="0" class="mytable1" bgcolor="#FFFFFF">
                    <tr>
                        <td valign="middle" align="center"> <nobr>
						
                        <td width="18" valign="middle">
                       <img id="Save" name="Save" class="Save" src="image/save.jpg" align="right" width="20" height="20" /> </td>
                        <td width="27" valign="middle"><b><nobr> Save </b>&nbsp;</td>
                    </tr>
					</table>
					<table width="100%" border="0" cellpadding="0" cellspacing="0" class="mytable1" bgcolor="#FFFFFF">
                    <tr>			 
                             <td valign="middle" align="center"> <font color="#FF0000" size="+3">Job No. : <?=$no?>  <br><br>
							  Fee : <select name="new_param" id="new_param" style="width:50pt;">					
							  						<option value="0" <? if($c["gasperkilo"]=="0") echo "selected";?>>0</option>
							  						<option value="1" <? if($c["gasperkilo"]=="1") echo "selected";?>>1.0</option>	
							  						<option value="1.25" <? if($c["gasperkilo"]=="1") echo "selected";?>>1.25</option>	
							  						<option value="1.5" <? if($c["gasperkilo"]=="1") echo "selected";?>>1.50</option>	
							  						<option value="1.75" <? if($c["gasperkilo"]=="1") echo "selected";?>>1.75</option>	
							  						<option value="2" <? if($c["gasperkilo"]=="2") echo "selected";?>>2.0</option>	
							  						<option value="2.25" <? if($c["gasperkilo"]=="2") echo "selected";?>>2.25</option>	
							  						<option value="2.5" <?if($c["gasperkilo"]=="2.5") echo "selected";?>>2.5</option>	
							  						<option value="2.75" <?if($c["gasperkilo"]=="2.75") echo "selected";?>>2.75</option>	
                                                    <option value="3" <? if($c["gasperkilo"]=="3") echo "selected";?>>3.0</option>
                                                    <option value="3.25" <? if($c["gasperkilo"]=="3.25") echo "selected";?>>3.25</option>
                                                    <option value="3.50" <? if($c["gasperkilo"]=="3.50") echo "selected";?>>3.50</option>
                                                    <option value="3.75" <? if($c["gasperkilo"]=="3.75") echo "selected";?>>3.75</option>	
							  						<option value="4" <? if($c["gasperkilo"]=="4") echo "selected";?>>4.0</option>	
							  						<option value="8" <? if($c["gasperkilo"]=="8") echo "selected";?>>8.0</option>	
							  				</select> B/Km.
							  <br><br></font></td>
				  </tr> 
                </table>  </form></td></tr></table>

                    </tr >
 </table>

