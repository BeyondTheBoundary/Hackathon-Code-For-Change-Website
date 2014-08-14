<?php
    $connect = mysql_connect("mysql.freehosting.io", "u488574653_swf", "code4change") 
            or die("Check your connection!"); 
    mysql_select_db("u488574653_swf");

// CROP IMG
function squarecrop($pic){
	// Original image
	$filename = "upload/" . $pic;
	 
	// Get dimensions of the original image
	list($current_width, $current_height) = getimagesize($filename);

	
	if($current_width >= $current_height){
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
	}
	else {
		$left = 0;
		$top = ($current_height - $current_width) / 2;
		 
		// This will be the final size of the image (e.g. how many pixels
		// left and down we will be going)
		$crop_width = $current_width;
		$crop_height = $current_width;
		 
		// Resample the image
		$canvas = imagecreatetruecolor($crop_width, $crop_height);
		$current_image = imagecreatefromjpeg($filename);
		imagecopy($canvas, $current_image, 0, 0, $left, $top, $current_width, $current_height);
		imagejpeg($canvas, $filename, 100);
		echo "Done!";		
		}
}
	squarecrop("food_res_before/1.jpg");
	squarecrop("food_res_before/2.jpg");
	squarecrop("food_res_before/3.jpg");
	squarecrop("food_res_before/4.jpg");
	squarecrop("food_res_before/5.jpg");
	squarecrop("food_res_before/6.jpg");
	squarecrop("food_res_before/7.jpg");
	squarecrop("food_res_before/8.jpg");
	squarecrop("food_res_before/9.jpg");
	squarecrop("food_res_before/10.jpg");
?>
