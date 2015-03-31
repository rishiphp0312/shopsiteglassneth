<?php
include ('include/common.inc');
include ('class/class.user.inc');
include ('class/class.item.inc');
include ("include/authentiateUserLogin.php");
include ('create_thumbs.php');
include ('class/class.package.inc');

$item_id_value  = $_REQUEST['item_id_value'];
//create user class object
$objUser        = new Class_User();
//create item class object
$objItem 	    = new Class_Item();
$objPackage     = new Class_Package();
 // code to know whether the items less than 25 or not or expiry date over or not before add any item
$objPackage->seller_id = $_SESSION['session_user_id'];
$objPackage->status    = 1;
$result_package        = $objPackage->getPackagedetails();
$num_rows_pacakage     = mysql_num_rows($result_package);
$smarty->assign('num_rows_pacakage',$num_rows_pacakage); // if =0
if($num_rows_pacakage>0)
{
  $arr_package_details = mysql_fetch_array($result_package);
  $pkg_max_items       = $arr_package_details['max_items'];

}
if($num_rows_pacakage>0)
$smarty->assign('pkg_max_items',$pkg_max_items); // pkg_max_items if pkg active
else
$smarty->assign('pkg_max_items',0); // pkg_max_items if pkg active

 // echo '<br>';
 $objItem->seller_id       =  $_SESSION['session_user_id'];
 $total_items_available    =  $objItem->select_total_items();
 $num_rows_items_available =  mysql_num_rows($total_items_available);
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

 if($num_rows_pacakage==1 && $num_rows_items_available>=$pkg_max_items )
   {

     failure_msg($str_pkg_name);
     // failure_msg("Please purchase package to add more itemss!!");
      redirect("purchase_package.php");
   }


		//create item class object

 
          
 $get_remove_value = $_REQUEST['unlink_this_img'];
 $get_remove_col   = $_REQUEST['col_position'];
 if($get_remove_value!='')
      {
		         $objItem->item_id =  $get_remove_value;
			 $objItem->col_id  =  $_REQUEST['col_position'];
			 $fetch_singcol    =  $objItem->getItemImageDetails();
             $fetch_array      =  mysql_fetch_assoc($fetch_singcol);
			 if($get_remove_col==1)
			 { 
	//			 @unlink('uploads/thumbs/'.$fetch_array['image1']);
				 @unlink('uploads/'.$fetch_array['image1']);
			 }
			 if($get_remove_col==2)
			 { 
	//			 @unlink('uploads/thumbs/'.$fetch_array['image2']);
				 @unlink('uploads/'.$fetch_array['image2']);
			 }
			 if($get_remove_col==3)
			 { 
	//			 @unlink('uploads/thumbs/'.$fetch_array['image3']);
				 @unlink('uploads/'.$fetch_array['image3']);
			 }
			 if($get_remove_col==4)
			 { 
	//			 @unlink('uploads/thumbs/'.$fetch_array['image4']);
				 @unlink('uploads/'.$fetch_array['image4']);
			 }
			  if($get_remove_col==5)
			 { 
	//			 @unlink('uploads/thumbs/'.$fetch_array['image5']);
				 @unlink('uploads/'.$fetch_array['image5']);
			 }
		//if(getItemImageDetails)
		//$get_remove_value 
                        $objItem->item_id    =  $get_remove_value;
                        $objItem->col_id     =  $get_remove_col;
                        $delete_remove_value = $objItem->particularImage(); // for particular image
                        success_msg("Image has been removed successfully!!");
                        if($get_remove_value=='')
                        redirect('upload_imgage.php');
                        else
                        redirect('upload_imgage.php?item_id_value='.$get_remove_value);
            }
                        if($item_id_value=='')
                        $objItem->update_item_id = $_SESSION['Last_id_row'];
                        else
                        $objItem->update_item_id = $item_id_value;

                        $objItem->seller_id      = $_SESSION['session_user_id'];
                        $odj_image_details_value = $objItem->getItemImageDetails();
                        $num_fetched_values = mysql_num_rows($odj_image_details_value);
                        if($num_fetched_values>0)
                        {
                         $fetched_values          = mysql_fetch_array($odj_image_details_value);
                         $arr_fetch_names1        = $fetched_values['image1'];
                         $arr_fetch_names2        = $fetched_values['image2'];
                         $arr_fetch_names3        = $fetched_values['image3'];
                         $arr_fetch_names4        = $fetched_values['image4'];
                         $arr_fetch_names5        = $fetched_values['image5'];
		      }
                if($arr_fetch_names1=='' && $arr_fetch_names2==''&& $arr_fetch_names3==''&& $arr_fetch_names4==''&& $arr_fetch_names5=='')
	          $no_image_upload =1;
                else
              $no_image_upload  =0;

                $smarty->assign('no_image_upload',$no_image_upload);

                //$rand_value = rand();
		$img1= $arr_fetch_names1;
		$smarty->assign('showimage1', $img1 );
		$smarty->assign('showimage2', $arr_fetch_names2 );
		$smarty->assign('showimage3', $arr_fetch_names3 );
		$smarty->assign('showimage4', $arr_fetch_names4 );
		$smarty->assign('showimage5', $arr_fetch_names5 );
	





