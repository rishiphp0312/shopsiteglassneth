<?php
include ('include/common.inc');
include ("class/class.category.inc");
include ('class/class.user.inc');
include ('include/country_state_cat.php');


$objUser		= new Class_User();
$objCategory	= new Class_Category;

$item_values_list = array();
 $main_cat_id      = $_REQUEST['main_cat_id'];
 

 $name_after_domain     = $_SERVER['HTTP_HOST'];
 $exp_name_after_domain = explode(".",$name_after_domain);
 $curent_page           =  $_SERVER['PHP_SELF'];
 $base_curent_page      = basename($curent_page);
 
 $exp_name_after_domain = explode(".",$name_after_domain);
if($name_after_domain=='www.nethaat.com' )
{
}
else
{

    $add_this_name_red         =   'featured_store_information.php';
    // header("Location:$add_this_name_red");
	redirect($add_this_name_red);
 
}

//select main categories
//$parentRes = $objCategory->selectSubCatgeory();
$parentRes = $objCategory->selectParentCatgeory();

while($parentRow = mysql_fetch_array($parentRes))
{
	$parentID[] = $parentRow['category_id'];
	$parentNAME[] = $parentRow['name'];
}
$smarty->assign("parentID",$parentID);
$smarty->assign("parentNAME",$parentNAME);

//select sub categories
if(isset($_POST["parent_id"]) && $_POST["parent_id"]!="")
{
	$objCategory->parent_id = $_POST["parent_id"];
	$subCateRes = $objCategory->selectSubCatgeory_havingitems();

	echo "<select  class='input' name='category_id' style='width:184px;'>";
	if($objCategory->parent_id<1)
	{
		echo "<option value='0'>-- Select Sub Category --</option>";
	}
	else if(mysql_num_rows($subCateRes)>0)
	{
		while($subCatRow = mysql_fetch_array($subCateRes))
		{
			echo "<option value='".$subCatRow['category_id']."'>".$subCatRow['name']."</option>";
		}
	}
	else
	{
		echo "<option value=''>No Sub Categories Available</option>";
	}
	echo "</select>";
	exit;
}

//select styles
$objResCatTotal1 = $objUser->getStylelisting();
$total_records1  = mysql_num_rows($objResCatTotal1);
if($total_records1>0)
{
	while($parentRow1 = mysql_fetch_array($objResCatTotal1))
	{
		$styleId[]   = $parentRow1['style_id'];
		$styleNAME[] = $parentRow1['set_style'];
	}
}
$smarty->assign("styleId",$styleId);
$smarty->assign("styleNAME",$styleNAME);
$smarty->assign('no_records',$num_rows_items1);
$smarty->assign('page_counter',$page_counter);
$smarty->assign("users_items_details", $item_values_list);


//assign error/update message
$smarty->assign("error_msg",$error_msg);
$smarty->assign("update_msg",$update_msg);

//display template
$smarty->assign('site_page_title','Nethaat: Advance Search');
$smarty->assign('site_title',$site_title);
$smarty->display('advanced_serch.tpl');
?>