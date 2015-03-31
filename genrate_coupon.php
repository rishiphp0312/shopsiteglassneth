<?php
include ('include/common.inc');
include ("include/authentiateUserLogin.php");
include ("class/class.category.inc");
include ("class/class.item.inc");
include ("class/class.user.inc");
include ("class/class.coupon.inc");
include ('class/class.mail.inc');
include ('include/sendEmailClass.php');


    //create mail class object
    $objMail 	= new Class_Mail();
   // Creating object of SendEmailClass
    $emailObj 	= new SendEmailClass;
     // Creating object of User Class
    $obj_user   = new Class_User();
    // Creating object of Coupon Class
    $obj_Coupon = new Class_Coupon();
    // Creating object of Item Class
    $obj_item   = new Class_Item();
   
    $input               =  array("a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k", "l", "m", "n", "o", "p", "0", "1", "2", "3", "4", "5" , "6" , "7" , "8" , "9" );

    $rand_keys           = array_rand($input,8);
    $coupon_code_string='';
    $coupon_code_string= $input[$rand_keys[0]].$input[$rand_keys[1]].$input[$rand_keys[2]].$input[$rand_keys[3]].$input[$rand_keys[4]].$input[$rand_keys[5]].$input[$rand_keys[6]].$input[$rand_keys[7]];

    $smarty->assign("coupon_code_str",$coupon_code_string);


    $objMail->mail_title	= "Email Template";
    $MailTemplate			= $objMail->selectMailTemplate();
    $templateRowArr 		= mysql_fetch_array($MailTemplate);
    $mail_content1			= $templateRowArr['mail_content'];
       // $subject			= $templateRowArr['mail_content'];
    $mail_content1			= str_replace("#link#",$baseUrl,$mail_content1);

   //get email template
   $objMail->mail_title          	= "Send Coupon"; 
   
   $obj_user->id                        = $_SESSION['session_user_id'];
   $result_users_em_sender              = $obj_user->selectUser();
   $num_value_users_em_sender           = mysql_num_rows($result_users_em_sender);
   if($num_value_users_em_sender >0)
	 {
     $arr_fetch_em_sender                = mysql_fetch_assoc($result_users_em_sender);
			
	 }
   $email_from_sender                    = $arr_fetch_em_sender['email'];
   $name_from_sender                     = $arr_fetch_em_sender['first_name'].''.$arr_fetch_em_sender['last_name'];

   $MailTemplate			 = $objMail->selectMailTemplate();
   $templateRowArr 		         = mysql_fetch_array($MailTemplate);
   $mail_content			 = $templateRowArr['mail_content'];
   $mail_content1			 = str_replace("#message_content#",$mail_content,$mail_content1);
   $subject 				 = $templateRowArr['mail_subject'];
   $recivers_name                        = "Customer" ;
   $mail_content1			 = str_replace("#link#",$baseUrl,$mail_content1);
   $mail_content1			 = str_replace("#link#",$baseUrl,$mail_content1);
   // $mail_content		         = str_replace("#link#",$baseUrl,$mail_content1);
 
  
  $mail_content1                         = str_replace("#recivers_name#",$recivers_name,$mail_content1);
  $mail_content1                         = str_replace("#seller_id#",$_SESSION['session_user_id'],$mail_content1);
  
  $mail_content1                         = str_replace("#message#",'',$mail_content1);
  $item_titles                           = $item_name;
  $mail_content1                         = str_replace("#item_titles#",$item_name,$mail_content1);
  $mailFrom                              = "$name_from_sender "." < ".$email_from_sender." >";


    if(isset($resCMSRow['page_title']))
    {
            $page_title = $resCMSRow['page_title'];
    }
    else
    {
            $page_title = SITE_CONTACT;
    }


