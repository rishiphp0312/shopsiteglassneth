<?php
include ('include/common.inc');
include ('class/class.item.inc');
include ('class/class.user.inc');
include ('class/class.shipping.inc');
include ('class/class.mail.inc');
include ('include/country_state_cat.php');
include ('include/sendEmailClass.php');
include ('include/send-sms.php');
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
			
			$objItem                  = new Class_Item();	
			$objUser 	              = new Class_User();
			$objMail 	              = new Class_Mail();
			$emailObj 	              = new SendEmailClass;
			
			$message          		      = ob_get_contents();
					
			$payment_status           = $_POST['payment_status'];
			$payment_currency         = $_POST['mc_currency'];
			$txn_id                   = $_POST['txn_id'];
			$receiver_email           = $_POST['receiver_email'];
			$payer_email              = $_POST['payer_email'];
			$amount                   = $_POST['mc_gross'];
			$custom           		  = $_POST['custom'];
			
			$explode_custom   		  = explode("##-|-##",$custom);
			
		    $objItem->paid_amount	  = $_POST['mc_gross'];
			
			$last_id_forcustom        = $explode_custom[0]; // giftcardnumber
			$rem_id_value             = $explode_custom[1]; // reminder id  value
			$last_giftcardid_forcustom= $explode_custom[2]; // last giftcard id  value
			
			$objItem->paymentstatus	  = 1;
			$objItem->check_condition = 1;
			$objItem->TRANSACTIONID   = $_POST['txn_id'];
		
			if($last_id_forcustom!='')
			{
			
			
			$objItem->giftcardnumber	  = $last_id_forcustom;
			$objDBReturn     = $objItem->insertUpdategiftcard(); // giftcard updated
		//	mail('rishi_kapoor@seologistics.com','hi',$last_id_forcustom.'=last_id_forcustom='.$objItem->paymentstatus.'--obj--'.$objDBReturn);
			$objUser->rem_id              =  $rem_id_value;
		//	$objUser->message             =  addslashes($_POST['message']);   
			$objUser->giftcard_id         =  $last_giftcardid_forcustom;	
			$objUser->STATUS              =  0;   
			$Reminder_details_value       =  $objUser->insertUpdate_giftcard_message();
			}
	
			

			
						
	

		
			


			
		
		
        

	if (!$fp) {
// HTTP ERROR
} else {
fputs ($fp, $header.$req);
	
			
			
	
	
	
	
	
	
			
		
  
//	ob_end_clean();	
	

fclose ($fp);
}

?>