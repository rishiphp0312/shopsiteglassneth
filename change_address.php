<?php
include ('include/common.inc');
include ("include/authentiateUserLogin.php");
include ('class/class.user.inc');
include ('include/country_state_cat.php');
//create user class object
$objUser 		= new Class_User();
//echo $_SESSION['session_user_id'];
//submit form
$objUser->seller_id = $_SESSION['session_user_id'];
$addres_rows  = $objUser->get_UserAddressDetails();
$num_addres_rows     = mysql_numrows($addres_rows);
if($num_addres_rows>0)
{
  $arr_address_rows = mysql_fetch_assoc($addres_rows);
  $fetch_address1    = $arr_address_rows['address1'];
  $fetch_address2    = $arr_address_rows['address2'];
  $fetch_city        = $arr_address_rows['city'];
  $fetch_state       = $arr_address_rows['state'];
  $fetch_country     = $arr_address_rows['country_id'];
  $fetch_zipcode     = $arr_address_rows['zipcode'];
  
}
//echo '<pre>';
//print_r($arr_address_rows);
$smarty->assign('fetch_zipcode',$fetch_zipcode);
$smarty->assign('fetch_address2',$fetch_address2);
$smarty->assign('fetch_city',$fetch_city);
$smarty->assign('fetch_state',$fetch_state);
$smarty->assign('fetch_address1',$fetch_address1);
$smarty->assign('fetch_country',$fetch_country);
if($_SERVER['REQUEST_METHOD']=='POST')
{
	//extract post variables array
	extract($_POST);
	
	$error_msg = "";
	//if($existing_password != md5($OldPassword))
	//{
	//	$error_msg = "Entered Old Password is not correct";
	//}
	
	//if no errors found
	if($error_msg=="")
	{
		$objUser->change_address1  	= $change_address1;
                $objUser->change_address2       = $change_address2;
                $objUser->country_value         = $country_value;
                $objUser->zipcode               = $zipcode;
                $objUser->change_state          = $change_state;
		$objUser->id			= $_SESSION['session_user_id'];
	
		 $objDBReturn = $objUser->updateUseraddress();
		
		if($objDBReturn->nErrorCode==0)
		{
			
		$_SESSION['session_user_address'] =$objUser->change_address ;
		//	session.session_user_address}
		success_msg("Your address has been changed successfully!");
		}//end of if
		else
		{
			
			failure_msg("Error occured while updating your address, please try again later");
		}
		redirect('my_account.php');
	}//end of if
	
	//assign error messages
	$smarty->assign('error_msg',$error_msg);
}//end of if

//get user details
	$objUser->id = $_SESSION['session_user_id'];
	$UserRes = $objUser->getUserLoginDetails();
	$UserArr = mysql_fetch_array($UserRes);
	$smarty->assign("UserArr",$UserArr);

//display template
//$smarty->assign('site_page_title',SITE_CHANGE_PWD);
$smarty->assign('site_page_title','Change Address');

$smarty->assign('site_title',$site_title);
$smarty->display('change_address.tpl');
?>