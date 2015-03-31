<?php
	
	$image_text = ucfirst($username);
	if($_POST['banner_val']==1)
	{
	$red   = 248;
	$green = 237;
	$white1 = 209;
	//$_GET['main']
	$main_img  = "test-baner/artisans1.jpg";

	}
	if($_POST['banner_val']==2)
	{
	$red   = 255;
	$green = 255;
	$white1 = 255;
	$main_img= "test-baner/artists1.jpg";
	
	}
	if($_POST['banner_val']==3)
	{
	$red   = 255;
	$green = 255;
	$white1 = 255;
	$main_img= "test-baner/designeres1.jpg";
	}
	if($_POST['banner_val']==4)
	{
	$red   = 253;
	$green = 243;
	$white1 = 242;
	$main_img= "test-baner/homemakers1.jpg";
	
	}
	//aashigifts= 
	$len_img    = strlen($image_text);
	$add_length=(15)*$len_img; 
	// Create a blank image and add some text
	$im = imagecreatetruecolor($add_length, 50);
	$white = imagecolorallocate($im, $red, $green, $white1);
	//$white = imagecolorallocate($im,255, 0, 0);
	imagefilledrectangle($im, 0, 0,$add_length+1,50, $white);
	
	$text_color = imagecolorallocate($im, 320,14, 91);
	imagestring($im,100, 16, 19,  $image_text,$text_color);
	
	
	// Output the image
	imagepng($im,$image_text.'-banner-text.png');
	
	// Free up memory
	//imagedestroy($im);
	copy($image_text.'-banner-text.png','test-uploads/'.$image_text.'-banner-text.png');
	
	/////------watermark -code starts----below------////
	include 'api.watermark.php';
	$watermark			= new watermark();
	$watermark_img      = 'test-uploads/'.$image_text.'-banner-text.png';

	# create image objects using our user-specified images
	# NOTE: we're just going to assume we're dealing with a JPG and a PNG here - for example purposes
	$main_img_obj		= imagecreatefromjpeg($main_img);
	$watermark_img_obj	= imagecreatefrompng($watermark_img);

	# create our watermarked image - set 66% alpha transparency for our watermark
	$return_img_obj			= $watermark->create_watermark($main_img_obj, $watermark_img_obj, 66);

	# display our watermarked image - first telling the browser that it's a JPEG, 
	# and that it should be displayed inline
	//header( 'Content-Type: image/jpeg' );
	header( 'Content-Disposition: inline; filename=' . $_GET['src'] );
	imagejpeg($return_img_obj, $image_text.'-banner.jpeg', 50 );
//	imagejpeg($im,$image_text.'-banner-text.jpeg');
	//copy('rishi-banner-text.jpeg','rishi-banner-text.jpeg');
	// Free up memory
	//imagedestroy($im);
	copy($image_text.'-banner.jpeg','test-uploads/'.$image_text.'-banner.jpeg');
    /////------watermark -code end----below------////
	
	
?>