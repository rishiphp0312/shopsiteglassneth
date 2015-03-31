<?php
//This page is used to dispaly CMS content of site
include ('include/common.inc');
include ('class/class.cms.inc');

//create CMS class object
$objCMS	= new Class_CMS();

//get page details
$page_link_id = trim($_GET['page']);

//set Faq and Help as same page
if($page_title=="faq")
{
	//$page_title1= "help";
}
if($page_link_id && $page_link_id!="")
{
	$objCMS->page_link_id  = $page_link_id;
	//$objCMS->page_title1 = $page_title1;
	
	$resCMS = $objCMS->selectCmsPage();
	
	if(mysql_num_rows($resCMS)>0)
	{
		$resCMSRow = mysql_fetch_array($resCMS);
		
		$smarty->assign('page_title',$resCMSRow['page_title']);
		$smarty->assign('page_link_id',$resCMSRow['page_link_id']);
		$smarty->assign('META_KEYWORDS',$resCMSRow['meta_keywords']);
		$smarty->assign('META_DESCRIPTION',$resCMSRow['meta_description']); 
		$smarty->assign('description',$resCMSRow['description']);
		$smarty->assign('posttime',$resCMSRow['posttime']);
	}
	else 
	{
		header("location: ".$baseUrl);
	}
}
if(isset($resCMSRow['page_title']))
{
	$page_title = $resCMSRow['page_title'];
}
else
{
	$page_title = SITE_CMS_TITLE;
}
//display template
$smarty->assign('site_page_title',$page_title);
$smarty->assign('site_title',$site_title);
$smarty->display('cms1.tpl');	
?>