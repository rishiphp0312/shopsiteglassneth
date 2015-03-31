<?php
include ('include/common.inc');
include ('class/class.item.inc');
include ('class/class.user.inc');
include ('class/class.shipping.inc');
include ('class/class.mail.inc');
include ('include/country_state_cat.php');
include ('include/sendEmailClass.php');
include ('include/send-sms.php');

	
   
			$req = 'cmd=_notify-validate';
			
			foreach ($_POST as $key => $value) {
			$value = urlencode(stripslashes($value));
			$req .= "&$key=$value";
			}
			
			// post back to PayPal system to validate
			$header .= "POST /cgi-bin/webscr HTTP/1.0\r\n";
			$header .= "Content-Type: application/x-www-form-urlencoded\r\n";
			$header .= "Content-Length: " . strlen($req) . "\r\n\r\n";
			$fp = fsockopen ('ssl://www.paypal.com', 443, $errno, $errstr, 30);
			
			
			
			$message          	  = ob_get_contents();
                       
                        
                   
                    //$item_id_value = $_REQUEST['item_id_value'];
//print_r($_SESSION);
//create item class object

 	//echo $insert_test="insert into temp(message)values(\"$message\") ";
	//echo mysql_query($insert_test);

                        $objItem                  = new Class_Item();
                	$objUser 	          = new Class_User();
			$objMail 	          = new Class_Mail();
			$emailObj 	          = new SendEmailClass;
					
			$payment_status           = $_POST['payment_status'];
			$payment_currency         = $_POST['mc_currency'];
			$txn_id                   = $_POST['txn_id'];
			$receiver_email           = $_POST['receiver_email'];
			$payer_email              = $_POST['payer_email'];
			$amount                   = $_POST['mc_gross'];
			$custom           	  = $_POST['custom'];			
			$explode_custom   	  = explode("##-|-##",$custom);

                    
                        //  mail('rishi_kapoor@seologistics.com','custom',$custom);
			
		
			$last_id_forcustom        = $explode_custom[0];//giftcardnumber
			$seller_id                = $explode_custom[1];//seller_id
			$buyer_id                 = $explode_custom[2];//buyer_id
			$giftcardrecivername      = $explode_custom[3];//giftcardrecivername
			$giftcardreciveremail     = $explode_custom[4];//giftcardreciveremail
		        $sellers_username         = $explode_custom[5];//sellers_username
			$sellers_email            = $explode_custom[6];//sellers_email

	if (!$fp) {
         // HTTP ERROR
         } else {
                        fputs ($fp, $header.$req);
                        $objItem->check_condition = 1;
                        $objItem->seller_id	  = $seller_id;
                        $objItem->paid_amount     = $amount;
                        $objItem->paymentstatus	  = 1;
                        $objItem->TRANSACTIONID   = $txn_id;
                  //      mail('rishi_kapoor@seologistics.com',"$txn_id=== $objItem->check_condition ",$message);
                        if($seller_id!='')
                        {
                          //  $objItem->giftcardnumber  = $last_id_forcustom;
                            $objItem->cardnumber      = $last_id_forcustom;
                            $objDBReturn= $objItem->insertUpdategiftcard();
                        }

		
                        $objUser 	= new Class_User();
                        $objMail 	= new Class_Mail();
                        $emailObj 	= new SendEmailClass;

                        $objUser->id = $buyer_id ;
                        $UserRes = $objUser->getUserDetails();
                        $UserArr = mysql_fetch_array($UserRes);
                        $UserArr['email'];
                        $UserArr['username'];

                        $objMail->mail_title	= "Email Template";
                        $MailTemplate		= $objMail->selectMailTemplate();
                        $templateRowArr 	= mysql_fetch_array($MailTemplate);
                        $mail_content		= $templateRowArr['mail_content'];
                        $mail_content		= str_replace("#link#",$baseUrl,$mail_content);
                        //$message_content =



                        $objMail->mail_title	= "Gift Card";
                        $MailRes 		= $objMail->selectMailTemplate();
                        $mailRowArr 		= mysql_fetch_array($MailRes);
                        $subject 		= $mailRowArr['mail_subject'];
                        $subject		= str_replace("#name#",$UserArr['username'],$subject);
                        $message_content	= $mailRowArr['mail_content'];

                        //replace message content with mail template message content variable

                        $mail_content		= str_replace("#message_content#",$message_content,$mail_content);
                        //$message_content_send_reply_toadmin =str_replace("#message_content#",$message_content_send_reply_toadmin,$mail_content);
                        $store_url=$baseUrl.'featured_store_information.php?id='.$seller_id;
                        $mail_content= str_replace("#store_url#",$store_url,$mail_content);
                        $mail_content= str_replace("#link#",$baseUrl,$mail_content);

                        $mail_content= str_replace("#name#",$giftcardrecivername,$mail_content);
                        $mail_content= str_replace("#email#",$giftcardreciveremail,$mail_content);
                        $mail_content= str_replace("#amount#",$_POST['mc_gross'],$mail_content);
                        $mail_content= str_replace("#senderemail#",$UserArr['email'],$mail_content);
                        $mail_content= str_replace("#sendername#",$UserArr['username'],$mail_content);
                        $mail_content= str_replace("#cardnum#",$last_id_forcustom,$mail_content);
                        //$mail_content= str_replace("#message#",$message,$mail_content);
                        $mail_content= str_replace("#nethatlink#","Net Haat",$mail_content);
                        if($last_id_forcustom!='')
                        {
                        $emailStatus=$emailObj->SendHtmlMail($giftcardreciveremail,$subject,$mail_content,$UserArr['email']);
                        }
                        // start of  sellers email

                        //******************************** Get email template ******************

                        $objMail->mail_title	        = "Email Template";
                        $MailTemplate			= $objMail->selectMailTemplate();
                        $templateRowArr 		= mysql_fetch_array($MailTemplate);
                        $mail_content			= $templateRowArr['mail_content'];
                        $mail_content			= str_replace("#link#",$baseUrl,$mail_content);

                        //get gift card email content
                        $objMail->mail_title	        = "Gift_Card_seller";
                        $MailRes 			= $objMail->selectMailTemplate();
                        $mailRowArr 			= mysql_fetch_array($MailRes);
                        $subject 			= $mailRowArr['mail_subject'];
                        $message_content		= $mailRowArr['mail_content'];
                        //replace message content with mail template message content variable
                        $mail_content			= str_replace("#message_content#",$message_content,$mail_content);
                        $mail_content			= str_replace("#link#",$baseUrl,$mail_content);
                        $mail_content                   = str_replace("#name#",$giftcardrecivername,$mail_content);
                        $mail_content                   = str_replace("#email#",$giftcardreciveremail,$mail_content);
                        $mail_content                   = str_replace("#amount#",$_POST['mc_gross'],$mail_content);
                        $mail_content                   = str_replace("#senderemail#",$UserArr['email'],$mail_content);
                        $mail_content                   = str_replace("#sendername#",$UserArr['username'],$mail_content);
                        $mail_content                   = str_replace("#cardnum#",$last_id_forcustom,$mail_content);
                        $mail_content                   = str_replace("#sellername#",$sellers_username,$mail_content);

                        $mail_content                   = str_replace("#image_gift#",'',$mail_content);
                        $mail_content                   = str_replace("#message#",$message,$mail_content);

                        $mail_content                   = str_replace("#nethatlink#","Net Haat",$mail_content);

                        //***************************  Sending mail content *********************


                                //echo $mail_content;exit;
                        $emailStatus = $emailObj->SendHtmlMail($sellers_email,$subject,$mail_content,$UserArr['email']);
                        //*********************************** Assigning transaction details *******


                        // end of sellers email





	
	
	
			
		
  
//	ob_end_clean();	
	

fclose ($fp);
}

?>