<?php
include ('include/common.inc');
include ('class/class.user.inc');
include ('class/class.mail.inc');
include ("include/authentiateUserLogin.php");

//echo phpinfo();

$objUser        = new Class_User();

$objUser->id = $_SESSION['session_user_id'];
$UserRes = $objUser->getUserLoginDetails();
if(mysql_num_rows($UserRes)>0){
$UserArr = mysql_fetch_array($UserRes);
//assign user details information
$smarty->assign("f_name",$UserArr['FirstName']);
$smarty->assign("l_name",$UserArr['LastName']);
$smarty->assign("contact_email",$UserArr['Email']);
$smarty->assign("phone",$UserArr['Phone']);
}
$smarty->assign("UserRes_array_tpl",$UserArr);

if($_SERVER['REQUEST_METHOD']=='POST')
{
	//extract post variables array
	extract($_POST);
	$objUser->id = $_SESSION['session_user_id'];

    //sel_logo_status	
if($_POST['sel_banner']==1)
{	

//exit;
if($_FILES['banner_upload']['tmp_name']!='')
{
  $image_details = getimagesize($_FILES['banner_upload']['tmp_name']);

  $image_detailswidth   =  $image_details[0];
  if($image_detailswidth>680)
  {
  //failure_msg("Banner width should be less than 680 ");
  //redirect("banner-manage.php");
  }
  if($_FILES['banner_upload']['type']=='image/pjpeg' || $_FILES['banner_upload']['type']=='image/jpeg' || $_FILES['banner_upload']['type']=='image/png'  || $_FILES['banner_upload']['type']=='image/gif' )
   {
	$tmp_name_file      = $_FILES['banner_upload']['tmp_name'];
	$file_name          = basename($_FILES['banner_upload']['name']);
	$file_ext           = explode(".",$file_name);
	$file_ext_len       = count($file_ext);
	$file_ext_value     = $file_ext[$file_ext_len-1];
	$file_name_with_ext = "uploads/".$_SESSION['session_user_name']."/banners/banner-".time()."-".".".$file_ext_value;
	
   $upload_banner=move_uploaded_file($_FILES['banner_upload']['tmp_name'],$file_name_with_ext);
  
	if($upload_banner==1)
	{
	$objUser->banner_val   = 5;
	$objUser->sel_banner_status = 1;//sel_banner_status
	$objUser->banner_name  = "banner-".time()."-".".".$file_ext_value;
	$objUser->id           = $_SESSION['session_user_id'];
	$objDBReturn           = $objUser->insertUpdateUser();exit;
	unlink("uploads/".$_SESSION['session_user_name']."/banners/".$_POST['unlink_banner']);
	//exit;	
//    if($objDBReturn->nIdentity && $objDBReturn->nErrorCode==0)
//  {
  success_msg("Information updated  successfully!!");
	
  //}
  
  ////====
  }
   //sel_banner_status

}
else
{
    failure_msg("Error occured file extension should  be .jpg or .jpeg or .gif or .png  ");

  
  } // end else
} // end if
		   
	}
	
if($_POST['sel_banner']==2)  // predifine banner
{	

    if($_POST['sel_banner']==2 && $_POST['banner_val']=='')
	{
	failure_msg("Please select atleast one banner from the given options .!!  ");
	redirect("banner-manage.php");
	}	   

    $objUser->banner_val   = $_POST['banner_val'];
	$objUser->banner_name  = $_SESSION['session_user_name'].'-banner-text.png';
	$objUser->sel_banner_status = 2;//sel_banner_status
	$objUser->id           = $_SESSION['session_user_id'];
	$objDBReturn           = $objUser->insertUpdateUser();
	//exit;
	//echo '==nid=='.$objDBReturn->nIdentity;
	//echo '<br>';
	//echo '==nErrorCode=='.$objDBReturn->nErrorCode;
	
	if($objDBReturn->nIdentity==0 && $objDBReturn->nErrorCode==0)
	{ 
	require_once('dynamic-gd-image1.php');
  success_msg("Information updated  successfully!!");
	}
	else
	{
	failure_msg("Error occured banner not updated  ");
   }
}	
	   

	
if($_POST['sel_logo']==2) // upload logo
{
if($_FILES['logo_upload']['tmp_name']!='')
{
	
  if($_FILES['logo_upload']['type']=='image/pjpeg' || $_FILES['logo_upload']['type']=='image/jpeg' || $_FILES['logo_upload']['type']=='image/png'  || $_FILES['logo_upload']['type']=='image/gif' )
   {
	$tmp_name_file      = $_FILES['logo_upload']['tmp_name'];
	$file_name          = basename($_FILES['logo_upload']['name']);
	$file_ext           = explode(".",$file_name);
	$file_ext_len       = count($file_ext);
	$file_ext_value     = $file_ext[$file_ext_len-1];
	$file_name_with_ext = "uploads/".$_SESSION['session_user_name']."/store_logos/logo-".time()."-".".".$file_ext_value;
	
   $upload_banner       = move_uploaded_file($_FILES['logo_upload']['tmp_name'],$file_name_with_ext);
  
	if($upload_banner==1)
	{
	$objUser->sel_logo_status = 2;  //sel_logo_status uploaded logo
	$objUser->store_logo   = "logo-".time()."-".".".$file_ext_value;
	$objUser->id           = $_SESSION['session_user_id'];
	$objDBReturn           = $objUser->insertUpdateUser();	
	//exit;
	unlink("uploads/".$_SESSION['session_user_name']."/store_logos/".$_POST['unlink_logo']);
	

//    if($objDBReturn->nIdentity && $objDBReturn->nErrorCode==0)
//  {
    success_msg("Information updated  successfully!!");
	
  //}
  
  ////====
  }
   //sel_banner_status

}
else
{
    failure_msg("Error occured file extension should  be .jpg or .jpeg or .gif or .png  ");

  
  } // end else

	
	}

    //logo_upload
   	
    success_msg(" Banner updated successfully.!! ");
	
}	
if($_POST['sel_logo']==1) // predefined logo
{
    $objUser->id              = $_SESSION['session_user_id'];
	$objUser->sel_logo_status = 1;  //sel_logo_status predefine
	$objDBReturn              = $objUser->insertUpdateUser();		
    success_msg(" Banner updated successfully.!! ");
	
}



  
  	redirect('banner-manage.php');
 }
	
	//echo 'country=='.$fetch_country_id;
//assign page title and display template
$smarty->assign('site_page_title','Nethaat: Banner Management');
$smarty->assign('site_title',$site_title);
$smarty->display('banner-manage.tpl');
?>
