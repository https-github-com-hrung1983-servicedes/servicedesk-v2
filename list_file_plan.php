
<html>
<head>
<title>ThaiCreate.Com PHP & scandir()</title>
</head>
<body>
<?
$objScan = scandir("ExcelFile");
foreach ($objScan as $value) {
    echo "folder : $value<br>";
}
?>
</body>
</html>


