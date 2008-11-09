<?php

/*  
	FeatPlug - http://www.featplug.com

	Featplug is free for non-commercial use. For commercial usage and redistribution with commercial packages
	check the plugins webpage http://featplug.huseyinuslu.net

	Huseyin Uslu < shalafirasitlin@gmail.com | http://www.regularsexpressions.com >
*/

include 'imgcache.php'; 

$file = $_GET["src"];
$w=$_GET["w"];
$h=$_GET["h"];
$crop=$_GET["crop"];

$info = getimagesize($file);
$image = ''; 

if (function_exists('gd_info'))
{
	switch ($info[2] ) 
	{
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

	$old_width = imagesx($image);
	$old_height = imagesy($image);

	$image_resized = imagecreatetruecolor($w, $h);
	imagecopyresampled($image_resized, $image, 0, 0, 0, 0, $w, $h, $old_width, $old_height);
	$image_cropped=imagecreatetruecolor($w, $crop);
	imagecopyresampled($image_cropped, $image_resized, 0, 0, 0, 0, $w, $crop, $w, $crop);

	if(check_cache())
	{
		$cache_file= "./cache/" . $w . "." . $h . "." . $crop . "." . basename($file);
		@imagejpeg($image_cropped,$cache_file);
	}

	header("Content-type: image/jpeg");
	imagejpeg($image_cropped);
	
	imagedestroy( $image );
	imagedestroy( $image_resized );
	imagedestroy( $image_cropped );
}
else
{
	die("Your php installation does not seem to have GD support..");
}
?>
