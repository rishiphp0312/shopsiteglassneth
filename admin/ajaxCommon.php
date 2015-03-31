<?php
/**
 * This file is used to get common AJAX results
 */

include ("common_includes.php");

//Update Featured Listings
if (isset($_GET['online_coupon_id']) && isset($_GET['status']))
{	
	include ('../class/class.online_coupon.inc');
	$objOnlineCoupon = new Class_OnlineCoupon();
	
	//update Featured Listings
	$objOnlineCoupon->online_coupon_id 		= $_GET['online_coupon_id'];
	$objOnlineCoupon->featured				= $_GET['status']; //if this will show in featured listinf
	$objDBReturn 							= $objOnlineCoupon->insertUpdateOnlineCoupon();
	if($objDBReturn->nErrorCode==0 && trim($_GET['online_coupon_id'])!=""){
		echo"1";
	}else{
		echo"0";
	}
	exit(0);
}

//Get City Listings
if (isset($_POST['mailType']) && !empty($_POST['mailType']))
{
	include ("../class/class.user.inc");
	$objUser		= new Class_User();
	$objDBReturn 	= $objUser->selectCityRelatedUsers();
	while($resCity = mysql_fetch_array($objDBReturn)){
		if ($data == "")
		{
			$data .="\"".$resCity['city_id']."#".$resCity['name']."\""; 
		}
		else
		{
			$data .=", \"".$resCity['city_id']."#".$resCity['name']."\"";
		}
	}
	
	//Here we create Array of items to be used in JavaScript
	$response = " new Array($data);";
	header("content-type:text/plain");
	print $response;
	exit(0);
}
?>