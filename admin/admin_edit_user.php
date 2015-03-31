<?php
include ("common_includes.php");
include ("../include/adminsession.php.inc");
include ("../class/class.user.inc");

//create user class object
$objUser		= new Class_User();

//assign static labels and heading
$smarty->assign("form_heading","Edit Users Information");
$smarty->assign("return_link","admin_users.php");

//selects user details
if(isset($_SESSION["view_user_id"]) && $_SESSION["view_user_id"]!="")
{
	$objUser->user_id = $_SESSION["view_user_id"];
	$resUser = $objUser->selectUser();
	$resUserRow = mysql_fetch_array($resUser);	
	$smarty->assign('user',$resUserRow);
}

//update user information
if($_SERVER['REQUEST_METHOD']=='POST')
{
	extract($_POST);
	
	$error_msg = "";
	$objUser->user_id 			= $_SESSION["view_user_id"];
	$objUser->first_name		= rteSafe($f_name);
	$objUser->last_name			= rteSafe($l_name);
	$objUser->email 			= rteSafe($email);
	$objUser->password  		= rteSafe($pwd);
	$objUser->company_name   	= rteSafe($c_name);	
	$objUser->pb_name	  		= rteSafe($pb_name);
	$objUser->street_address	= rteSafe($street_address);
	$objUser->city				= rteSafe($city);
	$objUser->state_id			= $state_id;
	$objUser->country_id		= $country_id;
	$objUser->postcode			= rteSafe($zipcode);
	$objUser->email  			= rteSafe($c_email);
		
	//check existing email
	if($objUser->validateExisringEmail())
	{
		$error_msg = "<br>Provided email address already in use...!";
		
	}
	//if no errors found
	if($error_msg=="")
	{
		//update user information
		$objDBReturn = $objUser->insertUpdateUser();
		
		if($objDBReturn->nErrorCode==0)
		{
			header("location:admin_view_user_details.php");
		}
	}//end of if($error_msg=="")
	
	//assign error messages
	$smarty->assign('error_msg',$error_msg);
	
	//assign back all post variables
	$smarty->assign('first_name',$first_name);
	$smarty->assign('last_name',$last_name);
	$smarty->assign('c_name',$c_name);
	$smarty->assign('pb_name',$pb_name);
	$smarty->assign('street_address',$street_address);
	$smarty->assign('city',$city);
	$smarty->assign('state_id',$state_id);
	$smarty->assign('zipcode',$zipcode);
	$smarty->assign('c_email',$c_email);
	$smarty->assign('pwd',$pwd);
}
//assign error msg
$smarty->assign('err_message',$err_message);

			
//display template and title
$smarty->assign('site_page_title',ADMIN_COMMON_TITLE);
$smarty->assign('site_title',$site_title);
$smarty->display('admin_edit_user.tpl');	
?>