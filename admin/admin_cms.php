<?php
include ("common_includes.php");
include ("../class/class.cms.inc");
include ("../include/adminsession.php.inc");//check admin session

//create object of CMS class
$objCMS = new Class_CMS();

//delete page
if(isset($_GET['delete']) && is_numeric($_GET['delete']))
{
	$objCMS->page_id = $_GET['delete'];
	$objDBReturn = $objCMS->deleteCmsPage();
	if($objDBReturn->nErrorCode==0)
	{
		success_msg("Page has been deleted successfully!");
	}
	else
	{
		failure_msg("Error occured, please try again later");
	}
	redirect("admin_cms.php");
}
/*
//delete page
if(isset($_POST['page_id']))
{
	$objCMS->page_id = $_POST['page_id'];
	$objDBReturn = $objCMS->deleteCmsPage();
	if($objDBReturn->nErrorCode==0)
	{
		//header("location:admin_cms.php");
		echo "1";
		exit;
	}
}
*/
//select 1 page
if(isset($_GET['page_id']))
{
	$objCMS->page_id = $_GET['page_id'];
}
//$objCMS->page_title = "About";
$cmsRes = $objCMS->selectCmsPage();
$cmsRow = mysql_fetch_array($cmsRes);
$smarty->assign('page_id_single',$cmsRow['page_id']);
$smarty->assign('page_title_single',$cmsRow['page_title']);
$smarty->assign('posttime', $cmsRow['posttime']);
$smarty->assign('page_desc_single',$cmsRow['description']);

//selects all pages
$objCMS->page_id = "";
$cmsAllRes = $objCMS->selectCmsPage();
while($cmsAllRow = mysql_fetch_array($cmsAllRes))
{
	$page_id[] = $cmsAllRow['page_id'];
	$page_title[] = substr($cmsAllRow['page_title'],0,50);
}
$smarty->assign('page_id',$page_id);
$smarty->assign('page_title',$page_title);

//display template and site title
$smarty->assign('site_page_title',ADMIN_PAGE_MGMT);
$smarty->assign('site_title',$site_title);
$smarty->display('admin_cms.tpl');	
?>