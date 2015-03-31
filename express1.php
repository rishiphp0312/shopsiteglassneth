<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
</head>
API_username
<body>
<?
$API_username=
$API_password=
$API_signature=
//https://www.sandbox.paypal.com/cgi-bin/webscr?cmd=_express-checkout&token=EC-1NK66318YB717835M
?>
<table>
<tr><td>
<form method=post action=https://api-3t.sandbox.paypal.com/nvp>
<input type='hidden' name=USER value='<?=$API_username;?>'>
<input type='hidden' name=PWD value='<?=$API_password;?>'>
<input type='hidden' name=SIGNATURE value='<?=$API_signature;?>'>
<input type='hidden' name=VERSION value=XX.0>
<input type='hidden' name='PAYMENTREQUEST_0_PAYMENTACTION'
value='Authorization'>
<input name='PAYMENTREQUEST_0_AMT' value='19.95'>
<input type='hidden' name='RETURNURL' value='http://www.nethaat.com/my_account.php'>
<input type='hidden' name='CANCELURL' value='http://www.nethaat.com/api_error1.php'>
<input type='submit' name='METHOD' value='SetExpressCheckout'>
</form></td></tr>
</table>
</body>
</html>
