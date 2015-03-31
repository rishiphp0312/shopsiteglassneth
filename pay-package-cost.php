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
include ('class/class.package.inc');
include ('class/class.mail.inc');
include ('include/country_state_cat.php');
include ('include/sendEmailClass.php');
include ('include/send-sms.php');



session_start();
//echo '<pre>';
//print_r($_POST);
$objItem        = new Class_Item();
$objUser 	= new Class_User();
$objPackage 	= new Class_Package();
$objMail 	= new Class_Mail();
$emailObj 	= new SendEmailClass;
$Obj_category   = new Class_Category();

$seller_id      = $_SESSION['session_user_id'] ; // sellers  id
$objUser->id    = $_SESSION['session_user_id'];
$result_user    = $objUser->selectUser();
$num_user       = mysql_num_rows($result_user);
if($num_user)
{
$arr_user_values = mysql_fetch_assoc($result_user);
$sellers_name    = $arr_user_values['first_name'].''.$arr_user_values['last_name'];
$smarty->assign("user_values",$arr_user_values);
}
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
        
        $_SESSION['API_USERNAME']               = $adm_API_USERNAME;
	$_SESSION['API_PASSWORD']               = $adm_API_PASSWORD;
	$_SESSION['API_SIGNATURE']              = $adm_API_SIGNATURE;
	$_SESSION['paypal_merchant_id']         = $adm_paypal_merchant_id;
}

if($adm_API_USERNAME=='' || $adm_API_PASSWORD=='' || $adm_API_SIGNATURE=='')
{
       failure_msg("Error occured ...!Payment details are incomplete try again");
       redirect("pay-package-cost.php");
}
require_once 'CallerService.php';


$current_first_date = date('Y');
for($i=$current_first_date;$i<=$current_first_date+10;$i++)
 {
 $date_array[] = $i;
 }
 //print_r($date_array);
$smarty->assign("show_exp_year",$date_array);

$duration_id       = $_POST['duration_id'];
$package_amount    = $_POST['amount'];
$package_max_items = $_POST['max_items'];
$package_min_items = $_POST['min_items'];
$package_name_id   = $_POST['package_name_id'];
$smarty->assign("duration_id",$duration_id);
//$smarty->assign("amount",$package_amount);
$smarty->assign("package_max_items",$package_max_items);
$smarty->assign("package_min_items",$package_min_items);
$smarty->assign("package_name_id",$package_name_id);

/**
 * Get required parameters from the web form for the request
 */


