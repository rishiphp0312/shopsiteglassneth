<?php
include ('include/common.inc');
include ('class/class.user.inc');
include ('class/class.item.inc');
include ("include/authentiateUserLogin.php");
//include ('include/Pagination.Class.php'); // For pagination

 $delete_item_value_id = $_REQUEST['delete_item_value'];// start here for delete code
//exit;
//create user class object
$objUser = new Class_User();
$objItem = new Class_Item();

$objUser->id   = $_SESSION['session_user_id'];

//********************** Delete code for favorite item *********
if(isset($_GET['delitemid'])!="")
{
	$objItem->id           = $_GET['delitemid'];
	$Record = $objItem->deleteFavItems();
 	if($Record>0)
	{
			success_msg("Item  has been deleted successfully!!");
	}
	else
	{
			failure_msg("Error occured ...!)");
	}

	

}
//********************** Delete code for favorite item *********

//********************** end delete code *******************

if(isset($_SESSION['session_user_id'])!="" )
{
	$objItem->user_id   = $_SESSION['session_user_id'];
	$RecordSetpage = $objItem->getallfavorite();

//************************** code for pagignation******	
$pagination = new Pagination();
if(!isset($_GET['pageNumber']))
{
	$pageNumber = 1;
}
else
{
	$pageNumber= $_GET['pageNumber'];
}

 $num_rows_items     = mysql_num_rows($RecordSetpage);
	if(isset($_GET['limit']) && is_numeric($_GET['limit']))
	{
		$to	= trim($_GET['limit']);
	}
	else
	{
		$to	=	10;
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
	$pageLink = $pagination->getPageLinks($num_rows_items, $to, $url, $pageNumber, '', $showPrevNext);
// Assigning Pagination Links

	$smarty->assign('pageLink',$pageLink);
	$objItem->pageLimit = $pageLimit;
	$objItem->user_id   = $_SESSION['session_user_id'];
	$RecordSet = $objItem->getallfavorite();
	$row=mysql_num_rows($RecordSet);
	while($resarr=mysql_fetch_array($RecordSet))
	{
		$records[]=$resarr;
	}
	$smarty->assign("favitems",$records);

$page_counter = $pagination->getPageCounter($row);
$smarty->assign('page_counter',$page_counter);
$smarty->assign('site_page_title','Nethaat : My Favourite Items List');

$smarty->assign('site_title',$site_title);

$smarty->display('my-buyer-favorite-items.tpl');

}
?>
