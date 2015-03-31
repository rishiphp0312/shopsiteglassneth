<?php
include ('include/common.inc');
include ('class/class.item.inc');
include ('class/class.user.inc');
include ('class/class.mail.inc');
include ('include/country_state_cat.php');
include ('include/sendEmailClass.php');

//$item_id_value = $_REQUEST['item_id_value'];
//print_r($_SESSION);
//create item class object

 	//echo $insert_test="insert into temp(message)values(\"$message\") ";
	//echo mysql_query($insert_test);

		
   
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
			$payment_status           = $_POST['payment_status'];
			$payment_currency         = $_POST['mc_currency'];
			$txn_id                   = $_POST['txn_id'];
			$receiver_email           = $_POST['receiver_email'];
			$payer_email              = $_POST['payer_email'];
			$amount                   = $_POST['mc_gross'];
			$message          		  = ob_get_contents();
			$custom           		  = $_POST['custom'];
			$explode_custom   		  = explode("##-|-##",$custom);
			

			$buyer_id                 = $explode_custom[0];//buyer_id
			
			$objItem                  = new Class_Item();	
			$objUser 	              = new Class_User();
			$objMail 	              = new Class_Mail();
			$emailObj 	              = new SendEmailClass;
		   // $objItem->message         = $message;
                        $objItem->message         = 'rishi message';
			$objItem->insertUpdatetranstemp();
			/*
			$name    		          = $explode_custom[1];//name
			$email                    = $explode_custom[2];//email
			$city                     = $explode_custom[3];//city
			
			$state                    = $explode_custom[5];//state
			$country_value            = $explode_custom[4];//country_value
			$seller_id                = $explode_custom[6];//seller_id
			*/
			
			
			////////code starts transaction
		
		
			$objItem->buyer_id	  = $buyer_id;
			$objItem->amount          = $amount;
			$objItem->paymentstatus	  = 0;
			$objItem->TRANSACTIONID   = $txn_id;
			
			
			$rstr = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
			$nstr = "";
			mt_srand ((double) microtime()*1000000);
			while(strlen($nstr) < 15)
			{
				  $random = mt_rand(0,(strlen($rstr)-1));
				  $nstr .= $rstr{$random};
			 }


		        $objItem->cardnumber	= $total_max_id_ofgiftcard.'_'.$nstr.'_'.$_SESSION['session_user_id'];
			$objItem->check_condition=0;
			$objDBReturn= $objItem->insertUpdategiftcard();

			/*
			$objItem->seller_id       = $seller_id;
			$objItem->name			  = rteSafe($name);
			$objItem->email			  = rteSafe($email);
			$objItem->city			  = rteSafe($city);
			$objItem->country		  = rteSafe($country_value);
		
			$objItem->values_returned = serialize($_POST);

			$objItem->reciverstate	  = rteSafe($state);
	        */
			
					
		
			//$objItem->paymentmode     = 'directpaypal';
			

            /*

			//******************************** Get email template ******************
		
			$objMail->mail_title	= "Email Template"; 
			$MailTemplate			= $objMail->selectMailTemplate();
			$templateRowArr 		= mysql_fetch_array($MailTemplate);
			$mail_content			= $templateRowArr['mail_content'];
			$mail_content			= str_replace("#link#",$baseUrl,$mail_content);
						
			//get gift card email content
			
			$objMail->mail_title	= "Gift Card"; 
			$MailRes 				= $objMail->selectMailTemplate();
			$mailRowArr 			= mysql_fetch_array($MailRes);
			$subject 				= $mailRowArr['mail_subject'];
			$subject				= str_replace("#name#",$UserArr['username'],$subject);
			$message_content		= $mailRowArr['mail_content'];
			
			//replace message content with mail template message content variable
			
			$mail_content			= str_replace("#message_content#",$message_content,$mail_content);
			$store_url              = 'http://www.flexsin.org/lab/net_haat/featured_store_information.php?id='.$seller_id;
			$mail_content			= str_replace("#store_url#",$store_url,$mail_content);
			$mail_content			= str_replace("#link#",$baseUrl,$mail_content);
			*/
			
	
	/*
	        $objUser->id = $buyer_id;
			$UserRes = $objUser->getUserDetails();
			$UserArr = mysql_fetch_array($UserRes);
			$UserArr['email'];
			$UserArr['username'];
			if($objDBReturn->nIdentity && $objDBReturn->nErrorCode==0)
			{
		//***************************  Replacing mail content *********************

			$mail_content= str_replace("#name#",$objItem->name,$mail_content);
			$mail_content= str_replace("#email#",$objItem->email,$mail_content);
			$mail_content= str_replace("#amount#",$objItem->paid_amount,$mail_content);
			$mail_content= str_replace("#senderemail#",$UserArr['email'],$mail_content);
			$mail_content= str_replace("#sendername#",$UserArr['username'],$mail_content);
			$mail_content= str_replace("#cardnum#",$objItem->cardnumber,$mail_content);
			$mail_content= str_replace("#message#",$message,$mail_content);
			$mail_content= str_replace("#nethatlink#","Net Haat",$mail_content);
			//$con_mail_content= str_replace("#name#",$objItem->name,$con_mail_content);

		//***************************  Sending mail content *********************
			//echo $mail_content;exit;
			$emailStatus 	= $emailObj->SendHtmlMail($objItem->email, $subject, $mail_content,$UserArr['email']);
			
			//$objDBReturn1 = $objItem->insertUpdategiftcard();
		    }
			
			*/
			// end of code for update giftcard info
	
	    	//=== code ends 
		
		//$obj_item->message= $message;
    //$obj_item->insertUpdatetranstemp();
//	ob_end_clean();	
	

	if (!$fp) {
// HTTP ERROR
} else {
			fputs ($fp, $header.$req);
			$res = fgets ($fp, 1024);
				

  


while (!feof($fp)) {/*
$res = fgets ($fp, 1024);
if (strcmp ($res, "VERIFIED") == 0) {

			




//echo 'session=='.$_SESSION['msg']= 'check the payment_status is Completed';
//header("location:http://www.flexsin.org/lab/net_haat/pay-thanks2.php");
// check the payment_status is Completed
// check that txn_id has not been previously processed
// check that receiver_email is your Primary PayPal email
// check that payment_amount/payment_currency are correct
// process payment
}
else if (strcmp ($res, "INVALID") == 0) {
// log for manual investigation
}
*/}
fclose ($fp);
}

?>