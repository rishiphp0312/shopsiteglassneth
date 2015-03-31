<?php
// email notification for sending reminder before 15 days
include ('include/common.inc');
include ('class/class.cms.inc');
include ('class/class.user.inc');
include ('class/class.mail.inc');
include ('include/sendEmailClass.php');
include ('captcha/php-captcha.php');

      //create user class object
      $objUser          = new Class_User();
      // Creating object of SendEmailClass
      $emailObj 	    = new SendEmailClass;
      $objItem          = new Class_Item();

      $result_user_details      = $objUser->selectUser();
      $num_user_details         = mysql_num_rows($result_user_details);
      if($num_user_details>0)
      {
          while($arr_user_details  = mysql_fetch_assoc($result_user_details))
          {
              $email_ids[]           = $arr_user_details['email'];
              $seller_ids[]          = $arr_user_details['user_id_value'];
              $name_seller[]         = $arr_user_details['first_name'].''.$arr_user_details['last_name'];
          }
      }
      for($i=0;$i<count($num_user_details);$i++)
      {
        $objItem->seller_id                   =  $seller_ids[$i];
        $nextfifteendays                      =  time()- (15 * 24 * 60 * 60);
        $last_15day                           =  date('Y-m-d',$nextfifteendays); // previous date
        $objItem->date_value                  =  $last_15day;

        $get_Invoicedetails  = $objItem->getinvoice_commisiondetails();

        $num_invoicedetails  = mysql_num_rows($get_Invoicedetails);
        //last 15 days

        $to                                   =  $email_ids[$i];

        $objMail 	                  =  new Class_Mail();
	    $objMail->mail_title	      =  "Email Template";
        $MailTemplate			      =  $objMail->selectMailTemplate();
        $templateRowArr 		      =  mysql_fetch_array($MailTemplate);
        $mail_content			      =  $templateRowArr['mail_content'];
        $mail_content			      =  str_replace("#link#",$baseUrl,$mail_content);

		$objMail->mail_title	              =  "invoice_commision";
		$MailTemplate			      =  $objMail->selectMailTemplate();
		$templateRowArr 		      =  mysql_fetch_array($MailTemplate);
        $mail_content1			      =  $templateRowArr['mail_content'];


        //$recivers_name                      =  $arr_fetch_users_details['name'] ;

	$mail_content			       =  str_replace("#message_content#",$mail_content1,$mail_content);
	$mail_content			       =  str_replace("#link#",$baseUrl,$mail_content);
        //last_15day
        // or using strtotime():



        $mail_content			       =  str_replace("#last_15day#",$last_15day,$mail_content);
	$mail_content			       =  str_replace("#current_day#",date('Y-m-d'),$mail_content);
	$mail_content			       =  str_replace("#name#", $name_to,$mail_content);
	$subject 			       =  $templateRowArr['mail_subject'];

        $message ="<table align='center' cellspacing='0' width='700' border='1' cellpadding='2'
	style='border:1px solid #330000;' >

    <tr style='color:#000000;font-size:14px;font-weight:bold;font-family:arial;'>
    <td align='left'>Seller's  Name</td>
    <td  align='left'>Item Name</td>
    <td  align='left'>Sold Date</td>
    <td  align='left'>Commision </td>
    <td  align='left'>Date of Commision Paid</td>
    <td  align='left'>Status</td>
    </tr>";
    for($k=0;$k<count($event_title_exp);$k++)
	{

    $message .="<tr style='color:#000000;font-size:12px;font-family:arial;font-weight:300px;'>
    <td align='left'>".$event_title_exp[$k]."</td>
    <td align='left'>".$event_title_exp[$k]."</td>
    <td align='left'>".$event_title_exp[$k]."</td>
    <td align='left'>".$event_title_exp[$k]."</td>
    <td  align='left'>".$event_name_grp_exp[$k]."</td>
    <td  align='left'>".$event_day_grp_exp[$k]."-".date('M',mktime(0,0,0,$event_month_grp_exp[$k],0,0))."</td>
    </tr>";
	}
    $message .="</table>";
    $mail_content     	          =  str_replace("#message_table#",$message,$mail_content);
    $mail_content	              =  str_replace("#link#",$baseUrl,$mail_content);
	//$mailFrom                   =  "$name_from_sender "." < ".$email_from_sender." >";
    $mailFrom                         =  "Nethaat";
    $emailObj->SendHtmlMail($to, $subject,$mail_content,$mailFrom);
    	}
echo 'email sent to =.'.$to;


?>