//get user details if user logged in
if(isset($_SESSION['session_user_id'])&& $_SESSION['session_user_id']!="")
{

	$objUser->id = $_SESSION['session_user_id'];
	$UserRes = $objUser->getUserLoginDetails();
	$UserArr = mysql_fetch_array($UserRes);

	//assign user details information
	$smarty->assign("f_name",$UserArr['FirstName']);
 	$smarty->assign("l_name",$UserArr['LastName']);
 	$smarty->assign("contact_email",$UserArr['Email']);
	$smarty->assign("phone",$UserArr['Phone']);
}



	

//replace message content with mail template message conyent variable
$mail_content			= str_replace("#message_content#",$message_content,$mail_content);
$mail_content			= str_replace("#link#",$baseUrl,$mail_content);



//send and login details email to user
if($_SERVER['REQUEST_METHOD']=='POST')
{
    /*
        $smarty->assign("f_name",$f_name);
	$smarty->assign("l_name",$l_name);
	$smarty->assign("phone",$phone);
	$smarty->assign("contact_email",$contact_email);
	$smarty->assign("contact",$contact);
	$smarty->assign("message",$message);	*/
//echo '<pre>';	print_r($_POST);
//echo '<pre>'; print_r($_FILES);


       

	extract($_POST);
	
	if($removeimage1!='' && $_FILES['upload_img_1']['tmp_name']!='' )
		{
	@unlink("uploads/".$removeimage1);
	//@unlink("uploads/thumbs/".$removeimage1);
		}
		if($removeimage2!=''  && $_FILES['upload_img_2']['tmp_name']!='' )
		{
	@unlink("uploads/".$removeimage2);
         //	@unlink("uploads/thumbs/".$removeimage2);
		}
		if($removeimage3!=''  && $_FILES['upload_img_3']['tmp_name']!='' )
		{
	@unlink("uploads/".$removeimage3);
	//@unlink("uploads/thumbs/".$removeimage3);
		}
		if($removeimage4!=''  && $_FILES['upload_img_4']['tmp_name']!='' )
		{
	@unlink("uploads/".$removeimage4);
	//@unlink("uploads/thumbs/".$removeimage4);
		}
		if($removeimage5!=''  && $_FILES['upload_img_5']['tmp_name']!='' )
		{
	@unlink("uploads/".$removeimage5);
	//@unlink("uploads/thumbs/".$removeimage5);
		}
	
//$POST_MAX_SIZE = ini_get('post_max_size');

	$POST_MAX_SIZE = '2M';
// $_SERVER['CONTENT_LENGTH'];

	$mul = substr($POST_MAX_SIZE, -1);
	///echo '<br>';
	$mul = ($mul == 'M' ? 1048576 : ($mul == 'K' ? 1024 : ($mul == 'G' ? 1073741824 : 1)));


	if ($_SERVER['CONTENT_LENGTH'] > $mul*(int)$POST_MAX_SIZE ) 
	$error = 'true';
	else
	$error = 'false';
	$error ;


	if($error=='true')
	{
	failure_msg("Error occured filsize cannot be more than 2 mb ");
	redirect('upload_imgage.php');
	}

	for($i=1;$i<6;$i++)
	{


	if($_FILES['upload_img_'.$i]['tmp_name']!='')
	  {
	if($_FILES['upload_img_'.$i]['type']=='image/pjpeg' || $_FILES['upload_img_'.$i]['type']=='image/jpeg' || $_FILES['upload_img_'.$i]['type']=='image/png'  || $_FILES['upload_img_'.$i]['type']=='image/gif' )
	   {
	//echo 	$_FILES['upload_img_'.$i]['type'];echo '<br>';
	   }
	else
          {
	   $type_error = 1;
	  } // end else
	 } // end if
       } // end of for loop

       if($type_error==1)
	{
        failure_msg("Error occured file extension should  be .jpg or .gif or .png  ");
	redirect('upload_imgage.php?item_id_value='.$get_remove_value);
	}

	
	$error_msg = "";
	
	//assign post values
	
	 $cnt_counter =0;
        // echo 'error_msg=='.$error_msg;
         //echo '<br>';
          
//if no errors found
		if($error_msg=="")
		{
		for($i=1;$i<6;$i++)
		{
                   
			if($_FILES['upload_img_'.$i]['tmp_name']=='' )
			{
				$cnt_counter =$cnt_counter+1;
			}

			
            if($_FILES['upload_img_'.$i]['tmp_name']!='' )
			{
			$tmp_name_file      = $_FILES['upload_img_'.$i]['tmp_name'];
			$file_name          = basename($_FILES['upload_img_'.$i]['name']);
			$file_ext           = explode(".",$file_name);
            $file_ext_len       = count($file_ext);
			$file_ext_value     = $file_ext[$file_ext_len-1];
			$file_name_with_ext = time().'-'.$i.'.'.$file_ext_value;
			$flg                = move_uploaded_file($tmp_name_file,'uploads/'.$file_name_with_ext);
        	if($flg==1)
			{     

				$namesof_files[$i]  = $file_name_with_ext;
			//	createThumbs1($file_name_with_ext,"uploads/thumbs/","100");
				$sucess_value=1;
			}
			else
			{  // echo 'lala';
                            //exit;
				$sucess_value=2;
				
			}


		  }// end of if
                  
            
	  } // end of for loop
          
          	if($sucess_value==1)
		{
		  if($_FILES['upload_img_1']['tmp_name']!='')
                    $objItem->image1=$namesof_files[1] ;
		  if($_FILES['upload_img_2']['tmp_name']!='')
                    $objItem->image2=$namesof_files[2] ;
                  if($_FILES['upload_img_3']['tmp_name']!='')
		    $objItem->image3=$namesof_files[3] ;
		  if($_FILES['upload_img_4']['tmp_name']!='')
                    $objItem->image4=$namesof_files[4] ;
                  if($_FILES['upload_img_5']['tmp_name']!='')
		    $objItem->image5=$namesof_files[5] ;

                  if($item_id_value=='')
		    $objItem->update_item_id = $_SESSION['Last_id_row'];
		  else
		    $objItem->update_item_id = $item_id_value;

       
		if($error_msg=="")
	        {
                $objItem->suspend_item                     = 1; //0 means image not added
                $objDBReturn = $objItem->insertUpdateImage();
		if($objDBReturn->nErrorCode==0)
		 {
                success_msg("Item details are added successfully!!");
		if($item_id_value=='')
		redirect('upload_imgage.php');
		else
		redirect('upload_imgage.php?item_id_value='.$item_id_value);
		 }
		
	        }else {
                failure_msg("Error ocurred please try again!!  ");
                if($item_id_value=='')
		redirect('upload_imgage.php');
		else
		redirect('upload_imgage.php?item_id_value='.$item_id_value);

                      }
	
    	        }	
		else if($cnt_counter==5 && $item_id_value=='')
                {
		failure_msg("Please select atleast one file!!  ");
		redirect('upload_imgage.php');
		}
                else if($cnt_counter==5 && $no_image_upload==1 && $item_id_value!='' )
                {
		failure_msg("Please select atleast one file!!  ");
		redirect('upload_imgage.php?item_id_value='.$item_id_value);
		}
		else if($cnt_counter!=0 && $sucess_value==2 )
		{			
		failure_msg("Error occured file not uploaded!!  ");
		if($item_id_value=='')
		redirect('upload_imgage.php');
		else
		redirect('upload_imgage.php?item_id_value='.$item_id_value);
		}
		

	}// end of error message
	//end of if($error_msg=="")
}
// createThumbs1("1274428329-1.jpg","uploads/thumbs/","100");
//assign error/update message

$smarty->assign("error_msg",$error_msg);
$smarty->assign("prev_next_id_value",$item_id_value);

$smarty->assign("update_msg",$update_msg);
if($item_id_value!='')
$smarty->assign("item_id_value",$item_id_value);
else
$smarty->assign("item_id_value",$_SESSION['Last_id_row']);

//display template
$smarty->assign('site_page_title','Sell an Item');
$smarty->assign('site_title',$site_title);
$smarty->display('upload_imgage.tpl');
?>
