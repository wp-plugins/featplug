=== WP-Post-Banners ===
Contributors: raistlinthewiz
Donate link: http://www.huseyinuslu.net/donate
Tags: banners, posts, post-banners, graphics, logos
Requires at least: 2.6
Tested up to: 2.6
Stable tag: 0.41


WP-Post-Banners is a plugin which can display banners(resized images) from your posts automaticly

== Description ==

WP-Post-Banners is a plugin which can display banners(resized images) from your posts automaticly. 
You can supply it parameters like banner size, post filters and maximum amount of banners to be shown.

Basicly you supply the dimensions you want your banners to be;
get_post_banners(300,100)

For filtering the posts and setting maximum amount of banners to be shown, this can be used
get_post_banners(300,100,10,'numberposts=10&orderby=rand')

Filter variable just uses the filtering mechanism of Wordpress. For more information about it check
[http://codex.wordpress.org/Template_Tags/get_posts](http://codex.wordpress.org/Template_Tags/get_posts)

For more usage examples check the examples page.


== Installation ==

Upload plugin to wp-content/plugins/
   
* On your Wordpress administrator section, browse to your Settings - Post-Banners. You have to do this in order plugin to work properly!!
* Add following code on your theme (propbably to sidebar)

      <?php if (function_exists('get_post_banners')): ?>
      <?php get_post_banners(300,150); ?>
      <?php endif; ?>

* Customize the code according to usage instructions & examples

Using theWidget:

* Browse to Design - Widgets section of your Wordpress blog. Add Post Banners widget and configure it.
* Widget title: Give it a title
* Image Width: Set the banner width
* Image Height: Set the maximum banner height
* Max Items: (Optional) Set maximum amount of items
* Post Filter:  (Optional) Set post filter. 

For more information about filters check; [http://codex.wordpress.org/Template_Tags/get_posts](http://codex.wordpress.org/Template_Tags/get_posts)

== Frequently Asked Questions ==

= More information & Download =
 
For more information and examples check [plugins homepage](http://www.huseyinuslu.net/wp-post-banners/) 

== Changelog ==

[09.08.2007] version 0.41

* quick bugfix release

[08.07.2007] version 0.4

* added plugin configuration
* added widget support
* cleaned div styles
* redesigned code from stratch; better & flexible now

[07.08.2007] 0.3

* Added title label to bottom. Maybe can be done with GD?* Added mouse over tooltip showing post title & content

[06.08.2007] 0.2:

* plugin now uses GD library to resize & crop the image, to optimize the bandwitdh images uses

[06.08.2007] 0.1:

* initial release

== Todo ==


* Recode title label with GD?