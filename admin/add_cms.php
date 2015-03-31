<?php
include ("common_includes.php");
include ("../class/class.cms.inc");
//create object of CMS class
$objCMS = new Class_CMS();

$page_get_id = isset($_GET['page_id']) ? trim($_GET['page_id']) : '';
if($page_get_id!='')
{
	$objCMS->page_id = $page_get_id;
	$cmsRes = $objCMS->selectCmsPage();
	$cmsRow = mysql_fetch_array($cmsRes);
	$smarty->assign('page_link_id',$cmsRow['page_link_id']);
	$smarty->assign('page_title_single',$cmsRow['page_title']);
	$smarty->assign('meta_title',$cmsRow['meta_title']);
	$smarty->assign('meta_keywords',$cmsRow['meta_keywords']);
	$smarty->assign('meta_description',$cmsRow['meta_description']);
	$smarty->assign('page_desc_single',$cmsRow['description']);
	//set update message
	$update_msg = "Page information has been updated successfully!";
}
else
{
	$update_msg = "Page has been added successfully!";
}


if(isset($_POST['Submit']))
{
	//post variables
	extract($_POST);
	if($page_get_id=='')
	{
		//$objCMS->page_link_id	= str_replace(" ","_",strtolower(rteSafe($page_title)));
	}	
	$objCMS->page_link_id 		= rteSafe($page_link_id);
	$objCMS->page_title 		= rteSafe($page_title);
	$objCMS->meta_title 		= rteSafe($meta_title);
	$objCMS->meta_keywords 		= rteSafe($meta_keywords);
	$objCMS->meta_description 	= rteSafe($meta_description);
	$objCMS->description 		= rteSafe($description);
	  
	$objDBReturn = $objCMS->insertUpdateCmsPage();
		
	if($objDBReturn->nErrorCode==0)
	{
		success_msg($update_msg);
	}
	else
	{
		failure_msg("Error occured, please try again later");
	}
	redirect("admin_cms.php?page_id=".$page_get_id);
}

//display template and title
$smarty->assign('site_page_title',ADMIN_PAGE_MGMT);
$smarty->assign('site_title',$site_title);
$smarty->display('add_cms.tpl');	
?>