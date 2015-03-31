<?php
include ('include/common.inc');
include ('class/class.item.inc');
include ('class/class.user.inc');
include ('class/class.mail.inc');
include ('class/class.shipping.inc');
include ('class/class.category.inc');
//include ('class/category.inc');
include ("include/authentiateUserLogin.php");
include ('include/country_state_cat.php');
session_start();

$_SESSION['page_name'] = basename($_SERVER['PHP_SELF']);

//////////  code to check availability of payment details 
//echo 'lala';
 //echo $_SESSION['d_cost_item'];
$code_accord_country_ip=  getIPAdressInfomation($_SERVER['REMOTE_ADDR']);
$smarty->assign("code_accord_country_ip",$code_accord_country_ip);
//echo '<br>';
$objUser	 	         	    = new Class_User();
$objShipping                    = new Class_Shipping;
$obj_item                       = new Class_Item();


  // code below to check whther item belongs to custom item request or not 
 if($_REQUEST['item_id']!='')
 {
     $obj_item->item_id             =  $_REQUEST['item_id'];
     $obj_item->owner_id            =  $_SESSION['session_user_id'];
     $customitem_details_value      =  $obj_item->check_usercustom_itembuy();
     $num_customitem_details        =  mysql_num_rows($customitem_details_value);
     if($num_customitem_details >0)
	 {
     $arr_customitem_details        =  mysql_fetch_assoc($customitem_details_value);
	 $all_customitem_quantity       =  $arr_customitem_details['quantity_available'];
	 }
	 
     $smarty->assign('num_customitem_details',$num_customitem_details);

 }
 // code ends here


	$objUser->id	         		= $_REQUEST['seller_id'];
	$result_user_sel	     		= $objUser->selectUser();
	$num_user_sel       			= mysql_num_rows($result_user_sel);
	if($num_user_sel)
	{
		$arr_user_values_sel 		= mysql_fetch_assoc($result_user_sel);
		$API_USERNAME	     	    = $arr_user_values_sel['API_USERNAME'];
		$API_PASSWORD	     		= $arr_user_values_sel['API_PASSWORD'];
		$API_SIGNATURE	     		= $arr_user_values_sel['API_SIGNATURE'];
		$Merchant_Id	     		= $arr_user_values_sel['Merchant_Id'];
		$payment_type	     		= $arr_user_values_sel['payment_type'];
		$country_id	     		    = $arr_user_values_sel['country_id'];
		$paypal_merchant_id	        = $arr_user_values_sel['paypal_merchant_id'];
		
		$_SESSION['payment_type']       = $payment_type;
		$_SESSION['API_USERNAME']       = $API_USERNAME;
		$_SESSION['API_PASSWORD']       = $API_PASSWORD;
		$_SESSION['API_SIGNATURE']      = $API_SIGNATURE;
		$_SESSION['Merchant_Id']        = $Merchant_Id;
		$_SESSION['paypal_merchant_id'] = $paypal_merchant_id;
		
		
	}
	
	
	  if($num_customitem_details >0)
	 {
		  $quantity                      = $all_customitem_quantity ;
	 }
	 else{
		 if($_REQUEST['requested_quantity']!='')
		 $quantity = $_REQUEST['requested_quantity'];
	 }
	 $smarty->assign('quantity',$quantity);
	// echo 'quantit--'.$quantity;
	 $_SESSION['det_seller_id'] ;                // seller id
	 $_SESSION['sess_requested_quantity'] = $quantity;
 

 //echo '<pre>';
 //print_r($arr_user_values_sel);
 //echo $API_USERNAME.'user || '.$API_PASSWORD.' passi '.$API_SIGNATURE.' sign&&'.$paypal_merchant_id;

  //// --------------start details----------------/////////
    $objCategory                          = new Class_Category();
    $objCategory->country_id              =  $country_id;
    $resCountry_pay                       =  $objCategory->selectCountry();
    $num_rowsCountry                      =  mysql_num_rows($resCountry_pay);
    if($num_rowsCountry>0)
	{
				$arr_fetch_code           = mysql_fetch_assoc($resCountry_pay);
				$current_code             = $arr_fetch_code['country_iso_code_2'];
	}
	
	//echo 'cur-code='.$current_code;
	//print_r($consCountrycodes);
	//$current_code='CA';
  $value_of_country     = check_country($current_code,$consCountrycodes);
  //exit;
  $smarty->assign('value_of_country',$value_of_country);

// echo 'paypal-'.$paypal_merchant_id.'api-sign'.$API_SIGNATURE.'api-pass'.$API_PASSWORD.'api-user'.$API_USERNAME;
 //exit;
////--------- end details--------------////
//echo 'payment_type='.$payment_type;
//echo '<br>';
//echo 'value_of_country='.$value_of_country;

