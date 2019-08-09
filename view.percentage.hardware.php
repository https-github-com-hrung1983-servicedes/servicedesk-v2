<?
header("Content-Type: text/html; charset=tis-620");                 
session_start();
require_once("function.php");                                   
  
  if(!checkUser()){    echo Message(35,"red",$titel1,$msg1,"<a href='index.php'> $login </a>");
  exit;
  }                                         

      $dte = $_REQUEST["dte"];
      $id = $_REQUEST["id"];

     
       
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

                <table width="100%" align="center" class="mytable" id="table7"  cellpadding="1" cellspacing="1">
                <tr>             
                        <th class="th" colspan = "11" >CM POS NGV</th>
                    </tr >
                    <tr>             
                        <th class="th" width="5%" align="center" >No.</th>
                        <th class="th" width="10%">Open Date</th>
                        <th class="th" width="10%" align="center" >Job No.</th>
                        <th class="th" width="10%">Site ID</th>    
                        <th class="th" width="40%">Site Name</th> 
                        <th class="th" width="15%">Site Province</th>
                        <th class="th" width="10%">Serial No.</th>  
                    </tr >
                    <?
                    $sql = "SELECT
						tbl_log_call_center.open_call_dte,
						tbl_log_call_center.job_no,
						tbl_insident_hw.site_id,
						tbl_station_ngv.site_name,
						tbl_station_ngv.site_province,
						tbl_insident_hw.serial_no
						FROM
						tbl_log_call_center
						Inner Join tbl_insident_hw ON tbl_log_call_center.job_no = tbl_insident_hw.job_no
						Inner Join tbl_category_hardware ON tbl_insident_hw.cate_id = tbl_category_hardware.cate_id
						Inner Join tbl_station_ngv ON tbl_insident_hw.site_id = tbl_station_ngv.site_id
						Where tbl_log_call_center.open_call_dte like '$dte%'
						And tbl_log_call_center.category_type = '9'
						And tbl_log_call_center.status_call =  'close'
						And tbl_insident_hw.cate_id = '$id'"; // echo $sql;
                    $sql_all = mysqli_query($conn,$sql);
                    $i=0;
                     while($c_all = mysqli_fetch_array($sql_all)){
                         $i++;
                         ?>
                         <tr onmouseover="this.style.backgroundColor='violet';" onmouseout="this.style.backgroundColor='white';" >       
                            <td style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;"  align="center">&nbsp;<?=$i?></td>     
                            <td  style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;" align="center">&nbsp;<?=$c_all["open_call_dte"];?></td> 
                            <td  style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;" align="center">&nbsp;<?=$c_all["job_no"];?></td>    
                            <td  style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;" align="left">&nbsp;<?=$c_all["site_id"];?></td>            
                            <td style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;"  align="left">&nbsp;<?=$c_all["site_name"]?></td>      
                            <td  style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;" align="center">&nbsp;<?=$c_all["site_province"];?></td> 
                            <td  style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;" align="center">&nbsp;<?=$c_all["serial_no"];?></td>    
                        </tr>
    <?
                }
                    ?>
                </table>
                </form>