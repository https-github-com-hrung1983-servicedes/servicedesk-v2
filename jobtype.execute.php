<?
header("Content-Type: text/html; charset=tis-620");

session_start();
require_once("function.php"); 
if(!checkUser()){    echo Message(35,"red",$titel1,$msg1,"<a href='index.php'> $login </a>");
   exit;
}
                                  
   $category_id = $_REQUEST["category_id"];                                    
   $station_type = $_REQUEST["station_type"];
   $category_type = $_REQUEST["category_type"];
   $fixed_description = $_REQUEST["fixed_description"];
   $commente = $_REQUEST["commente"];   
   $table = "tbl_category_type";     
   if($category_id == ""){                           
      $sql = "Insert into $table (station_type,category_type,fixed_description,commente)
               values ('$station_type','$category_type','$fixed_description','$commente')"; 
   } else {
      $sql = "Update $table set station_type='$station_type',category_type='$category_type',
               fixed_description='$fixed_description',commente='$commente'   
               Where category_id = $category_id"; 
   }  //echo $sql;
    mysql_query($sql);
    header("location:jobtype.index.php");
?>
