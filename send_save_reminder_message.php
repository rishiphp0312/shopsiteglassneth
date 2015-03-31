<?php
include ('include/common.inc');
include ("include/authentiateUserLogin.php");
include ("class/class.category.inc");
include ("class/class.item.inc");
include ("class/class.user.inc");
include ('class/class.mail.inc');
include ('include/sendEmailClass.php');



    $obj_user                             = new Class_User();
    $delete_item_value                    = $_GET['delete_item_value'];
   
	if($_GET['rem_id_value']!='')
	{
	$obj_user->rem_id                     = $_GET['rem_id_value'];
	$result_users                         = $obj_user->getreminderlisting();
	$num_value_users_details              = mysql_num_rows($result_users);
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
	$arr_fetch_em_sender      = mysql_fetch_assoc($result_user_details);
	
	$email_from_sender        = $arr_fetch_em_sender['email'];
    $name_from_sender         = $arr_fetch_em_sender['first_name'].''.$arr_fetch_em_sender['last_name'];

  
if($_SERVER['REQUEST_METHOD']=='POST' && $_POST['send_email']!='')
	{
	extract($_POST);
	$obj_user->rem_id                     =  $_GET['rem_id_value'];
	$obj_user->message                    =  $_POST['message']; 
	//create mail class object
    $objMail 	                          =  new Class_Mail();
	$objMail->mail_title	               = "Email Template"; 
    $MailTemplate			              = $objMail->selectMailTemplate();
    $templateRowArr 		              = mysql_fetch_array($MailTemplate);
    $mail_content			              = $templateRowArr['mail_content'];
    $mail_content			              = str_replace("#link#",$baseUrl,$mail_content);
	
	$objMail->mail_title	              =  "Aniversay_Reminder"; 
	$MailTemplate			              =  $objMail->selectMailTemplate();
	$templateRowArr 		              =  mysql_fetch_array($MailTemplate);
	$mail_content1			              =  $templateRowArr['mail_content'];
	
	
    $recivers_name                        =  $arr_fetch_users_details['name'] ;
    $mail_content			              = str_replace("#message_content#",$mail_content1,$mail_content);
	// $recivers_name                        =  'Anju' ;

    $mail_content                         =  str_replace("#reciver_name#",$recivers_name,$mail_content);
   	$mail_content			              =  str_replace("#message#",$_POST['message'],$mail_content);

	$subject 				              =  $templateRowArr['mail_subject'];  
	$subject                              = str_replace("#subject_aniversy#",$arr_fetch_users_details ['rem_title'],$templateRowArr['mail_subject']); 

    
	$send_email_ids                       =  $arr_fetch_users_details['email_id'] ;  
   
    
    $mail_content			              =  str_replace("#link#",$baseUrl,$mail_content);
	$mailFrom                             =  "$name_from_sender "." < ".$email_from_sender." >";
  
    $send_email_ids                       = 'rishi_kapoor@seologistics.com';
    //$send_email_ids                        = 'deepak_nagar@seologistics.com';
   
    
	

// Creating object of SendEmailClass
   $emailObj 	= new SendEmailClass;
   $emailObj->SendHtmlMail($send_email_ids,$subject,$mail_content,$mailFrom);
					  //success_msg("Your code  was successfull assigned to selected items !!");	




		  
		
	}



 

//send and login details email to user
//
if($_SERVER['REQUEST_METHOD']=='POST' && $_POST['add_value']=='Save')
	{
		extract($_POST);
		$obj_user->rem_id                    =  $_GET['rem_id_value'];
		$obj_user->message                   =  addslashes($_POST['message']);   
		  
		//$obj_user->gift_card_id            =  $_POST['name_of_relatives'];   
		
		$Reminder_details_value              =  $obj_user->insertUpdateReminder();
	   
		if($error_msg=="")
				{
					 $emailObj 	         = new SendEmailClass;
					
					  success_msg(" Reminder is  successfully added !!");	
				  }
		else
				{
					$error_msg = "Error occured ...!Please try again";
					failure_msg("Error occured while adding reminder");
				 }
				  if($_GET['rem_id_value']=='')
					redirect("view_15_days_remind.php");
                 else
					 redirect("view_15_days_remind.php?rem_id_value=".$_GET['rem_id_value']);

	}
    //end coment



	$smarty->assign("item_details_value",$item_details);
	for($day_s =1;$day_s<=31;$day_s++)
	 {
		$array_days[] = $day_s;
	 
	 }
    $smarty->assign("array_days",$array_days);
 
	for($month_s=1; $month_s<=12;$month_s++)
	 {
		 $array_month[] =      $month_s;
	 
	 }
	 
    $smarty->assign("array_month",$array_month);
	
    

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
$smarty->assign('site_page_title','Add/Edit Reminder');
$smarty->assign('site_title',$site_title);
$smarty->display('send_save_reminder_message.tpl');
?>
