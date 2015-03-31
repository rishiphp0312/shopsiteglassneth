<?php
include ('include/common.inc');
include ('class/class.user.inc');
include ('class/class.item.inc');
include ("include/authentiateUserLogin.php");
//include ('include/Pagination.Class.php'); // For pagination


  //create user class object
  $objUser              = new Class_User();

  
  $item_values_list = array();
  $objUser->user_id         = $_SESSION['session_user_id'];
  //$objItem->request_item_id  = 0; // request items should not be displayed
  $image_details_item         = $objUser->reminder_messagesListing();
 #>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>  Code for pagination START   <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<#
//3 = hold 1= active
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
	$url = basename($_SERVER['PHP_SELF'])."?serch_item_value=".$_REQUEST['serch_item_value'];
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
	
	
	$objUser->pageLimit = $pageLimit;
	$objUser->user_id   = $_SESSION['session_user_id'];
	
	//$obj_item->update_item_id = $_REQUEST['item_id'];
	
	$image_details_item1 = $objUser->reminder_messagesListing();
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
		
	$smarty->assign("ListItem",'listItem_');
	
	////// POST CODE FOR UPDATE QUANTITY
	
	
	
	
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
	$smarty->assign('site_page_title','My Reminder Message Listing');
	$smarty->assign('site_title',$site_title);
	$smarty->display('reminder_message_list.tpl');
	?>

