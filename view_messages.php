<?php
include ('include/common.inc');
include ("include/authentiateUserLogin.php");
include ('class/class.message.inc');


$obj_msg = new Class_Message();


$obj_msg->message_trash		=	$_GET['msg_id'];
//$obj_msg->inbox_read		=	"1";
//*****************************************************************
if(isset($_GET['msg_id']) != "")
{

	
	///////////
	//$delid=$_GET['checked_msg'];
	$delid= $_GET['msg_id'];
	
	//$delid=$_GET['checked_msg'];
		//foreach($delid as $key => $value)
		//{
			$obj_msg->message_trash		=	$delid;
			$obj_msg->inbox_read		=	"1";
			
			$objDBReturn = $obj_msg->insertUpdatemessage_sub();
			//exit;
			 //if($objDBReturn->nIdentity==0 && $objDBReturn->nErrorCode==0)
			//{
			//	success_msg("Messages has been successfully marked as read..");
				
			//}
			//}
	//////////
		$obj_msg->inbox_read		=	"0";
		$obj_msg->msg_id = $_GET['msg_id'];
	
	$UserRes = $obj_msg->getMessageDetails();
	$UserArr = mysql_fetch_array($UserRes);
	
	//echo $UserArr_msg_fwd['msg_contain'];
	$smarty->assign("msg_id",$_GET['msg_id']);
	$smarty->assign("senderid",$UserArr['sender_id']);
	$smarty->assign("f_name",$UserArr['first_name']);
 	$smarty->assign("l_name",$UserArr['last_name']);
	
 	$smarty->assign("username",$UserArr['username']);
	$smarty->assign("subject",$UserArr['subject']);
	$smarty->assign("message",$UserArr['message']);
	$smarty->assign("reciever_id",$UserArr['reciever_id']);
	
	//*************************** READ Messages Code ********************************
	
		
	//	$objDBReturn = $obj_msg->insertUpdatemessage_sub();
	
	//*************************** READ MESSAGE Code ********************************

}

$smarty->assign('site_page_title',"Nethaat: View Messages");
$smarty->assign('site_title',$site_title);
$smarty->display('view_messages.tpl');
?>