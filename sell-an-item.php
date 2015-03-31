<?php
include ('include/common.inc');
include ("include/authentiateUserLogin.php");
include ("class/class.category.inc");
include ("class/class.item.inc");
include ('class/class.user.inc');
include ('class/class.package.inc');
//include ('class/class.mail.inc');
//sssssssssinclude ('include/sendEmailClass.php');

   $objUser        = new Class_User();
   $item_id_value  = $_REQUEST['item_id_value'];
 //create mail class object
   //$objMail 	   = new Class_Mail();
   // Creating object of SendEmailClass
   //$emailObj       = new SendEmailClass;

//create item class object
    $obj_item       = new Class_Item();
    $obj_item->seller_id = $_SESSION['session_user_id'];
    $odj_image_details_TOTvalue = $obj_item->getItemImageDetails();
    $num_value_TOTdetails = mysql_num_rows($odj_image_details_TOTvalue);
	if($num_value_TOTdetails>0){
	$arr_fetch_store_name  = mysql_fetch_assoc($odj_image_details_TOTvalue);
	$store_name_user       = $arr_fetch_store_name['store_name']; 
	}
	$smarty->assign('store_name_user',$store_name_user); // if =0
    $smarty->assign('num_value_TOTdetails',$num_value_TOTdetails); // if =0
    
	$objPackage     = new Class_Package();
 // code to know whether the items less than 25 or not or expiry date over or not before add any item
	$objPackage->seller_id = $_SESSION['session_user_id'];
	$objPackage->status    = 1; //active packge
	$result_package        = $objPackage->getPackagedetails();
	$num_rows_pacakage     = mysql_num_rows($result_package);
	$smarty->assign('num_rows_pacakage',$num_rows_pacakage); // if =0
	if($num_rows_pacakage>0)
	{
	  $arr_package_details = mysql_fetch_array($result_package);
	  $pkg_max_items       = $arr_package_details['max_items'];
	
	}else
	{
		$pkg_max_items       = 25;
	}
	//echo 'pkg_max_items=='.$pkg_max_items;
	if($num_rows_pacakage>0)
	$smarty->assign('pkg_max_items',$pkg_max_items); // pkg_max_items if pkg active
	else
	$smarty->assign('pkg_max_items',0); // pkg_max_items if pkg is inactive 
	 
	$obj_item->seller_id       =  $_SESSION['session_user_id'];
	$total_items_available     =  $obj_item->select_total_items();
	$num_rows_items_available  =  mysql_num_rows($total_items_available);
	$smarty->assign('num_rows_items_available',$num_rows_items_available); // if>25
	if($num_rows_pacakage==0 && $num_rows_items_available>=25)
	  {
		  failure_msg("Please purchase package to add more itemss!!");
		  redirect("purchase_package.php");
	  }
		if($pkg_max_items==100)
		$str_pkg_name ="You cannot upload the new items further since your existing Master package allow 100 items space only.To continue uploading new item ,either remove items from my item list to create the space or upgrade to Master pro  from your purchase package module in your account. ";
		if($pkg_max_items==500)
		$str_pkg_name ="You cannot upload the new items further since your existing Pro Master package allows 500 items space only.To continue uploading new item , either remove items from my item list to create the space or contact admin@nethaat.com for further assistance.";
	
	if($num_rows_pacakage==1 && $num_rows_items_available >=$pkg_max_items )
	   {
		 failure_msg($str_pkg_name);
		 redirect("purchase_package.php");
	   }
	//create category class object
	$objCategory = new Class_Category;
	$check_by_admin = $obj_item->get_item_quantity();
	$num_by_admin   = mysql_num_rows($check_by_admin);
	if($num_by_admin>0)
	{
		$arr_by_admin = mysql_fetch_assoc($check_by_admin);
		$qty_by_admin = $arr_by_admin['quantity_value'];
	    $qty_by_cost = $arr_by_admin['cost_item'];
		$_SESSION['session_cost_item'] = $arr_by_admin['cost_item'];
	}
	
	
	
	$obj_item->seller_id = $_SESSION['session_user_id'];
	$result_ofItems_of_seller = $obj_item->getNoofItems_perseller();
	$NoofItems_of_seller = mysql_num_rows($result_ofItems_of_seller);
	if($NoofItems_of_seller > 0)
	{
	$arr_no_ofitemsseller = mysql_fetch_assoc($result_ofItems_of_seller);
	}

	$result_ofpaidItems_of_seller1 = $obj_item->getNoofpaidItems_forlisting();
	$NoofpaidItems_of_seller = mysql_num_rows($result_ofpaidItems_of_seller1);
	
	if ($_SESSION['session_paid_item'] == 0 && $arr_no_ofitemsseller['TOTAL_ITEMS'] >=$qty_by_admin && $_REQUEST['item_id_value'] == '') {
		//  if($_REQUEST['id']!='')
		// redirect("pay-item-listing.php?id=".$_REQUEST['id']);
		//else
		//   redirect("pay-item-listing.php");
	}
	
