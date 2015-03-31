<?php
session_start();
/******************  unset all session ********************************/
//if session exits
if(isset($_SESSION['session_admin_user_id']))
{
	//unset all session
	unset($_SESSION['session_admin_user_id']);
	unset($_SESSION['session_admin_username']);
	unset($_SESSION['session_admin_name']);
	unset($_SESSION['login_time']);
	unset($_SESSION['login_date']);
	
	//destroy session
	session_destroy();
	
	
	//redirect to wordpress blog to logout admin from blogs as well, from there user will redirect tosite admin login page
	//redirect user to blog to logout blog admin session
	
	//header("location:../blog/wp-login.php?action=logout&_wpnonce=37c0b22da8");
header("location:index.php?logout=yes");
	exit;
}
else 
{
	header("location:index.php?logout=no");
	exit;
}
?>