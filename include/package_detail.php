<?php
include ('include/common.inc');
include ("include/authentiateUserLogin.php");
include ("class/class.category.inc");
include ("class/class.item.inc");
include ("class/class.user.inc");
include ("class/class.ticket.inc");
include ('class/class.mail.inc');
include ('include/sendEmailClass.php');
//
$obj_user               = new Class_User();
$obj_user->admin_user_id = 1;
$result_user_sel        = $obj_user->getAdminUserLoginDetails();
$num_user_sel           = mysql_num_rows($result_user_sel);
if($num_user_sel)
{
	$arr_user_values_sel    		= mysql_fetch_assoc($result_user_sel);
    $adm_API_USERNAME	     		= $arr_user_values_sel['API_USERNAME'];
	$adm_API_PASSWORD	     		= $arr_user_values_sel['API_PASSWORD'];
	$adm_API_SIGNATURE	     		= $arr_user_values_sel['API_SIGNATURE'];
	$adm_paypal_merchant_id   		= $arr_user_values_sel['paypal_merchant_id'];

    $_SESSION['API_USERNAME']               = $adm_API_USERNAME;
	$_SESSION['API_PASSWORD']               = $adm_API_PASSWORD;
	$_SESSION['API_SIGNATURE']              = $adm_API_SIGNATURE;
	$_SESSION['paypal_merchant_id']         = $adm_paypal_merchant_id;
}
//echo $adm_paypal_merchant_id   ;
//echo PAYPAL_URL;
//$adm_paypal_merchant_id   	='';
echo 'pay=='.PAYPAL_URL;
$smarty->assign("PAYPAL_URL",PAYPAL_URL);
$smarty->assign("adm_paypal_merchant_id",$adm_paypal_merchant_id);
if($adm_API_USERNAME=='' || $adm_API_PASSWORD=='' || $adm_API_SIGNATURE=='')
{
       failure_msg("Error occured ...!Payment details are incomplete try again");
       redirect("pay-package-cost.php");
}


    $objMail 	            = new Class_Mail();
    $objMail->mail_title	= "Email Template";
    $MailTemplate			= $objMail->selectMailTemplate();
    $templateRowArr 		= mysql_fetch_array($MailTemplate);
    $mail_content1			= $templateRowArr['mail_content'];
    $mail_content1			= str_replace("#link#",$baseUrl,$mail_content1);

   //get email template
   $objMail->mail_title      = "Send Ticket";
   $MailTemplate	         = $objMail->selectMailTemplate();
   $templateRowArr     		 = mysql_fetch_array($MailTemplate);
   $mail_content		     = $templateRowArr['mail_content'];
   $mail_content1		     = str_replace("#message_content#",$mail_content,$mail_content1);
   $subject 			     = $mailRowArr['mail_subject'];
   $mail_content1		     = str_replace("#link#",$baseUrl,$mail_content1);

    //$mailFrom                     = $name_from_sender;
   $mailFrom                 = "$name_from_sender"." < ".$email_from_sender." >";
     // $mailFrom                   = " Nethaat ";

     // Creating object of SendEmailClass
    $emailObj 	            = new SendEmailClass;
    $objCategory            = new Class_Category();
    $objCategory->slab_id   = $_REQUEST['package_id'];
    $fetch_slabs_deatil     = $objCategory->selectSlabs();
    $num_fetch_details      = mysql_num_rows($fetch_slabs_deatil);
    if($num_fetch_details>0)
    {
    $arr_fetch_details    = mysql_fetch_assoc($fetch_slabs_deatil);
    $smarty->assign("package_name",$arr_fetch_details['package_name']);
    $smarty->assign("amount_1month",$arr_fetch_details['amount_1month']);
    $smarty->assign("amount_6month",$arr_fetch_details['amount_6month']);   
    $smarty->assign("amount_12month",$arr_fetch_details['amount_12month']);
    $smarty->assign("start_item",$arr_fetch_details['start_item']);
    $smarty->assign("end_item",$arr_fetch_details['end_item']);
    $smarty->assign("error_msg",$error_msg);
    $custom = $arr_fetch_details['package_name'].'##--0|0--##'.$arr_fetch_details['start_item'].'##--0|0--##'.$arr_fetch_details['end_item'].'##--0|0--##'.$_SESSION['session_user_id'];
    $smarty->assign("custom",$custom);
    }
   // echo '<pre>';
  //  print_r($arr_fetch_details);
   // $smarty->assign("error_msg",$error_msg);start_item==end_item
    //description

   $obj_user                            = new Class_User();
   $obj_user->id                        = $_SESSION['session_user_id'];
   $result_users_em_sender              = $obj_user->selectUser();
   $num_value_users_em_sender           = mysql_num_rows($result_users_em_sender);
   if($num_value_users_em_sender >0)
     {
     $arr_fetch_em_sender            = mysql_fetch_assoc($result_users_em_sender);
     $name_from_sender               = $arr_fetch_em_sender['first_name'].''.$arr_fetch_em_sender['last_name'];
     $email_from_sender              = $arr_fetch_em_sender['email'];
     }

   
	if(isset($resCMSRow['page_title']))
	{
		$page_title = $resCMSRow['page_title'];
	}
	else
	{
		$page_title = SITE_CONTACT;
	}





    
//send and login details email to user
/*if($_SERVER['REQUEST_METHOD']=='POST')
	{
   	extract($_POST);
	
       	 $emailObj 	   = new SendEmailClass;
	 $mail_content1	   = str_replace("#request_type#",$request_type,$mail_content1);
	 $mail_content1    = str_replace("#message#",$message,$mail_content1);				 				 $emailStatus       = $emailObj->SendHtmlMail($send_email_ids,$subject,$mail_content1,$mailFrom);
	 success_msg("Your request has been successfully sent to Admin !!");
		


//end coment
	}*/





	//end of code
	//assign error/update message
$smarty->assign("error_msg",$error_msg);
$smarty->assign("update_msg",$update_msg);

//display template
$smarty->assign('site_page_title','Nethaat : Package Detail');

$smarty->assign('site_title',$site_title);
$smarty->display('package_detail.tpl');
?>
