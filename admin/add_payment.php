<?php
include ("common_includes.php");
include ("../class/class.user.inc");
include ("../include/adminsession.php.inc");//check admin session

//create object of user class
$objUser = new Class_User();
//echo 'session_admin_user_id=='.$_SESSION['session_admin_user_id'];
// start new session




// end new session
if($_SESSION['session_admin_user_id'])
{
	$objUser->admin_user_id = $_SESSION['session_admin_user_id'];
	$userRes = $objUser->getAdminUserLoginDetails();
	$row = mysql_fetch_array($userRes);
	
	$smarty->assign('API_USERNAME',$row['API_USERNAME']);
	$smarty->assign('API_PASSWORD',$row['API_PASSWORD']);
	$smarty->assign('API_SIGNATURE',$row['API_SIGNATURE']);
	$smarty->assign('Merchant_Id',$row['Merchant_Id']);
        $smarty->assign('paypal_merchant_id',$row['paypal_merchant_id']);
	
	$smarty->assign('admin_payment_type',$row['payment_type']);
	$smarty->assign('admin_name',$row['admin_name']);
	$smarty->assign('admin_user_name',$row['admin_user_name']);
	$smarty->assign('admin_email',$row['admin_email']);
}
//echo 'paypal=='.$row['paypal_merchant_id'];
//print_r($_SESSION);	
//update password
if($_SERVER['REQUEST_METHOD']=='POST')
{
		//Post Variable	
		extract($_POST);
		
		$objUser->payment_type          = trim($payment_type,'');
		$objUser->API_USERNAME		= trim($API_USERNAME,'');
		$objUser->API_PASSWORD	        = trim($API_PASSWORD,'');
		$objUser->API_SIGNATURE		= trim($API_SIGNATURE,'');
		$objUser->Merchant_Id	        = trim($Merchant_Id,'');
                $objUser->paypal_merchant_id	= trim($paypal_merchant_id,'');
		$objUser->admin_user_id		= $_SESSION['session_admin_user_id'];
		$objDBReturn                    = $objUser->insertUpdateAdminUser();
		
		//update forum user information
		
		if($objDBReturn->nErrorCode==0)
		{
			$update_mess = "Admin payment details has been updated successfully!";
			success_msg($update_mess);
		}
		else
		{
			failure_msg("Error occured, please try again later");
		}
		redirect('add_payment.php');
}

//display template and title
$smarty->assign('site_page_title',ADMIN_ACCOUNT);
$smarty->assign('site_title',$site_title);
$smarty->display('add_payment.tpl');	
?>