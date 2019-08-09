<?
header("Content-Type: text/html; charset=tis-620");             
require_once("function.php");                                   
  
 if(!checkUser()){    echo Message(35,"red",$titel1,$msg1,"<a href='index.php'> $login </a>");
  exit;
  }           
  

 include("header.php"); 

	  $sql = "SELECT * FROM tbl_category_hardware Order by cate_name ";
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
    
                <table width="100%" border="1" align="center" class="mytable" id="table7"  cellpadding="1" cellspacing="1">
			<tr>             
			<th class="th" width="5%">#</th>
                        <th class="th" width="50%">Name</th>
                        <th class="th" width="15%">Status</th> 
                        <th class="th" width="15%"></th>         
                        <th class="th" width="15%">จำนวนเหลือ</th>        
                    </tr >
		<?
			$i = 1;
			while($c = mysqli_fetch_array($rc)){						
		?>
                      <tr onclick="click2add(<?=$c["item_id"]?>);" onmouseover="this.style.backgroundColor='violet';" onmouseout="this.style.backgroundColor='white';" >        
                              <td  style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;" align="center"><?=$i?></td>
                              <td  style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;" align="center"><?=$c["item_name"];?></td>
                              <td  style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;" align="center"><??></td>
                              <td  style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;" align="center"><??></td>  
			      <td  style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;" align="center"><??></td>  
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
 function click2add(id){         
	 parent.mainPage.location.href ="stock.list.php?id="+id;       
      }  
</script>