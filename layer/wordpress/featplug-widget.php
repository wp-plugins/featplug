<?php

/*  
	FeatPlug - http://www.featplug.com

	Featplug is free for non-commercial use. For commercial usage and redistribution with commercial packages
	check the plugins webpage http://featplug.huseyinuslu.net

	Huseyin Uslu < shalafirasitlin@gmail.com | http://www.regularsexpressions.com >
*/



function featplug_widget_init() {

	
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
		If (empty($options['wpb-enable-enlarge']))
			$enlarge=False;
		Else
		{
			If ($options['wpb-enable-enlarge'])
				$enlarge=True;
			else
				$enlarge=False;
		}


 		echo $before_widget;
		echo $before_title . $title . $after_title;
		
		echo "<center>";
		featplug_wp_render($output_width,$output_height,$enlarge,$template,$max_items,$post_filter);
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
			$options['wpb-enable-enlarge']=$_POST['wpb-enable-enlarge'];

			update_option('widget_wpb', $options);
		}

		
		$title = htmlspecialchars($options['wpb-title'], ENT_QUOTES);
		$output_width = htmlspecialchars($options['wpb-output-width'], ENT_QUOTES);
		$output_height = htmlspecialchars($options['wpb-output-height'], ENT_QUOTES);
		$max_items = htmlspecialchars($options['wpb-max-items'], ENT_QUOTES);
		$post_filter = htmlspecialchars($options['wpb-post-filter'], ENT_QUOTES);
		$template=htmlspecialchars($options['wpb-template'],ENT_QUOTES);
		$enlarge=$options['wpb-enable-enlarge'];

?>
		<div>
			
		<label for="wpb-title" style="line-height:35px;display:block;">Widget title: 
		<input type="text" id="wpb-title" name="wpb-title" value="<?php echo $title; ?>" /></label>
		
		<label for="wpb-output-width" style="line-height:35px;display:block;">Image Width: 
		<input type="text" id="wpb-output-width" name="wpb-output-width" value="<?php echo $output_width; ?>" /></label>

		<label for="wpb-output-height" style="line-height:35px;display:block;">Image Height: 
		<input type="text" id="wpb-output-height" name="wpb-output-height" value="<?php echo $output_height; ?>" /></label>

		<label for="wpb-enable-enlarge" style="line-height:35px;display:block;">Enable Enlarging Images:
		<input type="radio" id="wpb-enable-enlarge-yes" name="wpb-enable-enlarge"  value="1" <?php if ($enlarge) echo "Checked"; ?> >Yes
		<input type="radio" id="wpb-enable-enlarge-no"  name="wpb-enable-enlarge" value="0"  <?php if (!$enlarge) echo "Checked"; ?> >No
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


	register_sidebar_widget('Featplug', 'wpb_widget');


	register_widget_control('Featplug', 'wpb_widget_control');
}

?>