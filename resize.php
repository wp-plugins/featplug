<?php
/*

WP-Post-Banners

Huseyin Uslu, < shalafirasitlin@gmail.com >
http://www.huseyinuslu.net


This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 2 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA 02111-1307 USA
Online: http://www.gnu.org/licenses/gpl.txt
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
