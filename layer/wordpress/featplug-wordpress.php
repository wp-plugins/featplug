<?php

/*  
	FeatPlug - http://www.featplug.com

	Featplug is free for non-commercial use. For commercial usage and redistribution with commercial packages
	check the plugins webpage http://featplug.huseyinuslu.net

	Huseyin Uslu < shalafirasitlin@gmail.com | http://www.regularsexpressions.com >
*/


function pump_wordpress_data($filter,&$e)
{
	// check if we're running on a Wordpress-MU environment
	if(function_exists( 'is_site_admin' ))
		mu_pump_post_data($e);
	else
		pump_post_data($filter,&$e);
}

function pump_post_data($filter,&$e)
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

function mu_pump_post_data(&$e)
{
	$blogs = get_last_updated();
	foreach ($blogs as $b) 
	{
		switch_to_blog($b['blog_id']);
		pump_post_data('',$e);
		restore_current_blog();
	}

}

function featplug_wp_render($width,$height,$image_enlarging,$template,$max_stories=10,$filter='')
{
	$e=new engine; 	
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
	$e=new engine(); 	
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
	$e=new engine(); 	
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
