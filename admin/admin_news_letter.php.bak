<?php
include ("common_includes.php");			 // Common files
include ('../class/class.news_letter.inc');
include ("../include/adminsession.php.inc"); // For login session


//create object of Class_NewsLetter class
$objNewsLetter = new Class_NewsLetter();

//assign static labels and heading
$smarty->assign("form_heading","Manage News Letters");
$smarty->assign("add_label","Send News Letter");
$smarty->assign("add_link","admin_send_news_letter.php");
$smarty->assign("name_label","Email Address");

//display update message
if(isset($_GET['msg']) && trim($_GET['msg'])!="")
{
	if($_GET['msg']=="sent")
	{
		$update_msg = "Your Message Has Been Sent!";
	}	
	else
	{
		$update_msg = "Error occured while sending email. Please try again!.";
	}
	$smarty->assign("update_msg",$update_msg);
}

//select total recoords
$objResCatTotal = $objNewsLetter->selectNewsLetter();

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
//$url = "company.php?start_date=$start_date&end_date=$end_date&business=$business";
//$url = "admin_country.php?limit=".$to;
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
#>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>  End Code for END   <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<#

//assign page limit
$objNewsLetter->pageLimit = $pageLimit;

//selects users list
$categoryList = array();
$objResCat = $objNewsLetter->selectNewsLetter();
while($CateRow = mysql_fetch_array($objResCat))
{
	$categoryList[]	= $CateRow;
}
$smarty->assign('categoryList',$categoryList);

//delete new letter email
if(isset($_POST['delete_record']) && $_POST['delete_record']!="")
{
	$news_letter_id = $_POST['delete_record'];
	$objNewsLetter->news_letter_id = $news_letter_id;
	$objDBReturn = $objNewsLetter->deleteNewsLetter();
	if($objDBReturn->nErrorCode==0)
	{
		echo "1";//success
		exit;
	}
	else 
	{
		echo "2";//failure
		exit;
	}
}//end of if

//display template and title
$smarty->assign('site_page_title',ADMIN_COMMON_TITLE);
$smarty->assign('site_title',$site_title);
$smarty->display('admin_news_letter.tpl');	
?>