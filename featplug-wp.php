<?php  

/*

Plugin Name: Featplug
Plugin URI: http://featplug.huseyinuslu.net
Description: Featplug is wordpress plugin that can mine your Wordpress site and generate 'featured' section for your site using the found items.
Version: 0.51
Author: Huseyin Uslu
Author URI: http://www.huseyinuslu.net

Featplug

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

include 'engine.php'; 
include 'layer/wordpress/featplug-widget.php'; 


/* administration */ 
add_action('admin_menu','featplug_wp_admin_menu');  

/* widget */ 
add_action('plugins_loaded', 'featplug_widget_init');  

function featplug_wp_admin_menu() 
{ 	
	if (function_exists('add_options_page')) 
	{ 			
		add_options_page('featplug','featplug','manage_options','featplug/featplug-wp-options.php'); 			 		
	} 
}  


function pump_wordpress_data($filter,engine $e)
{
	$posts=get_posts($filter);
	foreach($posts as $post) 	
	{ 		
		setup_postdata($post); 		
		$p=new post_item(); 		
		$p->img=$post->post_content; 		
		$p->content=$post->post_content; 		
		$p->link=get_permalink($post->ID); 		
		$p->label=$post->post_title; 		
		$e->add_item($p); 	
	} 	 	
}

function featplug_wp_render($width,$height,$image_enlarging,$template,$max_stories=10,$filter='')
{
	$e=new engine(); // start your engines gentelmans 	
	$e->layer("WORDPRESS");
	$e->set_output_dimensions($width,$height);
	$e->enable_image_enlarging($image_enlarging);
	$e->set_maximum_stories($max_stories);
	$e->set_template($template);
	$e->set_story_lenght(250);
	
	pump_wordpress_data($filter,$e);

	echo $e->render(); 
	$e=null; // release resources
}


function featplug_wp_render_slideshow($width,$height,$image_enlarging,$max_stories=10,$filter='')
{
	$e=new engine(); // start your engines gentelmans 	
	$e->layer("WORDPRESS");
	$e->set_output_dimensions($width,$height);
	$e->enable_image_enlarging($image_enlarging);
	$e->set_maximum_stories($max_stories);
	$e->set_template("smoothgallery");
	$e->set_story_lenght(250);
	
	pump_wordpress_data($filter,$e);

	echo $e->render(); 
	$e=null; // release resources
}

function featplug_wp_render_banners($width,$height,$image_enlarging,$max_stories=10,$filter='')
{
	$e=new engine(); // start your engines gentelmans 	
	$e->layer("WORDPRESS");
	$e->set_output_dimensions($width,$height);
	$e->enable_image_enlarging($image_enlarging);
	$e->set_maximum_stories($max_stories);
	$e->set_template("simple_banners");
	$e->set_story_lenght(250); 
	
	pump_wordpress_data($filter,$e);

	echo $e->render(); 
	$e=null; // release resources
}






?>