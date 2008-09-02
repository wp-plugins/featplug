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

function widget_slideshow_postbanners_init() {

	
	if ( !function_exists('register_sidebar_widget') || !function_exists('register_widget_control') )
		return; 

	
	function wpb_slideshow_widget($args) {

		extract($args);

		$options = get_option('widget_slideshow_wpb');
		
		$title = empty($options['wpb-slideshow-title']) ? 'My Widget' : $options['wpb-slideshow-title'];
		$img_width = empty($options['wpb-slideshow-img-width']) ? '300' : $options['wpb-slideshow-img-width'];
		$img_height = empty($options['wpb-slideshow-img-height']) ? '100' : $options['wpb-slideshow-img-height'];
		$max_items = empty($options['wpb-slideshow-max-items']) ? '' : $options['wpb-slideshow-max-items'];
		$post_filter = empty($options['wpb-slideshow-post-filter']) ? '' : $options['wpb-slideshow-post-filter'];


 		echo $before_widget;
		echo $before_title . $title . $after_title;
		
		echo "<center>";
		get_slideshow($img_width,$img_height,$max_items,$post_filter);
		echo "</center>";
		
		echo $after_widget;
	}

	
	function wpb_slideshow_widget_control() {

	
		$options = get_option('widget_slideshow_wpb');

	
		if ( $_POST['wpb-slideshow-submit'] ) {
			$options['wpb-slideshow-title'] = strip_tags(stripslashes($_POST['wpb-slideshow-title']));
			$options['wpb-slideshow-img-width'] = strip_tags(stripslashes($_POST['wpb-slideshow-img-width']));
			$options['wpb-slideshow-img-height'] = strip_tags(stripslashes($_POST['wpb-slideshow-img-height']));
			$options['wpb-slideshow-max-items'] = strip_tags(stripslashes($_POST['wpb-slideshow-max-items']));
			$options['wpb-slideshow-post-filter'] = strip_tags(stripslashes($_POST['wpb-slideshow-post-filter']));


			update_option('widget_slideshow_wpb', $options);
		}

		
		$title = htmlspecialchars($options['wpb-slideshow-title'], ENT_QUOTES);
		$img_width = htmlspecialchars($options['wpb-slideshow-img-width'], ENT_QUOTES);
		$img_height = htmlspecialchars($options['wpb-slideshow-img-height'], ENT_QUOTES);
		$max_items = htmlspecialchars($options['wpb-slideshow-max-items'], ENT_QUOTES);
		$post_filter = htmlspecialchars($options['wpb-slideshow-post-filter'], ENT_QUOTES);

?>
		<div>
			
		<label for="wpb-title" style="line-height:35px;display:block;">Widget title: 
		<input type="text" id="wpb-slideshow-title" name="wpb-slideshow-title" value="<?php echo $title; ?>" /></label>
		
		<label for="wpb-img-width" style="line-height:35px;display:block;">Image Width: 
		<input type="text" id="wpb-slideshow-img-width" name="wpb-slideshow-img-width" value="<?php echo $img_width; ?>" /></label>
		
		<label for="wpb-img-height" style="line-height:35px;display:block;">Image Height: 
		<input type="text" id="wpb-slideshow-img-height" name="wpb-slideshow-img-height" value="<?php echo $img_height; ?>" /></label>

		<label for="wpb-max-items" style="line-height:35px;display:block;">Max Items: 
		<input type="text" id="wpb-slideshow-max-items" name="wpb-slideshow-max-items" value="<?php echo $max_items; ?>" /></label>
		
		<label for="wpb-post-filter" style="line-height:35px;display:block;">Post Filter: 
		<input type="text" id="wpb-slideshow-post-filter" name="wpb-slideshow-post-filter" value="<?php echo $post_filter; ?>" /></label>
		
		<input type="hidden" name="wpb-slideshow-submit" id="wpb-slideshow-submit" value="1" />
		</div>
	<?php

	}


	register_sidebar_widget('Post Banners Slideshow', 'wpb_slideshow_widget');
	register_widget_control('Post Banners Slideshow', 'wpb_slideshow_widget_control');
}

?>