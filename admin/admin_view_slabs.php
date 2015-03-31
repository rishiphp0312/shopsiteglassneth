<?php
include ("common_includes.php");			 // Common files
include ("../class/class.category.inc");     // For category class
include ("../include/adminsession.php.inc"); // For login session

//assign static labels and heading
$smarty->assign("form_heading","Manage Subscription");
$smarty->assign("add_label","Add New Slabs");
$smarty->assign("add_link","admin_add_slabs.php");
$smarty->assign("name_label","Slabs");


//create object of Category class
$objCategory = new Class_Category();

if($_REQUEST['del_slab_id']!='')
{
$objCategory->slab_id     = $_REQUEST['del_slab_id'];
$objResdeleTe             = $objCategory->deleteSlabs();
if($objResdeleTe->nErrorCode==0)
	{
	success_msg("Slab deleted successfully!!");
	}
	else
	{
	failure_msg("Error , please try again!!");
	}
	redirect("admin_view_slabs.php");
    
}
//select total recoords
$objResCatTotal = $objCategory->selectSlabs();

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
$pageLimit =" LIMIT $from,$to";
$pageLink = $pagination->getPageLinks($num_rows, $to, $url, $pageNumber, '', $showPrevNext);
// Assigning Pagination Links
$smarty->assign('pageLink',$pageLink);
#>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>  Code for pagination END   <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<#

//assign page limit
$objCategory->pageLimit = $pageLimit;

//selects category list
$categoryList = array();
$objResCat = $objCategory->selectSlabs();

$page_counter = $pagination->getPageCounter(mysql_num_rows($objResCat));
 mysql_num_rows($objResCat);
$smarty->assign('page_counter',$page_counter);
// echo mysql_num_rows($objResCat);
if(mysql_num_rows($objResCat)>0)
{
    while($CateRow = mysql_fetch_array($objResCat))
    {
            $slabList[]	= $CateRow;
    }
}
$smarty->assign('slabList',$slabList);
//display template and title
$smarty->assign('site_page_title',ADMIN_COMMON_TITLE);
$smarty->assign('site_title',$site_title);
$smarty->display('admin_view_slabs.tpl');
?>