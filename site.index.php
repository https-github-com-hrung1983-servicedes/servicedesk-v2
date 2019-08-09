<?
header("Content-Type: text/html; charset=tis-620");                 
session_start();
require_once("function.php");
                                             
  
  if(!checkUser()){    echo Message(35,"red",$titel1,$msg1,"<a href='index.php'> $login </a>");
  exit;
  }                                                                                                      
 include("header.php");                    
      $schBy =  $_REQUEST["schBy"];  
      $schTxt =  $_REQUEST["schTxt"];
	  /*
if($_SESSION['Uat'] ==  "BSS"){   */            
          $sql = "Select tbl_site.*,tbl_province.province_name From tbl_site Left Join tbl_province ON tbl_site.province_name = tbl_province.id ";
          if($schBy != ""){  
				  if($schBy=="site_id"){
					  $sql .= " where site_id like '%$schTxt%'";
				  } else  if($schBy=="site_name"){
					  $sql .= " where site_name like '$schTxt%'"; 
				  } 
		 } else {
		 	 $sql .= "   Where tbl_site.site_id  like 'M%' 
								Or tbl_site.site_id  like 'GN%' 
								Or tbl_site.site_id  like 'T%' 
								Or tbl_site.site_id  like 'SDC%' 
								Or tbl_site.site_id  like 'TBV%' ";
		 }
		 
		 $sql .= " Order by tbl_province.province_name ASC";
/* 
  }
   
   *else if($_SESSION['Uat'] ==  "MSI"){

$sql = "SELECT
tbl_site.site_id,
tbl_site.site_name,
tbl_site.address,
tbl_province.province_name,
tbl_site.contact
FROM
tbl_site
Inner Join tbl_site286 ON tbl_site286.site_id = tbl_site.site_id
Inner Join tbl_province ON tbl_site.province_name = tbl_province.id
Where tbl_site286.responsibility = 'MSI'";
 if($schBy != ""){  
				  if($schBy=="site_id"){
					  $sql .= " And site_id like '%$schTxt%'";
				  } else  if($schBy=="site_name"){
					  $sql .= " And site_name like '$schTxt%'"; 
				  } 
		 }
		 
		 $sql .= " Order by tbl_province.province_name ASC";
} */
?>
<title>Bizserv Solution Co.,Ltd</title>
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
                        <td width="879" valign="middle">         
                            <span class="fonttitle_board">&nbsp;Search by :</span> 
                            <select name="schby" id="schby">                        
                                <option value = "site_id"  <? if($schBy=="site_id") echo "selected";?> >Site ID</option>            
                                <option value = "site_name" <? if($schBy=="site_name") echo "selected";?> >Site Name</option>
                               <?php ?>         
                            </select>                                      
                            <input type="text" name="schTxt" id="schTxt" value="<?=$schTxt ?>">    
                            &nbsp;<input  type="button" name="sch" value="Search"  onclick="Search_Click(schby.value,schTxt.value)" style="width:50pt;">
                        </td>
		  
<?
if($_SESSION['Uat'] ==  "BSS" || $_SESSION['Ustate'] ==  "cmmsiadmin" || $_SESSION['Uat'] ==  "cmmsiadmin" ){?>                                                        
                        <td width="18" valign="middle">       
                            <a lang="site.form.php?typer=add" class="thickbox pointer" title="Add site">
                            <img src="image/add.JPG" alt="Add" width="20" height="20" border="0" align="right"> </a></td>
                            <td width="27" valign="middle">&nbsp;<b> Add </b></td> 
                        
                        <td width="18" valign="middle">
                        <img src="image/delete.JPG" alt="Delete" width="20" height="20" border="0" align="right">
                        </td>
                        <td width="27" valign="middle">&nbsp;<b>  Delete</b></td>
<?}?>
                    </tr>
                </table>     
                <table width="100%" align="center" class="mytable" id="table7"  cellpadding="1" cellspacing="1">
                    <tr>             
                        <th class="th" width="10%">Site ID</th>
                        <th class="th" width="25%">Site Name</th>
                        <th class="th" width="15%">Address</th>
                        <th class="th" width="10%">Province</th>
                        <th class="th" width="17%">Contact Name</th>
                        <!--th class="th" width="6%">Serial No.</th-->   
                    </tr >
                        <?  
                         $res = mysqli_query($conn,$sql);
                         $i=0;
                          while($row = mysqli_fetch_array($res)) {   
                        ?>
                       <tr onmouseover="this.style.backgroundColor='violet';" onmouseout="this.style.backgroundColor='white';" >
                        <td style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;"  align="center">
                                  <a lang="site.form.php?typer=edit&id=<?=$row["site_id"];?>&txt=<?=$schTxt?>" class="thickbox pointer" title="Edit site">&nbsp;<?=$row["site_id"];?></a></td>
                              <td  style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;" align="left">
                                  <a lang="site.form.php?typer=edit&id=<?=$row["site_id"];?>&txt=<?=$schTxt?>" class="thickbox pointer" title="Edit site">&nbsp;<?=$row["site_name"];?></a></td>
                              <td  style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;" align="left">
                                  <a lang="site.form.php?typer=edit&id=<?=$row["site_id"];?>&txt=<?=$schTxt?>" class="thickbox pointer" title="Edit site">&nbsp;<?=$row["address"];?></a></td>
                              <td  style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;" align="center">
                                 <a lang="site.form.php?typer=edit&id=<?=$row["site_id"];?>&txt=<?=$schTxt?>" class="thickbox pointer" title="Edit site">&nbsp;<?=$row["province_name"];?></a></td>
                              <td  style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;" align="center">
                                  <a lang="site.form.php?typer=edit&id=<?=$row["site_id"];?>&txt=<?=$schTxt?>" class="thickbox pointer" title="Edit site">&nbsp;<?=$row["contact"];?></a></td> 
                                  <!--td  style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;" align="center">
                                  &nbsp;<img src="image/serial_no.png" alt="Serial No." width="17pt;" height="17pt;" onclick="showSerial_no('<?//=$row["site_id"];?>');"></td-->                               
                          </tr>    
                           <?  
                          $i++;
                          }?> 
                          <tr>
                            <td colspan="10" style="padding:0px; border-bottom:1px solid #ccc; border-right:0px solid #ccc;"> Total <?=$i;?>(rows)</td>
                          </tr>   
                </table>  </form></td></tr></table>                    
<script type="text/javascript">
 function Search_Click(schby,schtxt){             
     document.location.href ="site.index.php?schBy="+schby+"&schTxt="+schtxt;
      }       
 function click2editNGV(id,typer){                        
  //       document.location.href ="site.form.php?id="+id+"&typer="+typer;       
      }
 function showSerial_no(val){
    // alert(val);
            myleft=(screen.width)?(screen.width-600)/2:100;    
            mytop=(screen.height)?(screen.height-300)/2:100;      
            properties = " width=800,height=600";                        
            properties +="directories=no,titlebar=no,toolbar=no,location=no,status=no,menubar=no,scrollbars=yes, top="+mytop+",left="+myleft;      
            window.open("serial_no_all.php?id="+val,"Entry",properties);
 }  
</script>
