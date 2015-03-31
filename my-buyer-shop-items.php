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

$objItem->buyer_id   = $_SESSION['session_user_id'];

$for_shop_ids        = $objItem->favorite_shops();
$num_shop_ids        = mysql_num_rows($for_shop_ids);
if($num_shop_ids>0)
	 {
        while($arr_fetch_ids  = mysql_fetch_assoc($for_shop_ids))
		 {
		 $store_details_shops[]     = $arr_fetch_ids;
		
		}
	 }

	$order_by_asc_desc = $_REQUEST['order_by'];

	// code for item to insert values for haating or for particular item min and max costs
	$item_value_id     = $_REQUEST['item_value_id'];
	// start here for code on to make item haat  when status=3

	$make_item_haat    = $_REQUEST['make_item_haat'];
	//code for put on hold 

	$remove_hold_item_id = $_REQUEST['remove_hold_item'];
    // code ends here for item on hold and on unhold

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
$num_rows_items       = $num_shop_ids;
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
$pageLink = $pagination->getPageLinks($num_shop_ids, $to, $url, $pageNumber,"1&order_by=$order_by_asc_desc", $showPrevNext);
// Assigning Pagination Links
$smarty->assign('pageLink',$pageLink); 
$smarty->assign('num_rows_items',$num_rows_items);
//$num_rows_items
#>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>  Code for pagination END   <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<#


$objItem->pageLimit = $pageLimit;
$obj_item->seller_id = $_SESSION['session_user_id'];

//$obj_item->update_item_id = $_REQUEST['item_id'];




	

$page_counter = $pagination->getPageCounter($num_shop_ids);

//if(isset($this->pageLimit) && $this->pageLimit!="")
//		$sSQL .= $this->pageLimit;
$smarty->assign('page_counter',$page_counter);

$smarty->assign("favo_store_details",$store_details_shops);
//print_r($haated_item_det_buyers);



////// POST CODE FOR UPDATE QUANTITY



//assign error/update message
//$title_asc$quantity_available_desc
$smarty->assign("quantity_available_desc",'quantity_available_desc');
$smarty->assign("quantity_available_asc",'quantity_available_asc');
$smarty->assign("title_asc",'title_asc');
$smarty->assign("cost_asc",'cost_asc');
$smarty->assign("cost_desc",'cost_desc');

$smarty->assign("title_desc",'title_desc');
$smarty->assign("error_msg",$error_msg);
$smarty->assign("update_msg",$update_msg);

//display template
$smarty->assign('site_page_title','My Favourite Shops List');
$smarty->assign('site_title',$site_title);
//$smarty->display('buyer-haated-items.tpl');

$smarty->display('my-buyer-shop-items.tpl');
?>
