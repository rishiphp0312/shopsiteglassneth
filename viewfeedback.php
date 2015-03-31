<?php
include ('include/common.inc');
//include ("include/authentiateUserLogin.php");
include ('class/class.user.inc');
include ('class/class.item.inc');
$rating_seller_id= $_REQUEST['rating_seller_id'];
$objItem = new Class_Item();
if($_SESSION['session_user_type']!="" && $rating_seller_id=='')
{//echo 'lala';
//echo  'sesion-user-type'.$_SESSION['session_user_type'];
       
	if(isset($_SESSION['session_user_id'])&& $_SESSION['session_user_id']!="")
	{
		$objItem->user_id = $_SESSION['session_user_id'];
		$UserRes = $objItem->getviewfeedback();
		$num=mysql_num_rows($UserRes);
                if($num>0){
		while($UserArr = mysql_fetch_array($UserRes))
		{
			$items[]	=	$UserArr;
		}}
		$smarty->assign("num",$num);
		$smarty->assign("citem",$items);
	}
}
else
{//echo 'lala--22';
	//if(isset($_SESSION['session_user_id'])&& $_SESSION['session_user_id']!="")
	//{
		//$objItem->user_id = $_SESSION['session_user_id'];
                if($rating_seller_id!='')
                {$objItem->user_id = $rating_seller_id;
		$UserRes = $objItem->getviewfeedbackseller();
		$num=mysql_num_rows($UserRes);
                 if($num>0){
		while($UserArr = mysql_fetch_array($UserRes))
		{
			$items[]	=	$UserArr;
		}}
                }
				//echo '<pre>';
				//print_r($items);
		$smarty->assign("num",$num);
		$smarty->assign("citem",$items);
	//}
}
$smarty->assign('CURRENCY',CURRENCY);
$smarty->assign('site_page_title','Nethaat : ViewFeedback');

$smarty->assign('site_title',$site_title);
$smarty->assign('site_title',$site_title);
$smarty->display('viewfeedback.tpl');
?>