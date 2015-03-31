<?php
include ('include/common.inc');
include ("include/authentiateUserLogin.php");
include ('class/class.user.inc');
include ('class/class.message.inc');


$obj_user = new Class_User();
$obj_msg = new Class_Message();

if(isset($_SESSION['session_user_id'])&& $_SESSION['session_user_id']!="")
{
    $obj_msg->sendsearch = $_GET['search_text'];
	$obj_msg->sentid = $_SESSION['session_user_id'];
	$UserRes1 = $obj_msg->getSendbox();
	
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
	$obj_msg->sentid = $_SESSION['session_user_id'];
	$obj_msg->sorting = $_GET['sorting'];
	$obj_msg->order = $_GET['order'];
	
	$obj_msg->pageLimit = $pageLimit;
	$sentRes = $obj_msg->getSendbox();
	$num_sent=mysql_num_rows($sentRes);


	while($SentArr = mysql_fetch_array($sentRes))
	{
		$msg[]	=	$SentArr;
	}
	$smarty->assign("sentmsg",$msg);
	$smarty->assign("num_sent",$num_rows_items);
	$smarty->assign("num_rows_items1",$num_sent);
	$page_counter = $pagination->getPageCounter($num_sent);
	$smarty->assign('page_counter',$page_counter);


	$smarty->assign("limit",$_GET['limit']);
	$smarty->assign("order",$_GET['order']);
	$smarty->assign("sorting",$_GET['sorting']);
	$smarty->assign("search_text",$_GET['search_text']);
	
}



//*************************** Delete Code ********************************
	if(isset($_GET['chk_delete_send']))
	{
		$delid=array();
		$delid=$_GET['checked_msg'];
		foreach($delid as $key => $value)
		{
			$obj_msg->message_trash		=	$value;
			$obj_msg->sender_deleted		=	"1";
			
			$objDBReturn = $obj_msg->insertUpdatemessage_sub();
			if($objDBReturn->nIdentity && $objDBReturn->nErrorCode==0)
			{
				
			}
			else if($objDBReturn->nIdentity==0 && $objDBReturn->nErrorCode==0)
			{
				success_msg("Messages has been successfully deleted from your sendbox..");
				
			}
			else
			{
				failure_msg("Error occured ...!Please try again");
			}
		}
		redirect("sent_message.php");
	}
	//$obj_msg->inboxdeleteid = $_SESSION['session_user_id'];


	//*************************** Delete Code ********************************


if(isset($_SESSION['session_user_id'])&& $_SESSION['session_user_id']!="")
{
	$obj_msg->inboxid = $_SESSION['session_user_id'];
	$obj_msg->inbox_read = "0";
    //$obj_msg->sender_deleted=	"0";
	$UserRes = $obj_msg->getinbox();
	$num_in=mysql_num_rows($UserRes);
	while($UserArr = mysql_fetch_array($UserRes))
	{
		$items[]	=	$UserArr;
	}
	$smarty->assign("citem",$items);
	$smarty->assign("num_in",$num_in);
	
}
if(isset($_SESSION['session_user_id'])&& $_SESSION['session_user_id']!="")
{
	$obj_msg->trashid = $_SESSION['session_user_id'];
	$obj_msg->reciever_deleted = "1";
	$UserRes = $obj_msg->gettrashbox();
	$num_trash=mysql_num_rows($UserRes);
	while($UserArr = mysql_fetch_array($UserRes))
	{
		$items[]	=	$UserArr;
	}
	$smarty->assign("citem",$items);
	$smarty->assign("num_trash",$num_trash);
	
}


$smarty->assign('site_page_title',"Message Send box");
$smarty->assign('site_title',$site_title);
$smarty->display('sent_message.tpl');
?>