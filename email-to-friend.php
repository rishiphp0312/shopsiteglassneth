<?php
include ('include/common.inc');

include ('class/class.mail.inc');
include ('class/class.user.inc');
include ('class/class.item.inc');
include ('include/sendEmailClass.php');
include ('captcha/php-captcha.php');

$details_item_value  =  $_REQUEST['details_item_value'];
$link_for_image      =  $baseURL."uploads/";
$item_name           =  $_REQUEST['item_name'];
//create user class object
$objUser             = new Class_User();
//create mail class object
$objMail 	     = new Class_Mail();
// Creating object of SendEmailClass
$objItem             = new Class_Item();

$objItem->update_item_id  =  $details_item_value;
$image_details_item       =  $objItem->getItemImageDetails();
$num_rows_items           = mysql_num_rows($image_details_item);
if($num_rows_items>0)
{
$arr_items_array = mysql_fetch_array($image_details_item);
}

$image_value = $arr_items_array['image1'];
//$link_for_image = $baseUrl.'uploads/'.$image_value;
//get email content
//send and login details email to user
if($_SERVER['REQUEST_METHOD']=='POST')
{
	extract($_POST);
	
//echo $mail_content;die;
	//exit;
//	print_r($_POST);
	 $objMail 	                              =  new Class_Mail();
	 $objMail->mail_title	                      =  "Email Template";
	 $MailTemplate			              =  $objMail->selectMailTemplate();
	 $templateRowArr 		              =  mysql_fetch_array($MailTemplate);
	 $mail_content			              =  $templateRowArr['mail_content'];
	 $mail_content			              =  str_replace("#link#",$baseUrl,$mail_content);

         $objMail->mail_title			      = "Share and Email Item";
	 $MailRes 				      = $objMail->selectMailTemplate();
	 $mailRowArr 			              = mysql_fetch_array($MailRes);
	 $subject 				      = $mailRowArr['mail_subject'];  
	 $mail_content1		                      = $mailRowArr['mail_content'];
	
	 $name		                              = $friend_name;
	 $phone		                              = $phone;
	 $email		                              = $yours_email;
	 $message	                              = $message_post;
	 $emailTo	                              = $frinds_email;
         $message_post                                = $message_post;
	 $mailFrom                                    = $yours_name."<".$yours_email.">";
	 $error_msg                                   = "";
	 $mail_content                                = str_replace("#message_content#",$mail_content1,$mail_content);
	 $mail_content                                = str_replace("#recivers_name#",$name,$mail_content);
	 $mail_content                                = str_replace("#sender_name#",$yours_name,$mail_content);
         $mail_content                                = str_replace("#item_id#",$_POST['details_item_value'],$mail_content);
         $mail_content                                = str_replace("#Item_name#",' '.$_POST['item_name_value'],$mail_content);
	 $mail_content                                = str_replace("#sender_email#",$yours_email,$mail_content);
	 $mail_content                                = str_replace("#product_name#",$item_name,$mail_content);
	 $subject                                     = str_replace("#sender_name#",$_POST['yours_name'],$subject);
	 $mail_content 			              = str_replace("#message#",$message,$mail_content);
         $mail_content 			              = str_replace("#link#",$baseUrl,$mail_content);
	//replace message content with mail template message conyent variable
	 $link_for_image =  $baseUrl."getthumb.php?w=150&h=120&fromfile=uploads/".$image_value;
	 $mail_content			             = str_replace("#src_value#",$link_for_image,$mail_content);
	 $mail_content		                     = str_replace("#message_content#",$mail_content1,$mail_content);
		//$mailFrom   = $yours_email;
	$mail_content			     = str_replace("#link#",$baseUrl,$mail_content);
        
        $emailObj 	                             = new SendEmailClass();
	   
	 
	$emailStatus  = $emailObj->SendHtmlMail($frinds_email,$subject,$mail_content,$mailFrom);
        //exit;
        if($emailStatus == true)
	  {
			success_msg("Thank you. Your message has been sent.");
			redirect('email-to-friend.php?details_item_value='.$_REQUEST['details_item_value'].'&item_name='.$item_name);
		
	  }
	  else
	  {
			failure_msg("Error occured while sending mail...! Please try again later");
			redirect('email-to-friend.php?details_item_value='.$_REQUEST['details_item_value'].'&item_name='.$item_name);
	  }

}
//assign error/update message

 $smarty->assign('site_page_title','Nethaat : Email To Friend');
$smarty->assign("item_name_value",$item_name);
$smarty->assign("details_item_value",$details_item_value);
$smarty->assign("error_msg",$error_msg);
$smarty->assign("update_msg",$update_msg);

//display template

$smarty->assign('site_title',$site_title);
$smarty->display('email-to-friend.tpl');
?>
