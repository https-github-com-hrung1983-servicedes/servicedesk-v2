<? 
session_start();                 
header("Content-Type: text/html; charset=tis-620");

require_once("function.php");           
//require_once("script/function.js");  
  
  if(!checkUser()){    echo Message(35,"red",$titel1,$msg1,"<a href='index.php?link=sch_user'> $login </a>");         
  exit;
  }                                 
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874"> 
<link rel="stylesheet" href="style.css">
<script language="javascript" src="script.js"></script>    
<script language="JavaScript">       
   function SelectedVal(frm,id,name){    
   if(frm=="UserReciptID"){              
        window.opener.document.form1.UserReciptID.value = id;
        window.opener.document.form1.cmbUserReceipt.value = name;           
   } else if(frm=="cmbUserEngineer"){
        window.opener.document.form1.UserEngineerID.value = id;
        window.opener.document.form1.cmbUserEngineer.value = name;
   } else if(frm=="bsslogcalluser"){
	    window.opener.document.form1.job_reciept_user_idx.value = id;
        window.opener.document.form1.job_reciept_user_name.value = name;
   } else if(frm=="bsslogcalleng"){
	    window.opener.document.form1.job_engineer_reciept_id.value = id;
        window.opener.document.form1.job_engineer_reciept_name.value = name;
   }
        window.close();
   }    
    </script> 
   <link href="style/mytable.css" rel="stylesheet" type="text/css" />

<title>Bizserv Solution Co.,Ltd</title></head>
  <style type="text/css">
    <!--
   .th{ background-color:#003366; color:#FFF; padding:0px; border:0px solid #ccc; height:20px; }  
    -->
</style> 
<body  >
<br>
<center>
        <?
        $type = $_REQUEST["type"]; 
        $frm = $_REQUEST["frm"]; 
        $sql = "Select * from tbl_user where at = '$type' And status_user = 'y' order by name";                        
        //echo $sql;
        $res = mysqli_query($conn,$sql);            
        ?>
        <table align="center" bordercolor="#000000"   class="mytable" id="table7" border="0" width="60%"> 
                <tr  >
                      <th width="10%" class="th" ><nobr>&nbsp;No. :</th>                                 
                      <th width="30%" class="th" ><nobr>&nbsp;Name<nobr></th>    
                      <th width="40%" class="th" ><nobr>&nbsp;Surname<nobr></th>
                      <th width="20%" class="th" ><nobr>&nbsp;Telphone<nobr></th>
             </tr>
          <?   $i = 1;
             while( $row = mysqli_fetch_array($res) ){
            ?>
            <tr style="cursor:hand"onmouseover=high(this) onmouseout=low(this) onClick="SelectedVal('<?=$frm?>','<?=$row[user_id]?>','<?=$row[name]." ".$row[sname]." (".$row[tel].")"?>')"> 
            <?                                                                                                                    
            echo"<td  style='padding:0px; border-bottom:1px solid #ccc; border-right:0px solid #ccc;' align = 'center'>$i</td> ";             
            echo"<td  style='padding:0px; border-bottom:1px solid #ccc; border-right:0px solid #ccc;'>&nbsp;$row[name]</td> ";            
            echo"<td  style='padding:0px; border-bottom:1px solid #ccc; border-right:0px solid #ccc;'>&nbsp;$row[sname]</td> ";           
            echo"<td  style='padding:0px; border-bottom:1px solid #ccc; border-right:0px solid #ccc;'>&nbsp;$row[tel]</td> ";            
            ?>         
        </tr>
        <?
             $i++;
             }?>
            
        </table>
        
</center>
</body>
</html>
