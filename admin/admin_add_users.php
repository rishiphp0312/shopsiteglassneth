<?php
include ("common_includes.php");
include ("../include/adminsession.php.inc");
include ("../class/class.user.inc");
//include ('../include/imageOptimization.php');
include ('../include/country_state_cat.php');


//create user class object
$objUser		= new Class_User();

//echo 'use='.$_GET['user_id'];
//selects user for edit
if(isset($_POST['featured_users']) && $_POST['featured_users']!="")
{
	extract($_POST);
	$objUser->id = trim($_GET['user_id']);
	$error_msg = "";

	$objUser->fetured_date 	=date("d/m/y : H:i:s",time());	
	$objUser->feturedstatus	= "1";
	//update user information
	$objDBReturn = $objUser->insertUpdateUser();
	if($objDBReturn->nErrorCode==0)
	{
		//header("location:admin_users.php");
		success_msg($update_msg);
	}
	else
	{
		failure_msg("Error occured, please try again later");
	}
}

if(isset($_GET['user_id']) && $_GET['user_id']!="")
{
	$objUser->id = trim($_GET['user_id']);
	$resUser = $objUser->selectUser();
	$resUserRow = mysql_fetch_array($resUser);
	
	//select forum user ID to updaate
	$objUser->Email     = $resUserRow['email'];
	$objUser->Password  = $resUserRow['Password'];
	$objUser->username  = $resUserRow['username'];
	$objUser->user_type = $resUserRow['user_type'];
	
	
	//$forum_user_id = $objUser->getForumUserDetails();
	//$smarty->assign('forum_user_id',$forum_user_id);
	
	$smarty->assign('FirstName',$resUserRow['first_name']);
	$smarty->assign('LastName',$resUserRow['last_name']);
	$smarty->assign('username',$resUserRow['username']);
	$smarty->assign('Email',$resUserRow['email']);
	$smarty->assign('Password',$resUserRow['password']);
	$smarty->assign('Phone',$resUserRow['phone1']);
	$smarty->assign('Zip',$resUserRow['zipcode']);
	$smarty->assign('EmailAlert',$resUserRow['EmailAlert']);
	$smarty->assign('nLetter',$resUserRow['nLetter']);
	$smarty->assign('UserType',$resUserRow['user_type']);
        
	//$smarty->assign('UserType',$user_type);

	$smarty->assign("state",$resUserRow['state']);
	
 	//$smarty->assign("user_country_name",$objUser->getcountry($resUserRow['country_id']));
	$smarty->assign("c",$resUserRow['country_id']);
	$smarty->assign("phone1",$resUserRow['phone1']);
 	$smarty->assign("phone2",$resUserRow['phone2']);
	$smarty->assign("paypal_email",$resUserRow['paypal_email']);
 	$smarty->assign("company_name",$resUserRow['company_name']);
	$smarty->assign("company_address",$resUserRow['company_address']);
 	$smarty->assign("company_phone",$resUserRow['company_phone']);
	$smarty->assign("store_name",$resUserRow['store_name']);
 	$smarty->assign("company_desc",$resUserRow['company_desc']);
	$smarty->assign("security_question",$resUserRow['security_question']);
 	$smarty->assign("security_answer",$resUserRow['security_answer']);
 	$smarty->assign("last_login",$resUserRow['last_login']);
        $smarty->assign("city_value",$resUserRow['city']);

	$smarty->assign("v_store_image",$resUserRow['v_store_image']);
	$smarty->assign("user_country_name",$objUser->getcountry($UserArr['country_id']));
	$smarty->assign("country_id",$UserArr['country_id']);

	$smarty->assign("v_welcome",$resUserRow['v_welcome']);
	$smarty->assign("v_payment",$resUserRow['v_payment']);
	$smarty->assign("v_shipping",$resUserRow['v_shipping']);
	$smarty->assign("v_refund_exchange",$resUserRow['v_refund_exchange']);
	$smarty->assign("v_additional_info",$resUserRow['v_additional_info']);
	$smarty->assign("id",$resUserRow['id']);
	
	
	//set update message
	$update_msg= "User information has been updated successfully!";
}
else
{
	$update_msg= "User information has been added successfully!";
}

