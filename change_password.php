<?php
include ('include/common.inc');
include ("include/authentiateUserLogin.php");
include ('class/class.user.inc');

//create user class object
$objUser 		= new Class_User();

//submit form
if($_SERVER['REQUEST_METHOD']=='POST')
{
	//extract post variables array
	extract($_POST);
	
	$error_msg = "";
	if($existing_password != md5($OldPassword))
	{
		$error_msg = "Entered Old Password is not correct";
	}
	
	//if no errors found
	if($error_msg=="")
	{
		$objUser->password  		= md5(rteSafe($Password));	
		$objUser->id				= $_SESSION['session_user_id'];
	
		$objDBReturn = $objUser->updateUserPassword();
		if($objDBReturn->nErrorCode==0)
		{
			success_msg("Your password has been changed successfully!");
		}//end of if
		else
		{
			failure_msg("Error occured while updating your password, please try again later");
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
$smarty->assign('site_page_title',SITE_CHANGE_PWD);
$smarty->assign('site_title',$site_title);
$smarty->display('change_password.tpl');
?>