//*********************************** By Deepak for adding locker information *******
if (isset($_REQUEST['id']) != "")
{
    $objUser->tblid = $_REQUEST['id'];
    $UserRes = $objUser->getcustomitem();
    $num = mysql_num_rows($UserRes);
    $UserArr = mysql_fetch_array($UserRes);
    $w = (($UserArr['price']*$UserArr['quantity']) - $UserArr['paid_amount'])/($UserArr['quantity']);
    $smarty->assign("title", $UserArr['title']);
    $smarty->assign("description", $UserArr['description']);
    $smarty->assign("material", $UserArr['material']);
    $smarty->assign("quantity", $UserArr['quantity']);
    $smarty->assign("buyerid", $UserArr['user_id']);
    $smarty->assign("cost_item", $w);
	$smarty->assign("adv_amount",$UserArr['paid_amount']);
	
	$smarty->assign("bal_amt",(($UserArr['price']*$UserArr['quantity']) - $UserArr['paid_amount']));
	
    $smarty->assign("reqid",$UserArr['cust_item_id']);
    $smarty->assign("num", $num);
}
//***********************************************************************************
 //echo 'cust-id'.$UserArr['cust_item_id'];
//get styles to create dropdwon list
$objResCatTotal1 = $objUser->getStylelisting();
$total_records1 = mysql_num_rows($objResCatTotal1);
if ($total_records1 > 0)
{
  while($parentRow1 = mysql_fetch_array($objResCatTotal1))
  {
    $styleId[]   = $parentRow1['style_id'];
    $styleNAME[] = $parentRow1['set_style'];
  }
    $smarty->assign("styleId", $styleId);
    $smarty->assign("styleNAME", $styleNAME);
}

//get categories to create category drop down list
$parentRes = $objCategory->selectParentCatgeory();
//$parentRes = $objCategory->selectSubCatgeory();
if(mysql_num_rows($parentRes)>0)
{
  while ($parentRow = mysql_fetch_array($parentRes))
  {
	$parentID[] = $parentRow['category_id'];
	$parentNAME[] = $parentRow['name'];
  }
	$smarty->assign("parentID", $parentID);
	$smarty->assign("parentNAME", $parentNAME);
}


