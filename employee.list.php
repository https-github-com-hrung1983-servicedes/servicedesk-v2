<?
header("Content-Type: text/html; charset=tis-620");                 
session_start();
require_once("function.php");          
  
  if(!checkUser()){    echo Message(35,"red",$titel1,$msg1,"<a href='index.php?link=employee.list'> $login </a>");
  exit;
  }                                                                                                      
       
include("header.php");   
  $type = $_REQUEST["typer"]; //echo $type;
  $status = $_REQUEST["status"];//echo $status;



  $cmd = "where";
  if($type!="All"){
	if($type!=""){
	 $where = $cmd." at = '$type'";
	 $cmd = " and";
	}
  }

  if($status!="All"){
	  if($status!=""){
		$where .= $cmd." status_user = '$status'";
	  }
  }

  $sql_employee = "Select * from tbl_user $where order by name";//echo $sql_employee;
  $rc_employee = mysqli_query($conn,$sql_employee);
?>  
<title>Bizserv Solution Co.,Ltd</title>
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
  
<table width="100%" align="center" class="mytable" id="table" height="100%"   cellpadding="1" cellspacing="1" >
    <tr>
        <td valign="top"> 
            <form  method="post" name="form1" id="form1" action="#" target="_parent" onSubmit="return false";> 
             

                   <table width="100%" border="0" cellpadding="0" cellspacing="0" class="mytable">
                    <tr>
                        <td width="879" valign="middle" align="center"> <nobr>		
                           <b> &nbsp;���ҵ��  :</b>
                            <select name="typer" id="typer" onchange="form1.submit();";>
                                <option value = 'All' <?if($typer=="All") echo "selected";?>>All</option>            
                                <option value = 'BSS' <?if($typer=="BSS") echo "selected";?>>Bizserv Solution</option>            
                                <option value = 'SDC' <?if($typer=="SDC") echo "selected";?>>System Dot Com</option>            
                            </select>&nbsp;<b> ʶҹ� : <b>
							  <select name="status" id="status" onchange="form1.submit();";>
							    <option value = 'All' <?if($status=="All") echo "selected";?>>������</option>            
                                <option value = 'y' <?if($status=="y") echo "selected";?>>�ӧҹ</option>            
                                <option value = 'n' <?if($status=="n") echo "selected";?>>¡���ס</option>            
                            </select>
                        </td>
                        <td width="18" valign="middle"><a href="employee.form.php?type=add" target="_parent">
                        <img src="image/add.JPG" alt="Add" width="20" height="20" border="0" align="right"> </a></td>
                        <td width="27" valign="middle">&nbsp;<b> ���� </b></td>
                    </tr>
                </table>     
                <table width="100%" align="center" class="mytable" id="table7"  cellpadding="1" cellspacing="1">
                    <tr>			 
                        <th class="th" width="7%">�ӴѺ���.</th>
                        <th class="th" width="25%">����</th>
                        <th class="th" width="25%">ʡ��</th>
                        <th class="th" width="10%">�������Ѿ��</th>
                        <th class="th" width="20%">�ѧ�Ѵ</th>
                        <th class="th" width="23%">ʶҹ�</th>   
                    </tr >
                        <? 
                          while($c_employee = mysqli_fetch_array($rc_employee)) {
                              $i++;
                              ?>
                        
                          <tr onclick="click2edit(<?=$c_employee["user_id"];?>,'edit');" onmouseover="this.style.backgroundColor='violet';" onmouseout="this.style.backgroundColor='white';" >
                          <td style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc; border-color:#003366;" align="center">
							  &nbsp;<?=$i;?></td>
                          <td style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;"  align="left">
                              &nbsp;&nbsp;<?=$c_employee["name"];?></td>
                          <td  style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;" align="left">
                              &nbsp;&nbsp;<?=$c_employee["sname"];?></td>
                          <td  style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;" align="center">
                              &nbsp;<?=$c_employee["tel"];?></td>
                          <td  style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;" align="center">
                              &nbsp;<?if($c_employee["at"]=="BSS"){echo "Bizserv Solution";}else{echo "System Dot Com";}?></td>
                          <td  style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;" align="center">
                              &nbsp;<?if($c_employee["status_user"]=="y"){echo "�ӧҹ";}else{echo "¡��ԡ";}?></td>
                          </tr>
                       <?                          
                          }
						 ?> 
                          <tr>
                            <td colspan="10" style="padding:0px; border-bottom:1px solid #ccc; border-right:0px solid #ccc;">�ӹǹ������ <?=$i?> ��</td>
                          </tr>   
                </table>  </form></td></tr></table>





<script type="text/javascript">       
      function click2edit(id,typer){    
		 parent.parent.location.href ="employee.form.php?id="+id+"&type="+typer;  
      }
</script>

