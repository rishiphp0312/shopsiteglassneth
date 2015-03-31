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
	
	$smarty->assign('old_password',$row['password']);
}
	
//update password
if(isset($_POST['changePassword']))
{
		//Post Variable	
		extract($_POST);
		$objUser->password = md5($new_password);
		$objUser->admin_user_id = $_SESSION['session_admin_user_id'];
		
		if($hdnOldPassord!=md5($old_password))
		{
			failure_msg("Entred value for old password doest't matched with existing Old password");
			redirect('admin_home.php');
		}
		else if($new_password!=$confirm_new_password)
		{
			failure_msg("Confirm password should be matched with password entered above");
			redirect('admin_home.php');
		}
		else
		{
			$objDBReturn = $objUser->insertUpdateAdminUser();
		}
		//update forum user information
		//$objDBReturn2 = $objUser->updateForumAdminUser();
			
		if($objDBReturn->nErrorCode==0)
		{
			$update_mess = "Admin password updated successfully!";
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
$smarty->display('admin_change_password.tpl');	
?>