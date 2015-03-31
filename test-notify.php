<?php
include ('include/common.inc');
include ('class/class.item.inc');
include ('class/class.user.inc');
include ('class/class.category.inc');
include ('class/class.shipping.inc');
include ('class/class.mail.inc');
include ('include/country_state_cat.php');
include ('include/sendEmailClass.php');
include ('include/send-sms.php');
include ('class/class.package.inc');

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

			$objItem                    = new Class_Item();
			$objShip                    = new Class_Shipping();
                        $objPackage 	            = new Class_Package();

			$message          	   = ob_get_contents();

			$payment_status           = $_POST['payment_status'];
			$payment_currency         = $_POST['mc_currency'];
			$txn_id                   = $_POST['txn_id'];
			$receiver_email           = $_POST['receiver_email'];
			$payer_email              = $_POST['payer_email'];
			$amount                   = $_POST['mc_gross'];
			$custom                   = $_POST['custom'];
			$explode_custom           = explode("#|_|#",$custom);
                        $message          	  = ob_get_contents();
                        mail('rishi_kapoor@seologistics.com','wheru gone456',$custom);








		   //     mail('rishi_kapoor@seologistics.com','hi','lastid='.$last_trans_id.'==explode_custom=='.$explode_custom);
			//$last_trans_id 	  = $objDBReturn->nIdentity;

		if (!$fp) {
                    // HTTP ERROR
                    } else {
               fputs ($fp, $header.$req);
    


}












?>