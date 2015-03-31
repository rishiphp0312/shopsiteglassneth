<?php
include ('include/common.inc');
include ('class/class.item.inc');
include ('class/class.user.inc');
include ('class/class.mail.inc');
include ("include/authentiateUserLogin.php");
include ('include/country_state_cat.php');
session_start();

$_SESSION['d_item_id']  =  $_GET['itemid'];
/*
$actual_costof_item     = $_SESSION['show_d_cost_item'];
$detect_1_card          = $actual_costof_item - $_SESSION['reciveramount_1_card'];
$detect_2_card          = $actual_costof_item - ($_SESSION['reciveramount_1_card']+$_SESSION['reciveramount_2_card']);
*/

//$_SESSION['det_seller_id'] = $_GET['seller_id'];            // seller id
//$sellers_id                = $_SESSION['det_seller_id'] ;   // seller id
$buyer_id                  = $_SESSION['session_user_id'] ; // buyer id

$objUser 	               = new Class_User();
$objUser->id               = $_SESSION['session_user_id'];
$result_user               = $objUser->selectUser();
$num_user                  = mysql_num_rows($result_user);
if($num_user)
$arr_user_values           = mysql_fetch_assoc($result_user);

$smarty->assign("country_values_id",$arr_user_values['country_id']);
$smarty->assign("user_values",$arr_user_values);

//create business class object
        
		$obj_item                 = new Class_Item();
        $obj_item->update_item_id = $_GET['itemid'];
        $result_item	          = $obj_item->getItemImageDetails();
		$num_item                 = mysql_num_rows($result_item);
	    if($num_item)
		$arr_item                 = mysql_fetch_assoc($result_item);

        // for user logged in country code

        $objCountry			      = new Class_Dynamic();
		$objCountry->id		      = $arr_user_values['country_id'];
		$result_country_log		  = $objCountry->selectCountry();
		$num_country_log          = mysql_num_rows($result_country_log);
	    if($num_country_log)
		$arr_country_log          = mysql_fetch_assoc($result_country_log);
		$smarty->assign("iso_code_loged_user",$arr_country_log['country_iso_code_2']);

		//////// code ends
          
		$objUser->id               = $arr_item['seller_id'];
		$result_user1              = $objUser->selectUser();
		$num_user1                 = mysql_num_rows($result_user1);
		if($num_user1)
		$arr_user_values1          = mysql_fetch_assoc($result_user1);
		$smarty->assign("country_origin_seller",$arr_user_values1['country_id']);
        $smarty->assign("zipcode_origin_seller",$arr_user_values1['zipcode']);
       
		
		// for seller country code
		
		
		$objCountry->id		       = $arr_user_values1['country_id'];
		$result_country		       = $objCountry->selectCountry();
		$num_country               = mysql_num_rows($result_country);
	    if($num_country)
		$arr_country_sel           = mysql_fetch_assoc($result_country);

		$smarty->assign("iso_code",$arr_country_sel['country_iso_code_2']);

        $current_first_date        = date('Y');
		
	//	echo 'codeorign='.$arr_country_sel['country_iso_code_2'];

/**
 Get required parameters from the web form for the request
 */
if(isset($_POST['submit']))
{

        $_SESSION['chk_session'] =$_POST['chk_box'];
        if($_POST['chk_box']!=1)
	    {
		$dest_countrycode        = $_POST['scountry_value'];                    // buyer
		$dest_zipcode            = $_POST['szipcode'];                          // buyer
        }
        else
	    {
		$dest_countrycode        = $_POST['country_value'];                      // buyer
		$dest_zipcode            = $_POST['zipcode'];                            // buyer
        }
        $origin_countrycode      = $arr_country_sel['country_iso_code_2'];       // seller
	 	$origin_zipcode          = $arr_user_values1['zipcode'];                 // seller
	   
	
		$quantity = urlencode($_POST['Quantity']);
		$weight    = $_POST['weight'];
	    $unit_type = $_POST['unit_type'];
						
		if($quantity == '')
		{
		$quantity = 1;
		}
	
		if($_POST['chk_box']==1)
		{
		$address1 = addslashes($_POST['address1']);
		$address2 = addslashes($_POST['address2']);
		$city     = addslashes($_POST['city']);
		$country  = urlencode($_POST['country_value']);
		$zip      = addslashes($_POST['zipcode']);
		}
		else
		{
		$address1 = addslashes($_POST['saddress1']);
		$address2 = addslashes($_POST['saddress2']);
		$city     = addslashes($_POST['scity']);
		$country  = addslashes($_POST['scountry_value']);
		$zip      = addslashes($_POST['szipcode']);
		}
	
        $_SESSION['shipping_address1']   = trim($address1,'');       
		$_SESSION['shipping_address2']   = trim($address2,'');       
		$_SESSION['dest_zip_code']       = $zip  ;
	    $_SESSION['city']=$city ; 
		//  $_SESSION['city']=$city ;
		
	  // stores the value of shipping whther in internation or domestic $arr_1 
	   $quantity = 1;
      //  echo 'origin_countrycode=='.$origin_countrycode.'--dest_countrycode'.$dest_countrycode;
	//	exit;
		if($origin_countrycode == $dest_countrycode )
		$arr_1                  = $arr_item['domestic_ship_rate']; 

		if($arr_item['allow_international']==1 && $origin_countrycode!= $dest_countrycode)
		$arr_1                  = $arr_item['international_ship_rate']; 
	  
	   if($arr_item['allow_international']==0 && $origin_countrycode!= $dest_countrycode)
	    {
		   //$error_msg="International shipping is not allowed !!";
		   	success_msg("International shipping is not allowed !!");
	        redirect("custom-item-shipping.php?itemid=".$_GET['itemid']."&buyerid=".$_GET['buyerid']);
	     }
	
	  
	    $smarty->assign("error_msg",$error_msg);
	
	   $_SESSION['service_rate'] = $arr_1*$quantity;
	   $_SESSION['ship_quantity'] = $quantity ;
     //$currencyCode=urlencode($_POST['currency']);
	   $currencyCode="USD";
  
       redirect("advance_agreement.php?itemid=".$_GET['itemid']."&buyerid=".$_GET['buyerid']);

}
       

   
		$smarty->assign("unit_type_val",$arr_item['unit_type']);
		$smarty->assign("weight_val",$arr_item['weight']);

//$arr_item['unit_type'];
//$arr_item['weight'];
$smarty->assign('CURRENCY',CURRENCY);
$smarty->assign('site_page_title',SITE_HOME);
$smarty->assign('site_title',$site_title);
$smarty->display('custom-item-shipping.tpl');
?>