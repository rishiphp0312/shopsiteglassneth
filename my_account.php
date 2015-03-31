<?php
include ('include/common.inc');
include ('class/class.mail.inc');
include ('include/sendEmailClass.php');
include ('class/class.user.inc');
include ('class/class.item.inc');
include ('class/class.package.inc');
include ('captcha/php-captcha.php');
include ("include/authentiateUserLogin.php");
include ('class/class.message.inc');
$_SESSION['page_name'] = basename($_SERVER['PHP_SELF']);
//echo '<pre>';
//print_r($_COOKIE);
//echo '</pre>';
    $obj_msg = new Class_Message();
    $obj_msg->inboxid = $_SESSION['session_user_id'];
    
	
	$obj_msg->inbox_read = "0";
	$UserRes_unread = $obj_msg->getinbox();
	$num_in_unread=mysql_num_rows($UserRes_unread);
	//$smarty->assign("num_in",$num_in_unread);
	

	$smarty->assign("num_inbox",$num_in_unread);
	
	unset($_SESSION['firstcardcode']);
    unset($_SESSION['secondcard_code']);
    unset($_SESSION['cost_after_discount']);
    unset($_SESSION['d_cost_item']);
       
    unset($_SESSION['item_is_haated']);
    unset($_SESSION['bdest_zip_code']);
	unset($_SESSION['d_item_id']);
	unset($_SESSION['shipping_address1']);
	unset($_SESSION['shipping_address2']);
	unset($_SESSION['dest_zip_code']);
	unset($_SESSION['city']);
	unset($_SESSION['reciveramount_1_card']);
	unset($_SESSION['reciveramount_2_card']);
	unset($_SESSION['giftcardreciverstate']);
	unset($_SESSION['firstcardcode']);
	unset($_SESSION['item_is_haated']);
	unset($_SESSION['haated_id']);
	unset($_SESSION['secondcard_code']);
	unset($_SESSION['secondcalculategiftcardvalue']);
	unset($_SESSION['shipping_address1']);
	unset($_SESSION['shipping_address2']);
	unset($_SESSION['dest_zip_code']);
	unset($_SESSION['city']);
	//unset($_SESSION['ship_quantity']);
	 //unset($_SESSION['service_rate']);
        //unset($_SESSION['ship_quantity']);
    //unset($_SESSION['service_rate']);
	//unset($_SESSION['show_d_cost_item']);
	//unset($_SESSION['service_rate']);
