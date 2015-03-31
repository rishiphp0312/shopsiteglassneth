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

		//$objItem->message         = 'rishi message'; 

        //$objItem->insertUpdatetranstemp();
   
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
			
			$message          		      = ob_get_contents();
			$custom           		      = $_POST['custom'];
			$explode_custom   		      = explode("#|_|#",$custom);
			$det_seller_id    		      = $explode_custom[0];
			$d_item_id                    = $explode_custom[1];
			$buyer_id                     = $explode_custom[2];
			
			$firstcardcode                = $explode_custom[3];
			$reciveramount_1_card         = $explode_custom[4];
			$reciveramount_2_card         = $explode_custom[5];
			
			$show_d_cost_item             = $explode_custom[6];
			$item_is_haated               = $explode_custom[7];
			$haated_id                    = $explode_custom[8];
			
			$secondcard_code          	  = $explode_custom[9];
			$secondcalculategiftcardvalue = $explode_custom[10];			
			
			$service_rate                 = $explode_custom[11];
			$shipping_address1            = $explode_custom[12];			
			$shipping_address2            = $explode_custom[13];
			
			$dest_zip_code                = $explode_custom[14];
			$city                         = $explode_custom[15];
			$ship_quantity                = $explode_custom[16];
		
			$payment_status           = $_POST['payment_status'];
			$payment_currency         = $_POST['mc_currency'];
			$txn_id                   = $_POST['txn_id'];
			$receiver_email           = $_POST['receiver_email'];
			$payer_email              = $_POST['payer_email'];
			$amount                   = $_POST['mc_gross'];
             
			$objItem                  = new Class_Item();	
			$objUser 	              = new Class_User();
			$objMail 	              = new Class_Mail();
			$emailObj 	              = new SendEmailClass;
			$objItem->message         = 'rishi message again'; 

            $objItem->insertUpdatetranstemp();
			
			$objItem->buyer_id		  = $buyer_id;
			$objItem->item_id         = $d_item_id;
			$objItem->seller_id       = $det_seller_id;
			$objItem->amount          = $amount;
			 //	calculategiftcardvalue
			$objItem->gift_card1	  =  $reciveramount_1_card;
			$objItem->gift_card2	  =	 $reciveramount_2_card;
		
		
		
		
		
		
		///////////////////////////
			$objItem->shipping_cost   = $service_rate;
			$objItem->paymentmode     = 'directpaypal';
			$objItem->shipping_status = 0;
			$objItem->values_returned = serialize($_POST);
			$objItem->trans_id        = $txn_id;
			
			
			$objDBReturn              = $objItem->insertUpdatepurchaseditem();
			$last_trans_id 			  = $objDBReturn->nIdentity;
		////////////////////
        

	if (!$fp) {
// HTTP ERROR
} else {
fputs ($fp, $header.$req);
//$res = fgets ($fp, 1024);
			
			////////code starts transaction
		
		
			// start update quantity after sale of product
/*	 	    
			$objShip                    = new Class_Shipping();
        	$objShip->shipping_cost     = $service_rate;
			$objShip->total_cost        = $amount;
			$objShip->buyer_id          = $buyer_id;
		    $objShip->item_id           = $d_item_id;
	//	    $objShip->shipping_address1 =    $res;
			$objShip->shipping_address1 = $shipping_address1;
			$objShip->shipping_address2 = $shipping_address2;
			$objShip->dest_zip_code     = $dest_zip_code;
			$objShip->city              = $city;
	//		$objShip->quantity          = $ship_quantity;
            $objShip->last_trans_id     = $last_trans_id;
			$objDBReturn1 = $objShip->insertUpdateshipping();
				
			// start quantity decreses code
			
			$objItem->update_item_id     =  $d_item_id;
			$item_details                =  $objItem->getItemImageDetails();
			$num_rows_details            =  mysql_num_rows($item_details);
			if($num_rows_details>0)
			{
			$arr_item_details            =  mysql_fetch_assoc($item_details);
			//print_r($arr_item_details);
			$quantity_available          = $arr_item_details['quantity_available'];
			//print_r($arr_item_details);
			}
			$quantity_available          = $quantity_available-1;
			$objItem->item_value         = $d_item_id;
			$objItem->quantity_available = $quantity_available ;
			$objItem->insertUpdateItem1('1');        
			
			// end of code
			
			
			 // start of code for giftcard info
			$objItem->paymentstatus	     = 1;
			$objItem->cardnumber         =	$firstcardcode ;
			$objItem->check_condition=1;
			if((int)$show_d_cost_item >(int)$reciveramount_1_card)
				{
			$objItem->paid_amount_first_card			= '0';
				 }
			else 
				{
			$pass_into_paid1 =(int)$show_d_cost_item-(int)$reciveramount_1_card;
			$objItem->paid_amount_first_card			= $pass_into_paid1;
				}
		
			$objDBReturn1 = $objItem->insertUpdategiftcard();
		
			
			if($secondcard_code!='')
			{
			  
			 $objItem->cardnumber            =	$secondcard_code ;
			 $objItem->paid_amount			 =   '0';
		if((int)$show_d_cost_item >((int)$reciveramount_1_card+(int)$reciveramount_2_card))
			 {
			   $objItem->paid_amount_second_card			= '0';
			 }
		else 
			 {
			  $first_sum       = ((int)$reciveramount_1_card+(int)$reciveramount_2_card);
			  $diff_of_amt     = ((int)$first_sum-(int)$show_d_cost_item);
			  $pass_into_paid2 = (int)$diff_of_amt;
			 }
			  $objItem->paid_amount_second_card        = (int)$pass_into_paid2;
	
			}
			$objItem->paymentstatus	                   = 1;
	    
			if($item_is_haated==1)
			{
			$objItem->last_id                         = $haated_id;
			$objItem->paid_status                     = 1;
			$objItem->changeBID_StatusHatingitems('1');					
			}
				
			$objDBReturn1 = $objItem->insertUpdategiftcard();
		    
			// end of code for update giftcard info
		
			/////// code  for sending sms 
			
			
			$objUser->id              = $buyer_id; //buyer id
			$UserRes                  = $objUser->getUserDetails();
			$UserArr                  = mysql_fetch_array($UserRes);
			//$UserArr['email'];
			//$UserArr['username'];
			//$sellers_id  
			$sellers_id        = $det_seller_id ;   //seller id
			$objUser1 	       = new Class_User();
			$objUser1->id      = $sellers_id;
			$result_user1      = $objUser1->selectUser();
			$num_user1         = mysql_num_rows($result_user1);
			if($num_user1)
			{
			$arr_user_values1  = mysql_fetch_assoc($result_user1);
			//	$arr_user_values1 ['phone1']
		
			send_to_seller($arr_user_values1['first_name'].''.$arr_user_values1['last_name'],$arr_item_details ['title'],$arr_user_values1['phone1'],$UserArr['first_name'].''.$UserArr['last_name']);
			 }
					if($objDBReturn1->nIdentity && $objDBReturn1->nErrorCode==0)
				{
			
				
					success_msg("You has successfully purchased an item.");
			}
			*/

			//echo '<pre>';
			//print_r($_POST);
			//echo '</pre>';
		 
       /// code ends here for sms
  
	ob_end_clean();	
	

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