if($objUser->user_type=='4' || $objUser->user_type=='' )
{

//$user_buyer_type ='checked';

}
if( $user_type=='3')
{
//	$user_seller_type ='checked';
}
//echo $objUser->user_type;
//insert/update user 
if($_SERVER['REQUEST_METHOD']=='POST')
{
	extract($_POST);
        
	$objUser->id 			= trim($_REQUEST['user_id']);
        $objUser->user_type             = trim($_REQUEST['user_type']);
	$error_msg = "";
	$objUser->email 		= rteSafe($Email);
	$objUser->username 		= rteSafe($username);
	//check existing email
    //exit;
	if($objUser->validateExisringEmail())
	{
	$error_msg = "Provided email address already in use...!";
	}
	if($objUser->validateExisringUsername())
	{
	$error_msg = "Provided username already in use...!";
	}
    //if no errors found

	if($error_msg=="")
	{
		$objUser->first_name	        =	rteSafe($FirstName);
		$objUser->last_name		=	rteSafe($LastName);
		$objUser->username		=	rteSafe($username);
		
		$objUser->email			=	rteSafe($Email);
		//$objUser->Password	        =	rteSafe($Password);
		$objUser->zipcode		=	rteSafe($Zip);	
		$objUser->EmailAlert	        =	$EmailAlert;
		$objUser->nLetter		=	$nLetter;
		$objUser->Status		=	1; //set active by default
		$objUser->phone1		=	$phone1;
                $objUser->city_value		=	$city_value;
		
		//if($_POST['user_type']==3) // for seller
		//{
		$objUser->country_id	=	$country_value; 
		$objUser->state			=	$state;
		$objUser->phone2		=	$phone2;
		$objUser->paypal_email	=	$paypal_email;
	//	$objUser->store_name	=	rteSafe($store_name);
		$objUser->company_name  =	$company_name;
		$objUser->company_address = rteSafe($company_address);
		$objUser->company_phone =	$company_phone;		
		$objUser->company_desc	=	rteSafe($company_desc);
	    $objUser->payment		= rteSafe($v_payment);
		$objUser->welcome		= rteSafe($v_welcome);
		$objUser->shipping		= rteSafe($v_shipping);
		$objUser->refund		= rteSafe($v_refund_exchange);
		$objUser->additional	= rteSafe($v_additional_info);
	     //}
	   if($_POST['user_type']==4) // buyer
		{
	/*
                $objUser->country_id		=	'';
		//$objUser->state				=	'';
		$objUser->phone2			=	'';
		$objUser->paypal_email		=	'';
		$objUser->store_name		=	'';
		$objUser->company_name  	=	'';
		$objUser->company_address 	= 	'';
		$objUser->company_phone 	=	'';		
		$objUser->company_desc		=	'';
		$objUser->payment			= 	'';
		$objUser->welcome			= 	'';
		$objUser->shipping			= 	'';
		$objUser->refund			= 	'';
		$objUser->additional		= 	'';
	    */
               
            }

		//update user information
		$objDBReturn = $objUser->insertUpdateUser();
		$objDBReturn->nErrorCode;
		
		if($objDBReturn->nErrorCode==0)
		{
			//header("location:admin_users.php");
			success_msg($update_msg);
		}
		else
		{
			failure_msg("Error occured, please try again later");
		}
		redirect("admin_users.php");
	}//end of if($error_msg=="")
		
		// $user_type.'--'.$user_type;	
	//assign error messages

	$smarty->assign('error_msg',$error_msg);

	//assign back all post variables
	//$smarty->assign('user_b_type',$user_buyer_type);
		//$smarty->assign('user_s_type',$user_seller_type);
	$smarty->assign('UserType',$user_type);
	
	$smarty->assign('FirstName',$FirstName);
	$smarty->assign('LastName',$LastName);
	$smarty->assign('Email',$Email);
	$smarty->assign('Password',$Password);
	$smarty->assign('Phone',$Phone);
	$smarty->assign('Zip',$Zip);
	$smarty->assign('EmailAlert',$EmailAlert);
	$smarty->assign('nLetter',$nLetter);
}

//assign error msg
//echo  $user_type;
$smarty->assign('err_message',$err_message);

			
//display template and title
$smarty->assign('site_page_title',ADMIN_COMMON_TITLE);
$smarty->assign('site_title',$site_title);
$smarty->display('admin_add_users.tpl');	
?>