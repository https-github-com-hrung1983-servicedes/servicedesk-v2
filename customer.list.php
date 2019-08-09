<?
header("Content-Type: text/html; charset=tis-620");                 
session_start();
require_once("function.php");
                                             
  
  if(!checkUser()){    echo Message(35,"red",$titel1,$msg1,"<a href='index.php?link=customer.list'> $login </a>");
  exit;
  }                                                                                                      
                    
      $schBy =  $_REQUEST["schBy"];  
      $schTxt =  $_REQUEST["schTxt"];       
  
           
          if($schBy != ""){  
              if($schBy=="customer_id"){
                  $cmd .= " where customer_id like '%$schTxt%'";
              } else {
                  $cmd .= " where customer_name like '%$schTxt%'"; 
              }
          }
          $sql = "Select * From tbl_other_customer $cmd Order by customer_name";
      
 include("header.php");      
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
            <form  method="post" name="form1" id="form1" action="#" target="_parent" onSubmit="return false";>             

                   <table width="100%" border="0" cellpadding="0" cellspacing="0" class="mytable">
                    <tr>
                        <td width="879" valign="middle" align="center">       
                             <span class="fonttitle_board">&nbsp;ค้นหาตาม :</span> 
                            <select name="schby" id="schby">                                                     
                                <option value = "customer_id"  <?if($schBy=="customer_id") echo "selected";?> >Customer ID</option>            
                                <option value = "customer_name" <?if($schBy=="customer_name") echo "selected";?> >Customer Name</option>               
                            </select>                                      
                            <input class="form-control"  type="text" name="schTxt" id="schTxt" value="<?=$schTxt ?>">    
                            &nbsp;<input class="form-control"   type="button" name="sch" value="ค้นหา"  onclick="Search_Click(schby.value,schTxt.value)" style="width:50pt;">
                        </td>                                                         
                        <td width="18" valign="middle">    
                             <a href="customer.form.php?typer=add" target="_parent">
                            <img src="image/add.JPG" alt="Add" width="20" height="20" border="0" align="right"> </a></td>
                            <td width="27" valign="middle">&nbsp;<b> เพิ่ม </b></td>    
                        <td width="18" valign="middle">
                        <img src="image/delete.JPG" alt="Delete" width="20" height="20" border="0" align="right">
                        </td>
                        <td width="27" valign="middle">&nbsp;<b>  ลบ</b></td>
                    </tr>
                </table>     
                <table width="100%" align="center" class="mytable" id="table7"  cellpadding="1" cellspacing="1">
                    <tr>             
                        <th class="th" width="10%">รหัสลูกค้า</th>
                        <th class="th" width="25%">ชื่อลูกค้า</th>
                        <th class="th" width="15%">ติดต่อ</th>
                        <th class="th" width="15%">เบอร์โทรศัพท์</th>
                        <th class="th" width="40%">ที่อยู่</th>              
                    </tr >
                        <? 
                         $res = mysql_query($sql);
                         $i=0;
                          while($row = mysql_fetch_array($res)) {   
                        ?>     
                        <tr onclick="click2edit(<?echo $row["customer_id"]?>,'edit');" onmouseover="this.style.backgroundColor='violet';" onmouseout="this.style.backgroundColor='white';" >
                        <td style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;"  align="center">
                                  &nbsp;<?=formatNum($row["customer_id"],3);?></td>
                              <td  style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;" align="left">
                                  &nbsp;<?=$row["customer_name"]?></td>
                              <td  style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;" align="center">
                              &nbsp;<?=$row["customer_contact"]?></td>
                              <td  style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;" align="center">
                              &nbsp;<?=$row["customer_tel"]?></td>
                              <td  style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;" align="left">
                                  &nbsp;<?=$row["customer_address"];?></td>
                          </tr>   
                        <?   
                          $i++;
                          }
                          ?> 
                          <tr>
                            <td colspan="10" style="padding:0px; border-bottom:1px solid #ccc; border-right:0px solid #ccc;"> จำนวนทั้งหมด <?=$i;?>แถว</td>
                          </tr>   
                </table>  </form></td></tr></table>                    
<script type="text/javascript">
 function Search_Click(schby,schtxt){       
    parent.mainPage.location.href ="customer.list.php?schBy="+schby+"&schTxt="+schtxt;
      }
         
 function click2edit(id,typer){                        
         parent.mainPage.location.href ="customer.form.php?id="+id+"&typer="+typer;       
      }
</script>
