<?php
include ('include/common.inc');
include ('class/class.user.inc');
include ('class/class.item.inc');
include ('class/class.coupon.inc');
include_once('currency_class.php');
include ('class/class.mail.inc');
include ('include/sendEmailClass.php');
include ('class/class.shipping.inc');
include ('include/country_state_cat.php');


// Get list of currencies
$c = new JOJO_Currency_yahoo();
$list = $c->getCurrencies();

$amount = "";
$total = "";
$emailObj 	= new SendEmailClass;
// Check any submitions
/*
 if($_SESSION['session_user_type'] == 3 )
 {
  failure_msg("You must login as buyer!!");
  redirect("my_account.php");
 }
*/


if(isset($_GET['N']) && $_GET['N'] != NULL)
{
	// Amount to convert
	$amount = (int)$_GET['N'];
	
	// From
    $from = '';
	$from_text = '';
	if(isset($_GET['F']))
	{
		$from = $_GET['F'];
		$from_text = $list[$from];
	}
	else
	{
		$from = "USD";
		$from_text = $list[$from];
	}
	
	// To
	$to = '';
	$to_text = '';
	if(isset($_GET['T']))
	{
		$to = $_GET['T'];
		$to_text = $list[$to];
	}
	else
	{
		$to = "EUR";
		$to_text = $list[$to];
	}
	
	// Get rate
	$rate = $c->getRate($from,$to, true);
	
	// Total price (to 2 decemial points)
	$total = number_format(($rate*$amount),2);
	$_SESSION['Exchange_rate'] = $rate;
	$_SESSION['from_text']     = $from_text;
	$_SESSION['to_text']       = $to_text;
	$_SESSION['total']         = $total;
	$_SESSION['amount']        = $_GET['N'];
}

 $details_item_value           =  $_REQUEST['details_item_value'];
 $chk_coupon                   =  $_REQUEST['d'];             

 $objItem                      = new Class_Item();
 $objItem1                     = new Class_Item();
 $objUser                      = new Class_User();
 $objCoupon                    = new Class_Coupon();
 $objShipping                  = new Class_Shipping;


//////////========================//////////////
// fetching sellers id
// sellers info starts
	    //$objUser->id               = $arr_items_array['seller_id'];
		  $item_values_list             =  array();
    	 
		  $objItem1->update_item_id      =  $details_item_value;
	      //$objItem->seller_id         =  $_SESSION['session_user_id'];
		  $objItem1->approve_store       =  '';
		  $objItem1->locker_status       =  '';
		  $objItem1->inventory_check     =  '';
		  $objItem1->status              =  '';
		  $objItem1->recent_status       =  '';
		  $objItem1->delete_restored     =  '';
			
	      $image_details_item_sell_info  =  $objItem1->getItemImageDetails();
      	  $num_rows_items_sell_info      =  mysql_num_rows($image_details_item_sell_info);
          if($num_rows_items_sell_info >0)
		   {
			$arr_items_array_sell_info  = mysql_fetch_array($image_details_item_sell_info);
			$seller_info_id             = $arr_items_array_sell_info['seller_id'];
			   //$item_mail_title = ucfirst($arr_items_array['title']);
    	   }
//echo 'sell-info-id'.$seller_info_id;


/// end of code

	// code starts for  shipping options below 
	
	 if($details_item_value!='')
	{
		$objShipping->item_value      =  $details_item_value;
		$odj_image_details_value      =  $objShipping->getshippingOptionsdetails();
		$num_value_details            =  mysql_num_rows($odj_image_details_value);
		if($num_value_details >0)
		{
			while($arr_fetch_item_details   = mysql_fetch_assoc($odj_image_details_value))
			{
			$show_all_options[]             = $arr_fetch_item_details;
			}
		 //   $available_countrys             = implode($show_all_options,',');
			//$country_name           = $arr_fetch_item_details['country'];
	
		}
	}
	$smarty->assign('num_value_details',$num_value_details);
	$smarty->assign('show_all_options',$show_all_options);
	
	//echo 'sdsd'.$available_countrys;

