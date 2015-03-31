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



session_start();
//print_r($_SESSION);
//echo '<pre>';
//print_r($_SESSION);
$actual_costof_item = $_SESSION['show_d_cost_item'];
$detect_1_card      = $actual_costof_item - $_SESSION['reciveramount_1_card'];
$detect_2_card      = $actual_costof_item - ($_SESSION['reciveramount_1_card']+$_SESSION['reciveramount_2_card']);

//echo '</pre>';


$sellers_id      = $_SESSION['det_seller_id'] ;   //seler id
$buyer_id        = $_SESSION['session_user_id'] ; // buyer id
$objUser 	     = new Class_User();
$objUser->id     = $_SESSION['session_user_id'];
$result_user     = $objUser->selectUser();
$num_user        = mysql_num_rows($result_user);
if($num_user)
$arr_user_values = mysql_fetch_assoc($result_user);
$smarty->assign("user_values",$arr_user_values);
// code to fetch payment details of sellers 

$objUser->id         = $_SESSION['det_seller_id'];
$result_user_sel     = $objUser->selectUser();
$num_user_sel        = mysql_num_rows($result_user_sel);
if($num_user_sel)
{
	$arr_user_values_sel 		= mysql_fetch_assoc($result_user_sel);
        $API_USERNAME	     		= $arr_user_values_sel['API_USERNAME'];
	$API_PASSWORD	     		= $arr_user_values_sel['API_PASSWORD'];
	$API_SIGNATURE	     		= $arr_user_values_sel['API_SIGNATURE'];
	$payment_type	     		= $arr_user_values_sel['payment_type'];
	$paypal_merchant_id   		= $arr_user_values_sel['paypal_merchant_id'];
	
	$_SESSION['payment_type']   = $payment_type;
	$_SESSION['API_USERNAME']   = $API_USERNAME;
	$_SESSION['API_PASSWORD']   = $API_PASSWORD;
	$_SESSION['API_SIGNATURE']  = $API_SIGNATURE;
	$_SESSION['Merchant_Id']    = $Merchant_Id;
	$_SESSION['paypal_merchant_id']    = $paypal_merchant_id;
}
if($API_USERNAME=='' || $API_PASSWORD=='' || $API_SIGNATURE=='')
 	{
    failure_msg("Error occured ...!Payment details are incomplete try again");
    redirect("pay-item-cost.php");
	}

