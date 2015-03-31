<?php
include ('include/common.inc');
//include ('class/class.user.inc');
include ("include/authentiateUserLogin.php");
include ('class/class.item.inc');
//include ('include/Pagination.Class.php'); // For pagination
$item_category_id          = $_REQUEST['item_category_id'];

$objItem                   = new Class_Item();


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
	//redirect($add_this_name_red);
 
}
$item_values_list          = array();
//$obj_item->update_item_id = $_REQUEST['item_id'];
$objItem->recent_status    = 2;
$objItem->hatting_status   = 1;
$objItem->inventory_check  = 1;
$objItem->delete_by_seller = 0;
$objItem->request_item_id  = 0; // request items should not be displayed
//$objItem->approve_store  = 1;
$objItem->locker_status    = 0;
$objItem->delete_restored  = 0;  // 0 for showing restored 1 means deleted by admin
$objItem->package_expired  = 0; // 0 for showing active packg 1 means expired packge

if($item_category_id!='')
$objItem->category_id      = $item_category_id ;
$image_details_item        = $objItem->getItemImageDetails();


#>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>  Code for pagination START   <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<#
  
  
$smarty->assign('BID_LIMIT_VAL',$arr_fetch_BIDLIMIT['number_bids']);


///// code ends here


$pagination = new Pagination();
//print_r($_SESSION);
if(!isset($_GET['pageNumber']))
{
	$pageNumber = 1;
}
else
{
	$pageNumber= $_GET['pageNumber'];
}

$num_rows_items     = mysql_num_rows($image_details_item);
if($num_rows_items>0)
{/*
    $count_sub =0;
    while($arr_items_array = mysql_fetch_array($image_details_item))
  	{

         $item_ids_hated         =   $arr_items_array['item_id'];
         if($item_ids_hated !='')
           {
		        $objItem->item_id      =   $item_ids_hated ;
			$result_not_show_haated =   $objItem->getHaatedItemImageDetails();
			$num_show_haated        =   mysql_num_rows($result_not_show_haated); 
			if($num_show_haated ==0)
			  {
                            $count_sub = $count_sub+1;
						//$item_values_list[]     =   $arr_items_array;
	                  }
	   }
	}
	*/
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
$pageLink = $pagination->getPageLinks($count_sub, $to, $url, $pageNumber, '', $showPrevNext);

// Assigning Pagination Links
$smarty->assign('pageLink',$pageLink);         

#>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>  Code for pagination END   <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<#


$objItem->pageLimit = $pageLimit;
$objItem->recent_status = 2;
$objItem->inventory_check =1 ;
$image_details_item1 = $objItem->getItemImageDetails();
//$image_details_item1 = $objItem->getHaatedItemImageDetails();
$num_rows_items1     = mysql_num_rows($image_details_item1);
if($num_rows_items1>0)
{
	 $count_sub =0;
while($arr_items_array = mysql_fetch_array($image_details_item1))
		{

   $item_ids_hated         =   $arr_items_array['item_id'];
		 //echo 'hat_min_value-'.$arr_items_array['hat_min_value'];
	//	 echo '<br>';
		 //echo $item_ids_hated.'hat_max_value-'.$arr_items_array['hat_max_value'];
    if($item_ids_hated!='' )
	 //if($item_ids_hated !='' && $arr_items_array['hat_max_value']!='0')
			{   
			  $count_sub = $count_sub+1;
			  $item_values_list[]     =   $arr_items_array;
			 /*
			
			$objItem->item_id        =   $item_ids_hated ;
			$result_not_show_haated  =   $objItem->getHaatedItemImageDetails();
			
			$num_show_haated         =   mysql_num_rows($result_not_show_haated); 
			
			if($num_show_haated ==0)
			  {
			  $count_sub = $count_sub+1;
			  $item_values_list[]     =   $arr_items_array;
			  }*/
			}
		}
		
}

//echo '<pre>';
//print_r($item_values_list);
//$num_rows_items1 

$page_counter = $pagination->getPageCounter($count_sub);
//$page_counter = $pagination->getPageCounter($count_sub);
//$smarty->assign('no_records',$count_sub);
$smarty->assign('no_records',$count_sub);
$smarty->assign('page_counter',$page_counter);
$smarty->assign("users_items_details", $item_values_list);

//assign error/update message
$smarty->assign("error_msg",$error_msg);
$smarty->assign("update_msg",$update_msg);

//display template

$smarty->assign('site_page_title','Haating Items List');
$smarty->assign('site_title',$site_title);
$smarty->display('hatting-items.tpl');

?>
