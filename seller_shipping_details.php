<?php
include ('include/common.inc');
include ('class/class.user.inc');
include ('class/class.item.inc');
include ("include/authentiateUserLogin.php");
include ("class/class.shipping.inc");



//create object of Item class

$objItem		= new Class_Item();
$objUser        = new Class_User();
$objShip        = new Class_Shipping();





$delete_item_value_id         = trim($_REQUEST['delete_item_value']);
$ship_status_id               = $_REQUEST['ship_status_id'];
//Hand picked item



		//set search request variables
	$smarty->assign("FirstName",trim($_REQUEST['FirstName']));

///////--code for  serching ends here

#>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>  Code for pagination START   <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<#
//select total recoords

	$objShip->seller_id =  $_SESSION['session_user_id'];
	$objResCatTotal     =  $objShip->getshippingdetails();
	$total_records      =  mysql_num_rows($objResCatTotal);
	
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
	
	$pageLink = $pagination->getPageLinks($total_records,$to,$url,$pageNumber,'',$showPrevNext);
	// Assigning Pagination Links
	$objShip->pageLimit = $pageLimit;
//assign page limit
//$objUser->pageLimit = $pageLimit;
	$smarty->assign('pageLink',$pageLink);    
#>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>  End Code for END   <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<#
//assign page limit
//$objUser->pageLimit = $pageLimit;
	$productList = array();
	$objShip->seller_id =  $_SESSION['session_user_id'];
	
	//$objItem->payment_status = 1;
	$objResItem         = $objShip->getshippingdetails();
	$page_counter       = $pagination->getPageCounter(mysql_num_rows($objResItem));
	$smarty->assign('page_counter',$page_counter);
	while($Row = mysql_fetch_array($objResItem))
	{
		$productList[]	= $Row;
	}
	$smarty->assign('productList',$productList);
	
	$anObject = new Class_Dynamic();
		$smarty->assign('anObject',$anObject);
	//display template
	$smarty->assign('site_page_title','View Shipping Details');
	$smarty->assign('site_title',$site_title);
	$smarty->display('seller_shipping_details.tpl');
?>
