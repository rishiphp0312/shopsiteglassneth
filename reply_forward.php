<?php
include ('include/common.inc');
include ("include/authentiateUserLogin.php");
include ('class/class.user.inc');
include ('class/class.message.inc');
include ('class/class.mail.inc');
include ('include/sendEmailClass.php');
include ('captcha/php-captcha.php');



    $obj_user                             = new Class_User();
    $obj_msg                              = new Class_Message();
    $emailObj 	                          = new SendEmailClass;
	
    $objMail 	                          = new Class_Mail();

    $objMail->mail_title                  = "Email Template";

    $MailTemplate	                  =  $objMail->selectMailTemplate();
    $templateRowArr 	                  =  mysql_fetch_array($MailTemplate);
    $mail_content	                  =  $templateRowArr['mail_content'];
    $mail_content	                  =  str_replace("#link#",$baseUrl,$mail_content);
	
    $objMail->mail_title	          =  "Auto_Email_Message";

    $MailTemplate			  =  $objMail->selectMailTemplate();
    $templateRowArr 		          =  mysql_fetch_array($MailTemplate);
    $mail_content1			  =  $templateRowArr['mail_content'];
    $mail_content			  =  str_replace("#message_content#",$mail_content1,$mail_content);

    $mail_content			  =  str_replace("#link#",$baseUrl,$mail_content);
    $subject 				  =  $templateRowArr['mail_subject'];
	


//*******************************************************************

if(isset($_SESSION['session_user_id'])&& $_SESSION['session_user_id']!="")
{
	$obj_msg->sentid = $_SESSION['session_user_id'];
	$UserRes = $obj_msg->getSendbox();
	$num_sent=mysql_num_rows($UserRes);
	while($UserArr = mysql_fetch_array($UserRes))
	{
		$items[]	=	$UserArr;
	}
	$smarty->assign("citem",$items);
	$smarty->assign("num_sent",$num_sent);
	
}

if(isset($_SESSION['session_user_id'])&& $_SESSION['session_user_id']!="")
{
	$obj_msg->inboxid = $_SESSION['session_user_id'];
	$obj_msg->inbox_read = "0";
	$UserRes = $obj_msg->getinbox();
	$num_in=mysql_num_rows($UserRes);
	while($UserArr = mysql_fetch_array($UserRes))
	{
		$items_in[]	=	$UserArr;
	}
	$smarty->assign("in_item",$items_in);
	$smarty->assign("num_in",$num_in);
	
}


//*******************************************************************
//*************************** Record of available user ****************
$obj_user                        = new Class_User();
$obj_user->id                    = '';
$obj_user->sellers_id            = $_SESSION['session_user_id'];
$obj_user->request_status        = 1;
$result_users                    = $obj_user->getDetails_ofbuyersrequest();
$num_value_users_details         = mysql_num_rows($result_users);
if($num_value_users_details >0)
{
    while($arr_fetch_users_details = mysql_fetch_assoc($result_users))
    {
	$user_details_value[]      = $arr_fetch_users_details;
    }
}

//*************************** Record of available user ****************


//***************************** Reply start messages *****************************


$smarty->assign("user_details_value",$user_details_value);

