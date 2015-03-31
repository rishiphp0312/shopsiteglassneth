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
			
			$objItem                  = new Class_Item();	
			$objShip                    = new Class_Shipping();
		
			$message          		  = ob_get_contents();
			$text                     = serialize($_POST);		
			$payment_status           = $_POST['payment_status'];
			$payment_currency         = $_POST['mc_currency'];
			$txn_id                   = $_POST['txn_id'];
			$receiver_email           = $_POST['receiver_email'];
			$payer_email              = $_POST['payer_email'];
			$amount                   = $_POST['mc_gross'];
			$custom           		  = $_POST['custom'];
			
			$explode_custom   		  = explode("#|_|#",$custom);
			   
			$last_trans_id            = $explode_custom[0];
			$buyer_id                 = $explode_custom[1];
							
			$payment_status           = $_POST['payment_status'];
			$payment_currency         = $_POST['mc_currency'];
			$txn_id                   = $_POST['txn_id'];
			$receiver_email           = $_POST['receiver_email'];
			$payer_email              = $_POST['payer_email'];
			$amount                   = $_POST['mc_gross'];
             
			
		//	$objItem->paymentstatus	     = 1;
			
			 //	calculategiftcardvalue
			/*
			$objItem->paymentmode     = 'directpaypal';
			$objItem->shipping_status = 0;
			$objItem->values_returned = serialize($_POST);
			$objItem->trans_id        = $txn_id;			
			$objItem->id              = $last_trans_id;
				*/		
      
			
		if (!$fp) {
// HTTP ERROR
} else {
fputs ($fp, $header.$req);

	if($last_trans_id!='')
		{


//////========
 // start of code for giftcard info
			
	$objUser = new Class_User();
	
	$objUser->reqid			= $last_trans_id;	
	$objUser->paymentstatus	= 1;
	$objUser->TRANSACTIONID	= $txn_id;			
	$objUser->paid_amount	= $amount;

	//echo $o[]				= rteSafe($resArray);
	$objUser->text           =  rteSafe($text);

	mail('rishi_kapoor@seologistics.com','hi','reqid'.$last_trans_id.'amount='.$amount);
	$objDBReturn = $objUser->insertUpdatecustomrequest();
	
	if($objDBReturn->nIdentity==0 && $objDBReturn->nErrorCode==0)
	{
		success_msg("Your Transaction has been successfull");
		header("Location:buyer_custom_request.php");
	}
	else
	{
		failure_msg("Error occured ...!Please try again");
	}
   
}
			// end of code for update giftcard info

/////////====end 2









}
        
			
		
			


			
		
		
        


?>