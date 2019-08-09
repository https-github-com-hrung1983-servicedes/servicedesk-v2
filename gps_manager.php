<?
session_start();
require_once("function.php");
  if(!checkUser()){    echo Message(35,"red",$titel1,$msg1,"<a href='index.php?link=gps_manager'> $login </a>");
  exit;
  }
$engineerid= $_REQUEST["engineerid"];
if($engineerid == ""){
   $engineerid_sql  = " a1.show_on_app_status='y' ";
}else{
  $engineerid_sql  = " a1.reciept_job_user_id = '$engineerid'";

}
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


<div class="tab_select">
  <form name="frm1" id="frm1" action="gps_manager.php">

      <?=iconv('UTF-8','TIS-620',"ช่างผู้รับงาน")?>
      <select id="engineerid" name="engineerid">
      <option value="" <? if($engineerid == "All") echo "selected";?>>---All---</option>
      <?
           $sql_rec="SELECT distinct a1.user_id,a1.name,a1.sname,a1.status_user from
                      (
                      select
                      distinct b.user_id,b.name,b.sname,b.status_user
                      from tbl_log_call_center a
                      left join  tbl_user b on b.user_id=a.reciept_job_user_id
                      where
                      a.status_close_job = 'o'
                      and a.type_service='BSS'
                      and b.status_user='y'
                      and b.group_email in ('s','c')
                      and a.show_on_app_status != ''

                      union all

                      SELECT
                       b.user_id,b.name,b.sname,b.status_user
                      from itbl_logcall_retail a
                      left join  tbl_user b on b.user_id= a.reciept_job_engineer
                      where
                      a.status_close_job = 'o'
                      and b.status_user='y'
                      and b.at='BSS'
                      and b.group_email in ('s','c')
                      and a.show_on_app_status != ''

                      union all

                      SELECT
                       b.user_id,b.name,b.sname,b.status_user
                      from tbl_major_logcall a
                      left join  tbl_user b on b.user_id= a.reciept_job_engineer
                      where
                      a.status_close_job = 'o'
                      and b.status_user='y'
                      and b.at='BSS'
                      and b.group_email in ('s','c')
                      and a.show_on_app_status != ''
                      ) a1
                      order by a1.name";

           $que_rec = mysqli_query($conn,$sql_rec);
           while($data_rec = mysqli_fetch_array($que_rec)) {
            $rec_name=$data_rec['name']." ".$data_rec['sname'];
            $rec_id=$data_rec['user_id'];
       ?>

       <option value="<?=$rec_id?>" <? if($engineerid == $rec_id) echo "selected";?>><?=$rec_name?></option>

       <? } ?>
       </select>
       <input type="submit" value="Search">
    <div class="report_name">GPS MANAGER</div>
    </div>
  </form>
<br>


