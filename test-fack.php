<?php
include("FCKeditor3/fckeditor.php") ;
if($_POST['add'])
{
echo  $_POST['FCKeditor1'];

}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
</head>

<body>

<table>
<form action="" method="post"  name="frm">
<tr><td>laalal</td></tr>
<tr><td></td></tr>
<tr><td></td></tr>
<tr><td><?php
// Automatically calculates the editor base path based on the _samples directory.
// This is usefull only for these samples. A real application should use something like this:
// $oFCKeditor->BasePath = '/FCKeditor/' ;	// '/FCKeditor/' is the default value.
 $sBasePath = $_SERVER['PHP_SELF'] ;
//$sBasePath = substr( $sBasePath, 0, strpos( $sBasePath, "test-fack.php" ) ) ;
echo $sBasePath =  'FCKeditor/' ;
$oFCKeditor = new FCKeditor('FCKeditor1') ;
$oFCKeditor->BasePath	= $sBasePath ;
$oFCKeditor->Value		= 'This is some <strong>sample text</strong>. You are using <a href="http://www.fckeditor.net/">FCKeditor</a>.' ;
$oFCKeditor->Create() ;
?>

</td></tr>
<tr><td><input type="submit" value="add" name="add" /></td></tr>
</form>
</table>
</body>
</html>
