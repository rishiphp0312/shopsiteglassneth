<?php
include ('include/common.inc');
include ("include/authentiateUserLogin.php");
include ('class/class.user.inc');

//create user class object
$objUser 		= new Class_User();

//submit form
//$email_id = 
if($_SERVER['REQUEST_METHOD']=='POST')
{
	//extract post variables array
	extract($_POST);
	
	$error_msg = "";
	
	    $objUser->email  		=    $Email;	
		$objUser->id				= $_SESSION['session_user_id'];
	    $objDBReturn = $objUser->validateExisringEmail();

	//if no errors found
	if($objUser->validateExisringEmail())
	{
		$error_msg = "Provided email address already in use...!";
		
	}
	if($error_msg=="")
	{
		
		$objDBReturn = $objUser->updateUserEmail();
		if($objDBReturn->nErrorCode==0)
		{
			$_SESSION['session_user_email_id']=  $Email;
			success_msg("Your email has been changed successfully!");
		}//end of if
		else
		{
			failure_msg("Error occured while updating your email, please try again later");
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
//$smarty->assign('site_page_title',SITE_CHANGE_PWD);
$smarty->assign('site_page_title','Change Email');
$smarty->assign('site_title',$site_title);
$smarty->display('change_email.tpl');
?>