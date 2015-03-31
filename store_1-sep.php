<?php
include ('include/common.inc');
include ("include/authentiateUserLogin.php");
include ('class/class.user.inc');
include ('include/country_state_cat.php');

//create user class object
$objUser 	= new Class_User();
//print_r($_SESSION);
if($_SESSION['session_user_type']!=3)
redirect("my_account.php");

//submit form
if($_SERVER['REQUEST_METHOD']=='POST')
{/*
	//extract post variables array
	extract($_POST);
	$objUser->id   				= $_SESSION['session_user_id'];	
	$objUser->first_name  		= rteSafe($first_name);
	$objUser->last_name  		= rteSafe($last_name);
	$objUser->address1			= rteSafe($address1);
	$objUser->address2			= rteSafe($address2);
	$objUser->city				= rteSafe($city);
	$objUser->zipcode		= rteSafe($zipcode);
	$objUser->state			= rteSafe($state);
	$objUser->country_id		= $country_id;
	$objUser->phone1		= rteSafe($phone1);
	$objUser->phone2		= rteSafe($phone2);
	$objUser->paypal_email		= rteSafe($paypal_email);
	$objUser->company_name		= rteSafe($company_name);
	$objUser->company_address	= rteSafe($company_address);
	$objUser->company_phone		= rteSafe($company_phone);
	$objUser->store_name		= rteSafe($store_name);
	$objUser->company_desc		= rteSafe($company_desc);
        $objUser->payment_type          = 0; // by default paypal
        $objUser->API_USERNAME          = rteSafe($API_USERNAME);
	$objUser->API_PASSWORD          = rteSafe($API_PASSWORD);
	$objUser->API_SIGNATURE         = rteSafe($API_SIGNATURE);
        $objUser->paypal_merchant_id    = rteSafe($paypal_merchant_id);



	$error_msg = "";
	
	//check existing paypal email address
	if($objUser->validateExisringPaypalEmail())
	{
		$error_msg = "Provided paypal email address already in use...!";
	}
	
	//if no errors found
	if($error_msg=="")
	{
		$objDBReturn = $objUser->insertUpdateUser();
		//echo "ssssss=".$objDBReturn->nAffectedRows." ===sssss";die;
		if($objDBReturn->nErrorCode==0)
		{
			success_msg("Congratulations! <b>".$_SESSION['session_user_name']."</b> your store information has been saved successfully!");
		}//end of if
		else
		{
			failure_msg("Error occured while submitting your business details. Please try again later");
		}
		redirect("my_account.php");
	}//end of if
	
	//assign error messages
	$smarty->assign('error_msg',$error_msg);
	
	//assign back all post variables
	$smarty->assign('first_name',$first_name);
	$smarty->assign('last_name',$last_name);
	$smarty->assign('address1',$address1);
	$smarty->assign('address2',$address2);
	$smarty->assign('city',$city);
	$smarty->assign('zipcode',$zipcode);
	$smarty->assign('state',$state);
	$smarty->assign('country_id',$country_id);
	$smarty->assign('phone1',$phone1);
	$smarty->assign('phone2',$phone2);
	$smarty->assign('paypal_email',$paypal_email);
	$smarty->assign('company_name',$company_name);
	$smarty->assign('company_address',$company_address);
	$smarty->assign('company_phone',$company_phone);
	$smarty->assign('store_name',$store_name);
	$smarty->assign('company_desc',$company_desc);
*/}//end of if

//check user session to get dtails
if(isset($_SESSION['session_user_id']) && $_SESSION['session_user_id'])
{/*
	$objUser->id   	 = $_SESSION['session_user_id'];	
	$userRes 	 = $objUser->getUserLoginDetails();
	$userArr	 = mysql_fetch_array($userRes);
	
	$API_USERNAME    = $userArr['API_USERNAME'];
	$API_PASSWORD    = $userArr['API_PASSWORD'];
	$API_SIGNATURE   = $userArr['API_SIGNATURE'];   
	$Merchant_Id     = $userArr['Merchant_Id']; 
	$payment_type    = $userArr['payment_type']; 
	//$payment_type    = $userArr['country_id'];
	$user_id         = $userArr['id'];
        $paypal_merchant_id  = $userArr['paypal_merchant_id'];

	 
	$smarty->assign('paypal_merchant_id',$paypal_merchant_id);
	$smarty->assign('payment_type',$payment_type);  
	$smarty->assign('API_USERNAME',$API_USERNAME);  
	$smarty->assign('API_PASSWORD',$API_PASSWORD);  
	$smarty->assign('API_SIGNATURE',$API_SIGNATURE);  
	$smarty->assign('Merchant_Id',$Merchant_Id);  
		
	$smarty->assign('first_name',$userArr['first_name']);
	$smarty->assign('last_name',$userArr['last_name']);
	$smarty->assign('address1',$userArr['address1']);
	$smarty->assign('address2',$userArr['address2']);
	$smarty->assign('city',$userArr['city']);
	$smarty->assign('zipcode',$userArr['zipcode']);
	$smarty->assign('state',$userArr['state']);
	$smarty->assign('country_id',$userArr['country_id']);
	$smarty->assign('phone1',$userArr['phone1']);
	$smarty->assign('phone2',$userArr['phone2']);
	$smarty->assign('paypal_email',$userArr['paypal_email']);
	$smarty->assign('company_name',$userArr['company_name']);
	$smarty->assign('company_address',$userArr['company_address']);
	$smarty->assign('company_phone',$userArr['company_phone']);
	$smarty->assign('store_name',$userArr['store_name']);
	$smarty->assign('company_desc',$userArr['company_desc']);
  
 */
} // start payment detail
	 
        $objCategory->country_id              =  $country_id;
	$resCountry_pay                       =  $objCategory->selectCountry();
	$num_rowsCountry                      =  mysql_num_rows($resCountry_pay);
	if($num_rowsCountry>0)
	{
		$arr_fetch_code               = mysql_fetch_assoc($resCountry_pay);
		$current_code                 = $arr_fetch_code['country_iso_code_2'];
	}
	
	//echo 'cur-code='.$current_code='C';
	//$current_code='CA';
    $value_of_country     = check_country($current_code,$consCountrycodes);
    $smarty->assign('value_of_country',$value_of_country);  

	 
	 // end payment details
 

//assign page title and display template
$smarty->assign('site_page_title',SITE_HOME);
$smarty->assign('site_title',$site_title);
$smarty->display('store.tpl');
?>