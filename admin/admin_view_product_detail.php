<?php
include ("common_includes.php");
include ("../include/adminsession.php.inc");
include ("../class/class.user.inc");
include ('../class/class.item.inc');
include ("../class/class.category.inc");
//include ('../include/imageOptimization.php');

// code for products detail start here


        
	$user_type_id  = $_GET['user_type_id'];
    $product_id    = $_REQUEST['product_id'];
    $objItem       = new Class_Item();
	$objItem->update_item_id=$_REQUEST['product_id'];

	if(isset($_POST['suspend']))
	{
		$objItem->item_value = $product_id;
		$objItem->insertUpdateItem1('2');
		redirect('admin_products_listing.php');
	}

	if(isset($_POST['approve']))
	{
		$objItem->item_value = $product_id;
		$objItem->insertUpdateItem1('1');
		redirect('admin_products_listing.php');
	}

    $image_details_item1 = $objItem->getItemImageDetails();
	$num_rows_items1     = mysql_num_rows($image_details_item1);
	if($num_rows_items1>0)
		{
			$arr_items_array	     = mysql_fetch_assoc($image_details_item1);
        	$material_used_value	 = $arr_items_array['material_used'];
			$cost_item_value	     = $arr_items_array['cost_item'];
			$max_item_value	         = $arr_items_array['quantity_available'];
			$image1	                 = $arr_items_array['image1'];
			$image2	                 = $arr_items_array['image2'];
			$image3	                 = $arr_items_array['image3'];
			$image4	                 = $arr_items_array['image4'];
			$image5	                 = $arr_items_array['image5'];
			$inventory_alert_value	 = $arr_items_array['inventory_alert'];
		  	$title                   = $arr_items_array['title'];
			$description_value       = $arr_items_array['description'];
			$category_id_value       = $arr_items_array['category_id'];
			$date_created            = $arr_items_array['date_added'];
			$status_show             = $arr_items_array['status'];
		}
                
            if($status_show  ==0)
			$status_value    = 'Pending'; 
			if($status_show  ==1)
			$status_value    = 'Active'; 
			if($status_show  ==2)
			$status_value    = 'Suspended'; 
			if($status_show  ==3)
			$status_value    = 'Hold'; 

			$smarty->assign("STATUS_ITEM_value",$status_value);
    		$smarty->assign("description_value",$description_value);
			$smarty->assign("material_used_value",$material_used_value);
			$smarty->assign("cost_item_value",$cost_item_value);
			$smarty->assign("max_item_value",$max_item_value);
			$smarty->assign("inventory_alert_value",$inventory_alert_value);
	
			$smarty->assign("title_value",$title);
            $smarty->assign("category_id_value",$category_id_value);
			$smarty->assign("date_created",$date_created);
			$smarty->assign('showimage1',$image1);
			$smarty->assign('showimage2',$image2);
			$smarty->assign('showimage3',$image3);
			$smarty->assign('showimage4',$image4);
			$smarty->assign('showimage5',$image5);


			$get_remove_value = $_REQUEST['unlink_this_img'];
            $get_remove_col   = $_REQUEST['col_position'];
			$smarty->assign("item_id_value",$_REQUEST['product_id']);
			 if($get_remove_value!='')
			 {				 
             $objItem->item_id =$get_remove_value;
			 $objItem->col_id  =$_REQUEST['col_position'];
			 $fetch_singcol    =  $objItem->getItemImageDetails();
             $fetch_array      =  mysql_fetch_assoc($fetch_singcol);
			 if($get_remove_col==1)
			 { 
				 @unlink('uploads/thumbs/'.$fetch_array['image1']);
				 @unlink('uploads/'.$fetch_array['image1']);
			 }
			 if($get_remove_col==2)
			 { 
				 @unlink('uploads/thumbs/'.$fetch_array['image2']);
				 @unlink('uploads/'.$fetch_array['image2']);
			 }
			 if($get_remove_col==3)
			 { 
				 @unlink('uploads/thumbs/'.$fetch_array['image3']);
				 @unlink('uploads/'.$fetch_array['image3']);
			 }
			 if($get_remove_col==4)
			 { 
				 @unlink('uploads/thumbs/'.$fetch_array['image4']);
				 @unlink('uploads/'.$fetch_array['image4']);
			 }
			  if($get_remove_col==5)
			 { 
				 @unlink('uploads/thumbs/'.$fetch_array['image5']);
				 @unlink('uploads/'.$fetch_array['image5']);
			 }
		//if(getItemImageDetails)
		//$get_remove_value 
        $objItem->item_id    =  $get_remove_value;
		$objItem->col_id     =  $get_remove_col;
		$delete_remove_value = $objItem->particularImage(); // for particular image
          success_msg("Image has been removed successfully!!");
		if($get_remove_value=='')
		redirect('admin_view_product_detail.php');
		else
		redirect('admin_view_product_detail.php?product_id='.$get_remove_value.'&user_type_id='. $user_type_id );
		 }

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
			








