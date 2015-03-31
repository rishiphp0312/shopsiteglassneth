<?php
include ('include/common.inc');
include ("include/authentiateUserLogin.php");
include ('class/class.item.inc');
include ('class/class.user.inc');
include ('class/class.category.inc');
include ('include/sendEmailClass.php');
include ('class/class.mail.inc');
include ('include/send-sms.php');
include ('class/class.shipping.inc');
//echo $_SESSION['page_name'];
if($_SESSION['page_name']!='shipping_details.php')
{
//echo 'lala';
redirect("my_account.php");
//header("Location :my_account.php");
//exit;
}
$objMail 	            = new Class_Mail();
$emailObj 	            = new SendEmailClass;	
 //echo  'totalcost-item-'.$_SESSION['d_cost_item'];
 //echo '<br>';
 //echo '<pre>';
//print_r($_SESSION);
//echo $_SESSION['sess_requested_quantity'];
//echo 'country_value=='.$_SESSION['country_value'];
$shipp_cost    = $_SESSION['service_rate'];
$item_send_url_id   =   $_REQUEST['item_id'];
$seller_send_url_id =   $_REQUEST['seller_id'];

 if($_REQUEST['requested_quantity']!='')
 $quantity = $_REQUEST['requested_quantity'];
 $item_available_quantity= $_REQUEST['item_available_quantity'];
  //echo $_SESSION['ship_quantity']*$shipp_cost;
 if(isset($_POST['change'])&& $_POST['change']!='')
 {
 //exit;
//     item_available_quantity

 //unset($_SESSION['calculategiftcardvalue']);
// unset($_SESSION['firstreciveamount']);
 //unset($_SESSION['reciveramount_1_card']);
 //unset($_SESSION['reciveramount_2_card']);
 //unset($_SESSION['firstcardcode']);
 //unset($_SESSION['secondcard_code']);
 //unset($_SESSION['secondcalculategiftcardvalue']);
 //unset($_SESSION['checksecondtime']);
     $_SESSION['total_paypal_cost_item']='';
     
 if($quantity <=$item_available_quantity)
 {   $_SESSION['reciveramount_1_card']='';
     $_SESSION['reciveramount_2_card']='';
     $_SESSION['firstcardcode']='';
     $_SESSION['secondcard_code']='';
     $_SESSION['det_seller_id'] ;                // seller id
     $_SESSION['sess_requested_quantity'] = $quantity;
     $_SESSION['ship_quantity']           = $quantity;
	//  $_SESSION['service_rate']    = $_SESSION['service_rate']*$quantity;
	
     $error="";



//exit;
      //$_SESSION['d_cost_item']='';
 //unset($_SESSION['firstreciveamount']);

 //firstreciveamount

 //unset($_SESSION['total_paypal_cost_item']);
 //unset($_SESSION['secondcard_code']);
//unset($_SESSION['calculategiftcardvalue']);
 //unset($_SESSION['firstcardcode']);

 }else
  {
//  $error="Quantity should be less than available quantity.! please try again..";
  failure_msg($error);
 
   }   $smarty->assign("error",$error);
    echo "<script>window.location='buynow.php?item_id='.$item_send_url_id.'&seller_id='.$seller_send_url_id.'</script>";
 }


 $ship_quantity = $_SESSION['ship_quantity'];


//echo 'dcostitem='.$_SESSION['d_cost_item'];
//echo '<br>';
//echo '[show_d_cost_item='.$_SESSION['show_d_cost_item'];
//echo 'sess_requested_quantity='.$_SESSION['sess_requested_quantity'];

//echo 'reciveramount_2_card'.$_SESSION['reciveramount_2_card'];
//echo 'reciveramount_1_card'.$_SESSION['reciveramount_1_card'];
                 
//if($_SESSION['session_user_type']!="4")
//{
	// failure_msg("Please login as buyer for purchase item ...! ");
	// header("Location:my_account.php");
