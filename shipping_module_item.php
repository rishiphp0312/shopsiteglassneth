<?php
include ('include/common.inc');
include ("include/authentiateUserLogin.php");
include ("class/class.category.inc");
include ("class/class.item.inc");
include ('class/class.user.inc');
include ('class/class.shipping.inc');
include ('include/country_state_cat.php');
include ('class/class.package.inc');
     //echo 'item-'.$_GET['item_id_value'];
     
	 $objUser              =   new Class_User();
	 $obj_item             =   new Class_Item();
	 $objCategory          =   new Class_Category;
	 $objShipping          =   new Class_Shipping;
     //create item class object
     $objPackage           =  new Class_Package();
    // code to know whether the items less than 25 or not or expiry date over or not before add any item
	
        $objPackage->seller_id = $_SESSION['session_user_id'];
        $objPackage->status    = 1;
        $result_package        = $objPackage->getPackagedetails();
        $num_rows_pacakage     = mysql_num_rows($result_package);
        $smarty->assign('num_rows_pacakage',$num_rows_pacakage); // if =0
        if($num_rows_pacakage>0)
        {
          $arr_package_details = mysql_fetch_array($result_package);
          $pkg_max_items       = $arr_package_details['max_items'];

        }
        if($num_rows_pacakage>0)
        $smarty->assign('pkg_max_items',$pkg_max_items); // pkg_max_items if pkg active
        else
        $smarty->assign('pkg_max_items',0); // pkg_max_items if pkg active

         // echo '<br>';
         $obj_item->seller_id      =  $_SESSION['session_user_id'];
         $total_items_available    =  $obj_item->select_total_items();
         $num_rows_items_available =  mysql_num_rows($total_items_available);
         $smarty->assign('num_rows_items_available',$num_rows_items_available); // if>25
         if($num_rows_pacakage==0 && $num_rows_items_available>=25)
           {
              failure_msg("Please purchase package to add more itemss!!");
              redirect("purchase_package.php");
           }
          if($pkg_max_items==100)
          $str_pkg_name ="You cannot upload the new items further since your existing Master package allow 100 items space only.To continue uploading new item ,either remove items from my item list to create the space or upgrade to Master pro  from your purchase package module in your account. ";
         if($pkg_max_items==500)
         $str_pkg_name ="You cannot upload the new items further since your existing Pro Master package allows 500 items space only.To continue uploading new item , either remove items from my item list to create the space or contact admin@nethaat.com for further assistance.";

		 if($num_rows_pacakage==1 && $num_rows_items_available>=$pkg_max_items )
		   {
		
			  failure_msg($str_pkg_name);
			 // failure_msg("Please purchase package to add more itemss!!");
			  redirect("purchase_package.php");
		   }

	 
	 $prev_next_id_value   =   $_REQUEST['item_id_value'];
     $smarty->assign("prev_next_id_value",$prev_next_id_value);
         //echo '<pre>';
         //print_r($_SESSION);
	 $item_id_value        = $_REQUEST['item_id_value']; //create business class object
	 $check_by_admin       = $obj_item->get_item_quantity();
	 $num_by_admin         = mysql_num_rows($check_by_admin);
	 if($num_by_admin>0)
		{
	   $arr_by_admin   = mysql_fetch_assoc($check_by_admin);
		}

	 $qty_by_admin                  = $arr_by_admin['quantity_value'];
	 $qty_by_cost                   = $arr_by_admin['cost_item'];
	 $_SESSION['session_cost_item'] = $arr_by_admin['cost_item'];
	 $obj_item->seller_id           = $_SESSION['session_user_id'];
	 $result_ofItems_of_seller      = $obj_item->getNoofItems_perseller();
	 $NoofItems_of_seller           = mysql_num_rows($result_ofItems_of_seller); 
	
	 if($NoofItems_of_seller>0)
	 $arr_no_ofitemsseller          = mysql_fetch_assoc($result_ofItems_of_seller);
     
    
	 $result_ofpaidItems_of_seller1  = $obj_item->getNoofpaidItems_forlisting();
	 $NoofpaidItems_of_seller        = mysql_num_rows($result_ofpaidItems_of_seller1); 
 
       if($_SESSION['session_paid_item']==0 && $arr_no_ofitemsseller['TOTAL_ITEMS'] >= $qty_by_admin && $_REQUEST['item_id_value']=='')
	  {
    	 redirect("pay-item-listing.php");
	  }

     $parentRes = $objCategory->selectSubCatgeory();


//*********************************** By Deepak for adding locker information *******