///////////======================///////////////////
	 
	 //////////start 
	$objItem->recent_status    = 2;
	$objItem->inventory_check  = 1;
	$objItem->approve_store    = 1;
	$objItem->locker_status    = 0; 
	$objItem->delete_restored  = 0;  // 0 for showing restored 1 means deleted by admin
	
	////////////----end
 
	  ///--checking whether its been gone for approval previously or not
	 $objItem->item_id              = $_REQUEST['details_item_value'];
	 $objItem->buyer_id             = $_SESSION['session_user_id'];
	 $existing_haating_item         = $objItem->getItem_Detailsfourtimes();
	 $num_existing_haating          = mysql_num_rows($existing_haating_item);
	  
	
	
	 ////////---end of code 
	 
	 if($_POST['coupon_code']!='')
	 $objCoupon->coupon_code       = $_POST['coupon_code'];
	 $objCoupon->item_id           = $details_item_value;
	 
	 
	 if($details_item_value!='' &&  $_POST['Apply'])
	 {
		 $result_coupon_exsist         = $objCoupon->getCouponDetails_expiredornot();
		 $num_coupon_expiry            = mysql_num_rows($result_coupon_exsist);
		 if($num_coupon_expiry>0)
						  {
			  $arr_num_coupon_details       = mysql_fetch_assoc($result_coupon_exsist);
			  $dicount_type                 = $arr_num_coupon_details['discount_type'];
			  $discount_amount 	            = $arr_num_coupon_details['discount_amount'];
						  }
		else              {
									if($_POST['coupon_code']!='')
									{
			  failure_msg("Error occured ...!this coupon  code is not valid!!");
			  redirect("item-details.php?details_item_value=".$_REQUEST['details_item_value'].'&d=1');
									}
						  }
			  
	  }
	  
	  
	  $objCoupon->item_id            = $details_item_value;
	  $result_coupon_exsist1         = $objCoupon->getCouponDetails_expiredornot();
	  $num_coupon_expiry1            = mysql_num_rows($result_coupon_exsist1);
	  if($num_coupon_expiry1>0)
	  $smarty->assign('coupon_d_not_posted',$chk_coupon);
	  
	  if($num_coupon_expiry>0 && $_POST['coupon_code']!='' && $chk_coupon==1)
		  {
					$smarty->assign('coupon_d',$chk_coupon);
					$smarty->assign('result_coupon_exsist',$num_coupon_expiry);
		  }
	

  
  if(count($_SESSION['inc_val123'])>0)
  //  $chkexsisting_ids             =            @in_array($_REQUEST['details_item_value'],$_SESSION['inc_val123']);
  
	 
 	 
 	$add_to_shop_item_id    =  $_REQUEST['add_to_shop'];
    if($add_to_shop_item_id!='')
		{
			  $objItem->buyer_id          = $_SESSION['session_user_id'];
			  $objItem->shop_id           = $add_to_shop_item_id;

			  $num_selectUser             = $objItem->favorite_shops();
			  $num_result_user            = mysql_num_rows($num_selectUser);
		
			  if($num_result_user>0)
			  {
	    	      failure_msg("Error occured this shop is already in favourite list");
		       }
			 else
			   {
				  $objItem->buyer_id     = $_SESSION['session_user_id'];
				  $objItem->shop_id      = $add_to_shop_item_id;
				  $Num_objUser           = $objItem->add_favorite_shops();
				  success_msg("Shop  has been added to yours favourite list !!");
			   }
			      redirect("item-details.php?details_item_value=$details_item_value");

		}




	if(isset($_GET['favorite_details_item_value'])!="")
    {
		$objItem->user_id                 = $_SESSION['session_user_id'];
        $objItem->item_id                 = $_REQUEST['favorite_details_item_value'];
		$RecordSet 						  = $objItem->getfavorite();
		$row                              = mysql_num_rows($RecordSet);
		if($row==0)
		   {
				$objDBReturn = $objItem->insertUpdatefavorite();
				
				if($objDBReturn->nIdentity && $objDBReturn->nErrorCode==0)
				{
	
					success_msg("Your request for custom item has been successfull");
					header("Location:item-details.php?details_item_value=$objItem->item_id ");
				}
				else
				{
					failure_msg("Error occured ...!item already in your favorite list");
					
				}
		    }
		  else
		    { 
		    		failure_msg("Error occured ...! Item already in favorite list)");
			    	header("Location:item-details.php?details_item_value=$objItem->item_id ");
		    }
		
			$smarty->assign('error_msg',$error_msg);
	    
			if($_SESSION['item_det_msg']!='')
			 {
				$smarty->assign('item_det_msg',$_SESSION['item_det_msg']);
				$_SESSION['item_det_msg']='';
			 }

  }
    
          //create Item class object

	  $item_values_list             =  array();
    	  $objItem->update_item_id      =  $details_item_value;
	      //$objItem->seller_id         =  $_SESSION['session_user_id'];
		 // $objItem->approve_store       =  '';
	  $image_details_item           =  $objItem->getItemImageDetails();
      	  $num_rows_items               =  mysql_num_rows($image_details_item);
          if($num_rows_items>0)
		   {
			   $arr_items_array = mysql_fetch_array($image_details_item);
			   $item_mail_title = ucfirst($arr_items_array['title']);
    	   }
		 // echo '<pre>';
		 // print_r($arr_items_array);
		//  echo '</pre>';
		  $discount_amount              = $arr_num_coupon_details['discount_amount'];
		  $dicount_type                 = $arr_num_coupon_details['discount_type'];
		  if($dicount_type==0) //%
		   {			 
		      $str_amount               = ($discount_amount*$arr_items_array['cost_item'])/100;
		      $str_amount_final         = (float)$arr_items_array['cost_item']-(float)round($str_amount,2)  ;
		   }
		  else      // $
		   {
		      $str_amount_final         = (float)$arr_items_array['cost_item']-(float)$discount_amount;
    	           }

		   if($num_coupon_expiry>0 && $_REQUEST['d']==1)
                    {
			   $_SESSION['d_cost_item']          =    round($str_amount_final,2);
			   $_SESSION['show_d_cost_item']     =    round($str_amount_final,2);
                     }
		   else
		   { 
		    	   $_SESSION['d_cost_item']         =   $arr_items_array['cost_item'];
			   $_SESSION['show_d_cost_item']    =    $arr_items_array['cost_item'];
		   }
	
             ////////////////code or bid post
            $_SESSION['d_item_id']               =  $_REQUEST['details_item_value']; // item id
            $smarty->assign("str_amount_final",round($str_amount_final,2)); 
            $smarty->assign("str_amount_final",round($str_amount_final,2)); 
			/*if($_REQUEST['details_item_value']!='')
			{
			$objItem->item_id                 = $_REQUEST['details_item_value'];		
			$image_details_item1              = $objItem->getItemImageDetails();
            $num_img_details_item1            = mysql_num_rows($image_details_item1); 
				 if($num_img_details_item1>0)
				 {
				 $arr_fetch_mail_item         = mysql_fetch_assoc($image_details_item1);
				 $item_mail_title             = ucfirst($arr_fetch_mail_item['title']);
				 }
			 }*/
		if($_REQUEST['details_item_value']!='')
		{
				$objItem->bid_status              = 1;
				$objItem->user_id                 = $_SESSION['session_user_id'];
				$objItem->item_id                 = $_REQUEST['details_item_value'];		
				$result_bid_details               = $objItem->getBIDdetails();
				$num_bid_details                  = mysql_num_rows($result_bid_details ); 
				if($num_bid_details)
				$arr_bid_details                  = mysql_fetch_assoc($result_bid_details);
				$smarty->assign("users_biditems_details", $arr_bid_details); 
				$smarty->assign("users_biditems_details_status",$num_bid_details); 
		}
         // start of code to display styles
		 $style_ids                             = explode(",",$arr_items_array['item_id_concat']);
		$all_style_names='';
		for($sty_i=0;$sty_i<count($style_ids);$sty_i++)
		{
		$objUser->style_id                      = $style_ids[$sty_i];
		$styl_details                           = $objUser->getStylelisting();
		$reslt_style_name                       = mysql_fetch_array($styl_details);
		$all_style_names                       .= $reslt_style_name['set_style'].' , ';          
		 }
		
		$conct_all_styles= substr($all_style_names,0,-2);
		$smarty->assign('all_style_names',$conct_all_styles);
		//end of  code to display styles
