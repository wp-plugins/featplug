<?php  

/*

Plugin Name: WP-Post-Banners
Plugin URI: http://www.huseyinuslu.net/wp-post-banners/
Description: WP-Post-Banners is wordpress plugin that can mine your Wordpress and generate 'featured' section for your site using the found items.
Version: 0.51
Author: Huseyin Uslu
Author URI: http://www.huseyinuslu.net


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

include 'engine.php'; 
include 'wpb-widget.php'; 
include 'wpb-slideshow-widget.php'; 

/* administration */ 
add_action('admin_menu','WPB_admin_menu');  

/* widget */ 
add_action('plugins_loaded', 'widget_postbanners_init');  
add_action('plugins_loaded', 'widget_slideshow_postbanners_init');  

function WPB_admin_menu() 
{ 	
	if (function_exists('add_options_page')) 
	{ 			
		add_options_page('Post-Banners','Post-Banners','manage_options','wp-post-banners/options.php'); 			 		
	} 
}  

function get_post_banners($width,$height,$max=999,$filter='') 
{ 	
	$e=new engine(); // start your engines gentelmans 	
	$e->layer("WORDPRESS");
	$e->width=$width; 	
	$e->height=$height; 	
	$e->max_items=$max; 	 	
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
	echo $e->render(); 
	
	$e=null; // release resources
}    

function get_slideshow($width,$height,$max=999,$filter='')
{
	$e=new engine(); // start your engines gentelmans 	
	$e->layer("WORDPRESS");
	$e->width=$width; 	
	$e->height=$height; 	
	$e->max_items=$max;
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
	echo $e->render_slideshow($width,$height); 
	
	$e=null; // release resources
}




?>