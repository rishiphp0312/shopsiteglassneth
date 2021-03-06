<?php
include ('include/common.inc');
include ('class/class.cms.inc');
include ('class/class.mail.inc');
include ('class/class.user.inc');
include ('include/sendEmailClass.php');
include ('captcha/php-captcha.php');
include ("include/authentiateUserLogin.php");


//create business class object
$objCMS	= new Class_CMS();

//create user class object
$objUser = new Class_User();

//create mail class object
$objMail 	= new Class_Mail();

// Creating object of SendEmailClass
$emailObj 	= new SendEmailClass;

//get page details
//$page_title = trim($_GET['page']);
/*$page_link_id = "contact_us";
/*
if($page_link_id && $page_link_id!="")
{
	$objCMS->page_link_id = $page_link_id;
	$resCMS = $objCMS->selectCmsPage();
	$resCMSRow = mysql_fetch_array($resCMS);
	
	$smarty->assign('page_title',$resCMSRow['page_title']);
	$smarty->assign('description',$resCMSRow['description']);
	$smarty->assign('posttime',$resCMSRow['posttime']);
	
}
*/
//echo $resCMSRow['page_title'];
if(isset($resCMSRow['page_title']))
{
	$page_title = $resCMSRow['page_title'];
}
else
{
	$page_title = SITE_CONTACT;
}

//get user details if user logged in
if(isset($_SESSION['session_user_id'])&& $_SESSION['session_user_id']!="")
{

	$objUser->id = $_SESSION['session_user_id'];
	$UserRes = $objUser->getUserLoginDetails();
	$UserArr = mysql_fetch_array($UserRes);

	//assign user details information
	$smarty->assign("f_name",$UserArr['FirstName']);
 	$smarty->assign("l_name",$UserArr['LastName']);
 	$smarty->assign("contact_email",$UserArr['Email']);
	$smarty->assign("phone",$UserArr['Phone']);
}

//validate captcha code
function validateCaptcha($captchaCode)
{
    if (PhpCaptcha :: Validate($captchaCode))
	{
    	return true;
    }
    else
	{
    	return false;
    }    	
}
//get email template
$objMail->mail_title	= "Email Template"; 
$MailTemplate			= $objMail->selectMailTemplate();
//$templateRowArr 		= mysql_fetch_array($MailTemplate);
//$mail_content			= $templateRowArr['mail_content'];
//$mail_content			= str_replace("#link#",$baseUrl,$mail_content);

//$con_mail_content			= $mail_content;
//echo $mail_content;die;
	
//get Contact US email content
$objMail->mail_title	= "Dashboard"; 
$MailRes 				= $objMail->selectMailTemplate();
$mailRowArr 			= mysql_fetch_array($MailRes);
$subject 				= $mailRowArr['mail_subject'];  
$message_content		= $mailRowArr['mail_content'];




//replace message content with mail template message conyent variable
$mail_content			= str_replace("#message_content#",$message_content,$mail_content);
$mail_content			= str_replace("#link#",$baseUrl,$mail_content);

//replace confirmation message content with mail template message conyent variable
/*$con_mail_content			= str_replace("#message_content#",$con_message_content,$con_mail_content);
$con_mail_content			= str_replace("#link#",$baseUrl,$con_mail_content);*/

//echo $mail_content;die;

//send and login details email to user
if($_SERVER['REQUEST_METHOD']=='POST')
{
	extract($_POST);
	$name		= rteSafe($f_name).' '.rteSafe($l_name);
	$phone		= rteSafe($phone);
	$email		= rteSafe($contact_email);
	$message	= rteSafe($message);
	$emailTo	= $admin_email;
	//$emailTo	= $contact;
	/*if(isset($SendMeCopy) && $SendMeCopy==1)
	{
		$emailTo = $emailTo.",".$email;
	}*/
	$mailFrom = $name."<".$email.">";
	$error_msg = "";
	
	//assign post values
	$smarty->assign("f_name",$f_name);
	$smarty->assign("l_name",$l_name);
	$smarty->assign("phone",$phone);
	$smarty->assign("contact_email",$contact_email);
	$smarty->assign("contact",$contact);
	$smarty->assign("message",$message);
	//$smarty->assign("SendMeCopy",$SendMeCopy);
	
	//validate captcha security code first	
	if(!validateCaptcha(trim($CaptchaCode)))
	{
		$error_msg .= "Please enter the captcha text again";
	}
	//if no errors found
	if($error_msg=="")
	{	
		//send contact us email
		$mail_content= str_replace("#name#",$name,$mail_content);
		$mail_content= str_replace("#email#",$email,$mail_content);
		$mail_content= str_replace("#phone#",$phone,$mail_content);
		$mail_content= str_replace("#contact#",$contact,$mail_content);
		$mail_content= str_replace("#message#",$message,$mail_content);
		
		//send contact us confirmation email
		$con_mail_content= str_replace("#name#",$name,$con_mail_content);

		//echo $mail_content;die;
		//$mail_content=str_replace("\n","<br>",$mail_content);
		$emailStatus 	= $emailObj->SendHtmlMail($emailTo, $subject, $mail_content, $mailFrom);
		//$conEmailStatus = $emailObj->SendHtmlMail($mailFrom, $conSubject, $con_mail_content, ADMIN_MAIL_ID);
		if($emailStatus == true)
		{
			success_msg("Thank you. Your message has been sent. Our representatives will reply within 24-48 hrs");
			redirect('contact_us.php');
			//header("location:thanks.php?type=4");
			
			//reset all fields
			$smarty->assign("f_name","");
			$smarty->assign("l_name","");
			$smarty->assign("phone","");
			$smarty->assign("contact_email","");
			$smarty->assign("contact","");
			$smarty->assign("message","");
			//$smarty->assign("SendMeCopy","");
		}
		else
		{
			failure_msg("Error occured while sending mail...! Please try again later");
			redirect('contact_us.php');
		}
	}//end of if($error_msg=="")

}
//assign error/update message
$smarty->assign("error_msg",$error_msg);
$smarty->assign("update_msg",$update_msg);

//display template
$smarty->assign('site_page_title','Dashboard');
$smarty->assign('site_title',$site_title);
$smarty->display('dashboard.tpl');
?>
