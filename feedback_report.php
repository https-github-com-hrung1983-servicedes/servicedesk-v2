<?
require_once("function.php");
  if(!checkUser()){    echo Message(35,"red",$titel1,$msg1,"<a href='index.php?link=logcall.index'> $login </a>");
  exit;
  }           
$select_cate = $_REQUEST["select_cate"];
if($select_cate == ""){
   $select_cate  = "0";
}

$select_rec= $_REQUEST["select_rec"];
if($select_rec == ""){
   $select_rec  = "0";

}
?>


<html>
<head>
   <title>BSS : Feedback Report</title>
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
    
    margin: 5px;
    border-radius:8px;
    background: #f8f8f8;
    border:none;
    outline:none;
    display: inline-block;
    cursor:pointer;
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
   background-color: #606060;
   color: #FFFFFF;
   cursor:pointer

   
}
table td{
   padding-top: 2px;
   padding-bottom: 2px;
   
}
</style>
</head>
<body>
<div class="contrainner">
<div class="tab_select">
<?=iconv('UTF-8','TIS-620',"ประเภทใบงาน")?>
  <select id="1" OnChange="window.location='?select_cate='+this.value+'&select_rec=0'">
  <option value="0" <? if($select_cate == "All") echo "selected";?>>---All---</option>
   <?
   $sql_cate="Select distinct a.category_id,a.category_type  From tbl_category_type a 
   left outer Join tbl_log_call_center b ON b.category_type = a.category_id 
   where b.status_call='feedback'    
   order by a.category_type";
   $que_cate = mysqli_query($conn,$sql_cate);

   while($data_cate = mysqli_fetch_array($que_cate))
      { 
       $cate_type=$data_cate['category_type'];
       $cate_id=$data_cate['category_id'];
      ?>
      <option value="<?=$cate_id?>" <? if($select_cate == $cate_id) echo "selected";?>><?=$cate_type?></option>
      <?
      }
   ?>
   </select>
  
   <?=iconv('UTF-8','TIS-620',"ช่างผู้รับงาน")?>
  <select id="2" OnChange="window.location='?select_cate='+<?=$select_cate?>+'&select_rec='+this.value;">
  <option value="0" <? if($select_rec == "All") echo "selected";?>>---All---</option>
<?
   $sql_rec="select distinct b.user_id,b.name,b.sname,b.status_user from tbl_log_call_center a
   left join  tbl_user b on b.user_id=a.reciept_job_user_id
   where a.status_call='feedback'
   and a.type_service='BSS'
   and b.status_user='y'";
   if($select_cate!="0"){
   $sql_rec.="and a.category_type = $select_cate order by b.name"; }
   else{ $sql_rec.="order by b.name"; }
   
   $que_rec = mysqli_query($conn,$sql_rec);
   while($data_rec = mysqli_fetch_array($que_rec))
   {
    $rec_name=$data_rec['name']." ".$data_rec['sname'];
    $rec_id=$data_rec['user_id'];
   ?>
   <option value="<?=$rec_id?>" <? if($select_rec == $rec_id) echo "selected";?>><?=$rec_name?></option>
   <?
   }
?>
   </select>
   
<div class="report_name">Feedback Report</div>
</div>
<br>
<table cellpadding="0" cellspacing="0">
   <tr>
      <th width="3%"><?=iconv('UTF-8','TIS-620',"ลำดับที่")?></th>
      <th width="5%"><?=iconv('UTF-8','TIS-620',"วันที่แจ้ง")?></th>
      <th width="15%"><?=iconv('UTF-8','TIS-620',"ประเภทใบงาน")?></th>
      <th width="7%"><?=iconv('UTF-8','TIS-620',"เลขที่ใบงาน")?></th>
      <th width="5%"><?=iconv('UTF-8','TIS-620',"รหัสสถานี")?></th>
      <th width="45%"><?=iconv('UTF-8','TIS-620',"ปัญหา")?></th>
      <th width="10%"><?=iconv('UTF-8','TIS-620',"ผู้รับใบงาน")?></th>
      <th width="10%"><?=iconv('UTF-8','TIS-620',"ช่างผู้รับงาน")?></th>
   </tr>
   <?
   $sql_logcall="Select 
      tbl_log_call_center.id,
      tbl_log_call_center.open_call_dte,
      tbl_log_call_center.open_call_tme,
      tbl_log_call_center.category_type,
      tbl_category_type.category_type,
      tbl_log_call_center.job_no,
      tbl_log_call_center.site_id,
      tbl_log_call_center.problem,
      tbl_log_call_center.problem_solving,
      u1.name as reciept_name,
      u1.sname as reciept_sname,
      tbl_log_call_center.type_service,
      tbl_log_call_center.reciept_job_user_id,
      u2.name as engineer_name,
      u2.sname as engineer_sname,
      u2.tel as engineer_tel,
      tbl_log_call_center.status_call,
      tbl_log_call_center.status_sla,
      tbl_log_call_center.doc 
      From tbl_log_call_center 
      Inner Join tbl_category_type ON tbl_log_call_center.category_type = tbl_category_type.category_id 
      Left Join tbl_user u1 ON tbl_log_call_center.reciept_job_bss = u1.user_id 
      Left Join tbl_user u2 ON tbl_log_call_center.reciept_job_user_id = u2.user_id
      where tbl_log_call_center.status_call ='feedback'";
  if($select_cate != "0" && $select_rec != "0")  {  				
   $sql_logcall .= "and tbl_log_call_center.category_type = $select_cate and tbl_log_call_center.reciept_job_user_id = $select_rec order by tbl_log_call_center.open_call_dte DESC";}
  else if($select_cate == "0" && $select_rec !="0"){
   $sql_logcall .= "and tbl_log_call_center.reciept_job_user_id = $select_rec order by tbl_log_call_center.open_call_dte DESC";}
  else if($select_rec == "0" && $select_cate!="0"){
   $sql_logcall .= "and tbl_log_call_center.category_type = $select_cate order by tbl_log_call_center.open_call_dte DESC";}
  else{
   $sql_logcall .= "order by tbl_log_call_center.open_call_dte DESC"; }
   $que_logcall = mysqli_query($conn,$sql_logcall);
   $i=0;
   while($data_logcall = mysqli_fetch_array($que_logcall)) {
      $i++
      
   ?>
   <tr>
      <td align="center"><?=$i?></td>
      <td><?=$data_logcall["open_call_dte"]?></td>
      <td><nobr><?=$data_logcall["category_type"]?></nobr></td>
      <td><nobr><?=$data_logcall["job_no"]?></nobr></td>
      <td><?=$data_logcall["site_id"]?></td>
      <td title="<?=$data_logcall["problem"]?>"><?=$data_logcall["problem"]?></td> 
      <td><nobr><?=$data_logcall["reciept_name"]?> <?=$data_logcall["reciept_sname"]?></nobr></td>
      <td><nobr><?=$data_logcall["engineer_name"]?> <?=$data_logcall["engineer_sname"]?></nobr></td>
   </tr>
   <? } ?>
   <tr>
      <td colspan=8 align="center" style="background-color: #444;color: #FFFFFF;"><?=iconv('UTF-8','TIS-620',"จำนวน")?> <?=$i?> <?=iconv('UTF-8','TIS-620',"แถว")?></td>
   </tr>
</table>
<br>
</div>
</body>
</html>


