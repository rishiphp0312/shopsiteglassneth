<?php
include ('include/common.inc');
//include ('class/class.user.inc');
include ('class/class.item.inc');
$item_category_id = $_REQUEST['item_category_id'];

$objItem = new Class_Item();
$item_values_list = array();
//$obj_item->update_item_id = $_REQUEST['item_id'];

$objItem->recent_status  = 2;
$objItem->hatting_status =0 ;
$objItem->inventory_check =1 ;
if($item_category_id!='')
$objItem->category_id = $item_category_id ;
$coupon_code = trim($_POST['discount_value'],' ');

 //$image_details_item     = $objItem->getItemImageDetails();
$image_details_item     = $objItem->getDiscountItemDetails(date('Y-m-d'),$coupon_code);
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
if($num_rows_items >0)
{
$_SESSION['str_coupon_code'] = $coupon_code;
}
//number of records per page LIMIT
if(isset($_GET['limit']) && is_numeric($_GET['limit']))
{

	$to	= trim($_GET['limit']);
}
else
{
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
$pageLimit =" LIMIT $from,$to";
$pageLink = $pagination->getPageLinks($num_rows_items, $to, $url, $pageNumber, '', $showPrevNext);

// Assigning Pagination Links
$smarty->assign('pageLink',$pageLink);         

#>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>  Code for pagination END   <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<#


$objItem->pageLimit = $pageLimit;
$objItem->recent_status = 2;

$image_details_item1 = $objItem->getDiscountItemDetails(date('Y-m-d'),$coupon_code);
$num_rows_items1     = mysql_num_rows($image_details_item1);
if($num_rows_items1>0)
{
while($arr_items_array = mysql_fetch_array($image_details_item1))
		{
	     $item_values_discount =   $item_values_list['discount_type'];
	     $item_values_list[]   =   $arr_items_array;
	
		}
}

//$num_rows_items1 
$page_counter = $pagination->getPageCounter($num_rows_items1);

//if(isset($this->pageLimit) && $this->pageLimit!="")
//		$sSQL .= $this->pageLimit;
//$item_values_list
$smarty->assign('discount_type_val', $item_values_list[0]['discount_type']);
$smarty->assign('discount_amount',$item_values_list[0]['discount_amount']);

$smarty->assign('no_records',$num_rows_items1);
$smarty->assign('page_counter',$page_counter);

$smarty->assign("users_items_details", $item_values_list);



//get user details if user logged in
	if(isset($_SESSION['session_user_id'])&& $_SESSION['session_user_id']!="")
	{
/*
		$objUser->id = $_SESSION['session_user_id'];
		$UserRes = $objUser->getUserLoginDetails();
		$UserArr = mysql_fetch_array($UserRes);

		//assign user details information
		$smarty->assign("f_name",$UserArr['FirstName']);
		$smarty->assign("l_name",$UserArr['LastName']);
		$smarty->assign("contact_email",$UserArr['Email']);
		$smarty->assign("phone",$UserArr['Phone']);
*/	}






if($_SERVER['REQUEST_METHOD']=='POST')
{

	
	$smarty->assign("message",$message);
	

}
//assign error/update message
$smarty->assign("error_msg",$error_msg);
$smarty->assign("update_msg",$update_msg);

//display template

$smarty->assign('site_page_title','Discount Items List');
$smarty->assign('site_title',$site_title);
$smarty->display('disocunted_items.tpl');

?>


