<?php
include ("common_includes.php");
include ("../class/class.user.inc");
include ("../include/adminsession.php.inc");//check admin session

//create object of user class
$objUser = new Class_User();

//print_r($_SESSION);
//display template and site title
$smarty->assign('site_page_title',ADMIN_HOME);
$smarty->assign('site_title',$site_title);
$smarty->display('admin_home.tpl');	
?>