if($_GET['msg_rpl_id']!="")
{
	$smarty->assign("msg_rpl_id",$_GET['msg_rpl_id']);
	$obj_msg->msg_rpl_id = $_GET['msg_rpl_id'];
	$UserRes11 = $obj_msg->getMessageDetails();
	$UserArr_msg = mysql_fetch_array($UserRes11);

	$smarty->assign("f_name",$UserArr_msg['first_name']);
 	$smarty->assign("l_name",$UserArr_msg['last_name']);
	
 	$smarty->assign("username",$UserArr_msg['username']);
	$pos = strpos($UserArr_msg['subject'],"RE");
	if($pos!==false)
	{
		$smarty->assign("subject",$UserArr_msg['subject']);		
	}
	else
	{
		$smarty->assign("subject","RE : ".$UserArr_msg['subject']);
	}		
	$smarty->assign("reciver_id",$UserArr_msg['sender_id']);
	$UserArr_msg['subject'];
	if(isset($_POST['post']))
	{
		extract($_POST);
		$obj_msg->message		=	$message;
		$obj_msg->subject		=	$sub;
		$objDBReturn = $obj_msg->insertUpdatemessage();
		$ms_id=$objDBReturn->nIdentity;

		$obj_user->id                     = $_SESSION['session_user_id'];
		$result_users1                    = $obj_user->selectUser();
		$num_value_users_details1         = mysql_num_rows($result_users1);
		
		if($num_value_users_details1 >0)
		 {
		$arr_fetch_users_details1         = mysql_fetch_assoc($result_users1);
		$name_from                        = $arr_fetch_users_details1['first_name'].''.$arr_fetch_users_details1['last_name'];
		$email_from                       = $arr_fetch_users_details1['email'];
      	}
   	// below is the code for mail notification
	$obj_user->id                         = $reciver_id; 
    $result_users2                        = $obj_user->selectUser();
    $num_value_users_details2             = mysql_num_rows($result_users2);
    if($num_value_users_details2 >0)
            {
	$arr_fetch_users_details2             = mysql_fetch_assoc($result_users2);
	$email_to_id                          = $arr_fetch_users_details2['email'];
	$name_to                              = $arr_fetch_users_details2['first_name'].''. $arr_fetch_users_details2['last_name'];

	       	}
			
	// $email_to_id                       = 'rishi_kapoor@seologistics.com';
  //  ECHO 'EMID=='.$email_to_id;                        
			 
   	// end is the code for mail notification

		if($objDBReturn->nIdentity && $objDBReturn->nErrorCode==0)
		{ 
			 $obj_msg->msg_id	    	=	$ms_id;
			 $obj_msg->reciverid		=	$reciver_id; 
			 $obj_msg->sender_id		=	$_SESSION['session_user_id'];
			 $objDBReturn               =   $obj_msg->insertUpdatemessage_sub();
						
			 $subject			 =  str_replace("#sender_name#",$name_from,$subject);
			 $mail_content		 =  str_replace("#name#",$name_to,$mail_content);
			 $mail_content	     =  str_replace("#message_table#",$message,$mail_content);	
			 $send_lastid        =  $objDBReturn->nIdentity;
			 $comp_url           =  $baseUrl."view_messages.php?msg_id=".$send_lastid;
	    	 $full_message_link   = '<a href="'.$comp_url.'"> Full Message</a>';
			 $subject_name        =  $sub;
			 $subject	          =  str_replace("#subject_name#",$subject_name,$subject);
    		 $mail_content		  =  str_replace("#full_message_link#",$full_message_link,$mail_content);
	
		
			$mail_content		  =  str_replace("#sender_name#",$name_from,$mail_content);	
			$mail_content		  =  str_replace("#link#",$baseUrl,$mail_content);
 //$mailFrom                          =  "$name_from_sender "." < ".$email_from_sender." >";
//message_table
//$subject 				              =  $templateRowArr['mail_subject'];  
			
			$mailFrom             =  'Nethaat';
    //        mail($email_to_id,'hi','hoo');
 			
			 $emailObj->SendHtmlMail($email_to_id,$subject,$mail_content,$mailFrom);  // reply
	
				if($objDBReturn->nIdentity && $objDBReturn->nErrorCode==0)
				{
					
				}
				else if($objDBReturn->nIdentity==0 && $objDBReturn->nErrorCode==0)
				{
					//success_msg("Your request for custom item has been successfull");
					//header("Location:seller_custom_request.php");
				}
				else
				{
					failure_msg("Error occured ...!Please try again");
				}
		}
		success_msg("Message has been sent successfully... ");
		redirect("reply_forward.php?msg_rpl_id=".$obj_msg->msg_rpl_id);
	}
		
		 
}
//***************************** Reply end messages ******************************

//***************************** Forwording  messages ******************************

