<?php
set_time_limit(0); //set execution time to unlimited
ini_set("post_max_size","128M");
ini_set("upload_max_filesize","128M");
include ("common_includes.php");
include ("../include/adminsession.php.inc");
include ("../class/class.tutorial.inc");

//create object of Tutorial class
$objTute = new Class_Tutorial();

//upload tutorial path
$upload_path = "../uploads/tutorials/";

//selects tutorial for edit
if(isset($_GET['tute_id']) && $_GET['tute_id']!="")
{
	$objTute->tute_id = trim($_GET['tute_id']);
	$resCMS         = $objTute->selectTutorials();
	
	if(mysql_num_rows($resCMS) > 0)
	{
		$tute      = mysql_fetch_array($resCMS);
		$smarty->assign('tute_language', $tute['tute_language']);
		$smarty->assign('tute_video', $tute['tute_video']);
	}
}

//post form
if($_SERVER['REQUEST_METHOD']=='POST')
{
	//extract post array
	extract($_POST);
	$error_msg = "";

	if(isset($_FILES['tute_video']) && $_FILES['tute_video']['name']!="")
	{
		//check file extension and upload file
		$flv_tutorial_tmp     = $_FILES['tute_video']['tmp_name'];
		$flv_tutorial         = basename($_FILES['tute_video']['name']);
		$exp_flv_tutorial     = explode(".",$flv_tutorial);
		$ext_exp_flv_tutorial = $exp_flv_tutorial[count($exp_flv_tutorial)-1];
		//$new_name_flv       = $flv_tutorial.$ext_exp_flv_tutorial;
		$new_name_flv         = $flv_tutorial;

		if($_FILES['tute_video']['type']!='application/octet-stream' || strtolower($ext_exp_flv_tutorial)!='flv')
		{
			$error_msg = "Please upload FLV file only";
		}
		
		if($flv_tutorial_tmp!='' && $error_msg=="")
		{
			//unlik old video if already exists
			unlink($upload_path.$tute['tute_video']);

			//upload new video
			$flg_flv              =  move_uploaded_file($flv_tutorial_tmp, $upload_path.$flv_tutorial);
			if($flg_flv==1)
			{
				$objTute->tute_video =  $new_name_flv;
				//echo "uploaded";
			}
			else
			{
				$error_msg = "Could not upload file. Please contact system admin.";
			}
		}
	}
	
	//if no errors found update database
	if($error_msg == "")
	{
		$objTute->tute_language =  $tute_language;
		$objDBReturn	= $objTute->insertUpdateTutorial();
		if($objDBReturn->nErrorCode==0 && $objDBReturn->sError=="")
		{
			success_msg("Tutorial has been saved successfully!!");
		}
		else
		{
			failure_msg("Error occured, please try again later");
		}
		//echo "sss=".$objDBReturn->sError;
		redirect("admin_tutorials.php");
	}
	//assign error message
	$smarty->assign('error_msg', $error_msg);

	//assign post values
	$smarty->assign('tute_language', $tute_language);
}

			
//display template and title
$smarty->assign('site_page_title',ADMIN_COMMON_TITLE);
$smarty->assign('site_title',$site_title);
$smarty->display('admin_add_tutorial.tpl');	
?>