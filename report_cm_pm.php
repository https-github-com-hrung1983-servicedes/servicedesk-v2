<?
header("Content-Type: text/html; charset=tis-620");                 
session_start();
require_once("function.php");
                                             
  
  if(!checkUser()){    echo Message(35,"red",$titel1,$msg1,"<a href='index.php?link=report_cm_pm'> $login </a>");
  exit;
  }                                                                                                      
 include("header.php");     
 $type = $_REQUEST["type"];
  $months = $_REQUEST["months"];
 $years = $_REQUEST["years"];
 $today = getdate();
 if($months==""){
	$months = $today["mon"];
 }
 if($years==""){
	$years = $today["year"];
 }
?>
 
<title>Bizserv Solution Co.,Ltd</title>    
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
            <form  method="post" name="form1" id="form1" action="generate2excel.php" target="_parent"> 
			    <table width="100%" border="0" cellpadding="0" cellspacing="0" class="mytable">
                    <tr>
                        <td align ="center">
						<span class="fonttitle_board">&nbsp;Type :</span> 
                            <select name="types_site" id="types_site">  
							<? if($type=="cm"){?>
									<option value = "CMPOSNGV" <?if($months=="CMPOSNGV") echo "selected";?> >CM (POS NGV)</option>            
                                    <option value = "CMPOSOil" <?if($months=="CMPOSOil") echo "selected";?> >CM (POS Oil)</option>
							<? } else if($type=="pm")  { ?>
									<option value = "PMPOSNGV" <?if($months=="PMPOSNGV") echo "selected";?> >PM (POS NGV)</option>
									<option value = "PMPOSOil" <?if($months=="PMPOSOil") echo "selected";?> >PM (POS Oil)</option>
							<? } ?>
								</select>&nbsp;
                        <span class="fonttitle_board">&nbsp;Month :</span> 
                            <select name="months" id="months">                 
                                <option value = "01" <?if($months=="01") echo "selected";?> >January</option>            
                                <option value = "02" <?if($months=="02") echo "selected";?> >February</option>          
                                <option value = "03" <?if($months=="03") echo "selected";?> >March</option>          
                                <option value = "04" <?if($months=="04") echo "selected";?> >April</option>          
                                <option value = "05" <?if($months=="05") echo "selected";?> >May</option>          
                                <option value = "06" <?if($months=="06") echo "selected";?> >June</option>          
                                <option value = "07" <?if($months=="07") echo "selected";?> >July</option>          
                                <option value = "08" <?if($months=="08") echo "selected";?> >August</option>          
                                <option value = "09" <?if($months=="09") echo "selected";?> >September</option>          
                                <option value = "10" <?if($months=="10") echo "selected";?> >October</option>          
                                <option value = "11" <?if($months=="11") echo "selected";?> >November</option>       
                                <option value = "12" <?if($months=="12") echo "selected";?> >December</option>               
                            </select> &nbsp;

							<span class="fonttitle_board">&nbsp;Year :</span>
									<select name="years" id="years">                 
                                <option value = "2012" <?if($months==2012) echo "selected";?> >2012</option>            
                                <option value = "2013" <?if($months==2013) echo "selected";?> >2013</option>          
                                <option value = "2014" <?if($months==2014) echo "selected";?> >2014</option>          
                                <option value = "2015" <?if($months==2015) echo "selected";?> >2015</option>                      
                            </select> 
                        </td>          
						
                        <td width="18" valign="middle">       
                            <a href="#" onclick="form1.submit();">
                            <img src="image/pixadex.png" alt="Add" width="20" height="20" border="0" align="right"> </a></td>
                            <td width="27" valign="middle">&nbsp;<b><nobr>Report </b></td>                         
                        <td width="18" valign="middle">
                        <img src="image/cancel.JPG" alt="Delete" width="20" height="20" border="0" align="right">
                        </td>
                        <td width="27" valign="middle">&nbsp;<b><nobr>Cancel </b></td>
                    </tr>
                </table>     
                <!--table width="100%" align="center" class="mytable" id="table7"  cellpadding="1" cellspacing="1">
                    <tr>             
                        <th class="th" width="10%">No.</th>
                        <th class="th" width="10%">Job Type</th>
                        <th class="th" width="25%">Category Type</th>
                        <th class="th" width="35%">Category Description</th>
                        <th class="th" width="10%">GLCode</th>         
                    </tr >
                
                           
                </table-->  </form></td></tr></table>                    
