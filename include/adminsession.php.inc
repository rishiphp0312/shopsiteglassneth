<?php
ob_start();
//check admin session
if($_SESSION['session_admin_user_id'] == '')
{
	//get referer to redirect user to that particular page
	$_SESSION["SESSION_REQUEST_URL"] = $_SERVER['REQUEST_URI'];
	
	//redirect
	header('Location:index.php');
    exit;
}
?>
