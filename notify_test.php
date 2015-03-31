<?php
include ('include/common.inc');
include ('class/class.item.inc');


        	$objItem                  = new Class_Item();	
		
			
             $objItem->message         = 'rishi message again5656'; 
			$objItem->insertUpdatetranstemp();
			
			
			
$req = 'cmd=_notify-validate';
foreach ($_POST as $key => $value) {
	$value = urlencode(stripslashes($value));
	$req .= "&$key=$value";
}
 	

// post back to PayPal system to validate
$header .= "POST /cgi-bin/webscr HTTP/1.0\r\n";
#$header .= "Proxy-Authenticate : http://proxy.shr.secureserver.net:3128\r\n";
$header .= "Content-Type: application/x-www-form-urlencoded\r\n";
$header .= "Content-Length: " . strlen($req) . "\r\n\r\n";

#BELOW LINE SHOULD BE COMMENTED FOR TESTING

//$fp = fsockopen ('www.paypal.com', 80, $errno, $errstr, 30);

#FOR TESTING BELOW LINE SHOULD BE UNCOMMENTED

$fp = fsockopen ('www.sandbox.paypal.com', 80, $errno, $errstr, 30);

   
   
		$tstValue=print_r($_POST,true);
		$tt="this is data to test";
		$fp=fopen("test.txt","w");
		fwrite($fp,$tt);
		fclose($fp);

   
   
	
	 ob_start();
	 echo "<pre>";
     print_r($_POST);
	  echo "<pre>";
	$message=ob_get_contents();
	ob_end_clean();	
 	
			?>
