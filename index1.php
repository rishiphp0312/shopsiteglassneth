<?php
include ('include/common.inc');
include ("class/class.user.inc");
include ("class/class.item.inc");
include ('class/class.cms.inc');


/***************************************** code for Featured Store END  *********************************/


//assign variable and display template
$smarty->assign('site_page_title','Nethaat : '.SITE_HOME);
$smarty->assign('site_title',$site_title);
$smarty->display('index1.tpl');
?>