<?php
include ('include/common.inc');
include ('class/class.user.inc');
include ('class/class.item.inc');
include ("include/authentiateUserLogin.php");
  
   
   //include ('include/Pagination.Class.php'); // For pagination

   $delete_item_value_id = $_REQUEST['delete_item_value'];// start here for delete code

  //create user class object
  $objItem                   = new Class_Item();
  $objUser                   = new Class_User();
  $objUser->user_id           = $_SESSION['session_user_id'];
  $objUser->del_rem_id        = $_GET['delete_item_value'];
  // to delete reminders
  if($_GET['delete_item_value']!='')
	{		
	$result_users_reminders               = $objUser->deletereminders();
	success_msg("Reminder is  successfully deleted !!");	
	redirect("view_reminders.php");
	}

  for($i=1;$i<=15;$i++)
    {
	   $next_15_days_array    = time() + ($i * 24 * 60 * 60);
       $next_15_month[]       = date('m', $next_15_days_array) ;
	   $next_15_days[]        = date('d', $next_15_days_array) ;
    }

   $next_15_month              = array_unique($next_15_month);		   
   $implode_days               = implode($next_15_days,',');
   $implode_month              = implode($next_15_month,',');
   $objUser->implode_month     = $implode_month;
   $objUser->implode_days      = $implode_days;
   $reminderlisting_details    = $objUser->getreminderlisting(); // to show listing of  reminders

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

    $num_rows_items     = mysql_num_rows($reminderlisting_details);
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

    $pageLimit =" LIMIT $from,$to";

    $pageLink = $pagination->getPageLinks($num_rows_items, $to, $url, $pageNumber,"1&order_by=$order_by_asc_desc", $showPrevNext);
    // Assigning Pagination Links

    $smarty->assign('pageLink',$pageLink); 
	
    #>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>  Code for pagination END   <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<#


    $objUser->pageLimit = $pageLimit;
    $objUser->user_id             = $_SESSION['session_user_id'];
    $reminderlisting_details      = $objUser->getreminderlisting();
    $num_rows_items1              = mysql_num_rows($reminderlisting_details);
    if($num_rows_items>0)
    {
     while($arr_items_array = mysql_fetch_array($reminderlisting_details))
		{
	        $item_values_list[]   = $arr_items_array;
		}
     }

    $page_counter                 = $pagination->getPageCounter($num_rows_items1);
	$error_msg="";
	$smarty->assign('page_counter',$page_counter);
	$smarty->assign("users_items_details", $item_values_list);
	$smarty->assign("ListItem",'listItem_');


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
	$smarty->assign('site_page_title','My Reminders List');
	$smarty->assign('site_title',$site_title);
	$smarty->display('view_15_days_remind.tpl');
?>
