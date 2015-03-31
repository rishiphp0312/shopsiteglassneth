<?php
/*************************************************
APIError.php

Displays error parameters.

Called by DoDirectPaymentReceipt.php, TransactionDetails.php,
GetExpressCheckoutDetails.php and DoExpressCheckoutPayment.php.

*************************************************/
include ('include/common.inc');
session_start();
$resArray=$_SESSION['reshash'];
/*
echo '<pre>'; 
print_r($_SESSION['reshash']);
echo '</pre>';
*/
?>


<?php  //it will print if any URL errors 
	if(isset($_SESSION['curl_error_no'])) 
	{ 
			$errorCode= $_SESSION['curl_error_no'] ;
			$errorMessage=$_SESSION['curl_error_msg'] ;	
			session_unset($errorCode);	
			session_unset($errorMessage);	
			$smarty->assign("errorCode",$errorCode);
			$smarty->assign("errorMessage",$errorMessage);   
			session_unset();

	} 
	else
	{
	$count=0;
	while (isset($resArray["L_SHORTMESSAGE".$count]))
	{		
		  $errorCode    = $resArray["L_ERRORCODE".$count];
		  $shortMessage = $resArray["L_SHORTMESSAGE".$count];
		  $longMessage  = $resArray["L_LONGMESSAGE".$count]; 
		  $smarty->assign("errorCode",$errorCode);

		  $count=$count+1; 
	}//end while

	$smarty->assign("ACK",$resArray['ACK']);
	$smarty->assign("CORRELATIONID",$resArray['CORRELATIONID']);
	$smarty->assign("VERSION",$resArray['VERSION']);
	$smarty->assign("errorCode",$errorCode);
	$smarty->assign('shortMessage',$shortMessage);
	$smarty->assign('longMessage',$longMessage);
//end while
}// end else
$smarty->display('APIError.tpl');

?>
