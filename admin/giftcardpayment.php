<?php
include ("common_includes.php");
include ("../include/adminsession.php.inc");
include ("../class/class.item.inc");
include ("../class/class.user.inc");
include ("../class/class.shipping.inc");
include ('../include/country_state_cat.php');
//include ('../include/sendEmailClass.php');

require_once '../CallerService.php';
session_start();



$objItem = new Class_Item();

$objUser = new Class_User();

if(isset($_POST['submit']))
{
	extract($_POST);


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
	$paymentType=urlencode($_POST['paymentType']);
	$paymentType=urlencode($_POST['paymentType']);
	//$itemid=urlencode($_POST['id']);
	//$_SESSION['itemid']=$itemid;
	//

	/* Construct the request string that will be sent to PayPal.
	   The variable $nvpstr contains all the variables and is a
	   name value pair string with & as a delimiter */
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
		$objUser 	= new Class_User();
		$objMail 	= new Class_Mail();
		$objItem    = new Class_Item();
		$emailObj 	= new SendEmailClass;

/*
		$objUser->id = $_SESSION['session_user_id'];
		$UserRes = $objUser->getUserDetails();
		$UserArr = mysql_fetch_array($UserRes);
		$UserArr['email'];
		$UserArr['username'];
		
*/		
		//******************************** Get email template ******************
		
		$objMail->mail_title	= "Email Template"; 
		$MailTemplate			= $objMail->selectMailTemplate();
		$templateRowArr 		= mysql_fetch_array($MailTemplate);
		$mail_content			= $templateRowArr['mail_content'];
		$mail_content			= str_replace("#link#",$baseUrl,$mail_content);
					
		//get gift card email content

		$objMail->mail_title	= "Gift Card"; 
		$MailRes 				= $objMail->selectMailTemplate();
		$mailRowArr 			= mysql_fetch_array($MailRes);
		$subject 				= $mailRowArr['mail_subject'];
	//	$subject				= str_replace("#name#",$UserArr['username'],$subject);
	    $subject				= str_replace("#name#",'Nethaat Admin',$subject);
		$message_content		= $mailRowArr['mail_content'];
		
		//replace message content with mail template message content variable
		
		$mail_content			= str_replace("#message_content#",$message_content,$mail_content);
		$mail_content			= str_replace("#link#",$baseUrl,$mail_content);
		
		//*********************************** Assigning transaction details *******
		
		$smarty->assign("TRANSACTIONID",$resArray['TRANSACTIONID']);
		$smarty->assign("AMT",$resArray['AMT']);
		$smarty->assign("AVSCODE",$resArray['AVSCODE']);
		$smarty->assign("CVV2MATCH",$resArray['CVV2MATCH']);
		$smarty->assign('CURRENCY',CURRENCY);

		
		//*********************************** Storing Giftcard details database ***

		
		$objItem->buyerid		= 'A1';
		//$objItem->buyerid		= rteSafe($_SESSION['session_user_id']);
		$objItem->name			= rteSafe($_SESSION['giftcardrecivername']);
		$objItem->email			= rteSafe($_SESSION['giftcardreciveremail']);
		$objItem->city			= rteSafe($_SESSION['giftcardrecivercity']);
		$objItem->country		= rteSafe($_SESSION['giftcardrecivercountry']);
		$objItem->reciverstate	= rteSafe($_SESSION['giftcardreciverstate']);

		$objItem->paymentstatus	= 1;
		$objItem->TRANSACTIONID	= rteSafe($resArray['TRANSACTIONID']);
		$objItem->paid_amount	= rteSafe($resArray['AMT']);
		$objItem->avs_code		= rteSafe($resArray['AVSCODE']);
		$objItem->cvv2			= rteSafe($resArray['CVV2MATCH']);
		
		$rstr = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        $nstr = "";
        mt_srand ((double) microtime() * 1000000);
        while(strlen($nstr) < 15)
        {
              $random = mt_rand(0,(strlen($rstr)-1));
              $nstr .= $rstr{$random};
         }


		$objItem->cardnumber	= $nstr.'_A1';
		//echo $o[]				= rteSafe($resArray);
		//$objUser->text

		$objDBReturn= $objItem->insertUpdategiftcard();

		if($objDBReturn->nIdentity && $objDBReturn->nErrorCode==0)
		{
		//***************************  Replacing mail content *********************

			$mail_content= str_replace("#name#",$objItem->name,$mail_content);
			$mail_content= str_replace("#email#",$objItem->email,$mail_content);
			$mail_content= str_replace("#amount#",$objItem->paid_amount,$mail_content);
			$mail_content= str_replace("#senderemail#",$UserArr['email'],$mail_content);
			//$mail_content= str_replace("#sendername#",$UserArr['username'],$mail_content);
			$mail_content= str_replace("#sendername#",'Nethaat Admin',$mail_content);
			$mail_content= str_replace("#cardnum#",$objItem->cardnumber,$mail_content);
			$mail_content= str_replace("#message#",$message,$mail_content);
			$mail_content= str_replace("#nethatlink#","Net Haat",$mail_content);
			//$con_mail_content= str_replace("#name#",$objItem->name,$con_mail_content);

		//***************************  Sending mail content *********************
			//echo $mail_content;exit;
			$emailStatus 	= $emailObj->SendHtmlMail($objItem->email, $subject, $mail_content,$UserArr['email']);
			
			if($emailStatus == true)
			{
				success_msg("Your gift card has been sent successfully...");
				header("Location:admin_home.php");
			}
			else
			{
				failure_msg("Error occured ...!Please try again");
			}
		}
	}
	header("Location:giftcardpayment.php");
	
	//success_msg("Your feedback for item has been successfull posted..");
	
	
}
$smarty->assign('CURRENCY',CURRENCY);
$smarty->assign('site_page_title',SITE_HOME);
$smarty->assign('site_title',$site_title);

$smarty->display('giftcardpayment.tpl');	
?>