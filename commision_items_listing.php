<?php
include ('include/common.inc');
include ('class/class.user.inc');
include ('class/class.item.inc');
include ("include/authentiateUserLogin.php");
//include ('include/Pagination.Class.php'); // For pagination

//echo 'pay=='.PAYPAL_URL;

 // start here for delete code
 $delete_item_value_id = $_REQUEST['delete_item_value'];
//exit;
//create user class object
$objUser = new Class_User();
$objItem = new Class_Item();
// code ends here for item on hold and on unhold
$objItem_delete = new Class_Item();
$order_by_asc_desc = $_REQUEST['order_by'];


if($delete_item_value_id!='')
{
    /*
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
redirect('items_list.php');
		//if($delete_item_value_id=='')
*/		
}

  $item_values_list = array();

  //$obj_item->update_item_id = $_REQUEST['item_id'];
  $order_by_asc_desc            = $_REQUEST['order_by'];
  // if($order_by_asc_desc!='')
  $objItem->default_value       = 1;
  $objItem->seller_id           = $_SESSION['session_user_id'];
  $objItem->purchased_date      = 13;
  $image_details_item           = $objItem->getsolditem_withcommision();

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

//$obj_item->update_item_id = $_REQUEST['item_id'];

$objItem->pageLimit     = $pageLimit;
$objItem->seller_id     = $_SESSION['session_user_id'];
$objItem->default_value = 1;
$image_details_item1    = $objItem->getsolditem_withcommision();
$num_rows_items1        = mysql_num_rows($image_details_item1);
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


        $total_item_commision          = $objItem->getTotalCommision_OnSoldItem();
    //    echo '<br>';
        $num_total_itemcommision       = mysql_num_rows($total_item_commision);
        //echo '<br>';
        if($num_total_itemcommision>0)
        {
        //while($arr_tot_comm = mysql_fetch_array($total_item_commision))
           $arr_tot_comm = mysql_fetch_array($total_item_commision);
           $comma_trans_ids    =   $arr_tot_comm['all_trans_ids'];
           $total_amt_commison =   $arr_tot_comm['total_amt_commison'];
           
        }

       $smarty->assign("comma_trans_ids",$comma_trans_ids);
       $smarty->assign("total_amt_commison",$total_amt_commison);

       $smarty->assign("ListItem",'listItem_');

////// POST CODE FOR UPDATE QUANTITY
$obj_item   = new Class_Item();
if($_SERVER['REQUEST_METHOD']=='POST')
{

	extract($_POST);
        $obj_item->quantity_available = $available_quantity;
	//$obj_item->available_quantity = $available_quantity;
	$obj_item->user_id            = $_SESSION['session_user_id'];
	$obj_item->item_value         = $item_value;


	if($error_msg=="")
		{

		$objDBReturn         = $obj_item->insertUpdateItem();

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
                redirect("commision_items_listing.php");
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
$smarty->assign('site_page_title','My Commision  List');
$smarty->assign('site_title',$site_title);
$smarty->display('commision_items_listing.tpl');
?>
