<?
header("Content-Type: text/html; charset=tis-620");
session_start();
require_once("function.php");
//require_once("script/function.js");
  if($_SESSION['Uat'] == "SNT"){
    $re_link="retail/logcall.retail.index.php";
  }
  else{
    $re_link="index.php?link=header";
  }
  if(!checkUser()){    echo Message(35,"red",$titel1,$msg1,"<a href='$re_link'> $login </a>");
  exit;
  }
 ?>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=windows-874">
   
<style type="text/css">

body {
	background-color:  #FFFFFF;
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;

}

</style></head>
<title>Bizserv Solution Co.,Ltd</title>
<body>
<center >
<table bgcolor="#799BD8" width="100%" border="0" cellpadding="0" cellspacing="0"  >
    <tr>
	<? if($_SESSION['Uat'] ==  "BSS") { ?>
		<td height="50" >
<a href="http://www.bizservsolution.com/servicedesk/retail/logcall.retail.index.php"><font size="+3" color="black">Retail</font></a>&nbsp;&nbsp;
<a href="http://www.bizservsolution.com/servicedesk/ptg/logcall.retail.index.php"><font size="+3" color="black">PTG</font></a>


		</td>



<? } else if($_SESSION['Uat'] ==  "MSI"){ ?>
		<td height="50" >
<a href="http://www.bizservsolution.com/servicedesk/retail/logcall.retail.index.php"><font size="+3" color="black">Bizserv Solution</font></a>
<?}?>
                    <td align="right" ><font size="-1" color="#FFFFFF"><nobr><b>Username : </b><?echo $_SESSION['Uname']." ".$_SESSION['Usname'];?> </font>&nbsp;<br>
                    <font size="-1" color="#FFFFFF"><b>IP Address :</b></font><font size="-1" color="#FFFFFF"> <?echo $_SERVER['REMOTE_ADDR'];?>&nbsp;</font>
      </td>
  </tr>
  <tr>
         <td colspan="2" align="center">
        <script type="text/javascript" src="script/stmenu.js"></script>



