<?php
//include ('include/common.inc');
//include ('include/constants.php.inc'); // constant 
include ('class/dbconnector.inc'); //DB connection file
include ('include/functions.php'); //common functions
include ('class/class.cms.inc');
include ('class/class.user.inc');
include ('class/class.mail.inc');
include ('class/class.item.inc');
include ('include/sendEmailClass.php');
include ('captcha/php-captcha.php');
$baseUrl = "http://www.nethaat.com/";
// Email Notification for sending reminder at every 15 days about commision on
//  items.
// done-linux
      //create user class object
      $objUser   = new Class_User();
      // Creating object of SendEmailClass
      $emailObj  = new SendEmailClass;
      $objItem   = new Class_Item();
      $result_user_details      = $objUser->selectUser();
      $num_user_details         = mysql_num_rows($result_user_details);
      if($num_user_details>0)
      {
         while($arr_user_details  = mysql_fetch_assoc($result_user_details))
         {
              $email_ids[]           = $arr_user_details['email'];
              $seller_ids[]          = $arr_user_details['user_id_value'];
              $name_seller[]         = $arr_user_details['first_name'].' '.$arr_user_details['last_name'];
         }

        for($i=0;$i<$num_user_details;$i++)
        {
        //echo 'counter'.$i;
        $objItem->seller_id  =  $seller_ids[$i];
        $objItem->status     =  0;         // 0 for not paid 1 for paid
        // echo   '<br>';
        //$nextfifteendays                      =  time()- (15 * 24 * 60 * 60);
        //$last_15day                           =  date('Y-m-d',$nextfifteendays); // previous date
        //$objItem->date_value                  =  $last_15day;
        
        $get_Invoicedetails  = $objItem->getinvoice_commisiondetails();
        $num_invoicedetails  = mysql_num_rows($get_Invoicedetails);
        //   echo   '<br>';
        //echo   'total-'.$num_invoicedetails;
        //echo   'total-'.$num_invoicedetails          = mysql_num_rows($get_Invoicedetails);
        //last 15 days
        $to                  =  $email_ids[$i];
        //last 15 days
        $objMail 	         =  new Class_Mail();
	    $objMail->mail_title =  "Email Template";
        $MailTemplate		 =  $objMail->selectMailTemplate();
        $templateRowArr 	 =  mysql_fetch_array($MailTemplate);
        $mail_content	     =  $templateRowArr['mail_content'];
        
       // echo '<br>';
	

       $message ="<table align='center' cellspacing='0' width='700' border='1' cellpadding='2'
       style='border:1px solid #330000;' >
       <tr style='color:#000000;font-size:14px;font-weight:bold;font-family:arial;'>
       <td  colspan='5' align='left'>".$name_seller[$i]."</td>
       </tr>
       <tr style='color:#000000;font-size:14px;font-weight:bold;font-family:arial;'>
       <td  align='left'>Item Name</td>
       <td  align='left'>Sold Date</td>
       <td  align='left'>Commision</td>
       <td  align='left'>Status</td>
       </tr>";
       
      // echo  'num=='.$num_invoicedetails;
       if($num_invoicedetails>0)
        {
        while($arr_user_Invoicedetails  = mysql_fetch_assoc($get_Invoicedetails))
          {
             $Item_name           = ucfirst($arr_user_Invoicedetails['title']);
             $Sold_Date           = $arr_user_Invoicedetails['purchase_date'];
             $Commision           = $arr_user_Invoicedetails['commision_amount'];
             $Commision           = ($Commision==0 || $Commision=='')?'Free':$Commision.' USD';
             $commision_status    = $arr_user_Invoicedetails['commision_status'];
             $commision_Date      = $arr_user_Invoicedetails['commisionpaid_date'];
             $showcommision_Date  = ($commision_status==0)?'Not paid':$commision_Date;
             $show_status         = ($commision_status==0)?'Not paid':'Paid';

            $message .="<tr style='color:#000000;font-size:12px;font-family:arial;font-weight:300px;'>
            <td align='left'>".$Item_name."</td>
            <td align='left'>".$Sold_Date."</td>
            <td align='left'>".$Commision." </td>
            <td  align='left'>".$show_status."</td>
            </tr>";

          
          
            //if($num_invoicedetails>0)
                 }
              $message .="</table>";
         //         echo 'msg-'. $message.'i=='.$i;
           //       echo '<br>';
            $objMail->mail_title	 =  "invoice_commision_seller";
            $MailTemplate		     =  $objMail->selectMailTemplate();
            $templateRowArr 	     =  mysql_fetch_array($MailTemplate);
            $mail_content1	         =  $templateRowArr['mail_content'];
            //$recivers_name         =  $arr_fetch_users_details['name'] ;
            $mail_content		     =  str_replace("#message_content#",$mail_content1,$mail_content);
            $mail_content		     =  str_replace("#link#",$baseUrl,$mail_content);
            $mail_content		     =  str_replace("#name_seller#",$name_seller[$i],$mail_content);
            $mail_content     	     =  str_replace("#str_sold_items_list#",$message,$mail_content);

      /*
          
            $mail_content                    =  str_replace("#link#",$baseUrl,$mail_content);
                //$mailFrom                  =  "$name_from_sender "." < ".$email_from_sender." >";
        
       */
            $subject 		          =  $templateRowArr['mail_subject'];
            $mail_content;
            $message='';
       
            $mailFrom                 =  "Nethaat";
            echo '<br>';
	        //echo 'emobj=='.$emailObj->SendHtmlMail('rishi_kapoor@seologistics.com',$subject,$mail_content,$mailFrom);
        
			  $out_put =$emailObj->SendHtmlMail($to, $subject,$mail_content,$mailFrom);
			$chek_r .=  $to.',ema-optut=='.$out_put.',';
        }      
      
      }
  }
   echo $mail_content;
    echo 'emobj=='.$emailObj->SendHtmlMail('rishi_kapoor@seologistics.com','Invoice-reminder-15daysbefore',$chek_r,$mailFrom);
   echo '<br>';
          //echo 'email sent to =.'.$to;

//  echo '<br>';
  //     echo 'email sent to =.'.$to;


 //$mail_content		     =  str_replace("#link#",$baseUrl,$mail_content);
        //last_15day
        // or using strtotime():
        //  $mail_content		     =  str_replace("#last_15day#",$last_15day,$mail_content);
        //$mail_content		     =  str_replace("#current_day#",date('Y-m-d'),$mail_content);

?>