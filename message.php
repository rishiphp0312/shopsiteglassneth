<?php
include ('include/common.inc');
include ("include/authentiateUserLogin.php");
include ('class/class.user.inc');
include ('class/class.message.inc');


$obj_user = new Class_User();
$obj_msg = new Class_Message();


//*************************** Delete Code ********************************
	if(isset($_GET['chk_delete']))
	{
		$delid=array();
		$delid=$_GET['checked_msg'];
		foreach($delid as $key => $value)
		{
			$obj_msg->message_trash		=	$value;
			$obj_msg->reciever_deleted		=	"1";
			
			$objDBReturn = $obj_msg->insertUpdatemessage_sub();
			if($objDBReturn->nIdentity && $objDBReturn->nErrorCode==0)
			{
				
			}
			else if($objDBReturn->nIdentity==0 && $objDBReturn->nErrorCode==0)
			{
				success_msg("Messages has been successfully moved to trash..");
				
			}
			else
			{
				failure_msg("Error occured ...!Please try again");
			}
		}
		redirect("message.php");
	}
	//$obj_msg->inboxdeleteid = $_SESSION['session_user_id'];


	//*************************** Delete Code ********************************



if(isset($_SESSION['session_user_id'])&& $_SESSION['session_user_id']!="")
{
	$obj_msg->inboxsearch = $_GET['search_text'];
	$obj_msg->inboxid = $_SESSION['session_user_id'];
	$obj_msg->reciever_deleted		=	"0";
	$UserRes1 = $obj_msg->getinbox();
	
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

	$num_rows_items     = mysql_num_rows($UserRes1);
	//number of records per page LIMIT
	//echo"---". $_REQUEST['limit'];
	if(isset($_GET['limit']) && is_numeric($_GET['limit']))
	{
		$to	= trim($_GET['limit']);
	}
	else
	{
		$to	=	10;
	}	
	$from=($pageNumber-1)*$to;
	$showPrevNext = true;

	//$url = "admin_category.php?start_date=$start_date&end_date=$end_date&business=$business";
	$url = basename($_SERVER['PHP_SELF'])."?search_text=".$_GET['search_text']."&sorting=".$_GET['sorting']."&limit=".$_GET['limit'];
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
	
	
	$obj_msg->inboxid = $_SESSION['session_user_id'];
	$obj_msg->sorting = $_GET['sorting'];
	$obj_msg->order = $_GET['order'];
	$obj_msg->inboxsearch = $_GET['search_text'];
	$obj_msg->pageLimit_inbox = $pageLimit;
	
	$UserRes = $obj_msg->getinbox();
	$num_in=mysql_num_rows($UserRes);
	if($num_in>0){
	while($UserArr = mysql_fetch_array($UserRes))
	{
		$items_in[]	=	$UserArr;
	}}

	$smarty->assign("in_item",$items_in);
	
	$smarty->assign("num_rows_items1",$num_in);
	$page_counter = $pagination->getPageCounter($num_in);
	$smarty->assign('page_counter',$page_counter);

	$obj_msg->inbox_read = "0";
	$UserRes_unread = $obj_msg->getinbox();
	$num_in_unread=mysql_num_rows($UserRes_unread);
	$smarty->assign("num_in",$num_in_unread);
	$smarty->assign("limit",$_GET['limit']);
	$smarty->assign("order",$_GET['order']);
	$smarty->assign("sorting",$_GET['sorting']);
	$smarty->assign("search_text",$_GET['search_text']);
}







//*************************** READ Messages Code ********************************
	if(isset($_GET['chk_read']))
	{
		$delid=array();
		$delid=$_GET['checked_msg'];
		foreach($delid as $key => $value)
		{
			$obj_msg->message_trash		=	$value;
			$obj_msg->inbox_read		=	"1";
			
			$objDBReturn = $obj_msg->insertUpdatemessage_sub();
			//exit;
			if($objDBReturn->nIdentity && $objDBReturn->nErrorCode==0)
			{
				
			}
			else if($objDBReturn->nIdentity==0 && $objDBReturn->nErrorCode==0)
			{
				success_msg("Messages has been successfully marked as read..");
				
			}
			else
			{
				failure_msg("Error occured ...!Please try again");
			}
		}
		redirect("message.php");
	}
	//$obj_msg->inboxdeleteid = $_SESSION['session_user_id'];


	//*************************** READ MESSAGE Code ********************************


	//*************************** UNREAD Messages Code ********************************
	if(isset($_GET['chk_unread']))
	{
		$delid=array();
		$delid=$_GET['checked_msg'];
		foreach($delid as $key => $value)
		{
			$obj_msg->message_trash		=	$value;
			$obj_msg->inbox_read		=	"0";
			
			$objDBReturn = $obj_msg->insertUpdatemessage_sub();
			if($objDBReturn->nIdentity && $objDBReturn->nErrorCode==0)
			{
				
			}
			else if($objDBReturn->nIdentity==0 && $objDBReturn->nErrorCode==0)
			{
				success_msg("Messages has been successfully marked as unread..");
				
			}
			else
			{
				failure_msg("Error occured ...!Please try again");
			}
		}
		redirect("message.php");
	}
	//$obj_msg->inboxdeleteid = $_SESSION['session_user_id'];


	//*************************** UNREAD MESSAGE Code ********************************





if(isset($_SESSION['session_user_id'])&& $_SESSION['session_user_id']!="")
{
	$obj_msg->sentid = $_SESSION['session_user_id'];
	$UserRes = $obj_msg->getSendbox();
	$num_sent=mysql_num_rows($UserRes);
	while($UserArr = mysql_fetch_array($UserRes))
	{
		$items[]	=	$UserArr;
	}
	$smarty->assign("citem",$items);
	$smarty->assign("num_sent",$num_sent);
	
}

if(isset($_SESSION['session_user_id'])&& $_SESSION['session_user_id']!="")
{
	$obj_msg->trashid = $_SESSION['session_user_id'];
	$obj_msg->reciever_deleted = "1";
	//$obj_msg->inbox_read = "0";

	$UserRes = $obj_msg->gettrashbox();
	$num_trash=mysql_num_rows($UserRes);
	while($UserArr = mysql_fetch_array($UserRes))
	{
		$items[]	=	$UserArr;
	}
	$smarty->assign("citem",$items);
	$smarty->assign("num_trash",$num_trash);
	
}

$smarty->assign('site_page_title',"Message Inbox");
$smarty->assign('site_title',$site_title);
$smarty->display('message.tpl');
?>