//Submit form
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    extract($_POST);
    $obj_item->price = $price;
    if($locker_id != "")
	{
        $obj_item->locker_buyer      = $locker_buyer;
        $obj_item->locker_permission = $locker_permission;
        $obj_item->locker_status     = $lock;
        $objUser->locker_status      = $lock;
        }
	else
	{
        $obj_item->locker_status     = $lock;
        $obj_item->locker_permission = $lock_permi;
     }
      //   echo  'lock--'.$lock;
       //  echo  'locker_status--'.$locker_status;
    //exit;
    if($item_id_value=='' || $_REQUEST['id']!='')
    $obj_item->suspend_item         = 0; //0 means image not added
    
    $obj_item->quantity				= $quantity;
    $obj_item->quantity_available	= $max_quantity;
    $obj_item->title				= rteSafe($title);
    $obj_item->description			= rteSafe($description);
    $obj_item->parent_id			= $parent_id;
    $obj_item->category_id			= $category_id;
    $obj_item->materials			= rteSafe($materials);
    $obj_item->care				    = rteSafe($care);
    $obj_item->user_id				= $_SESSION['session_user_id'];
    $obj_item->item_value			= $item_id_value;
    $obj_item->weight				= $weight;
    $obj_item->unit_type			= $unit_type;
    $obj_item->color				= $color;
    $obj_item->item_id_concat	    = implode(",",$_POST['style_id']);

	//if no errors found
    if($error_msg == "")
	{   
	 if($num_value_TOTdetails==0)
     {/*
	 $store_name  = $_REQUEST['store_name'];
	 $objUser->id = $_SESSION['session_user_id'];
	 $objUser->store_name=$store_name;
	 $objUser->insertUpdateUser();
	 */}
	 
        $obj_item->request_item_id = $_REQUEST['id'];
        $objDBReturn  = $obj_item->insertUpdateItem();
		$custreq_lastinsertedItem  =  $objDBReturn->nIdentity;
		//exit;
      //  if($objDBReturn->nErrorCode == 0 && $custreq_lastinsertedItem!='' )
	    if($objDBReturn->nErrorCode == 0  )
	      {
            $objUser->id             = $_SESSION['session_user_id'];
            $objUser->value_status   = 0;
            $objUser->changepaiditemstatus();
            
			$objUser->reqid          = $locker_id; //
            $objUser->fully_prepared = 1;  //when custom item is fully prepared by seller.
            if($locker_id!='')
		    $objUser->insertUpdatecustomrequest();
			//Start code of Mail sent to customer when custom item is fully prepared by seller.
			$objMail->mail_title	            = "Email Template";
    		$MailTemplate			            = $objMail->selectMailTemplate();
    		$templateRowArr 		            = mysql_fetch_array($MailTemplate);
    		$mail_content1			            = $templateRowArr['mail_content'];
       		// $subject			                = $templateRowArr['mail_content'];
    		$mail_content1			            = str_replace("#link#",$baseUrl,$mail_content1);			
			//get email template
		    $objUser->id                        = $_SESSION['session_user_id'];
		    $result_users_em_sender             = $objUser->selectUser();
		    $num_value_users_em_sender          = mysql_num_rows($result_users_em_sender);
		    if($num_value_users_em_sender >0)
			 {
		    $arr_fetch_em_sender               = mysql_fetch_assoc($result_users_em_sender);
			 //== sellers name and email==//
		    $email_from_sender                 = $arr_fetch_em_sender['email'];
		    $name_from_sender                  = $arr_fetch_em_sender['first_name'].''.$arr_fetch_em_sender['last_name'];
		    $storename_from_sender             = $arr_fetch_em_sender['store_name'];
		    $sellereusername_sender            = $arr_fetch_em_sender['username'];         
			 }			 
		    ///== buyers name and email== //			 
		   $objUser->id                         = $locker_buyer;
		   $result_users_buyers                 = $objUser->selectUser();
		   $num_value_users_buyers              = mysql_num_rows($result_users_buyers);
		   if($num_value_users_buyers >0)
			 {
			 $arr_fetch_buyers                  = mysql_fetch_assoc($result_users_buyers);
			 $email_from_buyers                 = $arr_fetch_buyers['email'];
		     $name_from_buyers                  = $arr_fetch_buyers['first_name'].''.$arr_fetch_buyers['last_name'];
			 }			 
		  
		   
		   $objMail->mail_title   = "Custom_item_created"; 		   
		   $MailTemplate   = $objMail->selectMailTemplate();
		   $templateRowArr = mysql_fetch_array($MailTemplate);
		   $mail_content   = $templateRowArr['mail_content'];
		   $mail_content1  = str_replace("#message_content#",$mail_content,$mail_content1);
		   $subject 	   = $templateRowArr['mail_subject'];		 
		   $mail_content1  = str_replace("#link#",$baseUrl,$mail_content1);
		   $mail_content1  = str_replace("#link#",$baseUrl,$mail_content1);
           // $mail_content		                = str_replace("#link#",$baseUrl,$mail_content1);
  
           $mail_content1 = str_replace("#buyer_name#",$name_from_buyers,$mail_content1);
		   $mail_content1 = str_replace("#item_name#",$title,$mail_content1);
           $mail_content1 = str_replace("#no_quantity#",$max_quantity,$mail_content1);
		   $mail_content1 = str_replace("#seller_username#",$sellereusername_sender,$mail_content1);
           $item_titles                         = $item_name;
		   $mail_content1                       = str_replace("#adv_amount#",$adv_amount,$mail_content1);
		   $link_url_custom     = "<a href='".$baseUrl."item-details.php?details_item_value=".$custreq_lastinsertedItem."'>".$title."</a>";
    	   $mail_content1                       = str_replace("#link_url_custom#",$link_url_custom,$mail_content1);
           $mail_content1                       = str_replace("#bal_amt#",$bal_amt,$mail_content1);
           $mailFrom                            = "$name_from_sender "." < ".$email_from_sender." >";
          // $send_email_ids                      =  'rishi_kapoor@seologistics.com' ;
          // $send_email_ids                      =  'rishi_kapoor@seologistics.com' ;
          $send_email_ids                      = $email_from_buyers;
		  //echo $mail_content1 ;
		 // exit;
		  if($_REQUEST['id']!= "")
		   $emailStatus  = $emailObj->SendHtmlMail($send_email_ids,$subject,$mail_content1,$mailFrom);

        // $mail_content1     =str_replace("#storename_from_sender#",$storename_from_sender,$mail_content1);
         
          //  $mail_content1                       = str_replace("#message#",'',$mail_content1);
 		   
		   
		  // $send_email_ids                    =  $email_from_buyers ;
		   
		  // echo $mail_content1 ;
		   //exit;

			
			
			
			
			
			
			
			
			
			// End code of Mail sent to customer when custom item is fully prepared by seller.
			
        }
	    else
	    {
            $error_msg = "Error occured ...!Please try again";
            failure_msg("Error occured ...!Please try again");
			if($item_id_value!='' && $_REQUEST['id']=='')
			  redirect("sell-an-item.php?item_id_value=".$item_id_value);
			if($item_id_value=='' && $_REQUEST['id']!='')
			  redirect("sell-an-item.php?item_id_value=".$item_id_value);
			if($item_id_value!='' && $_REQUEST['id']!='')
		      redirect("sell-an-item.php");
			  
        }
        
        if($item_id_value == '')
		{
            redirect("upload_imgage.php");
		}
        else
		{
            redirect("upload_imgage.php?item_id_value=".$item_id_value);
		}
    }
}//end of post


