<?php
//require 'smarty/libs/Smarty.class.php';
include ('include/common.inc');
include ('class/class.cms.inc');
include ('class/class.mail.inc');
include ('class/class.user.inc');
include ('include/sendEmailClass.php');
include ('captcha/php-captcha.php');
include ("include/authentiateUserLogin.php");
include ('include/country_state_cat.php');

//create business class object
$objCMS	= new Class_CMS();

//create user class object
$objUser = new Class_User();

//create mail class object
$objMail 	= new Class_Mail();

// Creating object of SendEmailClass
$emailObj 	= new SendEmailClass;

//get user details if user logged in
if(isset($_SESSION['session_user_id'])&& $_SESSION['session_user_id']!="")
{

	$objUser->id = $_SESSION['session_user_id'];
	$UserRes = $objUser->getUserDetails();
	$UserArr = mysql_fetch_array($UserRes);
	
	//assign user details information

	$smarty->assign("f_name",$UserArr['first_name']);
 	$smarty->assign("l_name",$UserArr['last_name']);
	$smarty->assign("username",$UserArr['username']);
 	$smarty->assign("email",$UserArr['email']);
	$smarty->assign("reg_date",$UserArr['reg_date']);
 	$smarty->assign("address1",$UserArr['address1']);
	$smarty->assign("address2",$UserArr['address2']);
 	$smarty->assign("city",$UserArr['city']);
	$smarty->assign("zipcode",$UserArr['zipcode']);
 	$smarty->assign("state",$UserArr['state']);
	$smarty->assign("f_name",$UserArr['first_name']);

 	$smarty->assign("user_country_name",$objUser->getcountry($UserArr['country_id']));
	$smarty->assign("country_id",$UserArr['country_id']);
	$smarty->assign("phone1",$UserArr['phone1']);
 	$smarty->assign("phone2",$UserArr['phone2']);
	$smarty->assign("paypal_email",$UserArr['paypal_email']);
 	$smarty->assign("company_name",$UserArr['company_name']);
	$smarty->assign("company_address",$UserArr['company_address']);
 	$smarty->assign("company_phone",$UserArr['company_phone']);
	$smarty->assign("store_name",$UserArr['store_name']);
 	$smarty->assign("company_desc",$UserArr['company_desc']);
	$smarty->assign("security_question",$UserArr['security_question']);
 	$smarty->assign("security_answer",$UserArr['security_answer']);
 	$smarty->assign("last_login",$UserArr['last_login']);
	$smarty->assign("private_public_store",$UserArr['private_public_store']);

	$smarty->assign("v_store_image",$UserArr['v_store_image']);

	$smarty->assign("v_welcome",$UserArr['v_welcome']);
	$smarty->assign("v_payment",$UserArr['v_payment']);
	$smarty->assign("v_shipping",$UserArr['v_shipping']);
	$smarty->assign("v_refund_exchange",$UserArr['v_refund_exchange']);
	$smarty->assign("v_additional_info",$UserArr['v_additional_info']);
	$smarty->assign("id",$UserArr['id']);

	$smarty->assign("locker_password",$UserArr['locker_password']);
	$smarty->assign("locker_create_date",$UserArr['locker_create_date']);
	$smarty->assign("locker_last_date",$UserArr['locker_last_date']);
	
}