//send and login details email to user
if($_SERVER['REQUEST_METHOD']=='POST')
{
   	 extract($_POST);
    
        $obj_Coupon->coupon_code             =  $coupon_code_str;
        $odj_Coupon_details_value            =  $obj_Coupon->getCouponDetails();
        $num_value_details                   =  mysql_num_rows($odj_Coupon_details_value);
	if($num_value_details >0)
	{
	  failure_msg("Error occured this coupon code already exsists !!");
          redirect("genrate_coupon.php");
	 }

  // seller_id
  // link
  // recivers_name
  // coupon_code
 //
    if($error_msg=="")
			{
	 $count_item_ids                             = count($available_items);
	 $user_details_emails   ='';
	 for($i=0;$i<$count_item_ids;$i++)
			{
		    //recivers_name
		   
			$obj_Coupon->available_items_id     = $available_items[$i];
		        $testinput_exp                      = explode("/",$testinput);
			$strt_date                          = $testinput_exp[2].'-'.$testinput_exp[0].'-'.$testinput_exp[1];
			$obj_Coupon->start_date             = $strt_date;
			
			$testinput2_exp                     = explode("/",$testinput2);
			$end_date                           = $testinput2_exp[2].'-'.$testinput2_exp[0].'-'.$testinput2_exp[1];
			$obj_Coupon->end_date               = $end_date;
			
			$obj_Coupon->coupon_code            = $coupon_code_str;
			           
		        $odj_Coupon_details_value           = $obj_Coupon->getCouponExsistence();
		
			$num_Coupon_details_value           = mysql_num_rows($odj_Coupon_details_value);
			
			if($num_Coupon_details_value>0)
				{
			failure_msg("Error occured one of these items is currently in use!!");	
			redirect("genrate_coupon.php");
			        }

                         }
			 
        	        $obj_Coupon->seller_id               = $_SESSION['session_user_id'];
			$obj_Coupon->type_discout            = $rad_discout;
		
			$obj_Coupon->discount_amount         = $amount; 
           
                        for($k=0;$k<count($user_ids_forcoupon);$k++)
			{
			$obj_user->id                        = $user_ids_forcoupon[$k];           
                        $result_users1                       = $obj_user->selectUser();
                        $num_value_users_details1            = mysql_num_rows($result_users1);
                        if($num_value_users_details1 >0)
                            {
			          $arr_fetch_users_details1  = mysql_fetch_assoc($result_users1);
		                  $user_details_emails.=       $arr_fetch_users_details1['email'].',';
						          
		             }
						
			}
			 $user_details_emails             = trim($user_details_emails,',');

                         if($email_id!='' && count($user_ids_forcoupon)>0)
			 $send_email_ids                  = $user_details_emails.','.$email_id;

                         if($email_id=='' && count($user_ids_forcoupon)>0)
			 $send_email_ids                  = $user_details_emails;

                         if($email_id!='' && count($user_ids_forcoupon)==0)
			 $send_email_ids                  = $email_id;

                         for($i=0;$i<$count_item_ids;$i++)
			{
			$obj_Coupon->seller_id               = $_SESSION['session_user_id'];
			$obj_Coupon->type_discout            = $rad_discout;
                         //for delete   previous applied
			
			$obj_Coupon->del_item_id            = $available_items[$i];
			$obj_Coupon->deletepreviousCoupon();
			$obj_Coupon->available_items_id     = $available_items[$i];
		    $testinput_exp                      = explode("/",$testinput);
			$strt_date                          = $testinput_exp[2].'-'.$testinput_exp[0].'-'.$testinput_exp[1];
			$obj_Coupon->start_date             = $strt_date;
			
			$testinput2_exp                     = explode("/",$testinput2);
			$end_date                           = $testinput2_exp[2].'-'.$testinput2_exp[0].'-'.$testinput2_exp[1];
			$obj_Coupon->end_date               = $end_date;
			
            $obj_Coupon->coupon_code            = $coupon_code_str;

		
			$obj_Coupon->discount_amount        = $amount; 

		    $objDBReturn_Coupon                 = $obj_Coupon->insertUpdateCoupon();
			
                        
                        }
                        //$send_email_ids ='rishi_kapoor@seologistics.com';
			if($objDBReturn_Coupon->nErrorCode==0)
			{
			         
				 $mail_content1			 = str_replace("#coupon_code#",$coupon_code_str,$mail_content1);
				 $emailStatus  = $emailObj->SendHtmlMail($send_email_ids,$subject,$mail_content1,$mailFrom);
				 success_msg("Your code  was successfull assigned to selected items !!");
		         }
			else
			{
				$error_msg = "Error occured ...!Please try again";
				failure_msg("Error occured while sending email, please contact Administrator to confirm your registration");
			}
				   
				redirect("genrate_coupon.php");
					
			}
	
//end coment
	}
    
                            // status='1' and hatting_status=0
                            //  $objItem->recent_status    = 2;
                            //  $objItem->approve_store    = 1;
    // Note: Haated and Requested custom items are not shown in list of select Items box.               
                            $obj_item->seller_id       =  $_SESSION['session_user_id'];
                            $obj_item->status          =  1;
                            $obj_item->inventory_check =  1;
                            $obj_item->delete_by_seller = 0; //not deleted by seller
                            $obj_item->delete_restored =  0;  // 0 for showing restored 1 means deleted by admin
                            $obj_item->hatting_status  =  0;
                            $obj_item->locker_status   =  0;
                            $obj_item->package_expired =  0;
							$obj_item->request_item_id  = 0; // request items should not be displayed
                            $odj_image_details_value   =  $obj_item->getItemImageDetails();
                            $num_value_details         =  mysql_num_rows($odj_image_details_value);
                            if($num_value_details >0)
		             {
			    while($arr_fetch_item_details  = mysql_fetch_assoc($odj_image_details_value))
			       {
			              $item_details[]    = $arr_fetch_item_details;
			
			       }
		             }


	$smarty->assign("item_details_value",$item_details);
	
	
        
	$obj_user->seller_id             = $_SESSION['session_user_id'];
         // SELECT * FROM tbl_buyer_purchased_item AS p, tbl_users AS u
         // WHERE u.id = p.buyer_id AND p.seller_id =10 GROUP BY p.buyer_id
		 //Note:Below is list of users who have atleast one transaction with seller.
	$result_users                    = $obj_user->selectpreviousUser();
	$num_value_users_details         = mysql_num_rows($result_users);
	if($num_value_users_details >0)
		 {
	while($arr_fetch_users_details    = mysql_fetch_assoc($result_users))
		 {
	         $user_details_value[]    = $arr_fetch_users_details;
			
		 }
		 }

	$smarty->assign("user_details_value",$user_details_value);


     //$user_details_value

// start for fetching data of items cooresponding to items 
	//echo 'max-'.$max_quantity_db     ;
	$smarty->assign("description_value",$description_value);
	$smarty->assign("material_used_value",$material_used_value);
	$smarty->assign("cost_item_value",$cost_item_value);
	$smarty->assign("max_item_value",$max_quantity_db);
	//$max_item_value
	$smarty->assign("inventory_alert_value",$inventory_alert_value);
	$smarty->assign("title_value",$title_value);
	$smarty->assign("category_id_value",$category_id_value);
	$smarty->assign("item_id_value",$item_id_value);
	//$item_id_value
	//end of code
//assign error/update message
$smarty->assign("error_msg",$error_msg);
$smarty->assign("update_msg",$update_msg);

//display template
$smarty->assign('site_page_title','Nethaat : Genrate Coupon');

$smarty->assign('site_title',$site_title);
$smarty->display('genrate_coupon.tpl');
?>
