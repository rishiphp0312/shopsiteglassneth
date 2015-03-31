<?php
session_start();
$_SESSION['firstcardcode']='';
$_SESSION['calculategiftcardvalue']='';
$_SESSION['secondcard_code']='';
$_SESSION['secondcalculategiftcardvalue']='';
unset($_SESSION['ship_quantity']);
unset($_SESSION['service_rate']);
unset($_SESSION['d_item_id']);
unset($_SESSION['shipping_address1']);
unset($_SESSION['shipping_address2']);
unset($_SESSION['dest_zip_code']);
unset($_SESSION['city']);
unset($_SESSION['reciveramount_1_card']);
unset($_SESSION['reciveramount_2_card']);
unset($_SESSION['giftcardreciverstate']);
unset($_SESSION['show_d_cost_item']);


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Pay thanks</title>
</head>
<body>
<table>
<tr><td>Payment thanks<?=$_SESSION['msg'];?></td></tr>
</table>
</body>
</html>

