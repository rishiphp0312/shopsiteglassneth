<?php
include ('include/common.inc');

$smarty->assign('site_page_title',"Error");
$smarty->assign('site_title',$site_title);
$smarty->display('error404.tpl');
?>