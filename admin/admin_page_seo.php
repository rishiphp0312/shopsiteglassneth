<?php
include ("common_includes.php");
include ("../class/class.user.inc");
include ("../include/adminsession.php.inc");//check admin session

//create object of user class
$objUser = new Class_User();

$meta_id = $_REQUEST['meta_id'];
//update password
if($_REQUEST['meta_id']!=''){

$objUser->meta_id = $meta_id;
$objResCatTotal = $objUser->select_metaTags();
$total_records = mysql_num_rows($objResCatTotal);
if($total_records>0)
{
$Row = mysql_fetch_array($objResCatTotal);
$productList_metatitle	        = $Row['meta_title'];
$productList_metakeywords	= $Row['meta_keywords'];
$productList_metadescription    = $Row['meta_description'];
$productList_pagename           = $Row['page_name'];
}
                              }
                            //  echo 'pag-name'.$productList_pagename;
$smarty->assign('productList_metatitle',$productList_metatitle);
$smarty->assign('productList_metakeywords',$productList_metakeywords);
$smarty->assign('productList_metadescription',$productList_metadescription);
$smarty->assign('productList_pagename',$productList_pagename);
if(isset($_POST['metatags']))
{//Post Variable
   // print_r($_POST);
		extract($_POST);
                if($meta_id!='')
                $objUser->meta_id     = $meta_id;
                $objUser->title       = $title;
                $objUser->page_name   = $page_name;
             
		$objUser->description = $description;
                $objUser->Keywords    = $Keywords;
               
                $objDBReturn = $objUser->insertUpdate_metaTags();

                //update forum user information
		
		if($objDBReturn->nErrorCode==0)
		{   if($meta_id!='')
	            $update_mess = "Information added successfully!!";
                    else
                    $update_mess = "Information updated successfully!!";

                    success_msg($update_mess);
			//$smarty->assign('update_mess',$update_mess);
		}
		else
		{
		    failure_msg("Error occured, please try again later");
		}
		redirect('admin_view_seo.php');
}

$smarty->assign('meta_id',$meta_id);
//display template and title
$smarty->assign('site_page_title',ADMIN_ACCOUNT);
$smarty->assign('site_title',$site_title);
$smarty->display('admin_page_seo.tpl');
?>