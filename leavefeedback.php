<?php
include ('include/common.inc');
include ("include/authentiateUserLogin.php");
include ('class/class.user.inc');
include ('class/class.item.inc');

$objItem = new Class_Item();

$objUser = new Class_User();
if(isset($_GET['id']) && isset($_GET['itemid'])&& $_GET['buyid']!="" && $_GET['seller_id']!="")
{
	$objItem->item_id = $_GET['itemid'];
	$objItem->buyer_id = $_GET['buyid'];
	$objItem->seller_id = $_GET['seller_id'];
        $objItem->purchased_date='NA';
	$UserRes = $objItem->getbuyitem();
	$UserArr = mysql_fetch_array($UserRes);
	
	$smarty->assign("f_name",$UserArr['first_name']);
 	$smarty->assign("l_name",$UserArr['last_name']);
	$smarty->assign("username",$UserArr['username']);
	$smarty->assign("title",$UserArr['title']);
	$smarty->assign("itemid",$_GET['itemid']);
	$smarty->assign("buyid",$_GET['buyid']);
	$smarty->assign("feedbackid",$_GET['id']);
	$smarty->assign("seller_id",$_GET['seller_id']);
	$smarty->assign("purchase_date",$UserArr['purchase_date']);

	//$UserRes1 = $objItem->getfeedback();
	//$UserArr1 = mysql_fetch_array($UserRes1);
	
	//$smarty->assign("comment",$UserArr1['comment']);
 	//$smarty->assign("feedback",$UserArr1['feedback']);
	//$smarty->assign("feedbackid",$UserArr1['id']);


}
//echo '<pre>';
//print_r($UserArr);
if(isset($_POST['submit']))
{
	extract($_POST);

	$objItem->feedbackid1 = rteSafe($feedbackid);
	$objItem->item_id =rteSafe($itemid);
	$objItem->buyer_id = rteSafe($buyerid);
	$objItem->seller_id = rteSafe($sellerid);
	$objItem->comment = rteSafe($feedback);
	$objItem->feedback =rteSafe($rate);
	
	$objItem->purchase_date =rteSafe($purchase_date);
	
	$objDBReturn = $objItem->insertUpdatefeedback();
	if($objDBReturn->nIdentity && $objDBReturn->nErrorCode==0)
	{
		$objDBReturn = $objItem->insertUpdatepurchaseditemfeedback();
		success_msg("Your feedback for item has been successfull posted..");
		header("Location:my_account.php");
		//?id=$objItem->item_id&buyid=$objItem->buyer_id&seller_id=$objItem->seller_id
	}
	else
	{
		if($objDBReturn->nIdentity==0 && $objDBReturn->nErrorCode==0)
		{
			$objDBReturn = $objItem->insertUpdatepurchaseditemfeedback();
			success_msg("Your feedback for item has been successfull update..");
			header("Location:my_account.php");
			//header("Location:leavefeedback.php?id=$objItem->item_id&buyid=$objItem->buyer_id&seller_id=$objItem->seller_id");
		}
		else
		{
			failure_msg("Error occured ...! ");
			
			header("Location:leavefeedback.php?id=$objItem->item_id&buyid=$objItem->buyer_id&seller_id=$objItem->seller_id");
		}
	}
	$smarty->assign('error_msg',$error_msg);
	
}

$smarty->assign('site_page_title','Nethaat : Leave Feedback');
$smarty->assign('site_title',$site_title);
$smarty->display('leavefeedback.tpl');
?>