//}

    $objItem                  = new Class_Item();
    $total_items_available    =  $objItem->select_total_items();
    $num_rows_items_available = mysql_num_rows($total_items_available);
   // {$smarty.session.sess_requested_quantity}
    $requested_quantity             = $_SESSION['sess_requested_quantity'];
    //sess_requested_quantity
    $_SESSION['d_item_id']          = $_REQUEST['item_id'];
    $_SESSION['det_seller_id']      = $_REQUEST['seller_id'];
    
	//////////  code to check availability of payment details 
        $objUser 	         		= new Class_User();
		$objUser->id	         		= $_REQUEST['seller_id'];
		$result_user_sel	     		= $objUser->selectUser();
		$num_user_sel       			= mysql_num_rows($result_user_sel);
		if($num_user_sel)	{
		$arr_user_values_sel 		= mysql_fetch_assoc($result_user_sel);
		$API_USERNAME	     		= $arr_user_values_sel['API_USERNAME'];
		$API_PASSWORD	     		= $arr_user_values_sel['API_PASSWORD'];
		$API_SIGNATURE	     		= $arr_user_values_sel['API_SIGNATURE'];
		$Merchant_Id	     		= $arr_user_values_sel['Merchant_Id'];
		$payment_type	     		= $arr_user_values_sel['payment_type'];
		$paypal_merchant_id    		= $arr_user_values_sel['paypal_merchant_id'];
        $merchant_store_name   		= $arr_user_values_sel['store_name'];
        $merchant_user_name   		= $arr_user_values_sel['username'];
		$_SESSION['payment_type']       = $payment_type;
		$_SESSION['API_USERNAME']       = $API_USERNAME;
		$_SESSION['API_PASSWORD']       = $API_PASSWORD;
		$_SESSION['API_SIGNATURE']      = $API_SIGNATURE;
		$_SESSION['Merchant_Id']        = $Merchant_Id;
		$_SESSION['paypal_merchant_id'] = $paypal_merchant_id;
		//business
	}

  $smarty->assign("merchant_user_name",$merchant_user_name);
  $smarty->assign("merchant_store_name",$merchant_store_name);
  $smarty->assign("item_id", $_REQUEST['item_id']); 
  $smarty->assign("seller_id", $_REQUEST['seller_id']);


 // $objItem->paid_status       = 0;
  $objItem->item_id           = $_REQUEST['item_id'];
  $objItem->buyer_id          = $_SESSION['session_user_id'];
  $chk_item_hated_or_not      = $objItem->getHaatedItemImageDetails(); 
  $rows_chk_item_hated_or_not = mysql_num_rows($chk_item_hated_or_not); // to check whether item is haated or not
  
  if($rows_chk_item_hated_or_not>0)
  {
      $_SESSION['item_is_haated']   = 1; 
      $arr_fetch_haated_item_amount = mysql_fetch_assoc($chk_item_hated_or_not);
      $_SESSION['d_cost_item']      = $arr_fetch_haated_item_amount['cost_posted'];
      $_SESSION['show_d_cost_item'] = $arr_fetch_haated_item_amount['cost_posted'];
      $_SESSION['haated_id']        = $arr_fetch_haated_item_amount['hat_id'];
      $haat_item_cost               = $_SESSION['d_cost_item'];
      $item_quantity                = $arr_fetch_haated_item_amount['quantity_available'];
      $item_image                   = $arr_fetch_haated_item_amount['image1'];

     // if($_SESSION['cost_of_haated_item']==1)
    //  {
      //$_SESSION['d_cost_item'] = $haat_item_cost*$ship_quantity;
     // }

      //5EiuTpwe68Yh1Hg_2
      $session_haated_val           = 1;
  }
  else
  {         // $_SESSION['show_d_cost_item'] = 0;
     $_SESSION['haated_id']        = 0;
     $_SESSION['item_is_haated']   = 0;
     $session_haated_val           = 0;
  
  }
//echo 'cost-'.$_SESSION['cost_after_discount'];
//echo '<br>';
// echo 'item-'.$session_haated_val;
  //     echo 'd_cost_item=='.$_SESSION['d_cost_item'];

if(isset($_REQUEST['item_id'])!="" && isset($_REQUEST['seller_id'])!="")
{
	$objItem->item_id	    =	$_REQUEST['item_id'];
	$objItem->seller_id     =	$_REQUEST['seller_id'];
	$RecordSet = $objItem->getpurchaseitem();
	$row=mysql_num_rows($RecordSet);
	$Result=mysql_fetch_array($RecordSet);
    $item_image                   = $Result['image1'];
    if($session_haated_val==1 &&  $_SESSION['cost_after_discount']!=1)
	$smarty->assign("price",$arr_fetch_haated_item_amount['cost_posted']);
    else if($session_haated_val==0 &&  $_SESSION['cost_after_discount']==1)
    $smarty->assign("price",$_SESSION['show_d_cost_item']);
	else
    $smarty->assign("price",$Result['cost_item']); 
    $item_quantity = $Result['quantity_available'];
    $smarty->assign("title", $Result['title']);
        
}
 

//******************* start first time use of gift card ***************************

if(isset($_REQUEST['giftsubmit']))
{	//echo 'hidprice=='.$_REQUEST['hidprice'];

        if($_REQUEST['cardcode']!="")
	{   $objItem->seller_id         = '';

        $objItem->cardcode          = trim($_REQUEST['cardcode'],'');
        // echo '<br>';
        $RecordSetcardcodematched   = $objItem->getgiftcarddetail();
	    $objItem->cardcode	        = trim($_REQUEST['cardcode'],'');
        $itemprice		            = $_REQUEST['hidprice']*$ship_quantity;
	    $_SESSION['firstcardcode']  = $objItem->cardcode;
        $objItem->seller_id         = $_REQUEST['seller_id'];
		//$objItem->paidstatus      = 0;
		$RecordSet = $objItem->getgiftcarddetail();
	 	$row=mysql_num_rows($RecordSet);
		if($row>0)
		{
		$record	=	mysql_fetch_array($RecordSet);		
		$smarty->assign("recivername",$record['recivername']);
		$smarty->assign("recivercountry",$record['recivercountry']);
		$smarty->assign("recivercity",$record['recivercity']);
		$smarty->assign("reciverstate",$record['reciverstate']);
		$smarty->assign("reciveramount",$record['reciveramount']);
		$smarty->assign("buyer_id",$record['buyer_id']);
		$smarty->assign("giftcardnumber",$record['giftcardnumber']);
		$_SESSION['firstreciveamount']     = $record['reciveramount'];
		$_SESSION['reciveramount_1_card']  = $record['reciveramount'];
		//$shipp_cost
		if((float)$record['reciveramount'] >=((float)$itemprice+((float)$shipp_cost*$ship_quantity)))
		{
			$calculation =(float)$record['reciveramount']-((float)$itemprice+((float)$shipp_cost*$ship_quantity));
			$smarty->assign("plusecalculation",$calculation);
			$_SESSION['calculategiftcardvalue']=$calculation;
		}
		else
		{
			$calculation1 =((float)$itemprice+((float)$shipp_cost*$ship_quantity))-(float)$record['reciveramount'];
			$calculation =(float)$record['reciveramount']-((float)$itemprice+((float)$shipp_cost)*$ship_quantity);
			$smarty->assign("minusecalculation",$calculation1);
			$_SESSION['d_cost_item']=$calculation;
			$_SESSION['calculategiftcardvalue']=$calculation1;
			$secondtimecheck =($itemprice+((float)$shipp_cost*$ship_quantity))-$record['reciveramount'];
			$_SESSION['checksecondtime']=$secondtimecheck;
		}
		$onload="giftcard_success();";
	}
	else
	{  // $_REQUEST['seller_id']=0;
          
	$row_cardcodematched = mysql_num_rows($RecordSetcardcodematched);
        //    echo 'num'.$row_cardcodematched;
            if($row_cardcodematched>0)
            {
           $error="Giftcard code  does not belong to this store ..!";
        }else{
		$error="Giftcard code is invalid .! please try again..";

                }
		//$error="Gift card number is not mached from our record..! please try again..";
		$onload="open_gift();";
	}
	$smarty->assign("row",$row);
	$smarty->assign("error",$error);
	}
	else
	{
		$error="Number field can not be blank..! please try again..";
		$smarty->assign("error",$error);
		$onload="open_gift();";
	}

	
}

