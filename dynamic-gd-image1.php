<?php
ini_set("display_errors","3"); //0- off, 3- ON

  if($_POST['banner_val']==1)
  $image="test-baner/artisans1.jpg";
  if($_POST['banner_val']==2)
  $image="test-baner/artists1.jpg";
  if($_POST['banner_val']==3)
  $image="test-baner/designeres1.jpg";
  if($_POST['banner_val']==4)
  $image="test-baner/homemakers1.jpg";

//Load the image
	 $username        = $_POST['username'];
	//echo '<br>';
	//echo $image;

    $image           = $baseUrl.$image;

	$img             = imagecreatefromjpeg($image);
	$get_size        = getimagesize($image);
	$with_main       = $get_size[0];
	$height_main     = $get_size[1];
	
	$newwidth_coord  = floor($with_main/2);
	$newheight_coord = floor($height_main/2);
	$image_text      = $username;
	//Convert to PNG and send it to browser
	if($img) {
//header("Content-Type: image/png");
	$text_color = imagecolorallocate($img, 320,14, 91);
	//imagestring($im,1000, 16, 19,  $image_text,$text_color);
	
	// Path to our ttf font file
	$font_file = 'font/verdana.ttf';
	
	// Draw the text 'PHP Manual' using font size 13
	//imagefttext($im, 16, 0, 16, 19, $text_color, $font_file,  $image_text);
	imagefttext($img, 25, 0, $newwidth_coord-24, $newheight_coord, $text_color, $font_file,  $image_text);
		
	
	// Output the image
	imagepng($img,'/home/nethaatadmin/public_html/uploads/'.$image_text.'/banners/'.$image_text.'-banner-text.png');
	//echo 'img-text'.$image_text;
	//exit;
	//unlink($image_text.'-banner-text.png');
	# and that it should be displayed inline
	//header( 'Content-Type: image/jpeg' );
	
	
	}
	?>
