=== FeatPlug ===
Contributors: raistlinthewiz
Donate link: http://featplug.huseyinuslu.net/donate
Tags: Featured, content, Banners, images, image, slideshow, Thumbs, Thumbnails, Post, posts, Digg, Mine, Featured Content, automatic, AJAX, blog,embed, filter, gallery, link, links, list, media, navigation, page, pages, photo, photos, picture, pictures, plugin, plugins,random, recent, redirect, sidebar, widget, widgets, wordpress
Requires at least: 2.6
Tested up to: 2.61
Stable tag: 0.51

Featplug is a plugin that can mine your Wordpress (or any other Blog/CMS/Forum software's) posts and generates ‘featured content’ section.

== Description ==

Featplug is a standalone script / wordpress plugin that can mine your Wordpress posts or any other
data and look for images suiting a given dimension and generates 'featured' section for your site using the
found items.

The featured section, includes a resized image (banner) with the label, description and link of the related
post or data.

Featplug is a architectural plugin with input layers and output templates.

Input Layer -> Featplug -> Output Template

Currently it supports Wordpress and standalone as input layers. But it's very easy
to integrate it to any other blog / cms / forum software or even in your static site.




= Simple Banners Mode =

In this mode, all suitable items are vertically positioned. Check [here](http://postbanners.huseyinuslu.net/index.php?wptheme=get_post_banners) to see a simple banners demo.

To use this mode, just call the function get_post_banners()

      <?php if (function_exists('get_post_banners')): ?>
      <?php get_post_banners(300,150); ?>
      <?php endif; ?>

get_post_banners() accepts 4 arguments;

* Banner image width
* Maximum banner image height (means actual rendered banners may be lesser than this value)
* (Optional) Maximum number of banners to be rendered
* (Optional) Filter - valid under wordpress and filters the posts returned by wordpress. For more information about avaible filtering options check [here](http://www.huseyinuslu.net/wp-post-banners-wordpress-filters).

So let's examine this call;

      <?php if (function_exists('get_post_banners')): ?>
      <?php get_post_banners(300,100,10,'numberposts=10&orderby=rand'); ?>
      <?php endif; ?>

This code will at maximum render 10 banners and wordpress returns us 10 posts to examine. And orderby=rand makes wordpress to select random posts and return us.

= Slideshow Mode =
In slideshow mode, all suitable items are shown as slideshow.  Check [here](http://postbanners.huseyinuslu.net/index.php?wptheme=Slideshow) to see a slideshow demo.

To use this mode just call the function get_slideshow()

      <?php if (function_exists('get_slideshow')): ?>
      <?php get_slideshow(300,150); ?>
      <?php endif; ?>

get_slideshow() accepts 4 arguments which are exactly the same with get_post_banners arguments.

* Ýmage width
* Maximum image height (means actual rendered images may be lesser than this value)
* (Optional) Maximum number of banners to be rendered
* (Optional) Filter - valid under wordpress and filters the posts returned by wordpress. For more information about avaible filtering options check [here](http://www.huseyinuslu.net/wp-post-banners-wordpress-filters).

= Widget Mode =

The plugin supports running as Widget for Wordpress. Todo so just browse to your Wordpress installations administator section and then
Design - Widgets section. There you can add Post Banners (Simple Banners) or Post Banners Slideshow widgets to your theme.

Check [here](http://postbanners.huseyinuslu.net/index.php?wptheme=Widget) to see a widget demo.

You can set these options for widgets:

* Widget title: Give it a title
* Image Width: Set the banner width
* Image Height: Set the maximum banner height
* Max Items: (Optional) Set maximum amount of items
* Post Filter:  (Optional) Set post filter. 

= Stand Alone Mode =

With the release of 0.5 version you can just run the WP-Post-Banners as a standalone script. You can use it your own static site
by supplying data manually or even use it in any other blog / CMS / forum software by just writing the data pump function.

Check [here](http://postbanners.huseyinuslu.net/wp-content/plugins/wp-post-banners/standalone.php) to see a stand-alone demo.

First lets see manuall data pumping; 

1) Include engine.php in your site
	
      include 'engine.php'; 


2) Initiate the engine class

      $e=new engine(); 
      $e->layer("STAND_ALONE");


3) Set configuration; width, height and maximum items

      $e->width="300"; 	
      $e->height="220"; 	
      $e->max_items=2;


4) Start pumping the content

      $p=new post_item(); // new content item
      $p->img="<img src='http://www.huseyinuslu.net/wp-content/uploads/2008/08/iloled-300x200.png'>"; // image
      $p->label="Sample Post I"; // label
      $p->content="Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum."; // description
      $p->link="http://www.huseyinuslu.net/wp-post-banners"; // related url
      $e->add_item($p); // add the item


5) Let the wp-post-banners do the magic and render.

* To render in Simple Banners mode use render()

      echo $e->render();


* To render slideshow use render_slideshow()

      echo $e->render_slideshow();


6) Free the resources used

      $e=null; // release resources


Within the distributed files, there's an example script 'standalone.php'.


= Porting plugin to other Blog / CMS / Forum Software =

By reading the standalone instructions and following sample data pumper for Wordpress you can just port the plugin to any other blog / cms / forum software
with coding a few lines.

To do so, take this Wordpress pumper code as a basis for your work and don't forget to contact plugin author about your work so that he can include it with main distribution.

      function get_slideshow($width,$height,$max=999,$filter='')
      {
            $e=new engine(); 
            $e->layer("WORDPRESS"); // when porting you'd like to use STAND_ALONE mode or code your own layer
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

= Examples & Live Demos =
To see example code & live demos please browse check [here](http://postbanners.huseyinuslu.net)

== Installation ==

= Wordpress =

* Upload plugin to wp-content/plugins/
* On your Wordpress administrator section, browse to your Settings - Post-Banners. You have to do this in order plugin to work properly!!
* Add widget or direct function calls 

= Standalone / Other Software =

* Upload to correct path of your software and include the 'engine.php' 
* See the Stand Alone Mode & Porting Instructions

= Requirements =

* php4 or php5
* wordpress (optional - can be run on standalone mode)
* libGD - (php's included gd library is okay)

== Screenshots ==

Check [Plugin's homepage](http://www.huseyinuslu.net/wp-post-banners/)  and [Examples & Live Demos](http://postbanners.huseyinuslu.net)  for screenshots and demo.

== Frequently Asked Questions ==
 
[Plugin's homepage](http://www.huseyinuslu.net/wp-post-banners/) 

[Examples & Live Demos](http://postbanners.huseyinuslu.net) 

= “Parse error: syntax error, unexpected T_STRING, expecting T_OLD_FUNCTION or T_FUNCTION or T_VAR or '}' in /.../wp-content/plugins/wp-post-banners/engine.php on line 33” =

WP-Post-Banners version 0.50 and below was coded for php5 and when you try to run it under php4 you'll get this error. With version 0.51, php4 is supported. So either use plugin version 0.51 or upgrade to php5.

= Sites Using =

Please contact me about your wp-post-banners example so that i can list it here.

= Credits =

* Author: Huseyin Uslu, [<http://www.huseyinuslu.net>](http://www.huseyinuslu.net)

= Components =

* BoxOver: Oliver Bryant, [<http://boxover.swazz.org>](http://boxover.swazz.org)
* JonDesign's Smooth Gallery: Jonathan Schemoul,  [<http://smoothgallery.jondesign.net>](http://smoothgallery.jondesign.net)
* MooTools, Valerio Proietti, [<http://mad4milk.net>](http://mad4milk.net)


== Changelog ==

= [16.08.2008] 0.51 =

* OOP code was faulting with php4 so cleaned out most OOP code (static,private,public variables and constructor)
* As we do not have any constructor any more $e=new engine("STAND_ALONE") is no more valid, instead try;
      $e=new engine(); 
      $e->layer("STAND_ALONE");

= [15.08.2008] 0.50 =

* major feature release
* added support for slideshows
* cleaned up code
* fixed checking just the very first image on given post. Now it correctly check all avaible images


= [14.08.2008] 0.42 =

* minor code improvements
* plugin now checks if gd is installed otherwise it warns about it
* added destructor & resource freeing code
* some preperation for next major feature release

= [09.08.2008] 0.41 =

* quick bugfix release

= [08.07.2008] 0.4 =

* added plugin configuration
* added widget support
* cleaned div styles
* redesigned code from stratch; better & flexible now

= [07.08.2008] 0.3 =

* Added title label to bottom. Maybe can be done with GD?* Added mouse over tooltip showing post title & content

= [06.08.2008] 0.2: =

* plugin now uses GD library to resize & crop the image, to optimize the bandwitdh images uses

= [06.08.2008] 0.1: =

* initial release
