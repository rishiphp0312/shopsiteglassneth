<?php
include ('include/common.inc');
include ("class/class.user.inc");

$objUser   = new Class_User();


if(isset($_POST['submit'])&& $_POST['submit']!="")
{
	$objUser->id = $_SESSION['session_user_id'];
	
	extract($_POST);
	//$q=date("Y-m-d H:i:s");
	$date = date("Y-m-d H:i:s");
	$newdate = strtotime ( '+'.$pass_expry.' days' , strtotime ( $date ) ) ;
	$newdate = date ( 'Y-m-j H:i:s' , $newdate );
	
	$objUser->locker_password =rteSafe($locker_pass);
	$objUser->locker_create_date =rteSafe($date);
	$objUser->locker_last_date =rteSafe($newdate);
	if($error_msg=="")
	{
		$objDBReturn = $objUser->getUserDetailsupdate();
		if($objDBReturn->nErrorCode==0)
		{
			success_msg("Your password for locker has been set..!!");
			//$onload="upd_function();";
			header("location:locker_items_seller.php");
		}
		else
		{
			$error_msg = "Error occured ...!Please try again";
			$onload="upd_function();";
		
		}
	}
}

//display template
$smarty->assign('site_page_title','Nethaat : Locker Password');
$smarty->assign('site_title',$site_title);
$smarty->display('locker_password.tpl');
?>