///////




	








// $objItem->update_item_id    = $details_item_value;

			 if($_SESSION['count_var']==2 &&  $chkexsisting_ids!=1 )
			 {
				 $_SESSION['count_var']='';
			
			 }
		
//////// strt of counter
			if($_SESSION['count_var']=='')
			{
			$_SESSION['prod_var_id']    = $details_item_value;
			//counter_view	
			$objItem->counter_value     = $arr_items_array['counter_view']+1; 
			$objItem->update_item_id    = $details_item_value;
			// $objItem->seller_id      = $_SESSION['session_user_id'];
			$image_update_counter       = $objItem->insertUpdateImage();
			$_SESSION['count_var']=2;
			}
		//echo 'conter-'.$_SESSION['count_var']='';
	
		$smarty->assign("users_items_details", $arr_items_array);
			/// END OF CODE
        
		// code for rating
		
		$objUser->logged_user_id      = $seller_info_id ;     // seller id
		//$objUser->logged_user_id      = $arr_items_array['seller_id'];     // seller id
		$detailsOfUserfeedback        = $objUser->getdetailsOfUsertotalfeedback();
		$num_OfUserfeedback           = mysql_num_rows($detailsOfUserfeedback) ;
		if($num_OfUserfeedback>0)
		{
		$arr_Userfeedback = mysql_fetch_assoc($detailsOfUserfeedback);
		}
		$total_value_Userfeedback     =  $arr_Userfeedback['total'];
         
		$detailsOfUserpostivefeedback = $objUser->getdetailsOfUserpostivefeedback();
		$num_OfUserpostivefeedback    = mysql_num_rows($detailsOfUserpostivefeedback) ;
		if($num_OfUserfeedback>0)
		{
		$arr_Userpostivefeedback      = mysql_fetch_assoc($detailsOfUserpostivefeedback);
		}
		$total_Userpostivefeedback    = $arr_Userpostivefeedback['total'];
		
		 if($total_Userpostivefeedback!=0)
		 $find_percentage   = ($total_Userpostivefeedback/$total_value_Userfeedback)*100;
		
		 if($find_percentage==0 || $find_percentage=='' || $total_Userpostivefeedback==0)
		 $find_percentage==0; 
		 else
		 $find_percentage   =  round($find_percentage,2);
		 
		 $smarty->assign("find_percentage", $find_percentage);	 
			 
         //end of rating code
		 
		 
				  //echo '<pre>';
		 // print_r($arr_items_array);
		 // echo '</pre>';
		
		
		//echo 'sellr-id=='.$objUser->id               = $arr_items_array['seller_id'];
		$_SESSION['det_seller_id'] = $seller_info_id;
		$objUser->id               = $seller_info_id;
		$smarty->assign("sellerid",$seller_info_id);
		if($objUser->id!='')
	    $result_user              = $objUser->selectUser();
		$num_user                 =  mysql_num_rows($result_user);
		if($num_user>0)
		{
		$arr_fetch_asoc_user_info = mysql_fetch_assoc($result_user);
		$store_status             = $arr_fetch_asoc_user_info['approve_store']; // check whther store approved or disapproved
		$v_store_image            = $arr_fetch_asoc_user_info['v_store_image']; // store image
		$seller_email_id          = $arr_fetch_asoc_user_info['email'];         // store image
		$seller_name              = $arr_fetch_asoc_user_info['first_name'].''.$arr_fetch_asoc_user_info['last_name']; 
		$objItem->seller_id       = $arr_fetch_asoc_user_info['id'];
		
		// store seller_email_id		
		//$seller_email_id          = $arr_fetch_asoc_user_info['email'];        // store seller_email_id			
		
		}
		
		
		//echo 'store_status=='.$store_status;
	        $smarty->assign("details_of_store_status",$store_status);
	    
		$objItem->item_value                =  $details_item_value;
		$sellers_other_products             =  $objItem->getNoOfItems();
		$sellers_number_of_items            =  mysql_num_rows($sellers_other_products);
		if($sellers_number_of_items>0)
		$arr_fetch_asoc_number_of_items     =  mysql_fetch_assoc($sellers_other_products);
		//   $sellers_image1[]              =  $arr_fetch_asoc_number_of_items['image1'];
		$number_items_sellers               =  $arr_fetch_asoc_number_of_items['number_items'];
		    	  
	        $objItem->seller_id        =   $seller_info_id;
	         //$objItem->seller_id     =  $arr_items_array['seller_id'];
	        $objItem->item_id          =  $_REQUEST['details_item_value'];
      	        $sellers_other_products1   = $objItem->getNoOfItemswithImagesforpartcularseller();
		$sellers_number_of_items1  =  mysql_num_rows($sellers_other_products1);
		if($sellers_number_of_items1>0)
		{
	while($arr_fetch_asoc_number_of_items1  = mysql_fetch_assoc($sellers_other_products1))
				{					
		$sellers_imageid_withotheritems[]  =  $arr_fetch_asoc_number_of_items1;
				}
		}
		// code for logged user as buyer
		//if($objUser->id!='')
		
		// code for looged user as buyer
			// if($dicount_type==0)
		if($_POST['bid_submit']=='Post-Bid') //for bid submit in haating case
		 {
		$objUser->id              = $_SESSION['session_user_id'];
	    $result_user_buyer        = $objUser->selectUser();
		$num_user_buyer           = mysql_num_rows($result_user_buyer);
		if($num_user_buyer>0)
		{
		$arr_user_buyerinfo = mysql_fetch_assoc($result_user_buyer);
		$buyer_name         = $arr_user_buyerinfo['first_name'].''.$arr_user_buyerinfo['last_name'];
		$buyer_email        = $arr_user_buyerinfo['email'];
		
		}
     
		//email notification on last bid posted by buyer send to seller
		$objMail 	                              =  new Class_Mail();
		$objMail->mail_title	                      =  "Email Template";
		$MailTemplate			              =  $objMail->selectMailTemplate();
		$templateRowArr 		              =  mysql_fetch_array($MailTemplate);
		$mail_content			              =  $templateRowArr['mail_content'];
		$mail_content			              =  str_replace("#link#",$baseUrl,$mail_content);
		
		$objMail->mail_title	                      =  "Haating_last";
		$MailTemplate			              =  $objMail->selectMailTemplate();
		$templateRowArr 		              =  mysql_fetch_array($MailTemplate);
		$mail_content1			              =  $templateRowArr['mail_content'];
			
	   //$recivers_name                      =  $arr_fetch_users_details['name'] ;
	   
		$mail_content			              =  str_replace("#message_content#",$mail_content1,$mail_content);
		$mail_content			              =  str_replace("#link#",$baseUrl,$mail_content);	
		
	
	

/// end of email notification



    	       // code for bidlimit of user starts
	        $objItem->item_id              =  $_REQUEST['details_item_value'];
	        $get_haat_max_min_value        =  $objItem->gethat_max_minvalue();
		$num_rows_haat_max_min_value   =  mysql_num_rows($get_haat_max_min_value);
		  
		       if($num_rows_haat_max_min_value>0)
			{
			 $arr_fetch_max_min_value    = mysql_fetch_assoc($get_haat_max_min_value);
			}

                        $getBIDLIMIT_value             =  $objItem->getBIDlimit();
                        $num_rows_BIDLIMIT_value       =  mysql_num_rows($getBIDLIMIT_value);
		        if($num_rows_BIDLIMIT_value>0)
			{
			  $arr_fetch_BIDLIMIT        = mysql_fetch_assoc($getBIDLIMIT_value);
			}

          
			if($arr_fetch_BIDLIMIT['number_bids']< 3 && $num_existing_haating ==0)
			{
			$objItem->user_id          =  $_SESSION['session_user_id'];
			$objItem->bid_value        =  $_POST['bid_value'];
			$objItem->item_value       =  $_REQUEST['details_item_value'];
			$result                    =  $objItem->insertBID_Hatingitems();
			
			if(($_POST['bid_value'] >= $arr_fetch_max_min_value['hat_min_value']) && ($_POST['bid_value']<=$arr_fetch_max_min_value['hat_max_value']))
					 {
						$_SESSION['d_cost_item']        =   $_POST['bid_value']; // amount to take it for credit card page
						$objItem->last_id				=	$_SESSION['hat_id_last_id'];
						$objItem->changeBID_StatusHatingitems('1');
						success_msg("Congatulations you can buy this product !!");
						redirect("buyer-haated-items.php");
					}else
					{
						if($arr_fetch_BIDLIMIT['number_bids']< 2)
						$_SESSION['item_det_msg']="Its low a price,look at the product every thing is handcrafted.Please offer your genuine price.!!  "."<a href='bid_history.php'>View bid History</a>";
						if($arr_fetch_BIDLIMIT['number_bids']==2)
			    		 $_SESSION['item_det_msg']="Its low a price again leave a final  price,which will be sent to the seller.!!  "."<a href='bid_history.php'>View bid History</a>";
						redirect("item-details.php?details_item_value=".$_REQUEST['details_item_value']);
					}
						
                        }
			else if($arr_fetch_BIDLIMIT['number_bids']== 3 && $num_existing_haating ==0)
			{
						$mail_content        =  str_replace("#amount#",$_POST['bid_value'],$mail_content);
						$subject 	         =  $templateRowArr['mail_subject'];  
						$objItem->user_id    =  $_SESSION['session_user_id'];
						$objItem->bid_value  =  $_POST['bid_value'];
						$objItem->item_value =  $_REQUEST['details_item_value'];
						$result              =  $objItem->insertBID_Hatingitems();
						
						$mail_content	     =  str_replace("#seller_name#",$seller_name,$mail_content);
						$mail_content	     =  str_replace("#buyer_name#",$buyer_name,$mail_content);
						$mail_content	     =  str_replace("#item_title#",$item_mail_title,$mail_content);
					    
					
						$mailFrom            = 'Nethaat ';
						//$seller_email_id     =  'rishi_kapoor@seologistics.com';
						$emailObj->SendHtmlMail($seller_email_id,$subject,$mail_content,$mailFrom);
						
						//if($result->nIdentity && $result->nErrorCode==0)
						//{
					   
						//}
						
										 
						$objItem->last_id         =  $_SESSION['hat_id_last_id'];
						$objItem->changeBID_StatusHatingitems('2');
						 $_SESSION['item_det_msg']="Wait  for sellers approval.!!  "."<a href='bid_history.php'>View bid History</a>";
						redirect("item-details.php?details_item_value=".$_REQUEST['details_item_value']);
			}
			else
			{
					 $_SESSION['item_det_msg']="Yours Bid limit for this item is over!!  "."<a href='bid_history.php'>View bid History</a>";
				     redirect("item-details.php?details_item_value=".$_REQUEST['details_item_value']);
			
			 }
			 
			
					//	exit;
		
    //  $session_user_id   
           }

