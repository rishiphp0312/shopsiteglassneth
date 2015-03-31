<?php
include ('include/common.inc');
include ("include/authentiateUserLogin.php");
include ("class/class.category.inc");
include ("class/class.item.inc");
include ("class/class.user.inc");
include ('class/class.mail.inc');
include ('include/sendEmailClass.php');



    $obj_user                             = new Class_User();
    $delete_item_value                    = $_REQUEST['delete_item_value'];
 
	if($_REQUEST['rem_id_value']!='')
	{
	$obj_user->rem_id                     = $_REQUEST['rem_id_value'];
	$result_users                         = $obj_user->reminder_messagesListing();
	$num_value_users_details              = mysql_num_rows($result_users);
	if($num_value_users_details >0)
		 {
	    $arr_fetch_users_details         = mysql_fetch_assoc($result_users);
		$show_msg                        = $arr_fetch_users_details['message'];
		 }
	}
	$smarty->assign("show_msg",$show_msg);
	$smarty->assign("reminders_details",$arr_fetch_users_details);
	
	

	
	if(isset($resCMSRow['page_title']))
	{
		$page_title = $resCMSRow['page_title'];
	}
	else
	{
		$page_title = SITE_CONTACT;
	}






 

//send and login details email to user
//
if($_SERVER['REQUEST_METHOD']=='POST' && $_POST['add_value']=='Change')
	{
		extract($_POST);
		$obj_user->rem_gift_id               =  $_REQUEST['rem_id_value'];
		$obj_user->message                   =  rteSafe($_POST['message']);   
		$obj_user->STATUS                    =  0;   
		$Reminder_details_value              =  $obj_user->insertUpdate_giftcard_message();
	   	if($error_msg=="")
				{
					 $emailObj 	             = new SendEmailClass;					
					 success_msg("Message is  successfully changed !!");	
				  }
		  else
				{
					$error_msg = "Error occured ...!Please try again";
					failure_msg("Error occured while changing reminder message!!.");
				 }
				redirect("reminder_message_list.php");

	}
    //end coment



	$smarty->assign("item_details_value",$item_details);
	$smarty->assign("user_details_value",$user_details_value);
    //$user_details_value

    // start for fetching data of items cooresponding to items 
	//echo 'max-'.$max_quantity_db     ;
	$smarty->assign("description_value",$description_value);
	$smarty->assign("material_used_value",$material_used_value);
	$smarty->assign("cost_item_value",$cost_item_value);
	$smarty->assign("max_item_value",$max_quantity_db);
	//$max_item_value
	$smarty->assign("inventory_alert_value",$inventory_alert_value);
	$smarty->assign("title_value",$title_value);
	$smarty->assign("category_id_value",$category_id_value);
	$smarty->assign("item_id_value",$item_id_value);
	//$item_id_value
	//end of code
//assign error/update message
$smarty->assign("error_msg",$error_msg);
$smarty->assign("update_msg",$update_msg);
$smarty->assign("rem_id_value",$_REQUEST['rem_id_value']);


//display template
$smarty->assign('site_page_title','Nethaat :  Edit Reminder Message');
$smarty->assign('site_title',$site_title);
$smarty->display('edit-reminder-mesg.tpl');
?>