//******************* Start second gift card ***************************
if(isset($_REQUEST['giftsubmitagain']))
{
	
	$itemprice		     = $_POST['hidprice']*$ship_quantity;

	if($_SESSION['firstcardcode']==$_POST['cardcode'])
	{// echo 'laal';
	//exit;
		$message="You can not use same card number again.. Please process again ..!!!";
		$smarty->assign("error",$message);
		unset($_SESSION['checksecondtime']);
		unset($_SESSION['calculategiftcardvalue']);
		//unset($_SESSION['firstcardcode']);
		unset($_SESSION['firstreciveamount']);
		$onload="open_gift();";

	}
	else
	{
		if($_POST['cardcode']!="")
		{ 
		    $objItem->seller_id          =  '';
            $objItem->cardcode	         =  trim($_REQUEST['cardcode'],'');
        //echo '<br>';
            $RecordSetcardcodematched    =  $objItem->getgiftcarddetail();
			$objItem->firstcardcode      =	$_SESSION['firstcardcode'];
			$objItem->cardcode	         =	trim($_POST['cardcode'],'');
			$_SESSION['secondcard_code'] =  trim($_POST['cardcode'],'');
			$objItem->seller_id          =  $_REQUEST['seller_id'];
			//$objItem->paidstatus       =  0;
			$RecordSet                   =  $objItem->getgiftcarddetail();
			$row=mysql_num_rows($RecordSet);
			
			if($row>0)
			{	$record	=	mysql_fetch_array($RecordSet);
				$smarty->assign("recivername",$record['recivername']);
				$smarty->assign("recivercountry",$record['recivercountry']);
				$smarty->assign("recivercity",$record['recivercity']);
				$smarty->assign("reciverstate",$record['reciverstate']);
				$smarty->assign("reciveramount",$record['reciveramount']);
				$_SESSION['reciveramount_2_card']=$record['reciveramount'];
				$smarty->assign("giftcardnumber",$record['giftcardnumber']);
				$smarty->assign("buyer_id",$record['buyer_id']);
		    //	echo $_SESSION['calculategiftcardvalue']."==calculategiftcardvalue +reciveramount== ".$record['reciveramount']."= ";
				//$_SESSION['reciveramount_1_card']
				$secondamount = $_SESSION['calculategiftcardvalue']+$record['reciveramount'];
				$totalrecivedamount =$_SESSION['firstreciveamount']+$record['reciveramount'];
				//reciveramount
				$_SESSION['checksecondtime'];
	//echo $totalrecivedamount."=totalrecivedamount+ itemprice=".$itemprice.'==shipp_cost='.$shipp_cost.'==ship_quantity='.$ship_quantity.'=secondamount=='.$secondamount.'=calculategiftcardvalue=='.$_SESSION['calculategiftcardvalue'].'=reciveramount='.$record['reciveramount'];
			
				if((float)$totalrecivedamount >=((float)$itemprice+((float)$shipp_cost*$ship_quantity)))
				{
				/*	echo 'calci=='.$calculation =(float)$totalrecivedamount -((float)$itemprice+((float)$shipp_cost*$ship_quantity));
					echo '<br>';
					//echo $_SESSION['d_cost_item']=$calculation;
					//exit;
					$smarty->assign("plusecalculation",$calculation);
					$smarty->assign("remainig",$calculation);
					$_SESSION['secondcalculategiftcardvalue']=$calculation;*/
					$calculation =((float)$totalrecivedamount-((float)$itemprice+((float)$shipp_cost*$ship_quantity)));
					$_SESSION['d_cost_item']=$calculation;
					
					$smarty->assign("plusecalculation",$calculation);
					//echo 'sec-ndamt'.$calculation;
					//exit;
					
					$smarty->assign("remainig",$secondamount);
					$_SESSION['secondcalculategiftcardvalue']=$calculation;
	
				}
				else
				{ 
				//echo 'lala000';
					//echo $calculation."=calculation + secondamount==".$secondamount." = ";
				    $calculation=  $_SESSION['calculategiftcardvalue']-$record['reciveramount'];
					//exit;
		        
					//$calculation =$secondamount;
					$_SESSION['d_cost_item']=$calculation;
					$smarty->assign("minusecalculation",$calculation);
					$_SESSION['secondcalculategiftcardvalue']=$calculation;
					
				}
		           $onload="giftcard_success2();";
				
				

			}
			else
			{
			//echo 'sdsd';
			//exit;
                         $row_cardcodematched = mysql_num_rows($RecordSetcardcodematched);
            //echo '<br>';
        //  echo 'num'.$row_cardcodematched;
                        if($row_cardcodematched>0)
                        {
                       $error="Giftcard code  does not belong to this store ..!";
                        }else{
                        $error="Giftcard code is invalid .! please try again..";

                           }
				//failure_msg("Gift card number is not mached from our record..! please try again..");
				$onload="open_gift();";$smarty->assign("error",$error);
			}
		}
		else
		{//	echo '123';
		//	exit;
			$error="Number field can not be blank..! please try again from starting..";
			$smarty->assign("error",$error);
			$onload="open_gift();";
		}
		$smarty->assign("row",$row);
	}
	
}
/*
		echo '7='.$_SESSION['calculategiftcardvalue'];
		echo '<br>';
		echo '1='.$_SESSION['firstreciveamount'];
		echo '<br>';
		echo '6='.$_SESSION['calculategiftcardvalue'];echo '<br>';
		
		echo '2='.$record['reciveramount'];
        echo '<br>';
		echo '3='.$_SESSION['reciveramount_2_card'];
		echo '<br>';
		echo '4='.(float)$totalrecivedamount ;
		echo '<br>';
		echo '5='.$secondamount;
		
	//	$_SESSION['calculategiftcardvalue']
	*/
