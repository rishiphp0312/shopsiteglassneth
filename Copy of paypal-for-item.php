<?php
include ('include/common.inc');
include ('class/class.item.inc');
include ('class/class.user.inc');
include ('class/class.shipping.inc');
include ('class/class.mail.inc');
include ('include/country_state_cat.php');
include ('include/sendEmailClass.php');
include ('include/send-sms.php');

session_start();
?>
<script type="text/javascript">
//document.write("Hello World!")
</script>


<?
$sitePath=$baseUrl;
$shipp_cost    = $_SESSION['service_rate']*$_SESSION['ship_quantity'];

$_SESSION['firstcardcode'];
$_SESSION['secondcard_code'];
$_SESSION['cost_after_discount'];
$d_cost_item = $_SESSION['d_cost_item'];
 
if(!isset($_SESSION['firstcardcode']))
{   // echo 'lala';
}
if((!isset($_SESSION['firstcardcode'])) && (!isset($_SESSION['secondcard_code'])))
{ //echo 'if==ama';
   $_SESSION['total_paypal_cost_item']='';
   $_SESSION['total_paypal_cost_item']=(($d_cost_item*$_SESSION['ship_quantity'])+$_SESSION['service_rate']);
}else
{ $_SESSION['total_paypal_cost_item']='';
  //echo 'else==a';
  $_SESSION['total_paypal_cost_item']=(($_SESSION['show_d_cost_item']*$_SESSION['ship_quantity'])+$_SESSION['service_rate'])- ($_SESSION['reciveramount_1_card']+$_SESSION['reciveramount_2_card']);
   
   // $_SESSION['total_paypal_cost_item']=$d_cost_item;
}

 //echo '<br>';

  //echo 'd-cost-item'.$_SESSION['d_cost_item'];
  //echo '<br>';
//$_SESSION['d_cost_item']=$_SESSION['d_cost_item']*$_SESSION['ship_quantity'];
  //echo '<pre>';
  //print_r($_SESSION);
  //echo  'totalcost-item-'.$_SESSION['d_cost_item'];
 // echo '<br>';
 // echo  'ship_quantity-item-'.$_SESSION['ship_quantity'];
 // echo '<br>';
 // echo  'show_d_cost_item-'.$_SESSION['show_d_cost_item'];
 // echo '<br>';
  //echo  'total_paypal_cost_item-'.$_SESSION['total_paypal_cost_item'];
  //echo '<br>';
  //exit;

