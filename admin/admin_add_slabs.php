<?php
include ("common_includes.php");
include ("../class/class.category.inc");
include ("../include/adminsession.php.inc");

//create object of Category class
$objCategory = new Class_Category();

//assign static labels and heading
$smarty->assign("form_heading","Add/Edit Subscription Slabs");
$smarty->assign("return_link","admin_add_slabs.php");

$update_msg = "Slabs has been inserted successfully!!";


//selects category for edit
if(isset($_GET['slab_id']) && $_GET['slab_id']!="")
{
	$objCategory->slab_id = trim($_GET['slab_id']);
	$objResCat		= $objCategory->selectSlabs();
	$CateRow		= mysql_fetch_array($objResCat);

        /*
        $parent_id		= $CateRow ['parent_id'];
	$name			= $CateRow ['name'];
	$description	        = $CateRow ['description'];
        $commision	        = $CateRow ['commision'];
	$status			= $CateRow ['status'];
        */
          
         
}
//submit form
if($_SERVER['REQUEST_METHOD']=='POST')
{
	//get ID
	if(isset($_GET['slab_id']) && $_GET['slab_id']!="")
	{
		$objCategory->slab_id = trim($_GET['slab_id']);
		$update_msg = "Slab has been updated successfully!!";
	}

	//Post Variable
	
	//check name for duplicate
	//if(!$objCategory->validateExisringName())
	//{
		
//	}
        extract($_POST);

        $objCategory->time_period 	= rteSafe($time_period);
	$objCategory->end_item_range 	= rteSafe($end_item_range);
       // if($_GET['slab_id']==1)
	//$objCategory->start_item_range 	= 25;
        //else
        $objCategory->start_item_range 	= rteSafe($start_item_range);
        
        $objCategory->package_name 	= rteSafe($package_name);
        $objCategory->amount            = rteSafe($amount);
        $objCategory->amount_1month     = rteSafe($amount_1month);
        $objCategory->amount_6month     = rteSafe($amount_6month);
        $objCategory->amount_12month    = rteSafe($amount_12month);
        $objCategory->description       = rteSafe($description_text);
        

        $objDBReturn                    = $objCategory->insertUpdateSlabs();
        if($objDBReturn->nErrorCode==0)
	{
	success_msg($update_msg);
	}
	else
	{
	failure_msg("Error, please try again!!");
	}
	redirect("admin_view_slabs.php");
}

//assign post/edit variables
$smarty->assign('package_name',$CateRow['package_name']);
$smarty->assign('amount_1month',$CateRow['amount_1month']);
$smarty->assign('amount_6month',$CateRow['amount_6month']);
$smarty->assign('amount_12month',$CateRow['amount_12month']);
$smarty->assign('start_item_range',$CateRow['start_item']);
$smarty->assign('end_item_range',$CateRow['end_item']);
$smarty->assign('description',$CateRow['description']);


//$smarty->assign('status',$status);
//$smarty->assign('commision',$commision);


//display template and title
$smarty->assign('site_page_title',ADMIN_COMMON_TITLE);
$smarty->assign('site_title',$site_title);
$smarty->display('admin_add_slabs.tpl');
?>