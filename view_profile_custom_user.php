<?php
include ('include/common.inc');
include ("include/authentiateUserLogin.php");
include ('class/class.user.inc');

$objUser = new Class_User();

$smarty->assign("id",$_GET['id']);
$smarty->assign("buyid",$_GET['buyid']);

if(isset($_GET['id'])&& $_GET['id']!="")
{
	$objUser->tblid = $_GET['id'];
	$smarty->assign("id",$_GET['id']);
	$UserRes = $objUser->getcustomitem();
	while($UserArr = mysql_fetch_array($UserRes))
	{
		$items[]	=	$UserArr;
	}
	
	$smarty->assign("citem",$items);

	$objUser->id = $_GET['id'];
	$objUser->buyid = $_GET['buyid'];

	//$smarty->assign("id",$_GET['id']);
	$UserRes = $objUser->getcustommessage();
	while($UserArr = mysql_fetch_array($UserRes))
	{
		$msg[]	=	$UserArr;
	}
	
	$smarty->assign("msg",$msg);
}

$smarty->assign("get_id",$_GET['id']);
$smarty->assign("buyid",$_GET['buyid']);

if(isset($_POST['submit'])&& $_POST['submit']!="")
{
	extract($_POST);
	
	//print_r($_FILES);	
	//uploads/custom_uploads
	
	$objUser->message_id		= rteSafe($msgid);	
	$objUser->seller_id 		= rteSafe($sellerid);
	$objUser->buyer_id	  		= rteSafe($user_id);
	$objUser->message  			= rteSafe($message);
	$objUser->user_type			= $_SESSION['session_user_id'];
	
	//$objUser->user_type			= rteSafe($_SESSION['session_user_type']);
	$image_tmpname              = $_FILES['attach_file']['tmp_name'];
	$image_name                 = basename($_FILES['attach_file']['name']);
	
	if($image_tmpname!='')
	{
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
		redirect('view_profile_custom_user.php?id='.$_REQUEST['get_id'].'&buyerid='.$_REQUEST['buyid']);
	}
	//$file_extension_array = array("image/pjpeg","image/png","image/jpeg","image/gif",   "application/txt","text/x-csv","application/doc","application/vnd.ms-excel",
//	"application/rtf","application/pdf");
	//echo in_array($_FILES['attach_file']['type'],$file_extension_array);"text/x-csv",
	//exit;

//	"application/rtf",

$file_extension_array = array("image/pjpeg","image/png","image/jpeg","image/gif",   "application/txt","application/doc","application/msword","application/vnd.ms-excel","application/pdf","image/x-png");
//echo $_FILES['attach_file']['type'];
//echo in_array($_FILES['attach_file']['type'],$file_extension_array);
//exit;
	if(in_array($_FILES['attach_file']['type'],$file_extension_array)!=1)
	{
		failure_msg("Error occured file extension should be .jpg,.jpeg,.gif,.xls,.doc!!");
		redirect('view_profile_custom_user.php?id='.$_REQUEST['get_id'].'&buyerid='.$_REQUEST['buyid']);
	}
    }
	
	$image_name_exp             = explode(".",basename($_FILES['attach_file']['name']));
	$count_val                  = count($image_name_exp); 
	$image_name_ext             = $image_name_exp[$count_val-1];
	if($message!='')
	{
	$objDBReturn                = $objUser->insertUpdatemessage();
	$last_id                    = $objDBReturn->nIdentity;
	if($image_tmpname!='')
	{
	    $file_attached             = 'file-'.$last_id.'.'.$image_name_ext;
	    $flg_upload                =  move_uploaded_file($image_tmpname,'uploads/custom_uploads/'.'file-'.$last_id.'.'.$image_name_ext);
		if($flg_upload==1)
		{ 
		$objUser->reqid              = $last_id;
		$objUser->file_attached     = $file_attached;
		
		$objDBReturn                = $objUser->insertUpdatemessage();
		//exit;
		}
	}
    }
	
	header("location:view_profile_custom_user.php?id=".$objUser->message_id);
	
	if($objDBReturn->nIdentity==0 && $objDBReturn->nErrorCode==0)
	{
	success_msg("Message succesfully posted ");

		//success_msg("Your registration was successfull");
	}
	else
	{
		$error_msg = "Error occured ...!Please try again";
	}
}
$smarty->assign('CURRENCY',CURRENCY);
$smarty->assign('site_page_title',SITE_HOME);
$smarty->assign('site_title',$site_title);
$smarty->display('view_profile_custom_user.tpl');
?>