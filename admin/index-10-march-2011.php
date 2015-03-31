<?php
include ("common_includes.php");
include ("../class/class.user.inc");

//create object of user class
$objUser = new Class_User();

//if login session exists
if($_SESSION['session_admin_user_id'] != '') 
{
	header('Location:admin_home.php');
    exit;
}

//if submit form
if($_SERVER['REQUEST_METHOD']=="POST")
{
	$error_msg = "";
	
	//post variables
	extract($_POST);
	$objUser->username = rteSafe($login_username);
	$objUser->password = rteSafe($login_password);
	  
	$userRes	=	$objUser->getAdminUserLoginDetails();
	$chk_rows	=	mysql_num_rows($userRes);
	
	if($chk_rows>0)
	{
		$user_data = mysql_fetch_object($userRes);
		//check user is active or not
		if($user_data->isactive != '1')
		{
			$error_msg = "Your account is not active.";
		}
		//check case sensitive username
		if($login_username != $user_data->admin_user_name)
		{
			$error_msg = "Username is not correct.";
		}
		//check case sensitive password
		if($login_password != $user_data->password)
		{
			$error_msg = "Password is not correct.";
		}
		if($error_msg == "")
		{
			//unset session first
			unset($_SESSION['session_admin_user_id'],$_SESSION['session_admin_username'],$_SESSION['session_admin_name'],$_SESSION["login_time"],$_SESSION["login_date"]);
			
			//set new user session
			$_SESSION['session_admin_user_id']	=	$user_data->admin_user_id;
			$_SESSION['session_admin_username']	=	$user_data->admin_user_name;
			$_SESSION['session_admin_name']		=	$user_data->admin_name;
			$_SESSION["login_time"]				=	date('h:i:s A');
			$_SESSION["login_date"]				=	date('d:m:Y');	
			
			//if user comes from any secure pages
			if(isset($_SESSION["SESSION_REQUEST_URL"]) && $_SESSION["SESSION_REQUEST_URL"]!="")
			{
				$req_url = $_SESSION["SESSION_REQUEST_URL"];
				unset($_SESSION["SESSION_REQUEST_URL"]);
				header("location:".$req_url);
				exit;
			}
			else 
			{
				header("location:admin_home.php");
				exit;
			}
		}	
	}
	else
	{
			$error_msg = "<b>Invalid Login:</b> Username or Password is not correct";
	}
}

$smarty->assign('error_msg',$error_msg);

//display template and title
$smarty->assign('site_page_title',ADMIN_LOGIN);
$smarty->assign('site_title',$site_title);
$smarty->display('admin_login.tpl');	
?>