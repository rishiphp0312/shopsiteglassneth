<?php
include ('include/common.inc');
//include ('class/class.user.inc');
include ('class/class.item.inc');
include ("class/class.category.inc");
include ('class/class.user.inc');
include ('include/country_state_cat.php');

$objItem = new Class_Item();
$objUser = new Class_User();
$item_values_list = array();
$main_cat_id      = $_REQUEST['main_cat_id'];

$name_after_domain     = $_SERVER['HTTP_HOST'];
 $exp_name_after_domain = explode(".",$name_after_domain);
 $curent_page           =  $_SERVER['PHP_SELF'];
 $base_curent_page      = basename($curent_page);
 
 $exp_name_after_domain = explode(".",$name_after_domain);
if($name_after_domain=='www.nethaat.com' )
{
}
else
{

    $add_this_name_red         =   'featured_store_information.php';
    // header("Location:$add_this_name_red");
	redirect($add_this_name_red);
 
}


$objCategory = new Class_Category;
$parentRes = $objCategory->selectSubCatgeory();


while($parentRow = mysql_fetch_array($parentRes))
 {
	$parentID[] = $parentRow['category_id'];
	$parentNAME[] = $parentRow['name'];
 }

$smarty->assign("parentID",$parentID);
$smarty->assign("parentNAME",$parentNAME);

$objResCatTotal1 = $objUser->getStylelisting();
$total_records1  = mysql_num_rows($objResCatTotal1);
if($total_records1>0)
{
while($parentRow1 = mysql_fetch_array($objResCatTotal1))
{
	$styleId[]   = $parentRow1['style_id'];
	$styleNAME[] = $parentRow1['set_style'];
}
}


$smarty->assign("styleId",$styleId);
$smarty->assign("styleNAME",$styleNAME);

//if($_REQUEST['Search']=='Search')
//{
$objItem->request_item_id  = 0; // request items should not be displayed
$objItem->recent_status   = 2;
$objItem->hatting_status  = 0;    // for not showing  haating items
$objItem->inventory_check = 1;    // for quantity greater than inventory check or min qty
//$objItem->approve_store   = 1;  // for approved stores
$objItem->locker_status   = 0;    // for not showing locker items
$objItem->delete_restored = 0;    // 0 for showing restored 1 means deleted by admin
$objItem->delete_by_seller = 0;   // not deleted by seller
$objItem->package_expired = 0;    // 0 for showing active packg 1 means expired packge

$item_category_id         = $_REQUEST['category_id'];  
if($item_category_id!='')
$objItem->category_id        = $item_category_id;

$item_cost                   = $_REQUEST['cost1'];
if($item_cost!='')
$objItem->cost_item          = $item_cost;

$item_cost2                   = $_REQUEST['cost2'];
if($item_cost2!='')
$objItem->cost_item2          = $item_cost2;


$Keywords                    = $_REQUEST['Keywords'];
if($Keywords!='')
$objItem->Keywords           = $Keywords;




$style_id                    = $_REQUEST['style_id'];
if($style_id!='')
$objItem->style_id           = $style_id;


$country_value               = $_REQUEST['country_value'];
if($country_value!='')
$objItem->item_country_id    = $country_value;

$ship_country                = $_REQUEST['scountry_value'];
if($ship_country!='')
$objItem->scountry_value     = $ship_country;

$color                       = $_REQUEST['color'];
if($color!='')
$objItem->color              = $color;


$main_cat_id_str = "Keywords=$Keywords&style_id=$style_id&cost1=$item_cost&cost2=$item_cost2&country_value=$country_value&";


$image_details_item          = $objItem->getadvancedsearchResults();

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

$num_rows_items     = mysql_num_rows($image_details_item);
//number of records per page LIMIT
//echo $_GET['limit'];
if(isset($_GET['limit']) && is_numeric($_GET['limit']))
{

	$to	= trim($_GET['limit']);
}
else
{
	$to	=	12;
}	
$from=($pageNumber-1)*$to;
$showPrevNext = true;
//$url = "admin_category.php?start_date=$start_date&end_date=$end_date&business=$business";
$url = basename($_SERVER['PHP_SELF'])."?$main_cat_id_str";
if($pageNumber==1 || $pageNumber=='')
{
	$counter=1;
}
else
{
	$counter = $pageNumber+$from-($pageNumber-1);
}
$pageLimit =" LIMIT $from,$to";
$pageLink = $pagination->getPageLinks($num_rows_items, $to, $url, $pageNumber, '', $showPrevNext);

// Assigning Pagination Links
$smarty->assign('pageLink',$pageLink);         

#>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>  Code for pagination END   <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<#


$objItem->pageLimit = $pageLimit;


$image_details_item1 = $objItem->getadvancedsearchResults();

$num_rows_items1     = mysql_num_rows($image_details_item1);
if($num_rows_items1>0)
{
while($arr_items_array = mysql_fetch_array($image_details_item1))
		{
	     $item_values_list[]=   $arr_items_array;
	
		}
}
//$num_rows_items1 
$page_counter = $pagination->getPageCounter($num_rows_items1);
//}

$smarty->assign('no_records',$num_rows_items1);
$smarty->assign('page_counter',$page_counter);

$smarty->assign("users_items_details", $item_values_list);


//get user details if user logged in


if($_SERVER['REQUEST_METHOD']=='POST')
{
	
	$smarty->assign("message",$message);
	

}
//assign error/update message
$smarty->assign("error_msg",$error_msg);
$smarty->assign("update_msg",$update_msg);

//display template

$smarty->assign('site_page_title','Nethaat: Advance Search Results');
$smarty->assign('site_title',$site_title);
$smarty->display('advanced_srch_results.tpl');

?>
