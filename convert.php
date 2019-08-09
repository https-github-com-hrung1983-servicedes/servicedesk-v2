<?
require("function.php");
$sql = "SELECT xxxxx.`x1`,xxxxx.`x2`,tbl_province.id FROM  xxxxx
Inner Join tbl_province ON xxxxx.`x2` = tbl_province.province_name
ORDER BY  xxxxx.`x2` ASC";
$rc = mysqli_query($conn,$sql);
while($c = mysqli_fetch_array($rc)){
	echo $c["x1"]."-".$c["id"]."<br>";
	mysqli_query($conn,"update tbl_site set province_name = '$c[id]'  where site_id = '$c[x1]'");
}

?>