//******************* End second gift card ******************************
//******************* Cancel button gift card ***************************
if(isset($_POST['cancel']))
{
     $_SESSION['reciveramount_1_card']='';
     $_SESSION['reciveramount_2_card']='';
     $_SESSION['firstcardcode']='';
     $_SESSION['secondcard_code']='';
     $_SESSION['det_seller_id'] ;                // seller id
	 $_SESSION['total_paypal_cost_item']='';
	
	 unset($_SESSION['checksecondtime']);
     unset($_SESSION['reciveramount_1_card']);
     unset($_SESSION['reciveramount_2_card']);
	 unset($_SESSION['calculategiftcardvalue']);
	 unset($_SESSION['firstcardcode']);
     unset($_SESSION['firstcardcode']);
          

       // unset($_SESSION['firstcardcode']);
       
	unset($_SESSION['firstreciveamount']);
    unset($_SESSION['secondcard_code']);
	unset($_SESSION['calculategiftcardvalue']);
	unset($_SESSION['reciveramount_1_card']);
	unset($_SESSION['firstreciveamount']);
    //redirect("buynow.php?item_id=".$item_send_url_id."&seller_id=".$seller_send_url_id);
	redirect("my_account.php");
}

//******************* Final Submitting gift card Information *************

if(isset($_POST['firstsuccesssubmit']))
{
	extract($_POST);
	echo '<pre>';
   	print_r($_POST);echo '<pre>';
	echo '<pre>';
	print_r($_SESSION);echo '<pre>';
	 echo 'ship_quantity=='.$ship_quantity;
	//exit;
	$objItem->giftcardnumber		=	$giftcardnumber;
	//$objItem->giftcardnumber		=	$_SESSION['firstcardcode'];

	$objItem->paid_amount			=	$firstgiftcardamount;
   // $objItem->paid_amount			=	$_SESSION['calculategiftcardvalue'];
	
	$objItem->check_condition	    =	1;//exit;
	//$objItem->paymentstatus	        =	1;
	$objDBReturn = $objItem->insertUpdategiftcard();
  //  echo  'nIdentity'.$objDBReturn->nIdentity.' && nErrorCode'.$objDBReturn->nErrorCode;
		if($objDBReturn->nErrorCode==0 && $objDBReturn->nIdentity==0)
	{   
		if($_SESSION['item_is_haated']==1)
		{
		$objItem->last_id         = $_SESSION['haated_id'];
		$objItem->paid_status     = 1;
		$objItem->changeBID_StatusHatingitems('1');					
		}
		
		$objItem->update_item_id     = $item_id;
	
		//$objItem->update_item_id   =  $_SESSION['d_item_id'];
		$item_details                =  $objItem->getItemImageDetails();
		$num_rows_details            =  mysql_num_rows($item_details);
        if($num_rows_details>0)
		$arr_item_details            =  mysql_fetch_assoc($item_details);
		//print_r($arr_item_details);
		$quantity_available          = $arr_item_details['quantity_available'];
		//print_r($arr_item_details);
        $item_name                   = $arr_item_details['title'];
		$quantity_available          = $quantity_available-$ship_quantity;
		//$quantity_available          = $quantity_available-1;
		//$objItem->item_value         = $_SESSION['d_item_id'];
    	$objItem->item_value         = $item_id;
                
	    if($quantity_available>0)
        $objItem->quantity_available = $quantity_available ;
        else
        $objItem->quantity_available = 0 ;

		$objItem->insertUpdateItem1('1');
		
		$success="Congratulations ...! You have successfully purchased this item ..";
		//$objItem->item_id	=   $_SESSION['d_item_id'];
		$objItem->item_id	=	$item_id;
		$objItem->buyer_id	=   $_SESSION['session_user_id'];
		//$objItem->seller_id	=	$_SESSION['det_seller_id'];	
	
		$objItem->seller_id	=	$seller_id;	
		//$objItem->amount	=	$amount*$ship_quantity; //storing item cost paid
		$objItem->amount	=	0; //storing item cost paid

        $objItem->paymentmode	=	$paymentmode;
                //if()
        $objItem->gift_card1	=	($amount*$ship_quantity)+($_SESSION['service_rate']*$_SESSION['ship_quantity']);
		
		//$objItem->gift_card1	=	$_SESSION['reciveramount_1_card']-$_SESSION['calculategiftcardvalue'];
		
		//$objItem->gift_card1	=	$_SESSION['reciveramount_1_card']-($amount*$ship_quantity);
		//$objItem->gift_card2	=	$_SESSION['reciveramount_2_card']-($amount*$ship_quantity);
        $objItem->total_cost_paid = '0' ;// paid throgh gift
		$objItem->shipping_cost	  = $_SESSION['service_rate']*$ship_quantity;
        $objItem->purchased_quantity =	$ship_quantity;
	         //*$ship_quantity;
                //start code for  commision on each item
        //seller_id
        $total_items_available       =  $objItem->select_total_items();
        $num_rows_items_available    = mysql_num_rows($total_items_available);
          
		if($num_rows_items_available<=25)
               {
                $Obj_category           = new Class_Category();
                $Obj_category->item_id  = $item_id;
                $result_commison        = $Obj_category->selectCatgeoryComission();
                $num_rows_commison      = mysql_num_rows($result_commison);
                if($num_rows_commison>0)
                { 
                  $arr_rows_commsion    = mysql_fetch_assoc($result_commison);
                  $commision_cost       = $arr_rows_commsion['commision'];
                 }//echo '<br>';
                  $item_cost            = $amount*$ship_quantity;
				 // $item_cost          = ($objItem->gift_card1) - ($objItem->shipping_cost);
                  //echo '<br>';
                  //$commision_cost       ;
                  //exit;
                  $after_deduct_commisioncost  =  (((float)$commision_cost)*((float)$item_cost))/100;  // After deduction of percentage of commision from item cost
                  $objItem->commision   =  $after_deduct_commisioncost;
                  //exit;
               }
			//    echo   'commision=='.$objItem->commision ;
     //exit;
                              //end code for  commision on each item
      
		
		 /////// code  for sending sms 
		
    	 //$sellers_id  
		$objUser 	       = new Class_User();
		$objUser->id       = $_SESSION['session_user_id'];
		$result_userb      = $objUser->selectUser();
		$num_userb         = mysql_num_rows($result_userb);
		if($num_userb)
		$arr_user_valuesb  = mysql_fetch_assoc($result_userb);
	
		
		$objUser->id       = $seller_id;
		$result_user1      = $objUser->selectUser();
		$num_user1         = mysql_num_rows($result_user1);
		if($num_user1)
		$arr_user_values1  = mysql_fetch_assoc($result_user1);
	
	  //  echo 'seller'.$arr_user_values1['email'];
	//exit;
		send_to_seller($arr_user_values1['first_name'].''.$arr_user_values1['last_name'],$arr_item_details['title'],'+'.$arr_user_values1['calling_code'].$arr_user_values1['phone1'],$UserArr['first_name'].''.$UserArr['last_name']);
	
               /// code ends here for sms
              $objItem->payment_status	    = 1;
            //   $objItem->purchased_quantity = $ship_quantity;
             $objDBReturn   = $objItem->insertUpdatepurchaseditem();
             $last_trans_id = $objDBReturn->nIdentity;
               // code for saving shipping details starts

         	$objShip                    = new Class_Shipping();
        	$objShip->shipping_cost     = $_SESSION['service_rate']*$ship_quantity;
	        //bleow we are storing whole amt including giftcard cost+ shipping cost
           // $objShip->total_cost        = $_SESSION['reciveramount_1_card']-$_SESSION['calculategiftcardvalue'];
                //$objShip->total_cost        = $resArray['AMT'];
			$objShip->total_cost        = 0;// only amt paid on paypal is stored in shipp table in field total_cost
               
			$objShip->buyer_id          = $_SESSION['session_user_id'];
			$objShip->item_id           = $_SESSION['d_item_id'];
			$objShip->shipping_address1 = $_SESSION['shipping_address1'];
			$objShip->shipping_address2 = $_SESSION['shipping_address2'];
			$objShip->dest_zip_code     = $_SESSION['dest_zip_code'];
			$objShip->city              = $_SESSION['city'];
    		$objShip->country_code      = $_SESSION['country_value'];
	    	$objShip->quantity          = $ship_quantity;
            //  $objItem->purchased_quantity = $ship_quantity;
            // $last_trans_id
		    $objShip->last_trans_id     = $last_trans_id;
			//exit;
		    $objShip->insertUpdateshipping();
			

           // code for saving ship details end
		   
		   
		
		   /// code to send mail after product purchase to seller//
		    $objMail->mail_title	= "Email Template";
			$MailTemplate		    = $objMail->selectMailTemplate();
			$templateRowArr 	    = mysql_fetch_array($MailTemplate);
			$mail_content		    = $templateRowArr['mail_content'];
			$mail_content			=  str_replace("#link#",$baseUrl,$mail_content);
		//************************  Replacing mail content *********************//
        
		
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
			$mail_content     = str_replace("#item_cost#",($item_cost/$ship_quantity).' USD',$mail_content);
			$mail_content     = str_replace("#ship_cost#",($_SESSION['service_rate']*$ship_quantity).' USD',$mail_content);
			$mail_content     = str_replace("#seller_name#",$arr_user_values1['first_name'].''.$arr_user_values1['last_name'],$mail_content);
			//<br> Total Amount Paid : #total_amt#
			$mail_content     = str_replace("#total_amt#",($objShip->total_cost).' USD',$mail_content);			
			//$subject		= str_replace("#username#",$UserArr['username'],$subject);
			if($objShip->total_cost!='')
			$gift_total_amount = $objShip->total_cost.' USD';
			
            $mail_content   = str_replace("#gift_total_amount#",($gift_total_amount).'',$mail_content);
//			 $mail_content =  str_replace("#link#",$baseUrl,$mail_content);
			$mail_content	     =  str_replace("#link#",$baseUrl,$mail_content);
			
			$emailStatus = $emailObj->SendHtmlMail($arr_user_values1['email'],$subject,$mail_content,'rksonava@gmail.com');

			
// end for seller //
		   /// code to send mail after product purchase to buyer//
		    $objMail->mail_title	= "Email Template";
			$MailTemplate		    = $objMail->selectMailTemplate();
			$templateRowArr 	    = mysql_fetch_array($MailTemplate);
			$mail_content		    = $templateRowArr['mail_content'];
			$mail_content			=  str_replace("#link#",$baseUrl,$mail_content);
		//************************  Replacing mail content *********************//
        
		
		    $objMail->mail_title	= "Purchased_product_buyer"; 
			$MailRes 		        = $objMail->selectMailTemplate();
			$mailRowArr 		    = mysql_fetch_array($MailRes);
			$subject 		        = $mailRowArr['mail_subject']; 			
			$message_content	    = $mailRowArr['mail_content'];
				
 	        $mail_content = str_replace("#message_content#",$message_content,$mail_content);
			$mail_content = str_replace("#buyer_name#",$arr_user_valuesb['first_name'].''.$arr_user_valuesb['last_name'],$mail_content);
			$mail_content     = str_replace("#item_name#",$item_name,$mail_content);
			$mail_content     = str_replace("#username#",$arr_user_values1['username'],$mail_content);
			$mail_content     = str_replace("#qty_items#",$ship_quantity,$mail_content);			
			$mail_content     = str_replace("#item_cost#",($item_cost/$ship_quantity).' USD',$mail_content);
			$mail_content     = str_replace("#ship_cost#",($_SESSION['service_rate']*$ship_quantity).' USD',$mail_content);
			$mail_content     = str_replace("#seller_name#",$arr_user_values1['first_name'].''.$arr_user_values1['last_name'],$mail_content);
			//<br> Total Amount Paid : #total_amt#
			$mail_content     = str_replace("#total_amt#",($objShip->total_cost).' USD',$mail_content);			
			//$subject		= str_replace("#username#",$UserArr['username'],$subject);
            $mail_content   = str_replace("#gift_total_amount#",$gift_total_amount.'',$mail_content);
//			 $mail_content =  str_replace("#link#",$baseUrl,$mail_content);
			$mail_content	     =  str_replace("#link#",$baseUrl,$mail_content);
			
			//echo 'buyer'.$arr_user_values1['email'];
			
			$emailStatus = $emailObj->SendHtmlMail($arr_user_valuesb['email'],$subject,$mail_content,'rksonava@gmail.com');
//exit;
// end for buyer //
		   
		
	   $onload="return_success();";


		unset($_SESSION['checksecondtime']);
		unset($_SESSION['calculategiftcardvalue']);
		unset($_SESSION['firstcardcode']);
		unset($_SESSION['firstreciveamount']);
                unset($_SESSION['reciveramount_1_card']);
                unset($_SESSION['reciveramount_2_card']);
                $_SESSION['total_paypal_cost_item']='';

redirect("my_account.php");

	}
	else
	{
		$error_msg="Error occured ...! Please try again ";
                $_SESSION['total_paypal_cost_item']='';
		unset($_SESSION['checksecondtime']);
		unset($_SESSION['calculategiftcardvalue']);
		unset($_SESSION['firstcardcode']);
		unset($_SESSION['firstreciveamount']);
                unset($_SESSION['reciveramount_1_card']);
                unset($_SESSION['reciveramount_2_card']);
              
redirect("buynow.php?item_id=".$item_send_url_id."&seller_id=".$seller_send_url_id);

		//header("Location:leavefeedback.php?id=$objItem->item_id&buyid=$objItem->buyer_id&seller_id=$objItem->seller_id");
	}
	$smarty->assign("success",$success);
	$smarty->assign('error_msg',$error_msg);
    
	
}