//if($payment_type==1 && $value_of_country!=1  )
	//if($value_of_country!=1  )
	//{
 	//failure_msg("Shipping Service unavailable in selected country .");
       //redirect("item-details.php?details_item_value=".$_REQUEST['item_id']);
	//}

//if(($payment_type==0 && (($API_USERNAME=='' || $API_PASSWORD=='' || $API_SIGNATURE=='') && $paypal_merchant_id=='')) ||($payment_type==1 && $Merchant_Id=='' ))
   //     if(($API_USERNAME=='' || $API_PASSWORD=='' || $API_SIGNATURE=='') && $paypal_merchant_id=='' )
     //   {
    //echo 'asasas';
	//failure_msg("Service unavailable payment details are incomplete please try on other items.");
        //redirect("item-details.php?details_item_value=".$_REQUEST['item_id']);
	//}


//////////


$_SESSION['d_item_id']  =  $_REQUEST['item_id'];
$actual_costof_item     =  $_SESSION['show_d_cost_item'];
$detect_1_card          =  $actual_costof_item - $_SESSION['reciveramount_1_card'];
$detect_2_card          =  $actual_costof_item - ($_SESSION['reciveramount_1_card']+$_SESSION['reciveramount_2_card']);

$_SESSION['det_seller_id'] = $_REQUEST['seller_id'];            // seller id
$sellers_id                = $_SESSION['det_seller_id'] ;       // seller id
$buyer_id                  = $_SESSION['session_user_id'] ;     // buyer id


$objUser->id               = $_SESSION['session_user_id'];
$result_user               = $objUser->selectUser();
$num_user                  = mysql_num_rows($result_user);
if($num_user)
$arr_user_values           = mysql_fetch_assoc($result_user);

$smarty->assign("country_values_id",$arr_user_values['country_id']);
$smarty->assign("user_values",$arr_user_values);



//create business class object
       
        $obj_item->update_item_id = $_REQUEST['item_id'];
        $result_item	          = $obj_item->getItemImageDetails();
		$num_item                 = mysql_num_rows($result_item);
		if($num_item)
		$arr_item                 = mysql_fetch_assoc($result_item);
		
	

       // for user logged in country code

        $objCountry		          = new Class_Dynamic();
		$objCountry->id		      = $arr_user_values['country_id'];
		$result_country_log	      = $objCountry->selectCountry();
		$num_country_log          = mysql_num_rows($result_country_log);
		if($num_country_log)
		$arr_country_log          = mysql_fetch_assoc($result_country_log);
	
		$smarty->assign("iso_code_loged_user",$arr_country_log['country_iso_code_2']);

	//////// code ends
        
	  
		$objUser->id               = $sellers_id;
		$result_user1              = $objUser->selectUser();
		$num_user1                 = mysql_num_rows($result_user1);
		if($num_user1)
		$arr_user_values1          = mysql_fetch_assoc($result_user1);
		$smarty->assign("country_origin_seller",$arr_user_values1['country_id']);
        $smarty->assign("zipcode_origin_seller",$arr_user_values1['zipcode']);
       
		
	// for seller country code
		
		
		$objCountry->id		           = $arr_user_values1['country_id'];
		$result_country		           = $objCountry->selectCountry();
		$num_country                   = mysql_num_rows($result_country);
		if($num_country)
		$arr_country_sel               = mysql_fetch_assoc($result_country);
	
		$smarty->assign("iso_code",$arr_country_sel['country_iso_code_2']);

        $current_first_date            = date('Y');
	//	echo 'codeorign='.$arr_country_sel['country_iso_code_2'];

/**
 Get required parameters from the web form for the request
 */
