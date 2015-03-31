<?php
/************* Exchange Rate Calculator *******************/
/*
Released by AwesomePHP.com, under the GPL License, a
copy of it should be attached to the zip file, or
you can view it on http://AwesomePHP.com/gpl.txt
*/
/************* Exchange Rate Calculator *******************/	

// Include Class
include_once('currency_class.php');

// Get list of currencies
$c = new JOJO_Currency_yahoo();
$list = $c->getCurrencies();

$amount = "";
$total = "";
// Check any submitions
if(isset($_GET['N']) && $_GET['N'] != NULL)
{
	// Amount to convert
	$amount = (int)$_GET['N'];
	
	// From
    $from = '';
	$from_text = '';
	if(isset($_GET['F']))
	{
		$from = $_GET['F'];
		$from_text = $list[$from];
	}
	else
	{
		$from = "USD";
		$from_text = $list[$from];
	}
	
	// To
	$to = '';
	$to_text = '';
	if(isset($_GET['T']))
	{
		$to = $_GET['T'];
		$to_text = $list[$to];
	}
	else
	{
		$to = "EUR";
		$to_text = $list[$to];
	}
	
	// Get rate
	$rate = $c->getRate($from,$to, true);
	
	// Total price (to 2 decemial points)
	$total = number_format(($rate*$amount),2);
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Nethaat</title>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Exchange Rate Calculator</title>
<style>
.Buton_color{font-size:12px;color:white;font-weight:300px;font-family:arial;background-color:#990000;border:1px solid #990000;}
</style>
</head>
<body>
<form name="convert" id="convert" method="get" action="currency_converter.php" style="display:inline;">
 <table width="100%" border="0" style='border:1px solid red;' align="center" cellpadding="5" cellspacing="0" class="contactBox">
    <?php if($total != NULL){?>
    <tr>
      <td colspan="2"><div align="center"><strong><font color="#0000FF" size="4" face="Georgia, Times New Roman, Times, serif">Exchange Rate </font></strong></div></td>
    </tr>
    <tr>
      <td colspan="2"><div align="center"><strong>Exchange Rate is</strong> <font color="#FF0000"><?=$rate;?></font><br /><font color="#FF0000"><?=$amount;?></font> <strong><?=$from_text;?> = </strong> <font color="#FF0000"><?=$total;?></font> <strong><?=$to_text;?></strong>. </div></td>
    </tr>
    <?php } ?>
	<tr>
      <td colspan="2">&nbsp;</td>
    </tr>
	<tr>
      <td colspan="2"><div align="center"><strong><font color="#990000" size="4" face="Georgia, Times New Roman, Times, serif">Exchange Rate Calculator </font></strong></div></td>
    </tr>
    <tr>
      <td width="50%"><strong><font color="#0000FF" size="2" face="Verdana, Arial, Helvetica, sans-serif">Convert:</font></strong></td>
      <td width="50%"><input name="N" type="text" id="N" style="width:200px;" value="<?=$amount;?>" class="adselbigselinputbox"></td>
    </tr>
    <tr>
      <td width="50%"><strong><font color="#0000FF" size="2" face="Verdana, Arial, Helvetica, sans-serif">From:</font></strong></td>
      <td width="50%">
	  <select name="F" id="F"  style="width:205px;" class="adselbigselinputbox">
	  <?php
	  if($from == NULL){$from = 'USD';}
	  foreach($list as $code => $name){
	  	if($from == $code){$sel=' selected';}else{$sel=NULL;}
		echo '<option value="'.$code.'"'.$sel.'>'.$name.'</option>';
	  }
	  ?>
      </select></td>
    </tr>
    <tr>
      <td width="50%"><strong><font color="#0000FF" size="2" face="Verdana, Arial, Helvetica, sans-serif">To:</font></strong></td>
      <td width="50%"><select name="T" id="T"  style="width:205px;" class="adselbigselinputbox">
	  <?php
	  if($to == NULL){$to = 'EUR';}
	  foreach($list as $code => $name){
	  	if($to == $code){$sel=' selected';}else{$sel=NULL;}
		echo '<option value="'.$code.'"'.$sel.'>'.$name.'</option>';
	  }
	  ?>
            </select></td>
    </tr>
    <tr>
      <td colspan="2"><div align="center">
        <input class='Buton_color' type="submit" name="Submit" value="Convert" class="reg_button">
      </div></td>
    </tr>
  </table>
</form>
</body>
</html>