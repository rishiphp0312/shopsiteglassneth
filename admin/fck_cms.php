<?php
include("../fckeditor/fckeditor.php");
//include ("../class/class.cms.inc");

//create object of CMS class
$objCMS = new Class_CMS();

$page_get_id = isset($_GET['page_id']) ? trim($_GET['page_id']) : '';
if($page_get_id!='')
{
	$objCMS->page_id = $page_get_id;
	$cmsRes = $objCMS->selectCmsPage();
	$cmsRow = mysql_fetch_array($cmsRes);
	//$smarty->assign('page_title_single',$cmsRow['page_title']);
	//$smarty->assign('page_desc_single',$cmsRow['description']);
	$message = html_entity_decode($cmsRow['description']);
}
else
{
	$message = html_entity_decode($_POST['description']);
}

$message = stripslashes($message);
$oFCKeditor = new FCKeditor('description') ;
$oFCKeditor->BasePath   = '../fckeditor/' ;
$oFCKeditor->Value= $message ;
$oFCKeditor->Width='100%';
$oFCKeditor->Height='485' ;
$oFCKeditor->Create() ;
?>

