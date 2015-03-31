<?php
include ('include/common.inc');
include ('class/class.user.inc');
include ('class/class.mail.inc');
include ('include/sendEmailClass.php');

//create user class object
$objUser 	= new Class_User();

//create mail class object
$objMail 	= new Class_Mail();

// Creating object of SendEmailClass
$emailObj 	= new SendEmailClass;

//get email template
$objMail->mail_title	        = "Email Template";
$MailTemplate			= $objMail->selectMailTemplate();
$templateRowArr 		= mysql_fetch_array($MailTemplate);
$mail_content			= $templateRowArr['mail_content'];
$mail_content			= str_replace("#link#",$baseUrl,$mail_content);
//echo $mail_content;die;
	
//get forgot password email content
$objMail->mail_title	        = "Forgot Password";
$MailRes 			= $objMail->selectMailTemplate();
$mailRowArr 			= mysql_fetch_array($MailRes);
$subject 			= $mailRowArr['mail_subject'];  
$message_content		= $mailRowArr['mail_content'];

//replace message content with mail template message conyent variable
$mail_content			= str_replace("#message_content#",$message_content,$mail_content);
$mail_content= str_replace("#link#",$baseUrl,$mail_content);
//echo $mail_content;die;

//send and login details email to user
if($_SERVER['REQUEST_METHOD']=='POST')
{
	extract($_POST);
	$objUser->email   	= rteSafe($email);
	
	$error_msg = "";
	
	//check existing email
	if(!$objUser->forgetValidateExisringEmail())
	{
		$error_msg = "Provided email address does not exists...!";
	}
	else
	{
		$userRes	= 	$objUser->getUserLoginDetails();
		$userArr	= 	mysql_fetch_array($userRes);
	}
	
	//check security question
/*	if($userArr['security_question'] != $security_question)
	{
		$error_msg = "Selected security question is not correct";
	}
	//check security answer
	else if($userArr['security_answer'] != $security_answer)
	{
		$error_msg = "Your security answer does not matched with our database";
	}
	else
	{
		$error_msg = "";
	}
*/
	//check existing email
	if($error_msg == "")
	{
		//set new password for user
		$new_password		= generatePassword();
		$objUser->id		= $userArr['id'];
		$objUser->password	= md5($new_password);
		$objUser->updateUserPassword();
		
		//get values for email template
		$name		= 	$userArr['username'];
		$email	  	= 	$userArr['email'];
		$password 	= 	$new_password;
		
		
		//send forgot password email to user
		$mail_content= str_replace("#name#",$name,$mail_content);
		//$mail_content= str_replace("#email#",$email,$mail_content);
		$mail_content= str_replace("#password#",$password,$mail_content);
		//$mail_content=str_replace("\n","<br>",$mail_content);
		//echo $mail_content;die;
		
		$emailStatus = $emailObj->SendHtmlMail($email, $subject, $mail_content, $mailFrom);
		if($emailStatus)
		{
			$update_msg = "Thank you. Your login information has been sent to your email address listed";
			success_msg($update_msg);
			redirect('login.php');
		}
		else
		{
			$error_msg = "Error occured while sending email...! Please try again later";
			failure_msg($error_msg);
			redirect('forgot_password.php');
		}
	}
	//assign post values
	$smarty->assign("email",$email);
	$smarty->assign("security_question",$security_question);
	$smarty->assign("security_answer",$security_answer);
}

//assign error/update message
$smarty->assign("error_msg",$error_msg);

//display template
$smarty->assign('site_page_title',SITE_FORGOT_PASSWORD);
$smarty->assign('site_title',$site_title);
$smarty->display('forgot_password.tpl');
?>