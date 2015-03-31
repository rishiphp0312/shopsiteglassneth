<?php
include ("common_includes.php");
include ("../include/adminsession.php.inc");
include ("../class/class.user.inc");

//create object of User class
$objUser = new Class_User();

if(isset($_GET['user_id']) && $_GET['user_id']!="")
{
	$objUser->id = trim($_GET['user_id']);
	$resUser = $objUser->selectUser();
	$resUserRow = mysql_fetch_array($resUser);
	
    $userID		= $resUserRow['id'];
    $userName	= $resUserRow['FirstName'].' '.$userArr['LastName'];
    $userEmail 	= $resUserRow['Email'];
    //$last_login = $resUserRow['last_login'];
    if(!empty($resUserRow['last_login']) && $resUserRow['last_login']!="" && $resUserRow['last_login']!='0000-00-00 00:00:00')
	{
		$last_login = $resUserRow['last_login'];
	}
	else
	{
		$last_login = date('Y-m-d H:i:s');
	}

    //unset all sessions
    unset($_SESSION['session_user_id'],$_SESSION['session_user_name'],$_SESSION['session_user_email'],$_SESSION['session_user_type'],$_SESSION['session_last_login']);

    //set login session
    $_SESSION['session_user_id'] 		= $userID;
    $_SESSION['session_user_name']		= $userName;
    $_SESSION['session_user_email']		= $userEmail;
    $_SESSION['session_last_login']		= date('D jS M Y h:i A', strtotime($last_login));  //Mon 8th Aug 2009 03:12 PM
    
    //redirect admin to user profile section
    $URL = $baseUrl."my_account.php";
	redirect($URL);
}
?>
