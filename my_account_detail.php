<?php
include ('include/common.inc');
include ("include/authentiateUserLogin.php");
include ('class/class.user.inc');

//create user class object
$objUser 		= new Class_User();
//print_r($_SESSION);
//submit form
//if($_POST['update_profile'])
if($_SERVER['REQUEST_METHOD']=='POST')
{
	
}//end of if

//get user details
/*
$objUser->id = $_SESSION['session_user_id'];
$UserRes = $objUser->getUserLoginDetails();
$UserArr = mysql_fetch_array($UserRes);

//assign user details
$smarty->assign("UserArr",$UserArr);
*/

//display template
$smarty->assign('site_page_title','Nethaat :  My Account Detail');
//$smarty->assign('site_page_title',SITE_MY_ACCOUNT);
$smarty->assign('site_title',$site_title);
$smarty->display('my_account_detail.tpl');
?>
