<?
session_start();              
require_once("function.php");          
  
 if(!checkUser()){    echo Message(35,"red",$titel1,$msg1,"<a href='index.php?link=list.folder.data'> $login </a>");
  exit;
  }                                                                                                      

include("header.php");  
$folder_name = $_REQUEST["folder_name"];
//if($_SESSION["Username"]=="hrung"  ||  $_SESSION["Username"]=="santi") { 

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
					echo "<a href='list.folder.data.php?folder_name=$folder'>$folder</a>&nbsp;&nbsp;";							
								echo "<br>";   
				}
				foreach ($files as $file) {
					echo "<li class='file'><a href='data/$folder_name/' target='_blank'>$file</a></li><br>'";
				}
//}
?>
