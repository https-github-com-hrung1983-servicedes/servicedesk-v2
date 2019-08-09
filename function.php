<?
//session_start();

header("Content-Type: text/html; charset=tis-620");

require("connection.php"); 

$hour = 0;   
	$min = 10;  
	$Year = date("Y")+543;
	$thaimonth= Array("01"=>"ม�?ราคม","02"=>"�?ุมภาพันธ์","03"=>"มีนาคม","04"=>"เมษายน","05"=>"พฤษภาคม","06"=>"มิถุนายน","07"=>"�?ร�?�?าคม","08"=>"สิงหาคม","09"=>"�?ันยายน","10"=>"ตุลาคม","11"=>"พฤศจิ�?ายน ","12"=>"ธันวาคม"); 
	$thaiweekFull=array("ÇÑ¹�?Ò·ÔµÂì ·Õè","ÇÑ¹¨Ñ¹·Ãì ·Õè","ÇÑ¹�?Ñ§¤ÒÃ ·Õè","ÇÑ¹¾Ø¸ ·Õè","ÇÑ¹¾ÄËÑÊº´Õ ·Õè","ÇÑ¹ÈØ¡Ãì ·Õè","ÇÑ¹àÊÒÃì ·Õè");
	$thaimonthFull = array("","�?¡ÃÒ¤�?","¡Ø�?ÀÒ¾Ñ¹¸ì","�?Õ¹Ò¤�?","à�?ÉÒÂ¹","¾ÄÉÀÒ¤�?","�?Ô¶Ø¹ÒÂ¹","¡Ã¡®Ò¤�?","ÊÔ§ËÒ¤�?","¡Ñ¹ÂÒÂ¹","µØÅÒ¤�?", "¾ÄÈ¨Ô¡ÒÂ¹","¸Ñ¹ÇÒ¤�?");
	//$thaimonth = array("�?.¤.","¡.¾.","�?Õ.¤.","à�?.Â.","¾.¤.","�?Ô.Â.","¡.¤.","Ê.¤.","¡.Â.","µ.¤.", "¾.Â.","¸.¤.");
	$colName=array("","sumEval1","sumEval2","sumEval3","sumEval4");
	// 3 Ê.¤. 2544
	$mdate = date("j ",mktime( date("H")+$hour, date("i")+$min )). $thaimonth[date("m")-1]." ".$Year; 

	// 3 Ê.¤. 2544 àÇÅÒ 12:36 ¹.
	$ThaiDate = date("j ").$thaimonth[date("m")-1]." ".$Year.date(" àÇÅÒ H:i ¹.",mktime( date("H")+$hour, date("i")+$min )); 
	
	// ÇÑ¹ÈØ¡Ãì·Õè 3 Ê.¤. 2544 àÇÅÒ 12:36 ¹.
	$ThaiDateFull = $thaiweekFull[date("w")]. date(" j "). $thaimonthFull[date("m")-1]. " ". $Year . date(" àÇÅÒ H:i ¹.",mktime( date("H")+$hour, date("i")+$min )); 

	// ä´é¤èÒà»ç¹ ÇÔ¹Ò·Õ ¹Ñº¨Ò¡»Õ ¤.È.1900
    $Logtime = date("U",mktime( date("H")+$hour, date("i")+$min));
    $msg1 = "คุณไม่มีสิทธิ์ใช้งานหน้านี้";
    $msg2 = "¤Ø³ä�?è�?ÕÊÔ·¸Ôìà¢éÒãªéË¹éÒ¹Õé";
    $titel1 = "แจ้งเตือน";
    $login = "ล็อกอินใหม่";
    $back = "กลับ";


    
	function getDte(){
        $today = getdate();
        $dte = $today["year"] ."-".$today["mon"]."-".$today["mday"];         
        return $dte;
    }
             
    function getDteTme(){
        $today = getdate();
        $dte = $today["year"] ."-".$today["mon"]."-".$today["mday"]." ".($today["hours"]-1).":".$today["minutes"].":".$today["seconds"];         
        return $dte;
    }
    
    function getTime($d,$pos){
         $v=split(":",$d);
         
        return $v[$pos];
    }
    
    function dateThai($d){
        $v=split("-",$d);
        return $v[2]."-".$v[1]."-".$v[0];
    }

    function dateMDY($d){
        $v=split("-",$d);
        return $v[1]."-".$v[2]."-".$v[0];
    }

	function stringvalue($s){
        return "'".$s."'";
}
  function getIDRand(){
		$abc= array("a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k", "l", "m", "n", "o", "p", "q", "r", "s", "t", "u", "v", "w", "x", "y", "z"); 
$num= array("0", "1", "2", "3", "4", "5", "6", "7", "8", "9");
return $abc[rand(0,25)]; 
//echo $num[rand(0,9)]; 
	}
    
    function format_moneys($val){
    	return number_format(sprintf("%01.2f", $val),2);
    }
    
	function getDescriptionJob($id){
		global $conn;
		$rs = mysqli_query($conn,"Select * from tbl_report_description where report_id = '$id'");
		$c = mysqli_fetch_array($rs);
		return $c["report_description2"];
	}


