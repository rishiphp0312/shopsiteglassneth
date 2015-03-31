<?php
include ('include/common.inc');
include ("include/authentiateUserLogin.php");
include ("class/class.category.inc");
include ("class/class.item.inc");
include ("class/class.user.inc");
include ('class/class.mail.inc');
include ('include/sendEmailClass.php');

      // echo 'paid_amount   = '.$_SESSION['gift_paid_amount'];
	    //echo 'gift_cardnumber   = '.$_SESSION['gift_cardnumber'];
	    
   

    $obj_user                     = new Class_User();
	$objMail 	                  = new Class_Mail();
	$emailObj 	                  = new SendEmailClass();
	$objItem                      = new Class_Item();
    $gift_id_paypl_sent           = $_REQUEST['gift_card_id'];
	$objItem->id                  = $gift_id_paypl_sent;
	$reslt_giftdetails            = $objItem->getgiftcarddetail();
    $num_rslt_giftcardsdetail     = mysql_num_rows($reslt_giftdetails);
	if($num_rslt_giftcardsdetail >0)
	{
	$arr_rslt_giftcardsdetail     = mysql_fetch_assoc($reslt_giftdetails);
	$giftcard_code                = $arr_rslt_giftcardsdetail['giftcardnumber'];
    $giftcard_cost                = $arr_rslt_giftcardsdetail['reciveramount'];
	
	}
	
	$smarty->assign("giftcard_cost",$giftcard_cost);
	$smarty->assign("giftcard_code",$giftcard_code);
       // echo 'giftid'.$_SESSION['reminder_giftcards_message_id'];
    $delete_item_value                = $_GET['delete_item_value'];
   
	if($_GET['rem_id_value']!='')
	{
	$obj_user->rem_id                  = $_REQUEST['rem_id_value'];
	$result_users                      = $obj_user->getreminderlisting();
	$num_value_users_details           = mysql_num_rows($result_users);
	if($num_value_users_details >0)
	 {
	  $arr_fetch_users_details         = mysql_fetch_assoc($result_users);
	 }
	}
	$smarty->assign("reminders_details",$arr_fetch_users_details);
	
	

	
	if(isset($resCMSRow['page_title']))
	{
		$page_title = $resCMSRow['page_title'];
	}
	else
	{
		$page_title = SITE_CONTACT;
	}

	$obj_user                 = new Class_User();
	$obj_user->id             = $arr_fetch_users_details['user_id'];
    $result_user_details      = $obj_user->selectUser();
    $num_user_details         = mysql_num_rows($result_user_details);
    if($num_user_details>0)
	{$arr_fetch_em_sender      = mysql_fetch_assoc($result_user_details);
	
	$email_from_sender        = $arr_fetch_em_sender['email'];
    $name_from_sender         = $arr_fetch_em_sender['first_name'].' '.$arr_fetch_em_sender['last_name'];
}

  
            // start of send email
        if($_POST['send_email']=='Send Email')
        {  
			extract($_POST);
                // code to save message starts here
/*
                $maxid_reminder         =  $obj_user->select_maxreminderId();
                $num_result_reminder    =  mysql_num_rows($maxid_reminder );
		if($num_result_reminder)
		{
		$arr_fetch_reminder     =  mysql_fetch_assoc($maxid_reminder);
		$max_rem_id             =  $arr_fetch_reminder['max_rem_id'];
		}
		$obj_user->rem_gift_id  =  $max_rem_id;
                // $obj_user->giftcard_id =$_REQUEST['gift_card_id'];
		$obj_user->STATUS       =  1;
		$obj_user->message      =  addslashes($_POST['message']);
		$Reminder_details_value =  $obj_user->insertUpdate_giftcard_message();
	        //exit;
		if($error_msg=="")
		{
        	success_msg("Message with giftcard for reminder is successfully saved and will be automatically sent on Reminder date!!");
		 }
		else
		{
	    	$error_msg = "Error occured ...!Please try again";
		failure_msg("Error occured while adding reminder");
		}
		

*/
                // code to save message ends here
				
				
		$obj_user->id = $_SESSION['session_user_id'];
		$UserRes = $obj_user->selectUser();
		if(mysql_num_rows($UserRes)>0)
		{
		$UserArr = mysql_fetch_array($UserRes);
		$UserArr['email'];
		$UserArr['username'];
         }       
		$obj_user->id   =  $_REQUEST['seller_id']; // for seller
		$UserRes_seller =  $obj_user->selectUser();
		if(mysql_num_rows($UserRes_seller)>0)
		{
		$UserArr_seller  =  mysql_fetch_array($UserRes_seller);
		$seller_email    =  $UserArr_seller['email'];        
		$seller_name     =  $UserArr_seller['first_name'].' '.$UserArr_seller['last_name'];
		$seller_username =  $UserArr_seller['username'];
         }
       //******************************** Get email template for beneficiary ******************

        $objMail->mail_title = "Email Template";
		$MailTemplate		 = $objMail->selectMailTemplate();
		$templateRowArr 	 = mysql_fetch_array($MailTemplate);
		$mail_content		 = $templateRowArr['mail_content'];
		$mail_content		 = str_replace("#link#",$baseUrl,$mail_content);
					
		//get gift card email content

		$objMail->mail_title	= "Aniversay_Reminder_Giftcard"; 
		$MailRes 		        = $objMail->selectMailTemplate();
		$mailRowArr 		    = mysql_fetch_array($MailRes);
		$subject 		        = $mailRowArr['mail_subject'];
		$subject = str_replace("#subject_aniversy#",$arr_fetch_users_details['rem_title'],$subject);
		$message_content	= $mailRowArr['mail_content'];
		//replace message content with mail template message content variable
		$mail_content		= str_replace("#message_content#",$message_content,$mail_content);
		$mail_content		= str_replace("#link#",$baseUrl,$mail_content);
				
		//******************************** Get email template for seller******************

		$objMail->mail_title = "Email Template";
		$MailTemplate1		= $objMail->selectMailTemplate();
		$templateRowArr1 	= mysql_fetch_array($MailTemplate1);
		$mail_content1		= $templateRowArr1['mail_content'];
		$mail_content1		= str_replace("#link#",$baseUrl,$mail_content1);

		//get gift card email content

		$objMail->mail_title	= "Gift_Card_seller";
		$MailRes1 		        = $objMail->selectMailTemplate();
		$mailRowArr1 		    = mysql_fetch_array($MailRes1);
		$subject1 		        = $mailRowArr1['mail_subject'];
	//	$subject1		= str_replace("#subject_aniversy#",$arr_fetch_users_details1['rem_title'],$subject);
		$message_content1	    = $mailRowArr1['mail_content'];

		//replace message content with mail template message content variable

		$mail_content1		    = str_replace("#message_content#",$message_content1,$mail_content1);
		$mail_content1		    = str_replace("#link#",$baseUrl,$mail_content1);
                
		//*********************************** Storing Giftcard details database ***
		
	    $objItem->name			= $arr_fetch_users_details['name'];     			        //$_SESSION['giftcardrecivername']
		$objItem->email			= $arr_fetch_users_details['email_id']; // session
	    $objItem->paid_amount   = $giftcard_cost;
		$objItem->cardnumber    = $giftcard_code;
	    
                // $objItem->cardnumber	= $_SESSION['last_gift_id'];
		//$objDBReturn= $objItem->insertUpdategiftcard();
		//if($objDBReturn->nErrorCode==0)
		//{
		 //  below is code for message update in  reminder  table
		//$obj_user->rem_gift_id               =  $_SESSION['reminder_giftcards_message_id'];
		$maxid_reminder         =  $obj_user->select_maxreminderId();
        $num_result_reminder    =  mysql_num_rows($maxid_reminder );
		if($num_result_reminder)
		{
		$arr_fetch_reminder     =  mysql_fetch_assoc($maxid_reminder);
		$max_rem_id             =  $arr_fetch_reminder['max_rem_id'];
		}
        $obj_user->rem_gift_id  =  $max_rem_id;

        $obj_user->STATUS                    =  1;
		$obj_user->message                   =  rteSafe($_POST['message']);   
		//$objUser->gift_card_id             =  $_SESSION['last_gift_id'] ;	
		$Reminder_details_value              =  $obj_user->insertUpdate_giftcard_message();        // giftcard updated
	     // end of code for message update in  reminder  table
	     //***************************  Replacing mail content *********************
        $store_url=$baseUrl.'featured_store_information.php?id='.$_REQUEST['seller_id'];
		$store_url_link   = "<a href='".$store_url."'>".$seller_username." Go to Store <a>"; 
		$mail_content= str_replace("#store_url#",$store_url_link,$mail_content);
		$mail_content= str_replace("#name#",$objItem->name,$mail_content);
		$mail_content= str_replace("#email#",$objItem->email,$mail_content);
		$mail_content= str_replace("#amount#",$objItem->paid_amount,$mail_content);
		$mail_content= str_replace("#senderemail#",$UserArr['email'],$mail_content);
		$mail_content= str_replace("#sendername#",$UserArr['first_name'].''.$UserArr['last_name'],$mail_content);
		$mail_content= str_replace("#cardnum#",$objItem->cardnumber,$mail_content);
		$mail_content= str_replace("#message#",$_POST['message'],$mail_content);
		$mail_content= str_replace("#nethatlink#","NetHaat",$mail_content);

        $mail_content1	= str_replace("#sellername#",$seller_name,$mail_content1);
	    $mail_content1	= str_replace("#senderemail#",$seller_email,$mail_content1);
        $mail_content1	= str_replace("#sendername#",$UserArr['first_name'].''.$UserArr['last_name'],$mail_content1);
        $mail_content1	= str_replace("#amount#",$objItem->paid_amount,$mail_content1);
        $mail_content1	= str_replace("#cardnum#",$objItem->cardnumber,$mail_content1);

		    //*************************  Sending mail content *********************
				
	            $path_str =$baseUrl."getthumb.php?w=100&h=100&fromfile=";
            // for recently listed items
                $objItem->inventory_check  = 1 ;
                $objItem->val_limit        = 91;
                $objItem->status           = 1;
                $objItem->recent_status    = 1;
                $objItem->hand_pickstatus  = 0;
                $objItem->hatting_status   = 0;
		        $objItem->request_item_id  = 0; // request items should not be displayed
                //$objItem->approve_store   = 1;
                $objItem->locker_status    = 0;
                $objItem->delete_by_seller = 0; //not deleted by seller
                $objItem->delete_restored  = 0; //0 for showing restored 1 means deleted by admin
                $objItem->package_expired  = 0; // 0 for showing active packg 1 means expired packge


                $result_recent_items = $objItem->getItemImageDetails();
                $num_recent_items    = mysql_num_rows($result_recent_items);
                if($num_recent_items>0)
                {
                while($arr_recent_items    = mysql_fetch_assoc($result_recent_items))
                  {
                   //$recent_item_img[]     =   $arr_recent_items['image1'];
                   //$recent_item_title[]   =   $arr_recent_items['title'];
                   $recent_item_img[]   = ($arr_recent_items['image1']!='')?'uploads/'.$arr_recent_items['image1']:'images/item_small_img.jpg';
                   $recent_item_title[] = ($arr_recent_items['title']!='')?ucfirst($arr_recent_items['title']):'No Title';

                  }
                }


        /// for handpicked items
             $objItem->recent_status   = '';
             $objItem->hand_pickstatus = 1;
             $objItem->inventory_check = 1 ;
             $objItem->val_limit       = 1;                             // recent 6 records
             $objItem->status          = 1;
             $objItem->hatting_status  = 0;
             //$objItem->approve_store   = 1;
             $objItem->locker_status   = 0;
             $objItem->delete_by_seller = 0; //not deleted by seller
             $objItem->delete_restored  = 0;  // 0 for showing restored 1 means deleted by admin
             $objItem->package_expired = 0; // 0 for showing active packg 1 means expired packge


            $result_hand_items = $objItem->getItemImageDetails();
            $num_hand_items    = mysql_num_rows($result_hand_items);
            if($num_hand_items>0)
            {
            while($arr_hand_items = mysql_fetch_assoc($result_hand_items))
              {
            $recent_hand_img[] =($arr_hand_items['image1']!='')?'uploads/'.$arr_hand_items['image1']:'images/item_small_img.jpg';
            $recent_hand_title[]=($arr_hand_items['title']!='')?ucfirst($arr_hand_items['title']):'No Title';
              }
            }

// tabble in  string
$str='<table width="650" cellpadding="3" cellspacing="0" border="0">
  <tr>
  <td colspan="6" align="left" valign="top" style="color:#AF6161;font-family:Arial, Helvetica, sans-serif;font-size:13px;text-align:left;font-weight:bold;" >Featured Items</td>
  </tr>
        <tr><td colspan="6">&nbsp;</td></tr>
        <tr>
<td align="center" width="100" height="100" valign="top" ><img src ='.$path_str.$recent_hand_img[0].'></td>
<td align="center" width="100" height="100" valign="top" ><img src ='.$path_str.$recent_hand_img[1].'></td>
<td align="center" width="100" height="100" valign="top" ><img src ='.$path_str.$recent_hand_img[2].'></td>
<td align="center" width="100" height="100" valign="top" ><img src ='.$path_str.$recent_hand_img[3].'></td>
<td align="center" valign="top" width="100" height="100" ><img src ='.$path_str.$recent_hand_img[4].'></td>
<td align="center" valign="top" width="100" height="100" ><img src ='.$path_str.$recent_hand_img[5].'></td>
   	 </tr>
	 <tr>
<td align="center" valign="top" >'.$recent_hand_title[0].'</td>
<td align="center" valign="top" >'.$recent_hand_title[1].'</td>
<td align="center" valign="top" >'.$recent_hand_title[2].'</td>
<td align="center" valign="top" >'.$recent_hand_title[3].'</td>
<td align="center" valign="top" >'.$recent_hand_title[4].'</td>
<td align="center" valign="top" >'.$recent_hand_title[5].'</td>
      </tr>
  <tr>
    <td colspan="6">&nbsp;</td>
  </tr>
  <tr>
  <td colspan="6" align="left" valign="top" style="color:#AF6161;font-family:Arial, Helvetica, sans-serif;font-size:13px;text-align:left;font-weight:bold;">Recently Listed Items</td>
   </tr>
   <tr>
    	<td colspan="6">&nbsp;</td>
   </tr>
   <tr>
	 <td align="center" valign="top" width="100" height="100" ><img src ='.$path_str.$recent_item_img[0].'></td>
	 <td align="center" valign="top" width="100"  height="100" ><img src ='.$path_str.$recent_item_img[1].'></td>
	 <td align="center" valign="top" width="100" height="100" ><img src ='.$path_str.$recent_item_img[2].'></td>
	 <td align="center" valign="top" width="100" height="100" ><img src ='.$path_str.$recent_item_img[3].'></td>
        <td align="center" valign="top" width="100" height="100" ><img src ='.$path_str.$recent_item_img[4].'></td>
	<td align="center" valign="top" width="100" height="100" ><img src ='.$path_str.$recent_item_img[5].'></td>
   </tr>
   <tr>
	<td align="center" valign="top" >'.$recent_item_title[0].'</td>
	<td align="center" valign="top" >'.$recent_item_title[1].'</td>
	<td align="center" valign="top" >'.$recent_item_title[2].'</td>
	<td align="center" valign="top" >'.$recent_item_title[3].'</td>
	<td align="center" valign="top" >'.$recent_item_title[4].'</td>
	<td align="center" valign="top" >'.$recent_item_title[5].'</td>
  </tr>
  <tr>
    	<td colspan="6">Click here to visit <a href='.$baseUrl.'>Nethaat</a></td>
  </tr>
</table>';

// table in string


		
	 $mail_content    =  str_replace("#table_str#",$str,$mail_content);
        // $mail_content1    =  str_replace("#table_str#",$str,$mail_content);
	 $mail_content	  =  str_replace("#link#",$baseUrl,$mail_content);
     $mail_content1	  =  str_replace("#link#",$baseUrl,$mail_content1);
	 //$objItem->email= 'rishi_kapoor@seologistics.com';
			
		//	$objItem->email = $UserArr['email'];
     $emailStatus = $emailObj->SendHtmlMail($objItem->email,$subject,$mail_content,$UserArr['email']);
	 $emailStatus1 = $emailObj->SendHtmlMail($seller_email,$subject1,$mail_content1,$UserArr['email']);
	 
	// mail($seller_email,'yp','aa gayi');
			if($emailStatus == true)
			{
				success_msg("Your gift card has been sent successfully...");
				header("Location:my_account.php");
			}
			else
			{
				failure_msg("Error occured ...!Please try again");
			}
		//}
	
 }


 

