<?php
include ('include/common.inc');
include ("class/class.user.inc");
include ("class/class.item.inc");
include ('class/class.cms.inc');
$smarty->assign("anObject" , new Class_Dynamic() );

// echo 'user-ip'.$userip; echo 'remote'.$_SERVER['REMOTE_ADDR'];
 

//create user class object
$objUser = new Class_User();
//get content for seller
//create CMS class object
//echo $url="http://api.ipinfodb.com/v2/ip_query.php?key=936462656b47c77cd8ffe6c5e232d4d4757957ab25631592578ace0eae293ea6&ip=".$_SERVER['REMOTE_ADDR']."&timezone=false";
$objCMS	 = new Class_CMS();

$objCMS->page_link_id  = "sellers";

$resCMS                = $objCMS->selectCmsPage();
	
if(mysql_num_rows($resCMS)>0)
{
	$resCMSRow = mysql_fetch_array($resCMS);
	$smarty->assign('sellers_desc',$resCMSRow['description']);
}

//get content for buyers
$objCMS->page_link_id  = "buyers";
$resCMS = $objCMS->selectCmsPage();
	
if(mysql_num_rows($resCMS)>0)
{
	$resCMSRow = mysql_fetch_array($resCMS);
	$smarty->assign('buyers_desc',$resCMSRow['description']);
}


/***************************************** code for handpicked  items START  *********************************/
//create object of Item class
$objItem		   = new Class_Item();

$productList = array();
$objItem->hand_pickstatus  = 1;
$objItem->inventory_check  = 1;
$objItem->val_limit        = 1;  // recent 12 records
$objItem->status           = 1;
//$objItem->hatting_status   = 0;
//$objItem->approve_store    = 1;
$objItem->delete_by_seller = 0; //0 not deleted by seller 1 means delete by seller
$objItem->locker_status    = 0;
$objItem->delete_restored  = 0; //0 for showing restored 1 means deleted by admin
$objItem->package_expired  = 0; //0 for showing active packg 1 means expired packge

$objResItem_hand           = $objItem->getItemImageDetails();
$total_hand_picked         = mysql_num_rows($objResItem_hand);
if(mysql_num_rows($objResItem_hand))
{
       $cc=1;
	while($Row = mysql_fetch_array($objResItem_hand))
	{
		$every_thing_handpicked[]     = $Row;
		$cc++;
	}
	$smarty->assign('total_hand_picked', $total_hand_picked);
	$smarty->assign('every_thing_handpicked_all',$every_thing_handpicked);
}
$smarty->assign('link_counter',$cc);
/***************************************** code for handpicked  items END  *********************************/

//echo '<pre>';
//print_r($every_thing_handpicked);
//echo '</pre>';

/***************************************** code for recent products  items START  *********************************/
$objItem1	= new Class_Item();
$objItem1->inventory_check = 1 ;
$objItem1->delete_by_seller = 0; //not deleted by seller
$objItem1->val_limit       = 91;
$objItem1->status          = 1;
$objItem1->recent_status   = 1;
$objItem1->hand_pickstatus = 0;
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
	}
	$smarty->assign('every_recent_product_all',$every_recent_product);
	$smarty->assign('total_recent_listed',mysql_num_rows($objResItem_hand1));
}
/***************************************** code for recent products  items END  *********************************/


/***************************************** code for Featured Store START  *********************************/

$objUser->pageLimit = "LIMIT 0,12";
$UserRes = $objUser->selectfeaturedimage();
$rows    = @mysql_num_rows($UserRes);
if($rows)
{
	while($UserArr = mysql_fetch_array($UserRes))
	{
		$store[]	=	$UserArr;
	}
	$smarty->assign("rows", $rows);
	$smarty->assign("store", $store);
	//$smarty->assign("store_img_path",'uploads/store_logos/');
}

/***************************************** code for Featured Store END  *********************************/


//assign variable and display template
$smarty->assign('site_page_title','Nethaat : '.SITE_HOME);
$smarty->assign('site_title',$site_title);
$smarty->display('index-14-dec-local.tpl');
?>