<?php
include ('include/common.inc');

?>

<?php
/******************  unset all session for Kauai Property users  ********************************/
if(isset($_SESSION['session_user_id']))
{
	//unset session
	$expire=time()+60*60*24*30;
    //setcookie("cook_babys", "c", 0);
    //setcookie("cook_baby", "c", 0);
	//$_COOKIE['cook_babys']='';
	//unset($_COOKIE['cook_baby']);
	
	unset($_SESSION["session_hatting_items_url"]);
	unset($_SESSION['session_user_id']);
	unset($_SESSION['session_user_name']);
	unset($_SESSION['session_user_type']);
	unset($_SESSION['session_last_login']);
	unset($_SESSION["SESSION_REQUEST_URL"]);
	unset($_COOKIE["cook_session_user_id"]);
	unset($_COOKIE["cook_session_user_name"]);
	unset($_COOKIE["cook_session_user_email_id"]);
	
    setcookie("cook_session_user_id", "", time()-3600);
	setcookie("cook_session_user_name", "", time()-3600);
	setcookie("cook_session_user_email_id", "", time()-3600);
     //sesstion_destroy();
    //set user redirect page here for both users
	$page = "login.php?logout=yes";

    //destroy session if admin is not logged in
    if(!isset($_SESSION['session_admin_user_id']) && $_SESSION['session_admin_user_id']=="")
    {
		session_unset();
        session_destroy();
    }

    //redirect user
    header('location:'.$page);
	exit();
}
else 
{
	session_unset();
	header('location:index.php');
	exit();
}
?>
