<?php
require_once("function.php");   
$sql = "SELECT
tbl_incentive_ot.other_no,
tbl_incentive_ot.other_date,
tbl_incentive_ot.other_receive,
tbl_incentive_ot.other_description,
tbl_user.name,
tbl_user.sname,
tbl_incentive_detail.job_no,
tbl_incentive_detail.site_id,
tbl_log_call_center.problem,
tbl_log_call_center.problem_solving,
tbl_insident_hw.cate_id,
tbl_insident_hw.serial_no
FROM
tbl_incentive_ot
Inner Join tbl_user ON tbl_incentive_ot.other_receive = tbl_user.id_login
Inner Join tbl_incentive_detail ON tbl_incentive_ot.id = tbl_incentive_detail.id
Inner Join tbl_log_call_center ON tbl_incentive_detail.job_no = tbl_log_call_center.job_no AND tbl_incentive_detail.site_id = tbl_log_call_center.site_id
Left Join tbl_insident_hw ON tbl_log_call_center.job_no = tbl_insident_hw.job_no AND tbl_log_call_center.site_id = tbl_insident_hw.site_id
Where tbl_incentive_ot.other_no in ('2562-0003019','2562-0003055','2562-0002977','2562-0003041','2562-0002985','2562-0003056','2562-0002986','2562-0003048',
'2562-0003027','2562-0003057','2562-0003032','2562-0003054','2562-0002974','2562-0003046',
'2562-0002947','2562-0002967','2562-0003025','2562-0003052','2562-0002976','2562-0002972',
'2562-0003040','2562-0003018','2562-0003047','2562-0002975','2562-0003038','2562-0002970',
'2562-0003044','2562-0003028','2562-0003039','2562-0003026','2562-0003049','2562-0002969',
'2562-0003042','2562-0003036','2562-0003024','2562-0003043','2562-0003020','2562-0003037')";
$rs = mysqli_query($conn,$sql);
while($c= mysqli_fetch_array($rs)){
    if($c["cate_id"]=="" && $c["serial_no"]=="" ){
        echo $c["name"]."  ".$c["sname"]." - ".$c["site_id"]."  (".$c["job_no"].") <br> problem : ".$c["problem"]." <br> solving : ".$c["problem_solving"]."<br>";
        echo $c["cate_id"]."".$c["serial_no"]."<hr>";
    }
  
}
?>