if($_GET['msg_fwd_id']!="")
{
	$smarty->assign("msg_fwd_id",$_GET['msg_fwd_id']);
	$obj_msg->msg_fwd_id = $_GET['msg_fwd_id'];
	//$obj_msg->msg_contain = $_GET['msg_contain'];
	$UserRes11_fwd = $obj_msg->getMessageDetails();
	$UserArr_msg_fwd = mysql_fetch_array($UserRes11_fwd);

	$smarty->assign("f_name",$UserArr_msg_fwd['first_name']);
 	$smarty->assign("l_name",$UserArr_msg_fwd['last_name']);
	
	//$UserArr_msg_fwd['last_name'];
	
 	$smarty->assign("username",$UserArr_msg_fwd['username']);
	$pos = strpos($UserArr_msg_fwd['subject'],"FWD");
	
	if($pos!==false)
	{
		$smarty->assign("subject",$UserArr_msg_fwd['subject']);
	}
	else
	{
		$smarty->assign("subject","FWD : ".$UserArr_msg_fwd['subject']);
	}
	
	$smarty->assign("message",$UserArr_msg_fwd['message']);
	$smarty->assign("reciver_id",$UserArr_msg_fwd['sender_id']);
	//echo $UserArr_msg['reciever_id'];

	if(isset($_POST['post']))
	{

		extract($_POST);
		$obj_msg->message		=	$message;
		$obj_msg->subject		=	$sub;
		$objDBReturn = $obj_msg->insertUpdatemessage();
		$ms_id=$objDBReturn->nIdentity;
		if($objDBReturn->nIdentity && $objDBReturn->nErrorCode==0)
		{ 
			foreach ($user_ids_for_message as $key => $a)
			{
					$obj_msg->msg_id		=	$ms_id;
					$obj_msg->reciverid		=	$a; 
					$obj_msg->sender_id		=	$_SESSION['session_user_id'];
				    
                   
	$obj_user->id                     = $_SESSION['session_user_id'];
    $result_users1                    = $obj_user->selectUser();
    $num_value_users_details1         = mysql_num_rows($result_users1);
    
	if($num_value_users_details1 >0)
     {
	$arr_fetch_users_details1         = mysql_fetch_assoc($result_users1);
      }
    $name_from         =   $arr_fetch_users_details1['first_name'].''.$arr_fetch_users_details1['last_name'];
	$email_from        =   $arr_fetch_users_details1['email'];

   	// below is the code for mail notification


   
	$obj_user->id                         = $a; 
    $result_users2                        = $obj_user->selectUser();
    $num_value_users_details2             = mysql_num_rows($result_users2);
    if($num_value_users_details2 >0)
            {
	$arr_fetch_users_details2             = mysql_fetch_assoc($result_users2);
	       	}
	$email_to_id                          = $arr_fetch_users_details2['email'];
			
	// $email_to_id                       = 'rishi_kapoor@seologistics.com';
	$name_to                              = $arr_fetch_users_details2['first_name'].''. $arr_fetch_users_details2['last_name'];

    $subject			                  =  str_replace("#sender_name#",$name_from,$subject);
    $mail_content			              =  str_replace("#name#",$name_to,$mail_content);
	$mail_content			              =  str_replace("#message_table#",$message,$mail_content);	
	$mail_content			              =  str_replace("#sender_name#",$name_from,$mail_content);	
    $mail_content			              =  str_replace("#link#",$baseUrl,$mail_content);
   //$mailFrom                          =  "$name_from_sender "." < ".$email_from_sender." >";
   //message_table
	 $mailFrom                            =  'Nethaat';
	 $objDBReturn = $obj_msg->insertUpdatemessage_sub();
	 $send_lastid=$objDBReturn->nIdentity;
	 $comp_url = $baseUrl."view_messages.php?msg_id=".$send_lastid;
	 $full_message_link ='<a href="'.$comp_url.'"> Full Message</a>';
	 $subject_name        =  $sub;
	 $subject	         =  str_replace("#subject_name#",$subject_name,$subject);
     $mail_content		=  str_replace("#full_message_link#",$full_message_link,$mail_content);
	 
    $emailObj->SendHtmlMail($email_to_id,$subject,$mail_content,$mailFrom); //fwd
			 


					
					if($objDBReturn->nIdentity && $objDBReturn->nErrorCode==0)
					{
						
					}
					else if($objDBReturn->nIdentity==0 && $objDBReturn->nErrorCode==0)
					{
						//success_msg("Your request for custom item has been successfull");
						//header("Location:seller_custom_request.php");
					}
					else
					{
						failure_msg("Error occured ...!Please try again");
					}
			}
		}
		success_msg("Message has been sent successfully... ");
		redirect("reply_forward.php?msg_fwd_id=".$obj_msg->msg_fwd_id);
		}
		
}


//***************************** forword end messages *****************************






if(isset($_SESSION['session_user_id'])&& $_SESSION['session_user_id']!="")
{
	$obj_msg->trashid = $_SESSION['session_user_id'];
	$obj_msg->reciever_deleted = "1";
	$UserRes = $obj_msg->gettrashbox();
	$num_trash=mysql_num_rows($UserRes);
	while($UserArr = mysql_fetch_array($UserRes))
	{
		$items[]	=	$UserArr;
	}
	$smarty->assign("citem",$items);
	$smarty->assign("num_trash",$num_trash);
	
}


$smarty->assign('site_page_title',"Compose Message");
$smarty->assign('site_title',$site_title);
$smarty->display('reply_forward.tpl');
?>