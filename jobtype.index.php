<?
header("Content-Type: text/html; charset=tis-620");                 
session_start();
require_once("function.php");
                                             
  
  if(!checkUser()){    echo Message(35,"red",$titel1,$msg1,"<a href='index.php?link=jobtype.index'> $login </a>");
  exit;
  }                                                                                                      
 include("header.php"); 
      $typer = $_REQUEST["typer"];                   
      $schBy =  $_REQUEST["schBy"];  
      $schTxt =  $_REQUEST["schTxt"];                 
          $sql = "Select category_id,station_type,category_type,fixed_description,commente From tbl_category_type";
          if($schBy != ""){  
              if($schBy=="site_id"){
                  $sql .= " where site_id like '%$schTxt%'";
              } else {
                  $sql .= " where site_name like '$schTxt%'"; 
              }
          }
            $sql .= " Order by station_type,fixed_description ASC";
      // echo "<br>".$sql;
  
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
            <form  method="post" name="form1" id="form1" action="#" target="_parent" onSubmit="return false";>             

                   <table width="100%" border="0" cellpadding="0" cellspacing="0" class="mytable">
                    <tr>
                        <td>
                        <span class="fonttitle_board">&nbsp;ประเภท :</span> 
                            <select name="typer" id="typer">                                                     
                                <option value = "a"> -All-</option>            
                                <option value = "n"  <?if($schBy=="2") echo "selected";?> >NGV</option>            
                                <option value = "o" <?if($schBy=="3") echo "selected";?> >Oil</option>            
                                <option value = "o" <?if($schBy=="4") echo "selected";?> >Amazon</option>            
                                <option value = "o" <?if($schBy=="5") echo "selected";?> >Bizserv</option>               
                            </select> 
                                 
                            <span class="fonttitle_board">&nbsp;ค้นหาตาม :</span> 
                            <select name="schby" id="schby">                                                     
                                <option value = "site_id"  <?if($schBy=="site_id") echo "selected";?> >Site ID</option>            
                                <option value = "site_name" <?if($schBy=="site_name") echo "selected";?> >Site Name</option>               
                            </select>                                      
                            <input class="form-control"  type="text" name="schTxt" id="schTxt" value="<?=$schTxt ?>">    
                            &nbsp;<input class="form-control"   type="button" name="sch" value="ค้นหา"  onclick="Search_Click(typer.value,schby.value,schTxt.value)" style="width:50pt;">
                        </td>                                                         
                        <td width="18" valign="middle">       
                            <a href="jobtype.form.php?typer=add" target="_parent">
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
                        <th class="th" width="10%">No.</th>
                        <th class="th" width="10%">Job Type</th>
                        <th class="th" width="25%">Category Type</th>
                        <th class="th" width="35%">Category Description</th>
                        <th class="th" width="10%">GLCode</th>         
                    </tr >
                        <?  
                         $res = mysql_query($sql);
                         $i=0;
                          while($row = mysql_fetch_array($res)) {  
                            $i++;  
                        ?>
                       <tr onclick="click2edit(<?=$row["category_id"]?>,'edit');" onmouseover="this.style.backgroundColor='violet';" onmouseout="this.style.backgroundColor='white';" >                                                    
                        <td style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;"  align="center">
                                  &nbsp;<?=$i;?></td>      
                              <td  style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;" align="center">
                                  &nbsp;
                              <?if($row["station_type"]=="2"){
                                  echo "NGV";
                              } else if($row["station_type"]=="3"){
                                  echo "Oil";
                              } else if($row["station_type"]=="4"){
                                  echo "Amazon";
                              } else if($row["station_type"]=="5"){
                                  echo "Bizserv";
                              }?></td>
                              <td  style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;" align="left">
                                  &nbsp;<?=$row["category_type"];?></td>
                              <td  style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;" align="left">
                                  &nbsp;<?=$row["fixed_description"];?></td>
                              <td  style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;" align="center">
                                  &nbsp;<?=$row["commente"];?></td>                                
                          </tr>    
                           <?}?> 
                          <tr>
                            <td colspan="10" style="padding:0px; border-bottom:1px solid #ccc; border-right:0px solid #ccc;"> จำนวนทั้งหมด <?=$i;?>แถว</td>
                          </tr>   
                </table>  </form></td></tr></table>                    
<script type="text/javascript">
 function Search_Click(typer,schby,schtxt){             
     parent.mainPage.location.href ="jobtype.index.php?typer="+typer+"&schBy="+schby+"&schTxt="+schtxt;
      }       
 function click2edit(id,typer){                        
         parent.mainPage.location.href ="jobtype.form.php?id="+id+"&typer="+typer;       
      }  
</script>
