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

function widget_postbanners_init() {

	
	if ( !function_exists('register_sidebar_widget') || !function_exists('register_widget_control') )
		return; 

	
	function wpb_widget($args) {

		extract($args);

		$options = get_option('widget_wpb');
		
		$title = empty($options['wpb-title']) ? 'My Widget' : $options['wpb-title'];
		$img_width = empty($options['wpb-img-width']) ? '300' : $options['wpb-img-width'];
		$img_height = empty($options['wpb-img-height']) ? '100' : $options['wpb-img-height'];
		$max_items = empty($options['wpb-max-items']) ? '' : $options['wpb-max-items'];
		$post_filter = empty($options['wpb-post-filter']) ? '' : $options['wpb-post-filter'];


 		echo $before_widget;
		echo $before_title . $title . $after_title;
		
		echo "<center>";
		get_post_banners($img_width,$img_height,$max_items,$post_filter);
		echo "</center>";
		
		echo $after_widget;
	}

	
	function wpb_widget_control() {

	
		$options = get_option('widget_wpb');

	
		if ( $_POST['wpb-submit'] ) {
			$options['wpb-title'] = strip_tags(stripslashes($_POST['wpb-title']));
			$options['wpb-img-width'] = strip_tags(stripslashes($_POST['wpb-img-width']));
			$options['wpb-img-height'] = strip_tags(stripslashes($_POST['wpb-img-height']));
			$options['wpb-max-items'] = strip_tags(stripslashes($_POST['wpb-max-items']));
			$options['wpb-post-filter'] = strip_tags(stripslashes($_POST['wpb-post-filter']));


			update_option('widget_wpb', $options);
		}

		
		$title = htmlspecialchars($options['wpb-title'], ENT_QUOTES);
		$img_width = htmlspecialchars($options['wpb-img-width'], ENT_QUOTES);
		$img_height = htmlspecialchars($options['wpb-img-height'], ENT_QUOTES);
		$max_items = htmlspecialchars($options['wpb-max-items'], ENT_QUOTES);
		$post_filter = htmlspecialchars($options['wpb-post-filter'], ENT_QUOTES);

?>
		<div>
			
		<label for="wpb-title" style="line-height:35px;display:block;">Widget title: 
		<input type="text" id="wpb-title" name="wpb-title" value="<?php echo $title; ?>" /></label>
		
		<label for="wpb-img-width" style="line-height:35px;display:block;">Image Width: 
		<input type="text" id="wpb-img-width" name="wpb-img-width" value="<?php echo $img_width; ?>" /></label>
		
		<label for="wpb-img-height" style="line-height:35px;display:block;">Image Height: 
		<input type="text" id="wpb-img-height" name="wpb-img-height" value="<?php echo $img_height; ?>" /></label>

		<label for="wpb-max-items" style="line-height:35px;display:block;">Max Items: 
		<input type="text" id="wpb-max-items" name="wpb-max-items" value="<?php echo $max_items; ?>" /></label>
		
		<label for="wpb-post-filter" style="line-height:35px;display:block;">Post Filter: 
		<input type="text" id="wpb-post-filter" name="wpb-post-filter" value="<?php echo $post_filter; ?>" /></label>
		
		<input type="hidden" name="wpb-submit" id="wpb-submit" value="1" />
		</div>
	<?php

	}


	register_sidebar_widget('Post Banners', 'wpb_widget');


	register_widget_control('Post Banners', 'wpb_widget_control');
}

?>