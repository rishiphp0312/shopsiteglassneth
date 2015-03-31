<?php
include ('include/common.inc');
include ("include/authentiateUserLogin.php");
include ('class/class.user.inc');
include ('include/country_state_cat.php');
include ('class/class.category.inc');


$objUser = new Class_User();
$smarty->assign("id",$_GET['itemid']);
$smarty->assign("buyid",$_GET['buyerid']);
$custom_variable = $_GET['itemid'].'#--|--#'.$_GET['buyerid'];
$smarty->assign("custom_variable",$custom_variable);
$smarty->assign("PAYPAL_URL",PAYPAL_URL);


if(isset($_GET['itemid'])&& $_GET['itemid']!="")
{	$objUser->tblid = $_GET['itemid'];
	$smarty->assign("id",$_GET['itemid']);
	$UserRes = $objUser->getcustomitem();
	$UserArr = mysql_fetch_array($UserRes);
//echo '<pre>';
//print_r($UserArr);

//////////  code to check availability of payment details 

$objUser	 	         		= new Class_User();
$objUser->id	         		= $UserArr['seller_id'];
$result_user_sel	     		= $objUser->selectUser();
$num_user_sel       			= mysql_num_rows($result_user_sel);
if($num_user_sel)
{
	$arr_user_values_sel 		= mysql_fetch_assoc($result_user_sel);
        $API_USERNAME	     		= $arr_user_values_sel['API_USERNAME'];
	$API_PASSWORD	     		= $arr_user_values_sel['API_PASSWORD'];
	$API_SIGNATURE	     		= $arr_user_values_sel['API_SIGNATURE'];
	$Merchant_Id	     		= $arr_user_values_sel['Merchant_Id'];
	$payment_type	     		= $arr_user_values_sel['payment_type'];
	$country_id	     		= $arr_user_values_sel['country_id'];
	$paypal_merchant_id	     	= $arr_user_values_sel['paypal_merchant_id'];
	
	$_SESSION['payment_type']       = $payment_type;
	$_SESSION['API_USERNAME']       = $API_USERNAME;
	$_SESSION['API_PASSWORD']       = $API_PASSWORD;
	$_SESSION['API_SIGNATURE']      = $API_SIGNATURE;
	$_SESSION['Merchant_Id']        = $Merchant_Id;
	$_SESSION['paypal_merchant_id'] = $paypal_merchant_id;
	
}

//// --------------start details----------------/////////
    $objCategory 		          = new Class_Category();
    $objCategory->country_id              =  $country_id;
    $resCountry_pay                       =  $objCategory->selectCountry();
	$num_rowsCountry                  =  mysql_num_rows($resCountry_pay);
	if($num_rowsCountry>0)
	{
		$arr_fetch_code           = mysql_fetch_assoc($resCountry_pay);
		$current_code             = $arr_fetch_code['country_iso_code_2'];
	}
	
	//echo 'cur-code='.$current_code;
	//print_r($consCountrycodes);
	//$current_code='CA';
    $value_of_country     = check_country($current_code,$consCountrycodes);
    $smarty->assign('value_of_country',$value_of_country);
    $smarty->assign('paypal_merchant_id',$paypal_merchant_id);


////--------- end details--------------////
//echo 'payment_type='.$payment_type;
//echo '<br>';
//echo 'value_of_country='.$value_of_country;

if($payment_type==1 && $value_of_country!=1  )
	{	
	//failure_msg("Service unavailable payment details are incomplete please try on other items.");
   //redirect("buyer_custom_request.php");
	}

if(($payment_type==0 && ($API_USERNAME=='' || $API_PASSWORD=='' || $API_SIGNATURE=='')&& $paypal_merchant_id=='') ||($payment_type==1 && $Merchant_Id==''))
	{	
//	failure_msg("Service unavailable payment details are incomplete please try on other items.");
   //redirect("buyer_custom_request.php");
	}


//////////


        $smarty->assign("sellerid",$UserArr['seller_id']);
	//$smarty->assign("sellerid",$UserArr['id']);
	$smarty->assign("f_name",$UserArr['firstname']);
 	$smarty->assign("l_name",$UserArr['lastname']);
	$smarty->assign("username",$UserArr['username']);
 	$smarty->assign("title",$UserArr['title']);
	$smarty->assign("cust_quantity",$UserArr['quantity']);
	$smarty->assign("price",$UserArr['price']);
	$smarty->assign("advancepersantage",$UserArr['advancepersantage']);
	$adAmount=(($UserArr['price']*$UserArr['advancepersantage'])/100);
	$smarty->assign("adAmount",$adAmount);
}
$smarty->assign('CURRENCY',CURRENCY);
$smarty->assign('site_page_title','Nethaat : Advance Agreement');
$smarty->assign('site_title',$site_title);
$smarty->display('advance_aggrement.tpl');



?>