if(isset($_POST['submit']))
{
        $duration_id       = $_POST['duration_id'];
        $package_amount    = $_POST['amount'];
        $package_max_items = $_POST['max_items'];
        $package_min_items = $_POST['min_items'];
        $package_name_id   = $_POST['package_name_id'];
        $paymentType       = urlencode($_POST['paymentType']);

        $firstName         = urlencode($_POST['firstName']);
	$lastName          = urlencode($_POST['lastName']);
	$creditCardType    = urlencode($_POST['creditCardType']);
	$creditCardNumber  = urlencode($_POST['creditCardNumber']);
	$expDateMonth      = urlencode($_POST['expDateMonth']);

	// Month must be padded with leading zero
	$padDateMonth     = str_pad($expDateMonth, 2, '0', STR_PAD_LEFT);

	$expDateYear      = urlencode($_POST['expDateYear']);
	$cvv2Number       = urlencode($_POST['cvv2Number']);
	$address1         = urlencode($_POST['address1']);
	$address2         = urlencode($_POST['address2']);
	$city             = urlencode($_POST['city']);
	$state            = urlencode($_POST['state']);
	$country          = urlencode($_POST['country']);
	$zip              = urlencode($_POST['zip']);
	$package_amount   = urlencode($_POST['amount']);
	//$currencyCode=urlencode($_POST['currency']);
	$currencyCode     = "USD";
	$paymentMode      = 'creditcard';


	/* Construct the request string that will be sent to PayPal.
	   The variable $nvpstr contains all the variables and is a
	   name value pair string with & as a delimiter */
	$nvpstr="&PAYMENTACTION=$paymentType&AMT=$package_amount&CREDITCARDTYPE=$creditCardType&ACCT=$creditCardNumber&EXPDATE=".$padDateMonth.$expDateYear."&CVV2=$cvv2Number&FIRSTNAME=$firstName&LASTNAME=$lastName&STREET=$address1&CITY=$city&STATE=ID"."&ZIP=$zip&COUNTRYCODE=US&CURRENCYCODE=$currencyCode";

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

		
		$objUser->id = $_SESSION['session_user_id'];
		$UserRes = $objUser->getUserDetails();
		$UserArr = mysql_fetch_array($UserRes);
		$UserArr['email'];
		$UserArr['username'];		
		//replace message content with mail template message conyent variable
		//$mail_content		= str_replace("#message_content#",$message_content,$mail_content);
		//$mail_content		= str_replace("#link#",'NetHaat',$mail_content);
		//*********************************** Assigning transaction details *******
		$smarty->assign("TRANSACTIONID",$resArray['TRANSACTIONID']);
		$smarty->assign("AMT",$resArray['AMT']);
		$smarty->assign("AVSCODE",$resArray['AVSCODE']);
		$smarty->assign("CVV2MATCH",$resArray['CVV2MATCH']);
		$smarty->assign('CURRENCY',CURRENCY);
                
                $objPackage->seller_id       = $_SESSION['session_user_id'];
                $objPackage->status          = 1;
                $result_active_pkgs          = $objPackage->getPackagedetails();
                $num_rowsactive_pkgs         = mysql_num_rows($result_active_pkgs);
                if($num_rowsactive_pkgs>0)
                {
                 $arr_active_pkgid           = mysql_fetch_assoc($result_active_pkgs);
                 $pkj_id_value               = $arr_active_pkgid['pack_id'];
                 $today_date                 = time();
                 $pkj_expiry_date            = $arr_active_pkgid['expiry_date'];
                 $days_diff                  = strtotime($pkj_expiry_date) - $today_date;
                 $no_of_days_toadd           = floor($days_diff/(60*60*24));
                 $no_of_days_toadd           = ($no_of_days_toadd +15);
             //     mail('rishi_kapoor@seologistics.com','sssss', 'pkg-'.$pkj_id_value);
                 $objPackage->pack_id        = $pkj_id_value;
                 $objPackage->status         =  0;
                 $objDBReturn                = $objPackage->insertUpdatePurchase_Package();
                }
                else
                {
                   $no_of_days_toadd           = 15;
                }
              //   echo 'no-of-days'.$no_of_days_toadd;
                // echo '<br>';
                if($duration_id==1)
                $time_exp =date("Y-m-d", strtotime("+1 month $no_of_days_toadd  days"));

                if($duration_id==6)
                $time_exp =date("Y-m-d", strtotime("+6 months $no_of_days_toadd days"));

                if($duration_id==12)
                $time_exp =date("Y-m-d", strtotime("+12 months $no_of_days_toadd days"));

               // echo $time_exp;exit;
                //$objPackage->status          = 1;
                $objPackage->time_month      = $duration_id.' Month';
		$objPackage->amount          = $resArray['AMT'];
		$objPackage->paymentmode     = 'credit card';
		$objPackage->trans_id        = $resArray['TRANSACTIONID'];
		$objPackage->values_returned = serialize($resArray);
                $objPackage->package_name    = $package_name_id;
                $objPackage->status          = 1;
                $objPackage->AVSCODE         = $resArray['AVSCODE'];
                $objPackage->CVV2MATCH       = $resArray['CVV2MATCH'];
                $objPackage->max_items       = $package_max_items;
                $objPackage->min_items       = $package_min_items;
                $objPackage->expiry_date     = $time_exp;
                 //start code for  commision on each item
                $objPackage->pack_id         = '';
                $objPackage->payment_status  = 1;
                $objDBReturn            = $objPackage->insertUpdatePurchase_Package();

                /////----------activating expired items------------//////////
              
                    $objItem->seller_id          = $seller_id;
                    $objItem->limit_max_items    = $package_max_items;
                    $objItem->orderexp_items_id  = 1;
                    $objItem->order_by_variable  = 1;
                    $get_items_ids               = $objItem->getItemImageDetails();
                    $num_items                   = mysql_num_rows($get_items_ids);
                    if($num_items>0)
                    {
                    while($arr_fetch_allitem_ids = mysql_fetch_assoc($get_items_ids))
                     {
                      $arr_allitem_ids[]         = $arr_fetch_allitem_ids['item_id'];
                     }
                      $implode_item_id           = implode(',',$arr_allitem_ids);
                    }
                     //mail('rishi_kapoor@seologistics.com','hi',$implode_item_id );
                    $objItem->expired_package    = 0;
                    $objItem->implode_item_ids   = $implode_item_id;
                    // $objItem->max_item        = $package_max_items;
                    $make_expire_items           = $objItem->insertUpdateActivateItem(); // function to activate items
              //exit;
               ///////----- end of code of activating expired items----------/////////


            
		if($objDBReturn->nIdentity && $objDBReturn->nErrorCode==0)
		{
		//******************************** Get email template ******************
		$objMail->mail_title	 = "Email Template";
		$MailTemplate		 = $objMail->selectMailTemplate();
		$templateRowArr 	 = mysql_fetch_array($MailTemplate);
		$mail_content		 = $templateRowArr['mail_content'];
		//$mail_content		 = str_replace("#link#",'NetHaat',$mail_content);
                $mail_content	    	 = str_replace("#link#",$baseUrl,$mail_content);

      //********************************  Purchased_package email content **************

		$objMail->mail_title	= "Purchased_package";
		$MailRes 		= $objMail->selectMailTemplate();
		$mailRowArr 		= mysql_fetch_array($MailRes);
		$subject 		= $mailRowArr['mail_subject'];
		//$subject		= str_replace("#name#",$UserArr['username'],$subject);
		$message_content	= $mailRowArr['mail_content'];


	//***************************  Replacing mail content *********************
                $mail_content           = str_replace("#message_content#",$message_content,$mail_content);
		$mail_content           = str_replace("#seller_name#",$sellers_name,$mail_content);
                $mail_content           = str_replace("#package_cost#",$resArray['AMT'],$mail_content);
                $mail_content           = str_replace("#package_name#",$package_name_id,$mail_content);
                $mail_content           = str_replace("#expiry_date#",$time_exp,$mail_content);
                $mail_content           = str_replace("#max_items#",$package_max_items,$mail_content);
                $mail_content		= str_replace("#link#",$baseUrl,$mail_content);


		//***************************  Sending mail content *********************
               //$emailStatus 	= $emailObj->SendHtmlMail('rishi_kapoor@seologistics.com', $subject, $mail_content,$UserArr['email']);
//	exit;
               $emailStatus = $emailObj->SendHtmlMail($UserArr['email'],$subject,$mail_content,'Nethaat');
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



		success_msg("You has  successfully purchased the package!!.");
                redirect('my_account.php');

	}
}
//session_unset();
$smarty->assign('CURRENCY',CURRENCY);
$smarty->assign('site_page_title',SITE_HOME);
$smarty->assign('site_title',$site_title);
$smarty->display('pay-package-cost.tpl');
?>