function splitText($str,$amt){
       $s = substr($str,0,$amt);
	   $s1 = substr($str,$amt,$amt+$amt);
	   $s2 = substr($str,$amt+$amt,$amt+$amt+$amt);
	   $s3 = substr($str,$amt+$amt+$amt,$amt+$amt+$amt+$amt);
	   return $s."<br>".$s1."\\n".$s2."\\n".$s3;
}

  function getSiteName($type,$site){
	  global $conn;
             $sql = "SELECT
                        tbl_3g_responsibility.site_id,
                        tbl_3g_responsibility.site_type
                      FROM
                        tbl_3g_responsibility
                      Where tbl_3g_responsibility.site_id = '$site'";
               $rc = mysqli_query($conn,$sql);
               $c = mysqli_fetch_array($rc);                           
               
               $type = $c["site_type"];  
    	if($type == "2"){   
    			 $col = " site_name_old as site_name";
    			 $table = "tbl_station_ngv";
    			 $where = " site_id = '$site'";
    	}else if($type == "3"){   
                $col = " site_name"; 
                $table = " tbl_station_oil"; 
                $where = " station_id = '$site'";
             } else if($type == "4"){
    			$col = " site_name"; 
                $table = " tbl_station_amazon"; 
                $where = " site_id = '$site'";
    	} else {
    			$col = " customer_name as site_name"; 
                $table = " tbl_customer"; 
                $where = " customer_code = '$site'";
    	}
               $sql = "Select $col from $table where $where";
               $rc = mysqli_query($conn,$sql);
               $c= mysqli_fetch_array($rc);
               return $c["site_name"];//$type.$sql;
    		   //return $sql;
         }
     
     function checkDupplicateSiteID($type,$site){
		 global $conn;
     	if($type == "2"){   
     		 $col = " count(site_id) as cnt";
     		 $table = "tbl_station_ngv";
     		 $where = " site_id = '$site'";
     	}else if($type == "3"){   
                 $col = " count(station_id) as cnt"; 
                 $table = " tbl_station_oil"; 
                 $where = " station_id = '$site'";
        } else if($type == "4"){
     		 $col = " count(site_id) as cnt"; 
                 $table = " tbl_station_amazon"; 
                 $where = " site_id = '$site'";
     	} else {
     	         $col = " count(customer_code) as cnt"; 
                 $table = " tbl_customer"; 
                 $where = " customer_code = '$site'";
     	}
                $sql = "Select $col from $table where $where";
                $rc = mysqli_query($conn,$sql);
                $c= mysqli_fetch_array($rc);
                return $c["cnt"];//$type.$sql;
     	      //  return $sql;
          }
  
