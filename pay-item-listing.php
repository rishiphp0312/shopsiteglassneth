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
include ('class/class.item.inc');
include ('class/class.user.inc');
include ('class/class.shipping.inc');
include ('class/class.mail.inc');
include ('include/country_state_cat.php');
include ('include/sendEmailClass.php');
include ('include/send-sms.php');

require_once 'CallerService.php';
session_start();

$sellers_id      = $_SESSION['det_seller_id'] ;   //seler id
$buyer_id        = $_SESSION['session_user_id'] ; // buyer id
$objUser 	     = new Class_User();

$result_user     = $objUser->selectUser();

$num_user        = mysql_num_rows($result_user);
if($num_user)
$arr_user_values = mysql_fetch_assoc($result_user);
$smarty->assign("user_values",$arr_user_values);
$current_first_date = date('Y');
	 for($i=$current_first_date;$i<=$current_first_date+10;$i++)
	  {
		$date_array[] = $i;
	   }
 //print_r($date_array);
    $smarty->assign("show_exp_year",$date_array);

/**
 * Get required parameters from the web form for the request
 */
 
 
 $custom_item_id =   $_REQUEST['id'];
 
if(isset($_POST['submit']))
{
        $custom_item_id =   $_REQUEST['id'];	
	$paymentType      = urlencode($_POST['paymentType']);
	$firstName        = urlencode($_POST['firstName']);
	$lastName         = urlencode($_POST['lastName']);
	$creditCardType   = urlencode($_POST['creditCardType']);
	$creditCardNumber = urlencode($_POST['creditCardNumber']);
	$expDateMonth     = urlencode( $_POST['expDateMonth']);

	// Month must be padded with leading zero
	$padDateMonth     = str_pad($expDateMonth, 2, '0', STR_PAD_LEFT);

	$expDateYear      = urlencode( $_POST['expDateYear']);
	$cvv2Number       = urlencode($_POST['cvv2Number']);
	$address1	  = urlencode($_POST['address1']);
	$address2         = urlencode($_POST['address2']);
	$city             = urlencode($_POST['city']);
	$state            = urlencode($_POST['state']);
	$country          = urlencode($_POST['country']);
	$zip              = urlencode($_POST['zip']);
	$amount           = urlencode($_POST['amount']);
	//$currencyCode=urlencode($_POST['currency']);
	$currencyCode     = "USD";
	$paymentType      = urlencode($_POST['paymentType']);
	$paymentMode     = 'creditcard';
    

	/* Construct the request string that will be sent to PayPal.
	   The variable $nvpstr contains all the variables and is a
	   name value pair string with & as a delimiter */
	$nvpstr="&PAYMENTACTION=$paymentType&AMT=$amount&CREDITCARDTYPE=$creditCardType&ACCT=$creditCardNumber&EXPDATE=".         $padDateMonth.$expDateYear."&CVV2=$cvv2Number&FIRSTNAME=$firstName&LASTNAME=$lastName&STREET=$address1&CITY=$city&STATE=ID".
	"&ZIP=$zip&COUNTRYCODE=US&CURRENCYCODE=$currencyCode&id=".$_REQUEST['id'];

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
		$objUser          = new Class_User();
		$objUser->id      = $_SESSION['session_user_id'];
                $UserRes          = $objUser->getUserDetails();
		$UserArr          = mysql_fetch_array($UserRes);
		$UserArr['email'];
		$UserArr['username'];
		//*********************************** Assigning transaction details *******
		
		$objItem                     = new Class_Item();
		
		$objItem->seller_id          = $_SESSION['session_user_id'];
		
		$objItem->paymentmode        = 'credit card';
	   	$objItem->trans_id           = $resArray['TRANSACTIONID'];
		$objItem->values_returned    = serialize($resArray);
		        	
		
		$objItem->amount	         = rteSafe($resArray['AMT']);
		$objItem->avs_code               = rteSafe($resArray['AVSCODE']);
		$objItem->cvv2		         = rteSafe($resArray['CVV2MATCH']);
		$objItem->address1	         = rteSafe($_POST['address1']);
		$objItem->address2	         = rteSafe($_POST['address2']);
		$objItem->city		         = rteSafe($_POST['city']);
		$objItem->state		         = rteSafe($_POST['state']);
		$objItem->zip		         = rteSafe($_POST['zip']);
		$objItem->country_id		 = $_POST['country'];
		$objItem->paymentstatus	     = 1;
		
		
		$rstr = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
                $nstr = "";
                 mt_srand ((double) microtime() * 1000000);
                while(strlen($nstr) < 15)
                 {
                 $random = mt_rand(0,(strlen($rstr)-1));
                 $nstr .= $rstr{$random};
        	  }

		 $objItem->cardnumber  = $nstr.'_'.$_SESSION['session_user_id'];
		 $objDBReturn          = $objItem->insert_updatepaidItems_forlisting();
		
		 if($objDBReturn->nErrorCode==0)
		 {
			 $objUser->id     = $_SESSION['session_user_id'];
                         $objUser->value_status=1;
                         $objUser->changepaiditemstatus();
		         $_SESSION['session_paid_item']=1;
			 success_msg("Your payment was successfull !");
	          
			  if($custom_item_id!='')
			  redirect("sell-an-item.php?id=".$custom_item_id);
                          else
			  redirect("sell-an-item.php");
            
	           }
	}
}

$smarty->assign('custom_item_id',$custom_item_id);
//session_unset();               
$smarty->assign('CURRENCY',CURRENCY);
$smarty->assign('site_page_title','Nethaat : Pay Items Listing');
$smarty->assign('site_title',$site_title);
$smarty->display('pay-item-listing.tpl');
?>