//5EiuTpwe68Yh1Hg_2
//echo 'country=='.$_SESSION['country_value'];
//$sitePath = 'http://www.flexsin.org/lab/net_haat/';
//echo "value=service_rate".$_SESSION['service_rate'];
//$paypal_merchant_id = $_REQUEST['paypal_merchant_id'];
//$str_custom=$_SESSION['det_seller_id'].'#|_|#'.$_SESSION['d_item_id'].'#|_|#'.$_SESSION['session_user_id'].'#|_|#';
//$str_custom.=$_SESSION['firstcardcode'].'#|_|#'.$_SESSION['reciveramount_1_card'].'#|_|#'.$_SESSION['reciveramount_2_card'].'#|_|#';
//$str_custom.=$_SESSION['show_d_cost_item'].'#|_|#'.$_SESSION['item_is_haated'].'#|_|#'.$_SESSION['haated_id'].'#|_|#';
//$str_custom.=$_SESSION['secondcard_code'].'#|_|#'.$_SESSION['secondcalculategiftcardvalue'].'#|_|#';
//exit;
			$objItem                      = new Class_Item();					
			$objItem->seller_id	          = $_SESSION['det_seller_id'];
			$objItem->item_id             = $_SESSION['d_item_id'];
			$objItem->buyer_id            = $_SESSION['session_user_id'];
			$objItem->gift_card1	      = $_SESSION['reciveramount_1_card'];
			$objItem->gift_card2	      =	$_SESSION['reciveramount_2_card'];
                        
			$objDBReturn                  = $objItem->insertUpdatepurchaseditem();
		    $last_trans_id 		          = $objDBReturn->nIdentity;
			$str_custom='';
			
                        // code start below to get comission
                        /*

                        $objDBReturn_commision        = $objItem->getcommisioncost();
                        $num_comison_val              = mysql_num_rows($objDBReturn_commision);

                        if($num_comison_val>0)
                        {
                         $arr_fetch_item_comison     = mysql_fetch_assoc($objDBReturn_commision) ;

                         $commsion_cost              = $arr_fetch_item_comison[''];
                            
                        }
                         */
                        // code ends here for comission
                        
        $str_custom = $last_trans_id.'#|_|#'.$_SESSION['firstcardcode'].'#|_|#'.$_SESSION['service_rate'].'#|_|#'.$_SESSION['shipping_address1'].'#|_|#'.$_SESSION['shipping_address2'].'#|_|#';
		$str_custom.= $_SESSION['d_item_id'].'#|_|#'.$_SESSION['session_user_id'].'#|_|#';
        $str_custom.= $_SESSION['dest_zip_code'].'#|_|#'.$_SESSION['city'].'#|_|#'.$_SESSION['ship_quantity'].'#|_|#';
		$str_custom.= $_SESSION['show_d_cost_item'].'#|_|#'.$_SESSION['item_is_haated'].'#|_|#'.$_SESSION['haated_id'].'#|_|#'.$_SESSION['secondcard_code'].'#|_|#'.$_SESSION['reciveramount_1_card'].'#|_|#'.$_SESSION['reciveramount_2_card'].'#|_|#'.$_SESSION['det_seller_id'].'#|_|#'.$_SESSION['country_value'].'#|_|#';
        $str_custom.= $_SESSION['billing_address1'].'#|_|#'.$_SESSION['billing_address2'].'#|_|#'.$_SESSION['bdest_zip_code'].'#|_|#'.$_SESSION['bcity'].'#|_|#'.$_SESSION['bcountry_value'].'#|_|#'.$_SESSION['sess_requested_quantity'].'#|_|#'.$_SESSION['cost_after_discount'];
	
                $objUser 	                = new Class_User();
                $objUser->id         		= $_REQUEST['seller_id'];
                $result_user_sel     		= $objUser->selectUser();
                $num_user_sel        		= mysql_num_rows($result_user_sel);
                if($num_user_sel)
                {
                   $arr_user_values_sel 	       = mysql_fetch_assoc($result_user_sel);
                   $paypal_merchant_id    	       = $arr_user_values_sel['paypal_merchant_id'];
                   $_SESSION['payment_type']       = $payment_type;
                   $_SESSION['paypal_merchant_id'] = $paypal_merchant_id;
                }
                if($paypal_merchant_id=='')
                { 
				//echo 'paypal_merchant_id-qty'.$paypal_merchant_id;
				$sitePath1=$sitePath.'my_account.php';
                failure_msg("Payment details of store are incomplete please try on some other stores.!!");
                     // redirect("pay-item-cost.php");
                echo "<script>window.location='".$sitePath1."'</script>";

                }
				
				 if($_SESSION['ship_quantity']=='' || $_SESSION['ship_quantity']=='0')
                {//	echo 'ship-qty'.$_SESSION['ship_quantity'];
				//echo '<br>';
                     failure_msg("Quantity cannot be blank.!!");
                     // redirect("pay-item-cost.php");
					 $sitePath1=$sitePath.'my_account.php';
					 header("Location :$sitePath1");
                     echo "<script>window.location='".$sitePath1."'</script>";
					 // echo 'ship-qtyvcvcvcvcv';

                }

                //echo $_SESSION['d_cost_item'];
             $total_amount =(trim($_SESSION['total_paypal_cost_item'],'-'));// this is final amount user has to pay on paypal
//exit;
		//$total_amount =(trim($_SESSION['d_cost_item'],'-')*.$_SESSION['sess_requested_quantity'])+$_SESSION['service_rate'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
</head>
<body onload ="document.Pay_order.submit();">
<noscript>Your browser does not support JavaScript!.Please enable javascript on your browser</noscript>
<div>Loading.............</div>
	<form action="<? echo PAYPAL_URL;?>" method="post" name="Pay_order">
	<input type="hidden" name="redirect_cmd" value="_xclick" />
	<input type="hidden" name="cmd" value="_ext-enter" />
	<!--<input type="hidden" name="business" value="<?php echo $_SESSION['paypal_merchant_id'];?>" />-->
	<input type="hidden" name="business" value="<?=$paypal_merchant_id;?>" />
	<input type="hidden" name="amount" value="<?php echo ($total_amount);?>">
	<!--<input type="hidden" name="business" value="pravee_1284618448_biz@seologistics.com" />
	<input type="hidden" name="amount" value="128" />-->		
	<input type="hidden" name="item_name" value="User Registration">
	<input type="hidden" name="no_shipping" value="0" />
       <input type="hidden" name="return" value="<?php echo $sitePath.'my_account.php';?>" />
	<input type="hidden" name="cancel_return" value="<?php echo $sitePath.'api_error1.php';?>" />
	<input type="hidden" name="no_note" value="1" />
	<input type="hidden" name="currency_code" value="USD" />
	<input type="hidden" name="notify_url" value="<?php echo $sitePath.'notify.php';?>" />
	<input type="hidden" name="custom" value="<?php echo $str_custom;?>" />
	<input type="hidden" name="flag" value="yes">
	<!--
        <input type="hidden" value="_xclick" name="cmd" />
	
	<input type="hidden" value="USD" name="currency_code" />
	<input type="hidden" value="business" name="business" />
	<input type="hidden" value="rm" name="2" />
	<input type="hidden" value="invoice" name="invoice" />	
	
	<input type="hidden" value="<?=$sitePath?>pay-fail2.php" name="cancel_return" />
	<input type="hidden" value="<?=$sitePath?>pay-thanks2.php" name="return" />
	<input type="hidden" value="<?=$sitePath?>notify.php" name="notify_url" />
	<input type="text" value="" name="amount" />
        -->
        
   </form>

</body>
</html>
