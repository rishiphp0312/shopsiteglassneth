<?php
include ("common_includes.php");
include ("../include/adminsession.php.inc");
include ("../class/class.item.inc");
include ("../class/class.user.inc");

//assign static labels and heading
$smarty->assign("form_heading","Manage  Meta Tags");

//create object of Item class

$objItem		= new Class_Item();

$objUser        = new Class_User();

$delete_item_value = $_REQUEST['delete_item_value'];


if($delete_item_value!='')
{
        $objUser->meta_id      = $_REQUEST['delete_item_value'];
	$objResCatTotal         = $objUser->deleteMetaTaglisting();
	if($objResCatTotal->nErrorCode==0)
	{
		//header("location:admin_users.php");
		success_msg("Record deleted successfully!!");
	}
	else
	{
		failure_msg("Error occured, please try again later");
	}
    redirect("admin_view_seo.php");

}

///////--code for  serching ends here


#>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>  Code for pagination START   <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<#
//select total recoords


$objResCatTotal = $objUser->select_metaTags();
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

$pageLink = $pagination->getPageLinks($total_records, $to, $url, $pageNumber,'', $showPrevNext);
// Assigning Pagination Links
$smarty->assign('pageLink',$pageLink);
#>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>  End Code for END   <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<#

//assign page limit
$objUser->pageLimit = $pageLimit;

$productList = array();

$objResItem = $objUser->select_metaTags();
$page_counter = $pagination->getPageCounter(mysql_num_rows($objResItem));
$smarty->assign('page_counter',$page_counter);
if(mysql_num_rows($objResItem)>0){
while($Row = mysql_fetch_array($objResItem))
{
	$productList[]	= $Row;
}}
$smarty->assign('productList',$productList);

//display template and title
$smarty->assign('site_page_title',ADMIN_COMMON_TITLE);
$smarty->assign('site_title',$site_title);
$smarty->display('admin_view_seo.tpl');
?>