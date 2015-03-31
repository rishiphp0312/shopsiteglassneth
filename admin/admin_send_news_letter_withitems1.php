<?php
include ("common_includes.php");
include ('../class/class.news_letter.inc');
include ("../class/class.item.inc");
include ("../class/class.user.inc");
include ('../include/country_state_cat.php');
include ("../class/class.category.inc");
include ("../include/adminsession.php.inc");

//create mail class object
$objMail 	= new Class_Mail();
$objUser        = new Class_User();
$objItem	    = new Class_Item();
$objCategory    = new Class_Category();


// Creating object of SendEmailClass
/// start of unregistered users //////
//create object of Class_NewsLetter class
$objNewsLetter = new Class_NewsLetter();

//selects users list to send email
$usersList = array();
$objNewsLetter->status = 1;//select oncy active
$objResUsers   = $objNewsLetter->selectNewsLetter();
$total_records_feature    = mysql_num_rows($objResUsers);
$smarty->assign('total_records_feature',$total_records_feature);

$pagination = new Pagination();
$objMail->mail_title	= "Email Template"; 
$MailRes 				= $objMail->selectMailTemplate();
$mailRowArr 			= mysql_fetch_array($MailRes);
$mail_subject 			= $mailRowArr['mail_subject'];  
$mail_content			= $mailRowArr['mail_content'];
$mail_content           = str_replace("#link#",$baseUrl,$mail_content);
//echo $mail_content;die;

//get monthly news Letter Content

//set page number
if(!isset($_POST['pageNumber']))
{
	$pageNumber = 1;
}
else
{
	$pageNumber= $_POST['pageNumber'];
}

//number of records per page LIMIT
if(isset($_POST['limit']) && is_numeric($_POST['limit']))
{
	$to	= trim($_POST['limit']);
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
$pageLimit =" LIMIT $from,$to ";

$objNewsLetter->pageLimit = $pageLimit;

//$url=$url."";

$pageLink = 
$pagination->getPageLinks($total_records_feature, $to, $url, $pageNumber,'', $showPrevNext);


// Assigning Pagination Links
 
$smarty->assign('pageLink',$pageLink);  
$objNewsLetter->pageLimit = $pageLimit; 

$objResItem1 = $objNewsLetter->selectNewsLetter();
$page_counter = $pagination->getPageCounter(mysql_num_rows($objResItem1));

if(mysql_num_rows($objResItem1)>0)
{
	while($UserRow = mysql_fetch_array($objResItem1))
	{
		$userList[]	= $UserRow;
	}
}
$smarty->assign('page_counter',$page_counter);
$smarty->assign('userList',$userList);

/// end of unregistered users //////



//display template and title
$smarty->assign('site_page_title',ADMIN_PAGE_MGMT);
$smarty->assign('site_title',$site_title);
$smarty->display('admin_send_news_letter_withitems1.tpl');	
?>