/// code  for products detail ends here



//create user class object
$objUser		= new Class_User();

//echo 'use='.$_GET['user_id'];
//selects user for edit



if(isset($user_type_id) && $user_type_id!="")
{
	$objUser->id = trim($user_type_id);
	$resUser = $objUser->selectUser();
	$resUserRow = mysql_fetch_array($resUser);
    //	echo 'res-'.$resUserRow['user_type'];
	//select forum user ID to updaate
	$objUser->Email = $resUserRow['email'];
	
	$smarty->assign('FirstName',$resUserRow['first_name']);
	$smarty->assign('LastName',$resUserRow['last_name']);
      if($resUserRow['user_type']==4)
	   {
				 $memeber_type= 'Buyer';
	   }
	   if($resUserRow['user_type']==3)
	   {
				 $memeber_type= 'Seller';
	   }
	$smarty->assign('UserType',$memeber_type);
	//echo 'res--'.$resUserRow['address1'];
		$smarty->assign('Useraddress1',$resUserRow['address1']);
	$smarty->assign('UserEmail',$resUserRow['email']);

	//set update message
	//$update_msg= "User information has been updated successfully!";
}
else
{
	//$update_msg= "User has been added successfully!";
}


if($_SERVER['REQUEST_METHOD']=='POST')
{
	extract($_POST);
	
	$error_msg = "";
	 $objUser->id 			= trim($_GET['user_id']);
	$objUser->email 		= rteSafe($Email);

	//check existing email
//exit;
	if($objUser->validateExisringEmail())
	{
		$error_msg = "Provided email address already in use...!";
		
	}
	$objUser->username 		= rteSafe($username);
	if($objUser->validateExisringUsername())
	{
		$error_msg = "Provided username already in use...!";
		
	}


	//if no errors found
	if($error_msg=="")
	{
		$objUser->first_name	= rteSafe($FirstName);
		$objUser->last_name		= rteSafe($LastName);
		$objUser->username		= rteSafe($username);
		
		$objUser->email			= rteSafe($Email);
		//$objUser->Password	= rteSafe($Password);	
		$objUser->phone1		= rteSafe($Phone);	
		$objUser->zipcode		= rteSafe($Zip);	
		$objUser->EmailAlert	= $EmailAlert;
		$objUser->nLetter		= $nLetter;
		$objUser->user_type		= $user_type;
		$objUser->Status		= 1; //set active by default
		$objUser->account_type	= 4; //set active type
		//update user information
		$objDBReturn = $objUser->insertUpdateUser();
		
		if($objDBReturn->nErrorCode==0)
		{
			//header("location:admin_users.php");
			success_msg($update_msg);
		}
		else
		{
			failure_msg("Error occured, please try again later");
		}
		redirect("admin_users.php");
	}//end of if($error_msg=="")
		
		// $user_type.'--'.$user_type;	
	//assign error messages

	$smarty->assign('error_msg',$error_msg);

	//assign back all post variables
	//$smarty->assign('user_b_type',$user_buyer_type);
		//$smarty->assign('user_s_type',$user_seller_type);
	$smarty->assign('UserType',$user_type);
	
	$smarty->assign('FirstName',$FirstName);
	$smarty->assign('LastName',$LastName);
	$smarty->assign('Email',$Email);
	$smarty->assign('Password',$Password);
	$smarty->assign('Phone',$Phone);
	$smarty->assign('Zip',$Zip);
	$smarty->assign('EmailAlert',$EmailAlert);
	$smarty->assign('nLetter',$nLetter);
}
//assign error msg
//echo  $user_type;
$smarty->assign('err_message',$err_message);

			
//display template and title
$smarty->assign('site_page_title',ADMIN_COMMON_TITLE);
$smarty->assign('site_title',$site_title);
$smarty->display('admin_view_product_detail.tpl');	
?>