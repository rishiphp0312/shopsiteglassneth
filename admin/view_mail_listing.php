<?php
include ("common_includes.php");
include ("../include/adminsession.php.inc");
$smarty->assign("form_heading","Manage Mail Content");
//create mail class object


//create object of Mail Content class
$Objmail = new Class_Mail();
$mail_fetchcontent    = array();
$objResMailTemplates  = $Objmail->selectMailTemplate();
$total_MailTemplates  = mysql_num_rows($objResMailTemplates);
$smarty->assign('total_MailTemplates',$total_MailTemplates);
if($total_MailTemplates>0)
{
  while($arr_fetch_templates = mysql_fetch_assoc($objResMailTemplates ))
  {
   $mail_fetchcontent[]           =  $arr_fetch_templates;
  }


}
$smarty->assign('mail_fetchcontent',$mail_fetchcontent);





   


//display template and title
$smarty->assign('site_page_title',ADMIN_COMMON_TITLE);
$smarty->assign('site_title',$site_title);
$smarty->display('view_mail_listing.tpl');	
?>