<?php
include ("common_includes.php");
include ("../include/adminsession.php.inc");
include ("../class/class.item.inc");
include ("../class/class.user.inc");
include ("../class/class.shipping.inc");

//assign static labels and heading
$smarty->assign("form_heading","Manage Style");


//create object of Item class


	$objUser		= new Class_User();
	
	if($_REQUEST['style_id']!='')
	{
	$objUser->style_id       = $_REQUEST['style_id'];
	$result_qty              = $objUser->getStylelisting();
	$num_qty                 = mysql_num_rows($result_qty);
	if($num_qty >0)
    $arr_qty                 = mysql_fetch_assoc($result_qty);
	$smarty->assign('arr_set_style',$arr_qty['set_style']);
	}
     //  echo 'sss--'.$arr_qty['set_style'];
     

if($_POST['submit'])
{
	
	$objUser->style_id               =  $_REQUEST['style_id'];
    $objUser->set_style			     =  addslashes(trim($_POST['set_style'],'')); 
	$result_sty1                     =  $objUser->getStylelisting1();
	$num_sty1                         =  mysql_num_rows($result_sty1);
	if($num_sty1==0)
	{
	$result_qty					     =  $objUser->insertUpdatestyle();
	
		if($result_qty->nErrorCode==0)
		{
			 if($_REQUEST['style_id']=='')
		      success_msg("Style added successfully!!");
			  else
	    	  success_msg("Style updated successfully!!");
			  
		}
		else
		{
    		  failure_msg("Error occured, please try again later");
		}
	}
	else
	{
	          success_msg(" This style already exsists!! ");
	}
    redirect("view_style.php");
}


			
					
			







///////--code for  serching ends here





//display template and title
$smarty->assign('site_page_title',ADMIN_COMMON_TITLE);
$smarty->assign('site_title',$site_title);
$smarty->display('admin_add_style.tpl');	
?>