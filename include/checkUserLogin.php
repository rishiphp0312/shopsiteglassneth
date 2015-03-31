<?php
//validate user login sesion here
//echo "URI=".$page = $_SERVER['REQUEST_URI'];
if(!isset($_SESSION['session_user_id'] ) && $_SESSION['session_user_id'] =="")
{
	$_SESSION["SESSION_POPUP_REQUEST_URL"] = $_SERVER['REQUEST_URI'];  
		
	//redirect user to login/registration page
	header("location: registration.php");
	exit;
}
?>