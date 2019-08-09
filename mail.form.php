<?
require_once("connection.php");
$sql = "select name,sname from tbl_user where user_id = 1";
$rs = mysqli_query($conn,$sql);
$c = mysqli_fetch_array($rs);
?>
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=tis-620">
<form action="testmail.php" method="pos">
name:<input class="form-control"  type="text" name="fname" id="fname" value="<?=$c["name"]?>"><br>
sname:<input class="form-control"  type="text" name="sname" id="sname" value="<?=$c["sname"]?>">
<input class="form-control"  type="submit" name="submit" id="submit">
</form>

