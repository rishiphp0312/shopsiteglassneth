<?php
include ('include/common.inc');
include ('class/class.cms.inc');
include ("class/class.tutorial.inc");

//create CMS class object
$objCMS	    = new Class_CMS();

$objCMS->page_link_id  = "sellers";

$resCMS                = $objCMS->selectCmsPage();

if(mysql_num_rows($resCMS)>0)
{
	$resCMSRow = mysql_fetch_array($resCMS);
	$smarty->assign('sellers_desc',$resCMSRow['description']);
}

//get content for buyers
$objCMS->page_link_id  = "buyers";
$resCMS = $objCMS->selectCmsPage();

if(mysql_num_rows($resCMS)>0)
{
	$resCMSRow = mysql_fetch_array($resCMS);
	$smarty->assign('buyers_desc',$resCMSRow['description']);
}


//create object of Tutorial class
$objTute = new Class_Tutorial();

/*********************  Selct page content from admin START **********************/
//get page details
$page_link_id = "how_it_works";

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
}
if(isset($resCMSRow['page_title']))
{
	$page_title = $resCMSRow['page_title'];
}
else
{
	$page_title = "How It Works";
}
/*********************  Selct page content from admin START **********************/

/*********************  Select default video START **********************/
//select default video
$objTute->tute_language = "english";
$resTute         = $objTute->selectTutorials();

if(mysql_num_rows($resTute) > 0)
{
	$tute      = mysql_fetch_array($resTute);
	$smarty->assign('tute_video', $tute['tute_video']);
}
/*********************  Select default video END **********************/



/*********************  Select all tutorial video language to create drop down **********************/
$objTute->tute_language = "";
$resAllTute         = $objTute->selectTutorials();

if(mysql_num_rows($resAllTute) > 0)
{
	$tuteList = array();
	while($row      = mysql_fetch_array($resAllTute))
	{
		$tuteList[$row['tute_video']] = $row['tute_language'];
	}
	$smarty->assign('tuteList', $tuteList);
}


//display template
$smarty->assign('site_page_title',"Nethaat: Tutorials");
$smarty->assign('site_title',$site_title);
$smarty->display('show_tutorial.tpl');	
?>