<?php
//$_SERVER['HTTP_REFERER']
//.$HTTP_REFFER['domain'].com
//ini_set("session.cookie_domain",.$HTTP_REFFER['domain'].com); 
//ini_set("session.cookie_domain",$_SERVER['HTTP_HOST']); 
include ('include/common.inc');
include ('class/class.user.inc');
include ('class/class.item.inc');
include ('class/class.coupon.inc');
include_once('currency_class.php');
include ('class/class.mail.inc');
include ('include/sendEmailClass.php');
include ('class/class.shipping.inc');
include ('include/country_state_cat.php');
//echo phpinfo();
//echo '<br> ';
//echo '<pre>';
//print_r($_SESSION);
//echo '</pre>';
//$_SESSION['d_cost_item']='';
//echo '<br> below is seeion id';
//echo '<br> ';
//echo session_id();
//echo '<br> ';
if(!isset($_SESSION["session_user_id"]))
$_SESSION["session_hatting_items_url"] = $_SERVER['REQUEST_URI'];

$anObject =  new Class_Dynamic();
$smarty->assign("anObject" , new Class_Dynamic() );

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
 
$name_after_domain     = $_SERVER['HTTP_HOST'];
 $exp_name_after_domain = explode(".",$name_after_domain);
 $curent_page           =  $_SERVER['PHP_SELF'];
 $base_curent_page      = basename($curent_page);
 
 $exp_name_after_domain = explode(".",$name_after_domain);
if($name_after_domain=='www.nethaat.com' )
{
}
else
{

    $add_this_name_red         =   'featured_store_information.php';
    // header("Location:$add_this_name_red");
	redirect($add_this_name_red);
 
}
*/
$objUser               = new Class_User();

$name_after_domain     = $_SERVER['HTTP_HOST'];
$exp_name_after_domain = explode(".",$name_after_domain);
if($name_after_domain=='www.nethaat.com')
{
$add_this_name         = $exp_name_after_domain[1].'.'.$exp_name_after_domain[2];
$add_this_name_www     = $exp_name_after_domain[0]; 
$smarty->assign('add_this_name',$add_this_name);
$smarty->assign('add_this_name_www',$add_this_name_www);
}
else
{
$add_this_name               =  $exp_name_after_domain[1].'.'.$exp_name_after_domain[2].'.'.$exp_name_after_domain[3];
$add_this_name_www           = $exp_name_after_domain[0]; 
$objUser->username_dom       = $exp_name_after_domain[1];
$reslt_seluser               = $objUser->selectUser();
$num_reslt_seluser           = mysql_num_rows($reslt_seluser);
	if($num_reslt_seluser>0)
	{
	$arr_reslt_seluser           = mysql_fetch_assoc($reslt_seluser);
	$reslt_seluserId             = $arr_reslt_seluser['user_id_value'];
    //if($reslt_seluserId==)
//	$_REQUEST['id']              = $reslt_seluserId;
	
	}
$objUser->username_dom         = '';

$objItem                       = new Class_Item();
$objItem->update_item_id       = $_REQUEST['details_item_value']; //details_item_value;
$reslt_seluser1                = $objItem->getItemImageDetails();
$num_reslt_seluser1            = mysql_num_rows($reslt_seluser1);
if($num_reslt_seluser1>0)
	{
	$arr_reslt_seluser1        = mysql_fetch_assoc($reslt_seluser1);
	$reslt_seluserId1          = $arr_reslt_seluser1['seller_id'];
	

    //if($reslt_seluserId==)
//	$_REQUEST['id']              = $reslt_seluserId;
	
	}

$smarty->assign('add_this_name',$add_this_name);
$smarty->assign('add_this_name_www',$add_this_name_www);
}

