	<?php 
	function  send_to_seller($reciver_name,$product_name,$mob_num,$buyer_name)
	{
//Please Enter Your Details
 $user="nethaat"; //your username====nethaat
 $password="nethaat123"; //your password===nethaat123 
 //$mobilenumbers=$mob_num; //enter Mobile numbers comma seperated
 $mobilenumbers='919899707258';
 $message = "Hi $reciver_name,Item name $product_name has been bought by buyer $buyer_name";//enter Your Message
 //$message = "Hi $reciver_name,Item name $product_name has $buyer_name";//enter Your Message
 
 $senderid="SMSCountry"; //Your senderid
 $messagetype="N"; //Type Of Your Message
 $DReports="Y"; //Delivery Reports
 $url="http://www.smscountry.com/SMSCwebservice.asp";
 $message = urlencode($message);
 $ch = curl_init(); 
 if (!$ch){die("Couldn't initialize a cURL handle");}
 $ret = curl_setopt($ch, CURLOPT_URL,$url);
 curl_setopt ($ch, CURLOPT_POST, 1);
 curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);          
 curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
 curl_setopt ($ch, CURLOPT_POSTFIELDS, 
"User=$user&passwd=$password&mobilenumber=$mobilenumbers&message=$message&sid=$senderid&mtype=$messagetype&DR=$DReports");
 $ret = curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);


//If you are behind proxy then please uncomment below line and provide your proxy ip with port.
// $ret = curl_setopt($ch, CURLOPT_PROXY, "PROXY IP ADDRESS:PORT");



 $curlresponse = curl_exec($ch); // execute
if(curl_errno($ch))
	echo 'curl error : '. curl_error($ch);

 if (empty($ret)) {
    // some kind of an error happened
    die(curl_error($ch));
    curl_close($ch); // close cURL handler
 } else {
    $info = curl_getinfo($ch);
    curl_close($ch); // close cURL handler
    //echo "<br>";
	//echo $curlresponse;
	//if($curlresponse)
	//mail("rishi_kapoor@seologistics.com","hi","curl error : ". curl_error($ch)."goog==".$curlresponse);
   
   //echo "Message Sent Succesfully" ;
 }
	}
 ?>