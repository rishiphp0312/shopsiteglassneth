<?php
include ("common_includes.php");
include ("../include/adminsession.php.inc");
include ("../class/class.user.inc");

//create user class object
$objUser		= new Class_User();

//assign static labels and heading
$smarty->assign("form_heading","User Profile");
$smarty->assign("return_link","admin_users.php");


//keep user id and user type in session
if(isset($_GET['user_id']) && $_GET['user_id']!="")
{
	//unset session
	unset($_SESSION["view_user_id"]);
	unset($_SESSION["view_user_type"]);
	//now put values in session
	$_SESSION["view_user_id"]   = trim($_GET['user_id']);
	$_SESSION["view_user_type"] = trim($_GET['user_type']);
}	
	
//selects user details
if(isset($_SESSION["view_user_id"]) && $_SESSION["view_user_id"]!="")
{
	$objUser->user_id = $_SESSION["view_user_id"];
	$resUser = $objUser->selectUser();
	$resUserRow = mysql_fetch_array($resUser);
	
	$smarty->assign('user',$resUserRow);
}

			
//display template and title
$smarty->assign('site_page_title',ADMIN_COMMON_TITLE);
$smarty->assign('site_title',$site_title);
$smarty->display('admin_view_user_details.tpl');	
?>