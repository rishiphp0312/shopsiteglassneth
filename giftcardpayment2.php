<?php
//***********************************************************/
include ('include/common.inc');
include ('class/class.item.inc');
include ('class/class.user.inc');
include ('class/class.mail.inc');
include ('include/country_state_cat.php');
include ('include/sendEmailClass.php');
session_start();
//echo 'seller=='.$_GET['custom'];
    $objUser 	                = new Class_User();
    $objUser->id         		= $_REQUEST['seller_id'];
	$result_user_sel     		= $objUser->selectUser();
	$num_user_sel        		= mysql_num_rows($result_user_sel);
	if($num_user_sel)
	{
		$arr_user_values_sel 		= mysql_fetch_assoc($result_user_sel);
		$API_USERNAME	     		= $arr_user_values_sel['API_USERNAME'];
		$API_PASSWORD	     		= $arr_user_values_sel['API_PASSWORD'];
		$API_SIGNATURE	     		= $arr_user_values_sel['API_SIGNATURE'];
		$payment_type	     		= $arr_user_values_sel['payment_type'];
		$paypal_merchant_id    		= $arr_user_values_sel['paypal_merchant_id'];
		$_SESSION['payment_type']   = $payment_type;
		$_SESSION['API_USERNAME']   = $API_USERNAME;
		$_SESSION['API_PASSWORD']   = $API_PASSWORD;
		$_SESSION['API_SIGNATURE']  = $API_SIGNATURE;
		$_SESSION['Merchant_Id']    = $Merchant_Id;
		$_SESSION['paypal_merchant_id']    = $paypal_merchant_id;
	}
//$objUser->id         		= $_SESSION['det_seller_id'];
    //exit;
	
?>
<script>
document.frm_pay2.submit();
</script>
<body onLoad="document.frm_pay2.submit();">
<?
?>
<form action="<? echo PAYPAL_URL;?>" method="post" name="frm_pay2">
<input type="hidden" name="redirect_cmd" value="_xclick" />
<input type="hidden" name="cmd" value="_ext-enter" />
<input type="hidden" name="business" value="<?=$paypal_merchant_id;?>" />
<input type="hidden" name="amount" id='amount'	value="<?=$_REQUEST['amount'];?> class="formInput required alph_num">
					<!--<input type="hidden" name="business" value="pravee_1284618448_biz@seologistics.com" />
				<input type="hidden" name="amount" value="128" />-->
				
					<input type="hidden" name="item_name" value="User Registration">
					<input type="hidden" name="no_shipping" value="0" />
	
					<input type="hidden" name="return" value="<?=$baseURL?>my_account.php" />
	<input type="hidden" name="cancel_return" value="<?=$baseURL?>paypal-gift-failed.php" />
					<input type="hidden" name="no_note" value="1" />
					<input type="hidden" name="currency_code" value="USD" />
		<input type="hidden" name="notify_url" value="<?=$baseURL?>notify_gift.php" />
				
     <input type="hidden" name="custom" id='custom' value="<?=$_REQUEST['custom'];?>" />
					<input type="hidden" name="flag" value="yes">
</form>
</body>