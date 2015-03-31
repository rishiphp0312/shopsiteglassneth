<?php
include ('include/common.inc');
include ("include/authentiateUserLogin.php");
include ("class/class.category.inc");
include ("class/class.item.inc");
include ("class/class.user.inc");
include ('class/class.mail.inc');
include ('include/sendEmailClass.php');



        $delete_item_value                    = $_GET['delete_item_value'];
        $obj_user                             = new Class_User();
	if($_GET['rem_id_value']!='')
	{
	$obj_user->rem_id                     = $_REQUEST['rem_id_value'];
	$result_users                         = $obj_user->getreminderlisting();
	$num_value_users_details              = mysql_num_rows($result_users);
	if($num_value_users_details >0)
		 {
	    $arr_fetch_users_details         = mysql_fetch_assoc($result_users);
		 }
	}
	$smarty->assign("reminders_details",$arr_fetch_users_details);
	
	

	//create mail class object
        $objMail 	= new Class_Mail();
	$objMail->mail_title	= "Email Template"; 
	$MailTemplate			= $objMail->selectMailTemplate();
	$templateRowArr 		= mysql_fetch_array($MailTemplate);
	$mail_content1			= $templateRowArr['mail_content'];
	$mail_content1			= str_replace("#link#",$baseUrl,$mail_content1);

   //get email template

       $email_from_sender        = $arr_fetch_em_sender['email'];
       $name_from_sender         = $arr_fetch_em_sender['first_name'].''.$arr_fetch_em_sender['last_name'];

       $MailTemplate			 = $objMail->selectMailTemplate();
       $templateRowArr 		         = mysql_fetch_array($MailTemplate);
       $mail_content			 = $templateRowArr['mail_content'];
       $mail_content1			 = str_replace("#message_content#",$mail_content,$mail_content1);
       $subject 		         = $mailRowArr['mail_subject'];
       $recivers_name                    = "Customer" ;
       $mail_content1			 = str_replace("#link#",$baseUrl,$mail_content1);
       $mail_content1			 = str_replace("#link#",$baseUrl,$mail_content1);
       // $mail_content		     = str_replace("#link#",$baseUrl,$mail_content1);


      $mail_content1             = str_replace("#recivers_name#",$recivers_name,$mail_content1);
      $mail_content1             = str_replace("#seller_id#",$_SESSION['session_user_id'],$mail_content1);

      $mail_content1             = str_replace("#message#",'',$mail_content1);
      $item_titles               = $item_name;
      $mail_content1             = str_replace("#item_titles#",$item_name,$mail_content1);
      $mailFrom                  = "$name_from_sender "." < ".$email_from_sender." >";

    // Creating object of SendEmailClass
       $emailObj 	= new SendEmailClass;




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
		//print_r($_POST);
		if($_REQUEST['rem_id_value']!='')
		$obj_user->rem_id                    =  $_REQUEST['rem_id_value'];

		$obj_user->rem_title                 =  $_POST['event_name'];   
		$obj_user->user_id                   =  $_SESSION['session_user_id'];
		$obj_user->email_id                  =  $_POST['Email'];  	
		$obj_user->message                   =  addslashes($_POST['message_compose']);   
		$obj_user->rem_day                   =  $_POST['event_day'];   
		$obj_user->rem_month                 =  $_POST['event_month'];   
		$obj_user->name                      =  $_POST['name_of_relatives'];   
		
		$Reminder_details_value              =  $obj_user->insertUpdateReminder();
	   
		if($error_msg=="")
				{
					 $emailObj 	         = new SendEmailClass;
					 $mail_content1		 = str_replace("#coupon_code#",$coupon_code_str,$mail_content1);
					 $emailStatus        = $emailObj->SendHtmlMail($send_email_ids,$subject,$mail_content1,$mailFrom);
					  //success_msg("Your code  was successfull assigned to selected items !!");	
					  success_msg("Reminder is  successfully added !!");	
				  }
		else
				{
					$error_msg = "Error occured ...!Please try again";
					failure_msg("Error occured while adding reminder");
				 }
				  if($_GET['rem_id_value']=='')
					redirect("view_reminders.php");
                 else
					 redirect("view_reminders.php?rem_id_value=".$_REQUEST['rem_id_value']);

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
	$smarty->assign("rem_id_value",$_REQUEST['rem_id_value']);
	 
	//$item_id_value
	//end of code
//assign error/update message
$smarty->assign("error_msg",$error_msg);
$smarty->assign("update_msg",$update_msg);

//display template
$smarty->assign('site_page_title','Nethaat : Add/Edit Reminder');
$smarty->assign('site_title',$site_title);
$smarty->display('add_reminder.tpl');
?>
