<?php
include ('include/common.inc');
include ('class/class.item.inc');
include ('class/class.user.inc');
include ("include/authentiateUserLogin.php");
/*
if($_SESSION['session_user_type']!="4")
{
	failure_msg("Please login as buyer for access LOCKER AREA ...! ");
	header("Location:my_account.php");
}*/
$objUser = new Class_User();

$name_after_domain     = $_SERVER['HTTP_HOST'];
$exp_name_after_domain = explode(".",$name_after_domain);
$add_this_name         = $exp_name_after_domain[1].'.'.$exp_name_after_domain[2];
//echo '<br>';
$add_this_username           = $exp_name_after_domain[1]; 

$objUser->username_dom       = $add_this_username;
$reslt_seluser               = $objUser->selectUser();
$num_reslt_seluser           = mysql_num_rows($reslt_seluser);
if($num_reslt_seluser>0)
{
$arr_reslt_seluser           = mysql_fetch_assoc($reslt_seluser);
$reslt_seluserId             = $arr_reslt_seluser['user_id_value'];
$_REQUEST['sellerid']              = $reslt_seluserId;

}

if($_SESSION['lockerseller']==$_REQUEST['sellerid'])
{
	redirect('view_locker.php?sellerid='.$_SESSION['lockerseller']);
}
else
{
	unset($_SESSION['lockerseller']);
}

//$objItem = new Class_User();

$smarty->assign("sellerid",$_REQUEST['sellerid']);


if($_REQUEST['sellerid']!="")
{
	$objUser->id = $_REQUEST['sellerid'];
	$UserRes = $objUser->getUserDetails();
	$UserArr = mysql_fetch_array($UserRes);
	
	$smarty->assign("f_name",$UserArr['first_name']);
 	$smarty->assign("l_name",$UserArr['last_name']);
	$smarty->assign("username",$UserArr['username']);
	$smarty->assign("store_name",$UserArr['store_name']);

	$smarty->assign("locker_last_date",$UserArr['locker_last_date']);
}
if(isset($_POST['submit']))
{
	extract($_POST);
	$objUser->seller_id = rteSafe($sellerid);
	$objUser->locker_password = rteSafe($loc_pass);
	$objUser->locker_last_date =rteSafe($locker_last_date);
	
	$objDBReturn = $objUser->getLockerUserDetails();

	$num=mysql_num_rows($objDBReturn);
	if($num>0)
	{
		$_SESSION['lockerseller']=$sellerid;
		success_msg("Your have been successfull entered to LOCKER AREA ...!!");
		redirect ('view_locker.php?sellerid='.$_SESSION['lockerseller']);
	}
	else
	{
		$error_msg="Please check your password and access code expiry date";
	}
	
	$smarty->assign('error_msg',$error_msg);
	
}

$smarty->assign('site_page_title','Nethaat: Locker Area');
$smarty->assign('site_title',$site_title);
$smarty->display('lockerform.tpl');

?>
