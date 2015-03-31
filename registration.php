<?php
include ('include/common.inc');
include ('class/class.user.inc');
include ('class/class.mail.inc');
//include ('class/crypto_class.php');
include ('class/encryption_class.php');
include ('include/sendEmailClass.php');
include ('include/country_state_cat.php');
include ('class/class.news_letter.inc');
$objNLetter = new Class_NewsLetter;


//check user session first
if(isset($_SESSION['session_user_id']) && $_SESSION['session_user_id'])
{
	$userURL = $baseUrl."my_account.php";
	redirect($userURL);
	exit;
}

//create user class object
$objUser 	= new Class_User();
//create mail class object
$objMail 	= new Class_Mail();
// Creating object of SendEmailClass
$emailObj 	= new SendEmailClass;
//Encryption/Description class object
$objEnc	= new EncryptDcrypt();


 $name_after_domain     = $_SERVER['HTTP_HOST'];
 $exp_name_after_domain = explode(".",$name_after_domain);
 $curent_page           =  $_SERVER['PHP_SELF'];
 $base_curent_page      = basename($curent_page); 
 $exp_name_after_domain = explode(".",$name_after_domain);
if($name_after_domain=='www.nethaat.com' )
{
}
else
{

    $add_this_name_red         =   'featured_store_information.php';
    // header("Location:$add_this_name_red");
//	redirect($add_this_name_red);
 
}


//set default user type
$smarty->assign('user_type', 3);


//get email template
$objMail->mail_title	= "Email Template"; 
$MailTemplate			= $objMail->selectMailTemplate();
$templateRowArr 		= mysql_fetch_array($MailTemplate);
$mail_content			= $templateRowArr['mail_content'];
$mail_content			= str_replace("#link#",$baseUrl,$mail_content);
//echo $mail_content;die;
	
//get registration email content
$objMail->mail_title	= "Registration"; 
$MailRes 				= $objMail->selectMailTemplate();
$mailRowArr 			= mysql_fetch_array($MailRes);
$subject 				= $mailRowArr['mail_subject'];  
$message_content		= $mailRowArr['mail_content'];

//replace message content with mail template message conyent variable
$mail_content			= str_replace("#message_content#",$message_content,$mail_content);
$mail_content			= str_replace("#link#",$baseUrl,$mail_content);

$anObject               = new Class_Dynamic() ;
$curnt_cotry_code       = getIPAdressInfomation($_SERVER['REMOTE_ADDR']);

$anObject->country_code = $curnt_cotry_code;
$resCountry_code        = $anObject->selectCountry();
if(mysql_num_rows($resCountry_code)>0)
{
$arr_ip_countryid = mysql_fetch_assoc($resCountry_code);
$fetch_country_id= $arr_ip_countryid['id'];

}
//echo $country_id;

//echo $mail_content;die;

  //$objMail->mail_title	= "Registration"; 
  //$MailRes 				= $objMail->selectMailTemplate();
  //$IPcountry_id		    = mysql_fetch_array($MailRes);
  //echo 'country=='.$fetch_country_id = ;
  
  //submit registration form
