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
			$message          	  = ob_get_contents();
			$custom                   = $_POST['custom'];		
			$payment_status           = $_POST['payment_status'];
			$payment_currency         = $_POST['mc_currency'];
			$txn_id                   = $_POST['txn_id'];
			$receiver_email           = $_POST['receiver_email'];
			$payer_email              = $_POST['payer_email'];
			$amount                   = $_POST['mc_gross'];	

		if (!$fp) {
// HTTP ERROR
} else {
fputs ($fp, $header.$req);

                $objItem->id                       = $custom;
            	$objItem->commisionvalues_returned = $message;
                $objItem->commision_status	   = 1;
                $objItem->commisionpaid_date       = date('Y-m-d');
               
		$objItem->commision_transaction    = $_POST['txn_id'];
		//$objItem->commision_amount         = rteSafe($resArray['AMT']);
		$objDBReturn1                      = $objItem->insertUpdatecommisionitem();

	

}












?>