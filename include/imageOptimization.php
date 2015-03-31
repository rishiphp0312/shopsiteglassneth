<?
function smart_resize_image( $file, $output, $width, $height, $proportional = false){
$info = getimagesize($file);
        $image = '';
		$final_width = 0;
        $final_height = 0;
	list($width_old, $height_old) = $info;
    if($width_old<=$width && $height_old<=$height){
        $final_width=$width_old;
        $final_height=$height_old;
    }elseif($width_old<=$width && $height_old>$height){
            $final_height = $height;
           	$factor = min ( $width / $width_old, $height / $height_old);
            $final_width = $width_old * $factor;
            $final_width = round($final_width,0);
    }elseif($width_old>$width && $height_old<=$height){
            $final_width = $width;
           	$factor = min ( $width / $width_old, $height / $height_old);
           	$final_height=$height_old * $factor;
            $final_height = round($final_height,0);
    }elseif($width_old>$width && $height_old>$height){
           	$factor = min ( $width / $width_old, $height / $height_old);
           	$final_height=$height_old * $factor;
            $final_height = round($final_height,0);
            $final_width = $width_old * $factor;
            $final_width = round($final_width,0);
    }
switch (
	$info[2] ) {
        case IMAGETYPE_GIF:
            $image = imagecreatefromgif($file);
        break;
        case IMAGETYPE_JPEG:
            $image = imagecreatefromjpeg($file);
        break;
        case IMAGETYPE_PNG:
            $image = imagecreatefrompng($file);
        break;
        default:
            return false;
        }
        $image_resized = imagecreatetruecolor( $final_width, $final_height );
        if ( ($info[2] == IMAGETYPE_GIF) || ($info[2] == IMAGETYPE_PNG) ) {
            $trnprt_indx = imagecolortransparent($image);
  
            // If we have a specific transparent color
            if ($trnprt_indx >= 0) {
  
                // Get the original image's transparent color's RGB values
                $trnprt_color = imagecolorsforindex($image, $trnprt_indx);
  
                // Allocate the same color in the new image resource
                $trnprt_indx = imagecolorallocate($image_resized, $trnprt_color['red'], $trnprt_color['green'], $trnprt_color['blue']);
  
                // Completely fill the background of the new image with allocated color.
                imagefill($image_resized, 0, 0, $trnprt_indx);
  
                // Set the background color for new image to transparent
                imagecolortransparent($image_resized, $trnprt_indx);
            }
            // Always make a transparent background color for PNGs that don't have one allocated already
            elseif ($info[2] == IMAGETYPE_PNG) {
  
                // Turn off transparency blending (temporarily)
                imagealphablending($image_resized, false);
  
                // Create a new transparent color for image
                $color = imagecolorallocatealpha($image_resized, 0, 0, 0, 127);
  
                // Completely fill the background of the new image with allocated color.
                imagefill($image_resized, 0, 0, $color);
  
                // Restore transparency blending
                imagesavealpha($image_resized, true);
            }
        }
imagecopyresampled($image_resized, $image, 0, 0, 0, 0, $final_width, $final_height, $width_old, $height_old);
        switch ( strtolower($output) ) {
            case 'browser':
                $mime = image_type_to_mime_type($info[2]);
                header("Content-type: $mime");
                $output = NULL;
            break;
            case 'file':
                $output = $file;
            break;
            case 'return':
                return $image_resized;
            break;
            default:
            break;
        }

		switch (
			$info[2] ) {
            case IMAGETYPE_GIF:
                imagegif($image_resized, $output);
            break;
            case IMAGETYPE_JPEG:
                imagejpeg($image_resized, $output);
            break;
            case IMAGETYPE_PNG:
                imagepng($image_resized, $output);
            break;
            default:
                return false;
        }

        return
	true;
}
?>
