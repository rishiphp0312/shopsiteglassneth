<?php
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT\n");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-cache");
header("Pragma: no-cache");


$explode_file =  explode(".",$_REQUEST['name_file']);
$get_exten    =  $explode_file[1];
$get_exten    = strtolower($get_exten);


$path         =  "uploads/custom_item/".$_REQUEST['name_file'];


if($get_exten=='gif' && $_REQUEST['name_file']!='' )
{
header('Content-Type: image/gif');
}


if(($get_exten=='jpg' ||$get_exten=='jpeg') && $_REQUEST['name_file']!='' )
{
header('Content-Type: image/jpeg');
}

if($get_exten=='png'  && $_REQUEST['name_file']!='')
{
header('Content-Type: image/x-png');
}
// zip file download
if($get_exten=='zip'  && $_REQUEST['name_file']!='' )
{
header("Content-type: application/zip;\n"); //or yours?
/*
header("Content-Transfer-Encoding: binary");
$len = filesize(basename($path));
header("Content-Length: $len;\n");
*/
}


if(($get_exten=='doc')  && $_REQUEST['name_file']!='' )
{
header("Content-type: application/doc"); 

}
if(($get_exten=='txt')  && $_REQUEST['name_file']!='' )
{
header("Content-type: application/txt"); 
}
if(($get_exten=='rtf')  && $_REQUEST['name_file']!='' )
{
header("Content-type: application/rtf"); 
}

if(($get_exten=='rar')  && $_REQUEST['name_file']!='' )
{
header("Content-type: application/rar"); 
}

if(($get_exten=='xls')  && $_REQUEST['name_file']!='' )
{
header("Content-type: application/vnd.ms-excel"); 
}

if(($get_exten=='csv')  && $_REQUEST['name_file']!='' )
{
header("Content-type: text/x-csv"); 
}

if(($get_exten=='pdf')  && $_REQUEST['name_file']!='' )
{
header("Content-type: application/pdf"); 
}

header("Content-Disposition: attachment; filename=nethaat-".basename($path));

readfile($path);
// 
echo "<script>window.close();</script>";
//header('Content-Type: image/gif');
?>
