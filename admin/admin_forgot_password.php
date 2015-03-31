<?php
include ("common_includes.php");
include ("../class/class.user.inc");

//create object of user class
$objUser = new Class_User();

//create mail class object
$objMail 	= new Class_Mail();

// Creating object of SendEmailClass
$emailObj 	= new SendEmailClass;

//if login session exists
if($_SESSION['session_admin_user_id'] != '') 
{
	header('Location:admin_home.php');
    exit;
}

//get email template
$objMail->mail_title	= "Email Template"; 
$MailTemplate			= $objMail->selectMailTemplate();
$templateRowArr 		= mysql_fetch_array($MailTemplate);
$mail_content			= $templateRowArr['mail_content'];
$mail_content			= str_replace("#link#",$baseUrl,$mail_content);
//echo $mail_content;die;
	
//get forgot password email content
$objMail->mail_title	= "Admin Forgot Password"; 
$MailRes 				= $objMail->selectMailTemplate();
$mailRowArr 			= mysql_fetch_array($MailRes);
$subject 				= $mailRowArr['mail_subject'];  
$message_content		= $mailRowArr['mail_content'];

//replace message content with mail template message conyent variable
$mail_content			= str_replace("#message_content#",$message_content,$mail_content);
$mail_content= str_replace("#link#",$baseUrl,$mail_content);
//echo $mail_content;die;


//if submit form
if($_SERVER['REQUEST_METHOD']=="POST")
{
	//post variables
	extract($_POST);
	$objUser->admin_email   	= rteSafe($admin_email);
	
	//check existing email
	if($objUser->validateAdminEmail())
	{
		$userRes	= 	$objUser->getAdminUserLoginDetails();
		$userArr	= 	mysql_fetch_array($userRes);
		
		//get values for email template
		$name		=	$userArr['admin_name'];
		$email		=	$userArr['admin_email'];
		$username	=	$userArr['admin_user_name'];
		$password	=	$userArr['password'];
		
		
		//send forgot password email to user
		$mail_content= str_replace("#name#",$name,$mail_content);
		$mail_content= str_replace("#username#",$username,$mail_content);
		$mail_content= str_replace("#password#",$password,$mail_content);
		//$mail_content=str_replace("\n","<br>",$mail_content);
		$emailStatus = $emailObj->SendHtmlMail($email, $subject, $mail_content, $mailFrom);
		if($emailStatus)
		{
			$update_msg = "Thank you. Your login information has been sent to your email address listed";
			success_msg($update_msg);
			redirect('index.php');
		}
		else
		{
			failure_msg("Error occured ...! Please try again");
			redirect('admin_forgot_password.php');
		}
	}
	else
	{
		failure_msg("Provided email address does not exists...!");
		redirect('admin_forgot_password.php');
	}
	
}
$smarty->assign('error_msg',$error_msg);


//display template and title
$smarty->assign('site_page_title',ADMIN_LOGIN);
$smarty->assign('site_title',$site_title);
$smarty->display('admin_forgot_password.tpl');	
?>