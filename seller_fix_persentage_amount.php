<?php
include ('include/common.inc');
include ("include/authentiateUserLogin.php");
include ('class/class.user.inc');

$objUser = new Class_User();
if(isset($_REQUEST['titleid'])&& $_REQUEST['titleid']!="")
{
	$objUser->tblid = $_REQUEST['titleid'];
	$UserRes = $objUser->getcustomitem();
	$num=mysql_num_rows($UserRes);
	$UserArr = mysql_fetch_array($UserRes);

	$smarty->assign("title",$UserArr['title']);
	$smarty->assign("price",$UserArr['price']);
 	$smarty->assign("quantity",$UserArr['quantity']);
	$smarty->assign("deadline",$UserArr['deadline']);
	$smarty->assign("titleid",$_REQUEST['titleid']);
	$smarty->assign("num",$num);
	
}

if(isset($_POST['submit'])&& $_POST['submit']!="")
{
print_r($_POST);
	$objUser->reqid	= rteSafe($_POST['titleid']);	
	$objUser->agreestatus	= 1;
	$objUser->adpersantage	= rteSafe($_POST['adpersantage']);
	$objDBReturn = $objUser->insertUpdatecustomrequest();
	if($objDBReturn->nIdentity==0 && $objDBReturn->nErrorCode==0)
	{
		success_msg("Your request for custom item has been successfull");
		header("Location:seller_custom_request.php");
	}
	else
	{
		failure_msg("Error occured ...!Please try again");
	}
	$smarty->assign('error_msg',$error_msg);
}
$smarty->assign('site_page_title',SITE_HOME);
$smarty->assign('site_title',$site_title);
$smarty->display('seller_fix_persentage_amount.tpl');
?>