///// code ends here
///////////code for bid post ends in haating case here

		
		
		
		
		
		
		
		
		
		
		
		

		
		
		$smarty->assign("details_ofuser_information",$arr_fetch_asoc_user_info);
		$smarty->assign("v_store_image",$v_store_image);
		
		//$smarty->assign("details_ofuser_information",$arr_fetch_asoc_user_info);
		$smarty->assign("sellers_withotheritems",$sellers_imageid_withotheritems);
		$smarty->assign("sellers_number_of_items1",$sellers_number_of_items1);
		$smarty->assign("details_item_name",$arr_items_array['dococmo']);
        $smarty->assign("sellers_image1",$sellers_image1);
		$smarty->assign("sellers_imageid",$sellers_imageid);
		$smarty->assign("personal_store_image_sellers",$personal_store_image_sellers[0]);
		$smarty->assign("sellers_number_of_items",$number_items_sellers);
		$smarty->assign("details_item_value_listingid",$details_item_value);
		$smarty->assign("error_msg",$error_msg);
		$smarty->assign("update_msg",$update_msg);
         $_SESSION['inc_val123'][] = $_REQUEST['details_item_value'];
//display template

	 	if($_SESSION['item_det_msg']!='')
		{
		$smarty->assign('item_det_msg',$_SESSION['item_det_msg']);
		$_SESSION['item_det_msg']='';
		}
		
		$smarty->assign('site_page_title','Item Details');
		$smarty->assign('site_title',$site_title);
		$smarty->display('item-details-6-oct.tpl');

 
?>