function checkUser(){ 
  		if(isset($_SESSION["Uid"])){	
			/*if($_SESSION["Ustate"]=="P"){
					$GLOBALS['add']=false;
					$GLOBALS['edit']=false;
					$GLOBALS['del']=false;
			}elseif($_SESSION["Ustate"]=="U"){
					$GLOBALS['add']=true;
					$GLOBALS['edit']=true;
					$GLOBALS['del']=false;
			}elseif($_SESSION["Ustate"]=="A"){
					$GLOBALS['add']=true;
					$GLOBALS['edit']=true;
					$GLOBALS['del']=true;
			}     */
   				 return  true;
				 }
  			else {				
			return false;
			}
  }
  function Message($Size,$Color,$Message,$Comment,$Link){
        $temp = "<br><center>\n";
        $temp .= "<table width=$Size% border=0 cellspacing=0 cellpadding=0 bgcolor=#000000>\n";
        $temp .= "<tr><td><table width=100% border=0 cellpadding=2 cellspacing=1>\n";
        $temp .= "<tr bgcolor=#FFFFCC>\n"; 
        $temp .= "<td align=center><br>\n";
        $temp .= "<font color=$Color class=size3><b>$Message</b></font>\n";
        $temp .= "<br><br>$Comment<br><br>\n";
        $temp .= "</td></tr></table></td></tr></table><br>\n";
        $temp .= "[ $Link ]\n";
        $temp .= "</center>\n";
        return ( $temp ) ;
    }    
    function login($username,$password,$tablename){  
		global $conn;
		
        $sql = "select * from $tablename where User_Name='$username' and User_Password='$password'";
        $result = mysqli_query($conn,$sql);
		$c=mysqli_fetch_array($result);
        if(!$result)
            return 0;
        if(mysqli_num_rows($result)>0){
			$valid_user=$c["User_ID"];
			session_register("valid_user");
            return 1;
            }else
            return 0;
        }        
		




function getDateline($date,$cate_id){
		global $conn;
		
       $sql = "SELECT ADDDATE('$date', INTERVAL $cate_id hour)  as hh";
      //echo $sql;
      $rs = mysqli_query($conn,$sql);
      while($c = mysqli_fetch_array($rs)){
           return $c["hh"];
      }      
    } 






function checkJobNo($typer, $id) {
		global $conn;
		
        $str = 0;   
            $where = "";
            if ($typer=="jobno") {
                $where = " job_no = '$id'";
            } else if ($typer=="msr") {
                $where = " bss_msr_no = '$id'";                
            }
            $sql = "Select count(id) as cntid From tbl_log_call_center Where $where";
            $rc = mysqli_query($conn,$sql);                         
            while ($c = mysqli_fetch_array($rc)) {
                if ($c["cntid"] == 0) {
                    $str = 0;
                } else {
                    $str = $c["cntid"];
                }
            }     
        return $str;
    }




      function AutoNumber($table,$col){
		  global $conn;
		  
            $sql="select max($col) as mxCol from $table";            
            $rc=mysqli_query($conn,$sql);
            $c=mysqli_fetch_array($rc);    
            $num=$c["mxCol"]+1;
            return $num;
        }  
       
		function getRowReportType($dte,$call_type,$cat_id,$status_call,$type_service,$status_sla){
			global $conn;
			$row = 0;
			$sql = "SELECT count(tbl_log_call_center.job_no) as cntrow FROM tbl_log_call_center
						Where tbl_log_call_center.open_call_dte like '$dte%'
								And tbl_log_call_center.call_type = '$call_type'
								And tbl_log_call_center.category_type = '$cat_id'";
						if($status_call != ""){
								$sql .= " And tbl_log_call_center.status_call = '$status_call'";
						}
						if($type_service != ""){
								$sql .= " And tbl_log_call_center.type_service = '$type_service'";
						}
						if($status_sla != ""){
								$sql .= " And tbl_log_call_center.status_sla = '$status_sla'";
						}
								$rc = mysqli_query($conn,$sql);
					while($c = mysqli_fetch_array($rc)){
								$row = $c["cntrow"];
					}

      $sql_all = "SELECT count(tbl_log_call_center.job_no) as cntrow FROM tbl_log_call_center
						Where tbl_log_call_center.open_call_dte like '$dte%'
								And tbl_log_call_center.call_type = '$call_type'
								And tbl_log_call_center.category_type = '$cat_id'";
						if($type_service != ""){
								$sql_all .= " And tbl_log_call_center.type_service = '$type_service'";
						}
	  $rc_all = mysqli_query($conn,$sql_all);
	  $c_all = mysqli_fetch_array($rc_all);

		$total = $c_all["cntrow"];

     if($row != 0){
		    $tot =  ($row * 100) / $total;
		   } else {
			$tot = $row;
		   }
			return $row . " </td><td  style=\"padding:0px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-color:#003366;\" align=\"center\"> ". round($tot,2) ."%";
		}