//unset($_SESSION['service_rate']);
   	
    //create business class object
	//show_d_cost_item
	
         $objItem   = new Class_Item();
 	     $objUser	= new Class_User();
	     $objMail 	= new Class_Mail();
         $emailObj 	= new SendEmailClass();
         $objPackage = new Class_Package();
         
		 
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

         $objItem->seller_id       =  $det_seller_id;
         $total_items_available    =  $objItem->select_total_items();
          // echo '<br>';
         $num_rows_items_available =  mysql_num_rows($total_items_available);
         $smarty->assign('num_rows_items_available',$num_rows_items_available);// if>25


      
	 $objUser->qty_id         = 1;
	 $result_qty              = $objUser->getquantityDetails();
	 $num_qty                 = mysql_num_rows($result_qty);
	 if($num_qty >0)
     $arr_qty                 = mysql_fetch_assoc($result_qty);
	 $smarty->assign('arr_qty_value',$arr_qty['quantity_value']);
	 
	 /// changing newsletter status of users
		if($_REQUEST['subuser']!='')
		{
		$objUser->id                 = $_SESSION['session_user_id'];
		$objUser->newsletter_status  = $_REQUEST['subuser'];
		$objUser->insertUpdateUser();
		if($_REQUEST['subuser']==0)
		success_msg("Newsletter status disabled successfully!! ");
		else
		success_msg("Newsletter status enabled successfully!! ");
		
		redirect("my_account.php");
		
		}
     
	
		//getPackagedetails();
	$objUser->id = $_SESSION['session_user_id'];
	$UserRes = $objUser->getUserLoginDetails();
	if(mysql_num_rows($UserRes)>0)
	$UserArr = mysql_fetch_array($UserRes);
    $_SESSION['session_paid_item'] =$UserArr['paid_item_status'];
     //create mail class object

	// Creating object of SendEmailClass
	$recivers_name       =  $UserArr['first_name'].' '.$UserArr['last_name'];
	$recivers_email      =  $UserArr['email'];
	$SubscribedUsers     =  $UserArr['newsletter_status'];
	
	 $smarty->assign("SubscribedUsers",$SubscribedUsers);
	 //assign user details information
	 $smarty->assign("first_last_name",$recivers_name);
 	 $smarty->assign("recivers_email",$recivers_email);
 
	if(isset($resCMSRow['page_title']))
	{
		$page_title = $resCMSRow['page_title'];
	}
	else
	{
		$page_title = SITE_CONTACT;
	}

	/////// code for Item Names In  less than inventory quantity 
  
 $objItem              = new Class_Item();
 $objItem->loggeduser_id    = $_SESSION['session_user_id'];
 $result_check_items   = $objItem->InventoryCheckItem_MESSAGES();
 $num_check_items      = mysql_num_rows($result_check_items);
 if($num_check_items>0)
   {
   while($arr_check_items = mysql_fetch_assoc($result_check_items))
	    {
          $item_name.=  $arr_check_items['title'].',';
         }
   
   }
   
 $item_name_with_comma =     trim($item_name,',') ;     
 $smarty->assign("item_name_comma",$item_name_with_comma);
 $smarty->assign("item_name_exsist",$num_check_items);

    /////// code ends here for Item Names In  less than inventory quantity 


   //get email template
  
  $objMail->mail_title	= "Inventory Notify"; 
  $MailTemplate			= $objMail->selectMailTemplate();
  $templateRowArr 		= mysql_fetch_array($MailTemplate);
  $mail_content			= $templateRowArr['mail_content'];
  $subject			    = $mailRowArr['mail_subject'];  

  $mail_content		     = str_replace("#link#",$baseUrl,$mail_content);
 // $mail_content		 = str_replace("#link#",$baseUrl,$mail_content);
  $mail_content          = str_replace("#recivers_name#",$recivers_name,$mail_content);		
  $mail_content          = str_replace("#message#",'',$mail_content);		
  $item_titles           = $item_name;
  $mail_content          = str_replace("#item_titles#",$item_name,$mail_content);		
  $mailFrom              = "Administrator "." < "." admin@nethaat.com "." >";
  if($_SESSION['session_user_type']==3)
  {
//  $emailStatus 	         = $emailObj->SendHtmlMail($recivers_email,$subject,$mail_content,$mailFrom);
  }	
  /*if($emailStatus == true)
		{
			success_msg("Thank you. Your message has been sent.");
			redirect('my_account.php');
			//header("location:thanks.php?type=4");
		}
		else
		{
			failure_msg("Error occured while sending mail...! Please try again later");
			redirect('email-to-friend.php?details_item_value='.$_REQUEST['details_item_value'].'&item_name='.$item_name);
		}
	*/
// code for upcoming reminders

 $objUser->user_id           = $_SESSION['session_user_id'];
 for($i=0;$i<=14;$i++)
    {
	   $next_15_days_array    = time() + ($i * 24 * 60 * 60);
       $next_15_month[]       = date('m', $next_15_days_array) ;
	   $next_15_days[]        = date('d', $next_15_days_array) ;
    }

   $next_15_month              = array_unique($next_15_month);		   

   $implode_days               = implode($next_15_days,',');
   $implode_month              = implode($next_15_month,',');
   $objUser->implode_month     = $implode_month;
   $objUser->implode_days      = $implode_days;
   $reminderlisting_details    = $objUser->getreminderlisting(); // to show listing of  reminders
 //  echo date('Y-m-d');
 //  echo '<br>';
    $num_rows_items1              = mysql_num_rows($reminderlisting_details);
     if($num_rows_items1>0)
     {
      while($arr_items_array = mysql_fetch_array($reminderlisting_details))
		{
	        $item_values_list[]   = $arr_items_array;
		}
     }
	
	//echo '<pre>';
	//print_r($item_values_list);
	$smarty->assign("users_items_details",$item_values_list);
	$smarty->assign("num_rows_items1",$num_rows_items1);
		if($num_rows_items1>=5)
                 $val_visble = '5';
                else
                 $val_visble = $num_rows_items1;
       $smarty->assign("val_visble",$val_visble);
	
// end of upcoming reminders

//assign error/update message
$smarty->assign("error_msg",$error_msg);
$smarty->assign("update_msg",$update_msg);

//display template

$smarty->assign('site_page_title','Nethaat :  My Account');
$smarty->assign('site_title',$site_title);
$smarty->display('my_account.tpl');
?>
