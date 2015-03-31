<?php
include ('include/common.inc');
include ('class/class.cms.inc');
include ('class/class.user.inc');
include ('class/class.item.inc');
//create CMS class object

ini_set('session.cookie_domain', '.nethaat.com');

$_SESSION['session_user_id']=$_COOKIE['cook_session_user_id'];
$_SESSION['session_user_name']=$_COOKIE['cook_session_user_name'];
$_SESSION['session_user_email_id']=$_COOKIE['cook_session_user_email_id'];

//phpSESSID
$smarty->assign("anObject" , new Class_Dynamic() );

$name_after_domain           = $_SERVER['HTTP_HOST'];
$exp_name_after_domain       = explode(".",$name_after_domain);
$add_this_name               = $exp_name_after_domain[1].'.'.$exp_name_after_domain[2];
//echo '<br>';
$add_this_username           = $exp_name_after_domain[1]; 

$objItem                     = new Class_Item();
$objUser                     = new Class_User();
$objUser->username_dom       = $add_this_username;
$reslt_seluser               = $objUser->selectUser();
$num_reslt_seluser           = mysql_num_rows($reslt_seluser);
if($num_reslt_seluser>0)
{

$arr_reslt_seluser           = mysql_fetch_assoc($reslt_seluser);
$reslt_seluserId             = $arr_reslt_seluser['user_id_value'];
$_REQUEST['id']              = $reslt_seluserId;

}

//echo $_REQUEST['id']              = $reslt_seluserId;

//if($_REQUEST['id']=='')
if($_REQUEST['id']=='')
redirect($_SERVER['HTTP_REFERER']);

$item_values_list               = array();
$sid                            = $_REQUEST['id'];

//$objItem->hatting_status      = 1; //hatting_status
//$image_details_item           = $objItem->getItemImageDetails();

//hatting_status


$_SESSION['giftcard_seller_id'] = $sid;
$objItem->delete_restored   = 0; // 0 for showing restored 1  means deleted by admin to items
$objItem->locker_status     = 0;
$objItem->delete_by_seller  = 0;
$objItem->seller_id         = $sid;
$objItem->package_expired   = 0; // 0 for showing active packg 1 means expired packge
//$objItem->coupon_status   = 1;
$objItem->request_item_id   = 0; // 0 for showing request custom item.


$image_details_item             = $objItem->getItemImageDetails_withdiscount();

//************************************** Code for pagination Start   ******************

$pagination = new Pagination();
if(!isset($_GET['pageNumber']))
{
	$pageNumber = 1;
}
else
{
	$pageNumber	= $_GET['pageNumber'];
}

$num_rows_items     = mysql_num_rows($image_details_item);
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

$url = basename($_SERVER['PHP_SELF'])."?id=".$sid;
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

//************************************** Code for pagination END   ******************
$date_forcheck =      date('Y-m-d');
$smarty->assign('date_forcheck',$date_forcheck);

$objItem->pageLimit = $pageLimit;
$objItem->seller_id = $sid;


//$image_details_item1 = $objItem->getItemImageDetails();
$image_details_item1 = $objItem->getItemImageDetails_withdiscount();
$num_rows_items1     = mysql_num_rows($image_details_item1);

//$num_rows_items1     = mysql_num_rows($image_details_item1);
if($num_rows_items1>0)
{
  while($arr_items_array = mysql_fetch_array($image_details_item))
  {
  $item_values_list[]	=   $arr_items_array;
   //	 $item_values_list_itm_ids[]	=   $arr_items_array['item_id'];
  }
}
  
