<?php

session_start();

//set display errors
if($_SERVER['REMOTE_ADDR']=='203.122.51.27')
//if($_SERVER['REMOTE_ADDR']=='127.0.0.1')
ini_set("display_errors","1"); //0- off, 3- ON
else
ini_set("display_errors","1"); //0- off, 3- ON

$DOMAIN_NAME	=	$_SERVER['SERVER_NAME'];

/************************************** List of Constants used in site *********************************************************/

//site title and mail
$site_title	=	"Nethaat";
$mailFrom	=	"Nethaat<admin@nethaat.com>";


//define pagination limit
define("ADMIN_PAGE_NUMBER","10"); //for admin section
define("RESULT_PER_PAGE","15"); //for site search result

//site base url and google API
$baseUrl	= "http://localhost/nethaat/";
//$baseUrl	= "http://www.nethaat.com/";
$google_api	= "ABQIAAAAm3ycQ1KaZT2_dw4Ny_2OrBTIt8xew0ipF9fWQ55wp9IQwSzzChREs-arvFHx5xxbGLEeF3gSMn1PDw";	
$smarty->assign('google_api',$google_api);
$smarty->assign('baseUrl',$baseUrl);


//Create Contact us drop down list array
$contactOut = array("General Enquiry","Buyers Enquiry","Sellers Enquiry","Advertising","Technical Support","Partnership Enquiry");
$contactValue   = array("General Enquiry","Buyers Enquiry","Sellers Enquiry","Advertising","Technical Support","Partnership Enquiry");
$smarty->assign('contactOut',$contactOut);
$smarty->assign('contactValue',$contactValue);
define("file_extension_array",$file_extension_array); //for file extension

/**
* Create security question array
*/
$securityQusOut   = array("Mother's Maiden Name","Home Town","Pets Name","High School I Attended");
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
define("PAYPAL_URL",'https://www.paypal.com/cgi-bin/webscr');
//define("PAYPAL_URL",'https://www.sandbox.paypal.com/cgi-bin/webscr');




/**
 * Define site user types
 */
$userTypeArr = array(1=>"System Administrator",2=>"Site Admin",3=>"Seller",4=>"Buyer"); 
$smarty->assign('userTypeArr',$userTypeArr);

//$array_country_codes = array("IN","CA");

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


//define item status array
$metaPageValue =array();
$metaPageValue = array('index.php','buyer.php','hatting-items.php','show_tutorial.php');
$smarty->assign('metaPageValue',$metaPageValue);
$metaPageName =array();
//define item status array
$metaPageName = array('Home Page','Buy Item Page','Haated Item Page','Show Tutorial Page');
$smarty->assign('metaPageName',$metaPageName);


?>