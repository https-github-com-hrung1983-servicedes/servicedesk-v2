<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=Windows-874">  
    <title>Service Desk Management System</title>
    <link href="image/bss_icon.ico"   rel="shortcut icon" /> 
<script language="javascript" src="script.js"></script>    
<link href="style/stylecss.css" rel="stylesheet" type="text/css">
</head>
<body>
<?php                                    
//header("Content-disposition: attachment");
echo "<a href='./file_upload/Router 3G Amazon.rar'>Amazon</a><br>";
echo "<a href='./file_upload/Router 3G OIL.rar'>OIL</a><br>";
echo "<a href='./file_upload/Router 3G NGV.rar'>NGV</a><br><br>";

//echo "Please wait NGV ......";


exit;
 $basepath = realpath("./file_upload/");  // Root directory
 $path = realpath($basepath.$_GET["path"]);  // Requested  path
$relativepath = "./".substr_replace( $path, "", 0, strlen( $basepath ) );
 if( "/" == substr( $relativepath, -1 )) {  // Remove the trailing slash
  $relativepath = substr( $relativepath, 0, -1 );
 }

$dh = opendir( $path );
  while( false !== ($file = readdir( $dh ))) {
   if("." == $file) {continue;}             
   // converts the filename to utf8
   $file_utf8 = iconv( "iso-8859-1", "utf-8", $file );                               
   // encode the path ('path' part: already utf8; 'filename' part: still iso-8859-1)
   $link = str_replace( "%2F", "/", rawurlencode( "{$relativepath}/" )) . rawurlencode( utf8_decode( "{$file_utf8}" ));
   $xx = $basepath."\\".$file;
   if( is_dir( "{$path}/{$file}" )) {
    echo "<a href='./file_upload/$file_utf8'>{$file_utf8}</a><br/>";
   } else {
    echo "<a href='./file_upload/$file_utf8'>{$file_utf8}</a><br/>";
   }
  }  
 ?>
</body>
</html>