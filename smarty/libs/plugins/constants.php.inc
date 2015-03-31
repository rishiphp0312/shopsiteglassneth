<?php
//start new session
session_start();

//set display errors
ini_set("display_errors","1");
$DOMAIN_NAME	=	$_SERVER['SERVER_NAME'];



/************************************** List of Constants used in site *********************************************************/

/**
* site title and mail
**/
$site_title	=	"Nethaat";
$mailFrom	=	"Nethaat<admin@nethaat.com>";


//define pagination limit
define("ADMIN_PAGE_NUMBER","10"); //for admin section
define("RESULT_PER_PAGE","15"); //for site search result

/**
* site base url and google API
**/ 
$baseUrl	= "http://www.flexsin.org/lab/net_haat/";
$google_api	= "ABQIAAAAsV3wt3z9PDIppT2rs8WhIxRBVgq3ZwfC423UluFxcRDeLDpUExS9ctVJPOZw2H9WWnv6U_N9KYdZmg";


$smarty->assign('google_api',$google_api);
$smarty->assign('baseUrl',$baseUrl);


/**
* Create Contact us drop down list array
**/
$contactOut   = array("General Inquiry","Buyers Inquiry", "Sellers Inquiry", "Advertising","Technical Support");
//$contactValue = array("mahipal_adhikari@seologistics.com","mahipaladhikari@gmail.com","pawan@seologistics.com","mahi_vae2004@yahoo.co.in");
$contactValue   = array("General Inquiry","Business Inquiry","Advertising","Technical Support");
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


/**
* define upload image directory for print coupon listing
**/
define("UPLOAD_LIST_DIR","upload/product/");
$smarty->assign("UPLOAD_LIST_DIR",UPLOAD_LIST_DIR);

/**
* set business details url
**/ 
$smarty->assign("businessUrl",$baseUrl."mybusniess/");
//$smarty->assign("businessUrl",$baseUrl);





//define item status array
$itemStatusArr = array(0=>'Pending',1=>'Active',2=>'Suspended');
$smarty->assign('itemStatusArr',$itemStatusArr);
?>