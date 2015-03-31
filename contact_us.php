<?php
include ('include/common.inc');
include ('class/class.cms.inc');
include ('class/class.mail.inc');
include ('class/class.user.inc');
include ('include/sendEmailClass.php');
include ("class/class.ticket.inc");
include ('captcha/php-captcha.php');

//echo '<pre>';
//print_r($_SESSION);

//create business class object
$objCMS	        = new Class_CMS();

//create user class object
$objUser        = new Class_User();

//create mail class object
$objMail 	= new Class_Mail();

// Creating object of SendEmailClass
$emailObj 	= new SendEmailClass;

$obj_ticket     = new Class_Ticket();
//get page details
//$page_title = trim($_GET['page']);
$page_link_id = "contact_us";
$details_item_value = $_REQUEST['details_item_value'];
$item_name          = $_REQUEST['item_name'];

if($page_link_id && $page_link_id!="")
{
	$objCMS->page_link_id = $page_link_id;
	$resCMS = $objCMS->selectCmsPage();
	$resCMSRow = mysql_fetch_array($resCMS);
	
	$smarty->assign('page_title',$resCMSRow['page_title']);
	$smarty->assign('description',$resCMSRow['description']);
	$smarty->assign('posttime',$resCMSRow['posttime']);
	
}
if(isset($resCMSRow['page_title']))
{
	$page_title = $resCMSRow['page_title'];
}
else
{
	$page_title = SITE_CONTACT;
}

//validate captcha code
function validateCaptcha($CaptchaCode1)
{
    if (PhpCaptcha :: Validate($CaptchaCode1))
	{ 
		return true;
    }
    else
	{
	
    	return false;
    }    	
}
//validate captcha code

//get email template
$objMail->mail_title            = "Email Template";
$MailTemplate			= $objMail->selectMailTemplate();
$templateRowArr 		= mysql_fetch_array($MailTemplate);
$mail_content			= $templateRowArr['mail_content'];
$mail_content			= str_replace("#link#",$baseUrl,$mail_content);

//$mail_content_user		= str_replace("#link#",$baseUrl,$mail_content);

	
//get Contact US email content

$objMail->mail_title		= "Contact US"; 
$MailRes			= $objMail->selectMailTemplate();
$mailRowArr     		= mysql_fetch_array($MailRes);
$subject 			= $mailRowArr['mail_subject'];  
$message_content		= $mailRowArr['mail_content'];

// unknown or unregisterd user when sends request or gnerate new ticket to admin
$objMail->mail_title             = "Send Reply Contact";
$MailRes_user 			 = $objMail->selectMailTemplate();
$mailRowArr_user  		 = mysql_fetch_array($MailRes_user );
$subject_user  			 = $mailRowArr_user['mail_subject'];
$message_content_user 		 = $mailRowArr_user['mail_content'];




// unknown or unregisterd user when sends reply to his previous request or ticket to admin and himself

$objMail->mail_title		        = "Send Reply"; 
$MailRes_send_reply_toadmin		= $objMail->selectMailTemplate();
$mailRowArr_send_reply_toadmin		= mysql_fetch_array($MailRes_send_reply_toadmin);
$subject_send_reply_toadminuser 	= $mailRowArr_send_reply_toadmin['mail_subject'];  
$message_content_send_reply_toadmin	= $mailRowArr_send_reply_toadmin['mail_content'];
 					
					//after lunch start here
   // subject for admin

		
$mail_content1  	 = str_replace("#reciver_name#",$name_from_reciver,$mail_content1);
$mail_content1  	 = str_replace("#ticket_id#",$_REQUEST['ticket_id'],$mail_content1);
$subject                 = str_replace("#sender_name#",$name_from_sender,$subject);
$mail_content1           = str_replace("#message#",$_POST['message'],$mail_content1);



//replace message content with mail template message conyent variable
 $mail_content_user	= str_replace("#message_content#",$message_content_user,$mail_content);
 $message_content_send_reply_toadmin= str_replace("#message_content#",$message_content_send_reply_toadmin,$mail_content);

$mail_content		= str_replace("#message_content#",$message_content,$mail_content);
//replace confirmation message content with mail template message conyent variable

