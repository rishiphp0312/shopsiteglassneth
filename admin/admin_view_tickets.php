<?php
include ("common_includes.php");
include ("../include/adminsession.php.inc");
include ("../class/class.item.inc");
include ("../class/class.user.inc");
include ("../class/class.ticket.inc");

//assign static labels and heading
$smarty->assign("form_heading","Manage Tickets");

//create object of Item class
 $objItem		= new Class_Item();
 $obj_ticket    = new Class_Ticket();
 $objUser       = new Class_User();
 
 
 $request_type  = $_REQUEST['request_type']; //request_type  
 $ticket_id     = $_REQUEST['ticket_id']; //ticket_id  
 $start_date    = $_REQUEST['start_date']; //start_date  
 $end_date      = $_REQUEST['end_date']; //end_date  
  $smarty->assign("start_date",$start_date);
  $smarty->assign("end_date",$end_date);
  $smarty->assign("ticket_id",$ticket_id);
  if($_REQUEST['request_type']!='' && $_REQUEST['request_type']!='0' )
  {
  $obj_ticket->request_type            = $_REQUEST['request_type'];
  }
  $smarty->assign("request_type",$request_type);
 
  if($ticket_id!='')
  {
  $obj_ticket->ticket_id            = $ticket_id;
  }
  if($start_date!='')
  {
  $start_date  = explode("/",$start_date);
  $start_date1  = $start_date[2].'-'.$start_date[0].'-'.$start_date[1];
  }
  if($end_date!='')
  {
  $end_date  = explode("/",$end_date);
  $end_date1  = $end_date[2].'-'.$end_date[0].'-'.$end_date[1];
  }
  if($end_date1!='')
  {
  $obj_ticket->end_date              = $end_date1;  //to 
  }
  if($start_date1!='')
  {
  $obj_ticket->start_date            = $start_date1; // from
  }

  $priority      = $_REQUEST['priority'];  
  if($_REQUEST['priority']!='' && $_REQUEST['priority']!='0' )
  {
  $obj_ticket->priority            = $_REQUEST['priority'];
  }
  $smarty->assign("priority",$priority);
  $serch_status                    = $_REQUEST['serch_status'];
 
  if($_REQUEST['close_ticket_id']!='')
  {
  $obj_ticket->ticket_id           =  $_REQUEST['close_ticket_id']; 
  $obj_ticket->status              =  1; // 1 to close ticket  	
  $Ticket_close                    =  $obj_ticket->insertUpdateTicket();		
    success_msg("Ticket closed successfully !!");	
	redirect("admin_view_tickets.php");
  }
  //$_REQUEST['serch_status'];
  if($_REQUEST['serch_status']!=2 && $_REQUEST['serch_status']!='')
  {
  $obj_ticket->status              = $_REQUEST['serch_status'];
  }

  $smarty->assign("serch_status", $serch_status);

 
///////--code for  serching ends here

#>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>  Code for pagination START   <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<#
  //select total recoords

    $obj_ticket->order_date_genrated = 1;
    $Ticketlisting_details           = $obj_ticket->getTicketDetails(); //to show listing of
  	$total_records = mysql_num_rows($Ticketlisting_details);
	$pagination = new Pagination();

	//set page number
	if(!isset($_GET['pageNumber']))
	{
		$pageNumber = 1;
	}
	else
	{
		$pageNumber= $_GET['pageNumber'];
	}
	
	//number of records per page LIMIT
	if(isset($_GET['limit']) && is_numeric($_GET['limit']))
	{
		$to	= trim($_GET['limit']);
	}
	else
	{
		$to	=	ADMIN_PAGE_NUMBER;
	}
	$from			= ($pageNumber-1)*$to;
	$showPrevNext	= true;

	$url = basename($_SERVER['PHP_SELF'])."?serch_status=$serch_status&priority=$priority&start_date=$start_date1&end_date=$end_date1&ticket_id=$ticket_id&request_type=$request_type";
	if($pageNumber==1 || $pageNumber=='')
	{
		$counter=1;
	}
	else
	{
		$counter = $pageNumber+$from-($pageNumber-1);
	}
	$pageLimit =" LIMIT $from,$to ";
	$obj_ticket->pageLimit = $pageLimit;	
	$pageLink = $pagination->getPageLinks($total_records, $to, $url, $pageNumber,'', $showPrevNext);
	// Assigning Pagination Links
	$smarty->assign('pageLink',$pageLink);         
#>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>  End Code for END   <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<#
//assign page limit
    $objResItem         = $obj_ticket->getTicketDetails();
	//mysql_num_rows($objResItem);
	$page_counter       = $pagination->getPageCounter(mysql_num_rows($objResItem));
	$smarty->assign('page_counter',$page_counter);
  if(mysql_num_rows($objResItem)>0)
    {
	while($Row = mysql_fetch_array($objResItem))
	{
		$TicketList[]	= $Row;
	}
	}
	//print_r($TicketList);
	$smarty->assign('TicketList',$TicketList);
	//display template and title
	$smarty->assign('site_page_title',ADMIN_COMMON_TITLE);
	$smarty->assign('site_title',$site_title);
	$smarty->display('admin_view_tickets.tpl');	
	?>