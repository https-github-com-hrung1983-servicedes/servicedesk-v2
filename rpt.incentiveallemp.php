<?
header("Content-Type: text/html; charset=tis-620");                 
session_start();
require_once("function.php");
                                             
  
  if(!checkUser()){    
      echo Message(35,"red",$titel1,$msg1,"<a href='index.php?link=rpt.incentiveallemp'> $login </a>");
      exit;
  } 
  $months = $_REQUEST["months"];
    $today = getdate();
  if($months == ""){   
    $months = $today["mon"];  
     $months  = $months;
  }
  
  $years = $_REQUEST["years"];
  if($years == ""){   
    $years = $today["year"]; 
  }      
 

 
 include("header.php");  
		 $sql = "SELECT
                    tbl_incentive_ot.other_receive,
                    tbl_user_login.name,
                    tbl_user_login.sname,
                    Sum(tbl_incentive_detail.allowance) AS sumallowance,
                    Sum(tbl_incentive_detail.incentive) AS sumincentive,
                    Sum(tbl_incentive_detail.fee_hotel) AS sumfee_hotel,
                    Sum(tbl_incentive_detail.fee_oil_gas) AS sumfee_oil_gas,
                    Sum(tbl_incentive_detail.other_fee) AS sumother_fee
             FROM
             tbl_incentive_ot
                    Inner Join tbl_incentive_detail ON tbl_incentive_ot.id = tbl_incentive_detail.id
                    Inner Join tbl_user_login ON tbl_incentive_ot.other_receive = tbl_user_login.user_bss_id
             Where tbl_incentive_ot.other_date like '$years-$months%'
             Group by tbl_incentive_ot.other_receive
			 Order by tbl_user_login.name";//echo $sql;
			 $rc= mysqli_query($conn,$sql);
?>
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
            <form  method="post" name="form1" id="form1" action="#" target="_parent"> 
                <table width="100%" border="0" cellpadding="0" cellspacing="0" class="mytable">
                    <tr>
                        <td align ="center">
                        
                        <span class="fonttitle_board">&nbsp;Month :</span> 
                            <select name="months" id="months" onchange="form1.submit();">                 
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
                                    <select name="years" id="years" onchange="form1.submit();">                 
                                        <option value = "2012" <?if($years==2012) echo "selected";?> >2012</option>            
                                        <option value = "2013" <?if($years==2013) echo "selected";?> >2013</option>          
                                        <option value = "2014" <?if($years==2014) echo "selected";?> >2014</option>          
                                        <option value = "2015" <?if($years==2015) echo "selected";?> >2015</option>                      
                            </select> 
                        </td>          
                        
                        <td width="18" valign="middle">&nbsp;       
                            <!--a href="#" onclick="form1.submit();">
                            <img src="image/pixadex.png" alt="Report" width="20" height="20" border="0" align="right"> </a></td>
                            <td width="27" valign="middle">&nbsp;<b><nobr>Report </b--></td>                         
                        <td width="18" valign="middle">
                        <img src="image/cancel.JPG" alt="Delete" width="20" height="20" border="0" align="right">
                        </td>
                        <td width="27" valign="middle">&nbsp;<b><nobr>Cancel </b></td>
                    </tr>
                </table>     
                <table width="60%" align="center" class="mytable" id="table7"  cellpadding="1" cellspacing="1">
                    <tr>              
                        <th class="th" width="10%">#</th>
                        <th class="th" width="30%">����</th>
                        <th class="th" width="10%">��������§</th>        
                        <th class="th" width="10%">��� Incentive</th>           
                        <th class="th" width="10%">��ҷ��ѡ</th>           
                        <th class="th" width="10%">������</th>        
                        <th class="th" width="10%">��ҷҧ��ǹ ��� ����</th>        
                        <th class="th" width="10%">Total</th>  
                    </tr >
                  <?     
				  $i=1;
                  while($c = mysqli_fetch_array($rc)){
						  $sumallowance = $c["sumallowance"];
						  $sumincentive = $c["sumincentive"];
						  $sumfee_hotel = $c["sumfee_hotel"];
						  $sumfee_oil_gas = $c["sumfee_oil_gas"];
						  $sumother_fee = $c["sumother_fee"];
						  $total_all = $sumallowance  + $sumincentive  + $sumfee_hotel + $sumfee_oil_gas  + $sumother_fee;
                  ?>
                  <tr onmouseover="this.style.backgroundColor='violet';" onmouseout="this.style.backgroundColor='white';" >
						<td style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;"  align="center">&nbsp;<?=$i?></td>
                       <td style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;"  align="left">&nbsp;<?=$c["name"]." ".$c["sname"]?></td>
                       <td style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;"  align="right">&nbsp;<?=format_moneys($sumallowance)?></td>
                       <td style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;"  align="right">&nbsp;<?=format_moneys($sumincentive)?></td>
                       <td style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;"  align="right"><?=format_moneys($sumfee_hotel)?>&nbsp;</td>
                       <td style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;"  align="right"><?=format_moneys($sumfee_oil_gas)?>&nbsp;</td>
                       <td style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;"  align="right"><?=format_moneys($sumother_fee)?>&nbsp;</td>
					   </td> 
					   <td style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;"  align="right"><?=format_moneys($total_all)?>&nbsp;</td>
                  </tr>
                   <? $i++;
						  $sumallowance_all += $sumallowance;
						  $sumincentive_all += $sumincentive;
						  $sumfee_hotel_all += $sumfee_hotel;
						  $sumfee_oil_gas_all += $sumfee_oil_gas;
						  $sumother_fee_all += $sumother_fee;
						  $total_all_all += $total_all;
                      }
                  ?>  
				   <tr onmouseover="this.style.backgroundColor='violet';" onmouseout="this.style.backgroundColor='white';" >
                       <td colspan="2" style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;"  align="center">&nbsp;<b>Total : </b></td>
                       <td style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;"  align="right">&nbsp;<b><?=format_moneys($sumallowance_all)?></b></td>
                       <td style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;"  align="right">&nbsp;<b><?=format_moneys($sumincentive_all)?></b></td>
                       <td style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;"  align="right">&nbsp;<b><?=format_moneys($sumfee_hotel_all)?>&nbsp;</b></td>
                       <td style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;"  align="right">&nbsp;<b><?=format_moneys($sumfee_oil_gas_all)?>&nbsp;</b></td>
                       <td style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;"  align="right">&nbsp;<b><?=format_moneys($sumother_fee_all)?>&nbsp;</b></td>
					   </td> 
					   <td style="padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;"  align="right">&nbsp;<b><?=format_moneys($total_all_all)?>&nbsp;</b></td>
                  </tr>
                </table>  </form></td></tr></table>       
<script type="text/javascript">
function click2print(id){                                                  
            parent.blank.location.href ="rpt.incentive.settlement.php?id="+id;
      }
	  function click2print(id){                                                  
            parent.parent.location.href ="view.incentive.settlement.php?id="+id;
      }
</script>

