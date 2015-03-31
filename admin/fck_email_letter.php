<?php
include("../fckeditor/fckeditor.php");
//create mail class object


//get monthly news Letter Content

//create object of Mail Content class
$Objmail = new Class_Mail();
$Objmail->mail_id     = $_GET['edit_id'];
$objResMailTemplates  = $Objmail->selectMailTemplate();
$total_MailTemplates  = mysql_num_rows($objResMailTemplates);



$message = stripslashes($mail_content2);
$oFCKeditor = new FCKeditor('mail_content') ;
$oFCKeditor->BasePath = '../fckeditor/' ;
if($total_MailTemplates>0)
{
$mail_fetchcontent          =  mysql_fetch_assoc($objResMailTemplates);

$oFCKeditor->Value          = $mail_fetchcontent['mail_content'];
}
 

$oFCKeditor->Width    = '100%';
$oFCKeditor->Height   = '485' ;
$oFCKeditor->Create();
?>