if(isset($_POST['submit']))
{
		 //  echo 'sellid=='.$_REQUEST['seller_id'];
		//exit;
       	$item_id 			= $_REQUEST['item_id'];
        $_SESSION['chk_session']        = $_POST['chk_box'];
            if($_POST['chk_box']!=1)
	    {
		$dest_countrycode        = $_POST['scountry_value'];                    // buyer
		$dest_zipcode            = $_POST['szipcode'];                          // buyer
            }else
	    {
		$dest_countrycode        = $_POST['country_value'];                      // buyer
		$dest_zipcode            = $_POST['zipcode'];                            // buyer
            }
        $origin_countrycode      = $arr_country_sel['country_iso_code_2'];       // seller
	 	$origin_zipcode          = $arr_user_values1['zipcode'];                 // seller
	   
	
		//$quantity = urlencode($_REQUEST['requested_quantity']);
		$weight    = $_POST['weight'];
	    $unit_type = $_POST['unit_type'];
						
		if($quantity == '')
		{
		$quantity = 1;
		}
	        //$_SESSION['ship_bill_same']= $_POST['chk_box'];
		if($_POST['chk_box']==1)
		{
		$baddress1 = addslashes($_POST['address1']);
		$baddress2 = addslashes($_POST['address2']);
		$bcity     = addslashes($_POST['city']);
		$bcountry  = urlencode($_POST['country_value']);
		$bzip      = addslashes($_POST['zipcode']);

        $address1 = addslashes($_POST['address1']);
		$address2 = addslashes($_POST['address2']);
		$city     = addslashes($_POST['city']);
		$country  = urlencode($_POST['country_value']);
		$zip      = addslashes($_POST['zipcode']);
        }
		else
		{
        $baddress1 = addslashes($_POST['address1']);
        $baddress2 = addslashes($_POST['address2']);
		$bcity     = addslashes($_POST['city']);
		$bcountry  = urlencode($_POST['country_value']);
		$bzip      = addslashes($_POST['zipcode']);
		$address1 = addslashes($_POST['saddress1']);
		$address2 = addslashes($_POST['saddress2']);
		$city     = addslashes($_POST['scity']);
		$country  = addslashes($_POST['scountry_value']);
		$zip      = addslashes($_POST['szipcode']);
		}
		
		////////// shipping info
		// code starts for  shipping options below 

		if($item_id !='')
		{
		$objShipping->item_value      =  $item_id ;
		$odj_image_details_value      =  $objShipping->getshippingOptionsdetails();
		$num_value_details            =  mysql_num_rows($odj_image_details_value);
		if($num_value_details >0)
		{$counter=0;
		while($arr_fetch_item_details = mysql_fetch_assoc($odj_image_details_value))
		{
		$show_all_country_codes[]     = $arr_fetch_item_details['country_iso_code_2'];
		$show_all_ship_cost[]         = $arr_fetch_item_details['cost_ship'];
		//$show_all_ship_cost[]         = $show_all_ship_cost['ship_allowcost'];
		$ship_allowcomment            = $arr_fetch_item_details['ship_allowcomment'];
		$ship_allowcost               = $arr_fetch_item_details['ship_allowcost'];
		$allow_rest_country_status    = $arr_fetch_item_details['allow_rest_country_status'];
		
		$counter++;
		}	 //   $available_countrys             = implode($show_all_options,',');
			 //   $country_name           = $arr_fetch_item_details['country'];
		}
		}
                
        $_SESSION['shipping_address1']    = trim($address1,'');
		$_SESSION['shipping_address2']    = trim($address2,'');
		$_SESSION['dest_zip_code']        = $zip;
	    $_SESSION['city']                 = $city;
        $_SESSION['country_value']        = $country;
        $_SESSION['billing_address1']     = trim($baddress1,'');
		$_SESSION['billing_address2']     = trim($baddress2,'');
		$_SESSION['bdest_zip_code']       = $bzip;
	    $_SESSION['bcity']                = $bcity;
        $_SESSION['bcountry_value']       = $bcountry;


		$check_shipping_possible = in_array($dest_countrycode,$show_all_country_codes);
		if($check_shipping_possible!=1)
		{
		        if($allow_rest_country_status!=1)
				{	
                failure_msg("Shipping in this country is not allowed !!");
                redirect("shipping_details.php?item_id=".$_REQUEST['item_id']."&seller_id=".$sellers_id ); 
				}
            //     redirect("shipping_details.php?item_id=".$_REQUEST['item_id'] );
        }
        if($check_shipping_possible==1)
		 {
			   for($k=0;$k<$counter;$k++)
			   {
					if($show_all_country_codes[$k]==$dest_countrycode)
					{
					$index_val = $k;
					}
			   }
			   
		      $arr_1	= $show_all_ship_cost[$index_val];
		      $_SESSION['service_rate']  = $arr_1;
         }
		 /// condition below when shippping is not possible 
		if($check_shipping_possible!=1 && $allow_rest_country_status==1)
		{		 
		    $arr_1= $ship_allowcost;
	        $_SESSION['service_rate']= $arr_1;
				
		}
                //$smarty->assign('num_value_details',$num_value_details);
                //$smarty->assign('show_all_options',$show_all_options);
                //end of ship info

                        //  $_SESSION['city']=$city ;

                  // stores the value of shipping whther in internation or domestic $arr_1
            	 //   $quantity = 1;
	   $smarty->assign("error_msg",$error_msg);
	  
	   $_SESSION['ship_quantity'] = $quantity ;
           //$currencyCode=urlencode($_POST['currency']);
	   $currencyCode="USD";
       redirect("buynow.php?item_id=".$_REQUEST['item_id']."&seller_id=".$sellers_id );

}
       

   
   		$smarty->assign("item_id",$_REQUEST['item_id']);
		$smarty->assign("unit_type_val",$arr_item['unit_type']);
		$smarty->assign("weight_val",$arr_item['weight']);

//$arr_item['unit_type'];
//$arr_item['weight'];
$smarty->assign('CURRENCY',CURRENCY);
$smarty->assign('site_page_title',SITE_HOME);
$smarty->assign('site_title',$site_title);
$smarty->display('shipping_details.tpl');
?>