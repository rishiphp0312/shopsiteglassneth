<?php
include ('include/common.inc');
include ('class/class.news_letter.inc');
include ('class/class.user.inc');

//check existing email for news letter signup
if(isset($_GET['news_letter_email']) && $_GET['news_letter_email']!="")
{  
	$objNewsLtr = new Class_NewsLetter(); 
 	$objNewsLtr->news_letter_email  = rteSafe($_GET['news_letter_email']);  
	if($objNewsLtr->validateExisringEmail())
	{  
	    echo "false";
	}  
	else
	{  
	    echo "true";
	}
}//end of if


//check existing email for new user registration
if(isset($_GET['email']) && $_GET['email']!="")
{  
	//create user class object
	$objUser 		= new Class_User();
 	$objUser->email = rteSafe($_GET['email']);  
	if(isset($_SESSION['session_user_id']))
	{
		$objUser->id = $_SESSION['session_user_id'];
	}
	if(isset($_GET['user_id']))
	{
		$objUser->id = $_SESSION['user_id'];
	}
	if($objUser->validateExisringEmail())
	{  
	    echo "false";
	}  
	else
	{  
	    echo "true";
	}
}//end of if

//check existing username
if(isset($_GET['username']) && $_GET['username']!="")
{  
	//create user class object
	$objUser 		   = new Class_User();
 	$objUser->username = rteSafe($_GET['username']);  
	if(isset($_SESSION['session_user_id']))
	{
		$objUser->id = $_SESSION['session_user_id'];
	}
	if(isset($_GET['user_id']))
	{
		$objUser->id = $_SESSION['user_id'];
	}
	if($objUser->validateExisringUsername())
	{  
	    echo "false";
	}  
	else
	{  
	    echo "true";
	}
}//end of if

//check existing paypal_email for store/business details
if(isset($_GET['paypal_email']) && $_GET['paypal_email']!="")
{  
	//create user class object
	$objUser 			   = new Class_User();
 	$objUser->paypal_email = rteSafe($_GET['paypal_email']);  
	if(isset($_SESSION['session_user_id']))
	{
		$objUser->id = $_SESSION['session_user_id'];
	}
	if(isset($_GET['user_id']))
	{
		$objUser->id = $_SESSION['user_id'];
	}
	if($objUser->validateExisringPaypalEmail())
	{  
	    echo "false";exit;
	}  
	else
	{  
	    echo "true";exit;
	}
}//end of if	   
?>  