<?
session_start();
require_once("function.php");
  if(!checkUser()){    echo Message(35,"red",$titel1,$msg1,"<a href='index.php?link=logcall.index'> $login </a>");
  exit;
  }
$engineerid = $_REQUEST["engineerid"];
$jobid = $_REQUEST["jobid"];
$logtype = $_REQUEST["logtype"];
?>


<html>
<head>
   <title>GPS MANAGER</title>
   <meta http-equiv=Content-Type content="text/html; charset=tis-620">
   <script type="text/javascript" src="script/jquery_1.7.1_min.js"></script>
<style>
body{
   font-size: 14px;
   font-family: Arial, Helvetica, sans-serif;
   margin: 0 auto;
   background-color: #F0F0F0;
}
.contrainner{
   width: 100%;
   margin-top: 50px;
}
.tab_select{
   background:#444;
   color: #C8C8C8;
   padding-top: 5px;
   padding-bottom: 5px;
   padding-left: 10px;
   position: fixed;
   top: 0;
   width: 100%;

}
select {
    padding:3px;
    width: 250px;
    margin: 5px;
    border-radius:8px;
    background: #f8f8f8;
    border:none;
    outline:none;
    display: inline-block;
    cursor:pointer;
}
.getlink_select{
  width: 70px;
  padding:0px;
  margin: 0px;
  border-radius:8px;
  background: #f8f8f8;
  border:none;
  outline:none;
  display: inline-block;
  cursor:pointer;

}
.getlink{
  margin: 0 auto;

  background-color: #FFFFFF;
  padding: 50px;
  text-align: center;

}
.report_name{
   float: right;
   margin-right: 20px;
   font-size: 26px;
   font-family: Impact;
   text-decoration: underline;
}
table{
   font-size: 12px;
   width: 95%;
   margin: auto;
   background-color: #FFFFFF;

}
table th{
   background:#444;
   padding-top: 5px;
   padding-bottom: 5px;
   color: #FFFFFF;
}
table tr:hover{
   background-color:violet;

   cursor:pointer


}
table td{
   padding-top: 2px;
   padding-bottom: 2px;

}
img{
  padding-left: 10px;
}
.Switch{
  padding: 2px;
  background-color: green;
  color:white;
  text-decoration: none;

}
.Send{
  padding: 2px;
  background-color: blue;
  color:white;
  text-decoration: none;
}
.Reject{
  padding: 2px;
  background-color: red;
  color:white;
  text-decoration: none;
}
.Clear{
  padding: 2px;
  background-color: gray;
  color:white;
  text-decoration: none;
}
</style>
</head>
<body>
<div class="contrainner">
<div class="getlink">
http://www.bizservsolution.com/servicedesk/getgps/getgeo.php?jobid=<?=$jobid?>&engineerid=<?=$engineerid?>&logtype=<?=$logtype?>
</div>
</div>
</body>
</html>
