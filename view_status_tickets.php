<?php
include ('include/common.inc');
include ('class/class.user.inc');
include ('class/class.item.inc');
include ("class/class.ticket.inc");
include ("include/authentiateUserLogin.php");
   //include ('include/Pagination.Class.php'); // For pagination

  
  //create user class object
  $objUser                         = new Class_User();
  $obj_ticket                      = new Class_Ticket();
  $serch_status                    = $_REQUEST['serch_status'];
  //$_REQUEST['serch_status'];
  if($_REQUEST['serch_status']!=2 && $_REQUEST['serch_status']!='')
  {
  $obj_ticket->status              = $_REQUEST['serch_status'];
  }
  $obj_ticket->user_id             = $_SESSION['session_user_id'];
  $obj_ticket->order_date_genrated = 1;
  $Ticketlisting_details           = $obj_ticket->getTicketDetails(); // to show listing of  Ticket
  $objUser->del_rem_id             = $_REQUEST['delete_item_value'];
  if($_REQUEST['close_ticket_id']!='')
  {
  $obj_ticket->ticket_id           =  $_REQUEST['close_ticket_id']; 
  $obj_ticket->status              =   1; // 1 to close ticket  	
  $Ticket_close                    =  $obj_ticket->insertUpdateTicket();		
    success_msg("Ticket closed successfully !!");	
	redirect("view_status_tickets.php");
  }

 #>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>  Code for pagination START   <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<#
 
//$obj_ticket->ticket_id                =  0; 




if(!isset($_GET['pageNumber']))
{
	$pageNumber = 1;
}
else
{
	$pageNumber= $_GET['pageNumber'];
}

$num_rows_items     = mysql_num_rows($Ticketlisting_details);
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
$url = basename($_SERVER['PHP_SELF'])."?serch_status=$serch_status";
if($pageNumber==1 || $pageNumber=='')
{
	$counter=1;
}
else
{
	$counter = $pageNumber+$from-($pageNumber-1);
}

$pageLimit =" LIMIT $from,$to ";
$pagination = new Pagination();

$pageLink = $pagination->getPageLinks($num_rows_items, $to, $url, $pageNumber,"", $showPrevNext);
//$pageLink = $pagination->getPageLinks($num_rows_items, $to, $url, $pageNumber,"1&order_by=$order_by_asc_desc", //$showPrevNext);
// Assigning Pagination Links
$smarty->assign('pageLink',$pageLink);         
#>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>  Code for pagination END   <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<#


$obj_ticket->pageLimit           = $pageLimit;
$obj_ticket->user_id             = $_SESSION['session_user_id'];
$Ticketlisting_details           = $obj_ticket->getTicketDetails();
$num_rows_items1                 = mysql_num_rows($Ticketlisting_details);
$page_counter                    = $pagination->getPageCounter($num_rows_items1);
$smarty->assign('page_counter',$page_counter);
if($num_rows_items1>0)
{
while($arr_items_array = mysql_fetch_array($Ticketlisting_details))
		{
	     $item_values_list[]  =   $arr_items_array;
		}
}

$error_msg="";
$smarty->assign("users_items_details",$item_values_list);
$smarty->assign("serch_status",$serch_status);
//assign error/update message
//$title_asc$quantity_available_desc
$smarty->assign("title_desc",'title_desc');
$smarty->assign("error_msg",$error_msg);
$smarty->assign("update_msg",$update_msg);
//display template
$smarty->assign('site_page_title','My Tickets Status');
$smarty->assign('site_title',$site_title);
$smarty->display('view_status_tickets.tpl');
?>
