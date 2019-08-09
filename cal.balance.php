<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>Calulate Balance before to trade</title>
</head>
<form method="post" action="cal.balance.php" name="frmCal">
<table>
 	<tr>
		<td>Test Point : </td>
		<td><select name="textpoint" id="textpoint">
				<option  value="2000" <? if($_REQUEST["textpoint"]=="2000") echo "selected";?>>2000 Points</option>
				<option value="3000" <? if($_REQUEST["textpoint"]=="3000") echo "selected";?>>3000 Points</option>
				<option value="4000" <? if($_REQUEST["textpoint"]=="4000") echo "selected";?>>4000 Points</option>
				<option value="5000" <? if($_REQUEST["textpoint"]=="5000") echo "selected";?>>5000 Points</option></select></td>
	</tr>
	<tr>
		<td>Symbo : </td>
		<td><select name="symbo" id="symbo">
				<option  value="1" <? if($_REQUEST["symbo"]=="1") echo "selected";?>>USD&JPY</option>
				<option value="2" <? if($_REQUEST["symbo"]=="2") echo "selected";?>>USD&JPY  /   EUR&USD </option>
				<option value="3" <? if($_REQUEST["symbo"]=="3") echo "selected";?>>USD&JPY  /  EUR&USD  /  GBP&USD </option></select></td>
	</tr>
	<tr>
	<td>Risk Balance : </td>
	<td><select name="risk" id="risk" > 
				<option value="0" <? if($_REQUEST["risk"]=="0") echo "selected";?>>0</option>
				<option value="100" <? if($_REQUEST["risk"]=="100") echo "selected";?>>100</option>
				<option value="200" <? if($_REQUEST["risk"]=="200") echo "selected";?>>200</option>
				<option value="300" <? if($_REQUEST["risk"]=="300") echo "selected";?>>300</option>
				<option value="400" <? if($_REQUEST["risk"]=="400") echo "selected";?>>400</option>
				<option value="500" <? if($_REQUEST["risk"]=="500") echo "selected";?>>500</option></select></td>
	</tr>
	<tr>
		<td>Balance : </td>
		<td><input type="text" name="moneybalance" id="moneybalance" onblur="return checkvalue()"  value="<?= $_REQUEST["moneybalance"]?>" />$$$
		<input type="submit" name="subCal" value="Calculate"  /></td>
	</tr>
</table>
</form>
<body>
</body>
</html>
<?
$form_submit = $_REQUEST["subCal"];
if($form_submit=="Calculate"){
$moneybalance = $_REQUEST["moneybalance"];
$risk = $_REQUEST["risk"];
$symbo = $_REQUEST["symbo"];
$textpoints = $_REQUEST["textpoint"];


					
    echo getVal($moneybalance,$risk ,$symbo,$textpoints);			
							
							 		
}


								
function getVal($moneybalance,$risk, $money_value,$textpoints){
if($money_value=="1"){	$header = "USD&JPY";
}else if($money_value=="2") { $header = "USD&JPY  /  EUR&USD";
}else if($money_value=="3"){ $header = "USD&JPY  /  EUR&USD  /  GBP&USD"; }
	

$lot4trade = Array("0"=>"0.01","1"=>"0.01","2"=>"0.01","3"=>"0.01","4"=>"0.02","5"=>"0.02","6"=>"0.02","7"=>"0.03","8"=>"0.04","9"=>"0.04","10"=>"0.05",
								"11"=> "0.06","12"=>"0.07","13"=>"0.09","14"=>"0.11","15"=>"0.13","16"=>"0.15","17"=>"0.18","18"=>"0.22","19"=>"0.27","20"=>"0.32","21"=>"0.38");
echo "<table border=2><tr><th colspan=3>$header</th></tr><tr>
					<th>Order No.</th>
					<th>Lot</th>
					<th>Usage balance</th></tr>";			
						   $moneybalance -= $risk;	
							$lot = 21;		
							$usemoney_total_all = 0;
							$moneybalanceDiv2 = $moneybalance / $money_value; 
							echo "<tr>";
							for($i=0 ; $i<=$lot ; $i++){
								 $lottrade =  $lot4trade[$i];
								 $usemoney  =  $lottrade * $textpoints; 		
								 $usemoney_total += $usemoney;
									if($usemoney_total <= $moneybalanceDiv2){	
										  echo "<td align=center > $i </td><td align=center> $lottrade</td>
										  			<td align=center >$usemoney</td>";
										  $usemoney_total_all += $usemoney ;	
									}	else {
										  echo "</tr><tr><td align=center colspan=3>Usage Balance  : ". $usemoney_total_all . "usd</td></tr><tr>";
										  echo "</tr><tr><td align=center colspan=3>Usage Balance All  : ". $usemoney_total_all  *   $money_value. "usd</td></tr><tr>";
										  $total = ($moneybalance+ $risk) - ($usemoney_total_all  *  $money_value);
										  echo "<td  align=center  colspan=3>Balance :  ". $total."USD</td>";
										  exit;
									}
								echo "</tr>";
							}  
							echo "</td></tr></table>";
}

?>
<script language="JavaScript">
function check_number(ch){
var len, digit;
if(ch == " "){ 
return false;
len=0;
}else{
len = ch.length;
}
for(var i=0 ; i<len ; i++){
digit = ch.charAt(i)
if(digit >="0" && digit <="9"){
; 
}else{
return false; 
} 
} 
return true;
}


function checkvalue(){
		if(!check_number(document.frmCal.moneybalance.value) || document.frmCal.moneybalance.value == "0" ){
			alert('กราบหละ ใส่ตัวเลข');document.frmCal.moneybalance.value = "0";
			document.frmCal.moneybalance.focus();  
			return false;
		} else { return true;}
}
</script>

















