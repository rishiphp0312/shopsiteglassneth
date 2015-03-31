<?php
/***********************************************************
DoDirectPaymentReceipt.php

Submits a credit card transaction to PayPal using a
DoDirectPayment request.

The code collects transaction parameters from the form
displayed by DoDirectPayment.php then constructs and sends
the DoDirectPayment request string to the PayPal server.
The paymentType variable becomes the PAYMENTACTION parameter
of the request string.

After the PayPal server returns the response, the code
displays the API request and response in the browser.
If the response from PayPal was a success, it displays the
response parameters. If the response was an error, it
displays the errors.

Called by DoDirectPayment.php.

Calls CallerService.php and APIError.php.

***********************************************************/

include ('include/common.inc');
include ('class/class.user.inc');
require_once 'CallerService.php';
session_start();

/**
 * Get required parameters from the web form for the request
 */
$paymentType =urlencode($_POST['paymentType']);
$firstName =urlencode($_POST['firstName']);
$lastName =urlencode($_POST['lastName']);
$creditCardType =urlencode($_POST['creditCardType']);
$creditCardNumber = urlencode($_POST['creditCardNumber']);
$expDateMonth =urlencode($_POST['expDateMonth']);

// Month must be padded with leading zero
$padDateMonth = str_pad($expDateMonth, 2, '0', STR_PAD_LEFT);

$expDateYear =urlencode($_POST['expDateYear']);
$cvv2Number = urlencode($_POST['cvv2Number']);
$address1 = urlencode($_POST['address1']);
$address2 = urlencode($_POST['address2']);
$city = urlencode($_POST['city']);
$state =urlencode($_POST['state']);
$country =urlencode($_POST['country']);
$zip = urlencode($_POST['zip']);
$amount = urlencode($_POST['amount']);
//$currencyCode=urlencode($_POST['currency']);
$currencyCode="USD";
$paymentType=urlencode($_POST['paymentType']);

$itemid=urlencode($_POST['id']);
$_SESSION['itemid']=$itemid;


/* 
   Construct the request string that will be sent to PayPal.
   The variable $nvpstr contains all the variables and is a
   name value pair string with & as a delimiter 
 */
$nvpstr="&PAYMENTACTION=$paymentType&AMT=$amount&CREDITCARDTYPE=$creditCardType&ACCT=$creditCardNumber&EXPDATE=".         $padDateMonth.$expDateYear."&CVV2=$cvv2Number&FIRSTNAME=$firstName&LASTNAME=$lastName&STREET=$address1&CITY=$city&STATE=ID".
"&ZIP=$zip&COUNTRYCODE=US&CURRENCYCODE=$currencyCode";

/* Make the API call to PayPal, using API signature.
   The API response is stored in an associative array called $resArray */
$resArray=hash_call("doDirectPayment",$nvpstr);

/* Display the API response back to the browser.
   If the response from PayPal was a success, display the response parameters'
   If the response was an error, display the errors received using APIError.php.
   */
$ack = strtoupper($resArray["ACK"]);

if($ack!="SUCCESS")  
	{
		$_SESSION['reshash']=$resArray;
		$location = "APIError.php";
		header("Location: $location");
   }
   else
   {
//header("Location: DoDirectPaymentReceipt.php");	
	//success_msg("Your request for custom item has been successfull");
	//echo '<pre>';print_r($resArray);
	$smarty->assign("TRANSACTIONID",$resArray['TRANSACTIONID']);
	$smarty->assign("AMT",$resArray['AMT']);
	$smarty->assign("AVSCODE",$resArray['AVSCODE']);
	$smarty->assign("CVV2MATCH",$resArray['CVV2MATCH']);
	$smarty->assign('CURRENCY',CURRENCY);

 
	$objUser = new Class_User();
	$objUser->reqid			= rteSafe($_SESSION['itemid']);	
	$objUser->paymentstatus	= 1;
	$objUser->TRANSACTIONID	= rteSafe($resArray['TRANSACTIONID']);
	$objUser->paid_amount	= rteSafe($resArray['AMT']);
	$objUser->avs_code		= rteSafe($resArray['AVSCODE']);
	$objUser->cvv2			= rteSafe($resArray['CVV2MATCH']);	
	//echo $o[]				= rteSafe($resArray);
	//$objUser->text

	
	$objDBReturn = $objUser->insertUpdatecustomrequest();
	
	if($objDBReturn->nIdentity==0 && $objDBReturn->nErrorCode==0)
	{
		success_msg("Your Transaction has been successfull");
		header("Location:buyer_custom_request.php");
	}
	else
	{
		failure_msg("Error occured ...!Please try again");
	}
   
	$smarty->display('DoDirectPaymentReceipt.tpl');
}
//session_unset();               
 ?>
