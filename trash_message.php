<?php
include ('include/common.inc');
include ("include/authentiateUserLogin.php");
include ('class/class.user.inc');
include ('class/class.message.inc');


$obj_user = new Class_User();
$obj_msg = new Class_Message();



//*************************** Restore Code ********************************
	if(isset($_GET['chk_restore']))
	{
		
		$delid=array();
		$delid=$_GET['checked_msg'];
		foreach($delid as $key => $value)
		{
			$obj_msg->message_trash		=	$value;
			$obj_msg->reciever_deleted		=	"0";
			
			
			$objDBReturn = $obj_msg->insertUpdatemessage_sub();
			if($objDBReturn->nIdentity && $objDBReturn->nErrorCode==0)
			{
				
			}
			else if($objDBReturn->nIdentity==0 && $objDBReturn->nErrorCode==0)
			{
				success_msg("Messages has been successfully Restored..");
				
			}
			else
			{
				failure_msg("Error occured ...!Please try again");
			}
		}
		redirect("trash_message.php");
	}
	//$obj_msg->inboxdeleteid = $_SESSION['session_user_id'];


	//*************************** Delete Code ********************************

//*************************** Delete Code ********************************
	if(isset($_GET['chk_delete_trash']))
	{
		
		$delid=array();
		$delid=$_GET['checked_msg'];
		foreach($delid as $key => $value)
		{
			$obj_msg->message_trash		=	$value;
			$obj_msg->reciever_deleted		=	"2";
			
			
			$objDBReturn = $obj_msg->insertUpdatemessage_sub();
			if($objDBReturn->nIdentity && $objDBReturn->nErrorCode==0)
			{
				
			}
			else if($objDBReturn->nIdentity==0 && $objDBReturn->nErrorCode==0)
			{
				success_msg("Messages has been successfully Deleted..");
				
			}
			else
			{
				failure_msg("Error occured ...!Please try again");
			}
		}
		redirect("trash_message.php");
	}
	//$obj_msg->inboxdeleteid = $_SESSION['session_user_id'];


	//*************************** Delete Code ********************************



if(isset($_SESSION['session_user_id'])&& $_SESSION['session_user_id']!="")
{
    $obj_msg->trashsearch = $_GET['search_text'];
	$obj_msg->trashid = $_SESSION['session_user_id'];
	$UserRes1 = $obj_msg->gettrashbox();

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
	
	$obj_msg->trashid = $_SESSION['session_user_id'];
	//$obj_msg->reciever_deleted = "1";
	$obj_msg->sorting = $_GET['sorting'];
	$obj_msg->order = $_GET['order'];
	$obj_msg->trashsearch = $_GET['search_text'];
	$obj_msg->pageLimit_trash = $pageLimit;
	
	$UserRes = $obj_msg->gettrashbox();
	$num_trash=mysql_num_rows($UserRes);
	while($UserArr = mysql_fetch_array($UserRes))
	{
		$trash_msg[]	=	$UserArr;
	}
	$smarty->assign("trash_msg",$trash_msg);
	$smarty->assign("num_trash",$num_rows_items);

	$smarty->assign("num_rows_items1",$num_trash);
	$page_counter = $pagination->getPageCounter($num_trash);
	$smarty->assign('page_counter',$page_counter);

	$obj_msg->reciever_deleted = "1";
	$obj_msg->inbox_read = "0";
	$UserRes_unread = $obj_msg->gettrashbox();
	$num_trash_unread=mysql_num_rows($UserRes_unread);
	$smarty->assign("num_trash",$num_trash_unread);

	$smarty->assign("limit",$_GET['limit']);
	$smarty->assign("order",$_GET['order']);
	$smarty->assign("sorting",$_GET['sorting']);
	$smarty->assign("search_text",$_GET['search_text']);
	
	
}

if(isset($_SESSION['session_user_id'])&& $_SESSION['session_user_id']!="")
{
	$obj_msg->inboxid = $_SESSION['session_user_id'];
	$obj_msg->inbox_read = "0";
	$UserRes = $obj_msg->getinbox();
	$num_in=mysql_num_rows($UserRes);
	while($UserArr = mysql_fetch_array($UserRes))
	{
		$items_in[]	=	$UserArr;
	}
	$smarty->assign("in_item",$items_in);
	$smarty->assign("num_in",$num_in);
	
}
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




$smarty->assign('site_page_title',"Message Trash");
$smarty->assign('site_title',$site_title);
$smarty->display('trash_message.tpl');
?>