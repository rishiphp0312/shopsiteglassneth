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




session_start();

        $API_USERNAME	     		= "testin_1288709251_biz_api1.yahoo.com";
	$API_PASSWORD	     		= "1288709261";
	$API_SIGNATURE	     		= "Ax8RPYzWhRS2bwcrFevHginx4knLAVCYB8koyKluTgXccJeScjZzTPT8";
	$payment_type	     		= "Sale";
	$paypal_merchant_id   		= "testin_1288709251_biz_api1.yahoo.com";
	
	$_SESSION['payment_type']   = $payment_type;
	$_SESSION['API_USERNAME']   = $API_USERNAME;
	$_SESSION['API_PASSWORD']   = $API_PASSWORD;
	$_SESSION['API_SIGNATURE']  = $API_SIGNATURE;
	$_SESSION['Merchant_Id']    = $paypal_merchant_id;
	$_SESSION['paypal_merchant_id']    = $paypal_merchant_id;

      require_once 'CallerService.php';


/**
 * Get required parameters from the web form for the request
 */
if(isset($_POST['submit']))
{
	
	//$paymentType =urlencode( $_POST['paymentType']);
	$paymentType ="SALE";
	//$firstName =urlencode( $_POST['fname']);
	$firstName="testing";
	$lastName="testingl";
	$creditCardType="Visa";
	$creditCardNumber ="4714822851005724";
	//$lastName =urlencode( $_POST['lname']);
	//$creditCardType =urlencode( $_POST['creditCardType']);
	//$creditCardNumber = urlencode($_POST['creditCardNumber']);
	//$expDateMonth =urlencode( $_POST['expDateMonth']);

	// Month must be padded with leading zero
//	$padDateMonth = str_pad($expDateMonth, 2, '0', STR_PAD_LEFT);
$padDateMonth = '11';
	
	$expDateYear ='2015';

//	$expDateYear =urlencode( $_POST['expDateYear']);
$cvv2Number='962';
	//$cvv2Number = urlencode($_POST['cvv2Number']);
	//$address1 = urlencode($_POST['address']);
	
	//$city = urlencode($_POST['city']);
	//$state =urlencode($_POST['state']);
	//$country =urlencode($_POST['country']);
	//$zip = urlencode($_POST['zcode']);
	//$amount = urlencode($_POST['amount']);
	//$currencyCode=urlencode($_POST['currency']);
	$currencyCode="USD";
	//$paymentType=urlencode($_POST['paymentType']);
	$paymentMode='creditcard';
    

	/* Construct the request string that will be sent to PayPal.
	   The variable $nvpstr contains all the variables and is a
	   name value pair string with & as a delimiter */
	//$nvpstr="&PAYMENTACTION=$paymentType&AMT=10&CREDITCARDTYPE=Visa&ACCT=$creditCardNumber&EXPDATE=".$padDateMonth.$expDateYear."&CVV2=$cvv2Number&FIRSTNAME=$firstName&LASTNAME=$lastName&STREET=$address1&CITY=$city&STATE=ID"."&ZIP=$zip&COUNTRYCODE=US&CURRENCYCODE=$currencyCode";

	$nvpstr="&PAYMENTACTION=$paymentType&AMT=10&CREDITCARDTYPE=Visa&ACCT=$creditCardNumber&EXPDATE=".$padDateMonth.$expDateYear."&CVV2=$cvv2Number&FIRSTNAME=$firstName&LASTNAME=$lastName&STREET=address1&CITY=city&STATE=ID"."&ZIP=zip&COUNTRYCODE=US&CURRENCYCODE=$currencyCode";
//echo $nvpstr;
	/* Make the API call to PayPal, using API signature.
	   The API response is stored in an associative array called $resArray */
	$resArray=hash_call("doDirectPayment",$nvpstr);

	/* Display the API response back to the browser.
	   If the response from PayPal was a success, display the response parameters'
	   If the response was an error, display the errors received using APIError.php.
	   */
	$ack = strtoupper($resArray["ACK"]);
echo 'acknow-'.$ack;
echo '<pre>';
print_r($resArray);
echo '</pre>';

exit;
if($ack!="SUCCESS")  
	{echo '<pre>';
print_r($resArray);
echo '</pre>';
exit;
	
		$_SESSION['reshash']=$resArray;
		//$location = "APIError.php";
		//header("Location: $location");
	}
	else
	{
		
		
		//*********************************** Assigning transaction details *******
		
		$smarty->assign("TRANSACTIONID",$resArray['TRANSACTIONID']);
		$smarty->assign("AMT",$resArray['AMT']);
		$smarty->assign("AVSCODE",$resArray['AVSCODE']);
		$smarty->assign("CVV2MATCH",$resArray['CVV2MATCH']);
		$smarty->assign('CURRENCY',CURRENCY);

		
		
        	}
}
//session_unset();               
//$smarty->assign('CURRENCY',CURRENCY);
//$smarty->assign('site_page_title',SITE_HOME);
//$smarty->assign('site_title',$site_title);
//$smarty->display('pay-item-cost.tpl');
?>