function getRowReportType2($dte,$call_type,$cat_id,$status_call,$type_service,$status_sla){
	global $conn;
$row = 0;
$sql = "SELECT count(tbl_log_call_center.job_no) as cntrow FROM tbl_log_call_center
Where tbl_log_call_center.open_call_dte like '$dte%'
And tbl_log_call_center.call_type = '$call_type'
And tbl_log_call_center.category_type = '$cat_id'";
if($status_call != ""){
$sql .= " And tbl_log_call_center.status_call = '$status_call'";
}
if($type_service != ""){
$sql .= " And tbl_log_call_center.type_service = '$type_service'";
}
if($status_sla != ""){
$sql .= " And tbl_log_call_center.status_sla = '$status_sla'";
}
$rc = mysqli_query($conn,$sql);
while($c = mysqli_fetch_array($rc)){
$row = $c["cntrow"];
}
      $sql_all = "SELECT count(tbl_log_call_center.job_no) as cntrow FROM tbl_log_call_center
Where tbl_log_call_center.open_call_dte like '$dte%'
And tbl_log_call_center.call_type = '$call_type'
And tbl_log_call_center.category_type = '$cat_id'";
if($type_service != ""){
$sql_all .= " And tbl_log_call_center.type_service = '$type_service'";
}
 $rc_all = mysqli_query($conn,$sql_all);
 $c_all = mysqli_fetch_array($rc_all);
$total = $c_all["cntrow"];
     if($row != 0){
   $tot =  ($row * 100) / $total;
  } else {
$tot = $row;
  }
return $row . " ". round($tot,2) ."%";
}



	function formatNum($num,$amnt){
		 for($i=1;$i<=$amnt;$i++){
				$str .= "0";
		 }
		 return $str.$num;
	}

	  function getSiteNumber($site){
		$st = 4-strlen($site);
        for($i=1;$i<=$st;$i++){
				$str .= "0";
		 }
		 return "  ".$str.$site;
	  }
	  
	  
	  function getMail($typemail){
		  global $conn;
			$mail_list = "";
		if($typemail=="BSS"){
			$sql = "select email from tbl_user where at = 'BSS' and status_user = 'y'";
			$rs = mysqli_query($conn,$sql);
			while($c=mysqli_fetch_array($rs)){
					$mail_list .= $c["email"].",";
				}		
		} else if($typemail=="SDC"){	
			//$sql = "select email from tbl_user where at = 'BSS' and status_user = 'y' and group_email = 'c'";
			//$rs = mysql_query($sql);
			//while($c=mysql_fetch_array($rs)){
			//		$mail_list .= $c["email"].",";
			//	}
			//$mail_list .= "Cesdc@systems.co.th,Chitikarn@systems.co.th,Kongkiat@systems.co.th,Niphon@systems.co.th,
			//nirut@systems.co.th,Paiboon@systems.co.th,pradit@systems.co.th,Ratana@systems.co.th,Suriya@systems.co.th,
			//narabhattaraj@bizservsolution.com,narabhattara.jankeaw@htomail.com";
		}	
		return $mail_list;
	  }

	  function getSiteNameAddress($site){
		  global $conn;
	          $sql = "SELECT
	                      tbl_3g_responsibility.site_id,
	                      tbl_3g_responsibility.site_type
	                    FROM
	                      tbl_3g_responsibility
	                    Where tbl_3g_responsibility.site_id = '$site'";
	             $rc = mysqli_query($conn,$sql);
	             $c = mysqli_fetch_array($rc);                           
	             
	             $type = $c["site_type"];  
	             
	  	if($type == "2"){   
	  			 $col = "concat(address ,'  ',site_khat,'  ',site_province) as address";
	  			 $table = "tbl_station_ngv";
	  			 $where = " site_id = '$site'";
				   $sqlx = "Select $col from $table where $where";
				   	             $rcx = mysqli_query($conn,$sqlx);
				   	             $cx= mysqli_fetch_array($rcx);
				   	  		   return $cx["address"];
	  	} else if($type == "3"){   
	              $col = "address"; 
	              $table = " tbl_station_oil"; 
	              $where = " station_id = '$site'";
		      $sqlx = "Select $col from $table where $where";
		      	             $rcx = mysqli_query($conn,$sqlx);
		      	             $cx= mysqli_fetch_array($rcx);
		      	  		   return $cx["address"];
	        } else if($type == "4"){
	  			$col = " site_address as address"; 
	              $table = " tbl_station_amazon"; 
	              $where = " site_id = '$site'";
		      $sqlx = "Select $col from $table where $where";
		      	             $rcx = mysqli_query($sqlx);
		      	             $cx= mysqli_fetch_array($rcx);
		      	  		   return $cx["address"];
	  	}   
	             //$type.$sql;
	  		   // return $sqlx;
	             
	             
	       }

