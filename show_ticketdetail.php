<?php
include ('include/common.inc');
include ('class/class.user.inc');
include ('class/class.item.inc');
include ("class/class.ticket.inc");
include ("include/authentiateUserLogin.php");
include ('class/class.mail.inc');
include ('include/sendEmailClass.php');

   //include ('include/Pagination.Class.php'); // For pagination

  
  //create user class object
  $objUser                         = new Class_User();
  $obj_ticket                      = new Class_Ticket();
  $objMail 	            		   = new Class_Mail();
  
  $objMail->mail_title			   = "Email Template"; 
  $MailTemplate					   = $objMail->selectMailTemplate();
  $templateRowArr 				   = mysql_fetch_array($MailTemplate);
  $mail_content1				   = $templateRowArr['mail_content'];
  $mail_content1				   = str_replace("#link#",$baseUrl,$mail_content1);

/////// ticket email
//get email template
 
  $obj_ticket->ticket_id           = $_REQUEST['ticket_id'];
  $Ticket_details                  = $obj_ticket->getTicketDetails();
  $numitems1                       = mysql_num_rows($Ticket_details);
  if($numitems1>0)
   {
   $arr_ticket_array               = mysql_fetch_array($Ticket_details);
   
   if($ticket_status==1)
   $ticket_val                     = 'Open';
   else
   $ticket_val                     = 'Close';
   
   $ticket_subject                 = ucfirst($arr_ticket_array['subject']);
   $ticket_message                 = $arr_ticket_array['message'];
   $ticket_type                    = ucfirst($arr_ticket_array['request_type']);
   $ticket_priority                = ucfirst($arr_ticket_array['priority']);
   $ticket_generated               = $arr_ticket_array['date_genrated'];
   $ticket_status                  = $arr_ticket_array['status'];
   
    }


  $smarty->assign("ticket_status",$ticket_val);
  $smarty->assign("ticket_status_row",$ticket_status);
  $smarty->assign("ticket_priority",$ticket_priority);
  $smarty->assign("ticket_type",$ticket_type);
  $smarty->assign("ticket_subject",$ticket_subject);
  $smarty->assign("ticket_message",$ticket_message);
  $smarty->assign("ticket_generated",$ticket_generated);
  $smarty->assign("ticket_id",$ticket_id);
  


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





//send and login details email to user
if($_SERVER['REQUEST_METHOD']=='POST')
	{
		extract($_POST);
		//print_r($_POST);
		//$send_email_ids                    = 'rishi_kapoor@seologistics.com'; // admin email id
		$send_email_ids                      =  $admin_email;
		$obj_ticket->message                 =  rteSafe($_POST['message']);   
		$obj_ticket->ticket_id               =  $_REQUEST['ticket_id']; 
		
		if($_REQUEST['chk_close']!='')
		{
		$obj_ticket->status                  =  $_REQUEST['chk_close'];  	
		$Ticket_close                        =  $obj_ticket->insertUpdateTicket();		
		}
		$obj_ticket->user_id                 =  1;  // 0 for admin 1 user 
		$obj_ticket->order_date_genrated     =  1;  // 0 for admin 1 user
		
		//$sender_name                        
	 	 if($_POST['message']!='')
			{
	    $Ticket_details_value            	= $obj_ticket->insertUpdateReplyTicket();
        	}
	   $objMail->mail_title          	 	= "Send Reply"; 
	   $obj_user                         	= new Class_User();
	   $obj_user->id                     	= $_SESSION['session_user_id'];
	   $result_users_em_sender          	= $obj_user->selectUser();
	   $num_value_users_em_sender           = mysql_num_rows($result_users_em_sender);
	   if($num_value_users_em_sender >0)
		 {
		 $arr_fetch_em_sender               = mysql_fetch_assoc($result_users_em_sender);
		 $name_from_sender                  = $arr_fetch_em_sender['first_name'].''.$arr_fetch_em_sender['last_name'];
		 $email_from_sender                 = $arr_fetch_em_sender['email'];
		 }
  
  
  		// $mailFrom                 		= " Nethaat ";
  
		// Creating object of SendEmailClass
   		$emailObj 	= new SendEmailClass;
	    ////////////// ticket email ends here
	    $MailTemplate				 = $objMail->selectMailTemplate();
        $templateRowArr 		     = mysql_fetch_array($MailTemplate);
		
        $mail_content				 = $templateRowArr['mail_content'];
        $mail_content1			 	 = str_replace("#message_content#",$mail_content,$mail_content1);
        $subject 				 	 = $templateRowArr['mail_subject'];  
        $mail_content1				 = str_replace("#link#",$baseUrl,$mail_content1);
  	
         //$mailFrom                   = $name_from_sender;
        $mailFrom                 	 = "$name_from_sender"." < ".$email_from_sender." >";
		if($error_msg=="")
				{
				$emailObj            = new SendEmailClass;
				$mail_content1  	 = str_replace("#reciver_name#",' Administrator ',$mail_content1);
				$mail_content1  	 = str_replace("#ticket_id#",$_REQUEST['ticket_id'],$mail_content1);
			
				$subject             = str_replace("#sender_name#",$name_from_sender,$subject);
				$mail_content1       = str_replace("#message#",$message,$mail_content1);
					if($_POST['message']!='')
					{
					$emailStatus         = $emailObj->SendHtmlMail($send_email_ids,$subject,$mail_content1,$mailFrom);
					}
					  //success_msg("Your code  was successfull assigned to selected items !!");	
					  success_msg("Reply posted  successfully !!");	
			   }
		else
			   {
					$error_msg = "Error occured ...!Please try again";
					failure_msg("Error occured while adding reminder");
			  }
				 
					 redirect("show_ticketdetail.php?ticket_id=".$_REQUEST['ticket_id']);

	}
    //end coment





$error_msg="";


$smarty->assign("ticket_id",$_REQUEST['ticket_id']);

$smarty->assign("users_items_details", $ticket_reply_list);
$smarty->assign("title_desc",'title_desc');
$smarty->assign("error_msg",$error_msg);
$smarty->assign("update_msg",$update_msg);

//display template
$smarty->assign('site_page_title','My Tickets Status');
$smarty->assign('site_title',$site_title);
$smarty->display('show_ticketdetail.tpl');
?>
