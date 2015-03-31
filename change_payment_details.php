<?php
include ('include/common.inc');
include ("include/authentiateUserLogin.php");
include ('class/class.user.inc');
include ('class/class.category.inc');
//include ('class/category.inc');

//create user class object
 $objUser 		    = new Class_User();
 $objCategory 		= new Class_Category();
 
 
 	/************************** Country *********************/
	//selects country details to make country drop down
	




$objUser->id = $_SESSION['session_user_id'];

$objDBReturn = $objUser->selectUser();
$num_rows    = mysql_num_rows($objDBReturn);
if($num_rows>0)
	 {
	 $arr_fetch_assoc     = mysql_fetch_assoc($objDBReturn);
	 $API_USERNAME        = $arr_fetch_assoc['API_USERNAME'];
	 $API_PASSWORD        = $arr_fetch_assoc['API_PASSWORD'];
	 $API_SIGNATURE       = $arr_fetch_assoc['API_SIGNATURE'];   
	 $Merchant_Id         = $arr_fetch_assoc['Merchant_Id']; 
	 $payment_type        = $arr_fetch_assoc['payment_type']; 
         $country_id          = $arr_fetch_assoc['country_id'];
	 $paypal_merchant_id  = $arr_fetch_assoc['paypal_merchant_id']; 
		 
	 $smarty->assign('paypal_merchant_id',$paypal_merchant_id);  
	 $smarty->assign('payment_type',$payment_type);  
	 $smarty->assign('API_USERNAME',$API_USERNAME);  
	 $smarty->assign('API_PASSWORD',$API_PASSWORD);  
	 $smarty->assign('API_SIGNATURE',$API_SIGNATURE);  
	 $smarty->assign('Merchant_Id',$Merchant_Id);  
 	}

    $objCategory->country_id              =  $country_id;
	$resCountry_pay                       =  $objCategory->selectCountry();
	$num_rowsCountry                      =  mysql_num_rows($resCountry_pay);
	if($num_rowsCountry>0)
	{
		$arr_fetch_code          		  = mysql_fetch_assoc($resCountry_pay);
		$current_code           		  = $arr_fetch_code['country_iso_code_2'];
	}
	
	//echo 'cur-code='.$current_code='C';
	//$current_code='CA';
    $value_of_country     = check_country($current_code,$consCountrycodes);
    $smarty->assign('value_of_country',$value_of_country);  

if($_SERVER['REQUEST_METHOD']=='POST')
{
	//extract post variables array
	extract($_POST);
	
	$error_msg = "";

	//if no errors found
	if($error_msg=="")
	{
		$objUser->API_SIGNATURE  		= $API_SIGNATURE;	
		$objUser->API_USERNAME  		= $API_USERNAME;	
		$objUser->API_PASSWORD  		= $API_PASSWORD;	
		$objUser->Merchant_Id  		    = $Merchant_Id;	
		$objUser->paypal_merchant_id    = $paypal_merchant_id;	
		
		if($choose_payment!='')
		$objUser->payment_type  		= $choose_payment;	
		else
		$objUser->payment_type  		= 0; // by default paypal	
	 // $choose_payment;	
	//exit;
		$objUser->id				    = $_SESSION['session_user_id'];
	
		$objDBReturn = $objUser->insertUpdateUser();
		if($objDBReturn->nErrorCode==0)
		{
			success_msg("Your payment details has been changed successfully!");
		}//end of if
		else
		{
			failure_msg("Error occured while updating your payment details, please try again later");
		}
		redirect('my_account.php');
	}//end of if
	
	//assign error messages
	$smarty->assign('error_msg',$error_msg);
}//end of if
//get user details
$objUser->id = $_SESSION['session_user_id'];
$UserRes = $objUser->getUserLoginDetails();
$UserArr = mysql_fetch_array($UserRes);
$smarty->assign("UserArr",$UserArr);

//display template
$smarty->assign('site_page_title',SITE_CHANGE_PAY);
$smarty->assign('site_title',$site_title);
$smarty->display('change_payment_details.tpl');
?>