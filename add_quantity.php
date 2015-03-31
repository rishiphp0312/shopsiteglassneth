<?php
include ('include/common.inc');
include ("class/class.item.inc");

$item_id_value = $_REQUEST['item_id_value'];

//create item class object
$obj_item   = new Class_Item();


if($item_id_value!='')
{
	$obj_item->update_item_id  =  $item_id_value;
	$odj_image_details_value   =  $obj_item->getItemImageDetails();
	$num_value_details         =  mysql_num_rows($odj_image_details_value);

	if($num_value_details >0)
	 {
		$arr_fetch_item_details	= mysql_fetch_assoc($odj_image_details_value);
		$quantity_available	= $arr_fetch_item_details['quantity_available'];
	 }
}

//$obj_item->quantity_available = $max_quantity;

$smarty->assign("quantity_available",$quantity_available);
$smarty->assign("item_id_value",$item_id_value);

//display template

$smarty->assign('site_page_title','Nethaat :Add Qunatity');
$smarty->assign('site_title',$site_title);
$smarty->display('update_quantity.tpl');
?>