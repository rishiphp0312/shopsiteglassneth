<?php
include ("common_includes.php");
include ("../include/adminsession.php.inc");
include ("../class/class.user.inc");
//include ('../include/imageOptimization.php');
include ('../include/country_state_cat.php');


    //create user class object
        $objUser		= new Class_User();
//	$objUser->tut_id = 1;
//	$resUser         = $objUser->selectFlv();
//	$num_rows_flv    = mysql_num_rows($resUser);
//	if($num_rows_flv>0)
//	$resUserRow      = mysql_fetch_array($resUser);
//	$tut_path        = $resUserRow['tutorial_path'];
//	$smarty->assign('tut_path',$tut_path);

    if($_SERVER['REQUEST_METHOD']=='POST')
    {
         extract($_POST);
         //echo $_FILES['flv_tutorial']['type'] ;
		 //exit;
		

	 $flv_tutorial_tmp     = $_FILES['flv_tutorial']['tmp_name'];
	 $flv_tutorial         = basename($_FILES['flv_tutorial']['name']);
         $exp_flv_tutorial     = explode(".",$flv_tutorial);
	 $ext_exp_flv_tutorial = $exp_flv_tutorial[count($exp_flv_tutorial)-1];
         $new_name_flv         = '1.'.$ext_exp_flv_tutorial;
	 if($_FILES['flv_tutorial']['type']!='application/octet-stream' || strtolower($ext_exp_flv_tutorial)!='flv')
	 {
	        failure_msg("Error occured, please try again later");
		redirect("add_tutorial.php");
	 }
                 
		 $total_path           = "../uploads/tutorials/".$new_name_flv;
         if($flv_tutorial_tmp!='')
		{
		 $flg_flv              =  move_uploaded_file($flv_tutorial_tmp,$total_path);
		 if($flg_flv==1)
		  {
					$objUser->tut_id        = 1;
					$objUser->tutorial_path =  $new_name_flv ;
					$objDBReturn            = $objUser->insertUpdateFlv();
					$objDBReturn->nErrorCode;
					
				        if($objDBReturn->nErrorCode==0)
					{
					//header("location:admin_users.php");
					success_msg("Tutorial updated successfully!!");
					}
					 else
					{
					failure_msg("Error occured, please try again later");
					}
				
		 }
		}	 
		$smarty->assign('error_msg',$error_msg);
		redirect("add_tutorial.php");
	}


$smarty->assign('err_message',$err_message);

			
//display template and title
$smarty->assign('site_page_title',ADMIN_COMMON_TITLE);
$smarty->assign('site_title',$site_title);
$smarty->display('add_tutorial.tpl');	
?>