<?php
include ('include/common.inc');
include ('class/class.user.inc');
include ('class/class.item.inc');
include ("include/authentiateUserLogin.php");
//include ('include/Pagination.Class.php'); // For pagination

    //create user class object
    $objUser = new Class_User();
    $objItem = new Class_Item();
    $pagination = new Pagination();
    $item_values_list = array();
    $objItem->hatting_status=1;
    $count_app =0;
    $objItem->bid_status          =   1;
    $objItem->buyer_id            =  $_SESSION['session_user_id'];
    $result_buy_haatedItemdetails =  $objItem->BuyHaatedItemDetails();
    $num_buy_haatedItemdetails    =  mysql_num_rows($result_buy_haatedItemdetails);

 #>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>  Code for pagination START   <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<#



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

$pageLimit =" LIMIT $from,$to";

$pageLink = $pagination->getPageLinks($num_rows_items, $to, $url, $pageNumber,"", $showPrevNext);

// Assigning Pagination Links

$smarty->assign('pageLink',$pageLink);         

#>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>  Code for pagination END   <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<#


$objItem->pageLimit = $pageLimit;
//$objItem->seller_id = $_SESSION['session_user_id'];
//$image_details_item1 = $objItem->getItemImageDetails();
// $num_rows_items1     = mysql_num_rows($image_details_item1);



$objItem->bid_status          =   1;
$objItem->buyer_id            =  $_SESSION['session_user_id'];
$result_buy_haatedItemdetails1 =  $objItem->BuyHaatedItemDetails();
$num_buy_haatedItemdetails1    =  mysql_num_rows($result_buy_haatedItemdetails1);
	if($num_buy_haatedItemdetails1>0)
		{  
			$count_app =0;
		    while($buy_hataed_arrayitems = mysql_fetch_assoc($result_buy_haatedItemdetails1))
							    	{
				                        $item_values_list[]=   $buy_hataed_arrayitems;
			              							
									    $count_app = $count_app +1;
									}
		      
				
		}
		//echo '<pre>';
	 //   print_r($item_values_list);

$page_counter = $pagination->getPageCounter($count_app);

//if(isset($this->pageLimit) && $this->pageLimit!="")
//		$sSQL .= $this->pageLimit;
$smarty->assign('page_counter',$page_counter);

$smarty->assign("users_items_details", $item_values_list);
// echo '<pre>';
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
if($_SERVER['REQUEST_METHOD']=='POST')
{

	extract($_POST);
    $obj_item->quantity_available = $available_quantity;
	//$obj_item->available_quantity = $available_quantity;
	$obj_item->user_id = $_SESSION['session_user_id'];
	$obj_item->item_value =$item_value;
	
	
	if($error_msg=="")
		{
	    
		$objDBReturn = $obj_item->insertUpdateItem();
	
		if($objDBReturn->nErrorCode==0)
		{
            success_msg("Quantity updated successfully");
		}
		else
		{
			//$error_msg = "Error occured ...!Please try again";
			failure_msg("Error occured while updating the quantity");
		}
		
		
		
	}
redirect("items_list.php");
}
/// END OF CODE



$smarty->assign("quantity_available_desc",'quantity_available_desc');
$smarty->assign("quantity_available_asc",'quantity_available_asc');
$smarty->assign("title_asc",'title_asc');
$smarty->assign("cost_asc",'cost_asc');
$smarty->assign("cost_desc",'cost_desc');

$smarty->assign("title_desc",'title_desc');


//display template
$smarty->assign('site_page_title','Nethaat: My Winning Haated Items List');

$smarty->assign('site_title',$site_title);
$smarty->display('buyer-haated-items.tpl');
?>
