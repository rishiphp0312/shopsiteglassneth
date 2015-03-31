<?php
include ('include/common.inc');
include ("include/authentiateUserLogin.php");
include ('class/class.user.inc');
include ('class/class.item.inc');
include ('include/country_state_cat.php');

$requestid=$_GET['requestid'];
$objUser = new Class_User();
$objItem = new Class_Item();

/*if($_SESSION['session_user_type']==3)
{
	//msg and redirect to my account
	failure_msg("Error occured ..! Please login as buyer..");
	redirect('my_account.php');
}*/
//echo $_SESSION['session_user_type'];

$name_after_domain     = $_SERVER['HTTP_HOST'];
$exp_name_after_domain = explode(".",$name_after_domain);
$add_this_name         = $exp_name_after_domain[1].'.'.$exp_name_after_domain[2];
//echo '<br>';
$add_this_username           = $exp_name_after_domain[1]; 
$objUser                     = new Class_User();
$objUser->username_dom       = $add_this_username;
$reslt_seluser               = $objUser->selectUser();
$num_reslt_seluser           = mysql_num_rows($reslt_seluser);
if($num_reslt_seluser>0)
{
$arr_reslt_seluser           = mysql_fetch_assoc($reslt_seluser);
$reslt_seluserId             = $arr_reslt_seluser['user_id_value'];
$_REQUEST['sellerid']              = $reslt_seluserId;

}

$objUser->sellerid 	=	rteSafe($_REQUEST['sellerid']);	
$smarty->assign("sellerid",$objUser->sellerid);
$smarty->assign("requestid",$_GET['requestid']);

 
		// code for rating
		 $objUser->logged_user_id      = $_REQUEST['sellerid']; //seller id

		 $detailsOfUserfeedback        = $objUser->getdetailsOfUsertotalfeedback();
	     $num_OfUserfeedback           = mysql_num_rows($detailsOfUserfeedback) ;		
		 if($num_OfUserfeedback>0)
		 {
		 $arr_Userfeedback = mysql_fetch_assoc($detailsOfUserfeedback);
		 $total_value_Userfeedback     =  $arr_Userfeedback['total'];
		 }
        
         
		 $detailsOfUserpostivefeedback = $objUser->getdetailsOfUserpostivefeedback();
		 $num_OfUserpostivefeedback    = mysql_num_rows($detailsOfUserpostivefeedback) ;
		 if($num_OfUserfeedback>0)
		 {
		 $arr_Userpostivefeedback      = mysql_fetch_assoc($detailsOfUserpostivefeedback);
		 $total_Userpostivefeedback    = $arr_Userpostivefeedback['total'];
		 }
                
		
		 if($total_Userpostivefeedback!=0)
		 $find_percentage   = ($total_Userpostivefeedback/$total_value_Userfeedback)*100;
		
		 if($find_percentage==0 || $find_percentage=='' || $total_Userpostivefeedback==0)
		 $find_percentage==0; 
		 else
		 $find_percentage   =  round($find_percentage,2);
		 
		 $smarty->assign("find_percentage", $find_percentage);	 
			 
         //end of rating code
		//*****************************************************************

if(isset($_GET['requestid']) != "")
{
	$objUser->requestid = $_GET['requestid'];
	$UserRes = $objUser->getcustomitem();
	
	$UserArr = mysql_fetch_array($UserRes);
	$smarty->assign("itemid",$UserArr['id']);
	$smarty->assign("title",$UserArr['title']);
 	$smarty->assign("price",$UserArr['price']);
	$smarty->assign("quantity",$UserArr['quantity']);
 	$smarty->assign("deadline",$UserArr['deadline']);
	$smarty->assign("description",$UserArr['description']);
 	$smarty->assign("tags",$UserArr['tags']);
 	$smarty->assign("material",$UserArr['material']);
	$smarty->assign("fullname",$UserArr['fullname']);
	$smarty->assign("street",$UserArr['street']);
	$smarty->assign("reg_date",$UserArr['reg_date']);
	$smarty->assign("city",$UserArr['city']);
	$smarty->assign("state",$UserArr['state']);
	$smarty->assign("zipcode",$UserArr['zipcode']);
	$smarty->assign("country_value",$UserArr['country']);
	$smarty->assign("user_id",$UserArr['user_id']);
	$smarty->assign("create_date",$UserArr['create_date']);
	$smarty->assign("image1",$UserArr['image1']);
	$smarty->assign("sellerid",$UserArr['sellerid']);
	if($UserArr['agreestatus']==1)
	{
		failure_msg("This item is accepted by it's seller..! this item is in under process now you can not edit this any more");
		redirect('view_profile_custom_user.php?id='.$_GET['requestid'].'&buyid='.$UserArr['user_id']);
	}
	/*if($UserArr['paymentstatus']==1)
	{
		failure_msg("This item is accepted by it's seller..! this item is in under process now you can not edit this any more");
		redirect('view_profile_custom_user.php?id='.$_GET['requestid'].'&buyid='.$UserArr['user_id']);
	}*/

	//$smarty->assign("country_value",$UserArr['country']);
	
}

