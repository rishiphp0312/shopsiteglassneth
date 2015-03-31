<?php
include ('include/common.inc');
include ('class/class.user.inc');
include ('class/class.item.inc');
include ("include/authentiateUserLogin.php");
//include ('include/Pagination.Class.php'); // For pagination


     
 $delete_item_value_id = $_REQUEST['delete_item_value'];// start here for delete code
//exit;
//create user class object



$objUser = new Class_User();

$objItem = new Class_Item();

$order_by_asc_desc = $_REQUEST['order_by'];


 /*
 // items with discounted coupons should not have haating link
  $objCoupon->item_id            = $details_item_value;
  $result_coupon_exsist1         = $objCoupon->getCouponDetails_expiredornot();
  $num_coupon_expiry1            = mysql_num_rows($result_coupon_exsist1);
  if($num_coupon_expiry1>0)
  $smarty->assign('coupon_d_not_posted',$chk_coupon);
  ///////// end of code 
  */
 


// start here for code on to make item haat  when status=3
$make_item_haat = $_REQUEST['make_item_haat'];
//code for put on hold 
if($make_item_haat!='')
{
	$objItem->item_value          = $make_item_haat;
	$objItem->hatting_status      = 1;
    $image_details_item1          = $objItem->insertUpdateItem1('');

	    success_msg("Item has been been send to hatting list !!");
		redirect('my-haating-items-list.php');

}


// code end here after making item haat
// start here for code on hold when status=3
$put_hold_item_id = $_REQUEST['put_hold_item'];
//code for put on hold 
if($put_hold_item_id!='')
{
	$objItem->item_value=$put_hold_item_id;
	$image_details_item1 = $objItem->insertUpdateItem1('3');
	success_msg("Item has been been put on hold !!");
		redirect('items_list.php');

}


// code for put on hold 

$remove_hold_item_id = $_REQUEST['remove_hold_item'];

if($remove_hold_item_id!='')
{
	$objItem->item_value    = $remove_hold_item_id;
	$image_details_item1 = $objItem->insertUpdateItem1('0');
	success_msg("Item has been been remove from hold !!");
		redirect('items_list.php');

}


// code ends here for item on hold and on unhold
$objItem_delete = new Class_Item();
if($delete_item_value_id!='')
{
	$objItem_delete->update_item_id=$delete_item_value_id;
    $image_details_item1 = $objItem_delete->getItemImageDetails();
	
	$num_rows_items1     = mysql_num_rows($image_details_item1);
	
	if($num_rows_items1>0)
		{
	$arr_items_array = mysql_fetch_assoc($image_details_item1);
	
	//print_r($arr_items_array);
	
	if($arr_items_array['image1']!='')
	{
    $remove_image1   = $arr_items_array['image1'];
	@unlink('uploads/thumbs/'.$remove_image1);
	@unlink('uploads/'.$remove_image1);
	}
	if($arr_items_array['image2']!='')
	{
    $remove_image2   = $arr_items_array['image2'];
	@unlink('uploads/thumbs/'.$remove_image2);
	@unlink('uploads/'.$remove_image2);
	}

    if($arr_items_array['image3']!='')
	{
    $remove_image3   = $arr_items_array['image3'];
	@unlink('uploads/thumbs/'.$remove_image3);
	@unlink('uploads/'.$remove_image3);
	}

	 if($arr_items_array['image4']!='')
	{
    $remove_image4   = $arr_items_array['image4'];
	@unlink('uploads/thumbs/'.$remove_image4);
	@unlink('uploads/'.$remove_image4);
	}
    
	  if($arr_items_array['image5']!='')
	{
    $remove_image5   = $arr_items_array['image5'];
	@unlink('uploads/thumbs/'.$remove_image5);
	@unlink('uploads/'.$remove_image5);
	}

	}
	$objItem_delete->del_item_id = $delete_item_value_id;
	$removeItem                  = $objItem_delete->deleteItems();
    
	if($removeItem->nErrorCode==0)
	{
        success_msg("Item has been deleted successfully!!");
		redirect('items_list.php');
	}
	else
	{
 failure_msg("Error occured item selected was not deleted ");
 redirect('items_list.php');
	}

		//if($delete_item_value_id=='')
		redirect('items_list.php');
}

$item_values_list = array();


//$obj_item->update_item_id = $_REQUEST['item_id'];
  $order_by_asc_desc          = $_REQUEST['order_by'];
  // if($order_by_asc_desc!='')
  $objItem->order_by_variable = $order_by_asc_desc;    
  $objItem->status            = 0;

  $objItem->seller_id         = $_SESSION['session_user_id'];
  $image_details_item         = $objItem->getItemImageDetails();

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
$objItem->seller_id = $_SESSION['session_user_id'];

//$obj_item->update_item_id = $_REQUEST['item_id'];

$image_details_item1 = $objItem->getItemImageDetails();
$num_rows_items1     = mysql_num_rows($image_details_item1);
if($num_rows_items1>0)
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

	/*
	if(isset($resCMSRow['page_title']))
	{
		$page_title = $resCMSRow['page_title'];
	}
	else
	{
		$page_title = SITE_CONTACT;
	}
*/

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
$smarty->assign('site_page_title','My Pending Items List');
$smarty->assign('site_title',$site_title);
$smarty->display('seller_pending_items.tpl');
?>
