<?php
// email notification for expring items and package on day of expiry date
// email notification for sending reminder before 15 days
/*include ('include/common.inc');
include ('class/class.package.inc');
include ('class/class.user.inc');
include ('class/class.mail.inc');
include ('include/sendEmailClass.php');
include ('captcha/php-captcha.php');*/
include ('class/dbconnector.inc'); //DB connection file
include ('include/functions.php'); //common functions
include ('class/class.cms.inc');
include ('class/class.user.inc');
include ('class/class.mail.inc');
include ('class/class.item.inc');
include ('class/class.package.inc');
include ('include/sendEmailClass.php');
//include ('captcha/php-captcha.php');
$baseUrl        = "http://www.nethaat.com/";
// done-linux
//create user class object
$emailObj 	    = new SendEmailClass;
$objUser        = new Class_User();
// mail('rishi_kapooor@seologistics.com','hi','implode_item_id' );
$objPackage     = new Class_Package();
$objItem        = new Class_Item();

$objPackage->check_expiry       = 1;
$objPackage->payment_status     = 1;
$mailFrom                       =  "Nethaat";
$objResCatTotal = $objPackage->getPackagedetails();
echo 'pkg-num'.$num_rows_pacakage = mysql_num_rows($objResCatTotal);
if($num_rows_pacakage>0)
{
  while($arr_fetch_asoc_pack_info = mysql_fetch_assoc($objResCatTotal))
    {
  	   echo $pack_trans_id          = $arr_fetch_asoc_pack_info['pack_id'];
	   $package_max_items           = $arr_fetch_asoc_pack_info['max_items'];
	   $package_seller_id           = $arr_fetch_asoc_pack_info['seller_id'];		
       echo '<br>';
       // $objPackage->pack_id         = $pack_trans_id;
       // $getpackage_details          = $objPackage->getPackagedetails();
       //$num_rows_pacakagedetails    = mysql_num_rows($getpackage_details);
       //if($num_rows_pacakagedetails>0)
       // {
       //$arr_fetch_asoc_pack_info   = mysql_fetch_assoc($getpackage_details);
       //echo '<br>';
       //}
	   
       // fetch start 25 items
    
		 $objItem->seller_id          = $package_seller_id;
		 $objItem->delete_by_seller   = 0;
		 $objItem->order_by_variable  = 1;

		 //$this->order_by_variable==''
		 // $objItem->seller_id          = $package_seller_id;

		 // change in function to fetch 25 by asc
		 $objItem->limit_max_items    = 25;
		 $objItem->orderexp_items_id  = 1;
		 $get_items_ids               = $objItem->getItemImageDetails();
		// echo '<br>';
		 $num_items                   = mysql_num_rows($get_items_ids);
		 $arr_allitem_ids='';
		 if($num_items>0)
		   {
				while($arr_fetch_allitem_ids = mysql_fetch_assoc($get_items_ids))
				{
				$arr_allitem_ids[]    = $arr_fetch_allitem_ids['item_id'];
				}
       		$implode_item_id      = implode(',',$arr_allitem_ids);
		   }
		 mail('rishi_kapooor@seologistics.com','hi package expiry status updated',$implode_item_id ,$mailFrom);
		 $objItem->expired_package    = 1;//making items expired	
	     echo '<br>';
		 echo  $objItem->implode_item_ids   = $implode_item_id;
		  // $objItem->max_item             = $package_max_items;
		 $make_expire_items           = $objItem->insertUpdateExpireItem();
		 // function to expire items
		 $objPackage->pack_id         = $pack_trans_id;		 
		 $objPackage->status          = 0; // after expiry date status will be 0
		 $objPackage->insertUpdatePurchase_Package();
		 
     }
}
echo 'emobj=='.$emailObj->SendHtmlMail('rishi_kapoor@seologistics.com','hi package expiry status updated',$chek_r,$mailFrom);
echo 'emobj=='.$emailObj->SendHtmlMail('rishi_kapoor@seologistics.com','sending message page 2',$implode_item_id,$mailFrom);
mail('rishi_kapooor@seologistics.com','hi package expiry status updated',$implode_item_id,$mailFrom);
//echo '<pre>';
//print_r($arr_allitem_ids);
//echo '</pre>';
?>