//start of rating code
$smarty->assign("num_rows_items1",$num_rows_items1);
$smarty->assign("users_items_details",$item_values_list);
//echo '<pre>';
//print_r($item_values_list);
$page_counter = $pagination->getPageCounter($num_rows_items1);

		// code for rating
		 $objUser->logged_user_id      = $_REQUEST['id']; //seller id
		 $detailsOfUserfeedback        = $objUser->getdetailsOfUsertotalfeedback();
		 $num_OfUserfeedback           = mysql_num_rows($detailsOfUserfeedback) ;
		 if($num_OfUserfeedback>0)
		 {
		 $arr_Userfeedback = mysql_fetch_assoc($detailsOfUserfeedback);
		 $total_value_Userfeedback     =  $arr_Userfeedback['total'];
		 }
         
         
		 $detailsOfUserpostivefeedback = $objUser->getdetailsOfUserpostivefeedback();
		 $num_OfUserpostivefeedback    = mysql_num_rows($detailsOfUserpostivefeedback) ;
		 if($num_OfUserfeedback>0)
		 {
		 $arr_Userpostivefeedback      = mysql_fetch_assoc($detailsOfUserpostivefeedback);
		 $total_Userpostivefeedback    = $arr_Userpostivefeedback['total'];
		 }
                 
		
		 if($total_Userpostivefeedback!=0)
		 $find_percentage   = ($total_Userpostivefeedback/$total_value_Userfeedback)*100;
		
		 if($find_percentage==0 || $find_percentage=='' || $total_Userpostivefeedback==0)
		 $find_percentage==0; 
		 else
		 $find_percentage   =  round($find_percentage,2);
		 
		 $smarty->assign("find_percentage", $find_percentage);	 
			 
                $smarty->assign("num_rows_items1",$num_rows_items1);
                $page_counter = $pagination->getPageCounter($num_rows_items1);

                $smarty->assign('page_counter',$page_counter);


//************************ store detail information ***********************************

if(isset($_REQUEST['id']) != "")
{
	$objUser->id = $_REQUEST['id'];
	$UserRes = $objUser->getUserDetails();
	$UserArr = mysql_fetch_array($UserRes);
	$smarty->assign("sellerid",$UserArr['id']);
	$smarty->assign("f_name",$UserArr['first_name']);
 	$smarty->assign("l_name",$UserArr['last_name']);
	$smarty->assign("username",$UserArr['username']);
 	$smarty->assign("email",$UserArr['email']);
	$smarty->assign("reg_date",$UserArr['reg_date']);
 	$smarty->assign("address1",$UserArr['address1']);
	$smarty->assign("address2",$UserArr['address2']);
 	$smarty->assign("city",$UserArr['city']);
	$smarty->assign("zipcode",$UserArr['zipcode']);
 	$smarty->assign("state",$UserArr['state']);
	$smarty->assign("v_store_image",$UserArr['v_store_image']);

	$smarty->assign("user_country_name",$objUser->getcountry($UserArr['country_id']));
	$smarty->assign("country_id",$UserArr['country_id']);
	$smarty->assign("phone1",$UserArr['phone1']);
 	$smarty->assign("phone2",$UserArr['phone2']);
	$smarty->assign("paypal_email",$UserArr['paypal_email']);
 	$smarty->assign("company_name",$UserArr['company_name']);
	$smarty->assign("company_address",$UserArr['company_address']);
 	$smarty->assign("company_phone",$UserArr['company_phone']);
	$smarty->assign("store_name",$UserArr['store_name']);
 	$smarty->assign("company_desc",$UserArr['company_desc']);
	$smarty->assign("security_question",$UserArr['security_question']);
 	$smarty->assign("security_answer",$UserArr['security_answer']);
 	$smarty->assign("last_login",$UserArr['last_login']);
	$smarty->assign("v_fetured_date",$UserArr['v_fetured_date']);
	$smarty->assign("approve_store", $UserArr['approve_store']);
	$smarty->assign("private_public_store",$UserArr['private_public_store']);
 
	$smarty->assign("v_welcome",$UserArr['v_welcome']);
 	$smarty->assign("v_payment",$UserArr['v_payment']);
	$smarty->assign("v_shipping",$UserArr['v_shipping']);
 	$smarty->assign("v_refund_exchange",$UserArr['v_refund_exchange']);
 	$smarty->assign("v_additional_info",$UserArr['v_additional_info']);
}

$smarty->assign('site_page_title','Nethaat: Store Information');
$smarty->assign('site_title',$site_title);
$smarty->display('featured_store_information.tpl');



/* star

$date_forcheck =      date('Y-m-d');
$smarty->assign('date_forcheck',$date_forcheck);
$objItem->pageLimit = $pageLimit;
$objItem->seller_id = $sid;

//$image_details_item1 = $objItem->getItemImageDetails();
$image_details_item1 = $objItem->getItemImageDetails_withdiscount();
$num_rows_items1     = mysql_num_rows($image_details_item1);
if($num_rows_items1>0)
{
	while($arr_items_array = mysql_fetch_array($image_details_item))
	{
		 $item_values_list[]	=   $arr_items_array;
	//	 $item_values_list_itm_ids[]	=   $arr_items_array['item_id'];
	}
}
//print_r($item_values_list);

 *end /
 */
?>
