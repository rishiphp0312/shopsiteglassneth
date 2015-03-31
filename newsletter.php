<?php
include ('include/common.inc');
include ('class/class.news_letter.inc');

//create news_letter class object
$objNLetter 	= new Class_NewsLetter();


//submit form
if($_SERVER['REQUEST_METHOD']=='POST')
{
	//extract post variables array
	extract($_POST);
	$objNLetter->news_letter_email  = rteSafe($news_letter_email);
		
	$error_msg = "";	
	//check existing email
	if($objNLetter->validateExisringEmail())
	{
		failure_msg("Provided email address already in use...!");
		redirect($_SERVER['HTTP_REFERER']);
	}
	//if no errors found
	if($error_msg=="")
	{
		$objDBReturn = $objNLetter->insertUpdateNewsLetter();
		
		if($objDBReturn->nIdentity && $objDBReturn->nErrorCode==0)
		{
			success_msg("Your request for News Letter service has been submitted successfully!");
			redirect($_SERVER['HTTP_REFERER']);
		}//end of if
	}//end of if
	
}//end of if

//assign page title and display template
//$smarty->assign('site_page_title',SITE_HOME);
//$smarty->assign('site_title',$site_title);
//$smarty->display('newsletter.tpl');
?>