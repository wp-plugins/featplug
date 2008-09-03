<?php

/*  
	FeatPlug - http://featplug.huseyinuslu.net

	Featplug is free for non-commercial use. For commercial usage and redistribution with commercial packages
	check the plugins webpage http://featplug.huseyinuslu.net

	Huseyin Uslu < shalafirasitlin@gmail.com | http://www.huseyinuslu.net >
*/

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