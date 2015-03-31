<?php
include ('include/common.inc');
include ('class/class.item.inc');
include ('class/class.user.inc');
include ("include/authentiateUserLogin.php");
//
//if($_SESSION['session_user_type']!="4")
//{
//	failure_msg("Please login as buyer for access LOCKER AREA ...! ");
//	header("Location:my_account.php");
//}
$objUser = new Class_User();
$objItem = new Class_Item();

$item_category_id = $_REQUEST['item_category_id'];
$sellerid         = $_REQUEST['sellerid'];



if(isset($_GET['sellerid']) != "")
{   
//start of rating code
		// code for rating
		 $objUser->logged_user_id      = $_REQUEST['sellerid']; //seller id
		 $detailsOfUserfeedback        = $objUser->getdetailsOfUsertotalfeedback();
		 $num_OfUserfeedback           = mysql_num_rows($detailsOfUserfeedback) ;
		 if($num_OfUserfeedback>0)
		 {
		 $arr_Userfeedback = mysql_fetch_assoc($detailsOfUserfeedback);
		 }
                 $total_value_Userfeedback     =  $arr_Userfeedback['total'];
        
		 $detailsOfUserpostivefeedback = $objUser->getdetailsOfUserpostivefeedback();
		 $num_OfUserpostivefeedback    = mysql_num_rows($detailsOfUserpostivefeedback) ;
		 if($num_OfUserfeedback>0)
		 {
		 $arr_Userpostivefeedback      = mysql_fetch_assoc($detailsOfUserpostivefeedback);
		 }
                 $total_Userpostivefeedback    = $arr_Userpostivefeedback['total'];
		
		 if($total_Userpostivefeedback!=0)
		 $find_percentage   = ($total_Userpostivefeedback/$total_value_Userfeedback)*100;
		
		 if($find_percentage==0 || $find_percentage=='' || $total_Userpostivefeedback==0)
		 $find_percentage==0; 
		 else
		 $find_percentage   =  round($find_percentage,2);
		 
		 $smarty->assign("find_percentage", $find_percentage);	 
			 
                 //end of rating code

                $objUser->id = $_GET['sellerid'];
                $UserRes = $objUser->getUserDetails();
                $UserArr = mysql_fetch_array($UserRes);
                $smarty->assign("sellerid",$UserArr['id']);
                $smarty->assign("f_name",$UserArr['first_name']);
                $smarty->assign("l_name",$UserArr['last_name']);
                $smarty->assign("v_welcome",$UserArr['v_welcome']);
                $smarty->assign("v_payment",$UserArr['v_payment']);
                $smarty->assign("v_shipping",$UserArr['v_shipping']);
                $smarty->assign("v_refund_exchange",$UserArr['v_refund_exchange']);
                $smarty->assign("v_additional_info",$UserArr['v_additional_info']);
                $smarty->assign("store_name",$UserArr['store_name']);
                $smarty->assign("v_store_image",$UserArr['v_store_image']);
                $smarty->assign("reg_date",$UserArr['reg_date']);
                $smarty->assign("city",$UserArr['city']);
                $smarty->assign("state",$UserArr['state']);
                $smarty->assign("user_country_name",$objUser->getcountry($UserArr['country_id']));
}


//$objItem->approve_store   = 1; // for approved stores

$objItem->recent_status    = 2;
$objItem->inventory_check  = 1; // for quantity greater than inventory check or min qty
$objItem->delete_by_seller = 0; // 0 for showing restored 1 means deleted by seller
$objItem->delete_restored  = 0; // 0 for showing restored 1 means deleted by admin
$objItem->package_expired  = 0; // 0 for showing active packg 1 means expired packge
$objItem->locker_status    = 1;
//$objItem->hatting_status   = 0;
$objItem->seller_id        = $sellerid;
$image_details_item        = $objItem->getItemImageDetails();

#>>>>>>>>>>>>>>>>>>>>>>  Code for pagination START   <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<#

$pagination = new Pagination();

if(!isset($_GET['pageNumber']))
{
	$pageNumber = 1;
}
else
{
	$pageNumber= $_GET['pageNumber'];
}

$num_rows_items     = mysql_num_rows($image_details_item);
//number of records per page LIMIT
if(isset($_GET['limit']) && is_numeric($_GET['limit']))
{

	$to	= trim($_GET['limit']);
}
else
{
	$to	=	8;
}	
$from=($pageNumber-1)*$to;
$showPrevNext = true;
//$url = "admin_category.php?start_date=$start_date&end_date=$end_date&business=$business";
$url = basename($_SERVER['PHP_SELF'])."?sellerid=".$sellerid;
if($pageNumber==1 || $pageNumber=='')
{
	$counter=1;
}
else
{
	$counter = $pageNumber+$from-($pageNumber-1);
}
$pageLimit =" LIMIT $from,$to";
$pageLink = $pagination->getPageLinks($num_rows_items, $to, $url, $pageNumber, '', $showPrevNext);

// Assigning Pagination Links
$smarty->assign('pageLink',$pageLink);         

#>>>>>>>>>>>>>>>>>>>>>>>>  Code for pagination END   <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<#


$objItem->pageLimit = $pageLimit;
$objItem->recent_status = 2;
$objItem->locker_status = 1;
$objItem->seller_id = $sellerid;


$image_details_item1 = $objItem->getItemImageDetails();
$num_rows_items1     = mysql_num_rows($image_details_item1);
if($num_rows_items1>0)
{
while($arr_items_array = mysql_fetch_array($image_details_item1))
	{
	$item_values_list[]=   $arr_items_array;
	
	}
}
$page_counter = $pagination->getPageCounter($num_rows_items1);

$smarty->assign('no_records',$num_rows_items1);
$smarty->assign('page_counter',$page_counter);

$smarty->assign("users_items_details", $item_values_list);


if($_SERVER['REQUEST_METHOD']=='POST')
{
	$smarty->assign("message",$message);
}
//assign error/update message
$smarty->assign("error_msg",$error_msg);
$smarty->assign("update_msg",$update_msg);

//display template

$smarty->assign('site_page_title','Buyer List');
$smarty->assign('site_title',$site_title);
$smarty->display('view_locker.tpl');

?>
