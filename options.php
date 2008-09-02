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

 	if( $_POST['post_banners_hidden'] == 'Y' )
 	{
 		$wpb_div_banner_style = $_POST['wpb_div_banner_style'];
 		$wpb_tooltip_story_lenght= $_POST['wpb_tooltip_story_lenght'];
 		$wpb_div_label_style=$_POST['wpb_div_label_style'];
 		$wpb_div_text_style=$_POST['wpb_div_text_style'];
 		$wpb_text_style=$_POST['wpb_text_style'];
 		
 		// write to database
 		update_option("wpb_div_banner_style",$wpb_div_banner_style);
 		update_option("wpb_tooltip_story_lenght",$wpb_tooltip_story_lenght);
 		update_option("wpb_div_label_style",$wpb_div_label_style);
 		update_option("wpb_div_text_style",$wpb_div_text_style);
 		update_option("wpb_text_style",$wpb_text_style);
	}
	else
	{
		check_option_values();
		// read from database;
		$wpb_div_banner_style=get_option("wpb_div_banner_style");
		$wpb_tooltip_story_lenght=get_option("wpb_tooltip_story_lenght");
		$wpb_div_label_style=get_option("wpb_div_label_style");
		$wpb_div_text_style=get_option("wpb_div_text_style");
		$wpb_text_style=get_option("wpb_text_style");
	}

function check_option_values()
{
			$wpb_div_banner_style=get_option("wpb_div_banner_style");
			$wpb_tooltip_story_lenght=get_option("wpb_tooltip_story_lenght");
			$wpb_div_label_style=get_option("wpb_div_label_style");
			$wpb_div_text_style=get_option("wpb_div_text_style");
			$wpb_text_style=get_option("wpb_text_style");
			
			// if any empty values, inject the default ones
			if(trim($wpb_div_banner_style)=="")
				update_option("wpb_div_banner_style","position: relative; overflow: hidden; width: {width} ; height: {height} ; border: solid 5px;");
						
			if(trim($wpb_tooltip_story_lenght)=="")
				update_option("wpb_tooltip_story_lenght","250");

			if(trim($wpb_div_label_style)=="")
				update_option("wpb_div_label_style","position: relative; top: -25px; height: 25px; background-color: black; filter:alpha(opacity=60); -moz-opacity: 0.6; opacity: 0.6;");
				
			if(trim($wpb_div_text_style)=="")
				update_option("wpb_div_text_style","position: relative; top: -55px; height: 25px; ");

			if(trim($wpb_text_style)=="")
				update_option("wpb_text_style","font-weight:bold;font-family:tahoma, verdana, arial, sans-serif;font-variant:small-caps;text-align:right;color:#d0d955;");

			$wpb_div_banner_style=get_option("wpb_div_banner_style");
			$wpb_tooltip_story_lenght=get_option("wpb_tooltip_story_lenght");
			$wpb_div_label_style=get_option("wpb_div_label_style");
			$wpb_div_text_style=get_option("wpb_div_text_style");
			$wpb_text_style=get_option("wpb_text_style");
			
}

?>

<!-- options form -->
<div class="wrap">
<h2>Post-Banners Options</h2>
<table class="form-table">

<form name="form1" method="post" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>">

<tr>
	<td valign="top" width="30%">
		<strong>Main DIV Additional Style: </strong><br>
		You can set the main DIV's style here. You can use <b>{width}</b> and <b>{height}</b> as placeholders for given values on function call <br><br>
	</td>
	<td valign="top">
		<textarea name="wpb_div_banner_style" rows="5" cols="50"/><?php echo $wpb_div_banner_style; ?></textarea>
	</td>
</tr>
<tr>
	<td valign="top" width="30%">
		<strong>Tooltip Story Lenght: </strong><br>
		Set here the maximum number of characters that tooltip must show off the post content
	</td>
	<td valign="top">
		<input name="wpb_tooltip_story_lenght" type="text"  value="<?php echo $wpb_tooltip_story_lenght; ?>"/>
	</td>
</tr>
<tr>
	<td valign="top" width="30%">
		<strong>Label DIV Style: </strong><br>
		Set the Label DIV's style here.
	</td>
	<td valign="top">
		<textarea name="wpb_div_label_style" rows="5" cols="50"><?php echo $wpb_div_label_style; ?></textarea>
	</td>
</tr>
<tr>
	<td valign="top" width="30%">
		<strong>Label Text DIV Style: </strong><br>
		The text on label also got it's own div. Set the style of it here and also any font related (size,face) variables here.
	</td>
	<td valign="top">
		<textarea name="wpb_div_text_style"  rows="5" cols="50"><?php echo $wpb_div_text_style; ?></textarea>
	</td>
</tr>
<tr>
	<td valign="top" width="30%">
	<strong>Text Style: </strong><br>
	Style your text at <a href="http://csstxt.com/" target="_blank">http://csstxt.com/</a>
	</td>
	<td valign="top">
		<textarea name="wpb_text_style" rows="5" cols="50"><?php echo $wpb_text_style; ?></textarea>
	</td>
</tr>
<tr>
	<td valign="top" width="30%">
		<strong>Test: </strong><br>
		The plugins output will be like;
	</td>
	<td valign="top">
		<?php get_post_banners(300,100,1); ?>
	</td>
</tr>



</table>
 
<input type="hidden" name="post_banners_hidden" value="Y">

	
<p class="submit">
<input type="submit" name="Submit" value="Update Options &raquo;" />
</p>	
	
</form>
</div>