//*****************************************************************
if(isset($_REQUEST['sellerid']) != "")
{
	$objUser->id = $_REQUEST['sellerid'];
	$UserRes = $objUser->getUserDetails();
	$UserArr = mysql_fetch_array($UserRes);
	$smarty->assign("sellerid",$UserArr['id']);
	$smarty->assign("f_name",$UserArr['first_name']);
 	$smarty->assign("l_name",$UserArr['last_name']);
	$smarty->assign("v_welcome",$UserArr['v_welcome']);
 	$smarty->assign("v_payment",$UserArr['v_payment']);
	$smarty->assign("v_shipping",$UserArr['v_shipping']);
 	$smarty->assign("v_refund_exchange",$UserArr['v_refund_exchange']);
 	$smarty->assign("v_additional_info",$UserArr['v_additional_info']);
	$smarty->assign("store_name",$UserArr['store_name']);
    $smarty->assign("username",$UserArr['username']);
	$smarty->assign("v_store_image",$UserArr['v_store_image']);
	$smarty->assign("reg_date",$UserArr['reg_date']);
	$smarty->assign("city",$UserArr['city']);
	$smarty->assign("state",$UserArr['state']);
	$smarty->assign("zipcode",$UserArr['zipcode']);
	$smarty->assign("country_value",$UserArr['country_id']);
	$smarty->assign("user_country_name",$objUser->getcountry($UserArr['country_id']));
}

