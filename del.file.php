<?
session_start();              
require_once("function.php");          
  
 if(!checkUser()){    echo Message(35,"red",$titel1,$msg1,"<a href='index.php?link=del.file'> $login </a>");
  exit;
  }                                                                                                      

include("header.php");  
$folder_name = $_REQUEST["folder_name"]; // echo "asdfas". $folder_name;//exit;
//if ($handle = opendir("data/$folder_name")) {
//    while (false !== ($entry = readdir($handle))) {
//        if ($entry != "." && $entry != "..") {
//            echo "<a href='del.file.php?folder_name=$entry'>$entry</a>&nbsp;&nbsp;";
//			if($folder_name != "") {
//				echo "<a href=' function.execute.php?mode=del.files.upload&folder_name=$folder_name&file_name=$entry'>ź</a><br>";
//			}else{ echo "<br>"; }
//        }
//    }  //8,000 
//    closedir($handle);
//} 
 if($_SESSION["Username"]=="hrung"  ||  $_SESSION["Username"]=="santi") { 

				$dir = "data/$folder_name";//  echo $dir;
				$contents = scandir($dir);
				$folders = $files = array();
				foreach ($contents as $file) {
					if (($file != '.') && ($file != '..')) {
						if (is_dir($dir.'/'.$file)) {
							$folders[] = $file;
						} else {
							$files[] = $file;
						}
					}
				}
				
				foreach ($folders as $folder) {
					echo "<a href='del.file.php?folder_name=$folder'>$folder</a>&nbsp;&nbsp;";
							if($folder_name != "") {
								echo "<a href=' function.execute.php?mode=del.files.upload&folder_name=$folder&file_name=$folder'>ź</a><br>";
							}  else{ 
								echo "<br>"; 
							}      
				}
				foreach ($files as $file) {
					echo "<li class='file'>$file&nbsp;&nbsp;<a href='function.execute.php?mode=del.files.upload&folder_name=$folder_name&file_name=$file'>ź</a></li><br>'";
				}
}
?>