if($_SERVER['REQUEST_METHOD']=='POST')
{
	//extract post variables array
	extract($_POST);
	$objUser->username   		= rteSafe($username);	
	$objUser->email  		    = rteSafe($email);
	$objUser->first_name  		= rteSafe($first_name);
	$objUser->last_name  		= rteSafe($last_name);
	$objUser->zipcode  		    = rteSafe($zipcode);
	$objUser->phone1  		    = rteSafe($phone1);
    $objUser->city			    = rteSafe($city);
	$objUser->zipcode		    = rteSafe($zipcode);
	$objUser->state			    = rteSafe($state);
	$objUser->country_id		= $country_id;

	
	$objUser->password  		= md5(rteSafe($password));
	$objUser->security_question	= $security_question;
	$objUser->security_answer	= rteSafe($security_answer);
	//$objUser->user_type  		= $user_type;
	
    $objUser->user_type  		= '3';
/*	if($objUser->user_type==4)
	{
		$objUser->city_value        = $city_value; 
		$objUser->country_value     = $country_value; 
		$objUser->state_value       = $state_value;
	}
	else
	{
		$objUser->city_value        = ''; 
		$objUser->country_value     = ''; 
		$objUser->state_value       = '';
	}

*/
	//$objUser->status  		= 1; //active user by default
		
	$error_msg = "";
	
	if(!validateUserName($username))
	{
		$error_msg = "Username should be alpha numeric with minimum 3 characters long. Only _(hyphen) and _(underscore) characters are allowed";
	}
	//check existing username
	if($objUser->validateExisringUsername())
	{
		$error_msg = "Provided username already in use...!";
		
	}
	//check existing email
	if($objUser->validateExisringEmail())
	{
		$error_msg = "Provided email address already in use...!";
		
	}
	/*//validate captcha security code first	
	if(!validateCaptcha(trim($CaptchaCode)))
	{
		$error_msg .= "<br>Please enter the captcha text again.";
	}*/
	


	//if no errors found
	if($error_msg=="")
	{
		//get values for email template
		$username	= $username;
		$email		= $email;
		$password	= $password;
		
		
		
		$objNLetter->news_letter_email  = rteSafe($email);
		$objNLetter->status =1;				
		$objDBReturn = $objNLetter->insertUpdateNewsLetter();	
		
			
		$objDBReturn = $objUser->insertUpdateUser();		
		if($objDBReturn->nIdentity && $objDBReturn->nErrorCode==0)
		{
			//get user id in session
			//$_SESSION['session_user_id'] = $objDBReturn->nIdentity;
			
			//$encCode = encryptStr("username=".$username."&id=".$objDBReturn->nIdentity);
			//$activation_link = $baseUrl."activate.php?".$encCode;

			$encCode = "username=".$username."&id=".$objDBReturn->nIdentity;
			$activation_link = $baseUrl."activate.php?".$objEnc->encrypt($encCode);
			
			//send registration email to user
			$mail_content = str_replace("#username#", $username, $mail_content);
			//$mail_content = str_replace("#email#", $email, $mail_content);
			$mail_content = str_replace("#password#", $password, $mail_content);
			$mail_content = str_replace("#activation_link#", $activation_link, $mail_content);
			//$mail_content=str_replace("\n","<br>",$mail_content);
			$emailStatus = $emailObj->SendHtmlMail($email, $subject, $mail_content, $mailFrom);
			//echo $mail_content;
			
			if($emailStatus)
			{
				success_msg("Your registration was successfull");
				
				//send mail to admin
				$admin_Subject =" New User Registered at Nethaat";
				$admin_Message = "Hello Nethaat Team,<br />A new user has registered at Nethaat.<br />This email contains their details:<br /><br />";
				$admin_Message .="<br /><b>Username:</b> ".$username;
				$admin_Message .="<br /><b>Email:</b> ".$email;
				$admin_Message .= "<br /><br />Please do not respond to this message as it is automatically generated and is for information purposes only.";
				$emailObj->SendHtmlMail($admin_email, $admin_Subject, $admin_Message, $mailFrom);
			}
			else
			{
				$error_msg = "Error occured ...!Please try again";
				failure_msg("Error occured while sending email, please contact Administrator to confirm your registration");
			}
			redirect("thanks.php?type=regconfirm");
		}//end of if
	}//end of if
	
	//assign error messages
	$smarty->assign('error_msg',$error_msg);
	
	//assign back all post variables
	$smarty->assign('username',$username);
	$smarty->assign('first_name',$first_name);
	$smarty->assign('last_name',$last_name);
	//$smarty->assign('zipcode',$zipcode);
	//echo 'country=='.$country_id;
    $smarty->assign('city',$city);
	$smarty->assign('zipcode',$zipcode);
	$smarty->assign('state',$state);
	$smarty->assign('country_id',$country_id);
	$smarty->assign('phone1',$phone1);	
	$smarty->assign('email',$email);
	$smarty->assign('password',$password);
	$smarty->assign('security_question',$security_question);
	$smarty->assign('security_answer',$security_answer);
	$smarty->assign('user_type',$user_type);
	$smarty->assign('agree',$agree);
}//end of if

	if($_REQUEST['country_id']!='')
	{
      $smarty->assign('country_id',$_REQUEST['country_id']);
	}else
	{
	  $smarty->assign('country_id',$fetch_country_id);
	}
	//echo 'country=='.$fetch_country_id;
//assign page title and display template
$smarty->assign('site_page_title','Nethaat: Open A Store');
$smarty->assign('site_title',$site_title);
$smarty->display('registration.tpl');
?>