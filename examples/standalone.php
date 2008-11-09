<html>
<meta>
<title>Featplug Standalone Demo</title>
</meta>
<body>

<?php

/*  
	FeatPlug - http://www.featplug.com

	Featplug is free for non-commercial use. For commercial usage and redistribution with commercial packages
	check the plugins webpage http://featplug.huseyinuslu.net

	Huseyin Uslu < shalafirasitlin@gmail.com | http://www.regularsexpressions.com >
*/


include '../engine.php'; // include the featplug engine


pump_test_data();

function pump_test_data()
{
	$e=new engine(); // init engine
	$e->layer("STAND_ALONE"); // layer: Standalone

	$e->set_maximum_stories(5); // maximum number of strories to show
	$e->set_story_lenght(150); // story text lenght
	$e->set_output_dimensions(500,350); // output image dimensions
	$e->set_thumbnail_dimensions(50,50); // thumbnail dimensions

	$e->enable_image_enlarging(True); // enlarge images?

	// Start pumping sample stories

	$p=new post_item();
	$p->img="<img src='http://fc07.deviantart.com/fs14/f/2007/005/e/0/The_Simpsonzu_by_spacecoyote.jpg'>";
	$p->label="Sample Post I";
	$p->content="Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.";
	$e->add_item($p);
	
	$p=new post_item();
	$p->img="<img src='http://fc03.deviantart.com/fs31/f/2008/204/d/9/d962113e73c4ea06ef8bac44b0eb93e3.jpg'>";
	$p->label="Sample Post II";
	$p->content="Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.";
	$e->add_item($p);

	$p=new post_item();
	$p->img="<img src=\"" . $e->path() . "/examples/images/featplug.png\">";
	$p->label="featplug";
	$e->add_item($p);

	$p=new post_item();
	$p->img="<img src=\"" . $e->path() . "/examples/images/featplug2.png\">";
	$p->label="Story Mining";
	$e->add_item($p);

	$p=new post_item();
	$p->label="Integration";
	$p->content=" What distinguishes PHP from something like client-side JavaScript is that the code is executed on the server, generating HTML which is then sent to the client. The client would receive the results of running that script, but would not know what the underlying code was. You can even configure your web server to process all your HTML files with PHP, and then there's really no way that users can tell what you have up your sleeve. ";
	$e->add_item($p);

	// now render with different templates
	
	echo "<h2>Slideshow template:</h2><br>";
	$e->set_template("smoothgallery"); // slideshow
	echo $e->render(); 

	echo "<h2>Banners:</h2><br>";
	$e->set_template("simple_banners"); // banners
	echo $e->render(); 

	$e->set_template("debug"); // debug mode
	echo $e->render(); 


	$e=null; // release resources
}


?>
</body>
</html>