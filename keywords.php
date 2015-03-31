<?php
include ('include/common.inc');
include ("class/class.user.inc");
include ("class/class.item.inc");
include ('class/class.cms.inc');
$smarty->assign("anObject" , new Class_Dynamic() );

$item_category_id = $_REQUEST['item_category_id'];

$objItem = new Class_Item();
$item_values_list = array();
$main_cat_id      = $_REQUEST['main_cat_id'];

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
//if(count()>0)

//$obj_item->update_item_id = $_REQUEST['item_id'];


if($main_cat_id!='' )
$objItem->subcategories_exisit = $no_of_subcategories;
	
if($item_category_id!='')
$objItem->category_id   = $item_category_id;
if($_REQUEST['search_Keywords']!='')
{
		$objItem->recent_status    = 2;
		$objItem->hatting_status   = 0;
		$objItem->inventory_check  = 1;
       //$objItem->approve_store   = 1;
	    $objItem->request_item_id  = 0; // request items should not be displayed
		$objItem->locker_status    = 0;
        $objItem->delete_by_seller = 0;   // not deleted by seller
		$objItem->delete_restored  = 0;    // 0 for showing restored 1 means deleted by admin
        $objItem->package_expired  = 0;    // 0 for showing active packg 1 means expired packge

        $objItem->search_Keywords  = trim($_REQUEST['search_Keywords'],"");
		$image_details_item        = $objItem->getbasicsearchResults();
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
		$to	=	12;
	}	
	$from=($pageNumber-1)*$to;
	$showPrevNext = true;
	//$url = "admin_category.php?start_date=$start_date&end_date=$end_date&business=$business";
    $url = basename($_SERVER['PHP_SELF'])."?main_cat_id=$main_cat_id&search_Keywords=".$_REQUEST['search_Keywords'];
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
	
	$image_details_item1 = $objItem->getbasicsearchResults();
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

		}

//if(isset($this->pageLimit) && $this->pageLimit!="")
//		$sSQL .= $this->pageLimit;
$smarty->assign('no_records',$num_rows_items1);
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
$smarty->assign('site_page_title','Nethaat : Searched Items');

$smarty->assign('site_title',$site_title);
$smarty->display('keywords.tpl');

?>
