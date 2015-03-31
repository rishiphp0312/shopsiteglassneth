<?php
include ('include/common.inc');
include ('class/class.mail.inc');
include ('class/class.user.inc');
include ('class/class.item.inc');
include ("class/class.category.inc");
include ("include/authentiateUserLogin.php");



//send and login details email to user
    $objItem = new Class_Item();
	$objItem->update_item_id=$_REQUEST['item_id_value'];
    $image_details_item1 = $objItem->getItemImageDetails();
	
	$num_rows_items1     = mysql_num_rows($image_details_item1);
	
	if($num_rows_items1>0)
		{
			$arr_items_array	 = mysql_fetch_assoc($image_details_item1);
			
        	$material_used_value	 = $arr_items_array['material_used'];
			$cost_item_value	     = $arr_items_array['cost_item'];
			$max_item_value	         = $arr_items_array['quantity_available'];
			$image1	                 = $arr_items_array['image1'];
			$image2	                 = $arr_items_array['image2'];
			$image3	                 = $arr_items_array['image3'];
			$image4	                 = $arr_items_array['image4'];
			$image5	                 = $arr_items_array['image5'];

			$inventory_alert_value	 = $arr_items_array['inventory_alert'];
		//	$material_used_value	 = $arr_items_array['material_used'];
		  	$title                   = $arr_items_array['title'];
			$description_value       = $arr_items_array['description'];
			$category_id_value       = $arr_items_array['category_id'];
			$locker_status			 = $arr_items_array['locker_status'];
			$care			         = $arr_items_array['care'];
		}

    		$smarty->assign("care",$care);
			$smarty->assign("description_value",$description_value);
			$smarty->assign("material_used_value",$material_used_value);
			$smarty->assign("cost_item_value",$cost_item_value);
			$smarty->assign("max_item_value",$max_item_value);
			$smarty->assign("inventory_alert_value",$inventory_alert_value);
			$smarty->assign("image_value1",$image1);
			$smarty->assign("image_value2",$image2);
			$smarty->assign("image_value3",$image3);
			$smarty->assign("image_value4",$image4);
			$smarty->assign("image_value5",$image5);
			$smarty->assign("title_value",$title);
            $smarty->assign("category_id_value",$category_id_value);
			$smarty->assign("locker_status",$locker_status);


			$objCategory = new Class_Category;
            //$category_id_value
			$objCategory->category_id=$category_id_value;
			$parentRes = $objCategory->selectSubCatgeory();
			$parentRow = mysql_fetch_array($parentRes);
								{
								//$parentID[] = $parentRow['category_id'];
								$CatgeoryName = $parentRow['name'];
								}
								  //	quantity_available

		//	$smarty->assign("subCatgeoryName",$CatgeoryName);
			$smarty->assign("subCatgeoryName",$CatgeoryName);
			$smarty->assign("item_id_value",$item_id_value);


		if($_SERVER['REQUEST_METHOD']=='POST')
		{
			if($_POST['locker']!="1")
			{
				redirect('items_list.php');
			}
			else
			{
				redirect('locker_items_seller.php');
			}


		}

//assign error/update message
$smarty->assign("error_msg",$error_msg);
$smarty->assign("update_msg",$update_msg);

//display template
$item_id_value = $_REQUEST['item_id_value'];
$smarty->assign('item_id_value',$item_id_value);

$smarty->assign('site_page_title','Review and Post');
$smarty->assign('site_title',$site_title);
$smarty->display('review-post.tpl');
?>
