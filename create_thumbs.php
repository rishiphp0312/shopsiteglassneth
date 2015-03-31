<?php
/*
	This is the PHP code for the How to Create Thumbnail Images using PHP Tutorial

	This script creates all of the thumbnail images and the gallery.html page.

	Note: Make sure that PHP has permission to read and write 
	to the directory in which .jpg files are stored and the directory 
	in which you're trying to create thumbnails.	
	
	You may use this code in your own projects as long as this 
	copyright is left in place.  All code is provided AS-IS.
	This code is distributed in the hope that it will be useful,
 	but WITHOUT ANY WARRANTY; without even the implied warranty of
 	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
	
	Copyright 2007 WebCheatSheet.com	
*/

//function createThumbs1( $pathToImages, $pathToThumbs, $thumbWidth ) 
function createThumbs1( $ToImages, $pathToThumbs, $thumbWidth ) 

{
	if($ToImages!='')
	{
  // open the directory
  $pathToImages ='uploads/';
  $dir = opendir( $pathToImages );
//echo "{$pathToThumbs}{$ToImages}";
  // loop through it, looking for any/all JPG files:
 // while (false !== ($fname = readdir( $dir ))) {
    // parse path for the extension
//echo	$pathToImages.$ToImages;

      $info = pathinfo($ToImages);
	// print_r($info);
    //$info = pathinfo($pathToImages . $fname);
    // continue only if this is a JPEG image
    if ( strtolower($info['extension']) == 'jpg' ) 
    {
      //echo "Creating thumbnail for {$fname} <br />";

      // load image and get image size
      $img = imagecreatefromjpeg( $pathToImages.$ToImages);
    $width = imagesx( $img );
      $height = imagesy( $img );

      // calculate thumbnail size
      $new_width = $thumbWidth;
      $new_height = floor( $height * ( $thumbWidth / $width ) );

      // create a new tempopary image
       $tmp_img = imagecreatetruecolor( $new_width, $new_height );

      // copy and resize old image into new image 
     imagecopyresized( $tmp_img, $img, 0, 0, 0, 0, $new_width, $new_height, $width, $height );

      // save thumbnail into a file
      imagejpeg( $tmp_img, $pathToImages.'/thumbs/'.$ToImages);
    }

//for gif images

if ( strtolower($info['extension']) == 'gif' ) 
    {
      //echo "Creating thumbnail for {$fname} <br />";

      // load image and get image size
      $img = imagecreatefromgif( $pathToImages.$ToImages);
    $width = imagesx( $img );
      $height = imagesy( $img );

      // calculate thumbnail size
      $new_width = $thumbWidth;
      $new_height = floor( $height * ( $thumbWidth / $width ) );

      // create a new tempopary image
       $tmp_img = imagecreatetruecolor( $new_width, $new_height );

      // copy and resize old image into new image 
     imagecopyresized( $tmp_img, $img, 0, 0, 0, 0, $new_width, $new_height, $width, $height );

      // save thumbnail into a file
      imagegif( $tmp_img, $pathToImages.'/thumbs/'.$ToImages);
    }

	////////end of gif images

	///////start of png images 
	if ( strtolower($info['extension']) == 'png' ) 
    {
      //echo "Creating thumbnail for {$fname} <br />";

      // load image and get image size
      $img = imagecreatefrompng( $pathToImages.$ToImages);
      $width = imagesx( $img );
      $height = imagesy( $img );

      // calculate thumbnail size
      $new_width = $thumbWidth;
      $new_height = floor( $height * ( $thumbWidth / $width ) );

      // create a new tempopary image
       $tmp_img = imagecreatetruecolor( $new_width, $new_height );

      // copy and resize old image into new image 
     imagecopyresized( $tmp_img, $img, 0, 0, 0, 0, $new_width, $new_height, $width, $height );

      // save thumbnail into a file
      imagepng( $tmp_img, $pathToImages.'/thumbs/'.$ToImages);
    }


	//////// end of png images 

  //}
  // close the directory
  closedir( $dir );
	}
}
/*
function createThumbs( $pathToImages, $pathToThumbs, $thumbWidth ) 
{
  // open the directory
  $pathToImages ='uploads/';
  $dir = opendir( $pathToImages );

  // loop through it, looking for any/all JPG files:
  while (false !== ($fname = readdir( $dir ))) {
    // parse path for the extension
echo	$pathToImages;
    $info = pathinfo($pathToImages . $fname);
    // continue only if this is a JPEG image
    if ( strtolower($info['extension']) == 'jpg' ) 
    {
      //echo "Creating thumbnail for {$fname} <br />";

      // load image and get image size
      $img = imagecreatefromjpeg( "{$pathToImages}{$fname}" );
      $width = imagesx( $img );
      $height = imagesy( $img );

      // calculate thumbnail size
      $new_width = $thumbWidth;
      $new_height = floor( $height * ( $thumbWidth / $width ) );

      // create a new tempopary image
      $tmp_img = imagecreatetruecolor( $new_width, $new_height );

      // copy and resize old image into new image 
      imagecopyresized( $tmp_img, $img, 0, 0, 0, 0, $new_width, $new_height, $width, $height );

      // save thumbnail into a file
      imagejpeg( $tmp_img, "{$pathToThumbs}{$fname}" );
    }
  }
  // close the directory
  closedir( $dir );
}
*/


// call createThumb function and pass to it as parameters the path 
// to the directory that contains images, the path to the directory
// in which thumbnails will be placed and the thumbnail's width. 
// We are assuming that the path will be a relative path working 
// both in the filesystem, and through the web for links
//createThumbs("images/","thumbs/",100);
// call createGallery function and pass to it as parameters the path 
// to the directory that contains images and the path to the directory
// in which thumbnails will be placed. We are assuming that 
// the path will be a relative path working 
// both in the filesystem, and through the web for links
//createGallery("images/","thumbs/");
?>