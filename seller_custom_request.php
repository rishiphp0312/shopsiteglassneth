<?php
include ('include/common.inc');
include ("include/authentiateUserLogin.php");
include ('class/class.user.inc');

$objUser = new Class_User();


if(isset($_SESSION['session_user_id'])&& $_SESSION['session_user_id']!="")
{
	$objUser->sel_id = $_SESSION['session_user_id'];
	$UserRes = $objUser->getcustomitem();
	$num=mysql_num_rows($UserRes);
	
}
 #>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>  Code for pagination START   <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<#

$pagination = new Pagination();

if(!isset($_GET['pageNumber']))
{
	$pageNumber = 1;
}
else
{
	$pageNumber= $_GET['pageNumber'];
}

//$num_rows_items     = mysql_num_rows($image_details_item);
//number of records per page LIMIT
if(isset($_GET['limit']) && is_numeric($_GET['limit']))
{
	$to	= trim($_GET['limit']);
}
else
{
	$to	=	ADMIN_PAGE_NUMBER;
}
$from=($pageNumber-1)*$to;
$showPrevNext = true;
//$url = "admin_category.php?start_date=$start_date&end_date=$end_date&business=$business";
$url = basename($_SERVER['PHP_SELF'])."?";
if($pageNumber==1 || $pageNumber=='')
{
	$counter=1;
}
else
{
	$counter = $pageNumber+$from-($pageNumber-1);
}
//echo '$counter'.$counter;
$pageLimit =" LIMIT $from,$to";
// echo 'url=-'.$url;
$pageLink = $pagination->getPageLinks($num, $to, $url, $pageNumber,"1&order_by=$order_by_asc_desc", $showPrevNext);
// Assigning Pagination Links
$smarty->assign('pageLink',$pageLink);
$objUser->pageLimit = $pageLimit;
if(isset($_SESSION['session_user_id'])&& $_SESSION['session_user_id']!="")
{
	$objUser->sel_id = $_SESSION['session_user_id'];
	$UserRes = $objUser->getcustomitem();
	$num1=mysql_num_rows($UserRes);
	while($UserArr = mysql_fetch_array($UserRes))
	{
		$items[]	=	$UserArr;
	}
	$smarty->assign("citem",$items);
	$smarty->assign("num",$num1);

}
$page_counter = $pagination->getPageCounter($num1);

//if(isset($this->pageLimit) && $this->pageLimit!="")
//		$sSQL .= $this->pageLimit;
$smarty->assign('page_counter',$page_counter);


#>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>  Code for pagination END   <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<#


if(isset($_REQUEST['titleid'])&& $_REQUEST['titleid']!="")
{
	$objUser->reqid			= rteSafe($_REQUEST['titleid']);	
	$objUser->agreestatus	= 1;
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
$smarty->display('seller_custom_request.tpl');
?>