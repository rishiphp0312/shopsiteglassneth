<?php
include ("common_includes.php");
include ("../include/adminsession.php.inc");
include ("../class/class.user.inc");

//create mail class object
$objMail 	= new Class_Mail();

// Creating object of SendEmailClass
$emailObj 	= new SendEmailClass;

//create user class object
$objUser		= new Class_User();

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
{
	//post variables
	extract($_POST);
	$emailTo		= "";
	$subject		= rteSafe($subject);
	$message		= rteSafe($message);
	//$emailTo		= rteSafe($emailTo);
	if($contact_list=='active_users')
	{
		$objUser->user_status = 1;            //only active users
	}
	if($contact_list=='inactive_users')
	{
		$objUser->user_status = 0;             //only Inactive users
	}

    if($contact_list==3 || $contact_list==4 )
	{
		$objUser->user_type = $contact_list;    //only for buyer or seller
	}

	$resUsersList = $objUser->selectUser();
	while($userListRow = mysql_fetch_array($resUsersList))
	{
		$emailTo .= $userListRow['email'].',';
	}
	$emailTo = substr($emailTo,0,strlen($emailTo)-1);
	
	//print_r($_POST);
	//send email
	$mail_content= str_replace("#message_content#",$message,$mail_content);
	//echo $mail_content;
	//echo $emailTo;
	//echo $subject;
	//exit;
	$emailStatus = $emailObj->SendHtmlMail($emailTo, $subject, $mail_content, $mailFrom);
	//exit;
	if($emailStatus)
	{
		success_msg("Mail has been sent successfully!");
		redirect("admin_users.php");
	}
	else
	{
		failure_msg("Error occured while sending email, please try again later");
		redirect("admin_user_send_mail.php?user_id=".$_GET['user_id']);
	}
}

//display template and title
$smarty->assign('site_page_title',ADMIN_COMMON_TITLE);
$smarty->assign('site_title',$site_title);
$smarty->display('admin_send_bulk_mail.tpl');	
?>