<?php
$image_thumb_method =1;
if($image_thumb_method==1)
{
	// Parameters:
	// src - path to source image
	// dest - path to thumb (where to save it)
	// w - max width
	// h - max height
	// q - quality (applicable only to JPG, 1 to 100, 100 - best)
	// t - thumb type. "-1" - same as source, 1 = GIF, 2 = JPG, 3 = PNG
	// f - save to file (1) or output to browser (0).

	// Sample usage:
	// 1. save thumb on server
	// http://www.zubrag.com/thumb.php?src=test.jpg&dest=thumb.jpg&x=100&y=50
	// 2. output thumb to browser
	// http://www.zubrag.com/thumb.php?src=test.jpg&x=50&y=50&f=0


	// Below are default values (if parameter is not passed)

	// save to file (true) or output to browser (false)
	$save_to_file = true;

	// Quality for JPEG and PNG.
	// 0 (worst quality, smaller file) to 100 (best quality, bigger file)
	// Note: PNG quality is only supported starting PHP 5.1.2
	$image_quality = 100;

	// resulting image type (1 = GIF, 2 = JPG, 3 = PNG)
	// enter code of the image type if you want override it
	// or set it to -1 to determine automatically
	$image_type = -1;

	// maximum thumb side size
	$max_x = 100;
	$max_y = 100;

	// cut image before resizing. Set to 0 to skip this.
	$cut_x = 0;
	$cut_y = 0;

	// Folder where source images are stored (thumbnails will be generated from these images).
	// MUST end with slash.
	$images_folder = '/uploads/';

	// Folder to save thumbnails, full path from the root folder, MUST end with slash.
	// Only needed if you save generated thumbnails on the server.
	// Sample for windows:     c:/wwwroot/thumbs/
	// Sample for unix/linux:  /home/site.com/htdocs/thumbs/
	$thumbs_folder = '/uploads/cache/';

	$to_name = '';

	if (isset($_REQUEST['f'])) {
	  $save_to_file = intval($_REQUEST['f']) == 1;
	}
	$save_to_file = 0; //added by mahipal

	if (isset($_REQUEST['fromfile'])) {
	  $from_name = urldecode($_REQUEST['fromfile']);
	}
	else {
	  die("Source file name must be specified.");
	}

	if (isset($_REQUEST['dest'])) {
	  $to_name = urldecode($_REQUEST['dest']);
	}
	else if ($save_to_file) {
	  die("Thumbnail file name must be specified.");
	}

	if (isset($_REQUEST['q'])) {
	  $image_quality = intval($_REQUEST['q']);
	}

	if (isset($_REQUEST['t'])) {
	  $image_type = intval($_REQUEST['t']);
	}
	$image_type = "-1"; //added by mahipal

	if (isset($_REQUEST['w'])) {
	  $max_x = intval($_REQUEST['w']);
	}

	if (isset($_REQUEST['h'])) {
	  $max_y = intval($_REQUEST['h']);
	}

	//if (!file_exists($images_folder)) die('Images folder does not exist (update $images_folder in the script)');
	if ($save_to_file && !file_exists($thumbs_folder)) die('Thumbnails folder does not exist (update $thumbs_folder in the script)');

	// Allocate all necessary memory for the image.
	// Special thanks to Alecos for providing the code.
	ini_set('memory_limit', '-1');

	// include image processing code
	include('image.class.php');

	$img = new Zubrag_image;

	// initialize
	$img->max_x        = $max_x;
	$img->max_y        = $max_y;
	$img->cut_x        = $cut_x;
	$img->cut_y        = $cut_y;
	$img->quality      = $image_quality;
	$img->save_to_file = $save_to_file;
	$img->image_type   = $image_type;

	// generate thumbnail
	//$img->GenerateThumbFile($images_folder . $from_name, $thumbs_folder . $to_name);
	$img->GenerateThumbFile($from_name, $thumbs_folder . $to_name);
}
else
{
	ini_set('memory_limit', '-1');
	include("class/image_class.php");

	$width		= $_GET['w'];
	$height		= $_GET['h'];
	$old_image	= $_GET['fromfile'];

	//set new image
	$namePartsArr	= explode('.', $old_image);
	$file_ext		= $namePartsArr[count($namePartsArr) - 1];
	$new_image		= "thumb-".time().".".$file_ext;

	$image = new Image($old_image);
	//$image->watermark('printer.png');
	$image->resize($width, $height);
	//$image->addwatermark('middle');
	//$image->create($new_image);
	$image->save($new_image);
}
?>
