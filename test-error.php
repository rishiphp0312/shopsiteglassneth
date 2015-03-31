<?php
include ('include/common.inc');
include ("class/class.user.inc");
include ("class/class.item.inc");
include ('class/class.cms.inc');
include ('class/class.news_letter.inc');
$smarty->assign("anObject" , new Class_Dynamic() );
// echo 'user-ip'.$userip; echo 'remote'.$_SERVER['REMOTE_ADDR'];
//echo 'sesion=='.$_SESSION['session_user_id'];


/***************************************** code for recent products  items START  *********************************/
$objItem1	= new Class_Item();
$objItem1->inventory_check = 1 ;
//$objItem->hat_max_value    = 1;
$objItem1->delete_by_seller = 0; //not deleted by seller
$objItem1->val_limit       = 91;
$objItem1->status          = 1;
$objItem1->recent_status   = 1;
$objItem1->hand_pickstatus = 0;
$objItem1->request_item_id  = 0; // request items should not be displayed
//$objItem1->hatting_status  = 0;
//$objItem1->approve_store = 1;
$objItem1->locker_status   = 0; 
$objItem1->delete_restored = 0;  // 0 for showing restored 1 means deleted by admin
$objItem1->package_expired = 0; // 0 for showing active packg 1 means expired packge

$objResItem_hand1          = $objItem1->getItemImageDetails();
if(mysql_num_rows($objResItem_hand1))
{
	$cc1=1;
	while($Row1 = mysql_fetch_array($objResItem_hand1))
	{
		$every_recent_product[]       = $Row1;
		$cc1++;
	}}
	
	echo '<pre>';
	print_r($every_recent_product);
		echo '</pre>';

	
	?>