<table cellpadding="0" cellspacing="0">
   <tr>
      <th width="1%"><?=iconv('UTF-8','TIS-620',"")?></th>
      <th width="3%"><?=iconv('UTF-8','TIS-620',"#")?></th>
      <th width="3%"><?=iconv('UTF-8','TIS-620',"Type")?></th>
      <th width="10%"><?=iconv('UTF-8','TIS-620',"Date")?></th>
      <th width="15%"><?=iconv('UTF-8','TIS-620',"Category Job")?></th>
      <th width="7%"><?=iconv('UTF-8','TIS-620',"Job No")?></th>
      <th width="3%"><?=iconv('UTF-8','TIS-620',"CAT")?></th>
      <th width="25%"><?=iconv('UTF-8','TIS-620',"Site Name")?></th>
      <th width="15%"><?=iconv('UTF-8','TIS-620',"Status GPS")?></th>
      <th width="5%"><?=iconv('UTF-8','TIS-620',"Engineer")?></th>
      <th width="7%"><?=iconv('UTF-8','TIS-620',"Action")?></th>
      <th width="5%"><?=iconv('UTF-8','TIS-620',"Get Link")?></th>

   </tr>
   <?



   $sql_logcall="select * from
                  (
                  Select
                      'PTT' as log_type,
                        a.id,
                        a.open_call_dte,
                        b.category_type,
                        a.problem,
                        a.job_no,
                        a.site_id,c.site_name,
                        a.type_service,
                        a.reciept_job_user_id,
                        u2.name as engineer_name,
                        u2.sname as engineer_sname,
                        a.status_call,
                        a.severity,
                        a.show_on_app_status
                        From tbl_log_call_center a
                        left outer Join tbl_category_type b ON a.category_type = b.category_id
                        Left outer Join tbl_user u2 ON a.reciept_job_user_id = u2.user_id
                        left outer join tbl_site c on a.site_id=c.site_id
                        where
                        a.status_close_job = 'o'
                        and a.type_service='BSS'
                        and u2.at='BSS'
                        and u2.group_email in ('s','c')
                        and a.show_on_app_status != ''

                   union all

                   Select
                      'BSS' as log_type,
                        a1.id,
                        a1.call_openjob_datetime,
                        b1.category_job ,
                        a1.problem_job_detail ,
                        a1.job_no,
                        c1.customer_id, c1.customer_name,
                        'BSS' as type_service,
                        a1.reciept_job_engineer ,
                        u2.name as engineer_name,
                        u2.sname as engineer_sname,
                        a1.status_call,
                        a1.cat,
                        a1.show_on_app_status
                        From itbl_logcall_retail a1
                        left outer Join itbl_category_job b1 ON a1.problem_job = b1.id
                        Left outer Join tbl_user u2 ON a1.reciept_job_engineer = u2.user_id
                        left outer join itbl_customer4 c1 on a1.customer_id= c1.id
                        where a1.status_close_job = 'o'
                        and u2.at='BSS'
                        and u2.group_email in ('s','c')
                        and a1.show_on_app_status != ''

                    union all

                    select
                          'MAJOR' as log_type,
                           a1.id,
                           a1.call_openjob_datetime,
                            b1.cate_name ,
                           a1.problem_job_detail ,
                           a1.job_no,
                           c1.customer_id, c1.customer_name,
                           'BSS' as type_service,
                           a1.reciept_job_engineer ,
                           u2.name as engineer_name,
                           u2.sname as engineer_sname,
                           a1.status_call,
                           a1.cat,
                           a1.show_on_app_status
                           From tbl_major_logcall a1
                           left outer Join tbl_major_category_hardware b1 ON a1.problem_job = b1.cate_id
                           Left outer Join tbl_user u2 ON a1.reciept_job_engineer = u2.user_id
                           left outer join tbl_major_site c1 on a1.customer_id= c1.id
                           where a1.status_close_job = 'o'
                           and u2.at='BSS'
                           and u2.group_email in ('s','c')
                           and a1.show_on_app_status != ''
                        ) a1
                        where $engineerid_sql
                        Order by a1.engineer_name
                        ";
   $que_logcall = mysqli_query($conn,$sql_logcall);
   $i=0;
   while($data_logcall = mysqli_fetch_array($que_logcall)) {
      $i++;
      $job_id = $data_logcall["id"];
      $log_type = $data_logcall["log_type"];
      $engineerid=$data_logcall["reciept_job_user_id"];

   ?>
   <tr>
      <td align="center">
        <? if($data_logcall["show_on_app_status"]=="y") { ?>
        <img src="image/on_car.png" title="" height="20" width="20">
        <? } ?>
      </td>
      <td align="center">
        <?=$i?>
      </td>
      <td align="center">
        <?=$data_logcall["log_type"]?>
      </td>
      <td align="center">
        <?=$data_logcall["open_call_dte"]?>
      </td>
      <td>
        <nobr><p title="<?=$data_logcall['problem']?>"><?=$data_logcall["category_type"]?></p></nobr>
      </td>
      <td>
        <nobr><?=$data_logcall["job_no"]?></nobr>
      </td>
      <td>
        <?=$data_logcall["severity"]?>
      </td>
      <td>
        <?=$data_logcall["site_id"]?> : <?=$data_logcall["site_name"]?>
      </td>
      <td>
        <?
          $sql_status_g="select count(a.job_no) as G from tbl_job_location a where a.job_no='".$data_logcall["job_no"]."' and status_shared='G' ";
          $que_status_g = mysqli_query($conn,$sql_status_g);
          $status_g = mysqli_fetch_array($que_status_g);

          $sql_status_o="select count(a.job_no) as O from tbl_job_location a where a.job_no='".$data_logcall["job_no"]."' and status_shared='O' ";
          $que_status_o = mysqli_query($conn,$sql_status_o);
          $status_o = mysqli_fetch_array($que_status_o);

          $sql_status_c="select count(a.job_no) as C from tbl_job_location a where a.job_no='".$data_logcall["job_no"]."' and status_shared='C' ";
          $que_status_c = mysqli_query($conn,$sql_status_c);
          $status_c = mysqli_fetch_array($que_status_c);

          $sql_status_f="select count(a.job_no) as F from tbl_job_location a where a.job_no='".$data_logcall["job_no"]."' and status_shared='F' ";
          $que_status_f = mysqli_query($conn,$sql_status_f);
          $status_f = mysqli_fetch_array($que_status_f);

          $sql_status_all="select count(a.job_no) as sum_all from tbl_job_location a where a.job_no='$job_id' ";
          $que_status_all = mysqli_query($conn,$sql_status_all);
          $status_all = mysqli_fetch_array($que_status_all);

          //echo "[".$status_all["sum_all"]."]";
           if($status_g["G"] > 0) { ?> <img src="image/map-location.png" title="Get Job [<?=$status_g['G']?>]" height="20" width="20"> <? } ?>
        <? if($status_o["O"] > 0) { ?> <img src="image/position.png" title="On Site [<?=$status_o['O']?>]" height="20" width="20"> <? } ?>
        <? if($status_c["C"] > 0) { ?> <img src="image/placeholder.png" title="Close Job [<?=$status_c['C']?>]" height="20" width="20"> <? } ?>
        <? if($status_f["F"] > 0) { ?> <img src="image/position-1.png" title="Finish [<?=$status_f['F']?>]" height="20" width="20"> <? } ?>

      </td>
      <td>
        <nobr><?=$data_logcall["engineer_name"]?> </nobr>
      </td>

        <td align="center">
          <?

          $sql_count2="select a1.job_no as id,count(a1.job_no) as show_on_app_count
                      from
                      (
                      select
                      a.job_no , a.reciept_job_user_id
                      from tbl_log_call_center a
                      where a.status_call='feedback'
                      and a.type_service='BSS'
                      and
                      (a.show_on_app_status='y')
                      union all
                      select b.job_no , b.reciept_job_engineer
                      from itbl_logcall_retail b
                      where b.status_call='feedback'
                      and
                      (b.show_on_app_status='y')

                      union all
                      select b.job_no , b.reciept_job_engineer
                      from tbl_major_logcall b
                      where b.status_call='feedback'
                      and
                      (b.show_on_app_status='y')


                      ) a1
                      where
                      a1.reciept_job_user_id = '$engineerid' ";//echo $sql_count2;
          $que_count2 = mysqli_query($conn,$sql_count2);
          $count2 = mysqli_fetch_array($que_count2);
          $show_on_app_count2=$count2["show_on_app_count"];

          if($engineerid != ""){
$job_no = $data_logcall["job_no"];
                if($data_logcall["show_on_app_status"]!="y") {
                  if($show_on_app_count2 != 0 ) { ?>
                      <a href="gps_manager.action.php?action=switch&jobid=<?=$job_no?>&logtype=<?=$log_type?>&engineerid=<?=$engineerid?>" onClick="return  confirm('Switch to <?=$data_logcall["job_no"]?>')" class="Switch">Switch</a>
                  <? } else{ ?>
                      <a href="gps_manager.action.php?action=send&jobid=<?=$job_no?>&logtype=<?=$log_type?>&engineerid=<?=$engineerid?>" onClick="return  confirm('Send <?=$data_logcall["job_no"]?>')" class="Send">Send</a>
                  <? }
                }else { ?>
                      <a href="gps_manager.action.php?action=reject&jobid=<?=$job_no?>&engineerid=<?=$engineerid?>" onClick="return  confirm('Reject <?=$data_logcall["job_no"]?>')" class="Reject">Reject</a>
            <?    }
             }
              ?>
              <a href="gps_manager.action.php?action=clear&jobid=<?=$job_no?>" onClick="return  confirm('Clear <?=$data_logcall["job_no"]?>')" class="Clear">Clear</a>
        </td>
        <td>
          <a href="gps_manager.getlink.php?jobid=<?=$job_no?>&engineerid=<?=$engineerid?>&logtype=<?=$data_logcall["log_type"]?>" target="_blank">Get Link</a>
        </td>

   </tr>
   <? } ?>
   <tr>
      <td colspan="12" align="center" style="background-color: #444;color: #FFFFFF;"><?=iconv('UTF-8','TIS-620',"จำนวน")?> <?=$i?> <?=iconv('UTF-8','TIS-620',"แถว")?></td>
   </tr>
</table>

</div>
</body>
</html>
