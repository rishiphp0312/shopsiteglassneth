<?php
include ("common_includes.php");
include ("../include/adminsession.php.inc");
include ("../class/class.item.inc");
include ("../class/class.user.inc");

//assign static labels and heading
$smarty->assign("form_heading","Purchased Items");

//create object of Item class
$objItem		= new Class_Item();
$objItem_delete	= new Class_Item();
$objUser        = new Class_User();


if(isset($_REQUEST['Username']) && trim($_REQUEST['Username'])!="")
{
	 $objItem->first_name	=	trim($_REQUEST['Username']);
}
//search by last name
if(isset($_REQUEST['title']) && trim($_REQUEST['title'])!="")
{
	$objItem->title	=	trim($_REQUEST['title']);
}
//search by Email
if(isset($_REQUEST['cost_item']) && trim($_REQUEST['cost_item'])!="")
{
	$objItem->cost_item	=	trim($_REQUEST['cost_item']);
}

if(isset($_REQUEST['paymentmode']) && trim($_REQUEST['paymentmode'])!="")
{
	$objItem->paymentmode	=	trim($_REQUEST['paymentmode']);
}

//set search request variables
$smarty->assign("Username",trim($_REQUEST['Username']));
$smarty->assign("title",trim($_REQUEST['title']));
$smarty->assign("cost_item",trim($_REQUEST['cost_item']));

#>>>>>>>>>>>>>>>>>  Code for pagination START   <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<#
//select total recoords


$objResCatTotal = $objItem->getbuyitem();
$total_records = mysql_num_rows($objResCatTotal);

$pagination = new Pagination();

//set page number
if(!isset($_GET['pageNumber']))
{
	$pageNumber = 1;
}
else
{
	$pageNumber= $_GET['pageNumber'];
}

//number of records per page LIMIT
if(isset($_GET['limit']) && is_numeric($_GET['limit']))
{
	$to	= trim($_GET['limit']);
}
else
{
	$to	=	ADMIN_PAGE_NUMBER;
}
$from			= ($pageNumber-1)*$to;
$showPrevNext	= true;

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
$objItem->pageLimit = $pageLimit;

$pageLink = $pagination->getPageLinks($total_records, $to, $url, $pageNumber, '', $showPrevNext);
// Assigning Pagination Links
$smarty->assign('pageLink',$pageLink);  

#>>>>>>>>>>>>>>>>>>>> End Code for END   <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<#

//assign page limit
$objUser->pageLimit = $pageLimit;

$productList = array();
$objItem->recent_status   =303;
$objResItem = $objItem->getbuyitem();
$page_counter = $pagination->getPageCounter(mysql_num_rows($objResItem));
$smarty->assign('page_counter',$page_counter);

while($Row = mysql_fetch_array($objResItem))
{
	$productList[]	= $Row;
}
$smarty->assign('productList',$productList);

//display template and title
$smarty->assign('site_page_title',ADMIN_COMMON_TITLE);
$smarty->assign('site_title',$site_title);
$smarty->display('admin_purchase_item.tpl');	
?>