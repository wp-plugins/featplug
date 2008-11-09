<?php  

/*

	Plugin Name: Featplug
	Plugin URI: http://www.featplug.com
	Description: Featplug is wordpress plugin that can mine your Wordpress site and generate 'featured' section using the found items.
	Version: 0.64
	Author: Huseyin Uslu
	Author URI: http://www.regularsexpressions.com

*/

/*  
	FeatPlug - http://www.featplug.com

	Featplug is free for non-commercial use. For commercial usage and redistribution with commercial packages
	check the plugins webpage http://featplug.huseyinuslu.net

	Huseyin Uslu < shalafirasitlin@gmail.com | http://www.regularsexpressions.com >
*/

include_once 'engine.php'; 
include_once 'layer/wordpress/featplug-wordpress.php';
include_once 'layer/wordpress/featplug-widget.php'; 


/* administration */ 
add_action('admin_menu','featplug_wp_admin_menu');  

/* widget */ 
add_action('plugins_loaded', 'featplug_widget_init');  

function featplug_wp_admin_menu() 
{ 	
	if (function_exists('add_options_page')) 
	{ 			
		add_options_page('FeatPlug','FeatPlug','manage_options','featplug/layer/wordpress/featplug-wp-options.php'); 			 		
	} 
}  


?>