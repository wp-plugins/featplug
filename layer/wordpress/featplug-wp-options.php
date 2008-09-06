<?php

/*  
	FeatPlug - http://featplug.huseyinuslu.net

	Featplug is free for non-commercial use. For commercial usage and redistribution with commercial packages
	check the plugins webpage http://featplug.huseyinuslu.net

	Huseyin Uslu < shalafirasitlin@gmail.com | http://www.huseyinuslu.net >
*/

?>


<div class="wrap">
<h2>FeatPlug</h2>

<h3>What is FeatPlug?</h3>
Featplug is a plugin that can mine your Wordpress (or any other Blog/CMS/Forum software's) posts and generates 'featured content' section for your site using the found items. 

<h3>Test / Demo:</h3>
<?php

	// featplug demo
	$e=new engine();
	$e->layer("STAND_ALONE");
	$e->set_output_dimensions(600,175);


	$p=new post_item();
	$p->img="<img src=\"" . $e->path() . "/examples/images/featplug.png\">";
	$p->label="featplug";
	$e->add_item($p);

	$p=new post_item();
	$p->img="<img src=\"" . $e->path() . "/examples/images/featplug2.png\">";
	$p->label="Story Mining";
	$e->add_item($p);

	$p=new post_item();
	$p->img="<img src=\"" . $e->path() . "/examples/images/featplug3.png\">";
	$p->label="Integration";
	$e->add_item($p);

	$p=new post_item();
	$p->img="<img src=\"" . $e->path() . "/examples/images/featplug4.png\">";
	$p->label="Theme Support";
	$e->add_item($p);

	$p=new post_item();
	$p->img="<img src=\"" . $e->path() . "/examples/images/featplug5.png\">";
	$p->label="Plug-in now!";
	$e->add_item($p);



	$e->set_template("smoothgallery");
	echo $e->render();
	$e=null;

?>

<h3>Installation / Usage</h3>
If you see the above slideshow, than it means you've install FeatPlug succesfully.
To use it on your blog, you can use it as widget or call it from your blog template.

For more information check plugin's <a href="http://featplug.huseyinuslu.net/documentation">Documentation</a>.
<br><br>
There exists <a href="http://featplug.huseyinuslu.net/faq">FAQ</a> and <a href="http://featplug.huseyinuslu.net/forum">Support Forums</a> in any case you need.

<h3>Donation & Help </h3>
If you liked the plugin and want it to be developed further, you can just 
<form action="https://www.paypal.com/cgi-bin/webscr" method="post"> <input name="cmd" type="hidden" value="_donations" /> <input name="business" type="hidden" value="shalafiraistlin@gmail.com" /> <input name="item_name" type="hidden" value="WP-Post-Banners" /> <input name="no_shipping" type="hidden" value="0" /> <input name="no_note" type="hidden" value="1" /> <input name="currency_code" type="hidden" value="USD" /> <input name="tax" type="hidden" value="0" /> <input name="lc" type="hidden" value="US" /> <input name="bn" type="hidden" value="PP-DonationsBF" /> <input alt="PayPal - The safer, easier way to pay online!" name="submit" src="https://www.paypal.com/en_US/i/btn/btn_donate_LG.gif" type="image" /> <img src="https://www.paypal.com/en_US/i/scr/pixel.gif" border="0" alt="" width="1" height="1" /></form><form action="https://www.paypal.com/cgi-bin/webscr" method="post"></form>

Check <a href="http://featplug.huseyinuslu.net/donate">latest donations</a> to see people that helped development of FeatPlug!



