<?php
include ("common_includes.php");
include ("../include/adminsession.php.inc");
include ("../class/class.user.inc");
include ("../class/class.item.inc");
include ("../class/class.ticket.inc");

//include ('../include/imageOptimization.php');

    $ticket_id_value  = $_REQUEST['ticket_id'];
	//create user class object
	$obj_user      	  = new Class_User();
	$obj_item         = new Class_Item();
	$obj_ticket       = new Class_Ticket();
	$objMail 	      = new Class_Mail();
	
	$objMail->mail_title			   = "Email Template"; 
	$MailTemplate					   = $objMail->selectMailTemplate();
	$templateRowArr 				   = mysql_fetch_array($MailTemplate);
	$mail_content1				       = $templateRowArr['mail_content'];
	$mail_content1				       = str_replace("#link#",$baseUrl,$mail_content1);
   // start for fetching data of tickets
	if($ticket_id_value!='')
	{
	$obj_ticket->ticket_id        =  $ticket_id_value;
    $odj_image_details_value      =  $obj_ticket->getTicketDetails();
    $num_value_details            =  mysql_num_rows($odj_image_details_value);
		if($num_value_details >0)
		 {
		$arr_fetch_image_details   = mysql_fetch_assoc($odj_image_details_value);
		$request_type             = ucfirst($arr_fetch_image_details['request_type']);
		$priority                 = ucfirst($arr_fetch_image_details['priority']);
		$subject                  = ucfirst($arr_fetch_image_details['subject']);
		$message                  = ucfirst($arr_fetch_image_details['message']);
		$status                   = $arr_fetch_image_details['status'];
		$date_genrated            = $arr_fetch_image_details['date_genrated'];
		$user_id                  = $arr_fetch_image_details['user_id'];
		if($user_id==0)
			{
			  $name_from_reciver                = $arr_fetch_image_details['first_name'].' '.$arr_fetch_item_details['last_name'];
			  $username_reciver                 = 'Not a Registered User';
			  $phone_no                         = $arr_fetch_image_details['phone_no'];
			  $email_from_reciver               = $arr_fetch_image_details['email_id'];
			  $smarty->assign("name_from_reciver",$name_from_reciver);
			}
		else
		   {
			  $obj_user->id                     	= $user_id ;
			  $result_users_em_sender          	    = $obj_user->selectUser();
			  $num_value_users_em_sender            = mysql_num_rows($result_users_em_sender);
				  
			  if($num_value_users_em_sender >0)
				 {
				 $arr_fetch_em_reciver              = mysql_fetch_assoc($result_users_em_sender);
				 $phone_no                          = $arr_fetch_em_reciver['phone_no'];
				 $name_from_reciver                 = $arr_fetch_em_reciver['first_name'].' '.$arr_fetch_em_reciver['last_name'];
				 $username_reciver                  = $arr_fetch_em_reciver['username'];
				 $email_from_reciver                = $arr_fetch_em_reciver['email'];
				 $smarty->assign("name_from_reciver",$name_from_reciver);
				 }
				
		   }
	     }
	
		 if($phone_no=='')
		 $phone_no='NA';
	 
		 
	$smarty->assign("phone_no",$phone_no);
    $smarty->assign("email_from_reciver",$email_from_reciver);
	$smarty->assign("name_from_reciver",ucfirst($name_from_reciver));
	$smarty->assign("username_reciver",$username_reciver);
	$smarty->assign("request_type",$request_type);
	$smarty->assign("priority",$priority);
	$smarty->assign("subject",$subject);
	$smarty->assign("message",$message);
	$smarty->assign("status",$status);
	$smarty->assign("date_genrated",$date_genrated);

	$obj_ticket->order_date_genrated = 1;
    $Ticketlisting_details           = $obj_ticket->getTicketReplyDetails();
    $num_rows_items1                 = mysql_num_rows($Ticketlisting_details);
    if($num_rows_items1>0)
    {
      while($arr_items_array = mysql_fetch_array($Ticketlisting_details))
		{
	     $ticket_reply_list[]  =   $arr_items_array;
		}
     }
	 
	 $smarty->assign("num_rows_items1",$num_rows_items1);
	 $smarty->assign("ticket_reply_list",$ticket_reply_list);
 
 }
      $smarty->assign("ticket_id",$ticket_id_value);
      			
	
