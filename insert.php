<?php
    $connect = mysql_connect("mysql.freehosting.io", "u488574653_swf", "code4change") 
            or die("Check your connection!"); 
    mysql_select_db("u488574653_swf");
    
	$query = "INSERT INTO transaction (username, billcode, price, pic1, pic2, pic3)" . 
		"VALUES ('" . $_POST['username'] . "', '" . $_POST['billcode'] . "', '" . $_POST['price'] . "', '" . $_POST['pic1'] . "', '" . $_POST['pic2'] . "', '" . $_POST['pic3'] . "')";  
	
	//	$query = "INSERT INTO transaction (username, billcode, price, pic1, pic2, pic3) VALUES ('url','KFC005','20000','http://placehold.it/200x200','http://placehold.it/200x200','http://placehold.it/200x200')";

    $results = mysql_query($query) 
            or die($query . mysql_error());

// CROP IMG
function squarecrop($pic){
	// Original image
	$filename = "upload/" . $pic;
	 
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
	//echo "Done!";
	//echo "<img src='upload/" . $pic . "'><br>";
}

	squarecrop($_POST['pic1']);
	squarecrop($_POST['pic2']);
	squarecrop($_POST['pic3']);
?>
