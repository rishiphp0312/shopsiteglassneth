<?php
// email notification for sending reminder before 15 days
/*include ('include/common.inc');
include ('class/class.package.inc');
include ('class/class.user.inc');
include ('class/class.mail.inc');
include ('include/sendEmailClass.php');
include ('captcha/php-captcha.php');*/
include ('class/dbconnector.inc'); //DB connection file
include ('include/functions.php'); //common functions
include ('class/class.cms.inc');
include ('class/class.user.inc');
include ('class/class.mail.inc');
include ('class/class.item.inc');
include ('class/class.package.inc');
include ('include/sendEmailClass.php');
//include ('captcha/php-captcha.php');
$baseUrl = "http://www.nethaat.com/";
// done-linux
//create user class object
$objUser      						  = new Class_User();
$objPackage     					  = new Class_Package();

$emailObj       					  = new SendEmailClass();
$objMail 	                          = new Class_Mail();

$objMail->mail_title	              = "Email Template";
$MailTemplate			              = $objMail->selectMailTemplate();
$templateRowArr 		              = mysql_fetch_array($MailTemplate);
$mail_content			              = $templateRowArr['mail_content'];
$mail_content			              = str_replace("#link#",$baseUrl,$mail_content);

$objMail->mail_title	              = "Auto_Email_Package_expiry_bfr15";
$MailTemplate			              = $objMail->selectMailTemplate();
$templateRowArr 		              = mysql_fetch_array($MailTemplate);
$mail_content1			              = $templateRowArr['mail_content'];
$objPackage->check_expiry   		  = 15;
$objPackage->status                   = 1;

$objResCatTotal                       = $objPackage->getPackagedetails();
$num_rows_pacakage                    = mysql_num_rows($objResCatTotal);
if($num_rows_pacakage>0)
{
  while($arr_fetch_asoc_pack_info = mysql_fetch_assoc($objResCatTotal))
    {
     $pack_trans_id      = $arr_fetch_asoc_pack_info['pack_id'];
     $pack_name          = ucfirst($arr_fetch_asoc_pack_info['pack_name']);
     $pack_expirydate    = $arr_fetch_asoc_pack_info['expiry_date'];
     $pack_maxitem       = $arr_fetch_asoc_pack_info['max_items'];
     $user_name = $arr_fetch_asoc_pack_info['first_name'].''.$arr_fetch_asoc_pack_info['last_name'];
     $to_email_id        = $arr_fetch_asoc_pack_info['email'];
     $mail_content	     =  str_replace("#message_content#",$mail_content1,$mail_content);
     $mail_content	     =  str_replace("#user_name#",$user_name,$mail_content);
     $mail_content	     =  str_replace("#pack_maxitem#",$pack_maxitem,$mail_content);
     $mail_content	     =  str_replace("#pack_expirydate#",$pack_expirydate,$mail_content);
     $mail_content	     =  str_replace("#pack_name#",$pack_name,$mail_content);

     $subject 		     =  $templateRowArr['mail_subject'];
     $mailFrom           =  "Nethaat";
    // $mail_content	 =  str_replace("#message_table#",$message,$mail_content);
     $mail_content	     =  str_replace("#link#",$baseUrl,$mail_content);
     $mailFrom           =  "Nethaat";
  	 $out_put =   $emailObj->SendHtmlMail($to_email_id,$subject,$mail_content,$mailFrom);
	 $chek_r .=  $to_email_id.',ema-optut=='.$out_put.',';
   //$emailObj->SendHtmlMail('rishi_kapoor@seologistics.com',$subject,$mail_content,$mailFrom);
     }
} //echo 'packid--'.$pack_trans_id;
//echo $to_email_id;
echo 'emobj=='.$emailObj->SendHtmlMail('rishi_kapoor@seologistics.com','15-days-packge-expiry',$chek_r,$mailFrom);


?>
