<?php
include ("common_includes.php");
include ('../class/class.news_letter.inc');
include ("../include/adminsession.php.inc");



//create mail class object
$objMail 	= new Class_Mail();

// Creating object of SendEmailClass
$emailObj 	= new SendEmailClass;

//create object of Class_NewsLetter class
$objNewsLetter = new Class_NewsLetter();

//selects users list to send email
$usersList = array();
$objNewsLetter->status = 1;//select oncy active
$objResUsers = $objNewsLetter->selectNewsLetter();
while($UserRow = mysql_fetch_array($objResUsers))
{
	$userList[]	= $UserRow;
}
$smarty->assign('userList',$userList);

//get monthly news letter email template
$objMail->mail_title	= "Email Template"; 
$MailRes 				= $objMail->selectMailTemplate();
$mailRowArr 			= mysql_fetch_array($MailRes);
$mail_subject 			= $mailRowArr['mail_subject'];  
$mail_content			= $mailRowArr['mail_content'];
$mail_content= str_replace("#link#",$baseUrl,$mail_content);
//echo $mail_content;die;

//get monthly news Letter Content
$objMail->mail_title	= "News Letter"; 
$MailRes2 				= $objMail->selectMailTemplate();
$mailRowArr2 			= mysql_fetch_array($MailRes2);
$mail_subject2 			= $mailRowArr2['mail_subject'];  
$smarty->assign('mail_subject2',$mail_subject2);


if($_SERVER['REQUEST_METHOD']=="POST")
{
	//post variables
	extract($_POST);
	$subject		= rteSafe($subject);
	$message		= rteSafe($message);
	
	//collect all email address's
	$emailTo = "";
	for($i=0; $i<count($UserEmails); $i++)
	{
		if($emailTo=="")
		{
			$emailTo = 	$UserEmails[$i];
		}
		else 
		{
			$emailTo .= ",".$UserEmails[$i];
		}
	}
	//echo "email==".$emailTo;die;
	if($emailTo!="")
	{
		//update email template
		$objMail->mail_id = 8;
		$objMail->mail_subject = $subject;
		$objMail->mail_content = $message;
		$objDBReturn	= $objMail->insertUpdateMailTemplate(); 
		 
		if($objDBReturn->nErrorCode==0)
		{
			//send contact us email
			$mail_content= str_replace("#message_content#",$message,$mail_content);
			//echo $mail_content;die;
			$emailStatus = $emailObj->SendHtmlMail($emailTo, $subject, $mail_content, $mailFrom);
			if($emailStatus)
			{
				//redirect user
				success_msg("News letter has been sent successfully!");
			}
			else
			{
				failure_msg("Error occured while sending email from this server. Please try again!");
			}
			
			redirect("admin_news_letter.php");
		}
	}//end of if($emailTo!="")
	else 
	{
		$error_msg = "Please select at least one contact email to send news letter";
		$smarty->assign("mail_subject2",$subject);
	}
}



//assign error message
$smarty->assign("error_msg",$error_msg);


//display template and title
$smarty->assign('site_page_title',ADMIN_PAGE_MGMT);
$smarty->assign('site_title',$site_title);
$smarty->display('admin_send_news_letter.tpl');	
?>