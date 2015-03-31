<?php
include ('include/common.inc');
include ("include/authentiateUserLogin.php");
include ('class/class.user.inc');
include ('class/class.item.inc');
include ('include/country_state_cat.php');

$sellersid_for_giftcard         = $_SESSION['giftcard_seller_id'];
$objUser	 	         	    = new Class_User();
$objUser->id	         		= $sellersid_for_giftcard;
$result_user_sel	     		= $objUser->selectUser();
$num_user_sel       			= mysql_num_rows($result_user_sel);
if($num_user_sel)
{
	$arr_user_values_sel 		= mysql_fetch_assoc($result_user_sel);
    $API_USERNAME	     		= $arr_user_values_sel['API_USERNAME'];
	$API_PASSWORD	     		= $arr_user_values_sel['API_PASSWORD'];
	$API_SIGNATURE	     		= $arr_user_values_sel['API_SIGNATURE'];
	$payment_type	     		= $arr_user_values_sel['payment_type'];
	$paypal_merchant_id    		= $arr_user_values_sel['paypal_merchant_id'];
	
	$_SESSION['payment_type']   = $payment_type;
	$_SESSION['API_USERNAME']   = $API_USERNAME;
	$_SESSION['API_PASSWORD']   = $API_PASSWORD;
	$_SESSION['API_SIGNATURE']  = $API_SIGNATURE;
	$_SESSION['Merchant_Id']    = $Merchant_Id;
	$_SESSION['paypal_merchant_id']  = $paypal_merchant_id;
}

//if(($payment_type==0 && ($API_USERNAME=='' && $API_PASSWORD=='' && $API_SIGNATURE=='' &&$paypal_merchant_id!='')) ||($payment_type==1 && $Merchant_Id==''))
//if(($API_USERNAME=='' || $API_PASSWORD=='' || $API_SIGNATURE=='' ) ||($payment_type==1 && $Merchant_Id==''))
//{
//	failure_msg("Service unavailable payment details are incomplete please try on other stores ");
  // redirect("featured_store_information.php?id=".$sellersid_for_giftcard);
//	}
/*
if($_SESSION['session_user_type']!="4")
{
	failure_msg("Please login as buyer for send giftcard ...! ");
	header("Location:my_account.php");
}*/
$objItem = new Class_Item();


if(isset($_POST['submit']))
{
	extract($_POST);
    //$_SESSION['giftcard_seller_id'] 
	$_SESSION['giftcardrecivername']      = $name;
	$_SESSION['giftcardreciveremail']     = $email;
	$_SESSION['giftcardreciveramount']    = $amount;
	$_SESSION['giftcardrecivercity']      = $city;
	$_SESSION['giftcardreciverstate']     = $state;
	$_SESSION['giftcardrecivercountry']   = $country_value;
	
	
	//failure_msg("");
	//success_msg("Your feedback for item has been successfull posted..");
	header("Location:giftcardpayment.php");
	
	
}

$smarty->assign('paypal_merchant_id',$paypal_merchant_id);
$smarty->assign('sellersid_for_giftcard',$sellersid_for_giftcard);
$smarty->assign('CURRENCY',CURRENCY);
$smarty->assign('site_page_title',SITE_HOME);
$smarty->assign('site_title',$site_title);
$smarty->display('giftcard.tpl');
?>