//send and login details email to user
//
if($_SERVER['REQUEST_METHOD']=='POST' && $_POST['add_value']=='Save')
	{
		extract($_POST);
                 // echo $objUser->rem_id                    =  $_REQUEST['rem_id_value'];
                 // exit;
                 // echo 'sesi-rem-id'.$obj_user->rem_gift_id =  $_SESSION['reminder_giftcards_message_id'];
                 // echo '<br>';
                 // echo 'rem_id_value-=='.$_REQUEST['rem_id_value'];
                 // exit;
				 
				 
				 
				 
				 
				 
				 
				 
				 /////////===== Email code for sellers notification ===//////////
				 
	    $obj_user->id   =  $_REQUEST['seller_id']; // for seller
		$UserRes_seller =  $obj_user->selectUser();
		$UserArr_seller =  mysql_fetch_array($UserRes_seller);
		$seller_email   =  $UserArr_seller['email'];    
		$seller_name    =  $UserArr_seller['first_name'].' '.$UserArr_seller['last_name'];
      
	    $obj_user->id = $_SESSION['session_user_id'];
		$UserRes = $obj_user->selectUser();
		$UserArr = mysql_fetch_array($UserRes);
		$UserArr['email'];
		$UserArr['username'];
		
		$objMail->mail_title = "Email Template";
		$MailTemplate1		= $objMail->selectMailTemplate();
		$templateRowArr1 	= mysql_fetch_array($MailTemplate1);
		$mail_content1		= $templateRowArr1['mail_content'];
		$mail_content1		= str_replace("#link#",$baseUrl,$mail_content1);

		//get gift card email content

		$objMail->mail_title	= "Gift_Card_seller";
		$MailRes1 		        = $objMail->selectMailTemplate();
		$mailRowArr1 		    = mysql_fetch_array($MailRes1);
		$subject1 		        = $mailRowArr1['mail_subject'];
	//	$subject1		= str_replace("#subject_aniversy#",$arr_fetch_users_details1['rem_title'],$subject);
		$message_content1	    = $mailRowArr1['mail_content'];
		//replace message content with mail template message content variable
		$mail_content1		    = str_replace("#message_content#",$message_content1,$mail_content1);
		$mail_content1		    = str_replace("#link#",$baseUrl,$mail_content1);
		
		$mail_content1	= str_replace("#sellername#",$seller_name,$mail_content1);
	    $mail_content1	= str_replace("#senderemail#",$seller_email,$mail_content1);
        $mail_content1	= str_replace("#sendername#",$UserArr['first_name'].''.$UserArr['last_name'],$mail_content1);
        $mail_content1	= str_replace("#amount#",$giftcard_cost,$mail_content1);
        $mail_content1	= str_replace("#cardnum#",$giftcard_code,$mail_content1); 
		$mail_content1= str_replace("#link#",$baseUrl,$mail_content1);
	    //echo 'giftca=='.$giftcard_cost;
	
		$emailStatus1 = $emailObj->SendHtmlMail($seller_email,$subject1,$mail_content1,$UserArr['email']);
	 
                 /////======== end===============////////////
				 
				 
				 
				 
				 
				 
        $maxid_reminder         =  $obj_user->select_maxreminderId();
        $num_result_reminder    =  mysql_num_rows($maxid_reminder );
		if($num_result_reminder)
		{
		$arr_fetch_reminder     =  mysql_fetch_assoc($maxid_reminder);
		$max_rem_id             =  $arr_fetch_reminder['max_rem_id'];
		}
		$obj_user->rem_gift_id  =  $max_rem_id;
	        // $obj_user->giftcard_id =$_REQUEST['gift_card_id'];
		$obj_user->STATUS       =  0;
		$obj_user->message      =  addslashes($_POST['message']);
		$Reminder_details_value =  $obj_user->insertUpdate_giftcard_message();
	        //exit;
		if($error_msg=="")
		{
        	  success_msg("Message with giftcard for reminder is successfully saved and will be automatically sent on Reminder date!!");
		 }
		else
		{
	    	$error_msg = "Error occured ...!Please try again";
		failure_msg("Error occured while adding reminder");
		}
		redirect("my_account.php");

	}
    //end coment
	$smarty->assign("item_details_value",$item_details);
	$smarty->assign("user_details_value",$user_details_value);
     //$user_details_value
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
$smarty->assign('site_page_title','Send/Save Message With Giftcard');
$smarty->assign('site_title',$site_title);
$smarty->display('giftcard_reminder_message.tpl');
?>
