<?php
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

// email notification for sending reminder before 7 day from event
//create user class object
// done-linux
$objUser = new Class_User();
// script runs once in week 
// Creating object of SendEmailClass
$emailObj 	= new SendEmailClass;


  for($i=0;$i<7;$i++)
    {
       $next_15_days_array    = time() + ($i * 24 * 60 * 60);
       $next_15_month[]       = date('m', $next_15_days_array) ;
       $next_15_days[]        = date('d', $next_15_days_array) ;
    }

   $next_15_month              = array_unique($next_15_month);		   
   $implode_days               = implode($next_15_days,',');
  // echo '<br>';
   $implode_month              = implode($next_15_month,',');
   
   $objUser->order_by_date     = 1;
   $objUser->group_by_user_id  = 1;
   $objUser->group_function    = 1;
   $objUser->implode_month     = $implode_month;
   $objUser->implode_days      = $implode_days;

   $reminderlisting_details    = $objUser->getreminderlisting(); // to show listing of  reminders
   $num_rows_items1            = mysql_num_rows($reminderlisting_details);
   if($num_rows_items1>0)
     {
      while($arr_items_array = mysql_fetch_array($reminderlisting_details))
	{
	$item_values_user_ids[]              = $arr_items_array['user_id'];
    $item_values_event_titles[]          = $arr_items_array['rem_title_grp'];
	$item_values_holder_name[]           = $arr_items_array['name_grp'];
	$item_values_event_day[]             = $arr_items_array['event_day_grp'];
	$item_values_event_month[]           = $arr_items_array['event_month_grp'];

	}
     }


	//print_r($item_values_user_ids);
	for($i=0;$i<count($item_values_user_ids);$i++)
	{
	$objUser->id              = $item_values_user_ids[$i];
	$result_user_details      = $objUser->selectUser();
    $num_user_details         = mysql_num_rows($result_user_details);
    if($num_user_details>0)
	{
	      $arr_fetch_em_sender      = mysql_fetch_assoc($result_user_details);
	      $email_to                 = $arr_fetch_em_sender['email'];
          $name_to                  = $arr_fetch_em_sender['first_name'].''.$arr_fetch_em_sender['last_name'];
	}
          
	$event_title                = $item_values_event_titles[$i];
	$event_title_exp            = explode(",",$event_title);
	$event_name_grp             = $item_values_holder_name[$i];
	$event_name_grp_exp         = explode(",",$event_name_grp);
	$event_day_grp              = $item_values_event_day[$i];
	$event_day_grp_exp          = explode(",",$event_day_grp);
	$event_month_grp            = $item_values_event_month[$i];
	$event_month_grp_exp        = explode(",",$event_month_grp);

	
	$subject              = 'Events Notification ';

        $to                   = $email_to;



	$objMail                              =  new Class_Mail();
	$objMail->mail_title	              =  "Email Template"; 
        $MailTemplate		              =  $objMail->selectMailTemplate();
        $templateRowArr		              =  mysql_fetch_array($MailTemplate);
        $mail_content		              =  $templateRowArr['mail_content'];
        $mail_content		              =  str_replace("#link#",$baseUrl,$mail_content);
	
	$objMail->mail_title	              =  "Auto_Email_Reminder"; 
	$MailTemplate		              =  $objMail->selectMailTemplate();
	$templateRowArr		              =  mysql_fetch_array($MailTemplate);
	$mail_content1		              =  $templateRowArr['mail_content'];
	
	
   // $recivers_name                      =  $arr_fetch_users_details['name'] ;
   
	
	$mail_content		              =  str_replace("#message_content#",$mail_content1,$mail_content);
	$mail_content		              =  str_replace("#number_days#",'In this Week',$mail_content);
	$mail_content		              =  str_replace("#name#", $name_to,$mail_content);
	$subject		                  =  $templateRowArr['mail_subject'];  
	
    $message ="<table align='center' cellspacing='0' width='700' border='1' cellpadding='2' 
	style='border:1px solid #330000;' >
    <tr style='color:#000000;font-size:14px;font-weight:bold;font-family:arial;'>
    <td align='left'>Event Name</td>
    <td  align='left'>Name</td>
	<td  align='left'>Date of Event</td>
    </tr>";
	for($k=0;$k<count($event_title_exp);$k++)
		{

   $message .="<tr style='color:#000000;font-size:12px;font-family:arial;font-weight:300px;'>
    <td align='left'>".$event_title_exp[$k]."</td>
    <td  align='left'>".$event_name_grp_exp[$k]."</td>
    <td  align='left'>".$event_day_grp_exp[$k]."-".date('M',mktime(0,0,0,$event_month_grp_exp[$k]+1,0,0))."</td>
    </tr>";
	}
   $message .="</table>";
   $mail_content			              =  str_replace("#message_table#",$message,$mail_content);
	
    $mail_content			              =  str_replace("#link#",$baseUrl,$mail_content);
	$mailFrom                             =  "Nethaat";
    $out_put =  $emailObj->SendHtmlMail($to, $subject, $mail_content, 'Nethaat');
    	
	$chek_r .=	$to.',ema-optut=='.$out_put.',';
		}
echo 'emobj=='.$emailObj->SendHtmlMail('rishi_kapoor@seologistics.com','7-days-reminder',$chek_r,$mailFrom);

      
echo 'email sent to =.'.$to;

?>