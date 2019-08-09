<?
session_start();
if ($_SESSION["Uid"]!="") 
{	
header("Location: dashboard.php");
exit;
}
//echo "asdfasdfasdf";

  //   ?link=
//require("function.php");
//echo dte_diff('2013-09-04 20:16:00','2013-09-04 22:14:00');
//function dte_diff($date2,$date1){   
//	   $sql = "SELECT TIMEDIFF('$date2' , '$date1') AS dte_diff"; 
//	   $rs = mysql_query($sql);
//	   $c = mysql_fetch_array($rs);     
//	   $d = $c["dte_diff"];  
//	   $dt = split(":",$d);                                 
//    return $dt[0].".".$dt[1];
//   }  
 ?>

<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=Windows-874">  
	<title>Bizserv Solution </title>
	<link href="image/bss_icon.ico"   rel="shortcut icon" /> 
<script language="javascript" src="script.js"></script>	
<link href="style/stylecss.css" rel="stylesheet" type="text/css">
</head>
<body>

<br><br><br><br><br><br><br><br>
<form method=post action="checkUser.php" name="login_form" onSubmit="return checkValue()">
<table width="100" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td align="center"><table width="100" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td><img src="image/ligin_r1_c1.jpg" width="119" height="85"></td>
        <td><img src="image/ligin_r1_c2.jpg" width="60" height="85"></td>
        <td><img src="image/ligin_r1_c3.jpg" width="61" height="85"></td>
        <td><img src="image/ligin_r1_c4.jpg" width="74" height="85"></td>
      </tr>
    </table></td>
  </tr>
    <tr>
    <td align="center" height="5"></td>
  </tr>
  <tr>
    <td><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td align="right" class="fonttitle_board">UserName:</td>
        <td>&nbsp;</td>
        <td><input class="form-control"  size=26 type=text name="username" maxlength=30 class=violet></td>
      </tr>      
      <tr>
        <td width="38%" align="right" class="fonttitle_board">PassWord:</td>
        <td width="3%">&nbsp;</td>
        <td width="59%"><input class="form-control"  size=26 type=password name="password" maxlength=30 class=violet></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td align="center" height="10"></td>
  </tr>
  <tr>
    <td align="center"><b>
	<input type="hidden" name="link" id="link" value="<?=$_REQUEST["link"]?>">
      <input class="btn btn-success"  type=submit value="Login" name="submit" style="width:60pt;">
      <input class="btn btn-secondary" type=reset value="Reset" name="reset" style="width:60pt;">
    </b></td>
  </tr>
</table>

   </form>

  <br>     
  </div>
</body>
</html>
 <script language="JavaScript">
function checkValue()
{
      var v1 = document.login_form.username.value;
      var v2 = document.login_form.password.value;

        if (v1.length==0)
           {
           alert("¡ÃØ³Ò¡ÃÍ¡ª×èÍŒÙéãªé§Ò¹ŽéÇÂ¹Ð€ÃÑº");
           document.login_form.username.focus();           
           return false;
           }
        else if (v2.length==0)
           {
           alert("¡ÃØ³Ò¡ÃÍ¡ÃËÑÊŒèÒ¹ŽéÇÂ¹Ð€ÃÑº") ;
           document.login_form.password.focus();           
           return false;
           }
        else
           return true;
}
</script>
</body>
</html>
