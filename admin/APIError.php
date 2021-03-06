<?php
/*************************************************
APIError.php

Displays error parameters.

Called by DoDirectPaymentReceipt.php, TransactionDetails.php,
GetExpressCheckoutDetails.php and DoExpressCheckoutPayment.php.

*************************************************/

include ("common_includes.php");
include ("../include/adminsession.php.inc");
include ("../class/class.item.inc");
include ("../class/class.user.inc");
include ("../class/class.shipping.inc");
include ('../include/country_state_cat.php');
session_start();
$resArray=$_SESSION['reshash']; 
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
