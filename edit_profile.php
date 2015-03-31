<?php
include ('include/common.inc');
include ("include/authentiateUserLogin.php");
include ('class/class.user.inc');

//create user class object
$objUser 		= new Class_User();
//print_r($_SESSION);
//submit form
if($_SERVER['REQUEST_METHOD']=='POST')
{
	//extract post variables array
	extract($_POST);
	
	$objUser->FirstName   		= rteSafe($FirstName);	
	$objUser->LastName  		= rteSafe($LastName);
	$objUser->Email  			= rteSafe($Email);
	//$objUser->Password  		= rteSafe($Password);
	$objUser->Phone				= rteSafe($Phone);
	$objUser->street_no			= rteSafe($street_no);
	$objUser->street_name		= rteSafe($street_name);
	$objUser->city				= rteSafe($city);
	$objUser->state				= rteSafe($state);
	$objUser->Zip				= rteSafe($Zip);
	$objUser->EmailAlert		= $EmailAlert;
	$objUser->nLetter			= $nLetter;
	
	$objUser->id				= $_SESSION['session_user_id'];
	
	$error_msg = "";
	
	//check existing email
	if($objUser->validateExisringEmail())
	{
		failure_msg("Provided email address already in use");
		redirect('my_account.php');
	}
	//if no errors found
	if($error_msg=="")
	{
		$objDBReturn = $objUser->insertUpdateUser();
		if($objDBReturn->nErrorCode==0)
		{
			//update forum user information
			$objDBReturn2 = $objUser->updateForumUserInfo();
			success_msg("Your profile has been updated successfully!");
			redirect('my_account.php');
		}//end of if
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
$smarty->assign('site_page_title',SITE_EDIT_PROFILE);
$smarty->assign('site_title',$site_title);
$smarty->display('edit_profile.tpl');
?>