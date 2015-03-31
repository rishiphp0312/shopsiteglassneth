<?php
include ('include/common.inc');
include ('class/class.mail.inc');
include ('class/class.user.inc');
include ('include/sendEmailClass.php');
include ('captcha/php-captcha.php');




//create user class object
$objUser        = new Class_User();
//create mail class object
$objMail 	    = new Class_Mail();
// Creating object of SendEmailClass
$emailObj       = new SendEmailClass;


//validate captcha code
function validateCaptcha($CaptchaCode1)
{/*
    if (PhpCaptcha :: Validate($CaptchaCode1))
	{ 
	    //echo 'ata';
    	return true;
    }
    else
	{
    	return false;
    }    	
*/}
//validate captcha code


//echo $baseUrl;
//get email template
$objMail->mail_title        = "Email Template";
$MailTemplate			    = $objMail->selectMailTemplate();
$templateRowArr 		    = mysql_fetch_array($MailTemplate);
$mail_content			    = $templateRowArr['mail_content'];
$mail_content			    = str_replace("#link#",$baseUrl,$mail_content);
//$mail_content_user		= str_replace("#link#",$baseUrl,$mail_content);

	

//get Contact US email content
$objMail->mail_title		= "Contact US"; 
$MailRes			        = $objMail->selectMailTemplate();
$mailRowArr     		    = mysql_fetch_array($MailRes);
 $subject 			    = $mailRowArr['mail_subject'];  
 $message_content		    = $mailRowArr['mail_content'];

$mail_content_admin	 = str_replace("#message_content#",$message_content,$mail_content);
//send and login details email to admin

if($_SERVER['REQUEST_METHOD']=='POST')
{  

    //mail("rishi_kapoor@seologistics.com","hi","kal aaya nahi");
	extract($_POST);
	$name		= rteSafe($contactname); 
	$phone		= rteSafe($contactphone);
	$email		= rteSafe($contactemail);
	$message	= rteSafe($contactmessage);
	$emailTo	= SITE_ADMIN_EMAIL;
   ////////// -----start ticket code---------------///
	//validate captcha security code first	
	if(!validateCaptcha(trim($CaptchaCode)))
	{/*
		$error_msg = "Please enter the captcha text again";
		//unset($_SESSION[CAPTCHA_SESSION_ID]);
		//redirect('contact_us.php');
		
	*/}
	//assign post values
	$smarty->assign("f_name",$f_name);
	//if no errors found
	if($error_msg=="")
	{
	$mail_content	   = str_replace("#link#",$baseUrl,$mail_content);	
	/// ---------end ticket code----------------////
	$mailFrom          = $name."<".$contactemail.">";
	//send contact us email to admin
	$mail_content_admin = str_replace("#name#",$contactname,$mail_content_admin);
	$mail_content_admin = str_replace("#email#",$contactemail,$mail_content_admin);
	$mail_content_admin = str_replace("#phone#",$contactphone,$mail_content_admin);
	$mail_content_admin = str_replace("#message#",$contactmessage,$mail_content_admin);
    $mail_content_admin = str_replace("#link#",$baseUrl,$mail_content_admin);
//exit;
	//send contact us confirmation email
	//$send_email_touser   = $contact_email ;   // send to  user
	$send_email_toadmin  = SITE_ADMIN_EMAIL;    // send to  admin
	$emailStatus = $emailObj->SendHtmlMail($send_email_toadmin,$subject,$mail_content_admin,$mailFrom); 
	// for admin

}

	//echo $mail_content;die;
		//$mail_content=str_replace("\n","<br>",$mail_content);
		//if(validateCaptcha(trim($CaptchaCode)))
	            
		if($emailStatus == true)
		{
			success_msg("Thank you.Your message has been sent.Our representatives will contact you shortly.");
		        redirect('contact-us.php');
			//header("location:thanks.php?type=4");
			

		}
		else
		{  
			 failure_msg("Error occured while sending mail...! Please try again later");
		     redirect('contact-us.php');
			 }
}
	//end of if($error_msg=="")

//assign error/update message
$smarty->assign("error_msg",$error_msg);
$smarty->assign("update_msg",$update_msg);//display template
$smarty->assign('site_page_title',$page_title);
$smarty->assign('site_title',$site_title);
$smarty->display('contact-us.tpl');
?>
