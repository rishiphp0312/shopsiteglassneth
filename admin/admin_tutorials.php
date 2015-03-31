<?php
include ("common_includes.php");
include ("../include/adminsession.php.inc");
include ("../class/class.tutorial.inc");

//create object of Tutorial class
$objTute = new Class_Tutorial();

//upload tutorial path
$upload_path = "../uploads/tutorials/";

//delete tutorial permanantely
if(isset($_REQUEST['action']) && $_REQUEST['action']="delete")
{
	$objTute->tute_id	= trim($_GET['tute_id']);
	//selects tutorial video and unlink
	$resCMS		= $objTute->selectTutorials();
	$tute		= mysql_fetch_array($resCMS);
	unlink($upload_path.$tute['tute_video']);
	
	//now delete record from database
	$objDBReturn	= $objTute->deleteTutorial();

	if($objDBReturn->nErrorCode==0 )
	{
		success_msg("Tutorial has been deleted successfully!");		
	}
	else 
	{
		failure_msg("Error occured while deleting tutorial, please try again later");		
	}
	redirect("admin_tutorials.php");
}//end of if


#>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>  Code for pagination START   <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<#
//select total recoords
$objResCatTotal = $objTute->selectTutorials();
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
$url = basename($_SERVER['PHP_SELF']);
if($pageNumber==1 || $pageNumber=='')
{
	$counter=1;
}
else
{
	$counter = $pageNumber+$from-($pageNumber-1);
}
$pageLimit =" LIMIT $from,$to";
$pageLink = $pagination->getPageLinks($num_rows, $to, $url.'?',$pageNumber, '',$showPrevNext);
// Assigning Pagination Links
$smarty->assign('pageLink',$pageLink);         
#>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>  End Code for END   <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<#

//assign page limit
$objTute->pageLimit = $pageLimit;

//selects category list
$tuteList      = array();

$objRes     = $objTute->selectTutorials();
$page_counter   = $pagination->getPageCounter(mysql_num_rows($objRes));
$smarty->assign('page_counter',$page_counter);


while($Row = mysql_fetch_array($objRes))
{
	$tuteList[]	= $Row;
}
$smarty->assign('tuteList',$tuteList);

//display template and title
$smarty->assign('site_page_title',ADMIN_COMMON_TITLE);
$smarty->assign('site_title',$site_title);
$smarty->display('admin_tutorials.tpl');	
?>