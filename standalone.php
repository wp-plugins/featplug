<html>
<meta>
<title>WP-POST-BANNERS STANDALONE</tile>
</meta>
<body>
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

include 'engine.php'; 


pump_test_data();

function pump_test_data()
{
	$e=new engine();
	$e->layer("STAND_ALONE");	

	$e->set_maximum_stories(5);
	$e->set_story_lenght(500);
	$e->set_output_dimensions(500,500);
	$e->set_thumbnail_dimensions(60,60);

	$e->enable_image_enlarging(True);
	
	$p=new post_item();
	$p->img="<img src='http://fc07.deviantart.com/fs14/f/2007/005/e/0/The_Simpsonzu_by_spacecoyote.jpg'>";
	$p->label="Sample Post I";
	$p->content="Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.";
	$p->link="http://www.huseyinuslu.net/wp-post-banners";
	$e->add_item($p);
	
	$p=new post_item();
	$p->img="<img src='http://fc03.deviantart.com/fs31/f/2008/204/d/9/d962113e73c4ea06ef8bac44b0eb93e3.jpg'>";
	$p->label="Sample Post II";
	$p->content="Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.";
	$p->link="http://www.huseyinuslu.net/";
	$e->add_item($p);

	$p=new post_item();
	$p->img="<img src=\"http://www.huseyinuslu.net/wp-content/plugins/wp-post-banners/images/featplug.png\">";
	$p->label="featplug";
	$e->add_item($p);

	$p=new post_item();
	$p->img="<img src=\"http://www.huseyinuslu.net/wp-content/plugins/wp-post-banners/images/featplug2.png\">";
	$p->label="Story Mining";
	$e->add_item($p);

	$p=new post_item();
	$p->label="Integration";
	$p->content=" What distinguishes PHP from something like client-side JavaScript is that the code is executed on the server, generating HTML which is then sent to the client. The client would receive the results of running that script, but would not know what the underlying code was. You can even configure your web server to process all your HTML files with PHP, and then there's really no way that users can tell what you have up your sleeve. ";
	$e->add_item($p);
	
	$e->set_template("smoothgallery");

	echo $e->render(); 
	$e=null; // release resources
}


?>
</body>
</html>