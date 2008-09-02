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
		$output_width = empty($options['wpb-output-width']) ? '300' : $options['wpb-output-width'];
		$output_height = empty($options['wpb-output-height']) ? '100' : $options['wpb-output-height'];
		$max_items = empty($options['wpb-max-items']) ? '' : $options['wpb-max-items'];
		$post_filter = empty($options['wpb-post-filter']) ? '' : $options['wpb-post-filter'];
 		$template= empty($options['wpb-template'])? 'simple_banners' : $options['wpb-template'];


 		echo $before_widget;
		echo $before_title . $title . $after_title;
		
		echo "<center>";
		wordpress_render($output_width,$output_height,True,$template,$max_items,$post_filter);
		echo "</center>";
		
		echo $after_widget;
	}

	
	function wpb_widget_control() {

	
		$options = get_option('widget_wpb');

	
		if ( $_POST['wpb-submit'] ) {
			$options['wpb-title'] = strip_tags(stripslashes($_POST['wpb-title']));
			$options['wpb-output-width'] = strip_tags(stripslashes($_POST['wpb-output-width']));
			$options['wpb-output-height'] = strip_tags(stripslashes($_POST['wpb-output-height']));
			$options['wpb-max-items'] = strip_tags(stripslashes($_POST['wpb-max-items']));
			$options['wpb-post-filter'] = strip_tags(stripslashes($_POST['wpb-post-filter']));
			$options['wpb-template']=strip_tags(stripslashes($_POST['wpb-template']));


			update_option('widget_wpb', $options);
		}

		
		$title = htmlspecialchars($options['wpb-title'], ENT_QUOTES);
		$output_width = htmlspecialchars($options['wpb-output-width'], ENT_QUOTES);
		$output_height = htmlspecialchars($options['wpb-output-height'], ENT_QUOTES);
		$max_items = htmlspecialchars($options['wpb-max-items'], ENT_QUOTES);
		$post_filter = htmlspecialchars($options['wpb-post-filter'], ENT_QUOTES);
		$template=htmlspecialchars($options['wpb-template'],ENT_QUOTES);

?>
		<div>
			
		<label for="wpb-title" style="line-height:35px;display:block;">Widget title: 
		<input type="text" id="wpb-title" name="wpb-title" value="<?php echo $title; ?>" /></label>
		
		<label for="wpb-output-width" style="line-height:35px;display:block;">Image Width: 
		<input type="text" id="wpb-output-width" name="wpb-output-width" value="<?php echo $output_width; ?>" /></label>

		<label for="wpb-output-height" style="line-height:35px;display:block;">Image Height: 
		<input type="text" id="wpb-output-height" name="wpb-output-height" value="<?php echo $output_height; ?>" /></label>

		<label for="wpb-enable-enlarge" style="line-height:35px;display:block;">Enable Enlarging Images:
		<input type="radio" id="wpb-enable-enlarge-yes" name="wpb-enable-enlarge" value="Yes">Yes
		<input type="radio" id="wpb-enable-enlarge-no" name="wpb-enable-enlarge" value="No" checked>No
		</label>

		<label for="wpb-template" style="line-height:35px;display:block;">Template: 
		<select id="wpb-template" name="wpb-template">
		<?php 
			$templates=engine::list_avaible_templates();
			foreach ($templates as $t)
			{
		?>

				<option value="<?php echo $t;?>" <?php if($template==$t) echo "selected";?>><?php echo $t;?></option>
		<?php 
			}
		?>
		</select>
		</label>

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