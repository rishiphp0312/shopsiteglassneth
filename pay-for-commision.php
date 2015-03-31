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
                        $sitePath=$baseUrl;

                        $objUser 	                = new Class_User();
                        $objUser->admin_user_id         = 1;
                        $result_user_sel     		= $objUser->getAdminUserLoginDetails();
                        $num_user_sel        		= mysql_num_rows($result_user_sel);
                        if($num_user_sel)
                        {
                          $arr_user_values_sel           = mysql_fetch_assoc($result_user_sel);
                          $adm_paypal_merchant_id        = $arr_user_values_sel['paypal_merchant_id'];
                          $_SESSION['paypal_merchant_id']= $adm_paypal_merchant_id;
                        }

                        if($adm_paypal_merchant_id=='')
                        {
                               failure_msg("Error occured ...!Admin Payment details are incomplete try again");
                               redirect("commision_items_listing.php");
                        }
                        
                        
                        $objItem                      = new Class_Item();
                        $objItem->seller_id           = $_SESSION['session_user_id'];
                        $total_item_commision         = $objItem->getTotalCommision_OnSoldItem();
                        $num_total_itemcommision      = mysql_num_rows($total_item_commision);
                        if($num_total_itemcommision>0)
                        {
                           $arr_tot_comm = mysql_fetch_array($total_item_commision);
                           $comma_trans_ids    =   $arr_tot_comm['all_trans_ids'];
                           $total_amt_commison =   $arr_tot_comm['total_amt_commison'];
                        }


		//$total_amount =trim($_SESSION['d_cost_item'],'-')+$_SESSION['service_rate'];
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
	<input type="hidden" name="business" value="<?=$adm_paypal_merchant_id;?>" />
	<input type="hidden" name="amount" value="<?php echo  $total_amt_commison;?>">
	<input type="hidden" name="item_name" value="Pay Total Commision">
	<input type="hidden" name="no_shipping" value="0" />
	<input type="hidden" name="return" value="<?php echo $sitePath.'my_account.php';?>" />
	<input type="hidden" name="cancel_return" value="<?php echo $sitePath.'api_error1.php';?>" />
	<input type="hidden" name="no_note" value="1" />
	<input type="hidden" name="currency_code" value="USD" />
	<input type="hidden" name="notify_url" value="<?php echo $sitePath.'notify-pay-commision.php';?>" />
	<input type="hidden" name="custom" value="<?php echo $comma_trans_ids;?>" />
	<input type="hidden" name="flag" value="yes">


   </form>

</body>
</html>