if($reslt_seluserId1==$reslt_seluserId)
{




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

 $details_item_value           = $_REQUEST['details_item_value'];
 $chk_coupon                   = $_REQUEST['d'];             

 $objItem                      = new Class_Item();
 $objUser                      = new Class_User();
 $objCoupon                    = new Class_Coupon();
 $objShipping                  = new Class_Shipping;


//////////========================//////////////
 // code below to check whther custom item belongs to user or not 
 if($details_item_value!='')
 {
     $objItem->item_id             =  $details_item_value;
     $objItem->owner_id            =  $_SESSION['session_user_id'];
     $customitem_details_value     =  $objItem->check_usercustom_itembuy();
     $num_customitem_details       =  mysql_num_rows($customitem_details_value);
     //if($num_customitem_details >0)
	// {
        // $arr_customitem_details    =  mysql_fetch_assoc($customitem_details_value);
	// $show_customitem_details[] = $arr_customitem_details;
	// }
     $smarty->assign('num_customitem_details',$num_customitem_details);

 }

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
$objItem->status=1;
$objItem->inventory_check  = 1;
//$objItem->approve_store    = 1;
//$objItem->locker_status    = 0;
$objItem->delete_by_seller = 0; //not deleted by seller
$objItem->delete_restored  = 0; // 0 for showing restored 1 means deleted by admin
$objItem->package_expired = 0; // 0 for showing active packg 1 means expired packge
////////////----end
 
  ///--checking whether its been gone for approval previously or not
 $objItem->item_id              = $_REQUEST['details_item_value'];
 $objItem->buyer_id             = $_SESSION['session_user_id'];
 $objItem->poster_session_id    = $_SESSION['session_user_id'];
 // make above line comment if feel any problem for haating in case of allowing all people
 $existing_haating_item         = $objItem->getItem_Detailsfourtimes();
 $num_existing_haating          = mysql_num_rows($existing_haating_item);
  


 ////////---end of code 
 
 if($_POST['coupon_code']!='')
 $objCoupon->coupon_code       = trim($_POST['coupon_code'],'');
 $objCoupon->item_id           = $details_item_value;
 $objCoupon->coupon_status     = 1;//1 means active 0 means when item send for haat

 
 
 if($details_item_value!='' &&  $_POST['Apply'])
 {
	 $result_coupon_exsist         = $objCoupon->getCouponDetails_expiredornot();
	 $num_coupon_expiry            = mysql_num_rows($result_coupon_exsist);
	 if($num_coupon_expiry>0)
	   {
		  $arr_num_coupon_details       = mysql_fetch_assoc($result_coupon_exsist);
		  $dicount_type                 = $arr_num_coupon_details['discount_type'];
		  $discount_amount              = $arr_num_coupon_details['discount_amount'];
	    }
         else{
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
     {  $_SESSION['cost_after_discount']=1;
	    $smarty->assign('coupon_d',$chk_coupon);
        $smarty->assign('result_coupon_exsist',$num_coupon_expiry);
      }else
	  {

           $_SESSION['cost_after_discount']=0;
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
		$RecordSet 			              = $objItem->getfavorite();
		$row                              = mysql_num_rows($RecordSet);
		if($row==0)
		{
				$objDBReturn = $objItem->insertUpdatefavorite();				
				if($objDBReturn->nIdentity && $objDBReturn->nErrorCode==0)
				{   success_msg("Your request for custom item has been successfull");
					header("Location:item-details.php?details_item_value=$objItem->item_id ");
				}
				else
				{   failure_msg("Error occured ...!item already in your favorite list");
					
				}
		 }
		  else
		  {  	failure_msg("Error occured ...! Item already in favorite list)");
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
             // $objItem->delete_by_seller    =  0;
              
	      //$objItem->seller_id         =  $_SESSION['session_user_id'];
	      $image_details_item           =  $objItem->getItemImageDetails();
      	  $num_rows_items               =  mysql_num_rows($image_details_item);
          if($num_rows_items>0)
		   {
			   $arr_items_array = mysql_fetch_array($image_details_item);
			   $item_mail_title = ucfirst($arr_items_array['title']);
			   $reslt_seldescription      = $arr_items_array['description'];
    	   }
			//	echo $reslt_seldescription;   
         //     echo '<pre>';
	       //    print_r($arr_items_array);
             //echo '</pre>';
		  $discount_amount 	            = $arr_num_coupon_details['discount_amount'];
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
           if($arr_items_array['hatting_status']==0)
           {
                if($num_coupon_expiry>0 && $_REQUEST['d']==1  )
                 {
                      $_SESSION['d_cost_item']          =    round($str_amount_final,2);
                      $_SESSION['show_d_cost_item']     =    round($str_amount_final,2);
                  }
                  else
                 {
                      $_SESSION['d_cost_item']         =   $arr_items_array['cost_item'];                      $_SESSION['show_d_cost_item']    =   $arr_items_array['cost_item'];
                  }

           }
          else
            {         // for showing haated price
                          $objItem->item_id      =  $details_item_value;
                          $objItem->buyer_id     =  $_SESSION['session_user_id'];
                          $image_details_item1   =  $objItem->getHaatedItemImageDetails();
                          $num_rows_items1       =  mysql_num_rows($image_details_item1);
                          if($num_rows_items1>0)
                            {
                               $arr_items_array1 = mysql_fetch_array($image_details_item1);
                               $_SESSION['d_cost_item'] = $arr_items_array1['cost_posted'];
                                  // $_SESSION['cost_of_haated_item']= 1;
                             }

             }
	     //echo 'sds'.$_SESSION['d_cost_item'];
             ////////////////code or bid post
            $_SESSION['d_item_id']               =  $_REQUEST['details_item_value']; // item id
            $smarty->assign("str_amount_final",round($str_amount_final,2));
            $smarty->assign("str_amount_final",round($str_amount_final,2)); 
            $smarty->assign("num_rows_items_qty_delete_by_admin_seller",$num_rows_items);//delete by admin or seller or expired pckg
            //$smarty->assign("arr_items_array1",$arr_items_array1);

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
		if($reslt_style_name['set_style']!='')
		$all_style_names                       .= $reslt_style_name['set_style'].' , ';          
		 }
	     //	 echo 'all-sty-name-'.$all_style_names;
		//$all_style_names           = trim($all_style_names,',');
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
	
		$smarty->assign("users_items_details",$arr_items_array);
                /// END OF CODE        
		// code for rating
		$objUser->logged_user_id      = $arr_items_array['seller_id'];            // seller id
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
		 
		 
		// sellers info starts
	    $objUser->id               = $arr_items_array['seller_id'];
		$_SESSION['det_seller_id'] = $arr_items_array['seller_id'];
		$smarty->assign("sellerid",$arr_items_array['seller_id']);
		if($objUser->id!='')
	    $result_user              = $objUser->selectUser();
		$num_user                 =  mysql_num_rows($result_user);
		if($num_user>0)
		{//echo 'sds';
		$arr_fetch_asoc_user_info = mysql_fetch_assoc($result_user);
		$store_status             = $arr_fetch_asoc_user_info['approve_store']; // check whether store approved or disapproved
		$v_store_image            = $arr_fetch_asoc_user_info['v_store_image']; // store image
		$seller_email_id          = $arr_fetch_asoc_user_info['email'];         // store image
		$seller_name              = $arr_fetch_asoc_user_info['first_name'].''.$arr_fetch_asoc_user_info['last_name']; 
		$seller_username              = $arr_fetch_asoc_user_info['username'];
		// store seller_email_id		
		//$seller_email_id          = $arr_fetch_asoc_user_info['email'];        // store seller_email_id		
		   // echo 'lala';
        $objItem->seller_id       =  $arr_fetch_asoc_user_info['user_id_val'];
		}
		//echo 'store--'.$store_status;//  1 means blocked by admin
		
		
		//echo 'store_status=='.$store_status;
	        $smarty->assign("details_of_store_status",$store_status);
	    
		$objItem->item_value               =   $details_item_value;
		$sellers_other_products            =   $objItem->getNoOfItems();
		$sellers_number_of_items           =   mysql_num_rows($sellers_other_products);
		if($sellers_number_of_items>0)
		$arr_fetch_asoc_number_of_items    =   mysql_fetch_assoc($sellers_other_products);
		//   $sellers_image1[]             =   $arr_fetch_asoc_number_of_items['image1'];
		$number_items_sellers              =  $arr_fetch_asoc_number_of_items['number_items'];

         //$objItem->hatting_status   =  0;
                $objItem->locker_status    = 0;
                $objItem->inventory_check  = 1;  // not deleted by admin
                $objItem->package_expired  = 0;  // active  package
                $objItem->delete_by_seller = 0;  // not deleted by seller
                $objItem->delete_restored  = 0;  // 0 for showing restored 1 means deleted by admin
                
                $objItem->seller_id        =  $arr_items_array['seller_id'];
                $objItem->item_id          =  $_REQUEST['details_item_value'];
				$objItem->seller_otheritem_id =  $_REQUEST['details_item_value'];
				
                //$sellers_other_products1   =  $objItem->getNoOfItemswithImagesforpartcularseller();
				$sellers_other_products1   =  $objItem->getItemImageDetails_withdiscount();
				$date_forcheck             =  date('Y-m-d');
                $smarty->assign('date_forcheck',$date_forcheck);
				
                $sellers_number_of_items1  = mysql_num_rows($sellers_other_products1);
                if($sellers_number_of_items1>0)
		          {
	           while($arr_fetch_asoc_number_of_items1 = mysql_fetch_assoc($sellers_other_products1))
		          {
		           $sellers_imageid_withotheritems[]  = $arr_fetch_asoc_number_of_items1;
		          }
		         }
              // echo '<pre>';
              // print_r($sellers_imageid_withotheritems);
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
	    $objMail                              =  new Class_Mail();
	    $objMail->mail_title                  =  "Email Template";
        $MailTemplate			              =  $objMail->selectMailTemplate();
        $templateRowArr 		              =  mysql_fetch_array($MailTemplate);
        $mail_content			              =  $templateRowArr['mail_content'];
        $mail_content			              =  str_replace("#link#",$baseUrl,$mail_content);
	
		$objMail->mail_title	              =  "Haating_last";
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
	            $arr_fetch_max_min_value      = mysql_fetch_assoc($get_haat_max_min_value);
		     }

		    $getBIDLIMIT_value             =  $objItem->getBIDlimit();
		    $num_rows_BIDLIMIT_value       =  mysql_num_rows($getBIDLIMIT_value);
		    if($num_rows_BIDLIMIT_value>0)
		     {
                 $arr_fetch_BIDLIMIT          = mysql_fetch_assoc($getBIDLIMIT_value);
		     }

        //echo 'no-bids='.$arr_fetch_BIDLIMIT['number_bids']."=&&num_existing_haating".$num_existing_haating;
		//	exit;
			if($arr_fetch_BIDLIMIT['number_bids']< 3 && $num_existing_haating ==0)
			{
			$objItem->user_id          =  $_SESSION['session_user_id'];
			$objItem->bid_value        =  $_REQUEST['bid_value'];
			$objItem->item_value       =  $_REQUEST['details_item_value'];
			if($_POST['bid_value'] <=$arr_fetch_max_min_value['hat_max_value'])
			{
			$result                    =  $objItem->insertBID_Hatingitems();
			
		
			
			if(($_POST['bid_value'] >= $arr_fetch_max_min_value['hat_min_value']) && ($_POST['bid_value']<=$arr_fetch_max_min_value['hat_max_value']))
			   {
				$_SESSION['d_cost_item']  =   $_POST['bid_value']; 
				// amount to take it for credit card page
				$objItem->last_id		  =   $_SESSION['hat_id_last_id'];
				$objItem->changeBID_StatusHatingitems('1');
				success_msg("Congratulations you can buy this product. !!");
				redirect("buyer-haated-items.php");
			   }
            else
			  {                                  
				if($arr_fetch_BIDLIMIT['number_bids']==0)
				$_SESSION['item_det_msg']="Its low a price,look at the product every thing is handcrafted.Please offer your genuine price.!! "."<a href='bid_history.php'>View bid History</a>";
				if($arr_fetch_BIDLIMIT['number_bids']==1)
				$_SESSION['item_det_msg']="Please revise your quote,since it takes lot of time to make it by hand.!!"."<a href='bid_history.php'>View bid History</a>";
						
                                                
                if($arr_fetch_BIDLIMIT['number_bids']==2)
			    $_SESSION['item_det_msg']="Please requote since this is a unique item created by hand.!!  "."<a href='bid_history.php'>View bid History</a>";
				redirect("item-details.php?details_item_value=".$_REQUEST['details_item_value']);
			   }
			  }
			  else
			  {
			    $_SESSION['item_det_msg']="Please enter below the maximum cost of haated item .!!  "."<a href='bid_history.php'>View bid History</a>";
				
				redirect("item-details.php?details_item_value=".$_REQUEST['details_item_value']);
			  
			  }
			   
		

               //(b)Please revise your quote ,since it takes lot of time to make it by hand
             }
		//(c)Please requote since this is a unique item created by hand
            else if($arr_fetch_BIDLIMIT['number_bids']== 3 && $num_existing_haating ==0)
			{       
			        if($_POST['bid_value'] <=$arr_fetch_max_min_value['hat_max_value'])
					{
					$result       =  $objItem->insertBID_Hatingitems();
					$mail_content   =  str_replace("#amount#",$_POST['bid_value'],$mail_content);
					$subject 	         =  $templateRowArr['mail_subject'];  
					$objItem->user_id    =  $_SESSION['session_user_id'];
					$objItem->bid_value  =  $_POST['bid_value'];
					$objItem->item_value =  $_REQUEST['details_item_value'];
						
					$mail_content =  str_replace("#seller_name#",$seller_name,$mail_content);
					$mail_content =  str_replace("#buyer_name#",$buyer_name,$mail_content);
					$mail_content = str_replace("#item_title#",$item_mail_title,$mail_content);
					    
					
					$mailFrom            = 'Nethaat ';
					$emailObj->SendHtmlMail($seller_email_id,$subject,$mail_content,$mailFrom);
						
					$objItem->last_id         =  $_SESSION['hat_id_last_id'];
					$objItem->changeBID_StatusHatingitems('2');
					$_SESSION['item_det_msg']="Wait  for sellers approval.!!  "."<a href='bid_history.php'>View bid History</a>";
					}else
					{
					$_SESSION['item_det_msg']="Please enter below the maximum price of haated item!!  "."<a href='bid_history.php'>View bid History</a>";
					}
					redirect("item-details.php?details_item_value=".$_REQUEST['details_item_value']);
			}
			else
			{
			     $_SESSION['item_det_msg']=" Yours Bid limit for this item is over!!  "."<a href='bid_history.php'>View bid History</a>";
			     redirect("item-details.php?details_item_value=".$_REQUEST['details_item_value']);
			
			 }
          }

              $cnt_catalogue=0;
              for($chk_item_won_forcatalogue=0;$chk_item_won_forcatalogue<$sellers_number_of_items1;$chk_item_won_forcatalogue++)
              {
   if($anObject->home_pageHaatedItems($sellers_imageid_withotheritems[$chk_item_won_forcatalogue]['item_id'])==0)
                     $cnt_catalogue++;
              }
           //   echo 'cnt-=='.$cnt_catalogue;

               if($cnt_catalogue>=5)
               $visble_val = 5;
               else
               $visble_val = $sellers_number_of_items1;

        $smarty->assign("visble_val",$visble_val);
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


	    if($_SESSION['item_det_msg']!='')
		{
			$smarty->assign('item_det_msg',$_SESSION['item_det_msg']);
			$_SESSION['item_det_msg']='';
		}
		
//display template
//<Company Name> | < Item Title> : Nethaat
//$reslt_seldescription
$title_showpage= $seller_username.' | '.$item_mail_title;
$smarty->assign('site_page_title',$title_showpage);
$smarty->assign('META_DESCRIPTION',$reslt_seldescription);
$smarty->display('item-details4.tpl'); 
}
else{
//$title_showpage= $seller_name.' | '.$item_mail_title;

//echo 'No Item found in this shop';
//display template
$title_showpage= $seller_username.' | '.$item_mail_title;
$smarty->assign('site_page_title',$title_showpage);

$smarty->assign('num_rows_items_qty_delete_by_admin_seller1',0);
$smarty->assign('site_page_title',$title_showpage);
$smarty->assign('META_DESCRIPTION',$reslt_seldescription);
$smarty->assign('site_title',$site_title);
$smarty->display('item-details4.tpl'); 
}
?>