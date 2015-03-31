<?php
include ("common_includes.php");
include ("../include/adminsession.php.inc");
include ("../class/class.item.inc");
include ("../class/class.user.inc");
include ("../class/class.shipping.inc");

//assign static labels and heading
$smarty->assign("form_heading","Manage Quantity Limitation");


//create object of Item class


	$objUser		= new Class_User();
	$objUser->qty_id         = 1;
	$result_qty              = $objUser->getquantityDetails();
	$num_qty                 = mysql_num_rows($result_qty);
	if($num_qty >0)
    $arr_qty                 = mysql_fetch_assoc($result_qty);
	$smarty->assign('arr_qty_value',$arr_qty['quantity_value']);
	$smarty->assign('arr_qty_cost_value',$arr_qty['cost_item']);

     

if($_POST['submit'])
{
	$objUser					    = new Class_User();
	
    $objUser->set_cost			    = $_POST['set_cost'];   
	$objUser->quantity_value	    = $_POST['set_quantity'];   
	$objUser->qty_id				= 1;
	$result_qty					    = $objUser->insertUpdatequantity();
	//if($result_qty)
	if($result_qty->nErrorCode==0)
	{
		//header("location:admin_users.php");
		success_msg("Quantity updated successfully!!");
	}
	else
	{
		failure_msg("Error occured, please try again later");
	}
    redirect("admin_set_quantity_listing.php");
}


			
					
			







///////--code for  serching ends here





//display template and title
$smarty->assign('site_page_title',ADMIN_COMMON_TITLE);
$smarty->assign('site_title',$site_title);
$smarty->display('admin_set_quantity_listing.tpl');	
?>