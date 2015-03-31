<?php
include ('include/common.inc');
include ('class/class.user.inc');
include ('class/class.item.inc');
//echo '<pre>';
//print_r($_SESSION); 
$objUser = new Class_User();


 $name_after_domain     = $_SERVER['HTTP_HOST'];
 $exp_name_after_domain = explode(".",$name_after_domain);
 $curent_page           =  $_SERVER['PHP_SELF'];
 $base_curent_page      = basename($curent_page);
 
 $exp_name_after_domain = explode(".",$name_after_domain);
if($name_after_domain=='www.nethaat.com' )
{
}
else
{

    $add_this_name_red         =   'featured_store_information.php';
    // header("Location:$add_this_name_red");
	redirect($add_this_name_red);
 
}


if($_REQUEST['cancel_value']==1)
{

                        $_SESSION['d_cost_item']='';
			$_SESSION['firstcardcode']='';
			$_SESSION['calculategiftcardvalue']='';
			$_SESSION['reciveramount_1_card']='';
			$_SESSION['reciveramount_2_card']='';
			$_SESSION['show_d_cost_item']='';
			$_SESSION['service_rate']='';
			$_SESSION['det_seller_id']='';
			$_SESSION['show_d_cost_item']='';
			
			
			unset($_SESSION['firstcardcode']);
			unset($_SESSION['det_seller_id']);
			unset($_SESSION['nvpReqArray']);
			
			unset($_SESSION['calculategiftcardvalue']);
			unset($_SESSION['secondcard_code']);
			unset($_SESSION['show_d_cost_item']);
			unset($_SESSION['reciveramount_1_card']);
			unset($_SESSION['reciveramount_2_card']);
			unset($_SESSION['ship_quantity']);
			unset($_SESSION['service_rate']);
			unset($_SESSION['d_item_id']);
			unset($_SESSION['shipping_address1']);
			unset($_SESSION['shipping_address2']);
			unset($_SESSION['dest_zip_code']);
			unset($_SESSION['city']);
			unset($_SESSION['giftcardreciverstate']);
			unset($_SESSION['show_d_cost_item']);


}


$item_category_id = $_REQUEST['item_category_id'];
$objItem = new Class_Item();
$item_values_list = array();
$main_cat_id      = $_REQUEST['main_cat_id'];


if($main_cat_id!='')
{
$objItem->main_cat_id       = $main_cat_id ;
$get_no_of_subcategories    = $objItem->get_sub_categories_seller();
$num_no_of_subcategories    = mysql_num_rows($get_no_of_subcategories);
if($num_no_of_subcategories>0)
{
	while($arr_no_of_subcategories = mysql_fetch_assoc($get_no_of_subcategories))
	 {
	 $no_of_subcategories .= $arr_no_of_subcategories['category_id'].',';
	 }
}
$no_of_subcategories    = trim($no_of_subcategories,',');
}
$objItem->recent_status   = 2;
$objItem->hatting_status  = 0; // for not showing  haating items
$objItem->inventory_check = 1; // for quantity greater than inventory check or min qty
//$objItem->approve_store   = 1; // for approved stores
$objItem->request_item_id  = 0; // request items should not be displayed
$objItem->delete_by_seller = 0;  // 0 for showing restored 1 means deleted by seller
$objItem->locker_status   = 0;  // for not showing locker items
$objItem->delete_restored = 0;  // 0 for showing restored 1 means deleted by admin
$objItem->package_expired = 0; // 0 for showing active packg 1 means expired packge

if($main_cat_id!='' )
$objItem->subcategories_exisit = $no_of_subcategories;

if($item_category_id!='')
$objItem->category_id   = $item_category_id;
$image_details_item     = $objItem->getItemImageDetails();

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
//echo $_GET['limit'];
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
if($main_cat_id!='')
{
$main_cat_id_str = "main_cat_id=$main_cat_id";
}
else
{
$main_cat_id_str = "";
}
//$url = "admin_category.php?start_date=$start_date&end_date=$end_date&business=$business";
$url = basename($_SERVER['PHP_SELF'])."?$main_cat_id_str";
if($pageNumber==1 || $pageNumber=='')
{
	$counter=1;
}
else
{
	$counter = $pageNumber+$from-($pageNumber-1);
}
$pageLimit =" LIMIT $from,$to";
$pageLink = $pagination->getPageLinks($num_rows_items, $to,$url,$pageNumber, '', $showPrevNext);

// Assigning Pagination Links
$smarty->assign('pageLink',$pageLink);         

#>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>  Code for pagination END   <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<#


$objItem->pageLimit = $pageLimit;


$image_details_item1 = $objItem->getItemImageDetails();
$num_rows_items1     = mysql_num_rows($image_details_item1);
if($num_rows_items1>0)
{
while($arr_items_array = mysql_fetch_array($image_details_item1))
		{
	     $item_values_list[]=   $arr_items_array;
	
		}
}
//$num_rows_items1 
$page_counter = $pagination->getPageCounter($num_rows_items1);

//if(isset($this->pageLimit) && $this->pageLimit!="")
//		$sSQL .= $this->pageLimit;
$smarty->assign('no_records',$num_rows_items1);
$smarty->assign('page_counter',$page_counter);

$smarty->assign("users_items_details", $item_values_list);

	/*
	
*/

//get user details if user logged in
	if(isset($_SESSION['session_user_id'])&& $_SESSION['session_user_id']!="")
	{}






if($_SERVER['REQUEST_METHOD']=='POST')
{
	
	$smarty->assign("message",$message);
	

}
//assign error/update message
$smarty->assign("error_msg",$error_msg);
$smarty->assign("update_msg",$update_msg);

//display template

//$smarty->assign('site_page_title','Nethaat: Buyers List');
//$smarty->assign('site_title',$site_title);
$objUser->page_id = basename($_SERVER['PHP_SELF']);
$result_userinfo        = $objUser->select_metaTags();
$num_usersinfo          = mysql_num_rows($result_userinfo);
if($num_usersinfo>0)
{

    $page_header_info = mysql_fetch_assoc($result_userinfo);
    $title_page       = $page_header_info['meta_title'];
 // echo '<br>';
    $meta_keywords    = $page_header_info['meta_keywords'];// echo '<br>';
    $meta_description = $page_header_info['meta_description'];// echo '<br>';

}
//assign variable and display template
//$smarty->assign('site_page_title','Nethaat : '.SITE_HOME);
$smarty->assign('site_page_title',$title_page);
$smarty->assign('site_title',$title_page);
$smarty->assign('META_DESCRIPTION',$META_DESCRIPTION);
$smarty->assign('META_KEYWORDS',$meta_keywords);
$smarty->display('buyer.tpl');

?>
