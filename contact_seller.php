<?php
include ('include/common.inc');
include ("include/authentiateUserLogin.php");
include ('class/class.mail.inc');
include ('class/class.user.inc');
include ('include/sendEmailClass.php');
include ('class/class.message.inc');
/*if($_SESSION['session_user_type']!="4")
{
	failure_msg("Please login as buyer to contact seller ...! ");
	header("Location:my_account.php");
}*/

$objUser	= new Class_User();
$objMail 	= new Class_Mail();
$obj_msg    = new Class_Message();
$emailObj 	= new SendEmailClass;


$name_after_domain     = $_SERVER['HTTP_HOST'];
$exp_name_after_domain = explode(".",$name_after_domain);
$add_this_name         = $exp_name_after_domain[1].'.'.$exp_name_after_domain[2];
//echo '<br>';
$add_this_username           = $exp_name_after_domain[1]; 

$objUser->username_dom       = $add_this_username;
$reslt_seluser               = $objUser->selectUser();
$num_reslt_seluser           = mysql_num_rows($reslt_seluser);
if($num_reslt_seluser>0)
{
$arr_reslt_seluser           = mysql_fetch_assoc($reslt_seluser);
$reslt_seluserId             = $arr_reslt_seluser['user_id_value'];
$_REQUEST['sellerid']              = $reslt_seluserId;

}



//get user details if user logged in
$seller_id = $_REQUEST['sellerid'];
if($seller_id!='')
{
    $objUser->id = $seller_id;
	$UserRes = $objUser->getUserLoginDetails();
	$UserArr = mysql_fetch_array($UserRes);
       // echo '<pre>';
       // print_r($UserArr);
       // exit;
        
       	$smarty->assign("sendto",$UserArr['email']);
	$smarty->assign("phone",$UserArr['phone1']);
	$smarty->assign("id",$UserArr['id']);
}
//echo $UserArr['email'];

if(isset($_POST['send_message']))
{    	extract($_POST);
	$name		         = rteSafe($f_name).' '.rteSafe($l_name);
	$phone		         = rteSafe($phone);
	$email		         = rteSafe($contact_email);
	$message	         = rteSafe($message);
	$emailTo	         = $_REQUEST['sentto'];
        //exit;

        if($_SESSION['session_user_id']!='' && $seller_id!=$_SESSION['session_user_id'])
        {

        
        $objUser->buyer_id       = $_SESSION['session_user_id'];
        $objUser->sellers_id     = $seller_id;
        $result_rows_forexist    = $objUser->check_seller_buyerexsist();
        $num_rows_forexist       = mysql_num_rows($result_rows_forexist);
    
        if($num_rows_forexist>0)
           {$objUser->request_status = 0;
            $arr_fetch_forexist  = mysql_fetch_assoc($result_rows_forexist);
            $frnd_id             = $arr_fetch_forexist['frnd_id'];
            $frnd_request_status = $arr_fetch_forexist['request_status'];
            $objUser->frnd_request_id =$frnd_id ;
            if($frnd_request_status!=1)
                $objUser->insertUpdatebuyers_requestseller();
            }else{
                $objUser->insertUpdatebuyers_requestseller();
            }
           
        }

//****************************************get email template***********//

	$objMail->mail_title    = "Email Template";
	$MailTemplate		= $objMail->selectMailTemplate();
	$templateRowArr 	= mysql_fetch_array($MailTemplate);
	$mail_content		= $templateRowArr['mail_content'];
	$mail_content		= str_replace("#link#",$baseUrl,$mail_content);
	$con_mail_content	= $mail_content;

	//***************************************mail_content***********//
		
	//*****************************************get Contact US email content
	$objMail->mail_title	= "Contact Seller"; 
	$MailRes 		= $objMail->selectMailTemplate();
	$mailRowArr       	= mysql_fetch_array($MailRes);
	$subject 	        = $mailRowArr['mail_subject'];
	$subject		= str_replace("#name#",$name,$subject);
	$message_content	= $mailRowArr['mail_content'];
	//************replace message content with mail template message conyent variable
	$mail_content		= str_replace("#message_content#",$message_content,$mail_content);
	$mail_content		= str_replace("#link#",$baseUrl,$mail_content);

	//$mailFrom = $name."<".$email.">";
    $mailFrom = $email;
	$error_msg = "";

	$smarty->assign("f_name",$f_name);
	$smarty->assign("l_name",$l_name);
	$smarty->assign("phone",$phone);
	$smarty->assign("contact_email",$contact_email);
	$smarty->assign("contact",$contact);
	$smarty->assign("message",$message);
		
	//if no errors found
	if($error_msg=="")
		{	
		//send contact us email
		$mail_content= str_replace("#name#",$name,$mail_content);
		$mail_content= str_replace("#email#",$email,$mail_content);
		$mail_content= str_replace("#phone#",$phone,$mail_content);
		$mail_content= str_replace("#contact#",$contact,$mail_content);
		$mail_content= str_replace("#message#",$message,$mail_content);
			
		//send contact us confirmation email
		$con_mail_content= str_replace("#name#",$name,$con_mail_content);
                //$emailTo= 'rishi_kapoor@seologistics.com';
              
                $obj_msg->message	 	  = $message;
	            $obj_msg->subject		  = $subject;
                $objDBReturn              = $obj_msg->insertUpdatemessage();
                $ms_id                    = $objDBReturn->nIdentity;
                $obj_msg->msg_id	      = $ms_id;
                $obj_msg->reciverid	      = $seller_id;
                $obj_msg->sender_id	      = $_SESSION['session_user_id'];
                $objDBReturn = $obj_msg->insertUpdatemessage_sub();
		        $emailStatus = $emailObj->SendHtmlMail($emailTo,$subject,$mail_content,$mailFrom);
		
                //exit;
		if($emailStatus == true)
		{//  exit;
		success_msg("Thank you. Your message has been sent. Our representatives will reply within 24-48 hrs");
		$smarty->assign("f_name","");
		$smarty->assign("l_name","");
		$smarty->assign("phone","");
		$smarty->assign("contact_email","");
		$smarty->assign("contact","");
		$smarty->assign("message","");
		//$smarty->assign("SendMeCopy","");
                //redirect('contact_seller.php');
		}
		else
		{
		failure_msg("Error occured while sending mail...! Please try again later");
		
		}
                redirect("contact_seller.php?sellerid=$seller_id");
	}//end of if($error_msg=="")

}


//assign error/update message
$smarty->assign("error_msg",$error_msg);
$smarty->assign("update_msg",$update_msg);
$smarty->assign('site_page_title',"Contact Seller");
$smarty->assign('site_title',$site_title);
$smarty->display('contact_seller.tpl');
?>