function txtBahtThai($number){
  $txtnum1 = array('ศูนย์','หนึ่ง','สอง','สาม','สี่','ห้า','ห�?','เจ็ด','�?ปด','เ�?้า','สิบ');
  $txtnum2 = array('','สิบ','ร้อย','พัน','หมื่น','�?สน','ล้าน');
  $number = str_replace(",","",$number);
  $number = str_replace(" ","",$number);
  $number = str_replace("บาท","",$number);
  $number = explode(".",$number);
  if(sizeof($number)>2){
    return 'ทศนิยมหลายตัวนะจ๊ะ';
    exit;
  }
  $strlen = strlen($number[0]);
  $convert = '';
  for($i=0;$i<$strlen;$i++){
    $n = substr($number[0], $i,1);
    if($n!=0){
      if($i==($strlen-1) AND $n==1){ $convert .= 'เอ็ด'; }
      elseif($i==($strlen-2) AND $n==2){ $convert .= 'ยี่'; }
      elseif($i==($strlen-2) AND $n==1){ $convert .= ''; }
      else{ $convert .= $txtnum1[$n]; }
      $convert .= $txtnum2[$strlen-$i-1];
    }
  }
  $convert .= 'บาท';
  if($number[1]=='0' OR $number[1]=='00' OR $number[1]==''){
    $convert .= 'ถ้วน';
  }else{
    $strlen = strlen($number[1]);
    for($i=0;$i<$strlen;$i++){
      $n = substr($number[1], $i,1);
      if($n!=0){
        if($i==($strlen-1) AND $n==1){$convert .= 'เอ็ด';}
        elseif($i==($strlen-2) AND $n==2){$convert .= 'ยี่';}
        elseif($i==($strlen-2) AND $n==1){$convert .= '';}
        else{ $convert .= $txtnum1[$n];}
        $convert .= $txtnum2[$strlen-$i-1];
      }
    }
    $convert .= 'สตางค์';
  }
  return $convert;
}

        
  /*       
        
       body onload="reloadwin('invoice.form.php');" 
       <script>    
            function reloadwin(page) {
            var newpage = eval("'"+page+"'");
            window.opener.location = newpage;
                }
    </script> 
        
       
        
 $date1 = "2008-11-01 22:45:00"; 

$date2 = "2009-12-04 13:44:01"; 

$diff = abs(strtotime($date2) - strtotime($date1)); 

$years   = floor($diff / (365*60*60*24)); 
$months  = floor(($diff - $years * 365*60*60*24) / (30*60*60*24)); 
$days    = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));

$hours   = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24 - $days*60*60*24)/ (60*60)); 

$minuts  = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24 - $days*60*60*24 - $hours*60*60)/ 60); 

$seconds = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24 - $days*60*60*24 - $hours*60*60 - $minuts*60)); 

printf("%d years, %d months, %d days, %d hours, %d minuts\n, %d seconds\n", $years, $months, $days, $hours, $minuts, $seconds);        
        
        


		header("Content-type: image/png");
$img = imagecreatetruecolor(500,500);

$ink = imagecolorallocate($img,255,255,255);

for($i=0;$i<500;$i++) {
  for($j=0;$j<500;$j++) {
  imagesetpixel($img, rand(1,500), rand(1,500), $ink1);
  }
}

imagepng($img);
imagedestroy($img);
        
 */       
        
        
        
        
        
		
		 function Personal($Mode,$tablename,$id_staff,$name_surname,$phone,$email){
			 global $conn;
		 if($Mode=="addPersonal"){
				$sql="insert into $tablename (id_staff,name_surname,phone,email,status)
          		 values ('$id_staff','$name_surname','$phone','$email','2')";
		  }else if($Mode=="editPersonal"){
		  		$sql="update $tablename set name_surname='$name_surname',phone='$phone',email='$email'
          		  where id_staff='$id_staff'";
		   }else if($Mode=="delPersonal"){
		   		$sql="delete from $tablename where id_staff= '$id_staff'";				
		   }
			$result = mysqli_query($conn,$sql);
			if(!$result)
					 return true;
				else 
					return false;
		}
		 //  company_id  company_name  company_phone  company_email
		function Company($Mode,$tablename,$company_id,$company_name,$company_phone,$company_email){
			global $conn;
		 if($Mode=="addCompany"){
				$sql="insert into $tablename (company_id,company_name,company_phone,company_email)
          		 values ('$company_id','$company_name','$company_phone','$company_email')";
		  }else if($Mode=="editCompany"){
		  		$sql="update $tablename set company_name='$company_name',company_phone='$company_phone',company_email='$company_email'
          		  where company_id='$company_id'";
		   }else if($Mode=="delCompany"){
		   		$sql="delete from $tablename where company_id= '$company_id'";
		   }
			$result = mysqli_query($conn,$sql);
			if(!$result)
					 return true;
				else 
					return false;
		}
		
		function Euipment($Mode,$tablename,$code_equipment,$id_equipment_type,$id_company,$item,$no_equipment,$serial_no,$uint,$detail,$brand,$model,$status,$remark){
		 global $conn;
		 if($Mode=="addEquipment"){
				$sql="insert into $tablename (code_equipment,id_equipment_type,id_company,item,no_equipment,serial_no,uint,detail,brand,model,status,remark)
          		 values ('$code_equipment','$id_equipment_type','$id_company','$item','$no_equipment','$serial_no','$uint','$detail','$brand','$model','$status','$remark')";
		  }else if($Mode=="editEquipment"){
		  		$sql="update $tablename set id_equipment_type='$id_equipment_type',id_company='$id_company',item='$item',no_equipment='$no_equipment',
						serial_no='$serial_no',uint='$uint',detail='$detail',brand='$brand',brand='$brand',status='$status',remark='$remark'
          		  		where code_equipment='$code_equipment'";
		   }else if($Mode=="delEquipment"){
		   		$sql="delete from $tablename where code_equipment= '$code_equipment'";
		   }
			$result = mysqli_query($conn,$sql);
			if(!$result)
					 return true;
				else 
					return false;
		}   	

//echo "exitadsfas";
?>
