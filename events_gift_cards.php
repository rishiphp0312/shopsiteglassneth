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
include ("include/authentiateUserLogin.php");
include ('class/class.category.inc');
session_start();

		$objUser 	    = new Class_User();
		$objMail 	    = new Class_Mail();
		$emailObj 	    = new SendEmailClass();
		$objItem        = new Class_Item();
        //   $objItem                  = new Class_Item();
        $result_max_rows          = $objItem->getgiftcarddetail();
        $num_max_id_ofgiftcard    = mysql_num_rows($result_max_rows);
        $total_max_id_ofgiftcard  = $num_max_id_ofgiftcard+1;

	    //$objUser->id         		= $_SESSION['det_seller_id'];
		
		if($_REQUEST['seller_username']!='')
		{//exit;
	    $seller_username                    = $_REQUEST['seller_username'];
		$objUser->username                  = $seller_username;
		$objUser->sort_order                = '1';
		 
		 }
		//if($_REQUEST['seller_username']!='')
		//{ 
		$smarty->assign("seller_username",$seller_username);
		$rslt_users_serch                   = $objUser->serchSeller_forgiftcard();
		$num_users_serch                    = mysql_num_rows($rslt_users_serch); 
		$pagination = new Pagination();
 
 
		if(!isset($_GET['pageNumber']))
		{
			$pageNumber = 1;
		}
		else
		{
			$pageNumber= $_GET['pageNumber'];
		}

	    $num_rows_items     = $num_users_serch;
		/////
		//number of records per page LIMIT
	if(isset($_GET['limit']) && is_numeric($_GET['limit']))
	{
		$to	= trim($_GET['limit']);
	}
	else
	{
		$to	=	ADMIN_PAGE_NUMBER;
	}	
	$from=($pageNumber-1)*$to;
	$showPrevNext = true;
//$url = "admin_category.php?start_date=$start_date&end_date=$end_date&business=$business";
	$url = basename($_SERVER['PHP_SELF'])."?rem_id_value=".$_REQUEST['rem_id_value']."&sort_order=1&seller_username=".$_REQUEST['seller_username'];
	if($pageNumber==1 || $pageNumber=='')
	{
		$counter=1;
	}
	else
	{
		$counter = $pageNumber+$from-($pageNumber-1);
	}
	//echo '$counter'.$counter;
	$pageLimit =" LIMIT $from,$to";
// echo 'url=-'.$url;
	$pageLink = $pagination->getPageLinks($num_rows_items, $to, $url, $pageNumber,"1&order_by=$order_by_asc_desc", $showPrevNext);
	// Assigning Pagination Links
	$smarty->assign('pageLink',$pageLink);         
	#>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>  Code for pagination END   <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<#
	
	    $objUser->pageLimit = $pageLimit;
	    $seller_username                     = $_REQUEST['seller_username'];
		$objUser->username                   = $seller_username;
		$rslt_users_serch1                   = $objUser->serchSeller_forgiftcard();
		$num_users_serch1                    = mysql_num_rows($rslt_users_serch1); 
		
		if($num_users_serch>0)
		 {
		  while($arr_fetc_users_serch1       = mysql_fetch_assoc($rslt_users_serch1))
		  {
			  $seller_user_name[]           = $arr_fetc_users_serch1['username'];
			  $seller_user_id[]             = $arr_fetc_users_serch1['user_id_value'];
			  $all_serch_arr_val[]          = $arr_fetc_users_serch1;
		  
		  }
		  }
		     $smarty->assign("all_serch_arr_val",$all_serch_arr_val);
			 $smarty->assign("arr_fetc_users_serch",$arr_fetc_users_serch);
			 $smarty->assign("num_users_serch",$num_users_serch);
	
	$page_counter = $pagination->getPageCounter($num_users_serch1);
	$smarty->assign('page_counter',$page_counter);
	
		////

		//exit;
		
		
		//}
		     
			
            
    	if($_REQUEST['rem_id_value']=='')
		redirect("my_account.php");
	     
		if($_REQUEST['rem_id_value']!='')
	     {
                $objUser->rem_id                      = $_REQUEST['rem_id_value'];
                $result_users                         = $objUser->getreminderlisting();
                $num_value_users_details              = mysql_num_rows($result_users);
                    if($num_value_users_details >0)
                    {
                    $arr_fetch_users_details         = mysql_fetch_assoc($result_users);
                    }
      	  }
		 $smarty->assign("reminders_details",$arr_fetch_users_details);
		 $smarty->assign("rem_id_value",$_REQUEST['rem_id_value']);
		 //$custom_variable = $_REQUEST['rem_id_value'].'#--|--#'.$_REQUEST['seller_id'];
		// $smarty->assign("custom_variable",$custom_variable);
	//	 print_r( $arr_fetch_users_details);
