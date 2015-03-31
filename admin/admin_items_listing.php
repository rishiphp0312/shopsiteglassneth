<?php
include ("common_includes.php");
include ("../include/adminsession.php.inc");
include ("../class/class.item.inc");
include ("../class/class.user.inc");
include ('../include/country_state_cat.php');
include ("../class/class.category.inc");
//assign static labels and heading
$smarty->assign("form_heading","Manage Products");
//create object of Item class

$objItem_delete	= new Class_Item();


$smarty->assign('array_for_id', array(1,2,3,4,5,6,7,8,9,10,11,12));
$smarty->assign('array_for_month', array('Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'));

///////--code for  serching ends here


#>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>  Code for pagination START   <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<#
//select total recoords

 //$objItem->getItemImageDetails_withothers()
// start implementation restrication to not to make more than 12 items featured//

$objUser        = new Class_User();
$objItem	    = new Class_Item();
$objCategory    = new Class_Category();
$objItem->inventory_check  = 1;

$objItem->status           = 1;
//$objItem->hat_max_value    = 1;
//$objItem->recent_status   =303;
$objItem->request_item_id  = 0; // request items should not be displayed
//$objItem->hatting_status   = 0;
//$objItem->approve_store    = 1;
$objItem->delete_by_seller = 0; //0 not deleted by seller 1 means delete by seller
$objItem->locker_status    = 0;
$objItem->delete_restored  = 0; //0 for showing restored 1 means deleted by admin
$objItem->package_expired  = 0; //0 for showing active packg 1 means expired packge
$objResCatTotal_feature   = $objItem->getItemImageDetails();
$total_records_feature    = mysql_num_rows($objResCatTotal_feature);
$smarty->assign('total_records_feature',$total_records_feature);
// end implementation restrication to not to make more than 12 items featured//


$objResCatTotal = $objItem->getItemImageDetails();
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
$pageLimit =" LIMIT $from,$to ";
$objItem->pageLimit = $pageLimit;

$url=$url."Username=".$_REQUEST['Username']."&cost_item=".$_REQUEST['cost_item']."&title=".$_REQUEST['title']."&status=".$_REQUEST['status']."&inventory_alert=".$_REQUEST['inventory_alert']."&country_value=".$_REQUEST['country_value']."parentNAME=".$_REQUEST['parentNAME']."&category_id=".$_REQUEST['category_id']."&state=".$_REQUEST['state']."&sel_year=".$_REQUEST['sel_year']."&sel_month=".$_REQUEST['sel_month']."&sel_days=".$_REQUEST['sel_days'];
$pageLink = $pagination->getPageLinks($total_records, $to, $url, $pageNumber,'', $showPrevNext);
// Assigning Pagination Links
$smarty->assign('pageLink',$pageLink);         
#>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>  End Code for END   <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<#

//assign page limit
$objUser->pageLimit = $pageLimit;

$productList = array();

$objResItem = $objItem->getItemImageDetails();
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
$smarty->display('admin_items_listing.tpl');	
?>