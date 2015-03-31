<?php
/***********************************************************
***********************************************************/

include ('include/common.inc');
include ('class/class.item.inc');
include ('class/class.user.inc');
include ('class/class.mail.inc');
include ('include/country_state_cat.php');
include ('include/sendEmailClass.php');
include ("include/authentiateUserLogin.php");
include ('class/class.category.inc');
session_start();

		$objUser 	= new Class_User();
		$objMail 	= new Class_Mail();
		$emailObj 	= new SendEmailClass();
		$objItem    = new Class_Item();
		//$sitePath = 'http://www.flexsin.org/lab/net_haat/';
		$sitePath   = $baseUrl;
        $result_max_rows          = $objItem->getgiftcarddetail();
        $num_max_id_ofgiftcard    = mysql_num_rows($result_max_rows);
        $total_max_id_ofgiftcard  = $num_max_id_ofgiftcard+1;
				
	    if($_REQUEST['seller_id']=='')   
        {		
		 failure_msg("Please select seller to purchase giftcard");
         redirect("events_gift_cards.php?rem_id_value=".$_REQUEST['rem_id_value']);
        }
        
       
        if($_REQUEST['rem_id_value']!='')
        {
                    $objUser->rem_id                      = $_REQUEST['rem_id_value'];
                    $result_users                         = $objUser->getreminderlisting();
                    $num_value_users_details              = mysql_num_rows($result_users);
                    if($num_value_users_details >0)
                      {
                      $arr_fetch_users_details            = mysql_fetch_assoc($result_users);
                      }
         }
		
		$objItem->paymentstatus	= 0;
		$rstr = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
                $nstr = "";
                mt_srand ((double) microtime() * 1000000);
                while(strlen($nstr) < 15)
                {
                  $random = mt_rand(0,(strlen($rstr)-1));
                  $nstr .= $rstr{$random};
                }


		$objItem->cardnumber	   = $total_max_id_ofgiftcard.'_'.$nstr.'_'.$_SESSION['session_user_id'];
		$objItem->buyerid	       = rteSafe($_SESSION['session_user_id']);
		$objItem->name		       = rteSafe($arr_fetch_users_details['name']);
		$objItem->email		       = rteSafe($arr_fetch_users_details['email_id']);
	    $objItem->check_condition  = 0;
		$objItem->seller_id        = $_REQUEST['seller_id'];
		$objItem->paid_amount      = $_REQUEST['amount'];
		
		
		$objDBReturn               = $objItem->insertUpdategiftcard();
             //  echo '<br>';
        $last_giftcardid_forcustom = $objDBReturn->nIdentity;
		$last_id_forcustom         = $total_max_id_ofgiftcard.'_'.$nstr.'_'.$_SESSION['session_user_id'];
		
		$custom_variable           = $last_id_forcustom.'##-|-##'.$_REQUEST['rem_id_value'].'##-|-##'.$last_giftcardid_forcustom;          
	     	//
        $objUser->id               = $_REQUEST['seller_id'];
        $result_user_sel     	   = $objUser->selectUser();
        $num_user_sel        	   = mysql_num_rows($result_user_sel);
        if($num_user_sel)
          {
             $arr_user_values_sel 		        = mysql_fetch_assoc($result_user_sel);
             $paypal_merchant_id    		    = $arr_user_values_sel['paypal_merchant_id'];
             $_SESSION['payment_type']          = $payment_type;
             $_SESSION['paypal_merchant_id']    = $paypal_merchant_id;
           }
		  // echo 'pay==='.$paypal_merchant_id;
		//   exit;
        if($paypal_merchant_id=='' )
           {	// exit;	   
               failure_msg("Service unavailable payment details are incomplete please try on other stores ");
               redirect("my_account.php");
            }


                //
			
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
</head>
<body onload ="document.Pay_order.submit();">
<div>Loading.............</div>
	<form action="<? echo PAYPAL_URL;?>" method="post" name="Pay_order">
	<input type="hidden" name="redirect_cmd" value="_xclick" />
	<input type="hidden" name="cmd" value="_ext-enter" />
			<!--<input type="hidden" name="business" value="<?php echo $_SESSION['paypal_merchant_id'];?>" />-->
	<input type="hidden" name="business" value="<?=$paypal_merchant_id;?>" />
	<input type="hidden" name="amount" value="<?php echo $_REQUEST['amount'];?>">
	<!--<input type="hidden" name="business" value="pravee_1284618448_biz@seologistics.com" />
	<input type="hidden" name="amount" value="128" />-->
				
	<input type="hidden" name="item_name" value="Purchase Giftcard">
	<input type="hidden" name="no_shipping" value="0" />

        <input type="hidden" name="return" value="<?php echo $sitePath."giftcard_reminder_message.php?rem_id_value=".$_REQUEST['rem_id_value']."&seller_id=".$_REQUEST['seller_id']."&gift_card_id=".$last_giftcardid_forcustom;?>" />
	<input type="hidden" name="cancel_return" value="<?php echo $sitePath.'api_error1.php';?>" />
	<input type="hidden" name="no_note" value="1" />
	<input type="hidden" name="currency_code" value="USD" />
	<input type="hidden" name="notify_url" 
	value="<?php echo $sitePath.'notify_gift_reminder.php';?>" />
		
        <input type="hidden" name="custom" value="<?php echo $custom_variable;?>" />
	<input type="hidden" name="flag" value="yes">
</td>
   </form>

</body>
</html>
