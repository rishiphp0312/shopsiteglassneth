<?php
include ('include/common.inc');
include ("include/authentiateUserLogin.php");
include ('class/class.user.inc');
$smarty->assign("anObject" , new Class_Dynamic() );

$objUser = new Class_User();

if(isset($_SESSION['session_user_id'])&& $_SESSION['session_user_id']!="")
{
	$objUser->id = $_SESSION['session_user_id'];
	$UserRes     = $objUser->getcustomitem();
	$num         = mysql_num_rows($UserRes);
	if($num>0){
	while($UserArr = mysql_fetch_array($UserRes))
	{
		$items[]	=	$UserArr;
	}}
	$smarty->assign("num",$num);
	$smarty->assign("citem",$items);
}

//echo '<pre>';
//print_r($UserArr);
//echo '</pre>';

$smarty->assign('site_page_title','Nethaat : My Custom Items List');
$smarty->assign('site_title',$site_title);
$smarty->display('buyer_custom_request.tpl');
?>