<?php
header("Content-type:text/xml; charset=UTF-8");
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);
require_once("function.php");
echo '<?xml version="1.0" encoding="utf-8"?>';
// 6-7 บรรทัดแรกด้านบน เป็นการกำหนด ให้ไฟล์นี้ส่งออกเป็นไฟล์ แบบ xml
// และการกำหนดการเชิ่อมต่อกับฐานข้อมูล
?>

<markers>

<?php
$sql_user="select distinct a.user_id from tbl_job_location a";
 $rs_user = mysqli_query($conn,$sql_user);
 $i=0;
 while ($c_user = mysqli_fetch_array($rs_user)) { 
     $sql_location="SELECT c.name,c.sname,b.la,b.lo 
                    ,b.dtetme 
                    ,b.status_shared 
                    from tbl_job_location b 
                    left outer join tbl_user c on b.user_id=c.tel 
                    where b.user_id = '$c_user[user_id]' and c.status_user='y'
order by b.dtetme desc
limit 0,1";
     $rs_location = mysqli_query($conn,$sql_location);
     $num_rows = mysqli_num_rows($rs_location);
    while ($c_location = mysqli_fetch_array($rs_location)) {
        $i++;

?>
    <marker id="<?=$c_user['user_id']?>">
        <name><?=$c_location["name"];?> <?=$c_location["sname"];?> [<?=$c_location["status_shared"]?>][<?=$c_location["dtetme"]?>]</name>
        <latitude><?=$c_location['la']?></latitude>
        <longitude><?=$c_location['lo']?></longitude>
    </marker>
<?php
    }
}
?>
</markers>
