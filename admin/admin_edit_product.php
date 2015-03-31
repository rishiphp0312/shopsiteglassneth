<?php
include ("common_includes.php");
include ("../include/adminsession.php.inc");
include ("../class/class.user.inc");
include ("../class/class.item.inc");
//include ('../include/imageOptimization.php');

$item_id_value  = $_REQUEST['item_id'];
//create user class object
$objUser		= new Class_User();
$obj_item       = new Class_Item();
$ftype          = $_REQUEST['ftype'];
//echo 'use='.$_GET['user_id'];
//selects user for edit
//echo $objUser->user_type;
//insert/update user

//send and login details email to user
if($_SERVER['REQUEST_METHOD']=='POST')
{
	/*start comment*/
	//print_r($_POST);
	//exit;
	extract($_POST);
    $obj_item->price =$price;
	$obj_item->quantity = $quantity;
	$obj_item->quantity_available = $max_quantity;
	
	$obj_item->title = rteSafe($title);
	$obj_item->description =rteSafe($description);
	$obj_item->category_id =$category_id;
	$obj_item->materials =$materials;
	$obj_item->user_id = $_SESSION['session_user_id'];
	$obj_item->item_value =$item_id_value;
//	max_quantity
	
if($error_msg=="")
	{
	    
		$objDBReturn = $obj_item->insertUpdateItem();
	//exit;	
		if($objDBReturn->nErrorCode==0)
		{
//success_msg("Your registration was successfull");
		}
		else
		{
			$error_msg = "Error occured ...!Please try again";
				failure_msg("Error occured while sending email, please contact Administrator to confirm your registration");
		}
		//redirect("sell-an-item.php");
		if($ftype=='')
			{
				if($item_id_value=='')
				redirect("admin_products_listing.php");
				else
				redirect("admin_products_listing.php?item_id_value=".$item_id_value);
			}else
		    {
				if($item_id_value=='')
				redirect("admin_handpicked_listing.php");
				else
				redirect("admin_handpicked_listing.php?item_id_value=".$item_id_value);
				}
	}
	
	
//end coment
}

///////////


// start for fetching data of items cooresponding to items 
	if($item_id_value!='')
	{
	$obj_item->update_item_id  =  $item_id_value;
    $odj_image_details_value   =  $obj_item->getItemImageDetails();
    $num_value_details         =  mysql_num_rows($odj_image_details_value);
	 if($num_value_details >0)
		 {
		$arr_fetch_item_details   = mysql_fetch_assoc($odj_image_details_value);
		$description_value        = $arr_fetch_item_details['description'];
		$material_used_value      = $arr_fetch_item_details['material_used'];
		$cost_item_value          = $arr_fetch_item_details['cost_item'];
		$title_value              = $arr_fetch_item_details['title'];
		$inventory_alert_value    = $arr_fetch_item_details['inventory_alert'];
		$max_quantity_db          = $arr_fetch_item_details['quantity_available'];
		$category_id_value        = $arr_fetch_item_details['category_id'];
	     }
    }
	//echo 'max-'.$max_quantity_db     ;
	$smarty->assign("description_value",$description_value);
	$smarty->assign("material_used_value",$material_used_value);
	$smarty->assign("cost_item_value",$cost_item_value);
	$smarty->assign("max_item_value",$max_quantity_db);
	//$max_item_value
	$smarty->assign("inventory_alert_value",$inventory_alert_value);
	$smarty->assign("title_value",$title_value);
	$smarty->assign("category_id_value",$category_id_value);
	$smarty->assign("item_id_value",$item_id_value);
	//$item_id_value
	//end of code
//assign error/update message

$smarty->assign("update_msg",$update_msg);




/////////////






//assign error msg
//echo  $user_type;
$smarty->assign('err_message',$err_message);

			
//display template and title
$smarty->assign('site_page_title',ADMIN_COMMON_TITLE);
$smarty->assign('site_title',$site_title);
$smarty->display('admin_edit_product.tpl');	
?>
