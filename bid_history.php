<?php
include ('include/common.inc');
include ('class/class.user.inc');
include ('class/class.item.inc');
include ("include/authentiateUserLogin.php");
//include ('include/Pagination.Class.php'); // For pagination

$smarty->assign("anObject" , new Class_Dynamic() );
//exit;
//create user class object
$objUser = new Class_User();

$objItem = new Class_Item();

$item_values_list = array();

        $objItem->hatting_status=1;
	$count_app =0;	
	//$objItem->bid_status          =   1;
	$objItem->buyer_id            =  $_SESSION['session_user_id'];
	$result_buy_haatedItemdetails =  $objItem->BuyerBIDHistory_Details();
 	$num_buy_haatedItemdetails    =  mysql_num_rows($result_buy_haatedItemdetails);

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
$num_rows_items       = $num_buy_haatedItemdetails;

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
$obj_item->seller_id = $_SESSION['session_user_id'];



$image_details_item1 = $objItem->getItemImageDetails();
$num_rows_items1     = mysql_num_rows($image_details_item1);

//$objItem->bid_status          =   1;
$objItem->buyer_id            =  $_SESSION['session_user_id'];
$result_buy_haatedItemdetails =  $objItem->BuyerBIDHistory_Details();
$num_buy_haatedItemdetails    =  mysql_num_rows($result_buy_haatedItemdetails);
                if($num_buy_haatedItemdetails>0)
		{  
		$count_app =0;
		 while($buy_hataed_arrayitems = mysql_fetch_assoc($result_buy_haatedItemdetails))
		{
		  $item_values_list[]=   $buy_hataed_arrayitems;
		 							
		    $count_app = $count_app +1;
		}
		      
		}
	

$page_counter = $pagination->getPageCounter($num_buy_haatedItemdetails);

//if(isset($this->pageLimit) && $this->pageLimit!="")
//		$sSQL .= $this->pageLimit;
$smarty->assign('page_counter',$page_counter);


$smarty->assign("users_items_details", $item_values_list);
//print_r($haated_item_det_buyers);





//get user details if user logged in
if(isset($_SESSION['session_user_id'])&& $_SESSION['session_user_id']!="")
{

		$objUser->id = $_SESSION['session_user_id'];
		$UserRes = $objUser->getUserLoginDetails();
		$UserArr = mysql_fetch_array($UserRes);

		//assign user details information
		
}

$smarty->assign("ListItem",'listItem_');

////// POST CODE FOR UPDATE QUANTITY
$obj_item   = new Class_Item();

/// END OF CODE



$smarty->assign("quantity_available_desc",'quantity_available_desc');
$smarty->assign("quantity_available_asc",'quantity_available_asc');
$smarty->assign("title_asc",'title_asc');
$smarty->assign("cost_asc",'cost_asc');
$smarty->assign("cost_desc",'cost_desc');

$smarty->assign("title_desc",'title_desc');


//display template
$smarty->assign('site_page_title','Nethaat :  My Bid History List');

$smarty->assign('site_title',$site_title);
$smarty->display('bid_history.tpl');
?>
