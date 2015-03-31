<?php
include ("common_includes.php");
include ("../include/adminsession.php.inc");
include ("../class/class.item.inc");
include ("../class/class.user.inc");
include ("../class/class.shipping.inc");
include ('../include/country_state_cat.php');





$objItem = new Class_Item();

$objUser = new Class_User();

if(isset($_POST['submit']))
{
	extract($_POST);

	$_SESSION['giftcardrecivername']      = $name;
	$_SESSION['giftcardreciveremail']     = $email;
	$_SESSION['giftcardreciveramount']    = $amount;
	$_SESSION['giftcardrecivercity']      = $city;
	$_SESSION['giftcardreciverstate']     = $state;
	$_SESSION['giftcardrecivercountry']   = $country_value;
	
	//success_msg("Your feedback for item has been successfull posted..");
	header("Location:giftcardpayment.php");
	
	
}
$smarty->assign('CURRENCY',CURRENCY);
$smarty->assign('site_page_title',SITE_HOME);
$smarty->assign('site_title',$site_title);

$smarty->display('add_giftcard.tpl');	
?>