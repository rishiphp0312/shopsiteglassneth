<?php
include("../fckeditor/fckeditor.php");
//create mail class object
$objMail 	= new Class_Mail();


//get monthly news Letter Content
$objMail->mail_title	= "News Letter"; 
$MailRes2 				= $objMail->selectMailTemplate();
$mailRowArr2 			= mysql_fetch_array($MailRes2);
$mail_content2			= $mailRowArr2['mail_content'];

if(isset($_POST["message"]) && $_POST["message"]!="")
{
	$mail_content2	= $_POST["message"];
}

$message = stripslashes($mail_content2);
$oFCKeditor = new FCKeditor('message') ;
$oFCKeditor->BasePath   = '../fckeditor/' ;
$oFCKeditor->Value= $message ;
$oFCKeditor->Width='100%';
$oFCKeditor->Height='485' ;
$oFCKeditor->Create() ;
?>