/**
 * Get required parameters from the web form for the request
 */
 
 
 
 //$objItem->delete_restored = 0;  // 0 for showing restored 1  means deleted by admin to items
//$objItem->locker_status=0;

//$objUser->show_deleted="No"; make it tomorrow
// approve condiation also
$objUser->approve_store  = 1; 
$objUser->user_type      = 3; 
$objResUser              = $objUser->selectUser();
//echo "sss=".mysql_num_rows($objResUser);
if(mysql_num_rows($objResUser)>0)
{
 while($UserRow = mysql_fetch_array($objResUser))
  {
      $usersId[]           = $UserRow['user_id_value'];
      $usersName_store[]   = $UserRow['store_name'].' ( '.$UserRow['username'].' ) ';
		//$usersStore[]  = $UserRow['store_name'];
  }
	//store_name
	$smarty->assign('usersId',$usersId);
	$smarty->assign('usersName_store',$usersName_store);
	//$smarty->assign('usersName',$usersList);
	//$smarty->assign('usersStore',$usersList);
	
 }
 //echo '<pre>';
// print_r($usersId);
 //echo '</pre>';
if($_POST['submit']=='Purchase Now' && $_SERVER['REQUEST_METHOD']=='POST' )
{   
    $objUser->id         			= $_POST['seller_id'];
	$result_user_sel     			= $objUser->selectUser();
	$num_user_sel        			= mysql_num_rows($result_user_sel);

        if($num_user_sel)
	   {
		$arr_user_values_sel 		= mysql_fetch_assoc($result_user_sel);
		$API_USERNAME	     		= $arr_user_values_sel['API_USERNAME'];
		$API_PASSWORD	     		= $arr_user_values_sel['API_PASSWORD'];
		$API_SIGNATURE	     		= $arr_user_values_sel['API_SIGNATURE'];
		$payment_type	     		= $arr_user_values_sel['payment_type'];
		$country_id	     		    = $arr_user_values_sel['country_id'];
		$paypal_merchant_id	     	= $arr_user_values_sel['paypal_merchant_id'];
			
		$_SESSION['payment_type']       = $payment_type;
		$_SESSION['API_USERNAME']       = $API_USERNAME;
		$_SESSION['API_PASSWORD']       = $API_PASSWORD;
		$_SESSION['API_SIGNATURE']      = $API_SIGNATURE;
		$_SESSION['Merchant_Id']        = $Merchant_Id;
		$_SESSION['paypal_merchant_id'] = $paypal_merchant_id;
	   }
	
	
	
           //// --------------start details----------------/////////
            $objCategory 		                      =  new Class_Category();
            $objCategory->country_id                  =  $country_id;
            $resCountry_pay                           =  $objCategory->selectCountry();
            $num_rowsCountry                          =  mysql_num_rows($resCountry_pay);
            if($num_rowsCountry>0)
              {
                $arr_fetch_code                       =  mysql_fetch_assoc($resCountry_pay);
                $current_code                         =  $arr_fetch_code['country_iso_code_2'];
              }

                //echo 'cur-code='.$current_code;
                //print_r($consCountrycodes);
                //$current_code='CA';
           // $value_of_country     = check_country($current_code,$consCountrycodes);
            $smarty->assign('value_of_country',$value_of_country);


////--------- end details--------------////
//echo 'payment_type='.$payment_type;
//echo '<br>';
//echo 'value_of_country='.$value_of_country;
//exit;
//	if($payment_type==1 && $value_of_country!=1)
//	{	
//		failure_msg("Service unavailable payment details are incomplete please try on other items.");
//		//redirect("my_account.php");
//	}

//if((($payment_type==0 || $payment_type=='') && ($API_USERNAME=='' || $API_PASSWORD=='' || $API_SIGNATURE=='' ) && $paypal_merchant_id=='') ||($payment_type==1 && $Merchant_Id==''))
        if($API_USERNAME=='' || $API_PASSWORD=='' || $API_SIGNATURE=='' )
        {
        failure_msg("Service unavailable payment details are incomplete please try on other stores!!. ");
        redirect("my_account.php");
        }

	require_once 'CallerService.php';

	
	$paymentType      = urlencode($_POST['paymentType']);
	$firstName        = urlencode($_POST['firstName']);
	$lastName         = urlencode($_POST['lastName']);
	$creditCardType   = urlencode($_POST['creditCardType']);
	$creditCardNumber = urlencode($_POST['creditCardNumber']);
	$expDateMonth     = urlencode($_POST['expDateMonth']);

	// Month must be padded with leading zero
	$padDateMonth     = str_pad($expDateMonth,2, '0', STR_PAD_LEFT);

	$expDateYear      = urlencode( $_POST['expDateYear']);
	$cvv2Number       = urlencode($_POST['cvv2Number']);
	$address1         = urlencode($_POST['address1']);
	$address2         = urlencode($_POST['address2']);
	$city             = urlencode($_POST['city']);
	$state            = urlencode($_POST['state']);
	$country          = urlencode($_POST['country']);
	$zip              = urlencode($_POST['zip']);
	$amount           = urlencode($_POST['amount']);
	//$currencyCode=urlencode($_POST['currency']);
	$currencyCode     = "USD";

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
      

		$objUser->id = $_SESSION['session_user_id'];
		$UserRes     = $objUser->selectUser();
		$UserArr     = mysql_fetch_array($UserRes);
		$UserArr['email'];
		$UserArr['username'];

		//******************************** Get email template ******************
	
		//*********************************** Assigning transaction details *******
		
		$smarty->assign("TRANSACTIONID",$resArray['TRANSACTIONID']);
		$smarty->assign("AMT",$resArray['AMT']);
		$smarty->assign("AVSCODE",$resArray['AVSCODE']);
		$smarty->assign("CVV2MATCH",$resArray['CVV2MATCH']);
		$smarty->assign('CURRENCY',CURRENCY);
		
		//*********************************** Storing Giftcard details database ***
		
		$objItem->buyerid		= rteSafe($_SESSION['session_user_id']);
		$objItem->name			= rteSafe($arr_fetch_users_details['name']);//$_SESSION['giftcardrecivername']
		//$_SESSION['gift_reciver_name'] = rteSafe($arr_fetch_users_details['name']);
		$objItem->email			= rteSafe($arr_fetch_users_details['email_id']);
	

		$objItem->paymentstatus 	    = 1;
		$objItem->TRANSACTIONID	        = rteSafe($resArray['TRANSACTIONID']);
		$objItem->paid_amount	        = rteSafe($resArray['AMT']);
		$_SESSION['gift_paid_amount']   = rteSafe($resArray['AMT']);
		$objItem->avs_code		        = rteSafe($resArray['AVSCODE']);
		$objItem->cvv2			        = rteSafe($resArray['CVV2MATCH']);
		
		$rstr = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
                $nstr = "";
                mt_srand ((double)microtime() * 1000000);
                while(strlen($nstr) < 15)
                  {
                          $random = mt_rand(0,(strlen($rstr)-1));
                          $nstr .= $rstr{$random};
                  }
        $objItem->seller_id          = $_POST['seller_id'];
		$objItem->check_condition    = 0;
		$objItem->cardnumber	     = $total_max_id_ofgiftcard.'_'.$nstr.'_'.$_SESSION['session_user_id'];
		$_SESSION['gift_cardnumber'] = $total_max_id_ofgiftcard.'_'.$nstr.'_'.$_SESSION['session_user_id'];
				
		$objDBReturn= $objItem->insertUpdategiftcard(); // giftcard updated
                 //   echo  $objDBReturn->nIdentity.' && '.$objDBReturn->nErrorCode;
		if($objDBReturn->nIdentity && $objDBReturn->nErrorCode==0)
		{			
			//  below is code for message update in  reminder  table
			$objUser->rem_id                    =  $_REQUEST['rem_id_value'];
		//	$objUser->message                   =  addslashes($_POST['message']);   
			$objUser->giftcard_id               =  $_SESSION['last_gift_id'] ;	
			$objUser->STATUS                    =  0;   
			$Reminder_details_value             =  $objUser->insertUpdate_giftcard_message();
		   //echo  $Reminder_details_value->nIdentity.' && '.$Reminder_details_value->nErrorCode;
			//exit;
		if($Reminder_details_value->nIdentity && $Reminder_details_value->nErrorCode==0)	    
		{
		        success_msg("Your gift card has been saved successfully...");
			header("Location:giftcard_reminder_message.php?rem_id_value=".$_REQUEST['rem_id_value'].'&seller_id='.$_REQUEST['seller_id']);
		}
		else
                {
			failure_msg("Error occured ...!Please try again");
					//header("Location:my_account.php");
    		}
	
			// end of code for message update in  reminder  table
	     }
	}
}
$smarty->assign('CURRENCY',CURRENCY);
$smarty->assign('site_page_title',SITE_HOME);
$smarty->assign('site_title',$site_title);
$smarty->display('events_gift_cards.tpl');
?>