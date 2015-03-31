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

if(isset($_SESSION['session_user_id'])&& $_SESSION['session_user_id']!="")
{
	$objUser->id = $_SESSION['session_user_id'];
	$UserRes = $objUser->getUserDetails();
	$UserArr = mysql_fetch_array($UserRes);
	$date = date("Y-m-d H:i:s");
	
	$smarty->assign("date",$date);
	$smarty->assign("locker_password",$UserArr['locker_password']);
	$smarty->assign("locker_create_date",$UserArr['locker_create_date']);
 	$smarty->assign("locker_last_date",$UserArr['locker_last_date']);
}

$objItem           = new Class_Item();
$order_by_asc_desc = $_REQUEST['order_by'];
$objItem_delete    = new Class_Item();
if($delete_item_value_id!='')
{
        //$objItem_delete->update_item_id   = $delete_item_value_id;
    $objItem_delete->item_value       = $delete_item_value_id;
	$objItem_delete->delete_by_seller = 1;
	$objItem_delete->insertUpdateItem();

        /*
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
    
   
     */
    	if($removeItem->nErrorCode==0)
	{
        success_msg("Item has been deleted successfully!!");
	redirect('locker_items_seller.php');
	}
	else
	{
	failure_msg("Error occured item selected was not deleted ");
	redirect('locker_items_seller.php');
	}


	//if($delete_item_value_id=='')
	redirect('locker_items_seller.php');
}

$item_values_list = array();

 $objItem->locker_status = "1";
 $order_by_asc_desc          = $_REQUEST['order_by'];
 $objItem->order_by_variable = $order_by_asc_desc;
 $objItem->delete_by_seller = 0;  // not deletd by seller
 $objItem->seller_id         = $_SESSION['session_user_id'];
 $objItem->request_item_id  = 0; // request items should not be displayed
 $image_details_item         = $objItem->getItemImageDetails();

 #>>>>>>>>>>>>>>>>>>>  Code for pagination START   <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<#

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
$pageLink = $pagination->getPageLinks($num_rows_items, $to, $url, $pageNumber,"1&order_by=$order_by_asc_desc", $showPrevNext);
$smarty->assign('pageLink',$pageLink);      

#>>>>>>>>>>>>>>>>>>>>>>>>  Code for pagination END   <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<#


$objItem->pageLimit = $pageLimit;
$objItem->seller_id = $_SESSION['session_user_id'];

$objItem->s = $_SESSION['session_user_id'];
 
$image_details_item1 = $objItem->getItemImageDetails();
$num_rows_items1     = mysql_num_rows($image_details_item1);
if($num_rows_items>0)
{
while($arr_items_array = mysql_fetch_array($image_details_item1))
		{
	     $item_values_list[]=   $arr_items_array;
		}
}

$page_counter = $pagination->getPageCounter($num_rows_items1);

$smarty->assign('page_counter',$page_counter);
$smarty->assign("users_items_details", $item_values_list);

$smarty->assign('usd',CURRENCY);

//display template
$smarty->assign('site_page_title','Nethaat : My Locker Items');

$smarty->assign('site_title',$site_title);
$smarty->display('locker_items_seller.tpl');
?>
