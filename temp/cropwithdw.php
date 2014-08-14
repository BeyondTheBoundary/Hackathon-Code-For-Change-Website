<?php

function squarecrop($pic){
	// Original image
	$filename = "img/" . $pic;
	 
	// Get dimensions of the original image
	list($current_width, $current_height) = getimagesize($filename);

	// The x and y coordinates on the original image where we
	// will begin cropping the image
	$left = ($current_width - $current_height) / 2;
	$top = 0;
	 
	// This will be the final size of the image (e.g. how many pixels
	// left and down we will be going)
	$crop_width = $current_height;
	$crop_height = $current_height;
	 
	// Resample the image
	$canvas = imagecreatetruecolor($crop_width, $crop_height);
	$current_image = imagecreatefromjpeg($filename);
	imagecopy($canvas, $current_image, 0, 0, $left, $top, $current_width, $current_height);
	imagejpeg($canvas, $filename, 100);
	echo "Done!";
	echo "<img src='img/" . $pic . "'><br>";
}
?>