<?
header("Content-Type: text/html; charset=tis-620");                 
session_start();
require_once("function.php");          
  
  if(!checkUser()){    echo Message(35,"red",$titel1,$msg1,"<a href='index.php?link=fix.gasnoil.index'> $login </a>");
  exit;
  }                                                                                                      
       
include("header.php");                           
$sql = "SELECT
					tbl_user.id_login,
					tbl_user.name,
					tbl_user.sname,
					tbl_user.gasperkilo
				FROM
					tbl_user
				Where tbl_user.at = 'BSS'
				And tbl_user.status_user = 'y'
				And tbl_user.gasperkilo is not null
				Order by tbl_user.name ASC";

?>  
<script type="text/javascript">
$(document).ready(function(){
         
		$(".Add").click(function(){  
			//		alert("sss");

			});	
				
});
</script>
<title>Bizserv Solution Co.,Ltd</title>
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
                        <td width="95%" valign="middle" align="center"> <nobr>		&nbsp;    </td>
                        <!--td valign="middle"><a lang="fix.gasnoil.form.php?type=add" class="thickbox pointer">
                        <img src="image/add.JPG"  alt="Add" width="20" height="20" border="0" align="right"> </a></td>
                        <td valign="middle"><b> เพิ่ม </b></td-->
						<td align="right"><a href="javascript:history.back(1)" ><img src="image/cancel.jpg" alt="Cancel" width="20" height="18" border="0" align="right" /> </a> </td>
                       <td align="left" valign="middle"><nobr><b> ยกเลิก</b>     </td>
                    </tr>
                </table>     
                <table width="100%" align="center" class="mytable" id="table7"  cellpadding="1" cellspacing="1">
                    <tr>			 
                        <th class="th" width="10%">#</th>
                        <th class="th" width="70%">Name</th>  
                        <th class="th" width="20%">Gas per Km.</th> 
                    </tr >
                        <?  // echo $sql;
                         $res = mysqli_query($conn,$sql);
                         $i=1;						 
                          while($row = mysqli_fetch_array($res)) {    
                             ?>
                          <tr onmouseover="this.style.backgroundColor='violet';" onmouseout="this.style.backgroundColor='white';" >
                          <td style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;"  align="center">
                              <a lang="fix.gasnoil.form.php?type=edit&id=<?=$row["id_login"]?>" class="thickbox pointer" title="Edit"><?=$i;?></a></td>
						<td style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;"  align="left">
                              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a lang="fix.gasnoil.form.php?type=edit&id=<?=$row["id_login"]?>" class="thickbox pointer" title="Edit"><?=$row["name"]." ".$row["sname"];?></a></td>
						<td style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;"  align="center">
                             <a lang="fix.gasnoil.form.php?type=edit&id=<?=$row["id_login"]?>" class="thickbox pointer" title="Edit"><?=$row["gasperkilo"];?> (Baht)</a></td>
                          </tr>  
                       <?          
							$i++;               
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
	
    function Search_Click(dte_beg,dte_end){
		 document.location.href ="bsslogcall.index.php"+"?dte_beg="+dte_beg+"&dte_end="+dte_end;
      }

      
      function click2edit(id,ubpdate_by,typer){   
		var dte_b = document.form1.date_beg.value;                         
         var dte_e = document.form1.date_end.value;
		 
        document.location.href ="bsslogcall.form.php"+"?id="+id+"&ubpdate_by="+ubpdate_by+"&type="+typer+"&dte_beg="+dte_b+"&dte_end="+dte_e;   
      }
</script>




