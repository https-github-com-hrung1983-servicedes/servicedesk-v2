<?
header("Content-Type: text/html; charset=tis-620");             
require_once("function.php");                                   
  
 if(!checkUser()){    echo Message(35,"red",$titel1,$msg1,"<a href='index.php'> $login </a>");
  exit;
  }           
  

 include("header.php"); 

	  $id = $_REQUEST["id"];
	  $sql = "select * from tbl_category_hardware order by cate_name";
				   //echo $sql;
	  $rc = mysqli_query($conn,$sql);   

?>
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
            <form  method="post" name="form1" id="form1" action="#" target="_parent">             

                   <table width="100%" border="0" cellpadding="0" cellspacing="0" class="mytable">
                    <tr>
                        <td align="center">
                        <span class="fonttitle_board">&nbsp;</span> 
                            </td>
                    </tr>
                </table>     
                <table width="100%" border="1" align="center" class="mytable" id="table7"  cellpadding="1" cellspacing="1">
				

					<tr>             
						<th class="th" width="5%">ลำดับที่</th>
                        <th class="th" width="15%">วันที่</th>
                        <th class="th" width="15%">เวลา</th> 
                        <th class="th" width="20%">Serial No.</th>         
                        <th class="th" width="20%">Status</th>   
                        <th class="th" width="25%">Comment</th>        
                    </tr >
					<?
					$i = 1;
					while($c = mysqli_fetch_array($rc)){						
					?>
                      <tr onclick="click2add(<?=$row["item_id"]?>);" onmouseover="this.style.backgroundColor='violet';" onmouseout="this.style.backgroundColor='white';" >        
                              <td  style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;" align="center"><?=$i?></td>
                              <td  style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;" align="center"><?=$c["date_"];?></td>
                              <td  style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;" align="center"><?=$c["time_"];?></td>
                              <td  style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;" align="center"><?=$c["serial_no"];?></td>  
								  <td  style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;" align="center"><?=$c["status_item"];?></td> 
								  <td  style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;" align="center"><?=$c["comment_"];?></td> 
                          </tr>
						  <?$i++; }?>
                </table>  

				</form></td></tr>		
				

				
				</table> 

<script type="text/javascript">
 //
 function Search_Click(typer,schby,schtxt){             
        self.mainPage.location.href ="jobtype.index.php?typer="+typer+"&schBy="+schby+"&schTxt="+schtxt;
      }       
 function click2add(id,typer){                        
         parent.mainPage.location.href ="stock.list.php?id="+id+"&typer="+typer;       
      }  
</script>