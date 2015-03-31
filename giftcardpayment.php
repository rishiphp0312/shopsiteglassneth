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
include ('class/class.mail.inc');
include ('include/country_state_cat.php');
include ('include/sendEmailClass.php');
session_start();
       
	   
                $objItem                  = new Class_Item();
                $result_max_rows          = $objItem->getgiftcarddetail();
                $num_max_id_ofgiftcard    = mysql_num_rows($result_max_rows);
                if($num_max_id_ofgiftcard>0)
                {//$arr_max_giftid         = mysql_fetch_assoc($result_max_rows);
                 //$gift_card_max_id       = $arr_max_giftid['max_id'];
                $total_max_id_ofgiftcard = $num_max_id_ofgiftcard+1;
                }//exit;
                if($_POST['seller_id']!='')
               // $_SESSION['giftcard-seller']=$_POST['seller_id'];
                $_SESSION['giftcard_seller_id']=$_POST['seller_id'];
		
                $objUser 	                   = new Class_User();
				//$objUser->id         		   = $_SESSION['det_seller_id'];
				$objUser->id         		   = $_SESSION['giftcard_seller_id'];
				$result_user_sel     		   = $objUser->selectUser();
				$num_user_sel        		   = mysql_num_rows($result_user_sel);
				if($num_user_sel)
				{
				$arr_user_values_sel 		   = mysql_fetch_assoc($result_user_sel);
				$sellers_username     		   = $arr_user_values_sel['username'];
				$sellers_email      		   = $arr_user_values_sel['email'];
				$API_USERNAME	     		   = $arr_user_values_sel['API_USERNAME'];
				$API_PASSWORD	     		   = $arr_user_values_sel['API_PASSWORD'];
				$API_SIGNATURE	     		   = $arr_user_values_sel['API_SIGNATURE'];
				$payment_type	     		   = $arr_user_values_sel['payment_type'];
				$paypal_merchant_id	     	   = $arr_user_values_sel['paypal_merchant_id'];
				$_SESSION['payment_type']      = $payment_type;
				$_SESSION['API_USERNAME']      = $API_USERNAME;
				$_SESSION['API_PASSWORD']      = $API_PASSWORD;
				$_SESSION['API_SIGNATURE']     = $API_SIGNATURE;
				$_SESSION['Merchant_Id']       = $Merchant_Id;
				$_SESSION['paypal_merchant_id']= $paypal_merchant_id;
					}
					
	//	echo 'API_USERNAME'.$API_USERNAME.'API_PASSWORD'.$API_PASSWORD.'sign'.$API_SIGNATURE.'paypal_m'.$paypal_merchant_id;
                if($_POST['purchase_now'])
                {
                if($paypal_merchant_id=='')
                {
                failure_msg("Service unavailable seller's payment details on paypal site are incomplete!! ");
                redirect("featured_store_information.php?id=".$_SESSION['giftcard_seller_id']);
                }
                 
				$objItem->buyerid		= rteSafe($_SESSION['session_user_id']);
				$objItem->name			= rteSafe($_SESSION['giftcardrecivername']);
				$objItem->email			= rteSafe($_SESSION['giftcardreciveremail']);
				$objItem->city			= rteSafe($_SESSION['giftcardrecivercity']);
				$objItem->country		= rteSafe($_SESSION['giftcardrecivercountry']);
				$objItem->reciverstate	= rteSafe($_SESSION['giftcardreciverstate']);
				$objItem->paymentstatus	= 0;
	
		
		        $rstr = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
                $nstr = "";
                mt_srand ((double) microtime() * 1000000);
                while(strlen($nstr) < 15)
                {
                      $random = mt_rand(0,(strlen($rstr)-1));
                      $nstr .= $rstr{$random};
                 }
                $last_id_forcustom = $total_max_id_ofgiftcard.'_'.$nstr.'_'.$_SESSION['session_user_id'];
                //$result_max_rows          = $objItem->getgiftcarddetail();
               // echo $num_max_id_ofgiftcard    = mysql_num_rows($result_max_rows);
               /* if($num_max_id_ofgiftcard>0)
                {$arr_max_giftid          = mysql_fetch_assoc($result_max_rows);
                 $gift_card_max_id        = $arr_max_giftid['max_id'];
                 echo $total_max_id_ofgiftcard = $gift_card_max_id+1;
                }*/
		$objItem->cardnumber	   = $last_id_forcustom;
		$objItem->check_condition  = 0;
		$objItem->seller_id        = $_SESSION['giftcard_seller_id'];
		$objDBReturn               = $objItem->insertUpdategiftcard();
	//exit;
		// $last_id_forcustom = $objDBReturn->nIdentity;
		$custom_variable   = $last_id_forcustom.'##-|-##'.$_SESSION['giftcard_seller_id'].'##-|-##'.$_SESSION['session_user_id'].'##-|-##'.$_SESSION['giftcardrecivername'].'##-|-##'.$_SESSION['giftcardreciveremail'].'##-|-##'.$sellers_username.'##-|-##'.$sellers_email ;
		echo '<div align="center" valign="center"><img src="'.$site_url.'images_site/loading.gif" alt="Loading........." ></div>';
		?>
	<form action="<? echo PAYPAL_URL;?>" method="post" name="Pay_order_new">
	<input type="hidden" name="redirect_cmd" value="_xclick" />
	<input type="hidden" name="cmd" value="_ext-enter" />
	<input type="hidden" name="business" value="<?=$paypal_merchant_id;?>" />
	<input type="hidden" name="item_name" value="Purchase Giftcard">
	<input type="hidden" name="no_shipping" value="0" />
	<input type="hidden"  name="amount"	value="<?=$_SESSION['giftcardreciveramount']?>" />
	<input type="hidden" name="return" value="<?=$baseUrl?>my_account.php" />
	<input type="hidden" name="cancel_return" value="<?=$baseUrl?>api_error1.php" />
	<input type="hidden" name="no_note" value="1" />
	<input type="hidden" name="currency_code" value="USD" />
       <!-- <input type="hidden" name="notify_url" value="<?=$baseUrl?>test-notify.php" />-->
	<input type="hidden" name="notify_url" value="<?=$baseUrl?>notify_gift1.php" />
	<input type="hidden" name="custom" value="<?=$custom_variable?>" />
	<input type="hidden" name="flag" value="yes">
	</form>

	

		<?
		echo "<script>document.Pay_order_new.submit();</script>";
}
//<input type="text"  name="business" value="{$smarty.session.paypal_merchant_id}" />



	  
		$smarty->assign('custom_variable',$custom_variable);

		


	require_once 'CallerService.php';
	
	/**
	 * Get required parameters from the web form for the request
	 */
	if(isset($_POST['submit']))
	{
            

         if($API_USERNAME=='' || $API_USERNAME=='' ||$API_USERNAME=='')
         {
          failure_msg("Service unavailable seller's payment details on paypal site are incomplete!! ");
          redirect("featured_store_information.php?id=".$_SESSION['giftcard_seller_id']);
          }
	
	//$seller_id 	  = $_POST['seller_id'];
        $seller_id 	  = $_SESSION['giftcard_seller_id'];
	$paymentType 	  = urlencode($_POST['paymentType']);
	$firstName 	  = urlencode($_POST['firstName']);
	$lastName 	  = urlencode($_POST['lastName']);
	$creditCardType   = urlencode($_POST['creditCardType']);
	$creditCardNumber = urlencode($_POST['creditCardNumber']);
	$expDateMonth 	  = urlencode($_POST['expDateMonth']);

	// Month must be padded with leading zero
	$padDateMonth    = str_pad($expDateMonth, 2, '0', STR_PAD_LEFT);

	$expDateYear     = urlencode($_POST['expDateYear']);
	$cvv2Number      = urlencode($_POST['cvv2Number']);
	$address1        = urlencode($_POST['address1']);
	$address2        = urlencode($_POST['address2']);
	$city            = urlencode($_POST['city']);
	$state           = urlencode($_POST['state']);
	$country         = urlencode($_POST['country']);
	$zip             = $_POST['zip'];
	$amount          = urlencode($_POST['amount']);
	//$currencyCode=urlencode($_POST['currency']);
	$currencyCode    = "USD";
	$paymentType     = $_POST['paymentType'];
	//$itemid=urlencode($_POST['id']);
	//$_SESSION['itemid']=$itemid;
	//

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
	{//exit;
		$_SESSION['reshash']=$resArray;
		$location = "APIError.php";
		header("Location: $location");
	}
	else
	{
		$objUser 	= new Class_User();
		$objMail 	= new Class_Mail();
		$emailObj 	= new SendEmailClass;

		$objUser->id = $_SESSION['session_user_id'];
		$UserRes = $objUser->getUserDetails();
		$UserArr = mysql_fetch_array($UserRes);
		$UserArr['email'];// buyer email
		$UserArr['username'];// buyers user name
		
		
		//******************************** Get email template ******************
		
		$objMail->mail_title	        = "Email Template";
		$MailTemplate			= $objMail->selectMailTemplate();
		$templateRowArr 		= mysql_fetch_array($MailTemplate);
		$mail_content			= $templateRowArr['mail_content'];
		$mail_content			= str_replace("#link#",$baseUrl,$mail_content);
					
		//get gift card email content
		
		$objMail->mail_title	        = "Gift Card";
		$MailRes 			= $objMail->selectMailTemplate();
		$mailRowArr 			= mysql_fetch_array($MailRes);
		$subject 			= $mailRowArr['mail_subject'];
		$subject			= str_replace("#name#",$UserArr['username'],$subject);
		$message_content		= $mailRowArr['mail_content'];
		
		//replace message content with mail template message content variable
		$mail_content			= str_replace("#message_content#",$message_content,$mail_content);
		//$store_url = 'http://www.flexsin.org/lab/net_haat/featured_store_information.php?id='.$seller_id;
                $store_url = $baseUrl.'featured_store_information.php?id='.$seller_id;
		$mail_content= str_replace("#store_url#",$store_url,$mail_content);
		$mail_content= str_replace("#link#",$baseUrl,$mail_content);
		                //*********************************** Assigning transaction details *******

                //  start of gift card code
                //*********************************** Storing Giftcard details database ***

		
		$objItem->buyerid		= rteSafe($_SESSION['session_user_id']);
		$objItem->name			= rteSafe($_SESSION['giftcardrecivername']);
		$objItem->email			= rteSafe($_SESSION['giftcardreciveremail']);
		$objItem->city			= rteSafe($_SESSION['giftcardrecivercity']);
		$objItem->country		= rteSafe($_SESSION['giftcardrecivercountry']);
		$objItem->reciverstate	        = rteSafe($_SESSION['giftcardreciverstate']);
		$objItem->paymentstatus	        = 1;
		$objItem->TRANSACTIONID	        = rteSafe($resArray['TRANSACTIONID']);
		$objItem->paid_amount	        = rteSafe($resArray['AMT']);
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
                $objItem->cardnumber = $total_max_id_ofgiftcard.'_'.$nstr.'_'.$_SESSION['session_user_id'];
                $mail_content= str_replace("#name#",$objItem->name,$mail_content);
		$mail_content= str_replace("#email#",$objItem->email,$mail_content);
		$mail_content= str_replace("#amount#",$objItem->paid_amount,$mail_content);
		$mail_content= str_replace("#senderemail#",$UserArr['email'],$mail_content);
		$mail_content= str_replace("#sendername#",$UserArr['username'],$mail_content);
		$mail_content= str_replace("#cardnum#",$objItem->cardnumber,$mail_content);
                $mail_content= str_replace("#image_gift#",'',$mail_content);

                $mail_content= str_replace("#message#",$message,$mail_content);
		$mail_content= str_replace("#nethatlink#","Net Haat",$mail_content);
			//$con_mail_content= str_replace("#name#",$objItem->name,$con_mail_content);

		//***************************  Sending mail content *********************


			//echo $mail_content;exit;
		$emailStatus = $emailObj->SendHtmlMail($objItem->email,$subject,$mail_content,$UserArr['email']);
		//mail('rishi_kapoor@seologistics.com','hi ',$emailStatus.'--emailstatus--'.$objItem->email.'--'.$mail_content.'-'.$UserArr['email']);





                $objItem->check_condition=0;
		$objItem->seller_id  = $_SESSION['giftcard_seller_id'];
		$objDBReturn= $objItem->insertUpdategiftcard();

                //******************************** Get email template ******************
               
		$objMail->mail_title	        = "Email Template";
		$MailTemplate			= $objMail->selectMailTemplate();
		$templateRowArr 		= mysql_fetch_array($MailTemplate);
		$mail_content			= $templateRowArr['mail_content'];
		$mail_content			= str_replace("#link#",$baseUrl,$mail_content);

                //get gift card email content
                $objMail->mail_title	        = "Gift_Card_seller";
		$MailRes 			= $objMail->selectMailTemplate();
		$mailRowArr 			= mysql_fetch_array($MailRes);
		$subject 			= $mailRowArr['mail_subject'];
                $message_content		= $mailRowArr['mail_content'];
		//replace message content with mail template message content variable
		$mail_content			= str_replace("#message_content#",$message_content,$mail_content);
		$mail_content			= str_replace("#link#",$baseUrl,$mail_content);
             	$mail_content                   = str_replace("#name#",$objItem->name,$mail_content);
		$mail_content                   = str_replace("#email#",$objItem->email,$mail_content);
		$mail_content                   = str_replace("#amount#",$objItem->paid_amount,$mail_content);
		$mail_content                   = str_replace("#senderemail#",$UserArr['email'],$mail_content);
		$mail_content                   = str_replace("#sendername#",$UserArr['username'],$mail_content);
		$mail_content                   = str_replace("#cardnum#",$objItem->cardnumber,$mail_content);
                $mail_content                   = str_replace("#sellername#",$sellers_username,$mail_content);
               
                $mail_content                   = str_replace("#image_gift#",'',$mail_content);
                $mail_content                   = str_replace("#message#",$message,$mail_content);
                
		$mail_content                   = str_replace("#nethatlink#","Net Haat",$mail_content);

		//***************************  Sending mail content *********************


			//echo $mail_content;exit;
		$emailStatus = $emailObj->SendHtmlMail($sellers_email,$subject,$mail_content,$UserArr['email']);
		//*********************************** Assigning transaction details *******



		$smarty->assign("TRANSACTIONID",$resArray['TRANSACTIONID']);
		$smarty->assign("AMT",$resArray['AMT']);
		$smarty->assign("AVSCODE",$resArray['AVSCODE']);
		$smarty->assign("CVV2MATCH",$resArray['CVV2MATCH']);
		$smarty->assign('CURRENCY',CURRENCY);

		
		
		//echo $o[]				= rteSafe($resArray);
		//$objUser->text
                //$total_path = 'www.nethaat.com/images/nathaat-gift-cart.jpg';
		
                ///   table design starts to show structure
//   $str_table='';
//   $str_table="<table align='left'  width='250' height='164' cellspacing='10' cellpadding='1' border='1'>";
//   $str_table.="<tr><td>&nbsp; </td></tr>";
//   $str_table.="<tr><td width='250' align='left' height='164' style='background-image:url('".$total_path."');background-repeat:no-repeat;' >";
//  //$str_table.="<tr><td width='250' align='left' height='164' style='background-color:red;' >";
//
//   $str_table.="<table align='right' width='250' height='160' cellspacing='0' cellpadding='1' border='0'>";
//   $str_table.="<tr><td colspan='3' valign='bottom' >&nbsp;</td></tr>";
//   $str_table.="<tr><td width='60'  valign='bottom'>&nbsp;</td>
//   <td nowrap width='20' valign='bottom' style='padding-left:5px;' class='classsmallTiTleTXT' >&nbsp;&nbsp;Name </td>
//   <td  nowrap width='80' valign='bottom'  style='padding-left:5px;' class='classsmallTiTleTXT'>&nbsp;Rishi kapoor</td>
//   </tr>
//   <tr>
//   <td  valign='bottom' >&nbsp;</td>
//   <td  nowrap valign='top' class='classsmallTiTleTXT'>&nbsp;&nbsp;Giftcard Code </td>
//   <td nowrap valign='top' class='classsmallTiTleTXT'>&nbsp;#123456789101112</td>
//   </tr></table></td></tr></table>";


                //   table design ends
		if($objDBReturn->nIdentity && $objDBReturn->nErrorCode==0)
		{
		//***************************  Replacing mail content *********************

			
			
			if($emailStatus == true)
			{
				success_msg("Your gift card has been sent successfully...");
				header("Location:my_account.php");
			}
			else
			{
				failure_msg("Error occured ...!Please try again");
			}
		}
	}
}
//session_unset();               
$smarty->assign('CURRENCY',CURRENCY);
$smarty->assign('site_page_title',SITE_HOME);
$smarty->assign('site_title',$site_title);
$smarty->display('giftcardpayment.tpl');
?>