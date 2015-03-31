<?php
include ('include/common.inc');
include ('class/class.item.inc');
include ('include/country_state_cat.php');

//if(isset($_POST['post']))


if($_POST['chk_bal_gift']==1)
{

	extract($_POST);
         //$_SESSION['giftcard_seller_id']
$obj_item   = new Class_Item();
$obj_item->cardcode = $gift_card_code;
$result_serch_gift  = $obj_item->getgiftcarddetailUser();
$num_serch_gift     = mysql_num_rows($result_serch_gift);
if($num_serch_gift>0)
{
    $value_amt_gift       = mysql_fetch_assoc($result_serch_gift);
    $balance_left_gift    = $value_amt_gift['reciveramount'];
    $balance_sellers_name = $value_amt_gift['first_name'].''.$value_amt_gift['last_name'];
    $balance_username     = $value_amt_gift['username'];
    
    $_SESSION['sess_balance_left_gift'] = $balance_left_gift;
    $_SESSION['sess_sellers_name']      = $balance_sellers_name;
    $_SESSION['sess_username']          = $balance_username;
//    if($balance_left_gift==0)
//        $balance_left_gift=0;
//    else
//        $balance_left_gift=
    success_msg("Your giftcard code successfully matched!!");
}
else
{
    failure_msg("Invalid giftcard code!!");
    $_SESSION['sess_balance_left_gift']='';
}


header("Location:giftcard-balance.php");


}

$smarty->assign('balance_left_gift',$balance_left_gift);
$smarty->assign('sellersid_for_giftcard',$sellersid_for_giftcard);
$smarty->assign('CURRENCY',CURRENCY);

$smarty->assign('site_page_title',"Nethaat: Giftcard Balance");
$smarty->display('giftcard-balance.tpl');
?>