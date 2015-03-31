<?php
include ("common_includes.php");
include ("../include/adminsession.php.inc");
//include ('../class/class.mail.inc');
//include ('../include/sendEmailClass.php');
include ("../class/class.user.inc");

//create mail class object
$objMail 	= new Class_Mail();

// Creating object of SendEmailClass
$emailObj 	= new SendEmailClass;

//create user class object
$objUser		= new Class_User();

//selects user details
if(isset($_REQUEST["user_id"]) && $_REQUEST["user_id"]!="")
{
	$objUser->id = $_REQUEST["user_id"];
	$resUser = $objUser->selectUser();
	$resUserRow = mysql_fetch_array($resUser);
	$smarty->assign('emailTo',$resUserRow["email"]);
}
//print_r($resUserRow);
//get monthly news letter email template
$objMail->mail_title	= "Email Template"; 
$MailRes 				= $objMail->selectMailTemplate();
$mailRowArr 			= mysql_fetch_array($MailRes);
$mail_subject 			= $mailRowArr['mail_subject'];  
$mail_content			= $mailRowArr['mail_content'];
$mail_content= str_replace("#link#",$baseUrl,$mail_content);
//echo $mail_content;die;

//get user email Content
$objMail->mail_title	= "Email To User"; 
$MailRes2 				= $objMail->selectMailTemplate();
$mailRowArr2 			= mysql_fetch_array($MailRes2);
$mail_subject2 			= $mailRowArr2['mail_subject'];  
$smarty->assign('mail_subject2',$mail_subject2);


if($_SERVER['REQUEST_METHOD']=="POST")
//if($_REQUEST['Submit'])
{
//	exit;
	//post variables
	extract($_POST);
	$subject		= rteSafe($subject);
	$message		= rteSafe($message);
	$emailTo		= rteSafe($emailTo);
		
	//update email template
	/*$objMail->mail_id = 9;
	$objMail->mail_subject = $subject;
	$objMail->mail_content = $message;
	$objDBReturn	= $objMail->insertUpdateMailTemplate(); */
	 
	//send email
	$mail_content= str_replace("#message_content#",$message,$mail_content);
	//echo $mail_content;die;
//	print_r($_POST);
	$emailStatus = $emailObj->SendHtmlMail($emailTo, $subject, $mail_content, $mailFrom);
//	exit;
	if($emailStatus)
	{
		success_msg("Mail has been sent successfully!");
		redirect("admin_users.php");
	}
	else
	{
		failure_msg("Error occured while sending email, please try again later");
		redirect("admin_user_send_mail.php?user_id=".$_REQUEST['user_id']);
	}
}

//display template and title
$smarty->assign('site_page_title',ADMIN_COMMON_TITLE);
$smarty->assign('site_title',$site_title);
$smarty->display('admin_user_send_mail.tpl');	
?>