// start for fetching data of items cooresponding to items 
if ($item_id_value != '')
{
    $obj_item->update_item_id = $item_id_value;
    $odj_image_details_value = $obj_item->getItemImageDetails();
    $num_value_details = mysql_num_rows($odj_image_details_value);
    if($num_value_details > 0)
	{
        $arr_fetch_item_details = mysql_fetch_assoc($odj_image_details_value);
        $description_value      = $arr_fetch_item_details['description'];
		$request_item_id        = $arr_fetch_item_details['request_item_id'];
        $material_used_value    = $arr_fetch_item_details['material_used'];
        $cost_item_value        = $arr_fetch_item_details['cost_item'];
        $title_value            = $arr_fetch_item_details['title'];
        $inventory_alert_value  = $arr_fetch_item_details['inventory_alert'];
        $max_quantity_db        = $arr_fetch_item_details['quantity_available'];
        $category_id_value      = $arr_fetch_item_details['category_id'];
        $color                  = $arr_fetch_item_details['color'];
        $locker_status          = $arr_fetch_item_details['locker_status'];
        $locker_permission      = $arr_fetch_item_details['locker_permission'];
        $care                   = $arr_fetch_item_details['care'];
        $style_id_value         = explode(",", $arr_fetch_item_details['item_id_concat']);
        $domestic_ship_rate     = $arr_fetch_item_details['domestic_ship_rate'];
        $international_ship     = $arr_fetch_item_details['international_ship_rate'];
        $weight                 = $arr_fetch_item_details['weight'];
        $hatting_status         = $arr_fetch_item_details['hatting_status'];
		$smarty->assign("hatting_status",$hatting_status);
		$smarty->assign("locker_permission", $locker_permission);
		$smarty->assign("care", $care);
		$smarty->assign("locker_status", $locker_status);
		$smarty->assign("color", $color);
		$smarty->assign("domestic_ship_rate",$domestic_ship_rate);
		$smarty->assign("international_ship",$international_ship);
		$smarty->assign("weight", $weight);
		$smarty->assign("description_value",$description_value);
		$smarty->assign("material_used_value",$material_used_value);
		$smarty->assign("cost_item_value", $cost_item_value);
		$smarty->assign("max_item_value", $max_quantity_db);
		$smarty->assign("inventory_alert_value",$inventory_alert_value);
		$smarty->assign("title_value",$title_value);
		$smarty->assign("parent_id",$arr_fetch_item_details['parent_id']);
		$smarty->assign("category_id_value",$category_id_value);
		$smarty->assign("style_id_value",$style_id_value);
		$smarty->assign("item_id_value",$item_id_value);
		$smarty->assign("request_item_id",$request_item_id);
   
	}
}
//assign error/update message
$smarty->assign("error_msg", $error_msg);
$smarty->assign("update_msg", $update_msg);


//select sub categories
if(isset($_GET["parent_id"]) && $_GET["parent_id"]!="")
{
	$objCategory->parent_id = $_GET["parent_id"];
	$subCateRes = $objCategory->selectSubCatgeory();
	$category_id = trim($_GET['category_id']);

	echo "<select class='required priceinputbox' name='category_id' style='width:204px;'>";
	if($objCategory->parent_id<1)
	{
		echo "<option value=''>-- Select Sub Category --</option>";
	}
	else if(mysql_num_rows($subCateRes)>0)
	{
		while($subCatRow = mysql_fetch_array($subCateRes))
		{
			if($category_id==$subCatRow['category_id'])
			{
				$selected = "selected='selected'";
			}
			echo "<option value='".$subCatRow['category_id']."' ".$selected.">".$subCatRow['name']."</option>";
		}
	}
	else
	{
		echo "<option value=''>No Sub Categories Available</option>";
	}
	echo "</select>";
	exit;
}

//display template
$smarty->assign('site_page_title', 'Sell An Item');
$smarty->assign('site_title', $site_title);
$smarty->display('sell-an-item.tpl');
?>