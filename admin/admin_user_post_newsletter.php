<?php
include ("common_includes.php");
include ("../include/adminsession.php.inc");
include ("../class/class.user.inc");
include ("../class/class.coupon.inc");

//create object of User class
$objUser = new Class_User();

//create Coupon class object
$objCoupon 		= new Class_Coupon();

//assign static labels and heading
$smarty->assign("form_heading","NewsLetter Post By Merchants");

$objUser->user_id = $_SESSION["view_user_id"];

$objCoupon->user_id	= $_SESSION['view_user_id'];

/**
* Select only those coupon has NewsLetter Date is not expired yet
* i.e. display only coupon news letters having News Letter Date is greater than Current date 
**/
$objCoupon->show_expire	= "Yes";

#>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>  Code for pagination START   <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<#
//select total recoords
$objResCatTotal = $objCoupon->selectNewsLetterCoupon();

$pagination = new Pagination();
if(!isset($_GET['pageNumber']))
{
	$pageNumber = 1;
}
else
{
	$pageNumber= $_GET['pageNumber'];
}
$num_rows = mysql_num_rows($objResCatTotal);
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
$url = basename($_SERVER['PHP_SELF'])."?";
if($pageNumber==1 || $pageNumber=='')
{
	$counter=1;
}
else
{
	$counter = $pageNumber+$from-($pageNumber-1);
}
$pageLimit =" LIMIT $from,$to";
$pageLink = $pagination->getPageLinks($num_rows, $to, $url, $pageNumber, '', $showPrevNext);
// Assigning Pagination Links
$smarty->assign('pageLink',$pageLink);         
#>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>  End Code for END   <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<#

//assign page limit
$objCoupon->pageLimit = $pageLimit;

//get user coupons
$couponListArr 		= array();
$ResCoupon 			= $objCoupon->selectNewsLetterCoupon();
while($couponRow = mysql_fetch_array($ResCoupon))
{
	$couponListArr[] = $couponRow;
}
$smarty->assign('usersList',$couponListArr);


//display template and title
$smarty->assign('site_page_title',ADMIN_COMMON_TITLE);
$smarty->assign('site_title',$site_title);
$smarty->display('admin_user_post_newsletter.tpl');	
?>