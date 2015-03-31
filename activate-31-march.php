<?php
include ('include/common.inc');
include ('class/class.user.inc');
include ('class/crypto_class.php');
include ('class/class.mail.inc');
include ('include/sendEmailClass.php');

//create user class object
$objUser 	= new Class_User();

//create mail class object
$objMail 	= new Class_Mail();

// Creating object of SendEmailClass
$emailObj 	= new SendEmailClass;

$activeCode = $_SERVER['QUERY_STRING'];

//get parameters to activate user account
if(isset($activeCode) && $activeCode!="")
{
	//echo "sssss=".$enc = encryptStr("user=mahipal&id=1");
	$activeCode = decryptStr($activeCode);

	$query_string = split("&", $activeCode);

	$param1 = split("=", $query_string[0]);
	$param2 = split("=", $query_string[1]);

	$username 	= $param1[1];
	$id 		= $param2[1];
	
	//echo "username=".$username." id=".$id;
	
	//validate username and ID
	$objUser->id 		= $id;
	$objUser->username  = $username;
	$userRes = $objUser->getUserLoginDetails();
	if(mysql_num_rows($userRes) > 0)
	{
		$userArr = mysql_fetch_array($userRes);
		
		//check user status first
		if($userArr['status']==0)
		{
			//activate user account
			$objUser->status = 1;
			$objUser->changeUserStatus();
			//set success welcome message
			success_msg("Congratulations! <b>".$username."</b> your account has been activated successfully!");
			
			//Login automatically and redirect user as per their TYPE
			if(!empty($userArr['last_login']) && $userArr['last_login']!="" && $userArr['last_login']!='0000-00-00 00:00:00')
			{
				$last_login = $userArr['last_login'];
			}
			else
			{
				$last_login = date('Y-m-d H:i:s');
			}
			
			//unset all sessions
			unset($_SESSION['session_user_id'], $_SESSION['session_user_name'], $_SESSION['session_user_type'], $_SESSION['session_last_login']); 
			
			//set login session
			$_SESSION['session_user_id'] 		= $userArr['id'];
			$_SESSION['session_user_name']		= $userArr['username'];
			$_SESSION['session_user_type'] 		= $userArr['user_type'];
			$_SESSION['session_last_login']		= date('D jS M Y h:i A', strtotime($last_login));  //Mon 8th Aug 2009 03:12 PM
			
			//log user login dates to DB table
			$objUser->user_id = $userArr['id'];
			$objUser->loggedUserLoginDates();
		
			//check user type first
			if($userArr['user_type']==4) //Buyer
			{
				redirect("my_account.php");
			}
			//if user is Seller then redirect user to Seller info page to fill other details
			else
			{
				//unset($_SESSION["seller_id"]);
				//$_SESSION["seller_id"] = $id;
				redirect("store.php");
			}
		}
		else
		{
			echo "This user account has been already activated";
			redirect("my_account.php");
		}
	}
	else
	{
		failure_msg("Account activation link is not valid.");
		redirect("index.php");
	}
}
else
{
	failure_msg("Access is denied, please register first to access our services");
	redirect("index.php");
}
?>