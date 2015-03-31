<?php
include ("common_includes.php");
include ("../include/adminsession.php.inc");


$smarty->assign("form_heading","Manage Mail Content");
//create mail class object


//create object of Mail Content class
$Objmail                  = new Class_Mail();
$Objmail->mail_id         = $_GET['edit_id'];
$objResMailTemplates      = $Objmail->selectMailTemplate();
$total_MailTemplates      = mysql_num_rows($objResMailTemplates);

$smarty->assign('total_MailTemplates',$total_MailTemplates);
if($total_MailTemplates>0)
{
$mail_fetchcontent         =  mysql_fetch_assoc($objResMailTemplates);
$smarty->assign('mail_content',$mail_fetchcontent['mail_content']);
$smarty->assign('mail_subject',$mail_fetchcontent['mail_subject']);
}
$smarty->assign('message',$message);


if($_SERVER['REQUEST_METHOD']=='POST')
{
      $mail_content             = $_POST['mail_content'];
	  $mail_subject             = $_POST['subject'];
	  $Objmail->mail_id         = $_POST['edit_id'];
	  $Objmail->mail_subject    = html_entity_decode($mail_subject);
	  $Objmail->mail_content    = html_entity_decode($mail_content);
	  $objResMailTemplates      = $Objmail->insertUpdateMailTemplate();
	
	  if($objResMailTemplates->nErrorCode==0)
	  {
	     $update_msg ="Mail Content updated successfully!!";
		 success_msg($update_msg);
	  }
	  else
	  {
		 failure_msg("Error occured, please try again later");
	  }
	redirect("view_mail_listing.php");
	  
}
	//while($arr_fetch_templates = mysql_fetch_assoc($total_MailTemplates ))
	//{
	// $mail_content[]           =  $arr_fetch_templates;
	//}






   


//display template and title
$smarty->assign('site_page_title',ADMIN_COMMON_TITLE);
$smarty->assign('site_title',$site_title);
$smarty->display('admin_edit_emailcontent.tpl');	
?>