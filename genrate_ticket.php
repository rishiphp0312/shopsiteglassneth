<?php
include ('include/common.inc');
include ("include/authentiateUserLogin.php");
include ("class/class.category.inc");
include ("class/class.item.inc");
include ("class/class.user.inc");
include ("class/class.ticket.inc");
include ('class/class.mail.inc');
include ('include/sendEmailClass.php');

$smarty->assign("coupon_code_str",$coupon_code_string);
  //create mail class object
    $objMail 	            		= new Class_Mail();
	$objMail->mail_title			= "Email Template"; 
	$MailTemplate					= $objMail->selectMailTemplate();
	$templateRowArr 				= mysql_fetch_array($MailTemplate);
	$mail_content1					= $templateRowArr['mail_content'];
	$mail_content1					= str_replace("#link#",$baseUrl,$mail_content1);

   //get email template
   $objMail->mail_title          	 = "Send Ticket"; 
   $obj_user                         = new Class_User();
   $obj_user->id                     = $_SESSION['session_user_id'];
   $result_users_em_sender           = $obj_user->selectUser();
   $num_value_users_em_sender        = mysql_num_rows($result_users_em_sender);
   if($num_value_users_em_sender >0)
	 {
     $arr_fetch_em_sender            = mysql_fetch_assoc($result_users_em_sender);
	 $name_from_sender               = $arr_fetch_em_sender['first_name'].''.$arr_fetch_em_sender['last_name'];
	 $email_from_sender              = $arr_fetch_em_sender['email'];
		 }
  
   $MailTemplate			 = $objMail->selectMailTemplate();
   $templateRowArr 		     = mysql_fetch_array($MailTemplate);
   $mail_content			 = $templateRowArr['mail_content'];
   $mail_content1			 = str_replace("#message_content#",$mail_content,$mail_content1);
   $subject 				 = $mailRowArr['mail_subject'];  
   $mail_content1			 = str_replace("#link#",$baseUrl,$mail_content1);
  	
   //$mailFrom                  = $name_from_sender;
   $mailFrom                  = "$name_from_sender"." < ".$email_from_sender." >";
  // $mailFrom                 = " Nethaat ";

// Creating object of SendEmailClass
   $emailObj 	= new SendEmailClass;

	if(isset($resCMSRow['page_title']))
	{
		$page_title = $resCMSRow['page_title'];
	}
	else
	{
		$page_title = SITE_CONTACT;
	}





    $obj_ticket = new Class_Ticket();

//send and login details email to user
if($_SERVER['REQUEST_METHOD']=='POST')
	{
   	extract($_POST);
	$send_email_ids             = $admin_email;
	//$send_email_ids             = 'rishi_kapoor@seologistics.com';
	$obj_ticket->user_id        = $_SESSION['session_user_id'];
	$obj_ticket->request_type   = rteSafe($request_type);
	$obj_ticket->priority  		= rteSafe($priority);
    $obj_ticket->subject        = rteSafe($subject);
	$obj_ticket->message        = rteSafe($message);	
	$obj_ticket->email_id       = rteSafe($email_id);	
	$obj_ticket->status         = 0;	
    $objDBReturn_ticket         = $obj_ticket->insertUpdateTicket();
	//$ticket_id        = 
    $ticket_id = $_SESSION['ticket_id'];
    if($objDBReturn_ticket->nErrorCode==0)
	{
	        	 $emailObj 	        = new SendEmailClass;
     			 $mail_content1		= str_replace("#ticket_id#",$ticket_id,$mail_content1);
				 $mail_content1	    = str_replace("#request_type#",$request_type,$mail_content1);
				 $mail_content1    = str_replace("#message#",$message,$mail_content1);				 				 $emailStatus       = $emailObj->SendHtmlMail($send_email_ids,$subject,$mail_content1,$mailFrom);
				success_msg("Your request has been successfully sent to Admin !!");	
		}
		else
		{
				$error_msg = "Error occured ...!Please try again";
				failure_msg("Error occured while sending email, please contact Administrator ");
		}
		   
				redirect("genrate_ticket.php");
					
			
//end coment
	}
    


	
	
	//end of code
	//assign error/update message
	$smarty->assign("error_msg",$error_msg);
	$smarty->assign("update_msg",$update_msg);

//display template
$smarty->assign('site_page_title','Nethaat :  Genrate Ticket');
//$smarty->assign('site_page_title','Genrate Ticket');
$smarty->assign('site_title',$site_title);
$smarty->display('genrate_ticket.tpl');
?>