/*
//if(($payment_type==0 &&( $API_USERNAME=='' || $API_PASSWORD=='' || $API_SIGNATURE=='')&& $paypal_merchant_id=='') ||($payment_type==1 && $Merchant_Id==''))
if($API_USERNAME=='' || $API_PASSWORD=='' || $API_SIGNATURE=='')

 	{
	failure_msg("Error occured ...!Payment details are incomplete try again");
    redirect("pay-item-cost.php");
	}
	*/



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
if(isset($_POST['submit']))
{
    require_once 'CallerService.php';
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
	$paymentType = $_REQUEST['paymentType'];
	$paymentMode='creditcard';
    

	/* Construct the request string that will be sent to PayPal.
	   The variable $nvpstr contains all the variables and is a
	   name value pair string with & as a delimiter */
//$nvpstr="&PAYMENTACTION=$paymentType&AMT=$amount&CREDITCARDTYPE=$creditCardType&ACCT=$creditCardNumber&EXPDATE=".$padDateMonth.$expDateYear."&CVV2=$cvv2Number&FIRSTNAME=$firstName&LASTNAME=$lastName&STREET=$address1&CITY=$city&STATE=ID"."&ZIP=$zip&COUNTRYCODE=US&CURRENCYCODE=$currencyCode";

        $nvpstr="&PAYMENTACTION=$paymentType&AMT=$amount&CREDITCARDTYPE=$creditCardType&ACCT=$creditCardNumber&EXPDATE=".         $padDateMonth.$expDateYear."&CVV2=$cvv2Number&FIRSTNAME=$firstName&LASTNAME=$lastName&STREET=$address1&CITY=$city&STATE=$state".
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
		$emailObj 	= new SendEmailClass;

		$objUser->id = $_SESSION['session_user_id'];
		$UserRes = $objUser->getUserDetails();
		$UserArr = mysql_fetch_array($UserRes);
		$UserArr['email'];
		$UserArr['username'];
		
		//******************************** Get email template ******************
			$objMail->mail_title	= "Email Template"; 
		$MailTemplate			= $objMail->selectMailTemplate();
		$templateRowArr 		= mysql_fetch_array($MailTemplate);
		$mail_content			= $templateRowArr['mail_content'];
		$mail_content			= str_replace("#link#",'NetHaat',$mail_content);

      //********************************  Gift Card email content **************
	
		$objMail->mail_title	= "Gift Card"; 
		$MailRes 	        = $objMail->selectMailTemplate();
		$mailRowArr 		= mysql_fetch_array($MailRes);
		$subject 		= $mailRowArr['mail_subject'];
		$subject		= str_replace("#name#",$UserArr['username'],$subject);
		$message_content	= $mailRowArr['mail_content'];

		//replace message content with mail template message conyent variable
		
		$mail_content			= str_replace("#message_content#",$message_content,$mail_content);
		$mail_content			= str_replace("#link#",'NetHaat',$mail_content);


		//*********************************** Assigning transaction details *******
		
		$smarty->assign("TRANSACTIONID",$resArray['TRANSACTIONID']);
		$smarty->assign("AMT",$resArray['AMT']);
		$smarty->assign("AVSCODE",$resArray['AVSCODE']);
		$smarty->assign("CVV2MATCH",$resArray['CVV2MATCH']);
		$smarty->assign('CURRENCY',CURRENCY);

		
		//*********************************** Storing Giftcard details database ***

		$objItem = new Class_Item();
		$objItem->buyer_id	  = rteSafe($_SESSION['session_user_id']);
		$objItem->item_id         = $_SESSION['d_item_id'];
		$objItem->seller_id       = $_SESSION['det_seller_id'];
		$objItem->amount          = trim($_SESSION['d_cost_item'],'-');
		$objItem->paymentmode     = $paymentMode;
	        $objItem->shipping_status = 0;
		$objItem->trans_id        = $resArray['TRANSACTIONID'];
		$objItem->values_returned = serialize($resArray);
		//exit;
		$objItem->cardnumber	  = $nstr.'_'.$_SESSION['session_user_id'];
	    //	calculategiftcardvalue
		$objItem->gift_card1	  =  $_SESSION['reciveramount_1_card'];
		$objItem->gift_card2	  =  $_SESSION['reciveramount_2_card'];
		
		$objItem->shipping_cost   = $_SESSION['service_rate'];
		$objItem->payment_status  = 1;
	//	$objShip->total_cost        = $resArray['AMT'];
                $objDBReturn= $objItem->insertUpdatepurchaseditem();
                $last_trans_id = $objDBReturn->nIdentity;

		
		//exit;
               if($_SESSION['firstcardcode']!='')
		{
	//	$objItem->giftcardnumber		=	$_SESSION['firstcardcode'] ;
	        $objItem->cardnumber            =	$_SESSION['firstcardcode'] ;
	    
	      if((int)$_SESSION['show_d_cost_item']>(int)$_SESSION['reciveramount_1_card'])
			{
    		$objItem->paid_amount_first_card			= '0';
		        }
		else 
			{
	    	$pass_into_paid1=(int)$_SESSION['show_d_cost_item']-(int)$_SESSION['reciveramount_1_card'];
	        $objItem->paid_amount_first_card			= $pass_into_paid1;
			}
		
		
	         $objDBReturn1 = $objItem->insertUpdategiftcard();
	  
		 if($objDBReturn1->nErrorCode==0)
				{
				$_SESSION['firstcardcode']='';
				$_SESSION['calculategiftcardvalue']='';
				 }
		}

		if($_SESSION['secondcard_code']!='')
		{
		  
		     $objItem->cardnumber            =	$_SESSION['secondcard_code'] ;
			 $objItem->paid_amount			=   '0';

	  if((int)$_SESSION['show_d_cost_item']>((int)$_SESSION['reciveramount_1_card']+(int)$_SESSION['reciveramount_2_card']))
    	  	{
			 $objItem->paid_amount_second_card			= '0';
			}
	  else 
			{
		      $first_sum       = ((int)$_SESSION['reciveramount_1_card']+(int)$_SESSION['reciveramount_2_card']);
              $diff_of_amt     = ((int)$first_sum-(int)$_SESSION['show_d_cost_item']);
	      	  $pass_into_paid2 = (int)$diff_of_amt;
			}
	        $objItem->paid_amount_second_card        = (int)$pass_into_paid2;
		              
		    $objDBReturn2                            = $objItem->insertUpdategiftcard();
		
			
			if($objDBReturn2->nErrorCode==0)
			 {
				$_SESSION['secondcard_code']='';
				$_SESSION['secondcalculategiftcardvalue']='';
			 }
		 
		}
 		$objItem->update_item_id     =  $_SESSION['d_item_id'];
		
		$item_details                =  $objItem->getItemImageDetails();
		$num_rows_details            =  mysql_num_rows($item_details);
        if($num_rows_details>0)
		$arr_item_details            =  mysql_fetch_assoc($item_details);
		//print_r($arr_item_details);
		$quantity_available          = $arr_item_details['quantity_available'];
		//print_r($arr_item_details);

		
		$quantity_available          = $quantity_available-1;
		$objItem->item_value         = $_SESSION['d_item_id'];
	    $objItem->quantity_available = $quantity_available ;
		$objItem->insertUpdateItem1('1');        
        
		$objItem->paymentstatus	     = 1;
		
		$objItem->paid_amount	     = rteSafe($resArray['AMT']);
		$objItem->avs_code		     = rteSafe($resArray['AVSCODE']);
		$objItem->cvv2		         = rteSafe($resArray['CVV2MATCH']);
		if($_SESSION['item_is_haated']==1)
		{
		$objItem->last_id             = $_SESSION['haated_id'];
		$objItem->paid_status         = 1;
		$objItem->changeBID_StatusHatingitems('1');					
		}
	
		
		$rstr = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        $nstr = "";
        mt_srand ((double) microtime() * 1000000);
        while(strlen($nstr) < 15)
        {
              $random = mt_rand(0,(strlen($rstr)-1));
              $nstr .= $rstr{$random};
         }
        /////////////----storing databse details of giftcard//////////
        	
		$objItem->buyerid		= rteSafe($_SESSION['session_user_id']);
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
		


		$objItem->cardnumber	= $nstr.'_'.$_SESSION['session_user_id'];
		//echo $o[]				= rteSafe($resArray);
		//$objUser->text

		   //$objDBReturn1= $objItem->insertUpdategiftcard();
          
         	$objShip                    = new Class_Shipping();
        	$objShip->shipping_cost     = $_SESSION['service_rate'];
			$objShip->total_cost        = $resArray['AMT'];
			$objShip->buyer_id          = $_SESSION['session_user_id'];
		    $objShip->item_id           = $_SESSION['d_item_id'];
			$objShip->shipping_address1 = $_SESSION['shipping_address1'];
			$objShip->shipping_address2 = $_SESSION['shipping_address2'];
			$objShip->dest_zip_code     = $_SESSION['dest_zip_code'];
			$objShip->city              = $_SESSION['city'];
			$objShip->quantity          = $_SESSION['ship_quantity'];
            // $last_trans_id 
			$objShip->last_trans_id     = $last_trans_id;
			//exit;
			$objShip->insertUpdateshipping();
			
          

		if($objDBReturn1->nIdentity && $objDBReturn1->nErrorCode==0)
		{
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
			


			
			//if($emailStatus == true)
			//{
				success_msg("You has  successfully purchased an item.");
			 //	header("Location:my_account.php");
			//}
			//else
			//{
		///		failure_msg("Error occured ...!Please try again");
			//}
		}

		
		///////------end of giftcard-------////
	
		 /////// code  for sending sms 
		
     //$sellers_id  
		$objUser1 	       = new Class_User();
		$objUser1->id      = $sellers_id;
		$result_user1      = $objUser1->selectUser();
		$num_user1         = mysql_num_rows($result_user1);
		if($num_user1)
		$arr_user_values1  = mysql_fetch_assoc($result_user1);
	//echo	$arr_user_values1 ['calling_code'];
	
		 send_to_seller($arr_user_values1['first_name'].''.$arr_user_values1['last_name'],$arr_item_details ['title'],'+'.$arr_user_values1 ['calling_code'].$arr_user_values1['phone1'],$UserArr['first_name'].''.$UserArr['last_name']);
	
       /// code ends here for sms


		//echo $o[]				= rteSafe($resArray);
		//$objUser->text

		success_msg("You has  successfully purchased an item.");
        redirect('my_account.php');
		
	}
}
//session_unset();               
$smarty->assign('CURRENCY',CURRENCY);
$smarty->assign('site_page_title',SITE_HOME);
$smarty->assign('site_title',$site_title);
$smarty->display('pay-item-cost.tpl');
?>