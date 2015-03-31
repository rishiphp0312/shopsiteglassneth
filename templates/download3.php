<?php
include ('include/common.inc');
include ('class/class.cms.inc');
include ('class/class.user.inc');

$objUser = new Class_User();
$cust_id = base64_decode($_REQUEST['cust_id']);
$cust_id1= $_REQUEST['cust_id1'];
if($cust_id!='')
{
	$objUser->custommessage_id = $cust_id;
	$UserRes     = $objUser->getcustommessage();
	$num_userarr = mysql_num_rows($UserRes);
	
	if($num_userarr>0)
	{
	$UserArr     = mysql_fetch_assoc($UserRes);
	
	
		 $items_image  	=	$UserArr['file_attached'];
		$path = 'uploads/'.$UserArr['username'].'/custom_item/'.$items_image;
		
		
		header ("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
		header ("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
		header ("Cache-Control: no-cache, must-revalidate");
		header ("Pragma: no-cache");
		//header ("Content-type: ".mime_content_type($path));
	//	header ("Content-type: ".returnMIMEType($items_image));
		header ("Content-Disposition: attachment; filename=".$items_image);
		header ("Content-Description: Custom Item Attachment" );
		readfile($path);
	}
}
if($cust_id1!='')
{
	$objUser->tblid = $cust_id1;
	$UserRes     = $objUser->getcustomitem();
	
	$num_userarr = mysql_num_rows($UserRes);	
	if($num_userarr>0)
	{
	$UserArr     = mysql_fetch_assoc($UserRes);

      //echo '<pre>';
	  //print_r($UserArr);
	  //echo '</pre>';
		 $items_image  	=	$UserArr['file_attached'];
	    //echo '<br>';
		 $path = 'uploads/'.$UserArr['username'].'/custom_item/'.$items_image;
		//exit;			
		header ("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
		header ("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
		header ("Cache-Control: no-cache, must-revalidate");
		header ("Pragma: no-cache");
	//	header ("Content-type: ".mime_content_type($path));
	//	header ("Content-type: ".returnMIMEType($items_image));
		header ("Content-Disposition: attachment; filename=".$items_image);
		header ("Content-Description: Custom Item Attachment" );
		readfile($path);
	}
}


?>