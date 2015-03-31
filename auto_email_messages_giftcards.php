<?php

// email notification for sending message with giftcards on date of occasion
/*include ('include/common.inc');
include ('class/class.package.inc');
include ('class/class.user.inc');
include ('class/class.mail.inc');
include ('include/sendEmailClass.php');
include ('captcha/php-captcha.php');*/
include ('class/dbconnector.inc'); //DB connection file
include ('include/functions.php'); //common functions
include ('class/class.cms.inc');
include ('class/class.user.inc');
include ('class/class.mail.inc');
include ('class/class.package.inc');
include ('class/class.item.inc');
include ('include/sendEmailClass.php');
include ('captcha/php-captcha.php');
$baseUrl = "http://www.nethaat.com/";

// done-linux
	//create user class object
	$objUser                    = new Class_User();
	$objItem   	                = new Class_Item();
	    $emailObj 	= new SendEmailClass();
		$objMail 	                    =  new Class_Mail();
	
	$i_today                    = 0; 
	$next_15_days_array         = time() + ($i_today * 24 * 60 * 60);
	$next_15_month[]            = date('m', $next_15_days_array) ;
	$next_15_days[]             = date('d', $next_15_days_array) ;
	$next_15_month              = array_unique($next_15_month);		   
	$implode_days               = implode($next_15_days,',');
	$implode_month              = implode($next_15_month,',');
   
    //  echo date('Y-m-d');
    //  echo '<br>';
    $objUser->order_by_date     = 1;
    $objUser->group_by_user_id  = 1;
    $objUser->group_function    = 1;
    $objUser->implode_month     = $implode_month;
    $objUser->implode_days      = $implode_days;
    $reminderlisting_details    = $objUser->auto_email_sendgiftcard(); 
	// to show listing of  reminders

    $num_rows_items1              = mysql_num_rows($reminderlisting_details);
    if($num_rows_items1>0)
      {
      while($arr_items_array = mysql_fetch_array($reminderlisting_details))
        {
     $item_values_rem_gift_ids[]          = $arr_items_array['rem_gift_id'];
	 $item_values_user_ids[]              = $arr_items_array['user_id'];
	 $item_values_rem_title[]             = $arr_items_array['rem_title'];
	 $item_values_holder_name[]           = $arr_items_array['name'];
	 $item_values_message[]               = $arr_items_array['message'];
	 $item_values_email_id[]              = $arr_items_array['email_id'];
	 $item_gift_card_ids[]                = $arr_items_array['giftcard_id'];
		}
     }
        echo '<br>';
     echo count($item_values_rem_gift_ids);
	for($i=0;$i<count($item_values_rem_gift_ids);$i++)
	{
	$objUserCls                 = new Class_User();
	$rem_gift_id                = $item_values_rem_gift_ids[$i];
	$email_to 		            = $item_values_email_id[$i];
    $name_to                    = $item_values_holder_name[$i];
	$event_title                = $item_values_rem_title[$i];
	$event_message              = $item_values_message[$i];
	$event_gift_card_ids        = $item_gift_card_ids[$i];
    $objUserCls->id = "";
    $objUserCls->id             = $item_values_user_ids[$i];
	$result_user_details1       = $objUserCls->selectUser();
    $num_user_details1          = mysql_num_rows($result_user_details1);
     if($num_user_details1>0)
	{
	$arr_fetch_em_sender1       = mysql_fetch_assoc($result_user_details1);
	$email_from                 = $arr_fetch_em_sender1['email'];
	$name_from                  = $arr_fetch_em_sender1['first_name'].''.$arr_fetch_em_sender1['last_name'];
	}
	
	echo 'evnt=='.$event_gift_card_ids;
     
     if($event_gift_card_ids!=0)
	{
	 
	 $objItem->id                = "";
	 $objItem->id                = $event_gift_card_ids; 
     $result_event_gift_details1 = $objItem->getgiftcarddetail();
     $num_event_gift_details1    = mysql_num_rows($result_event_gift_details1);
  	 if($num_user_details1>0)
		{
		   $arr_event_gift_details1 = mysql_fetch_assoc($result_event_gift_details1);
		   $Giftcard_code           = $arr_event_gift_details1['giftcardnumber'];
		   $Giftcard_amount         = $arr_event_gift_details1['reciveramount'];
		   $Giftcard_seller_id      = $arr_event_gift_details1['seller_id'];
		}
	  
	}
   
    $to                             =  $email_to;
	$objMail 	                    =  new Class_Mail();
	$objMail->mail_title            =  "Email Template";
    $MailTemplate			        =  $objMail->selectMailTemplate();
    $templateRowArr 		        =  mysql_fetch_array($MailTemplate);
    $mail_content			        =  $templateRowArr['mail_content'];
    $mail_content			        =  str_replace("#link#",$baseUrl,$mail_content);
	//echo 'gift-id==='.$event_gift_card_ids.'<br>';
	if($event_gift_card_ids!=0)
            {
	$objMail->mail_title            =  "Aniversay_Reminder_Giftcard";
            }else
            {
	$objMail->mail_title            =  "Aniversay_Reminder";
            }
	$MailTemplate			        =  $objMail->selectMailTemplate();
	$templateRowArr 		        =  mysql_fetch_array($MailTemplate);
    $mail_content1			        =  $templateRowArr['mail_content'];
        //$recivers_name                        =  $arr_fetch_users_details['name'] ;
   
	$mail_content			        =  str_replace("#message_content#",$mail_content1,$mail_content);
	$mail_content			        =  str_replace("#link#",$baseUrl,$mail_content);
	$mail_content			        =  str_replace("#name#", $name_to,$mail_content);
	$subject	     		        =  $templateRowArr['mail_subject'];  
	$subject                        =  str_replace("#subject_aniversy#",$event_title,$subject);
	
	$mail_content			        =  str_replace("#reciver_name#",$name_to,$mail_content);	
	$mail_content			        =  str_replace("#sendername#",$name_from,$mail_content);	
	//$event_message;
    $mail_content			        =  str_replace("#message#",$event_message,$mail_content);
    $mail_content			        =  str_replace("#amount#",$Giftcard_amount,$mail_content);
   	$mail_content			        =  str_replace("#cardnum#",$Giftcard_code,$mail_content);	
   

	$mailFrom                       =  "Nethaat";
	
	$path_str =$baseUrl."getthumb.php?w=100&h=100&fromfile=";
// for recently listed items	
	$objItem->inventory_check = 1 ;
	$objItem->val_limit       = 91;
	$objItem->status          = 1;
	$objItem->recent_status   = 1;
	$objItem->hand_pickstatus = 0;
	$objItem->hatting_status  = 0;
	$objItem->approve_store   = 1;
	
	$objItem->locker_status   = 0; 
		
	$objItem->request_item_id = 0;
	
	$result_recent_items = $objItem->getItemImageDetails();

	$num_recent_items    = mysql_num_rows($result_recent_items);   	
	if($num_recent_items>0)
	{
	while($arr_recent_items    = mysql_fetch_assoc($result_recent_items))
		{
			//$recent_item_img[]     =   $arr_recent_items['image1'];
			//$recent_item_title[]   =   $arr_recent_items['title'];
$recent_item_img[]=($arr_recent_items['image1']!='')?'uploads/'.$arr_recent_items['image1']:'images/item_small_img.jpg';
$recent_item_title[]=($arr_recent_items['title']!='')?ucfirst($arr_recent_items['title']):'No Title';
			
		}
	}	

	$objItem   	             = new Class_Item();
/// for handpicked items
	 $objItem->recent_status   = '';
	 $objItem->hand_pickstatus = 1;
	 $objItem->inventory_check = 1 ;
	 $objItem->val_limit       = 1;                             // recent 6 records
	 $objItem->status          = 1;
	 $objItem->hatting_status  = 0;
	 $objItem->approve_store   = 1;
	 $objItem->locker_status   = 0; 
	 $objItem->request_item_id = 0;
	 
	
	$result_hand_items = $objItem->getItemImageDetails();
	$num_hand_items    = mysql_num_rows($result_hand_items);   	
	if($num_hand_items>0)
	{
	while($arr_hand_items    = mysql_fetch_assoc($result_hand_items))
		{
	$recent_hand_img[]=($arr_hand_items['image1']!='')?'uploads/'.$arr_hand_items['image1']:'images/item_small_img.jpg';
	$recent_hand_title[]=($arr_hand_items['title']!='')?ucfirst($arr_hand_items['title']):'No Title';
		}
	}	

// tabble in  string
$str='<table width="630" cellpadding="0" cellspacing="0" border="0">
  <tr>
  <td colspan="6" align="left" valign="top" style="color:#AF6161;font-family:Arial, Helvetica, sans-serif;font-size:13px;text-align:left;font-weight:bold;" >Handpicked Items</td>
  </tr>
  <tr>
				<td colspan="6">&nbsp;</td>
  </tr>
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
    	<td colspan="6">click here to visit <a href='.$baseUrl.'>Nethaat</a></td>
  </tr>
</table>';

// table in string
     $store_url      = $baseUrl.'featured_store_information.php?id='.$Giftcard_seller_id;
	 $mail_content   = str_replace("#store_url#",$store_url,$mail_content);
	 $mail_content   =  str_replace("#table_str#",$str,$mail_content);
	 $mail_content   =  str_replace("#link#",$baseUrl,$mail_content);
	// Creating object of SendEmailClass
    $emailObj 	= new SendEmailClass();
	$status          = $emailObj->SendHtmlMail($to,$subject,$mail_content,$mailFrom);
	
	$chek_r .=  $to.',ema-optut=='.$status.',';
    if($status)
	{
	$objUser->rem_gift_id = $rem_gift_id;      
	$objUser->STATUS=1;
	$objUser->insertUpdate_giftcard_message();         
	 echo "<br>Mail Sent to <b>".$to."</b>";
	}
	else
	{
	 echo "<br>Mail Send failure for <b>".$to."</b>";
	}
	
	// unset($objUserCls,$emailObj,$objMail,$objItem);
    
 }
 echo 'emobj=='.$emailObj->SendHtmlMail('rishi_kapoor@seologistics.com','sending message with giftcards on date of occasion',$chek_r,$mailFrom);
echo 'email sent to =.'.$to;


?>