if(isset($_POST['submit'])&& $_POST['submit']!="")
{
	$objUser->id = $_SESSION['session_user_id'];
	//$UserRes = $objUser->getUserDetailsupdate();
	
	extract($_POST);
	
	$objUser->private_public_store =$_POST['make_info_pvt_pub'];
	$objUser->f_name =rteSafe($f_name);
	$objUser->l_name = rteSafe($l_name);
	//$objUser->email = rteSafe($email);
	$objUser->address1 =rteSafe( $address1);
	$objUser->address2 =rteSafe($address2);
	$objUser->city =rteSafe($city);
	$objUser->zipcode =rteSafe($zipcode);
	$objUser->country_id = $country_value;
	$objUser->payment_type = 0;

	$objUser->phone1 =rteSafe($phone1);
	$objUser->phone2 =rteSafe($phone2);
	$objUser->paypal_email = rteSafe($paypal_email);
	$objUser->company_name = rteSafe($company_name);
	$objUser->company_address = rteSafe($company_address);
	$objUser->company_phone =rteSafe($company_phone);
	$objUser->store_name =rteSafe($store_name);
	$objUser->company_desc =rteSafe($company_desc);
	$objUser->security_question = $security_question;
	$objUser->security_answer =rteSafe($security_answer);
	$objUser->state =rteSafe($state);
	$POST_MAX_SIZE = '2M';
	$mul = substr($POST_MAX_SIZE, -1);
	$mul = ($mul == 'M' ? 1048576 : ($mul == 'K' ? 1024 : ($mul == 'G' ? 1073741824 : 1)));
	if ($_SERVER['CONTENT_LENGTH'] > $mul*(int)$POST_MAX_SIZE ) 
		$error = 'true';
	else
		$error = 'false';
		$error ;
	if($error=='true')
	{
		failure_msg("Error occured filsize cannot be ");
		$onload="upd_function();";
	}
	if($_FILES['storeimage']['type']=="")
	{
		$objUser->store_logo =rteSafe($store_image_upd);
	}
	else
	{
		if($_FILES['storeimage']['type']=='image/jpeg'||$_FILES['storeimage']['type']=='image/png' || $_FILES['storeimage']['type']=='image/gif' )
		{
			if($_FILES['storeimage']['tmp_name']!='' )
			{
				$tmp_name_file      = $_FILES['storeimage']['tmp_name'];
				$file_name          = basename($_FILES['storeimage']['name']);
				$file_ext           = explode(".",$file_name);
				$file_ext_len       = count($file_ext);
				$file_ext_value     =  $file_ext[$file_ext_len-1];
				$store_holder_id = $_SESSION['session_user_id'];
				$file_name_with_ext = time().'-'.$store_holder_id.'.'.$file_ext_value;
				$flg = move_uploaded_file($tmp_name_file,'uploads/store_logos/'.$file_name_with_ext);
				if($flg==1)
				{
					$namesof_files  = $file_name_with_ext;
					$objUser->store_logo =$namesof_files;
					
					@unlink('uploads/store_logos/'.$store_image_upd);
					@unlink('uploads/thumbs/'.$store_image_upd);
				}
			}// end of if
		}
		else
		{
			failure_msg("Error occured file type should be  .jpg,.gif,.png");
			$onload="upd_function();";
		}
	}// end else

	if($error_msg=="")
	{
		$objDBReturn = $objUser->getUserDetailsupdate();
		if($objDBReturn->nErrorCode==0)
		{
			success_msg("Your Store information successfully Update..!!");
			//$onload="upd_function();";
			header("location:store_info.php");
		}
		else
		{
			$error_msg = "Error occured ...!Please try again";
			$onload="upd_function();";
		
		}
	}
}

if(isset($_POST['locker_submit'])&& $_POST['locker_submit']!="")
{
	$objUser->id = $_SESSION['session_user_id'];
	
	extract($_POST);
	//$q=date("Y-m-d H:i:s");
	$date = date("Y-m-d H:i:s");
	$a="15";
	$newdate = strtotime ( '+'.$a.' days' , strtotime ( $date ) ) ;
	$newdate = date ( 'Y-m-j H:i:s' , $newdate );
	
	$objUser->locker_password =rteSafe($locker_pass);
	$objUser->locker_create_date =rteSafe($date);
	$objUser->locker_last_date =rteSafe($newdate);
	if($error_msg=="")
	{
		$objDBReturn = $objUser->getUserDetailsupdate();
		if($objDBReturn->nErrorCode==0)
		{
			success_msg("Your Store information successfully Update..!!");
			//$onload="upd_function();";
			header("location:store_info.php");
		}
		else
		{
			$error_msg = "Error occured ...!Please try again";
			$onload="upd_function();";
		
		}
	}
}
$smarty->assign("error_msg",$error_msg);
$smarty->assign("update_msg",$update_msg);
$smarty->assign("onload",$onload);

//display template
$smarty->assign('site_page_title','My Account');
$smarty->assign('site_title',$site_title);
$smarty->display('store_info.tpl');
?>