//***********************************************************************************



//start
if($_SERVER['REQUEST_METHOD']=='POST')
{ 

	extract($_POST);
	
    

	$objShipping->user_id               = $_SESSION['session_user_id'];
	$objShipping->item_value            = $item_id_value;
	$count_array                        = count($country_hid_id);
	
	
	if($error_msg=="")
		{
	    //unit_type
	        $objDBReturn = $objShipping->deleteshipping_options();
	   		for($i=0;$i<$count_array;$i++)
			{
			$objShipping->cost_ship      = $cost_ship[$i];
			$objShipping->country_id  	 = $country_hid_id[$i];
			$objShipping->comment        = rteSafe($comment[$i]);
			$objDBReturn = $objShipping->insertUpdateshipping_options();
			}  
		
			if($objDBReturn->nErrorCode==0)
			{ 
			   if($chk_rest_countries==1)
			    {
				$obj_item->item_value                = $item_id_value;
				$obj_item->allow_rest_country_status = 1;
				$obj_item->ship_allowcost            = $ship_allowcost;
				$obj_item->ship_allowcomment         = rteSafe($ship_allowcomment);
				$obj_item->insertUpdateItem();	
				}else
				{
				$obj_item->item_value                = $item_id_value;
				$obj_item->allow_rest_country_status = 0;
				$obj_item->ship_allowcost            = '';
				$obj_item->ship_allowcomment         = '';
				$obj_item->insertUpdateItem();	
	
				}
				success_msg("Shipping Information added successfully!!");
			}
			else
			{
				$error_msg = "Error occured ...!Please try again";
				failure_msg("Error occured ...!Please try again");
			}
		//redirect("sell-an-item.php");
		
			if($item_id_value=='')
			redirect("shipping_module_item.php");
			else
			redirect("shipping_module_item.php?item_id_value=".$item_id_value);
			
	}
	
	
//end coment
}
$rem_ship_id = $_REQUEST['rem_ship_id'];

if($rem_ship_id!='')
{
	        $objShipping->ship_id      =  $rem_ship_id;
            $odj_image_details_value   =  $objShipping->deleteshipping_options();		
	       	success_msg("Shipping Information deleted successfully!!");
		    if($item_id_value=='')
			redirect("shipping_module_item.php");
		    else
			redirect("shipping_module_item.php?item_id_value=".$item_id_value);

}
//end
// start for fetching data of items cooresponding to item id
if($item_id_value!='')
{
	$objShipping->item_value      =  $item_id_value;
	$odj_image_details_value      =  $objShipping->getshippingOptionsdetails();
	$num_value_details            =  mysql_num_rows($odj_image_details_value);
	if($num_value_details >0)
	{
		while($arr_fetch_item_details   = mysql_fetch_assoc($odj_image_details_value))
		{
		$show_all_options[]    = $arr_fetch_item_details;
		$chk_rest_countries    = $arr_fetch_item_details['allow_rest_country_status'];
		$ship_allowcost        = $arr_fetch_item_details['ship_allowcost'];
		$ship_allowcomment     = $arr_fetch_item_details['ship_allowcomment'];
		}
	   
		//$country_name           = $arr_fetch_item_details['country'];

	}
}
	//echo 'max-'.$max_quantity_db     ;

   $objUser->id            = $_SESSION['session_user_id'];
   $Sellers_location_value = $objUser->selectUser();
   $num_rows_location      = mysql_num_rows($Sellers_location_value); 
   if($num_rows_location>0)
   {
   $arr_Sellers_location   = mysql_fetch_assoc($Sellers_location_value);
   $country_name           = $arr_Sellers_location['country'];
   }
 

	 //$num_value_details=0;
	//$max_item_value
	$smarty->assign("show_all_options",$show_all_options);
	$smarty->assign("chk_rest_countries",$chk_rest_countries);
	$smarty->assign("ship_allowcost",$ship_allowcost);
    $smarty->assign("ship_allowcomment",$ship_allowcomment);
    //show_all_options
	$smarty->assign("num_value_details",$num_value_details);
	$smarty->assign("title_value",$title_value);
	$smarty->assign("category_id_value",$category_id_value);
	$smarty->assign("item_id_value",$item_id_value);
	//$item_id_value
	//end of code
//assign error/update message
$smarty->assign("error_msg",$error_msg);
$smarty->assign("update_msg",$update_msg);

//display template
$smarty->assign('site_page_title','Sell An Item');
$smarty->assign('site_title',$site_title);
$smarty->display('shipping_module_item.tpl');
?>
