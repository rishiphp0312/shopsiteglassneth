<?php
include ('include/common.inc');
include ("include/authentiateUserLogin.php");
include ('class/class.user.inc');
include ('class/class.item.inc');
include ('class/class.shipping.inc');

$objItem = new Class_Item();
$smarty->assign("anObject" , new Class_Dynamic() );

if($_REQUEST['trans_id']!='')
{
		$objShip = new Class_Shipping();
		$objShip->last_trans_id   = $_REQUEST['trans_id'];
		$objShip->ship_status     = 2;
		//	$objItem->payment_status = $_REQUEST['trans_id'];
		$objDBReturn= $objShip->makeconfirmshipping();

		//echo 'haha';
		//exit;
		success_msg("You has  confirmed the shippment of yours purchased item.");
        redirect('buyitem.php');

}

if(isset($_SESSION['session_user_id'])&& $_SESSION['session_user_id']!="")
{    //   $objItem->getinvoice_commisiondetails()
 	$objItem->buyer_id = $_SESSION['session_user_id'];
	$objItem->default_value = 1;
	$objItem->payment_status = 1;
        $objItem->purchased_date ='NA'; // If this parameter is blank it will show todays list.
	$UserRes = $objItem->getbuyitem();
	$num=mysql_num_rows($UserRes);
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
	//echo '$counter'.$counter;
	$pageLimit =" LIMIT $from,$to";
// echo 'url=-'.$url;
	$pageLink = $pagination->getPageLinks($num_rows_items, $to, $url, $pageNumber,"1&order_by=$order_by_asc_desc", $showPrevNext);
	// Assigning Pagination Links
	$smarty->assign('pageLink',$pageLink);
	#>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>  Code for pagination END   <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<#
        $objItem->pageLimit = $pageLimit;
        $UserRes          =  $objItem->getbuyitem();
        $num              = mysql_num_rows($UserRes);
        if($num>0){

       	 while($UserArr = mysql_fetch_array($UserRes))
			{
			$items[]	=	$UserArr;
			}
		}
    $page_counter = $pagination->getPageCounter($num);
	$smarty->assign('page_counter',$page_counter);
	$smarty->assign("num",$num);
	$smarty->assign("citem",$items);
}
$smarty->assign('CURRENCY',CURRENCY);
$smarty->assign('site_page_title','Nethaat :Purchase Now');
$smarty->assign('site_title',$site_title);
$smarty->display('buyitem.tpl');
?>