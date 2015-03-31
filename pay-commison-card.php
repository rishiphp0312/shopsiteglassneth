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
include ('class/class.category.inc');
include ('class/class.shipping.inc');
include ('class/class.mail.inc');
include ('include/country_state_cat.php');
include ('include/sendEmailClass.php');
include ('include/send-sms.php');



session_start();



  //seler id
$sellers_id        = $_SESSION['session_user_id'] ; //seler id

$objItem         = new Class_Item();

$objUser         = new Class_User();
$objUser->id     = $_SESSION['session_user_id'];
$result_user     = $objUser->selectUser();
$num_user        = mysql_num_rows($result_user);
if($num_user)
$arr_user_values = mysql_fetch_assoc($result_user);
$smarty->assign("user_values",$arr_user_values);
// code to fetch payment details of sellers


$objUser->admin_user_id = 1;
$result_user_sel     = $objUser->getAdminUserLoginDetails();
$num_user_sel        = mysql_num_rows($result_user_sel);
if($num_user_sel)
{
	$arr_user_values_sel    		= mysql_fetch_assoc($result_user_sel);
        $adm_API_USERNAME	     		= $arr_user_values_sel['API_USERNAME'];
	$adm_API_PASSWORD	     		= $arr_user_values_sel['API_PASSWORD'];
	$adm_API_SIGNATURE	     		= $arr_user_values_sel['API_SIGNATURE'];
	$adm_paypal_merchant_id   		= $arr_user_values_sel['paypal_merchant_id'];
        //$adm_payment_type	     		= $arr_user_values_sel['payment_type'];
	//$_SESSION['payment_type']       = $adm_payment_type;

        $_SESSION['API_USERNAME']               = $adm_API_USERNAME;
	$_SESSION['API_PASSWORD']               = $adm_API_PASSWORD;
	$_SESSION['API_SIGNATURE']              = $adm_API_SIGNATURE;
	//$_SESSION['Merchant_Id']              = $adm_Merchant_Id;
	$_SESSION['paypal_merchant_id']         = $adm_paypal_merchant_id;
}

if($adm_API_USERNAME=='' || $adm_API_PASSWORD=='' || $adm_API_SIGNATURE=='')
{
       failure_msg("Error occured ...!Payment details are incomplete try again");
       redirect("commision-items-listing.php");
}
      require_once 'CallerService.php';


    $current_first_date = date('Y');
    for($i=$current_first_date;$i<=$current_first_date+10;$i++)
    {
    $date_array[] = $i;
    }
 //print_r($date_array);
   $smarty->assign("show_exp_year",$date_array);
   $objItem->seller_id            = $_SESSION['session_user_id'];
   $total_item_commision          = $objItem->getTotalCommision_OnSoldItem();
   $num_total_itemcommision       = mysql_num_rows($total_item_commision);
   if($num_total_itemcommision>0)
    {
      $arr_tot_comm       =   mysql_fetch_array($total_item_commision);
      $comma_trans_ids    =   $arr_tot_comm['all_trans_ids'];
      $total_amt_commison =   $arr_tot_comm['total_amt_commison'];

    }
       $smarty->assign("total_amt_commison",$total_amt_commison);
       $smarty->assign("comma_trans_ids",$comma_trans_ids);

/**
 * Get required parameters from the web form for the request
 */