//******************* Final Second gift card Submitting Information *************
if(isset($_POST['submitsecondtimesuccess']))
{
	
	extract($_POST);
	/*echo '<pre>';
   	print_r($_POST);echo '<pre>';
	echo '<pre>';
	print_r($_SESSION);echo '<pre>';*/
	//echo 'gift--'.$objItem->giftcardnumber		=	$giftcardnumber;
	if($firstcardcode!= "")
	{
		//echo $objItem->giftcardnumber		=	$giftcardnumber;

		$objItem->giftcardnumber		=	$firstcardcode;
		$objItem->paid_amount			=	"0";
		$objItem->check_condition		=    1;
		//	$objItem->paymentstatus	        =	 1;
		$objDBReturn = $objItem->insertUpdategiftcard();
        
		if($objDBReturn->nIdentity==0 && $objDBReturn->nErrorCode==0)
		{
			$objItem->giftcardnumber	=   $giftcardnumber;
			$objItem->paid_amount		=   $firstgiftcardamount;
			$objDBReturn 		        =   $objItem->insertUpdategiftcard();
			if($objDBReturn->nIdentity==0 && $objDBReturn->nErrorCode==0)
			{
				$success="Congratulations ...! You have successfully purchased this item ..";

				$objItem->update_item_id    =	$item_id;	
				$item_details                =  $objItem->getItemImageDetails();
				$num_rows_details            =  mysql_num_rows($item_details);
				if($num_rows_details>0)
				$arr_item_details            =  mysql_fetch_assoc($item_details);
		        //print_r($arr_item_details);
         		$quantity_available          = $arr_item_details['quantity_available'];
		        //print_r($arr_item_details);
				
	
                $quantity_available1          = $quantity_available-$ship_quantity;
	
				$objItem->item_value         = $item_id;	
                

				if($quantity_available1>0)
                $objItem->quantity_available = $quantity_available1 ;
                else
                $objItem->quantity_available = 0 ;

				$objItem->insertUpdateItem1('1');
				//exit;
		
				$objItem->buyer_id	         = $_SESSION['session_user_id'];
				$objItem->seller_id	         = $seller_id;	
				$objItem->amount	         = 0; //storing item cost paid
                //$objItem->amount	=	$amount*$ship_quantity;  // storing item cost
				$objItem->paymentmode	     = $paymentmode;
                // if(($amount*$ship_quantity)>)
				$objItem->gift_card1	     = $_SESSION['reciveramount_1_card'];
//$objItem->gift_card2	=((($amount*$ship_quantity)+($_SESSION['service_rate']*$ship_quantity))-$_SESSION['reciveramount_1_card']);
			    $objItem->gift_card2	     = $_SESSION['reciveramount_2_card']-$_SESSION['secondcalculategiftcardvalue'];
                              
				$objItem->shipping_cost	     = $_SESSION['service_rate']*$ship_quantity;
                $objItem->total_cost_paid    = '0'; // paid throgh gift
                $objItem->purchased_quantity = $ship_quantity;
               //   $objItem->gift_card1	 = $_SESSION['reciveramount_1_card']-;
               //start code for  commision on each item
                $total_items_available       =  $objItem->select_total_items();
                $num_rows_items_available    = mysql_num_rows($total_items_available);
                if($num_rows_items_available<=25)
                 {
                       $Obj_category            = new Class_Category();
                       $Obj_category->item_id   = $item_id;
                       $result_commison         = $Obj_category->selectCatgeoryComission();
                       $num_rows_commison       = mysql_num_rows($result_commison);
                       if($num_rows_commison>0)
                       {
                         $arr_rows_commsion    = mysql_fetch_assoc($result_commison);
                         $commision_cost       = $arr_rows_commsion['commision'];
                       }
                      $item_cost               = $amount*$ship_quantity;
                                   //echo '<br>';
                      $after_deduct_commisioncost  = (((float)$commision_cost)*((float)$item_cost))/100;  // After deduction of percentage of commision from item cost
                      $objItem->commision          = $after_deduct_commisioncost;
                    }

                                              //end code for  commision on each item


                                ///////======= code  for sending sms=====///
		
				 //$sellers_id  
				
				$objUser 	       = new Class_User();
				$objUser->id       = $_SESSION['session_user_id'];
				$result_userb      = $objUser->selectUser();
				$num_userb         = mysql_num_rows($result_userb);
				if($num_userb)
				$arr_user_valuesb  = mysql_fetch_assoc($result_userb);
		
				$objUser->id       = $seller_id;
				$result_user1      = $objUser->selectUser();
				$num_user1         = mysql_num_rows($result_user1);
				if($num_user1)
				$arr_user_values1  = mysql_fetch_assoc($result_user1);
		
		 		//send_to_seller($arr_user_values1['first_name'].''.$arr_user_values1['last_name'],$arr_item_details['title'],'+'.$arr_user_values1['calling_code'].$arr_user_values1['phone1'],$UserArr['first_name'].''.$UserArr['last_name']);
				send_to_seller($arr_user_values1['first_name'].''.$arr_user_values1['last_name'],$arr_item_details['title'],'+'.$arr_user_values1['calling_code'].$arr_user_values1['phone1'],$UserArr['first_name'].''.$UserArr['last_name']);
	
	
                /// code ends here for sms
                 $objItem->payment_status	= 1;
                 $objDBReturn = $objItem->insertUpdatepurchaseditem();
                 $last_trans_id = $objDBReturn->nIdentity;
                // code for saving shipping details starts

                 $objShip                    = new Class_Shipping();
                 $objShip->shipping_cost     = $_SESSION['service_rate']*$ship_quantity;
               //  $objShip->total_cost        = ($_SESSION['service_rate']*$ship_quantity)+($amount*$ship_quantity);
                 $objShip->total_cost        = 0;// only amt paid on paypal is stored in shipp table in field total cost
               
			     $objShip->buyer_id          = $_SESSION['session_user_id'];
                 $objShip->item_id           = $_SESSION['d_item_id'];
                 $objShip->shipping_address1 = $_SESSION['shipping_address1'];
                 $objShip->shipping_address2 = $_SESSION['shipping_address2'];
                 $objShip->dest_zip_code     = $_SESSION['dest_zip_code'];
                 $objShip->city              = $_SESSION['city'];
                 $objShip->country_code      = $_SESSION['country_value'];
                 $objShip->quantity          = $_SESSION['ship_quantity'];
                 // $last_trans_id
                 $objShip->last_trans_id     = $last_trans_id;
                                    //exit;
                 $objShip->insertUpdateshipping();
							


                       // code for saving ship details end
					   
					   
	
		   /// code to send mail after product purchase to seller//
	
		    $objMail->mail_title	= "Email Template";
			$MailTemplate		    = $objMail->selectMailTemplate();
			$templateRowArr 	    = mysql_fetch_array($MailTemplate);
			$mail_content		    = $templateRowArr['mail_content'];
			$mail_content			=  str_replace("#link#",$baseUrl,$mail_content);
		
		//************************  Replacing mail content *********************//
        
	
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
			$mail_content     = str_replace("#item_cost#",($item_cost/$ship_quantity).' USD',$mail_content);
			$mail_content     = str_replace("#ship_cost#",($_SESSION['service_rate']*$ship_quantity).' USD',$mail_content);
			$mail_content     = str_replace("#seller_name#",$arr_user_values1['first_name'].''.$arr_user_values1['last_name'],$mail_content);
			//<br> Total Amount Paid : #total_amt#
			$mail_content     = str_replace("#total_amt#",($objShip->total_cost).' USD',$mail_content);			
			//$subject		= str_replace("#username#",$UserArr['username'],$subject);
			if($objShip->total_cost!='')
			$gift_total_amount = $objShip->total_cost.' USD';
			
            $mail_content   = str_replace("#gift_total_amount#",($gift_total_amount).'',$mail_content);
//			 $mail_content =  str_replace("#link#",$baseUrl,$mail_content);
			$mail_content	     =  str_replace("#link#",$baseUrl,$mail_content);
			
			$emailStatus = $emailObj->SendHtmlMail($arr_user_values1['email'],$subject,$mail_content,'rksonava@gmail.com');

			
// end for seller //
		   /// code to send mail after product purchase to buyer//
		    $objMail->mail_title	= "Email Template";
			$MailTemplate		    = $objMail->selectMailTemplate();
			$templateRowArr 	    = mysql_fetch_array($MailTemplate);
			$mail_content		    = $templateRowArr['mail_content'];
			$mail_content			=  str_replace("#link#",$baseUrl,$mail_content);
		//************************  Replacing mail content *********************//
     
		    $objMail->mail_title	= "Purchased_product_buyer"; 
			$MailRes 		        = $objMail->selectMailTemplate();
			$mailRowArr 		    = mysql_fetch_array($MailRes);
			$subject 		        = $mailRowArr['mail_subject']; 			
			$message_content	    = $mailRowArr['mail_content'];
				
 	        $mail_content = str_replace("#message_content#",$message_content,$mail_content);
			$mail_content = str_replace("#buyer_name#",$arr_user_valuesb['first_name'].''.$arr_user_valuesb['last_name'],$mail_content);
			$mail_content     = str_replace("#item_name#",$item_name,$mail_content);
			$mail_content     = str_replace("#username#",$arr_user_values1['username'],$mail_content);
			$mail_content     = str_replace("#qty_items#",$ship_quantity,$mail_content);			
			$mail_content     = str_replace("#item_cost#",($item_cost/$ship_quantity).' USD',$mail_content);
			$mail_content     = str_replace("#ship_cost#",($_SESSION['service_rate']*$ship_quantity).' USD',$mail_content);
			$mail_content     = str_replace("#seller_name#",$arr_user_values1['first_name'].''.$arr_user_values1['last_name'],$mail_content);
			//<br> Total Amount Paid : #total_amt#
			$mail_content     = str_replace("#total_amt#",($objShip->total_cost).' USD',$mail_content);			
			//$subject		= str_replace("#username#",$UserArr['username'],$subject);
            $mail_content   = str_replace("#gift_total_amount#",$gift_total_amount.'',$mail_content);
//			 $mail_content =  str_replace("#link#",$baseUrl,$mail_content);
			$mail_content	     =  str_replace("#link#",$baseUrl,$mail_content);
			
			//echo 'buyer'.$arr_user_values1['email'];
			
			$emailStatus = $emailObj->SendHtmlMail($arr_user_valuesb['email'],$subject,$mail_content,'rksonava@gmail.com');
//exit;
// end for buyer //
		 

				$onload="return_success();";
				$smarty->assign("success",$success);
				redirect("my_account.php");

			}
			else
			{
				$error_msg="Error occured ..! Please try again ";
				unset($_SESSION['checksecondtime']);
				unset($_SESSION['calculategiftcardvalue']);
				unset($_SESSION['firstcardcode']);
				unset($_SESSION['firstreciveamount']);
                unset($_SESSION['reciveramount_1_card']);
                unset($_SESSION['reciveramount_2_card']);
                unset($_SESSION['secondcard_code']);
				redirect("buynow.php?item_id=".$item_send_url_id."&seller_id=".$seller_send_url_id);
				//header("Location:leavefeedback.php?id=$objItem->item_id&buyid=$objItem->buyer_id&seller_id=$objItem->seller_id");
			}
		}
		else
		{
			$error_msg="Error occured ...! Please try again lului";
			unset($_SESSION['checksecondtime']);
			unset($_SESSION['calculategiftcardvalue']);
			unset($_SESSION['firstcardcode']);
			unset($_SESSION['firstreciveamount']);
                        unset($_SESSION['reciveramount_1_card']);
                        unset($_SESSION['reciveramount_2_card']);
                        unset($_SESSION['secondcard_code']);
	      redirect("buynow.php?item_id=".$item_send_url_id."&seller_id=".$seller_send_url_id);
			//header("Location:leavefeedback.php?id=$objItem->item_id&buyid=$objItem->buyer_id&seller_id=$objItem->seller_id");
		}
		$smarty->assign("success",$success);
		$smarty->assign('error_msg',$error_msg);
	}
	else
	{
		$error_msg="Card number can not be blank..";
		$smarty->assign('error_msg',$error_msg);
	 redirect("buynow.php?item_id=".$item_send_url_id."&seller_id=".$seller_send_url_id);

	}
         
}
//echo 'pay-merchant-id'.$paypal_merchant_id;
$smarty->assign("item_image",$item_image);
$smarty->assign("item_quantity",$item_quantity);
$smarty->assign("business",$paypal_merchant_id);
$smarty->assign("onload",$onload);
$smarty->assign('CURRENCY',CURRENCY);
$smarty->assign('site_page_title',SITE_HOME);
$smarty->assign('site_title',$site_title);
$smarty->display('buynow.tpl');
?>