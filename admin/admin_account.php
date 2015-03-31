<?php
include ("common_includes.php");
include ("../class/class.user.inc");
include ("../include/adminsession.php.inc");//check admin session

//create object of user class
$objUser = new Class_User();

if($_SESSION['session_admin_user_id'])
{
	$objUser->admin_user_id = $_SESSION['session_admin_user_id'];
	$userRes = $objUser->getAdminUserLoginDetails();
	$row = mysql_fetch_array($userRes);
	
	$smarty->assign('admin_name',$row['admin_name']);
	$smarty->assign('admin_user_name',$row['admin_user_name']);
	$smarty->assign('admin_email',$row['admin_email']);
}
//print_r($_SESSION);	
//update password
if($_SERVER['REQUEST_METHOD']=='POST')
{
		//Post Variable	
		extract($_POST);
		$objUser->admin_name		= $admin_name;
		$objUser->admin_user_name	= $admin_user_name;
		$objUser->admin_email		= $admin_email;
		$objUser->admin_user_id		= $_SESSION['session_admin_user_id'];
		
		$objDBReturn = $objUser->insertUpdateAdminUser();
		
		//update forum user information
		//$objDBReturn2 = $objUser->updateForumAdminUser();
		
		if($objDBReturn->nErrorCode==0)
		{
			$update_mess = "Admin account information has been updated successfully!";
			success_msg($update_mess);
			//$smarty->assign('update_mess',$update_mess);
		}
		else
		{
			failure_msg("Error occured, please try again later");
		}
		redirect('admin_home.php');
}

//display template and title
$smarty->assign('site_page_title',ADMIN_ACCOUNT);
$smarty->assign('site_title',$site_title);
$smarty->display('admin_account.tpl');	
?>