<?php
include ('include/common.inc');
include ("include/authentiateUserLogin.php");
include ('class/class.user.inc');
include ('class/class.message.inc');
include ('class/class.mail.inc');
include ('include/sendEmailClass.php');
include ('captcha/php-captcha.php');


$obj_user = new Class_User();
$obj_msg  = new Class_Message();
//create user class object
//$objUser = new Class_User();

// Creating object of SendEmailClass


//*******************************************************************

if(isset($_SESSION['session_user_id'])&& $_SESSION['session_user_id']!="")
{
	$obj_msg->sentid = $_SESSION['session_user_id'];
	$UserRes = $obj_msg->getSendbox();
 	$num_sent=mysql_num_rows($UserRes);
	if($num_sent>0)
	{
	while($UserArr = mysql_fetch_array($UserRes))
	{
		$items[]	=	$UserArr;
	}
	}
	$smarty->assign("citem",$items);
	$smarty->assign("num_sent",$num_sent);
	
}

if(isset($_SESSION['session_user_id'])&& $_SESSION['session_user_id']!="")
{
	$obj_msg->inboxid    = $_SESSION['session_user_id'];
	$obj_msg->inbox_read = "0";
	$UserRes             = $obj_msg->getinbox();
	$num_in              = mysql_num_rows($UserRes);
	if($num_in>0)
	{
	while($UserArr = mysql_fetch_array($UserRes))
	{
 		$items_in[]	=	$UserArr;
	}
	}
	$smarty->assign("in_item",$items_in);
	$smarty->assign("num_in",$num_in);
	
}






//*******************************************************************
//*************************** Record of available user ****************
$obj_user                        = new Class_User();
$obj_user->id                    = 	  '';

$result_users                    = $obj_user->selectUser();
$num_value_users_details         = mysql_num_rows($result_users);
if($num_value_users_details >0)
{
	while($arr_fetch_users_details         = mysql_fetch_assoc($result_users))
	{
		$user_details_value[]    = $arr_fetch_users_details;
	}
}

//*************************** Record of available user ****************

$smarty->assign("user_details_value",$user_details_value);

if(isset($_POST['post']))
{ 
 
   	extract($_POST);
    /*
	$emailObj 	                      = new SendEmailClass;
	$obj_user->id                     = $_SESSION['session_user_id'];
    $result_users1                    = $obj_user->selectUser();
    $num_value_users_details1         = mysql_num_rows($result_users1);
    exit;
	if($num_value_users_details1 >0)
     {
	$arr_fetch_users_details1         = mysql_fetch_assoc($result_users1);
      }
    $name_from         =   $arr_fetch_users_details1['first_name'].''.$arr_fetch_users_details1['last_name'];
	$email_from        =   $arr_fetch_users_details1['email'];
    */
	$obj_msg->message  =   $message;
	$obj_msg->subject  =   $sub;
	$objDBReturn = $obj_msg->insertUpdatemessage();
	$ms_id=$objDBReturn->nIdentity;
	
	// below is the code for mail notification
/*
	$objMail 	                          =  new Class_Mail();
	$objMail->mail_title	              =  "Email Template"; 
    $MailTemplate			              =  $objMail->selectMailTemplate();
    $templateRowArr 		              =  mysql_fetch_array($MailTemplate);
    $mail_content			              =  $templateRowArr['mail_content'];
    $mail_content			              =  str_replace("#link#",$baseUrl,$mail_content);
	
	$objMail->mail_title	              =  "Auto_Email_Message"; 
	$MailTemplate			              =  $objMail->selectMailTemplate();
	$templateRowArr 		              =  mysql_fetch_array($MailTemplate);
    $mail_content1			              =  $templateRowArr['mail_content'];
	$mail_content			              =  str_replace("#message_content#",$mail_content1,$mail_content);
	$mail_content			              =  str_replace("#link#",$baseUrl,$mail_content);
	$subject 				              =  $templateRowArr['mail_subject'];  
	$subject			                  =  str_replace("#sender_name#",$name_from,$subject);
*/	
    
  //	sender_name

 	//  it is the end of code
	if($objDBReturn->nIdentity && $objDBReturn->nErrorCode==0)
	{ 
	foreach ($user_ids_for_message as $key => $a)
	{
			$obj_msg->msg_id	              =	$ms_id;
			$obj_msg->reciverid		          =	$a;
		
			$obj_msg->sender_id		          =	$_SESSION['session_user_id'];
/*
	        $obj_user->id                     = $a;
            $result_users2                    = $obj_user->selectUser();
            $num_value_users_details2         = mysql_num_rows($result_users2);
            if($num_value_users_details2 >0)
               {
	       $arr_fetch_users_details2          = mysql_fetch_assoc($result_users2);
	          
				}
		   $email_to_id                       = $arr_fetch_users_details2['email'];
			//exit;
			// $email_to_id                     = 'rishi_kapoor@seologistics.com';
			 $name_to                         = $arr_fetch_users_details2['first_name'].''. $arr_fetch_users_details2['last_name'];


             $mail_content			              =  str_replace("#name#",$name_to,$mail_content);
			 $mail_content			              =  str_replace("#message_table#",$message,$mail_content);	
             $mail_content			              =  str_replace("#link#",$baseUrl,$mail_content);
	         //$mailFrom                          =  "$name_from_sender "." < ".$email_from_sender." >";
	         //message_table
			 $mailFrom                            =  "Nethaat";
             $emailObj->SendHtmlMail($email_to_id,$subject,$mail_content,$mailFrom);
			 */
			 //$_SESSION['session_user_id']	
			$objDBReturn = $obj_msg->insertUpdatemessage_sub();
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
	redirect("compase_message.php");
	}
	else
	{
		failure_msg("Error occured ...!Please try again");
	}




	
}	 


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
$smarty->display('compase_message.tpl');
?>