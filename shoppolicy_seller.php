<?php
include ('include/common.inc');
include ('class/class.cms.inc');
include ('class/class.user.inc');

$objUser = new Class_User();

 $_SESSION['session_user_id'];

$name_after_domain     = $_SERVER['HTTP_HOST'];
$exp_name_after_domain = explode(".",$name_after_domain);
$add_this_name         = $exp_name_after_domain[1].'.'.$exp_name_after_domain[2];
//echo '<br>';
$add_this_username           = $exp_name_after_domain[1]; 
$objUser                     = new Class_User();
$objUser->username_dom       = $add_this_username;
$reslt_seluser               = $objUser->selectUser();
$num_reslt_seluser           = mysql_num_rows($reslt_seluser);
if($num_reslt_seluser>0)
{
$arr_reslt_seluser           = mysql_fetch_assoc($reslt_seluser);
$reslt_seluserId             = $arr_reslt_seluser['user_id_value'];
$_REQUEST['sellerid']              = $reslt_seluserId;

}

if($_REQUEST['sellerid']=='')
$sellerid = $_SESSION['session_user_id'];
else
$sellerid = $_REQUEST['sellerid'];


if(isset($sellerid) != "")
{
// code for rating
         
		 $objUser->logged_user_id      = $sellerid; //seller id

		 $detailsOfUserfeedback        = $objUser->getdetailsOfUsertotalfeedback();
	     $num_OfUserfeedback           = mysql_num_rows($detailsOfUserfeedback) ;
		
		 if($num_OfUserfeedback>0)
		 {
		 $arr_Userfeedback = mysql_fetch_assoc($detailsOfUserfeedback);
		 }
         $total_value_Userfeedback     =  $arr_Userfeedback['total'];
         
		 $detailsOfUserpostivefeedback = $objUser->getdetailsOfUserpostivefeedback();
		 $num_OfUserpostivefeedback    = mysql_num_rows($detailsOfUserpostivefeedback) ;
		 if($num_OfUserfeedback>0)
		 {
		 $arr_Userpostivefeedback      = mysql_fetch_assoc($detailsOfUserpostivefeedback);
		 }
         $total_Userpostivefeedback    = $arr_Userpostivefeedback['total'];
		
		 if($total_Userpostivefeedback!=0)
		 $find_percentage   = ($total_Userpostivefeedback/$total_value_Userfeedback)*100;
		
		 if($find_percentage==0 || $find_percentage=='' || $total_Userpostivefeedback==0)
		 $find_percentage==0; 
		 else
		 $find_percentage   =  round($find_percentage,2);
		 
		 $smarty->assign("find_percentage", $find_percentage);	 
			 
         //end of rating code
		//*****************************************************************


	$objUser->id = $sellerid;
	$UserRes = $objUser->getUserDetails();
	$UserArr = mysql_fetch_array($UserRes);
	$smarty->assign("sellerid",$UserArr['id']);
	$smarty->assign("f_name",$UserArr['first_name']);
 	$smarty->assign("l_name",$UserArr['last_name']);
	$smarty->assign("v_welcome",$UserArr['v_welcome']);
 	$smarty->assign("v_payment",$UserArr['v_payment']);
	$smarty->assign("v_shipping",$UserArr['v_shipping']);
 	$smarty->assign("v_refund_exchange",$UserArr['v_refund_exchange']);
 	$smarty->assign("v_additional_info",$UserArr['v_additional_info']);
	$smarty->assign("store_name",$UserArr['store_name']);
	$smarty->assign("v_store_image",$UserArr['v_store_image']);
	$smarty->assign("reg_date",$UserArr['reg_date']);
	$smarty->assign("city",$UserArr['city']);
	$smarty->assign("state",$UserArr['state']);
	$smarty->assign("username",$UserArr['username']);
	
	$smarty->assign("user_country_name",$objUser->getcountry($UserArr['country_id']));
}

$smarty->assign('site_page_title','Nethaat: Shop Policy Information');
$smarty->assign('site_title',$site_title);
$smarty->display('shoppolicy_seller.tpl');
?>