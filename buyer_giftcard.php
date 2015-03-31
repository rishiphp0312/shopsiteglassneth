<?php
include ('include/common.inc');
include ("include/authentiateUserLogin.php");
include ('class/class.user.inc');
include ('class/class.item.inc');

$objItem = new Class_Item();

if(isset($_SESSION['session_user_id'])&& $_SESSION['session_user_id']!="")
{
	$objItem->user_id = $_SESSION['session_user_id'];
	$UserRes = $objItem->getgiftcarddetail();
	
}
///////




if(!isset($_GET['pageNumber']))
{
	$pageNumber = 1;
}
else
{
	$pageNumber= $_GET['pageNumber'];
}

$num_rows_items     = mysql_num_rows($UserRes);
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

$pageLimit =" LIMIT $from,$to ";
$pagination = new Pagination();
$objItem->pageLimit = $pageLimit;
 $pageLink = $pagination->getPageLinks($num_rows_items, $to, $url, $pageNumber, '', $showPrevNext);
//$pageLink = $pagination->getPageLinks($num_rows_items, $to, $url, $pageNumber,"1&order_by=$order_by_asc_desc", //$showPrevNext);
// Assigning Pagination Links
$smarty->assign('pageLink',$pageLink);         
#>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>  Code for pagination END   <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<#


$objItem->pageLimit           = $pageLimit;
$objItem->user_id             = $_SESSION['session_user_id'];
//select * from (bdg left join res on bdg.bid = res.bid) left join dom on res.rid = dom.rid; 
$UserRes1                     = $objItem->getgiftcarddetail();
$num_rows_items1              = mysql_num_rows($UserRes1);
$page_counter                 = $pagination->getPageCounter($num_rows_items1);
$smarty->assign('page_counter',$page_counter);
if($num_rows_items1>0)
	{
	while($UserArr = mysql_fetch_array($UserRes1))
	{
		$items[]	=	$UserArr;
	}
	
	}

    $smarty->assign("num",$num_rows_items1);
	$smarty->assign("citem",$items);




$error_msg="";

$smarty->assign("users_items_details", $item_values_list);
$smarty->assign("ListItem",'listItem_');
///////////
$smarty->assign('CURRENCY',CURRENCY);

$smarty->assign('site_page_title','Nethaat: My Purchased Giftcards ');

$smarty->assign('site_title',$site_title);
$smarty->display('buyer_giftcard.tpl');
?>