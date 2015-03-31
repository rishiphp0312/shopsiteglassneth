<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

include ('include/common.inc');
include ("include/authentiateUserLogin.php");
include ("class/class.category.inc");
include ("class/class.item.inc");
include ("class/class.user.inc");
include ("class/class.ticket.inc");
include ('class/class.mail.inc');
include ('include/sendEmailClass.php');

    $package_id           = $_GET['package_id'];
    $objCategory          = new Class_Category();
    $objCategory->slab_id = $_REQUEST['package_id'];
    $fetch_slabs_deatil   = $objCategory->selectSlabs();
    $num_fetch_details    = mysql_num_rows($fetch_slabs_deatil);
    if($num_fetch_details>0)
    {
    $arr_fetch_details    = mysql_fetch_assoc($fetch_slabs_deatil);
    $smarty->assign("package_name",$arr_fetch_details['package_name']);
//    $smarty->assign("amount_1month",$arr_fetch_details['amount_1month']);
//    $smarty->assign("amount_6month",$arr_fetch_details['amount_6month']);
//    $smarty->assign("amount_12month",$arr_fetch_details['amount_12month']);
    $smarty->assign("start_item",$arr_fetch_details['start_item']);
    $smarty->assign("end_item",$arr_fetch_details['end_item']);
    $smarty->assign("error_msg",$error_msg);
    }

?>
<div>Please wait you will be redirected to paypal shortly...........</div>
<div>
    <form name="frm_soure" action="" method="post">

        <input type='hidden' value="<?=$arr_fetch_details['amount_1month'];?>" id='amount' name='amount'>
        <input type='hidden' value="<?=$arr_fetch_details['package_name'];?>" id='max_items' name='max_items'>
        <input type='hidden' value="<?=$arr_fetch_details['package_name'];?>" id='min_items' name='min_items'>
        <input type='hidden' value="<?=$arr_fetch_details['package_name'];?>" id='package_name_id' name='package_name_id'>

    </form>

</div>