//send and login details email to user
if($_SERVER['REQUEST_METHOD']=='POST')
{  

    //mail("rishi_kapoor@seologistics.com","hi","kal aaya nahi");
	extract($_POST);
	$name		= rteSafe($f_name).' '.rteSafe($l_name); 
	$phone		= rteSafe($phone);
	
	$email		= rteSafe($contact_email);
	$message	= rteSafe($message);
	$emailTo	= $admin_email;
        
	////////// -----start ticket code---------------///
	$obj_ticket->status         = 0;	
	$obj_ticket->first_name     = rteSafe($f_name);	
	$obj_ticket->last_name      = rteSafe($l_name);	
	$obj_ticket->message        = rteSafe($message);	
	$obj_ticket->subject        = rteSafe($subject);
	$obj_ticket->phone_no       = rteSafe($phone);
	$obj_ticket->email_id       = rteSafe($contact_email);
    $obj_ticket->request_type   =  $contact;
	$obj_ticket->user_id        = 0;	
	//$obj_ticket->date_genrated  = date()
	$obj_ticket->ticket_id      = $_REQUEST['ticket_id']; 
	
	$ticket_exsists_ornot       = $obj_ticket->getTicketDetails();
	$numticket_exsists_ornot    = mysql_num_rows($ticket_exsists_ornot);  
	
   
    $message_content_send_reply_toadmin  	= str_replace("#ticket_id#",$_REQUEST['ticket_id'],$message_content_send_reply_toadmin);
	$subject_send_reply_toadmin             = str_replace("#sender_name#",$name,$subject_send_reply_toadmin);      
	$message_content_send_reply_toadmin     = str_replace("#message#",$_POST['message'],$message_content_send_reply_toadmin);

	$report_it      = $_POST['report_it'];
	if($report_it!='')
    {
         $objUser->reporter_id = $_SESSION['session_user_id'];
         $objUser->item_id     = $details_item_value;
         $objUser->status      = 0;
         $num_rows             = $objUser->getDetails_ofreportItem();
			 if($num_rows==0)
			 {
			   $objUser->insertUpdate_reportItem();
			 }
			 
      }
		//validate captcha security code first	
	if(!validateCaptcha(trim($CaptchaCode)))
	{
		$error_msg = "Please enter the captcha text again";
		//unset($_SESSION[CAPTCHA_SESSION_ID]);
		//redirect('contact_us.php');
		
	}
	if($error_msg=='')
	{ 
		if($_REQUEST['ticket_id']!='')
	  {
	    
		if($numticket_exsists_ornot>0)
		{  
		$obj_ticket->user_id        = 2; // reply by contact user
		$obj_ticket->message        = rteSafe($message);
		$obj_ticket->ticket_id      = $_REQUEST['ticket_id'];     
		if(validateCaptcha(trim($CaptchaCode)))
		$objDBReturn_ticket         = $obj_ticket->insertUpdateReplyTicket();
		}
		else
		{
		 $error_msg="Entered ticket id does not exist...! Please try again later";
		//exit;
		//failure_msg("Entered ticket id does not exist...! Please try again later");
		//redirect('contact_us.php');
		}
	}
	else
	{
	if(validateCaptcha(trim($CaptchaCode)))
	$objDBReturn_ticket         = $obj_ticket->insertUpdateTicket();
	$ticket_id                  = $_SESSION['ticket_id'];
	
	}
	}
		
	//assign post values
	$smarty->assign("f_name",$f_name);
	$smarty->assign("l_name",$l_name);
	$smarty->assign("phone",$phone);
	$smarty->assign("contact_email",$contact_email);
	$smarty->assign("contact",$contact);
	$smarty->assign("message",$message);
	$smarty->assign("ticket_id",$ticket_id);
	//if no errors found
	if($error_msg=="")
	{
	if($_REQUEST['ticket_id']!='')
        $ticket_id=$_REQUEST['ticket_id'];
        else
        $ticket_id=$_SESSION['ticket_id'];
        $mail_content			    = str_replace("#link#",$baseUrl,$mail_content);
	
	/// ---------end ticket code----------------////
	
	$mailFrom = $name."<".$email.">";
		//send contact us email to admin
	$mail_content= str_replace("#name#",$name,$mail_content);
	$mail_content= str_replace("#email#",$email,$mail_content);
	$mail_content= str_replace("#phone#",$phone,$mail_content);
	$mail_content= str_replace("#contact#",$contact,$mail_content);
	$mail_content= str_replace("#message#",$message,$mail_content);
	$mail_content= str_replace("#ticket_id#",$ticket_id,$mail_content);
	$mail_content= str_replace("#link#",$baseUrl,$mail_content);
		//send contact us confirmation email
	
       
	  
		//send contact us email to user
	$mail_content_user= str_replace("#sender_name#",$name,$mail_content_user);
	$mail_content_user= str_replace("#first_name#",$f_name,$mail_content_user);
	$mail_content_user= str_replace("#last_name#",$l_name,$mail_content_user);
	$mail_content_user= str_replace("#email#",$email,$mail_content_user);
	$mail_content_user= str_replace("#phone#",$phone,$mail_content_user);
	$mail_content_user= str_replace("#contact#",$contact,$mail_content_user);
	$mail_content_user= str_replace("#message#",$message,$mail_content_user);
	$mail_content_user= str_replace("#ticket_id#",$ticket_id,$mail_content_user);
	$mail_content_user= str_replace("#link#",$baseUrl,$mail_content_user);
		//send contact us confirmation email
		 // $send_email_to  = $emailTo; // send to user and admin
		//echo $mail_content_user;
        	 // $send_email_to  = $emailTo; // send to user and admin
		//echo $mail_content_user;

		
		
		
		
		
		//send contact us email to user na admin
	$message_content_send_reply_toadmin       = str_replace("#sender_name#",$name,$message_content_send_reply_toadmin);
	$message_content_send_reply_toadmin       = str_replace("#first_name#",$f_name,$message_content_send_reply_toadmin);
	$message_content_send_reply_toadmin       = str_replace("#last_name#",$l_name,$message_content_send_reply_toadmin);
	$message_content_send_reply_toadmin       = str_replace("#email#",$email,$message_content_send_reply_toadmin);
	$message_content_send_reply_toadmin       = str_replace("#phone#",$phone,$message_content_send_reply_toadmin);
	//	$message_content_send_reply_toadmin= str_replace("#reciver_name#",$reciver_name,$message_content_send_reply_toadmin);
	$message_content_send_reply_toadmin        = str_replace("#contact#",$contact,$message_content_send_reply_toadmin);
	$message_content_send_reply_toadmin        = str_replace("#message#",$message,$message_content_send_reply_toadmin);
	$message_content_send_reply_toadmin        = str_replace("#ticket_id#",$ticket_id,$message_content_send_reply_toadmin);
	//send contact us confirmation email
	$subject_send_reply_toadmin                = str_replace("#sender_name#",$name,$subject_send_reply_toadminuser);      				
	// subject for user
    $subject_send_reply_touser             = str_replace("#sender_name#",$name,$subject_send_reply_toadminuser);
	
	$send_email_touser   = $contact_email ;   // send to  user
		
	$send_email_toadmin  = $emailTo;           // send to  admin
		
		
    $message_content_send_reply_toadmin  	 = str_replace("#reciver_name#",$name,$message_content_send_reply_toadmin);
	$message_content_send_reply_toadmin	         = str_replace("#link#",$baseUrl,$message_content_send_reply_toadmin);
		
	//	exit;
	if($_REQUEST['ticket_id']!='')
		{
		 
		$emailStatus= $emailObj->SendHtmlMail($send_email_toadmin,$subject_send_reply_toadmin,$message_content_send_reply_toadmin,$mailFrom); // for admin
		$emailStatus1= $emailObj->SendHtmlMail($send_email_touser,$subject_send_reply_touser,$message_content_send_reply_toadmin,'Administrator'); // for user
		//$conEmailStatus = $emailObj->SendHtmlMail($mailFrom, $conSubject, $con_mail_content, ADMIN_MAIL_ID);
		}

		//echo $mail_content;die;
		//$mail_content=str_replace("\n","<br>",$mail_content);
		//if(validateCaptcha(trim($CaptchaCode)))
		if($_REQUEST['ticket_id']=='')
		{
		 // $send_email_toadmin = 'rishi_kapoor@seologistics.com';
	     // $send_email_touser  =  'rishi_kapoor@seologistics.com';
		$emailStatus 	= $emailObj->SendHtmlMail($send_email_toadmin,$subject,$mail_content,$mailFrom); // for admin
		$emailStatus1 	= $emailObj->SendHtmlMail($send_email_touser,$subject_user,$mail_content_user,'Administrator'); // for user
		//$conEmailStatus = $emailObj->SendHtmlMail($mailFrom, $conSubject, $con_mail_content, ADMIN_MAIL_ID);
		}	
		$send_url = 'details_item_value='.$details_item_value.'&item_name='.$item_name;
                
		if($emailStatus == true)
		{
			success_msg("Thank you. Your message has been sent. Our representatives will reply within 24-48 hrs");
		    redirect('contact_us.php?'.$send_url);
			//header("location:thanks.php?type=4");
			
			//reset all fields
			$smarty->assign("f_name","");
			$smarty->assign("l_name","");
			$smarty->assign("phone","");
			$smarty->assign("contact_email","");
			$smarty->assign("contact","");
			$smarty->assign("message","");
			$smarty->assign("ticket_id",'');
			//$smarty->assign("SendMeCopy","");
		}
		else
		{  
			failure_msg("Error occured while sending mail...! Please try again later");
		    redirect('contact_us.php?'.$send_url);
		
		}
	}
	//end of if($error_msg=="")

}
//assign error/update message
$smarty->assign("error_msg",$error_msg);
$smarty->assign("update_msg",$update_msg);

//display template
$smarty->assign('site_page_title',$page_title);
$smarty->assign('site_title',$site_title);
$smarty->display('contact_us.tpl');
?>
