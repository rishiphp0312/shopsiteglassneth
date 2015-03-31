<?php
include ('include/common.inc');
include ('class/class.cms.inc');
include ('class/class.mail.inc');
include ('class/class.user.inc');
include ('include/sendEmailClass.php');
include ('captcha/php-captcha.php');

//create user class object
$objUser = new Class_User();



if(isset($_SESSION['session_user_id'])&& $_SESSION['session_user_id']!="")
{
	$objUser->id = $_SESSION['session_user_id'];
	$UserRes = $objUser->getUserDetails();
	$UserArr = mysql_fetch_array($UserRes);
	
	$smarty->assign("v_welcome",$UserArr['v_welcome']);
	$smarty->assign("v_payment",$UserArr['v_payment']);
	$smarty->assign("v_shipping",$UserArr['v_shipping']);
	$smarty->assign("v_refund_exchange",$UserArr['v_refund_exchange']);
	$smarty->assign("v_additional_info",$UserArr['v_additional_info']);

}

if(isset($_POST['hid']))
{
	if($_SERVER['REQUEST_METHOD']=='POST')
	{
		extract($_POST);
		
		$objUser->id			= $_SESSION['session_user_id'];
		$objUser->payment			= rteSafe($payment);
		$objUser->shipping			= rteSafe($shipping);
		$objUser->refund			= rteSafe($refund);
		$objUser->additional		= rteSafe($additional);
		$objUser->welcome			= rteSafe($welcome);
		//$objUser->Usershoppolicy();
		
		//assign post values
		/*$smarty->assign("payment",$payment);
		$smarty->assign("shipping",$shipping);
		$smarty->assign("refund",$refund);
		$smarty->assign("additional",$additional);
		$smarty->assign("welcome",$welcome);
		*/
	if($error_msg=="")
	{
	    
	$objDBReturn = $objUser->getUserDetailsupdate();
	
		if($objDBReturn->nErrorCode==0)
		{
			success_msg("Your add was successfull");
			header("Location:shop-policies.php");
		
		}
		else
		{
			$error_msg = "Error occured ...!Please try again";
		}
}
}
$smarty->assign("error_msg",$error_msg);
}
//assign error/update message
$smarty->assign("error_msg",$error_msg);
$smarty->assign("update_msg",$update_msg);

//display template
$smarty->assign('site_page_title','Sell an Item');
$smarty->assign('site_title',$site_title);
$smarty->display('shop-policies.tpl');
?>
