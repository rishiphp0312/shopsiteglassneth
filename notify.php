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
			
			$objItem                      = new Class_Item();
			$objShip                      = new Class_Shipping();
            $objPackage 	              = new Class_Package();
			$objdyanmic                   = new Class_Dynamic();
		
			$message          	          = ob_get_contents();
			$payment_status               = $_POST['payment_status'];
			$payment_currency             = $_POST['mc_currency'];
			$txn_id                       = $_POST['txn_id'];
			$receiver_email               = $_POST['receiver_email'];
			$payer_email                  = $_POST['payer_email'];
			$amount                       = $_POST['mc_gross'];
			$custom                       = $_POST['custom'];
			$explode_custom               = explode("#|_|#",$custom);
		   	   
			$last_trans_id                = $explode_custom[0];
			$firstcardcode                = $explode_custom[1];			
			$service_rate                 = $explode_custom[2];
            
			$shipping_address1            = $explode_custom[3];
			$shipping_address2            = $explode_custom[4];
			$dest_zip_code                = $explode_custom[7];
			$city                         = $explode_custom[8];
			$country_code                 = $explode_custom[17];
			
			$d_item_id                    = $explode_custom[5];
			$buyer_id                     = $explode_custom[6];
			// email code//
						
			$ship_quantity                = $explode_custom[9];
			$show_d_cost_item             = $explode_custom[10];
			$item_is_haated               = $explode_custom[11];
			$haated_id                    = $explode_custom[12];
			$secondcard_code              = $explode_custom[13];
			$reciveramount_1_card         = $explode_custom[14];
			$reciveramount_2_card         = $explode_custom[15];
			$det_seller_id                = $explode_custom[16];
            

            $billing_address1             = $explode_custom[18];
			$billing_address2             = $explode_custom[19];
			$bdest_zip_code               = $explode_custom[20];
			$bcity                        = $explode_custom[21];
			$bcountry_code                = $explode_custom[22];
            $requested_quantity           = $explode_custom[23];
            $cost_after_discount          = $explode_custom[24];
            $payment_status               = $_POST['payment_status'];
			$payment_currency             = $_POST['mc_currency'];
			$txn_id                       = $_POST['txn_id'];
			$receiver_email               = $_POST['receiver_email'];
			$payer_email                  = $_POST['payer_email'];
			$amount                       = $_POST['mc_gross'];
			
		//	$objItem->paymentstatus	     = 1;
			$objItem->amount            = $amount-$service_rate ;// cost paid for item
			 //	calculategiftcardvalue
			$objItem->shipping_cost     = $service_rate; // cost paid for item shipping
			$objItem->paymentmode       = 'directpaypal';
			$objItem->shipping_status   = 0;
			$objItem->values_returned   = serialize($_POST);
			$objItem->trans_id          = $txn_id;
			$objItem->id                = $last_trans_id;
            $objItem->total_cost_paid   = $amount;      //final amount payment
			$objShip->shipping_cost     = $explode_custom[2];
        	$objShip->country_code      = $country_code;
			$objShip->buyer_id          = $explode_custom[6];
		    $objShip->item_id           = $explode_custom[5];
			$objShip->total_cost        = $amount;
            //	        $objShip->shipping_address1 =    $res;
			$objShip->shipping_address1  = $shipping_address1;
			$objShip->shipping_address2  = $shipping_address2;
			$objShip->dest_zip_code      = $dest_zip_code;
			$objShip->city               = $city;                        
            $objShip->billing_address1   = $billing_address1;
		    $objShip->billing_address2   = $billing_address2;
		    $objShip->bdest_zip_code     = $bdest_zip_code;
		    $objShip->bcity              = $bcity;
            $objShip->bcountry_code      = $bcountry_code;
			
			
			$objShip->quantity           = $ship_quantity;
			/////////start here
			 $objItem->item_id              =  $d_item_id;
			 $objItem->owner_id             =  $buyer_id;
			 $customitem_details_value      =  $objItem->check_usercustom_itembuy();
			 $num_customitem_details        =  mysql_num_rows($customitem_details_value);
					///////////end hrere
			
			
		   //     			//$last_trans_id 	  = $objDBReturn->nIdentity;
			
		if (!$fp) {
                    // HTTP ERROR
                    } else {
               fputs ($fp, $header.$req);
              if($last_trans_id!='')
                  {
              //start code for  commision on each item
             // item_id
             //start code for  commision on each item
               // item_id
                $objPackage->seller_id = $det_seller_id;
                $objPackage->status    = 1;
                $result_package        = $objPackage->getPackagedetails();
                $num_rows_pacakage     = mysql_num_rows($result_package);
               
                $objItem->seller_id       =  $det_seller_id;
                $total_items_available    =  $objItem->select_total_items();
                $num_rows_items_available = mysql_num_rows($total_items_available);
                if($num_rows_items_available<=25 && $num_rows_pacakage==0)
                {
                $Obj_category               = new Class_Category();
                $Obj_category->item_id      = $explode_custom[5];
                $result_commison            = $Obj_category->selectCatgeoryComission();
                $num_rows_commison          = mysql_num_rows($result_commison);
                if($num_rows_commison>0)
                 {
                  $arr_rows_commsion        = mysql_fetch_assoc($result_commison);
                  $commision_cost           = $arr_rows_commsion['commision'];
                 }
                //$item_cost                   =  ($amount+$reciveramount_1_card+$reciveramount_2_card)-$service_rate;
                 $item_cost =($amount+$reciveramount_1_card+$reciveramount_2_card)-$service_rate;
                /// code for commision on custom starts
				 if($num_customitem_details >0)
				 {
				 $arr_customitem_details        =  mysql_fetch_assoc($customitem_details_value);
				 $all_customitem_quantity       =  $arr_customitem_details['quantity_available'];
				 $tot_prev_adv_pmt              =  $arr_customitem_details['paid_amount'];  
				 $sing_prev_adv_pmt             =  ($tot_prev_adv_pmt/$all_customitem_quantity);             
				 $prev_curent_total             =  ($item_cost + ($sing_prev_adv_pmt*ship_quantity));
				 $after_deduct_commisioncost    =  (($commision_cost)*($prev_curent_total))/100;  // After deduction of percentage of commision from item cost				 	
				 }else
				 {
				 $after_deduct_commisioncost    = (($commision_cost)*($item_cost))/100;  // After deduction of percentage of commision from item cost
				 }
			
		//	mail('rishi_kapoor@seologistics.com','hi','prev_curent_total='.$prev_curent_total.'==sing_prev_adv_pmt=='.$sing_prev_adv_pmt.'commision_cost='.$commision_cost.'num_customitem_details=='.$num_customitem_details);

	
				// end of code for commission on custom
				
				
                $objItem->commision          = $after_deduct_commisioncost;
                $objItem->package_name       = 'Basic';
                }
  
          //end code for  commision on each item
      
			$objItem->payment_status     =  1;
            $objItem->purchased_quantity =	$ship_quantity;// quantity shipped
			$objDBReturn                 =  $objItem->insertUpdatepurchaseditem();
			
		
            $objShip->last_trans_id      =  $last_trans_id;
			$objDBReturn1 = $objShip->insertUpdateshipping();
			
			
			// start update quantity after sale of product
			// start quantity decreses code
			
			$objItem->update_item_id     =  $d_item_id;
			$item_details                =  $objItem->getItemImageDetails();
			$num_rows_details            =  mysql_num_rows($item_details);
			if($num_rows_details>0)
			{
			$arr_item_details            =  mysql_fetch_assoc($item_details);
			$item_name                   = $arr_item_details['title'];
			$quantity_available          = $arr_item_details['quantity_available'];
			//print_r($arr_item_details);
			//print_r($arr_item_details);
			}
            if($quantity_available>1)
			$quantity_available          = $quantity_available-$requested_quantity;
			else
            $quantity_available          = 0;

			$objItem->item_value         = $d_item_id;
			$objItem->quantity_available = $quantity_available ;
			$objItem->insertUpdateItem1('1');

//////========
 // start of code for giftcard info
               //       ($amount+$reciveramount_1_card+$reciveramount_2_card)-$service_rate;
                        //$total_cost_for_giftcardcomaprison =   ($amount+$reciveramount_1_card+$reciveramount_2_card);
			//if($cost_after_discount!=1)
                     //   else
                       // $total_cost_for_giftcardcomaprison =(float)(($show_d_cost_item)+(float)$service_rate);

            $total_cost_for_giftcardcomaprison =(float)(($show_d_cost_item*$requested_quantity)+(float)$service_rate);
                    
            $objItem->cardnumber         =	$firstcardcode ;
            $objItem->giftcardnumber     =	$firstcardcode ;	                
			$objItem->check_condition    =  1;
			if($total_cost_for_giftcardcomaprison >(float)$reciveramount_1_card)
			{
			$objItem->paid_amount_first_card			= '0';
			 }
			else 
			{
			$pass_into_paid1 =$total_cost_for_giftcardcomaprison-(float)$reciveramount_1_card;
			$objItem->paid_amount_first_card = $pass_into_paid1;
			}
		
			$objDBReturn1 = $objItem->insertUpdategiftcard();
			if($secondcard_code!='')
			{
				$objItem->giftcardnumber     =	$secondcard_code ;
				$objItem->check_condition    =  1;
				$objItem->cardnumber         =	$secondcard_code ;
				$objItem->paid_amount        =   '0';
				if($total_cost_for_giftcardcomaprison >((float)$reciveramount_1_card+(float)$reciveramount_2_card))
				 {
				 $objItem->paid_amount_second_card			= '0';
				 }
				else
				 {
				  $first_sum       = ((float)$reciveramount_1_card+(float)$reciveramount_2_card);
				  $diff_of_amt     = ((float)$first_sum-(float)$total_cost_for_giftcardcomaprison);
				  $pass_into_paid2 = (float)$diff_of_amt;
				 }
				$objItem->paid_amount_second_card        = (float)$pass_into_paid2;
			}
			$objItem->paymentstatus	                   = 1;
	    	if($item_is_haated==1)
			{
			$objItem->last_id                         = $haated_id;
			$objItem->paid_status                     = 1;
			$objItem->changeBID_StatusHatingitems('1');					
			}
			$objDBReturn2 = $objItem->insertUpdategiftcard();
		    
		//	'+'.$arr_user_values1 ['calling_code'].
			// end of code for update giftcard info
			
			 /////// code  for sending sms 
		
		 //$sellers_id  
		    	//******************************** Get email template **********//
			$objMail 	            = new Class_Mail();
		    $emailObj 	            = new SendEmailClass;	
			$objMail->mail_title	= "Email Template";
			$MailTemplate		    = $objMail->selectMailTemplate();
			$templateRowArr 	    = mysql_fetch_array($MailTemplate);
			$mail_content		    = $templateRowArr['mail_content'];
			$mail_content			=  str_replace("#link#",$baseUrl,$mail_content);
			//$mail_content		    = str_replace("#link#",'NetHaat',$mail_content);
						
			 //**************** Purchased_product_buyer email content *******************//
			
			$objMail->mail_title	= "Purchased_product_buyer"; 
			$MailRes 		        = $objMail->selectMailTemplate();
			$mailRowArr 		    = mysql_fetch_array($MailRes);
			$subject 		        = $mailRowArr['mail_subject']; 
			$message_content	    = $mailRowArr['mail_content'];	
			//replace message content with mail template message conyent variable		   
		   	$mail_content = str_replace("#message_content#",$message_content,$mail_content);
		    // $mail_content = str_replace("#link#",'NetHaat',$mail_content);
		    
			
		  
            ///////--end-----------/////			
			$objUser1 	       = new Class_User();
			// fr seller details
			$objUser1->id      = $det_seller_id;
			$result_user1      = $objUser1->selectUser();
			$num_user1         = mysql_num_rows($result_user1);
			if($num_user1)
			{
			$arr_user_values1  = mysql_fetch_assoc($result_user1);
		     }
			// fr buyer details
				
			$objUser1->id      = $buyer_id;
			$result_userb      = $objUser1->selectUser();
			$num_userb         = mysql_num_rows($result_userb);
			if($num_userb)
			{
			$arr_user_valuesb  = mysql_fetch_assoc($result_userb);
		     }
			 
			$gift_total_amount =$reciveramount_1_card+$reciveramount_2_card;
			
			if($gift_total_amount=='')
			$gift_total_amount = 'Not Used';
			else
			$gift_total_amount = $gift_total_amount.'USD';
			 
					
	//***************************  Replacing mail content *********************//

			$mail_content     = str_replace("#buyer_name#",$arr_user_valuesb['first_name'].''.$arr_user_valuesb['last_name'],$mail_content);
			$mail_content     = str_replace("#item_name#",$item_name,$mail_content);
			$mail_content     = str_replace("#username#",$arr_user_values1['username'],$mail_content);
			$mail_content     = str_replace("#qty_items#",$ship_quantity,$mail_content);			
			$mail_content     = str_replace("#item_cost#",($amount-$service_rate).' USD',$mail_content);
			$mail_content     = str_replace("#ship_cost#",$service_rate.' USD',$mail_content);
			$mail_content     = str_replace("#seller_name#",$arr_user_values1['first_name'].''.$arr_user_values1['last_name'],$mail_content);
			//<br> Total Amount Paid : #total_amt#
			$mail_content     = str_replace("#total_amt#",($amount+$gift_total_amount).' USD',$mail_content);			
			//$subject		= str_replace("#username#",$UserArr['username'],$subject);
            $mail_content   = str_replace("#gift_total_amount#",$gift_total_amount.' USD',$mail_content);
//			 $mail_content =  str_replace("#link#",$baseUrl,$mail_content);
			$mail_content	     =  str_replace("#link#",$baseUrl,$mail_content);
			$emailStatus = $emailObj->SendHtmlMail($arr_user_valuesb['email'],$subject,$mail_content,'rksonava@gmail.com');
	        			//replace message content with mail template message conyent variable		   //***	
			$objMail->mail_title	= "Email Template";
			$MailTemplate		    = $objMail->selectMailTemplate();
			$templateRowArr 	    = mysql_fetch_array($MailTemplate);
			$mail_content		    = $templateRowArr['mail_content'];
			$mail_content			=  str_replace("#link#",$baseUrl,$mail_content);
		//************************  Replacing mail content *********************//
          
		    $objdyanmic->country_code= $bcountry_code;		   
		    $country_result         =  $objdyanmic->selectCountry();
		    if(mysql_num_rows($country_result)>0)
			{
			$mail_bcountry = mysql_fetch_assoc($country_result);
			$name_mail_bcountry =$mail_bcountry['country'];
			}
			$objMail->mail_title	= "Purchased_product_seller"; 
			$MailRes 		        = $objMail->selectMailTemplate();
			$mailRowArr 		    = mysql_fetch_array($MailRes);
			$subject 		        = $mailRowArr['mail_subject']; 			
			$message_content	    = $mailRowArr['mail_content'];
				
 	        $mail_content = str_replace("#message_content#",$message_content,$mail_content);
			$mail_content = str_replace("#buyer_name#",$arr_user_valuesb['first_name'].''.$arr_user_valuesb['last_name'],$mail_content);
			$mail_content     = str_replace("#item_name#",$item_name,$mail_content);
			$mail_content     = str_replace("#username#",$arr_user_values1['username'],$mail_content);
			$mail_content     = str_replace("#qty_items#",$ship_quantity,$mail_content);			
			$mail_content     = str_replace("#item_cost#",($amount-$service_rate).' USD',$mail_content);
			$mail_content     = str_replace("#ship_cost#",$service_rate.' USD',$mail_content);
			
			//////////////////////////////===========================///////////////////////////
			$mail_content     = str_replace("#billing_address1#",$billing_address1,$mail_content);
			$mail_content     = str_replace("#billing_address2#",$billing_address2,$mail_content);
			$mail_content     = str_replace("#bdest_zip_code#",$bdest_zip_code,$mail_content);
			$mail_content     = str_replace("#bcity#",$bcity,$mail_content);			
			$mail_content     = str_replace("#bcountry_code#",$name_mail_bcountry,$mail_content);
			
			$objdyanmic->country_code  = $country_code;		   
		    $scountry_result           =  $objdyanmic->selectCountry();
		    if(mysql_num_rows($scountry_result)>0)
			{
			$smail_bcountry = mysql_fetch_assoc($scountry_result);
			$name_mail_scountry =$smail_bcountry['country'];
			}
			
			
			$mail_content     = str_replace("#shipping_address1#",$shipping_address1,$mail_content);
			$mail_content     = str_replace("#shipping_address2#",$shipping_address2,$mail_content);
			$mail_content     = str_replace("#dest_zip_code#",$dest_zip_code,$mail_content);
			$mail_content     = str_replace("#city#",$city,$mail_content);			
			$mail_content     = str_replace("#country_code#",$name_mail_scountry,$mail_content);
			//<br> Total Amount Paid : #total_amt#
			
			
			////////////////////////////////================/////////////////////////////////
			
			$mail_content     = str_replace("#total_amt#",($amount+$gift_total_amount).' USD',$mail_content);			
			//$subject		= str_replace("#username#",$UserArr['username'],$subject);
            $mail_content   = str_replace("#gift_total_amount#",$gift_total_amount.'',$mail_content);
//			 $mail_content =  str_replace("#link#",$baseUrl,$mail_content);
			$mail_content	     =  str_replace("#link#",$baseUrl,$mail_content);
			
			$emailStatus = $emailObj->SendHtmlMail($arr_user_values1['email'],$subject,$mail_content,'rksonava@gmail.com');
			
	        			//replace message content with mail template message conyent variable		   
						
						
		   	//$mail_content = str_replace("#message_content#",$message_content,$mail_content);
			//mail('rishi_kapoor@seologistics.com','hi','emailStatus='.$emailStatus.'--ema-='.$mail_content.'--sub--'.$subject.'user-val-email'.$arr_user_valuesb['email']);

		//***************************  Sending mail content *********************

		//	$emailStatus 	= $emailObj->SendHtmlMail($objItem->email, $subject, $mail_content,$UserArr['email']);
	
			//echo	$arr_user_values1 ['calling_code'];
		
		 send_to_seller($arr_user_values1['first_name'].''.$arr_user_values1['last_name'],$arr_item_details ['title'],$arr_user_values1 ['calling_code'].$arr_user_values1['phone1'],$UserArr['first_name'].''.$UserArr['last_name']);
	
       /// code ends here for sms

/////////====end 2


		}


}
        
			
		
			


			
		
		
        


?>