if(isset($_POST['submit']))
{
	$paymentType =urlencode( $_POST['paymentType']);
	$firstName =urlencode( $_POST['firstName']);
	$lastName =urlencode( $_POST['lastName']);
	$creditCardType =urlencode( $_POST['creditCardType']);
	$creditCardNumber = urlencode($_POST['creditCardNumber']);
	$expDateMonth =urlencode( $_POST['expDateMonth']);

	// Month must be padded with leading zero
	$padDateMonth = str_pad($expDateMonth, 2, '0', STR_PAD_LEFT);

	$expDateYear =urlencode( $_POST['expDateYear']);
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
	$paymentMode='creditcard';


	/* Construct the request string that will be sent to PayPal.
	   The variable $nvpstr contains all the variables and is a
	   name value pair string with & as a delimiter */
	$nvpstr="&PAYMENTACTION=$paymentType&AMT=$amount&CREDITCARDTYPE=$creditCardType&ACCT=$creditCardNumber&EXPDATE=".$padDateMonth.$expDateYear."&CVV2=$cvv2Number&FIRSTNAME=$firstName&LASTNAME=$lastName&STREET=$address1&CITY=$city&STATE=ID"."&ZIP=$zip&COUNTRYCODE=US&CURRENCYCODE=$currencyCode";

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

		$objUser 	= new Class_User();
		$objMail 	= new Class_Mail();
		$emailObj 	= new SendEmailClass;
                $objItem        = new Class_Item();
                	//*********************************** Assigning transaction details *******

		$smarty->assign("TRANSACTIONID",$resArray['TRANSACTIONID']);
		$smarty->assign("AMT",$resArray['AMT']);
		$smarty->assign("AVSCODE",$resArray['AVSCODE']);
		$smarty->assign("CVV2MATCH",$resArray['CVV2MATCH']);
		$smarty->assign('CURRENCY',CURRENCY);
              
		//$objItem->buyer_id	  = rteSafe($_SESSION['session_user_id']);
                $objItem->id                       =  $comma_trans_ids  ;
               // echo '<br>';
		$objItem->commisionvalues_returned = serialize($resArray);
                $objItem->commision_status	   = 1;
                $objItem->commisionpaid_date       = date('Y-m-d');
		$objItem->commision_transaction    = rteSafe($resArray['TRANSACTIONID']);
		//$objItem->commision_amount         = rteSafe($resArray['AMT']);
		$objItem->avs_code		   = rteSafe($resArray['AVSCODE']);
		$objItem->cvv2			   = rteSafe($resArray['CVV2MATCH']);
                $objDBReturn1                      = $objItem->insertUpdatecommisionitem();
//exit;
		$objUser->id = $_SESSION['session_user_id'];
		$UserRes = $objUser->getUserDetails();
		$UserArr = mysql_fetch_array($UserRes);
		$UserArr['email'];
		$UserArr['username'];

		//******************************** Get email template ******************
		$objMail->mail_title	        = "Email Template";
		$MailTemplate			= $objMail->selectMailTemplate();
		$templateRowArr 		= mysql_fetch_array($MailTemplate);
		$mail_content			= $templateRowArr['mail_content'];
		$mail_content			= str_replace("#link#",'NetHaat',$mail_content);

               //********************************  Gift Card email content **************

		$objMail->mail_title	        = "Gift Card";
		$MailRes 			= $objMail->selectMailTemplate();
		$mailRowArr 			= mysql_fetch_array($MailRes);
		$subject 			= $mailRowArr['mail_subject'];
		$subject			= str_replace("#name#",$UserArr['username'],$subject);
		$message_content		= $mailRowArr['mail_content'];

		//replace message content with mail template message conyent variable

		$mail_content			= str_replace("#message_content#",$message_content,$mail_content);
		$mail_content			= str_replace("#link#",'NetHaat',$mail_content);


		if($objDBReturn1->nIdentity && $objDBReturn1->nErrorCode==0)
		{
		

			//$_SESSION['giftcardrecivername']

		//***************************  Replacing mail content *********************

			$mail_content     = str_replace("#name#",$objItem->name,$mail_content);
			$mail_content     = str_replace("#email#",$objItem->email,$mail_content);
			$mail_content     = str_replace("#amount#",$objItem->paid_amount,$mail_content);
			$mail_content     = str_replace("#senderemail#",$UserArr['email'],$mail_content);
			$mail_content     = str_replace("#sendername#",$UserArr['username'],$mail_content);
			$mail_content     = str_replace("#cardnum#",$objItem->cardnumber,$mail_content);
			$mail_content     = str_replace("#message#",$message,$mail_content);
			$con_mail_content = str_replace("#name#",$objItem->name,$con_mail_content);

		//***************************  Sending mail content *********************

		//	$emailStatus 	= $emailObj->SendHtmlMail($objItem->email, $subject, $mail_content,$UserArr['email']);
                }



			


		success_msg("You has  successfully paid commision to admin .");
                redirect('my_account.php');

	}
}
//session_unset();
$smarty->assign('CURRENCY',CURRENCY);
$smarty->assign('site_page_title','Pay Commision');
$smarty->assign('site_title',$site_title);
$smarty->display('pay-commison-card.tpl');
?>