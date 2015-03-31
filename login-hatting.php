<?php
include ('include/common.inc');
include ('class/class.user.inc');
//include ("include/authentiateUserLogin.php");
//create user class object
$objUser 	= new Class_User();

//if user is already logged in then redirect user to myaccount page
if(isset($_SESSION['session_user_id']) && $_SESSION['session_user_id']!="")
{
	header("location:hatting-items.php");
}

//if user is logout from site
if(isset($_GET['logout']) && $_GET['logout']=="yes")
{
	$update_msg = "Thanks for using Nethaat! You have been successfully logged out.";
}
//if unathorised access
if(isset($_GET['logout']) && $_GET['logout']=="no")
{
	//$error_warning_msg = "Please login to enter the site.";
	//failure_msg("Please login to enter the site");
	
	$URL = $baseUrl.'login-hatting.php';
	redirect($URL);
}


//submit form
if($_SERVER['REQUEST_METHOD']=='POST')
{
	//extract post variables array
	extract($_POST);

	$username  	= rteSafe($username);
	$password   = rteSafe($password);

	$objUser->username  = $username;
	$objUser->password  = md5($password);


	$error_msg = "";//hold error message
	
	$objUser->deleted_user=0;
	$userRes	= $objUser->getUserLoginDetails();
	if(mysql_num_rows($userRes)>0)
	{

		//get user details
		$userArr	= mysql_fetch_array($userRes);

		$userID		= $userArr['id'];
		$userName	= $userArr['username'];
		$isactive	= $userArr['status'];
		$userType	= $userArr['user_type'];
		$user_email_id = $userArr['email'];
		$user_password = $userArr['password'];
		$user_address = $userArr['address1'];
		$isdeleted	= $userArr['isdeleted'];

		if(!empty($userArr['last_login']) && $userArr['last_login']!="" && $userArr['last_login']!='0000-00-00 00:00:00')
		{
			$last_login = $userArr['last_login'];
		}
		else
		{
			$last_login = date('Y-m-d H:i:s');
		}

		//check user account status, if account is active then proceed
		if($isactive!=1)
		{
			failure_msg("Login failed. Your account is not active. Please check your email to activate your account");
			$URL = $baseUrl.'login-hatting.php';
			redirect($URL);
		}
		if($isdeleted==1)
		{//exit;
			failure_msg("Login failed. Your account has been deleted. Please contact System Administrator");
				$URL = $baseUrl.'login-hatting.php';
			redirect($URL);
		}

		if($error_msg=="")
		{
			//if remember me is checked then set cookies
			if($rememberMe==1)
			{
				// Check to see if the 'remember me' box was ticked to remember the user
				$time = time();
				setcookie("Nethaat[username]", urlencode($username), $time + 86400*30); // Sets the cookie username
				setcookie("Nethaat[password]", urlencode($password), $time + 86400*30); // Sets the cookie password
			}
			//delete cookies
			else
			{
				$time = time();
				setcookie("Nethaat[username]", "", $time - 86400*30); // delete the cookie username
				setcookie("Nethaat[password]", "", $time - 86400*30); // delete the cookie password
			}
			//unset all sessions
			unset($_SESSION['session_user_id'],$_SESSION['session_user_name'],
				$_SESSION['session_user_type'],$_SESSION['session_last_login'],$_SESSION['session_user_email']);

			//set login session
			$_SESSION['session_user_id'] 		= $userID;
			$_SESSION['session_user_name']		= $userName;
			$_SESSION['session_user_email_id']		= $user_email_id;
			$_SESSION['session_user_address']		= $user_address;
			
			
			
			
			


		//	$_SESSION['session_user_password']	= $user_password;
			$_SESSION['session_user_type'] 		= $userType;
			$_SESSION['session_last_login']		= date('D jS M Y h:i A', strtotime($last_login));  //Mon 8th Aug 2009 03:12 PM
			
				ini_set('session.cookie_domain', '.nethaat.com');
			setcookie("phpSESSID", session_id(), 0, "/", ".nethaat.com"); 
			setcookie("cook_session_user_id",$_SESSION['session_user_id'], 0, "/", ".nethaat.com"); 
			setcookie("cook_session_user_name",$_SESSION['session_user_name'], 0, "/", ".nethaat.com"); 
			setcookie("cook_session_user_email_id",$_SESSION['session_user_email_id'], 0, "/", ".nethaat.com"); 

			//log user login dates to DB table
			$objUser->user_id = $userID;
			$objUser->loggedUserLoginDates();

			//if uer comes from any secure pages
			if(isset($_SESSION["SESSION_REQUEST_URL"]) && $_SESSION["SESSION_REQUEST_URL"]!="")
			{
				$URL = str_replace('\r', '', str_replace('\n', '', $_SESSION['SESSION_REQUEST_URL']));
				unset($_SESSION['SESSION_REQUEST_URL']);
			}
			//redirect user to profile page
			else
			{
				$URL = $baseUrl."my_account.php";
				//$URL = $baseUrl."dashboard.php";

			}
			if(isset($_SESSION['session_hatting_items_url']) && $_SESSION['session_user_id']!="")
			{   $URL=	 $_SESSION["session_hatting_items_url"];
				unset($_SESSION["session_hatting_items_url"]);
				header("location: $ses_req_url");
				header("location:hatting-items.php");
			}
				header("location:hatting-items.php");
		}//end of if
	}//end of if
	else
	{
		failure_msg("Invalid Login. Please check your Username and Password");
		$URL = $baseUrl."login-hatting.php";
		redirect($URL);
	}
}//end of if

//assign error messages
$smarty->assign('update_msg',$update_msg);
$smarty->assign('error_msg',$error_msg);
$smarty->assign('error_warning_msg',$error_warning_msg);


//dispaly template and page title
$smarty->assign('site_page_title','Nethaat: '.SITE_LOGIN);
$smarty->assign('site_title',$site_title);
$smarty->display("login-hatting.tpl");
?>