<script type="text/javascript">
<? if($_SESSION['Uat'] ==  "BSS") { ?>

<!--
stm_bm(["menu4d8f",700,"","script/blank.gif",0,"","",0,0,0,0,30,1,0,0,"","",0,0,1,1,"default","hand","",1,15],this);
stm_bp("p0",[0,4,0,0,0,4,0,16,100,"",-2,"",-2,90,0,0,"#999999","transparent","",3,0,0,"#E6FAB4 #788C32 #788C32 #E6FAB4"]);
stm_ai("p0i0",[0,"Home","","",-1,-1,0,"cm_sla_showdata.php","_self","","","","",0,0,0,"","",0,0,0,1,1,"#9cc2c9",0,"#9cc2c9",0,"","",3,3,1,1,"#BEE6F0 #64878C #64878C #BEE6F0","#64878C #BEE6F0 #BEE6F0 #64878C","#333366","#333366","bold 8pt Arial","bold 8pt Arial",0,0,"","","","",0,0,0],80,20);

stm_ai("p0i1",[0,"Dashboard","","",-1,-1,0,"rpt.summary.showdata.php","_self","","","","",0,0,0,"","",0,0,0,1,1,"#9cc2c9",0,"#9cc2c9",0,"","",3,3,1,1,"#BEE6F0 #64878C #64878C #BEE6F0","#64878C #BEE6F0 #BEE6F0 #64878C","#333366","#333366","bold 8pt Arial","bold 8pt Arial",0,0,"","","","",0,0,0],80,20);



stm_aix("p0i1","p0i0",[0,"Log call center","","",-1,-1,0,"#","_self","","","","",0,0,0,"","",0,0,0,1,1,"#9cc2c9",0,"#9cc2c9",0,"","",3,3,1,1,"#BEE6F0 #64878C #64878C #BEE6F0","#64878C #BEE6F0 #BEE6F0 #64878C","#333366","#333366","bold 8pt Arial","bold 8pt Arial",0,0,"","","","",0,0,0],80,20);
stm_bp("p1",[1,4,0,0,0,4,0,0,100,"",-2,"",-2,58,0,0,"#999999","transparent","",3,0,0,"#000000"]);
stm_aix("p1i0","p0i0",[0,"Logcall Center","","",-1,-1,0,"logcall.index.php","_self","","","","",0,0,0,"","",0,0,0,0,1,"#9cc2c9",0,"#9cc2c9",0,"","",3,3,1,1,"#FFFFFF #A0A0A0 #A0A0A0 #FFFFFF","#A0A0A0 #FFFFFF #FFFFFF #A0A0A0","#4B4B4B","#000000","8pt Arial","8pt Arial"],120,20);
stm_aix("p1i0","p0i0",[0,"Logcall Center-BSS","","",-1,-1,0,"bsslogcall.index.php","_self","","","","",0,0,0,"","",0,0,0,0,1,"#9cc2c9",0,"#9cc2c9",0,"","",3,3,1,1,"#FFFFFF #A0A0A0 #A0A0A0 #FFFFFF","#A0A0A0 #FFFFFF #FFFFFF #A0A0A0","#4B4B4B","#000000","8pt Arial","8pt Arial"],120,20);
//stm_aix("p1i0","p0i0",[0,"Files Site","","",-1,-1,0,"upload.data.php","_self","","","","",0,0,0,"","",0,0,0,0,1,"#9cc2c9",0,"#9cc2c9",0,"","",3,3,1,1,"#FFFFFF #A0A0A0 #A0A0A0 #FFFFFF","#A0A0A0 #FFFFFF #FFFFFF #A0A0A0","#4B4B4B","#000000","8pt Arial","8pt Arial"],120,20);



<? if($_SESSION['Ustate'] ==  "helpdesk" || $_SESSION['Ustate'] ==  "admin" || $_SESSION['Uid'] ==  "31" ){ ?>
stm_aix("p1i0","p0i0",[0,"Service Report","","",-1,-1,0,"logcall.index.excel.form.php","_self","","","","",0,0,0,"","",0,0,0,0,1,"#9cc2c9",0,"#9cc2c9",0,"","",3,3,1,1,"#FFFFFF #A0A0A0 #A0A0A0 #FFFFFF","#A0A0A0 #FFFFFF #FFFFFF #A0A0A0","#4B4B4B","#000000","8pt Arial","8pt Arial"],120,20);
stm_aix("p1i0","p0i0",[0,"Service Report -1","","",-1,-1,0,"logcall.index.excel.form2nim.php","_self","","","","",0,0,0,"","",0,0,0,0,1,"#9cc2c9",0,"#9cc2c9",0,"","",3,3,1,1,"#FFFFFF #A0A0A0 #A0A0A0 #FFFFFF","#A0A0A0 #FFFFFF #FFFFFF #A0A0A0","#4B4B4B","#000000","8pt Arial","8pt Arial"],120,20);
stm_aix("p1i0","p0i0",[0,"Service Report -2","","",-1,-1,0,"logcall.index.excel.form2callcenter.php","_self","","","","",0,0,0,"","",0,0,0,0,1,"#9cc2c9",0,"#9cc2c9",0,"","",3,3,1,1,"#FFFFFF #A0A0A0 #A0A0A0 #FFFFFF","#A0A0A0 #FFFFFF #FFFFFF #A0A0A0","#4B4B4B","#000000","8pt Arial","8pt Arial"],120,20);
stm_aix("p1i0","p0i0",[0,"Service Ricoh Report ","","",-1,-1,0,"logcall.index.excel.form4ricoh.php","_self","","","","",0,0,0,"","",0,0,0,0,1,"#9cc2c9",0,"#9cc2c9",0,"","",3,3,1,1,"#FFFFFF #A0A0A0 #A0A0A0 #FFFFFF","#A0A0A0 #FFFFFF #FFFFFF #A0A0A0","#4B4B4B","#000000","8pt Arial","8pt Arial"],120,20);
stm_aix("p1i0","p0i0",[0,"FSLA Report","","",-1,-1,0,"logcall.index.excel.form4ptt.php","_self","","","","",0,0,0,"","",0,0,0,0,1,"#9cc2c9",0,"#9cc2c9",0,"","",3,3,1,1,"#FFFFFF #A0A0A0 #A0A0A0 #FFFFFF","#A0A0A0 #FFFFFF #FFFFFF #A0A0A0","#4B4B4B","#000000","8pt Arial","8pt Arial"],120,20);

<? } ?>





//stm_aix("p1i0","p0i0",[0,"Service Report","","",-1,-1,0,"logcall.index.excel.form1.php","_self","","","","",0,0,0,"","",0,0,0,0,1,"#9cc2c9",0,"#9cc2c9",0,"","",3,3,1,1,"#FFFFFF #A0A0A0 #A0A0A0 #FFFFFF","#A0A0A0 #FFFFFF #FFFFFF #A0A0A0","#4B4B4B","#000000","8pt Arial","8pt Arial"],120,20);
stm_aix("p1i0","p0i0",[0,"Serial All NGV","","",-1,-1,0,"serial.export.php","_blank","","","","",0,0,0,"","",0,0,0,0,1,"#9cc2c9",0,"#9cc2c9",0,"","",3,3,1,1,"#FFFFFF #A0A0A0 #A0A0A0 #FFFFFF","#A0A0A0 #FFFFFF #FFFFFF #A0A0A0","#4B4B4B","#000000","8pt Arial","8pt Arial"],120,20);
stm_aix("p1i0","p0i0",[0,"Serial All NGV DEALER","","",-1,-1,0,"serial.export.ngvdealer.php","_blank","","","","",0,0,0,"","",0,0,0,0,1,"#9cc2c9",0,"#9cc2c9",0,"","",3,3,1,1,"#FFFFFF #A0A0A0 #A0A0A0 #FFFFFF","#A0A0A0 #FFFFFF #FFFFFF #A0A0A0","#4B4B4B","#000000","8pt Arial","8pt Arial"],120,20);
stm_aix("p1i0","p0i0",[0,"Serial All OIL","","",-1,-1,0,"serial.export.oil1.php","_blank","","","","",0,0,0,"","",0,0,0,0,1,"#9cc2c9",0,"#9cc2c9",0,"","",3,3,1,1,"#FFFFFF #A0A0A0 #A0A0A0 #FFFFFF","#A0A0A0 #FFFFFF #FFFFFF #A0A0A0","#4B4B4B","#000000","8pt Arial","8pt Arial"],120,20);


//stm_aix("p1i0","p0i0",[0,"Serial All NGV -1","","",-1,-1,0,"serial.export1.php","_blank","","","","",0,0,0,"","",0,0,0,0,1,"#9cc2c9",0,"#9cc2c9",0,"","",3,3,1,1,"#FFFFFF #A0A0A0 #A0A0A0 #FFFFFF","#A0A0A0 #FFFFFF #FFFFFF #A0A0A0","#4B4B4B","#000000","8pt Arial","8pt Arial"],120,20);


//stm_aix("p1i0","p0i0",[0,"Serial All NGV -2","","",-1,-1,0,"serial.export2.php","_blank","","","","",0,0,0,"","",0,0,0,0,1,"#9cc2c9",0,"#9cc2c9",0,"","",3,3,1,1,"#FFFFFF #A0A0A0 #A0A0A0 #FFFFFF","#A0A0A0 #FFFFFF #FFFFFF #A0A0A0","#4B4B4B","#000000","8pt Arial","8pt Arial"],120,20);
//stm_aix("p1i0","p0i0",[0,"Serial All NGV -3","","",-1,-1,0,"serial.export3.php","_blank","","","","",0,0,0,"","",0,0,0,0,1,"#9cc2c9",0,"#9cc2c9",0,"","",3,3,1,1,"#FFFFFF #A0A0A0 #A0A0A0 #FFFFFF","#A0A0A0 #FFFFFF #FFFFFF #A0A0A0","#4B4B4B","#000000","8pt Arial","8pt Arial"],120,20);

//stm_aix("p1i0","p0i0",[0,"Serial All Oil","","",-1,-1,0,"serial.export.oil.php","_self","","","","",0,0,0,"","",0,0,0,0,1,"#9cc2c9",0,"#9cc2c9",0,"","",3,3,1,1,"#FFFFFF #A0A0A0 #A0A0A0 #FFFFFF","#A0A0A0 #FFFFFF #FFFFFF #A0A0A0","#4B4B4B","#000000","8pt Arial","8pt Arial"],120,20);


stm_aix("p1i0","p0i0",[0,"Summary Serial NGV","","",-1,-1,0,"summary.serail.all.php","_blank","","","","",0,0,0,"","",0,0,0,0,1,"#9cc2c9",0,"#9cc2c9",0,"","",3,3,1,1,"#FFFFFF #A0A0A0 #A0A0A0 #FFFFFF","#A0A0A0 #FFFFFF #FFFFFF #A0A0A0","#4B4B4B","#000000","8pt Arial","8pt Arial"],120,20);
stm_aix("p1i0","p0i0",[0,"Summary Serial OIL","","",-1,-1,0,"summary.serail.oil.php","_blank","","","","",0,0,0,"","",0,0,0,0,1,"#9cc2c9",0,"#9cc2c9",0,"","",3,3,1,1,"#FFFFFF #A0A0A0 #A0A0A0 #FFFFFF","#A0A0A0 #FFFFFF #FFFFFF #A0A0A0","#4B4B4B","#000000","8pt Arial","8pt Arial"],120,20);
stm_aix("p1i0","p0i0",[0,"Top 10 hardware ","","",-1,-1,0,"top10hardware.php","_blank","","","","",0,0,0,"","",0,0,0,0,1,"#9cc2c9",0,"#9cc2c9",0,"","",3,3,1,1,"#FFFFFF #A0A0A0 #A0A0A0 #FFFFFF","#A0A0A0 #FFFFFF #FFFFFF #A0A0A0","#4B4B4B","#000000","8pt Arial","8pt Arial"],120,20);
stm_aix("p1i0","p0i0",[0,"Top 10 Site ","","",-1,-1,0,"top10site.php","_blank","","","","",0,0,0,"","",0,0,0,0,1,"#9cc2c9",0,"#9cc2c9",0,"","",3,3,1,1,"#FFFFFF #A0A0A0 #A0A0A0 #FFFFFF","#A0A0A0 #FFFFFF #FFFFFF #A0A0A0","#4B4B4B","#000000","8pt Arial","8pt Arial"],120,20);






//stm_aix("p1i0","p0i0",[0,"Serial byR category","","",-1,-1,0,"getserialno.job.date.site.php","_self","","","","",0,0,0,"","",0,0,0,0,1,"#9cc2c9",0,"#9cc2c9",0,"","",3,3,1,1,"#FFFFFF #A0A0A0 #A0A0A0 #FFFFFF","#A0A0A0 #FFFFFF #FFFFFF #A0A0A0","#4B4B4B","#000000","8pt Arial","8pt Arial"],120,20);

//stm_aix("p1i0","p0i0",[0,"Summary 3G Network donw","","",-1,-1,0,"site.max.3g.php","_self","","","","",0,0,0,"","",0,0,0,0,1,"#9cc2c9",0,"#9cc2c9",0,"","",3,3,1,1,"#FFFFFF #A0A0A0 #A0A0A0 #FFFFFF","#A0A0A0 #FFFFFF #FFFFFF #A0A0A0","#4B4B4B","#000000","8pt Arial","8pt Arial"],120,20);

<?// }?>
//stm_aix("p1i0","p0i0",[0,"Dirly Job Logcall 3G","","",-1,-1,0,"statisticssolve3g.index.php","_self","","","","",0,0,0,"","",0,0,0,0,1,"#9cc2c9",0,"#9cc2c9",0,"","",3,3,1,1,"#FFFFFF #A0A0A0 #A0A0A0 #FFFFFF","#A0A0A0 #FFFFFF #FFFFFF #A0A0A0","#4B4B4B","#000000","8pt Arial","8pt Arial"],120,20);

//stm_aix("p1i0","p0i0",[0,"Percentage 3g up and down","","",-1,-1,0,"count.3g.job.list.php","_self","","","","",0,0,0,"","",0,0,0,0,1,"#9cc2c9",0,"#9cc2c9",0,"","",3,3,1,1,"#FFFFFF #A0A0A0 #A0A0A0 #FFFFFF","#A0A0A0 #FFFFFF #FFFFFF #A0A0A0","#4B4B4B","#000000","8pt Arial","8pt Arial"],120,20);

//stm_aix("p1i0","p0i0",[0,"Dirly Job Logcall 3G","","",-1,-1,0,"rpt.statisticssolve3g.php","_self","","","","",0,0,0,"","",0,0,0,0,1,"#9cc2c9",0,"#9cc2c9",0,"","",3,3,1,1,"#FFFFFF #A0A0A0 #A0A0A0 #FFFFFF","#A0A0A0 #FFFFFF #FFFFFF #A0A0A0","#4B4B4B","#000000","8pt Arial","8pt Arial"],120,20);



//stm_aix("p1i0","p0i0",[0,"Serial PM Dirly Report","","",-1,-1,0,"serial.export.pm.php","_self","","","","",0,0,0,"","",0,0,0,0,1,"#9cc2c9",0,"#9cc2c9",0,"","",3,3,1,1,"#FFFFFF #A0A0A0 #A0A0A0 #FFFFFF","#A0A0A0 #FFFFFF #FFFFFF #A0A0A0","#4B4B4B","#000000","8pt Arial","8pt Arial"],120,20);
stm_ep();

//stm_ai("p0i0",[0,"Check the Distance","","",-1,-1,0,"check.distance.php","_self","","","","",0,0,0,"","",0,0,0,1,1,"#9cc2c9",0,"#9cc2c9",0,"","",3,3,1,1,"#BEE6F0 #64878C #64878C #BEE6F0","#64878C #BEE6F0 #BEE6F0 #64878C","#333366","#333366","bold 8pt Arial","bold 8pt Arial",0,0,"","","","",0,0,0],80,20);


<? if($_SESSION['Ustate'] ==  "helpdesk" || $_SESSION['Ustate'] ==  "admin" ){ ?>
stm_aix("p0i3","p0i0",[0,"Stock","","",-1,-1,0,"#","_self","","","","",0,0,0,"script/0604scroll2ldlalr.gif","script/0604scroll2ldlalr.gif",16,9],80,20);
stm_bp("p1",[1,4,0,0,0,4,0,0,100,"",-2,"",-2,58,0,0,"#999999","transparent","",3,0,0,"#000000"]);
stm_aix("p1i1","p1i0",[0,"Stock","","",-1,-1,0,"hw.expose.list.php","_self","","","","",0,0,0,"","",0,0,0,0,1,"#9cc2c9",0,"#9cc2c9",0,"","",3,3,1,1,"#FFFFFF #A0A0A0 #A0A0A0 #FFFFFF","#A0A0A0 #FFFFFF #FFFFFF #A0A0A0","#4B4B4B","#000000","8pt Arial","8pt Arial"],120,20);
stm_aix("p1i1","p1i0",[0,"On hand by service","","",-1,-1,0,"hw.onhand.list.php","_self","","","","",0,0,0,"","",0,0,0,0,1,"#9cc2c9",0,"#9cc2c9",0,"","",3,3,1,1,"#FFFFFF #A0A0A0 #A0A0A0 #FFFFFF","#A0A0A0 #FFFFFF #FFFFFF #A0A0A0","#4B4B4B","#000000","8pt Arial","8pt Arial"],120,20);
stm_aix("p1i1","p1i0",[0,"On hand all service","","",-1,-1,0,"stock.ngv.bss-1.php","_self","","","","",0,0,0,"","",0,0,0,0,1,"#9cc2c9",0,"#9cc2c9",0,"","",3,3,1,1,"#FFFFFF #A0A0A0 #A0A0A0 #FFFFFF","#A0A0A0 #FFFFFF #FFFFFF #A0A0A0","#4B4B4B","#000000","8pt Arial","8pt Arial"],120,20);
stm_aix("p1i1","p1i0",[0,"Repair.","","",-1,-1,0,"hw.waitrepair.list.php","_self","","","","",0,0,0,"","",0,0,0,0,1,"#9cc2c9",0,"#9cc2c9",0,"","",3,3,1,1,"#FFFFFF #A0A0A0 #A0A0A0 #FFFFFF","#A0A0A0 #FFFFFF #FFFFFF #A0A0A0","#4B4B4B","#000000","8pt Arial","8pt Arial"],120,20);
stm_aix("p1i1","p1i0",[0,"Fix (S/N) ","","",-1,-1,0,"rpt.wait.sent.to.site.php","_self","","","","",0,0,0,"","",0,0,0,0,1,"#9cc2c9",0,"#9cc2c9",0,"","",3,3,1,1,"#FFFFFF #A0A0A0 #A0A0A0 #FFFFFF","#A0A0A0 #FFFFFF #FFFFFF #A0A0A0","#4B4B4B","#000000","8pt Arial","8pt Arial"],120,20);

stm_ep();
<? } 

?>
stm_aix("p0i3","p0i0",[0,"Stock","","",-1,-1,0,"#","_self","","","","",0,0,0,"script/0604scroll2ldlalr.gif","script/0604scroll2ldlalr.gif",16,9],80,20);
stm_bp("p1",[1,4,0,0,0,4,0,0,100,"",-2,"",-2,58,0,0,"#999999","transparent","",3,0,0,"#000000"]);
stm_aix("p1i1","p1i0",[0,"On hand by service","","",-1,-1,0,"hw.onhand.list.php","_self","","","","",0,0,0,"","",0,0,0,0,1,"#9cc2c9",0,"#9cc2c9",0,"","",3,3,1,1,"#FFFFFF #A0A0A0 #A0A0A0 #FFFFFF","#A0A0A0 #FFFFFF #FFFFFF #A0A0A0","#4B4B4B","#000000","8pt Arial","8pt Arial"],120,20);

<? if($_SESSION['Ustate'] ==  "admin" || $_SESSION['Ustate'] ==  "user" || $_SESSION['Ustate'] ==  "cm" || $_SESSION['Ustate'] ==  "helpdesk"){ ?>
stm_aix("p1i1","p1i0",[0,"On hand all service","","",-1,-1,0,"stock.ngv.bss-1.php","_self","","","","",0,0,0,"","",0,0,0,0,1,"#9cc2c9",0,"#9cc2c9",0,"","",3,3,1,1,"#FFFFFF #A0A0A0 #A0A0A0 #FFFFFF","#A0A0A0 #FFFFFF #FFFFFF #A0A0A0","#4B4B4B","#000000","8pt Arial","8pt Arial"],120,20);
<?}?>
stm_ep();


stm_aix("p0i3","p0i0",[0,"Setting","","",-1,-1,0,"#","_self","","","","",0,0,0,"script/0604scroll2ldlalr.gif","script/0604scroll2ldlalr.gif",16,9],80,20);
stm_bp("p1",[1,4,0,0,0,4,0,0,100,"",-2,"",-2,58,0,0,"#999999","transparent","",3,0,0,"#000000"]);

<? if($_SESSION['Ustate'] ==  "helpdesk" || $_SESSION['Ustate'] ==  "admin" ){ ?>
stm_aix("p1i1","p1i0",[0,"Job Rename","","",-1,-1,0,"rename_jobno.php","_self","","","","",0,0,0,"","",0,0,0,0,1,"#9cc2c9",0,"#9cc2c9",0,"","",3,3,1,1,"#FFFFFF #A0A0A0 #A0A0A0 #FFFFFF","#A0A0A0 #FFFFFF #FFFFFF #A0A0A0","#4B4B4B","#000000","8pt Arial","8pt Arial"],120,20);
stm_aix("p1i1","p1i0",[0,"Upload File","","",-1,-1,0,"upload_form.php","_self","","","","",0,0,0,"","",0,0,0,0,1,"#9cc2c9",0,"#9cc2c9",0,"","",3,3,1,1,"#FFFFFF #A0A0A0 #A0A0A0 #FFFFFF","#A0A0A0 #FFFFFF #FFFFFF #A0A0A0","#4B4B4B","#000000","8pt Arial","8pt Arial"],120,20);
stm_aix("p1i1","p1i0",[0,"Serial Manager","","",-1,-1,0,"serial.manager.php","_self","","","","",0,0,0,"","",0,0,0,0,1,"#9cc2c9",0,"#9cc2c9",0,"","",3,3,1,1,"#FFFFFF #A0A0A0 #A0A0A0 #FFFFFF","#A0A0A0 #FFFFFF #FFFFFF #A0A0A0","#4B4B4B","#000000","8pt Arial","8pt Arial"],120,20);

<? } ?>
<? if($_SESSION["Ustate"]=="admin") {// ?>
//stm_aix("p1i0","p0i0",[0,"Site NGV","","",-1,-1,0,"site.ngv.index.php","_self","","","","",0,0,0,"","",0,0,0,0,1,"#9cc2c9",0,"#9cc2c9",0,"","",3,3,1,1,"#FFFFFF #A0A0A0 #A0A0A0 #FFFFFF","#A0A0A0 #FFFFFF #FFFFFF #A0A0A0","#4B4B4B","#000000","8pt Arial","8pt Arial"],120,20);
//stm_aix("p1i1","p1i0",[0,"Site Oil","","",-1,-1,0,"site.oil.index.php","_self","","","","",0,0,0,"","",0,0,0,0,1,"#9cc2c9",0,"#9cc2c9",0,"","",3,3,1,1,"#FFFFFF #A0A0A0 #A0A0A0 #FFFFFF","#A0A0A0 #FFFFFF #FFFFFF #A0A0A0","#4B4B4B","#000000","8pt Arial","8pt Arial"],120,20);
//stm_aix("p1i1","p1i0",[0,"Site Amazon","","",-1,-1,0,"site.amazon.index.php","_self","","","","",0,0,0,"","",0,0,0,0,1,"#9cc2c9",0,"#9cc2c9",0,"","",3,3,1,1,"#FFFFFF #A0A0A0 #A0A0A0 #FFFFFF","#A0A0A0 #FFFFFF #FFFFFF #A0A0A0","#4B4B4B","#000000","8pt Arial","8pt Arial"],120,20);
stm_aix("p1i1","p1i0",[0,"Add Site","","",-1,-1,0,"site.index.php","_self","","","","",0,0,0,"","",0,0,0,0,1,"#9cc2c9",0,"#9cc2c9",0,"","",3,3,1,1,"#FFFFFF #A0A0A0 #A0A0A0 #FFFFFF","#A0A0A0 #FFFFFF #FFFFFF #A0A0A0","#4B4B4B","#000000","8pt Arial","8pt Arial"],120,20);
stm_aix("p1i1","p1i0",[0,"Add Site (Retail)","","",-1,-1,0,"site.retail.index.php","_self","","","","",0,0,0,"","",0,0,0,0,1,"#9cc2c9",0,"#9cc2c9",0,"","",3,3,1,1,"#FFFFFF #A0A0A0 #A0A0A0 #FFFFFF","#A0A0A0 #FFFFFF #FFFFFF #A0A0A0","#4B4B4B","#000000","8pt Arial","8pt Arial"],120,20);

<? }
if($_SESSION["Username"]=="hrung" || $_SESSION["Username"]=="santi" ||  $_SESSION["Username"]=="varong"){
?>
stm_aix("p1i0","p0i0",[0,"Site Amazon responsibility","","",-1,-1,0,"site.responsibility.index.php?val_type=4","_self","","","","",0,0,0,"","",0,0,0,0,1,"#9cc2c9",0,"#9cc2c9",0,"","",3,3,1,1,"#FFFFFF #A0A0A0 #A0A0A0 #FFFFFF","#A0A0A0 #FFFFFF #FFFFFF #A0A0A0","#4B4B4B","#000000","8pt Arial","8pt Arial"],120,20);
stm_aix("p1i0","p0i0",[0,"Site NGV responsibility","","",-1,-1,0,"site.responsibility.index.php?val_type=2","_self","","","","",0,0,0,"","",0,0,0,0,1,"#9cc2c9",0,"#9cc2c9",0,"","",3,3,1,1,"#FFFFFF #A0A0A0 #A0A0A0 #FFFFFF","#A0A0A0 #FFFFFF #FFFFFF #A0A0A0","#4B4B4B","#000000","8pt Arial","8pt Arial"],120,20);
stm_aix("p1i0","p0i0",[0,"Site Oil responsibility","","",-1,-1,0,"site.responsibility.index.php?val_type=3","_self","","","","",0,0,0,"","",0,0,0,0,1,"#9cc2c9",0,"#9cc2c9",0,"","",3,3,1,1,"#FFFFFF #A0A0A0 #A0A0A0 #FFFFFF","#A0A0A0 #FFFFFF #FFFFFF #A0A0A0","#4B4B4B","#000000","8pt Arial","8pt Arial"],120,20);


//stm_aix("p1i1","p1i0",[0,"Insidant h/d.","","",-1,-1,0,"report.insident.hardware.php","","","","","",0,0,0,"","",0,0,0,0,1,"#9cc2c9",0,"#9cc2c9",0,"","",3,3,1,1,"#FFFFFF #A0A0A0 #A0A0A0 //#FFFFFF","#A0A0A0 #FFFFFF #FFFFFF #A0A0A0","#4B4B4B","#000000","8pt Arial","8pt Arial"],120,20);

//stm_aix("p1i1","p1i0",[0,"Onsite service (hour)","","",-1,-1,0,"report.hour.engineers.php","","","","","",0,0,0,"","",0,0,0,0,1,"#9cc2c9",0,"#9cc2c9",0,"","",3,3,1,1,"#FFFFFF #A0A0A0 #A0A0A0 #FFFFFF","#A0A0A0 #FFFFFF #FFFFFF #A0A0A0","#4B4B4B","#000000","8pt Arial","8pt Arial"],120,20);

<? } if($_SESSION["Ustate"]=="admin"){?>
stm_aix("p1i1","p1i0",[0,"Job Types","","",-1,-1,0,"jobtype.index.php","_self","","","","",0,0,0,"","",0,0,0,0,1,"#9cc2c9",0,"#9cc2c9",0,"","",3,3,1,1,"#FFFFFF #A0A0A0 #A0A0A0 #FFFFFF","#A0A0A0 #FFFFFF #FFFFFF #A0A0A0","#4B4B4B","#000000","8pt Arial","8pt Arial"],120,20);
stm_aix("p1i1","p1i0",[0,"Job Rename","","",-1,-1,0,"rename_jobno.php","_self","","","","",0,0,0,"","",0,0,0,0,1,"#9cc2c9",0,"#9cc2c9",0,"","",3,3,1,1,"#FFFFFF #A0A0A0 #A0A0A0 #FFFFFF","#A0A0A0 #FFFFFF #FFFFFF #A0A0A0","#4B4B4B","#000000","8pt Arial","8pt Arial"],120,20);
stm_aix("p1i1","p1i0",[0,"Edit Item","","",-1,-1,0,"edit_item.php","_self","","","","",0,0,0,"","",0,0,0,0,1,"#9cc2c9",0,"#9cc2c9",0,"","",3,3,1,1,"#FFFFFF #A0A0A0 #A0A0A0 #FFFFFF","#A0A0A0 #FFFFFF #FFFFFF #A0A0A0","#4B4B4B","#000000","8pt Arial","8pt Arial"],120,20);
stm_aix("p1i1","p1i0",[0,"Other Customer","","",-1,-1,0,"customer.list.php","_self","","","","",0,0,0,"","",0,0,0,0,1,"#9cc2c9",0,"#9cc2c9",0,"","",3,3,1,1,"#FFFFFF #A0A0A0 #A0A0A0 #FFFFFF","#A0A0A0 #FFFFFF #FFFFFF #A0A0A0","#4B4B4B","#000000","8pt Arial","8pt Arial"],120,20);
stm_aix("p1i1","p1i0",[0,"Upload file schedule helpdesk","","",-1,-1,0,"schedule_helpdesk_uploadfile.php","_self","","","","",0,0,0,"","",0,0,0,0,1,"#9cc2c9",0,"#9cc2c9",0,"","",3,3,1,1,"#FFFFFF #A0A0A0 #A0A0A0 #FFFFFF","#A0A0A0 #FFFFFF #FFFFFF #A0A0A0","#4B4B4B","#000000","8pt Arial","8pt Arial"],120,20);
//stm_aix("p1i1","p1i0",[0,"Delete Serial Hardware","","",-1,-1,0,"delete.serail.php","_self","","","","",0,0,0,"","",0,0,0,0,1,"#9cc2c9",0,"#9cc2c9",0,"","",3,3,1,1,"#FFFFFF #A0A0A0 #A0A0A0 #FFFFFF","#A0A0A0 #FFFFFF #FFFFFF #A0A0A0","#4B4B4B","#000000","8pt Arial","8pt Arial"],120,20);

stm_aix("p1i1","p1i0",[0,"PM NGV & Oil description","","",-1,-1,0,".php","_self","","","","",0,0,0,"","",0,0,0,0,1,"#9cc2c9",0,"#9cc2c9",0,"","",3,3,1,1,"#FFFFFF #A0A0A0 #A0A0A0 #FFFFFF","#A0A0A0 #FFFFFF #FFFFFF #A0A0A0","#4B4B4B","#000000","8pt Arial","8pt Arial"],120,20);

stm_aix("p1i1","p1i0",[0,"Serial No.","","",-1,-1,0,"check.serial.no.php","_self","","","","",0,0,0,"","",0,0,0,0,1,"#9cc2c9",0,"#9cc2c9",0,"","",3,3,1,1,"#FFFFFF #A0A0A0 #A0A0A0 #FFFFFF","#A0A0A0 #FFFFFF #FFFFFF #A0A0A0","#4B4B4B","#000000","8pt Arial","8pt Arial"],120,20);


//stm_aix("p1i1","p1i0",[0,"Delete Serial Hardware","","",-1,-1,0,"delete.serail.php","_self","","","","",0,0,0,"","",0,0,0,0,1,"#9cc2c9",0,"#9cc2c9",0,"","",3,3,1,1,"#FFFFFF #A0A0A0 #A0A0A0 #FFFFFF","#A0A0A0 #FFFFFF #FFFFFF #A0A0A0","#4B4B4B","#000000","8pt Arial","8pt Arial"],120,20);

stm_aix("p1i1","p1i0",[0,"Serial site to on hand","","",-1,-1,0,"serialsite2onhand.php","_self","","","","",0,0,0,"","",0,0,0,0,1,"#9cc2c9",0,"#9cc2c9",0,"","",3,3,1,1,"#FFFFFF #A0A0A0 #A0A0A0 #FFFFFF","#A0A0A0 #FFFFFF #FFFFFF #A0A0A0","#4B4B4B","#000000","8pt Arial","8pt Arial"],120,20);
<? } ?>
<?
if($_SESSION["Username"]=="hrung") { ?>
stm_aix("p1i1","p1i0",[0,"Employee","","",-1,-1,0,"employee.list.php","_self","","","","",0,0,0,"","",0,0,0,0,1,"#9cc2c9",0,"#9cc2c9",0,"","",3,3,1,1,"#FFFFFF #A0A0A0 #A0A0A0 #FFFFFF","#A0A0A0 #FFFFFF #FFFFFF #A0A0A0","#4B4B4B","#000000","8pt Arial","8pt Arial"],120,20);
stm_aix("p1i1","p1i0",[0,"Incentive 3G payment","","",-1,-1,0,"rpt.summary.incentive.for.payment.php","_self","","","","",0,0,0,"","",0,0,0,0,1,"#9cc2c9",0,"#9cc2c9",0,"","",3,3,1,1,"#FFFFFF #A0A0A0 #A0A0A0 #FFFFFF","#A0A0A0 #FFFFFF #FFFFFF #A0A0A0","#4B4B4B","#000000","8pt Arial","8pt Arial"],120,20);

<? } ?>
//	stm_aix("p1i1","p1i0",[0,"Gas per Km.","","",-1,-1,0,"fix.gasnoil.index.php","_self","","","","",0,0,0,"","",0,0,0,0,1,"#9cc2c9",0,"#9cc2c9",0,"","",3,3,1,1,"#FFFFFF #A0A0A0 #A0A0A0 #FFFFFF","#A0A0A0 #FFFFFF #FFFFFF #A0A0A0","#4B4B4B","#000000","8pt Arial","8pt Arial"],120,20);









<?
 if($_SESSION["Username"]=="hrungx" || $_SESSION["Username"]=="nattapon" || $_SESSION["Username"]=="santi" || $_SESSION["Username"]=="siriwan" || $_SESSION["Username"]=="kamphol"){ ?>
stm_aix("p1i1","p1i0",[0,"Gas per Km","","",-1,-1,0,"fix.gasnoil.index.php","_self","","","","",0,0,0,"","",0,0,0,0,1,"#9cc2c9",0,"#9cc2c9",0,"","",3,3,1,1,"#FFFFFF #A0A0A0 #A0A0A0 #FFFFFF","#A0A0A0 #FFFFFF #FFFFFF #A0A0A0","#4B4B4B","#000000","8pt Arial","8pt Arial"],120,20);

stm_aix("p1i1","p1i0",[0,"Clear session.","","",-1,-1,0,"clear.session.php","_self","","","","",0,0,0,"","",0,0,0,0,1,"#9cc2c9",0,"#9cc2c9",0,"","",3,3,1,1,"#FFFFFF #A0A0A0 #A0A0A0 #FFFFFF","#A0A0A0 #FFFFFF #FFFFFF #A0A0A0","#4B4B4B","#000000","8pt Arial","8pt Arial"],120,20);

stm_aix("p1i1","p1i0",[0,"Logcall report (MSR).","","",-1,-1,0,"rpt.logcallcenter.msr.php","_blank","","","","",0,0,0,"","",0,0,0,0,1,"#9cc2c9",0,"#9cc2c9",0,"","",3,3,1,1,"#FFFFFF #A0A0A0 #A0A0A0 #FFFFFF","#A0A0A0 #FFFFFF #FFFFFF #A0A0A0","#4B4B4B","#000000","8pt Arial","8pt Arial"],120,20);


stm_aix("p1i1","p1i0",[0,"Add S/N for PM","","",-1,-1,0,"insert.sn4pm.php","_blank","","","","",0,0,0,"","",0,0,0,0,1,"#9cc2c9",0,"#9cc2c9",0,"","",3,3,1,1,"#FFFFFF #A0A0A0 #A0A0A0 #FFFFFF","#A0A0A0 #FFFFFF #FFFFFF #A0A0A0","#4B4B4B","#000000","8pt Arial","8pt Arial"],120,20);


stm_aix("p1i1","p1i0",[0,"Category HW.","","",-1,-1,0,"category.hardware.php","_blank","","","","",0,0,0,"","",0,0,0,0,1,"#9cc2c9",0,"#9cc2c9",0,"","",3,3,1,1,"#FFFFFF #A0A0A0 #A0A0A0 #FFFFFF","#A0A0A0 #FFFFFF #FFFFFF #A0A0A0","#4B4B4B","#000000","8pt Arial","8pt Arial"],120,20);
stm_aix("p1i1","p1i0",[0,"Category Brand.","","",-1,-1,0,"category.brand.php","_blank","","","","",0,0,0,"","",0,0,0,0,1,"#9cc2c9",0,"#9cc2c9",0,"","",3,3,1,1,"#FFFFFF #A0A0A0 #A0A0A0 #FFFFFF","#A0A0A0 #FFFFFF #FFFFFF #A0A0A0","#4B4B4B","#000000","8pt Arial","8pt Arial"],120,20);

<? } ?>
//stm_aix("p1i1","p1i0",[0,"SN to User.","","",-1,-1,0,"check.snand.transfer.sn.php","_blank","","","","",0,0,0,"","",0,0,0,0,1,"#9cc2c9",0,"#9cc2c9",0,"","",3,3,1,1,"#FFFFFF #A0A0A0 #A0A0A0 #FFFFFF","#A0A0A0 #FFFFFF #FFFFFF #A0A0A0","#4B4B4B","#000000","8pt Arial","8pt Arial"],120,20);

stm_ep();





stm_aix("p0i3","p0i0",[0,"Report","","",-1,-1,0,"","_self","","","","",0,0,0,"script/0604scroll2ldlalr.gif","script/0604scroll2ldlalr.gif",16,9],80,20);
stm_bp("p1",[1,4,0,0,0,4,0,0,100,"",-2,"",-2,58,0,0,"#999999","transparent","",3,0,0,"#000000"]);

<?
//if($_SESSION["Ustate"]=="admin" || $_SESSION["Ustate"]=="helpdesk"|| $_SESSION["Ustate"]=="repair"|| $_SESSION["Ustate"]=="cmmsiadmin") { ?>
//stm_aix("p1i1","p1i0",[0,"Serial No.","","",-1,-1,0,"check.serial.no.php","_self","","","","",0,0,0,"","",0,0,0,0,1,"#9cc2c9",0,"#9cc2c9",0,"","",3,3,1,1,"#FFFFFF #A0A0A0 #A0A0A0 #FFFFFF","#A0A0A0 #FFFFFF #FFFFFF #A0A0A0","#4B4B4B","#000000","8pt Arial","8pt Arial"],120,20);



stm_aix("p1i1","p1i0",[0,"Dashboard BSS","","",-1,-1,0,"dashboard_bss/index.php","_blank","","","","",0,0,0,"","",0,0,0,0,1,"#9cc2c9",0,"#9cc2c9",0,"","",3,3,1,1,"#FFFFFF #A0A0A0 #A0A0A0 #FFFFFF","#A0A0A0 #FFFFFF #FFFFFF #A0A0A0","#4B4B4B","#000000","8pt Arial","8pt Arial"],120,20);
stm_aix("p1i1","p1i0",[0,"Report Engineer Getjob","","",-1,-1,0,"report_engineer_getjob.php","_blank","","","","",0,0,0,"","",0,0,0,0,1,"#9cc2c9",0,"#9cc2c9",0,"","",3,3,1,1,"#FFFFFF #A0A0A0 #A0A0A0 #FFFFFF","#A0A0A0 #FFFFFF #FFFFFF #A0A0A0","#4B4B4B","#000000","8pt Arial","8pt Arial"],120,20);
stm_aix("p1i1","p1i0",[0,"Report Engineer Summary(Km.)","","",-1,-1,0,"report_engineer_sumgps.php","_blank","","","","",0,0,0,"","",0,0,0,0,1,"#9cc2c9",0,"#9cc2c9",0,"","",3,3,1,1,"#FFFFFF #A0A0A0 #A0A0A0 #FFFFFF","#A0A0A0 #FFFFFF #FFFFFF #A0A0A0","#4B4B4B","#000000","8pt Arial","8pt Arial"],120,20);

//stm_aix("p1i1","p1i0",[0,"Stock","","",-1,-1,0,"hw.expose.list.php","_self","","","","",0,0,0,"","",0,0,0,0,1,"#9cc2c9",0,"#9cc2c9",0,"","",3,3,1,1,"#FFFFFF #A0A0A0 #A0A0A0 #FFFFFF","#A0A0A0 #FFFFFF #FFFFFF #A0A0A0","#4B4B4B","#000000","8pt Arial","8pt Arial"],120,20);
//stm_aix("p1i1","p1i0",[0,"Change SparePart","","",-1,-1,0,"change.sparepartfor.php","_self","","","","",0,0,0,"","",0,0,0,0,1,"#9cc2c9",0,"#9cc2c9",0,"","",3,3,1,1,"#FFFFFF #A0A0A0 #A0A0A0 #FFFFFF","#A0A0A0 #FFFFFF #FFFFFF #A0A0A0","#4B4B4B","#000000","8pt Arial","8pt Arial"],120,20);
//stm_aix("p1i1","p1i0",[0,"On hand by service","","",-1,-1,0,"hw.onhand.list.php","_self","","","","",0,0,0,"","",0,0,0,0,1,"#9cc2c9",0,"#9cc2c9",0,"","",3,3,1,1,"#FFFFFF #A0A0A0 #A0A0A0 #FFFFFF","#A0A0A0 #FFFFFF #FFFFFF #A0A0A0","#4B4B4B","#000000","8pt Arial","8pt Arial"],120,20);
//stm_aix("p1i1","p1i0",[0,"On hand all service","","",-1,-1,0,"stock.ngv.bss.php","_self","","","","",0,0,0,"","",0,0,0,0,1,"#9cc2c9",0,"#9cc2c9",0,"","",3,3,1,1,"#FFFFFF #A0A0A0 #A0A0A0 #FFFFFF","#A0A0A0 #FFFFFF #FFFFFF #A0A0A0","#4B4B4B","#000000","8pt Arial","8pt Arial"],120,20);
stm_aix("p1i1","p1i0",[0,"GPS Manager.","","",-1,-1,0,"gps_manager.php","_blank","","","","",0,0,0,"","",0,0,0,0,1,"#9cc2c9",0,"#9cc2c9",0,"","",3,3,1,1,"#FFFFFF #A0A0A0 #A0A0A0 #FFFFFF","#A0A0A0 #FFFFFF #FFFFFF #A0A0A0","#4B4B4B","#000000","8pt Arial","8pt Arial"],120,20);
stm_aix("p1i1","p1i0",[0,"Site IP Report.","","",-1,-1,0,"site.ip_report.php","_blank","","","","",0,0,0,"","",0,0,0,0,1,"#9cc2c9",0,"#9cc2c9",0,"","",3,3,1,1,"#FFFFFF #A0A0A0 #A0A0A0 #FFFFFF","#A0A0A0 #FFFFFF #FFFFFF #A0A0A0","#4B4B4B","#000000","8pt Arial","8pt Arial"],120,20);
stm_aix("p1i1","p1i0",[0,"Work Schedule Report.","","",-1,-1,0,"work.schedule_report.php","_blank","","","","",0,0,0,"","",0,0,0,0,1,"#9cc2c9",0,"#9cc2c9",0,"","",3,3,1,1,"#FFFFFF #A0A0A0 #A0A0A0 #FFFFFF","#A0A0A0 #FFFFFF #FFFFFF #A0A0A0","#4B4B4B","#000000","8pt Arial","8pt Arial"],120,20);

//stm_aix("p1i1","p1i0",[0,"Repair.","","",-1,-1,0,"hw.waitrepair.list.php","_self","","","","",0,0,0,"","",0,0,0,0,1,"#9cc2c9",0,"#9cc2c9",0,"","",3,3,1,1,"#FFFFFF #A0A0A0 #A0A0A0 #FFFFFF","#A0A0A0 #FFFFFF #FFFFFF #A0A0A0","#4B4B4B","#000000","8pt Arial","8pt Arial"],120,20);
stm_aix("p1i1","p1i0",[0,"Buy/Rent Report.","","",-1,-1,0,"report_buyrent.php","_blank","","","","",0,0,0,"","",0,0,0,0,1,"#9cc2c9",0,"#9cc2c9",0,"","",3,3,1,1,"#FFFFFF #A0A0A0 #A0A0A0 #FFFFFF","#A0A0A0 #FFFFFF #FFFFFF #A0A0A0","#4B4B4B","#000000","8pt Arial","8pt Arial"],120,20);

<? if($_SESSION['Ustate'] ==  "helpdesk" || $_SESSION['Ustate'] ==  "admin"){ ?>
stm_aix("p1i1","p1i0",[0,"Map Location.","","",-1,-1,0,"location_user.php","_blank","","","","",0,0,0,"","",0,0,0,0,1,"#9cc2c9",0,"#9cc2c9",0,"","",3,3,1,1,"#FFFFFF #A0A0A0 #A0A0A0 #FFFFFF","#A0A0A0 #FFFFFF #FFFFFF #A0A0A0","#4B4B4B","#000000","8pt Arial","8pt Arial"],120,20);
<? } ?>
<? if($_SESSION['Ustate'] ==  "admin"){ ?>
stm_aix("p1i1","p1i0",[0,"Logcall Transaction.","","",-1,-1,0,"report.logcall.transaction.php","_self","","","","",0,0,0,"","",0,0,0,0,1,"#9cc2c9",0,"#9cc2c9",0,"","",3,3,1,1,"#FFFFFF #A0A0A0 #A0A0A0 #FFFFFF","#A0A0A0 #FFFFFF #FFFFFF #A0A0A0","#4B4B4B","#000000","8pt Arial","8pt Arial"],120,20);
stm_aix("p1i1","p1i0",[0,"Incentive Transaction.","","",-1,-1,0,"report.incentive.transaction.php","_self","","","","",0,0,0,"","",0,0,0,0,1,"#9cc2c9",0,"#9cc2c9",0,"","",3,3,1,1,"#FFFFFF #A0A0A0 #A0A0A0 #FFFFFF","#A0A0A0 #FFFFFF #FFFFFF #A0A0A0","#4B4B4B","#000000","8pt Arial","8pt Arial"],120,20);
stm_aix("p1i1","p1i0",[0,"Incentive Detail Transaction.","","",-1,-1,0,"report.incentive.detail.transaction.php","_self","","","","",0,0,0,"","",0,0,0,0,1,"#9cc2c9",0,"#9cc2c9",0,"","",3,3,1,1,"#FFFFFF #A0A0A0 #A0A0A0 #FFFFFF","#A0A0A0 #FFFFFF #FFFFFF #A0A0A0","#4B4B4B","#000000","8pt Arial","8pt Arial"],120,20);

<? } ?>


stm_ep();

stm_aix("p0i4","p0i0",[0,"Time Table","","",-1,-1,0,"#","_self","","","","",0,0,0,"script/0604scroll2ldlalr.gif","script/0604scroll2ldlalr.gif",16,9],80,20);
stm_bpx("p2","p1",[]);
//stm_aix("p4i1","p1i0",[0,"Helpdesk","","",-1,-1,0,"schedule_helpdesk.php","_blank","","","","",0,0,0,"","",0,0,0,0,1,"#9cc2c9",0,"#9cc2c9",0,"","",3,3,1,1,"#FFFFFF #A0A0A0 #A0A0A0 #FFFFFF","#A0A0A0 #FFFFFF #FFFFFF #A0A0A0","#4B4B4B","#000000","8pt Arial","8pt Arial"],120,20);
//stm_aix("p4i1","p1i0",[0,"Preventive Maintenance (PM)","","",-1,-1,0,"schedule_pm.php","_blank","","","","",0,0,0,"","",0,0,0,0,1,"#9cc2c9",0,"#9cc2c9",0,"","",3,3,1,1,"#FFFFFF #A0A0A0 #A0A0A0 #FFFFFF","#A0A0A0 #FFFFFF #FFFFFF #A0A0A0","#4B4B4B","#000000","8pt Arial","8pt Arial"],120,20);
//stm_aix("p4i1","p1i0",[0,"Corrective Maintenance (CM)","","",-1,-1,0,"schedule_cm.php","_self","","","","",0,0,0,"","",0,0,0,0,1,"#9cc2c9",0,"#9cc2c9",0,"","",3,3,1,1,"#FFFFFF #A0A0A0 #A0A0A0 #FFFFFF","#A0A0A0 #FFFFFF #FFFFFF #A0A0A0","#4B4B4B","#000000","8pt Arial","8pt Arial"],120,20);
//stm_aix("p4i1","p1i0",[0,"All Plan","","",-1,-1,0,"plan_all.php","_self","","","","",0,0,0,"","",0,0,0,0,1,"#9cc2c9",0,"#9cc2c9",0,"","",3,3,1,1,"#FFFFFF #A0A0A0 #A0A0A0 #FFFFFF","#A0A0A0 #FFFFFF #FFFFFF #A0A0A0","#4B4B4B","#000000","8pt Arial","8pt Arial"],120,20);

stm_ep();

<? if($_SESSION['Ustate'] ==  "admin" || $_SESSION['Ustate'] ==  "user" || $_SESSION['Ustate'] ==  "cm" || $_SESSION['Ustate'] ==  "helpdesk"){ ?>

stm_aix("p0i5","p0i4",[0,"Accounting"],80,20);
stm_bpx("p3","p1",[]);

stm_aix("p4i1","p1i0",[0,"Product Entry","","",-1,-1,0,"product.index.php","_self","","","","",0,0,0,"","",0,0,0,0,1,"#9cc2c9",0,"#9cc2c9",0,"","",3,3,1,1,"#FFFFFF #A0A0A0 #A0A0A0 #FFFFFF","#A0A0A0 #FFFFFF #FFFFFF #A0A0A0","#4B4B4B","#000000","8pt Arial","8pt Arial"],120,20);
stm_aix("p4i1","p1i0",[0,"Invoice Entry","","",-1,-1,0,"invoice.list.php","_self","","","","",0,0,0,"","",0,0,0,0,1,"#9cc2c9",0,"#9cc2c9",0,"","",3,3,1,1,"#FFFFFF #A0A0A0 #A0A0A0 #FFFFFF","#A0A0A0 #FFFFFF #FFFFFF #A0A0A0","#4B4B4B","#000000","8pt Arial","8pt Arial"],120,20);

//stm_aix("p4i1","p1i0",[0,"Expenses","","",-1,-1,0,"incentive.ot.list.php","_self","","","","",0,0,0,"","",0,0,0,0,1,"#9cc2c9",0,"#9cc2c9",0,"","",3,3,1,1,"#FFFFFF #A0A0A0 #A0A0A0 #FFFFFF","#A0A0A0 #FFFFFF #FFFFFF #A0A0A0","#4B4B4B","#000000","8pt Arial","8pt Arial"],120,20);
stm_aix("p4i1","p1i0",[0,"Expenses -1","","",-1,-1,0,"incentive.ot.list_new.php","_self","","","","",0,0,0,"","",0,0,0,0,1,"#9cc2c9",0,"#9cc2c9",0,"","",3,3,1,1,"#FFFFFF #A0A0A0 #A0A0A0 #FFFFFF","#A0A0A0 #FFFFFF #FFFFFF #A0A0A0","#4B4B4B","#000000","8pt Arial","8pt Arial"],120,20);
stm_aix("p4i1","p1i0",[0,"Expenses Report by Employee","","",-1,-1,0,"rpt.incentivebyemp.php","_self","","","","",0,0,0,"","",0,0,0,0,1,"#9cc2c9",0,"#9cc2c9",0,"","",3,3,1,1,"#FFFFFF #A0A0A0 #A0A0A0 #FFFFFF","#A0A0A0 #FFFFFF #FFFFFF #A0A0A0","#4B4B4B","#000000","8pt Arial","8pt Arial"],120,20);


<? if($Ustate=="admin") { ?>
stm_aix("p4i1","p1i0",[0,"Expenses Report All Employee","","",-1,-1,0,"rpt.incentiveallemp.php","_self","","","","",0,0,0,"","",0,0,0,0,1,"#9cc2c9",0,"#9cc2c9",0,"","",3,3,1,1,"#FFFFFF #A0A0A0 #A0A0A0 #FFFFFF","#A0A0A0 #FFFFFF #FFFFFF #A0A0A0","#4B4B4B","#000000","8pt Arial","8pt Arial"],120,20);
stm_aix("p4i1","p1i0",[0,"Expenses Report Wifi","","",-1,-1,0,"report_expenses_wifi.php","_self","","","","",0,0,0,"","",0,0,0,0,1,"#9cc2c9",0,"#9cc2c9",0,"","",3,3,1,1,"#FFFFFF #A0A0A0 #A0A0A0 #FFFFFF","#A0A0A0 #FFFFFF #FFFFFF #A0A0A0","#4B4B4B","#000000","8pt Arial","8pt Arial"],120,20);

<? } ?>
stm_ep();
<?}?>

stm_aix("p0i6","p0i4",[0,"Other System"],80,20);
stm_bpx("p4","p1",[]);
stm_aix("p4i0","p1i0",[0,"All Plan","","",-1,-1,0,"list_file_plan.php","_self","","","","",0,0,0,"","",0,0,0,0,1,"#9cc2c9",0,"#9cc2c9",0,"","",3,3,1,1,"#FFFFFF #A0A0A0 #A0A0A0 #FFFFFF","#A0A0A0 #FFFFFF #FFFFFF #A0A0A0","#4B4B4B","#000000","8pt Arial","8pt Arial"],120,20);
stm_aix("p4i1","p1i0",[0,"Upload  File on Plan","","",-1,-1,0,"upload_file_plan.php","_self","","","","",0,0,0,"","",0,0,0,0,1,"#9cc2c9",0,"#9cc2c9",0,"","",3,3,1,1,"#FFFFFF #A0A0A0 #A0A0A0 #FFFFFF","#A0A0A0 #FFFFFF #FFFFFF #A0A0A0","#4B4B4B","#000000","8pt Arial","8pt Arial"],120,20);

stm_aix("p1i1","p1i0",[0,"Stock","","",-1,-1,0,"stock.php","_self","","","","",0,0,0,"","",0,0,0,0,1,"#9cc2c9",0,"#9cc2c9",0,"","",3,3,1,1,"#FFFFFF #A0A0A0 #A0A0A0 #FFFFFF","#A0A0A0 #FFFFFF #FFFFFF #A0A0A0","#4B4B4B","#000000","8pt Arial","8pt Arial"],120,20);


stm_ep();
stm_aix("p0i7","p0i0",[0,"Change Password","","",-1,-1,0,"change_password_form.php","_self","","","","",0,0,0,"","",0,0,0,1,1,"#9cc2c9",0,"#9cc2c9",0,"","",3,3,1,1,"#BEE6F0 #64878C #64878C #BEE6F0","#64878C #BEE6F0 #BEE6F0 #64878C","#333366","#333366","bold 8pt Arial","bold 8pt Arial",0,0,"","","","",0,0,0],80,20);
stm_aix("p0i8","p0i0",[0,"Logout","","",-1,-1,0,"logout.php","_self","","","","",0,0,0,"","",16,9],80,20);
stm_ep();
stm_em();
//-->



<? } else if($_SESSION['Uat'] ==  "MSI") { ?>


<!--
stm_bm(["menu4d8f",700,"","script/blank.gif",0,"","",0,0,0,0,30,1,0,0,"","",0,0,1,1,"default","hand","",1,15],this);
stm_bp("p0",[0,4,0,0,0,4,0,16,100,"",-2,"",-2,90,0,0,"#999999","transparent","",3,0,0,"#E6FAB4 #788C32 #788C32 #E6FAB4"]);
stm_ai("p0i0",[0,"Home","","",-1,-1,0,"cm_sla_percentage.php","_self","","","","",0,0,0,"","",0,0,0,1,1,"#9cc2c9",0,"#9cc2c9",0,"","",3,3,1,1,"#BEE6F0 #64878C #64878C #BEE6F0","#64878C #BEE6F0 #BEE6F0 #64878C","#333366","#333366","bold 8pt Arial","bold 8pt Arial",0,0,"","","","",0,0,0],80,20);

stm_ai("p0i0",[0,"Dashboard","","",-1,-1,0,"rpt.summary.index.php","_self","","","","",0,0,0,"","",0,0,0,1,1,"#9cc2c9",0,"#9cc2c9",0,"","",3,3,1,1,"#BEE6F0 #64878C #64878C #BEE6F0","#64878C #BEE6F0 #BEE6F0 #64878C","#333366","#333366","bold 8pt Arial","bold 8pt Arial",0,0,"","","","",0,0,0],80,20);

stm_aix("p0i1","p0i0",[0,"Log call center","","",-1,-1,0,"#","_self","","","","",0,0,0,"","",0,0,0,1,1,"#9cc2c9",0,"#9cc2c9",0,"","",3,3,1,1,"#BEE6F0 #64878C #64878C #BEE6F0","#64878C #BEE6F0 #BEE6F0 #64878C","#333366","#333366","bold 8pt Arial","bold 8pt Arial",0,0,"","","","",0,0,0],80,20);
stm_bp("p1",[1,4,0,0,0,4,0,0,100,"",-2,"",-2,58,0,0,"#999999","transparent","",3,0,0,"#000000"]);
<? if($_SESSION['Ustate'] ==  "cmmsiadmin") { ?>
stm_aix("p1i0","p0i0",[0,"Logcall Center","","",-1,-1,0,"logcall.index.msi.php","_self","","","","",0,0,0,"","",0,0,0,0,1,"#9cc2c9",0,"#9cc2c9",0,"","",3,3,1,1,"#FFFFFF #A0A0A0 #A0A0A0 #FFFFFF","#A0A0A0 #FFFFFF #FFFFFF #A0A0A0","#4B4B4B","#000000","8pt Arial","8pt Arial"],120,20);
stm_aix("p1i1","p1i0",[0,"Add S/N for PM","","",-1,-1,0,"insert.sn4pm.php","_blank","","","","",0,0,0,"","",0,0,0,0,1,"#9cc2c9",0,"#9cc2c9",0,"","",3,3,1,1,"#FFFFFF #A0A0A0 #A0A0A0 #FFFFFF","#A0A0A0 #FFFFFF #FFFFFF #A0A0A0","#4B4B4B","#000000","8pt Arial","8pt Arial"],120,20);
stm_aix("p1i0","p0i0",[0,"Service Report -1","","",-1,-1,0,"logcall.index.excel.formnim.msi.php","_self","","","","",0,0,0,"","",0,0,0,0,1,"#9cc2c9",0,"#9cc2c9",0,"","",3,3,1,1,"#FFFFFF #A0A0A0 #A0A0A0 #FFFFFF","#A0A0A0 #FFFFFF #FFFFFF #A0A0A0","#4B4B4B","#000000","8pt Arial","8pt Arial"],120,20);
<? } ?>

<?// if($_SESSION["Username"]=="hatthaya" || $_SESSION["Username"]=="hrung" || $_SESSION["Username"]=="santi" || $_SESSION["Username"]=="kittanat" ||  $_SESSION["Username"]=="kanokporn" ||  $_SESSION["Username"]=="sataporn" ||  $_SESSION["Username"]=="kannika" ||  $_SESSION["Username"]=="varong"){ ?>
//stm_aix("p1i0","p0i0",[0,"Service Report","","",-1,-1,0,"logcall.index.excel.form.php","_self","","","","",0,0,0,"","",0,0,0,0,1,"#9cc2c9",0,"#9cc2c9",0,"","",3,3,1,1,"#FFFFFF #A0A0A0 #A0A0A0 #FFFFFF","#A0A0A0 #FFFFFF #FFFFFF #A0A0A0","#4B4B4B","#000000","8pt Arial","8pt Arial"],120,20);

stm_aix("p1i0","p0i0",[0,"Serial All NGV","","",-1,-1,0,"serial.export.php","_blank","","","","",0,0,0,"","",0,0,0,0,1,"#9cc2c9",0,"#9cc2c9",0,"","",3,3,1,1,"#FFFFFF #A0A0A0 #A0A0A0 #FFFFFF","#A0A0A0 #FFFFFF #FFFFFF #A0A0A0","#4B4B4B","#000000","8pt Arial","8pt Arial"],120,20);
stm_aix("p1i0","p0i0",[0,"Serial All NGV DEALER","","",-1,-1,0,"serial.export.ngvdealer.php","_blank","","","","",0,0,0,"","",0,0,0,0,1,"#9cc2c9",0,"#9cc2c9",0,"","",3,3,1,1,"#FFFFFF #A0A0A0 #A0A0A0 #FFFFFF","#A0A0A0 #FFFFFF #FFFFFF #A0A0A0","#4B4B4B","#000000","8pt Arial","8pt Arial"],120,20);
stm_aix("p1i0","p0i0",[0,"Serial All OIL","","",-1,-1,0,"serial.export.oil.php","_blank","","","","",0,0,0,"","",0,0,0,0,1,"#9cc2c9",0,"#9cc2c9",0,"","",3,3,1,1,"#FFFFFF #A0A0A0 #A0A0A0 #FFFFFF","#A0A0A0 #FFFFFF #FFFFFF #A0A0A0","#4B4B4B","#000000","8pt Arial","8pt Arial"],120,20);

//stm_aix("p1i0","p0i0",[0,"Summary Serial ","","",-1,-1,0,"summary.serail.all.php","_blank","","","","",0,0,0,"","",0,0,0,0,1,"#9cc2c9",0,"#9cc2c9",0,"","",3,3,1,1,"#FFFFFF #A0A0A0 #A0A0A0 #FFFFFF","#A0A0A0 #FFFFFF #FFFFFF #A0A0A0","#4B4B4B","#000000","8pt Arial","8pt Arial"],120,20);

//stm_aix("p1i0","p0i0",[0,"Top 10 hardware ","","",-1,-1,0,"top10hardware.php","_blank","","","","",0,0,0,"","",0,0,0,0,1,"#9cc2c9",0,"#9cc2c9",0,"","",3,3,1,1,"#FFFFFF #A0A0A0 #A0A0A0 #FFFFFF","#A0A0A0 #FFFFFF #FFFFFF #A0A0A0","#4B4B4B","#000000","8pt Arial","8pt Arial"],120,20);
//stm_aix("p1i0","p0i0",[0,"Top 10 Site ","","",-1,-1,0,"top10site.php","_blank","","","","",0,0,0,"","",0,0,0,0,1,"#9cc2c9",0,"#9cc2c9",0,"","",3,3,1,1,"#FFFFFF #A0A0A0 #A0A0A0 #FFFFFF","#A0A0A0 #FFFFFF #FFFFFF #A0A0A0","#4B4B4B","#000000","8pt Arial","8pt Arial"],120,20);

stm_ep();


stm_aix("p0i3","p0i0",[0,"Setting","","",-1,-1,0,"#","_self","","","","",0,0,0,"script/0604scroll2ldlalr.gif","script/0604scroll2ldlalr.gif",16,9],80,20);
stm_bp("p1",[1,4,0,0,0,4,0,0,100,"",-2,"",-2,58,0,0,"#999999","transparent","",3,0,0,"#000000"]);
stm_aix("p1i1","p1i0",[0,"Add Site","","",-1,-1,0,"site.index.php","_self","","","","",0,0,0,"","",0,0,0,0,1,"#9cc2c9",0,"#9cc2c9",0,"","",3,3,1,1,"#FFFFFF #A0A0A0 #A0A0A0 #FFFFFF","#A0A0A0 #FFFFFF #FFFFFF #A0A0A0","#4B4B4B","#000000","8pt Arial","8pt Arial"],120,20);

stm_aix("p1i1","p1i0",[0,"Serial site to on hand","","",-1,-1,0,"serialsite2onhand.php","_self","","","","",0,0,0,"","",0,0,0,0,1,"#9cc2c9",0,"#9cc2c9",0,"","",3,3,1,1,"#FFFFFF #A0A0A0 #A0A0A0 #FFFFFF","#A0A0A0 #FFFFFF #FFFFFF #A0A0A0","#4B4B4B","#000000","8pt Arial","8pt Arial"],120,20);
stm_aix("p1i1","p1i0",[0,"Job Rename","","",-1,-1,0,"rename_jobno.php","_self","","","","",0,0,0,"","",0,0,0,0,1,"#9cc2c9",0,"#9cc2c9",0,"","",3,3,1,1,"#FFFFFF #A0A0A0 #A0A0A0 #FFFFFF","#A0A0A0 #FFFFFF #FFFFFF #A0A0A0","#4B4B4B","#000000","8pt Arial","8pt Arial"],120,20);
stm_ep();



stm_aix("p0i3","p0i0",[0,"Report","","",-1,-1,0,"","_self","","","","",0,0,0,"script/0604scroll2ldlalr.gif","script/0604scroll2ldlalr.gif",16,9],80,20);
stm_bp("p1",[1,4,0,0,0,4,0,0,100,"",-2,"",-2,58,0,0,"#999999","transparent","",3,0,0,"#000000"]);

stm_aix("p1i1","p1i0",[0,"Stock","","",-1,-1,0,"hw.expose.list.php","_self","","","","",0,0,0,"","",0,0,0,0,1,"#9cc2c9",0,"#9cc2c9",0,"","",3,3,1,1,"#FFFFFF #A0A0A0 #A0A0A0 #FFFFFF","#A0A0A0 #FFFFFF #FFFFFF #A0A0A0","#4B4B4B","#000000","8pt Arial","8pt Arial"],120,20);
stm_aix("p1i1","p1i0",[0,"On hand.","","",-1,-1,0,"hw.onhand.list.php","_self","","","","",0,0,0,"","",0,0,0,0,1,"#9cc2c9",0,"#9cc2c9",0,"","",3,3,1,1,"#FFFFFF #A0A0A0 #A0A0A0 #FFFFFF","#A0A0A0 #FFFFFF #FFFFFF #A0A0A0","#4B4B4B","#000000","8pt Arial","8pt Arial"],120,20);

stm_aix("p1i1","p1i0",[0,"Repair.","","",-1,-1,0,"hw.waitrepair.list.php","_self","","","","",0,0,0,"","",0,0,0,0,1,"#9cc2c9",0,"#9cc2c9",0,"","",3,3,1,1,"#FFFFFF #A0A0A0 #A0A0A0 #FFFFFF","#A0A0A0 #FFFFFF #FFFFFF #A0A0A0","#4B4B4B","#000000","8pt Arial","8pt Arial"],120,20);
stm_ep();



stm_aix("p0i4","p0i0",[0,"Time Table","","",-1,-1,0,"#","_self","","","","",0,0,0,"script/0604scroll2ldlalr.gif","script/0604scroll2ldlalr.gif",16,9],80,20);
stm_bpx("p2","p1",[]);
stm_ep();

stm_aix("p0i5","p0i4",[0,"Accounting"],80,20);

stm_bpx("p3","p1",[]);
stm_aix("p4i1","p1i0",[0,"Expenses -1","","",-1,-1,0,"msi/incentive.ot.list_msi.php","_self","","","","",0,0,0,"","",0,0,0,0,1,"#9cc2c9",0,"#9cc2c9",0,"","",3,3,1,1,"#FFFFFF #A0A0A0 #A0A0A0 #FFFFFF","#A0A0A0 #FFFFFF #FFFFFF #A0A0A0","#4B4B4B","#000000","8pt Arial","8pt Arial"],120,20);
stm_ep();


stm_aix("p0i6","p0i4",[0,"Other System"],80,20);
stm_bpx("p4","p1",[]);

stm_ep();
stm_aix("p0i7","p0i0",[0,"Change Password","","",-1,-1,0,"change_password_form.php","_self","","","","",0,0,0,"","",0,0,0,1,1,"#9cc2c9",0,"#9cc2c9",0,"","",3,3,1,1,"#BEE6F0 #64878C #64878C #BEE6F0","#64878C #BEE6F0 #BEE6F0 #64878C","#333366","#333366","bold 8pt Arial","bold 8pt Arial",0,0,"","","","",0,0,0],80,20);
stm_aix("p0i8","p0i0",[0,"Logout","","",-1,-1,0,"logout.php","_self","","","","",0,0,0,"","",16,9],80,20);
stm_ep();
stm_em();
//-->





<?} else if($_SESSION['Uat'] ==  "PTT") { ?>

<!--
stm_bm(["menu4d8f",700,"","script/blank.gif",0,"","",0,0,0,0,30,1,0,0,"","",0,0,1,1,"default","hand","",1,15],this);
stm_bp("p0",[0,4,0,0,0,4,0,16,100,"",-2,"",-2,90,0,0,"#999999","transparent","",3,0,0,"#E6FAB4 #788C32 #788C32 #E6FAB4"]);
stm_ai("p0i0",[0,"Home","","",-1,-1,0,"#","_self","","","","",0,0,0,"","",0,0,0,1,1,"#9cc2c9",0,"#9cc2c9",0,"","",3,3,1,1,"#BEE6F0 #64878C #64878C #BEE6F0","#64878C #BEE6F0 #BEE6F0 #64878C","#333366","#333366","bold 8pt Arial","bold 8pt Arial",0,0,"","","","",0,0,0],80,20);



//stm_aix("p0i1","p0i0",[0,"Log call center","","",-1,-1,0,"#","_self","","","","",0,0,0,"","",0,0,0,1,1,"#9cc2c9",0,"#9cc2c9",0,"","",3,3,1,1,"#BEE6F0 #64878C #64878C #BEE6F0","#64878C #BEE6F0 #BEE6F0 #64878C","#333366","#333366","bold 8pt Arial","bold 8pt Arial",0,0,"","","","",0,0,0],80,20);
//stm_bp("p1",[1,4,0,0,0,4,0,0,100,"",-2,"",-2,58,0,0,"#999999","transparent","",3,0,0,"#000000"]);

stm_aix("p0i3","p0i0",[0,"Stock","","",-1,-1,0,"#","_self","","","","",0,0,0,"script/0604scroll2ldlalr.gif","script/0604scroll2ldlalr.gif",16,9],80,20);
stm_bp("p1",[1,4,0,0,0,4,0,0,100,"",-2,"",-2,58,0,0,"#999999","transparent","",3,0,0,"#000000"]);
//stm_aix("p1i1","p1i0",[0,"On hand all service","","",-1,-1,0,"stock.ngv.bss-1.php","_self","","","","",0,0,0,"","",0,0,0,0,1,"#9cc2c9",0,"#9cc2c9",0,"","",3,3,1,1,"#FFFFFF #A0A0A0 #A0A0A0 #FFFFFF","#A0A0A0 #FFFFFF #FFFFFF #A0A0A0","#4B4B4B","#000000","8pt Arial","8pt Arial"],120,20);
stm_ep();

//stm_ep();
stm_aix("p0i7","p0i0",[0,"Change Password","","",-1,-1,0,"change_password_form.php","_self","","","","",0,0,0,"","",0,0,0,1,1,"#9cc2c9",0,"#9cc2c9",0,"","",3,3,1,1,"#BEE6F0 #64878C #64878C #BEE6F0","#64878C #BEE6F0 #BEE6F0 #64878C","#333366","#333366","bold 8pt Arial","bold 8pt Arial",0,0,"","","","",0,0,0],80,20);
stm_aix("p0i8","p0i0",[0,"Logout","","",-1,-1,0,"logout.php","_self","","","","",0,0,0,"","",16,9],80,20);
stm_ep();
stm_em();
//-->


<?}?>
</script>
    </td>
  </tr>
  </table>
</center>
</body>
</html>