//send and login details tickets
if($_SERVER['REQUEST_METHOD']==' Post ' || $_REQUEST['submit'] == ' Post ')
{    
      
		// Creating object of SendEmailClass
   		$emailObj 	= new SendEmailClass;
		
		
		$obj_ticket->ticket_id               =  $_REQUEST['ticket_id']; 

		if($_REQUEST['chk_close']!='')
		{
		$obj_ticket->status                  =  $_REQUEST['chk_close'];  	
		$Ticket_close                        =  $obj_ticket->insertUpdateTicket();		
		}
		$obj_ticket->user_id                 =  0;  // 0 for admin 1 user 
		$obj_ticket->order_date_genrated     =  1;  // 0 for admin 1 user
		
		//$sender_name                        
	 	 if($_POST['message']!='')
		{
		$obj_ticket->message                 =  rteSafe($_POST['message']);   
	    $Ticket_details_value            	= $obj_ticket->insertUpdateReplyTicket();
        }
	    $objMail->mail_title          	 	= "Send Reply"; 
	  
  
  		// $mailFrom                 		= " Nethaat ";
		


	    ////////////// ticket email ends here
	    $MailTemplate				 = $objMail->selectMailTemplate();
        $templateRowArr 		     = mysql_fetch_array($MailTemplate);
		
        $mail_content				 = $templateRowArr['mail_content'];
        $mail_content1			 	 = str_replace("#message_content#",$mail_content,$mail_content1);
        $subject 				 	 = $templateRowArr['mail_subject'];  
        $mail_content1				 = str_replace("#link#",$baseUrl,$mail_content1);
  	
         //$mailFrom                 = $name_from_sender;
        //   $mailFrom                  = "$name_from_sender"." < ".$email_from_sender." >";      
	
//		$send_email_ids              = 'rishi_kapoor@seologistics.com'; // admin email id
		$send_email_ids              = $email_from_reciver; // user or reciver email id
	
	    $name_from_sender            = "Nethaat Admin ";
	    $mailFrom                 	 = "Nethaat Admin ";
	
		if($error_msg=="")
				{
				    $mail_content1  	 = str_replace("#reciver_name#",$name_from_reciver,$mail_content1);
					$mail_content1  	 = str_replace("#ticket_id#",$_REQUEST['ticket_id'],$mail_content1);
		            $subject             = str_replace("#sender_name#",$name_from_sender,$subject);      
					$mail_content1       = str_replace("#message#",$_POST['message'],$mail_content1);
					
					if($_POST['message']!='')
					{
		$emailStatus = $emailObj->SendHtmlMail($send_email_ids,$subject,$mail_content1,$mailFrom);
					}
					  //success_msg("Your code  was successfull assigned to selected items !!");	
					  if($_POST['message']!='' && $_POST['chk_close']=='')
					  success_msg("Reply posted  successfully !!");	
					  if($_POST['message']=='' && $_POST['chk_close']!='')
					  success_msg("Ticket closed successfully !!");	
					  if($_POST['message']!='' && $_POST['chk_close']!='')
					  success_msg("Reply posted and Ticket closed successfully !!");	
			   }
		else
			   {
					$error_msg = "Error occured ...!Please try again";
					failure_msg("Error occured while adding reminder");
			  }
				 
			
 redirect("admin_reply_ticket.php?ticket_id=".$_REQUEST['ticket_id']);
}

///////////
	
	//end of code
//assign error/update message
$smarty->assign("update_msg",$update_msg);
/////////////
//assign error msg
//echo  $user_type;
$smarty->assign('err_message',$err_message);

			
//display template and title
$smarty->assign('site_page_title',ADMIN_COMMON_TITLE);
$smarty->assign('site_title',$site_title);
$smarty->display('admin_reply_ticket.tpl');	
?>