if($_SERVER['REQUEST_METHOD']=='POST')
{
		extract($_POST);
		//print_r($_POST);
		//exit;
		$image_tmpname              = $_FILES['attach_file']['tmp_name'];
	    $image_name                 = basename($_FILES['attach_file']['name']);
		$slrid = $_POST["hid"];
		$reqid = $_POST["reqhid"];

		$Date_Day   = $_POST['Date_Day'];
		$Date_Month = $_POST['Date_Month'];
		$Date_Year  = $_POST['Date_Year'];
		$v_fdt      = $Date_Year."-".$Date_Month."-".$Date_Day;

		$objUser->reqid 				= rteSafe($reqhid);	
		$objUser->sellerid 				= rteSafe($hid);	
		$objUser->userid   				= rteSafe($_SESSION['session_user_id']);	
		$objUser->title   				= rteSafe($title);	
		$objUser->price  				= rteSafe($price);
		$objUser->quantity  			= rteSafe($quantity);
		$objUser->deadline  			= rteSafe($v_fdt);
		$objUser->description  			= rteSafe($description);

		$objUser->tags   				= rteSafe($tags);	
		$objUser->material   			= rteSafe($material);	
		/**/
        $objUser->fullname  			= rteSafe($fullname);
		$objUser->street  				= rteSafe($street);
		$objUser->city  				= rteSafe($city);
		$objUser->state  				= rteSafe($state);
		$objUser->zipcode  				= rteSafe($zipcode);
		$objUser->country_value  		= $country_value_hid;
		
		
		 //	$objUser->country_value  		= rteSafe($country_value);
	
       
		if($_FILES['image1']['tmp_name']=="")
		{
			$objUser->custom_logo =$hidimage;
		}
		else
		{

			$POST_MAX_SIZE = '2M';
			$mul = substr($POST_MAX_SIZE, -1);
			$mul = ($mul == 'M' ? 1048576 : ($mul == 'K' ? 1024 : ($mul == 'G' ? 1073741824 : 1)));
			if ($_SERVER['CONTENT_LENGTH'] > $mul*(int)$POST_MAX_SIZE ) 
				$error = 'true';
			else
				$error = 'false';
				$error ;
			if($error=='true')
			{
				failure_msg("Error occured filsize cannot be greater than 2mb ");
				if($reqid=="")
				{
					redirect('request_custom_item.php?sellerid='.$slrid);
				}
				else
				{
					redirect('request_custom_item.php?requestid='.$reqid);
				}
			}
		}
	if($_FILES['attach_file']['tmp_name']=="")
		{
			//$objUser->custom_logo =$hidimage;
		}
		else
		{

			$POST_MAX_SIZE = '2M';
			$mul = substr($POST_MAX_SIZE, -1);
			$mul = ($mul == 'M' ? 1048576 : ($mul == 'K' ? 1024 : ($mul == 'G' ? 1073741824 : 1)));
			if ($_SERVER['CONTENT_LENGTH'] > $mul*(int)$POST_MAX_SIZE ) 
				$error = 'true';
			else
				$error = 'false';
				$error ;
			if($error=='true')
			{
				failure_msg("Error occured filsize cannot be ");
				if($reqid=="")
				{
					redirect('request_custom_item.php?sellerid='.$slrid);
				}
				else
				{
					redirect('request_custom_item.php?requestid='.$reqid);
				}
			}
			
		if($image_tmpname!='')
		{
	        $image_name_exp             = explode(".",basename($_FILES['attach_file']['name']));
		$count_val                  = count($image_name_exp); 
		$image_name_ext             = $image_name_exp[$count_val-1];

		$file_extension_array = array("image/pjpeg","image/png","image/jpeg","image/gif","application/txt","application/doc","application/msword","application/vnd.ms-excel","application/pdf","image/x-png");
			
		//in_array($_FILES['attach_file']['type'],$file_extension_array);
	//		exit;
		if(in_array($_FILES['attach_file']['type'],$file_extension_array)!=1)
	     {
	failure_msg("Error occured attachment file extension should be .jpg,.jpeg,.gif,.xls,.doc,.pdf!!");
		
		if($reqid=="")
				{
					redirect('request_custom_item.php?sellerid='.$slrid);
				}
				else
				{
					redirect('request_custom_item.php?requestid='.$reqid);
				}
			}
		}
	}
		//echo	$_FILES['attach_file']['type'];
	
	
        if($_FILES['image1']['tmp_name']!='' )
		{				
		if($_FILES['image1']['type']=='image/pjpeg' || $_FILES['image1']['type']=='image/jpeg'||$_FILES['image1']['type']=='image/png' ||$_FILES['image1']['type']=='image/x-png' || $_FILES['image1']['type']=='image/gif')
			{
			//echo 'ajya';exit;
					$tmp_name_file       	= $_FILES['image1']['tmp_name'];
					$file_name           	= basename($_FILES['image1']['name']);
					$file_ext            	= explode(".",$file_name);
					$file_ext_len        	= count($file_ext);
					$file_ext_value      	= $file_ext[$file_ext_len-1];
					$store_holder_id     	= $_SESSION['session_user_id'];
					$file_name_with_ext  	= time().'-'.$store_holder_id.'.'.$file_ext_value;
				//	echo 'dfd';
			        $flg 					= move_uploaded_file($tmp_name_file,'uploads/custom_item/'.$file_name_with_ext);
					
					
					if($flg==1)
					{
						$namesof_files  = $file_name_with_ext;
						$objUser->custom_logo =$namesof_files;
						@unlink('uploads/custom_item/'.$hidimage);
						@unlink('uploads/thumbs/'.$hidimage);
					}
						
				}// end of if
				else
					{
					//echo 'ajya123';exit;
			
						failure_msg("Error occured image file type should be  .jpg,.gif,.png");
						if($reqid=="")
						{
							redirect('request_custom_item.php?sellerid='.$slrid);
						}
						else
						{
							redirect('request_custom_item.php?requestid='.$reqid);
						}
		        	}
					// end else

		}
			
		//echo "iden-".$objDBReturn->nIdentity."--error--".$objDBReturn->nErrorCode;
		       
		$objDBReturn = $objUser->insertUpdatecustomrequest();
		$last_id     = $objDBReturn->nIdentity;

		if($objDBReturn->nIdentity && $objDBReturn->nErrorCode==0)
		{	
		 
		if($image_tmpname!='')
			{
				 $file_attached             = 'Custom-Item-file-'.$last_id.'.'.$image_name_ext;
				 $flg_upload                =  move_uploaded_file($image_tmpname,'uploads/custom_item/Custom-Item-file-'.$last_id.'.'.$image_name_ext);
				
				if($flg_upload==1)
				{ 
				$objUser->reqid             = $last_id;
				$objUser->file_attached     = $file_attached;
				
				$objDBReturn                = $objUser->insertUpdatecustomrequest();
				}
        	}
		//requestid=63
			success_msg("Your request for custom item has been successfully added");
			header("Location:buyer_custom_request.php?sellerid=".$_REQUEST['hid']);
		}
		else
		{
		
			if($objDBReturn->nErrorCode==0)
			{
				success_msg("Your item request has been updated successfully");
				header("Location:buyer_custom_request.php?requestid=".$reqid);
			}
			else
			{
				failure_msg("Error occured ...!Please try again (Title may be already in use)");
				if($reqid=="")
				{
					$error_msg = "Error occured ...!Please try again (Title may be already in use)";
					redirect('request_custom_item.php?sellerid='.$slrid);
				}
				else
				{
					redirect('request_custom_item.php?requestid='.$reqid);
				}
			}
		}
		$smarty->assign('error_msg',$error_msg);
	

}

$smarty->assign('site_page_title','Nethaat: My Workshop');
$smarty->assign('site_title',$site_title);
$smarty->display('request_custom_item.tpl');
?>