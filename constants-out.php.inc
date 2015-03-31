<?php
//start new session
session_start();

//set display errors
ini_set("display_errors","1"); //0- off, 3- ON
$DOMAIN_NAME	=	$_SERVER['SERVER_NAME'];

$consCountrycodes = array("CA","IN");

/************************************** List of Constants used in site *********************************************************/

/**
* site title and mail
**/
$site_title	=	"Nethaat";
$mailFrom	=	"Nethaat<admin@nethaat.com>";

// define usd as $
define("USD","USD"); //for admin section
$smarty->assign('USD',USD);
//define pagination limit
define("ADMIN_PAGE_NUMBER","10"); //for admin section
define("RESULT_PER_PAGE","15"); //for site search result
$file_extension_array = array("image/pjpeg","image/png","image/jpeg","image/gif",   "application/txt","application/doc","application/vnd.ms-excel","application/pdf");
define("file_extension_array",$file_extension_array); //for file extension


/**
* site base url and google API
**/ 
if($DOMAIN_NAME=="localhost")
{
	$baseUrl	= "http://localhost/nethaat/";
	$google_api	= "ABQIAAAAsV3wt3z9PDIppT2rs8WhIxRBVgq3ZwfC423UluFxcRDeLDpUExS9ctVJPOZw2H9WWnv6U_N9KYdZmg";
}
else
{
	$baseUrl	= "http://www.nethaat.com/";
	$google_api	= "ABQIAAAAm3ycQ1KaZT2_dw4Ny_2OrBTIt8xew0ipF9fWQ55wp9IQwSzzChREs-arvFHx5xxbGLEeF3gSMn1PDw";	
}

$smarty->assign('google_api',$google_api);
$smarty->assign('baseUrl',$baseUrl);


/**
* Create Contact us drop down list array
**/
$contactOut   = array("General Enquiry","Buyers Enquiry", "Sellers Enquiry", "Advertising","Technical Support","Partnership Enquiry");
//$contactValue = array("mahipal_adhikari@seologistics.com","mahipaladhikari@gmail.com","pawan@seologistics.com","mahi_vae2004@yahoo.co.in");
$contactValue   = array("General Enquiry","Buyers Enquiry", "Sellers Enquiry", "Advertising","Technical Support","Partnership Enquiry");
$smarty->assign('contactOut',$contactOut);
$smarty->assign('contactValue',$contactValue);


/**
* Create security question array
*/
$securityQusOut   = array("Mother's Maiden Name","Home Town", "Pets Name", "High School I Attended");
$securityQusValue = array("1","2","3","4");
$smarty->assign('securityQusOut',$securityQusOut);
$smarty->assign('securityQusValue',$securityQusValue);

/**
*@Added By	  : Mahipal Adhikari
*@Added On	  : 12-Nov-09
*@Description : defined constant for Admin page titles
**/
define("ADMIN_COMMON_TITLE","Administration");
define("ADMIN_LOGIN","Admin Login");
define("ADMIN_HOME","Admin Home");
define("ADMIN_ACCOUNT","Admin Account");
define("ADMIN_PAGE_MGMT","Admin Page Management");

/**
*@Added By	  : Mahipal Adhikari
*@Added On	  : 12-Nov-09
*@Description : defined constant for Site page titles
**/
define("SITE_HOME","Home");
define("SITE_BUYER","Buyer");
define("SITE_SELLER","Seller");
define("SITE_LOGIN","Member Login");
define("SITE_FORGOT_PASSWORD","Forgot Password");
define("SITE_RECOURCES","Recources");
define("SITE_CONTACT","Contact Us");
define("SITE_FEEDBACK","Feedback");
define("SITE_PAGE_ERROR","Error Found!");
define("SITE_MY_ACCOUNT","My Account");
define("SITE_EDIT_PROFILE","Edit Profile");
define("SITE_CHANGE_PWD","Change Password");
define("SITE_CHANGE_PAY","Change Payment Details");
define("SITE_TELL_FRIEND","Tell A Friend");
define("SITE_SIGNUP","Signup and create an acccount");
define("SITE_MAIL","My Mails");
define("SITE_CMS_TITLE","Nethaat");
define("DISCOUNT",10);
define("CURRENCY","USD");


/**
 * Define site user types
 */
$userTypeArr = array(1=>"System Administrator",2=>"Site Admin",3=>"Seller",4=>"Buyer"); 
$smarty->assign('userTypeArr',$userTypeArr);



/**
*@Added By	  : Mahipal Adhikari
*@Added On	  : 12-Nov-09
*@Description : defined constant paging dropdown
**/
$pagingnationArr = array("10","25","50","100");
$smarty->assign('pagingnationArr',$pagingnationArr);


//define item status array
$itemStatusArr = array(0=>'Pending',1=>'Active',2=>'Suspended');
$smarty->assign('itemStatusArr',$itemStatusArr);
?>