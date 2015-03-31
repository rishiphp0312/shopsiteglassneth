<?php
include ('include/common.inc');
include ('class/class.cms.inc');
include ('class/class.user.inc');
//create CMS class object
$objCMS	= new Class_CMS();
$objUser = new Class_User();

//************************ Featured store ***********************************
//$objUser->pageLimit = $pageLimit;
$UserRes = $objUser->selectallfeaturedimage();

$name_after_domain     = $_SERVER['HTTP_HOST'];
$exp_name_after_domain = explode(".",$name_after_domain);
 $add_this_name         = $exp_name_after_domain[1].'.'.$exp_name_after_domain[2];
//echo '<br>';
 $add_this_name_www     =  $exp_name_after_domain[0]; 
$smarty->assign('add_this_name',$add_this_name);
$smarty->assign('add_this_name_www',$add_this_name_www);

$smarty->assign("store_img_path",'uploads/store_logos/');

//************************ Featured store ***********************************
#>>>>>>>>>>> ************ Code for pagination START   <*****<<<<<<<<<<<<<<<<<<

$pagination = new Pagination();

if(!isset($_GET['pageNumber']))
{
	$pageNumber = 1;
}
else
{
	$pageNumber= $_GET['pageNumber'];
}

 $num_rows_items     = mysql_num_rows($UserRes);
if(isset($_GET['limit']) && is_numeric($_GET['limit']))
{
//5/25/2010$to	= 5;

	$to	= trim($_GET['limit']);
}
else
{
	//$to	= 5;
	$to	=	12;
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
//echo '$counter'.$counter;
$pageLimit =" LIMIT $from,$to";
$pageLink = $pagination->getPageLinks($num_rows_items, $to, $url, $pageNumber, '', $showPrevNext);
// Assigning Pagination Links
$smarty->assign('pageLink',$pageLink);

//****************** Code for pagination END   ***********************<<<<<<<<<<#


$rows=mysql_num_rows($UserRes);


$smarty->assign("rows",$rows);






//get content for seller
$objCMS->page_link_id  = "sellers";
$resCMS = $objCMS->selectCmsPage();
	
if(mysql_num_rows($resCMS)>0)
{
	$resCMSRow = mysql_fetch_array($resCMS);
	$smarty->assign('sellers_desc',$resCMSRow['description']);
}

//get content for buyers
$objCMS->page_link_id  = "buyers";
$resCMS = $objCMS->selectCmsPage();


$objUser->pageLimit = $pageLimit;
$objUser->sortingid = $_POST['sortingid'];
$UserRes = $objUser->selectallfeaturedimage();
$record	= mysql_num_rows($UserRes);
while($UserArr = mysql_fetch_array($UserRes))
{
	$store[]	=	$UserArr;
}
$smarty->assign("store",$store);
$smarty->assign("record",$record);




if(mysql_num_rows($resCMS)>0)
{
	$resCMSRow = mysql_fetch_array($resCMS);
	$smarty->assign('buyers_desc',$resCMSRow['description']);
}


//assign variable and display template
$smarty->assign('site_page_title','Nethaat: Store Information');
$smarty->assign('site_title',$site_title);
$smarty->display('featured_more_store.tpl');
?>