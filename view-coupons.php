<?php
include ('include/common.inc');
include ('class/class.user.inc');
include ('class/class.item.inc');
include ("include/authentiateUserLogin.php");
//create user class object
$objUser = new Class_User();

$objItem = new Class_Item();

$order_by_asc_desc = $_REQUEST['order_by'];

// code for item to insert values for haating or for particular item min and max costs

$delete_coupon_id = $_REQUEST['delete_coupon_id'];
if($delete_coupon_id!='')
{
    
   $objItem->del_coupon_id              = $delete_coupon_id;
   $image_details_item                  = $objItem->deleteCoupons();
   success_msg("Coupon deleted successfully");
   redirect("view-coupons.php");
    
}
// code end here after making item haat
// start here for code on hold when status=3
// code ends here for item on hold and on unhold
    //$objItem_delete->buyer_id          = $_SESSION['session_user_id'];
   $item_values_list                    = array();
   $objItem->hatting_status             = 0;
   $objItem->seller_id                  = $_SESSION['session_user_id'];
   $image_details_item                  = $objItem->getitems_withCoupons();

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

$num_rows_items     = mysql_num_rows($image_details_item);
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

//$obj_item->update_item_id = $_REQUEST['item_id'];

$image_details_item1 = $objItem->getitems_withCoupons();
$num_rows_items1     = mysql_num_rows($image_details_item1);
if($num_rows_items>0)
{
while($arr_items_array = mysql_fetch_array($image_details_item1))
		{
	     $item_values_list[]=   $arr_items_array;
			}
}
//echo $num_rows_items1;



$page_counter = $pagination->getPageCounter($num_rows_items1);

//if(isset($this->pageLimit) && $this->pageLimit!="")
//		$sSQL .= $this->pageLimit;
$smarty->assign('page_counter',$page_counter);

$smarty->assign("users_items_details", $item_values_list);

	
//get user details if user logged in
	if(isset($_SESSION['session_user_id'])&& $_SESSION['session_user_id']!="")
	{

		$objUser->id = $_SESSION['session_user_id'];
		$UserRes = $objUser->getUserLoginDetails();
		$UserArr = mysql_fetch_array($UserRes);

		//assign user details information
		$smarty->assign("f_name",$UserArr['FirstName']);
		$smarty->assign("l_name",$UserArr['LastName']);
		$smarty->assign("contact_email",$UserArr['Email']);
		$smarty->assign("phone",$UserArr['Phone']);
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
			$error_msg = "Error occured ...!Please try again";
				failure_msg("Error occured while updating the quantity");
		}
		//redirect("sell-an-item.php");
		//if($item_id_value=='')
		//redirect("upload_imgage.php");
		//else
		//redirect("upload_imgage.php?item_id_value=".$item_id_value);
		
		
	}
redirect("items_list.php");
}
/// END OF CODE



//assign error/update message
//$title_asc$quantity_available_desc
$smarty->assign("quantity_available_desc",'quantity_available_desc');
$smarty->assign("quantity_available_asc",'quantity_available_asc');
$smarty->assign("title_asc",'title_asc');
$smarty->assign("cost_asc",'cost_asc');
$smarty->assign("cost_desc",'cost_desc');

$smarty->assign("title_desc",'title_desc');
$smarty->assign("error_msg",$error_msg);
$smarty->assign("update_msg",$update_msg);

//display template
$smarty->assign('site_page_title','View Coupons');
$smarty->assign('site_title',$site_title);
$smarty->display('view-coupons.tpl');
?>
