<?
session_start();
header("Content-Type: text/html; charset=tis-620");

require_once("function.php");
//require_once("script/function.js");

  if(!checkUser()){    echo Message(35,"red",$titel1,$msg1,"<a href='index.php?link=sch_site'> $login </a>");
  exit;
  }
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874">
<link rel="stylesheet" href="style.css">
<script language="javascript" src="script.js"></script>
<script language="JavaScript">
   function SelectedVal(site_id,site_name,site_province,site_phase,way_length,center_position){
        window.opener.document.form1.txtSid.value = site_id;
        window.opener.document.form1.txtSid_name.value = site_name;
        window.opener.document.form1.txtSidProvince.value = site_province;
        window.opener.document.form1.province_phase.value = site_phase;
        window.opener.document.form1.way_length.value = way_length;
     



   //if(way_length >= 200){
       //     window.opener.document.form1.cmbCat.value = "CAT 1";
       //     window.opener.document.form1.txtSLA.value = "6";
        //}

      //  alert("site_id : "+site_id);
      //  alert("site_name : "+site_name);
      //  alert("site_province : "+site_province);
      //  alert("site_phase : "+site_phase);
      //  alert("way_length : "+way_length);
      //  alert("responsible_by : "+responsible_by);
      //  alert("center_position : "+center_position);

        window.close();
   }
    </script>
   <link href="style/mytable.css" rel="stylesheet" type="text/css" />

<title>Bizserv Solution Co.,Ltd</title></head>
 <style type="text/css">
    <!--
   .th{ background-color:#003366; color:#FFF; padding:0px; border:0px solid #ccc; height:20px; }
    -->
</style>
<body  >
<br>
<center>
        <?
        $type = $_REQUEST["type"];
        $site = $_REQUEST["site"];

        switch (variable) {
          case 'value':
            # code...
            break;

          default:
            # code...
            break;
        }

 if($type == "39"){

   $sql = "SELECT
           tbl_site.*,
           tbl_site_ngv_responsible.way_length,
           tbl_site_ngv_responsible.responsible_by,
           tbl_site_ngv_responsible.center_position,
           tbl_province.province_name as provincename,
		tbl_phase.phase_name
           FROM
           tbl_site
           Left Join tbl_site_ngv_responsible ON tbl_site_ngv_responsible.site_id = tbl_site.site_id
           Left Join tbl_province ON tbl_site.province_name = tbl_province.id
           Left Join tbl_phase ON tbl_site.center_phase = tbl_phase.phase_id
          Where tbl_site.site_id like '%$site%'
          and  tbl_site.from_owner ='RICOH'
          ";


 }else {

   $sql = "SELECT
           tbl_site.*,
           tbl_site_ngv_responsible.way_length,
           tbl_site_ngv_responsible.responsible_by,
           tbl_site_ngv_responsible.center_position,
           tbl_province.province_name as provincename,
		tbl_phase.phase_name
           FROM
           tbl_site
           Left Join tbl_site_ngv_responsible ON tbl_site_ngv_responsible.site_id = tbl_site.site_id
           Left Join tbl_province ON tbl_site.province_name = tbl_province.id
           Left Join tbl_phase ON tbl_site.center_phase = tbl_phase.phase_id
          Where tbl_site.site_id like '%$site%'
          and  tbl_site.from_owner !='RICOH'
          ";
 }
//echo $sql; 
                    $res = mysqli_query($conn,$sql);

                    ?>
                    <table align="center" bordercolor="#000000"   class="mytable" id="table7" border="0" width="60%">
                            <tr>
                                  <th width="50" class="th" ><nobr>&nbsp;No. :</th>
                                  <th width="100" class="th" ><nobr>&nbsp;Site ID<nobr></th>
                                  <th width="300" class="th" ><nobr>&nbsp;Site Name<nobr></th>
                                  <th width="150" class="th" ><nobr>&nbsp;Province<nobr></th>
                         </tr>
                      <?
                      $i = 1;
                         while( $row = mysqli_fetch_array($res) ){
                                         $str = $row["responsible_by"]." ".$row["way_length"]."Km";
                        ?>
                        <tr style="cursor:hand"onmouseover=high(this) onmouseout=low(this) onClick="SelectedVal('<?=$row[site_id]?>','<?=$row[site_name]?>','<?=$row[provincename]?>','<?=$row[phase_name]?>','<?=$str?>','<?=$row[center_position]?>')">
                        <?
                        echo"<td  style='padding:0px; border-bottom:1px solid #ccc; border-right:0px solid #ccc;' align = 'center'>$i</td>";
                        echo"<td  style='padding:0px; border-bottom:1px solid #ccc; border-right:0px solid #ccc;' align = 'center'>$row[site_id]</td>";
                        echo"<td  style='padding:0px; border-bottom:1px solid #ccc; border-right:0px solid #ccc;'>&nbsp;$row[site_name]</td>";
                        echo"<td  style='padding:0px; border-bottom:1px solid #ccc; border-right:0px solid #ccc;'>&nbsp;$row[provincename]</td>";
                        ?>
                    </tr>
            <?              }


             ?>

        </table>

</center>
</body>
</html>
