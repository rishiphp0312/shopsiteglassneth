<?php
include ('include/common.inc');
include ('class/class.cms.inc');
include ("class/class.item.inc");
include ('class/class.user.inc');

header ("Expires: Mon, 26 Jul 1997 05:00:00 GMT");

header ("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");

header ("Cache-Control: no-cache, must-revalidate");

header ("Pragma: no-cache");
$file_id      = $_REQUEST['file_id'];


/*
$explode_file =  explode(".",$_REQUEST['name_file']);
$get_exten    =  $explode_file[1];
$get_exten    =  strtolower($get_exten);
$path         =  "uploads/custom_uploads/".$_REQUEST['name_file'];
$filtype      =   filetype(basename($path));
*/
header ("Content-type: $filtype");

header ("Content-Disposition: attachment; filename=".basename($path));

readfile($path);

?>
