<?php
/******************************************************
DoAuthorizationReceipt.php.

Sends a DoAuthorization NVP API request to PayPal.

The code retrieves the authorization ID, amount, currency
and constructs the NVP API request string to send to the
PayPal server. The request to PayPal uses an API Signature.

After receiving the response from the PayPal server, the
code displays the request and response in the browser. If
the response was a success, it displays the response
parameters. If the response was an error, it displays the
errors received.

Called by DoAuthorization.html.

Calls CallerService.php and APIError.php.

******************************************************/

// clearing the session before starting new API Call
session_unset();

require_once 'CallerService.php';
session_start();

$orderId=urlencode($_REQUEST['order_id']);

$amount=urlencode($_REQUEST['amount']);

$currency=urlencode($_REQUEST['currency']);




/* Construct the request string that will be sent to PayPal.
   The variable $nvpstr contains all the variables and is a
   name value pair string with & as a delimiter */
$nvpStr="&TRANSACTIONID=$orderId&AMT=$amount&CURRENCYCODE=$currency";

/* Make the API call to PayPal, using API signature.
   The API response is stored in an associative array called $resArray */
$resArray=hash_call("DoAuthorization",$nvpStr);

/* Next, collect the API request in the associative array $reqArray
   as well to display back to the browser.
   Normally you wouldnt not need to do this, but its shown for testing */

$reqArray=$_SESSION['nvpReqArray'];

/* Display the API response back to the browser.
   If the response from PayPal was a success, display the response parameters'
   If the response was an error, display the errors received using APIError.php.
   */
$ack = strtoupper($resArray["ACK"]);

if($ack!="SUCCESS"){
	$_SESSION['reshash']=$resArray;
	$location = "APIError.php";
		 header("Location: $location");
   }

?>



<html >
<head>
    <title>PayPal PHP SDK - DoReAuthorization API</title>
    <link href="sdk.css" rel="stylesheet" type="text/css" />
</head>
<body>
	<br>
	<center>
		<font size=2 color=black face=Verdana><b>Do Authorization</b></font>
		<br><br>

		<b>Authorization Response details!</b><br><br>

	        <table class="api">
	        	<tr>
	        		<td class="field">Authorization ID:</td>
	        		<td><?php echo $resArray['AUTHORIZATIONID'] ?></td>
	        	</tr>
	        	<tr>
	        		<td>Transaction ID:</td>
	        		<td><?php echo $resArray['TRANSACTIONID'] ?></td>
	        	</tr>
	        	<tr>
	        		<td>Gross Amount:</td>
	        		<td><?php echo ($resArray['CURRENCYCODE'].$resArray['AMT']) ?></td>
	        	</tr>
	        	<tr>
	        		<td>Payment Status:</td>
	        		<td><?php echo $resArray['PAYMENTSTATUS'] ?></td>
	        	</tr>
	        	<tr>
	        		<td>Pending Reason:</td>
	        		<td><?php echo $resArray['PENDINGREASON'] ?></td>
	        	</tr>
	        	<tr>
	        		<td>ProtectionEligibility:</td>
	        		<td><?php echo $resArray['PROTECTIONELIGIBILITY'] ?></td>
	        	</tr>
		</table>
	</center>
	<a class="home" id="CallsLink" href="index.html">Home</a>
</body>
</html>


